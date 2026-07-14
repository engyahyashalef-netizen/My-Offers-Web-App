<?php
session_start();
include "connection.php";

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$cart = &$_SESSION['cart'];

// Handle updates (quantities or removals)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        foreach ($_POST['quantity'] as $id => $qty) {
            $id = (int)$id;
            $qty = (int)$qty;
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id] = $qty;
            }
        }
    }
    if (isset($_POST['clear'])) {
        $_SESSION['cart'] = [];
        $cart = [];
    }
}

// Fetch product details
$items = [];
$total = 0;
if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $sql = "SELECT id, title, image, org_price, discount FROM offer WHERE id IN ($ids)";
    $res = mysqli_query($con, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $id       = $row['id'];
        $qty      = $cart[$id];
        $orig     = (float)$row['org_price'];
        $disc     = (float)$row['discount'];
        $price    = $orig - ($orig * $disc / 100);
        $subtotal = $price * $qty;
        $total   += $subtotal;
        $items[] = [
            'id'       => $id,
            'title'    => htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'),
            'image'    => htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'),
            'unit'     => $price,
            'qty'      => $qty,
            'subtotal' => $subtotal,
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <a href="index.php">Home</a>
  <title>Your Cart</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
    h1 { margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
    th, td { padding: 10px; border: 1px solid #ddd; text-align: center; }
    th { background: #f0f0f0; }
    img { max-width: 80px; height: auto; }
    .actions { margin-top: 10px; }
    .btn { padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
    .btn-update { background: #2196F3; color: #fff; }
    .btn-clear  { background: #f44336; color: #fff; }
    .btn-checkout { background: #4CAF50; color: #fff; float: right; }
    .total { font-size: 18px; font-weight: bold; text-align: right; }
  </style>
</head>
<body>
  <h1>Your Shopping Cart</h1>

  <?php if (empty($items)): ?>
    <p>Your cart is empty.</p>
    <p><a href="index.php">Continue Shopping</a></p>
  <?php else: ?>
    <form method="post">
      <table>
        <thead>
          <tr>
            <th>Product</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $item): ?>
            <tr>
              <td>
                <img src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>"><br>
                <?= $item['title'] ?>
              </td>
              <td><?= number_format($item['unit'], 2) ?> SAR</td>
              <td>
                <input type="number" name="quantity[<?= $item['id'] ?>]" value="<?= $item['qty'] ?>" min="0" style="width: 60px;">
              </td>
              <td><?= number_format($item['subtotal'], 2) ?> SAR</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <p class="total">Total: <?= number_format($total, 2) ?> SAR</p>

      <div class="actions">
        <button type="submit" name="update" class="btn btn-update">Update Cart</button>
        <button type="submit" name="clear" class="btn btn-clear">Clear Cart</button>
        <button type="button" onclick="window.location='checkout.php'" class="btn btn-checkout">Proceed to Checkout</button>
      </div>
    </form>
  <?php endif; ?>
  <script src="js/scripts.js"></script>
</body>
</html>

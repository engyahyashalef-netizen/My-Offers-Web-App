<?php
include "connection.php";

// تأكد من وجود id
if (!isset($_GET['id'])) {
    echo '<p>No offer ID provided.</p>';
    exit;
}

$offer_id = (int) $_GET['id'];
$sql = "SELECT * FROM offer WHERE id = $offer_id";
$result = mysqli_query($con, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo '<p>Offer not found.</p>';
    exit;
}

$row   = mysqli_fetch_assoc($result);
$orig  = (float) $row['org_price'];
$disc  = (float) $row['discount'];
$deal  = $orig - ($orig * $disc / 100);
$title = htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8');
$image = 'uploads/' . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
$desc  = nl2br(htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8'));
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="css/style3.css">

</head>
<body>

  <div class="breadcrumb">
    <a href="index.php">Home</a>
    <span>&gt;</span>
    <span><?= $title ?></span>
  </div>

  <div class="offer-container">

    <div class="offer-left">
      <img class="main" src="<?= $image ?>" alt="<?= $title ?>">
      
    </div>

    <div class="offer-right">
      <div class="quantity-selector">
        <label for="qty">Quantity:</label>
        <input type="number" id="qty" name="quantity" value="1" min="1">
      </div>
      <div class="discount-badge"><?= $disc ?>% OFF</div>

      <div class="price-section">
        <span>SAR <s><?= number_format($orig,2) ?></s> <span class="deal-price-amount"><?= number_format($deal,2) ?></span></span>
      </div>

      <form method="post" action="cart.php">
        <input type="hidden" name="offer_id" value="<?= $offer_id ?>">
        <input type="hidden" name="title" value="<?= $title ?>">
        <input type="hidden" name="price" value="<?= $deal ?>">
        <input type="hidden" name="image" value="<?= $image ?>">
        <input type="hidden" name="quantity" id="formQty" value="1">
        <button type="submit" class="add-cart-btn">
        🛒 ADD TO CART
        </button>
      </form>

    </div>

  </div>

  <p class="caption"><?= $desc ?></p>

  <script>
    // Sync quantity input with form hidden input
    const qtyInput = document.getElementById('qty');
    const formQty = document.getElementById('formQty');
    qtyInput.addEventListener('change', () => {
      formQty.value = qtyInput.value;
    });
  </script>
<script src="js/scripts.js"></script>
</body>
<?php include 'footer.php'; ?>

</html>

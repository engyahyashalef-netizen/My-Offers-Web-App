<?php
$pageTitle = 'Add Offer';
include 'header.php';

$success = false;
$errors = [];

// تعريف المتغيرات
$title = $_POST['title'] ?? '';
$description = $_POST['description'] ?? '';
$org_price = $_POST['org_price'] ?? '';
$discount = $_POST['discount'] ?? '';
$cat_id = $_POST['cat_id'] ?? '';
$quantity = $_POST['quantity'] ?? '';
$image = '';

// عند الإرسال
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['image']['tmp_name'];
        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $name = basename($_FILES['image']['name']);
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $uniqueName = uniqid('img_', true) . '.' . $extension;
        $targetPath = $uploadDir . $uniqueName;

        if (move_uploaded_file($tmp, $targetPath)) {
            $image = $uniqueName;
        } else {
            $errors[] = "Sorry, your file was not uploaded.";
        }
    } elseif (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_INI_SIZE) {
        $errors[] = "Sorry, your file is too large.";
    }

    $stmt = mysqli_prepare($con,
        "INSERT INTO offer (title, image, description, org_price, discount, cat_id, user_id, quantity, creation_date)
         VALUES (?, ?, ?, ?, ?, ?, 1, ?, NOW())");
    mysqli_stmt_bind_param($stmt, 'sssdiis',
        $title, $image, $description, $org_price, $discount, $cat_id, $quantity);

    if (mysqli_stmt_execute($stmt)) {
        $success = true;
    } else {
        $errors[] = "Failed to add offer to database.";
    }
}
?>

<link rel="stylesheet" href="css/style5.css">


<main class="main-content">
    <div class="offer-form-container">
        <a href="index.php" class="back-link">← Back to Home Page</a>
        <h2>Add Offer</h2>

        <?php if (!empty($errors)): ?>
            <p style="color: red;"><?php echo implode('<br>', $errors); ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p style="color: green;">Thank you. Offer data has been entered. Check database.</p>
        <?php endif; ?>

        <form action="submit-offer.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Offer Title..." required>

            <select name="cat_id" required>
                <option value="">Choose Category</option>
                <?php
                $cats = mysqli_query($con, "SELECT * FROM category");
                while ($c = mysqli_fetch_assoc($cats)) {
                    echo '<option value="' . $c['id'] . '">' . htmlspecialchars($c['title']) . '</option>';
                }
                ?>
            </select>

            <input type="file" name="image">
            <textarea name="description" placeholder="Offer Description..."></textarea>
            <input type="number" step="0.01" name="org_price" placeholder="Original Price (e.g. 5.50)" required>
            <input type="number" name="discount" placeholder="Discount (e.g. 30%)" required>
            <input type="number" name="quantity" placeholder="Quantity..." required>

            <button type="submit">SAVE</button>
        </form>
    </div>
</main>
<script src="js/scripts.js"></script>
<?php include 'footer.php'; ?>

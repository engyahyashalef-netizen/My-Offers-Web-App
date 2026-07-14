<?php
// index.php
$pageTitle = 'Cobone - Latest Offers';
include 'header.php';
?>



<link rel="stylesheet" href="css/style6.css">
<link rel="stylesheet" href="css/style2.css">

<main class="main-content">
  <?php
  if (isset($_GET['cat_id'])) {
      // إذا تم تمرير معرّف الفئة
      $cat_id = (int) $_GET['cat_id'];  // تحويل cat_id إلى عدد صحيح
      $sql    = "SELECT * FROM offer WHERE cat_id = $cat_id ORDER BY id DESC"; // استعلام لعرض العروض من نفس الفئة
  } else {
      // إذا لم يتم تمرير معرّف الفئة، عرض جميع العروض
      $sql = "SELECT * FROM offer ORDER BY id DESC"; // استعلام لعرض جميع العروض
  }
  $res = mysqli_query($con, $sql); // تنفيذ الاستعلام
  if (mysqli_num_rows($res) > 0) {
      echo '<div class="deals-grid">';
      while ($offer = mysqli_fetch_assoc($res)) {
          // حساب سعر العرض بعد الخصم
          $dealPrice = $offer['org_price'] - ($offer['org_price'] * $offer['discount'] / 100);
          echo '<div class="deal-card">';
echo '  <a href="offer.php?id=' . $offer['id'] . '">';
echo '    <img src="uploads/' . htmlspecialchars($offer['image']) . '" class="deal-image">';
echo '  </a>';
echo '  <div class="deal-info">';
echo '    <h3>' . htmlspecialchars($offer['title']) . '</h3>';
echo '    <p>' . htmlspecialchars($offer['description']) . '</p>';
echo '  </div>';
echo '  <div class="deal-meta">';
echo '    <span class="discount-badge">' . $offer['discount'] . '% Off</span>';
echo '    <span class="store-name">Al Anaeem</span>';
echo '  </div>';
echo '  <div class="deal-price">';
echo '    <span class="price-old">SAR ' . number_format($offer['org_price']) . '</span>';
echo '    ' . number_format($dealPrice) . '';
echo '  </div>';
echo '</div>';

      }
      echo '</div>';
  } else {
      echo '<p>No offers found.</p>'; // إذا لم توجد عروض
  }
  ?>
</main>

<?php include 'footer.php'; ?>

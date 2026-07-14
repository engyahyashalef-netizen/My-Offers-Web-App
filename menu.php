<?php

$con = mysqli_connect('localhost','root','','myoffers');
if (mysqli_connect_errno()) {
    die("DB connect error: " . mysqli_connect_error());
}



echo '<nav class="nav">';
echo '<a href="index.php">Home</a>';

$sql    = "SELECT * FROM category";
$result = mysqli_query($con, $sql);

while ( $cat = mysqli_fetch_assoc($result) ) {
    echo '<a href="index.php?cat_id='
       . $cat['id']
       . '">'
       . htmlspecialchars( $cat['title'] )
       . '</a>';
}

echo '</nav>';
?>

<?php
// header.php
include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Cobone'; ?></title>
    <link rel="stylesheet" href="css/style6.css">
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>

<div class="top-header">
    <div class="logo">
        <a href="index.php"><img src="img/logo.jpg" alt="Cobone Logo"></a>
    </div>
    <div class="my-account">
        <a href="login.php"><span>👤 My Account</span></a> |
        <a href="register.php">Register</a> |
        <a href="submit-offer.php">Add Offer</a>
    </div>
</div>

<nav class="menu-bar">
    <a href="index.php" class="home-link">Home</a>
    <?php
    $sql = "SELECT * FROM category";
    $result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="index.php?cat_id=' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a>';
        }
    }
    ?>
    <div class="search-bar">
        <form action="index.php" method="GET">
            <input
                type="text"
                name="search"
                placeholder="Search offers..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
            >
            <button
                type="submit"
                name="searchOffers"
                title="Search Offers"
            >
                🔍 Search Offers
            </button>
        </form>
    </div>
</nav>

<?php
$pageTitle = "Register";
include 'header.php';
include 'connection.php';

$success = false;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ( empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } else {
        $sql = "INSERT INTO promoters ( email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 'sss',  $email, $password);

        if (mysqli_stmt_execute($stmt)) {
            $success = true;
        } else {
            $errors[] = "Failed to register user.";
        }
    }
}
?>
    <link rel="stylesheet" href="css/style.css">

<div class="form-container">
    <h2>User Registration</h2>

    <?php if (!empty($errors)): ?>
        <div style="color:red;"><?php echo implode("<br>", $errors); ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div style="color:green;">User registered successfully!</div>
    <?php endif; ?>

    <form action="register.php" method="POST">
       
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</div>
<script src="js/scripts.js"></script>
<?php include 'footer.php'; ?>

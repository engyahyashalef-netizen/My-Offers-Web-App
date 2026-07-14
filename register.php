<?php
$pageTitle = 'Register';
include 'header.php';

$errors = [];
$success = false;

$firstName = $lastName = $email = $password = $address = $mobile = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName']  ?? '');
    $email     = trim($_POST['email']     ?? '');
    $password  = trim($_POST['password']  ?? '');
    $address   = trim($_POST['address']   ?? '');
    $mobile    = trim($_POST['mobile']    ?? '');

    if (!$firstName) $errors['firstName'] = 'First Name is required';
    if (!$lastName)  $errors['lastName']  = 'Last Name is required';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid Email is required';
    if (!$password)  $errors['password'] = 'Password is required';
    if (!$address)   $errors['address'] = 'Address is required';
    if (!$mobile)    $errors['mobile']  = 'Mobile is required';

    if (empty($errors)) {
        $stmt = mysqli_prepare($con, "INSERT INTO user (firstName, lastName, email, password, address, mobile, creation_date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, 'ssssss', $firstName, $lastName, $email, $password, $address, $mobile);
        mysqli_stmt_execute($stmt);
        $success = true;
    }
}
?>

<link rel="stylesheet" href="css/style4.css">


<main class="main-content">
    <div class="form-container">
    <a href="index.php">Home</a>
        <h2>Register</h2>

        <?php if ($success): ?>
            <p class="success">Thank you! Your data has been entered. <a href="index.php">Back to home page</a></p>
        <?php else: ?>
            <?php if (!empty($errors)): ?>
                <p class="error">Please enter required data!</p>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <label>First Name</label>
                <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
                <?php if (isset($errors['firstName'])) echo "<p class='error'>* {$errors['firstName']}</p>"; ?>

                <label>Last Name</label>
                <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
                <?php if (isset($errors['lastName'])) echo "<p class='error'>* {$errors['lastName']}</p>"; ?>

                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                <?php if (isset($errors['email'])) echo "<p class='error'>* {$errors['email']}</p>"; ?>

                <label>Password</label>
                <input type="password" name="password">
                <?php if (isset($errors['password'])) echo "<p class='error'>* {$errors['password']}</p>"; ?>

                <label>Address</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
                <?php if (isset($errors['address'])) echo "<p class='error'>* {$errors['address']}</p>"; ?>

                <label>Mobile</label>
                <input type="text" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">
                <?php if (isset($errors['mobile'])) echo "<p class='error'>* {$errors['mobile']}</p>"; ?>

                <p style="font-size: 12px; color: #777;">
                    By clicking Register, you agree to our <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a>
                </p>

                <button type="submit">REGISTER</button>
            </form>
        <?php endif; ?>
    </div>
</main>
<script src="js/scripts.js"></script>
<?php include 'footers.php'; ?>

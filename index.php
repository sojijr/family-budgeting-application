<?php
session_start();
include("include/dbConnect.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM family_profile WHERE Email = '$email' AND Password = '$password'";
    $result = $conn->query($sql);

    $user_matched = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    if ($user_matched > 0) {
        $_SESSION['loginUser'] = $row['FamilyID'];
        $_SESSION['familyName'] = $row['Name'];
        $_SESSION['income'] = $row['TotalMonthlyIncome'];
        $_SESSION['savingsGoal'] = $row['MonthlySavingsGoal'];
        header("location: dashboard.php");
    } else {
        echo "<script>alert('Invalid email or password')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body class="blue-gold-theme">
    <div class="container">
        <h1>Login</h1>
        <form method="POST">
            <label for="email">Email Address:</label>
            <input type="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>

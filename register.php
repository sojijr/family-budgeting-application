<?php
session_start();
include("include/dbConnect.php");

if (isset($_POST['register'])) {
    $name = $_POST['family-name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $income = $_POST['income'];
    $savingsGoal = $_POST['saving-goal'];

    $checkEmail = "SELECT * FROM family_profile WHERE Email = '$email'";
    $result = $conn->query($checkEmail);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email is already registered. Please use a different email.')</script>";
    } else {
        $sql = "INSERT INTO family_profile (Name, Email, Password, TotalMonthlyIncome, MonthlySavingsGoal) 
                VALUES ('$name', '$email', '$password', '$income', '$savingsGoal')";

        if ($conn->query($sql) === TRUE) {
            // auto-login after successful registration
            $familyId = $conn->insert_id;
            $_SESSION['loginUser'] = $familyId;
            $_SESSION['familyName'] = $name;
            $_SESSION['income'] = $income;
            $_SESSION['savingsGoal'] = $savingsGoal;

            echo "<script>alert('Registration successful!')</script>";
            header("location: dashboard.php");
        } else {
            echo "<script>alert('Registration failed. Please try again.')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body class="blue-gold-theme">
    <div class="container">
        <h1>Register</h1>
        <form method="POST" id="register-form">
            <!-- Page 1 -->
            <div class="page page-1">
                <label for="family-name">Family Name:</label>
                <input type="text" name="family-name" required>
                <label for="email">Email Address:</label>
                <input type="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
                <button type="button" id="next" class="btn">Next</button>
            </div>
            <!-- Page 2 -->
            <div class="page page-2 hidden">
                <label for="income">Total Monthly Income:</label>
                <input type="number" name="income" required>
                <label for="savings-goal">Monthly Savings Goal:</label>
                <input type="number" name="saving-goal" required>
                <button type="submit" name="register" class="btn">Register</button>
            </div>
        </form>
    </div>
</body>
<script src="public/js/app.js"></script>
</html>

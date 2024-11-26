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
        <form id="register-form">
            <!-- Page 1 -->
            <div class="page page-1">
                <label for="family-name">Family Name:</label>
                <input type="text" id="family-name" required>
                <label for="email">Email Address:</label>
                <input type="email" id="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" required>
                <button type="button" id="next" class="btn">Next</button>
            </div>
            <!-- Page 2 -->
            <div class="page page-2 hidden">
                <label for="income">Total Monthly Income:</label>
                <input type="number" id="income" required>
                <label for="savings-goal">Monthly Savings Goal:</label>
                <input type="number" id="savings-goal" required>
                <button type="submit" class="btn">Register</button>
            </div>
        </form>
    </div>
</body>
<script src="public/js/app.js"></script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body class="blue-gold-theme">
    <div class="dashboard-container">
        <div class="dashboard-header">
        <div class="welcome-info">
            <span>Welcome {Family Name}</span>
            <p>Monthly Income: ₦0<br>Savings Goal: ₦0</p>
        </div>
            <button class="btn logout">Logout</button>
        </div>
        <h1>Budget Summary</h1>
        <div id="summary">
            <p>Total Expenses: <span id="total-expenses">₦0</span></p>
            <p>Remaining Budget: <span id="remaining-budget">₦0</span></p>
            <p>Savings Goal Reached: <span id="savings-percentage">0%</span></p>
        </div>
        <div class="dashboard-content">
        <!-- Add Expense Section -->
        <div class="add-expense-section">
        <form id="expense-form">
            <h3>Add an Expense/Saving</h3>
            <label for="category">Category:</label>
            <select id="category">
                <option value="food">Food</option>
                <option value="rent">Rent</option>
                <option value="savings">Savings</option>
                <option value="utilities">Utilities</option>
                <option value="miscellaneous">Miscellaneous</option>
            </select>
            <label for="amount">Amount:</label>
            <input type="number" id="amount" required>
            <label for="description">Description:</label>
            <input type="text" id="description" required>
            <button type="submit" id="add-button" class="btn">Add Expense</button>
        </form>
        </div>
        <!-- Previous Categories Section -->
        <div class="categories-section">
            <h3>Expense History</h3>
            <ul>
                <li>Food - ₦1000</li>
                <li>Food - ₦1000</li>
                <li>Food - ₦1000</li>
            </ul>
        </div>
        </div>
    </div>
</body>
<script src="public/js/app.js"></script>
</html>

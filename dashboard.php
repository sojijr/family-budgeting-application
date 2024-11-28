<?php
session_start();
include("include/dbConnect.php");

if (!isset($_SESSION['loginUser'])) {
    header("location: index.php");
    exit();
}

$familyID = $_SESSION['loginUser'];
$familyName = $_SESSION['familyName'];
$totalIncome = $_SESSION['income'];
$savingsGoal = $_SESSION['savingsGoal'];

// Calculate total expenses
$expensesQuery = "SELECT SUM(Amount) AS TotalExpenses FROM expenses WHERE FamilyID = '$familyID'";
$expensesResult = $conn->query($expensesQuery);
$totalExpenses = $expensesResult->fetch_assoc()['TotalExpenses'] ?? 0;

// Calculate savings progress (using CategoryID = 3 for savings)
$savingsQuery = "SELECT SUM(Amount) AS TotalSavings FROM expenses WHERE FamilyID = '$familyID' AND CategoryID = 3";
$savingsResult = $conn->query($savingsQuery);
$totalSavings = $savingsResult->fetch_assoc()['TotalSavings'] ?? 0;

// Calculate remaining budget and savings progress percentage
$remainingBudget = number_format($totalIncome - $totalExpenses, 2);
$savingsProgress = ($totalSavings >= $savingsGoal) ? 100 : ($totalSavings / $savingsGoal) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/css/styles.css">

    <style>
     body {
        height: auto;
    }
    </style>

</head>
<body class="blue-gold-theme">
    <div class="dashboard-container">
        <div class="dashboard-header">
        <div class="welcome-info">
            <span>Welcome, <?php echo $familyName; ?></span>
            <p>Monthly Income: ₦<?php echo $totalIncome; ?><br>Savings Goal: ₦<?php echo $savingsGoal; ?></p>
        </div>
        <a href="logout.php"><button class="btn logout">Logout</button></a>
        </div>
        <h1>Budget Summary</h1>
        <div id="summary">
            <p>Total Expenses: <span id="total-expenses">₦<?php echo $totalExpenses; ?></span></p>
            <p>Remaining Budget: <span id="remaining-budget">₦<?php echo $remainingBudget; ?></span></p>
            <p>Savings Goal Reached: <span id="savings-percentage"><?php echo round($savingsProgress, 2); ?>%</span></p>
        </div>
        <div class="dashboard-content">
        <!-- Add Expense Section -->
        <div class="add-expense-section">
        <form action="add_expense.php" method="POST" id="expense-form">
            <h3>Add an Expense/Saving</h3>
            <label for="category">Category:</label>
            <select name="category" id="category">
                <option value="1">Food</option>
                <option value="2">Rent</option>
                <option value="3">Savings</option>
                <option value="4">Utilities</option>
                <option value="5">Miscellaneous</option>
            </select>
            <label for="amount">Amount:</label>
            <input type="number" name="amount" required>
            <label for="description">Description:</label>
            <input type="text" name="description">
            <button type="submit" name="addExpense" id="add-button" class="btn">Add Expense</button>
        </form>
        </div>
        <!-- Previous Categories Section -->
        <div class="categories-section">
            <h3>Expense History</h3>
            <ul>
                <?php
                $expensesQuery = "SELECT e.Amount, e.Description, b.CategoryName
                          FROM expenses e, budgetcategory b
                          WHERE e.CategoryID = b.CategoryID AND e.FamilyID = '$familyID'
                          ORDER BY e.Date DESC";

                $expensesResult = $conn->query($expensesQuery);

                if ($expensesResult->num_rows > 0) {
                    while ($expense = $expensesResult->fetch_assoc()) {
                    $description = !empty($expense['Description']) ? " ({$expense['Description']})" : "";
                    echo "<li>{$expense['CategoryName']} - ₦" . number_format($expense['Amount'], 2) . "$description</li>";
                    }
                } else {
                echo "<li>No expenses recorded yet.</li>";
                }
                ?>
            </ul>
        </div>
        </div>
    </div>
</body>
<script src="public/js/app.js"></script>
</html>

<?php
session_start();
include("include/dbConnect.php");

if (isset($_POST['addExpense'])) {
    $familyID = $_SESSION['loginUser'];
    $amount = $_POST['amount'];
    $categoryID = $_POST['category'];
    $description = $_POST['description'];
    $date = date('Y-m-d');

    $sql = "INSERT INTO expenses (Date, Amount, CategoryID, FamilyID, Description) 
            VALUES ('$date', '$amount', '$categoryID', '$familyID', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Expense/Saving added successfully!')</script>";
        header("location: dashboard.php");
    } else {
        echo "<script>alert('Failed to add Expense/Saving. Please try again.')</script>";
        header("location: dashboard.php");
    }
}
?>

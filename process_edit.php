<?php
session_start();
require_once 'db_config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You need to log in first.");
}

// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaction_id = $_POST['transaction_id'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    // Update the transaction in the database
    $query = "UPDATE transactions SET category = ?, description = ?, amount = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdi", $category, $description, $amount, $transaction_id);

    if ($stmt->execute()) {
        header('Location: view_transactions.php'); // Redirect back to the view page
    } else {
        echo "Error updating transaction: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
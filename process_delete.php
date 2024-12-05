<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_system');

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    die("You need to log in first.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the transaction ID from the POST request
    $transaction_id = intval($_POST['transaction_id']);

    // Prepare the DELETE query
    $query = "DELETE FROM transactions WHERE id = ? AND owner = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $username = $_SESSION['username']; // Owner is required to ensure only their data is deleted
        $stmt->bind_param("is", $transaction_id, $username);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = "Transaction deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to delete the transaction.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Error preparing the delete query.";
    }
}

$conn->close();

// Redirect back to the view transactions page
header("Location: view_transactions.php");
exit();
?>
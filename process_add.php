<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the logged-in username from the session
$username = $_SESSION['username'];

// Get form inputs
$category = $_POST['category'];
$description = $_POST['description'];
$amount = $_POST['amount'];

// Validate inputs
if (empty($category) || empty($description) || empty($amount)) {
    die("All fields are required.");
}

// Establish a connection to the database
$conn = new mysqli("localhost", "root", "", "user_system");

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use a prepared statement to insert user data
$query = "INSERT INTO transactions (owner, category, amount, description) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);

if ($stmt) {
    // Bind parameters ('s' for string, 'i' for integer)
    $stmt->bind_param("ssis", $username, $category, $amount, $description);

    // Execute the statement
    if ($stmt->execute()) {
        echo "$username added a new transaction!";
    } else {
        echo "Error saving transaction: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing the query: " . $conn->error;
}

// Close the connection
$conn->close();

// Redirect to the transactions page
header("Location: view_transactions.php");
exit();
?>

<?php
$username = $_POST["username"];
$password = $_POST["password"];
$year = $_POST["year"];
$course = $_POST["course"];
$program = $_POST["program"];

// Hash the password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Establish a database connection
$conn = new mysqli("localhost", "root", "", "user_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use a prepared statement to insert user data
$query = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($query);

if ($stmt) {
    // Bind parameters (s = string)
    $stmt->bind_param("ss", $username, $password_hash);

    // Execute the statement
    if ($stmt->execute()) {
        echo "User $username created successfully";
    } else {
        echo "Error saving $username: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error preparing the query: " . $conn->error;
}

// Close the connection
$conn->close();

// Redirect to the login page
header("Location: login.php", true, 301);
exit;
?>

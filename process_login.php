<?php
$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect('localhost', 'root', '', 'user_system');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Verify the password
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['username'] = $username;

        header("Location: home.php", true, 301);
        exit;
    } else {
        header("Location: login.php?error=invalid_password", true, 301);
        exit;
    }
} else {
    header("Location: login.php?error=no_user", true, 301);
    exit;
}

$stmt->close();
$conn->close();
?>
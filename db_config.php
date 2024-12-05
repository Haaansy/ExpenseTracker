<?php
// db_config.php
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$database = "user_system";

// Establish a connection to the database
$conn = new mysqli($host, $dbuser, $dbpass, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
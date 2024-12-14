<?php
// Database connection settings
$host = '127.0.0.1';        // Your database host
$username = 'root';          // Your MySQL username
$password = '';              // Your MySQL password (empty for XAMPP)
$database = 'access_edu';    // Your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

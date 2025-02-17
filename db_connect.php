<?php
$host = 'localhost';  // Database host
$username = 'root';   // Database username (default for XAMPP is root)
$password = 'root';       // Database password (default for XAMPP is empty)
$dbname = 'location_db';  // The database you created

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

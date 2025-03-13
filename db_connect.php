<?php
$host = 'localhost';  
$username = 'root';   
$password = 'root';       
$dbname = 'location_db';  // The database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

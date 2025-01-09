<?php
// Database configuration
$host = $GLOBALS['_dbhost'];       // Database host
$dbname = $GLOBALS['_dbname']; // Database name
$username = $GLOBALS['_dbusername']; // Database username
$password = $GLOBALS['_dbpassword']; // Database password

try {
    // Create a new PDO connection
    $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Set PDO attributes for error handling
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}
?>

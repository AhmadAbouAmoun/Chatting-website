<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbDatabase = "tutorial_db";

// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Drop the database
$sql = "DROP DATABASE IF EXISTS $dbDatabase";
if ($conn->query($sql) === TRUE) {
    echo "Database dropped successfully\n";
} else {
    echo "Error dropping database: " . $conn->error;
}

$conn->close();
?>
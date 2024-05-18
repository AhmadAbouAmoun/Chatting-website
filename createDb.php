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


// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbDatabase";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the created database
$conn->select_db($dbDatabase);

// Create register table
$sql = "CREATE TABLE IF NOT EXISTS register (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    number VARCHAR(15) NOT NULL,
    modified_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    trust INT DEFAULT 100,
    banned INT DEFAULT 0,
    counter INT DEFAULT 0
)";
if ($conn->query($sql) === TRUE) {
    echo "Register table created successfully\n";
} else {
    echo "Error creating register table: " . $conn->error;
}

// Create chat table
$sql = "CREATE TABLE IF NOT EXISTS chat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    message TEXT,
    created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Chat table created successfully\n";
} else {
    echo "Error creating chat table: " . $conn->error;
}

// Create nsfw_messages table
$sql = "CREATE TABLE IF NOT EXISTS nsfw_messages (
    name VARCHAR(255) NOT NULL,
    message TEXT,
    nsfw_word VARCHAR(50) NOT NULL,
    date_sent TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "NSFW Messages table created successfully\n";
} else {
    echo "Error creating nsfw_messages table: " . $conn->error;
}

// Insert sample data into register table
$sql = "INSERT INTO register (name, email, password, number) VALUES
    ('John Doe', 'john.doe@example.com', 'securepassword', '1234567890'),
    ('Jane Smith', 'jane.smith@example.com', 'strongpassword', '9876543210')";

if ($conn->query($sql) === TRUE) {
    echo "Sample data inserted into register table successfully\n";
} else {
    echo "Error inserting sample data into register table: " . $conn->error;
}

// Insert sample data into chat table
$sql = "INSERT INTO chat (name, message) VALUES
    ('John Doe', 'Hello, world!'),
    ('Jane Smith', 'How are you doing today?')";

if ($conn->query($sql) === TRUE) {
    echo "Sample data inserted into chat table successfully\n";
} else {
    echo "Error inserting sample data into chat table: " . $conn->error;
}

// Insert sample data into nsfw_messages table
$sql = "INSERT INTO nsfw_messages (name, message, nsfw_word) VALUES
    ('John Doe', 'Inappropriate message', 'explicit'),
    ('Jane Smith', 'Keep it clean!', 'violence')";

if ($conn->query($sql) === TRUE) {
    echo "Sample data inserted into nsfw_messages table successfully\n";
} else {
    echo "Error inserting sample data into nsfw_messages table: " . $conn->error;
}



?>

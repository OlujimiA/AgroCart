<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "e-commerce");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL to create table USERS if not exists
$sql = "CREATE TABLE IF NOT EXISTS USERS (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
    user_type CHAR(20) NOT NULL,
    fullname VARCHAR(50) NOT NULL,
    Date_of_Birth VARCHAR(50) NOT NULL,
    phone_number VARCHAR(20) UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(200) NOT NULL,
    location VARCHAR(100) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    return "Table USERS created successfully <br>";
} else {
    echo "Error creating table: <br>" . mysqli_error($conn);
}
?>
<?php
// Database connection for the Employee Project Assignment system.
$conn = mysqli_connect("localhost", "root", "", "company_db");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>

<?php

// By G-Team https://glitcher.me

// Set your database connection details here
$host = 'localhost';
$username = '';
$password = '';
$database = '';

// Connect to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Delete all records from the "messages" column
$sql = "DELETE FROM messages";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    echo "All messages deleted successfully.";
} else {
    echo "Error deleting messages: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
<?php

// Connection
$servername = "localhost";
$username = "marie";
$password = "marie123";
$dbname = "onlinetherapyplatform";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
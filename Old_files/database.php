<?php
//Connect to the database
$servername = "mysql";
$username = "martindiamond289";
$password = "blue55fox";
$dbname = "saveaslave";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
?>

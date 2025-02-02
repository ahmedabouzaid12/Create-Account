<?php
session_start(); // Start session to access stored messages

$host = "localhost";
$username = "root"; 
$password = "";     
$database = "user_info"; 


$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

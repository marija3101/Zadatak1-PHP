<?php
$dbServerName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "kursevi";

$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) { 
    die("Nije moguce pristupiti bazi: " . $conn->connect_error);
}
?>
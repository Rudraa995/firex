<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$fullname = $_POST['fullname'];
$phone = $_POST['phone'];
$location = $_POST['location'];
$details = $_POST['details'];

$conn = new mysqli('localhost', 'root', '', 'firex');

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO report(fullname, phone, location, details) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $fullname, $phone, $location, $details);
$stmt->execute();

echo "report submit Successful";

$stmt->close();
$conn->close();


?>
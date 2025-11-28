<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

$conn = new mysqli('localhost', 'root', '', 'firex');

if($conn->connect_error){
    die("Connection Failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("INSERT INTO demo(fullname, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $fullname, $email, $password);
$stmt->execute();

echo "Signup Successful";

$stmt->close();
$conn->close();
?>
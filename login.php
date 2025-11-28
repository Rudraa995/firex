<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "firex");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($email == "" || $password == "") {
        echo "<script>alert('Please enter both email and password');</script>";
        exit;
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM demo WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If no user found
    if ($result->num_rows == 0) {
        echo "<script>alert('User not found! Please signup first.'); window.location.href='signup.html';</script>";
        exit;
    }

    // User exists
    $user = $result->fetch_assoc();

    if ($user['password'] === $password) {
        echo "<script>alert('Login successful!'); window.location.href='index.html';</script>";
        exit;
    } else {
        echo "<script>alert('Incorrect email or password!');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
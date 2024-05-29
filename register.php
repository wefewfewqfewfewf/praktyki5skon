<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}

$user = $_POST['username'];
$pass = $_POST['password'];

$sql = "INSERT INTO test2 (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);

if ($stmt->execute()) {
    $_SESSION['username'] = $user; 
    header('Location: superstrona.html');
    exit;
} else {
    echo "Błąd: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
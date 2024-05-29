<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularz";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['username'];
    $dish = $_POST['dish'];
    $review = $_POST['review'];

    $stmt = $conn->prepare("INSERT INTO reviews (username, dish, review) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $user, $dish, $review);

    if ($stmt->execute() === TRUE) {
        $stmt->close();
        $conn->close();
        header("Location: superstrona.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
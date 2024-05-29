<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularz";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $przypisanie = $_POST['przypisanie'];
    $tresc = $_POST['firstName'];

    
    $stmt = $conn->prepare("INSERT INTO recenzje (przypisanie, tresc) VALUES (?, ?)");
    $stmt->bind_param("ss", $przypisanie, $tresc);

    if ($stmt->execute()) {
        
        $update_stmt = $conn->prepare("UPDATE potrawy SET liczbaopini = liczbaopini + 1 WHERE nazwa = ?");
        $update_stmt->bind_param("s", $przypisanie);

        if ($update_stmt->execute()) {
            header('Location: superstrona.html');
            exit;
        } else {
            echo "Error updating record: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
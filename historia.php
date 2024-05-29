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

$user = $_SESSION['username'];
$sql = "SELECT dish, review FROM reviews WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title> bla bla</title>
    <link rel="icon" href="dinner.png" type="image/jpeg">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    </title>
</head>

<body>
    <h1>Cześć <?php echo ($user); ?></h1>

    <a href="superstrona.html"><button>Powrót na stronę główną</button></a>
    <h2>Twoje recenzje:</h2>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<p><strong>Danie:</strong> " . ($row["dish"]) . "<br>";
            echo "<strong>Treść:</strong> " . ($row["review"]) . "</p><hr>";
        }
    } else {
        echo "<p>brak danych.</p>";
    }
    $stmt->close();
    $conn->close();
    ?>
</body>

</html>
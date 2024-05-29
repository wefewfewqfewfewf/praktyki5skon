<?php
    
    $conn = new mysqli('localhost', 'root', '', 'formularz');
 

    if ($conn->connect_error) {
        die("Połączenie nieudane: " . $conn->connect_error);
    }
 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nazwa = $_POST['nazwa'];
 
        
        $stmt = $conn->prepare("UPDATE potrawy SET przyzgwazdki = przyzgwazdki + 1 WHERE nazwa = ?");
        $stmt->bind_param("s", $nazwa);
        if ($stmt->execute()) {
            echo "<p >Gwiazdka została przyznana dla potrawy: $nazwa</p>";
        } else {
            echo "<p>Błąd przyznawania gwiazdki dla potrawy: $nazwa.</p>";
        }
        $stmt->close();
    }
    ?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>twoje</title>
    <link rel="icon" href="dinner.png" type="image/jpeg">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Cześć <?php session_start(); echo $_SESSION['username']; ?></h1>

    <form action="process2.php" method="post">
        <label for="dish">danie:</label><br>
        <select id="dish" name="dish" required>
            <?php
            
            $sql = "SELECT nazwa FROM potrawy";
            $result = $conn->query($sql);
 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['nazwa'] . "'>" . $row['nazwa'] . "</option>";
                }
            } else {
                echo "<option value=''>Brak dostępnych potraw</option>";
            }
            ?>
        </select>
        <br><br>
        <label for="review">Treść:</label><br>
        <textarea id="review" name="review" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Zamieść recenzje</button>
    </form>
    <a href="superstrona.html"><button>Powrót na stronę główną</button></a>
</body>

</html>
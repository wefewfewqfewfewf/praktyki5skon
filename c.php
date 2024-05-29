<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "formularz";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name_filter = "";
if (isset($_GET['przypisanie']) && $_GET['przypisanie'] != "") {
    $name_filter = $conn->real_escape_string($_GET['przypisanie']);
}

$sql = "SELECT przypisanie,tresc FROM recenzje";
if ($name_filter != "") {
    $sql .= " WHERE przypisanie LIKE '%$name_filter%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recenzje</title>
    <link rel="stylesheet" href="styl.css">
    <link rel="icon" href="rating.png" type="image/jpeg">

</head>

<body>

    <h1>Recenzje</h1>

    <form class="filter-form" method="get" action="">
        <label for="przypisanie">Nazwa Dania :</label><br>
        <select class="form-control" id="przypisanie" name="przypisanie">
            <?php
            
            $sql2 = "SELECT DISTINCT `przypisanie` from recenzje";
            $result2 = $conn->query($sql2);
 
            if ($result2->num_rows > 0) {
                echo "<option value='" . $row[''] . "'>" . $row['']. "</option>";
                while ($row = $result2->fetch_assoc()) {
                  
                    echo "<option value='" . $row['przypisanie'] . "'>" . $row['przypisanie'] . "</option>";
                }
            } else {
                echo "<option value=''>Brak dostępnych potraw</option>";
            }
            ?>

        </select>
        <button type="submit">wyszukaj</button>
    </form>
    <a href="superstrona.html"><button>Powrót na stronę główną</button></a>
    <div class="card-container">
        <?php
    if ($result->num_rows > 0) {
    
        while($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<h2>" . ($row["przypisanie"]) . "</h2>";
            echo "<p>" . ($row["tresc"]) . "</p>";
            echo "</div>";
        }
    } else {
        echo "Brak recenzji";
    }





    
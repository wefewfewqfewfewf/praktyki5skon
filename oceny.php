<!DOCTYPE html>
<html lang="pl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="star.png" type="image/jpeg">
    <title>Średnia ocena potraw</title>
</head>

<body>
    <br>
    <br>
    <br>
    <br>
    <br>

    <h1>Średnia ocena potraw</h1>


    <?php

    $host = 'localhost';
    $db = 'formularz';
    $user = 'root'; 
    $password = ''; 

    
    $mysqli = new mysqli($host, $user, $password, $db);

    
    if ($mysqli->connect_error) {
        die('Błąd połączenia (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
    }

    
    $query = "SELECT ROUND(AVG(przyzgwazdki), 2) AS srednia FROM potrawy";
    if ($result = $mysqli->query($query)) {
        $row = $result->fetch_assoc();
        $srednia = $row['srednia'];
        echo "<p>Średnia ocena potraw: $srednia</p>";
        $result->close();
    } else {
        echo "Błąd w zapytaniu: " . $mysqli->error;
    }

    
    $mysqli->close();
    ?>
    <a href="superstrona.html"><button class="blad">Powrót na stronę główną</button></a>
</body>

</html>
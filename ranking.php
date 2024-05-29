<!DOCTYPE html>
<html lang="pl">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="test.css">
    <link rel="icon" href="top-three.png" type="image/jpeg">
    <title>Ranking</title>

</head>

<body>
    <div>

        <div class="r">

            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularz";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT `nazwa`, `przyzgwazdki`, ROUND(przyzgwazdki / liczbaopini, 1) as srednia FROM potrawy  order by srednia DESC";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Nazwa</th><th>Przyznane Gwiazdki</th><th>Średnia Ocen</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["nazwa"] . "</td><td>" . $row["przyzgwazdki"] . "</td><td>" . $row["srednia"] . "</td></tr>";
    }
    
    echo "</table>";
} else {
    echo "Brak wyników";
}

$conn->close();
?>



        </div>

        <div class="re">
            <h1> Ranking dań</h1>



            <a href="superstrona.html"><button>Powrót na stronę główną</button></a>

        </div>

    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="menu.png" type="image/jpeg">
    <title>Przystawki i Zupy</title>
</head>

<body>
    <h1>Przystawki i Zupy</h1>
    <a href="superstrona.html"><button class="blad">Powrót na stronę główną</button></a>

    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formularz";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT nazwa,przyzgwazdki  FROM potrawy where kategoria like'piz'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo  "<h3>"  .$row["nazwa"]. "" . "</h3>" ;
        echo"<li>  " ."Przyznane gwiazki : ".$row["przyzgwazdki"].""."</li>";
   
     }
} else {
    echo "0 results";
}

$conn->close();
?>

</body>

</html>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="menu.png" type="image/jpeg">
    <title>desery</title>
</head>

<body>
    <h1>Desery</h1>
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

$sql = "SELECT nazwa,przyzgwazdki FROM potrawy where kategoria like'Deser'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        echo  "<h3>" .$row["nazwa"]. "" . "</h3>" ;
        echo"<li>" ."Przyznane gwiazki : ".$row["przyzgwazdki"].""."</li>";
        
    }
} else {
    echo "0 results";
}
$sql2= "UPDATE potrawy  SET przyzgwazdki = przyzgwazdki + 1 WHERE nazwa=''";
$result2=$conn->query($sql2);

$conn->close();
?>

</body>

</html>
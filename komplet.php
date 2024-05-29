<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="menu.png" type="image/jpeg">
    <title>Przepisy </title>
</head>

<body>
    <h1>Przepisy</h1>

    <a href="superstrona.html"><button class="blad">Powrót na stronę główną</button></a>
    <br>


    <form method="POST" action="">
        <label for="search">Wyszukaj przepis po składnikach :</label>
        <br>
        <input type="text" id="search" name="search">
        <button type="submit" class="blad">Szukaj</button>
    </form>
    <br>
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
        $search = $_POST['search']; 
 
        
        $sql = "SELECT danie.danie, skladniki.skladniki, przepis.tresc
                FROM danie
                INNER JOIN skladniki ON danie.Id=skladniki.Id
                INNER JOIN przepis ON danie.Id=przepis.Id
                WHERE skladniki.skladniki LIKE '%$search%'";
 
        $result = $conn->query($sql);
 
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Danie</th><th>Składniki</th><th>Przepis</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["danie"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["skladniki"]) . "</td>";
 
                $przepis_z_br = nl2br(htmlspecialchars($row["tresc"]));
                echo "<td>" . $przepis_z_br . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Brak wyników dla wyszukiwania: $search";
        }
    } else {
       
 
        
        $sql = "SELECT danie.danie, skladniki.skladniki, przepis.tresc
                FROM danie
                INNER JOIN skladniki ON danie.Id=skladniki.Id
                INNER JOIN przepis ON danie.Id=przepis.Id";
 
        $result = $conn->query($sql);
 
        if ($result->num_rows > 0) {
            
            echo "<table border='1'>";
            echo "<tr><th>Danie</th><th>Składniki</th><th>Przepis</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . ($row["danie"]) . "</td>";
                echo "<td>" . ($row["skladniki"]) . "</td>";
 
                $przepis_z_br = (($row["tresc"]));
                echo "<td>" . $przepis_z_br . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Brak danych do wyświetlenia";
        }
    }
 
    $conn->close();
    ?>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="star.png" type="image/jpeg">
    <title>Przyznaj gwiazdkę</title>
</head>

<body>
    <h1>Przyznaj gwiazdkę</h1>
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

    <form action="" method="post">
        <label for="nazwa">Wybierz potrawę:</label>
        <select name="nazwa" id="nazwa">
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
        <button type="submit">Przyznaj gwiazdkę</button>
    </form>
    <a href="superstrona.html"><button>Powrót na stronę główną</button></a>
</body>

</html>
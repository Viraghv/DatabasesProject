<?php
    include "../egyeb/menu.php";
    include "../adatkezeles/adatbazis.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Műfajok</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<h1>Műfajok</h1>

<form method="POST" action="../adatkezeles/felvitel/mufajfelvitel.php" accept-charset="UTF-8">
    <fieldset>
        <legend>Új műfaj felvitele</legend>
        <label class="genreformlabel">Műfaj: <input class="genreforminput" type="text" name="mufajnev" required/></label><br>
        <input class="genreforminput" type="submit" value="Küldés"/>
    </fieldset>
</form>

<h2>Műfajok listája</h2>
<?php
    echo "<table>";
    echo "<tr><th>Műfaj</th><th></th></tr>";
    $mufajok = mufajok_lista();
    if($mufajok != false){
        while ($mufaj = mysqli_fetch_assoc($mufajok)) {
            echo "<tr>";
            echo "<td>" . $mufaj["mufajnev"] . "</td>";
            echo "<td>";
                echo "<form action='/imdb/adatkezeles/torles/mufajtorles.php' method='POST'>";
                    echo "<input type='hidden' name='id' value='". $mufaj["id"] ."'>";
                    echo "<input type='submit' value='Törlés'>";
                echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "Nem sikerült az adatbázishoz csatlakozni";
    }

    echo "</table>";
?>
</div>
</body>
</html>
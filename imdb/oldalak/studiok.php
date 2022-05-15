<?php
    include "../egyeb/menu.php";
    include "../adatkezeles/adatbazis.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stúdiók</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<h1>Stúdiók</h1>

<form method="POST" action="../adatkezeles/felvitel/studiofelvitel.php" accept-charset="UTF-8">
    <fieldset>
        <legend>Új stúdió felvitele</legend>
        <label class="studioformlabel">*Név: <input class="studioforminput" type="text" name="nev" required/></label><br>
        <label class="studioformlabel">Tulajdonos: <input class="studioforminput" type="text" name="tulajdonos"/></label><br>
        <label class="studioformlabel">Alapítás éve: <input class="studioforminput" type="number" name="alapitas_eve"/></label><br>
        <p>*Kötelező mezők</p>
        <input class="studioforminput" type="submit" value="Küldés"/>
    </fieldset>
</form>

<h2>Stúdiók listája</h2>
<?php
echo "<table>";
echo "<tr>";
echo "<th>Név</th>";
echo "<th>Tulajdonos</th>";
echo "<th>Alapítás éve</th>";
echo "<th colspan='2'></th>";
echo "</tr>";

$studiok = studiok_lista();
if($studiok != false) {
    while ($studio = mysqli_fetch_assoc($studiok)) {
        echo "<tr>";
            echo "<form action='szerkesztes/studioszerkesztes.php' method='POST'>";
                echo "<td>" . $studio["nev"] . "</td>";
                echo "<td>" . $studio["tulajdonos"] . "</td>";
                echo "<td>";
                if($studio["alapitas_eve"] == 0){
                    echo "";
                } else {
                    echo $studio["alapitas_eve"];
                }
                echo "</td>";
                echo "<td><input type='submit' value='Szerkesztés'></td>";
                echo "<input type='hidden' name='nev' value='".$studio["nev"]."'>";
            echo "</form>";
            echo "<td>";
                echo "<form action='/imdb/adatkezeles/torles/studiotorles.php' method='POST'>";
                    echo "<input type='hidden' name='nev' value='". $studio["nev"] ."'>";
                    echo "<input type='submit' value='Törlés'>";
                echo "</form>";
            echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nem sikerült az adatbázishoz csatlakozni";
}
mysqli_free_result($studiok);
?>
</div>
</body>
</html>
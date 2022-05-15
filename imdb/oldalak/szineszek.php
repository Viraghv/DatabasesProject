<?php
    include "../egyeb/menu.php";
    include "../adatkezeles/adatbazis.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Színészek</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<h1>Színészek</h1>

<form method="POST" action="../adatkezeles/felvitel/szineszfelvitel.php" accept-charset="UTF-8">
    <fieldset>
        <legend>Új színész felvitele</legend>
        <label class="actorformlabel">*Név: <input class="actorforminput" type="text" name="nev" required/></label><br>
        <label class="actorformlabel">Születési dátum: <input class="actorforminput" type="date" name="szuletesi_datum"/></label><br>
        <label class="actorformlabel">Származás: <input class="actorforminput" type="text" name="szarmazas"/></label><br>

        Nem:
        <label class="actorformlabel" for="op1">Férfi:</label>
        <input class="actorforminput" type="radio" id="op1" name="nem" value=1 checked/>
        <label class="actorformlabel" for="op2">Nő:</label>
        <input class="actorforminput" type="radio" id="op2" name="nem" value=0/>
        <label class="actorformlabel" for="op3">Egyéb:</label>
        <input class="actorforminput" type="radio" id="op3" name="nem" value=-1 /> <br/>
        <p>*Kötelező mezők</p>
        <input class="actorforminput" type="submit" value="Küldés"/>
    </fieldset>
</form>

<h2>Színészek listája</h2>
<?php
    echo "<table>";
    echo "<tr>";
    echo "<th>Név</th>";
    echo "<th>Születési dátum</th>";
    echo "<th>Származás</th>";
    echo "<th>Nem</th>";
    echo "<th colspan='2'></th>";
    echo "</tr>";

    $szineszek = szineszek_lista();
    if($szineszek != false) {
        while ($szinesz = mysqli_fetch_assoc($szineszek)) {
            echo "<tr>";
                echo "<form action='szerkesztes/szineszszerkesztes.php' method='POST'>";
                    echo "<td>" . $szinesz["nev"] . "</td>";
                    if($szinesz["szuletesi_datum"] == '0000-00-00'){
                        echo "<td></td>";
                    } else {
                        echo "<td>" . $szinesz["szuletesi_datum"] . "</td>";
                    }
                    echo "<td>" . $szinesz["szarmazas"] . "</td>";
                    echo "<td>";
                    if ($szinesz["nem"] == 1) {
                        echo "Férfi";
                    } else if ($szinesz["nem"] == 0) {
                        echo "Nő";
                    } else {
                        echo "Egyéb";
                    }
                    echo "</td>";
                echo "<td><input type='submit' value='Szerkesztés'></td>";
                echo "<input type='hidden' name='id' value='".$szinesz["id"]."'>";
                echo "</form>";
                echo "<td>";
                    echo "<form action='/imdb/adatkezeles/torles/szinesztorles.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='". $szinesz["id"] ."'>";
                        echo "<input type='submit' value='Törlés'>";
                    echo "</form>";
                echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nem sikerült az adatbázishoz csatlakozni";
    }
    mysqli_free_result($szineszek);
?>
</div>
</body>
</html>
<?php
    include "../egyeb/menu.php";
    include "../adatkezeles/adatbazis.php"
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Filmek</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<h1>Filmek</h1>
<form method="POST" action="../adatkezeles/felvitel/filmfelvitel.php" accept-charset="UTF-8">
    <fieldset>
        <legend>Új film felvitele</legend>
        <label class="filmformlabel">*Cím: <input class="filmforminput" type="text" name="cim" required/></label><br>
        <label class="filmformlabel">Rendező: <input class="filmforminput" type="text" name="rendezo"/></label><br>
        <label class="filmformlabel">Megjelenés éve: <input class="filmforminput" type="number" name="megjelenes_eve"/></label><br>
        <label class="filmformlabel">*Stúdió:
        <select name="studio_nev" required>
            <option value="">Válassz stúdiót!</option>
            <?php
                $studiok = studionevek_lista();
                if(mysqli_num_rows($studiok) > 0){
                    while($studio = mysqli_fetch_assoc($studiok)){
                        echo "<option value='".$studio["nev"]."'>".$studio["nev"]."</option>";
                    }
                } else {
                    echo "<option value=''>Nincs választható stúdió</option>";
                }
                mysqli_free_result($studiok);
            ?>
        </select></label><br>
        <p>*Kötelező mezők</p>
        <input class="filmforminput" type="submit" value="Küldés"/>
    </fieldset>
</form>
<h2>Filmek listája</h2>
<?php
        echo "<table>";
        echo "<tr>";
            echo "<th>Cím</th>";
            echo "<th>Rendező</th>";
            echo "<th>Megjelenés éve</th>";
            echo "<th>Stúdió</th>";
            echo "<th>Műfaj</th>";
            echo "<th colspan='3'></th>";
        echo "</tr>";

        $filmek = filmek_lista();
        while ($film = mysqli_fetch_assoc($filmek)) {
            $mufajok = film_mufaj_lista($film["id"]);

            echo "<tr>";
                echo "<td>" . $film["cim"] . "</td>";
                echo "<td>" . $film["rendezo"] . "</td>";
                echo "<td>";
                if($film["megjelenes_eve"] == 0){
                    echo "";
                } else {
                    echo $film["megjelenes_eve"];
                }
                echo "</td>";
                echo "<td>" . $film["studio_nev"] . "</td>";
                echo "<td>";
                $elso = true;
                while ($mufaj = mysqli_fetch_assoc($mufajok)){
                    if ($elso){
                        echo $mufaj["mufajnev"];
                        $elso = false;
                    } else {
                        echo ", " . $mufaj["mufajnev"];
                    }
                }
                echo "</td>";
                echo "<form action='/imdb/oldalak/egyeb/filmreszletek.php' method='POST'>";
                    echo "<td><input type='submit' value='Részletek'></td>";
                    echo "<input type='hidden' name='filmid' value='". $film["id"] ."'>";
                echo "</form>";
                echo "<form action='szerkesztes/filmszerkesztes.php' method='POST'>";
                    echo "<td><input type='submit' value='Szerkesztés'></td>";
                    echo "<input type='hidden' name='filmid' value='".$film["id"]."'>";
                echo "</form>";
                echo "<td>";
                    echo "<form action='/imdb/adatkezeles/torles/filmtorles.php' method='POST'>";
                        echo "<input type='hidden' name='id' value='". $film["id"] ."'>";
                        echo "<input type='submit' value='Törlés'>";
                    echo "</form>";
                echo "</td>";
            echo "</tr>";

        }
        echo "</table>";

    mysqli_free_result($filmek);
?>
</div>
</body>
</html>
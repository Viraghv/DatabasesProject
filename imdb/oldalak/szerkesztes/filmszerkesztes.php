<?php
    session_start();

    include "../../egyeb/menu.php";
    include "../../adatkezeles/adatbazis.php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Film szerkesztése</title>
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<?php
    if(!isset($_POST["filmid"]) || empty($_POST["filmid"])){
        $_POST["filmid"] = $_SESSION["filmid"];
    }

    $filmid = $_POST["filmid"];
    $filmadat = filmadat_leker($filmid);
?>
<form method="POST" action="../../adatkezeles/modositas/filmmodositas.php" accept-charset="UTF-8">
    <fieldset>
        <legend>Film szerkesztése</legend>
        <label class="filmformlabel">*Cím:
            <?php
                echo "<input class='filmforminput' type='text' name='cim' value='". $filmadat["cim"] ."' required/>"
            ?>
        </label><br>
        <label class="filmformlabel">Rendező:
            <?php
                echo "<input class='filmforminput' type='text' name='rendezo' value='". $filmadat["rendezo"] ."'/>"
            ?>
        </label><br>
        <label class="filmformlabel">Megjelenés éve:
            <?php
                echo "<input class='filmforminput' type='number' name='megjelenes_eve' value='". $filmadat["megjelenes_eve"] ."'/>"
            ?>
        </label><br>
        <label class="filmformlabel">*Stúdió:
            <select name="studio_nev" required>
                <?php
                $studiok = studionevek_lista();
                if(mysqli_num_rows($studiok) > 0){
                    while($studio = mysqli_fetch_assoc($studiok)){
                        if($filmadat["studio_nev"] == $studio["nev"]) {
                            echo "<option value='" . $studio["nev"] . "' selected>" . $studio["nev"] . "</option>";
                        } else {
                            echo "<option value='" . $studio["nev"] . "'>" . $studio["nev"] . "</option>";
                        }
                    }
                } else {
                    echo "<option value=''>Nincs választható stúdió</option>";
                }
                mysqli_free_result($studiok);
                ?>
            </select></label><br>
        <?php
            echo "<input type='hidden' name='id' value='". $filmid ."'>";
        ?>
        <p>*Kötelező mezők</p>
        <input class="filmforminput" type="submit" value="Módosítás"/>
    </fieldset>
</form>
<h2>Műfaj hozzáadása</h2>
<form method="post" action="/imdb/adatkezeles/felvitel/filmmufajfelvitel.php">
    <label class="filmformlabel">Műfaj:
        <select id="mufaj_hozzaad" name="mufajid">
            <?php
                $mufajnevek = mufajok_lista();
                if(mysqli_num_rows($mufajnevek) > 0){
                    while($mufajnev = mysqli_fetch_assoc($mufajnevek)){
                        echo "<option value='". $mufajnev["id"] ."'>" . $mufajnev["mufajnev"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nincs választható műfaj</option>";
                }
            mysqli_free_result($mufajnevek);
            ?>
        </select>
    </label><br>
    <?php
        echo "<input type='hidden' name='filmid' value='". $filmid ."'>";
    ?>
    <input class="filmforminput" type="submit" value="Hozzáadás"/>
</form>
<h2>Műfaj törlése</h2>
<?php
    $mufajok = film_mufaj_lista($filmid);
?>
<table>
    <tr>
        <th>Műfajok</th>
        <th></th>
    </tr>
    <?php
        while ($mufaj = mysqli_fetch_assoc($mufajok)){
            echo "<form method='post' action='/imdb/adatkezeles/torles/filmmufajtorles.php'>";
            echo "<tr>";
            echo "<td>". $mufaj["mufajnev"] ."</td>";
            echo "<td><input type='submit' value='Törlés'> </td>";
            echo "<input type='hidden' name='filmid' value='". $filmid ."'>";
            echo "<input type='hidden' name='mufajid' value='". $mufaj['id'] ."'>";
            echo "</tr>";
            echo "</form>";
        }
    ?>
</table>
<hr/>
<h2>Szereplő hozzáadása</h2>
<form method="post" action="/imdb/adatkezeles/felvitel/szereplofelvitel.php">
    <label class="szereploformlabel">*Színész:
        <select id="szereplo_hozzaad" name="szineszid" required>
            <?php
                $szineszek = szineszek_lista();
                if(mysqli_num_rows($szineszek) > 0){
                    while($szinesz = mysqli_fetch_assoc($szineszek)){
                        echo "<option value='".$szinesz["id"]."'>".$szinesz["nev"]."</option>";
                    }
                } else {
                    echo "<option value=''>Nincs választható színész</option>";
                }
                mysqli_free_result($szineszek);
            ?>
        </select>
    </label><br>
    <label class="szereploformlabel">*Szerep:
        <input type="text" class="szereploforminput" name="szerep" required/>
    </label><br>
    <?php
        echo "<input type='hidden' name='filmid' value='". $filmid ."'>";
    ?>
    <p>*Kötelező mezők</p>
    <input class="filmforminput" type="submit" value="Hozzáadás"/>
</form>

<h2>Szereplő törlése</h2>
<?php
    $szereplok = film_szereplok_lista($filmid);
?>
<table>
    <tr>
        <th>Színész</th>
        <th>Szerep</th>
        <th></th>
    </tr>
    <?php
        while ($szereplo = mysqli_fetch_assoc($szereplok)){
            echo "<form method='post' action='/imdb/adatkezeles/torles/szereplotorles.php'>";
            echo "<tr>";
            echo "<td>". $szereplo["nev"] ."</td>";
            echo "<td>". $szereplo["szerep"] ."</td>";
            echo "<input type='hidden' name='filmid' value='". $szereplo["film_id"] ."'>";
            echo "<input type='hidden' name='szineszid' value='". $szereplo["szinesz_id"] ."'>";
            echo "<td><input type='submit' value='Törlés'></td>";
            echo "</tr>";
            echo "</form>";
        }
    ?>
</table>
</div>
</body>
</html>
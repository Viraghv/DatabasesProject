<?php
    include "../../egyeb/menu.php";
    include "../../adatkezeles/adatbazis.php"
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Stúdió szerkesztése</title>
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<?php
    $studionev = $_POST["nev"];
    $studioadat = studioadat_leker($studionev);
?>
<form method="POST" action="../../adatkezeles/modositas/studiomodositas.php" accept-charset="UTF-8">
    <fieldset>
        <legend>Stúdió szerkesztése</legend>
        <label class="studioformlabel">*Név:
            <?php
                echo "<input class='studioforminput' type='text' name='nev' value='". $studioadat["nev"] ."' required/>"
            ?>
        </label><br>
        <label class="studioformlabel">Tulajdonos:
            <?php
                echo "<input class='studioforminput' type='text' name='tulajdonos' value='". $studioadat["tulajdonos"] ."'/>"
            ?>
        </label><br>
        <label class="studioformlabel">Alapítás éve:
            <?php
                echo "<input class='studioforminput' type='number' name='alapitas_eve' value='". $studioadat["alapitas_eve"] ."'/>"
            ?>
        </label><br>
        <?php
            echo "<input type='hidden' name='idnev' value='". $studionev ."'>";
        ?>
        <p>*Kötelező mezők</p>
        <input class="studioforminput" type="submit" value="Módosítás"/>
    </fieldset>
</form>
</div>
</body>
</html>
<?php
    include "../../egyeb/menu.php";
    include "../../adatkezeles/adatbazis.php"
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Színész szerkesztése</title>
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<?php
    $szineszid = $_POST["id"];
    $szineszadat = szineszadat_leker($szineszid);
?>
<form method="POST" action="../../adatkezeles/modositas/szineszmodositas.php" accept-charset="UTF-8">
    <fieldset>
        <legend>Színész szerkesztése</legend>
        <label class="actorformlabel">*Név:
            <?php
                echo "<input class='actorforminput' type='text' name='nev' value='". $szineszadat["nev"] ."' required/>"
            ?>
        </label><br>
        <label class="actorformlabel">Születési dátum:
            <?php
                echo "<input class='actorforminput' type='date' name='szuletesi_datum' value='". $szineszadat["szuletesi_datum"] ."'/>"
            ?>
        </label><br>
        <label class="actorformlabel">Származás:
            <?php
                echo "<input class='actorforminput' type='textr' name='szarmazas' value='". $szineszadat["szarmazas"] ."'/>"
            ?>
        </label><br>
        Nem:
        <label class="actorformlabel" for="op1">Férfi:</label>
        <?php
            if($szineszadat["nem"] == 1){
                echo "<input class='actorforminput' type='radio' id='op1' name='nem' value=1 checked/>";
            } else {
                echo "<input class='actorforminput' type='radio' id='op1' name='nem' value=1 />";
            }
        ?>
        <label class="actorformlabel" for="op2">Nő:</label>
        <?php
            if($szineszadat["nem"] == 0){
                echo " <input class='actorforminput' type='radio' id='op2' name='nem' value=0 checked/>";
            } else {
                echo "<input class='actorforminput' type='radio' id='op2' name='nem' value=0/>";
            }
        ?>
        <label class="actorformlabel" for="op3">Egyéb:</label>
        <?php
            if($szineszadat["nem"] == -1){
                echo "<input class='actorforminput' type='radio' id='op3' name='nem' value=-1 checked /> <br/>";
            } else {
                echo "<input class='actorforminput' type='radio' id='op3' name='nem' value=-1 /> <br/>";
            }
        ?>
        <?php
            echo "<input type='hidden' name='id' value='". $szineszid ."'>";
        ?>
        <p>*Kötelező mezők</p>
        <input class="actorforminput" type="submit" value="Módosítás"/>
    </fieldset>
</form>
</div>
</body>
</html>
<?php
    include "../../egyeb/menu.php";
    include "../../adatkezeles/adatbazis.php"
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Film részletei</title>
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<h1>Film adatai</h1>
<?php
    $filmid = $_POST["filmid"];
    $filmadat = filmadat_leker($filmid);
    $mufajok = film_mufaj_lista($filmid);
?>

<table>
    <tr>
        <th>Cím:</th>
        <?php
            echo "<td>". $filmadat["cim"] ."</td>";
        ?>
    </tr>
    <tr>
        <th>Rendező:</th>
        <?php
            echo "<td>". $filmadat["rendezo"] ."</td>";
        ?>
    </tr>
    <tr>
        <th>Megjelenés éve:</th>
        <?php
            echo "<td>". $filmadat["megjelenes_eve"] ."</td>";
        ?>
    </tr>
    <tr>
        <th>Stúdió:</th>
        <?php
            echo "<td>". $filmadat["studio_nev"] ."</td>";
        ?>
    </tr><tr>
        <th>Műfaj:</th>
        <td>
            <?php
                $elso = true;
                while ($mufaj = mysqli_fetch_assoc($mufajok)){
                     if($elso){
                         echo $mufaj["mufajnev"];
                         $elso = false;
                     } else {
                         echo ", ".$mufaj["mufajnev"];
                     }
                 }
            ?>
        </td>
    </tr>
</table>

<h2>Szereplők</h2>
<?php
    $szereplok = film_szereplok_lista($filmid);
?>

<table>
    <tr>
        <th>Színész</th>
        <th>Szerep</th>
    </tr>
    <?php
        while ($szereplo = mysqli_fetch_assoc($szereplok)){
            echo "<tr>";
                echo "<td>". $szereplo["nev"] ."</td>";
                echo "<td>". $szereplo["szerep"] ."</td>";
            echo "</tr>";
        }
    ?>
</table>
</div>
</body>
</html>
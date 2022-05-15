<?php
include "../egyeb/menu.php";
include "../adatkezeles/adatbazis.php";
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Egyéb adatok</title>
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php
    menu();
?>
<div class="tartalom">
<h1>Színészek filmjei</h1>
<form method="post" action="egyeb_adatok.php">
    <label>*Színész: <input class="szineszfilminput" type="text" name="nev" required></label>
    <label>Évtől: <input class="szineszfilminput" type="number" name="evtol" ></label>
    <label>Évig: <input class="szineszfilminput" type="number" name="evig"></label>
    <input type="submit" value="Keresés">
</form>
<br/>
<?php
if(isset($_POST["nev"]) && !empty($_POST["nev"])){
    echo "<table>
        <tr>
            <th>Színész</th>
            <th>Film</th>
            <th>Év</th>
            <th>Szerep</th>
        </tr>";

    $nev = htmlspecialchars($_POST["nev"]);
    if(isset($_POST["evtol"]) && !empty($_POST["evtol"])){
        $evtol = $_POST["evtol"];
    } else {
        $evtol = 0;
    }
    if(isset($_POST["evig"]) && !empty($_POST["evig"])){
        $evig = $_POST["evig"];
    } else {
        $evig = PHP_INT_MAX;
    }

    $sorok = szineszek_filmjei($nev, $evtol, $evig);
    while($sor = mysqli_fetch_assoc($sorok)){
        echo "<tr>";
        echo "<td>". $sor["nev"] ."</td>";
        echo "<td>". $sor["cim"] ."</td>";
        echo "<td>". $sor["megjelenes_eve"] ."</td>";
        echo "<td>". $sor["szerep"] ."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>

<h1>Műfajok gyakorisága</h1>
<table>
    <tr>
        <th>Műfaj</th>
        <th>Filmek száma</th>
        <th>Gyakoriság (%)</th>
    </tr>
    <?php
        $sorok = mufaj_gyakorisag_lekerd();
        while ($sor = mysqli_fetch_assoc($sorok)) {
            echo "<tr>";
                echo "<td>". $sor["mufajnev"] ."</td>";
                echo "<td>". $sor["db"] ."</td>";
                echo "<td>". $sor["gyakorisag"] ."</td>";
            echo "</tr>";
        }
    ?>
</table>

<h1>Színészek legelső és legfrissebb filmje</h1>
<table>
    <tr>
        <th>Színész</th>
        <th>Első film éve</th>
        <th>Legújabb film éve</th>
    </tr>
    <?php
        $sorok = szinesz_filmek();
        while($sor = mysqli_fetch_assoc($sorok) ){
            echo "<tr>";
                echo "<td>". $sor["nev"] ."</td>";
                echo "<td>". $sor["elso_ev"] ."</td>";
                echo "<td>". $sor["legujabb_ev"] ."</td>";
                echo "</tr>";
        }
    ?>
</table>
</div>
</body>
</html>

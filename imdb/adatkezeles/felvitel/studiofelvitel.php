<?php
include_once "../adatbazis.php";

$nev = $_POST["nev"];
$tulajdonos = $_POST["tulajdonos"];
$alapitas_eve = $_POST["alapitas_eve"];

if(isset($_POST["nev"]) && !empty($_POST["nev"])) {
    $nev_t = htmlspecialchars($nev);
    $tulajdonos_t = htmlspecialchars($tulajdonos);

    $sikeres = studiot_beszur($nev_t, $tulajdonos_t, $alapitas_eve);

    if(!$sikeres){
        die("Sikertelen rekordfelvitel");
    } else {
        header("Location: /imdb/oldalak/studiok.php");
    }
} else {
    error_log("A kötelező mezőket meg kell adni!");
    header("Location: /imdb/oldalak/studiok.php");
}

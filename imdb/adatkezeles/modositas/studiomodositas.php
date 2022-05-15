<?php
include_once "../adatbazis.php";

$idnev = $_POST["idnev"];
$nev = $_POST["nev"];
$tulajdonos = $_POST["tulajdonos"];
$alapitas_eve = $_POST["alapitas_eve"];


if(isset($_POST["nev"]) && !empty($_POST["nev"])){
    $idnev_t = htmlspecialchars($idnev);
    $nev_t = htmlspecialchars($nev);
    $tulajdonos_t = htmlspecialchars($tulajdonos);

    $sikeres = studiot_modosit($idnev, $nev_t, $tulajdonos_t, $alapitas_eve);

    if(!$sikeres){
        die("Sikertelen rekordmódosítás");
    } else {
        header("Location: /imdb/oldalak/studiok.php");
    }
} else {
    error_log("A kötelező mezőket meg kell adni!");
    header("Location: /imdb/oldalak/studiok.php");
}
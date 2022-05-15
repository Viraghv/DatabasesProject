<?php
include_once "../adatbazis.php";

$id = $_POST["id"];
$nev = $_POST["nev"];
$szuletesi_datum = $_POST["szuletesi_datum"];
$szarmazas = $_POST["szarmazas"];
$nem = $_POST["nem"];

if(isset($_POST["nev"]) && !empty($_POST["nev"])){
    $nev_t = htmlspecialchars($nev);
    $szarmazas_t = htmlspecialchars($szarmazas);

    $sikeres = szineszt_modosit($id, $nev_t, $szuletesi_datum, $szarmazas_t, $nem);

    if(!$sikeres){
        die("Sikertelen rekordmódosítás");
    } else {
        header("Location: /imdb/oldalak/szineszek.php");
    }
} else {
    error_log("A kötelező mezőket meg kell adni!");
    header("Location: /imdb/oldalak/szineszek.php");
}
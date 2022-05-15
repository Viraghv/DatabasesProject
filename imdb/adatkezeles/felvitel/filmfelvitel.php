<?php
include_once "../adatbazis.php";

$cim = $_POST["cim"];
$rendezo = $_POST["rendezo"];
$megjelenes_eve = $_POST["megjelenes_eve"];
$studio_nev = $_POST["studio_nev"];

if(isset($_POST["cim"]) && trim($_POST["cim"]) !== "" && isset($_POST["studio_nev"]) && !empty($_POST["cim"]) && !empty($_POST["studio_nev"])){
    $cim_t = htmlspecialchars($cim);
    $rendezo_t = htmlspecialchars($rendezo);

    $sikeres = filmet_beszur($cim_t, $rendezo_t, $megjelenes_eve, $studio_nev);

    if(!$sikeres){
        die("Sikertelen rekordfelvitel");
    } else {
        header("Location: /imdb/oldalak/filmek.php");
    }
} else {
    error_log("A kötelező mezőket meg kell adni!");
    header("Location: /imdb/oldalak/filmek.php");
}
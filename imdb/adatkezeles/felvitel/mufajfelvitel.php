<?php
include_once "../adatbazis.php";

$mufajnev = $_POST["mufajnev"];

if(isset($_POST["mufajnev"]) && !empty($_POST["mufajnev"])){
    $mufajnev_t = htmlspecialchars($mufajnev);

    $sikeres = mufajt_beszur($mufajnev_t);

    if(!$sikeres){
        die("Sikertelen rekordfelvitel");
    } else {
        header("Location: /imdb/oldalak/mufajok.php");
    }
} else {
    error_log("A kötelező mezőket meg kell adni!");
    header("Location: /imdb/oldalak/mufajok.php");
}
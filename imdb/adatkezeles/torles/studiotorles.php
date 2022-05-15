<?php
include_once "../adatbazis.php";

$nev = $_POST["nev"];

if(isset($nev) && !empty($nev)){
    $sikeres = studiot_torol($nev);

    if(!$sikeres){
        die("Sikertelen törlés");
    } else {
        header("Location: /imdb/oldalak/studiok.php");
    }
} else {
    error_log("Nincs beállítva valamelyik érték");
    header("Location: /imdb/oldalak/studiok.php");
}
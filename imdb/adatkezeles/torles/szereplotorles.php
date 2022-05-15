<?php
session_start();
include_once "../adatbazis.php";

$filmid = $_POST["filmid"];
$szineszid = $_POST["szineszid"];

$_SESSION["filmid"] = $filmid;

if(isset($filmid) && !empty($filmid) && isset($szineszid) && !empty($szineszid)){
    $sikeres = szereplot_torol($filmid, $szineszid);

    if(!$sikeres){
        die("Sikertelen törlés");
    } else {
        header("Location: /imdb/oldalak/szerkesztes/filmszerkesztes.php");
    }
} else {
    error_log("Nincs beállítva valamelyik érték");
    header("Location: /imdb/oldalak/szerkesztes/filmszerkesztes.php");
}
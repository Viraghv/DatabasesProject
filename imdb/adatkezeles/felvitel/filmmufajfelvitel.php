<?php
session_start();
include_once "../adatbazis.php";

$filmid = $_POST["filmid"];
$mufajid = $_POST["mufajid"];

$_SESSION["filmid"] = $filmid;

if(isset($filmid) && !empty($filmid) && isset($mufajid) && !empty($mufajid)){
    $sikeres = filmmufajt_beszur($filmid, $mufajid);

    if(!$sikeres){
        die("Sikertelen törlés");
    } else {
        header("Location: /imdb/oldalak/szerkesztes/filmszerkesztes.php");
    }
} else {
    error_log("Nincs beállítva valamelyik érték");
    header("Location: /imdb/oldalak/szerkesztes/filmszerkesztes.php");
}

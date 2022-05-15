<?php
session_start();
include_once "../adatbazis.php";

$filmid = $_POST["filmid"];
$szineszid = $_POST["szineszid"];
$szerep = $_POST["szerep"];

$_SESSION["filmid"] = $filmid;

if(isset($_POST["filmid"]) && !empty($_POST["filmid"]) && isset($_POST["szineszid"]) && !empty($_POST["szineszid"]) &&  isset($_POST["szerep"]) && !empty($_POST["szerep"]) ){
    $szerep_t = htmlspecialchars($szerep);

     $sikeres = szereplot_beszur($filmid, $szineszid, $szerep_t);

    if(!$sikeres){
        die("Sikertelen rekordfelvitel");
    } else {
        header("Location: /imdb/oldalak/szerkesztes/filmszerkesztes.php");
    }
} else {
    error_log("A kötelező mezőket meg kell adni!");
    header("Location: /imdb/oldalak/szerkesztes/filmszerkesztes.php");
}
<?php
include_once "../adatbazis.php";

$id = $_POST["id"];

if(isset($id) && !empty($id)){
    $sikeres = szineszt_torol($id);

    if(!$sikeres){
        die("Sikertelen törlés");
    } else {
        header("Location: /imdb/oldalak/szineszek.php");
    }
} else {
    error_log("Nincs beállítva valamelyik érték");
    header("Location: /imdb/oldalak/szineszek.php");
}
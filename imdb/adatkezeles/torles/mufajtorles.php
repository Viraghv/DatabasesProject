<?php
include_once "../adatbazis.php";

$id = $_POST["id"];

if(isset($id) && !empty($id)){
    $sikeres = mufajt_torol($id);

    if(!$sikeres){
        die("Sikertelen törlés");
    } else {
        header("Location: /imdb/oldalak/mufajok.php");
    }
} else {
    error_log("Nincs beállítva valamelyik érték");
    header("Location: /imdb/oldalak/mufajok.php");
}
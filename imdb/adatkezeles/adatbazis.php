<?php

function db_connect(){
    $conn = mysqli_connect('localhost', 'root', '') or die("Csatlakozási hiba");
    if(mysqli_select_db($conn, "imdb") == false){
        return null;
    }

    mysqli_query($conn, 'SET NAMES UTF-8');
    mysqli_query($conn, 'SET character_set_results=utf8');
    mysqli_set_charset($conn, 'utf8');

    return $conn;
}

//================ Filmek ================

function filmek_lista(){
    if(!($conn = db_connect())){
        return false;
    }
    $sql = "SELECT id, cim, rendezo, megjelenes_eve, studio_nev FROM film ORDER BY cim";
    $res = mysqli_query($conn,$sql) or die ("Hibás utasítás");

    return $res;
}

function studionevek_lista(){
    if(!($conn = db_connect())){
        return false;
    }
    $sql = "SELECT nev FROM filmstudio";
    $res = mysqli_query($conn,$sql) or die ("Hibás utasítás");

    return $res;
}

function filmet_beszur($cim, $rendezo, $megjelenes_eve, $studio){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO film(cim, rendezo, megjelenes_eve, studio_nev) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssds", $cim, $rendezo, $megjelenes_eve, $studio);

    $success = mysqli_stmt_execute($stmt);
    if(!$success){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function filmet_modosit($id, $cim, $rendezo, $megjelenes_eve, $studio_nev){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "UPDATE film SET cim = ?, rendezo = ?, megjelenes_eve = ?, studio_nev = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "ssdsd", $cim, $rendezo, $megjelenes_eve, $studio_nev, $id);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function filmadat_leker($filmid){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "SELECT cim, rendezo, megjelenes_eve, studio_nev FROM film WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "d", $filmid);

    $result = mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_result($stmt, $cim, $rendezo, $megjelenes_eve, $studio_nev);

    $reader = array();
    mysqli_stmt_fetch($stmt);
    $reader["cim"] = $cim;
    $reader["rendezo"] = $rendezo;
    $reader["megjelenes_eve"] = $megjelenes_eve;
    $reader["studio_nev"] = $studio_nev;

    mysqli_close($conn);
    return $reader;
}

function filmet_torol($filmid){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM film WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "d", $filmid);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}
//================ Színészek ================

function szineszek_lista(){
    if(!($conn = db_connect())){
        return false;
    }
    $sql = "SELECT id, nev, szuletesi_datum, szarmazas, nem FROM szinesz ORDER BY nev";
    $res = mysqli_query($conn,$sql) or die ("Hibás utasítás");

    return $res;
}

function szineszt_beszur($nev, $szuletesi_datum, $szarmazas, $nem){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO szinesz(nev, szuletesi_datum, szarmazas, nem) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssd", $nev, $szuletesi_datum, $szarmazas, $nem);

    $success = mysqli_stmt_execute($stmt);
    if(!$success){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function szineszadat_leker($szineszid){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "SELECT nev, szuletesi_datum, szarmazas, nem FROM szinesz WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "d", $szineszid);

    $result = mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_result($stmt, $nev, $szuletesi_datum, $szarmazas, $nem);

    $reader = array();
    mysqli_stmt_fetch($stmt);
    $reader["nev"] = $nev;
    $reader["szuletesi_datum"] = $szuletesi_datum;
    $reader["szarmazas"] = $szarmazas;
    $reader["nem"] = $nem;

    mysqli_close($conn);
    return $reader;
}

function szineszt_modosit($id, $nev_t, $szuletesi_datum, $szarmazas_t, $nem){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "UPDATE szinesz SET nev = ?, szuletesi_datum = ?, szarmazas = ?, nem = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "sssdd", $nev_t, $szuletesi_datum, $szarmazas_t, $nem, $id);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function szineszt_torol($szineszid){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM szinesz WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "d", $szineszid);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function film_szereplok_lista($filmid) {
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn,"SELECT  nev, szerep, szinesz_id, film_id FROM film, szinesz, szerepel 
                                        WHERE film.id = ? AND film.id = szerepel.film_id AND szerepel.szinesz_id = szinesz.id");
    mysqli_stmt_bind_param($stmt, "d", $filmid);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }

    $res = mysqli_stmt_get_result($stmt);
    mysqli_close($conn);

    return $res;
}

function szereplot_beszur($filmid, $szineszid, $szerep){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO szerepel(szinesz_id, film_id, szerep) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "dds", $szineszid, $filmid, $szerep);

    $success = mysqli_stmt_execute($stmt);
    if(!$success){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function szereplot_torol($filmid, $szineszid) {
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM szerepel WHERE szinesz_id = ? AND film_id = ?");
    mysqli_stmt_bind_param($stmt, "dd", $szineszid, $filmid);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

//================ Stúdiók ================

function studiok_lista(){
    if(!($conn = db_connect())){
        return false;
    }
    $sql = "SELECT nev, tulajdonos, alapitas_eve FROM filmstudio ORDER BY nev";
    $res = mysqli_query($conn,$sql) or die ("Hibás utasítás");

    return $res;
}

function studioadat_leker($studionev){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "SELECT nev, tulajdonos, alapitas_eve FROM filmstudio WHERE nev = ?");
    mysqli_stmt_bind_param($stmt, "s", $studionev);

    $result = mysqli_stmt_execute($stmt);
    if($result == false){
        die(mysqli_error($conn));
    }

    mysqli_stmt_bind_result($stmt, $nev, $tulajdonos, $alapitas_eve);

    $reader = array();
    mysqli_stmt_fetch($stmt);
    $reader["nev"] = $nev;
    $reader["tulajdonos"] = $tulajdonos;
    $reader["alapitas_eve"] = $alapitas_eve;

    mysqli_close($conn);
    return $reader;
}

function studiot_beszur($nev, $tulajdonos, $alapitas_eve){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO filmstudio(nev, tulajdonos, alapitas_eve) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssd", $nev, $tulajdonos, $alapitas_eve);

    $success = mysqli_stmt_execute($stmt);
    if(!$success){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function studiot_modosit($idnev, $nev, $tulajdonos, $alapitas_eve){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "UPDATE filmstudio SET nev = ?, tulajdonos = ?, alapitas_eve = ? WHERE nev = ?");
    mysqli_stmt_bind_param($stmt, "ssds", $nev, $tulajdonos, $alapitas_eve, $idnev);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function studiot_torol($nev){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM filmstudio WHERE nev = ?");
    mysqli_stmt_bind_param($stmt, "s", $nev);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

//================ Műfajok ================

function mufajok_lista(){
    if(!($conn = db_connect())){
        return false;
    }
    $sql = "SELECT id, mufajnev FROM mufaj ORDER BY mufajnev";
    $res = mysqli_query($conn,$sql) or die ("Hibás utasítás");

    return $res;
}

function film_mufaj_lista($filmid){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn,"SELECT mufaj.id, mufajnev FROM mufaj, mufaja, film 
                                        WHERE film.id = mufaja.film_id AND mufaja.mufaj_id = mufaj.id AND film.id = ? 
                                        ORDER BY mufajnev");
    mysqli_stmt_bind_param($stmt, "d", $filmid);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }

    $res = mysqli_stmt_get_result($stmt);
    mysqli_close($conn);

    return $res;
}

function mufajt_beszur($mufajnev){
    if(!($conn = db_connect())){
        return false;
    }

    $mufajok = mufajok_lista();
    $letezik = false;
    if($mufajok != false) {
        while ($mufaj = mysqli_fetch_assoc($mufajok)) {
            if (strcmp(implode("",$mufaj), $mufajnev) == 0) {
                $letezik = true;
                break;
            }
        }
    }
    mysqli_free_result($mufajok);

    if(!$letezik){
        $stmt = mysqli_prepare($conn, "INSERT INTO mufaj(mufajnev) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $mufajnev);

        $success = mysqli_stmt_execute($stmt);
        if(!$success){
            die(mysqli_error($conn));
        }
        mysqli_close($conn);
        return $success;
    }
    return true;
}

function filmmufajt_beszur($filmid, $mufajid){
    if(!($conn = db_connect())){
        return false;
    }
    $stmt = mysqli_prepare($conn, "INSERT INTO mufaja(film_id, mufaj_id) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "dd", $filmid, $mufajid);

    $success = mysqli_stmt_execute($stmt);
    if(!$success){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;

}

function mufajt_torol($mufajid){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn, "DELETE FROM mufaj WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "d", $mufajid);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

function filmmufajt_torol($filmid, $mufajid) {
    if(!($conn = db_connect())){
        return false;
    }
    $stmt = mysqli_prepare($conn, "DELETE FROM mufaja WHERE film_id = ? AND mufaj_id = ?");
    mysqli_stmt_bind_param($stmt, "dd", $filmid, $mufajid);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }
    mysqli_close($conn);
    return $success;
}

//================ Egyéb adatok ================

function mufaj_gyakorisag_lekerd(){
    if(!($conn = db_connect())){
        return false;
    }

    $sql = "SELECT mufajnev, COUNT(film_id) AS db, ROUND(COUNT(film_id)/(SELECT COUNT(*) FROM film)*100, 2) AS gyakorisag
            FROM mufaj LEFT JOIN mufaja ON mufaj.id = mufaja.mufaj_id GROUP BY mufaj.id ORDER BY db DESC";
    $res = mysqli_query($conn,$sql) or die ("Hibás utasítás");

    return $res;
}

function szinesz_filmek(){
    if(!($conn = db_connect())){
        return false;
    }

    $sql = "SELECT szinesz.nev, MIN(film.megjelenes_eve) AS elso_ev, MAX(film.megjelenes_eve) AS legujabb_ev 
            FROM film INNER JOIN szerepel ON film.id = szerepel.film_id INNER JOIN szinesz ON szinesz.id = szerepel.szinesz_id 
            GROUP BY szinesz.id ORDER BY szinesz.nev";
    $res = mysqli_query($conn,$sql) or die ("Hibás utasítás");

    return $res;
}

function szineszek_filmjei($nev, $evtol, $evig){
    if(!($conn = db_connect())){
        return false;
    }

    $stmt = mysqli_prepare($conn,"SELECT nev, cim, megjelenes_eve, szerep FROM film, szinesz, szerepel 
                                        WHERE film.id = szerepel.film_id AND szerepel.szinesz_id = szinesz.id 
                                        AND nev LIKE '%$nev%' AND megjelenes_eve >= ? AND megjelenes_eve <= ? ORDER BY nev, megjelenes_eve");
    mysqli_stmt_bind_param($stmt, "dd",  $evtol, $evig);

    $success = mysqli_stmt_execute($stmt);

    if($success == false){
        die(mysqli_error($conn));
    }

    $res = mysqli_stmt_get_result($stmt);
    mysqli_close($conn);

    return $res;
}
<?php
function menu() {
    echo "<nav>";
    echo "<ul id='menu'>";
    echo "<li class='menubar'><a class='menulink' href='/imdb/oldalak/filmek.php'>Filmek</a></li>";
    echo "<li class='menubar'><a class='menulink' href='/imdb/oldalak/szineszek.php'>Színészek</a></li>";
    echo "<li class='menubar'><a class='menulink' href='/imdb/oldalak/studiok.php'>Stúdiók</a></li>";
    echo "<li class='menubar'><a class='menulink' href='/imdb/oldalak/mufajok.php'>Műfajok</a></li>";
    echo "<li class='menubar'><a class='menulink' href='/imdb/oldalak/egyeb_adatok.php'>Egyéb adatok</a></li>";
    echo "<ul>";
    echo "</nav>";
}

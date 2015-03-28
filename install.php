<?php

$sql = file("shorter.sql");
$sqlite = new SQLite3('shorter.db');
$str = "";

foreach($sql as $ligne)
    $str += $ligne; // On met tout le texte du ficher sur une ligne

$tabstr = explode(";", $str); // on split la ligne à chaques ; (separant les requetes)

foreach ($tabstr as &$value) {
    $value += ";"; // On replace le ; puisqu'il à été enlevé avec expload
    $sqlite->query($value); // On execute les requetes contenue dans le fichier sql
}


?>
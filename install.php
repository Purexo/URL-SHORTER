<?php

$sqlite = new SQLite3('shorter.db');

$sql = "CREATE TABLE IF NOT EXISTS links (id INTEGER PRIMARY KEY, link TEXT)";

$sqlite->query($sql);

?>

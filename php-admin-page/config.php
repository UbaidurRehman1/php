<?php
/* Attempt to connect to MySQL database */
$link = pg_connect("host=localhost dbname=shop user=postgres password=password");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . "Error");
}


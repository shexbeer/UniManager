<?php
$hostname = "localhost";
$username = "unimanager";
$password = "manatizu56";
$database_name = "UniManager";

@mysql_connect($hostname, $username, $password) or die("Konnte nicht zur Mysql DB connecten");
@mysql_select_db($database_name) or die ("Konnte die Datenbank <b>$database_name</b> nicht auswaehlen (nicht vorhanden?)");

?>
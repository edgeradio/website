<?php

$user = "edge_edge";
$pass = "rAdio_993";
$db = "edge_podcasts";


// Connect to MYSQL database

 $link = mysql_connect('localhost', $user, $pass);


if ( ! $link )
	die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db($db, $link);

?>

<?php

$db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db('edge_music'); 

$query1 = "UPDATE music SET playcountweek='0'";
mysql_query($query1);



?>
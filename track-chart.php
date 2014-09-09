<?php

$db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db('edge_music'); 

$data = file_get_contents('http://edgeradio.org.au/BILBOARD.ASC');
$data = str_replace("_", " ", $data);
$data = str_replace("Playing", " - ", $data);
$data = ucwords(strtolower($data));

$data = explode("Song",$data,2);

$full = $data[0];
$full = str_replace(" (TASSIE)", "", $full);
$full = str_replace(" (Tassie)", "", $full);
$full = str_replace(" (tassie)", "", $full);
$full = str_replace(" [tassie]", "", $full);
$full = str_replace(" [TASSIE]", "", $full);
$full = str_replace(" [Tassie]", "", $full);

                                 

$datar = explode(" - ",$full);

$title = addslashes(ucwords($datar[0]));
$artist = addslashes(ucwords($datar[1]));

$title = trim($title);

$artist = trim($artist);

echo '<input value="'.$title.'">';
echo'<br>-<br>';
echo '<input value="'.$artist.'">';

$inforesult = mysql_query("SELECT * FROM music WHERE artist='$artist' AND title='$title'",$db) or die(mysql_error());
$rows = mysql_num_rows($inforesult);
echo $rows;
if($rows != 0){
$query1 = "UPDATE music SET playcount=playcount+1, playcountweek=playcountweek+1, playdate=NOW() WHERE artist='$artist' AND title='$title'";
mysql_query($query1);
}



?>
<?php


include'../inc/database.inc.php';
mysql_select_db("edge_programs",$db);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');



$presult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00') FROM program_special WHERE day_time='$d' AND start_time <= '$h' ORDER BY start_time DESC LIMIT 1");
$countp = mysql_num_rows($presult);


if($countp > 0) {
while ($infop = mysql_fetch_array($presult)) {

$titlecount = strlen($infop['title']);
if($infop['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $infop['sml_img']; }

$start = $infop['start'];
$finish = $infop['finish'];

 $xml_output .= "<show>"; 
    // Escaping illegal characters 
        $infop['title'] = str_replace("&", "&amp;", $infop['title']); 
        $infop['title'] = str_replace("<", "&lt;", $infop['title']); 
        $infop['title'] = str_replace(">", "&gt;", $infop['title']); 
        $infop['title'] = str_replace("\"", "&quot;", $infop['title']); 
         $infop['summary'] = str_replace("&", "&amp;", $infop['summary']); 
        $infop['summary'] = str_replace("<", "&lt;", $infop['summary']); 
        $infop['summary'] = str_replace(">", "&gt;", $infop['summary']); 
        $infop['summary'] = str_replace("\"", "&quot;", $infop['summary']); 
 $xml_output .= "\t<showinfo id=\"" . $infop['id'] . "\" title=\"" . stripslashes($infop['title']) . "\" summary=\"" . stripslashes($info['summary']) . "\" time=\"" . $infop['start'] . " - " . $infop['finish'] . "\" day=\"" . $info['day_time'] . "\" url=\"http://www.edgeradio.org.au/programs/".$infop['day_time']."/".str_replace(' ','-',$infop['seotitle'])."/\" image=\"" . $img . "\" />\n"; 
     $xml_output .= "</show>"; 
}

} else {

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00')  FROM program_info ORDER BY day_time ASC");
$count = mysql_num_rows($inforesult);
for($x = 0 ; $x < mysql_num_rows($inforesult) ; $x++){ 
$info = mysql_fetch_assoc($inforesult);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
    // Escaping illegal characters 
        $info['title'] = str_replace("&", "&amp;", $info['title']); 
        $info['title'] = str_replace("<", "&lt;", $info['title']); 
        $info['title'] = str_replace(">", "&gt;", $info['title']); 
        $info['title'] = str_replace("\"", "&quot;", $info['title']); 
 echo"".$info['day_time']." ".$info['start']."-".$info['finish'].": ".$info['title'].", "; 

}

}



?>


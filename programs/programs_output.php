<?php

header("Content-type: text/xml"); 

include'../inc/database.inc.php';
mysql_select_db("edge_programs",$db);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

$xml_output = "<?xml version=\"1.0\"?>\n"; 
$xml_output .= "<entries>\n"; 



$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00') FROM program_info ORDER BY day_time ASC") or die(mysql_error());
$count = mysql_num_rows($inforesult);
for($x = 0 ; $x < mysql_num_rows($inforesult) ; $x++){ 
$info = mysql_fetch_assoc($inforesult);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
 $xml_output .= "<show>"; 
    // Escaping illegal characters 
        $info['title'] = str_replace("&", "&amp;", $info['title']); 
        $info['title'] = str_replace("<", "&lt;", $info['title']); 
        $info['title'] = str_replace(">", "&gt;", $info['title']); 
        $info['title'] = str_replace("\"", "&quot;", $info['title']); 
         $info['summary'] = str_replace("&", "&amp;", $info['summary']); 
        $info['summary'] = str_replace("<", "&lt;", $info['summary']); 
        $info['summary'] = str_replace(">", "&gt;", $info['summary']); 
        $info['summary'] = str_replace("\"", "&quot;", $info['summary']); 
 $xml_output .= "\t<showinfo id=\"" . $info['id'] . "\" title=\"" . stripslashes($info['title']) . "\" summary=\"" . stripslashes($info['summary']) . "\" time=\"" . $info['start'] . " - " . $info['finish'] . "\" day=\"" . $info['day_time'] . "\" url=\"http://www.edgeradio.org.au/programs/".$info['day_time']."/".str_replace(' ','-',$info['seotitle'])."/\" image=\"" . $img . "\" />\n"; 
     $xml_output .= "</show>"; 

}

 
 $xml_output .= "</entries>"; 

echo $xml_output; 


?>


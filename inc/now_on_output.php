<?php

header("Content-type: text/xml"); 

include'database.inc.php';
mysql_select_db("edge_programs",$db);

putenv("TZ=Australia/Hobart");
$h = date('H:i:s');
$d = date('l');

$xml_output = "<?xml version=\"1.0\"?>\n"; 
$xml_output .= "<entries>\n"; 

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish, REPLACE(end_time, '00:00:00', '24:00:00')  FROM program_info WHERE day_time='$d' AND start_time <= '$h' ORDER BY start_time DESC LIMIT 1");
$count = mysql_num_rows($inforesult);
for($x = 0 ; $x < mysql_num_rows($inforesult) ; $x++){ 
    $info = mysql_fetch_assoc($inforesult); 
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }


 $xml_output .= "\t<nowon>\n"; 
        // Escaping illegal characters 
        $info['title'] = str_replace("&", "&", $info['title']); 
        $info['title'] = str_replace("<", "<", $info['title']); 
        $info['title'] = str_replace(">", "&gt;", $info['title']); 
        $info['title'] = str_replace("\"", "&quot;", $info['title']); 
         $xml_output .= "\t\t<nowinfo id=\"" . $info['id'] . "\" time=\"" . $info['start'] . " - " . $info['finish'] . "\" title=\"" . $info['title'] . "\" image=\"" . $img . "\" />\n"; 
    $xml_output .= "\t</nowon>\n"; 

}

if($count == 0) { 

 $xml_output .= "\t<nowon>\n"; 
 $xml_output .= "\t\t<nowinfo id=\"0\" time=\"All Night\" title=\"Edge Tunes\" image=\"http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg\" />\n"; 
    $xml_output .= "\t</nowon>\n"; 


 }



$curesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l%p') as start, DATE_FORMAT(end_time, '%l%p') as finish FROM program_info WHERE day_time='$d' AND start_time > '$h' ORDER BY start_time ASC LIMIT 0,1");
$coua = mysql_num_rows($curesult);
for($x = 0 ; $x < mysql_num_rows($curesult) ; $x++){ 
    $info = mysql_fetch_assoc($curesult); 
$titlecount = strlen($info['title']);
if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }


 $xml_output .= "\t<nexton>\n"; 
        // Escaping illegal characters 
        $info['title'] = str_replace("&", "&", $info['title']); 
        $info['title'] = str_replace("<", "<", $info['title']); 
        $info['title'] = str_replace(">", "&gt;", $info['title']); 
        $info['title'] = str_replace("\"", "&quot;", $info['title']); 
$xml_output .= "\t\t<nextinfo id=\"" . $info['id'] . "\" time=\"" . $info['start'] . " - " . $info['finish'] . "\" title=\"" . $info['title'] . "\" image=\"" . $img . "\" />\n"; 
    $xml_output .= "\t</nexton>\n"; 

}

if($coua == 0) { 

 $xml_output .= "\t<nexton>\n"; 
    $xml_output .= "\t\t<nextinfo id=\"0\" time=\"All Night\" title=\"Edge Tunes\" image=\"http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg\" />\n"; 
    $xml_output .= "\t</nexton>\n"; 


 }
 
 $xml_output .= "</entries>"; 

echo $xml_output; 


?>


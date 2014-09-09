<?php 
$db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_content",$db);

$namer = $_POST['name'];
$ad1 = $_POST['ad1'];
$ad2 = $_POST['ad2'];
$suburb = $_POST['suburb'];
$pcode = $_POST['pcode'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$age = $_POST['age'];

mysql_query("INSERT INTO sor_applications (name, address1, address2, suburb, postcode, phone, email, age, paid, date) VALUES('".$namer."', '".$ad1."', '".$ad2."', '".$suburb."', '".$pcode."', '".$phone."', '".$email."', '".$age."', 'false', NOW())") or die(mysql_error());  

$result = mysql_query("SELECT * FROM sor_applications WHERE name = '$namer'",$db);
  while ($myrow = mysql_fetch_array($result)) {

@header('Location: http://www.paypal.com/cgi-bin/webscr?cmd=_cart&upload=1&charset=utf-8&currency_code=AUD&business=42HRYDVKR526L&custom='.$myrow['id'].'&return=http://www.edgeradio.org.au/community/school-of-rock/register/finish.php&item_number_1=1&item_name_1=School of Rock Program&amount_1=150.00&quantity_1=1');

}


?>

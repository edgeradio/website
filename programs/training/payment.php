<?php 
$db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_content",$db);

$status = $_POST['status'];
$namer = $_POST['name'];
$ad1 = $_POST['ad1'];
$ad2 = $_POST['ad2'];
$suburb = $_POST['suburb'];
$pcode = $_POST['pcode'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$program = $_POST['program'];
if($status == '1') {
$price = '40.00';
$name = 'Current Presenter - '.$_POST['namer'].' ('.$_POST['program'].')';
} elseif($status == '2') {
$price = '180.00';
$name = 'New Presenter - '.$_POST['namer'].'';
} elseif($status == '3') {
$price = '150.00';
$name = 'Not Presenting A Show - '.$_POST['namer'].'';
}

mysql_query("INSERT INTO training_applications (name, address1, address2, suburb, postcode, phone, email, presenter_status, program, paid, date) VALUES('".$namer."', '".$ad1."', '".$ad2."', '".$suburb."', '".$pcode."', '".$phone."', '".$email."', '".$name."', '".$program."', '".$price."', NOW())") or die(mysql_error());  

$result = mysql_query("SELECT * FROM training_applications WHERE name = '$namer'",$db);
  while ($myrow = mysql_fetch_array($result)) {

@header('Location: http://www.paypal.com/cgi-bin/webscr?cmd=_cart&upload=1&charset=utf-8&currency_code=AUD&business=42HRYDVKR526L&custom='.$myrow['id'].'&return=http://www.edgeradio.org.au/programs/training/finish.php&item_number_1=1&item_name_1='.$name.'&amount_1='.$price.'&quantity_1=1');

}


?>

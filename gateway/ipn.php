<?php

include'../inc/database.inc.php';
mysql_select_db("edge_content") or die(mysql_error());

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
}
// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
while (!feof($fp)) {
$res = fgets ($fp, 1024);
if (strcmp ($res, "VERIFIED") == 0) {

// PAYMENT VALIDATED & VERIFIED!

$txn_id = $_POST['txn_id'];
$payer_email = $_POST['payer_email'];
$item_id = $_POST['custom'];

 $result = mysql_query("SELECT * FROM supporter_info WHERE username = '$item_id'") or die(mysql_error());  
 $anyrowsthere = mysql_num_rows($result);
 
 $result1 = mysql_query("SELECT * FROM training_applications WHERE id = '$item_id'") or die(mysql_error());  
 $anyrowsthere2 = mysql_num_rows($result1);
 
 $result2 = mysql_query("SELECT * FROM sor_applications WHERE id = '$item_id'") or die(mysql_error());  
 $anyrowsthere3 = mysql_num_rows($result2);

if($anyrowsthere > 0) {

mysql_query("UPDATE supporter_info SET paypal_id='$txn_id', paypal_email='$payer_email' WHERE username = '$item_id'") or die(mysql_error());  

} elseif($anyrowsthere2 > 0) {

mysql_query("UPDATE training_applications SET paypal_id='$txn_id', paypal_email='$payer_email' WHERE id = '$item_id'") or die(mysql_error());  

} elseif($anyrowsthere3 > 0) {

mysql_query("UPDATE sor_applications SET paypal_id='$txn_id', paypal_email='$payer_email', paid='true' WHERE id = '$item_id'") or die(mysql_error());  

} else {

$qty1 = $_POST['quantity1'];
$id1 = $_POST['item_number1'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty1 WHERE id = '$id1'") or die(mysql_error());  

 if($_POST['quantity2']) {
$qty2 = $_POST['quantity2'];
$id2 = $_POST['item_number2'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty2 WHERE id = '$id2'") or die(mysql_error());  
}

 if($_POST['quantity3']) {
$qty3 = $_POST['quantity3'];
$id3 = $_POST['item_number3'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty3 WHERE id = '$id3'") or die(mysql_error());  
}

 if($_POST['quantity4']) {
$qty4 = $_POST['quantity4'];
$id4 = $_POST['item_number4'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty4 WHERE id = '$id4'") or die(mysql_error());  
}

 if($_POST['quantity5']) {
$qty5 = $_POST['quantity5'];
$id5 = $_POST['item_number5'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty5 WHERE id = '$id5'") or die(mysql_error());  
}

 if($_POST['quantity6']) {
$qty6 = $_POST['quantity6'];
$id6 = $_POST['item_number6'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty6 WHERE id = '$id6'") or die(mysql_error());  
}

 if($_POST['quantity7']) {
$qty7 = $_POST['quantity7'];
$id7 = $_POST['item_number7'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty7 WHERE id = '$id7'") or die(mysql_error());  
}

 if($_POST['quantity8']) {
$qty8 = $_POST['quantity8'];
$id8 = $_POST['item_number8'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty8 WHERE id = '$id8'") or die(mysql_error());  
}

 if($_POST['quantity9']) {
$qty9 = $_POST['quantity9'];
$id9 = $_POST['item_number9'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty9 WHERE id = '$id9'") or die(mysql_error());  
}

 if($_POST['quantity10']) {
$qty10 = $_POST['quantity10'];
$id10 = $_POST['item_number10'];
mysql_select_db("edge_shop") or die(mysql_error());
mysql_query("UPDATE shop SET qty=qty-$qty10 WHERE id = '$id10'") or die(mysql_error());  
}


$message = "Items:\n\n".$_POST['quantity1']." x ".$_POST['item_name1']."\n".$_POST['quantity2']." x ".$_POST['item_name2']."\n".$_POST['quantity3']." x ".$_POST['item_name3']."\n".$_POST['quantity4']." x ".$_POST['item_name4']."\n".$_POST['quantity5']." x ".$_POST['item_name5']."\n".$_POST['quantity6']." x ".$_POST['item_name6']."\n".$_POST['quantity7']." x ".$_POST['item_name7']."\n".$_POST['quantity8']." x ".$_POST['item_name8']."\n".$_POST['quantity9']." x ".$_POST['item_name9']."\n".$_POST['quantity10']." x ".$_POST['item_name10']."\n\n\nFirst Name: ".$_POST['first_name']."\nLast Name: ".$_POST['last_name']."\nAddress Name: ".$_POST['address_name']."\nStreet: ".$_POST['address_street']."\nPostcode: ".$_POST['address_zip']."\nCity/Suburb: ".$_POST['address_city']."\nState: ".$_POST['address_state']."\nPhone: ".$_POST['contact_phone']."\nEmail: ".$_POST['payer_email']."\n";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
$message = wordwrap($message, 70);

// Send
mail('my987fm@gmail.com', 'My Subject', $message);

 
 }

}

else if (strcmp ($res, "INVALID") == 0) {

// PAYMENT INVALID & INVESTIGATE MANUALY!

}
}
fclose ($fp);
}
?>

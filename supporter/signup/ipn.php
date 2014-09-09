<?php

include'../../inc/database.inc.php';
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

mysql_query("UPDATE supporter_info SET paypal_id='$txn_id', paypal_email='$payer_email' WHERE username = '$item_id'") or die(mysql_error());  


}

else if (strcmp ($res, "INVALID") == 0) {

// PAYMENT INVALID & INVESTIGATE MANUALY!

}
}
fclose ($fp);
}
?>

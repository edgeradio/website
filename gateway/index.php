<?php
define('IN_PHPBB', true);
$phpbb_root_path = '/home/edge/public_html/soapbox/';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('ucp');

require($phpbb_root_path .'includes/functions_user.php'); 
?>

<?php



$datb = mysql_connect("localhost", "edge_edge", "rAdio_993");
$paypal_id = $_GET['tx'];
 mysql_select_db("edge_content", $datb) or die(mysql_error());
 $result = mysql_query("SELECT * FROM supporter_info WHERE paypal_id = '$paypal_id'") or die(mysql_error());  
 $anyrowsthere = mysql_num_rows($result);

if($anyrowsthere) {



while($row = mysql_fetch_array($result)) {
$username = $row['username'];
$password = $row['password'];
$email = $row['email'];
$time = time();

if($anyrowsthere) {

$message = "A new supporter has signed up. \nName: $username\nEmail: $email\n\nFrom The Edge Bot";

$message = wordwrap($message, 70);

// Send
mail('manager@edgeradio.org.au', 'ATTN: NEW EDGE SUPPORTER', $message);



$user_row = array( 
'username' => $username, 
'user_password' => md5($password), 
'user_email' => $email, 
'group_id' => 9, 
'user_timezone' => '1.00', 
'user_dst' => 0, 
'user_lang' => 'en', 
'user_type' => '0', 
'user_actkey' => '', 
'user_dateformat' => 'd M Y H:i', 
'user_style' => 1, 
'user_regdate' => time(), 
); 

$nu_user = user_add($user_row); 
 
 

if($nu_user) {
?>

<script type="text/javascript">
<!--
window.location = "http://www.edgeradio.org.au/supporter/signup/confirmation.php"
//-->
</script>

<?php
}

 }
 
 }
 
 } else {
 
 ?>
 
 <script type="text/javascript">
<!--
window.location = "http://www.edgeradio.org.au/shop/thankyou/"
//-->
</script>

<?php
 
 
 }


?>
    
<?php 
if(!$_POST['subscription']) {
header('Location: http://www.edgeradio.org.au/supporter/signup/');
}
?>
<?php

include'../../inc/database.inc.php';
mysql_select_db("edge_content") or die(mysql_error());

include'passwordHash.php';

$username = $_POST['username'];
$password = $_POST['password'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$suburb = $_POST['suburb'];
$pcode = $_POST['pcode'];
$email = $_POST['email'];
$phno = $_POST['phno'];
$mono = $_POST['mono'];
$subscribe = $_POST['subscribe'];
$birthdateday = $_POST['birthdateday'];
$birthdatemonth = $_POST['birthdatemonth'];
$birthdateyear = $_POST['birthdateyear'];
$sex = $_POST['sex'];
$subscription = $_POST['subscription'];


 mysql_select_db("edge_phpb1") or die(mysql_error());
 $result = mysql_query("SELECT * FROM phpbb_users WHERE username = '$username'") or die(mysql_error());  
 $checkusername = mysql_num_rows($result);
 if($checkusername) {
 
 $ohno = '1';
 
 
 } else {
 mysql_select_db("edge_content") or die(mysql_error());
$birthdate = $birthdateyear . '-' . $birthdatemonth . '-' . $birthdateday;
mysql_select_db("edge_content") or die(mysql_error());
mysql_query("INSERT INTO supporter_info (username, password, first_name, last_name, address1, address2, suburb, postcode, email, phone, mobile, newsletter, birthday, sex, package, supporterdate) VALUES('".$username."', '".$password."', '".$fname."', '".$lname."', '".$address."', '".$address2."', '".$suburb."', '".$pcode."', '".$email."', '".$phno."', '".$mono."', '".$subscribe."', '".$birthdate."', '".$sex."', '".$subscription."', NOW())") or die(mysql_error());  
 }


?>
<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	 <ul class="border-light">
	 <li style="color: #C0C0C0;">1. Packages</li>
	 <li style="color: #C0C0C0;">2. Details</li>
	 <li>3. Payment</li>
	 <li style="color: #C0C0C0;">4. Confirmation</li>
	 </ul>
	 </div>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">

<div class="rounded">
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Payment</div>
        
        <?php 
        
        if($ohno == '1') {
        echo'<p>Hold on, that username is already in use! Please go back and select another one!</p>';
        } else {
        ?>
        <p>Righto, we are ready to go! Click the "Pay Via PayPal" button below to redirect via PayPal's secure payment gateway.</p>
</div>
<br />
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
 <input type="hidden" name="cmd" value="_xclick">
 <input type="hidden" name="custom" value="<?php echo $_POST['username']; ?>">
 <input type="hidden" name="business" value="supporter@edgeradio.org.au">
 <input type="hidden" name="item_name" value="Edge Radio Supporter">
 <input type="hidden" name="amount" value="<?php echo $_POST['subscription']; ?>">
 <input type="hidden" name="quantity" value="1">
 <input type="hidden" name="no_note" value="1">
 <input type="hidden" name="currency_code" value="AUD">
 <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Pay Via PayPal >>" name="submit" type="submit" />
</form> 
<?php
}
?>
    
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

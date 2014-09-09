<?php
if(isset($_POST['submit'])) 

{

include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == true) {
  
  include 'inc/database.inc.php';
mysql_select_db('edge_content'); 

   $name=$_POST['name'];
   $suburb=$_POST['suburb'];
   $mobile_no=$_POST['mobile_no'];
   $message=$_POST['message'];
   $ip_address=$_SERVER['REMOTE_ADDR'];

      $insertemail="INSERT into studio_email (name, suburb, mobile_no, message, ip_address) values('$name','$suburb','$mobile_no','$message','$ip_address')";

      mysql_query($insertemail) or die(mysql_error());
    
      
      
      ?>
      <span style="font:80%/1 sans-serif;">Success! Your email has been sent to our studio!</span>
      <?php
      


} else {

   ?>
      <span style="font:80%/1 sans-serif;">Oops, the code you entered was wrong. Awkward.</span>
      <?php

}

}

else

{


?>
<style>
fieldset {
  padding: 1em;
  border: 0px;
  font:80%/1 sans-serif;
  }
label {
  float:left;
  padding: 5px; 
  width:100px;
  margin-right:0.5em;
  padding-top:5px;
  text-align:right;
  font-weight:bold;
  }
</style>

<form action="send-studio-message.php" method="post">
 <fieldset>
    <label for="name">Name:</label>
    <input type="text" style="padding: 5px; border: 1px solid #000000;" name="name" id="name" />
    <br />
    <label for="suburb">Suburb:</label>
    <input type="text" style="padding: 5px; border: 1px solid #000000;" name="suburb" id="suburb" />
    <br />
    <label for="mobile_no">Mobile Number:</label>
    <input type="text" style="padding: 5px; border: 1px solid #000000;" name="mobile_no" id="mobile_no" />
    <br>
    <label for="message">Message:</label>
    <textarea id="message" style="padding: 5px; border: 1px solid #000000;" rows="5" cols="50" name="message"></textarea>
    <br>
    <label for="human">R U Human?</label>
    <input type="text" id="human" style="padding: 5px; border: 1px solid #000000;" name="code" /><br>
    <img style="margin: 10px 0px 10px 120px;" src="http://www.edgeradio.org.au/programs/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>">
    <br>
    <label for="go"></label>
    <input id='go' type='submit' name='submit' style='border: 1px solid #000000; background-color: #FFFFFF; line-height: 18px; letter-spacing:1px; padding: 5px; margin-bottom: 5px;' value='submit'>
  </fieldset>
  </form>

<?php


}

?>
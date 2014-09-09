<?php 
require_once '../newsletter/swift_required.php';
set_time_limit (0);

include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
     <?php
    if($user->data['group_id'] == 5)
{
?>
       <div id="left_column">
    <?php
 include'sidebar.php';
 mysql_select_db('edge_website'); 
    ?>
          </div>
    <div id="two_column">

<?php
if(isset($_POST['image']))

{

 if($_FILES['imagefile']['name']) {
     $idir = "../newsletter/images/";   // Path To Images Directory 
$twidth = "676";   // Maximum Width For Thumbnail Images 

  $url = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy($_FILES['imagefile']['tmp_name'], "$idir" . $_FILES['imagefile']['name']);

 $image = 'http://www.edgeradio.org.au/newsletter/images/' . $_FILES['imagefile']['name'] . '';
}
mysql_select_db("edge_newsletter",$db);
 $query1 = "UPDATE settings SET single_img='$image'";
 
 $result1 = mysql_query($query1);
 
  if($query1) {

?>
Done!
<?php



}


} elseif(isset($_POST['submit']))

{

  $subject=$_POST['subject'];

  $nletter=$_POST['nletter'];

  if(strlen($subject)<1)

  {

     print "You did not enter a subject.";

  }

  else

  {
  

      $nletter=$_POST['nletter'];

$nletter .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>'.$subject.'</title>
</head>
<style>
	body {
		background-color: #CB1E1E;
		margin: 0;
		padding:0;
		font-size: 11px;
	}
	
	p {
	font-size: 11px;
	}
	
	span {
	font-size: 11px;
	}
	
	@font-face {
font-family: \'bebas\';
    src: url(\'http://www.edgeradio.org.au/templates/BebasNeue-webfont.eot?#iefix\') format(\'embedded-opentype\'),
         url(\'http://www.edgeradio.org.au/templates/BebasNeue-webfont.woff\') format(\'woff\'),
         url(\'http://www.edgeradio.org.au/templates/BebasNeue-webfont.ttf\') format(\'truetype\'),
         url(\'http://www.edgeradio.org.au/templates/BebasNeue-webfont.svg\') format(\'svg\');
}
	
</style>
<body>

<div style="font-size: 10px; background-color: #000000; width: 100%; padding: 5px; color: #FFFFFF;">
<div style="margin-left: auto; margin-right: auto; width: 660px; text-align: right;">
'. date('l jS \of F Y') .'
</div>
</div>
<div style="width: 100%; font-size: 11px; background-color: #CB1E1E;">
<!-- HEADER -->
';

if($_POST['type'] == 'sub' || $_POST['type'] == 'test' ||$_POST['type'] == 'databasetest') {

$nletter .= '
<table background="http://www.edgeradio.org.au/images/newsletter-bg.jpg" id="wrapper" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
<div style="width: 700px; margin-left: auto; margin-right: auto;"><a href="http://www.edgeradio.org.au"><img border="0" src="http://www.edgeradio.org.au/images/newsletter-logo.jpg"></a></div>
</td>
</tr>
</table><br>
';

} elseif($_POST['type'] == 'vol' || $_POST['type'] == 'test2') {

$nletter .= '
<table background="http://www.edgeradio.org.au/images/newsletter-bg.jpg" id="wrapper" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
<div style="width: 700px; margin-left: auto; margin-right: auto;"><a href="http://www.edgeradio.org.au"><img border="0" src="http://www.edgeradio.org.au/images/newsletter-logo.jpg"></a></div>
</td>
</tr>
</table><br>';

}

$nletter .= '
<div style="width: 700px; margin-left: auto; margin-right: auto; background-color: #CB1E1E; font-family: Verdana, Arial, Sans-serif;">

';


   mysql_select_db("edge_newsletter",$db);
 $result = mysql_query("SELECT * FROM settings",$db);
 while ($info = mysql_fetch_array($result)) {

			$nletter .= '<a target="_blank" href="' . $_POST["link"] . '"><img style="margin: 5px 10px 10px 10px;" src="'.$info['single_img'].'"></a>';
			
			}
   
$nletter .= '
<br>
<!-- MAIN CONTENT -->

';


if($_POST["news1"]) {
  $nletter .= '<div style="padding: 5px 10px 5px 10px; font-size: 11px; background-color:#FFF; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;"><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news1"])) . '</p></div><br>';
}





$nletter .= '

<div style="margin: 0 10px 0 10px; padding: 5px 10px 5px 10px; background-color:#000; -moz-border-radius:15px; text-align: center; -webkit-border-radius:15px; border-radius:15px;">
<img border="0" src="http://www.edgeradio.org.au/images/email-getso.jpg">
<a href="http://www.facebook.com/edgeradio993"><img border="0" src="http://www.edgeradio.org.au/images/email-face.jpg"></a>
<a href="http://twitter.com/edgeradio"><img border="0" src="http://www.edgeradio.org.au/images/email-twit.jpg"></a>
<a href="http://itunes.apple.com/us/app/edge-radio/id498802737?ls=1&mt=8"><img border="0" src="http://www.edgeradio.org.au/images/email-itunes.jpg"></a>

</div>


';

  

      
      if($_POST['type'] == 'sub') {
      
      mysql_select_db('edge_newsletter'); 

      $getlist="SELECT * from subscribers WHERE validated = '1' order by email ASC"; //select e-mails in ABC order

      $getlist2=mysql_query($getlist) or die("Could not get list");

      while($getlist3=mysql_fetch_array($getlist2))

      {
      
      $listofsubemails = $getlist3[email];
    
      
      $body = $nletter.'<div style="width: 400px; margin-left: auto; margin-right: auto; padding: 10px; color: #FFFFFF; text-align: center; font-size: 10px;">You have received this e-newsletter because you are an Edge Radio supporter, or because you have signed up for the Edge Newsletter at edgeradio.org.au. To unsubscribe, <a href="http://edgeradio.org.au/newsletter/unsubscribe.php?email='.$listofsubemails.'" style="text-decoration: none; color: #FFFFFF;"><b>click here</b></a>.<br><br>
      <a href="http://edgeradio.org.au/" style="text-decoration: none; color: #FFFFFF;">Visit The Edge Radio Website</a></div>
</div>
</div>
</body>
</html>';

 $transport = Swift_SmtpTransport::newInstance('mail.edgeradio.org.au', 25)
->setUsername('webguy@edgeradio.org.au')
->setPassword('sophie123')
;

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance($subject)
->setFrom(array('noreply@edgeradio.org.au' => 'Edge Radio 99.3FM'))
->setTo(array($listofsubemails))
->setBody($body, 'text/html')
;
$numSent = $mailer->send($message);  

echo '<img src="../newsletter/tick.png"> Sent message to '.$listofsubemails.'<br>';
         
          }

} elseif($_POST['type'] == 'databasetest') {
      
      mysql_select_db('edge_newsletter'); 

      $getlist="SELECT * from test order by email ASC"; 

      $getlist2=mysql_query($getlist) or die("Could not get list");
      
        
      while($getlist3=mysql_fetch_array($getlist2))

      {
      
      $listofsubemails = $getlist3[email];
    
      
      $body = $nletter.'<div style="width: 400px; margin-left: auto; margin-right: auto; padding: 10px; color: #FFFFFF; text-align: center; font-size: 10px;">You have received this e-newsletter because you are an Edge Radio supporter, or because you have signed up for the Edge Newsletter at edgeradio.org.au. To unsubscribe, <a href="http://edgeradio.org.au/newsletter/unsubscribe.php?email='.$listofsubemails.'" style="text-decoration: none; color: #FFFFFF;"><b>click here</b></a>.<br><br>
      <a href="http://edgeradio.org.au/" style="text-decoration: none; color: #FFFFFF;">Visit The Edge Radio Website</a></div>
</div>
</div>
</body>
</html>';

          
$transport = Swift_SmtpTransport::newInstance('mail.edgeradio.org.au', 25)
->setUsername('webguy@edgeradio.org.au')
->setPassword('sophie123')
;

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance($subject)
->setFrom(array('noreply@edgeradio.org.au' => 'Edge Radio 99.3FM'))
->setTo(array($listofsubemails))
->setBody($body, 'text/html')
;
$numSent = $mailer->send($message);  

echo '<img src="../newsletter/tick.png"> Sent message to '.$listofsubemails.'<br>';
          }


} elseif($_POST['type'] == 'vol') {



mysql_select_db('edge_newsletter'); 

      $getlist="SELECT * from volunteers order by email ASC"; //select e-mails in ABC order

      $getlist2=mysql_query($getlist) or die("Could not get list");

      while($getlist3=mysql_fetch_array($getlist2))

      {
      $listofsubemails = $getlist3[email];

    
$body = $nletter.'<div style="width: 400px; margin-left: auto; margin-right: auto; padding: 10px; color: #FFFFFF; text-align: center; font-size: 10px;">You have received this e-newsletter because you are an Edge Radio volunteer. <br><br><a href="http://edgeradio.org.au/" style="text-decoration: none; color: #FFFFFF;">Visit The Edge Radio Website</a></div>
</div>
</div>
</body>
</html>';

 $transport = Swift_SmtpTransport::newInstance('mail.edgeradio.org.au', 25)
->setUsername('webguy@edgeradio.org.au')
->setPassword('sophie123')
;

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance($subject)
->setFrom(array('noreply@edgeradio.org.au' => 'Edge Radio 99.3FM'))
->setTo(array($listofsubemails))
->setBody($body, 'text/html')
;
$numSent = $mailer->send($message);  

echo '<img src="../newsletter/tick.png"> Sent message to '.$listofsubemails.'<br>';

}

} elseif($_POST['type'] == 'test') {


      $nletter .= '<div style="width: 400px; margin-left: auto; margin-right: auto; padding: 10px; color: #FFFFFF; text-align: center; font-size: 10px;">You have received this e-newsletter because you are an Edge Radio supporter, or because you have signed up for the Edge Newsletter at edgeradio.org.au. To unsubscribe, <a href="http://edgeradio.org.au/newsletter/unsubscribe.php?email=test@edgeradio.org.au" style="text-decoration: none; color: #FFFFFF;"><b>click here</b></a>.<br><br>
      <a href="http://edgeradio.org.au/" style="text-decoration: none; color: #FFFFFF;">Visit The Edge Radio Website</a></div>
</div>
</div>
</body>
</html>';

$transport = Swift_SmtpTransport::newInstance('mail.edgeradio.org.au', 25)
->setUsername('webguy@edgeradio.org.au')
->setPassword('sophie123')
;

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance($subject)
->setFrom(array('noreply@edgeradio.org.au' => 'Edge Radio 99.3FM'))
->setTo(array('programs@edgeradio.org.au', 'webguy@edgeradio.org.au'))
->setBody($nletter, 'text/html')
;
$numSent = $mailer->send($message);  

echo '<img src="../newsletter/tick.png"> Sent message to '.$listofsubemails.'<br>';

} elseif($_POST['type'] == 'test2') {


$nletter .= '<div style="width: 400px; margin-left: auto; margin-right: auto; padding: 10px; color: #FFFFFF; text-align: center; font-size: 10px;">You have received this e-newsletter because you are an Edge Radio volunteer. <br><br><a href="http://edgeradio.org.au/" style="text-decoration: none; color: #FFFFFF;">Visit The Edge Radio Website</a></div>
</div>
</div>
</body>
</html>';


 $transport = Swift_SmtpTransport::newInstance('mail.edgeradio.org.au', 25)
->setUsername('webguy@edgeradio.org.au')
->setPassword('sophie123')
;

$mailer = Swift_Mailer::newInstance($transport);

$message = Swift_Message::newInstance($subject)
->setFrom(array('noreply@edgeradio.org.au' => 'Edge Radio 99.3FM'))
->setTo(array('programs@edgeradio.org.au', 'webguy@edgeradio.org.au'))
->setBody($nletter, 'text/html')
;
$numSent = $mailer->send($message);  

echo '<img src="../newsletter/tick.png"> Sent message to '.$listofsubemails.'<br>';

}


}
}

else

{




?>
<style>
label {
width: 200px;
text-align: right;
float:left;
padding: 5px;
padding-top:5px;
margin-right:10px;
font-weight:bold;
}
</style>

<div class="rounded">

<h1 class="greyheader">SINGLE IMAGE</h1>
     
     <p>Upload an image for the newsletter. Yep.</p>

   <p>
   <form enctype="multipart/form-data" action="single-newsletter.php" method="post">
 <table cellpadding="5" cellspacing="2">
 
 <tr>
	<td style="width: 100px;"><b>Current Image</b></td>
   <td>
   <img style="width: 300px; height: 200px;" src="<?php
   
   mysql_select_db("edge_newsletter",$db);
 $result = mysql_query("SELECT * FROM settings",$db);
 while ($info = mysql_fetch_array($result)) {

			echo $info['single_img'];
			
			}
   
   ?>">
   </td>
</tr>
 <tr>
	<td style="width: 100px;"><b>Upload Image</b></td>
   <td><input type="file" name="imagefile" class="form"> </td>
</tr></table>

<input type='submit' name='submit' value='Submit'>
<input type="hidden" name="image" value="TRUE" /></form>

</div>

<br />


  <div class="rounded">
    
    


<h1 class="greyheader">Newsletter Manager</h1>
     
     <p>As you can probably see, this sends out a single newsletter to all the subscribers/volunteers. You upload an image and attach some content and send it out. Its single newslettery goodness!</p>



<form action='single-newsletter.php' method="POST">

<label for="type">Newsletter Type</label>
<select name="type" id="type">
<option value="">Select One</option>
<option value="sub">Subscribers & Supporters (Sends to newsletter subscribers and supporters)</option>
<option value="vol">Volunteers (Sends to volunteers)</option>
<option value="databasetest">Test Database (Sends To Emails In Test DB)</option>
<option value="test">Test Subscriber Newsletter (Sends To Programs)</option>
<option value="test2">Test Volunteer Newsletter (Sends To Programs)</option>
</select><br><br>

<label for="subject">Newsletter Subject</label>
<input type='text' name='subject' id='subject' size='40'><br><br><br>

<label for="link">Newsletter Image Link</label>
<input type='text' name='link' id='link' size='40'><br><br><br>

  
  
          <label for='news1'>Content</label><textarea rows='10' cols='50' id='news1' name='news1'>You should probably write a little introduction here, but if you don't feel like it, then just delete this!</textarea><br><br>
          
     <br><br><br>
     
     <input type='submit' name='submit' value='Submit'><br><br>
</form>

<?

}


 }
else
{
  echo "<h1 class=\"greyheader\">WOAH</h1>";
        echo "<p>We are now redirecting you to the login page.</p>";
        echo "<p><a href=\"index.php\">Click Here</a> if you are not automatically redirected.</p>";
        echo "<script type=\"text/javascript\">
<!--
window.location = \"index.php\"
//-->
</script>";
    
}
?>
</div>
 <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>

<?php include '../templates/common_end.php'; ?>
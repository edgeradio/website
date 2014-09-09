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
$twidth = "106";   // Maximum Width For Thumbnail Images 
$theight = "81";   // Maximum Height For Thumbnail Images 

  $url = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy($_FILES['imagefile']['tmp_name'], "$idir" . $_FILES['imagefile']['name']);

 $image = 'http://www.edgeradio.org.au/newsletter/images/' . $_FILES['imagefile']['name'] . '';
}
mysql_select_db("edge_newsletter",$db);
 $query1 = "UPDATE settings SET top_img='$image'";
 
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
<div style="width: 700px; margin-left: auto; margin-right: auto;"><a href="http://www.edgeradio.org.au"><img border="0" src="http://www.edgeradio.org.au/images/newsletter-logo.jpg"></a><img style="float: right;" src="http://www.edgeradio.org.au/images/newsletter-title.jpg"></div>
</td>
</tr>
</table><br>
';

} elseif($_POST['type'] == 'vol' || $_POST['type'] == 'test2') {

$nletter .= '
<table background="http://www.edgeradio.org.au/images/newsletter-bg.jpg" id="wrapper" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td>
<div style="width: 700px; margin-left: auto; margin-right: auto;"><a href="http://www.edgeradio.org.au"><img border="0" src="http://www.edgeradio.org.au/images/newsletter-logo.jpg"></a><img style="float: right;" src="http://www.edgeradio.org.au/images/newsletter-vol.jpg"></div>
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

			$nletter .= '<img style="margin: 5px 10px 10px 10px;" src="'.$info['top_img'].'">';
			
			}
   
$nletter .= '
<br>
<table style="width: 700px; border: 0px;" cellpadding="10">
<tr>
<td style="vertical-align: top;">
<!-- MAIN CONTENT -->

<div style="padding: 5px 10px 5px 10px; font-size: 11px; background-color:#FFF; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;">';


if($_POST["newstitle1"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle1"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news1"])) . '</p><br>';
}

if($_POST["newstitle2"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle2"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news2"])) . '</p><br>';
}

if($_POST["newstitle3"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle3"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news3"])) . '</p><br>';
}

if($_POST["newstitle4"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle4"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news4"])) . '</p><br>';
}

if($_POST["newstitle5"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle5"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news5"])) . '</p><br>';
}

if($_POST["newstitle6"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle6"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news6"])) . '</p><br>';
}

if($_POST["newstitle7"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle7"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news7"])) . '</p><br>';
}

if($_POST["newstitle8"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle8"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news8"])) . '</p><br>';
}

if($_POST["newstitle9"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle9"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news9"])) . '</p><br>';
}

if($_POST["newstitle10"]) {
  $nletter .= '<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">' .stripslashes($_POST["newstitle10"]) . '</div><p>' . str_replace(chr(13),"<br>",stripslashes($_POST["news10"])) . '</p><br>';
}



$nletter .= '

</div>
<br>

';


if($_POST['type'] == 'sub' || $_POST['type'] == 'test') {


$nletter .= '
<div style="font-size: 11px; padding: 5px 10px 5px 10px; background-color:#FFF; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;">
<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">What\'s On Edge?</div>
';

mysql_select_db("edge_website",$db);
$result = mysql_query("SELECT * FROM cup WHERE Display='Y' AND expire > NOW() ORDER BY expire ASC",$db);
$nletter .= '<table style="width: 100%;" cellpadding="10" cellspacing="5">';
              

    while ($myrow = mysql_fetch_array($result)) {
      $sd = $myrow["Date"];
  $counttitle = strlen($myrow["Title"]);
  $counttext = strlen($myrow["Description"]);
  $text = substr($myrow["Description"], 0, 240);
  $show_id = $myrow["show_id"];
  mysql_select_db("edge_programs",$db);
  $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_time, DATE_FORMAT(end_time,'%h:%i%p') as end_time FROM program_info WHERE id='$show_id' LIMIT 1");
  while ($info = mysql_fetch_array($inforesult)) {
$start = $info['start_time'];
   $end = $info['end_time'];
   $day = $info['day_time'];
   $seotitle = $info['seotitle'];
   if($info['sml_img'] == '') { $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg'; } else { $img = $info['sml_img']; }
   }
$nletter .= '
			  <tr>
	<td style="vertical-align: top; width: 100px;"><a href="http://www.edgeradio.org.au/programs/'.$day.'/'.str_replace(" ","-",$seotitle).'/"><img style="border: 0px none; width: 100px; height: 100px;" src="' . $img . '"></a></td>
	<td>
	<a href="http://www.edgeradio.org.au/programs/'.$day.'/'.str_replace(" ","-",$seotitle).'/" border="0" style="text-decoration: none; font-weight: bold; color: #FF2A2A;">'.$myrow["Title"].'</a><br>
	
	<span style="color: rgb(150, 150, 150); line-height: 16px;">'.$day.' @ ' . $start . ' - ' . $end . '</span>
	<br />
	
	<div style="padding-top: 3px; font-size: 12px; line-height: 16px; color: #000000;">';
	if($counttext > 240) { $nletter .= ''.$text.'...'; } else { $nletter .= ''.$text.''; } 
	
	$nletter .= '</div>
	</td>
</tr>';

    }


$nletter .= '
</table>';

}

$nletter .= '
</td>
<td style="width: 180px; vertical-align: top;">
<!-- SIDEBAR -->
<div style="font-size: 11px; padding: 5px 10px 10px 10px; background-color:#FFF; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;">
<div style="background:#242424; font-family: bebas, arial; color:#FFF; margin: 10px 0 10px 0; font-size: 14px; font-weight: bold; padding: 5px;">Feature Albums</div>


';


mysql_select_db("edge_music",$db);
 $result = mysql_query("SELECT * FROM music WHERE err_date_end != '0000-00-00' ORDER BY date_added DESC",$db);
 while ($info = mysql_fetch_array($result)) {
 if(strtotime($info['err_date_end']) > time()) {

			$nletter .= '<center><img style="width: 100px; height: 100px; padding: 10px;" src="'.$info['image'].'"><br><span style="color: #000000;">'.stripslashes($info['artist']).' - <span style="color: #333333;">'.stripslashes($info['album']).'</span></span><br></center>';
			
			}
			}

$nletter .= '<br><a style="float: right; text-decoration: none; font-size: 10px; color: #000000;" href="http://www.edgeradio.org.au/music/edge-radio-recommended/"><i>View All ERR\'s...</i></a><br></div>

<br>

<a target="_blank" href="http://www.edgeradio.org.au/player/"><img style="border: 0px; margin-bottom: 20px;" src="http://www.edgeradio.org.au/newsletter/listen-live.png"></a>

<a target="_blank" href="http://www.edgeradio.org.au/soapbox/"><img style="border: 0px; margin-bottom: 20px;" src="http://www.edgeradio.org.au/newsletter/soapbox.png"></a>

<a target="_blank" href="http://www.edgeradio.org.au/music/"><img style="border: 0px; margin-bottom: 20px;" src="http://www.edgeradio.org.au/newsletter/new-music.png"></a>

<a target="_blank" href="http://www.edgeradio.org.au/supporter/"><img style="border: 0px; margin-bottom: 20px;" src="http://www.edgeradio.org.au/newsletter/supporter.png"></a>

</td>
</tr>
</table>

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

<h1 class="greyheader">HEADER IMAGE</h1>
     
     <p>Upload an image for the header of the newsletter. Yep.</p>

   <p>
   <form enctype="multipart/form-data" action="newsletter-manager.php" method="post">
 <table cellpadding="5" cellspacing="2">
 
 <tr>
	<td style="width: 100px;"><b>Current Image</b></td>
   <td>
   <img style="width: 338px; height: 100px;" src="<?php
   
   mysql_select_db("edge_newsletter",$db);
 $result = mysql_query("SELECT * FROM settings",$db);
 while ($info = mysql_fetch_array($result)) {

			echo $info['top_img'];
			
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
     
     <p>As you can probably see, this sends out a newsletter to all the subscribers/volunteers. It snatches content from the edge news blog and the current ERR releases. Theres also some blank spots for you to fill in... Whoopee.</p>



<form action='newsletter-manager.php' method="POST">

<label for="type">Newsletter Type</label>
<select name="type" id="type">
<option value="">Select One</option>
<option value="sub">Subscribers & Supporters (Sends to newsletter subscribers and supporters)</option>
<option value="vol">Volunteers (Sends to volunteers)</option>
<option value="databasetest">Test Database (Sends To Emails In Test DB)</option>
<option value="test">Test Subscriber Newsletter (Sends To Programs)</option>
<option value="test2">Test Volunteer Newsletter (Sends To Programs)</option>
</select><br><br>

<label for="subject">Newsletter Title</label>
<input type='text' name='subject' id='subject' size='40'><br><br><br>

  
  
          <label for="newstitle1">News Item Title 1</label><input id="newstitle1" type="text" size="40" name="newstitle1" value="Welcome"><br><br><label for='news1'>News Item Body 1</label><textarea rows='10' cols='50' id='news1' name='news1'>You should probably write a little introduction here, but if you don't feel like it, then just delete this!</textarea><br><br>
          
          <label for="newstitle2">News Item Title 2</label><input id="newstitle2" type="text" size="40" name="newstitle2" value=""><br><br><label for='news2'>News Item Body 2</label><textarea rows='10' cols='50' id='news2' name='news2'></textarea><br><br>
          
          <label for="newstitle3">News Item Title 3</label><input id="newstitle3" type="text" size="40" name="newstitle3" value=""><br><br><label for='news3'>News Item Body 3</label><textarea rows='10' cols='50' id='news3' name='news3'></textarea><br><br>
          
          <label for="newstitle4">News Item Title 4</label><input id="newstitle4" type="text" size="40" name="newstitle4" value=""><br><br><label for='news4'>News Item Body 4</label><textarea rows='10' cols='50' id='news4' name='news4'></textarea><br><br>
          
          <label for="newstitle5">News Item Title 5</label><input id="newstitle5" type="text" size="40" name="newstitle5" value=""><br><br><label for='news5'>News Item Body 5</label><textarea rows='10' cols='50' id='news5' name='news5'></textarea><br><br>
          
          <label for="newstitle5">News Item Title 6</label><input id="newstitle6" type="text" size="40" name="newstitle6" value=""><br><br><label for='news6'>News Item Body 6</label><textarea rows='10' cols='50' id='news6' name='news6'></textarea><br><br>
          
          <label for="newstitle7">News Item Title 7</label><input id="newstitle7" type="text" size="40" name="newstitle7" value=""><br><br><label for='news7'>News Item Body 7</label><textarea rows='10' cols='50' id='news7' name='news7'></textarea><br><br>
          
          <label for="newstitle8">News Item Title 8</label><input id="newstitle8" type="text" size="40" name="newstitle8" value=""><br><br><label for='news8'>News Item Body 8</label><textarea rows='10' cols='50' id='news8' name='news8'></textarea><br><br>
          
          <label for="newstitle9">News Item Title 9</label><input id="newstitle9" type="text" size="40" name="newstitle9" value=""><br><br><label for='news9'>News Item Body 9</label><textarea rows='10' cols='50' id='news9' name='news9'></textarea><br><br>
          
          <label for="newstitle10">News Item Title 10</label><input id="newstitle10" type="text" size="40" name="newstitle10" value=""><br><br><label for='news10'>News Item Body 10</label><textarea rows='10' cols='50' id='news10' name='news10'></textarea><br><br>
          
          
          
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
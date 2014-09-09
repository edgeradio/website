<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
<?php include'../sidebar.php'; ?>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
    
    <div style="height: 100px; background-image: url(../../images/gigguide.png);" class="rounded">
    </div>
    <br />
    
     <div class="rounded">
     <h1 class="title-head-right">Information</h1>
     <p>To have your gig listed in this guide you need to have the info submitted at least a week before the gig. Gigs are subject to approval by the Edge Radio Management. Most gigs receive promotion on air, but there is no guarantee that your gig will be promoted.</p>
     
     <p>Edge Radio Sponsors receive a highlighted gig on this page, if you are a sponsor or you are interested in becoming a sponsor of Edge Radio, please email us at sponsor@edgeradio.org.au.</p>
     </div>
     </br />
    <?php
    if($user->data['user_id'] = ANONYMOUS)
{
    ?> 
    <div class="rounded">
    
    
    <?php
    if (isset($_POST['submitted'])) {

mysql_select_db('edge_content'); 

$date = ''.$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'].' '.$_POST['hours'].':'.$_POST['minutes'].':'.$_POST['seconds'].'';

$title = addslashes($_POST['title']);
$website = $_POST['website'];
$facebook = $_POST['facebook'];
$venue = addslashes($_POST['venue']);
$description = addslashes($_POST['description']);
$lineup = $_POST['lineup'];
$sponsor = $_POST['sponsor'];
$user = $user->data['username'];

 $query1 = "INSERT INTO gig_guide (approved, sponsor, title, whenevent, venue, description, lineup, facebook, website, image, user_submitted, date_submitted) VALUES ('', '$sponsor', '$title', '$date', '$venue', '$description', '$lineup', '$facebook', '$website', '$image', '$user', NOW())";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo "<p><strong>Success!</strong>";
  echo mysql_error();
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
 } else {
?> 
<form enctype="multipart/form-data" action="http://www.edgeradio.org.au/community/new-gig/" method="post">
<h1 class="title-head-right">Submit New Gig</h1>

 <table cellpadding="5" cellspacing="2">
  <tr>
<td style="width: 200px;"><b>When Is The Event?</b></td>
	<td>  
 <select name="month">
	<option value="01">January
	</option><option value="02">February
	</option><option value="03">March
	</option><option value="04">April
	</option><option value="05">May
	</option><option value="06">June
	</option><option value="07">July
	</option><option value="08">August
	</option><option value="09">September
	</option><option value="10">October
	</option><option value="11">November
	</option><option value="12">December

</option></select>
<select name="day">
	<option value="01">1
	</option><option value="02">2
	</option><option value="03">3
	</option><option value="04">4
	</option><option value="05">5
	</option><option value="06">6
	</option><option value="07">7
	</option><option value="08">8
	</option><option value="09">9
	</option><option value="10">10
	</option><option value="11">11
	</option><option value="12">12
	</option><option value="13">13
	</option><option value="14">14
	</option><option value="15">15
	</option><option value="16">16
	</option><option value="17">17
	</option><option value="18">18
	</option><option value="19">19
	</option><option value="20">20
	</option><option value="21">21
	</option><option value="22">22
	</option><option value="23">23
	</option><option value="24">24
	</option><option value="25">25
	</option><option value="26">26
	</option><option value="27">27
	</option><option value="28">28
	</option><option value="29">29
	</option><option value="30">30
	</option><option value="31">31

</option></select>
<select name="year">
	<option value="2010">2010
	</option><option value="2011">2011
	</option><option value="2012">2012
	</option><option value="2013">2013
	</option><option value="2014">2014
	</option><option value="2015">2015
	</option><option value="2016">2016
	</option><option value="2017">2017
	</option><option value="2018">2018
	</option><option value="2019">2019
	</option><option value="2020">2020
</option></select>

<br>

<select name="hours">
<?php
for ($i=0; $i<=23; $i++)
  {
?>
	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	<?php } ?>
</select>
<select name="minutes">
<?php
for ($i=00; $i<=59; $i++)
  {
?>
	<option value="<?php echo sprintf("%02d", $i); ?>"><?php echo sprintf("%02d", $i); ?></option>
	<?php } ?>
</select>
<select name="seconds">
<?php
for ($i=00; $i<=59; $i++)
  {
?>
	<option value="<?php echo sprintf("%02d", $i); ?>"><?php echo sprintf("%02d", $i); ?></option>
	<?php } ?>
</select></td>
	</tr>
  <tr>
	<td style="width: 200px;"><b>Title</b></td>
	<td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
	<tr>
	<td style="width: 200px;"><b>Venue</b></td>
   <td><input name="venue" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 200px;"><b>Short Description</b></td>
   <td><input name="description" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
   </tr>
      <tr>
	<td style="width: 200px;"><b>Lineup/Arrists/Bands/DJs</b></td>
   <td><input name="lineup" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 200px;"><b>Website (Optional)</b></td>
   <td><input name="website" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 200px;"><b>Facebook Event Page (Optional)</b></td>
   <td><input name="facebook" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
  </table>
  <br>

 <p>
  <input type="submit" style="border:solid 1px #990000;" name="submit" value="Submit Gig For Approval" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
   <?php
   }
   
   ?>
     
      </div>
    <?php
    } else {
    ?>
    <div class="rounded">
     <h1 class="title-head-right">Oops!</h1>
     <p>You need to Register for our Soapbox and/or Log In to access this page!</p>
    </div>
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

<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	<ul class="border-light">
	 <li style="color: #C0C0C0;">1. Introduction</li>
	 <li>2. Program/Contact Details</li>
	 <li style="color: #C0C0C0;">3. Confirmation</li>
	 </ul>
	 </div>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
     <?php
       $db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_content",$db);
 $result = mysql_query("SELECT * FROM programapp_status LIMIT 1",$db);
  while ($myrow = mysql_fetch_array($result)) {
    if($myrow["status"] == 1) {

    ?>

<form  name="form" action="http://www.edgeradio.org.au/programs/apply/details.php" method="post">
<div class="rounded">
<p align="center"><h1>Please Read Before Re-applying</h1></p>
<p align="left"><h2>A few Things To Remember When Submitting Your Re-application.</h2></p>
<blockquote>
<li>We need your current contact details even if they have not changed.</li>
<li>You do not have to fill out the form in any great detail if you are not changing the format of your program. Just note down the important elements associated with your program so we understand what it's all about.</li>
<li>If you do not wish to change the format or timeslot of your program then make a note of that in the notes/comments section near the bottom of the form.</li>
<li>If you wish to do the same format but in a different timeslot make sure you list your availabilities on the form and make a note of it in the notes/comments section near the bottom.</li>
<li>If you're unhappy with both the format and timeslot you have, but want to do a different program then you'll need to submit an application for a new program.</li>
</div><br>
<div class="rounded">
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Select Existing Program</div>
		
		<style>
fieldset {
  padding: 1em;
  border: 0px;
  font: 12px sans-serif;
  }
label {
  float:left;
  padding: 5px; 
  width:150px;
  margin-right:10px;
  padding-top:5px;
  text-align:right;
  font-weight:bold;
  }
</style>
		
		<fieldset>

<label for="title">Program</label>
<select name="program">
<?php
mysql_select_db("edge_programs",$db);
 $result = mysql_query("SELECT * FROM program_info ORDER BY title ASC",$db);
  while ($my = mysql_fetch_array($result)) {
  if($my["title"] != 'Edge Tunes') {
  echo'<option value="'.$my["id"].'">'.stripslashes($my["title"]).' ('.$my["day_time"].')</option>';
  }
  }

?>
</select>


		</fieldset>
</div>

        <br />
        
     
       
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Continue >>" name="submit" type="submit" />
        </form>
        <?php
		 } else {
		 
		 echo'<div class="rounded"><div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Program Applications Are Currently Closed. Sorry.</div></div>';
		 
		 }
    }
		?>
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

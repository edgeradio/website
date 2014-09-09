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

<form  name="form" action="http://www.edgeradio.org.au/programs/apply/finish.php" method="post">
<div class="rounded">
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Your Program Details</div>
		
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
  
  #bits label {
  float:left;
  padding: 5px; 
  width:250px;
  margin-right:10px;
  padding-top:5px;
  text-align:right;
  font-weight:bold;
  }
</style>
		
		<fieldset>
		
		<?php
		if($_POST['program']) {
	$id = $_POST['program'];
mysql_select_db("edge_programs",$db);
 $result = mysql_query("SELECT * FROM program_info WHERE id = '$id'",$db);
  while ($my = mysql_fetch_array($result)) {
  $title = stripslashes($my["title"]);
  $day = stripslashes($my["day_time"]);
  
  echo'<div style="padding: 0px 0 20px 0; font-size: 24px;" class="title">We have filled in a few details for you, please fill in the blanks and you should be ready to go!</div>';
  
  echo'<input value="true" name="reapply" type="hidden" />';
  }

		}
		
		?>

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is your program called?</div>
<label for="title">Program Title*</label>
<input type="text" name="title" size="25" id="title" value="<?php echo $title; ?>" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">How many hours will your program run for?</div>
<label for="tday">Duration of Program*</label>
<div id="duration" style="float: left;">
<input type="radio" name="duration" value="1 Hour" /> 1 Hour<br>
<input type="radio" name="duration" value="2 Hours" /> 2 Hours<br>
<input type="radio" name="duration" value="3 Hours" /> 3 Hours<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What type of program will you be broadcasting?</div>
<label for="type">Type Of Program*</label>
<div id="day" style="float: left;">
<input type="radio" name="type" value="Light Entertainment (Breakfast/Lunch)" /> Light Entertainment (Breakfast/Lunch)<br>
<input type="radio" name="type" value="Journalistic/News/Curent Affairs" /> Journalistic/News/Curent Affairs<br>
<input type="radio" name="type" value="Community Issues/Local Content" /> Community Issues/Local Content<br>
<input type="radio" name="type" value="New Music" /> New Music<br>
<input type="radio" name="type" value="Specialist Music" /> Specialist Music<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What's your program about?</div>
<label for="des">Description*</label>
<textarea type="text" name="description" rows="5" cols="40" id="des"></textarea>
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">In <b>20 WORDS</b> or less.</div>
<label for="short">Short Description*</label>
<input type="text" name="short" size="40" id="short" value="" />
<br /><br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">If you are choosing to do a music based show, a specific genre helps us place your show in an appropriate timeslot.</div>
<label for="genre">Genre</label>
<input type="text" name="genre" size="25" id="genre" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">If you are choosing to do a music based show, please provide 5 or more sample artists you would play on your program.</div>
<label for="art">Example Artists Played On Your Show</label>
<textarea type="text" name="art" rows="5" cols="40" id="art"></textarea>
<br /><br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What type of audience are you aiming at?</div>
<label for="audience">Target Audience*</label>
<textarea type="text" name="audience" rows="5" cols="40" id="audience"></textarea>
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Your program will be exposed to the public, how will you promote it?</div>
<label for="promo">How Will You Promote It?*</label>
<textarea type="text" name="promo" rows="5" cols="40" id="promo"></textarea>
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Required Field.</div>
<label for="achieve">What Do You Want To Achieve As A Presenter On Edge Radio?*</label>
<textarea type="text" name="achieve" rows="5" cols="40" id="achieve"></textarea>
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Required Field.</div>
<label for="aimso">How Will You Meet <a href="http://www.edgeradio.org.au/about/" target="_blank">Edge Radio’s Aims And Objectives</a>?*</label>
<textarea type="text" name="aimso" rows="5" cols="40" id="aimso"></textarea>
<br /><br />
</fieldset>
</div>



<br />
<div class="rounded">
<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Availability</div>
<fieldset>

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What days of the week are you NOT available to broadcast? If you are only available during a certain time of day (IE: Morning, Afternoon, or Evenings) please make a note of it in Notes/Comments section at the bottom of the form.</div>
<label for="dayno">Days You <u>CANNOT</u> Broadcast On*</label>
<div id="dayno" style="float: left;">
<input type="checkbox" name="dayno[]" value="Monday" <?php if($dayno == 'Monday') { echo'checked="checked"'; } ?> /> Monday<br>
<input type="checkbox" name="dayno[]" value="Tuesday" <?php if($dayno == 'Tuesday') { echo'checked="checked"'; } ?> /> Tuesday<br>
<input type="checkbox" name="dayno[]" value="Wednesday" <?php if($dayno == 'Wednesday') { echo'checked="checked"'; } ?> /> Wednesday<br>
<input type="checkbox" name="dayno[]" value="Thursday" <?php if($dayno == 'Thursday') { echo'checked="checked"'; } ?> /> Thursday<br>
<input type="checkbox" name="dayno[]" value="Friday" <?php if($dayno == 'Friday') { echo'checked="checked"'; } ?> /> Friday<br>
<input type="checkbox" name="dayno[]" value="Saturday" <?php if($dayno == 'Saturday') { echo'checked="checked"'; } ?> /> Saturday<br>
<input type="checkbox" name="dayno[]" value="Sunday" <?php if($dayno == 'Sunday') { echo'checked="checked"'; } ?> /> Sunday<br>
</div>
<div style="clear: both;"></div>
<br /><br />
</fieldset>
</div>

<br />
<div class="rounded">
<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Presenter #1 (YOU!)</div>
<fieldset>

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is your full name?</div>
<label for="fullname">Full Name*</label>
<input type="text" name="fullname" size="25" id="fullname" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What role will you play in the program?</div>
<label for="role">Role*</label>
<div id="role" style="float: left;">
<input type="radio" name="role" value="Presenter" /> Presenter<br>
<input type="radio" name="role" value="Panel Operator" /> Panel Operator<br>
<input type="radio" name="role" value="Producer" /> Producer<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">The course is required to all presenters/panel operators/producers.</div>
<label for="training">Have You Undertaken The Edge Radio Training Course?*</label>
<div id="training" style="float: left;">
<input type="radio" name="training" value="Yes" /> Yes<br>
<input type="radio" name="training" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Day/Month/Year</div>
<label for="dob">Date Of Birth*</label>
<input type="text" name="dob" size="25" id="dob" value="DD/MM/YYYY" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Required Field.</div>
<label for="student">Are You A Student?*</label>
<div id="student" style="float: left;">
<input type="radio" name="student" value="Yes (University)" /> Yes (University)<br>
<input type="radio" name="student" value="Yes (TAFE)" /> Yes (TAFE)<br>
<input type="radio" name="student" value="Yes (Year 11 / Year 12)" /> Yes (Year 11 / Year 12)<br>
<input type="radio" name="student" value="Yes (Year 10 or Below)" /> Yes (Year 10 or Below)<br>
<input type="radio" name="student" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Street address.</div>
<label for="ad">Address*</label>
<input type="text" name="ad" size="25" id="ad" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Which suburb do you live in?</div>
<label for="suburb">Suburb*</label>
<input type="text" name="suburb" size="25" id="suburb" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is your email address? E.G: edgeling@tehinternetz.com</div>
<label for="email">Email Address*</label>
<input type="text" name="email" size="25" id="email" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is your home phone number? (In case of emergency contact).</div>
<label for="phone">Home Phone</label>
<input type="text" name="phone" size="25" id="phone" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is your mobile phone number? (In case of emergency contact).</div>
<label for="mobile">Mobile*</label>
<input type="text" name="mobile" size="25" id="mobile" value="" />
<br /><br />

<label for="spec">Any Special Needs or Requirements?</label>
<textarea type="text" name="spec" rows="3" cols="40" id="spec"></textarea>
<br /><br />

		</fieldset>
</div>

<br />
<div class="rounded">
<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Presenter #2</div>
<fieldset>

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their full name?</div>
<label for="fullname1">Full Name*</label>
<input type="text" name="fullname1" size="25" id="fullname1" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What role will they play in the program?</div>
<label for="role1">Role*</label>
<div id="role1" style="float: left;">
<input type="radio" name="role1" value="Presenter" /> Presenter<br>
<input type="radio" name="role1" value="Panel Operator" /> Panel Operator<br>
<input type="radio" name="role1" value="Producer" /> Producer<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">The course is required to all presenters/panel operators/producers.</div>
<label for="training1">Have They Undertaken The Edge Radio Training Course?*</label>
<div id="training1" style="float: left;">
<input type="radio" name="training1" value="Yes" /> Yes<br>
<input type="radio" name="training1" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Day/Month/Year</div>
<label for="dob1">Date Of Birth*</label>
<input type="text" name="dob1" size="25" id="dob1" value="DD/MM/YYYY" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Required Field.</div>
<label for="student1">Are They A Student?*</label>
<div id="student1" style="float: left;">
<input type="radio" name="student1" value="Yes (University)" /> Yes (University)<br>
<input type="radio" name="student1" value="Yes (TAFE)" /> Yes (TAFE)<br>
<input type="radio" name="student1" value="Yes (Year 11 / Year 12)" /> Yes (Year 11 / Year 12)<br>
<input type="radio" name="student1" value="Yes (Year 10 or Below)" /> Yes (Year 10 or Below)<br>
<input type="radio" name="student1" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Street address.</div>
<label for="ad1">Address*</label>
<input type="text" name="ad1" size="25" id="ad1" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Which suburb do they live in?</div>
<label for="suburb1">Suburb*</label>
<input type="text" name="suburb1" size="25" id="suburb1" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their email address? E.G: edgeling@tehinternetz.com</div>
<label for="email1">Email Address*</label>
<input type="text" name="email1" size="25" id="email1" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their home phone number? (In case of emergency contact).</div>
<label for="phone1">Home Phone</label>
<input type="text" name="phone1" size="25" id="phone1" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their mobile phone number? (In case of emergency contact).</div>
<label for="mobile1">Mobile*</label>
<input type="text" name="mobile1" size="25" id="mobile1" value="" />
<br /><br />

<label for="spec1">Any Special Needs or Requirements?</label>
<textarea type="text" name="spec1" rows="3" cols="40" id="spec1"></textarea>
<br /><br />

		</fieldset>
</div>

<br />
<div class="rounded">
<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Presenter #3</div>
<fieldset>

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their full name?</div>
<label for="fullname2">Full Name*</label>
<input type="text" name="fullname2" size="25" id="fullname2" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What role will they play in the program?</div>
<label for="role2">Role*</label>
<div id="role2" style="float: left;">
<input type="radio" name="role2" value="Presenter" /> Presenter<br>
<input type="radio" name="role2" value="Panel Operator" /> Panel Operator<br>
<input type="radio" name="role2" value="Producer" /> Producer<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">The course is required to all presenters/panel operators/producers.</div>
<label for="training">Have They Undertaken The Edge Radio Training Course?*</label>
<div id="training" style="float: left;">
<input type="radio" name="training" value="Yes" /> Yes<br>
<input type="radio" name="training" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Day/Month/Year</div>
<label for="dob2">Date Of Birth*</label>
<input type="text" name="dob2" size="25" id="dob2" value="DD/MM/YYYY" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Required Field.</div>
<label for="student2">Are They A Student?*</label>
<div id="student2" style="float: left;">
<input type="radio" name="student2" value="Yes (University)" /> Yes (University)<br>
<input type="radio" name="student2" value="Yes (TAFE)" /> Yes (TAFE)<br>
<input type="radio" name="student2" value="Yes (Year 11 / Year 12)" /> Yes (Year 11 / Year 12)<br>
<input type="radio" name="student2" value="Yes (Year 10 or Below)" /> Yes (Year 10 or Below)<br>
<input type="radio" name="student2" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Street address.</div>
<label for="ad2">Address*</label>
<input type="text" name="ad2" size="25" id="ad2" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Which suburb do they live in?</div>
<label for="suburb2">Suburb*</label>
<input type="text" name="suburb2" size="25" id="suburb2" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their email address? E.G: edgeling@tehinternetz.com</div>
<label for="email2">Email Address*</label>
<input type="text" name="email2" size="25" id="email2" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their home phone number? (In case of emergency contact).</div>
<label for="phone2">Home Phone</label>
<input type="text" name="phone1" size="25" id="phone2" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What is their mobile phone number? (In case of emergency contact).</div>
<label for="mobile2">Mobile*</label>
<input type="text" name="mobile2" size="25" id="mobile2" value="" />
<br /><br />

<label for="spec2">Any Special Needs or Requirements?</label>
<textarea type="text" name="spec2" rows="3" cols="40" id="spec2"></textarea>
<br /><br />

		</fieldset>
</div>

        <br />
        
        
        <div class="rounded">

<fieldset>
        
<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Anything else we should know? Have a specific idea or request? Leave it in here.</div>
<label for="notes">Notes/Comments</label>
<textarea type="text" name="notes" rows="8" cols="40" id="notes"></textarea>
<br /><br />
        </fieldset>
     
       </div>
       
<br />
<div class="rounded">
<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Terms and Conditons</div>
<ul>
<li style="padding: 2px;">All Edge Radio presenters are required to pay an annual membership fee member to Tasmanian Youth Broadcasters Inc.</li>
<li style="padding: 2px;">New presenters are required to complete the compulsory basic training course. </li>
<li style="padding: 2px;">If a program is not required at the time of submission (outside of official application periods), the proposal will be placed on a waiting list and prioritised according to future station requirements.</li>
</ul>
<fieldset>

<label for="soo">Do You Agree To Become A Member Of Tasmanian Youth Broadcasters Inc?</label>
<div id="soo" style="float: left;">
<input type="radio" name="soo" value="Yes" /> Yes<br>
<input type="radio" name="soo" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<label for="cop">Have You Read And Understood <a href="http://www.cbaa.org.au/codes" target="_blank">The Community Broadcasting Association of Australia Codes of Practice</a>?</label>
<div id="cop" style="float: left;">
<input type="radio" name="cop" value="Yes" /> Yes<br>
<input type="radio" name="cop" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />

<label for="true">Do you agree that all information provided is true, accurate and up to date?</label>
<div id="true" style="float: left;">
<input type="radio" name="true" value="Yes" /> Yes<br>
<input type="radio" name="true" value="No" /> No<br>
</div>
<div style="clear: both;"></div>
<br />
       
       		</fieldset>
</div>

       
       <br />
       
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Submit Application >>" name="submit" type="submit" />
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

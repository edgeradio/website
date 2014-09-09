<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	<ul class="border-light">
	 <li style="color: #C0C0C0;">1. Introduction</li>
	 <li>2. Contact Details</li>
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

<form  name="form" action="http://www.edgeradio.org.au/programs/training/payment.php" method="post">
<div class="rounded">
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Your Contact Details</div>
		
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
		


<label for="name">Full Name*</label>
<input type="text" name="name" size="45" id="name" value="" />
<br /><br />

<label for="ad">Address*</label>
<input type="text" name="ad1" size="45" id="ad" value="" /><br>
<input type="text" name="ad2" size="45" id="ad" value="" />
<br /><br />

<label for="suburb">Suburb*</label>
<input type="text" name="suburb" size="45" id="suburb" value="" />
<br /><br />

<label for="pcode">Postcode*</label>
<input type="text" name="pcode" size="4" id="pcode" value="" />
<br /><br />

<label for="email">Email Address*</label>
<input type="text" name="email" size="45" id="email" value="" />
<br /><br />

<label for="phone">Phone Number</label>
<input type="text" name="phone" size="45" id="phone" value="" />
<br /><br />

<script>

$(document).ready(function() {
    $("input[name$='status']").click(function() {
        var test = $(this).val();

        $("div.desc").hide();
        $("#status" + test).show();
    });
    $("input[name$='status']").click(function() {
        var test = $(this).val();

        $("div.pr").hide();
        $("#ye" + test).show();
    });
});

</script>
        
<label for="status">Are you a current presenter or a new presenter?*</label>
<div id="status" style="float: left;">
<!-- <input type="radio" name="status" value="1" /> Current Presenter<br> -->
<input type="radio" name="status" value="2" /> New Presenter<br>
<input type="radio" name="status" value="3" /> Not Presenting A Show<br>
</div>
<div style="clear: both;"></div>
<br />

<div id="ye1" style="display: none;" class="pr">
<label for="title">What show do you present?</label>
<select name="program">
<option value="">Select</option>
<?php
mysql_select_db("edge_programs",$db);
 $result = mysql_query("SELECT * FROM program_info ORDER BY title ASC",$db);
  while ($my = mysql_fetch_array($result)) {
  if($my["title"] != 'Edge Tunes') {
  echo'<option value="'.$my["title"].'">'.stripslashes($my["title"]).' ('.$my["day_time"].')</option>';
  }
  }

?>
</select>
</div>
</div>

       
<br />

<div class="rounded">
<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Overview</div>

<div id="status0" class="desc">
<label for="1">Please fill in all details above.</label>
<br><br><br>
</div>


<!-- <div id="status1" style="display: none;" class="desc">
<label for="1">Training Cost:</label>
<div id="1" style="padding: 5px;">$40.00</div>
<hr style="border: 1px solid #000000; height: 1px; background-color: #000000;" size="1">
<label for="1">Total:</label>
<div id="1" style="padding: 5px;">$40.00</div>
</div> -->

<div id="status2" style="display: none;" class="desc">
<label for="1">Training Cost:</label>
<div id="1" style="padding: 5px;">$150.00</div>
<label for="2">TYB Inc Membership:</label>
<div id="2" style="padding: 5px;">$20.00</div>
<label for="2">Edge Studio Access Card:</label>
<div id="2" style="padding: 5px;">$10.00</div>
<hr style="border: 1px solid #000000; height: 1px; background-color: #000000;" size="1">
<label for="1">Total:</label>
<div id="1" style="padding: 5px;">$180.00</div>
</div>

<div id="status3" style="display: none;" class="desc">
<label for="1">Training Cost:</label>
<div id="1" style="padding: 5px;">$150.00</div>
<hr style="border: 1px solid #000000; height: 1px; background-color: #000000;" size="1">
<label for="1">Total:</label>
<div id="1" style="padding: 5px;">$150.00</div>
</div>
    


</div>

       
       <br />
       
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Pay Via PayPal >>" name="submit" type="submit" />
        </form>
        <?php
		 } else {
		 
		 echo'<div class="rounded"><div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Training Is Currently Closed. Sorry.</div></div>';
		 
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

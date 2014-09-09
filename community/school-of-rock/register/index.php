<?php include '../../../templates/common_start.php'; ?>
<body>
<?php include '../../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	<ul class="border-light">
	 <li>1. Contact Details</li>
	 <li style="color: #C0C0C0;">2. Payment</li>
	 <li style="color: #C0C0C0;">3. Confirmation</li>
	 </ul>
	 </div>
    <br />
<div class="rounded-side-new" onclick="location.href='http://www.youtube.com/watch?v=2lUQiOTVnpI';" style="background-image: url(http://www.edgeradio.org.au/images/video-sor.jpg); background-position: center center; cursor: pointer; height: 230px;"></div>
<br />
<img src="http://www.edgeradio.org.au/images/livebroad.png">
    </div>
    <div id="two_column">
     <?php
       $db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_content",$db);
 $result = mysql_query("SELECT * FROM sor_status LIMIT 1",$db);
  while ($myrow = mysql_fetch_array($result)) {
    if($myrow["status"] == 1) {

    ?>
    
    <div class="rounded">
        <h1 class="title-head-right">Course Summary</h1>
        <p><b>Course Fee:</b> $150</p>
<p><b>Who can participate?</b> Students aged between 14 and 18 years of age.</p>
<p><b>Dates:</b> June 12th - 15th, 2012.</p>
        </div>
        
        <br />

<form  name="form" action="http://www.edgeradio.org.au/community/school-of-rock/register/payment.php" method="post">
<div class="rounded">
        <h1 class="title-head-right">Your Contact Details</h1>
		
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

<label for="age">Age*</label>
<input type="text" name="age" size="2" id="age" value="" />
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

</div>

       

       
       <br />
       
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #FFFFFF; color: #000000; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Pay Via PayPal >>" name="submit" type="submit" />
        </form>
        <?php
		 } else {
		 
		 echo'<div class="rounded"><div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">School Of Rock Applications Currently Closed. Sorry.</div></div>';
		 
		 }
    }
		?>
      <div id="footer">
        <?php include '../../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../../templates/common_end.php'; ?>

<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
  <div id="left_column">
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
    
     <div style="height: 400px; background-image: url(../carboot.jpg); background-repeat: no-repeat; background-color: #000000;" class="roundednew">
  
 </div>
    <br />

      
      <div class="rounded" style="background-color: #000000; color: #FFFFFF;">
        <h1 style="font-size: 48px;" class="title">register yo car!</h1>
        
        
        <?php
        
        
        if($_POST['submitted']) {
        
        
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $postcode = $_POST['postcode'];
        $numberplate = $_POST['numberplate'];
        $selling = $_POST['selling'];
        $mobile = $_POST['mono'];
        
        $message .= "
        Name: ".$name."\n
        Email: ".$email."\n
        Postcode: ".$postcode."\n
        Number Plate: ".$numberplate."\n
        Items The Vendor Will Be Selling: ".$selling."\n
        Mobile Number: ".$mobile."\n
";
        

// Send
mail('webguy@edgeradio.org.au,manager@edgeradio.org.au,sponsor@edgeradio.org.au', 'New Car Boot Sale Submission', $message);

        echo'<p>Thanks for registering your car, see you on the day!</p><br><br>';
        
        
        ?>
        
        
        
        
        <?php
        
        } else {
        
        
        ?>
        
        	<style>
fieldset {
  padding: 1em;
  border: 0px;
  font: 12px sans-serif;
  }
label {
  float:left;
  padding: 5px; 
  width:200px;
  margin-right:10px;
  padding-top:5px;
  text-align:right;
  font-weight:bold;
  }
</style>

<form enctype="multipart/form-data" action="index.php" method="post">
		
		<fieldset>

<label for="name">Full Name</label>
<input type="text" name="name" size="50" id="name" value="" />
<br /><br />

<label for="email">Email Address</label>
<input type="text" name="email" size="50" id="email" value="" />
<br /><br />

<label for="postcode">Postcode</label>
<input type="text" name="postcode" size="4" id="postcode" value="" />
<br /><br />

<label for="numberplate">Numberplate</label>
<input type="text" name="numberplate" size="6" id="numberplate" value="" />
<br /><br />

<label for="selling">Items You Will Be Selling<br><small>Give us a few examples of items!</small></label>
<input type="text" name="selling" size="50" id="selling" value="" />
<br /><br />

<label for="mono">Mobile Number</label>
<input type="text" name="mono" size="25" id="mono" value="" />
<br /><br />
<br /><br />

<p>$10 should be payed on the day in cash to the Edge Staff on site. Other payment methods (credit card, debit card) are available by calling our office.</p>
<br>

  <input style="height: 50px; width: 200px; border: 0px; font-size: 28px; background-color: #FFFFFF; color: #000000; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Submit!" name="submit" type="submit" />
  <input type="hidden" name="submitted" value="TRUE" />


</fieldset>
</form>

<?php
}

?>
        
        
     
      
        </div>
     
   
   <div id="footer">
        <?php include '../../inc/footer.php'; ?>
      </div>
      
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

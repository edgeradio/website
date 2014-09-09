<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	 <ul class="border-light">
	 <li>1. Packages</li>
	 <li style="color: #C0C0C0;">2. Details</li>
	 <li style="color: #C0C0C0;">3. Payment</li>
	 <li style="color: #C0C0C0;">4. Confirmation</li>
	 </ul>
	 </div>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
<form action="http://www.edgeradio.org.au/supporter/signup/details.php" method="post" onSubmit="return checkForm(this);">
<div class="rounded">
        <div style="padding: 20px 0 20px 0; color: #FF0000; float: right; font-size: 48px;" class="title">$16</div>
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title"><label><input style="height: 30px;" value="0.01" name="subscription" type="radio" /> Under 18 / Concession</label></div>
		<p>Perfect for those little edgelings and concession card holders wanting to support Edge Radio! Please note that proof of age or concession card is required.</p>
</div>
<br />
<div class="rounded">
        <div style="padding: 20px 0 20px 0; color: #FF0000; float: right; font-size: 48px;" class="title">$35</div>
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title"><label><input style="height: 30px;" value="35" name="subscription" type="radio" /> Love Ya Lots</label></div>
		<p>Love what we do in the community, on-air and off-air? This is the one for you!</p>
</div>
<br />
<div class="rounded">
        <div style="padding: 20px 0 20px 0; color: #FF0000; float: right; font-size: 48px;" class="title">$100</div>
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title"><label><input style="height: 30px;" value="100" name="subscription" type="radio" /> I'm Passionate</label></div>
		<p>Do you love Edge Radio so much that you want to wear it? Choose this option and recieve your very own EDGE TEE!</p>
</div>
<br />
<div class="rounded">
        <div style="padding: 20px 0 20px 0; color: #FF0000; float: right; font-size: 48px;" class="title">$1,000</div>
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title"><label><input style="height: 30px;" value="1000" name="subscription" type="radio" /> Just Can't Get Enough (10 years)</label></div>
		<p>For those who crave Edge Radio for breakfast, lunch and dinner. Includes $650 tax deductible donation and your very own EDGE TEE!</p>
</div>
<br />
<div class="rounded">
        <div style="padding: 20px 0 20px 0; color: #FF0000; float: right; font-size: 48px;" class="title">$3,000</div>
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title"><label><input style="height: 30px;" value="3000" name="subscription" type="radio" /> My Heart Belongs To Edge (Life)</label></div>
		<p>For those who want a life long relationship with Edge! Includes $1950 tax deductible donation and your very own EDGE TEE!</p>
</div>
        <br />
        <script>
        function checkForm(form)
  {
        if (!$("input[name='subscription']:checked").val()) {
   alert('Oh! You need to select a package!');
   return false;
}
}
        </script>
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Continue >>" name="submit" type="submit" />
        </form>
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

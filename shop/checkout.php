<?php

// jCart v1.3
// http://conceptlogic.com/jcart/

// This file demonstrates a basic checkout page

// If your page calls session_start() be sure to include jcart.php first
include_once('jcart/jcart.php');

session_start();
?>
<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
     <div class="roundednew">
      <ul class="border-light">
	 <li><a href="http://www.edgeradio.org.au/shop/">Shop Home</a></li>
	 <li><a href="http://www.edgeradio.org.au/shop/checkout.php">Checkout</a></li>
	 </ul>
	</div>
	<br>
     <div class="roundednew">
	 <div class="title-head-sidebar">Explore</div>
	 <ul class="border-light">
	 <li><a href="http://www.edgeradio.org.au/shop/?cat=apparel">Apparel</a></li>
	 <li><a href="http://www.edgeradio.org.au/shop/?cat=fun">Fun Things</a></li>
	 </ul>
	 </div>
    <br />
<?php include '../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
   <div style="background-image: url(../images/sale_banner.png); width: 737px; height: 240px;" class="roundednew">
 </div>
 <br />
 <div class="roundednew">
  <h1 class="title-head-right">Edge Shop - Checkout</h1>
 
		<link rel="stylesheet" type="text/css" media="screen, projection" href="style.css" />

		<link rel="stylesheet" type="text/css" media="screen, projection" href="jcart/css/jcart.css" />
	
				<div id="jcart">
				<script type="text/javascript">

function theChecker()
{ 
if(document.theForm.theCheck.checked==false)
{
document.theForm.jcartPaypalCheckout.disabled=true;
}
else
{
document.theForm.jcartPaypalCheckout.disabled=false;
}
}
</script>
				
				<?php $jcart->display_cart();?></div>

				<p><a href="index.php">&larr; Continue shopping</a></p>

				<?php
					//echo '<pre>';
					//var_dump($_SESSION['jcart']);
					//echo '</pre>';
				?>
			</div>

			<div class="clear"></div>

    <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>

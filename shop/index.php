<?php

// jCart v1.3
// http://conceptlogic.com/jcart/

// This file demonstrates a basic store setup

// If your page calls session_start() be sure to include jcart.php first
include_once('jcart/jcart.php');

session_start();
?><?php include '../templates/common_start.php'; ?>
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
    <div class="roundednew">
    <div id="jcart"><?php $jcart->display_cart();?></div>
    </div>
    <br />
<?php include '../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
    <div style="background-image: url(../images/sale_banner.png); width: 737px; height: 240px;" class="roundednew">
 </div>
 <br />
 <div class="roundednew">
  <h1 class="title-head-right">Edge Shop</h1>

		<link rel="stylesheet" type="text/css" media="screen, projection" href="style.css" />

		<link rel="stylesheet" type="text/css" media="screen, projection" href="jcart/css/jcart.css" />

		<?php
		
		if($_GET['cat'] == 'apparel' || !$_GET['cat']) {
		
		?>

			<div id="content">

				<form method="post" action="" class="jcart">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="NEWTEE" />
						<input type="hidden" name="my-item-name" value="Edge Radio Squiggle Tee" />
						<input type="hidden" name="my-item-price" value="14.95" />
						<input type="hidden" name="my-item-url" value="" />
 						<input type="submit" name="my-add-button" value="Add To Cart" class="button" />
 	
 						<a href="../images/squiggle-tee.png"><img title="Click To Enlarge" style="border: 0px; float: left; width: 107px; height: 150px; margin-right: 20px; margin-bottom: 10px;" src="../images/s-squiggle-tee.png"></a>
						<ul>
							<li><span style="color: #000000;" class="title">Edge Radio Squiggle Tee</span></li>
							<li>Price: <b>$14.95</b> (Includes Postage)<br><span style="color: #FF0000;">Was: <s>$29.95</s></span></li>
							<li><p>Features 2011 squiggle design, 100% premium combed cotton, Twin-needle sleeve and bottom hem, and boobs (if worn by a female).</p></li>
							<li>
								<label>Qty: <input type="text" name="my-item-qty" value="1" size="3" /></label>
								<label>Size: 
								<select name="my-item-url">
								<?php
								include'../inc/database.inc.php';
								mysql_select_db("edge_shop") or die(mysql_error());
								$result = mysql_query("SELECT * FROM shop WHERE type='NEWTEE'",$db);
								while ($myrow = mysql_fetch_array($result)) {
								?>
								<option value="<?php echo $myrow['size']; ?>"><?php echo $myrow['size']; ?> (<?php echo $myrow['qty']; ?> Left)</option>
								<?php
								}
								?>
								</select></label>
							</li>
						</ul>

					</fieldset>
				</form>
				
				<form method="post" action="" class="jcart">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="OLDTEE" />
						<input type="hidden" name="my-item-name" value="Edge Radio Classic Tee" />
						<input type="hidden" name="my-item-price" value="14.95" />
						<input type="hidden" name="my-item-url" value="" />
 						<input type="submit" name="my-add-button" value="Add To Cart" class="button" />
 						<a href="../images/edge-classic-tee.png"><img title="Click To Enlarge" style="border: 0px; float: left; width: 107px; height: 150px; margin-right: 20px; margin-bottom: 10px;" src="../images/s-edge-classic-tee.png"></a>
						<ul>
							<li><span style="color: #000000;" class="title">Edge Radio Classic Tee</span></li>
							<li>Price: <b>$14.95</b> (Includes Postage)<br><span style="color: #FF0000;">Was: <s>$29.95</s></span></li>
							<li><p>Features original Edge Radio design for those who remember what street cred really meant!</p></li>
							<li>
								<label>Qty: <input type="text" name="my-item-qty" value="1" size="3" /></label>
								<label>Size: 
								<select name="my-item-url">
								<?php
								include'../inc/database.inc.php';
								mysql_select_db("edge_shop") or die(mysql_error());
								$result = mysql_query("SELECT * FROM shop WHERE type='OLDTEE'",$db);
								while ($myrow = mysql_fetch_array($result)) {
								?>
								<option value="<?php echo $myrow['size']; ?>"><?php echo $myrow['size']; ?> (<?php echo $myrow['qty']; ?> Left)</option>
								<?php
								}
								?>
								</select></label>
							</li>
						</ul>

					</fieldset>
				</form>

				<form method="post" action="" class="jcart">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="HOODIE" />
						<input type="hidden" name="my-item-name" value="Edge Radio Squiggle Hoodie" />
						<input type="hidden" name="my-item-price" value="24.95" />
						<input type="submit" name="my-add-button" value="Add To Cart" class="button" />
						<a href="../images/squiggle-hoodie.png"><img title="Click To Enlarge" style="border: 0px; float: left; width: 107px; height: 150px; margin-right: 20px; margin-bottom: 10px;" src="../images/s-squiggle-hoodie.png"></a>
						<ul>
							<li><span style="color: #000000;" class="title">Edge Radio Squiggle Hoodie</span></li>
							<li>Price: <b>$24.95</b> (Includes Postage)<br><span style="color: #FF0000;">Was: <s>$49.95</s></span></li>
							<li><p>Features 2011 squiggle design, 100% polyester polyfleece, Drawstring in hood and added warm fuzzy feeling.</p></li>
							<li>
								<label>Qty: <input type="text" name="my-item-qty" value="1" size="3" /></label>
								<label>Size: 
								<select name="my-item-url">
								<?php
								include'../inc/database.inc.php';
								mysql_select_db("edge_shop") or die(mysql_error());
								$result = mysql_query("SELECT * FROM shop WHERE type='HOODIE'",$db);
								while ($myrow = mysql_fetch_array($result)) {
								?>
								<option value="<?php echo $myrow['size']; ?>"><?php echo $myrow['size']; ?> (<?php echo $myrow['qty']; ?> Left)</option>
								<?php
								}
								?>
								</select></label>
							</li>
						</ul>

					</fieldset>
				</form>
				
				<?php
				
				} 
				
				if($_GET['cat'] == 'fun' || !$_GET['cat']) {
				
				?>

				<form method="post" action="" class="jcart">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="OLDSTUBBIE" />
						<input type="hidden" name="my-item-name" value="Edge Radio Classic Stubbie Holder" />
						<input type="hidden" name="my-item-price" value="3.95" />
						<input type="submit" name="my-add-button" value="Add To Cart" class="button" />
						<a href="old_stub.jpg"><img title="Click To Enlarge" style="border: 0px; float: left; width: 94px; height: 100px; margin-right: 20px; margin-bottom: 10px;" src="old_stub.jpg"></a>
						<ul>
							<li><span style="color: #000000;" class="title">Edge Radio Classic Stubbie Holder</span></li>
							<li>Price: <b>$3.95</b> (Includes Postage)<br><span style="color: #FF0000;">Was: <s>$7.95</s></span></li>
							<li><p>For keeping drinks cold and arms warm since 2003!</p></li>
							<li>
								<label>Qty: <input type="text" name="my-item-qty" value="1" size="3" /></label>
							</li>
						</ul>
					</fieldset>
				</form>
				
				<form method="post" action="" class="jcart">
					<fieldset>
						<input type="hidden" name="jcartToken" value="<?php echo $_SESSION['jcartToken'];?>" />
						<input type="hidden" name="my-item-id" value="NEWSTUBBIE" />
						<input type="hidden" name="my-item-name" value="Edge Radio Squiggle Stubbie Holder" />
						<input type="hidden" name="my-item-price" value="3.95" />
						<input type="submit" name="my-add-button" value="Add To Cart" class="button" />
						<a href="new_stub.jpg"><img title="Click To Enlarge" style="border: 0px; float: left; width: 94px; height: 100px; margin-right: 20px; margin-bottom: 10px;" src="new_stub.jpg"></a>
						<ul>
							<li><span style="color: #000000;" class="title">Edge Radio Squiggle Stubbie Holder</span></li>
							<li>Price: <b>$3.95</b> (Includes Postage)<br><span style="color: #FF0000;">Was: <s>$7.95</s></span></li>
							<li><p>2011 squiggle design stubbie holder includes free bottom to keep drinks from escaping.</p></li>
							<li>
								<label>Qty: <input type="text" name="my-item-qty" value="1" size="3" /></label>
							</li>
						</ul>
					</fieldset>
				</form>
				
				<?php 
				
				}
				
				?>
			

				<div class="clear"></div>

	

				<?php
					//echo '<pre>';
					//var_dump($_SESSION['jcart']);
					//echo '</pre>';
				?>
			</div>
			
				<script type="text/javascript" src="jcart/jquery-1.3.2.min.js"></script>
<!--
		<script type="text/javascript" src="jcart/jcart-javascript.min.php"></script>
-->
    <script type="text/javascript" src="jcart/jcart-javascript.php"></script>

			<div class="clear"></div>
	
	<script type="text/javascript" src="jcart/js/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="jcart/js/jcart.min.js"></script>

</div> 
        
      <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../templates/common_end.php'; ?>

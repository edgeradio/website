<?php include '../templates/common_start.php'; ?>
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
 mysql_select_db('edge_shop'); 
    ?>
          </div>
    <div id="two_column">
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'edit')
 {

if (isset($_POST['submitted'])) {

mysql_select_db('edge_shop'); 

$id = $_POST['id'];
$qty = $_POST['qty'];

 $query1 = "UPDATE shop SET qty='$qty' WHERE id = '$id'";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo "<p><strong>Success!</strong><br><a href=\"shop-manager.php\">Return</a>";
  echo mysql_error();
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
 } else {
 
  $id = $_GET['id'];
$inforesult = mysql_query("SELECT * FROM shop WHERE id = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="shop-manager.php?do=edit&id=<?php print $id ?>" method="post">
 <h1 class="greyheader">EDIT SHOP ITEM</h1>
 <table cellpadding="2" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Quantity</b></td>
	<td><input name="qty" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo $info['qty']; ?>" /></td>
	</tr>
  </table>
  <br>
 <p>
  <input type="submit" style="border:solid 1px #990000;" name="submit" value="Submit Changes" />
<input type="hidden" name="submitted" value="TRUE" /><input type="hidden" name="id" value="<?php echo $id; ?>" />
 </p>
</form>
   <?php
   }
   }
 } else {
  
	 ?>
    
    <h1 class="greyheader">SHOP MANAGER</h1>
    <p>Shop Manager fo shizzle.</p>
  	 <table cellpadding="10" cellspacing="0">
<tr>
	<td style="width: 120px;"><b>Id</b></td>
	<td style="width: 120px;"><b>Size</b></td>
	<td style="width: 120px;"><b>Qty</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];
	  	 	
$inforesult = mysql_query("SELECT * FROM shop ORDER BY id DESC",$db);

$count = 0;
while ($info = mysql_fetch_array($inforesult)) {
    if (($count % 2) == 0)
        {
            $bg = "#F2F2F2";        //change this
        }
        else
        {
            $bg = "#FFFFFF";        //and this
        }
?>
<tr style="background-color: <?php echo($bg); ?>;">
<td><?php echo $info['id']; ?></td>
<td><?php echo $info['size']; ?></td>
<td><?php echo $info['qty']; ?></td>
	<td><a href="shop-manager.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>


    <?php
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
<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
     <?php
     
 $userid = $user->data['user_id'];
 mysql_select_db('edge_programs'); 
 $inforesult = mysql_query("SELECT * FROM program_info WHERE presenter_1='$userid' OR presenter_2='$userid' OR presenter_3='$userid'");
$info = mysql_num_rows($inforesult);
if($info || $user->data['group_id'] == 5) {

?>

       <div id="left_column">
    <?php
 include'sidebar.php';
 mysql_select_db('edge_website'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenu">
        <ul>
        <li><a href="wo-manager.php?do=add"><span style="font-weight: bold;">+</span> Add Entry</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'add')
 {

if (isset($_POST['submitted'])) {

mysql_select_db('edge_website'); 

$show_id = $_POST['show_id'];
$Description = $_POST['Description'];
date_default_timezone_set('Australia/Hobart');


 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(end_time, '%k:%i:%s') as finish FROM program_info WHERE id='$show_id'");
 while ($info = mysql_fetch_array($inforesult)) {
  $day = strtotime($info['day_time']);
  $end = $info['finish'];
  if($end == '0:00:00') {
   $end = '23:59:59';
   }
  $day = date('Y-m-d', $day);
  $title = $info['title'];
  $product = $day.' '.$end.'';
 }

mysql_select_db('edge_website'); 
 $query1 = "INSERT INTO cup (Date, Title, Description, show_id, expire, Display) VALUES (NOW(), '$title', '$Description', '$show_id', '$product', 'Y')";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo "<p><strong>Success!</strong>";
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }


 echo "</p>";
 } else {
?>
<form enctype="multipart/form-data" action="wo-manager.php?do=add" method="post">
<h1 class="greyheader">This Week On Edge Manager</h1>

 <table cellpadding="5" cellspacing="2">
  <tr>
<td style="width: 100px;"><b>Program</b></td>
	<td>  
 <select name="show_id">
 <?php
  $pid = $user->data['user_id'];
 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT * FROM program_info WHERE presenter_1='$pid' OR presenter_2='$pid' OR presenter_3='$pid'");
 while ($info = mysql_fetch_array($inforesult)) {
 ?>
	<option value="<?php echo $info['id']; ?>"><?php echo $info['title']; ?></option>
	<?php } ?>
	</select>
</td>
	</tr>
   <tr>
	<td style="width: 100px;"><b>Description</b><br><small>Max 240 Characters</small></td>
   <td><input name="Description" maxlength="240" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Information</b></td>
   <td>This entry will expire when your show is on air. This means once your show has aired for this week, this entry will no longer be displayed on the homepage.</td>
   </tr>
  </table>
  <br>

 <p>
  <input type="submit" style="border:solid 1px #990000;" name="submit" value="Submit Item" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
   <?php
   }
 } elseif($_GET['do'] == 'edit') {
  
  
  
  if (isset($_POST['submitted'])) {

mysql_select_db('edge_website'); 

$Description = $_POST['Description'];

$id = $_GET['id'];

 $query1 = "UPDATE cup SET Description='$Description' WHERE id = '$id'";
 $result1 = mysql_query($query1);
 echo mysql_error();
 if($query1) {
  
   echo "<p><strong>Success!</strong></p><p><a href='wo-manager.php'>Return To TWOE Manager</a></p>";
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p><br>";
 } else {
  
  $id = $_GET['id'];
  mysql_select_db('edge_website'); 
$inforesult = mysql_query("SELECT * FROM cup WHERE id = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
 
 $show_id = $info['show_id'];
   $userid = $_SESSION['UserID'];
   mysql_select_db('edge_programs'); 
  $inaresult = mysql_query("SELECT * FROM program_info WHERE id='$show_id' AND presenter_1='$userid' OR presenter_2='$userid' OR presenter_3='$userid'");
 while ($ina = mysql_fetch_array($inaresult)) {
 
?>
<form enctype="multipart/form-data" action="wo-manager.php?do=edit&id=<?php print $id ?>" method="post">
 <h1 class="greyheader">EDIT ENTRY</h1>
 <table cellpadding="2" cellspacing="2">
   <tr>
   <td style="width: 100px;"><b>Description</b><br><small>Max 240 Characters</small></td>
   <td><input name="Description" maxlength="240" style="border:solid 1px #990000;" type="text" size="50" value="<?php echo $info['Description']; ?>" /></td>
   </tr>
  </table>
  <br>
 <p>
  <input type="submit" style="border:solid 1px #990000;" name="submit" value="Submit Changes" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
   <?php
   }
  }
    }
 } else {
  
	 ?>
    
    <h1 class="greyheader">TWOE MANAGER</h1>
    <p>Welcome to the new This Week On Edge (TWOE) Manager. This is where you can add items to the TWOE section on the homepage and listen live popup. Simply add a new entry above, fill out the details and choose which program you would like the TWOE assigned to. And you're away! The entries are automatically taken down once your show has aired.</p>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td><b>Description</b></td>
	<td style="width: 150px;"><b>Program</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];

 $userid = $user->data['user_id'];
mysql_select_db('edge_programs'); 
$inaresult = mysql_query("SELECT * FROM program_info WHERE presenter_1='$userid' OR presenter_2='$userid' OR presenter_3='$userid'");
 while ($ina = mysql_fetch_array($inaresult)) {
  $program = $ina['title'];
  $sid = $ina['id'];
  mysql_select_db('edge_website'); 
$inforesult = mysql_query("SELECT *, DATE_FORMAT(Date, '%D %M %Y') as Date FROM cup WHERE show_id='$sid' ORDER BY Date DESC",$db);
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
<td><?php echo $info['Description']; ?></td>
<td><?php echo $program; ?></td>
<td><a href="wo-manager.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit</a></td>
</tr>
<?php
$count++;
}
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
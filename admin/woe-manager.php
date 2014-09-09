<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
     <?php
    if($user->data['group_id'] == 1)
{
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
        <li><a href="woe-manager.php?do=add"><span style="font-weight: bold;">+</span> Add Entry</a></li>
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
<form enctype="multipart/form-data" action="woe-manager.php?do=add" method="post">
<h1 class="greyheader">This Week On Edge Manager</h1>

 <table cellpadding="5" cellspacing="2">
  <tr>
<td style="width: 100px;"><b>Program</b></td>
	<td>  
 <select name="show_id">
 <?php
 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT * FROM program_info WHERE edgetunes='0' ORDER BY day_time DESC");
 while ($info = mysql_fetch_array($inforesult)) {
 ?>
	<option value="<?php echo $info['id']; ?>"><?php echo $info['title']; ?> (<?php echo $info['day_time']; ?>)</option>
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
  
   echo "<p><strong>Success!</strong></p><p><a href='woe-manager.php'>Return To TWOE Manager</a></p>";
  
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
  $inaresult = mysql_query("SELECT * FROM program_info WHERE id='$show_id'");
 while ($ina = mysql_fetch_array($inaresult)) {
 
?>
<form enctype="multipart/form-data" action="woe-manager.php?do=edit&id=<?php print $id ?>" method="post">
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
 } elseif($_GET['do'] == 'delete') {
   $ida = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM cup WHERE id='$ida'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">TWOE MANAGER</h1>
   <p>Successfully deleted TWOE Entry!</p>';
   echo "<meta http-equiv='refresh' content='=2;woe-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">TWOE MANAGER</h1>
   <p>Uh, crap. That entry didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;woe-manager.php' />";
    }
 } else {
  
	 ?>
    
    <h1 class="greyheader">TWOE MANAGER</h1>
    <p>Welcome to the new This Week On Edge (TWOE) Manager. This is where you can add items to the TWOE section on the homepage and listen live popup. Simply add a new entry above, fill out the details and choose which program you would like the TWOE assigned to. And you're away! The entries are automatically taken down once your show has aired.</p>
    <p><font color="#339966">Green</font> = Currently being displayed</p>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td><b>Description</b></td>
	<td style="width: 150px;"><b>Program</b></td>
	<td style="width: 70px;"><b>Expire</b></td>
	<td style="width: 50px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];



 $myquery = "SELECT COUNT(*) as num FROM cup ORDER BY expire DESC";
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "woe-manager.php";
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
$inforesult = mysql_query("SELECT *, DATE_FORMAT(Date, '%D %M %Y') as Date FROM cup ORDER BY expire DESC, Date DESC LIMIT $start, $limit",$db);

$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM cup ORDER BY expire DESC"),0);	


$count = 0;
while ($info = mysql_fetch_array($inforesult)) {
 
 $now = date("Y-m-d H:i:s");
 if($now < $info['expire']) {
  $bg = "#D4FFAA"; 
  } else {
    if (($count % 2) == 0)
        {
            $bg = "#F2F2F2";        //change this
        }
        else
        {
            $bg = "#FFFFFF";        //and this
        }
        }
?>
<tr style="background-color: <?php echo($bg); ?>;">
<td><?php echo $info['Description']; ?></td>
<td><?php echo $info['Title']; ?></td>
<td><?php echo $info['expire']; ?></td>
<td><a href="woe-manager.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit</a><br>
<a href="woe-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>


<?php 
    if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;



	if($lastpage > 1)
	{	
		//previous button
		if ($page > 1) 
			$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$prev\"><< Previous</a> ";
	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;' >$counter</span> ";
				else
					$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lastpage\">$lastpage</a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=1\">1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=2\">2</a> ";
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</b> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lastpage\">$lastpage</a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=1\">1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=2\">2</a> ";
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$next\">Next >></a>";
		
	}
	?>
	<?=$pagination?>
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
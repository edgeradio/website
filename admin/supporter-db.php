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
 mysql_select_db('edge_newsletter'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenu">
        <ul>
        <li><a href="supporter-db.php?do=add">Add New Supporter/Subscriber</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'add')
 {

if (isset($_POST['submitted'])) {

mysql_select_db('edge_newsletter'); 

$email = $_POST['email'];


$inforesult = mysql_query("SELECT * FROM subscribers WHERE email = '$email'");
$noof = mysql_num_rows($inforesult);
echo mysql_error();

if($noof == 0) {

 $query1 = "INSERT INTO subscribers (email) VALUES ('$email')";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo "<p><strong>Success!</strong>";
  echo mysql_error();
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }
   
   } else {
   
   echo'<p><strong>Error!</strong><br>Theres a duplicate entry already added with this email address!<br>';
   }

 echo "</p>";
 } else {
?>
<form enctype="multipart/form-data" action="supporter-db.php?do=add" method="post">
<h1 class="greyheader">Add New Subscriber/Supporter</h1>

 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Email</b></td>
	<td><input name="email" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
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

mysql_select_db('edge_newsetter'); 

$id = $_POST['id'];
$email = $_POST['email'];

 $query1 = "UPDATE subscribers SET email='$email' WHERE id = '$id'";
 $result1 = mysql_query($query1);
 echo mysql_error();
 if($query1) {
  
   echo "<p><strong>Success!</strong></p><p><a href='supporter-db.php'>Return To Subscriber Manager</a></p>";
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p><br>";
 } else {
  
  $id = $_GET['id'];
$inforesult = mysql_query("SELECT * FROM subscribers WHERE id = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="supporter-db.php?do=edit&id=<?php print $id ?>" method="post">
 <h1 class="greyheader">EDIT ITEM</h1>
 <table cellpadding="2" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Email</b></td>
	<td><input name="email" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo $info['email']; ?>" /></td>
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
 } elseif($_GET['do'] == 'delete') {
   $bid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM subscribers WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;supporter-db.php' />";
   } else {
    echo'
       <h1 class="greyheader">DELETED!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;supporter-db.php' />";
    }
 } else {
  
	 ?>
    
    <h1 class="greyheader">SUBSCRIBER/SUPPORTER MANAGER</h1>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td style="width: 120px;"><b>ID</b></td>
	<td><b>Email</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];



  $myquery = "SELECT COUNT(*) as num FROM subscribers ORDER BY id DESC";
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "supporter-db.php";
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
$inforesult = mysql_query("SELECT * FROM subscribers WHERE validated = '1' ORDER BY email ASC LIMIT $start, $limit",$db);

$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM subscribers WHERE validated = '1' ORDER BY email ASC"),0);	


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
<td><?php echo $info['email']; ?></td>
	<td><a href="supporter-db.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit</a><br><a href="supporter-db.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
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
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
 mysql_select_db('edge_website'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenu">
        <ul>
        <li><a href="amp-manager.php?do=add"><span style="font-weight: bold;">+</span> Add Amplified Event</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'add')
 {

if (isset($_POST['submitted'])) {

mysql_select_db('edge_website'); 

$Date = ''.$_POST['year'].''.$_POST['month'].''.$_POST['day'].'';

$Title = addslashes($_POST['Title']);
$URL = $_POST['URL'];
$start = $_POST['start'];
$Venue = addslashes($_POST['Venue']);
$Description = addslashes($_POST['Description']);
$Cost = $_POST['Cost'];

 $query1 = "INSERT INTO amplified_events (date, title, url, time, venue, description, cost) VALUES ('$Date', '$Title', '$URL', '$start', '$Venue', '$Description', '$Cost')";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo "<p><strong>Success!</strong>";
  echo mysql_error();
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
 } else {
?>
<form enctype="multipart/form-data" action="amp-manager.php?do=add" method="post">
<h1 class="greyheader">Amplified Presents Manager</h1>

 <table cellpadding="5" cellspacing="2">
  <tr>
<td style="width: 100px;"><b>Date</b></td>
	<td>  
 <select name="month">
	<option value="01">January
	</option><option value="02">February
	</option><option value="03">March
	</option><option value="04">April
	</option><option value="05">May
	</option><option value="06">June
	</option><option value="07">July
	</option><option value="08">August
	</option><option value="09">September
	</option><option value="10">October
	</option><option value="11">November
	</option><option value="12">December

</option></select>
<select name="day">
	<option value="01">1
	</option><option value="02">2
	</option><option value="03">3
	</option><option value="04">4
	</option><option value="05">5
	</option><option value="06">6
	</option><option value="07">7
	</option><option value="08">8
	</option><option value="09">9
	</option><option value="10">10
	</option><option value="11">11
	</option><option value="12">12
	</option><option value="13">13
	</option><option value="14">14
	</option><option value="15">15
	</option><option value="16">16
	</option><option value="17">17
	</option><option value="18">18
	</option><option value="19">19
	</option><option value="20">20
	</option><option value="21">21
	</option><option value="22">22
	</option><option value="23">23
	</option><option value="24">24
	</option><option value="25">25
	</option><option value="26">26
	</option><option value="27">27
	</option><option value="28">28
	</option><option value="29">29
	</option><option value="30">30
	</option><option value="31">31

</option></select>
<select name="year">
	<option value="2010">2010
	</option><option value="2011">2011
	</option><option value="2012">2012
	</option><option value="2013">2013
	</option><option value="2014">2014
	</option><option value="2015">2015
	</option><option value="2016">2016
	</option><option value="2017">2017
	</option><option value="2018">2018
	</option><option value="2019">2019
	</option><option value="2020">2020
</option></select></td>
	</tr>
  <tr>
	<td style="width: 100px;"><b>Title</b></td>
	<td><input name="Title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>URL</b></td>
   <td><input name="URL" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Description</b></td>
   <td><input name="Description" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
   </tr>
      <tr>
	<td style="width: 100px;"><b>Venue</b></td>
   <td><input name="Venue" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Cost</b></td>
   <td><input name="Cost" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Time</b></td>
   <td><input name="start" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
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

$Title = addslashes($_POST['Title']);
$URL = $_POST['URL'];
$start = $_POST['start'];
$Venue = addslashes($_POST['Venue']);
$Description = addslashes($_POST['Description']);
$Cost = $_POST['Cost'];
$id = $_POST['id'];

 $query1 = "UPDATE amplified_events SET title='$Title', url='$URL', time='$start', venue='$Venue', description='$Description', cost='$Cost' WHERE id = '$id'";
 $result1 = mysql_query($query1);
 echo mysql_error();
 if($query1) {
  
   echo "<p><strong>Success!</strong></p><p><a href='amp-manager.php'>Return To Amplified Manager</a></p>";
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p><br>";
 } else {
  
  $id = $_GET['id'];
$inforesult = mysql_query("SELECT * FROM amplified_events WHERE id = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="amp-manager.php?do=edit&id=<?php print $id ?>" method="post">
 <h1 class="greyheader">EDIT AMPLIFIED ITEM</h1>
 <table cellpadding="2" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Title</b></td>
	<td><input name="Title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo $info['title']; ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>URL</b></td>
   <td><input name="URL" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo $info['url']; ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Description #1</b></td>
   <td><input name="Description" style="border:solid 1px #990000;" type="text" size="50" value="<?php echo $info['description']; ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Venue</b></td>
   <td><input name="Venue" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo $info['venue']; ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Time</b></td>
   <td><input name="start" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo $info['time']; ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Cost</b></td>
   <td><input name="Cost" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo $info['cost']; ?>" /></td>
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
   $deletequery = mysql_query("DELETE FROM amplified_events WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;amp-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">DELETED!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;amp-manager.php' />";
    }
 } else {
  
	 ?>
    
    <h1 class="greyheader">AMPLIFIED EVENTS MANAGER</h1>
    <p>For Amplified Week. Coded under stress and love, so be nice to it :).</p>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td style="width: 120px;"><b>Date</b></td>
	<td><b>Title</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];



  $myquery = "SELECT COUNT(*) as num FROM amplified_events ORDER BY id DESC";
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "amp-manager.php";
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
$inforesult = mysql_query("SELECT *, DATE_FORMAT(date, '%D %M %Y') as date FROM amplified_events ORDER BY id DESC, date DESC LIMIT $start, $limit",$db);

$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM amplified_events ORDER BY id DESC"),0);	


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
<td><?php echo $info['date']; ?></td>
<td><?php echo $info['title']; ?></td>
	<td><a href="amp-manager.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit</a><br><a href="amp-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
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
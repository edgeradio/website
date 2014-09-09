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
 mysql_select_db('edge_content'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenu">
        <ul>
        <li><a href="gig-manager.php?do=add"><span style="font-weight: bold;">+</span> Add Gig</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'add')
 {

if (isset($_POST['submitted'])) {

mysql_select_db('edge_content'); 

$date = ''.$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'].' '.$_POST['hours'].':'.$_POST['minutes'].':'.$_POST['seconds'].'';

$title = addslashes($_POST['title']);
$website = $_POST['website'];
$facebook = $_POST['facebook'];
$venue = addslashes($_POST['venue']);
$description = addslashes($_POST['description']);
$lineup = $_POST['lineup'];
$sponsor = $_POST['sponsor'];
$user = $user->data['username'];

 $query1 = "INSERT INTO gig_guide (approved, sponsor, title, whenevent, venue, description, lineup, facebook, website, image, user_submitted, date_submitted) VALUES ('true', '$sponsor', '$title', '$date', '$venue', '$description', '$lineup', '$facebook', '$website', '$image', '$user', NOW())";
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
<form enctype="multipart/form-data" action="gig-manager.php?do=add" method="post">
<h1 class="title-head-right">Gig Guide Manager</h1>

 <table cellpadding="5" cellspacing="2">
  <tr>
<td style="width: 100px;"><b>When Is The Event?</b></td>
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
</option></select>

<br>

<select name="hours">
<?php
for ($i=0; $i<=23; $i++)
  {
?>
	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	<?php } ?>
</select>
<select name="minutes">
<?php
for ($i=00; $i<=59; $i++)
  {
?>
	<option value="<?php echo sprintf("%02d", $i); ?>"><?php echo sprintf("%02d", $i); ?></option>
	<?php } ?>
</select>
<select name="seconds">
<?php
for ($i=00; $i<=59; $i++)
  {
?>
	<option value="<?php echo sprintf("%02d", $i); ?>"><?php echo sprintf("%02d", $i); ?></option>
	<?php } ?>
</select></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>Type</b></td>
   <td><select name="sponsor">
   <option value=""></option>
	<option value="sponsor">Sponsor Gig</option>
	<option value="edge">Edge Gig</option>
	</select></td>
   </tr>
  <tr>
	<td style="width: 100px;"><b>Title</b></td>
	<td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>Venue</b></td>
   <td><input name="venue" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Description</b></td>
   <td><input name="description" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
   </tr>
      <tr>
	<td style="width: 100px;"><b>Lineup</b></td>
   <td><input name="lineup" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Website</b></td>
   <td><input name="website" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Facebook Event Page</b></td>
   <td><input name="facebook" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
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
 } elseif($_GET['do'] == 'delete') {
   $bid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM gig_guide WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;gig-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">DELETED!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;gig-manager.php' />";
    }
 } elseif($_GET['do'] == 'approve') {
   $bid = $_GET['id'];
   $deletequery = mysql_query("UPDATE gig_guide SET approved='true' WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">YO!</h1>
   <p>Successfully approved post!</p>';
   echo "<meta http-equiv='refresh' content='=2;gig-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">ERM!</h1>
   <p>Uh, crap. That didnt approve for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;gig-manager.php' />";
    }
 } else {
  
	 ?>
    
    <h1 class="title-head-right">GIG GUIDE MANAGER</h1>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td><b>Title</b></td>
	<td><b>Type</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];



  $myquery = "SELECT COUNT(*) as num FROM gig_guide ORDER BY date_submitted DESC";
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "gig-manager.php";
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
$inforesult = mysql_query("SELECT *FROM gig_guide ORDER BY id DESC, date_submitted DESC LIMIT $start, $limit",$db);

$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM gig_guide ORDER BY id DESC"),0);	


$count = 0;
while ($info = mysql_fetch_array($inforesult)) {

if(!$info['approved']) {

if (($count % 2) == 0)
        {
            $bg = "#CCFFCC";        //change this
        }
        else
        {
            $bg = "#99FF99";        //and this
        } 

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
<td><?php echo $info['title']; ?><br><?php echo $info['whenevent']; ?></td>
<td><?php echo $info['sponsor']; ?></td>
	<td>
	<?php
	if(!$info['approved']) {
	?>
	<a href="gig-manager.php?do=approve&id=<?php echo $info['id']; ?>" style="color: #006600; font-weight: bold; text-decoration: none;">Approve Gig</a>
	<?php
	}
	?>
	
	<a href="gig-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
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
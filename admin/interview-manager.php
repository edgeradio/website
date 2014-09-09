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
 mysql_select_db('edge_content'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenuadmin">
        <ul>
        <li><a href="interview-manager.php">View All Interviews</a></li>
        <li><a href="interview-manager.php?do=add"><span style="font-weight: bold;">+</span> Add New Interview</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'add')
 {

if (isset($_POST['submitted'])) {

mysql_select_db('edge_content'); 

$dates = ''.$_POST['year-s'].''.$_POST['month-s'].''.$_POST['day-s'].'';
$datee = ''.$_POST['year-e'].''.$_POST['month-e'].''.$_POST['day-e'].'';

$name = addslashes($_POST['name']);
$url = $_POST['url'];
$description = addslashes($_POST['description']);
$notes = addslashes($_POST['notes']);
$status = 'available';

 $query1 = "INSERT INTO interviews (name, description, url, date_start, date_end, extra_notes, status) VALUES ('$name', '$description', '$url', '$dates', '$datee', '$notes', '$status')";
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
<form enctype="multipart/form-data" action="interview-manager.php?do=add" method="post">
<h1 class="title-head-right">Add New Interview</h1>

<?php

$day = date("d");
$month = date("m");
$year = date("Y");

?>

 <table cellpadding="5" cellspacing="2">
  <tr>
<td style="width: 100px;"><b>Date Available</b></td>
	<td>  
 <select name="month-s">
	<option <?php if($month == '01') { echo'selected="selected"'; } ?>value="01">January
	</option><option <?php if($month == '02') { echo'selected="selected"'; } ?>value="02">February
	</option><option <?php if($month == '03') { echo'selected="selected"'; } ?>value="03">March
	</option><option <?php if($month == '04') { echo'selected="selected"'; } ?>value="04">April
	</option><option <?php if($month == '05') { echo'selected="selected"'; } ?>value="05">May
	</option><option <?php if($month == '06') { echo'selected="selected"'; } ?>value="06">June
	</option><option <?php if($month == '07') { echo'selected="selected"'; } ?>value="07">July
	</option><option <?php if($month == '08') { echo'selected="selected"'; } ?>value="08">August
	</option><option <?php if($month == '09') { echo'selected="selected"'; } ?>value="09">September
	</option><option <?php if($month == '10') { echo'selected="selected"'; } ?>value="10">October
	</option><option <?php if($month == '11') { echo'selected="selected"'; } ?>value="11">November
	</option><option <?php if($month == '12') { echo'selected="selected"'; } ?>value="12">December

</option></select>
<select name="day-s">
	<option <?php if($day == '01') { echo'selected="selected"'; } ?>value="01">1
	</option><option <?php if($day == '02') { echo'selected="selected"'; } ?>value="02">2
	</option><option <?php if($day == '03') { echo'selected="selected"'; } ?>value="03">3
	</option><option <?php if($day == '04') { echo'selected="selected"'; } ?>value="04">4
	</option><option <?php if($day == '05') { echo'selected="selected"'; } ?>value="05">5
	</option><option <?php if($day == '06') { echo'selected="selected"'; } ?>value="06">6
	</option><option <?php if($day == '07') { echo'selected="selected"'; } ?>value="07">7
	</option><option <?php if($day == '08') { echo'selected="selected"'; } ?>value="08">8
	</option><option <?php if($day == '09') { echo'selected="selected"'; } ?>value="09">9
	</option><option <?php if($day == '10') { echo'selected="selected"'; } ?>value="10">10
	</option><option <?php if($day == '11') { echo'selected="selected"'; } ?>value="11">11
	</option><option <?php if($day == '12') { echo'selected="selected"'; } ?>value="12">12
	</option><option <?php if($day == '13') { echo'selected="selected"'; } ?>value="13">13
	</option><option <?php if($day == '14') { echo'selected="selected"'; } ?>value="14">14
	</option><option <?php if($day == '15') { echo'selected="selected"'; } ?>value="15">15
	</option><option <?php if($day == '16') { echo'selected="selected"'; } ?>value="16">16
	</option><option <?php if($day == '17') { echo'selected="selected"'; } ?>value="17">17
	</option><option <?php if($day == '18') { echo'selected="selected"'; } ?>value="18">18
	</option><option <?php if($day == '19') { echo'selected="selected"'; } ?>value="19">19
	</option><option <?php if($day == '20') { echo'selected="selected"'; } ?>value="20">20
	</option><option <?php if($day == '21') { echo'selected="selected"'; } ?>value="21">21
	</option><option <?php if($day == '22') { echo'selected="selected"'; } ?>value="22">22
	</option><option <?php if($day == '23') { echo'selected="selected"'; } ?>value="23">23
	</option><option <?php if($day == '24') { echo'selected="selected"'; } ?>value="24">24
	</option><option <?php if($day == '25') { echo'selected="selected"'; } ?>value="25">25
	</option><option <?php if($day == '26') { echo'selected="selected"'; } ?>value="26">26
	</option><option <?php if($day == '27') { echo'selected="selected"'; } ?>value="27">27
	</option><option <?php if($day == '28') { echo'selected="selected"'; } ?>value="28">28
	</option><option <?php if($day == '29') { echo'selected="selected"'; } ?>value="29">29
	</option><option <?php if($day == '30') { echo'selected="selected"'; } ?>value="30">30
	</option><option <?php if($day == '31') { echo'selected="selected"'; } ?>value="31">31

</option></select>
<select name="year-s">
	<option value="2010">2010
	</option><option <?php if($year == '2011') { echo'selected="selected"'; } ?>value="2011">2011
	</option><option <?php if($year == '2012') { echo'selected="selected"'; } ?>value="2012">2012
	</option><option <?php if($year == '2013') { echo'selected="selected"'; } ?>value="2013">2013
	</option><option <?php if($year == '2014') { echo'selected="selected"'; } ?>value="2014">2014
	</option><option <?php if($year == '2015') { echo'selected="selected"'; } ?>value="2015">2015
	</option><option <?php if($year == '2016') { echo'selected="selected"'; } ?>value="2016">2016
	</option><option <?php if($year == '2017') { echo'selected="selected"'; } ?>value="2017">2017
	</option><option <?php if($year == '2018') { echo'selected="selected"'; } ?>value="2018">2018
	</option><option <?php if($year == '2019') { echo'selected="selected"'; } ?>value="2019">2019
	</option><option <?php if($year == '2020') { echo'selected="selected"'; } ?>value="2020">2020
</option></select><br>
- Until -<br>
 <select name="month-e">
	<option <?php if($month == '01') { echo'selected="selected"'; } ?>value="01">January
	</option><option <?php if($month == '02') { echo'selected="selected"'; } ?>value="02">February
	</option><option <?php if($month == '03') { echo'selected="selected"'; } ?>value="03">March
	</option><option <?php if($month == '04') { echo'selected="selected"'; } ?>value="04">April
	</option><option <?php if($month == '05') { echo'selected="selected"'; } ?>value="05">May
	</option><option <?php if($month == '06') { echo'selected="selected"'; } ?>value="06">June
	</option><option <?php if($month == '07') { echo'selected="selected"'; } ?>value="07">July
	</option><option <?php if($month == '08') { echo'selected="selected"'; } ?>value="08">August
	</option><option <?php if($month == '09') { echo'selected="selected"'; } ?>value="09">September
	</option><option <?php if($month == '10') { echo'selected="selected"'; } ?>value="10">October
	</option><option <?php if($month == '11') { echo'selected="selected"'; } ?>value="11">November
	</option><option <?php if($month == '12') { echo'selected="selected"'; } ?>value="12">December

</option></select>
<select name="day-e">
	<option <?php if($day == '01') { echo'selected="selected"'; } ?>value="01">1
	</option><option <?php if($day == '02') { echo'selected="selected"'; } ?>value="02">2
	</option><option <?php if($day == '03') { echo'selected="selected"'; } ?>value="03">3
	</option><option <?php if($day == '04') { echo'selected="selected"'; } ?>value="04">4
	</option><option <?php if($day == '05') { echo'selected="selected"'; } ?>value="05">5
	</option><option <?php if($day == '06') { echo'selected="selected"'; } ?>value="06">6
	</option><option <?php if($day == '07') { echo'selected="selected"'; } ?>value="07">7
	</option><option <?php if($day == '08') { echo'selected="selected"'; } ?>value="08">8
	</option><option <?php if($day == '09') { echo'selected="selected"'; } ?>value="09">9
	</option><option <?php if($day == '10') { echo'selected="selected"'; } ?>value="10">10
	</option><option <?php if($day == '11') { echo'selected="selected"'; } ?>value="11">11
	</option><option <?php if($day == '12') { echo'selected="selected"'; } ?>value="12">12
	</option><option <?php if($day == '13') { echo'selected="selected"'; } ?>value="13">13
	</option><option <?php if($day == '14') { echo'selected="selected"'; } ?>value="14">14
	</option><option <?php if($day == '15') { echo'selected="selected"'; } ?>value="15">15
	</option><option <?php if($day == '16') { echo'selected="selected"'; } ?>value="16">16
	</option><option <?php if($day == '17') { echo'selected="selected"'; } ?>value="17">17
	</option><option <?php if($day == '18') { echo'selected="selected"'; } ?>value="18">18
	</option><option <?php if($day == '19') { echo'selected="selected"'; } ?>value="19">19
	</option><option <?php if($day == '20') { echo'selected="selected"'; } ?>value="20">20
	</option><option <?php if($day == '21') { echo'selected="selected"'; } ?>value="21">21
	</option><option <?php if($day == '22') { echo'selected="selected"'; } ?>value="22">22
	</option><option <?php if($day == '23') { echo'selected="selected"'; } ?>value="23">23
	</option><option <?php if($day == '24') { echo'selected="selected"'; } ?>value="24">24
	</option><option <?php if($day == '25') { echo'selected="selected"'; } ?>value="25">25
	</option><option <?php if($day == '26') { echo'selected="selected"'; } ?>value="26">26
	</option><option <?php if($day == '27') { echo'selected="selected"'; } ?>value="27">27
	</option><option <?php if($day == '28') { echo'selected="selected"'; } ?>value="28">28
	</option><option <?php if($day == '29') { echo'selected="selected"'; } ?>value="29">29
	</option><option <?php if($day == '30') { echo'selected="selected"'; } ?>value="30">30
	</option><option <?php if($day == '31') { echo'selected="selected"'; } ?>value="31">31

</option></select>
<select name="year-e">
	<option value="2010">2010
	</option><option <?php if($year == '2011') { echo'selected="selected"'; } ?>value="2011">2011
	</option><option <?php if($year == '2012') { echo'selected="selected"'; } ?>value="2012">2012
	</option><option <?php if($year == '2013') { echo'selected="selected"'; } ?>value="2013">2013
	</option><option <?php if($year == '2014') { echo'selected="selected"'; } ?>value="2014">2014
	</option><option <?php if($year == '2015') { echo'selected="selected"'; } ?>value="2015">2015
	</option><option <?php if($year == '2016') { echo'selected="selected"'; } ?>value="2016">2016
	</option><option <?php if($year == '2017') { echo'selected="selected"'; } ?>value="2017">2017
	</option><option <?php if($year == '2018') { echo'selected="selected"'; } ?>value="2018">2018
	</option><option <?php if($year == '2019') { echo'selected="selected"'; } ?>value="2019">2019
	</option><option <?php if($year == '2020') { echo'selected="selected"'; } ?>value="2020">2020
</option></select></td>
	</tr>
  <tr>
	<td style="width: 100px;"><b>Band/Act/Group/Person/People Wanting To Be Interviewed</b></td>
	<td><input name="name" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>URL</b></td>
   <td><input name="url" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Description</b></td>
   <td><input name="description" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Extra Notes / Special Requirements</b></td>
   <td><input name="notes" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
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
   $deletequery = mysql_query("DELETE FROM interviews WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;interview-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">DELETED!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;interview-manager.php' />";
    }
 } else {
  
	 ?>
	 
	 <h1 class="title-head-right">Interview Applications</h1>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td style="width: 220px;"><b>Dates Available</b></td>
	<td><b>Name</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>

<?php


$inforesult = mysql_query("SELECT *, DATE_FORMAT(date_start, '%D %M %Y') as dates, DATE_FORMAT(date_end, '%D %M %Y') as datee FROM interviews WHERE status = 'booked' ORDER BY id DESC, dates DESC",$db);

while ($info = mysql_fetch_array($inforesult)) {
?>

<tr style="background-color: <?php echo($bg); ?>;">
<td><?php echo $info['dates']; ?> Until <?php echo $info['datee']; ?></td>
<td><?php echo $info['name']; ?><br><small><b>Show:</b> <i><?php 

mysql_select_db("edge_programs",$db);
$id = $info['show_id'];
 $inforesultr = mysql_query("SELECT * FROM program_info WHERE id='$id'");
 while ($infor = mysql_fetch_array($inforesultr)) {
echo $infor['seotitle']; } ?></i><br><b>Notes From Presenter:</b> <i><?php echo $info['presenter_notes']; ?></i></small></td>
	<td><a style="text-decoration: none; font-weight: bold; color: #33B537;" href="mailto:<?php echo $info['email']; ?>">Email Presenter To Confirm</a><br><br>
	<a style="text-decoration: none; color: #FF0000; font-weight: bold;" href="interview-manager.php?do=delete&id=<?php echo $info['id']; ?>">Deny & Delete</a></td>
</tr>


<?php
}
mysql_select_db("edge_content",$db);

?>
</table>

</div>
<br />
<div class="rounded">
    
    <h1 class="title-head-right">All Current Interviews</h1>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td style="width: 220px;"><b>Dates Available</b></td>
	<td><b>Name</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];



  $myquery = "SELECT COUNT(*) as num FROM interviews ORDER BY id DESC";
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "interview-manager.php";
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
$inforesult = mysql_query("SELECT *, DATE_FORMAT(date_start, '%D %M %Y') as dates, DATE_FORMAT(date_end, '%D %M %Y') as datee FROM interviews WHERE status = 'available' ORDER BY id DESC, dates DESC LIMIT $start, $limit",$db);

$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM interviews ORDER BY id DESC"),0);	


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
<td><?php echo $info['dates']; ?> Until <?php echo $info['datee']; ?></td>
<td><?php echo $info['name']; ?><br><small><b>Description:</b> <i><?php echo $info['description']; ?></i><br><b>Extra Notes:</b> <i><?php echo $info['extra_notes']; ?></i></small></td>
	<td><a href="interview-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
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
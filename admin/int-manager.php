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
 mysql_select_db('edge_programs'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenu">
        <ul>
        <li><a href="int-manager.php"><span style="font-weight: bold;">+</span> View All Things</a></li>
        <li><a href="int-manager.php?do=add-track"><span style="font-weight: bold;">+</span> Add Interview To Database</a></li>
      </ul>
      </div>
<br />

    
     <div class="rounded">
<?php
if($_GET['do'] == 'add-track')
 {
 
 if (isset($_POST['submitted'])) {
   
   
date_default_timezone_set('Australia/Hobart');   

mysql_select_db('edge_programs'); 

$date = ''.$_POST['rel-year'].''.$_POST['rel-month'].''.$_POST['rel-day'].'';

$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
$description = addslashes($_POST['description']);
$soundcloud = addslashes($_POST['soundcloud']);

 $query1 = "INSERT INTO interviews (title, date, soundcloud, description) 
 VALUES 
 ('$title', '$date', '$soundcloud', '$description')";
 $result1 = mysql_query($query1);

 if($query1) {
  
echo'<p><strong>Done!</strong><br>';
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
 } else {

?>
<form enctype="multipart/form-data" action="int-manager.php?do=add-track" method="post">
<h1 class="greyheader">Add Interview Track</h1>
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Title</b></td>
	<td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
	<tr>
<td style="width: 100px;"><b>Interview Date</b></td>
	<td>  
 <select name="rel-month">
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
<select name="rel-day">
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
<select name="rel-year">
	<option value="1995">2013
	</option><option value="1996">1995
	</option><option value="1996">1996
	</option><option value="1997">1997
	</option><option value="1998">1998
	</option><option value="1999">1999
	</option><option value="2000">2000
	</option><option value="2001">2001
	</option><option value="2002">2002
	</option><option value="2003">2003
	</option><option value="2004">2004
	</option><option value="2005">2005
	</option><option value="2006">2006
	</option><option value="2007">2007
	</option><option value="2008">2008
	</option><option value="2009">2009
	</option><option value="2010">2010
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
	<td style="width: 100px;"><b>Soundcloud</b></td>
   <td><input name="soundcloud" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Description</b></td>
   <td><textarea name="description" style="border:solid 1px #990000;" rows="4" cols="40"></textarea></td>
   </tr>
  </table>
  <br>
  
  
  
 
 <p>
  <input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Continue >>" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
   <?php
   
   }
 } elseif($_GET['do'] == 'edit') {
 
  if (isset($_POST['submitted'])) {


mysql_select_db('edge_programs'); 

$id = $_POST['id'];

$date = ''.$_POST['rel-year'].''.$_POST['rel-month'].''.$_POST['rel-day'].'';

$title = addslashes($_POST['title']);
$description = addslashes($_POST['description']);
$soundcloud = addslashes($_POST['soundcloud']);

 $query1 = "UPDATE interviews SET title='$title', date='$date', soundcloud='$soundcloud', description='$description' WHERE id='$id'";

 $result1 = mysql_query($query1);

 if($query1) {
  
echo'<p><strong>Done!</strong><br>';
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
 } else {


  $id = $_GET['id'];
$inforesult = mysql_query("SELECT * FROM interviews WHERE id = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="int-manager.php?do=edit" method="post">
<h1 class="greyheader">Edit Interview</h1>
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Title</b></td>
	<td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo $info['title']; ?>" /></td>
	</tr>
	   <tr>
	<td style="width: 100px;"><b>Interview Date</b></td>
   <td><input name="soundcloud" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo $info['date']; ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Soundcloud</b></td>
   <td><input name="soundcloud" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo $info['soundcloud']; ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Description</b></td>
   <td><textarea name="description" style="border:solid 1px #990000;" rows="4" cols="40"><?php echo $info['description']; ?></textarea></td>
   </tr>
  </table>
  <br>
  
  
  
 
 <p>
  <input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Update >>" /><input type="hidden" name="id" value="<?php echo $id; ?>" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
   <?php
   }
   }
 
 } elseif($_GET['do'] == 'delete') {
   $bid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM interviews WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;int-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">OH!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;int-manager.php' />";
    }
 } else {
  
	 ?>
	 

    <h1 class="title-head-right">INTERVIEW MANAGER</h1>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td><b>Title</b></td>
	<td style="width: 110px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];


   $myquery = "SELECT COUNT(*) as num FROM interviews ORDER BY id DESC";
   
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	

	 $targetpage = "int-manager.php";
	 
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	

 
 
$inforesult = mysql_query("SELECT * FROM interviews ORDER BY id DESC LIMIT $start, $limit",$db);
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
<td><?php echo stripslashes($info['title']); ?></td>
	<td>
	<a href="int-manager.php?do=edit&id=<?php echo $info['id']; ?>" style="padding: 2px; color: #FF6600; font-weight: bold; text-decoration: none;">Edit</a> 
	<a href="int-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="padding: 2px; color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
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
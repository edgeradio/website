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
if($info || $user->data['group_id'] == 5 || $user->data['group_id'] == 4) {
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
        <li><a href="presenter-interview.php">View All Interviews</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'book') {
  
  
  if (isset($_POST['submitted'])) {

mysql_select_db('edge_content'); 

$id = $_GET['id'];
$show_id = $_POST['show_id'];
$email = $_POST['email'];
$notes = addslashes($_POST['notes']);
$status = 'booked';

 $query1 = "UPDATE interviews SET show_id='$show_id', email='$email', presenter_notes='$notes', status='$status' WHERE id='$id'";
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
 
 $id = $_GET['id'];
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(date_start, '%D %M %Y') as dates, DATE_FORMAT(date_end, '%D %M %Y') as datee FROM interviews WHERE id = '$id'",$db);

while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="presenter-interview.php?do=book&id=<?php echo $id; ?>" method="post">
<h1 class="title-head-right">Book Interview Confirmation</h1>

<span class="title">Your Interview: <span style="color: #333333;"><?php echo $info['name']; ?></span></span>
<br><br>
<span class="title">Dates Available: <span style="color: #333333;"><?php echo $info['dates']; ?> until <?php echo $info['datee']; ?></span></span>


<br><br>
 <table cellpadding="5" cellspacing="2">
  <tr>
   <tr>
	<td style="width: 200px;"><b>Choose Your Show (Where the interview will take place!)</b></td>
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
	<td style="width: 200px;"><b>Your Email Address (REQUIRED!)</b></td>
   <td><input name="email" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
   </tr>
   <tr>
	<td style="width: 200px;"><b>Extra Notes / Special Requirements</b></td>
   <td><input name="notes" style="border:solid 1px #990000;" type="text" size="50" value="" /></td>
   </tr>
  </table>
  <br>

 <p>
  <input type="submit" style="border:solid 1px #990000;" name="submit" value="Submit Interview" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
<?php
}
}
  
 } else {
  
	 ?>
	 
	 
    <h1 class="title-head-right">Interviews Available</h1>
   
     <div class="top_exp">
  <h1>Be Content Rich</h1>
  <p>Edge Radio offers all programs the chance to interview acts, artists, bands, community groups and much more! Below you will find a list of interviews that are ready to book for your show. Simply click "Book Interview", select your show and wait for a confirmation email! Simple!</p>
  </div>
   <br>
   
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr style="background-color: #000000; color: #FFFFFF;">
	<td><b>Details</b></td>
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
<td><span class="title"><?php echo $info['name']; ?></span><br>
<b>Dates Available:</b> <?php echo $info['dates']; ?> Until <?php echo $info['datee']; ?>
<p><i><?php echo $info['description']; ?></i></p>
<p><i><?php echo $info['extra_notes']; ?></i></p>
</td>
	<td style="width: 120px;"><a href="presenter-interview.php?do=book&id=<?php echo $info['id']; ?>" style="color: #000000; background-color: #3DD43D; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; font-weight: bold; padding: 10px; text-decoration: none;">Book Interview</a></td>
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
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
        <li><a href="program.php?do=add"><b>+</b> Add New Program</a></li>
        <li><a href="program.php?do=addet"><b>+</b> Add Edge Tunes</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'addet')
 {
 ?>
   <h1 class="title-head-right">PROGRAM MANAGER</h1>
  <?php
  if(!empty($_POST['title']) && !empty($_POST['start_time']))
{
	$title = mysql_real_escape_string($_POST['title']);
    $start_time = mysql_real_escape_string($_POST['start_time']);
    $end_time = mysql_real_escape_string($_POST['end_time']);
    $day_time = mysql_real_escape_string($_POST['day_time']);
    
	 $checktimes = mysql_query("SELECT * FROM program_info WHERE start_time = '".$start_time."' AND day_time = '".$day_time."'");
     
    if(mysql_num_rows($checktimes) == 1)
     {
     	echo "<h1>Error</h1>";
        echo "<p>Sorry, that program is overlapping with another program. Please go back and try again.</p>";
     }
     else
     {
     	$registerquery = mysql_query("INSERT INTO program_info (title, edgetunes, start_time, end_time, day_time) VALUES('".$title."', 'true', '".$start_time."', '".$end_time."', '".$day_time."')");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Hoorah, Edge Tunes have been added!</p>
			<p><a href=\"program.php\">Return to programs</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, that failed. Please go back and try again.</p>";    
        }    	
     }
}
else
{
	?>
    <p>Add edge tunes (gap fillers) here.</p>
	<form method="post" action="program.php?do=addet" name="registerform" id="registerform">
		<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Program Title </td>
	<td><input type="text" style="border:solid 1px #990000;" value="Edge Tunes" name="title" id="title" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Start Time<br><small>(24 hr time)</small></td>
	<td><select name="start_time" style="border:solid 1px #990000;" id="start_time" size="1" height="1">
	<option>00:00</option>
	<option>00:30</option>
	<option>01:00</option>
	<option>01:30</option>
	<option>02:00</option>
	<option>02:30</option>
	<option>03:00</option>
	<option>03:30</option>
	<option>04:00</option>
	<option>04:30</option>
	<option>05:00</option>
	<option>05:30</option>
	<option>06:00</option>
	<option>06:30</option>
	<option>07:00</option>
	<option>07:30</option>
	<option>08:00</option>
	<option>08:30</option>
	<option>09:00</option>
	<option>09:30</option>
	<option>10:00</option>
	<option>10:30</option>
	<option>11:00</option>
	<option>11:30</option>
	<option>12:00</option>
	<option>12:30</option>
	<option>13:00</option>
	<option>13:30</option>
	<option>14:00</option>
	<option>14:30</option>
	<option>15:00</option>
	<option>15:30</option>
	<option>16:00</option>
	<option>16:30</option>
	<option>17:00</option>
	<option>17:30</option>
	<option>18:00</option>
	<option>18:30</option>
	<option>19:00</option>
	<option>19:30</option>
	<option>20:00</option>
	<option>20:30</option>
	<option>21:00</option>
	<option>21:30</option>
	<option>22:00</option>
	<option>22:30</option>
	<option>23:00</option>
	<option>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">End Time<br><small>(24 hr time)</small></td>
	<td><select name="end_time" style="border:solid 1px #990000;" id="end_time" size="1" height="1">
	<option>00:00</option>
	<option>00:30</option>
	<option>01:00</option>
	<option>01:30</option>
	<option>02:00</option>
	<option>02:30</option>
	<option>03:00</option>
	<option>03:30</option>
	<option>04:00</option>
	<option>04:30</option>
	<option>05:00</option>
	<option>05:30</option>
	<option>06:00</option>
	<option>06:30</option>
	<option>07:00</option>
	<option>07:30</option>
	<option>08:00</option>
	<option>08:30</option>
	<option>09:00</option>
	<option>09:30</option>
	<option>10:00</option>
	<option>10:30</option>
	<option>11:00</option>
	<option>11:30</option>
	<option>12:00</option>
	<option>12:30</option>
	<option>13:00</option>
	<option>13:30</option>
	<option>14:00</option>
	<option>14:30</option>
	<option>15:00</option>
	<option>15:30</option>
	<option>16:00</option>
	<option>16:30</option>
	<option>17:00</option>
	<option>17:30</option>
	<option>18:00</option>
	<option>18:30</option>
	<option>19:00</option>
	<option>19:30</option>
	<option>20:00</option>
	<option>20:30</option>
	<option>21:00</option>
	<option>21:30</option>
	<option>22:00</option>
	<option>22:30</option>
	<option>23:00</option>
	<option>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Day Of Week </td>
	<td><select name="day_time" style="border:solid 1px #990000;" id="day_time" size="1" height="1">
	<option value="Monday">Monday</option>
	<option value="Tuesday">Tuesday</option>
	<option value="Wednesday">Wednesday</option>
	<option value="Thursday">Thursday</option>
	<option value="Friday">Friday</option>
	<option value="Saturday">Saturday</option>
	<option value="Sunday">Sunday</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Add Edge Tunes" /></td>
</tr>
</table>
	</form>
    
   <?php
}
 
 } elseif($_GET['do'] == 'add')
 {
  ?>
  <h1 class="title-head-right">PROGRAM MANAGER</h1>
  <?php
  if(!empty($_POST['title']) && !empty($_POST['start_time']))
{
	$title = mysql_real_escape_string($_POST['title']);
	$seotitle = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['title']);
    $start_time = mysql_real_escape_string($_POST['start_time']);
    $end_time = mysql_real_escape_string($_POST['end_time']);
    $day_time = mysql_real_escape_string($_POST['day_time']);
    $r_start_time = mysql_real_escape_string($_POST['r_start_time']);
    $r_end_time = mysql_real_escape_string($_POST['r_end_time']);
    $r_day_time = mysql_real_escape_string($_POST['r_day_time']);
    $summary = addslashes($_POST['summary']);
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $p3 = $_POST['p3'];
    
	 $checktitle = mysql_query("SELECT * FROM program_info WHERE title = '".$title."'");
	 $checktimes = mysql_query("SELECT * FROM program_info WHERE start_time = '".$start_time."' AND day_time = '".$day_time."'");
     
     if(mysql_num_rows($checktitle) == 1)
     {
     	echo "<h1>Error</h1>";
        echo "<p>Sorry, that program name is taken. Please go back and try again.</p>";
     }
     elseif(mysql_num_rows($checktimes) == 1)
     {
     	echo "<h1>Error</h1>";
        echo "<p>Sorry, that program is overlapping with another program. Please go back and try again.</p>";
     }
     else
     {
     	$registerquery = mysql_query("INSERT INTO program_info (title, summary, edgetunes, seotitle, start_time, end_time, day_time, r_start_time, r_end_time, r_day_time, presenter_1, presenter_2, presenter_3) VALUES('".$title."', '".$summary."', '0', '".$seotitle."', '".$start_time."', '".$end_time."', '".$day_time."', '".$r_start_time."', '".$r_end_time."', '".$r_day_time."', '".$p1."', '".$p2."', '".$p3."')");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Hoorah, the program has been added. Remember to encourage the presenters of the show to update the page's content!</p>
			<p><a href=\"program.php\">Return to programs</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, that failed. Please go back and try again.</p>";    
        }    	
     }
}
else
{
	?>
    <p>Add a new program here and assign presenters to the program.</p>
	<form method="post" action="program.php?do=add" name="registerform" id="registerform">
		<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Program Title </td>
	<td><input type="text" style="border:solid 1px #990000;" name="title" id="title" size="40" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">5 Word Summary/Description</td>
	<td><input type="text" style="border:solid 1px #990000;" name="summary" id="summary" size="40" /></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Air Date</h1>
     <p>Please choose what date & time the show airs.</p>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Start Time<br><small>(24 hr time)</small></td>
	<td><select name="start_time" style="border:solid 1px #990000;" id="start_time" size="1" height="1">
	<option>00:00</option>
	<option>00:30</option>
	<option>01:00</option>
	<option>01:30</option>
	<option>02:00</option>
	<option>02:30</option>
	<option>03:00</option>
	<option>03:30</option>
	<option>04:00</option>
	<option>04:30</option>
	<option>05:00</option>
	<option>05:30</option>
	<option>06:00</option>
	<option>06:30</option>
	<option>07:00</option>
	<option>07:30</option>
	<option>08:00</option>
	<option>08:30</option>
	<option>09:00</option>
	<option>09:30</option>
	<option>10:00</option>
	<option>10:30</option>
	<option>11:00</option>
	<option>11:30</option>
	<option>12:00</option>
	<option>12:30</option>
	<option>13:00</option>
	<option>13:30</option>
	<option>14:00</option>
	<option>14:30</option>
	<option>15:00</option>
	<option>15:30</option>
	<option>16:00</option>
	<option>16:30</option>
	<option>17:00</option>
	<option>17:30</option>
	<option>18:00</option>
	<option>18:30</option>
	<option>19:00</option>
	<option>19:30</option>
	<option>20:00</option>
	<option>20:30</option>
	<option>21:00</option>
	<option>21:30</option>
	<option>22:00</option>
	<option>22:30</option>
	<option>23:00</option>
	<option>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">End Time<br><small>(24 hr time)</small></td>
	<td><select name="end_time" style="border:solid 1px #990000;" id="end_time" size="1" height="1">
	<option>00:00</option>
	<option>00:30</option>
	<option>01:00</option>
	<option>01:30</option>
	<option>02:00</option>
	<option>02:30</option>
	<option>03:00</option>
	<option>03:30</option>
	<option>04:00</option>
	<option>04:30</option>
	<option>05:00</option>
	<option>05:30</option>
	<option>06:00</option>
	<option>06:30</option>
	<option>07:00</option>
	<option>07:30</option>
	<option>08:00</option>
	<option>08:30</option>
	<option>09:00</option>
	<option>09:30</option>
	<option>10:00</option>
	<option>10:30</option>
	<option>11:00</option>
	<option>11:30</option>
	<option>12:00</option>
	<option>12:30</option>
	<option>13:00</option>
	<option>13:30</option>
	<option>14:00</option>
	<option>14:30</option>
	<option>15:00</option>
	<option>15:30</option>
	<option>16:00</option>
	<option>16:30</option>
	<option>17:00</option>
	<option>17:30</option>
	<option>18:00</option>
	<option>18:30</option>
	<option>19:00</option>
	<option>19:30</option>
	<option>20:00</option>
	<option>20:30</option>
	<option>21:00</option>
	<option>21:30</option>
	<option>22:00</option>
	<option>22:30</option>
	<option>23:00</option>
	<option>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Day Of Week </td>
	<td><select name="day_time" style="border:solid 1px #990000;" id="day_time" size="1" height="1">
	<option value="Monday">Monday</option>
	<option value="Tuesday">Tuesday</option>
	<option value="Wednesday">Wednesday</option>
	<option value="Thursday">Thursday</option>
	<option value="Friday">Friday</option>
	<option value="Saturday">Saturday</option>
	<option value="Sunday">Sunday</option>
</select></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Repeat Date</h1>
     <p>If the show is repeated another day, please select the date/time below, if the show does not repeat, just leave it blank.</p>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Start Time<br><small>(24 hr time)</small></td>
	<td><select name="r_start_time" style="border:solid 1px #990000;" id="r_start_time" size="1" height="1">
	<option></option>
	<option>00:00</option>
	<option>00:30</option>
	<option>01:00</option>
	<option>01:30</option>
	<option>02:00</option>
	<option>02:30</option>
	<option>03:00</option>
	<option>03:30</option>
	<option>04:00</option>
	<option>04:30</option>
	<option>05:00</option>
	<option>05:30</option>
	<option>06:00</option>
	<option>06:30</option>
	<option>07:00</option>
	<option>07:30</option>
	<option>08:00</option>
	<option>08:30</option>
	<option>09:00</option>
	<option>09:30</option>
	<option>10:00</option>
	<option>10:30</option>
	<option>11:00</option>
	<option>11:30</option>
	<option>12:00</option>
	<option>12:30</option>
	<option>13:00</option>
	<option>13:30</option>
	<option>14:00</option>
	<option>14:30</option>
	<option>15:00</option>
	<option>15:30</option>
	<option>16:00</option>
	<option>16:30</option>
	<option>17:00</option>
	<option>17:30</option>
	<option>18:00</option>
	<option>18:30</option>
	<option>19:00</option>
	<option>19:30</option>
	<option>20:00</option>
	<option>20:30</option>
	<option>21:00</option>
	<option>21:30</option>
	<option>22:00</option>
	<option>22:30</option>
	<option>23:00</option>
	<option>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">End Time<br><small>(24 hr time)</small></td>
	<td><select name="r_end_time" style="border:solid 1px #990000;" id="r_end_time" size="1" height="1">
	<option></option>
	<option>00:00</option>
	<option>00:30</option>
	<option>01:00</option>
	<option>01:30</option>
	<option>02:00</option>
	<option>02:30</option>
	<option>03:00</option>
	<option>03:30</option>
	<option>04:00</option>
	<option>04:30</option>
	<option>05:00</option>
	<option>05:30</option>
	<option>06:00</option>
	<option>06:30</option>
	<option>07:00</option>
	<option>07:30</option>
	<option>08:00</option>
	<option>08:30</option>
	<option>09:00</option>
	<option>09:30</option>
	<option>10:00</option>
	<option>10:30</option>
	<option>11:00</option>
	<option>11:30</option>
	<option>12:00</option>
	<option>12:30</option>
	<option>13:00</option>
	<option>13:30</option>
	<option>14:00</option>
	<option>14:30</option>
	<option>15:00</option>
	<option>15:30</option>
	<option>16:00</option>
	<option>16:30</option>
	<option>17:00</option>
	<option>17:30</option>
	<option>18:00</option>
	<option>18:30</option>
	<option>19:00</option>
	<option>19:30</option>
	<option>20:00</option>
	<option>20:30</option>
	<option>21:00</option>
	<option>21:30</option>
	<option>22:00</option>
	<option>22:30</option>
	<option>23:00</option>
	<option>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Day Of Week </td>
	<td><select name="r_day_time" style="border:solid 1px #990000;" id="r_day_time" size="1" height="1">
	<option></option>
	<option value="Monday">Monday</option>
	<option value="Tuesday">Tuesday</option>
	<option value="Wednesday">Wednesday</option>
	<option value="Thursday">Thursday</option>
	<option value="Friday">Friday</option>
	<option value="Saturday">Saturday</option>
	<option value="Sunday">Sunday</option>
</select></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Presenter Info</h1>
     <p>You may assign presenters here who are registered to the website/soapbox. If they are not listed, please ask them to register and provide you with their username.</p>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Presenter #1 </td>
	<td><select name="p1" style="border:solid 1px #990000;" id="p1" size="1" height="1">
	<option selected="selected" value="0"></option>
	<?php
	mysql_select_db('edge_phpb1'); 
	 $uresult1 = mysql_query("SELECT * FROM phpbb_users WHERE group_id != 1 AND group_id != 6");
while ($u = mysql_fetch_array($uresult1)) {
 echo'<option value="'.$u['user_id'].'">'.$u['username'].'</option>';
 }
 mysql_select_db('edge_programs'); 
	?>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Presenter #2 </td>
	<td><select name="p2" style="border:solid 1px #990000;" id="p2" size="1" height="1">
	<option selected="selected" value="0"></option>
	<?php
	mysql_select_db('edge_phpb1'); 
	 $uresult2 = mysql_query("SELECT * FROM phpbb_users WHERE group_id != 1 AND group_id != 6");
while ($u = mysql_fetch_array($uresult2)) {
 echo'<option value="'.$u['user_id'].'">'.$u['username'].'</option>';
 }
 mysql_select_db('edge_programs'); 
	?>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Presenter #3 </td>
	<td><select name="p3" style="border:solid 1px #990000;" id="p3" size="1" height="1">
	<option selected="selected" value="0"></option>
	<?php
	mysql_select_db('edge_phpb1'); 
	 $uresult3 = mysql_query("SELECT * FROM phpbb_users WHERE group_id != 1 AND group_id != 6");
while ($u = mysql_fetch_array($uresult3)) {
 echo'<option value="'.$u['user_id'].'">'.$u['username'].'</option>';
 }
 mysql_select_db('edge_programs'); 
	?>
</select></td>
</tr>
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Add Program" /></td>
</tr>
</table>
	</form>
    
   <?php
}
  
  } elseif($_GET['do'] == 'edit') {
   
     if(!empty($_POST['title']))
{
    $title = mysql_real_escape_string($_POST['title']);
	$seotitle = preg_replace("/[^a-zA-Z0-9\s]/", "", $_POST['title']);
    $start_time = mysql_real_escape_string($_POST['start_time']);
    $end_time = mysql_real_escape_string($_POST['end_time']);
    $day_time = mysql_real_escape_string($_POST['day_time']);
    $r_start_time = mysql_real_escape_string($_POST['r_start_time']);
    $r_end_time = mysql_real_escape_string($_POST['r_end_time']);
    $r_day_time = mysql_real_escape_string($_POST['r_day_time']);
    $summary = addslashes($_POST['summary']);
    $p1 = $_POST['p1'];
    $p2 = $_POST['p2'];
    $p3 = $_POST['p3'];
    
      $uid = $_POST['id'];
     	$registerquery = mysql_query("UPDATE program_info SET title='$title', summary='$summary', seotitle='$seotitle', start_time='$start_time', end_time='$end_time', day_time='$day_time', r_start_time='$r_start_time', r_end_time='$r_end_time', r_day_time='$r_day_time', presenter_1='$p1', presenter_2='$p2', presenter_3='$p3' WHERE id='$uid'");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Woo!</p>
			<p><a href=\"program.php\">Return to programs</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, that failed. Please go back and try again.</p>";    
        }    	
}
else
{
 $id = $_GET['id'];
 $inforesult = mysql_query("SELECT * FROM program_info WHERE id='$id'");
while ($info = mysql_fetch_array($inforesult)) {
 
	?>
	<h1 class="title-head-right">PROGRAM MANAGER</h1>
    <p>If this program requires a name change/time change, you may do so here...</p>
	<form method="post" action="program.php?do=edit" name="registerform" id="registerform">
		<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Program Title </td>
	<td><input type="text" style="border:solid 1px #990000;" value="<?php echo stripslashes($info['title']); ?>" name="title" id="title" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">5 Word Summary/Description</td>
	<td><input type="text" style="border:solid 1px #990000;" value="<?php echo stripslashes($info['summary']); ?>" name="summary" id="summary" /></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Air Date</h1>
     <p>Please choose what date & time the show airs.</p>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Start Time<br><small>(24 hr time)</small></td>
	<td><select name="start_time" style="border:solid 1px #990000;" id="start_time" size="1" height="1">
	<option<?php if($info['start_time'] == '00:00:00') { echo ' selected="selected"'; } ?>>00:00</option>
	<option<?php if($info['start_time'] == '00:30:00') { echo ' selected="selected"'; } ?>>00:30</option>
	<option<?php if($info['start_time'] == '01:00:00') { echo ' selected="selected"'; } ?>>01:00</option>
	<option<?php if($info['start_time'] == '01:30:00') { echo ' selected="selected"'; } ?>>01:30</option>
	<option<?php if($info['start_time'] == '02:00:00') { echo ' selected="selected"'; } ?>>02:00</option>
	<option<?php if($info['start_time'] == '02:30:00') { echo ' selected="selected"'; } ?>>02:30</option>
	<option<?php if($info['start_time'] == '03:00:00') { echo ' selected="selected"'; } ?>>03:00</option>
	<option<?php if($info['start_time'] == '03:30:00') { echo ' selected="selected"'; } ?>>03:30</option>
	<option<?php if($info['start_time'] == '04:00:00') { echo ' selected="selected"'; } ?>>04:00</option>
	<option<?php if($info['start_time'] == '04:30:00') { echo ' selected="selected"'; } ?>>04:30</option>
	<option<?php if($info['start_time'] == '05:00:00') { echo ' selected="selected"'; } ?>>05:00</option>
	<option<?php if($info['start_time'] == '05:30:00') { echo ' selected="selected"'; } ?>>05:30</option>
	<option<?php if($info['start_time'] == '06:00:00') { echo ' selected="selected"'; } ?>>06:00</option>
	<option<?php if($info['start_time'] == '06:30:00') { echo ' selected="selected"'; } ?>>06:30</option>
	<option<?php if($info['start_time'] == '07:00:00') { echo ' selected="selected"'; } ?>>07:00</option>
	<option<?php if($info['start_time'] == '07:30:00') { echo ' selected="selected"'; } ?>>07:30</option>
	<option<?php if($info['start_time'] == '08:00:00') { echo ' selected="selected"'; } ?>>08:00</option>
	<option<?php if($info['start_time'] == '08:30:00') { echo ' selected="selected"'; } ?>>08:30</option>
	<option<?php if($info['start_time'] == '09:00:00') { echo ' selected="selected"'; } ?>>09:00</option>
	<option<?php if($info['start_time'] == '09:30:00') { echo ' selected="selected"'; } ?>>09:30</option>
	<option<?php if($info['start_time'] == '10:00:00') { echo ' selected="selected"'; } ?>>10:00</option>
	<option<?php if($info['start_time'] == '10:30:00') { echo ' selected="selected"'; } ?>>10:30</option>
	<option<?php if($info['start_time'] == '11:00:00') { echo ' selected="selected"'; } ?>>11:00</option>
	<option<?php if($info['start_time'] == '11:30:00') { echo ' selected="selected"'; } ?>>11:30</option>
	<option<?php if($info['start_time'] == '12:00:00') { echo ' selected="selected"'; } ?>>12:00</option>
	<option<?php if($info['start_time'] == '12:30:00') { echo ' selected="selected"'; } ?>>12:30</option>
	<option<?php if($info['start_time'] == '13:00:00') { echo ' selected="selected"'; } ?>>13:00</option>
	<option<?php if($info['start_time'] == '13:30:00') { echo ' selected="selected"'; } ?>>13:30</option>
	<option<?php if($info['start_time'] == '14:00:00') { echo ' selected="selected"'; } ?>>14:00</option>
	<option<?php if($info['start_time'] == '14:30:00') { echo ' selected="selected"'; } ?>>14:30</option>
	<option<?php if($info['start_time'] == '15:00:00') { echo ' selected="selected"'; } ?>>15:00</option>
	<option<?php if($info['start_time'] == '15:30:00') { echo ' selected="selected"'; } ?>>15:30</option>
	<option<?php if($info['start_time'] == '16:00:00') { echo ' selected="selected"'; } ?>>16:00</option>
	<option<?php if($info['start_time'] == '16:30:00') { echo ' selected="selected"'; } ?>>16:30</option>
	<option<?php if($info['start_time'] == '17:00:00') { echo ' selected="selected"'; } ?>>17:00</option>
	<option<?php if($info['start_time'] == '17:30:00') { echo ' selected="selected"'; } ?>>17:30</option>
	<option<?php if($info['start_time'] == '18:00:00') { echo ' selected="selected"'; } ?>>18:00</option>
	<option<?php if($info['start_time'] == '18:30:00') { echo ' selected="selected"'; } ?>>18:30</option>
	<option<?php if($info['start_time'] == '19:00:00') { echo ' selected="selected"'; } ?>>19:00</option>
	<option<?php if($info['start_time'] == '19:30:00') { echo ' selected="selected"'; } ?>>19:30</option>
	<option<?php if($info['start_time'] == '20:00:00') { echo ' selected="selected"'; } ?>>20:00</option>
	<option<?php if($info['start_time'] == '20:30:00') { echo ' selected="selected"'; } ?>>20:30</option>
	<option<?php if($info['start_time'] == '21:00:00') { echo ' selected="selected"'; } ?>>21:00</option>
	<option<?php if($info['start_time'] == '21:30:00') { echo ' selected="selected"'; } ?>>21:30</option>
	<option<?php if($info['start_time'] == '22:00:00') { echo ' selected="selected"'; } ?>>22:00</option>
	<option<?php if($info['start_time'] == '22:30:00') { echo ' selected="selected"'; } ?>>22:30</option>
	<option<?php if($info['start_time'] == '23:00:00') { echo ' selected="selected"'; } ?>>23:00</option>
	<option<?php if($info['start_time'] == '23:30:00') { echo ' selected="selected"'; } ?>>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">End Time<br><small>(24 hr time)</small></td>
	<td><select name="end_time" style="border:solid 1px #990000;" id="end_time" size="1" height="1">
	<option<?php if($info['start_time'] == '00:00:00') { echo ' selected="selected"'; } ?>>00:00</option>
	<option<?php if($info['start_time'] == '00:30:00') { echo ' selected="selected"'; } ?>>00:30</option>
	<option<?php if($info['start_time'] == '01:00:00') { echo ' selected="selected"'; } ?>>01:00</option>
	<option<?php if($info['start_time'] == '01:30:00') { echo ' selected="selected"'; } ?>>01:30</option>
	<option<?php if($info['start_time'] == '02:00:00') { echo ' selected="selected"'; } ?>>02:00</option>
	<option<?php if($info['start_time'] == '02:30:00') { echo ' selected="selected"'; } ?>>02:30</option>
	<option<?php if($info['start_time'] == '03:00:00') { echo ' selected="selected"'; } ?>>03:00</option>
	<option<?php if($info['start_time'] == '03:30:00') { echo ' selected="selected"'; } ?>>03:30</option>
	<option<?php if($info['start_time'] == '04:00:00') { echo ' selected="selected"'; } ?>>04:00</option>
	<option<?php if($info['start_time'] == '04:30:00') { echo ' selected="selected"'; } ?>>04:30</option>
	<option<?php if($info['start_time'] == '05:00:00') { echo ' selected="selected"'; } ?>>05:00</option>
	<option<?php if($info['start_time'] == '05:30:00') { echo ' selected="selected"'; } ?>>05:30</option>
	<option<?php if($info['start_time'] == '06:00:00') { echo ' selected="selected"'; } ?>>06:00</option>
	<option<?php if($info['start_time'] == '06:30:00') { echo ' selected="selected"'; } ?>>06:30</option>
	<option<?php if($info['start_time'] == '07:00:00') { echo ' selected="selected"'; } ?>>07:00</option>
	<option<?php if($info['start_time'] == '07:30:00') { echo ' selected="selected"'; } ?>>07:30</option>
	<option<?php if($info['start_time'] == '08:00:00') { echo ' selected="selected"'; } ?>>08:00</option>
	<option<?php if($info['start_time'] == '08:30:00') { echo ' selected="selected"'; } ?>>08:30</option>
	<option<?php if($info['start_time'] == '09:00:00') { echo ' selected="selected"'; } ?>>09:00</option>
	<option<?php if($info['start_time'] == '09:30:00') { echo ' selected="selected"'; } ?>>09:30</option>
	<option<?php if($info['start_time'] == '10:00:00') { echo ' selected="selected"'; } ?>>10:00</option>
	<option<?php if($info['start_time'] == '10:30:00') { echo ' selected="selected"'; } ?>>10:30</option>
	<option<?php if($info['start_time'] == '11:00:00') { echo ' selected="selected"'; } ?>>11:00</option>
	<option<?php if($info['start_time'] == '11:30:00') { echo ' selected="selected"'; } ?>>11:30</option>
	<option<?php if($info['start_time'] == '12:00:00') { echo ' selected="selected"'; } ?>>12:00</option>
	<option<?php if($info['start_time'] == '12:30:00') { echo ' selected="selected"'; } ?>>12:30</option>
	<option<?php if($info['start_time'] == '13:00:00') { echo ' selected="selected"'; } ?>>13:00</option>
	<option<?php if($info['start_time'] == '13:30:00') { echo ' selected="selected"'; } ?>>13:30</option>
	<option<?php if($info['start_time'] == '14:00:00') { echo ' selected="selected"'; } ?>>14:00</option>
	<option<?php if($info['start_time'] == '14:30:00') { echo ' selected="selected"'; } ?>>14:30</option>
	<option<?php if($info['start_time'] == '15:00:00') { echo ' selected="selected"'; } ?>>15:00</option>
	<option<?php if($info['start_time'] == '15:30:00') { echo ' selected="selected"'; } ?>>15:30</option>
	<option<?php if($info['start_time'] == '16:00:00') { echo ' selected="selected"'; } ?>>16:00</option>
	<option<?php if($info['start_time'] == '16:30:00') { echo ' selected="selected"'; } ?>>16:30</option>
	<option<?php if($info['start_time'] == '17:00:00') { echo ' selected="selected"'; } ?>>17:00</option>
	<option<?php if($info['start_time'] == '17:30:00') { echo ' selected="selected"'; } ?>>17:30</option>
	<option<?php if($info['start_time'] == '18:00:00') { echo ' selected="selected"'; } ?>>18:00</option>
	<option<?php if($info['start_time'] == '18:30:00') { echo ' selected="selected"'; } ?>>18:30</option>
	<option<?php if($info['start_time'] == '19:00:00') { echo ' selected="selected"'; } ?>>19:00</option>
	<option<?php if($info['start_time'] == '19:30:00') { echo ' selected="selected"'; } ?>>19:30</option>
	<option<?php if($info['start_time'] == '20:00:00') { echo ' selected="selected"'; } ?>>20:00</option>
	<option<?php if($info['start_time'] == '20:30:00') { echo ' selected="selected"'; } ?>>20:30</option>
	<option<?php if($info['start_time'] == '21:00:00') { echo ' selected="selected"'; } ?>>21:00</option>
	<option<?php if($info['start_time'] == '21:30:00') { echo ' selected="selected"'; } ?>>21:30</option>
	<option<?php if($info['start_time'] == '22:00:00') { echo ' selected="selected"'; } ?>>22:00</option>
	<option<?php if($info['start_time'] == '22:30:00') { echo ' selected="selected"'; } ?>>22:30</option>
	<option<?php if($info['start_time'] == '23:00:00') { echo ' selected="selected"'; } ?>>23:00</option>
	<option<?php if($info['start_time'] == '23:30:00') { echo ' selected="selected"'; } ?>>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Day Of Week </td>
	<td><select name="day_time" style="border:solid 1px #990000;" id="day_time" size="1" height="1">
	<option<?php if($info['day_time'] == 'Monday') { echo ' selected="selected"'; } ?> value="Monday">Monday</option>
	<option<?php if($info['day_time'] == 'Tuesday') { echo ' selected="selected"'; } ?> value="Tuesday">Tuesday</option>
	<option<?php if($info['day_time'] == 'Wednesday') { echo ' selected="selected"'; } ?> value="Wednesday">Wednesday</option>
	<option<?php if($info['day_time'] == 'Thursday') { echo ' selected="selected"'; } ?> value="Thursday">Thursday</option>
	<option<?php if($info['day_time'] == 'Friday') { echo ' selected="selected"'; } ?> value="Friday">Friday</option>
	<option<?php if($info['day_time'] == 'Saturday') { echo ' selected="selected"'; } ?> value="Saturday">Saturday</option>
	<option<?php if($info['day_time'] == 'Sunday') { echo ' selected="selected"'; } ?> value="Sunday">Sunday</option>
</select></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Repeat Date</h1>
     <p>Please choose what date & time the show repeats.</p>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Start Time<br><small>(24 hr time)</small></td>
	<td><select name="r_start_time" style="border:solid 1px #990000;" id="start_time" size="1" height="1">
	<option<?php if($info['start_time'] == '00:00:00') { echo ' selected="selected"'; } ?>>00:00</option>
	<option<?php if($info['start_time'] == '00:30:00') { echo ' selected="selected"'; } ?>>00:30</option>
	<option<?php if($info['start_time'] == '01:00:00') { echo ' selected="selected"'; } ?>>01:00</option>
	<option<?php if($info['start_time'] == '01:30:00') { echo ' selected="selected"'; } ?>>01:30</option>
	<option<?php if($info['start_time'] == '02:00:00') { echo ' selected="selected"'; } ?>>02:00</option>
	<option<?php if($info['start_time'] == '02:30:00') { echo ' selected="selected"'; } ?>>02:30</option>
	<option<?php if($info['start_time'] == '03:00:00') { echo ' selected="selected"'; } ?>>03:00</option>
	<option<?php if($info['start_time'] == '03:30:00') { echo ' selected="selected"'; } ?>>03:30</option>
	<option<?php if($info['start_time'] == '04:00:00') { echo ' selected="selected"'; } ?>>04:00</option>
	<option<?php if($info['start_time'] == '04:30:00') { echo ' selected="selected"'; } ?>>04:30</option>
	<option<?php if($info['start_time'] == '05:00:00') { echo ' selected="selected"'; } ?>>05:00</option>
	<option<?php if($info['start_time'] == '05:30:00') { echo ' selected="selected"'; } ?>>05:30</option>
	<option<?php if($info['start_time'] == '06:00:00') { echo ' selected="selected"'; } ?>>06:00</option>
	<option<?php if($info['start_time'] == '06:30:00') { echo ' selected="selected"'; } ?>>06:30</option>
	<option<?php if($info['start_time'] == '07:00:00') { echo ' selected="selected"'; } ?>>07:00</option>
	<option<?php if($info['start_time'] == '07:30:00') { echo ' selected="selected"'; } ?>>07:30</option>
	<option<?php if($info['start_time'] == '08:00:00') { echo ' selected="selected"'; } ?>>08:00</option>
	<option<?php if($info['start_time'] == '08:30:00') { echo ' selected="selected"'; } ?>>08:30</option>
	<option<?php if($info['start_time'] == '09:00:00') { echo ' selected="selected"'; } ?>>09:00</option>
	<option<?php if($info['start_time'] == '09:30:00') { echo ' selected="selected"'; } ?>>09:30</option>
	<option<?php if($info['start_time'] == '10:00:00') { echo ' selected="selected"'; } ?>>10:00</option>
	<option<?php if($info['start_time'] == '10:30:00') { echo ' selected="selected"'; } ?>>10:30</option>
	<option<?php if($info['start_time'] == '11:00:00') { echo ' selected="selected"'; } ?>>11:00</option>
	<option<?php if($info['start_time'] == '11:30:00') { echo ' selected="selected"'; } ?>>11:30</option>
	<option<?php if($info['start_time'] == '12:00:00') { echo ' selected="selected"'; } ?>>12:00</option>
	<option<?php if($info['start_time'] == '12:30:00') { echo ' selected="selected"'; } ?>>12:30</option>
	<option<?php if($info['start_time'] == '13:00:00') { echo ' selected="selected"'; } ?>>13:00</option>
	<option<?php if($info['start_time'] == '13:30:00') { echo ' selected="selected"'; } ?>>13:30</option>
	<option<?php if($info['start_time'] == '14:00:00') { echo ' selected="selected"'; } ?>>14:00</option>
	<option<?php if($info['start_time'] == '14:30:00') { echo ' selected="selected"'; } ?>>14:30</option>
	<option<?php if($info['start_time'] == '15:00:00') { echo ' selected="selected"'; } ?>>15:00</option>
	<option<?php if($info['start_time'] == '15:30:00') { echo ' selected="selected"'; } ?>>15:30</option>
	<option<?php if($info['start_time'] == '16:00:00') { echo ' selected="selected"'; } ?>>16:00</option>
	<option<?php if($info['start_time'] == '16:30:00') { echo ' selected="selected"'; } ?>>16:30</option>
	<option<?php if($info['start_time'] == '17:00:00') { echo ' selected="selected"'; } ?>>17:00</option>
	<option<?php if($info['start_time'] == '17:30:00') { echo ' selected="selected"'; } ?>>17:30</option>
	<option<?php if($info['start_time'] == '18:00:00') { echo ' selected="selected"'; } ?>>18:00</option>
	<option<?php if($info['start_time'] == '18:30:00') { echo ' selected="selected"'; } ?>>18:30</option>
	<option<?php if($info['start_time'] == '19:00:00') { echo ' selected="selected"'; } ?>>19:00</option>
	<option<?php if($info['start_time'] == '19:30:00') { echo ' selected="selected"'; } ?>>19:30</option>
	<option<?php if($info['start_time'] == '20:00:00') { echo ' selected="selected"'; } ?>>20:00</option>
	<option<?php if($info['start_time'] == '20:30:00') { echo ' selected="selected"'; } ?>>20:30</option>
	<option<?php if($info['start_time'] == '21:00:00') { echo ' selected="selected"'; } ?>>21:00</option>
	<option<?php if($info['start_time'] == '21:30:00') { echo ' selected="selected"'; } ?>>21:30</option>
	<option<?php if($info['start_time'] == '22:00:00') { echo ' selected="selected"'; } ?>>22:00</option>
	<option<?php if($info['start_time'] == '22:30:00') { echo ' selected="selected"'; } ?>>22:30</option>
	<option<?php if($info['start_time'] == '23:00:00') { echo ' selected="selected"'; } ?>>23:00</option>
	<option<?php if($info['start_time'] == '23:30:00') { echo ' selected="selected"'; } ?>>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">End Time<br><small>(24 hr time)</small></td>
	<td><select name="r_end_time" style="border:solid 1px #990000;" id="r_end_time" size="1" height="1">
	<option<?php if($info['start_time'] == '00:00:00') { echo ' selected="selected"'; } ?>>00:00</option>
	<option<?php if($info['start_time'] == '00:30:00') { echo ' selected="selected"'; } ?>>00:30</option>
	<option<?php if($info['start_time'] == '01:00:00') { echo ' selected="selected"'; } ?>>01:00</option>
	<option<?php if($info['start_time'] == '01:30:00') { echo ' selected="selected"'; } ?>>01:30</option>
	<option<?php if($info['start_time'] == '02:00:00') { echo ' selected="selected"'; } ?>>02:00</option>
	<option<?php if($info['start_time'] == '02:30:00') { echo ' selected="selected"'; } ?>>02:30</option>
	<option<?php if($info['start_time'] == '03:00:00') { echo ' selected="selected"'; } ?>>03:00</option>
	<option<?php if($info['start_time'] == '03:30:00') { echo ' selected="selected"'; } ?>>03:30</option>
	<option<?php if($info['start_time'] == '04:00:00') { echo ' selected="selected"'; } ?>>04:00</option>
	<option<?php if($info['start_time'] == '04:30:00') { echo ' selected="selected"'; } ?>>04:30</option>
	<option<?php if($info['start_time'] == '05:00:00') { echo ' selected="selected"'; } ?>>05:00</option>
	<option<?php if($info['start_time'] == '05:30:00') { echo ' selected="selected"'; } ?>>05:30</option>
	<option<?php if($info['start_time'] == '06:00:00') { echo ' selected="selected"'; } ?>>06:00</option>
	<option<?php if($info['start_time'] == '06:30:00') { echo ' selected="selected"'; } ?>>06:30</option>
	<option<?php if($info['start_time'] == '07:00:00') { echo ' selected="selected"'; } ?>>07:00</option>
	<option<?php if($info['start_time'] == '07:30:00') { echo ' selected="selected"'; } ?>>07:30</option>
	<option<?php if($info['start_time'] == '08:00:00') { echo ' selected="selected"'; } ?>>08:00</option>
	<option<?php if($info['start_time'] == '08:30:00') { echo ' selected="selected"'; } ?>>08:30</option>
	<option<?php if($info['start_time'] == '09:00:00') { echo ' selected="selected"'; } ?>>09:00</option>
	<option<?php if($info['start_time'] == '09:30:00') { echo ' selected="selected"'; } ?>>09:30</option>
	<option<?php if($info['start_time'] == '10:00:00') { echo ' selected="selected"'; } ?>>10:00</option>
	<option<?php if($info['start_time'] == '10:30:00') { echo ' selected="selected"'; } ?>>10:30</option>
	<option<?php if($info['start_time'] == '11:00:00') { echo ' selected="selected"'; } ?>>11:00</option>
	<option<?php if($info['start_time'] == '11:30:00') { echo ' selected="selected"'; } ?>>11:30</option>
	<option<?php if($info['start_time'] == '12:00:00') { echo ' selected="selected"'; } ?>>12:00</option>
	<option<?php if($info['start_time'] == '12:30:00') { echo ' selected="selected"'; } ?>>12:30</option>
	<option<?php if($info['start_time'] == '13:00:00') { echo ' selected="selected"'; } ?>>13:00</option>
	<option<?php if($info['start_time'] == '13:30:00') { echo ' selected="selected"'; } ?>>13:30</option>
	<option<?php if($info['start_time'] == '14:00:00') { echo ' selected="selected"'; } ?>>14:00</option>
	<option<?php if($info['start_time'] == '14:30:00') { echo ' selected="selected"'; } ?>>14:30</option>
	<option<?php if($info['start_time'] == '15:00:00') { echo ' selected="selected"'; } ?>>15:00</option>
	<option<?php if($info['start_time'] == '15:30:00') { echo ' selected="selected"'; } ?>>15:30</option>
	<option<?php if($info['start_time'] == '16:00:00') { echo ' selected="selected"'; } ?>>16:00</option>
	<option<?php if($info['start_time'] == '16:30:00') { echo ' selected="selected"'; } ?>>16:30</option>
	<option<?php if($info['start_time'] == '17:00:00') { echo ' selected="selected"'; } ?>>17:00</option>
	<option<?php if($info['start_time'] == '17:30:00') { echo ' selected="selected"'; } ?>>17:30</option>
	<option<?php if($info['start_time'] == '18:00:00') { echo ' selected="selected"'; } ?>>18:00</option>
	<option<?php if($info['start_time'] == '18:30:00') { echo ' selected="selected"'; } ?>>18:30</option>
	<option<?php if($info['start_time'] == '19:00:00') { echo ' selected="selected"'; } ?>>19:00</option>
	<option<?php if($info['start_time'] == '19:30:00') { echo ' selected="selected"'; } ?>>19:30</option>
	<option<?php if($info['start_time'] == '20:00:00') { echo ' selected="selected"'; } ?>>20:00</option>
	<option<?php if($info['start_time'] == '20:30:00') { echo ' selected="selected"'; } ?>>20:30</option>
	<option<?php if($info['start_time'] == '21:00:00') { echo ' selected="selected"'; } ?>>21:00</option>
	<option<?php if($info['start_time'] == '21:30:00') { echo ' selected="selected"'; } ?>>21:30</option>
	<option<?php if($info['start_time'] == '22:00:00') { echo ' selected="selected"'; } ?>>22:00</option>
	<option<?php if($info['start_time'] == '22:30:00') { echo ' selected="selected"'; } ?>>22:30</option>
	<option<?php if($info['start_time'] == '23:00:00') { echo ' selected="selected"'; } ?>>23:00</option>
	<option<?php if($info['start_time'] == '23:30:00') { echo ' selected="selected"'; } ?>>23:30</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Day Of Week </td>
	<td><select name="r_day_time" style="border:solid 1px #990000;" id="r_day_time" size="1" height="1">
	<option<?php if($info['r_day_time'] == '') { echo ' selected="selected"'; } ?> value=""></option>
	<option<?php if($info['r_day_time'] == 'Monday') { echo ' selected="selected"'; } ?> value="Monday">Monday</option>
	<option<?php if($info['r_day_time'] == 'Tuesday') { echo ' selected="selected"'; } ?> value="Tuesday">Tuesday</option>
	<option<?php if($info['r_day_time'] == 'Wednesday') { echo ' selected="selected"'; } ?> value="Wednesday">Wednesday</option>
	<option<?php if($info['r_day_time'] == 'Thursday') { echo ' selected="selected"'; } ?> value="Thursday">Thursday</option>
	<option<?php if($info['r_day_time'] == 'Friday') { echo ' selected="selected"'; } ?> value="Friday">Friday</option>
	<option<?php if($info['r_day_time'] == 'Saturday') { echo ' selected="selected"'; } ?> value="Saturday">Saturday</option>
	<option<?php if($info['r_day_time'] == 'Sunday') { echo ' selected="selected"'; } ?> value="Sunday">Sunday</option>
</select></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Presenter Info</h1>
     <p>You may assign presenters here who are registered to the website/soapbox. If they are not listed, please ask them to register and provide you with their username.</p>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">


<tr>
	<td style="width: 100px; text-align: right;">Presenter #1 </td>
	<td><select name="p1" style="border:solid 1px #990000;" id="p1" size="1" height="1">
	<?php
mysql_select_db('edge_phpb1');
	 echo'<option value="0"></option>';
	 $uresult1 = mysql_query("SELECT * FROM phpbb_users WHERE group_id != 1 AND group_id != 6");
while ($u = mysql_fetch_array($uresult1)) {
 echo'<option';if($info['presenter_1'] == $u['user_id']) { echo ' selected="selected"'; } echo' value="'.$u['user_id'].'">'.$u['username'].'</option>';
 }
 mysql_select_db('edge_programs'); 
	?>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Presenter #2 </td>
	<td><select name="p2" style="border:solid 1px #990000;" id="p2" size="1" height="1">
	<?php
	mysql_select_db('edge_phpb1');
	 echo'<option value="0"></option>';
	 $uresult2 = mysql_query("SELECT * FROM phpbb_users WHERE group_id != 1 AND group_id != 6");
while ($u = mysql_fetch_array($uresult2)) {
 echo'<option';if($info['presenter_2'] == $u['user_id']) { echo ' selected="selected"'; } echo' value="'.$u['user_id'].'">'.$u['username'].'</option>';
 }
 mysql_select_db('edge_programs'); 
	?>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Presenter #3 </td>
	<td><select name="p3" style="border:solid 1px #990000;" id="p3" size="1" height="1">
	<?php
mysql_select_db('edge_phpb1');
	 echo'<option value="0"></option>';
	 $uresult3 = mysql_query("SELECT * FROM phpbb_users WHERE group_id != 1 AND group_id != 6");
while ($u = mysql_fetch_array($uresult3)) {
 echo'<option';if($info['presenter_3'] == $u['user_id']) { echo ' selected="selected"'; } echo' value="'.$u['user_id'].'">'.$u['username'].'</option>';
 }
 mysql_select_db('edge_programs'); 
	?>
</select></td>
</tr>
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Update Program" />
	<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" /></td>
</tr>
</table>
	</form>
    
   <?php
   }
}
   
 } elseif($_GET['do'] == 'delete') {
   $uid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM program_info WHERE id='$uid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Successfully deleted program!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
   } else {
    echo'
       <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Uh, crap. That program didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
    }
 } elseif($_GET['do'] == 'reset') {
   $uid = $_GET['id'];
   $resetquery = mysql_query("UPDATE program_info SET sml_img='', lrg_img='', summary='', fb_link='', twit_link='', web_link='' WHERE id='$uid'");
   
   if($resetquery)
        {
   echo'
   <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Successfully reset program!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
   } else {
    echo'
       <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Uh, crap. That program didnt dreset for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
    }
 } elseif($_GET['do'] == 'restream-enable') {
   $uid = $_GET['id'];
   $resetquery = mysql_query("UPDATE program_info SET restream_enabled='true' WHERE id='$uid'");
   
   if($resetquery)
        {
   echo'
   <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Successfully enabled restreaming!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
   } else {
    echo'
       <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Uh, crap. That program didnt enable for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
    }
 } elseif($_GET['do'] == 'restream-disable') {
   $uid = $_GET['id'];
   $resetquery = mysql_query("UPDATE program_info SET restream_enabled='' WHERE id='$uid'");
   
   if($resetquery)
        {
   echo'
   <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Successfully enabled restreaming!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
   } else {
    echo'
       <h1 class="title-head-right">PROGRAM MANAGER</h1>
   <p>Uh, crap. That program didnt enable for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;program.php' />";
    }
 } else {
	 ?>
	 
	 <script language="javascript"> 
function toggle2(showHideDiv, switchTextDiv) {
	var ele = document.getElementById(showHideDiv);
	var text = document.getElementById(switchTextDiv);
	if(ele.style.display == "block") {
    		ele.style.display = "none";
  	}
	else {
		ele.style.display = "block";
	}
}

function toggle3(contentDiv, controlDiv) {
        if (contentDiv.constructor == Array) {
                for(i=0; i < contentDiv.length; i++) {
                     toggle2(contentDiv[i], controlDiv[i]);
                }
        }
        else {
               toggle2(contentDiv, controlDiv);
        }
}
</script>

    
    <h1 class="title-head-right">PROGRAM MANAGER</h1>
    <p>The program manager is where you can add/edit/delete programs from the database. Each program is listed under each day from Monday through Sunday, so the schedule is in order. <b>NOTE: If the new schedule is starting and a program is being replaced my another one, <u>delete</u> the old program and <u>add</u> a new program to replace it.</b></p>
    <p>NOTE: Programs with the same name should not be added more than once, if a show is repeated, please edit the existing program and add a repeated show.</p>
    <p>Click on the days below to show the schedule for that day.</p>
    <p><input value="Press Me To Show All Days" onclick="toggle3(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'], ['mondayh', 'tuesdayh', 'wednesdayh', 'thursdayh', 'fridayh', 'saturdayh', 'sundayh']);" type="button"></p>
  	 <h1 title="Click To Expand/Collapse" onclick="javascript:toggle2('monday','mondayh');" style="cursor: pointer;" id="mondayh" class="greyheader">Monday</h1>
<div id="monday" style="display: none">
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Program Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer, DATE_FORMAT(r_start_time,'%l:%i%p') as r_start_timer, DATE_FORMAT(r_end_time,'%h:%i%p') as r_end_timer FROM program_info WHERE day_time='Monday' OR r_day_time='Monday' ORDER BY IF(day_time='Monday', start_time, r_start_time) ASC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['sml_img']; ?>"></td>
	<td><?php if($info['edgetunes'] == 'true') { ?><b><?php echo stripslashes($info['title']); ?></b><?php } else { ?><a target="_blank" style="text-decoration: none;" href="http://www.edgeradio.org.au/program/<?php echo str_replace(" ","-",$info['seotitle']); ?>/playlists/"><?php echo stripslashes($info['title']); ?></a><?php } ?><br><i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?></i></td>
	<td style="width: 100px;"><?php if($info['edgetunes'] != 'true') { ?><a href="program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Program</a><br><a href="program.php?do=reset&id=<?php echo $info['id']; ?>" style="color: #00CCCC; font-weight: bold; text-decoration: none;">Reset Program</a><br><?php if($info['restream_enabled'] == 'true') { ?><a href="program.php?do=restream-disable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Disable Re-streaming</a><br>
	<?php } else { ?>
	<a href="program.php?do=restream-enable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Enable Re-streaming</a><br><?php } ?><?php } ?>
	<a href="program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>
</div>

  	 <h1 title="Click To Expand/Collapse" onclick="javascript:toggle2('tuesday','tuesdayh');" style="cursor: pointer;" id="tuesdayh" class="greyheader">Tuesday</h1>
<div id="tuesday" style="display: none">
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Program Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer, DATE_FORMAT(r_start_time,'%l:%i%p') as r_start_timer, DATE_FORMAT(r_end_time,'%h:%i%p') as r_end_timer FROM program_info WHERE day_time='Tuesday' OR r_day_time='Tuesday' ORDER BY IF(day_time='Tuesday', start_time, r_start_time) ASC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['sml_img']; ?>"></td>
	<td><?php if($info['edgetunes'] == 'true') { ?><b><?php echo stripslashes($info['title']); ?></b><?php } else { ?><a target="_blank" style="text-decoration: none;" href="http://www.edgeradio.org.au/programs/<?php echo $info['day_time']; ?>/<?php echo str_replace(" ","-",$info['seotitle']); ?>/"><?php echo stripslashes($info['title']); ?></a><?php } ?><br><i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?></i></td>
	<td style="width: 100px;"><?php if($info['edgetunes'] != 'true') { ?><a href="program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Program</a><br><a href="program.php?do=reset&id=<?php echo $info['id']; ?>" style="color: #00CCCC; font-weight: bold; text-decoration: none;">Reset Program</a><br><?php if($info['restream_enabled'] == 'true') { ?><a href="program.php?do=restream-disable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Disable Re-streaming</a><br>
	<?php } else { ?>
	<a href="program.php?do=restream-enable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Enable Re-streaming</a><br><?php } ?><?php } ?><a href="program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>
</div>

  	 <h1 title="Click To Expand/Collapse" onclick="javascript:toggle2('wednesday','wednesdayh');" style="cursor: pointer;" id="wednesdayh" class="greyheader">Wednesday</h1>
<div id="wednesday" style="display: none">
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Program Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer, DATE_FORMAT(r_start_time,'%l:%i%p') as r_start_timer, DATE_FORMAT(r_end_time,'%h:%i%p') as r_end_timer FROM program_info WHERE day_time='Wednesday' OR r_day_time='Wednesday' ORDER BY IF(day_time='Wednesday', start_time, r_start_time) ASC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['sml_img']; ?>"></td>
	<td><?php if($info['edgetunes'] == 'true') { ?><b><?php echo stripslashes($info['title']); ?></b><?php } else { ?><a target="_blank" style="text-decoration: none;" href="http://www.edgeradio.org.au/programs/<?php echo $info['day_time']; ?>/<?php echo str_replace(" ","-",$info['seotitle']); ?>/"><?php echo stripslashes($info['title']); ?></a><?php } ?><br><i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?></i></td>
	<td style="width: 100px;"><?php if($info['edgetunes'] != 'true') { ?><a href="program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Program</a><br><a href="program.php?do=reset&id=<?php echo $info['id']; ?>" style="color: #00CCCC; font-weight: bold; text-decoration: none;">Reset Program</a><br><?php if($info['restream_enabled'] == 'true') { ?><a href="program.php?do=restream-disable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Disable Re-streaming</a><br>
	<?php } else { ?>
	<a href="program.php?do=restream-enable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Enable Re-streaming</a><br><?php } ?><?php } ?><a href="program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>
</div>
  	 <h1 title="Click To Expand/Collapse" onclick="javascript:toggle2('thursday','thursdayh');" style="cursor: pointer;" id="thursdayh" class="greyheader">Thursday</h1>
<div id="thursday" style="display: none">
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Program Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer, DATE_FORMAT(r_start_time,'%l:%i%p') as r_start_timer, DATE_FORMAT(r_end_time,'%h:%i%p') as r_end_timer FROM program_info WHERE day_time='Thursday' OR r_day_time='Thursday' ORDER BY IF(day_time='Thursday', start_time, r_start_time) ASC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['sml_img']; ?>"></td>
	<td><?php if($info['edgetunes'] == 'true') { ?><b><?php echo stripslashes($info['title']); ?></b><?php } else { ?><a target="_blank" style="text-decoration: none;" href="http://www.edgeradio.org.au/programs/<?php echo $info['day_time']; ?>/<?php echo str_replace(" ","-",$info['seotitle']); ?>/"><?php echo stripslashes($info['title']); ?></a><?php } ?><br><i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?></i></td>
	<td style="width: 100px;"><?php if($info['edgetunes'] != 'true') { ?><a href="program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Program</a><br><a href="program.php?do=reset&id=<?php echo $info['id']; ?>" style="color: #00CCCC; font-weight: bold; text-decoration: none;">Reset Program</a><br><?php if($info['restream_enabled'] == 'true') { ?><a href="program.php?do=restream-disable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Disable Re-streaming</a><br>
	<?php } else { ?>
	<a href="program.php?do=restream-enable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Enable Re-streaming</a><br><?php } ?><?php } ?><a href="program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>
</div>
  	 <h1 title="Click To Expand/Collapse" onclick="javascript:toggle2('friday','fridayh');" style="cursor: pointer;" id="fridayh" class="greyheader">Friday</h1>
<div id="friday" style="display: none">
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Program Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer, DATE_FORMAT(r_start_time,'%l:%i%p') as r_start_timer, DATE_FORMAT(r_end_time,'%h:%i%p') as r_end_timer FROM program_info WHERE day_time='Friday' OR r_day_time='Friday' ORDER BY IF(day_time='Friday', start_time, r_start_time) ASC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['sml_img']; ?>"></td>
	<td><?php if($info['edgetunes'] == 'true') { ?><b><?php echo stripslashes($info['title']); ?></b><?php } else { ?><a target="_blank" style="text-decoration: none;" href="http://www.edgeradio.org.au/programs/<?php echo $info['day_time']; ?>/<?php echo str_replace(" ","-",$info['seotitle']); ?>/"><?php echo stripslashes($info['title']); ?></a><?php } ?><br><i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?></i></td>
	<td style="width: 100px;"><?php if($info['edgetunes'] != 'true') { ?><a href="program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Program</a><br><a href="program.php?do=reset&id=<?php echo $info['id']; ?>" style="color: #00CCCC; font-weight: bold; text-decoration: none;">Reset Program</a><br><?php if($info['restream_enabled'] == 'true') { ?><a href="program.php?do=restream-disable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Disable Re-streaming</a><br>
	<?php } else { ?>
	<a href="program.php?do=restream-enable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Enable Re-streaming</a><br><?php } ?><?php } ?><a href="program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>
</div>
  	 <h1 title="Click To Expand/Collapse" onclick="javascript:toggle2('saturday','saturdayh');" style="cursor: pointer;" id="saturdayh" class="greyheader">Saturday</h1>
<div id="saturday" style="display: none">
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Program Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer, DATE_FORMAT(r_start_time,'%l:%i%p') as r_start_timer, DATE_FORMAT(r_end_time,'%h:%i%p') as r_end_timer FROM program_info WHERE day_time='Saturday' OR r_day_time='Saturday' ORDER BY IF(day_time='Saturday', start_time, r_start_time) ASC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['sml_img']; ?>"></td>
	<td><?php if($info['edgetunes'] == 'true') { ?><b><?php echo stripslashes($info['title']); ?></b><?php } else { ?><a target="_blank" style="text-decoration: none;" href="http://www.edgeradio.org.au/programs/<?php echo $info['day_time']; ?>/<?php echo str_replace(" ","-",$info['seotitle']); ?>/"><?php echo stripslashes($info['title']); ?></a><?php } ?><br><?php if($info['day_time'] == 'Saturday') { ?>
	<i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?></i>
	<?php } elseif($info['r_day_time'] == 'Saturday') { ?>
	<i><?php echo $info['r_start_timer']; ?> - <?php echo $info['r_end_timer']; ?></i>
	<?php } ?>
	</td></td>
	<td style="width: 100px;"><?php if($info['edgetunes'] != 'true') { ?><a href="program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Program</a><br><a href="program.php?do=reset&id=<?php echo $info['id']; ?>" style="color: #00CCCC; font-weight: bold; text-decoration: none;">Reset Program</a><br><?php if($info['restream_enabled'] == 'true') { ?><a href="program.php?do=restream-disable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Disable Re-streaming</a><br>
	<?php } else { ?>
	<a href="program.php?do=restream-enable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Enable Re-streaming</a><br><?php } ?><?php } ?><a href="program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>
</div>
  	 <h1 title="Click To Expand/Collapse" onclick="javascript:toggle2('sunday','sundayh');" style="cursor: pointer;" id="sundayh" class="greyheader">Sunday</h1>
<div id="sunday" style="display: none">
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Program Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer, DATE_FORMAT(r_start_time,'%l:%i%p') as r_start_timer, DATE_FORMAT(r_end_time,'%h:%i%p') as r_end_timer FROM program_info WHERE day_time='Sunday' OR r_day_time='Sunday' ORDER BY IF(day_time='Sunday', start_time, r_start_time) ASC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['sml_img']; ?>"></td>
	<td><?php if($info['edgetunes'] == 'true') { ?><b><?php echo stripslashes($info['title']); ?></b><?php } else { ?><a target="_blank" style="text-decoration: none;" href="http://www.edgeradio.org.au/programs/<?php echo $info['day_time']; ?>/<?php echo str_replace(" ","-",$info['seotitle']); ?>/"><?php echo stripslashes($info['title']); ?></a><?php } ?><br>
	<?php if($info['day_time'] == 'Sunday') { ?>
	<i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?></i>
	<?php } elseif($info['r_day_time'] == 'Sunday') { ?>
	<i><?php echo $info['r_start_timer']; ?> - <?php echo $info['r_end_timer']; ?></i>
	<?php } ?>
	</td>
	<td style="width: 100px;"><?php if($info['edgetunes'] != 'true') { ?><a href="program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Program</a><br><a href="program.php?do=reset&id=<?php echo $info['id']; ?>" style="color: #00CCCC; font-weight: bold; text-decoration: none;">Reset Program</a><br><?php if($info['restream_enabled'] == 'true') { ?><a href="program.php?do=restream-disable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Disable Re-streaming</a><br>
	<?php } else { ?>
	<a href="program.php?do=restream-enable&id=<?php echo $info['id']; ?>" style="color: #54257A; font-weight: bold; text-decoration: none;">Enable Re-streaming</a><br><?php } ?><?php } ?><a href="program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>
</div>

    <?php
    }
}
else
{
	
    
  echo "<div class=\"rounded\"><h1 class=\"greyheader\">WOAH</h1>";
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
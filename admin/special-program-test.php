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
        <li><a href="special-program.php?do=add"><b>+</b> Add New Special Event</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
if($_GET['do'] == 'add')
 {
  ?>
  <h1 class="title-head-right">SPECIAL EVENT MANAGER</h1>
  <?php
  if(!empty($_POST['title']) && !empty($_POST['start_time']))
{

 include 'resize.image.class.php';
 
 if(!empty($_FILES['minfile']['name'])) {
$pid1 = $_POST['id'];
$idir1 = "/home/edge/public_html/programs/images/";   // Path To Images Directory 
$SafeFile = $_FILES['minfile']['name'];   // Set $url To Equal The Filename For Later Use 
$SafeFile = str_replace("#", "", $SafeFile);
$SafeFile = str_replace("$", "", $SafeFile);
$SafeFile = str_replace("%", "", $SafeFile);
$SafeFile = str_replace("^", "", $SafeFile);
$SafeFile = str_replace("&", "", $SafeFile);
$SafeFile = str_replace("*", "", $SafeFile);
$SafeFile = str_replace("?", "", $SafeFile); 
$SafeFile = str_replace("'", "", $SafeFile); 
$SafeFile = str_replace("\\", "", $SafeFile); 
$SafeFile = str_replace("/", "", $SafeFile); 
$SafeFile = str_replace(" ", "", $SafeFile); 
$SafeFile = str_replace(")", "", $SafeFile); 
$SafeFile = str_replace("(", "", $SafeFile); 


$copy1 = copy($_FILES['minfile']['tmp_name'], "$idir1" . $SafeFile);
$image = new Resize_Image;
$image->new_width = 163;
$image->new_height = 163;
$image->image_to_resize = '/home/edge/public_html/programs/images/'.$SafeFile.''; // Full Path to the file
$image->ratio = false;
$image->new_image_name = 'icon_'.$pid1.'_'.$SafeFile;
$image->save_folder = '/home/edge/public_html/programs/images/';
$process = $image->resize();
$sml_img = 'http://www.edgeradio.org.au/programs/images/icon_'.$pid1.'_'.$SafeFile.'';
}


	$title = mysql_real_escape_string($_POST['title']);
    $start_time = mysql_real_escape_string($_POST['start_time']);
    $end_time = mysql_real_escape_string($_POST['end_time']);
    $day_time = mysql_real_escape_string($_POST['day_time']);
    $summary = addslashes($_POST['summary']);
    
    if(isset($_POST['stream'])){
    	$stream = 'true';
    }else{
    	$stream = 'false';
    }
    
	 $checktitle = mysql_query("SELECT * FROM program_special WHERE title = '".$title."'");
	 $checktimes = mysql_query("SELECT * FROM program_special WHERE start_time = '".$start_time."' AND day_time = '".$day_time."'");
     
     if(mysql_num_rows($checktitle) == 1)
     {
     	echo "<h1>Error</h1>";
        echo "<p>Sorry, that event name is taken. Please go back and try again.</p>";
     }
     elseif(mysql_num_rows($checktimes) == 1)
     {
     	echo "<h1>Error</h1>";
        echo "<p>Sorry, that event is overlapping with another event. Please go back and try again.</p>";
     }
     else
     {
     	$registerquery = mysql_query("INSERT INTO program_special (title, summary, start_time, end_time, day_time, sml_img, streaming_enabled) VALUES('".$title."', '".$summary."', '".$start_time."', '".$end_time."', '".$day_time."', '" . $sml_img . "', '" . $stream . "')");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Hoorah, the event has been added.</p>
			<p><a href=\"special-program.php\">Return to programs</a>.</p>";
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
	<form method="post" enctype="multipart/form-data" action="special-program.php?do=add" name="registerform" id="registerform">
		<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Event Title </td>
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
     <p>Please choose what date & time the event airs.</p>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Start Time<br><small>(24 hr time)</small></td>
	<td><select name="start_time" style="border:solid 1px #990000;" id="start_time" size="1" height="1">
	<option>00:00</option>
	<option>01:00</option>
	<option>02:00</option>
	<option>03:00</option>
	<option>04:00</option>
	<option>05:00</option>
	<option>06:00</option>
	<option>07:00</option>
	<option>08:00</option>
	<option>09:00</option>
	<option>10:00</option>
	<option>11:00</option>
	<option>12:00</option>
	<option>13:00</option>
	<option>14:00</option>
	<option>15:00</option>
	<option>16:00</option>
	<option>17:00</option>
	<option>18:00</option>
	<option>19:00</option>
	<option>20:00</option>
	<option>21:00</option>
	<option>22:00</option>
	<option>23:00</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">End Time<br><small>(24 hr time)</small></td>
	<td><select name="end_time" style="border:solid 1px #990000;" id="end_time" size="1" height="1">
	<option>00:00</option>
	<option>01:00</option>
	<option>02:00</option>
	<option>03:00</option>
	<option>04:00</option>
	<option>05:00</option>
	<option>06:00</option>
	<option>07:00</option>
	<option>08:00</option>
	<option>09:00</option>
	<option>10:00</option>
	<option>11:00</option>
	<option>12:00</option>
	<option>13:00</option>
	<option>14:00</option>
	<option>15:00</option>
	<option>16:00</option>
	<option>17:00</option>
	<option>18:00</option>
	<option>19:00</option>
	<option>20:00</option>
	<option>21:00</option>
	<option>22:00</option>
	<option>23:00</option>
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
	<td style="width: 100px; text-align: right;">Streaming Enabled</td>
	<td><input type="checkbox" name="stream" value="enabled" checked></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Upload Image</h1>
     <table style="width: 500px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 200px; text-align: right;"><b>Icon Image</b><br><small>This image may be resized if the dimensions don't fit.<br><a href="http://www.edgeradio.org.au/images/icon-eg.png">Example</a></small></td>
	<td><input type="file" style="border:solid 1px #990000;" name="minfile" class="form"></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Go!</h1>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Add Event" /></td>
</tr>
</table>
	</form>
    
   <?php
}
  
  } elseif($_GET['do'] == 'edit') {
   
     if(!empty($_POST['title']))
{
    $title = mysql_real_escape_string($_POST['title']);
    $start_time = mysql_real_escape_string($_POST['start_time']);
    $end_time = mysql_real_escape_string($_POST['end_time']);
    $day_time = mysql_real_escape_string($_POST['day_time']);
    $summary = addslashes($_POST['summary']);
    
    if(isset($_POST['stream'])){
    	$stream = 'true';
    }else{
    	$stream = 'false';
    }
    
      $uid = $_POST['id'];
     	$registerquery = mysql_query("UPDATE program_info SET title='$title', summary='$summary', start_time='$start_time', end_time='$end_time', day_time='$day_time', streaming_enabled='$stream' WHERE id='$uid'");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Woo!</p>
			<p><a href=\"special-program.php\">Return to special events</a>.</p>";
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
 $inforesult = mysql_query("SELECT * FROM program_special WHERE id='$id'");
while ($info = mysql_fetch_array($inforesult)) {
 
	?>
	<h1 class="title-head-right">SPECIAL EVENT MANAGER</h1>
    <p>If this program requires a name change/time change, you may do so here...</p>
	<form method="post" action="special-program.php?do=edit" name="registerform" id="registerform">
		<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Event Title </td>
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
	<option<?php if($info['start_time'] == '01:00:00') { echo ' selected="selected"'; } ?>>01:00</option>
	<option<?php if($info['start_time'] == '02:00:00') { echo ' selected="selected"'; } ?>>02:00</option>
	<option<?php if($info['start_time'] == '03:00:00') { echo ' selected="selected"'; } ?>>03:00</option>
	<option<?php if($info['start_time'] == '04:00:00') { echo ' selected="selected"'; } ?>>04:00</option>
	<option<?php if($info['start_time'] == '05:00:00') { echo ' selected="selected"'; } ?>>05:00</option>
	<option<?php if($info['start_time'] == '06:00:00') { echo ' selected="selected"'; } ?>>06:00</option>
	<option<?php if($info['start_time'] == '07:00:00') { echo ' selected="selected"'; } ?>>07:00</option>
	<option<?php if($info['start_time'] == '08:00:00') { echo ' selected="selected"'; } ?>>08:00</option>
	<option<?php if($info['start_time'] == '09:00:00') { echo ' selected="selected"'; } ?>>09:00</option>
	<option<?php if($info['start_time'] == '10:00:00') { echo ' selected="selected"'; } ?>>10:00</option>
	<option<?php if($info['start_time'] == '11:00:00') { echo ' selected="selected"'; } ?>>11:00</option>
	<option<?php if($info['start_time'] == '12:00:00') { echo ' selected="selected"'; } ?>>12:00</option>
	<option<?php if($info['start_time'] == '13:00:00') { echo ' selected="selected"'; } ?>>13:00</option>
	<option<?php if($info['start_time'] == '14:00:00') { echo ' selected="selected"'; } ?>>14:00</option>
	<option<?php if($info['start_time'] == '15:00:00') { echo ' selected="selected"'; } ?>>15:00</option>
	<option<?php if($info['start_time'] == '16:00:00') { echo ' selected="selected"'; } ?>>16:00</option>
	<option<?php if($info['start_time'] == '17:00:00') { echo ' selected="selected"'; } ?>>17:00</option>
	<option<?php if($info['start_time'] == '18:00:00') { echo ' selected="selected"'; } ?>>18:00</option>
	<option<?php if($info['start_time'] == '19:00:00') { echo ' selected="selected"'; } ?>>19:00</option>
	<option<?php if($info['start_time'] == '20:00:00') { echo ' selected="selected"'; } ?>>20:00</option>
	<option<?php if($info['start_time'] == '21:00:00') { echo ' selected="selected"'; } ?>>21:00</option>
	<option<?php if($info['start_time'] == '22:00:00') { echo ' selected="selected"'; } ?>>22:00</option>
	<option<?php if($info['start_time'] == '23:00:00') { echo ' selected="selected"'; } ?>>23:00</option>
</select></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">End Time<br><small>(24 hr time)</small></td>
	<td><select name="end_time" style="border:solid 1px #990000;" id="end_time" size="1" height="1">
	<option<?php if($info['end_time'] == '00:00:00') { echo ' selected="selected"'; } ?>>00:00</option>
	<option<?php if($info['end_time'] == '01:00:00') { echo ' selected="selected"'; } ?>>01:00</option>
	<option<?php if($info['end_time'] == '02:00:00') { echo ' selected="selected"'; } ?>>02:00</option>
	<option<?php if($info['end_time'] == '03:00:00') { echo ' selected="selected"'; } ?>>03:00</option>
	<option<?php if($info['end_time'] == '04:00:00') { echo ' selected="selected"'; } ?>>04:00</option>
	<option<?php if($info['end_time'] == '05:00:00') { echo ' selected="selected"'; } ?>>05:00</option>
	<option<?php if($info['end_time'] == '06:00:00') { echo ' selected="selected"'; } ?>>06:00</option>
	<option<?php if($info['end_time'] == '07:00:00') { echo ' selected="selected"'; } ?>>07:00</option>
	<option<?php if($info['end_time'] == '08:00:00') { echo ' selected="selected"'; } ?>>08:00</option>
	<option<?php if($info['end_time'] == '09:00:00') { echo ' selected="selected"'; } ?>>09:00</option>
	<option<?php if($info['end_time'] == '10:00:00') { echo ' selected="selected"'; } ?>>10:00</option>
	<option<?php if($info['end_time'] == '11:00:00') { echo ' selected="selected"'; } ?>>11:00</option>
	<option<?php if($info['end_time'] == '12:00:00') { echo ' selected="selected"'; } ?>>12:00</option>
	<option<?php if($info['end_time'] == '13:00:00') { echo ' selected="selected"'; } ?>>13:00</option>
	<option<?php if($info['end_time'] == '14:00:00') { echo ' selected="selected"'; } ?>>14:00</option>
	<option<?php if($info['end_time'] == '15:00:00') { echo ' selected="selected"'; } ?>>15:00</option>
	<option<?php if($info['end_time'] == '16:00:00') { echo ' selected="selected"'; } ?>>16:00</option>
	<option<?php if($info['end_time'] == '17:00:00') { echo ' selected="selected"'; } ?>>17:00</option>
	<option<?php if($info['end_time'] == '18:00:00') { echo ' selected="selected"'; } ?>>18:00</option>
	<option<?php if($info['end_time'] == '19:00:00') { echo ' selected="selected"'; } ?>>19:00</option>
	<option<?php if($info['end_time'] == '20:00:00') { echo ' selected="selected"'; } ?>>20:00</option>
	<option<?php if($info['end_time'] == '21:00:00') { echo ' selected="selected"'; } ?>>21:00</option>
	<option<?php if($info['end_time'] == '22:00:00') { echo ' selected="selected"'; } ?>>22:00</option>
	<option<?php if($info['end_time'] == '23:00:00') { echo ' selected="selected"'; } ?>>23:00</option>
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
<tr>
	<td style="width: 100px; text-align: right;">Streaming Enabled</td>
	<td><input type="checkbox" name="stream" value="enabled" <?php if($info['streaming_enabled'] != 'false') { echo 'checked'; } ?>></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Go!</h1>
<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Update Event" />
	<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" /></td>
</tr>
</table>
	</form>
    
   <?php
   }
}
   
 } elseif($_GET['do'] == 'delete') {
   $uid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM program_special WHERE id='$uid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">SPECIAL EVENT MANAGER</h1>
   <p>Successfully deleted event!</p>';
   echo "<meta http-equiv='refresh' content='=2;special-program.php' />";
   } else {
    echo'
       <h1 class="title-head-right">SPECIAL EVENT MANAGER</h1>
   <p>Uh, crap. That event didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;special-program.php' />";
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

    
    <h1 class="title-head-right">SPECIAL EVENT MANAGER</h1>



  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Event Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l:%i%p') as start_timer, DATE_FORMAT(end_time,'%h:%i%p') as end_timer FROM program_special ORDER BY start_time, day_time ASC");
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
	<td><b><?php echo stripslashes($info['title']); ?></b><br><i><?php echo $info['start_timer']; ?> - <?php echo $info['end_timer']; ?><br><?php echo $info['day_time']; ?></i></td>
	<td style="width: 100px;"><a href="special-program.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Event</a><br><a href="special-program.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>


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
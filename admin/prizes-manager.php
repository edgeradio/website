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
        <li><a href="prizes-manager.php?do=add"><b>+</b> Add New Prize</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
if($_GET['do'] == 'add')
 {
  ?>
  <h1 class="title-head-right">PRIZES MANAGER</h1>
  <?php
  if(!empty($_POST['title']))
{

 include 'resize.image.class.php';
 
 if(!empty($_FILES['minfile']['name'])) {
$pid1 = $_POST['show_id'];
$idir1 = "/home/edge/public_html/images/";   // Path To Images Directory 
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
$image->image_to_resize = '/home/edge/public_html/images/'.$SafeFile.''; // Full Path to the file
$image->ratio = false;
$image->new_image_name = 'icon_'.$pid1.'_'.$SafeFile;
$image->save_folder = '/home/edge/public_html/images/';
$process = $image->resize();
$sml_img = 'http://www.edgeradio.org.au/images/icon_'.$pid1.'_'.$SafeFile.'';
}


	$title = mysql_real_escape_string($_POST['title']);
    $summary = addslashes($_POST['summary']);
    $show_id = $_POST['show_id'];
    
     	$registerquery = mysql_query("INSERT INTO prizes (title, description, show_id, image, date_added) VALUES('".$title."', '".$summary."', '".$show_id."', '".$sml_img."', NOW())");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Hoorah, the prize has been added.</p>
			<p><a href=\"prizes-manager.php\">Return to prizes</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, that failed. Please go back and try again.</p>";    
        }    	
}
else
{
	?>
	<form method="post" enctype="multipart/form-data" action="prizes-manager.php?do=add" name="registerform" id="registerform">
		<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Prize Title </td>
	<td><input type="text" style="border:solid 1px #990000;" name="title" id="title" size="40" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Summary/Description</td>
	<td><input type="text" style="border:solid 1px #990000;" name="summary" id="summary" size="40" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Show</td>
	<td><select name="show_id">
 <?php
 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT * FROM program_info WHERE edgetunes='0' ORDER BY title ASC");
 while ($info = mysql_fetch_array($inforesult)) {
 ?>
	<option value="<?php echo $info['id']; ?>"><?php echo $info['title']; ?> (<?php echo $info['day_time']; ?>)</option>
	<?php } ?>
	</select></td>
</tr>
</table>
</div>
<br />
     <div class="rounded">
     <h1 class="title-head-right">Upload Image</h1>
     <table style="width: 500px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 200px; text-align: right;"><b>Icon Image</b><br><small>This image may be resized if the dimensions don't fit.</small></td>
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
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Add Prize" /></td>
</tr>
</table>
	</form>
    
   <?php
}
  
  } elseif($_GET['do'] == 'edit') {
   
     if(!empty($_POST['winner']))
{
    $winner = mysql_real_escape_string($_POST['winner']);
    
      $uid = $_POST['id'];
     	$registerquery = mysql_query("UPDATE prizes SET winner='$winner' WHERE id='$uid'");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Woo!</p>
			<p><a href=\"prizes-manager.php\">Return to prizes</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, that failed. Please go back and try again.</p>";    
        }    	
}
else
{
 
	?>
	<h1 class="title-head-right">PRIZES MANAGER</h1>
    <p>Add A Winnar...</p>
	<form method="post" action="prizes-manager.php?do=edit" name="registerform" id="registerform">
		<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Winner</td>
	<td><input type="text" style="border:solid 1px #990000;" name="winner" id="title" size="40" /></td>
</tr>
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Add Winner" />
	<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" /></td>
</tr>
</table>
	</form>
    
   <?php
}
   
 } elseif($_GET['do'] == 'delete') {
   $uid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM prizes WHERE id='$uid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">PRIZES MANAGER</h1>
   <p>Successfully deleted prize!</p>';
   echo "<meta http-equiv='refresh' content='=2;prizes-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">PRIZES MANAGER</h1>
   <p>Uh, crap. That prize didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;prizes-manager.php' />";
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

    
    <h1 class="title-head-right">CURRENT PRIZES</h1>



  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Event Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$inforesult = mysql_query("SELECT * FROM prizes WHERE winner = '' ORDER BY date_added DESC");
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['image']; ?>"></td>
	<td><span class="title"><?php echo stripslashes($info['title']); ?></span><br>
	<p><i><?php echo stripslashes($info['description']); ?></i></p>
	<b>
	 <?php
	 $show_id = $info['show_id'];
 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l%p') as start_timer FROM program_info WHERE id='$show_id'");
 while ($infor = mysql_fetch_array($inforesult)) {
 ?>
	<?php echo $infor['title']; ?> (<?php echo $infor['start_timer']; ?>, <?php echo $infor['day_time']; } ?>)
	</b></td>
	<td style="width: 150px;"><a href="prizes-manager.php?do=edit&id=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Add Winner</a><br><a href="prizes-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>

</div>
<br>
<div class="rounded">
 <h1 class="title-head-right">PAST PRIZES</h1>



  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
<td></td>
	<td><b>Event Name</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
 mysql_select_db("edge_content",$db);
$inforesult = mysql_query("SELECT * FROM prizes WHERE winner != '' ORDER BY date_added DESC") or die(mysql_error());
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
<td style="width: 100px;"><img style="width: 80px; height: 80px;" src="<?php echo $info['image']; ?>"></td>
	<td><span class="title"><?php echo stripslashes($info['title']); ?></span><br>
	<p><i><?php echo stripslashes($info['description']); ?></i></p>
	<b>
	 <?php
	 $show_id = $info['show_id'];
 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l%p') as start_timer FROM program_info WHERE id='$show_id'");
 while ($infor = mysql_fetch_array($inforesult)) {
 ?>
	<?php echo $infor['title']; ?> (<?php echo $infor['start_timer']; ?>, <?php echo $infor['day_time']; } ?>)
	<br>Winner: <?php echo stripslashes($info['winner']); ?>
	</b></td>
	<td style="width: 150px;"><a href="prizes-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
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
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
 mysql_select_db('edge_programs'); 
    ?>
          </div>
    <div id="two_column">

     <div class="rounded">
<?php
 
   $id = $_GET['id'];
 $uid = $user->data['user_id'];
 $inforesult = mysql_query("SELECT * FROM program_info WHERE id='$id' AND presenter_1='$uid' OR presenter_2='$uid' OR presenter_3='$uid'");
 $countit = mysql_num_rows($inforesult);
 if($countit != '0') {
   
     if(!empty($_POST['done']))
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

 if(!empty($_FILES['aboutfile']['name'])) {
$pid1 = $_POST['id'];
$idir1 = "/home/edge/public_html/programs/images/";   // Path To Images Directory 
$SafeFile = $_FILES['aboutfile']['name'];   // Set $url To Equal The Filename For Later Use 
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


$copy1 = copy($_FILES['aboutfile']['tmp_name'], "$idir1" . $SafeFile);
$image = new Resize_Image;
$image->new_width = 250;
$image->new_height = 250;
$image->image_to_resize = '/home/edge/public_html/programs/images/'.$SafeFile.''; // Full Path to the file
$image->ratio = false;
$image->new_image_name = 'about_'.$pid1.'_'.$SafeFile;
$image->save_folder = '/home/edge/public_html/programs/images/';
$process = $image->resize();
$about_img = 'http://www.edgeradio.org.au/programs/images/about_'.$pid1.'_'.$SafeFile.'';
}

 if(!empty($_FILES['headerfile']['name'])) {
$pid2 = $_POST['id'];
$idir2 = "/home/edge/public_html/programs/images/";   // Path To Images Directory 
$SafeFile = $_FILES['headerfile']['name'];   // Set $url To Equal The Filename For Later Use 
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
$copy2 = copy($_FILES['headerfile']['tmp_name'], "$idir2" . $SafeFile);
$image = new Resize_Image;
$image->new_width = 1000;
$image->new_height = 200;
$image->image_to_resize = '/home/edge/public_html/programs/images/'.$SafeFile.''; // Full Path to the file
$image->ratio = false;
$image->new_image_name = 'header_'.$pid2.'_'.$SafeFile;
$image->save_folder = '/home/edge/public_html/programs/images/';
$process = $image->resize();
$xl_img = 'http://www.edgeradio.org.au/programs/images/header_'.$pid2.'_'.$SafeFile.'';
}

 if(!empty($_FILES['woefile']['name'])) {
$pid2 = $_POST['id'];
$idir2 = "/home/edge/public_html/programs/images/";   // Path To Images Directory 
$SafeFile = $_FILES['woefile']['name'];   // Set $url To Equal The Filename For Later Use 
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
$copy2 = copy($_FILES['woefile']['tmp_name'], "$idir2" . $SafeFile);
$image = new Resize_Image;
$image->new_width = 765;
$image->new_height = 200;
$image->image_to_resize = '/home/edge/public_html/programs/images/'.$SafeFile.''; // Full Path to the file
$image->ratio = false;
$image->new_image_name = 'woe_'.$pid2.'_'.$SafeFile;
$image->save_folder = '/home/edge/public_html/programs/images/';
$process = $image->resize();
$lrg_img = 'http://www.edgeradio.org.au/programs/images/woe_'.$pid2.'_'.$SafeFile.'';
}

    $description = addslashes($_POST['description']);
    $description = nl2br($description);
    $fb_link = $_POST['fb_link'];
    $twit_link = $_POST['twit_link'];
    $web_link = $_POST['web_link'];
    $summary = addslashes($_POST['summary']);
    
      $uid = $_POST['id'];
      if(!empty($lrg_img)) {
$query1 = "lrg_img='$lrg_img', ";
       } 
	   
	   if(!empty($sml_img)) {
$query2 = "sml_img='$sml_img', ";
        }
        
        if(!empty($xl_img)) {
$query3 = "xl_img='$xl_img', ";
       } 
       
       if(!empty($about_img)) {
$query4 = "about_img='$about_img', ";
       } 
        
        
$registerquery = mysql_query("UPDATE program_info SET description='$description', summary='$summary', $query1 $query2 $query3 $query4 fb_link='$fb_link', twit_link='$twit_link', web_link='$web_link' WHERE id='$uid'");

$updatequery = mysql_query("UPDATE program_info SET dateupdated=NOW() WHERE id='$uid'");
         
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Woo!</p>
			<p><a href=\"presenter-program.php?id=" . $_POST['id'] ."\">Return To Program</a></p>";
			
			$gnid = $_GET['id'];

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l:%i %p') as start_time, DATE_FORMAT(end_time, '%l:%i %p') as end_time FROM program_info WHERE id='$gnid'");
 while ($info = mysql_fetch_array($inforesult)) {
  $nameid = str_replace(" ","-",$info['title']);
  echo'<p><a target="_blank" href="http://www.edgeradio.org.au/program/' . $nameid . '/"><b>Preview My Program Page</b></a></p>';
  }
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
 $uid = $user->data['user_id'];
 $inforesult = mysql_query("SELECT * FROM program_info WHERE id='$id' AND (presenter_1='$uid' OR presenter_2='$uid' OR presenter_3='$uid')");
while ($info = mysql_fetch_array($inforesult)) {
 
	?>
	<h1 class="title-head-right">EDIT <?php echo $info['title']; ?></h1>
    <p>Edit your program details such as the description, images or links to external sites here. Remember: Image Is Everything! Make your page stand out with unique branding, images and detailed text.</p>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript"> bkLib.onDomLoaded(function() { 
	 new nicEditor({buttonList : ['bold','italic','underline']}).panelInstance('area1');
}); </script>
	<form method="post" enctype="multipart/form-data" action="presenter-program.php?id=<?php echo $id; ?>" name="registerform" id="registerform">
		<table style="width: 700px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 150px; text-align: right;"><b>Short Summary</b><br><small>5 Words Or Less</small></td>
	<td><input type="text" style="border:solid 1px #990000; width: 200px;" name="summary" value="<?php echo stripslashes($info['summary']); ?>" /></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;"><b>Facebook URL</b><br><small>Add your full Facebook page url.</small></td>
	<td><input type="text" style="border:solid 1px #990000; width: 300px;" name="fb_link" value="<?php echo $info['fb_link']; ?>" /></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;"><b>Twitter URL</b><br><small>Add your full twitter account url.</small></td>
	<td><input type="text" style="border:solid 1px #990000; width: 300px;" name="twit_link" value="<?php echo $info['twit_link']; ?>" /></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;"><b>Website URL</b><br><small>Add your website url.</small></td>
	<td><input type="text" style="border:solid 1px #990000; width: 300px;" name="web_link" value="<?php echo $info['web_link']; ?>" /></td>
</tr>
</table>
</div>
<br>
<div class="rounded">
<h1 class="title-head-right">ABOUT</h1>
<p>Write all bout your program here, add a detailed description and a nice image to accompany it!</p>
		<table style="width: 700px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 150px; text-align: right;"><b>Short Description</b><br><small>2 Paragraphs or Less!</small></td>
	<td><textarea name="description" rows="8" cols="100" style="border:solid 1px #990000; width: 300px;"><?php echo stripslashes(str_replace('<br />', '', $info['description'])); ?></textarea></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;"><b>About Image</b> (Dimensions: 250px x 250px)<br><small>This image may be resized if the dimensions don't fit.</small></td>
	<td><input type="file" style="border:solid 1px #990000;" name="aboutfile" class="form"></td>
</tr>

</table>
</div>
<br>
<div class="rounded">
<h1 class="title-head-right">HEADER IMAGE</h1>
<p>Upload your header image here. The header image is used on your program page. You can preview what your header image will look like by visiting your program page. (Dimensions: 1000px x 200px)</p>
<p>NOTE: If you don't upload a header image, the default Edge Radio background will appear.</p>

<table style="width: 500px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
<?php if(!empty($info['xl_img'])) { ?>
 <tr>
	<td style="width: 150px; text-align: right;"><b>Current Image</b></td>
	<td><a target="_blank" href="<?php echo $info['xl_img']; ?>"><img style="width: 500px; height: 100px;" src="<?php echo $info['xl_img']; ?>"></a></td>
</tr>
<?php } ?>
	<td style="width: 150px; text-align: right;"><b>Header Image</b><br><small>This image may be resized if the dimensions don't fit.<br><a href="http://www.edgeradio.org.au/images/xl-eg.png">Example</a></small></td>
	<td><input type="file" style="border:solid 1px #990000;" name="headerfile" class="form"></td>
</tr>
</table>
</div>
<br>
<div class="rounded">
<h1 class="title-head-right">ICON IMAGE</h1>
    <p>Upload your icon image here. It will be displayed in the header when your show is on air. (Dimensions: 163px x 163px)</p>

<table style="width: 500px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<?php if(!empty($info['sml_img'])) { ?>
 <tr>
	<td style="width: 150px; text-align: right;"><b>Current Image</b></td>
	<td><a target="_blank" href="<?php echo $info['sml_img']; ?>"><img style="width: 163px; height: 163px;" src="<?php echo $info['sml_img']; ?>"></a></td>
</tr>
<?php } ?>
<tr>
	<td style="width: 150px; text-align: right;"><b>Icon Image</b><br><small>This image may be resized if the dimensions don't fit.<br><a href="http://www.edgeradio.org.au/images/icon-eg.png">Example</a></small></td>
	<td><input type="file" style="border:solid 1px #990000;" name="minfile" class="form"></td>
</tr>
</table>
</div>
<br>
<div class="rounded">
<h1 class="title-head-right">WHATS ON EDGE IMAGE</h1>
<p>Upload your WOE image here. The WOE image is used when your program has a WOE on the homepage. (Dimensions: 765px x 200px)</p>
<p>NOTE: If you don't upload a WOE image, the default Edge Radio background will appear.</p>

<table style="width: 500px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<?php if(!empty($info['lrg_img'])) { ?>
 <tr>
	<td style="width: 150px; text-align: right;"><b>Current Image</b></td>
	<td><a target="_blank" href="<?php echo $info['lrg_img']; ?>"><img style="width: 350px; height: 100px;" src="<?php echo $info['lrg_img']; ?>"></a></td>
</tr>
<?php } ?>
<tr>
	<td style="width: 150px; text-align: right;"><b>WOE Image</b><br><small>This image may be resized if the dimensions don't fit.<br><a href="http://www.edgeradio.org.au/images/lrg-eg.png">Example</a></small></td>
	<td><input type="file" style="border:solid 1px #990000;" name="woefile" class="form"></td>
</tr>
</table>
</div>
<br>

<div class="rounded">
<small><span style="color: #FF0000;">*</span> Required Field</small>
<table style="width: 500px; margin-left: auto; margin-right: auto; text-align: center;" border="0" cellpadding="5">
<tr>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Update My Program" />
	<input type="hidden" name="done" value="TRUE" />
	<input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" /></td>
</tr>
</table>
	</form>
    
   <?php
   }
}
   
   } else {
    
    echo "<h1 class=\"greyheader\">WOAH</h1>";
        echo "<p>You cannot view that!</p>";
        echo "<p><a href=\"index.php\">Click Here</a> if you are not automatically redirected.</p>";
        echo "<script type=\"text/javascript\">
<!--
window.location = \"index.php\"
//-->
</script>";
    
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
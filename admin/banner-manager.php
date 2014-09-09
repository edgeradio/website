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
    
     <div class="rounded">
<?php
 if($_GET['do'] == 'edit')
 {

if (isset($_POST['submitted'])) {

include 'resize.image.class.php';

mysql_select_db('edge_content'); 

$id = $_POST['id'];
$url = $_POST['url'];

 if(!empty($_FILES['headerfile']['name'])) {
$pid2 = $_POST['id'];
$idir2 = "/home/edge/public_html/images/";   // Path To Images Directory 
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
if($id == 'side_1') {
$image->new_width = 210;
$image->new_height = 300;
} elseif($id == 'side_2') {
$image->new_width = 210;
$image->new_height = 240;
} elseif($id == 'home_1') {
$image->new_width = 760;
$image->new_height = 100;
}
$image->image_to_resize = '/home/edge/public_html/images/'.$SafeFile.''; // Full Path to the file
$image->ratio = false;
$image->new_image_name = 'up_'.$pid2.'_'.$SafeFile;
$image->save_folder = '/home/edge/public_html/images/';
$process = $image->resize();
$lrg_img = 'http://www.edgeradio.org.au/images/up_'.$pid2.'_'.$SafeFile.'';
}

 $query1 = "UPDATE banners SET image_url='$lrg_img', http_url='$url' WHERE banner = '$id'";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo "<p><strong>Success!</strong><br><a href=\"banner-manager.php\">Return</a>";
  echo mysql_error();
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
 } else {
 
  $id = $_GET['id'];
$inforesult = mysql_query("SELECT * FROM banners WHERE banner = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="banner-manager.php?do=edit&id=<?php print $id ?>" method="post">
 <h1 class="greyheader">EDIT BANNER ITEM</h1>
 <table cellpadding="2" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>URL</b></td>
	<td><input name="url" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo $info['http_url']; ?>" /></td>
	</tr>
	  <tr>
	<td style="width: 100px;"><b>Image (Will be resized!)</b></td>
	<td><input type="file" style="border:solid 1px #990000;" name="headerfile" class="form"></td>
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
 } else {
  
	 ?>
    
    <h1 class="greyheader">BANNER MANAGER</h1>
    <p>Banner Manager</p>
  	 <table cellpadding="10" cellspacing="0">
<tr>
	<td style="width: 120px;"><b>Banner</b></td>
	<td style="width: 120px;"><b>Image</b></td>
	<td style="width: 120px;"><b>URL</b></td>
	<td style="width: 100px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];
	  	 	
$inforesult = mysql_query("SELECT * FROM banners",$db);

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
<td><?php echo $info['banner']; ?></td>
<td><?php echo $info['image_url']; ?></td>
<td><?php echo $info['http_url']; ?></td>
	<td><a href="banner-manager.php?do=edit&id=<?php echo $info['banner']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>


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
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
 mysql_select_db('edge_music'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenu">
        <ul>
        <li><a href="freemusic-manager.php"><span style="font-weight: bold;">+</span> View All Things</a></li>
        <li><a href="freemusic-manager.php?do=add-track"><span style="font-weight: bold;">+</span> Add Track To Database</a></li>
      </ul>
      </div>
<br />

    
     <div class="rounded">
<?php
if($_GET['do'] == 'addimage-track')
 {
  
  if (isset($_POST['submitted'])) {
   
   
   

mysql_select_db('edge_music'); 

$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
$description = addslashes($_POST['description']);
$soundcloud = addslashes($_POST['soundcloud']);

 $query1 = "INSERT INTO free_music (artist, title, soundcloud, description) 
 VALUES 
 ('$artist', '$title', '$soundcloud', '$description')";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo '
   
   
    <h1 class="greyheader">Add Image</h1>
   <p>Choose an image from the last.fm database, or if none show up, you can upload an image in the form below.</p>
   <p>
   <form enctype="multipart/form-data" action="freemusic-manager.php?do=addimagesubmit-track" method="post">
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Last.fm Image Lookup</b></td>
   <td>
   ';
  $artist = $_POST['artist'];
     $completeurl = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$artist&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);
echo '<div style="float: left; margin: 5px 5px 5px 5px;"><input name="image" style="border:solid 1px #990000; margin-right: 10px;" type="radio" size="25" value="'.$xml->artist->image[3].'" /><br><br>';
echo '<img style="width: 100px; height: 100px;" src="'.$xml->artist->image[3].'"></div>';


echo'</td>
</tr>
<tr>
	<td style="width: 100px;"><br><br><b>- OR -</b><br><br></td>
   <td></td>
</tr>
 <tr>
	<td style="width: 100px;"><b>Upload Image</b></td>
   <td><input type="file" name="imagefile" class="form"> </td>
</tr></table>
   
   <input name="title" value="'.$title.'" type="hidden" /><input name="artist" value="'.$artist.'" type="hidden" />

<input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Continue >>" />
<input type="hidden" name="submitted" value="TRUE" /></form>';

  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
 }
  
  } elseif($_GET['do'] == 'addimagesubmit-track')
 {
  
  if (isset($_POST['submitted'])) {
   
   if($_FILES['imagefile']['name']) {
     $idir = "../music_files/";   // Path To Images Directory 
$twidth = "106";   // Maximum Width For Thumbnail Images 
$theight = "81";   // Maximum Height For Thumbnail Images 

  $url = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy($_FILES['imagefile']['tmp_name'], "$idir" . $_FILES['imagefile']['name']);

include 'resize.image.class.php';

$image = new Resize_Image;

$image->new_width = 120;
$image->new_height = 120;

$image->image_to_resize = '../music_files/'.$url.''; // Full Path to the file

$image->ratio = true; // Keep Aspect Ratio?

// Name of the new image (optional) - If it's not set a new will be added automatically

$image->new_image_name = 'thumb_'.$_FILES['imagefile']['name'];

/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

$image->save_folder = '../music_files/';

$process = $image->resize();

if($process['result'] && $image->save_folder)
{
echo 'The new image ('.$process['new_file_path'].') has been saved.';
}


 $image = 'http://www.edgeradio.org.au/music_files/thumb_' . $_FILES['imagefile']['name'] . '';
} else {

$image = $_POST['image'];

}

$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
 $query1 = "UPDATE free_music SET image='$image' WHERE artist = '$artist' AND title = '$title'";
 $result1 = mysql_query($query1);

 if($query1) {

?>
Done
<?php



}


   }
   
   
   } elseif($_GET['do'] == 'add-track')
 {

?>
<form enctype="multipart/form-data" action="freemusic-manager.php?do=addimage-track" method="post">
<h1 class="greyheader">Add Free Music Track</h1>
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Artist</b></td>
	<td><input name="artist" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>Track Title</b></td>
   <td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
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
 } elseif($_GET['do'] == 'delete') {
   $bid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM free_music WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;freemusic-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">OH!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;freemusic-manager.php' />";
    }
 } else {
  
	 ?>
	 

    <h1 class="greyheader">FREE MUSIC MANAGER</h1>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td><b>Title</b></td>
	<td style="width: 110px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];


   $myquery = "SELECT COUNT(*) as num FROM free_music ORDER BY id DESC";
   
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	

	 $targetpage = "freemusic-manager.php";
	 
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	

 
 
$inforesult = mysql_query("SELECT * FROM free_music ORDER BY id DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM free_music ORDER BY id DESC"),0);	
 

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
<td><b><?php echo stripslashes($info['artist']); ?></b><br><?php echo stripslashes($info['title']); ?></td>
	<td>
	<a href="freemusic-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="padding: 2px; color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
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
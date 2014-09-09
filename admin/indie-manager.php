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
        <li><a href="indie-manager.php"><span style="font-weight: bold;">+</span> View All Things</a></li>
        <li><a href="indie-manager.php?do=add-track"><span style="font-weight: bold;">+</span> Add Item</a></li>
      </ul>
      </div>
<br />

    
     <div class="rounded">
<?php
if($_GET['do'] == 'add-track')
 {
 
 if (isset($_POST['submitted'])) {
   
   
   

mysql_select_db('edge_programs'); 

$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
$description = addslashes($_POST['description']);
$soundcloud = addslashes($_POST['soundcloud']);


  if(!empty($_FILES['imagefile']['name'])) {
   include 'resize.image.class.php';
$pid1 = $_POST['id'];
$idir1 = "/home/edge/public_html/programs/indie-tas/images/";   // Path To Images Directory 
$url1 = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy1 = copy($_FILES['imagefile']['tmp_name'], "$idir1" . $_FILES['imagefile']['name']);
$image = new Resize_Image;
$image->new_width = 700;
$image->image_to_resize = '/home/edge/public_html/programs/indie-tas/images/'.$url1.''; // Full Path to the file
$image->ratio = true;
$image->new_image_name = 'blog_'.$pid1.'_'.$_FILES['imagefile']['name'];
$image->save_folder = '/home/edge/public_html/programs/indie-tas/images/';
$process = $image->resize();
$blogimg = 'http://www.edgeradio.org.au/programs/indie-tas/images/blog_'.$pid1.'_'.$_FILES['imagefile']['name'].'';
}


 $query1 = "INSERT INTO indie_tas (title, image, soundcloud, description, date) 
 VALUES 
 ('$title', '$blogimg', '$soundcloud', '$description', NOW())";
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
<form enctype="multipart/form-data" action="indie-manager.php?do=add-track" method="post">
<h1 class="greyheader">Add Indie Tasmania Track</h1>
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Title</b></td>
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
   <tr>
	<td style="width: 100px;"><b>Image</b></td>
	<td><input type="file" style="border:solid 1px #990000;" name="imagefile" class="form"></td>
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

$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
$description = addslashes($_POST['description']);
$soundcloud = addslashes($_POST['soundcloud']);


  if(!empty($_FILES['imagefile']['name'])) {
   include 'resize.image.class.php';
$pid1 = $_POST['id'];
$idir1 = "/home/edge/public_html/programs/indie-tas/images/";   // Path To Images Directory 
$url1 = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy1 = copy($_FILES['imagefile']['tmp_name'], "$idir1" . $_FILES['imagefile']['name']);
$image = new Resize_Image;
$image->new_width = 700;
$image->image_to_resize = '/home/edge/public_html/programs/indie-tas/images/'.$url1.''; // Full Path to the file
$image->ratio = true;
$image->new_image_name = 'blog_'.$pid1.'_'.$_FILES['imagefile']['name'];
$image->save_folder = '/home/edge/public_html/programs/indie-tas/images/';
$process = $image->resize();
$blogimg = 'http://www.edgeradio.org.au/programs/indie-tas/images/blog_'.$pid1.'_'.$_FILES['imagefile']['name'].'';
 $query1 = "UPDATE indie_tas SET title='$title', image='$blogimg', soundcloud='$soundcloud', description='$description' WHERE id='$id'";
} else {
 $query1 = "UPDATE indie_tas SET title='$title', soundcloud='$soundcloud', description='$description' WHERE id='$id'";
}



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
$inforesult = mysql_query("SELECT * FROM indie_tas WHERE id = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="indie-manager.php?do=edit" method="post">
<h1 class="greyheader">Edit Indie Tasmania Track</h1>
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Title</b></td>
	<td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo stripslashes($info['title']); ?>" /></td>
	</tr>
   <tr>
	<td style="width: 100px;"><b>Soundcloud</b></td>
   <td><input name="soundcloud" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['soundcloud']); ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Description</b></td>
   <td><textarea name="description" style="border:solid 1px #990000;" rows="4" cols="40"><?php echo stripslashes($info['description']); ?></textarea></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>New Image</b></td>
	<td><input type="file" style="border:solid 1px #990000;" name="imagefile" class="form"></td>
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
   $deletequery = mysql_query("DELETE FROM indie_tas WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;indie-manager.php' />";
   } else {
    echo'
       <h1 class="greyheader">OH!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;indie-manager.php' />";
    }
 } else {
  
	 ?>
	 

    <h1 class="title-head-right">INDIE TAS MANAGER</h1>
  	 <table style="width: 100%;" cellpadding="10" cellspacing="0">
<tr>
	<td><b>Title</b></td>
	<td style="width: 110px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];


   $myquery = "SELECT COUNT(*) as num FROM indie_tas ORDER BY id DESC";
   
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	

	 $targetpage = "indie-manager.php";
	 
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	

 
 
$inforesult = mysql_query("SELECT * FROM indie_tas ORDER BY id DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM indie_tas ORDER BY id DESC"),0);	
 

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
	<a href="indie-manager.php?do=edit&id=<?php echo $info['id']; ?>" style="padding: 2px; color: #FF9900; font-weight: bold; text-decoration: none;">Edit</a><a href="indie-manager.php?do=delete&id=<?php echo $info['id']; ?>" style="padding: 2px; color: #FF0000; font-weight: bold; text-decoration: none;">Delete</a></td>
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
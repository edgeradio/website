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
            <div class="indentmenu">
        <ul>
        <li><a href="blog-program.php?id=<?php echo $_GET['id']; ?>&do=add"><span style="font-weight: bold;">+</span> Add New Blog Post</a></li>
      </ul>
      </div>
<br />
    
     <div class="rounded">
<?php
 
    $id = $_GET['id'];
 $uid = $user->data['user_id'];
 $inforesult = mysql_query("SELECT * FROM program_info WHERE id='$id' AND presenter_1='$uid' OR presenter_2='$uid' OR presenter_3='$uid'");
 $countit = mysql_num_rows($inforesult);
 if($countit != '0') {
 
 if($_GET['do'] == 'add')
 {
  ?>
  <h1 class="greyheader">ADD NEW BLOG POST</h1>
  <?php
  if(!empty($_POST['title']) && !empty($_POST['body']))
{
 
 
  if(!empty($_FILES['imagefile']['name'])) {
   include 'resize.image.class.php';
$pid1 = $_POST['id'];
$idir1 = "/home/edge/public_html/programs/images/";   // Path To Images Directory 
$url1 = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy1 = copy($_FILES['imagefile']['tmp_name'], "$idir1" . $_FILES['imagefile']['name']);
$image = new Resize_Image;
$image->new_width = 470;
$image->image_to_resize = '/home/edge/public_html/programs/images/'.$url1.''; // Full Path to the file
$image->ratio = true;
$image->new_image_name = 'blog_'.$pid1.'_'.$_FILES['imagefile']['name'];
$image->save_folder = '/home/edge/public_html/programs/images/';
$process = $image->resize();
$blogimg = '
www.edgeradio.org.au/programs/images/blog_'.$pid1.'_'.$_FILES['imagefile']['name'].'';
}
 
 $pageid = $_POST['id'];
	$title = mysql_real_escape_string($_POST['title']);
    $body = $_POST['body'];
    $audio = mysql_real_escape_string($_POST['audio']);
    
     	$registerquery = mysql_query("INSERT INTO blog_posts (title, body, img, audio, show_id, date) VALUES('".$title."', '".$body."', '".$blogimg."', '".$audio."', '".$pageid."', NOW())");
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Wooo! The blog post has successfully been added.</p>
			<p><a href=\"http://www.edgeradio.org.au/admin/test/blog-program.php?id=" . $_GET['id'] . "\">Return to blogs</a>.</p>";
			
			$gnid = $_GET['id'];

$inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l:%i %p') as start_time, DATE_FORMAT(end_time, '%l:%i %p') as end_time FROM program_info WHERE id='$gnid'");
 while ($info = mysql_fetch_array($inforesult)) {
  $nameid = str_replace(" ","-",$info['title']);
  echo'<p><a target="_blank" href="http://www.edgeradio.org.au/programs/' . $info['day_time'] . '/blogs/' . $nameid . '/"><b>Preview My Program Blog</b></a></p>';
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
	?>
    <p>Add a new blog post here to publish and share with your listeners!</p>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript" src="http://www.edgeradio.org.au/java/nicYoutubeVideo.js"></script> <script type="text/javascript"> bkLib.onDomLoaded(function() { 
     
	 new nicEditor({buttonList : ['fontSize','bold','italic','underline','youtubevideo','link','html','removeformat','xhtml']}).panelInstance('area1');
}); </script>
	<form method="post" enctype="multipart/form-data" action="blog-program.php?id=<?php echo $_GET['id']; ?>&do=add" name="registerform" id="registerform">
		<table style="width: 550px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 150px; text-align: right;">Blog Title <span style="color: #FF0000;">*</span></td>
	<td><input type="text" style="border:solid 1px #990000;" name="title" id="title" /></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;">Body <span style="color: #FF0000;">*</span><br><small>(HTML Not Allowed!)</small></td>
	<td><textarea style="border:solid 1px #990000; width: 400px; height: 300px;" id="area1" name="body" wrap="ON"></textarea></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;">Image<br><small>Optional</small></td>
	<td><input type="file" style="border:solid 1px #990000;" name="imagefile" class="form"></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;">Audio Link<br><small>Optional<br>Link to an mp3 file and it will be included in this blog post. (MP3 ONLY!)</small></td>
	<td><input type="text" style="border:solid 1px #990000;" value="" name="audio" /></td>
</tr>
<tr>
	<td style="width: 150px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Add Blog Post" /><input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" /></td>
</tr>
</table>
	</form>
    
   <?php
}
  
  } elseif($_GET['do'] == 'edit') {
   
     if(!empty($_POST['title']))
{

  if(!empty($_FILES['imagefile']['name'])) {
   include 'resize.image.class.php';
$pid1 = $_POST['id'];
$idir1 = "/home/edge/public_html/programs/images/";   // Path To Images Directory 
$url1 = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy1 = copy($_FILES['imagefile']['tmp_name'], "$idir1" . $_FILES['imagefile']['name']);
$image = new Resize_Image;
$image->new_width = 470;
$image->image_to_resize = '/home/edge/public_html/programs/images/'.$url1.''; // Full Path to the file
$image->ratio = true;
$image->new_image_name = 'blog_'.$pid1.'_'.$_FILES['imagefile']['name'];
$image->save_folder = '/home/edge/public_html/programs/images/';
$process = $image->resize();
$img = 'http://www.edgeradio.org.au/programs/images/blog_'.$pid1.'_'.$_FILES['imagefile']['name'].'';
$pageid = $_GET['blogid'];
$title = mysql_real_escape_string($_POST['title']);
$body = $_POST['body'];
$audio = mysql_real_escape_string($_POST['audio']);
$registerquery = mysql_query("UPDATE blog_posts SET title='$title', body='$body', audio='$audio', img='$img' WHERE id='$pageid'");
} else {
$pageid = $_GET['blogid'];
$title = mysql_real_escape_string($_POST['title']);
$body = $_POST['body'];
$audio = mysql_real_escape_string($_POST['audio']);
$registerquery = mysql_query("UPDATE blog_posts SET title='$title', body='$body', audio='$audio', img='$img' WHERE id='$pageid'");
 }
 
        if($registerquery)
        {
        	echo "<h1>Success</h1>";
        	echo "
			<p>Wooo! The blog post has successfully been edited.</p>
			<p><a href=\"http://www.edgeradio.org.au/admin/test/blog-program.php?id=" . $_GET['id'] . "\">Return to blogs</a>.</p>";
        }
        else
        {
     		echo "<h1>Error</h1>";
        	echo "<p>Sorry, that failed. Please go back and try again.</p>";    
        } 


   	
}
else
{
 $blogid = $_GET['blogid'];
 $inforesult = mysql_query("SELECT * FROM blog_posts WHERE id='$blogid'");
while ($info = mysql_fetch_array($inforesult)) {
 
	?>
	<h1 class="greyheader">EDIT BLOG POST</h1>
    <p>Edit your blog post.</p>
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript" src="http://www.edgeradio.org.au/java/nicYoutubeVideo.js"></script> <script type="text/javascript"> bkLib.onDomLoaded(function() { 
     
	 new nicEditor({buttonList : ['fontSize','bold','italic','underline','youtubevideo','link','html','removeformat','xhtml']}).panelInstance('area1');
}); </script>
	<form method="post" enctype="multipart/form-data" action="blog-program.php?id=<?php echo $_GET['id']; ?>&do=edit&blogid=<?php echo $_GET['blogid']; ?>" name="registerform" id="registerform">
		<table style="width: 550px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 150px; text-align: right;">Blog Title <span style="color: #FF0000;">*</span></td>
	<td><input type="text" style="border:solid 1px #990000;" name="title" value="<?php echo $info['title']; ?>" id="title" /></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;">Body <span style="color: #FF0000;">*</span><br><small>(HTML Not Allowed!)</small></td>
	<td><textarea style="border:solid 1px #990000; width: 400px; height: 300px;" id="area1" name="body" wrap="ON"><?php echo $info['body']; ?></textarea></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;">New Image<br><small>Optional</small></td>
	<td><input type="file" style="border:solid 1px #990000;" name="imagefile" class="form"></td>
</tr>
<tr>
	<td style="width: 150px; text-align: right;">Audio Link<br><small>Optional<br>Link to an mp3 file and it will be included in this blog post. (MP3 ONLY!)</small></td>
	<td><input type="text" style="border:solid 1px #990000;" value="<?php echo $info['audio']; ?>" name="audio" /></td>
</tr>
<tr>
	<td style="width: 150px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="register" id="register" value="Edit Blog Post" /><input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" /></td>
</tr>
</table>
	</form>
    
   <?php
   }
}
   
 } elseif($_GET['do'] == 'delete') {
   $bid = $_GET['blogid'];
   $deletequery = mysql_query("DELETE FROM blog_posts WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted blog post!</p>';
   echo "<meta http-equiv='refresh' content='=2;blog-program.php?id=".$_GET['id']."' />";
   } else {
    echo'
       <h1 class="greyheader">DELETED!</h1>
   <p>Uh, crap. That program didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;blog-program.php?id=".$_GET['id']."' />";
    }
 } else {
  
	 ?>
    
    <h1 class="greyheader">EDIT BLOGS</h1>
    <p>Here, you can add/edit blog posts on your program pages. Blogs are useful for letting listeners know about certain features in your show, sharing links from around the world wide web or even just sharing music/articles that you like with your listeners. Start blogging!</p>
    <br />
  	 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
	<td><b>Post Title</b></td>
	<td style="width: 100px;"><b>Date Published</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];
$inforesult = mysql_query("SELECT *, DATE_FORMAT(date,'%D %M %Y<br>%r') as date FROM blog_posts WHERE show_id='$id' ORDER BY date DESC");
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
	<td><?php echo $info['title']; ?></td>
	<td><?php echo $info['date']; ?></td>
	<td><a href="blog-program.php?id=<?php echo $id; ?>&do=edit&blogid=<?php echo $info['id']; ?>" style="color: #FF9900; font-weight: bold; text-decoration: none;">Edit Post</a><br><a href="blog-program.php?id=<?php echo $id; ?>&do=delete&blogid=<?php echo $info['id']; ?>" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>
</tr>
<?php
$count++;
}
?>
</table>
<br>


    <?php
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
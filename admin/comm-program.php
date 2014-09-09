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
 
 if($_GET['do'] == 'approve') {
 
  $bid = $_GET['commentid'];
   $appquery = mysql_query("UPDATE comments SET approved='1' WHERE id='$bid'");
   
   if($appquery)
        {
   echo'
   <h1 class="greyheader">APPROVED!</h1>
   <p>Successfully approved comment!</p>';
   echo "<meta http-equiv='refresh' content='=2;comm-program.php?id=".$_GET['id']."' />";
   } else {
    echo'
       <h1 class="greyheader">OH.</h1>
   <p>Uh, crap. That comment didnt approve for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;comm-program.php?id=".$_GET['id']."' />";
    }
 
 } elseif($_GET['do'] == 'delete') {
  
   
  $bid = $_GET['commentid'];
   $appquery = mysql_query("UPDATE comments SET approved='0' WHERE id='$bid'");
   
   if($appquery)
        {
   echo'
   <h1 class="greyheader">DELETED!</h1>
   <p>Successfully deleted comment!</p>';
   echo "<meta http-equiv='refresh' content='=2;comm-program.php?id=".$_GET['id']."' />";
   } else {
    echo'
       <h1 class="greyheader">OH.</h1>
   <p>Uh, crap. That comment didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;comm-program.php?id=".$_GET['id']."' />";
    }
  
  } else {
 
?>


<h1 class="redheader">NOTICE: FAKE COMMENTS</h1>
<p>Please note that posting comments on your own program pages under fake names is not cool, just sad. Save yourself the embarrassment and leave the comments to your listeners to post. We CAN trace who posted comments on program pages, and we laugh.</p>
</div>
<br>
<div class="rounded">
    <h1 class="greyheader">COMMENTS</h1>
    <?php
 
	?>
	     <p>Visitors to your program page often like to give feedback or comment on your program, you may approve/delete comments here. Once the comments are approved, they will be displayed on your program page.</p>
	     <p>Why do you need to approve comments before the public can see them? Well duh, you may get the occasional party pooper or spambot that says some inappropriate things, we wouldn't want that! So please, keep your moderated comments clean!</p>
 <table style="width: 100%;" cellpadding="5" cellspacing="0">
<tr>
	<td><b>Name</b></td>
	<td style="width: 100px;"><b>Date</b></td>
	<td style="width: 120px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];
 $comresult = mysql_query("SELECT *, DATE_FORMAT(date, '%D %M, %Y') as sd FROM comments WHERE show_id='$id' AND approved != '0' ORDER BY approved ASC");
 while ($com = mysql_fetch_array($comresult)) {
  ?>
<tr>
	<td><?php echo $com['name']; ?> Says...<br><div style="padding: 5px; background-color: #F2F2F2; font-size: 10px; font-style: italic;"><?php echo $com['body']; ?></div></td>
	<td style="width: 100px;"><?php echo $com['sd']; ?></td>
	<?php 
	if($com['approved'] == 0) {
	 echo '<td style="width: 120px;"><a href="comm-program.php?id=' . $id . '&do=approve&commentid=' . $com['id'] . '" style="color: #339966; font-weight: bold; text-decoration: none;">Approve</a><br><a href="comm-program.php?id=' . $id . '&do=delete&commentid=' . $com['id'] . '" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>';
	 } else {
	  echo '<td style="width: 120px;"><a href="comm-program.php?id=' . $id . '&do=delete&commentid=' . $com['id'] . '" style="color: #FF0000; text-decoration: none; font-weight: bold;">Delete</a></td>';
	  }
	?>
</tr>
<?php
}
?>
</table>
    
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
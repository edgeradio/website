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
    
    <h1 class="greyheader">PROGRAM APPLICATION MANAGER</h1>
    <p>Chon chon.</p>
<?php

if($_POST['submit']) {

$status = $_POST['status'];
$training = $_POST['training'];
$registerquery = mysql_query("UPDATE programapp_status SET status='$status', training='$training'");
echo'Done!';
} else {

$inforesult = mysql_query("SELECT * FROM programapp_status LIMIT 1",$db);

while ($info = mysql_fetch_array($inforesult)) {
   
?>
<form method="post" enctype="multipart/form-data" action="http://www.edgeradio.org.au/admin/apply-manager.php" name="registerform">
<b>Section Status:</b><br>
<input type="radio" name="status" value="0" <?php if($info['status'] == 0) { echo'checked'; } ?>> Disabled (Closed for applications)<br>
<input type="radio" name="status" value="1" <?php if($info['status'] == 1) { echo'checked'; } ?>> Enabled (Open for applications)

<br><br>

<b>Training Information:</b><br>
<textarea name="training" rows="5" cols="50">
<?php echo $info['training']; ?>
</textarea>

<br>

<input type="submit" style="border:solid 1px #990000;" name="submit" id="submit" value="Submit" />
</form>
<?php
}
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
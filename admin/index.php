<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/admin_navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
     <?php
     
 $userid = $user->data['user_id'];
 mysql_select_db('edge_programs'); 
 $inforesult = mysql_query("SELECT * FROM program_info WHERE presenter_1='$userid' OR presenter_2='$userid' OR presenter_3='$userid'");
$info = mysql_num_rows($inforesult);
if($info || $user->data['group_id'] == 5 || $user->data['group_id'] == 4) {

?>

       <div id="left_column">
    <?php
 include'sidebar.php';
    ?>
          </div>
    <div style="padding-top: 65px;" id="two_column">
    <div class="rounded">
   <h1 class="title-head-right">Welcome</h1>
   <p style="line-height: 16px;">Welcome to the Edge Radio admin panel. This is where presenters can control their program pages, volunteers can add music to the catalogue and staff can access various forms, control panels and options for the website. You can navigate using the panel on the right. It lists various options including your programs (if you have any) which are highlighted in red. </p>
   
   <p style="line-height: 16px;">The admin panel is strictly controlled by staff, this means any changes to settings or program pages that go against Edge Radio's rules will be actioned on. We want to keep our website clean, well moderated and family friendly. Remember we are a community radio station! Any volunteers adding music to the catalogue from a non-edge computer will be reported and blocked.</p>
   </div>
   <br />
   
   <div class="rounded">
   <h1 class="title-head-right">Interviews Available</h1>
   <table style="width: 100%;" cellpadding="10" cellspacing="0">
  <?php
  mysql_select_db('edge_content'); 
  
  $inforesult = mysql_query("SELECT *, DATE_FORMAT(date_start, '%D %M %Y') as dates, DATE_FORMAT(date_end, '%D %M %Y') as datee FROM interviews WHERE status = 'available' ORDER BY id DESC, dates DESC LIMIT 5",$db);
  
  $any = mysql_num_rows($inforesult);
  if($any == 0) {
  echo'<span class="title">No Interviews Currently Available! Check Back Soon!</span><br><br>';
  }

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
<td><span class="title"><?php echo $info['name']; ?></span><br>
<b>Dates Available:</b> <?php echo $info['dates']; ?> Until <?php echo $info['datee']; ?>
<p><i><?php echo $info['description']; ?></i></p>
<p><i><?php echo $info['extra_notes']; ?></i></p>
</td>
	<td style="width: 120px;"><a href="presenter-interview.php" style="color: #000000; background-color: #3DD43D; -moz-border-radius:5px; -webkit-border-radius:5px; border-radius:5px; font-weight: bold; padding: 10px; text-decoration: none;">View Interview</a></td>
</tr>
<?php
$count++;
}
?>
</table>
  
  
   </div>
   <br />
   
   <div class="rounded">
   <h1 class="title-head-right">Latest Comments</h1>
 <?php
 mysql_select_db('edge_programs'); 
 
 
 ?>
  <table style="width: 100%;" cellpadding="10" cellspacing="0">
<?php
 $comresult = mysql_query("SELECT *, DATE_FORMAT(date, '%D %M, %Y') as sd FROM comments WHERE approved = '1' ORDER BY date DESC LIMIT 5");
 while ($com = mysql_fetch_array($comresult)) {
	$show_id = $com['show_id'];
  ?>
<tr>
	<td><span class="title"><?php echo $com['name']; ?> Says...</span><br>
	<div style="line-height: 18px; padding: 10px; color: #FFFFFF; background-color: #C92828; background-image: url(http://www.edgeradio.org.au/images/edge-comm-bg.png); background-repeat: repeat-x; font-size: 12px;"><?php echo stripslashes($com['body']); ?></div></td>
</tr>
<?php
}
?>
</table>
 <?php
 
 
 ?>
 
   </div>
   <br />
   
   <div class="rounded">
   <h1 class="title-head-right">Feedback, Suggestions or Comments</h1>
   <p style="line-height: 16px;">We're open to new ideas, feedback or suggestions to improve the front end or admin back end of Edge Radio's website. This may include a new feature on the program pages, a new feature to help you present your program better or a new feature to help the staff!</p>
   
   <p style="line-height: 16px;">If you have some gnarly ideas, please send an email to <a href="mailto:manager@edgeradio.org.au">manager@edgeradio.org.au</a>.</p>
   
   
   
      <?php
}
else
{
  echo "<div class=\"rounded\">
   <h1 class=\"title\" style=\"font-size: 78px;\">WOAH</h1>";
        echo "<p class=\"title\">You either don't have the right access privileges or you need to log in via the login box on the top of this page before you can access this!</p>";
        echo "<p class=\"title\">VOLUNTEERS NOTE: We have recently updated the admin panel, if you are not registered for the soapbox or you haven't received access to the admin panel, please email <a href=\"mailto:webguy@edgeradio.org.au\">James</a>.</p>";
    
}
?>
</div>
 <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
</div>

<?php include '../templates/common_end.php'; ?>
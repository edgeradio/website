
 <?php if($user->data['group_id'] == 5)
{ ?>
 <div class="rounded">
 <div class="title-head-sidebar">ADMIN TOOLS</div>
<ul class="admin-light">
	<li><a href="index.php">Admin Index</a></li>
	</ul><br>
<ul class="admin-light">	
	<li><a href="program.php">Program Manager</a></li>
	<li><a href="special-program.php">Special Event Manager</a></li>
	<li><a href="woe-manager.php">This Week On Edge Manager</a></li>
	<li><a href="apply-manager.php">Program Application Manager</a></li>
	<li><a href="indie-manager.php">Indie Tas Manager</a></li>
	<li><a href="int-manager.php">Interview Page Manager</a></li>
	<li><a href="music-manager.php">Music Catalogue</a></li>
	</ul><br>
<ul class="admin-light">
	<li><a href="shop-manager.php">Shop Manager</a></li>
	<li><a href="banner-manager.php">Banner Manager</a></li>
	<li><a href="interview-manager.php">Interview Panel Manager</a></li>
	<li><a href="gig-manager.php">Gig Guide Manager</a></li>
	<li><a href="studio-messages.php">Studio Message Manager</a></li>
</ul><br>

<ul class="admin-light">
	<li><a href="sponsor-manager.php">Sponsor Manager</a></li>
	<li><a href="prizes-manager.php">Prizes Manager</a></li>
	</ul><br>

<ul class="admin-light">
	<li><a href="http://airnet.org.au/station/login.php?id=6">AMRAP Admin</a></li>
	<li><a href="http://edgeradio.org.au/blog/wp-login.php">Edge News Admin (Wordpress)</a></li>
</ul><br><br>
 </div>
 <br />
 <?php } ?>
 
    <?php if($user->data['group_id'] == 5)
{ ?>
<!-- <div class="rounded">
 <div class="title-head-sidebar">EMAIL TOOLS</div>
<ul class="admin-light">
<li><a href="newsletter-manager.php">Send Newsletter</a></li>
<li><a href="supporter-db.php">Subscriber/Supporter Manager</a></li>
<li><a href="volunteer-db.php">Volunteer Manager</a></li>
</ul><br>
 </div>
 <br /> -->
 <?php } ?>
 
     <?php if($user->data['group_id'] == 5)
{ ?>
<!-- <div class="rounded">
 <div class="title-head-sidebar">EVENT TOOLS</div>
<ul class="admin-light">
	<li><a href="amp-manager.php">Amplified Manager</a></li>
</ul><br>
 </div>
 <br /> -->
 <?php } ?>
 
  
 <?php if($user->data['group_id'] != 4)
{ ?>
  <div class="rounded">
 <div class="title-head-sidebar">PRESENTER RESOURCES</div>
<ul class="admin-light">
 <li><a href="wo-manager.php">This Week On Edge</a></li>
 <li><a href="presenter-interview.php">Interviews Available</a></li>
</ul><br>

<ul class="admin-light"> 
 <li><a href="handbook.pdf">Station Handbook (PDF)</a></li>
 <li><a href="http://cbaa.org.au/Code-of-Practice">Codes of Practice</a></li>
 <li><a href="http://airit.org.au/web/Amrap_Pages/Amrap_Pages_Broadcaster_Guide.pdf">AMRAP Pages Guide (PDF)</a></li>
 <li><a href="videoguides.php">Video Guides</a></li>
</ul><br>
 </div>
 <br />
<?php } ?>

 <?php 
 $userid = $user->data['user_id'];
 mysql_select_db('edge_programs'); 
 $inforesult = mysql_query("SELECT * FROM program_info WHERE presenter_1='$userid' OR presenter_2='$userid' OR presenter_3='$userid'");
while ($info = mysql_fetch_array($inforesult)) { ?>
  <div class="rounded">
 <div class="title-head-sidebar" style="background-color: #333333;"><img style="width: 20px; height: 20px; margin-right: 10px; float: right;" src="<?php echo $info['sml_img']; ?>"><?php echo $info['title']; ?></div>
 
 <ul class="admin-light">
<li><a href="welcome.php?id=<?php echo $info['id']; ?>"><b>Get Started</b></a></li>
</ul>
<br>
 
<ul class="admin-light">
	<li><a href="presenter-program.php?id=<?php echo $info['id']; ?>">Edit Program</a></li>
  <li><a href="blog-program.php?id=<?php echo $info['id']; ?>">Edit/Add Blog</a></li>
  <?php 
  $show_id = $info['id'];
  $comments = mysql_query("SELECT * FROM comments WHERE show_id='$show_id' AND approved=''"); 
  $commcount = mysql_num_rows($comments);
  ?>
  <li><a href="comm-program.php?id=<?php echo $info['id']; ?>"><b><?php echo $commcount; ?></b> Pending Comments</a></li>
</ul><br>
<ul class="admin-light">
<li><a target="_blank" href="http://www.edgeradio.org.au/program/<?php echo str_replace(' ', '-', $info['seotitle']); ?>/"><b>Preview My Page</b></a></li>
</ul>
 </div>
 <br />
 
 <?php } 
 mysql_select_db('edge_users'); 
 ?>
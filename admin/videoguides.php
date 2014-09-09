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
if($info || $user->data['group_id'] == 5 || $user->data['group_id'] == 4) {

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
 
 $id = $info['id'];
 $uid = $user->data['user_id'];
 $inforesult = mysql_query("SELECT * FROM program_info WHERE id='$id' AND presenter_1='$uid' OR presenter_2='$uid' OR presenter_3='$uid'");
  ?>
	<h1 class="title-head-right">Video Guides</h1>
	<img style="float: right; width: 300px; height: 250px; margin: 10px;" src="../images/thanks.jpg">
    <p>First of all, welcome to Edge Radio 99.3FM! Thanks for volunteering with us and contributing such valuable radio content towards the Hobart community.</p>
    
    <p>We understand that not everybody can work their way around a computer, but you are making a great start by visiting this page first! If you are unsure of what to do, feel free to email any staff member or pop in and see us and we can show you your way around our website.</p>
    
    <p>This is the Admin Panel, it is where you can edit your program page, add blogs, view/approve comments, book interviews and browse the full music catalogue. Wicked eh?</p>
    
    <p>We recommend utilising the website and admin panel, take advantage of what is on offer. Trust us, it will make your life easier and will attract an audience to your show if you give it 110%!</p>
    
    <p>We have listed some things in order below that we recommend you do, these will assist in building an audience, making your page look pretty and making your show fun/exciting!</p>
    
    </div>
    <br />
    <div class="rounded">
    <h1 class="title-head-right">Switching from Automation to Live Assist</h1>
    <p align="center">Coming Soon...</p><br>
    </div><br>
    <div class="rounded">
    <h1 class="title-head-right">Inserting a pause in the chain event</h1>
    <p align="center">Coming Soon...</p><br>
    </div><br>
    <div class="rounded">
    <h1 class="title-head-right">Skipping tracks</h1>
    <p align="center">Coming Soon...</p><br>
    </div><br>
    <div class="rounded">
    <h1 class="title-head-right">How to search for an artist</h1>
    <p align="center"><iframe width="640" height="480" src="//www.youtube.com/embed/NNhk7NMdsMc" frameborder="0" allowfullscreen></iframe></p><br>
    </div><br>
    <div class="rounded">
    <h1 class="title-head-right">Recording your program</h1>
    <p align="center">Coming Soon...</p><br>
    </div><br>
    <div class="rounded">
    <h1 class="title-head-right">Using AMRAP Pages to playlist your program</h1>
    <p align="center">Coming Soon...</p><br>
 

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


<?php include '../templates/common_end.php'; ?>
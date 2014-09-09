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
	<h1 class="title-head-right">Post to Social Networks</h1>
	<img style="float: right; width: 300px; height: 250px; margin: 10px;" src="../images/zuckerberg.jpg">
    <p>First of all, welcome to Edge Radio 99.3FM! Thanks for volunteering with us and contributing such valuable radio content towards the Hobart community.</p>
    
    <p>We understand that not everybody can work their way around a computer, but you are making a great start by visiting this page first! If you are unsure of what to do, feel free to email any staff member or pop in and see us and we can show you your way around our website.</p>
    
    <p>This is the Admin Panel, it is where you can edit your program page, add blogs, view/approve comments, book interviews and browse the full music catalogue. Wicked eh?</p>
    
    <p>We recommend utilising the website and admin panel, take advantage of what is on offer. Trust us, it will make your life easier and will attract an audience to your show if you give it 110%!</p>
    
    <p>We have listed some things in order below that we recommend you do, these will assist in building an audience, making your page look pretty and making your show fun/exciting!</p>
    
    </div>
    <br />
    <div class="rounded">
    <h1 class="title-head-right">Post to Facebook and Twitter</h1>
    <p>
<iframe width="100%" height="378" allowTransparency="true" frameborder="0" scrolling="no" style="border:none" src="http://www.emailmeform.com/builder/embed/fBb2c0q1U78KD49fWNby9dJda"><a href="http://www.emailmeform.com/builder/embed/fBb2c0q1U78KD49fWNby9dJda">Fill out form.</a></iframe>
<div style="margin-top:18px;text-align:center"><script type="text/javascript">generate_css_for_emf_ad();</script><div id='emf_advertisement'><font face="Verdana" size="2" color="#000000">Powered by</font><span style="position: relative; padding-left: 3px; bottom: -5px;"><img src="http://www.emailmeform.com/builder/images/footer-logo.png" /></span><font face="Verdana" size="2" color="#000000">EMF </font><a style="text-decoration:none;" href="http://www.emailmeform.com/" target="_blank"><font face="Verdana" size="2" color="#000000">Web Form</font></a></div></div>
    </p>

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
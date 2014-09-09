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
	<h1 class="title-head-right">Let's Get Started!</h1>
	<img style="float: right; width: 300px; height: 250px; margin: 10px;" src="../images/thanks.jpg">
    <p>First of all, welcome to Edge Radio 99.3FM! Thanks for volunteering with us and contributing such valuable radio content towards the Hobart community.</p>
    
    <p>We understand that not everybody can work their way around a computer, but you are making a great start by visiting this page first! If you are unsure of what to do, feel free to email any staff member or pop in and see us and we can show you your way around our website.</p>
    
    <p>This is the Admin Panel, it is where you can edit your program page, add blogs, view/approve comments, book interviews and browse the full music catalogue. Wicked eh?</p>
    
    <p>We recommend utilising the website and admin panel, take advantage of what is on offer. Trust us, it will make your life easier and will attract an audience to your show if you give it 110%!</p>
    
    <p>We have listed some things in order below that we recommend you do, these will assist in building an audience, making your page look pretty and making your show fun/exciting!</p>
    
    </div>
    <br />
    <div class="rounded">
    <h1 class="title-head-right">1. Edit Your Program Page</h1>
    <a href="#" style="text-decoration: none; color: #000000;" class="title">Customise Your Page</a>
    <p>If you have some images, logos and fun stuff to add to your page, you can upload them and display them instantly on your program page.</p>
    
    <a href="#" style="text-decoration: none; color: #000000;" class="title">Add some details about your program</a>
    <p>Sometimes a program title just isn't enough. Some people may want to know a bit more about your program or yourself. Why not add a paragraph or two?</p>
    
    <a href="#" style="text-decoration: none; color: #000000;" class="title">Link your social media and website</a>
    <p>Social media is all the rage, everyone loves it, even us! So you have the ability to link your Facebook, Twitter and Website to your program page.</p>
    
     </div>
    <br />
    <div class="rounded">
    <h1 class="title-head-right">2. Get Blogging!</h1>
    <a href="#" style="text-decoration: none; color: #000000;" class="title">Add Some Blog Posts</a>
    <p>Everyone seems to have a blog these days! Me, my neighbour, my mother, my mate and even my cat. So we've added a blog to your program page. How sweet is that? Why not blog about your next show, some music you've featured or even about your neighbours, mothers, mates, cat's blog!</p>
    
    <a href="#" style="text-decoration: none; color: #000000;" class="title">Words not enough?</a>
    <p>Fear not! My fellow Edgeling! We have catered for you media monkeys out there and we now allow images, video and audio to be added to your blog posts.</p>
    
       </div>
    <br />
    <div class="rounded">
    <h1 class="title-head-right">3. Let everyone know about you and your show!</h1>
    <a href="#" style="text-decoration: none; color: #000000;" class="title">Add  a 'Whats On Edge' Entry</a>
    <p>Edge Radio's website features the WOE slider on the home page which displays some info and an image of your program and what's coming up on it. To add an entry, click on "This Week On Edge" in the sidebar under Presenter Tools!</p>
    
    <a href="mailto:programs@edgeradio.org.au" style="text-decoration: none; color: #000000;" class="title">Create an on-air advertisement</a>
    <p>The Edge Staff are more than happy to help you promote your show on air, we can help you script and produce a short promo for us to rotate on-air!</p>

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
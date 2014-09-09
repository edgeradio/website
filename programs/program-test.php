<?php
 include '../inc/database.programs.php';
 
 if (isset($_POST['submitted'])) {
include("securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == true) {

$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comment'];
$ip = $_SERVER['REMOTE_ADDR'];
$comment = str_replace("\n", "<br>", $comment);
$comment = mysql_real_escape_string ($comment);
$approved = '0';
$id = $_POST['id'];

if(!empty($name) && !empty($email) && !empty($comment)) {

$rwv = "INSERT INTO comments (show_id, name, email, body, ip, date) VALUES ('$id', '$name', '$email', '$comment', '$ip', NOW())";
$reruil = mysql_query($rwv);

 $comm_fin = '<div class="rounded">
        <h1 class="greyheader">THANKS!</h1>
        <p style="text-align: center; color: #339966;">Your comment has now been submitted to the presenters for approval, once approved, it will be shown below. Check back in a day or two!</p>
        </div><br>';
        } else {
         $comm_fin = '<div class="rounded">
        <h1 class="greyheader">WOAH!</h1>
        <p style="text-align: center; color: #FF0000;">Please fill in all required forms! <a href="javascript:history.go(-1)">Go back</a> to try again.</p>
        </div><br>';
         }
  } else {
    $comm_fin = '<div class="rounded">
        <h1 class="greyheader">WOAH!</h1>
        <p style="text-align: center; color: #FF0000;">Sorry, the code you entered was invalid. <a href="javascript:history.go(-1)">Go back</a> to try again.</p>
        </div><br>';
  }

}
 
 $gnid = $_GET['id'];
 $day = $_GET['day'];
 $nameid = str_replace("-"," ",$gnid);
 $nameid = str_replace("%26","&",$nameid);
 $type = $_GET['type'];
 ?>
 <?php
 $infoprogprogprogresult = mysql_query("SELECT *, DATE_FORMAT(start_time, '%l:%i %p') as start_time, DATE_FORMAT(end_time, '%l:%i %p') as end_time FROM program_info WHERE seotitle='$nameid' AND day_time='$day'",$db);
 $countrow = mysql_num_rows($infoprogprogprogresult);
 while ($infoprogprogprog = mysql_fetch_array($infoprogprogprogresult)) {
  $id = $infoprogprogprog['id'];
  $showtitle = stripslashes($infoprogprogprog['title']);
 ?>
<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="one_column">
    
    <link rel="image_src" href="<?php echo $infoprogprogprog['sml_img']; ?>" />
    
    <?php if($infoprogprogprog['lrg_img']) { ?>
      <div style="padding: 10px; -moz-border-top-left-radius:15px; -webkit-border-top-left-radius:15px; -moz-border-top-right-radius:15px; -webkit-border-top-right-radius:15px; height: 180px; background-image: url(http://edgeradio.org.au/images/bassline.png);">
        </div>
        <?php } ?>
        <div style="background-color: #1A1A1A; padding: 10px;">
        <img style="float: right; margin-top: 5px;" title="Remind Me When Program Airs Via Email" src="http://edgeradio.org.au/images/reminder.png">
       <span class="title" style="font-size: 42px; line-height: 42px; color: #FFFFFF;">BeΔt Culture</span><br>
       <span style="font-size: 18px; letter-spacing: -1px; line-height: 20px; font-weight: bold; color: #FFFFFF;"><?php echo $infoprogprogprog['day_time']; ?> @ 8pm - 9pm</span>
       </div>
        <br />
        
        <div style="float: right; width: 220px;">
        <div class="rounded-side-new" onclick="location.href='http://www.edgeradio.org.au/programs/apply/';" style="background-image: url(http://www.edgeradio.org.au/phpthumb/phpThumb.random.php?dir=./images/leftbanner/&w=220&f=jpeg); cursor: pointer; height: 290px;">
 </div>
 <br />
 <div class="rounded-side-new" onclick="location.href='http://www.edgeradio.org.au/soapbox/';" style="background-image: url(http://www.edgeradio.org.au/images/soapbox.jpg); cursor: pointer; height: 230px;"></div>
        </div>

        <div style="width:760px; margin: 0 auto; text-align:left; height:100%; display:block; position:absolute; top:300px; left:0px;">
        
        <div class="indentmenu" style="width: 760px;">
        <ul>
        <li><a href="http://www.edgeradio.org.au/programs/test/<?php echo $day; ?>/<?php echo $gnid; ?>/">Program Home</a></li>
        <li><a href="http://www.edgeradio.org.au/programs/test/<?php echo $day; ?>/episodes/<?php echo $gnid; ?>/">Episodes</a></li>
        <li><a href="http://www.edgeradio.org.au/programs/test/<?php echo $day; ?>/blogs/<?php echo $gnid; ?>/">Blog</a></li>
		<?php if($infoprogprogprog['fb_link']) { ?><li><a href="http://www.edgeradio.org.au/programs/test/<?php echo $day; ?>/social/<?php echo $gnid; ?>/">Get Social</a></li><?php } ?>
		<li><a href="http://www.edgeradio.org.au/programs/test/<?php echo $day; ?>/sopabox/<?php echo $gnid; ?>/">Soapbox</a></li>
		<li><a href="http://www.edgeradio.org.au/programs/test/<?php echo $day; ?>/contact/<?php echo $gnid; ?>/">Contact</a></li>
      </ul>
      </div>

        
        
        
        <?php
        if($type == 'blogs') {
          ?>
          <?php
          
    $myquery = "SELECT COUNT(*) as num FROM blog_posts WHERE show_id='$id' ORDER BY date DESC";
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "http://www.edgeradio.org.au/programs/blogs/".$_GET['id']."";
	$limit = 5; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
$blogresult = mysql_query("SELECT *, DATE_FORMAT(date, '%D %M, %Y - %h:%i%p') as sd, DATE_FORMAT(date, '%d') as day, DATE_FORMAT(date, '%b') as mon FROM blog_posts WHERE show_id='$id' ORDER BY date DESC LIMIT $start, $limit",$db);

$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM blog_posts WHERE show_id='$id' ORDER BY date DESC"),0);	
	
 if(mysql_num_rows($blogresult) != 0) {
 $count = 0;
 while ($blog = mysql_fetch_array($blogresult)) {

  ?>
<div class="rounded">
		<div style="font-size: 34px; line-height: 40px; font-weight: bold;" class="title"><?php echo $blog['title']; ?></div>
		<div style="font-size: 11px; color: #808080;"><?php echo $blog['sd']; ?></div>
		<?php if(!empty($blog['img'])) { ?>
		<p><img style="width: 470px;" src="<?php echo $blog['img']; ?>"></p>
<?php } ?>
		<p><?php echo $blog['body']; ?></p>
		<?php if(!empty($blog['audio'])) {
		 if($blog['audio'] != 'http://') { ?>
		<p><object type="application/x-shockwave-flash" data="http://www.edgeradio.org.au/inc/player_mp3.swf" width="470" height="20">
    <param name="movie" value="http://www.edgeradio.org.au/inc/player_mp3.swf" />
    <param name="wmode" value="transparent">
    <param name="bgcolor" value="#ffffff" />
    <param name="FlashVars" value="mp3=<?php echo $blog['audio']; ?>&amp;width=470&amp;bgcolor1=FF0000&amp;bgcolor2=F10000&amp;buttoncolor=000000&amp;buttonovercolor=000000&amp;slidercolor1=990000&amp;slidercolor2=990000&amp;sliderovercolor=990000" />
</object></p>
<?php } } ?>
		</div>
		<br>
		
        <?php
        $count++;
        }
        ?>
        <div class="rounded">
       <?php 
    if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;


$pagination = "";
	if($lastpage > 1)
	{	
		//previous button
		if ($page > 1) 
			$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$prev\"><< Previous</a> ";
	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;' >$counter</span> ";
				else
					$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$counter\">$counter</a> ";					
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
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$lastpage\">$lastpage</a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-1\">1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-2\">2</a> ";
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</b> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$lastpage\">$lastpage</a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-1\">1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-2\">2</a> ";
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$counter\">$counter</a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage/page-$next\">Next >></a>";
		
	}
	?>
	<?=$pagination?>
        </div>
        <?php
        } else {
         ?>
         <div class="rounded">
        <h1 class="greyheader">BLOG</h1>
        <center><p>No Blog Posts!</p></center>
         </div>
         <?php
         }
        ?>
        <?php
         } elseif($type == 'social') {
		
		?>
		<div class="rounded">
        <h1 class="greyheader">FACEBOOK ACTIVITY</h1>
		<iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $infoprogprogprog['fb_link']; ?>&amp;width=490&amp;colorscheme=light&amp;show_faces=true&amp;stream=true&amp;header=false&amp;height=600" scrolling="no" frameborder="0" style="border: 0px; overflow:hidden; width:490px; height:600px;" allowTransparency="true"></iframe>
		</div>
		<?php
		
		} elseif($type == 'episodes') {
		
		?>
		<div class="rounded">
        <div id="amrappage"></div>
		</div>
		<?php
		
		} else {
		  
		 
        ?>
        <div style="min-height: 180px; background-color: #F0F0F0;">
        
        <div class="imagepage">

      <img style="margin-top: auto; margin-bottom: auto;" src="http://www.edgeradio.org.au/images/dubstep-promoter.jpg"/>

      <div class="text">
      <div class="title">About</div><p>BeΔt Culture is your local house party! We give you the latest electro, house and dubstep from James' record crate along with the latest tour news, residencies and upcoming events in the Hobart clubbing scene!</p>
      <p>James has been a clubbing connoisseur ever since his first gig when he was 16 years old. He loves finding new bangers and hunting down that underground track that gives you shivers.</p></div>

</div>
        
        </div>
        <br>
                 <?php
            
                 
                 echo $comm_fin;

 $comresult = mysql_query("SELECT *, DATE_FORMAT(date, '%D %M, %Y - %h:%i%p') as sd FROM comments WHERE show_id='$id' AND approved = '1' ORDER BY sd DESC",$db);
 if(mysql_num_rows($comresult) != 0) {
  ?>
        <div class="rounded">
        <h1 class="greyheader">COMMENTS</h1>
        <table style="width: 100%;" cellpadding="10" cellspacing="0">
        <?php
        
 while ($com = mysql_fetch_array($comresult)) {
  ?>
  <tr>
	<td><span class="title"><?php echo $com['name']; ?> Says...</span><br>
	<div style="line-height: 18px; padding: 10px; color: #FFFFFF; background-color: #C92828; background-image: url(http://www.edgeradio.org.au/images/edge-comm-bg.png); background-repeat: repeat-x; font-size: 12px;"><?php echo stripslashes($com['body']); ?></div></td>
	</tr>
<?php
}
?>
        </table><br></div>
        <?php
        } else {
         ?>
         <div class="rounded">
        <h1 class="greyheader">COMMENTS</h1>
        <p style="text-align: center;">Be the first to comment on this program!</p>
        </div>
         <?php
         }
        ?>
                <br />
         <div class="rounded">
        <h1 class="greyheader">ADD A COMMENT</h1>
      <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
<table style="width: 100%; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Your Name</td>
	<td><input style="border: 1px solid rgb(153, 0, 0); padding: 3px;" type="text" name="name" id="name" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Email Address</td>
	<td><input style="border: 1px solid rgb(153, 0, 0); padding: 3px;" type="text" name="email" id="email" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Your Comments</td>
	<td><textarea rows="4" style="width: 300px; border: 1px solid rgb(153, 0, 0); padding: 3px;" name="comment" id="comment"></textarea></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Are You Human?</td>
	<td><img style="padding-bottom: 3px;" src="http://www.edgeradio.org.au/programs/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>"><br />
<input type="text" style="border: 1px solid rgb(153, 0, 0); padding: 3px;" name="code" /></td>
</tr>
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" name="submit" style="border: 1px solid rgb(153, 0, 0); padding: 3px;" value="Submit" /><input type="hidden" name="submitted" value="TRUE" /><input type="hidden" name="id" value="<?php echo $id; ?>" /></td>
</tr>
</table>
      </form>
        </div>
        <?php
        }
        ?>
        <br><br>
      <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>

<?php include '../templates/common_end.php'; ?>
<?php
}

if($countrow == 0) {
 
 include '../inc/common_start.php'; ?>
<body>
<?php include '../inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="http://www.edgeradio.org.au/images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="one_column">
        <div class="rounded">
        <h1 class="greyheader">AH CRAP</h1>
        <p><center>Well, this is awkward! We can't find the program you are looking for!</center></p>
        <p></p>
</div>
        <br><br>
      <div id="footer">
        <?php include '../inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>

<?php include '../inc/common_end.php'; 
 
 }
?>
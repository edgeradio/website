<?php include 'templates/common_start.php'; ?>
<?php
 include 'inc/database.programs.php';
$gnid = $_GET['id'];
 $nameid = str_replace("-"," ",$gnid);
 $nameid = str_replace("%26","&",$nameid);
 ?>
 <?php
 $infoprogprogprogresult = mysql_query("SELECT *, REPLACE(end_time, '00:00:00', '24:00:00'), DATE_FORMAT(start_time, '%H') as 
 _time, DATE_FORMAT(start_time, '%l:%i %p') as start_time, DATE_FORMAT(end_time, '%l:%i %p') as end_time, DATE_FORMAT(r_start_time, '%l:%i %p') as r_start_time, DATE_FORMAT(r_end_time, '%l:%i %p') as r_end_time FROM program_info WHERE seotitle='$nameid' LIMIT 1") or die(mysql_error());
 $countrow = mysql_num_rows($infoprogprogprogresult);
 while ($infoprogprogprog = mysql_fetch_array($infoprogprogprogresult)) {
  $id = $infoprogprogprog['id'];
  $showtitle = stripslashes($infoprogprogprog['title']);
 ?>
<body>
<?php include 'templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="one_column">
    
    <link rel="image_src" href="<?php echo $infoprogprogprog['sml_img']; ?>" />
    
      <div style="padding: 10px; -moz-border-top-left-radius:15px; -webkit-border-top-left-radius:15px; -moz-border-top-right-radius:15px; -webkit-border-top-right-radius:15px; height: 180px; background-image: url(<?php if($infoprogprogprog['xl_img']) { echo $infoprogprogprog['xl_img']; } else { echo'http://www.edgeradio.org.au/images/edge-blank-page.png'; } ?>);">
        </div>
        <div style="background-color: #1A1A1A; padding: 10px; -moz-border-bottom-left-radius:15px; -webkit-border-bottom-left-radius:15px; -moz-border-bottom-right-radius:15px; -webkit-border-bottom-right-radius:15px;">
        
        <?php if($infoprogprogprog['fb_link']) { ?>
        <a href="<?php echo $infoprogprogprog['fb_link']; ?>" target="_blank"><img style="margin-left: 5px; float: right; margin-top: 8px; margin-left: 5px; border: 0px;" title="<?php echo stripslashes($infoprogprogprog['title']); ?>'s Facebook Page" src="http://edgeradio.org.au/images/fb-page.png"></a>
        <?php } ?>
        
        <?php if($infoprogprogprog['twit_link']) { ?>
        <a href="<?php echo $infoprogprogprog['twit_link']; ?>" target="_blank"><img style="margin-left: 5px; float: right; margin-top: 8px; margin-left: 5px; border: 0px;" title="<?php echo stripslashes($infoprogprogprog['title']); ?>'s Twitter" src="http://edgeradio.org.au/images/tw-page.png"></a>
        <?php } ?>
        
        <?php if($infoprogprogprog['web_link']) { ?>
        <a href="<?php echo $infoprogprogprog['web_link']; ?>" target="_blank"><img style="margin-left: 5px; float: right; margin-top: 8px; margin-left: 5px; border: 0px;" title="<?php echo stripslashes($infoprogprogprog['title']); ?>'s Website" src="http://edgeradio.org.au/images/web-page.png"></a>
        <?php } ?>
        
        <?php if($infoprogprogprog['restream_enabled']) { ?>
        <img style="margin-left: 5px; float: right; margin-top: 8px; margin-left: 5px;" title="Previous Episodes" src="http://edgeradio.org.au/images/restream.png">
        <?php } ?>
       <span class="title" style="font-size: 42px; line-height: 42px; color: #FFFFFF;"><?php echo stripslashes($infoprogprogprog['title']); ?></span><br>
       <span style="font-size: 18px; letter-spacing: -1px; line-height: 20px; font-weight: bold; color: #FFFFFF;"><?php echo $infoprogprogprog['day_time']; ?>  <?php echo $infoprogprogprog['start_time']; ?> - <?php echo $infoprogprogprog['end_time']; ?></span>
       <?php if($infoprogprogprog['r_day_time']) { ?>
       <br>
       <span style="font-size: 18px; letter-spacing: -1px; line-height: 20px; font-weight: bold; color: #FFFFFF;"><?php echo $infoprogprogprog['r_day_time']; ?>  <?php echo $infoprogprogprog['r_start_time']; ?> - <?php echo $infoprogprogprog['r_end_time']; ?></span>
       <?php } ?>
       
        </div>
         <br />
        
        <div style="float: left; width: 210px;">
        <?php include'programs/sidebar.php'; ?><br>
        <?php include'music/sidebar.php'; ?>
        </div>
        
            

        <div style="width:770px; margin: 0 auto; text-align:left; height:100%; display:block; float: right;">
        
        <div class="indentmenu" style="width: 770px;">
        <ul>
        <li><a href="http://www.edgeradio.org.au/program/<?php echo $gnid; ?>/playlists/"><?php echo stripslashes($infoprogprogprog['title']); ?></a></li>
        <?php if($infoprogprogprog['restream_enabled'] == 'true') { ?><li><a href="http://www.edgeradio.org.au/program/<?php echo $gnid; ?>/restream/">On Demand</a></li><?php } ?>
        <li><a href="http://www.edgeradio.org.au/program/<?php echo $gnid; ?>/blog/">Blog</a></li>
      </ul>
      </div>
        
        
        <?php
        include 'inc/database.programs.php';
        $type = $_GET['type'];
        if($type == 'blogs') {
          ?>
          <div style="background-color: #F0F0F0; -moz-border-bottom-left-radius:15px; -webkit-border-bottom-left-radius:15px; -moz-border-bottom-right-radius:15px; -webkit-border-bottom-right-radius:15px;">
          
          <div style="font-size: 48px; padding: 15px 10px 15px 10px;" class="title">BLOG.</div>
          </div>
          <br>
          
          <?php
          
    $myquery = "SELECT COUNT(*) as num FROM blog_posts WHERE show_id='$id' ORDER BY date DESC";
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	
	$targetpage = "http://www.edgeradio.org.au/program/".$_GET['id']."/blog";
	$limit = 5; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
$blogresult = mysql_query("SELECT *, DATE_FORMAT(date, '%D %M, %Y - %h:%i%p') as sd, DATE_FORMAT(date, '%d') as day, DATE_FORMAT(date, '%b') as mon FROM blog_posts WHERE show_id='$id' ORDER BY date DESC LIMIT $start, $limit",$db) or die(mysql_error());

$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM blog_posts WHERE show_id='$id' ORDER BY date DESC"),0);	
	
 if(mysql_num_rows($blogresult) != 0) {
 $count = 0;
 while ($blog = mysql_fetch_array($blogresult)) {

  ?>
<div class="rounded">
		<div style="font-size: 34px; line-height: 40px; font-weight: bold;" class="title"><?php echo stripslashes($blog['title']); ?></div>
		<div style="font-size: 11px; color: #808080;"><?php echo $blog['sd']; ?></div>
		<?php if(!empty($blog['img'])) { ?>
		<p><center><img style="width: 470px;" src="<?php echo $blog['img']; ?>"></center></p>
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


$pagination = " ";
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
        <center><p>No Blog Posts!</p></center>
         </div>
         <?php
         }
        ?>
        <?php
         } elseif($type == 'playlists') {
		
		?>
		<div style="background-color: #F0F0F0; -moz-border-bottom-left-radius:15px; -webkit-border-bottom-left-radius:15px; -moz-border-bottom-right-radius:15px; -webkit-border-bottom-right-radius:15px;">
		<div style="font-size: 48px; padding: 15px 10px 15px 10px;" class="title">Program Home</div>
          </div>
          <br>
		<div class="rounded">
        <div id="amrappage"></div>
		</div>
		<?php
		
		} elseif($type == 'restream' && $infoprogprogprog['restream_enabled'] == 'true') {
		
		?>
		<div style="background-color: #F0F0F0; -moz-border-bottom-left-radius:15px; -webkit-border-bottom-left-radius:15px; -moz-border-bottom-right-radius:15px; -webkit-border-bottom-right-radius:15px;">
		<div style="font-size: 48px; padding: 15px 10px 15px 10px;" class="title">Edge On Demand</div>
          </div>
          <br>

        
        <?php
        
        
    
        date_default_timezone_set('Australia/Hobart');
        $theday = $infoprogprogprog['day_time'];
        
if($theday == 'Monday') {
        if (date('n', time()) == 1) {  
		$day = date('Y-m-d');
		$dayr = date('d');
        $monthr = date('M');
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Monday'));
		$lastdayr = date('d', strtotime('last Monday'));
        $lastmonthr = date('M', strtotime('last Monday'));
} else { 
		$day = date('Y-m-d', strtotime('last Monday'));
		$dayr = date('d', strtotime('last Monday'));
        $monthr = date('M', strtotime('last Monday'));
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Monday -1'));
		$lastdayr = date('d', strtotime('last Monday -1'));
        $lastmonthr = date('M', strtotime('last Monday -1'));
}
        } elseif($theday == 'Tuesday') {
        if (date('n', time()) == 2) {  
		$day = date('Y-m-d');
		$dayr = date('d');
        $monthr = date('M');
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Monday'));
		$lastdayr = date('d', strtotime('last Monday'));
        $lastmonthr = date('M', strtotime('last Monday'));
} else { 
		$day = date('Y-m-d', strtotime('last Tuesday'));
        $monthr = date('M', strtotime('last Tuesday'));
        $dayr = date('d', strtotime('last Tuesday'));
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Monday -1'));
		$lastdayr = date('d', strtotime('last Monday -1'));
        $lastmonthr = date('M', strtotime('last Monday -1'));
}
        } elseif($theday == 'Wednesday') {
        if (date('n', time()) == 3) {  
		$day = date('Y-m-d');
		$dayr = date('d');
        $monthr = date('M');
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Wednesday'));
		$lastdayr = date('d', strtotime('last Wednesday'));
        $lastmonthr = date('M', strtotime('last Wednesday'));
} else { 
		$day = date('Y-m-d', strtotime('last Wednesday'));
        $monthr = date('M', strtotime('last Wednesday'));
        $dayr = date('d', strtotime('last Wednesday'));
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Wednesday -1'));
		$lastdayr = date('d', strtotime('last Wednesday -1'));
        $lastmonthr = date('M', strtotime('last Wednesday -1'));
}
        } elseif($theday == 'Thursday') {
        if (date('n', time()) == 4) {  
		$day = date('Y-m-d');
		$dayr = date('d');
        $monthr = date('M');
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Thursday'));
		$lastdayr = date('d', strtotime('last Thursday'));
        $lastmonthr = date('M', strtotime('last Thursday'));
} else { 
		$day = date('Y-m-d', strtotime('last Thursday'));
		$dayr = date('d', strtotime('last Thursday'));
        $monthr = date('M', strtotime('last Thursday'));
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Thursday -1'));
		$lastdayr = date('d', strtotime('last Thursday -1'));
        $lastmonthr = date('M', strtotime('last Thursday -1'));
}
        } elseif($theday == 'Friday') {
        if (date('n', time()) == 5) {  
		$day = date('Y-m-d');
		$dayr = date('d');
        $monthr = date('M');
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Friday'));
		$lastdayr = date('d', strtotime('last Friday'));
        $lastmonthr = date('M', strtotime('last Friday'));
} else { 
		$day = date('Y-m-d', strtotime('last Friday'));
		$dayr = date('d', strtotime('last Friday'));
        $monthr = date('M', strtotime('last Friday'));
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Friday -1'));
		$lastdayr = date('d', strtotime('last Friday -1'));
        $lastmonthr = date('M', strtotime('last Friday -1'));
}
        } elseif($theday == 'Saturday') {
        if (date('n', time()) == 6) {  
		$day = date('Y-m-d');
		$dayr = date('d');
        $monthr = date('M');
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Saturday'));
		$lastdayr = date('d', strtotime('last Saturday'));
        $lastmonthr = date('M', strtotime('last Saturday'));
} else { 
		$day = date('Y-m-d', strtotime('last Saturday'));
		$dayr = date('d', strtotime('last Saturday'));
        $monthr = date('M', strtotime('last Saturday'));
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Saturday -1'));
		$lastdayr = date('d', strtotime('last Saturday -1'));
        $lastmonthr = date('M', strtotime('last Saturday -1'));
}
        } elseif($theday == 'Sunday') {
        if (date('n', time()) == 7) {  
		$day = date('Y-m-d');
		$dayr = date('d');
        $monthr = date('M');
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Sunday'));
		$lastdayr = date('d', strtotime('last Sunday'));
        $lastmonthr = date('M', strtotime('last Sunday'));
} else { 
		$day = date('Y-m-d', strtotime('last Sunday'));
		$dayr = date('d', strtotime('last Sunday'));
        $monthr = date('M', strtotime('last Sunday'));
        $time = $infoprogprogprog['restream_time'];
        
        $lastday = date('Y-m-d', strtotime('last Sunday -1'));
		$lastdayr = date('d', strtotime('last Sunday -1'));
        $lastmonthr = date('M', strtotime('last Sunday -1'));
}
        }
        
        
$date = $infoprogprogprog['day_time'];
$beggin_hour = $infoprogprogprog['start_time'];
if($infoprogprogprog['end_time'] == '12:00 AM') { $end = '11:59 PM'; } else { $end = $infoprogprogprog['end_time']; };
$end_hour = $end;
define("SECONDS_PER_HOUR", 60*60);
// Calculate timestamp
$start = strtotime($date." ".$beggin_hour);
$stop = strtotime($date." ".$end_hour);
$difference = $stop - $start;
$hours = round($difference / SECONDS_PER_HOUR, 0, PHP_ROUND_HALF_DOWN);

        
    



  function checkRemoteFile($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    // don't download content
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
    if(curl_exec($ch)!==FALSE)
    {
        return true;
    }
    else
    {
        return false;
    }
}

$urlr = str_replace(" ", "%20", "http://mymyrecords.com/7edg/".$day." RESTREAM ".$time."-00-00.mp3");




if(checkRemoteFile($urlr)) {

$timer = $time+1;
$timerr = $time+2;
     
     $urla = "".$day." RESTREAM ".$time."-00-00";
     $urlhrs = "".$day." RESTREAM ".$timer."-00-00";
     $urlhrss = "".$day." RESTREAM ".$timerr."-00-00";

echo'<div style="clear: both; margin-bottom: 10px;">
     <div class="title" style="-moz-border-top-left-radius:15px;
	-webkit-border-top-left-radius:15px; -moz-border-bottom-left-radius:15px;
	-webkit-border-bottom-left-radius:15px; float: left; width: 30px; min-height: 50px; text-align: center; background-color: #0F0F0F; padding: 10px; color: #FFFFFF;"><span style="font-size: 16px;">'.$monthr.'</span><br>'.$dayr.'</div>
     <div class="title" style="float: left; width: 40px; text-align: center; min-height: 50px; background-color: #2B2B2B; padding: 10px; color: #FFFFFF;"><span style="font-size: 16px;">LENGTH</span><br>'; if($hours == 1) { echo'1hr'; } else { echo $hours.'hrs'; } echo'</div>
     <div style="-moz-border-top-right-radius:15px;
	-webkit-border-top-right-radius:15px; -moz-border-bottom-right-radius:15px;
	-webkit-border-bottom-right-radius:15px; float: left; width: 640px; min-height: 50px; background-color: #F0F0F0; padding: 10px; color: #000000;">
     <div style="float: right; text-align: right; line-height: 18px; font-size: 11px; width: 150px;"><img src="http://www.edgeradio.org.au/images/day-on.png"> <img src="http://www.edgeradio.org.au/images/day-on.png"> <img src="http://www.edgeradio.org.au/images/day-on.png"><br>
     3 Weeks Left<br>
     
     <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style " style="float: right; width: 65px;" addthis:url="http://www.7edg.com/index.php?restream='.$urla.'&pid='.$infoprogprogprog['id'].'&restream2='.$urlhrs.'&restream3='.$urlhrss.'&title=Listen: '.$infoprogprogprog['title'].'">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fc330e0059e70dd"></script>
<!-- AddThis Button END -->
     </div>
     
     <div class="title">'.$day.'</div>
     ';


if($user->data['user_id'] != USER)
{
     ?>
    <a href="javascript:popUp('http://www.edgeradio.org.au/player/?restream=<?php echo $urla; ?>&pid=<?php echo $infoprogprogprog['id']; ?><?php if($hours > 1) { echo '&restream2='.$urlhrs.'&restream3='.$urlhrss; } ?>')"><img style="margin: 5px 2px 2px 0px;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a>
<?php

} else {

 ?>
Restreaming is only available to registered members and Edge Radio supporters, you can become an <a style="color: #000000; font-weight: bold; text-decoration: none;" href="http://www.edgeradio.org.au/supporter/">Edge Supporter</a> or <a style="color: #000000; font-weight: bold; text-decoration: none;" href="http://www.edgeradio.org.au/soapbox/ucp.php?mode=register">Soapbox Member</a> by signing up!
<?php

}
echo'
     
     </div></div>
     <div style="clear: both;"></div>';
     
     
     
     $urllw = str_replace(" ", "%20", "http://mymyrecords.com/7edg/".date('Y-m-d', strtotime($day.'- 1 week'))." RESTREAM ".$time."-00-00.mp3");
     
     if(checkRemoteFile($urllw)) {
     
          $timer = $time+1;
     
     $urla = "".date('Y-m-d', strtotime($day.'- 1 week'))." RESTREAM ".$time."-00-00";
     $urlhrs = "".date('Y-m-d', strtotime($day.'- 1 week'))." RESTREAM ".$timer."-00-00";
    
     echo' <br>
     <div style="clear: both; margin-bottom: 10px;">
     <div class="title" style="-moz-border-top-left-radius:15px;
	-webkit-border-top-left-radius:15px; -moz-border-bottom-left-radius:15px;
	-webkit-border-bottom-left-radius:15px; float: left; width: 30px; min-height: 50px; text-align: center; background-color: #0F0F0F; padding: 10px; color: #FFFFFF;"><span style="font-size: 16px;">'.date('M', strtotime($day.'- 1 week')).'</span><br>'.date('d', strtotime($day.'- 1 week')).'</div>
     <div class="title" style="float: left; width: 40px; text-align: center; min-height: 50px; background-color: #2B2B2B; padding: 10px; color: #FFFFFF;"><span style="font-size: 16px;">LENGTH</span><br>'; if($hours == 1) { echo'1hr'; } else { echo $hours.'hrs'; } echo'</div>
     <div style="-moz-border-top-right-radius:15px;
	-webkit-border-top-right-radius:15px; -moz-border-bottom-right-radius:15px;
	-webkit-border-bottom-right-radius:15px; float: left; width: 640px; min-height: 50px; background-color: #F0F0F0; padding: 10px; color: #000000;">
     <div style="float: right; text-align: right; line-height: 18px; font-size: 11px; width: 150px;"><img src="http://www.edgeradio.org.au/images/day-on.png"> <img src="http://www.edgeradio.org.au/images/day-on.png"><br>
     2 Weeks Left<br>
      <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style " style="float: right; width: 65px;" addthis:url="http://mymyrecords.com/7edg/index.php?restream='.$urla.'&pid='.$infoprogprogprog['id'].'&restream2='.$urlhrs.'&restream3='.$urlhrss.'&title=Listen: '.$infoprogprogprog['title'].'">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fc330e0059e70dd"></script>
<!-- AddThis Button END --></div>
     
     <div class="title">'.date('Y-m-d', strtotime($day.'- 1 week')).'</div>
     ';
    

if($user->data['user_id'] != USER)
{
     ?>
    <a href="javascript:popUp('http://www.edgeradio.org.au/player/?restream=<?php echo $urla; ?>&pid=<?php echo $infoprogprogprog['id']; ?><?php if($hours > 1) { echo '&restream2='.$urlhrs.'&restream3='.$urlhrss; } ?>')"><img style="margin: 5px 2px 2px 0px;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a>
<?php

} else {

 ?>
Restreaming is only available to registered members and Edge Radio supporters, you can become an <a style="color: #000000; font-weight: bold; text-decoration: none;" href="http://www.edgeradio.org.au/supporter/">Edge Supporter</a> or <a style="color: #000000; font-weight: bold; text-decoration: none;" href="http://www.edgeradio.org.au/soapbox/ucp.php?mode=register">Soapbox Member</a> by signing up!
<?php

}
echo'
     
     </div></div>
     <div style="clear: both;"></div>';
     }
     
     $urllw2 = str_replace(" ", "%20", "http://mymyrecords.com/7edg/".date('Y-m-d', strtotime($day.'- 2 weeks'))." RESTREAM ".$time."-00-00.mp3");
     
     if(checkRemoteFile($urllw2)) {
     
          $timer = $time+1;
     
     $urla = "".date('Y-m-d', strtotime($day.'- 2 weeks'))." RESTREAM ".$time."-00-00";
  $urlhrs = "".date('Y-m-d', strtotime($day.'- 2 weeks'))." RESTREAM ".$timer."-00-00";
     
     echo' <br>
     <div style="clear: both; margin-bottom: 10px;">
     <div class="title" style="-moz-border-top-left-radius:15px;
	-webkit-border-top-left-radius:15px; -moz-border-bottom-left-radius:15px;
	-webkit-border-bottom-left-radius:15px; float: left; width: 30px; min-height: 50px; text-align: center; background-color: #0F0F0F; padding: 10px; color: #FFFFFF;"><span style="font-size: 16px;">'.date('M', strtotime($day.'- 2 weeks')).'</span><br>'.date('d', strtotime($day.'- 2 weeks')).'</div>
     <div class="title" style="float: left; width: 40px; text-align: center; min-height: 50px; background-color: #2B2B2B; padding: 10px; color: #FFFFFF;"><span style="font-size: 16px;">LENGTH</span><br>'; if($hours == 1) { echo'1hr'; } else { echo $hours.'hrs'; } echo'</div>
     <div style="-moz-border-top-right-radius:15px;
	-webkit-border-top-right-radius:15px; -moz-border-bottom-right-radius:15px;
	-webkit-border-bottom-right-radius:15px; float: left; width: 640px; min-height: 50px; background-color: #F0F0F0; padding: 10px; color: #000000;">
     <div style="float: right; text-align: right; line-height: 18px; font-size: 11px; width: 100px;"><img src="http://www.edgeradio.org.au/images/day-on.png"><br>
     1 Week Left<br>
      <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style " style="float: right; width: 65px;" addthis:url="http://www.7edg.com/index.php?restream='.$urla.'&pid='.$infoprogprogprog['id'].'&restream2='.$urlhrs.'&restream3='.$urlhrss.'&title=Listen: '.$infoprogprogprog['title'].'">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fc330e0059e70dd"></script>
<!-- AddThis Button END --></div>
     
     <div class="title">'.date('Y-m-d', strtotime($day.'- 2 weeks')).'</div>
     ';
    

if($user->data['user_id'] != USER)
{
     ?>
    <a href="javascript:popUp('http://www.edgeradio.org.au/player/?restream=<?php echo $urla; ?>&pid=<?php echo $infoprogprogprog['id']; ?><?php if($hours > 1) { echo '&restream2='.$urlhrs; } ?><?php if($hours > 2) { echo '&restream2='.$urlhrs.'&restream3='.$urlhrss; } ?>')"><img style="margin: 5px 2px 2px 0px;" src="http://www.edgeradio.org.au/images/listen-live-i.png"></a>
<?php

} else {

 ?>
Restreaming is only available to registered members and Edge Radio supporters, you can become an <a style="color: #000000; font-weight: bold; text-decoration: none;" href="http://www.edgeradio.org.au/supporter/">Edge Supporter</a> or <a style="color: #000000; font-weight: bold; text-decoration: none;" href="http://www.edgeradio.org.au/soapbox/ucp.php?mode=register">Soapbox Member</a> by signing up!
<?php

}
echo'
     
     </div></div>
     <div style="clear: both;"></div>';
     }
     

} else {

echo'<div class="rounded"><p>No episodes available, please check back tomorrow!</p></div>';

}

        
    
       ?>
        
		
		<?php
		
		} elseif($type == 'comments') {
		
		?>
		<div style="background-color: #F0F0F0; -moz-border-bottom-left-radius:15px; -webkit-border-bottom-left-radius:15px; -moz-border-bottom-right-radius:15px; -webkit-border-bottom-right-radius:15px;">
		<div style="font-size: 48px; padding: 15px 10px 15px 10px;" class="title">COMMENTS.</div>
          </div>
          <br>
          <?php
           if (isset($_POST['submitted'])) {

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

 echo '<div class="rounded">
        <h1 class="title-head-right" style="width: 755px;">CHEERS!</h1>
        <p style="text-align: center; color: #339966;">Your comment has now been submitted to the presenters for approval, once approved, it will be shown below. Check back in a day or two!</p>
        </div><br>';
        } else {
         echo '<div class="rounded">
        <h1 class="title-head-right" style="width: 755px;">WOAH!</h1>
        <p style="text-align: center; color: #FF0000;">Please fill in all required forms! <a href="javascript:history.go(-1)">Go back</a> to try again.</p>
        </div><br>';
         }

}

 $comresult = mysql_query("SELECT *, DATE_FORMAT(date, '%D %M, %Y - %h:%i%p') as sd FROM comments WHERE show_id='$id' AND approved = '1' ORDER BY sd DESC",$db);
 if(mysql_num_rows($comresult) != 0) {
  ?>
        <div class="rounded">
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
        <p style="text-align: center;">Be the first to comment on this program!</p>
        </div>
         <?php
         }
         
         if($user->data['user_id'] != USER)
{
        ?>
                <br />
         <div class="rounded">
        <h1 class="title-head-right" style="width: 755px;">ADD A COMMENT</h1>
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
	<td style="width: 100px;"></td>
	<td><input type="submit" name="submit" style="border: 1px solid rgb(153, 0, 0); padding: 3px;" value="Submit" /><input type="hidden" name="submitted" value="TRUE" /><input type="hidden" name="id" value="<?php echo $id; ?>" /></td>
</tr>
</table>
      </form>
		</div>
		<?php
		
		} else {
		?>
		<br>
		<div class="rounded">
        <h1 class="title-head-right" style="width: 755px;">ADD A COMMENT</h1>
        <p>Please log in or register to add a comment!</p>
        </div>
		
		<?php
		
		
		}
		
		} else {
		  
		 
        ?>
        <div style="background-color: #F0F0F0; -moz-border-bottom-left-radius:15px; -webkit-border-bottom-left-radius:15px; -moz-border-bottom-right-radius:15px; -webkit-border-bottom-right-radius:15px; <?php if($infoprogprogprog['about_img']) { echo'background-image: url( '.$infoprogprogprog['about_img'].' ); background-position: bottom right; background-repeat: no-repeat;'; } ?>">
        

      <div class="imagepagetext">
      <div class="title">About</div><p><?php echo stripslashes($infoprogprogprog['description']); ?></p>
      </div>

        </div>
        
        
        <?php
        $showid = $infoprogprogprog['id'];
 include "inc/database.inc.php";
 $result = mysql_query("SELECT * FROM cup WHERE Display='Y' AND show_id='$showid' AND expire > NOW() ORDER BY expire ASC",$db);
$count = 0;
$num = mysql_num_rows($result);

 while ($myrow = mysql_fetch_array($result)) {
 
   ?> 
        
        <br />
        
        <div class="rounded">
          <h1 class="title-head-right" style="width: 755px;">This Week On <?php echo stripslashes($infoprogprogprog['title']); ?></h1>
      
      
      <div class="title"><?php echo stripslashes($myrow['Title']); ?></div>
      <p><?php echo stripslashes($myrow['Description']); ?></p>
        </div>
    
              
        <?php
        
        }
        }
        ?>
        <br><br>
</div>
<div id="footer">
        <?php include 'templates/footer.php'; ?>
        </div>
    </div>
  </div>
</div>

<?php include 'templates/common_end.php'; ?>
<?php
}

if($countrow == 0) {
 
 include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
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
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>

<?php include 'inc/common_end.php'; 
 
 }
?>
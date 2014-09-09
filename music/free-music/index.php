<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	 <ul class="border-light">
	 <li><a href="http://www.edgeradio.org.au/music/">New Tracks</a></li>
<li><a href="http://www.edgeradio.org.au/music/albums/">New Albums</a></li>

	 <li><a href="http://www.edgeradio.org.au/music/edge-radio-recommended/">Edge Radio Recommended</a></li>
	 <li><a href="http://www.edgeradio.org.au/music/tasmanian-music/">Tasmanian Music</a></li>
	 <li><a href="http://www.edgeradio.org.au/music/free-music/">Free Tasmanian Music Downloads</a></li>
	 <li><a href="http://www.edgeradio.org.au/music/submit-music/">Submit Music</a></li>
	 </ul>
	 </div>
    <br />
<?php include '../../inc/box_leftbanner_new.php'; ?>
<br />
<?php include '../../inc/box_supporter_new.php'; ?>
    </div>
    <div id="two_column">
 
 <div class="roundednew">
  <h1 class="greyheader">Free Tasmanian Music Downloads</h1>
  
  <div class="top_exp">
  <h1>Did You Say Free?</h1>
  <p>Here at Edge Radio we luuurve supporting Tasmanian artists. So much so that we're making it even easier for you to get your hands on fresh Tasmanian tracks, straight from us to you. Below you'll find our feature tracks available for you to download this month, for free.</p>
<p>Get some Tassie music onto your player. If you like it, request the artist on Edge Radio, or better yet, go check out the band online, at a local gig, or buy their album.</p>
  </div>
  

<?php
include "../../inc/database.inc.php";
mysql_select_db("edge_music",$db);


   $myquery = "SELECT COUNT(*) as num FROM free_music ORDER BY id DESC";

    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	

	 $targetpage = "index.php";
	
	$limit = 5; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
	  	 
$inforesult = mysql_query("SELECT * FROM free_music ORDER BY id DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM free_music ORDER BY id DESC"),0);	


$count = 0;
while ($info = mysql_fetch_array($inforesult)) {
 
 
echo'
  <table style="width: 100%;" cellpadding="15">
<tr>
	<td style="width: 100px; vertical-align: top;"><div style="background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); width: 100px; height: 100px;"><img style="width:100px;height:100px;" src="'.$info['image'].'"></div></td>
	<td>
	<a href="'.$info['soundcloud'].'/download" style="color: #000000; text-decoration: none;" class="title">'.stripslashes($info['artist']).' - '; if($info['title']) { echo'<span style="color: #333333;">'.stripslashes($info['title']).'</a>'; } echo'</span><br>
	<p>'; echo stripslashes(substr($info['description'],0,240)); echo'</p>
	</td>
</tr>
</table>
<center><object height="81" width="100%"> <param name="movie" value="https://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;show_comments=true&amp;auto_play=false&amp;color=d10000"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" height="81" src="https://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;show_comments=true&amp;auto_play=false&amp;color=d10000" type="application/x-shockwave-flash" width="96%"></embed> </object></center><br><br>';
 
 
 

 	
 	
 	}


    if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;



	if($lastpage > 1)
	{	
		//previous button
		if ($page > 1) 
			$pagination.= "<a style='padding: 2px 5px 2px 5px; border: 1px solid #333333; text-decoration: none; color: #333333;' href=\"$targetpage?p=$prev\"><< Previous</a> ";
	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span style='font-weight:bold; border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' >$counter</span> ";
				else
					$pagination.= "<a style='padding: 2px 5px 2px 5px; border: 1px solid #333333; text-decoration: none; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
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
						$pagination.= "<span style='font-weight:bold; border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; border: 1px solid #333333; text-decoration: none; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='font-weight:bold; border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; border: 1px solid #333333; text-decoration: none; color: #333333;' href=\"$targetpage?p=$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; border: 1px solid #333333; text-decoration: none; color: #333333;' href=\"$targetpage?p=$lastpage\">$lastpage</a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a style='padding: 2px 5px 2px 5px; border: 1px solid #333333; text-decoration: none; color: #333333;' href=\"$targetpage?p=1\">1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; border: 1px solid #333333; text-decoration: none; color: #333333;' href=\"$targetpage?p=2\">2</a> ";
				$pagination.= "<span style='font-weight:bold; border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='border: 1px solid #333333; text-decoration: none; font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</b> ";
				$pagination.= "<a style='border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lastpage\">$lastpage</a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a style='border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=1\">1</a> ";
				$pagination.= "<a style='border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=2\">2</a> ";
				$pagination.= "<span style='border: 1px solid #333333; text-decoration: none; font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='border: 1px solid #333333; text-decoration: none; font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a style='border: 1px solid #333333; text-decoration: none; padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$next\">Next >></a>";
		
	}
	?>
	<?=$pagination?>


 </div>
 
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
<?php include '../sidebar.php'; ?>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
 
 <div class="roundednew">
  <h1 class="title-head-right">New Albums On Edge</h1>

<table style="width: 100%;" cellpadding="15">
 	<?php
include "../../inc/database.inc.php";
mysql_select_db("edge_music",$db);


   $myquery = "SELECT COUNT(*) as num FROM music WHERE public = 'true' AND type='album' ORDER BY date_added DESC";

    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	

	 $targetpage = "index.php";
	
	$limit = 10; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
	  	 
$inforesult = mysql_query("SELECT * FROM music WHERE public = 'true' AND type='album' ORDER BY id DESC, date_added DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM music WHERE public = 'true' AND type='album' ORDER BY date_added DESC"),0);	


$count = 0;
while ($info = mysql_fetch_array($inforesult)) {


echo'

<tr>
	<td style="width: 100px;"><div style="background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); width: 100px; height: 100px;"><img style="width:100px;height:100px;" src="'.$info['image'].'"></div></td>
	<td>
	<span class="title">'.stripslashes($info['artist']).' - '; if($info['album']) { echo'<span style="color: #333333;">'.stripslashes($info['album']).'</span>'; } echo'</span>'; if($info['tasmanian']) { echo' <img title="Tasmanian Artist" src="http://www.edgeradio.org.au/images/tas_icon.png">'; } echo'<br>
	<span><b>Genre:</b> '.stripslashes($info['genre']).' - <b>Label:</b> '.stripslashes($info['label']).'</span><br>
	<p>'; echo stripslashes(substr($info['notes'],0,240)); if(strlen($info['notes']) >= 240) { echo'...'; } echo'</p>
	';
	if($info['soundcloud']) {
	 echo'
	<object height="18" width="100%"> <param name="movie" value="http://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" height="18" src="http://player.soundcloud.com/player.swf?url='.$info['soundcloud'].'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false" type="application/x-shockwave-flash" width="100%"></embed> </object>
	';
	}
	echo'
	</td>
</tr>

';
}
    
    ?>

	</table>
	
	
	
	<?php 
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
	<br><br>
 </div>
 
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

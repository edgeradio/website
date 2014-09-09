<?php include '../../templates/common_start.php'; ?>
<body>
<script type="text/javascript" src="../../player/anarchy.js"></script>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    <?php include '../sidebar.php'; ?>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
 
  <span style="font-size: 82px; color: #FFFFFF; line-height: 90px;" class="title">EDGE INTERVIEWS</span>
        
          <?php include '../../inc/database.inc.php';
mysql_select_db('edge_programs',$db);

 $myquery = "SELECT COUNT(*) as num FROM interviews ORDER BY date DESC";

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
	  	 	
	  	 
$inforesult = mysql_query("SELECT * FROM interviews ORDER BY date DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM interviews ORDER BY date DESC"),0);	


$count = 0;
while ($infop = mysql_fetch_array($inforesult)) {
		
			
			?>
			
			<div class="roundednew">
        <h1 class="title-head-right"><?php echo $infop['title']; ?></h1>
  
			<img style="width: 100%;" src="<?php echo $infop['image']; ?>">
         <iframe class="iframe" src="https://w.soundcloud.com/player?url=<?php echo $infop['soundcloud']; ?>&auto_play=false&show_artwork=true&show_comments=false&sharing=true" width="100%" height="166" scrolling="no" frameborder="no">...</iframe>
         <p><?php echo $infop['description']; ?></p>
        
<br />
          <?php	
echo'</div><br />';

} //while 

?>
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
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

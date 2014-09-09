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
 
<img src="../../images/indie-title.png">
<br /><br />
        
          <?php include '../../inc/database.inc.php';
mysql_select_db('edge_programs');


$sqlBlogger = "SELECT * from indie_tas ORDER BY date DESC";
$data = mysql_query($sqlBlogger);			
		
// run a cursor to loop through all podcasts and update the SQL table
	
		while ($infop = mysql_fetch_array($data)) {
		
			
			?>
			
			 <div class="roundednew">
				 <h1 class="title-head-right"><?php echo $infop['title']; ?></h1>
				 <img style="width: 100%;" src="<?php echo $infop['image']; ?>"><br>
				 <iframe class="iframe" src="https://w.soundcloud.com/player?url=<?php echo $infop['soundcloud']; ?>&auto_play=false&show_artwork=true&show_comments=false&sharing=true" width="100%" hight="166" scrolling="no" frameborder="no">...</iframe>
				 <p><?php echo $infop['description']; ?></p>
        
<br />
          <?php	
echo'</div><br />';
} //while 



?>

        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

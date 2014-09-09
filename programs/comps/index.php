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
  <h1 class="title-head-right">Competitions On Edge</h1>
              <p class="text">Edge is always keen to reward you with great prize packs and competitions. Check out these competitions that are currently running, and tune in for your chance to win!</p>
              <?php
              include '../../inc/database.inc.php';
              mysql_select_db('edge_content'); 
$playresult = mysql_query("SELECT * FROM prizes WHERE winner=''",$db);
 if(mysql_num_rows($playresult) != 0) {
 while ($play = mysql_fetch_array($playresult)) {
    
        $img = 'http://www.edgeradio.org.au/images/edgepics/edgeradio.jpg';
  ?>
  <table style="width: 100%;" cellpadding="10" cellspacing="5">
<tr>
<?php
	 $show_id = $play['show_id'];
 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l%p') as start_timer FROM program_info WHERE id='$show_id'");
 while ($infor = mysql_fetch_array($inforesult)) {
 ?>
	<td style="vertical-align: top; width: 100px;"><a href="http://www.edgeradio.org.au/program/<?php echo str_replace(' ' , '-', $infor['seotitle']); ?>/"><img style="border: 0px; width: 100px; height: 100px;" src="<?php echo $play['image']; ?>"></a></td>
	<td>
	<span class="title"><?php echo $play['title']; ?></span><br>
	<span><i>
	<?php echo $infor['title']; ?> (<?php echo $infor['start_timer']; ?>, <?php echo $infor['day_time']; } ?>)</i></span>
<p><?php echo stripslashes($play['description']); ?></p>
<b>Winner:</b> <?php if($play['winner'] == '') { echo'Up For Grabs!'; } else { echo $play['winner']; } ?>
	</td>
</tr>
</table>
<?php
        }
        } else {
         ?>
        <center><p>No prizes up for grabs at the moment, check back soon!</p></center>
         <?php
         }
        
        
        
        
        
        
        echo' </div>
        <br>
        <div class="roundednew">
  <h1 class="title-head-right">Prizes Recently Won On Edge</h1>';
        mysql_select_db("edge_content",$db);
        $playresult = mysql_query("SELECT * FROM prizes WHERE winner != '' LIMIT 10",$db);
 if(mysql_num_rows($playresult) != 0) {
 while ($play = mysql_fetch_array($playresult)) {
  ?>
  <table style="width: 100%;" cellpadding="10" cellspacing="5">
<tr>
	<?php
	 $show_id = $play['show_id'];
 mysql_select_db("edge_programs",$db);
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(start_time,'%l%p') as start_timer FROM program_info WHERE id='$show_id'");
 while ($infor = mysql_fetch_array($inforesult)) {
 ?>
	<td style="vertical-align: top; width: 100px;"><a href="http://www.edgeradio.org.au/program/<?php echo str_replace(' ' , '-', $infor['seotitle']); ?>/"><img style="border: 0px; width: 100px; height: 100px;" src="<?php echo $play['image']; ?>"></a></td>
	<td>
	<span class="title"><?php echo $play['title']; ?></span><br>
	<span><i> 
	<?php echo $infor['title']; ?> (<?php echo $infor['start_timer']; ?>, <?php echo $infor['day_time']; } ?>)</i></span>
<p><?php echo $play['description']; ?></p>
<b>Winner:</b> <?php if($play['winner'] == '') { echo'Up For Grabs!'; } else { echo $play['winner']; } ?>
	</td>
</tr>
</table>
<?php
        }
        } else {
         ?>
        <center><p>No prizes up for grabs at the moment, check back soon!</p></center>
         <?php
         }

?>
        <br />
     
  </div> 
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

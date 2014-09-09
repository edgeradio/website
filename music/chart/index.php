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
  <h1 class="title-head-right">Top Tracks Played On Edge This Week</h1>

<table style="width: 100%;" cellpadding="15">
 	<?php
include "../../inc/database.inc.php";
mysql_select_db("edge_music",$db);


	  	 
$inforesult = mysql_query("SELECT * FROM music WHERE playcountweek != '0' ORDER BY playcountweek DESC LIMIT 20",$db);

$count = 1;
while ($info = mysql_fetch_array($inforesult)) {


echo'

<tr>
<td style="width: 20px;"><div class="title">' . $count . '</div></td>
	<td>
	<span class="title">'.stripslashes($info['artist']).' - '.stripslashes($info['title']).' '; if($info['album']) { echo'<span style="color: #333333;">('.stripslashes($info['album']).')</span>'; } echo'</span>'; if($info['tasmanian']) { echo' <img title="Tasmanian Artist" src="http://www.edgeradio.org.au/images/tas_icon.png">'; }
	echo'
	</td>
</tr>

';
$count++;
}
    
    ?>

	</table>
	
	
	
	<br><br>
 </div>
 
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

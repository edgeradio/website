<?php include 'templates/common_start.php'; ?>
<body>
    <img src="images/gighead.png">
    </div>
    <br />
    
    <style>
.date {
	background:#fff url('http://www.edgeradio.org.au/images/fulldate-red.jpeg') repeat-x scroll top left;
	width:60px;
	height:60px;
	text-align:center;
	color:#fff;
	font-family:Arial, Helvetica, sans-serif;
	text-transform:uppercase;
}
.date .date-day {
	color:#333;
	margin-top: 12px;
	font-family:Georgia, "Times New Roman", Times, serif;
	font-size:35px;
}
.date .date-month {
	font-size:11px;
	font-weight:bold;
}

.datetime {
	font-size:11px;
	font-weight:bold;
	margin: 5px 0 5px 6px;
}
</style>
    
        <?php
    include "inc/database.inc.php";
mysql_select_db("edge_content",$db);

$inforesult = mysql_query("SELECT * FROM gig_guide WHERE approved = 'true' AND whenevent >= CURDATE() ORDER BY sponsor DESC, whenevent ASC",$db);
$count = 1;
while ($info = mysql_fetch_array($inforesult)) {
?>
 
<div style="z-index: <?php echo $count; ?>; padding: 20px; width: 93%; vertical-align: top; margin: 10px; min-height: 100px;" class="rounded">
    
<div style="float: right; width: 80px; margin-left: 10px;">

<div class="date">
    <div class="date-month"><?php echo date("M", strtotime($info['whenevent'])); ?></div>
    <div class="date-day"><?php echo date("d", strtotime($info['whenevent'])); ?></div>
</div>
<div class="datetime"><?php echo date("h:iA", strtotime($info['whenevent'])); ?></div>


<?php if($info['facebook']) { ?><a title="Facebook" href="<?php echo $info['facebook']; ?>" style="text-decoration: none; margin: 10px 5px 5px 15px;"><img border="0" src="http://edgeradio.org.au/images/social/facebook.png"></a><?php } ?>

</div>

<?php if($info['image']) { ?><div onclick="location.href='<?php echo $info['image']; ?>';" style="cursor: pointer; float: left; width: 100px; height: 100px; background-image: url(<?php echo $info['image']; ?>); background-position: center center; margin-right: 15px;"></div><?php } else { ?><div style="float: left; width: 100px; height: 100px; background-image: url(http://www.edgeradio.org.au/images/unknown.jpg); background-position: center center; margin-right: 15px;"></div><?php } ?>
 
 <?php if($info['sponsor'] == 'edge') { ?>
 <span class="title" style="color: #FF0000;"><?php echo stripslashes($info['title']); ?></span><br><br>
 <?php } else { ?>
 <span class="title"><?php echo stripslashes($info['title']); ?></span><br><br>
 <?php } ?>
 
<b><?php echo $info['lineup']; ?></b>
<br>
<div title="Where The Event Is Being Held" style="padding: 0px 0 0 0; margin: 5px 5px 5px 5px; font-size: 10px; height: 20px;"><a target="_blank" href="<?php echo $info['website']; ?>" style="text-decoration: none; color: #000000;"><b><?php echo $info['venue']; ?></b></a></div>
        
        
        
          <div style="clear: both;"></div>
    
<p><?php echo stripslashes($info['description']); ?></p>
        
     <div style="clear: both;"></div>

      </div>
      
      <?php
      $count++;
      }
      ?>
    <br><br>
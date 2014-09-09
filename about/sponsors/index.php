<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
    <?php include'../sidebar.php'; ?>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
 
 <div class="roundednew">
  <h1 class="title-head-right">Our Sponsors</h1>
  <table style="width: 100%;" cellpadding="10" cellspacing="20">
<?php


mysql_select_db("edge_content",$db);
 $result = mysql_query("SELECT * FROM sponsors WHERE image != '' ORDER BY id ASC",$db);
 while ($info = mysql_fetch_array($result)) {
 
 
 echo'<tr>
 <td style="width: 200px;"><a href="'.$info['url'].'" target="_blank"><img border="0" src="'.$info['image'].'"></a></td>
 <td><a href="'.$info['url'].'" target="_blank" class="title" style="color: #000000; text-decoration: none;">'.$info['name'].'</a><br><p>'.stripslashes($info['about']).'</p></td>
 </tr>';
 
 }

?>
  </table> 
          </div> 
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

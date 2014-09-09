<?php 
$db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db('edge_wrdp1',$db);
$querywp = mysql_query("SELECT post_title, post_name FROM wp_posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT 1") or die(mysql_error());

  echo '<ul>';
  while ($wpo = mysql_fetch_array($querywp)) {
    echo '<li><a href="/blog/'.$wpo['post_name'].'">'.stripslashes($wpo['post_title']).'</a></li>';
  }
  echo '</ul>';
?>
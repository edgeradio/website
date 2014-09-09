 <?php

$xml = simplexml_load_file('http://edgeatfalls.tumblr.com/api/read/?num=50');
$posts = $xml->xpath("/tumblr/posts/post");
					
foreach($posts as $post) { ?> 
          <div class="tumblr_post">

<?php if ($post['type'] == 'regular') {  ?>
<div style="padding: 5px; font-size: 12px;">
<?php if($post->{'regular-title'} != '') { echo '<div style="font-weight: bold; font-size: 14px; padding-bottom: 2px;">'.$post->{'regular-title'}.'</div>'; } ?>														
<?php echo $post->{'regular-body'}; ?>
</div>
<?php } ?>

<?php if ($post['type'] == 'photo') {  if($post->{'photo-link-url'} != '') { ?>
<a target="_blank" href="<?php echo $post->{'photo-link-url'}; ?>"><?php } ?><img style="border: 0px; width: 100%;" src="<?php echo $post->{'photo-url'}[1] ?>"><?php if($post->{'photo-link-url'} != '') { ?></a><?php } ?>
<div style="padding: 5px; font-size: 12px;"><?php echo $post->{'photo-caption'}; ?></div>
<?php } ?>

<?php if ($post['type'] == 'link') {  ?>
<div style="padding: 5px; font-size: 12px;">
<a href="<?php echo $post->{'link-url'}; ?>" style="font-weight: bold; font-size: 14px; padding-bottom: 2px;"><?php echo $post->{'link-url'}; ?></a>		<br>												
<?php echo $post->{'link-description'}; ?>
</div>
<?php } ?>

<?php if ($post['type'] == 'answer') {  ?>
<div style="padding: 5px; font-size: 12px;">
<?php echo '<div style="font-weight: bold; font-size: 14px; padding-bottom: 2px;">Question: '.$post->{'question'}.'</div>'; ?>														
<?php echo $post->{'answer'}; ?>
</div>
<?php } ?>

<?php if ($post['type'] == 'video') {  ?>
<center>Oops, sorry. You can't view videos via your mobile device :(</center><?php } ?>

<?php if ($post['type'] == 'audio') {  ?>
<center>Oops, sorry. You can't listen to audio via your mobile device :(</center>
<?php } ?>
              
  
<div style="padding-left: 3px; font-size: 11px; color: #969696;">Posted on <?php echo date("jS D M, h:i",strtotime($post['date'])); ?> <?php $from = substr($post['feed-item'], 0, 18); if($from == 'http://twitter.com') { echo'from <a style="color: #4AD2FF;" href="http://twitter.com/EdgeRadio/" target="_blank">Twitter</a>'; } ?> <?php $tag = $post['type']; if($tag == 'video') { echo'<br>Tag: <b>Video</b>'; } elseif($tag == 'photo') { echo'<br>Tag: <b>Photo</b>'; } elseif($tag == 'audio') { echo'<br>Tag: <b>Audio</b>'; } elseif($tag == 'answer') { echo'<br>Tag: <b>Q&A</b>'; }  ?></div>

</div><!-- //end post-->
<br>
<?php } ?>
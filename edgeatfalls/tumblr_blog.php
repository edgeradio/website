<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>jQuery pagination</title>
<script type="text/javascript" src="http://www.edgeradio.org.au/edgeatfalls/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	//how much items per page to show
	var show_per_page = 10; 
	//getting the amount of elements inside content div
	var number_of_items = $('#content').children().size();
	//calculate the number of pages we are going to have
	var number_of_pages = Math.ceil(number_of_items/show_per_page);
	
	//set the value of our hidden input fields
	$('#current_page').val(0);
	$('#show_per_page').val(show_per_page);
	
	//now when we got all we need for the navigation let's make it '
	
	/* 
	what are we going to have in the navigation?
		- link to previous page
		- links to specific pages
		- link to next page
	*/
	var navigation_html = '<a class="previous_link" href="javascript:previous();">Prev</a>';
	var current_link = 0;
	while(number_of_pages > current_link){
		navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">'+ (current_link + 1) +'</a>';
		current_link++;
	}
	navigation_html += '<a class="next_link" href="javascript:next();">Next</a>';
	
	$('#page_navigation').html(navigation_html);
	
	//add active_page class to the first page link
	$('#page_navigation .page_link:first').addClass('active_page');
	
	//hide all the elements inside content div
	$('#content').children().css('display', 'none');
	
	//and show the first n (show_per_page) elements
	$('#content').children().slice(0, show_per_page).css('display', 'block');
	
});

function previous(){
	
	new_page = parseInt($('#current_page').val()) - 1;
	//if there is an item before the current active link run the function
	if($('.active_page').prev('.page_link').length==true){
		go_to_page(new_page);
	}
	
}

function next(){
	new_page = parseInt($('#current_page').val()) + 1;
	//if there is an item after the current active link run the function
	if($('.active_page').next('.page_link').length==true){
		go_to_page(new_page);
	}
	
}
function go_to_page(page_num){
	//get the number of items shown per page
	var show_per_page = parseInt($('#show_per_page').val());
	
	//get the element number where to start the slice from
	start_from = page_num * show_per_page;
	
	//get the element number where to end the slice
	end_on = start_from + show_per_page;
	
	//hide all children elements of content div, get specific items and show them
	$('#content').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');
	
	/*get the page link that has longdesc attribute of the current page and add active_page class to it
	and remove that class from previously active page link*/
	$('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');
	
	//update the current page input field
	$('#current_page').val(page_num);
}
  
</script>
<style>
#page_navigation a{
	padding: 3px 6px 3px 6px;
	border: 1px solid gray;
	margin:2px;
	color:black;
	text-decoration:none
}
.active_page{
	background:#C0C0C0;
	color:#000000;
}
</style>
</head>
<body>

<input type='hidden' id='current_page' />
	<input type='hidden' id='show_per_page' />
	
	<?php



$xml = simplexml_load_file('http://edgeatfalls.tumblr.com/api/read/?num=100');
$posts = $xml->xpath("/tumblr/posts/post");
					
echo'<div id="content">';
foreach($posts as $post) { ?> 
          <div class="tumblr_post">

<?php if ($post['type'] == 'regular') {  ?>
<div style="padding: 5px; font-size: 12px;">
<?php if($post->{'regular-title'} != '') { echo '<div style="font-weight: bold; font-size: 14px; padding-bottom: 2px;">'.$post->{'regular-title'}.'</div>'; } ?>														
<?php echo $post->{'regular-body'}; ?>
</div>
<?php } ?>

<?php if ($post['type'] == 'photo') {  if($post->{'photo-link-url'} != '') { ?>
<a target="_blank" href="<?php echo $post->{'photo-link-url'}; ?>"><?php } ?><img style="border: 0px; width: 490px;" src="<?php echo $post->{'photo-url'}[1] ?>"><?php if($post->{'photo-link-url'} != '') { ?></a><?php } ?>
<div style="padding: 5px; font-size: 12px;"><?php echo $post->{'photo-caption'}; ?></div>
<?php } ?>

<?php if ($post['type'] == 'answer') {  ?>
<div style="padding: 5px; font-size: 12px;">
<?php echo '<div style="font-weight: bold; font-size: 14px; padding-bottom: 2px;">Question: '.$post->{'question'}.'</div>'; ?>														
<?php echo $post->{'answer'}; ?>
</div>
<?php } ?>

<?php if ($post['type'] == 'video') {  ?>
<center><?php echo $post->{'video-player'}; ?></center>
<div style="padding: 5px; font-size: 12px;"><?php echo $post->{'video-caption'}; ?></div>
<?php } ?>

<?php if ($post['type'] == 'audio') {  ?>
<center><br><?php echo $post->{'audio-player'}; ?></center>
<div style="padding: 5px; font-size: 12px;"><?php echo $post->{'audio-caption'}; ?></div>
<?php } ?>
              
  
<div style="padding-left: 3px; font-size: 11px; color: #969696;">Posted on <?php echo date("jS D M, h:i",strtotime($post['date'])); ?> <?php $from = substr($post['feed-item'], 0, 18); if($from == 'http://twitter.com') { echo'from <a style="color: #4AD2FF;" href="http://twitter.com/EdgeRadio/" target="_blank">Twitter</a>'; } ?> <?php $tag = $post['type']; if($tag == 'video') { echo'<br>Tag: <b>Video</b>'; } elseif($tag == 'photo') { echo'<br>Tag: <b>Photo</b>'; } elseif($tag == 'audio') { echo'<br>Tag: <b>Audio</b>'; } elseif($tag == 'answer') { echo'<br>Tag: <b>Q&A</b>'; }  ?></div>

</div><!-- //end post-->
<br>
<?php } ?>
</div>
<br><br>
<div id='page_navigation'></div>
<br><br>
</body>
</html>
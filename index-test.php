<?php include 'templates/header.php'; ?>
		
<link rel="stylesheet" href="http://www.edgeradio.org.au/templates/slider/slider.css">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	<script src="http://www.edgeradio.org.au/templates/slides.min.jquery.js"></script>
	<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: 'http://www.edgeradio.org.au/images/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.caption').animate({
						bottom:0
					},200);
				}
			});
		});
	</script>
	
	<div id="slides">
				<div class="slides_container">
				<div class="slide">
						<a href="http://www.flickr.com/photos/stephangeyer/3020487807/" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="http://www.edgeradio.org.au/images/slide3.jpg" width="100%" height="270" alt="Slide 3"></a>
						<div class="caption">
						<div class="title">Harrison Manton on Tasmusica</div>
							<p>Re-stream Harrison Manton performing on Tasmusica this week.</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://www.flickr.com/photos/jliba/4665625073/" title="145.365 - Happy Bokeh Thursday! | Flickr - Photo Sharing!" target="_blank"><img src="http://www.edgeradio.org.au/images/slide1.jpg" width="100%" height="270" alt="Slide 1"></a>
						<div class="caption" style="bottom:0">
						<div class="title">RBMA: Canblaster Live at Circulo de Bellas Artes </div>
							<p>Yes you Canblaster! French take-no-prisoners party starter and Club Cheval’s co-founder live in the mix during the Academy in Madrid.</p>
						</div>
					</div>
					<div class="slide">
						<a href="http://www.flickr.com/photos/stephangeyer/3020487807/" title="Taxi | Flickr - Photo Sharing!" target="_blank"><img src="http://www.edgeradio.org.au/images/slide2.jpg" width="100%" height="270" alt="Slide 2"></a>
						<div class="caption">
						<div class="title">The XX release 'coexist'</div>
							<p>Hear the full album here!</p>
						</div>
					</div>
				</div>
			</div>


<br><br>

<div style="float: left; width: 645px; padding-right: 15px;">

<div class="title" style="margin: 0 0 10px 0; padding: 10px; background-color: #1F1F1F; color: #FFFFFF;">Blog</div>

<?php  
//db parameters  
$db_username = 'edge';  
$db_password = 'edg3r4di0993';  
$db_database = 'edge_wrdp1';  
  
$blog_url = 'http://edgeradio.org.au/blog/'; //base folder for the blog. Make SURE there is a slash at the end  
  
//connect to the database  
mysql_connect(localhost, $db_username, $db_password);  
@mysql_select_db($db_database) or die("Unable to select database");  

$query = "Select * FROM wp_posts WHERE post_type='post' AND post_status='publish' ORDER BY id DESC LIMIT 3";   
  
$query_result = mysql_query($query);  
$num_rows = mysql_numrows($query_result);  

  
?>  

<?php  
  
//start a loop that starts $i at 0, and make increase until it's at the number of rows  
for($i=0; $i< $num_rows; $i++){   
  
//assign data to variables, $i is the row number, which increases with each run of the loop  
$blog_id = mysql_result($query_result, $i, "ID"); 
$blog_date = mysql_result($query_result, $i, "post_date");  
$blog_title = mysql_result($query_result, $i, "post_title");  
$blog_content = mysql_result($query_result, $i, "post_content");  
//$blog_permalink = mysql_result($query_result, $i, "guid"); //use this line for p=11 format.  
  
$blog_permalink = mysql_result($query_result, $i, "guid"); //combine blog url, with permalink title. Use this for title format  
  
//format date  
$blog_date = strtotime($blog_date);  
$blog_date = strftime("%b %e", $blog_date);  
  
//the following HTML content will be generated on the page as many times as the loop runs. In this case 5.  
?>  


<?php
$query1 = "Select * FROM wp_postmeta WHERE post_id='$blog_id' AND meta_key='_thumbnail_id' LIMIT 1";   
$query_result1 = mysql_query($query1);  
while ($myrow1 = mysql_fetch_array($query_result1)) {

$meta_value = $myrow1['meta_value'];

		$query2 = "Select * FROM wp_postmeta WHERE post_id='$meta_value'LIMIT 1";   
		$query_result2 = mysql_query($query2);  
		while ($myrow2 = mysql_fetch_array($query_result2)) {

		echo '<img style="float: left;" src="http://edgeradio.org.au/blog/wp-content/uploads/'.preg_replace('/(.*)(\.[\w\d]{3})/', '$1-150x150$2', $myrow2['meta_value'])  .'">';

		}

}

?>
  <div style="float: left; padding: 10px; min-height: 130px; width: 475px; border-top: 2px solid #1F1F1F; color: #4F4F4F;">
         
  
        <a class="title" style="color: #000000; text-decoration: none; font-weight: normal;" href="<?php echo $blog_permalink; ?>"><?php echo $blog_title; ?></a><br>  
        <small>Posted: <?php echo $blog_date; ?></small>
  
        <p><?php echo substr($blog_content, 0, 250); ?>...</p>
        <a style="color: #FFFFFF; float: right; font-size: 10px; text-decoration: none; font-weight: normal;" href="<?php echo $blog_permalink; ?>">[ Read More ]</a>
        </div>
        <div style="clear:both;"></div>
        <br />
        <?php
        
        }
        
        ?>
        
        </div>
        
        <div style="float: left; width: 300px;">
        <div class="title" style="margin: 0 0 10px 0; padding: 10px; background-color: #1F1F1F; color: #FFFFFF;">Whats on?</div>

        Hello Hello Hello Hello Hello Hello Hello Hello Hello Hello 
        </div>
        
        <div style="clear:both;"></div>

<?php include 'templates/bottom.php'; ?>

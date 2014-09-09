<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	 <ul class="border-light">
	 <li>1. Introduction</li>
	 <li style="color: #C0C0C0;">2. Program/Contact Details</li>
	 <li style="color: #C0C0C0;">3. Confirmation</li>
	 </ul>
	 </div>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    
    
    <div id="two_column">
     <?php
       $db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_content",$db);
 $result = mysql_query("SELECT * FROM programapp_status LIMIT 1",$db);
  while ($myrow = mysql_fetch_array($result)) {
    if($myrow["status"] == 1) {

    ?>
    <div class="rounded">
    <h1><p align="center">Applications Are Currently Closed</h1></p>
    <h3><p align="center">The current season runs from May 26th 2014 and ends November 23rd 2014</p></h3>
    
    </div>
    <br>
    
<div class="roundednew">
        <h1 class="title-head-right">What is Edge Radio?</h1>
		<p>Edge Radio is youth community radio station based in Hobart, Tasmania. As Hobart’s only youth orientated radio station, Edge Radio provides an alternative to mainstream stations. This is achieved with a mix of youth focused music, entertainment, local journalistic content and other information relevant to youth. Our target audience is aged 15-30, although Edge is a station 'For Youth Of All Ages'.
		
		<br>
		<h2>EDGE AIMS TO PROVIDE A VIBRANT YOUTH FOCUSED RADIO STATION THAT...</h2>
<blockquote>
<li>Enlivens the culture and social climate of Tasmania</li>
<li>Is responsive to the needs of its audiences</li>
<li>Provides programming relevant to youth</li>
<li>Is high quality</li>
<li>Is artistically diverse</li>
<li>Is broadly inclusive</li>
<li>Has informative and educational programming</li>
<li>Provides a forum to discuss current issues</li>
</blockquote>
</p>
		
		</div>
		<br>

		<div class="roundednew">
		<h1 class="title-head-right">Statement of Objectives</h1>
		<blockquote>
<li>To present original, rich and diverse programming of music and other forms of expression free from the direct constraints of commercial interests.</li>
<li>To provide the target audience with a significant alternative to other broadcast media within the station's service area.</li>
<li>To provide a diversity of music and music genres underrepresented in mainstream media.</li>
<li>To provide informative educational and public affairs programming.</li>
<li>To inform on issues and events of interest to the target audience.</li></blockquote><p>
	</div>
	<br>
	
	<div class="roundednew">
	<h1 class="title-head-right">Introduction to Radio Broadcasting Course</h1>
	<p>All new presenters are required to undertake Edge Radio's compulsory Introduction to Radio Broadcasting course. The Course comprises of six two hour sessions and is run over three weeks with two sessions a week (generally a Tuesday and Thursday evening). The course is designed to introduce you to the world of radio and the underlying concepts and laws people in the media must follow. The course will also give you an opportunity to have hands on time with a trainer in the studio. The course costs $180 in total, which includes access card and Tasmanian Youth Broadcasters membership. Different payments options are available: PayPal, Credit Card (via PayPal), and Direct Deposit. Once your program application is in and approved you will be contacted by the Training Coordinator via email with payment instructions.</p>
		
<p>The course is also open to those who wish to learn about being a radio broadcaster but don't necessarily want a radio program. If that sounds like you then send an email to <a href="mailto:training@edgeradio.org.au">training [at] edgeradio.org.au</a> to enquire about signing up.

	</p>
	<blockquote>
	<li>Session One: Station Induction and Overview. (May 6th)</li>
	<li>Session Two: Industry Context and Media Law. (May 8th)</li>
	<li>Session Three: Planning and Presenting a Program. (May 13th)</li>
	<li>Session Four: Website Features, AMRAP Pages, and Introduction to the Studio. (May 15th)</li>
	<li>Session Five: Studio Session. (May 20th)</li>
	<li>Session Six: Studio Session. (May 22st)</li>
	</blockquote>
<p><b>Next Training Course Starts: May 6th at 6pm in room 312 of the social science building at UTAS.</b></p>
	
<b><p>If you're interested in just doing the training course and not presenting a program or have any questions about the course please email:</b> <a href="mailto:training@edgeradio.org.au">training [at] edgeradio.org.au</a></p>
	
	</div><br>
	
	<div class="roundednew">
	<h1 class="title-head-right">What We're Currently Looking For</h1>
	<p>Edge Radio is always on the lookout for new and interesting ideas for programs. But sometimes we're on the lookout for particular kinds of programs to fill a gap in the content we cover. Below is a short list of the programs we're currently after. Don't be disheartened if you have an idea that is not on this list. All submissions will be considered. The more out there the idea the better we say.
	
	<blockquote>
	<li>Two hour lunchtime programs</li>
	<li>Dedicated community news program</li>
	<li>Afternoon interviews programs</li>
	<li>Specialist hardcore metal program (late night)</li>
	</blockquote></p>
	
<b>If you have any questions about the application process you can send and email to</b> <a href="mailto:programs@edgeradio.org.au">programs [at] edgeradio.org.au</a><p>
	
	</div></p>
	
<form name="form" action="new.php">
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Apply For A New Program >>" name="submit" type="submit" />
        </form>
        
        <br>
	<form name="form" action="reapp.php">
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Reapply Existing Program >>" name="submit" type="submit" />
        </form>
        
        <?php
		 } else {
		 
		 echo'<div class="rounded"><div style="padding: 20px 0 20px 0; line-height: 50px; font-size: 32px;" class="title">Program Applications Are Currently Closed.<p>Next round of applications will open on September 29 2014.<p>Want to chat about possibilities? Feel free to contact the program manager via <a href="mailto:programs@edgeradio.org.au">programs [at] edgeradio.org.au</a></div></div>';
		 
		 }
    }
		?>
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

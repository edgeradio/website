<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	 <ul class="border-light">
	 <li>1. Introduction</li>
	 <li style="color: #C0C0C0;">2. Contact Details</li>
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
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Edge Radio New Presenter Training</div>
		<p>All new presenters are required to undertake Edge Radio's compulsory Introduction to Radio Broadcasting course. The Course comprises of six two hour sessions and is run over three weeks with two sessions a week (generally a Tuesday and Thursday evening). The course is designed to introduce you to the world of radio and the underlying concepts and laws people in the media must follow. The course will also give you an opportunity to have hands on time with a trainer in the studio. The course costs $180 in total, which includes access card and Tasmanian Youth Broadcasters membership. Different payments options are available: PayPal, Credit Card (via PayPal), and Direct Deposit. Once your program application has been approved you will be contacted by the Training Coordinator via email with payment instructions.</p>
		
<p>The course is also open to those who wish to learn about being a radio broadcaster but don't necessarily want to present a radio program. The cost for just the course is $150.</p>

<p><b>You are required to pay for the course before the it commences. If you cannot please contact the training coordinator ASAP via <a href="mailto:training@edgeradio.org.au">training [at] edgeradio.org.au</a> to sort out payment.</b></p>		

<b>This training course is compulsory for all presenters and producers prior to starting a program.</b>
		</p>
		
		</div>
		<br>
		<div class="rounded">
		<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Course Structure</div>

<blockquote>
	<li>Session One: Station Induction and Overview. (May 6th)</li>
	<li>Session Two: Industry Context and Media Law. (May 8th)</li>
	<li>Session Three: Planning and Presenting a Program. (May 13th)</li>
	<li>Session Four: Website Features, AMRAP Pages, and Engaging your Audience via Social Media. (May 15th)</li>
	<li>Session Five: Studio Session. (May 20th)</li>
	<li>Session Six: Studio Session. (May 22st)</li>
	</blockquote>
<p><b>Next Training Course Starts: May 6th at 6pm in room 312 of the social science building at UTAS.</b></p>
	
<b><p>If you're interested in just doing the training course and not presenting a program or have any questions about the course please email:</b> <a href="mailto:training@edgeradio.org.au">training [at] edgeradio.org.au</a></p>

	</div>
	
	<br>
	<form name="form" action="http://www.edgeradio.org.au/programs/training/details.php" method="post">
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Sign Up For Training Session >>" name="submit" type="submit" />
        </form>
        
        <?php
		 } else {
		 
		 echo'<div class="rounded"><div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Training Is Currently Closed. Sorry.</div></div>';
		 
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
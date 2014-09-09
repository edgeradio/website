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
    <h1><p align="center">Reapplications FAQ and Reminders</h1></p>
    <h3><p align="center">Before you submit your reapplication please take some time to read the FAQ and reminders.</p></h3>
    
    </div>
	<br>
	
	<div class="roundednew">
	<h1 class="title-head-right">FAQ</h1>
	<p><b>Am I Guaranteed A Timeslot In The Next Schedule?</b><br>
	We'd love to say right here and now that your program is confirmed for next season. But there's many reasons why we might not renew a program. When we construct a new schedule we do look back over the previous six months to assess if a program a been has performing as expected. Don't worry, that's not as scary as it sounds. It comes down to few core elements. Has a program's original concept/pitch been adhered to? Have there been any unexplained absences? Is the program complying with station policy and the codes of practice?</p>
	
	<p><b>HOT TIP:</b> If you do a music program and your playlists aren't being kept up to date you'll significantly decrease your chances of having your program renewed.</p>
	
	<p><b>ANOTHER HOT TIP:</b> You'll need to have paid your TYB Inc 2014 membership fee of $10 to be able to continue next season.</p>
	
	<p><b>Make Sure Every Presenter's Details Are Up To Date</b><br>
	Please make sure that you enter in every presenter's details for your program and make sure they're up to date. We want to make sure everyone is getting communicated with throughout the the next schedule. Also make sure you include your access card number(s) as well.</p>

	<p><b>I Want To Change Aspects Of My Program</b><br>
	Sure, no problem. If you're looking to change some aspects of your program the reapplication form will allow you to update the descriptions and other minor details, including applying for a timeslot change. If you're wanting to make huge wholesale changes to your program you'll need to submit a completely new program application. Big changes mean we need more details, of which the new application form can hold.</p>
	
	<p><b>HOT TIP:</b> Timeslot changes are hard to obtain and while we do our very best to get you the timeslot you want it's always best to not get your hopes up.</p>
	
	<p><b>What If I'm Asked To Change My Timeslot?</b><br>
	Sometimes we ask programs to change timeslots because we think your program will benefit from a larger more appropriate audience. In most circumstances we don't like asking programs to change their timeslots because we know you're building an audience. Rest assured if you do get asked it will be for all the right reasons.
	
	<p><b>What's This About 30 Minute Programs?</b><br>
	There is now an option to do a 30 minute program. 30 minute programs are generally allocated during the day (mostly in the morning) and are expected to be all talk content with little to no music. This could be a great opportunity to get second passion out there.
	
	<p><b>How Can I Keep Up To Date With What's Happening With The Next Schedule?</b><br>
	We realise it might seem like there's a wall of silence as things get sorted behind the scenes. Preparing a new season of radio is time consuming and often takes months to really bed down with a complete picture of what's going on. But we're keen on keeping current presenters in the loop. So now you can follow the evolution of next season by following the link below.</p>
	
	<p><a href="https://docs.google.com/document/d/1zkmsRHqWYJewv5biojMdsFcVRyqrFHFeuXSgDbBjveA/edit?usp=sharing">Live Evolving Program Guide</a></p>
	
	Please be aware that this document is only a guide and is not always the most up to date version of the program guide.<br>
	
	<p><b>I Have A Question That's Not Answered Here</b><br>
	Sure, we're happy to answer, or try to answer any questions you might have. If you have any questions about the reapplication process you can send an email to</b> <a href="mailto:programs@edgeradio.org.au">programs [at] edgeradio.org.au</a><p> 
	
	Beyond that if you have any general questions an Edge Radio staff member can help you out. Drop by our office for a chat or give us a call on 0362 267273.
	<br>
	</div>
	<br>
	
	<div class="roundednew">
	<h1 class="title-head-right">Introduction to Radio Broadcasting Course</h1>
	<p>All new presenters are required to undertake Edge Radio's compulsory Introduction to Radio Broadcasting course. As an existing presenter you would of done a similar training course. But it may have been a while since then so you're more than welcome to come along to the course we're running in May to brush up on your presenting skills. There's even a session about engaging your audience via social media. Details below.</p>

	<blockquote>
	<li>Session One: Station Induction and Overview. (May 6th)</li>
	<li>Session Two: Industry Context and Media Law. (May 8th)</li>
	<li>Session Three: Planning and Presenting a Program. (May 13th)</li>
	<li>Session Four: Website Features, AMRAP Pages, and Engaging your Audience via Social Media. (May 15th)</li>
	<li>Session Five: Studio Session. (May 20th)</li>
	<li>Session Six: Studio Session. (May 22st)</li>
	</blockquote>
<p><b>Next Training Course Starts: May 6th</b></p>
	
<b><p>If you're interested in attending the course please register your interest by emailing:</b> <a href="mailto:training@edgeradio.org.au">training [at] edgeradio.org.au</a></p>
	
	</div><br>
	
	<form name="form" action="https://docs.google.com/forms/d/1uvimWuuZY9w_76Ww4l7NtzB_86x2VncvSXoZiGfh0z8/viewform">
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Click Here To Reapply For Your Program >>" name="submit" type="submit" />
        </form>
        
        <br>
        
        <?php
		 } else {
		 
		 echo'<div class="rounded"><div style="padding: 20px 0 20px 0; line-height: 50px; font-size: 32px;" class="title">Program Applications Are Currently Closed.<p>Next round of applications will open on October 1st.<p>Want to know more about the application process? Feel free to contact the program manager via <a href="mailto:programs@edgeradio.org.au">programs [at] edgeradio.org.au</a></div></div>';
		 
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

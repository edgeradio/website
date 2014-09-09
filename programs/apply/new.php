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
    <h1><p align="center">New Applications FAQ</h1></p>
    <h3><p align="center">Before you submit an application please take some time to read the FAQ.</p></h3>
    
    </div>
	<br>
	
	<div class="roundednew">
	<h1 class="title-head-right">FAQ</h1>
	<b>There's a lot of information to digest in the FAQ. We hope you don't get scared off. We've covered the basics but if you have any questions about the application process you can send an email to</b> <a href="mailto:programs@edgeradio.org.au">programs [at] edgeradio.org.au</a><p>
	
	<p><b>Does it Cost Anything to be a Presenter on Edge Radio?</b><br>
	New presenters will need to attend Edge Radio's Introduction to Radio Broadcasting Course, which will set you back $180. More details about the course can be found at the 	bottom of this FAQ. If you have done a similar course or have relevant qualifications please contact the program manager to discuss the next step.</p>
	
	<p><b>What kind of Programs Does Edge Radio Broadcast?</b><br>
	Edge Radio likes to broadcast all kinds of programming. If it has a youth focus that appeals to ‘youth of all ages’ then it could have a home on Edge Radio. To expand on this, Edge Radio has two distinct kinds of programs, general and specialist music.</p>
	
	<p><b>What Is A General Program?</b><br>
	General programs tend to be during the day and cover many types of programs including, light entertainment, journalistic/news/current affairs, community issues/local content. Applying for a general program means you will 	be doing a talk based program concentrating on informational content and not music content. You will generally be expected to stick to Edge Radio’s pre-scheduled music playlist.</p>
	
	<p><b>What Is A Specialist Music Program?</b><br>
	A specialist music program is what you’d expect, a program that dives deep into a certain area of music, be it a genre, era, or everything in between. Specialist music programs are usually during the evening or night and allow you to have the freedom to pick all the music on your program.</p>
	
	<p><b>What Length Program Can I Have?</b><br>
	Most programs are one or two hours. We don’t generally allocate more than two hours. There is an option for 30 minute programs. These are in specific timeslots and require further discussion with the Program Manager.</p>
	
	<p><b>Can I Pick The Time And Day My Program Is On?</b><br>
	While you’re able to specify your availabilities during the application process, timeslot allocations are always very tight. While we make every effort to give presenters their requested timeslots you should not pin your hopes on a particular timeslot. Programs are allocated timeslots where we believe they will have an audience. Evening and night timeslots are extremely hard to obtain.</p>
	
	<p><b>I Want To Do A General Program Where I Pick The Music.</b><br>
	Sorry, the answer will generally be a no. If you think your idea merits further discussion you can always contact the Program Manager to state your case.</p>
	
	<p><b>Can I Do A Talkback Radio Program?</b><br>
	No. Edge Radio does not broadcast any talkback content.</p>
	
	<p><b>I Want To Do A Program Where I Play Just Cool Music.</b><br>
	We’re sure you have wonderful taste in music, but you’ll have to do better than just wanting to play cool music you like. Your application will need to be very defined and give us a detailed idea of what your music program will be focused on. This helps us decide if your program will have an audience and where it is best placed in the schedule.</p>
	
	<p><b>The Program I Want To Do Sounds Like One Edge Radio Already Has.</b><br>
	We don’t generally have two programs that cover the same topic. But don’t lose hope. If you’re dead keen to get involved the current presenters might be happy to have you contribute to their program. Just get in touch with the Program Manager if this is the case.</p>
	
	<p><b>If I Do A Specialist Music Program Can I Request Music/CDs?</b><br>
	Edge Radio’s music department is more than happy to help get you music from your program. However station policy does not allow presenters to approach labels/band/PR. If you want any music from a specific place you must request it via the music department. Generally Edge Radio will get 90% of the new music programs ask for, so chances are you’ll get what you’re after.</p>
	
	<p><b>If My Application Is Successful What Kind Of Commitment Am I Looking At?</b><br>
	Edge Radio runs a six months rotating programming schedule. What this means is each season runs for about six months before we refresh things. We run a summer and winter schedule. So overall we ask presenters to commit to 	six months of weekly radio.</p>
	
	<p><b>What If I Cannot Make It One Week?</b><br>
	We understand that there are times where you cannot manage to make it to your program. Edge Radio has the <b>Airtime Caretaker Policy</b>, which details the procedure when you need to miss a program one week.</p>
	
	<p><b>Does Edge Radio Syndicate Any Programs?</b><br>
	Yes, we have a small number of programs we take from the Community Radio Network. They are mainly news-based programs. We 100% prefer locally produced programs with local voices, so if you think you'd like a crack at doing the topic of one of our syndicated programs please contact the program manager.</p>
	
	<p><b>I Have An Idea For A Program But I’d Like To Talk To Someone Before Submitting An Application.</b><br>
	Sometimes chatting to an Edge Radio staff member can help you flesh out a program idea. We’re always happy to chat with potential new presenters with pockets full of new ideas. Drop by our office for a chat or give us a call on 0362 267273.</p>
	
	<br>
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
	<li>Session Four: Website Features, AMRAP Pages, and Engaging your Audience via Social Media. (May 15th)</li>
	<li>Session Five: Studio Session. (May 20th)</li>
	<li>Session Six: Studio Session. (May 22st)</li>
	</blockquote>
<p><b>Next Training Course Starts: May 6th</b></p>
	
<b><p>If you're interested in just doing the training course and not presenting a program or have any questions about the course please email:</b> <a href="mailto:training@edgeradio.org.au">training [at] edgeradio.org.au</a></p>
	
	</div><br>
	
	<div class="roundednew">
	<h1 class="title-head-right">Programs We're Currently Looking For</h1>
	<p>Edge Radio is always on the lookout for new and interesting ideas for programs. But sometimes we're on the lookout for particular kinds of programs to fill a gap in the content we cover. Below is a short list of the programs we're currently after. Don't be disheartened if you have an idea that is not on this list. All submissions will be considered. The more out there the idea the better we say.
	
	<blockquote>
	<li>Two hour lunchtime programs</li>
	<li>Afternoon interviews programs</li>
	<li>Specialist hardcore metal program (late night)</li>
	</blockquote></p>
	
<b>If you have any questions about the application process you can send and email to</b> <a href="mailto:programs@edgeradio.org.au">programs [at] edgeradio.org.au</a><p>
	
	</div></p>
	
	<form name="form" action="https://docs.google.com/forms/d/1SzOo4lmp9NM27hLM2DI6zHwIdMshxY7b2ejD-fucPdg/viewform">
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Apply For A New Program >>" name="submit" type="submit" />
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

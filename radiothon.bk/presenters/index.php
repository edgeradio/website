<?php include '../../inc/common_start.php'; ?>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
<script src="http://www.edgeradio.org.au/java/showHide.js" type="text/javascript"></script>


<style type="text/css">

#marqueecontainer{
position: relative;
width: 100%; /*marquee width */
height: 200px; /*marquee height */
background-color: white;
overflow: hidden;
padding: 2px;
padding-left: 4px;
}

</style>

<script type="text/javascript">

/***********************************************
* Cross browser Marquee II- © Dynamic Drive (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit http://www.dynamicdrive.com/ for this script and 100s more.
***********************************************/

var delayb4scroll=2000 //Specify initial delay before marquee starts to scroll on page (2000=2 seconds)
var marqueespeed=2 //Specify marquee scroll speed (larger is faster 1-10)
var pauseit=1 //Pause marquee onMousever (0=no. 1=yes)?

////NO NEED TO EDIT BELOW THIS LINE////////////

var copyspeed=marqueespeed
var pausespeed=(pauseit==0)? copyspeed: 0
var actualheight=''

function scrollmarquee(){
if (parseInt(cross_marquee.style.top)>(actualheight*(-1)+8))
cross_marquee.style.top=parseInt(cross_marquee.style.top)-copyspeed+"px"
else
cross_marquee.style.top=parseInt(marqueeheight)+8+"px"
}

function initializemarquee(){
cross_marquee=document.getElementById("vmarquee")
cross_marquee.style.top=0
marqueeheight=document.getElementById("marqueecontainer").offsetHeight
actualheight=cross_marquee.offsetHeight
if (window.opera || navigator.userAgent.indexOf("Netscape/7")!=-1){ //if Opera or Netscape 7x, add scrollbars to scroll and exit
cross_marquee.style.height=marqueeheight+"px"
cross_marquee.style.overflow="scroll"
return
}
setTimeout('lefttime=setInterval("scrollmarquee()",30)', delayb4scroll)
}

if (window.addEventListener)
window.addEventListener("load", initializemarquee, false)
else if (window.attachEvent)
window.attachEvent("onload", initializemarquee)
else if (document.getElementById)
window.onload=initializemarquee


</script>

<?php include '../../inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="../../images/edge-radiothon.png" alt="edge radio 99.3FM" width="700" height="105"/></div>
    <div id="one_column">



<div class="rounded">
<center>
Phone Line:
<h1>(03) 6226 7273</h1>

Text Line:
<h1>0427 334 336</h1>

Website:
<h1>edgeradio.org.au/radiothon</h1>
</center>
</div>

<br />
   
<div class="rounded">
<h1 class="greyheader">HEY!</h1>

<p>So - Radiothon starts this Monday, you'll be needing to get all over it like a
rash on a baby.</p>

<p>How do we do this thing then?</p>

<p>It's really important that EVERY PROGRAM is involved with the Radiothon and
presents a consistent message on-air. This is the one time of year when we
need to be a collective, not individuals, and pull together to make this an
amazing event.</p>

<p>We also want Radiothon to sound exciting, not a drag. If you're passionate
about Edge and what we do then it won't be a problem for you!</p>

<p>It would be super amazing if you could mention Radiothon and the sign up
procedure at least 4 times during your program. It might be nice to also
talk about why you think Edge Radio is important, and why you're involved,
you know - add some personal touch to Radiothon.</p>

<p>There are daily major prizes, so make sure you check the Radiothon page daily to mention on air!</p>


</div>

<br/>

<div class="rounded">
<h1 class="greyheader">TIPS FOR PRESENTERS</h1>

<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
<div id="vmarquee" style="position: absolute; width: 98%;">

<div style="color: green;">

<h4>SHOW US SOME LOVE! :)</h4>
Ask listeners to log on to our Radiothon page on the website to 
add their comment on our "Love Box". Ask them to say why they
love Edge Radio and to show their support!

<br />


<h4>During Your Program, Use These Phrases:</h4>
<ul>
<li>Support the station that supports you</li>
<li>If you love Edge Radio, if you love what we do, if you love [insert
show name] then why not ring up right now and become a Supporter.</li>
<li>This week Edge Radio is holding its second Radiothon - and we're
asking you, the listener, to become a Supporter of the station.</li>
</ul>

<h4>Social Networking</h4>
Use social networking sites like Twitter and Facebook to let peeps
know what prize they can win by becoming a Supporter during your show (or
throughout the day) to win fantastic prizes and keep us on air.

<br />

<h4>Face The Music</h4>
Mention the Face The Music Quiz -
<a href="http://www.edgeradio.org.au/facethemusic.php">http://www.edgeradio.org.au/facethemusic.php</a>

<br />

<h4>Let Listeners Know!</h4>
Let listeners know that if they can't get through because the phone
is engaged, they should keep on trying - we only have one phone line!

<br />

<h4>How To Donate?</h4>
Listeners can either ring the office during your program (and during the
week), with their credit card details OR jump online and use the Paypal or
secure credit card options. http://www.edgeradio.org.au/radiothon/ 


</div>

<div style="color: red;">

<h4>DONT Say...</h4>
That we "need" money or that we are "poor" - we don't want a
negative perception of the station to become apparent on -air. This is not
about us being needy, it is about us trying develop some financial
sustainability for the future and encouraging the listeners to participate
in that.


</div>

</div>
</div>


</div>

<br />


<div class="roundedblack" style="line-height: 40px; text-align: center; width: 100%;">
<a href="http://www.edgeradio.org.au/radiothon/" style="color: #FFFFFF; text-decoration: none; font-size: 35px;">Go To The Radiothon Page >></a>
</div>

      <div id="footer">
        <?php include '../../inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../inc/common_end.php'; ?>

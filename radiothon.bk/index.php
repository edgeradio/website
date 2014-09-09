<?php include '../inc/common_start.php'; ?>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
<script src="http://www.edgeradio.org.au/java/showHide.js" type="text/javascript"></script>
<script type="text/javascript" src="thickbox.js"></script>
<link rel="stylesheet" href="thickbox.css" type="text/css" media="screen" />


<script type="text/javascript">


window.onload = function(){
}

$(document).ready(function(){


   $('.show_hide').showHide({			 
		speed: 1000,  // speed you want the toggle to happen	
		easing: '',  // the animation effect you want. Remove this line if you dont want an effect and if you haven't included jQuery UI
		changeText: 0, // if you dont want the button text to change, set this to 0
		showText: 'View',// the button text to show when a div is closed
		hideText: 'Close' // the button text to show when a div is open
					 
	}); 


});

</script>

<style>


#Rthon1, #Rthon2, #Rthon3, #Rthon4, #Rthon5 {
	display:none;
clear: both;
}



</style>

<?php include '../inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="../images/edge-radiothon.png" alt="edge radio 99.3FM" width="700" height="105"/></div>
    <div id="one_column">
    
     <div class="rounded">
     Radiothon
2011 is now over. You can still sign up as Edge Radio Supporter to keep Edge
Radio on air. Tune into Edge breakfast programming all this week to hear the
announcement of the winners for the major daily Radiothon prizes!
     </div>
     
     <br />
   
<div class="roundedblack" style="line-height: 40px; text-align: center; float: right; width: 240px; background-image: url(Untitled-1.jpg); background-position: top right; background-repeat: no-repeat;">
Show Us Some Love<br />
<a class="thickbox" href="#TB_inline?height=200&width=300&inlineId=CreditCard" title="Donate Via Credit Card" style="color: #FFFFFF; text-decoration: none; font-size: 35px;">Via Credit Card</a>
</div>

 
<div class="roundedblack" style="line-height: 40px; text-align: center; float: left; width: 240px; background-image: url(Untitled-1.jpg); background-position: top right; background-repeat: no-repeat;">
Show Us Some Love<br />
<a class="thickbox" href="#TB_inline?height=200&width=300&inlineId=PayPal" title="Donate Via PayPal" style="color: #FFFFFF; text-decoration: none; font-size: 35px;">Via PayPal</a>
</div>

<div style="display: none;" id="CreditCard"><p>
Choose a supporter option below to donate via Credit Card</p>
<p>When prompted, choose the "Don't Have A PayPal Account?" button to enter in your credit card details securely.</p>
<p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="3571333">
<select style="width: 200px; border: 1px solid #39807C; padding: 2px;" name="os0">
<option>Select An Option...</option>
	<option value="Edgeling (Under 18)/Concession">Edgeling (Under 18/Concession) $16.00</option>
	<option value="Love Ya Lots">Love Ya Lots $35.00</option>
	<option value="I'm Passionate">I'm Passionate $100.00</option>
	<option value="Band/Artist/DJ">Band/Artist/DJ $75.00</option>
</select>
<input type="hidden" name="currency_code" value="AUD">
<input type="submit" name="submit" value="Submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
</p></div>

<div style="display: none;" id="PayPal"><p>
Choose a supporter option below to donate via PayPal</p>
<p>When prompted, choose the "I Have A PayPal Account" button to enter in your login details securely.</p>
<p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="3571333">
<select style="width: 200px; border: 1px solid #39807C; padding: 2px;" name="os0">
<option>Select An Option...</option>
	<option value="Edgeling (Under 18)/Concession">Edgeling (Under 18/Concession) $16.00</option>
	<option value="Love Ya Lots">Love Ya Lots $35.00</option>
	<option value="I'm Passionate">I'm Passionate $100.00</option>
	<option value="Band/Artist/DJ">Band/Artist/DJ $75.00</option>
</select>
<input type="hidden" name="currency_code" value="AUD">
<input type="submit" name="submit" value="Submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
</p></div>



<div style="clear: both;"></div>

<br /><br />

      <div class="rounded" style="margin-top: 50px; padding-top: 30px;">
        <a href="#" class="show_hide" rel="#Rthon1"><img style="border: 0px; margin: -90px -0px 0px -18px;" src="radiothon.png"></a>
<div class="show_hide" rel="#Rthon1" style="position: absolute; margin: -25px 0px 0px 490px; font-size: 11px; color: #888888;">Click To Show</div>
    <div id="Rthon1">
<p>Radiothon 2011 is here. From Monday October 24 to Sunday October 30 we're calling on you, the community, to show Edge Radio some love and sign up as a Supporter. Financial Supporters are vital to the survival of community radio. So if you're passionate about local music, arts, and culture - dig deep from October 24 and show us some love.</p>

<p>Have a squiz at the major daily prizes on offer, and simply sign up or donate using your credit card or PayPal. Sign up on a certain day of the week and you'll automatically go into the draw to win the major prize for that day!</p>

<p>What do lovely Supporters get?</p>

<p>
<ul>
<li>Eligibility for Supporter-only giveaways of tickets, CDs and other goodies</li>
<li>The fortnightly What's On Edge mailout of news, events, and other music essentials</li>
<li>The Edge Radio Supporter card</li>
<li>The Edge Radio bumper sticker - show your colours and wear it with pride</li>
<li>A CD of your choice - we'll send you our music list to choose from</li>
<li>The feel-good factor that comes from supporting a great cause - priceless!</li>
</ul>
</p>

<p>Edgeling (under 18)/Concession $16 (proof of age/concession card required)</p>

<p>Love Ya Lots $35</p>

<p>I'm Passionate $100 - comes with your very own Edge tee</p>

<p>Band/Artist/DJ $75 - includes $100 credit towards your next on-air campaign, a guaranteed feature on 'Tasmusica', and credits every time your song gets played on Edge.</p>

<p>Show us some love - donate or sign up as a Supporter today!</p>
</div>
      </div>
      
      <br />
      
<div class="rounded" style="margin-top: 50px; padding-top: 30px;">
<a href="#" style="clear: both;" class="show_hide" rel="#Rthon2"><img style="border: 0px; margin: -90px -0px 0px -18px;" src="what-is-radiothon.png"></a>
<div class="show_hide" rel="#Rthon2" style="position: absolute; margin: -25px 0px 0px 490px; font-size: 11px; color: #888888;">Click To Show</div>
        <div id="Rthon2">
<p>Much like 'Radiothon 2010' that ran last year, we are turning to the music loving community to help raise vital funds to keep Edge Radio alive and rockin'.</p>

<p>A Radiothon is week long period where we ask our listeners to contribute financially to the station. Edge Radio is a not-for-profit, independent station that relies on sponsors and hip people like YOU to operate.</p>

<p>Most community stations run an annual Radiothon as a major source of vital income.  There are heaps of prizes and incentives involved.</p>

<p>There are also fundraising events and fun things throughout the week.</p>

<p><b>Why are we running Radiothon now?</b>

<p>Edge Radio, like most not-for-profit organisations, relies on the support of the community to stay afloat.</p>

<p>Edge Radio is a non-profit community radio station that relies on listener subscriptions and support to operate - listener-funded radio. Our annual Supporter drive, Radiothon, is absolutely critical to keep the station alive for listeners.</p>

<p>Edge Radio maintains a passionate commitment to Tasmanian music, arts and culture. With the efforts of over 100 volunteer broadcasters, the station produces live & local independent radio 24 hours a day, 7 days a week.</p>

<p>Edge Radio is a community resource and the community needs to take some
ownership over that.</p>
        
</div></div>

<br />

<div class="rounded" onclick="window.open('http://www.edgeradio.org.au/facethemusic.php'); return false;" style="cursor: pointer; background-image: url(ftmradbann.jpg); height: 80px;">
</div>

<br />
      
<div class="rounded" style="margin-top: 30px; padding-top: 30px;">
<a href="#" class="show_hide" rel="#Rthon3"><img style="border: 0px; margin: -90px -0px 0px -18px;" src="prizes.png"></a>
<div class="show_hide" rel="#Rthon3" style="position: absolute; margin: -25px 0px 0px 490px; font-size: 11px; color: #888888;">Click To Show</div>
<div id="Rthon3">
<p>Sign up as a Supporter during Radiothon 2011 and you’ll automatically go
into the draw to win the major prize for that day.</p>

<p><b>Monday, Oct 24:</b> Win your height in CDs!</p>

<p><b>Tuesday, Oct 25:</b> VIP lunch experience at The Lansdowne Café with a
complimentary bottle of wine + an Edge Radio Recommended pack of ten CDs.</p>

<p><b>Wednesday, Oct 26:</b> x2 VIP passes to Xzibit - Friday December 9th at the
Derwent Entertainment Centre, courtesy of Carpe Noctem.</p>

<p><b>Thursday, Oct 27:</b> A double pass to see '6/7 Empty', a dance piece on in the Peacock on
Wednesday 23 November + a double pass to see 'Circus Horrificus' in the
Peacock Theatre in December.</p>

<p><b>Friday, Oct 28:</b> $50 voucher to any gig at The Brisbane Hotel + a Popboomerang
CD prize pack of epic goodness.</p>

<p><b>Saturday, Oct 29:</b> $50 voucher to any gig at The Brisbane Hotel + an Ivy League CD prize pack of epic goodness.</p>

<p><b>Sunday, Oct 30:</b> A $50 gift card to Video City + a mixed DVD pack.</p>

<p>Winners of each prize will be announced on air the week of Monday, October
31. Winners will be contacted by an Edge Radio representative.</p>

<p>You're able to sign up as a Supporter at any time during Radiothon � if you would like to go into the running for one of the daily prizes, please specify when signing up (unless you would like to win the prize allocated to that specific day).</p>
</div></div>


<br />
      
<div class="rounded" style="margin-top: 50px; padding-top: 30px;">
<a href="#" class="show_hide" rel="#Rthon4"><img style="margin: -90px -0px 0px -18px;" src="the-love-box.png"></a>
<div class="show_hide" rel="#Rthon4" style="position: absolute; margin: -25px 0px 0px 490px; font-size: 11px; color: #888888;">Click To Show</div>
<div id="Rthon4">

<p>Show Edge Radio some love. Tell us why you love community radio, and you will go into the draw to win an Edge Radio Recommended CD Pack of 20 CDs and a little extra Edge lovin'!</p>

<div id="disqus_thread"></div>
<script type="text/javascript">
    /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
    var disqus_shortname = 'edgeradio'; // required: replace example with your forum shortname

    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

</div></div>

<br />
      
<div class="rounded" style="margin-top: 50px; padding-top: 30px;">
<a href="#" class="show_hide" rel="#Rthon5"><img style="border: 0px; margin: -90px -0px 0px -18px;" src="videos.png"></a>
<div style="position: absolute; margin: -25px 0px 0px 490px; font-size: 11px; color: #888888;">Click To Show</div>
<div id="Rthon5">
<p><iframe width="100%" height="350" src="http://www.youtube.com/embed/jfjHZEhEHZY?hd=1" frameborder="0" allowfullscreen></iframe></p>
</div></div>

<br />

<div class="rounded">
<center>
<img style="width: 100px; height: 100px; padding: 5px;" src="A_SalArts.jpg">
<img style="width: 100px; height: 60px; padding: 5px;" src="Brisbane.jpg">
<img style="width: 100px; height: 50px; padding: 5px;" src="Carpe Noctem.png">
<img style="width: 100px; height: 50px; padding: 5px;" src="Falls Fest.jpg">
<img style="width: 100px; height: 100px; padding: 5px;" src="lansdowne.png">
<img style="width: 100px; height: 100px; padding: 5px;" src="POPBOOMERANG red.jpg">
<img style="width: 100px; height: 60px; padding: 5px;" src="Popfrenzy.jpg">
<img style="width: 100px; height: 100px; padding: 5px;" src="Remote Control.jpg">
<img style="width: 100px; height: 60px; padding: 5px;" src="Video City.jpg">
</center>
</div>

      <div id="footer">
        <?php include '../inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../inc/common_end.php'; ?>

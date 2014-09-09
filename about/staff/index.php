<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
    <?php include'../sidebar.php'; ?>
    <br />
<?php include '../../inc/sidebar.php'; ?>
	</div>
    
   
    
    <div id="two_column">
    
<style>
ul.tabs {
    width:180px;
    float: left;
    margin:0;
    padding:0;
}
ul.tabs li {
    display:block;
    float:left;
    margin-bottom: 5px;
}
ul.tabs li a {
    display:block;
    float:left;
    width: 140px;
    test-align: right;
    padding: 2px 20px 2px 20px;
    font-size: 22px;
	line-height: 22px;
	font-family: "bebas", arial, serif;
    background:#FFFFFF;
    text-decoration:none;
    -moz-border-radius-topleft: 10px;
    -webkit-border-top-left-radius: 10px;
    -moz-border-radius-bottomleft: 10px;
    -webkit-border-bottom-left-radius: 10px;
    color: #242424;
}

ul.tabs li a span {
	font-size: 14px;
	line-height: 14px;
	color: #242424;
}
.tab-content {
    float: left;
    width: 535px;
    min-height: 232px;
    background:#FFFFFF;
    border:0px;
    padding:25px;
    -moz-border-radius-bottomright: 10px;
    -webkit-border-bottom-right-radius: 10px;
    -moz-border-radius-topright: 10px;
    -webkit-border-top-right-radius: 10px;
}

.tab-content p {
    font-size: 11px;
    width: 300px;
}

</style>

<script>
$(document).ready(function() {
 
	$('.tabs a').click(function(){
		switch_tabs($(this));
	});
 
	switch_tabs($('.defaulttab'));
 
});
 
function switch_tabs(obj)
{
	$('.tab-content').hide();
	$('.tabs a').removeClass("selected");
	var id = obj.attr("rel");
 
	$('#'+id).fadeToggle("fast", "linear").show();
	obj.addClass("selected");
}
</script>

<div id="wrapper">
    <ul class="tabs">
    	<li><a href="#" class="defaulttab" rel="tabs1">
    	<span>Station Manager</span>
    	<br>Mark Cutler</a></li>
    	
    	<li><a href="#" rel="tabs3">
    	<span>Program Manager</span>
    	<br>Alastair Ling</a></li>
    	
        <li><a href="#" rel="tabs4">
        <span>Training & Sponsorship Coordinator</span>
        <br>Honni Mooy-Cox</a></li>
        
        <li><a href="#" rel="tabs5">
        <span>Marketing & Communications</span>
        <br>Melanie Page</a></li>
        
    </ul>
    
    <!-- MARK CUTLER -->
    <div style="background-image: url(mark.png); background-repeat: no-repeat; background-position: center right;" class="tab-content" id="tabs1">
    <span style="font-size: 52px;" class="title">Mark Cutler</span><br>
    <span style="font-size: 28px; line-height: 32px;" class="title">Station Manager</span>
    <br>
    <p>Phone: (03) 6226 7272<br>Email: manager [at] edgeradio.org.au</p>
    </div>
    
    <!-- TIM KLING -->
    <div style="background-image: url(tim.png); background-repeat: no-repeat; background-position: bottom right;" class="tab-content" id="tabs2">
    <span style="font-size: 52px;" class="title">Tim Kling</span><br>
    <span style="font-size: 28px; line-height: 32px;" class="title">Program Manager</span>
    <br>
    <p>Phone: (03) 6226 7273<br>Email: programs [at] edgeradio.org.au</p>
    </div>
    
    <!-- ALASTAIR LING -->
    <div style="background-image: url(al.png); background-repeat: no-repeat; background-position: bottom right;" class="tab-content" id="tabs3">
    <span style="font-size: 52px;" class="title">Alastair Ling</span><br>
    <span style="font-size: 28px; line-height: 32px;" class="title">Program Manager</span>
    <br>
    <p>Phone: (03) 6226 7272<br>Email: programs [at] edgeradio.org.au</p>
    </div>
    
    <!-- ANDREW MAZENGARB -->
    <div style="background-image: url(dunno.png); background-repeat: no-repeat; background-position: bottom right;" class="tab-content" id="tabs4">
    <span style="font-size: 52px;" class="title">Honni Mooy-Cox</span><br>
    <span style="font-size: 28px; line-height: 32px;" class="title">Training & Sponsorship Coordinator</span>
    <br>
    <p>Phone: (03) 6226 7273<br>Email: training [at] edgeradio.org.au<br>Email: sponsor [at] edgeradio.org.au</p>
    </div>
    
     <!-- IMOGEN LANCASTER -->
    <div style="background-image: url(dunno.png); background-repeat: no-repeat; background-position: bottom right;" class="tab-content" id="tabs5">
    <span style="font-size: 52px;" class="title">Melanie Page</span><br>
    <span style="font-size: 28px; line-height: 32px;" class="title">Marketing & Communications</span>
    <br>
    <p>Phone: (03) 6226 7273<br>Email: marketing [at] edgeradio.org.au</p>
    </div>
    
</div>

<div style="clear: both;"></div>

        
     <br />
     <div class="roundednew">
     <h1 class="title-head-right">About Edge Radio</h1>
     Edge Radio is a not-for-profit community station, in Hobart, Tasmania. As Hobart’s only youth station, Edge Radio provides a mix of music, entertainment, local journalistic content and information to enhance Hobart’s cultural landscape. Edge Radio broadcasts to the greater Hobart area on 99.3fm, and web casts globally on www.edgeradio.org.au.<br><br>
     
     <h2>Who is Edge Radio’s Audience?</h2>
     Youth of all ages. Hobart has a richly diverse community and Edge Radio recognises the unique needs of youth. Edge Radio’s core audience is between 15-30 years. Edge Radio’s programming is broad, and designed to reflect the interests of Hobart. This approach caters not only for the core audience, but has seen a substantial audience beyond this community grow. Whilst we remain committed to serving the needs of our core audience, Edge Radio is fast becoming a service for ‘youth of all ages’.<br><br>
     
              <h2>We're an Award Winning Station</h2>
              <p><strong class="text_red">National Broadcasting Award 2006:</strong> Edge Radio's talented presenters and programmers were recognised at the 2006 Community Broadcasting Association of Australia's (CBAA) annual awards. Edge Radio took out the Excellence in Spoken Word Programming Award.</p>
              <p><strong class="text_red">Australia's Community Radio Station of the Year:</strong> At the 2003 CBAA Industry Awards. Less than 12-months into broadcasting, Edge Radio was chosen by the industry voted awards out of over 350 community radio stations nationwide. </p>
              <p><strong class="text_red">Edge Radio's 'School of Rock' received the Award for Educational Excellence:</strong> From the Tasmanian Department of Education in 2003 for outstanding youth engagement and youth community service.</p>
              <p> <span class="text_red"><strong>Awarded Best Contribution to Local Music:</strong></span> At the 2003 CBAA Industry Awards. Edge Radio's commitment to showcasing Tasmanian Music and enhancing the Tasmanian music scene was acknowledged by industry peers</p>
              <p> <span class="text_red"><strong>Hobart's Volunteer Organisation Best Practice Award</strong></span>: At the Hobart City Council 2004 Volunteer Recognition Awards.      </p>
</p>

</div>

<br>
     <div class="roundednew">   
        <h1 class="title-head-right">TASMANIAN YOUTH BROADCASTERS INC COMMITTEE OF MANAGEMENT</h1>
Edge Radio is governed by Tasmanian Youth Broadcasters Inc. (TYB Inc.); TYB Inc.'s Committee of Management is democratically elected from station membership, and constitutionally reflects educational institutions, community organisations, and general membership.
<br><br>
<table class="smalltext" width="100%" border="0" cellspacing="1" cellpadding="5">
            <tr>
              <td width="36%" align="left" valign="top" bgcolor="#CCCCCC">PRESIDENT</td>
              <td width="64%" align="left" valign="top" bgcolor="#CCCCCC">Steven Wright</td>
            </tr>
            <tr>
              <td width="36%" align="left" valign="top" bgcolor="#CCCCCC">VICE PRESIDENT</td>
              <td width="64%" align="left" valign="top" bgcolor="#CCCCCC"></td>
            </tr>
            <tr>
              <td align="left" valign="top" bgcolor="#CCCCCC">SECRETARY</td>
              <td align="left" valign="top" bgcolor="#CCCCCC">Robert Fisher</td>
            </tr>
             <tr>
              <td align="left" valign="top" bgcolor="#CCCCCC">TREASURER</td>
              <td align="left" valign="top" bgcolor="#CCCCCC">John Minus</td>
            </tr>
            <tr>
              <td align="left" valign="top" bgcolor="#CCCCCC">GENERAL MEMBERS</td>
              <td align="left" valign="top" bgcolor="#CCCCCC">
Charles Touber
</td>
            </tr>
          </table>
<br>To contact the Committee of Management, email: board [at] edgeradio.org.au<br><br>
          
          </div> 
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>
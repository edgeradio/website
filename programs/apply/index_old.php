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
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">What is Edge Radio?</div>
		<p>Edge Radio is a newly licensed Community radio station based in Hobart.  As Hobart’s only youth orientated radio station, Edge Radio provides an alternative to mainstream stations. This is achieved with a mix of youth focused music, entertainment, local journalistic content and other information relevant to youth. Our target audience is aged 15-30, although Edge is a station 'For Youth Of All Ages'.
		
		<br>
		<div style="padding: 20px 0 0px 0; font-size: 24px;" class="title">EDGE RADIO AIMS TO PROVIDE A VIBRANT YOUTH FOCUSED RADIO STATION THAT...</div>
<ul>
<li>Enlivens the culture and social climate of Tasmania</li>
<li>Is responsive to the needs of its audiences</li>
<li>Provides programming relevant to youth</li>
<li>Is high quality</li>
<li>Is artistically diverse</li>
<li>Is broadly inclusive</li>
<li>Has informative and educational programming</li>
<li>Provides a forum to discuss current issues</li>
</ul></p>
		
		</div>
		<br>
		<div class="rounded">
		<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">STATEMENT OF OBJECTIVES</div>
		<p>To present original, rich and diverse programming of music and other forms of expression free from the direct constraints of commercial interests.</p>

<p>To provide the target audience with a significant alternative to other broadcast media within the station’s service area.</p>

<p>To provide a diversity of music and music genres underrepresented in mainstream media.</p>

<p>To provide informative educational and public affairs programming.</p>

<p>To inform on issues and events of interest to the target audience.</p>
	</div>
	
	<br>
	<form name="form" action="http://www.edgeradio.org.au/programs/apply/details.php" method="post">
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Apply For A New Program >>" name="submit" type="submit" />
        </form>
        
        <br>
	<form name="form" action="http://www.edgeradio.org.au/programs/apply/reapply.php" method="post">
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Re-apply Existing Program >>" name="submit" type="submit" />
        </form>
        
        <?php
		 } else {
		 
		 echo'<div class="rounded"><div style="padding: 20px 0 20px 0; line-height: 50px; font-size: 48px;" class="title">Program Applications Are Currently Closed. Sorry.</div></div>';
		 
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

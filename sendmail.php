<?php include 'inc/common_start.php'; ?>
<body>
<script type="text/javascript" src="player/anarchy.js"></script>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
    <?php include 'inc/box_supporter.php'; ?>
    </div>
    <div id="right_column">
        <?php include 'inc/box_flickr.php'; ?>
    </div>
    <div id="three_column">
      <div class="rounded">
        <div class="text">
         <p><img src="facethemusic/facethemusic.jpg" width="490" height="143" alt="Face The Music" /></p>
        <p><strong>The second Edge Radio music quiz, <em>Face The Music</em>, will be held on </strong><strong>Thursday 8th April, 7pm at Hotel SOHO.</strong> </p>
<p>Are you smarter than Edge Radio?</p>
        <p>Pit your wits against the Edge Radio DJs and score yourself some awesome prizes.</p>
        <ul><li>Lucy from Film Central presents the Film Scores round</li>
          <li>Damo &amp; Tom from Live and Loud present the Covers round</li>
          <li>Melanie from Tasmusica presents the Tasmanian round</li>
          <li>Aung from Microphone Check presents the Hip Hop round</li>
          <li>Aeron from We Stole Our Dad's Records presents the 60s/70s round</li>
          <li>Bruno from MVWAT presents the Soul/Funk round</li>
          </ul>
        <p>And what quiz night wouldn’t be complete without a dazzling All Star House Band and audio visual splendifery?</p>
        <p>Register your team of max 6 NOW to avoid disappointment.<br />
          $10 each or $60 a team, payable on the night.</p>
        <form action="http://www.utas.edu.au/cgi-bin/FormMail.pl" method="post" name="Face the Music Entry" id="Face_The_Music_Form" onSubmit="return validateForm(this)">
            <input type="hidden" value="admin@edgeradio.org.au" name="recipient" />
            <input type="hidden" value="http://www.edgeradio.org.au/facethemusic_response.php" name="redirect" />
            <input type="hidden" value="Face the Music Entry" name="subject" />
            <p><b>REGISTRATION
              FORM</b></p>
            <p>Key Team Contact: <input name="Key Team Contact" type="text" id="keycontact" value="(Full Name)" size="50" />
              <br />
              Email:
              <input name="Key Contact Email" type="text" id="keycontact_email" value="" size="60" />
            </p>
            <p>Team Member 2:
              <input name="Team Member 2" type="text" id="member2" value="(Full Name)" size="50" />
<br />
Email:
<input name="Team Member 2 Email" type="text" id="member2_email" value="" size="60" />
</p>
            <p>Team Member 3:
              <input name="Team Member 3" type="text" id="member3" value="(Full Name)" size="50" />
<br />
Email:
<input name="Team Member 3 Email" type="text" id="member3_email" value="" size="60" />
</p>
            <p>Team Member 4:
              <input name="Team Member 4" type="text" id="member4" value="(Full Name)" size="50" />
<br />
Email:
<input name="Team Member 4 Email" type="text" id="member4_email" value="" size="60" />
</p>
            <p>Team Member 5:
              <input name="Team Member 5" type="text" id="member5" value="(Full Name)" size="50" />
<br />
Email:
<input name="Team Member 5 Email" type="text" id="member5_email" value="" size="60" />
</p>
            <p>Team Member 6:
              <input name="Team Member 6" type="text" id="member6" value="(Full Name)" size="50" />
<br />
Email:
<input name="Team Member 6 Email" type="text" id="member6_email" value="" size="60" />
            </p>
            <p>
              <input type="submit" value="Submit Registration Form" name="Submit Registration Form" />
            </p>
          </form>
        </div>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>

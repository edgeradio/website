<?php include 'inc/common_start.php'; ?>
<body>
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
         <h1 class="greyheader">SUPPORTING YOUR EVENT</h1>
        <p>Being a not for profit community organisation, we know how hard it can be to make ends meet sometimes. So we like to give back to the community that we’re a part of and lend our support.</p>
        <p>Edge staff and volunteers have actively participated in, and supported, events including the RSPCA Cupcake Day, Lunch for Leaukemia, World’s Greatest Shave, and Clean Up Australia Day.</p>
        <p>Each year Edge Radio likes to support a number of events, primarily through on-air and new media promotions, and outside broadcasts.</p>
        <p>If you’d like us to sponsor your event, please fill in the following form, giving as much information as possible. Alternatively, email your proposal to <a href="mailto:manager@edgeradio.org.au">manager@edgeradio.org.au</a>, ensuring your proposal covers all the points in the form below.</p>
        <p>We require your proposal a minimum of 8 weeks before the event. We will contact you if your proposal is successful to arrange an agreement.</p>
        <hr size="1" />
        <p><strong>Application Form</strong>          </p>
        <form action="scripts/FormMail.pl" method="post" name="Event_Sponsorship_Application" id="Event_Sponsorship_Application" onSubmit="return validateForm(this)">
            <input type="hidden" value="manager@edgeradio.org.au" name="recipient" />
            <input type="hidden" value="http://www.edgeradio.org.au/community_events_response.php" name="redirect" />
            <input type="hidden" value="Event Sponsorship Application" name="subject" />
            <p>Your Full Name:<br />
              <b>
              <input name="Name" type="text" id="Comments10" value="" size="55" maxlength="55" />
            </b></p>
            <p>Your Email:
              <br />
              <input id="Name" maxlength="55" size="55" name="Email" />
            </p>
            <p>Your Phone Number:
              <br />
              <input id="Name14" maxlength="55" size="55" name="Phone" />
            </p>
            <p>Some information on you, your organization, or business:<strong><br />
              <textarea id="Comments9" name="Information" rows="5" cols="55"></textarea>
            </strong></p>
            <p>An overview of your event, including when it will take place and it’s frequency <br />
(
              ie once only, annually)<strong>:<br />
              <textarea id="Interests" name="Event_Overview" rows="5" cols="55"></textarea>
            </strong></p>
            <p>Some info on the attendees, audience or participants. <br />
              Detail how far our sponsorship will reach<strong>:<br />
              <textarea id="Interests2" name="Event_Attendees" rows="5" cols="55"></textarea>
            </strong></p>
            <p>What is the underlying aim of your event?<strong><br />
              <textarea id="Interests3" name="Event_Aim" rows="5" cols="55"></textarea>
            </strong></p>
            <p>How would you like us to sponsor it?<strong><br />
                <textarea id="Interests4" name="Sponsorship_Requested" rows="5" cols="55"></textarea>
            </strong></p>
            <p>What benefits will Edge Radio receive in return for our support?<br />
(ie signage, logo placement<strong>):<br />
                <textarea id="Interests5" name="Benefit_To_Edge" rows="5" cols="55"></textarea>
            </strong></p>
            <p>Please detail any other sponsors you have secured, including other media partners. <br />
            If you haven’t secured other sponsors yet, outline who you intend to approach<strong>:<br />
            <textarea id="Interests6" name="Other_Sponsors" rows="5" cols="55"></textarea>
            </strong></p>
            <p>
              <input type="submit" value="Submit Application Form" name="Submit Application Form" />
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

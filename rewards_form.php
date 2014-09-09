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
          <h1 class="greyheader">EDGE REWARDS APPLICATION FORM</h1>
          <p>Select your rewards from our <a href="rewards.php">edge rewards page</a>.</p>
          <hr size="1" />
          <form action="scripts/FormMail.pl" method="post" name="Edge_Rewards_Form" id="Edge_Rewards_Form" onSubmit="return validateForm(this)">
            <p>Your Full Name: <input type="text" name="Full_Name" size="31" /></p>
            <p>Contact Number (business Hours): <input type="text" name="phone_no" size="31" /> </p>
            <p>Email contact: <input type="text" name="email" size="31" /></p>
            <p><strong>To register as a competition winner please put the competition code here:</strong><br />
           <input type="text" name="competition_code" size="31" /></p>
            <p><strong><u>OR</u></strong></p>
            <p><strong>If redeeming rewards points or vouchers please put details here:</strong></p>          
            <p>Note: if applying for a complimentary CD put at least 4x preferred options from titles listed on the rewards page. This
              is to avoid disappointment if we are 'out' of specific titles<br />
              <textarea id="Comments0" name="Requested_Rewards" rows="6" cols="42">Artist Names and Album Titles Here.
If you're not requesting a CD please put the description of reward listed on the rewards page</textarea>
            </p>
            <p class="smalltext"><strong>Click the submit
              button below to get your picks to us!</strong></p>
              <input type="reset" value="Reset" name="Reset" />
              &nbsp;&nbsp;
              <input type="submit" value="Submit" name="submit_rewards_request_form" />
              </font></p>
            <input type="hidden" value="supporter@edgeradio.org.au" name="recipient" />
            <input type="hidden" value="http://www.edgeradio.org.au/rewards_form_response.php" name="redirect" />
            <input type="hidden" value="Edge Rewards Request Form" name="subject" />
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

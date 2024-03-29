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
 
<div class="rounded">
      <h1 class="title-head-right">COMMUNITY SERVICE ANNOUNCEMENTS        </h1>
         <p>Does your charitable or not for profit organization have an event or awareness campaign coming up that you'd like a Community Service Announcement for?</p>
         <p>Community Service Announcements provide an opportunity to create campaigns that: </p>
         <ul>
           <li>Promote community and charitable services</li>
           <li>Raise listener awareness of important community issues, specifically health and human services</li>
           <li>Promote upcoming fundraising events</li>
         </ul>
         <p>If you already have a Community Service Announcement produced and simply wish to request we schedule it, please email the audio, along with the relevant campaign information to <b>programs [at] edgeradio.org.au</b>.</p>
         <p>To be eligible, all CSA requests need to be submitted a minimum of 4 weeks in advance. </p>
         <p> Announcements must be apolitical, non-commercial, and should be relevant and of interest to the broad Tasmanian community. Scripts that do not meet these criteria will not be considered for production. Edge Radio reserves the right to modify submitted scripts to meet station policy and the community radio codes of practice.</p>
         <p><b>Please note: Due to the high number of CSA requests Edge Radio receives, and the station's limited resources, not all requests can be met.</b></p>
         <hr size="1" />
         <p><strong>Submission Form</strong></p>
          <form action="../../scripts/FormMail.pl" method="post" name="Community_Service_Announcement_Application" id="Community_Service_Announcement_Application" onSubmit="return validateForm(this)">
            <input type="hidden" value="programs@edgeradio.org.au" name="recipient" />
            <input type="hidden" value="http://www.edgeradio.org.au/community_sa_response.php" name="redirect" />
            <input type="hidden" value="Community Service Announcement Application" name="subject" />
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
            <p>Are you registered as a charitable organisation or incorporated body?<br />
              <label>
                <input type="checkbox" name="RegisteredOrg" id="RegisteredOrg" />
              Yes</label>
            </p>
            <p>What is the event or awareness campaign you wish to have a CSA for?<br />
              <strong>
              <textarea id="Interests" name="Description" rows="5" cols="55"></textarea>
            </strong></p>
            <p>If this is a ticketed event, are 100% of the proceeds going to charity?<br />
              <label>
                <input type="checkbox" name="OneHundredPercent_Charity" id="OneHundredPercent_Charity" />
                Yes</label>
            </p>
            <p>Is this event/campaign affiliated with a Government department (local, state, federal) in any way, and if so how?<br />
              <strong>
              <textarea id="Description" name="GovernmentAffiliated" rows="5" cols="55"></textarea>
            </strong></p>
            <p>Outline a short script for your Community Service Announcement <br />
              (no more than 70 words):<br />
              <strong>
              <textarea id="GovernmentAffiliated" name="ShortScript" rows="5" cols="55"></textarea>
            </strong></p>
            <p>When would you like your on-air campaign to begin?<br />
               From:<b>
              <select name="From_Date" size="1" id="From_Date">
                <option>Date</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
              </select>
              <select name="From_Month" size="1" id="From_Month">
                <option>Month</option>
                <option>Jan</option>
                <option>Feb</option>
                <option>Mar</option>
                <option>Apr</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>Aug</option>
                <option>Sept</option>
                <option>Oct</option>
                <option>Nov</option>
                <option>Dec</option>
              </select>
              <select name="From_Year" size="1" id="From_Year">
                <option selected="selected">Year</option>
                <option>2013</option>
                <option>2014</option>
                <option>2015</option>
              </select>
            </b></p>
            <p>When should the campaign cease? <br /> 
              Until: 
              <select name="To_Date" size="1" id="To_Date">
                <option>Date</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                <option>17</option>
                <option>18</option>
                <option>19</option>
                <option>20</option>
                <option>21</option>
                <option>22</option>
                <option>23</option>
                <option>24</option>
                <option>25</option>
                <option>26</option>
                <option>27</option>
                <option>28</option>
                <option>29</option>
                <option>30</option>
                <option>31</option>
              </select>
              <select name="To_Month" size="1" id="To_Month">
                <option>Month</option>
                <option>Jan</option>
                <option>Feb</option>
                <option>Mar</option>
                <option>Apr</option>
                <option>May</option>
                <option>June</option>
                <option>July</option>
                <option>Aug</option>
                <option>Sept</option>
                <option>Oct</option>
                <option>Nov</option>
                <option>Dec</option>
              </select>
              <select name="To_Year" size="1" id="To_Year">
                <option selected="selected">Year</option>
                <option>2013</option>
                <option>2014</option>
                <option>2015</option>
              </select>
            </p>
            <p>
              <input type="submit" value="Submit Application Form" name="Submit Application Form" />
            </p>
          </form>
      
       
      </div>
        
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

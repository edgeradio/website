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
         <h1 class="greyheader">WORK EXPERIENCE @ EDGE </h1>
        <p><strong>Get a sneak peak at our radio thingamies</strong></p>
        <p>Every year we get HEAPS of eager beavers requesting work experience placements at Edge. While we’re pretty stoked you want to come and play with us, due to a shortage of time and staffing resources we can only accept a tiny handful of students.</p>
        <p>We also like to coincide your placement with an event we’re doing, like a<em> School of Rock</em> live broadcast, so you get as much out of your time with us as possible.</p>
        <p>We ask that you fill out the form below giving us as much advance notice as you can. In radio, timing is everything.</p>
        <hr size="1" />
        <p><strong>Application Form</strong>          </p>
        <form action="scripts/FormMail.pl" method="post" name="Work_Experience_Application" id="Work_Experience_Application" onSubmit="return validateForm(this)">
            <input type="hidden" value="support@edgeradio.org.au" name="recipient" />
            <input type="hidden" value="http://www.edgeradio.org.au/community_workexp_response.php" name="redirect" />
            <input type="hidden" value="Work Experience Application" name="subject" />
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
            <p>Your School:<br />
              <input id="Name28" maxlength="55" size="55" name="School" />
            </p>
            <p>Your Teachers Full Name:<br />
              <input id="Name47" maxlength="55" size="55" name="Teacher" />
            </p>
            <p>Your Teachers Email:<br />
              <input id="Name31" maxlength="55" size="55" name="Teacher_Email" />
            </p>
            <p>Your Teachers Phone Number:<br />
              <input id="Name2" maxlength="55" size="55" name="Teacher_Phone" />
            </p>
            <p>What grade are you in? <b>
              <select name="Grade" size="1" id="Grade">
                <option>Grade</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
            </b></p>
            <p>What dates are you requesting for your placement?<br />
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
                <option>2009</option>
                <option>2010</option>
                <option>2011</option>
                <option>2012</option>
              </select>
              </b><br /> 
              To: 
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
                <option>2009</option>
                <option>2010</option>
                <option>2011</option>
                <option>2012</option>
              </select>
            </p>
            <p>What interests you about radio?<strong><br />
              <textarea id="Comments9" name="Interests" rows="5" cols="55"></textarea>
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

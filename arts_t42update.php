<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
     <?php include 'inc/box_contact.php'; ?>
    </div>
    <div id="right_column">
        <?php include 'inc/box_flickr.php'; ?>
    </div>
    <div id="three_column">
      <div class="rounded">
        <h1 class="greyheader">THE T42 ARTS UPDATE</h1>
        <div class="text">
         <p><img src="images/T42_logo.jpg" width="100" height="100" alt="T42" align="right"/>The T42 Arts Update provides accessible information on local art exhibitions, openings, and gallery events in Hobart through an on air sponsorship announcement broadcast on Edge Radio 99.3fm. </p>
          <p>This promotional mechanism is supported financially by T42, who purchase the on air announcements as part of an Edge Radio sponsorship package.&nbsp; This is a fantastic service for Tasmania’s arts community, supporting and promoting local and international artistic excellence at no financial cost to the arts community. </p>
          <p><span class="text_red"><strong>PLEASE NOTE:</strong></span><strong>&nbsp; Listings are only eligible if the exhibition entry is <em>free of charge</em>. For enquiries on promoting ticketed or entry fee events email <a href="mailto:sponsor@edgeradio.org.au">sponsor@edgeradio.org.au</a></strong></p>
          <p>To be eligible please complete the form below a minimum of three weeks prior to the event date.</p>
          <hr />
          <p> </p>
          <form action="scripts/FormMail.pl" method="post" name="Arts_Update_Form" id="Arts_Update_Form" onSubmit="return validateForm(this)">
            <input type="hidden" value="artsupdate@edgeradio.org.au" name="recipient" />
            <input type="hidden" value="http://www.edgeradio.org.au/arts_t42update_response.php" name="redirect" />
            <input type="hidden" value="Arts Update Form" name="subject" />
            <p><b>EVENT
              DETAILS</b></p>
            <p>Exhibition
              Title:<br />
              <b>
              <input name="Exhibition_Title" type="text" id="Comments10" value="" size="60" />
              </b></p>
            <p>Artist(s):<br />
              <b>
              <textarea id="Comments11" name="Artist" rows="2" cols="55"></textarea>
              </b></p>
            <p>Up
              to 25 word description of work to be exhibited including media/themes
              etc.:<br />
              <b>
              <textarea id="Comments8" name="Description" rows="2" cols="55"></textarea>
              </b></p>
            <p><b>WHEN</b></p>
            <p>Opening
              Day<b>
              <select name="Opening_Day" size="1" id="Opening_Day">
                <option selected="selected">Day</option>
                <option>Mon</option>
                <option>Tue</option>
                <option>Wed</option>
                <option>Thur</option>
                <option>Fri</option>
                <option>Sat</option>
                <option>Sun</option>
              </select>
              <select name="Opening_Date" size="1" id="Opening_Date">
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
              <select name="Opening_Month" size="1" id="Opening_Month">
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
              <select name="Opening_Year" size="1" id="Opening_Year">
                <option selected="selected">Year</option>
                <option>2009</option>
                <option>2010</option>
                <option>2011</option>
                <option>2012</option>
              </select>
              </b><br />
              Closing
              Day&nbsp;
              <select name="Closing_Day" size="1" id="Closing_Day">
                <option selected="selected">Day</option>
                <option>Mon</option>
                <option>Tue</option>
                <option>Wed</option>
                <option>Thur</option>
                <option>Fri</option>
                <option>Sat</option>
                <option>Sun</option>
              </select>
              <select name="Closing_Date" size="1" id="Closing_Date">
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
              <select name="Closing_Month" size="1" id="Closing_Month">
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
              <select name="Closing_Year" size="1" id="Closing_Year">
                <option selected="selected">Year</option>
                <option>2009</option>
                <option>2010</option>
                <option>2011</option>
                <option>2012</option>
              </select>
            </p>
            <p>Opening
              Hours &amp; Days (if applicable):<br />
              <b>
              <input id="Name46" maxlength="30" size="60" name="Opening_Hours" />
              </b></p>
            <p><b>WHERE</b></p>
            <p>Gallery
              name:<br />
              <input id="Name32" maxlength="30" size="60" name="Gallery_Name" />
            </p>
            <p>Address:<b><br />
              </b>
              <textarea name="Gallery_Address" cols="55" rows="2" id="Name37"></textarea>
              <br />
            </p>
            <p>Disability
              Access?<b>
              <input type="checkbox" name="Disability_Access" value="ON" />
              </b></p>
            <p><b>CONTACT
              DETAILS</b></p>
            <p>Surname:
              <input id="Name14" maxlength="30" size="39" name="Surname" />
            </p>
            <p>First
              Name:
              <input id="Name28" maxlength="30" size="39" name="FirstName" />
            </p>
            <p>Phone
              (business hours):
              <input id="Name47" maxlength="30" size="39" name="Phone" />
            </p>
            <p>Email:&nbsp;
              <input id="Name31" maxlength="30" size="55" name="Email" />
            </p>
            <p>Suburb:
              <input id="Name35" maxlength="30" size="30" name="Suburb" />
            </p>
            <p><b>Declaration
              (must be ticked to be eligible for listing)<br />
              </b>Entry
              to this event is free of charge<b>
              <input type="checkbox" name="ENTRY TO THIS EVENT IS FREE OF CHARGE" value="ON" />
              </b></p>
            <p><strong>Where
              did you hear about the Edge Radio T42 arts update service?<br />
              <textarea id="Comments9" name="Wheredidyouhearaboutupdate" rows="3" cols="55"></textarea>
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

<?php include 'inc/common_start.php'; ?>
<body>
<?php include 'inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="one_column">
      <div class="rounded">
        <h1 class="greyheader">ONLINE PROGRAM APPLICATION FORM</h1>
        <div class="text">
          <p>This online form is for existing programs who want to re apply for the next schedule with <u>exactly the same program format you applied for in the last schedule</u>.</p>
          <p>If you want to change your format, program aims or objectives you need to fill out the paper application linked <a href="apply.php">here</a>.</p>
          <p>If you have more than 3 presenters you must submit multiple online forms with contact details for all presenters involved.</p>
          <p class="text_red">Don't forget to click <strong>submit</strong> button when you've finished with this form!</p>
          <p><a href="##Instructions">CLICK HERE FOR MORE INSTRUCTIONS</a><br />
            <br />
          </p>
          <hr />
          <p><br />
            <strong><a name="#Form">To complete this form you have to have presented a show with us before.</a></strong> </p>
          <form name="Program_application_Form" onSubmit="return validateForm(this)" action="http://www.utas.edu.au/cgi-bin/FormMail.pl" method="post">
           <input type="hidden" value="Program Application Form" name="subject">
            <input type="hidden" value="manager@edgeradio.org.au" name="recipient">
            <input type="hidden" value="http://www.edgeradio.org.au/application_response.php" name="redirect">
            <p> Are you going to be presenting your show in the same format as last time? Yes
              <input type="radio" name="Yes" value="V1">
              No
              <input type="radio" name="No" value="V2">
            </p>
            <p style="color:#F00; font-weight:bold">All Fields are below are compulsory</p>
            <p class="text"><strong><u>Section A</u></strong></p>
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="148" height="30">Name of Show:</td>
                <td width="352" height="30"><input id="Name39" maxlength="30" size="47" name="Name_of_show1"></td>
              </tr>
              <tr>
                <td height="30">Curent Timeslot:</td>
                <td height="30"><input id="Name47" maxlength="30" size="47" name="Current_timeslot"></td>
              </tr>
              <tr>
                <td height="30">Name of Contact 1:</td>
                <td height="30"><input id="Name17" maxlength="30" size="50" name="Name1"></td>
              </tr>
              <tr>
                <td height="30">Phone of Contact
                  1:</td>
                <td height="30"><input id="Name18" maxlength="30" size="29" name="Phone1"></td>
              </tr>
              <tr>
                <td height="30">Email of Contact 1:</td>
                <td height="30"><input id="Name19" size="42" name="Email1"></td>
              </tr>
              <tr>
                <td height="30">Address of Contact1:</td>
                <td height="30"><textarea name="Address1" cols="35" rows="2" id="Address1"></textarea></td>
              </tr>
            </table>
            <p><strong>Additional
              Presenters: </strong>
            <p>All applicants must be registered. Maximum of three
              presenters On-Air at any time.</p>
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="148" height="30">Name of Contact 2:</td>
                <td width="352" height="30"><input id="Name35" maxlength="30" size="44" name="Name2"></td>
              </tr>
              <tr>
                <td height="30">Phone 2:</td>
                <td height="30"><input id="Name36" maxlength="30" size="27" name="Phone2"></td>
              </tr>
              <tr>
                <td height="30">Email 2:</td>
                <td height="30"><input id="Name37" maxlength="30" size="43" name="Email2"></td>
              </tr>
              <tr>
                <td height="30">Address 2: </td>
                <td height="30"><textarea name="Address2" cols="35" rows="2" id="Address2"></textarea></td>
              </tr>
            </table>
            <br>
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="148" height="30">Name of Contact
                  3:</td>
                <td width="352" height="30"><input id="Name44" maxlength="30" size="40" name="Name3"></td>
              </tr>
              <tr>
                <td height="30">Phone
                  3: </td>
                <td height="30"><input id="Name45" maxlength="30" size="25" name="Phone3"></td>
              </tr>
              <tr>
                <td height="30">Email
                  3:</td>
                <td height="30"><input id="Name46" maxlength="30" size="42" name="Email3"></td>
              </tr>
              <tr>
                <td height="30">Address
                  3:</td>
                <td height="30"><textarea name="Address3" cols="35" rows="2" id="Address3"></textarea></td>
              </tr>
            </table>
            <p><u><strong>Section
              B</strong></u></p>
            <p><strong>The following is for security access and
              station administration:</strong></p>
            <p>Are
              you a:</p>
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="30">K-12
                  Student?</td>
                <td height="30"><input type="checkbox" name="School_Student" value="ON">
                  Which School?</td>
                <td height="30"><input id="Name40" maxlength="30" size="35" name="Which_School1"></td>
              </tr>
              <tr>
                <td height="30">TAFE Student?</td>
                <td height="30"><input type="checkbox" name="TAFE_Student" value="ON">
                  Which Campus?</td>
                <td height="30"><input id="Name22" maxlength="30" size="35" name="Which_Campus1"></td>
              </tr>
              <tr>
                <td height="30">University Student?</td>
                <td height="30"><input type="checkbox" name="University_Student" value="ON">
                  Student ID:&nbsp;</td>
                <td height="30"><input id="Name23" maxlength="30" size="17" name="Student_ID1"></td>
              </tr>
              <tr>
                <td height="30">Other?</td>
                <td height="30"><input name="Other" type="checkbox" id="Other" value="ON">
                  Please Specify:</td>
                <td height="30"><input id="Name41" maxlength="30" size="35" name="Other_Specify"></td>
              </tr>
            </table>
            <p><strong>All
              Edgers need a proxy to access the studio and building. Please provide
              your:</strong></p>
            <p>Drivers license
              number,proof of age card number or University ID:
              <input id="Name26" maxLength="30" size="31" name="ID_for_Proxy_card">
            </p>
            <br>
            What is Your Current Proxy
            Card Number&nbsp;(if you have&nbsp; a card, the number It is written in small text on
            the corner of the card):
            </p>
            <input id="Name48" maxLength="30" size="31" name="Current_Proxy_Card_Number">
            </p>
            </p>
            <p>Please
              note any days or times that you are <strong>not available </strong>to do a show:</p>
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="91" height="30">Monday:</td>
                <td width="409" height="30"><input name="Cant_Monday" type="checkbox" id="Cant_Monday" value="ON">
                  Time:
                <input id="Name28" maxLength="30" size="6" name="Time_Mon"></td>
              </tr>
              <tr>
                <td height="30">Tuesday:</td>
                <td height="30"><input name="Cant_Tuesday" type="checkbox" id="Cant_Tuesday" value="ON">
                  Time:
                <input id="Name29" maxLength="30" size="6" name="Time_Tues"></td>
              </tr>
              <tr>
                <td height="30">Wednesday:</td>
                <td height="30"><input name="Cant_Wednesday" type="checkbox" id="Cant_Wednesday" value="ON">
                  Time:
                <input id="Name30" maxLength="30" size="6" name="Time_Wed"></td>
              </tr>
              <tr>
                <td height="30">Thursday: </td>
                <td height="30"><input name="Cant_Thursday" type="checkbox" id="Cant_Thursday" value="ON">
                  Time:
                <input id="Name31" maxLength="30" size="6" name="Time_Thurs"></td>
              </tr>
              <tr>
                <td height="30">Friday: </td>
                <td height="30"><input name="Cant_Friday" type="checkbox" id="Cant_Friday" value="ON">
                  Time:
                <input id="Name32" maxLength="30" size="6" name="Time_Fri"></td>
              </tr>
              <tr>
                <td height="30">Saturday: </td>
                <td height="30"><input name="Cant_Saturday" type="checkbox" id="Cant_Saturday" value="ON">
                  Time:
                <input id="Name33" maxLength="30" size="6" name="Time_Sat"></td>
              </tr>
              <tr>
                <td height="30">Sunday:</td>
                <td height="30"><input name="Cant_Sunday" type="checkbox" id="Cant_Sunday" value="ON">
                  Time:
                <input id="Name34" maxLength="30" size="6" name="Time_Sun"></td>
              </tr>
            </table>
            <p><strong><u>Section C</u></strong></p>
            <p><strong>The
              Following is to promote, support and enhance your program:</strong> </p>
            <p>Please
              provide a description of your program in 20 words or less. If your
              application is successful this description will be used on the web site
              and schedule posters.<br>
              <textarea rows="1" name="twenty_word_description" cols="58"></textarea>
            </p>
            <p>Please
              provide a short 5 word summary of your new program. If your application is
              successful this summary will be used on the new schedule posters. <br>
              <textarea rows="1" name="five_word_summary" cols="54"></textarea>
            </p>
            <p>What
              can the Edge team do to help you advance your show in the next period? <br>
              <textarea rows="2" name="How_can_staff_help_in_next_schedule" cols="57"></textarea>
            </p>
            <p>What
              improvements would you like to make to your show in the next schedule? <br>
              <textarea rows="2" name="How_will_you_improve_your_show" cols="57"></textarea>
            </p>
            <p>What
              extra skills would you like to get to improve your program? (eg voice
              technique training, program preparation, interview training...anything
              that will help you take your program to 'the next level'). <br>
              <textarea rows="2" name="I_Want_to_learn" cols="57"></textarea>
            </p>
            <p align="left" style="line-height: 100%; margin-bottom: -7"><strong>Section
              D</strong> </p>
            <p align="left" style="line-height: 100%; margin-bottom: -7"><strong>The
              following to is assess skills you have or may want to aquire to assist
              your station?</strong></p>
            <p align="left" style="line-height: 100%; margin-bottom: -7">Yes
              <input type="checkbox" name="I have skills in the following areas" value="ON">
              (Please
              tick)</p>
            <p align="left" style="line-height: 100%; margin-bottom: -7">Please
              specify...</p>
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="169">Web Development</td>
                <td width="331"><input type="checkbox" name="Web_Development_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Graphic Design</td>
                <td><input type="checkbox" name="Graphic_Design_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Accounting</td>
                <td><input type="checkbox" name="Accounting_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Human Resources</td>
                <td><input type="checkbox" name="Human_Resources_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Promotions/Marketing</td>
                <td><input type="checkbox" name="promotions_marketing_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Journalism</td>
                <td><input type="checkbox" name="Journalism_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>IT</td>
                <td><input type="checkbox" name="IT_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Administration</td>
                <td><input type="checkbox" name="Administration_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Audio Production</td>
                <td><input type="checkbox" name="Audio_production_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Live Sound Engineering</td>
                <td><input type="checkbox" name="Live_Sound_Skills" value="ON"></td>
              </tr>
              <tr>
                <td>Other-please specify</td>
                <td><input id="Other_skills" maxlength="30" size="35" name="other_skills"></td>
              </tr>
            </table>
            <p>How
              could you use your skills to assist Edge?</p>
            <p>
              <textarea rows="2" name="Skill_you_have_to_help_edge" cols="57"></textarea>
            </p>
            <p><strong>Would you
              like to learn any of the following skills?</strong></p>
            <p>Yes
              <input type="checkbox" name="I_want_skills_in" value="ON">
              (Please
              tick)</p>
            <p>Please
              specify...</p>
            <table width="500" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="169">Web Development</td>
                <td width="331"><input type="checkbox" name="Web_development" value="ON"></td>
              </tr>
              <tr>
                <td>Graphic Design</td>
                <td><input type="checkbox" name="Graphic_design_want" value="ON"></td>
              </tr>
              <tr>
                <td>Accounting</td>
                <td><input type="checkbox" name="Accounting_want" value="ON"></td>
              </tr>
              <tr>
                <td>Human Resources</td>
                <td><input type="checkbox" name="Human_resources_want" value="ON"></td>
              </tr>
              <tr>
                <td>Promotions/Marketing</td>
                <td><input type="checkbox" name="Promotions_marketing_want" value="ON"></td>
              </tr>
              <tr>
                <td>Journalism</td>
                <td><input type="checkbox" name="Journalism_want" value="ON"></td>
              </tr>
              <tr>
                <td>IT</td>
                <td><input type="checkbox" name="IT_want" value="ON"></td>
              </tr>
              <tr>
                <td>Administration</td>
                <td><input type="checkbox" name="Administration_want" value="ON"></td>
              </tr>
              <tr>
                <td>Audio Production</td>
                <td><input type="checkbox" name="Audio_production_want" value="ON"></td>
              </tr>
              <tr>
                <td>Live Sound Engineering</td>
                <td><input type="checkbox" name="Live_sound_want" value="ON"></td>
              </tr>
              <tr>
                <td>Other-please specify</td>
                <td><input id="Other_want" maxlength="30" size="35" name="Other_want"></td>
              </tr>
            </table>
            <p>
              <input type="submit" value="submit application form" name="submit application form">
            </p>
          </form>
       </div>
      </div>
      <br />
      <div class="rounded">
        <h1 class="greyheader"><a name="#Instructions">EDGE RADIO 99.3fm / TASMANIAN YOUTH BROADCASTERS INC. - PROGRAM APPLICATION FORM INSTRUCTIONS</a> </h1>
        <p><strong>WHAT IS EDGE RADIO?</strong></p>
        <p>Edge Radio is a newly licensed Community radio station based in
          Hobart. As Hobart’s only youth orientated radio station, Edge
          Radio provides an alternative to mainstream stations. This is
          achieved with a mix of youth focused music, entertainment, local
          journalistic content and other information relevant to youth. Our
          target audience is aged 15-30, although Edge is a station 'For Youth
          Of All Ages'.</p>
        <p><strong>EDGE RADIO AIMS TO PROVIDE A VIBRANT YOUTH FOCUSED RADIO STATION
          THAT:</strong></p>
        <ul>
          <li>Enlivens the culture and social
            climate of Tasmania</li>
          <li>Is responsive to the needs of its
            audiences</li>
          <li>Provides programming determined by
            youth, for youth</li>
          <li>Is high quality</li>
          <li> Is artistically diverse</li>
          <li>Is broadly inclusive</li>
          <li>Has informative and educational
            programming</li>
          <li>Provides a forum to discuss current
            issues</li>
        </ul>
        <p><strong>STATEMENT OF OBJECTIVES:</strong></p>
        <ul>
          <li>To present original, rich and diverse programming of music and
            other forms of expression free from the direct constraints of
            commercial interests.</li>
          <li>To provide the target audience with a significant alternative to
            other broadcast media within the station’s service area.</li>
          <li>To provide a diversity of music and music genres underrepresented
            in mainstream media</li>
          <li>To provide informative educational and public affairs programming</li>
          <li>To inform on issues and events of interest to the target audience</li>
        </ul>
        <p><strong>OK I GET IT NOW AND I NEED TO FILL OUT THE FORM...<a href="##Form">TAKE ME THERE!</a></strong></p>
        </form>
      </div>
      <div id="footer">
        <?php include 'inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include 'inc/common_end.php'; ?>

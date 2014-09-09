<?php 
if(!$_POST['subscription']) {
header('Location: http://www.edgeradio.org.au/supporter/signup/');
}
?>
<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	 <ul class="border-light">
	 <li style="color: #C0C0C0;">1. Packages</li>
	 <li>2. Details</li>
	 <li style="color: #C0C0C0;">3. Payment</li>
	 <li style="color: #C0C0C0;">4. Confirmation</li>
	 </ul>
	 </div>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
<form  onSubmit="return checkForm(this);" name="form" action="http://www.edgeradio.org.au/supporter/signup/payment.php" method="post">
<div class="rounded">
        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Your Details</div>
		
		<style>
fieldset {
  padding: 1em;
  border: 0px;
  font: 12px sans-serif;
  }
label {
  float:left;
  padding: 5px; 
  width:150px;
  margin-right:10px;
  padding-top:5px;
  text-align:right;
  font-weight:bold;
  }
</style>
		
		<fieldset>

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Your awesomely cool username, used to log in to the Edge Supporter Sections!</div>
<label for="soapbox">Edge Username</label>
<input type="text" name="username" size="25" id="soapbox" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Don't worry, we wont share this with anyone.</div>
<label for="password">Edge Password</label>
<input type="password" name="password" size="25" id="password" value="" />
<br /><br />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Your First Name. You have one don't you?</div>
<label for="fname">First Name</label>
<input type="text" name="fname" size="25" id="fname" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Your Last Name. That word after your first name.</div>
<label for="lname">Last Name</label>
<input type="text" name="lname" size="25" id="lname" value="" />
<br /><br />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Your House/Apartment/Lair Number and Street.</div>
<label for="address">Address</label>
<input type="text" name="address" size="35" id="address" value="" /><br>
<input type="text" name="address2" size="35" id="address" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What suburb is your House/Apartment/Lair located in?</div>
<label for="suburb">Suburb</label>
<input type="text" name="suburb" size="25" id="suburb" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Type in those four numbers of awesomeness!</div>
<label for="pcode">Postcode</label>
<input type="text" name="pcode" size="4" id="pcode" value="" />
<br /><br />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">yourawesomeemail@tehinternetz.com</div>
<label for="email">Email Address</label>
<input type="text" name="email" size="25" id="pemail" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Does anyone even have a home phone anymore? Prove us wrong!</div>
<label for="phno">Phone Number</label>
<input type="text" name="phno" size="25" id="phno" value="" />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">What ringtone do you have? Ours is the X-Files!</div>
<label for="mono">Mobile Number</label>
<input type="text" name="mono" size="25" id="mono" value="" />
<br /><br />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">We have a gnarly newsletter that gets sent out every so often, would you like it to be delieved to you via email? </div>
<label for="subscribe">Recieve Newsletter?</label>
<select name="subscribe" id="subscribe">
    <option value="Y" label="Yes">Yes</option>
    <option value="N" label="No">No</option>
</select>
<br /><br />
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Happy birthday to youuuu...</div>
<label for="birthdate">Birthdate</label>
<select name="birthdateday" id="birthdateday">
    <option value="0" label="-">-</option>
    <option value="1" label="1">1</option>
    <option value="2" label="2">2</option>
    <option value="3" label="3">3</option>
    <option value="4" label="4">4</option>
    <option value="5" label="5">5</option>
    <option value="6" label="6">6</option>
    <option value="7" label="7">7</option>
    <option value="8" label="8">8</option>
    <option value="9" label="9">9</option>
    <option value="10" label="10">10</option>
    <option value="11" label="11">11</option>
    <option value="12" label="12">12</option>
    <option value="13" label="13">13</option>
    <option value="14" label="14">14</option>
    <option value="15" label="15">15</option>
    <option value="16" label="16">16</option>
    <option value="17" label="17">17</option>
    <option value="18" label="18">18</option>
    <option value="19" label="19">19</option>
    <option value="20" label="20">20</option>
    <option value="21" label="21">21</option>
    <option value="22" label="22">22</option>
    <option value="23" label="23">23</option>
    <option value="24" label="24">24</option>
    <option value="25" label="25">25</option>
    <option value="26" label="26">26</option>
    <option value="27" label="27">27</option>
    <option value="28" label="28">28</option>
    <option value="29" label="29">29</option>
    <option value="30" label="30">30</option>
    <option value="31" label="31">31</option>
</select><select name="birthdatemonth" id="birthdatemonth">
    <option value="0" label="-">-</option>
    <option value="1" label="January">January</option>
    <option value="2" label="February">February</option>
    <option value="3" label="March">March</option>
    <option value="4" label="April">April</option>
    <option value="5" label="May">May</option>
    <option value="6" label="June">June</option>
    <option value="7" label="July">July</option>
    <option value="8" label="August">August</option>
    <option value="9" label="September">September</option>
    <option value="10" label="October">October</option>
    <option value="11" label="November">November</option>
    <option value="12" label="December">December</option>
</select><select name="birthdateyear" id="birthdateyear">
    <option value="0" label="-">-</option>
    <option value="2012" label="2012">2012</option>
    <option value="2011" label="2011">2011</option>
    <option value="2010" label="2010">2010</option>
    <option value="2009" label="2009">2009</option>
    <option value="2008" label="2008">2008</option>
    <option value="2007" label="2007">2007</option>
    <option value="2006" label="2006">2006</option>
    <option value="2005" label="2005">2005</option>
    <option value="2004" label="2004">2004</option>
    <option value="2003" label="2003">2003</option>
    <option value="2002" label="2002">2002</option>
    <option value="2001" label="2001">2001</option>
    <option value="2000" label="2000">2000</option>
    <option value="1999" label="1999">1999</option>
    <option value="1998" label="1998">1998</option>
    <option value="1997" label="1997">1997</option>
    <option value="1996" label="1996">1996</option>
    <option value="1995" label="1995">1995</option>
    <option value="1994" label="1994">1994</option>
    <option value="1993" label="1993">1993</option>
    <option value="1992" label="1992">1992</option>
    <option value="1991" label="1991">1991</option>
    <option value="1990" label="1990">1990</option>
    <option value="1989" label="1989">1989</option>
    <option value="1988" label="1988">1988</option>
    <option value="1987" label="1987">1987</option>
    <option value="1986" label="1986">1986</option>
    <option value="1985" label="1985">1985</option>
    <option value="1984" label="1984">1984</option>
    <option value="1983" label="1983">1983</option>
    <option value="1982" label="1982">1982</option>
    <option value="1981" label="1981">1981</option>
    <option value="1980" label="1980">1980</option>
    <option value="1979" label="1979">1979</option>
    <option value="1978" label="1978">1978</option>
    <option value="1977" label="1977">1977</option>
    <option value="1976" label="1976">1976</option>
    <option value="1975" label="1975">1975</option>
    <option value="1974" label="1974">1974</option>
    <option value="1973" label="1973">1973</option>
    <option value="1972" label="1972">1972</option>
    <option value="1971" label="1971">1971</option>
    <option value="1970" label="1970">1970</option>
    <option value="1969" label="1969">1969</option>
    <option value="1968" label="1968">1968</option>
    <option value="1967" label="1967">1967</option>
    <option value="1966" label="1966">1966</option>
    <option value="1965" label="1965">1965</option>
    <option value="1964" label="1964">1964</option>
    <option value="1963" label="1963">1963</option>
    <option value="1962" label="1962">1962</option>
    <option value="1961" label="1961">1961</option>
    <option value="1960" label="1960">1960</option>
    <option value="1959" label="1959">1959</option>
    <option value="1958" label="1958">1958</option>
    <option value="1957" label="1957">1957</option>
    <option value="1956" label="1956">1956</option>
    <option value="1955" label="1955">1955</option>
    <option value="1954" label="1954">1954</option>
    <option value="1953" label="1953">1953</option>
    <option value="1952" label="1952">1952</option>
    <option value="1951" label="1951">1951</option>
    <option value="1950" label="1950">1950</option>
    <option value="1949" label="1949">1949</option>
    <option value="1948" label="1948">1948</option>
    <option value="1947" label="1947">1947</option>
    <option value="1946" label="1946">1946</option>
    <option value="1945" label="1945">1945</option>
    <option value="1944" label="1944">1944</option>
    <option value="1943" label="1943">1943</option>
    <option value="1942" label="1942">1942</option>
    <option value="1941" label="1941">1941</option>
    <option value="1940" label="1940">1940</option>
    <option value="1939" label="1939">1939</option>
    <option value="1938" label="1938">1938</option>
    <option value="1937" label="1937">1937</option>
    <option value="1936" label="1936">1936</option>
    <option value="1935" label="1935">1935</option>
    <option value="1934" label="1934">1934</option>
    <option value="1933" label="1933">1933</option>
    <option value="1932" label="1932">1932</option>
    <option value="1931" label="1931">1931</option>
    <option value="1930" label="1930">1930</option>
    <option value="1929" label="1929">1929</option>
    <option value="1928" label="1928">1928</option>
    <option value="1927" label="1927">1927</option>
    <option value="1926" label="1926">1926</option>
    <option value="1925" label="1925">1925</option>
    <option value="1924" label="1924">1924</option>
    <option value="1923" label="1923">1923</option>
    <option value="1922" label="1922">1922</option>
    <option value="1921" label="1921">1921</option>
    <option value="1920" label="1920">1920</option>
    <option value="1919" label="1919">1919</option>
    <option value="1918" label="1918">1918</option>
    <option value="1917" label="1917">1917</option>
    <option value="1916" label="1916">1916</option>
    <option value="1915" label="1915">1915</option>
    <option value="1914" label="1914">1914</option>
    <option value="1913" label="1913">1913</option>
    <option value="1912" label="1912">1912</option>
    <option value="1911" label="1911">1911</option>
    <option value="1910" label="1910">1910</option>
    <option value="1909" label="1909">1909</option>
    <option value="1908" label="1908">1908</option>
    <option value="1907" label="1907">1907</option>
    <option value="1906" label="1906">1906</option>
    <option value="1905" label="1905">1905</option>
    <option value="1904" label="1904">1904</option>
    <option value="1903" label="1903">1903</option>
    <option value="1902" label="1902">1902</option>
    <option value="1901" label="1901">1901</option>
    <option value="1900" label="1900">1900</option>
</select>
<br /><br />

<div style="float: right; width: 200px; font-size: 10px; color: #333333;">Male or Female?</div>
<label for="sex">Sex</label>
<select name="sex" id="sex">
    <option value="M" label="Male">Male</option>
    <option value="F" label="Female">Female</option>
</select>
<br /><br />

		</fieldset>
		
</div>
        <br />
        
        <SCRIPT LANGUAGE="JavaScript">
function checkForm(form)
  {
var themessage = "You are required to complete the following fields: ";
if (document.form.username.value=="") {
themessage = themessage + " - First Name";
}
if (document.form.password.value=="") {
themessage = themessage + " -  Last Name";
}
if (document.form.fname.value=="") {
themessage = themessage + " -  First Name";
}
if (document.form.lname.value=="") {
themessage = themessage + " -  Last Name";
}
if (document.form.address.value=="") {
themessage = themessage + " -  Address";
}
if (document.form.suburb.value=="") {
themessage = themessage + " -  Suburb";
}
if (document.form.pcode.value=="") {
themessage = themessage + " -  Postcode";
}
if (document.form.email.value=="") {
themessage = themessage + " -  E-mail";
}
//alert if fields are empty and cancel form submit
if (themessage == "You are required to complete the following fields: ") {
} else {
alert(themessage);
return false;
   }
}
</script>
       
       <input style="height: 100px; width: 100%; border: 0px; font-size: 48px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: 'bebas', arial, serif;" value="Continue >>" name="submit" type="submit" />
       <input type="hidden" name="subscription" value="<?php echo $_POST['subscription']; ?>" />
        </form>
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

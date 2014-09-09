<?php include "base.php"; 
mysql_select_db('edge_users'); 
?>
<?php include '../../inc/common_start.php'; ?>
<body>
<?php include '../../inc/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="http://www.edgeradio.org.au/images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    <div id="left_column">
          </div>
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
	 ?>
	 
<div id="left_column">
<div class="rounded">
<h1 class="greyheader">DATE & TIME</h1>
<p>
<span id=tick2></span>

<script>
<!--
function show2(){
if (!document.all&&!document.getElementById)
return
thelement=document.getElementById? document.getElementById("tick2"): document.all.tick2
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="PM"
if (hours<12)
dn="AM"
if (hours>12)
hours=hours-12
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
var ctime=hours+":"+minutes+":"+seconds+" "+dn
thelement.innerHTML="<center><span style='font-size: 28px; font-weight: bold;'>"+ctime+"</span></center>"
setTimeout("show2()",1000)
}
window.onload=show2
//-->
</script>
</p>
<p><center><span style='font-size: 18px; font-weight: bold;'><?php print date("F d, Y", time())?></span></center></p>
<br>
</div>
<br>
<div class="rounded">
<h1 class="greyheader">USEFUL LINKS</h1>
<ul class="admin-light">
<li><a target="_blank" href="http://www.google.com.au">Google</a></li>
<li><a target="_blank" href="http://www.news.com.au">News.com.au</a></li>
<li><a target="_blank" href="http://news.google.com.au">Google News</a></li>
<li><a target="_blank" href="http://www.thedwarf.com.au">The Dwarf</a></li>
<li><a target="_blank" href="http://www.fasterlouder.com.au">Fasterlouder</a></li>
</ul>

</div>
</div>
<div id="right_column">
<?php include '../../inc/box_nowon_new.php'; ?>
<br />
<?php include '../../inc/box_rightbanner_new.php'; ?>
</div>
	 
    <div id="three_column">
     <div class="rounded">
    <h1 class="greyheader">ON AIR PANEL</h1>
  	<p>Thanks for logging in, <b><?=$_SESSION['Username']?></b>!</p>
  	<p>Welcome to this little concept on air panel, im not sure what to put on this page so yeah...</p>
    <p>Any questions/problems/suggestions, please email jdavey@broadcastingworld.net.</p>
    </div>
    <br>
    <div class="rounded">
    <h1 class="greyheader">NOTES</h1>
    <textarea style="border: 0px; width: 100%; height: 300px; font: 18px Arial; font-weight: bold;">Add your own notes here!</textarea>
    <?php

}
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
	 $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
    
	 $checklogin = mysql_query("SELECT * FROM users WHERE Username = '".$username."' AND Password = '".$password."'");
    
    if(mysql_num_rows($checklogin) == 1)
    {
    	 $row = mysql_fetch_array($checklogin);
        $email = $row['EmailAddress'];
        $type = $row['Type'];
         $uid = $row['UserID'];
         $fv = $row['firstvisit'];
        
        $_SESSION['Username'] = $username;
        $_SESSION['Type'] = $type;
        $_SESSION['EmailAddress'] = $email;
        $_SESSION['LoggedIn'] = 1;
        $_SESSION['UserID'] = $uid;
        $_SESSION['fv'] = $fv;
        
    	 echo "
		 <div id=\"one_column\">
     <div class=\"rounded\">
		 <h1 class=\"greyheader\">SUCCESS</h1>";
        echo "<p>We are now redirecting you to the on air panel.</p>";
       echo "<script type=\"text/javascript\">
<!--
window.location = \"index.php\"
//-->
</script>";
    }
    else
    {
    	 echo "<h1 class=\"greyheader\">ERROR</h1>";
        echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
    }
}
else
{
	?>
    <div id="one_column">
     <div class="rounded">
   <h1 class="greyheader">ON AIR PANEL</h1>
    
   <p>Access denied. You need to login below to access this page.</p>
   
   <p>NOTE: Presenters, please use your login details from the admin panel to log in here.</p>
    
	<form method="post" action="index.php" name="loginform" id="loginform">
	<table style="width: 300px; margin-left: auto; margin-right: auto;" border="0" cellpadding="5">
<tr>
	<td style="width: 100px; text-align: right;">Username </td>
	<td><input type="text" style="border:solid 1px #990000;" name="username" id="username" /></td>
</tr>
<tr>
	<td style="width: 100px; text-align: right;">Password </td>
	<td><input type="password" style="border:solid 1px #990000;" name="password" id="password" /></td>
</tr>
<tr>
	<td style="width: 100px;"></td>
	<td><input type="submit" style="border:solid 1px #990000;" name="login" id="login" value="Login" /></td>
</tr>
</table>

		
	</form>
    
   <?php
}
?>
</div>
 <div id="footer">
        <?php include '../../inc/footer.php'; ?>
      </div>
    </div>
  </div>
</div>

<?php include '../../inc/common_end.php'; ?>
<?php include '../inc/common_start.php'; ?>
<body>
<div id="navbar_float">
  <div id="navbar_fluid">
<div id="navbar">
      <script type="text/javascript" language="JavaScript1.2" src="java/pop_core.js"></script>
      <script type="text/javascript" language="JavaScript1.2" src="java/pop_data.js"></script>
      <script type="text/javascript" language="JavaScript1.2" src="java/pop_events.js"></script>
<div id="pMenu-root" style="position: absolute; visibility: visible; left: 422px; top: 113px; width: 679px; height: 24px; z-index: 1000; clip: rect(0px, 679px, 24px, 0px);"><div id="pMenu-root-1" style="position: absolute; left: 0px; top: 0px; width: 47px; height: 22px; z-index: 1000; cursor: pointer; background: none repeat scroll 0% 0% transparent;" onmouseover="return pMenu.over('root',1)" onmouseout="pMenu.out('root',1)" onclick="return pMenu.click('root',1)">
<a href="http://www.edgeradio.org.au/admin/" class="highText" style="position: absolute; left: 0px; top: 0px; width: 100px; height: 22px; cursor: pointer;">&nbsp;<strong>Admin Home</strong></a>
<a href="http://www.edgeradio.org.au/index.php" class="highText" style="position: absolute; left: 100px; top: 0px; width: 50px; height: 22px; cursor: pointer;">&nbsp;<strong>Homepage</strong></a>
</div></div>
<a id="mNavbar" name="mNavbar"></a>
      <div id="cube"></div>
      <div id="topbanner"> 
     
      </div>

</div>
<div id="main_fluid">
  <div id="main_container">
    <div align="center"><img src="../images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    


<div id="one_column">
      <div class="rounded">

<h1 class="greyheader">Edge Radio Recommended Form</h1>
<?php

if (isset($_POST['submitted'])) {
 include "database.inc.php";


mysql_select_db('edge_website'); 

include 'resize.image.class.php';

$idir = "../images/err/";   // Path To Images Directory 
$twidth = "120";   // Maximum Width For Thumbnail Images 
$theight = "120";   // Maximum Height For Thumbnail Images 
$url = $_FILES['imagefile0']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy(''.$_POST['startDate'].'-'.$_FILES['imagefile0']['tmp_name'], "$idir" . $_FILES['imagefile0']['name']);
$image = new Resize_Image;
$image->new_width = 120;
$image->new_height = 120;
$image->image_to_resize = '../images/err/'.$url.''; // Full Path to the file
$image->ratio = true; // Keep Aspect Ratio?
$image->new_image_name = 'thumb_'.$_POST['startDate'].'-'.$_FILES['imagefile0']['name'];
$image->save_folder = '../images/err/thumb/';
$process = $image->resize();
$thumb0 = 'http://www.edgeradio.org.au/images/err/thumb/thumb_'.$_POST['startDate'].'-' . $_FILES['imagefile0']['name'] . '';

$idir = "../images/err/";   // Path To Images Directory 
$twidth = "120";   // Maximum Width For Thumbnail Images 
$theight = "120";   // Maximum Height For Thumbnail Images 
$url = $_FILES['imagefile1']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy(''.$_POST['startDate'].'-'.$_FILES['imagefile1']['tmp_name'], "$idir" . $_FILES['imagefile1']['name']);
$image = new Resize_Image;
$image->new_width = 120;
$image->new_height = 120;
$image->image_to_resize = '../images/err/'.$url.''; // Full Path to the file
$image->ratio = true; // Keep Aspect Ratio?
$image->new_image_name = 'thumb_'.$_POST['startDate'].'-'.$_FILES['imagefile1']['name'];
$image->save_folder = '../images/err/thumb/';
$process = $image->resize();
$thumb1 = 'http://www.edgeradio.org.au/images/err/thumb/thumb_'.$_POST['startDate'].'-' . $_FILES['imagefile1']['name'] . '';

$idir = "../images/err/";   // Path To Images Directory 
$twidth = "120";   // Maximum Width For Thumbnail Images 
$theight = "120";   // Maximum Height For Thumbnail Images 
$url = $_FILES['imagefile2']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy(''.$_POST['startDate'].'-'.$_FILES['imagefile2']['tmp_name'], "$idir" . $_FILES['imagefile2']['name']);
$image = new Resize_Image;
$image->new_width = 120;
$image->new_height = 120;
$image->image_to_resize = '../images/err/'.$url.''; // Full Path to the file
$image->ratio = true; // Keep Aspect Ratio?
$image->new_image_name = 'thumb_'.$_POST['startDate'].'-'.$_FILES['imagefile2']['name'];
$image->save_folder = '../images/err/thumb/';
$process = $image->resize();
$thumb2 = 'http://www.edgeradio.org.au/images/err/thumb/thumb_'.$_POST['startDate'].'-' . $_FILES['imagefile2']['name'] . '';

$idir = "../images/err/";   // Path To Images Directory 
$twidth = "120";   // Maximum Width For Thumbnail Images 
$theight = "120";   // Maximum Height For Thumbnail Images 
$url = $_FILES['imagefile3']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy(''.$_POST['startDate'].'-'.$_FILES['imagefile3']['tmp_name'], "$idir" . $_FILES['imagefile3']['name']);
$image = new Resize_Image;
$image->new_width = 120;
$image->new_height = 120;
$image->image_to_resize = '../images/err/'.$url.''; // Full Path to the file
$image->ratio = true; // Keep Aspect Ratio?
$image->new_image_name = 'thumb_'.$_POST['startDate'].'-'.$_FILES['imagefile3']['name'];
$image->save_folder = '../images/err/thumb/';
$process = $image->resize();
$thumb3 = 'http://www.edgeradio.org.au/images/err/thumb/thumb_'.$_POST['startDate'].'-' . $_FILES['imagefile3']['name'] . '';

$idir = "../images/err/";   // Path To Images Directory 
$twidth = "120";   // Maximum Width For Thumbnail Images 
$theight = "120";   // Maximum Height For Thumbnail Images 
$url = $_FILES['imagefile4']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy(''.$_POST['startDate'].'-'.$_FILES['imagefile4']['tmp_name'], "$idir" . $_FILES['imagefile4']['name']);
$image = new Resize_Image;
$image->new_width = 120;
$image->new_height = 120;
$image->image_to_resize = '../images/err/'.$url.''; // Full Path to the file
$image->ratio = true; // Keep Aspect Ratio?
$image->new_image_name = 'thumb_'.$_POST['startDate'].'-'.$_FILES['imagefile4']['name'];
$image->save_folder = '../images/err/thumb/';
$process = $image->resize();
$thumb4 = 'http://www.edgeradio.org.au/images/err/thumb/thumb_'.$_POST['startDate'].'-' . $_FILES['imagefile4']['name'] . '';

$startDate0 = $_POST['startDate0'];
$startDate1 = $_POST['startDate1'];
$startDate2 = $_POST['startDate2'];
$startDate3 = $_POST['startDate3'];
$startDate4 = $_POST['startDate4'];

$endDate0 = $_POST['endDate0'];
$endDate1 = $_POST['endDate1'];
$endDate2 = $_POST['endDate2'];
$endDate3 = $_POST['endDate3'];
$endDate4 = $_POST['endDate4'];

$Artist0 = $_POST['Artist0'];
$Artist1 = $_POST['Artist1'];
$Artist2 = $_POST['Artist2'];
$Artist3 = $_POST['Artist3'];
$Artist4 = $_POST['Artist4'];

$Album0 = $_POST['Album0'];
$Album1 = $_POST['Album1'];
$Album2 = $_POST['Album2'];
$Album3 = $_POST['Album3'];
$Album4 = $_POST['Album4'];

$Label0 = $_POST['Label0'];
$Label1 = $_POST['Label1'];
$Label2 = $_POST['Label2'];
$Label3 = $_POST['Label3'];
$Label4 = $_POST['Label4'];

$Description0 = addslashes($_POST['Description0']);
$Description1 = addslashes($_POST['Description1']);
$Description2 = addslashes($_POST['Description2']);
$Description3 = addslashes($_POST['Description3']);
$Description4 = addslashes($_POST['Description4']);

$URL0 = $_POST['URL0'];
$URL1 = $_POST['URL1'];
$URL2 = $_POST['URL2'];
$URL3 = $_POST['URL3'];
$URL4 = $_POST['URL4'];

$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];


 // Yep, this is messy, but I have given up with variable variables for today :-)
 $query1 = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, cover, Archived) VALUES ('$startDate', '$endDate', '$Artist0', '$Album0', '$Label0', '$Description0', '$URL0', '$thumb0', 'N')";
 $result1 = mysql_query($query1);

 $query2 = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, cover, Archived) VALUES ('$startDate', '$endDate', '$Artist1', '$Album1', '$Label1', '$Description1', '$URL1', '$thumb1', 'N')";
 $result2 = mysql_query($query2);

 $query3 = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, cover, Archived) VALUES ('$startDate', '$endDate', '$Artist2', '$Album2', '$Label2', '$Description2', '$URL2', '$thumb2', 'N')";
 $result3 = mysql_query($query3);

 $query4 = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, cover, Archived) VALUES ('$startDate', '$endDate', '$Artist3', '$Album3', '$Label3', '$Description3', '$URL3', '$thumb3', 'N')";
 $result4 = mysql_query($query4);

 $query5 = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, cover, Archived) VALUES ('$startDate', '$endDate', '$Artist4', '$Album4', '$Label4', '$Description4', '$URL4', '$thumb4', 'N')";
 $result5 = mysql_query($query5);
 echo mysql_error();
 if($query1 || $query2 || $query3 || $query4 || $query5) {
  
   echo "<p><strong>Success!</strong>";
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p><br>";
}
?>
<form enctype="multipart/form-data" action="mass_err_form.php" method="post">
<p>
 <strong>Start Date: </strong><br />
 <input name="startDate" type="text" value="YYYYMMDD" size="8" maxlength="8" /><br />
 <br />
 <strong>End Date: </strong><br />
 <input name="endDate" type="text" value="YYYYMMDD" size="8" maxlength="8" /><br />
 <br />
</p>
 <table cellpadding="2" cellspacing="2">
  <tr>
   <td><strong>Artist</strong></td>
   <td><strong>Album</strong></td>
   <td><strong>Label</strong></td>
   <td><strong>Description</strong></td>
   <td><strong>URL</strong></td>
<td><strong>Image</strong></td>
  </tr>
 <?php

 for ($i=0; $i<5; $i++) {
 ?>
  <tr>
   <td><input name="Artist<?php print $i ?>" type="text" maxlength="255" size="15" value="" /></td>
   <td><input name="Album<?php print $i ?>" type="text" maxlength="255" size="15" value="" /></td>
   <td><input name="Label<?php print $i ?>" type="text" maxlength="255" size="15" value="" /></td>
   <td><input name="Description<?php print $i ?>" type="text" maxlength="255" size="15" value="" /></td>
   <td><input name="URL<?php print $i ?>" type="text" maxlength="255" size="15" value="http://" /></td>
<td><input type="file" name="imagefile<?php print $i ?>" class="form"></td>
  </tr>
<?php
}
?>
 </table>
 <p>
  <input type="submit" name="submit" value="Submit Data" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
          </div>

      <div id="footer">
        <p>Copyright &copy; Edge Radio 2011. <a href="contact.php">Contact Us</a>.</p>
<!--[if lt IE 7]>
<p><strong>Note:</strong> You are using an outdated version of Internet Explorer.<br />
Some features of this site will not work. Upgrade to Firefox.</p><![endif]-->
<!--[if IE]>
<p><a href="http://www.mozilla.com/firefox?from=sfx&uid=256496&t=317"><img border="0" alt="Spreadfirefox Affiliate Button" src="http://sfx-images.mozilla.org/affiliates/Buttons/firefox3/FF3b80x15_square.gif" /></a></p><![endif]--><br /><br /><br />      </div>
    </div>
  </div>
</div>

 <script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-4237462-5");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
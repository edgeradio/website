<?php
//Generates a string of random Characters
function generateCode($length=8) 
{
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
	$code = "";
      while (strlen($code) < $length)
	{
      	$code .= $chars[mt_rand(0,strlen($chars))];
      }
      return $code;
}

function open_image ($file) {
        # JPEG:
        $im = @imagecreatefromjpeg($file);
        if ($im !== false) { return $im; }

        # GIF:
        $im = @imagecreatefromgif($file);
        if ($im !== false) { return $im; }

        # PNG:
        $im = @imagecreatefrompng($file);
        if ($im !== false) { return $im; }

        # GD File:
        $im = @imagecreatefromgd($file);
        if ($im !== false) { return $im; }

        # GD2 File:
        $im = @imagecreatefromgd2($file);
        if ($im !== false) { return $im; }

        # WBMP:
        $im = @imagecreatefromwbmp($file);
        if ($im !== false) { return $im; }

        # XBM:
        $im = @imagecreatefromxbm($file);
        if ($im !== false) { return $im; }

        # XPM:
        $im = @imagecreatefromxpm($file);
        if ($im !== false) { return $im; }

        # Try and load from string:
        $im = @imagecreatefromstring(file_get_contents($file));
        if ($im !== false) { return $im; }

        return false;
}

function makeThumbnail($image)
{
	$width = imagesx($image);
	$height = imagesy($image);
	$image_resized = imagecreatetruecolor(100, 100);
	imagecopyresampled($image_resized, $image, 0, 0, 0, 0, 100, 100, $width, $height);
	return ($image_resized);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>Mass ERR Form (by dan)</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 </head>
 <body>
<?php

if ($submit) {
 include "/include/database.inc.php";

 echo "<p><strong>The following queries were executed:</strong><br /><ul>";

 // Yep, this is messy, but I have given up with variable variables for today :-)
 $query = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, Archived) VALUES ('$startDate', '$endDate', '$Artist0', '$Album0', '$Label0', '$Description0', '$URL0', 'Y')";
 echo "<li>" . $query . "</li><br />";
 mysql_query($query);

 $query = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, Archived) VALUES ('$startDate', '$endDate', '$Artist1', '$Album1', '$Label1', '$Description1', '$URL1', 'Y')";
 echo "<li>" . $query . "</li><br />";
 mysql_query($query);

 $query = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, Archived) VALUES ('$startDate', '$endDate', '$Artist2', '$Album2', '$Label2', '$Description2', '$URL2', 'Y')";
 echo "<li>" . $query . "</li><br />";
 mysql_query($query);

 $query = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, Archived) VALUES ('$startDate', '$endDate', '$Artist3', '$Album3', '$Label3', '$Description3', '$URL3', 'Y')";
 echo "<li>" . $query . "</li><br />";
 mysql_query($query);

 $query = "INSERT INTO hub (StartDate, EndDate, Artist, Album, Label, Description, URL, Archived) VALUES ('$startDate', '$endDate', '$Artist4', '$Album4', '$Label4', '$Description4', '$URL4', 'Y')";
 echo "<li>" . $query . "</li><br />";
 mysql_query($query);

 echo "</ul></p>";
}
?>
<h1>Mass ERR Form (by dan)</h1>
<p>
 <strong>Warning:</strong> This script has the potential to cause quite a bit of havoc (from a data entry point of view).  You won't cause any lasting damage, though, because this script only inserts data, and doesn't edit anything.  All entries will be automatically archived.
</p>
<form method="post" action="mass_err_form.php">
<p>
 <strong>Start Date: </strong><br />
 <input name="startDate" type="text" value="YYYYMMDD" size="8" maxlength="8" /><br />
 <br />
 <strong>End Date: </strong><br />
 <input name="endDate" type="text" value="YYYYMMDD" size="8" maxlength="8" /><br />
 <br />
</p>
 <table>
  <tr>
   <td><strong>Artist</strong></td>
   <td><strong>Album</strong></td>
   <td><strong>Label</strong></td>
   <td><strong>Description</strong></td>
   <td><strong>URL (can be empty)</strong></td>
  </tr>
 <?php

 for ($i=0; $i<5; $i++) {
 ?>
  <tr>
   <td><input name="Artist<?php print $i ?>" type="text" maxlength="255" value="artist<?php echo $i ?>" /></td>
   <td><input name="Album<?php print $i ?>" type="text" maxlength="255" value="album<?php echo $i ?>" /></td>
   <td><input name="Label<?php print $i ?>" type="text" maxlength="255" value="label<?php echo $i ?>" /></td>
   <td><input name="Description<?php print $i ?>" type="text" maxlength="255" value="description<?php echo $i ?>" /></td>
   <td><input name="URL<?php print $i ?>" type="text" maxlength="255" value="url<?php echo $i ?>" /></td>
   <td><input name="Cover<?php print $i ?>" type="file" /></td>
  </tr>
<?php
}
?>
 </table>
 <p>
  <input type="submit" name="submit" value="Submit Data" />
 </p>
</form>
  <p>
   <a href="http://validator.w3.org/check?uri=referer"><img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0!" height="31" width="88" /></a>
  </p>
 </body>
</html>

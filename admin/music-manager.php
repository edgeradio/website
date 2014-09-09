<?php include '../templates/common_start.php'; ?>
<body>
<?php include '../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
     <?php
     
 $userid = $user->data['user_id'];
 mysql_select_db('edge_programs'); 
 $inforesult = mysql_query("SELECT * FROM program_info WHERE presenter_1='$userid' OR presenter_2='$userid' OR presenter_3='$userid'");
$info = mysql_num_rows($inforesult);
if($info || $user->data['group_id'] == 5 || $user->data['group_id'] == 4) {

?>

       <div id="left_column">
    <?php
 include'sidebar.php';
 mysql_select_db('edge_music'); 
    ?>
          </div>
    <div id="two_column">
            <div class="indentmenuadmin">
        <ul>
        <li><a href="music-manager.php"><span style="font-weight: bold;">+</span> View All</a></li>
        <li><a href="music-manager.php?do=viewpublic">Public Items</a></li>
        <li><a href="music-manager.php?do=viewerrs">ERR Items</a></li>
        <li><a style="color: #FF0000;" href="music-manager.php?do=add-track">Add Track</a></li>
        <li><a style="color: #FF0000;" href="music-manager.php?do=add-album">Add Album</a></li>
      </ul>
      </div>
<br />


<?php
$blacklist_ip_range = array(
    '/^131\.217\.(\d+)\.(\d+)/',
);

$request_ip = $_SERVER['REMOTE_ADDR'];

foreach( $blacklist_ip_range as $ip ) {
    if(!preg_match( $ip, $request_ip ) )
       	echo'<div class="rounded title" style="font-size: 24px; padding: 15px; line-height: 28px;"><b>PLEASE NOTE: You are using a computer that is not within the Edge Radio network. It is against station rules to add music from a computer outside of the Edge network, your I.P address will be logged.</b></div><br />';
    }
?>

    
     <div class="rounded">
<?php
 if($_GET['do'] == 'addimage-track')
 {
  
  if (isset($_POST['submitted'])) {
   
   
   

mysql_select_db('edge_music'); 

$date_recieved = ''.$_POST['rec-year'].''.$_POST['rec-month'].''.$_POST['rec-day'].'';
$date_released = ''.$_POST['rel-year'].''.$_POST['rel-month'].''.$_POST['rel-day'].'';

$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
$album = addslashes($_POST['album']);
$genre = addslashes($_POST['genre']);
$tracks = addslashes($_POST['tracks']);
$country = addslashes($_POST['country']);
$label = addslashes($_POST['label']);
$tasmanian = addslashes($_POST['tasmanian']);
$soundcloud = addslashes($_POST['soundcloud']);
$image = addslashes($_POST['image']);
$copies = addslashes($_POST['copies']);
$request_ip = $_SERVER['REMOTE_ADDR'];


   $inforesult = mysql_query("SELECT * FROM music WHERE artist='$artist' AND title='$title' AND album='$album'");
$info = mysql_num_rows($inforesult); 

if($info == 0) {

 $query1 = "INSERT INTO music (type, artist, title, album, genre, tracks, country, label, tasmanian, soundcloud, image, copies, date_released, date_recieved, date_added, ip) 
 VALUES 
 ('track', '$artist', '$title', '$album', '$genre', '$tracks', '$country', '$label', '$tasmanian', '$soundcloud', '$image', '$copies', '$date_released', '$date_recieved', NOW(), '$request_ip')";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo '
   
   
    <h1 class="title-head-right">Add Image</h1>
   <p>Choose an image from the last.fm database, or if none show up, you can upload an image in the form below.</p>
   <p>
   <form enctype="multipart/form-data" action="music-manager.php?do=addimagesubmit-album" method="post">
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Last.fm Image Lookup</b></td>
   <td>
   ';
  
     $completeurl = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist=$artist&album=$album&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);
echo '<div style="float: left; margin: 5px 5px 5px 5px;"><input name="image" style="border:solid 1px #990000; margin-right: 10px;" type="radio" size="25" value="'.$xml->album->image[3].'" /><br><br>';
echo '<img style="width: 100px; height: 100px;" src="'.$xml->album->image[3].'"></div>';
 
 $completeurl1 = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$artist&api_key=969c9f4dadfd85339594b7e438689e33";
$xml1 = simplexml_load_file($completeurl1);

echo '<div style="float: left; margin: 5px 5px 5px 15px;"><input name="image" style="margin-right: 10px; border:solid 1px #990000;" type="radio" size="25" value="'.$xml1->artist->image[3].'" /><br><br>';
echo '<img style="width: 100px; height: 100px;" src="'.$xml1->artist->image[3].'"></div>';


echo'</td>
</tr>
<tr>
	<td style="width: 100px;"><br><br><b>- OR -</b><br><br></td>
   <td></td>
</tr>
 <tr>
	<td style="width: 100px;"><b>Upload Image</b></td>
   <td><input type="file" name="imagefile" class="form"> </td>
</tr></table>


<br>

<h1 class="title-head-right">Add Soundcloud Sample</h1>
<p>Select which soundcloud sample you wish to use. If none are suitable or none show up, just leave it. <b>Please wait for soundcloud player to load!</b></p>

<table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Soundcloud Sample Lookup</b></td>
   <td>
   ';
  
     $completeurl3 = "http://api.soundcloud.com/tracks?q=$artist $album&consumer_key=556de56ca03c053cc27ef0644777e203&limit=10";
$xmlr = simplexml_load_file($completeurl3);

foreach($xmlr->track as $track) {

echo '<div style="padding: 5px;"><input name="soundcloud" style="margin-right: 10px; border:solid 1px #990000;" type="radio" size="25" value="'.$track->{'permalink-url'}.'" /><object height="18" width="90%"> <param name="movie" value="http://player.soundcloud.com/player.swf?url='.$track->{'permalink-url'}.'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" height="18" src="http://player.soundcloud.com/player.swf?url='.$track->{'permalink-url'}.'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false" type="application/x-shockwave-flash" width="90%"></embed> </object></div>';

}


echo'</td>
</tr>
</table>
   
   <input name="title" value="'.$title.'" type="hidden" /><input name="artist" value="'.$artist.'" type="hidden" /><input name="album" value="'.$album.'" type="hidden" />

<input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Continue >>" />
<input type="hidden" name="submitted" value="TRUE" /></form>';

  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
} else {
 echo'<p><strong>Sorry, this track is already in here!</strong>';
 }
 }
  
  } elseif($_GET['do'] == 'addimagesubmit-track')
 {
  
  if (isset($_POST['submitted'])) {
   
   if($_FILES['imagefile']['name']) {
     $idir = "../music_files/";   // Path To Images Directory 
$twidth = "106";   // Maximum Width For Thumbnail Images 
$theight = "81";   // Maximum Height For Thumbnail Images 

  $url = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy($_FILES['imagefile']['tmp_name'], "$idir" . $_FILES['imagefile']['name']);

include 'resize.image.class.php';

$image = new Resize_Image;

$image->new_width = 120;
$image->new_height = 120;

$image->image_to_resize = '../music_files/'.$url.''; // Full Path to the file

$image->ratio = true; // Keep Aspect Ratio?

// Name of the new image (optional) - If it's not set a new will be added automatically

$image->new_image_name = 'thumb_'.$_FILES['imagefile']['name'];

/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

$image->save_folder = '../music_files/';

$process = $image->resize();

if($process['result'] && $image->save_folder)
{
echo 'The new image ('.$process['new_file_path'].') has been saved.';
}


 $image = 'http://www.edgeradio.org.au/music_files/thumb_' . $_FILES['imagefile']['name'] . '';
} else {

$image = $_POST['image'];

}

$artist = addslashes($_POST['artist']);
$album = addslashes($_POST['album']);
$title = addslashes($_POST['title']);
$soundcloud = addslashes($_POST['soundcloud']);
 $query1 = "UPDATE music SET image='$image', soundcloud='$soundcloud' WHERE artist = '$artist' AND title = '$title'";
 $result1 = mysql_query($query1);

 if($query1) {

   $completeurl = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist=$artist&album=$album&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);

if($xml->album->wiki->summary[0] == '') {
 
  $completeurl = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$artist&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);

$info = strip_tags($xml->artist->bio->summary[0]);
 
 } else {
  
  $info = strip_tags($xml->album->wiki->summary[0]);
  
  }

?>
<form enctype="multipart/form-data" action="music-manager.php?do=adddessubmit-track" method="post">
<h1 class="title-head-right">Add Notes/Description</h1>
<p><strong>Success! Now Add Some Info....</strong></p>
<p>Please ensure this info is correct below and accurate!</p>
 <table cellpadding="5" cellspacing="2">
   <tr>
	<td style="width: 100px;"><b>Notes/Description</b></td>
   <td><textarea style="width: 100%; height: 400px;" name="notes"><?php echo $info; ?></textarea></td>
   </tr>
  </table>
  <br>
  
 
 <p>
  <input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Finish >>" />
  <input name="title" value="<?php echo $title; ?>" type="hidden" /><input name="artist" value="<?php echo $artist; ?>" type="hidden" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>

<?php



}


   }
   
   
   } elseif($_GET['do'] == 'adddessubmit-track')
 {
  
  if (isset($_POST['submitted'])) {
   
$notes = addslashes($_POST['notes']);
$artist = $_POST['artist'];
$title = $_POST['title'];

 $query1 = "UPDATE music SET notes='$notes' WHERE artist = '$artist' AND title = '$title'";
 $result1 = mysql_query($query1);

 if($query1) {
echo'Success!';
}


   }
   
   
   } elseif($_GET['do'] == 'addimage-album')
 {
  
  if (isset($_POST['submitted'])) {
   
   
   

mysql_select_db('edge_music'); 

$date_recieved = ''.$_POST['rec-year'].''.$_POST['rec-month'].''.$_POST['rec-day'].'';
$date_released = ''.$_POST['rel-year'].''.$_POST['rel-month'].''.$_POST['rel-day'].'';

$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
$album = addslashes($_POST['album']);
$genre = addslashes($_POST['genre']);
$tracks = addslashes($_POST['tracks']);
$country = addslashes($_POST['country']);
$label = addslashes($_POST['label']);
$tasmanian = addslashes($_POST['tasmanian']);
$soundcloud = addslashes($_POST['soundcloud']);
$image = addslashes($_POST['image']);
$copies = addslashes($_POST['copies']);
$request_ip = $_SERVER['REMOTE_ADDR'];


   $inforesult = mysql_query("SELECT * FROM music WHERE artist='$artist' AND title='$title' AND album='$album'");
$info = mysql_num_rows($inforesult); 

if($info == 0) {

 $query1 = "INSERT INTO music (type, artist, title, album, genre, tracks, country, label, tasmanian, soundcloud, image, copies, date_released, date_recieved, date_added, ip) 
 VALUES 
 ('album', '$artist', '$title', '$album', '$genre', '$tracks', '$country', '$label', '$tasmanian', '$soundcloud', '$image', '$copies', '$date_released', '$date_recieved', NOW(), '$request_ip')";
 $result1 = mysql_query($query1);

 if($query1) {
  
   echo '
   <h1 class="title-head-right">Add Image</h1>
   <p>Choose an image from the last.fm database, or if none show up, you can upload an image in the form below.</p>
   <p>
   <form enctype="multipart/form-data" action="music-manager.php?do=addimagesubmit-album" method="post">
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Last.fm Image Lookup</b></td>
   <td>
   ';
  
     $completeurl = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist=$artist&album=$album&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);
echo '<div style="float: left; margin: 5px 5px 5px 5px;"><input name="image" style="border:solid 1px #990000; margin-right: 10px;" type="radio" size="25" value="'.$xml->album->image[3].'" /><br><br>';
echo '<img style="width: 100px; height: 100px;" src="'.$xml->album->image[3].'"></div>';
 
 $completeurl1 = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$artist&api_key=969c9f4dadfd85339594b7e438689e33";
$xml1 = simplexml_load_file($completeurl1);

echo '<div style="float: left; margin: 5px 5px 5px 15px;"><input name="image" style="margin-right: 10px; border:solid 1px #990000;" type="radio" size="25" value="'.$xml1->artist->image[3].'" /><br><br>';
echo '<img style="width: 100px; height: 100px;" src="'.$xml1->artist->image[3].'"></div>';


echo'</td>
</tr>
<tr>
	<td style="width: 100px;"><br><br><b>- OR -</b><br><br></td>
   <td></td>
</tr>
 <tr>
	<td style="width: 100px;"><b>Upload Image</b></td>
   <td><input type="file" name="imagefile" class="form"> </td>
</tr></table>


<br>

<h1 class="title-head-right">Add Soundcloud Sample</h1>
<p>Select which soundcloud sample you wish to use. If none are suitable or none show up, just leave it. <b>Please wait for soundcloud player to load!</b></p>

<table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Soundcloud Sample Lookup</b></td>
   <td>
   ';
  
     $completeurl3 = "http://api.soundcloud.com/tracks?q=$artist $album&consumer_key=556de56ca03c053cc27ef0644777e203&limit=10";
$xmlr = simplexml_load_file($completeurl3);

foreach($xmlr->track as $track) {

echo '<div style="padding: 5px;"><input name="soundcloud" style="margin-right: 10px; border:solid 1px #990000;" type="radio" size="25" value="'.$track->{'permalink-url'}.'" /><object height="18" width="90%"> <param name="movie" value="http://player.soundcloud.com/player.swf?url='.$track->{'permalink-url'}.'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false"></param> <param name="allowscriptaccess" value="always"></param> <embed allowscriptaccess="always" height="18" src="http://player.soundcloud.com/player.swf?url='.$track->{'permalink-url'}.'&amp;auto_play=false&amp;player_type=tiny&amp;font=Arial&amp;color=000000&amp;theme_color=333333&amp;show_user=false&amp;single_active=true&amp;show_playcount=false" type="application/x-shockwave-flash" width="90%"></embed> </object></div>';

}


echo'</td>
</tr>
</table>

<input name="title" value="'.$title.'" type="hidden" /><input name="artist" value="'.$artist.'" type="hidden" /><input name="album" value="'.$album.'" type="hidden" />

<input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Continue >>" />
<input type="hidden" name="submitted" value="TRUE" /></form>';

  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p>";
} else {
 echo'<p><strong>Sorry, this track is already in here!</strong>';
 }
 }
  
  } elseif($_GET['do'] == 'addimagesubmit-album')
 {
  
  if (isset($_POST['submitted'])) {
   
   if($_FILES['imagefile']['name']) {
     $idir = "../music_files/";   // Path To Images Directory 
$twidth = "106";   // Maximum Width For Thumbnail Images 
$theight = "81";   // Maximum Height For Thumbnail Images 

  $url = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy($_FILES['imagefile']['tmp_name'], "$idir" . $_FILES['imagefile']['name']);

include 'resize.image.class.php';

$image = new Resize_Image;

$image->new_width = 120;
$image->new_height = 120;

$image->image_to_resize = '../music_files/'.$url.''; // Full Path to the file

$image->ratio = true; // Keep Aspect Ratio?

// Name of the new image (optional) - If it's not set a new will be added automatically

$image->new_image_name = 'thumb_'.$_FILES['imagefile']['name'];

/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

$image->save_folder = '../music_files/';

$process = $image->resize();

if($process['result'] && $image->save_folder)
{
echo 'The new image ('.$process['new_file_path'].') has been saved.';
}


 $image = 'http://www.edgeradio.org.au/music_files/thumb_' . $_FILES['imagefile']['name'] . '';
} else {

$image = $_POST['image'];

}

$artist = addslashes($_POST['artist']);
$album = addslashes($_POST['album']);
$title = addslashes($_POST['title']);
$soundcloud = addslashes($_POST['soundcloud']);
 $query1 = "UPDATE music SET image='$image', soundcloud='$soundcloud' WHERE artist = '$artist' AND title = '$title'";
 $result1 = mysql_query($query1);

 if($query1) {

   $completeurl = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist=$artist&album=$album&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);

if($xml->album->wiki->summary[0] == '') {
 
  $completeurl = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=$artist&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);

$info = strip_tags($xml->artist->bio->summary[0]);
 
 } else {
  
  $info = strip_tags($xml->album->wiki->summary[0]);
  
  }

?>
<form enctype="multipart/form-data" action="music-manager.php?do=adddessubmit-album" method="post">
<h1 class="title-head-right">Add Notes/Description</h1>
<p><strong>Success! Now Add Some Info....</strong></p>
<p>Please ensure this info is correct below and accurate!</p>
 <table cellpadding="5" cellspacing="2">
   <tr>
	<td style="width: 100px;"><b>Notes/Description</b></td>
   <td><textarea style="width: 100%; height: 400px;" name="notes"><?php echo $info; ?></textarea></td>
   </tr>
  </table>
  <br>
  
 
 <p>
  <input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Finish >>" />
  <input name="title" value="<?php echo $title; ?>" type="hidden" /><input name="artist" value="<?php echo $artist; ?>" type="hidden" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>

<?php



}


   }
   
   
   } elseif($_GET['do'] == 'adddessubmit-album')
 {
  
  if (isset($_POST['submitted'])) {
   
$notes = addslashes($_POST['notes']);
$artist = $_POST['artist'];
$title = $_POST['title'];

 $query1 = "UPDATE music SET notes='$notes' WHERE artist = '$artist' AND title = '$title'";
 $result1 = mysql_query($query1);

 if($query1) {
echo'Success!';
}


   }
   
   
   } elseif($_GET['do'] == 'add-track')
 {

?>
<form enctype="multipart/form-data" action="music-manager.php?do=addimage-track" method="post">
<h1 class="title-head-right">Add Track</h1>
<p>Add music to the Edge Radio database here, be sure to fill out as much information as possible, it really helps! We use a system that searches the Last.fm database for an image, if that fails to find an image, would you be oh so kind and upload one? The music manager will decide what tracks will be visible on the website, so don't stress if your track doesnt show up on the website, we like to review what gets displayed to our peers!</p>
<p>Volunteers please note that adding music to the database should only be done using Edge computers, we are able to track where volunteers are posting from. This is taken very seriously!</p>
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Artist</b></td>
	<td><input name="artist" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>Track Title</b></td>
   <td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Album</b></td>
   <td><input name="album" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
   </tr>
      <tr>
	<td style="width: 100px;"><b>Genre</b></td>
   <td> <select name="genre">
	<option value="Australian">A - Australian
	</option><option value="Bluesy">B - Bluesy
	</option><option value="Chill">C - Chill
	</option><option value="Downbeat">D - Downbeat
	</option><option value="Electro">E - Electro
	</option><option value="Funk">F - Funk
	</option><option value="Swing">G - Swing
	</option><option value="Hip Hop">H - Hip Hop
	</option><option value="Instrumental">I - Instrumental
	</option><option value="Jazzy">J - Jazzy
	</option><option value="Alternative Country">K - Alternative Country
	</option><option value="Live">L - Live
	</option><option value="Metal">M - Metal
	</option><option value="Indie">N - Indie
	</option><option value="World">O - World
	</option><option value="Punk">P - Punk
	</option><option value="Trance">Q - Trance
	</option><option value="Retro">R - Retro
	</option><option value="Ska">S - Ska
	</option><option value="Tasmanian">T - Tasmanian
	</option><option value="Unplugged">U - Unplugged
	</option><option value="Rap">W - Rap
	</option><option value="Hardcore">X - Hardcore
	</option><option value="Film Related">Y - Film Related
	</option><option value="Gothic">Z - Gothic
	</option><option value="Aftrican">a - African
	</option><option value="Breaks">b - Breaks
	</option><option value="Dance">c - Dance
	</option><option value="Drum n Bass">d - Drum n Bass
	</option><option value="Rockabilly">e - Rockabilly
	</option><option value="Folk">f - Folk
	</option><option value="UK Garage">g - UK Garage
	</option><option value="House">h - House
	</option><option value="Indigenous">i - Indigenous
	</option><option value="Soul">k - Soul
	</option><option value="Remix">m - Remix
	</option><option value="Noise">n - Noise
	</option><option value="Atmospheric">o - Atmospheric
	</option><option value="Progressive">p - Progressive
	</option><option value="Spiritual">q - Spiritual
	</option><option value="Reggae">r - Reggae/Dub/Ragga
	</option><option value="Trip Hop">s - Trip Hop
	</option><option value="Techno">t - Techno
	</option><option value="Pop">u - Pop
	</option><option value="Cover Version">v - Cover Version
	</option><option value="Rock">w - Rock
	</option><option value="Tekky">x - Tekky
	</option><option value="Dritpop">y - Dritpop
	</option><option value="Industrial">z - Industrial
</option></select></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Country</b></td>
   <td><input name="country" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Label</b></td>
   <td><input name="label" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Tasmanian?</b></td>
   <td><input type="checkbox" name="tasmanian" value="true" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b># Of Copies</b></td>
   <td><input name="copies" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
    <tr>
<td style="width: 100px;"><b>Date Released</b></td>
	<td>  
 <select name="rel-month">
	<option value="01">January
	</option><option value="02">February
	</option><option value="03">March
	</option><option value="04">April
	</option><option value="05">May
	</option><option value="06">June
	</option><option value="07">July
	</option><option value="08">August
	</option><option value="09">September
	</option><option value="10">October
	</option><option value="11">November
	</option><option value="12">December

</option></select>
<select name="rel-day">
	<option value="01">1
	</option><option value="02">2
	</option><option value="03">3
	</option><option value="04">4
	</option><option value="05">5
	</option><option value="06">6
	</option><option value="07">7
	</option><option value="08">8
	</option><option value="09">9
	</option><option value="10">10
	</option><option value="11">11
	</option><option value="12">12
	</option><option value="13">13
	</option><option value="14">14
	</option><option value="15">15
	</option><option value="16">16
	</option><option value="17">17
	</option><option value="18">18
	</option><option value="19">19
	</option><option value="20">20
	</option><option value="21">21
	</option><option value="22">22
	</option><option value="23">23
	</option><option value="24">24
	</option><option value="25">25
	</option><option value="26">26
	</option><option value="27">27
	</option><option value="28">28
	</option><option value="29">29
	</option><option value="30">30
	</option><option value="31">31

</option></select>
<select name="rel-year">
	<option value="2013">2013
	</option><option value="1996">1995
	</option><option value="1996">1996
	</option><option value="1997">1997
	</option><option value="1998">1998
	</option><option value="1999">1999
	</option><option value="2000">2000
	</option><option value="2001">2001
	</option><option value="2002">2002
	</option><option value="2003">2003
	</option><option value="2004">2004
	</option><option value="2005">2005
	</option><option value="2006">2006
	</option><option value="2007">2007
	</option><option value="2008">2008
	</option><option value="2009">2009
	</option><option value="2010">2010
	</option><option value="2011">2011
	</option><option value="2012">2012
	</option><option value="2013">2013
	</option><option value="2014">2014
	</option><option value="2015">2015
	</option><option value="2016">2016
	</option><option value="2017">2017
	</option><option value="2018">2018
	</option><option value="2019">2019
	</option><option value="2020">2020
</option></select></td>
	</tr>
	 <tr>
<td style="width: 100px;"><b>Date Received</b></td>
	<td>  
 <select name="rec-month">
	<option value="01">January
	</option><option value="02">February
	</option><option value="03">March
	</option><option value="04">April
	</option><option value="05">May
	</option><option value="06">June
	</option><option value="07">July
	</option><option value="08">August
	</option><option value="09">September
	</option><option value="10">October
	</option><option value="11">November
	</option><option value="12">December

</option></select>
<select name="rec-day">
	<option value="01">1
	</option><option value="02">2
	</option><option value="03">3
	</option><option value="04">4
	</option><option value="05">5
	</option><option value="06">6
	</option><option value="07">7
	</option><option value="08">8
	</option><option value="09">9
	</option><option value="10">10
	</option><option value="11">11
	</option><option value="12">12
	</option><option value="13">13
	</option><option value="14">14
	</option><option value="15">15
	</option><option value="16">16
	</option><option value="17">17
	</option><option value="18">18
	</option><option value="19">19
	</option><option value="20">20
	</option><option value="21">21
	</option><option value="22">22
	</option><option value="23">23
	</option><option value="24">24
	</option><option value="25">25
	</option><option value="26">26
	</option><option value="27">27
	</option><option value="28">28
	</option><option value="29">29
	</option><option value="30">30
	</option><option value="31">31

</option></select>
<select name="rec-year">
	<option value="2013">2013
	</option><option value="1996">1995
	</option><option value="1996">1996
	</option><option value="1997">1997
	</option><option value="1998">1998
	</option><option value="1999">1999
	</option><option value="2000">2000
	</option><option value="2001">2001
	</option><option value="2002">2002
	</option><option value="2003">2003
	</option><option value="2004">2004
	</option><option value="2005">2005
	</option><option value="2006">2006
	</option><option value="2007">2007
	</option><option value="2008">2008
	</option><option value="2009">2009
	</option><option value="2010">2010
	</option><option value="2011">2011
	</option><option value="2012">2012
	</option><option value="2013">2013
	</option><option value="2014">2014
	</option><option value="2015">2015
	</option><option value="2016">2016
	</option><option value="2017">2017
	</option><option value="2018">2018
	</option><option value="2019">2019
	</option><option value="2020">2020
</option></select></td>
	</tr>
  </table>
  <br>
  
 
 <p>
  <input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Continue >>" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
   <?php
 } elseif($_GET['do'] == 'add-album')
 {

?>
<form enctype="multipart/form-data" action="music-manager.php?do=addimage-album" method="post">
<h1 class="title-head-right">Add Album</h1>
<p>Add music to the Edge Radio database here, be sure to fill out as much information as possible, it really helps! We use a system that searches the Last.fm database for an image, if that fails to find an image, would you be oh so kind and upload one? The music manager will decide what tracks will be visible on the website, so don't stress if your track doesnt show up on the website, we like to review what gets displayed to our peers!</p>
<p>Volunteers please note that adding music to the database should only be done using Edge computers, we are able to track where volunteers are posting from. This is taken very seriously!</p>
 <table cellpadding="5" cellspacing="2">
  <tr>
	<td style="width: 100px;"><b>Artist</b></td>
	<td><input name="artist" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
	</tr>
   <tr>
	<td style="width: 100px;"><b>Album</b></td>
   <td><input name="album" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="" /></td>
   </tr>
      <tr>
	<td style="width: 100px;"><b>Genre</b></td>
   <td> <select name="genre">
	<option value="Australian">A - Australian
	</option><option value="Bluesy">B - Bluesy
	</option><option value="Chill">C - Chill
	</option><option value="Downbeat">D - Downbeat
	</option><option value="Electro">E - Electro
	</option><option value="Funk">F - Funk
	</option><option value="Swing">G - Swing
	</option><option value="Hip Hop">H - Hip Hop
	</option><option value="Instrumental">I - Instrumental
	</option><option value="Jazzy">J - Jazzy
	</option><option value="Alternative Country">K - Alternative Country
	</option><option value="Live">L - Live
	</option><option value="Metal">M - Metal
	</option><option value="Indie">N - Indie
	</option><option value="World">O - World
	</option><option value="Punk">P - Punk
	</option><option value="Trance">Q - Trance
	</option><option value="Retro">R - Retro
	</option><option value="Ska">S - Ska
	</option><option value="Tasmanian">T - Tasmanian
	</option><option value="Unplugged">U - Unplugged
	</option><option value="Rap">W - Rap
	</option><option value="Hardcore">X - Hardcore
	</option><option value="Film Related">Y - Film Related
	</option><option value="Gothic">Z - Gothic
	</option><option value="Aftrican">a - African
	</option><option value="Breaks">b - Breaks
	</option><option value="Dance">c - Dance
	</option><option value="Drum n Bass">d - Drum n Bass
	</option><option value="Rockabilly">e - Rockabilly
	</option><option value="Folk">f - Folk
	</option><option value="UK Garage">g - UK Garage
	</option><option value="House">h - House
	</option><option value="Indigenous">i - Indigenous
	</option><option value="Soul">k - Soul
	</option><option value="Remix">m - Remix
	</option><option value="Noise">n - Noise
	</option><option value="Atmospheric">o - Atmospheric
	</option><option value="Progressive">p - Progressive
	</option><option value="Spiritual">q - Spiritual
	</option><option value="Reggae">r - Reggae/Dub/Ragga
	</option><option value="Trip Hop">s - Trip Hop
	</option><option value="Techno">t - Techno
	</option><option value="Pop">u - Pop
	</option><option value="Cover Version">v - Cover Version
	</option><option value="Rock">w - Rock
	</option><option value="Tekky">x - Tekky
	</option><option value="Dritpop">y - Dritpop
	</option><option value="Industrial">z - Industrial
</option></select></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b># Of Tracks</b></td>
   <td><input name="tracks" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Country</b></td>
   <td><input name="country" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Label</b></td>
   <td><input name="label" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Tasmanian?</b></td>
   <td><input type="checkbox" name="tasmanian" value="true" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b># Of Copies</b></td>
   <td><input name="copies" style="border:solid 1px #990000;" type="text" size="25" value="" /></td>
   </tr>
    <tr>
<td style="width: 100px;"><b>Date Released</b></td>
	<td>  
 <select name="rel-month">
	<option value="01">January
	</option><option value="02">February
	</option><option value="03">March
	</option><option value="04">April
	</option><option value="05">May
	</option><option value="06">June
	</option><option value="07">July
	</option><option value="08">August
	</option><option value="09">September
	</option><option value="10">October
	</option><option value="11">November
	</option><option value="12">December

</option></select>
<select name="rel-day">
	<option value="01">1
	</option><option value="02">2
	</option><option value="03">3
	</option><option value="04">4
	</option><option value="05">5
	</option><option value="06">6
	</option><option value="07">7
	</option><option value="08">8
	</option><option value="09">9
	</option><option value="10">10
	</option><option value="11">11
	</option><option value="12">12
	</option><option value="13">13
	</option><option value="14">14
	</option><option value="15">15
	</option><option value="16">16
	</option><option value="17">17
	</option><option value="18">18
	</option><option value="19">19
	</option><option value="20">20
	</option><option value="21">21
	</option><option value="22">22
	</option><option value="23">23
	</option><option value="24">24
	</option><option value="25">25
	</option><option value="26">26
	</option><option value="27">27
	</option><option value="28">28
	</option><option value="29">29
	</option><option value="30">30
	</option><option value="31">31

</option></select>
<select name="rel-year">
	<option value="2013">2013
	</option><option value="1996">1996
	</option><option value="1997">1997
	</option><option value="1998">1998
	</option><option value="1999">1999
	</option><option value="2000">2000
	</option><option value="2001">2001
	</option><option value="2002">2002
	</option><option value="2003">2003
	</option><option value="2004">2004
	</option><option value="2005">2005
	</option><option value="2006">2006
	</option><option value="2007">2007
	</option><option value="2008">2008
	</option><option value="2009">2009
	</option><option value="2010">2010
	</option><option value="2011">2011
	</option><option value="2012">2012
	</option><option value="2013">2013
	</option><option value="2014">2014
	</option><option value="2015">2015
	</option><option value="2016">2016
	</option><option value="2017">2017
	</option><option value="2018">2018
	</option><option value="2019">2019
	</option><option value="2020">2020
</option></select></td>
	</tr>
	 <tr>
<td style="width: 100px;"><b>Date Recieved</b></td>
	<td>  
 <select name="rec-month">
	<option value="01">January
	</option><option value="02">February
	</option><option value="03">March
	</option><option value="04">April
	</option><option value="05">May
	</option><option value="06">June
	</option><option value="07">July
	</option><option value="08">August
	</option><option value="09">September
	</option><option value="10">October
	</option><option value="11">November
	</option><option value="12">December

</option></select>
<select name="rec-day">
	<option value="01">1
	</option><option value="02">2
	</option><option value="03">3
	</option><option value="04">4
	</option><option value="05">5
	</option><option value="06">6
	</option><option value="07">7
	</option><option value="08">8
	</option><option value="09">9
	</option><option value="10">10
	</option><option value="11">11
	</option><option value="12">12
	</option><option value="13">13
	</option><option value="14">14
	</option><option value="15">15
	</option><option value="16">16
	</option><option value="17">17
	</option><option value="18">18
	</option><option value="19">19
	</option><option value="20">20
	</option><option value="21">21
	</option><option value="22">22
	</option><option value="23">23
	</option><option value="24">24
	</option><option value="25">25
	</option><option value="26">26
	</option><option value="27">27
	</option><option value="28">28
	</option><option value="29">29
	</option><option value="30">30
	</option><option value="31">31

</option></select>
<select name="rec-year">
	<option value="1995">2013
	</option><option value="1996">1996
	</option><option value="1997">1997
	</option><option value="1998">1998
	</option><option value="1999">1999
	</option><option value="2000">2000
	</option><option value="2001">2001
	</option><option value="2002">2002
	</option><option value="2003">2003
	</option><option value="2004">2004
	</option><option value="2005">2005
	</option><option value="2006">2006
	</option><option value="2007">2007
	</option><option value="2008">2008
	</option><option value="2009">2009
	</option><option value="2010">2010
	</option><option value="2011">2011
	</option><option value="2012">2012
	</option><option value="2013">2013
	</option><option value="2014">2014
	</option><option value="2015">2015
	</option><option value="2016">2016
	</option><option value="2017">2017
	</option><option value="2018">2018
	</option><option value="2019">2019
	</option><option value="2020">2020
</option></select></td>
	</tr>
  </table>
  <br>
  
 
 <p>
  <input type="submit" style="border: 0px; background-color: #000000; color: #FFFFFF; -moz-border-radius:15px; -webkit-border-radius:15px; border-radius:15px; font-family: \'bebas\', arial, serif; font-size: 24px; padding: 5px;" name="submit" value="Continue >>" />
<input type="hidden" name="submitted" value="TRUE" />
 </p>
</form>
   <?php
 } elseif($_GET['do'] == 'edit') {
  
  
  
  if (isset($_POST['submitted'])) {
  
   if($_FILES['imagefile']['name']) {
     $idir = "../music_files/";   // Path To Images Directory 
$twidth = "106";   // Maximum Width For Thumbnail Images 
$theight = "81";   // Maximum Height For Thumbnail Images 

  $url = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use 
$copy = copy($_FILES['imagefile']['tmp_name'], "$idir" . $_FILES['imagefile']['name']);

include 'resize.image.class.php';

$image = new Resize_Image;

$image->new_width = 120;
$image->new_height = 120;

$image->image_to_resize = '../music_files/'.$url.''; // Full Path to the file

$image->ratio = true; // Keep Aspect Ratio?

// Name of the new image (optional) - If it's not set a new will be added automatically

$image->new_image_name = 'thumb_'.$_FILES['imagefile']['name'];

/* Path where the new image should be saved. If it's not set the script will output the image without saving it */

$image->save_folder = '../music_files/';

$process = $image->resize();

if($process['result'] && $image->save_folder)
{
echo 'The new image ('.$process['new_file_path'].') has been saved.';
}


 $image = 'http://www.edgeradio.org.au/music_files/thumb_' . $_FILES['imagefile']['name'] . '';
} elseif($_POST['image'] != '') {

$image = $_POST['image'];

} else {

$image = $_POST['img'];

}

mysql_select_db('edge_music'); 
$id = $_GET['id'];
$artist = addslashes($_POST['artist']);
$title = addslashes($_POST['title']);
$album = addslashes($_POST['album']);
$genre = addslashes($_POST['genre']);
$tracks = addslashes($_POST['tracks']);
$country = addslashes($_POST['country']);
$label = addslashes($_POST['label']);
$tasmanian = addslashes($_POST['tasmanian']);
$soundcloud = addslashes($_POST['soundcloud']);
$copies = addslashes($_POST['copies']);
$notes = addslashes($_POST['notes']);
$date_recieved = addslashes($_POST['date_recieved']);
$date_released = addslashes($_POST['date_released']);
$request_ip = $_SERVER['REMOTE_ADDR'];
$type = addslashes($_POST['type']);

 $query1 = "UPDATE music SET type='$type', title='$title', artist='$artist', album='$album', genre='$genre', tracks='$tracks', country='$country', label='$label', tasmanian='$tasmanian', soundcloud='$soundcloud', copies='$copies', notes='$notes', date_recieved='$date_recieved', image='$image', date_released='$date_released', ip='$request_ip' WHERE id = '$id'";
 $result1 = mysql_query($query1);
 echo mysql_error();
 if($query1) {
  
   echo "<p><strong>Success!</strong></p><p><a href='music-manager.php'>Return To Music Manager</a></p>";
  
  } else {
   
   echo'<p><strong>Error!</strong><br>';
   echo mysql_error();
   }

 echo "</p><br>";
 } else {
  
  $id = $_GET['id'];
$inforesult = mysql_query("SELECT * FROM music WHERE id = '$id'");
while ($info = mysql_fetch_array($inforesult)) {
?>
<form enctype="multipart/form-data" action="music-manager.php?do=edit&id=<?php echo $id; ?>" method="post">
<h1 class="title-head-right">Edit Music Item</h1>
<p>Add music to the Edge Radio database here, be sure to fill out as much information as possible, it really helps! We use a system that searches the Last.fm database for an image, if that fails to find an image, would you be oh so kind and upload one? The music manager will decide what tracks will be visible on the website, so don't stress if your track doesn't show up on the website, we like to review what gets displayed to our peers!</p>
<p>Volunteers please note that adding music to the database should only be done using Edge computers, we are able to track where volunteers are posting from. This is taken very seriously!</p>
 <table cellpadding="5" cellspacing="2">
   <tr>
	<td style="width: 100px;"><b>Type</b></td>
	<td><select name="type">
	<option <?php if(stripslashes($info['type']) == "album") { echo'selected="selected" '; } ?>value="album">Album</option>
	<option <?php if(stripslashes($info['type']) == "track") { echo'selected="selected" '; } ?>value="track">Track</option>
	</select></td>
	</tr>
  <tr>
	<td style="width: 100px;"><b>Artist</b></td>
	<td><input name="artist" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo stripslashes($info['artist']); ?>" /></td>
	</tr>
	<tr>
	<td style="width: 100px;"><b>Track Title</b></td>
   <td><input name="title" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo stripslashes($info['title']); ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Album</b></td>
   <td><input name="album" style="border:solid 1px #990000;" type="text" maxlength="255" size="25" value="<?php echo stripslashes($info['album']); ?>" /></td>
   </tr>
      <tr>
	<td style="width: 100px;"><b>Genre</b></td>
   <td><select name="genre">
	<option <?php if(stripslashes($info['genre']) == "Australian") { echo'selected="selected" '; } ?>value="Australian">A - Australian
	</option><option <?php if(stripslashes($info['genre']) == "Bluesy") { echo'selected="selected" '; } ?>value="Bluesy">B - Bluesy
	</option><option <?php if(stripslashes($info['genre']) == "Chill") { echo'selected="selected" '; } ?>value="Chill">C - Chill
	</option><option <?php if(stripslashes($info['genre']) == "Downbeat") { echo'selected="selected" '; } ?>value="Downbeat">D - Downbeat
	</option><option <?php if(stripslashes($info['genre']) == "Electro") { echo'selected="selected" '; } ?>value="Electro">E - Electronica
	</option><option <?php if(stripslashes($info['genre']) == "Funk") { echo'selected="selected" '; } ?>value="Funk">F - Funk
	</option><option <?php if(stripslashes($info['genre']) == "Swing") { echo'selected="selected" '; } ?>value="Swing">G - Swing
	</option><option <?php if(stripslashes($info['genre']) == "Hip Hop") { echo'selected="selected" '; } ?>value="Hip Hop">H - Hip Hop
	</option><option <?php if(stripslashes($info['genre']) == "Instrumental") { echo'selected="selected" '; } ?>value="Instrumental">I - Instrumental
	</option><option <?php if(stripslashes($info['genre']) == "Jazzy") { echo'selected="selected" '; } ?>value="Jazzy">J - Jazzy
	</option><option <?php if(stripslashes($info['genre']) == "Alternative Country") { echo'selected="selected" '; } ?>value="Alternative Country">K - Alternative Country
	</option><option <?php if(stripslashes($info['genre']) == "Live") { echo'selected="selected" '; } ?>value="Live">L - Live
	</option><option <?php if(stripslashes($info['genre']) == "Metal") { echo'selected="selected" '; } ?>value="Metal">M - Metal
	</option><option <?php if(stripslashes($info['genre']) == "Indie") { echo'selected="selected" '; } ?>value="Indie">N - Indie
	</option><option <?php if(stripslashes($info['genre']) == "World") { echo'selected="selected" '; } ?>value="World">O - World
	</option><option <?php if(stripslashes($info['genre']) == "Punk") { echo'selected="selected" '; } ?>value="Punk">P - Punk
	</option><option <?php if(stripslashes($info['genre']) == "Trance") { echo'selected="selected" '; } ?>value="Trance">Q - Trance
	</option><option <?php if(stripslashes($info['genre']) == "Retro") { echo'selected="selected" '; } ?>value="Retro">R - Retro
	</option><option <?php if(stripslashes($info['genre']) == "Ska") { echo'selected="selected" '; } ?>value="Ska">S - Ska
	</option><option <?php if(stripslashes($info['genre']) == "Tasmanian") { echo'selected="selected" '; } ?>value="Tasmanian">T - Tasmanian
	</option><option <?php if(stripslashes($info['genre']) == "Unplugged") { echo'selected="selected" '; } ?>value="Unplugged">U - Unplugged
	</option><option <?php if(stripslashes($info['genre']) == "Rap") { echo'selected="selected" '; } ?>value="Rap">W - Rap
	</option><option <?php if(stripslashes($info['genre']) == "Hardcore") { echo'selected="selected" '; } ?>value="Hardcore">X - Hardcore
	</option><option <?php if(stripslashes($info['genre']) == "Film Related") { echo'selected="selected" '; } ?>value="Film Related">Y - Film Related
	</option><option <?php if(stripslashes($info['genre']) == "Gothic") { echo'selected="selected" '; } ?>value="Gothic">Z - Gothic
	</option><option <?php if(stripslashes($info['genre']) == "Aftrican") { echo'selected="selected" '; } ?>value="Aftrican">a - African
	</option><option <?php if(stripslashes($info['genre']) == "Breaks") { echo'selected="selected" '; } ?>value="Breaks">b - Breaks
	</option><option <?php if(stripslashes($info['genre']) == "Dance") { echo'selected="selected" '; } ?>value="Dance">c - Dance
	</option><option <?php if(stripslashes($info['genre']) == "Drum n Bass") { echo'selected="selected" '; } ?>value="Drum n Bass">d - Drum n Bass
	</option><option <?php if(stripslashes($info['genre']) == "Rockabilly") { echo'selected="selected" '; } ?>value="Rockabilly">e - Rockabilly
	</option><option <?php if(stripslashes($info['genre']) == "Folk") { echo'selected="selected" '; } ?>value="Folk">f - Folk
	</option><option <?php if(stripslashes($info['genre']) == "UK Garage") { echo'selected="selected" '; } ?>value="UK Garage">g - UK Garage
	</option><option <?php if(stripslashes($info['genre']) == "House") { echo'selected="selected" '; } ?>value="House">h - House
	</option><option <?php if(stripslashes($info['genre']) == "Indigenous") { echo'selected="selected" '; } ?>value="Indigenous">i - Indigenous
	</option><option <?php if(stripslashes($info['genre']) == "Soul") { echo'selected="selected" '; } ?>value="Soul">k - Soul
	</option><option <?php if(stripslashes($info['genre']) == "Remix") { echo'selected="selected" '; } ?>value="Remix">m - Remix
	</option><option <?php if(stripslashes($info['genre']) == "Noise") { echo'selected="selected" '; } ?>value="Noise">n - Noise
	</option><option <?php if(stripslashes($info['genre']) == "Atmospheric") { echo'selected="selected" '; } ?>value="Atmospheric">o - Atmospheric
	</option><option <?php if(stripslashes($info['genre']) == "Progressive") { echo'selected="selected" '; } ?>value="Progressive">p - Progressive
	</option><option <?php if(stripslashes($info['genre']) == "Spiritual") { echo'selected="selected" '; } ?>value="Spiritual">q - Spiritual
	</option><option <?php if(stripslashes($info['genre']) == "Reggae") { echo'selected="selected" '; } ?>value="Reggae">r - Reggae/Dub/Ragga
	</option><option <?php if(stripslashes($info['genre']) == "Trip Hop") { echo'selected="selected" '; } ?>value="Trip Hop">s - Trip Hop
	</option><option <?php if(stripslashes($info['genre']) == "Techno") { echo'selected="selected" '; } ?>value="Techno">t - Techno
	</option><option <?php if(stripslashes($info['genre']) == "Pop") { echo'selected="selected" '; } ?>value="Pop">u - Pop
	</option><option <?php if(stripslashes($info['genre']) == "Cover Version") { echo'selected="selected" '; } ?>value="Cover Version">v - Cover Version
	</option><option <?php if(stripslashes($info['genre']) == "Rock") { echo'selected="selected" '; } ?>value="Rocky">w - Rock
	</option><option <?php if(stripslashes($info['genre']) == "Tekky") { echo'selected="selected" '; } ?>value="Tekky">x - Tekky
	</option><option <?php if(stripslashes($info['genre']) == "Britpop") { echo'selected="selected" '; } ?>value="Britpop">y - Britpop
	</option><option <?php if(stripslashes($info['genre']) == "Industrial") { echo'selected="selected" '; } ?>value="Industrial">z - Industrial
</option></select></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b># Of Tracks</b></td>
   <td><input name="tracks" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['tracks']); ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Country</b></td>
   <td><input name="country" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['country']); ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Label</b></td>
   <td><input name="label" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['label']); ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Tasmanian?</b></td>
   <td><input type="checkbox" name="tasmanian" <?php if($info['tasmanian'] == 'true') { echo'checked="checked"';  } ?> value="true" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Soundcloud Link</b></td>
   <td><input name="soundcloud" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['soundcloud']); ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b># Of Copies</b></td>
   <td><input name="copies" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['copies']); ?>" /></td>
   </tr>
   <tr>
	<td style="width: 100px;"><b>Notes/Description</b></td>
   <td><textarea style="width: 100%;" name="notes"><?php echo stripslashes($info['notes']); ?></textarea></td>
   </tr>
    <tr>
<td style="width: 100px;"><b>Date Released</b></td>
	<td> 
	<input name="date_released" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['date_released']); ?>" /> 
</td>
	</tr>
	 <tr>
<td style="width: 100px;"><b>Date Recieved</b></td>
	<td>  
	<input name="date_recieved" style="border:solid 1px #990000;" type="text" size="25" value="<?php echo stripslashes($info['date_recieved']); ?>" /> 
 </td>
	</tr>
  </table>
  <br>  <br>  <br>  <br>
  
  <?php
  
  
  
  echo'
  
   <table cellpadding="5" cellspacing="2">
   <tr>
	<td style="width: 100px;"><b>Current Image</b></td>
   <td><img src="'.stripslashes($info['image']).'"> </td>
</tr>
<tr>
	<td style="width: 100px;"><br><br><b>- CHOOSE A NEW IMAGE? -</b><br><br></td>
   <td></td>
</tr>
  <tr>
	<td style="width: 100px;"><b>Last.fm Image Lookup</b></td>
   <td>
   ';
   
     $completeurl = "http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist=".$info['artist']."&album=".$info['album']."&api_key=969c9f4dadfd85339594b7e438689e33";
$xml = simplexml_load_file($completeurl);
echo '<div style="float: left; margin: 5px 5px 5px 5px;">';
echo '<img style="width: 100px; height: 100px;" src="'.$xml->album->image[3].'"><br>
<input name="image" style="border:solid 1px #990000; margin-right: 10px;" type="radio" size="25" value="'.$xml->album->image[3].'" /></div>';
 
 $completeurl1 = "http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=".$info['artist']."&api_key=969c9f4dadfd85339594b7e438689e33";
$xml1 = simplexml_load_file($completeurl1);

echo '<div style="float: left; margin: 5px 5px 5px 15px;">';
echo '<img style="width: 100px; height: 100px;" src="'.$xml1->artist->image[3].'"><br>
<input name="image" style="margin-right: 10px; border:solid 1px #990000;" type="radio" size="25" value="'.$xml1->artist->image[3].'" /></div>';


echo'</td>
</tr>
<tr>
	<td style="width: 100px;"><br><br><b>- OR -</b><br><br></td>
   <td></td>
</tr>
 <tr>
	<td style="width: 100px;"><b>Upload Image</b></td>
   <td><input type="file" name="imagefile" class="form"> </td>
</tr></table>';
?>
  
 
 <p>
  <input type="submit" style="border:solid 1px #990000;" name="submit" value="Edit Track" />
<input type="hidden" name="submitted" value="TRUE" />
<input type="hidden" name="img" value="<?php echo $info['image']; ?>" />
 </p>
</form>
   <?php
   }
  
    }
 } elseif($_GET['do'] == 'public') { 
	
	 $bid = $_GET['id'];
   $deletequery = mysql_query("UPDATE music SET public='true' WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">PUBLIC!</h1>
   <p>Successfully made public!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">OH!</h1>
   <p>Uh, crap. That didnt be publicz for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
    }
	
} elseif($_GET['do'] == 'removepublic') { 
	
	 $bid = $_GET['id'];
   $deletequery = mysql_query("UPDATE music SET public='' WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">PUBLIC!</h1>
   <p>Successfully not made public!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">OH!</h1>
   <p>Uh, crap. That didnt not be publicz for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
    }
	
} elseif($_GET['do'] == 'makeerr') { 
	date_default_timezone_set('Australia/Hobart');
	 $bid = $_GET['id'];
	 $thedate = strtotime('+1 weeks');
	 $thedate = date('Y-m-d', $thedate);
   $deletequery = mysql_query("UPDATE music SET public='true', err_date_end='$thedate' WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">ERR!</h1>
   <p>Successfully made ERR!</p>
   <p>ERR expires on '.$thedate.'</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">OH!</h1>
   <p>Uh, crap. That didnt be ERRz for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
    }
	
} elseif($_GET['do'] == 'feat') { 
	date_default_timezone_set('Australia/Hobart');
	 $bid = $_GET['id'];
	 $thedate = date('Y-m-d');
   $deletequery = mysql_query("UPDATE music SET public='true', date_featured='$thedate' WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">FEATURE!</h1>
   <p>Successfully made feature!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">OH!</h1>
   <p>Uh, crap. That didnt be featuredz for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
    }
	
} elseif($_GET['do'] == 'removefeat') { 
	
	 $bid = $_GET['id'];
   $deletequery = mysql_query("UPDATE music SET date_featured='0000-00-00' WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">Public</h1>
   <p>This aint public now!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">OH!</h1>
   <p>Uh, crap. That didnt not not be publicz for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
    }
	
} elseif($_GET['do'] == 'removeerr') { 
	
	 $bid = $_GET['id'];
   $deletequery = mysql_query("UPDATE music SET err_date_end=NOW() WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">ERR!</h1>
   <p>Successfully not made err!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">OH!</h1>
   <p>Uh, crap. That didnt not be errz for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
    }
	
} elseif($_GET['do'] == 'delete') {
   $bid = $_GET['id'];
   $deletequery = mysql_query("DELETE FROM music WHERE id='$bid'");
   
   if($deletequery)
        {
   echo'
   <h1 class="title-head-right">DELETED!</h1>
   <p>Successfully deleted post!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
   } else {
    echo'
       <h1 class="title-head-right">OH!</h1>
   <p>Uh, crap. That didnt delete for some reason!</p>';
   echo "<meta http-equiv='refresh' content='=2;music-manager.php' />";
    }
 } else {
  
	 ?>
	 
	  <h1 class="title-head-right">SEARCH</h1>
	 <form method="get" action="music-manager.php"> 
	 <table style="width: 100%;" cellpadding="2">
<tr>
	<td><input type="text" name="search" style="width: 100%;" value="Search For Music..." onclick="this.value='';"> </td>
	<td style="width: 80px;"><input type="submit" value="Search"> </td>
</tr>
</table>
</form>
	 </div>
	 
	 <br />
	 
	 <div class="rounded">
    
    <h1 class="title-head-right">MUSIC MANAGER</h1>
  	 <table style="width: 100%;" cellpadding="15" cellspacing="0">
<tr>
<td style="width: 20px;"></td>
	<td><b>Title</b></td>
	<td style="width: 110px;"><b>Date Added</b></td>
	<td style="width: 110px;"><b>Options</b></td>
</tr>
<?php
$id = $_GET['id'];


if($_GET['search']) {
 $sque = $_GET['search'];
  $myquery = "SELECT COUNT(*) as num FROM music WHERE title LIKE '%$sque%' OR artist LIKE '%$sque%' OR album LIKE '%$sque%' ORDER BY id DESC";
  } elseif($_GET['do'] == 'viewpublic') {
   $myquery = "SELECT COUNT(*) as num FROM music WHERE public = 'true' ORDER BY id DESC";
   
   } elseif($_GET['do'] == 'viewerrs') {
    date_default_timezone_set('Australia/Hobart');
    $date = date('Y-m-d');
    $myquery = "SELECT COUNT(*) as num FROM music WHERE err_date_end != '0000-00-00' ORDER BY err_date_end DESC";
    
   } else {
   $myquery = "SELECT COUNT(*) as num FROM music ORDER BY id DESC";
   }
    $adjacents = 2;
	$total_pages = mysql_fetch_array(mysql_query($myquery));
	$total_pages = $total_pages[num];
	
	if($_GET['search']) {
 $sque = $_GET['search'];
	$targetpage = "music-manager.php?search=$sque";
	} elseif($_GET['do'] == 'viewpublic') {
	 $targetpage = "music-manager.php?do=viewpublic";
	} elseif($_GET['do'] == 'viewerrrs') {
	 $targetpage = "music-manager.php?do=viewerrs";
	} else {
	 $targetpage = "music-manager.php";
	 }
	$limit = 15; 
	$page = $_GET['p'];
	if($page) 
		$start = ($page - 1) * $limit; 
	else
		$start = 0;
	  	 	
	  	 	if($_GET['search']) {
 $sque = $_GET['search'];
$inforesult = mysql_query("SELECT *, DATE_FORMAT(date_added, '%D %M %Y') as date_added, DATE_FORMAT(err_date_end, '%D %M %Y') as err_end FROM music WHERE title LIKE '%$sque%' OR artist LIKE '%$sque%' OR album LIKE '%$sque%' ORDER BY id DESC, date_added DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM music WHERE title LIKE '%$sque%' OR artist LIKE '%$sque%' OR album LIKE '%$sque%' ORDER BY id DESC"),0);	
} elseif($_GET['do'] == 'viewpublic') {
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(date_added, '%D %M %Y') as date_added, DATE_FORMAT(err_date_end, '%D %M %Y') as err_end FROM music WHERE public = 'true' ORDER BY id DESC, date_added DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM music WHERE public = 'true' ORDER BY id DESC"),0);	

} elseif($_GET['do'] == 'viewerrs') {
 date_default_timezone_set('Australia/Hobart');
  $date = date('Y-m-d');
 $inforesult = mysql_query("SELECT *, DATE_FORMAT(date_added, '%D %M %Y') as date_added, DATE_FORMAT(err_date_end, '%D %M %Y') as err_end FROM music WHERE err_date_end != '0000-00-00' ORDER BY err_date_end DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM music WHERE err_date_end != '0000-00-00' ORDER BY err_date_end DESC"),0);	

} else {
 
 
$inforesult = mysql_query("SELECT *, DATE_FORMAT(date_added, '%D %M %Y') as date_added, DATE_FORMAT(err_date_end, '%D %M %Y') as err_end FROM music ORDER BY id DESC, date_added DESC LIMIT $start, $limit",$db);
$totalres = mysql_result(mysql_query("SELECT COUNT(*) as tot FROM music ORDER BY id DESC"),0);	
 }

$count = 0;
while ($info = mysql_fetch_array($inforesult)) {
    if (($count % 2) == 0)
        {
            $bg = "#F2F2F2";        //change this
        }
        else
        {
            $bg = "#FFFFFF";        //and this
        }
        
        date_default_timezone_set('Australia/Hobart');
        if(strtotime($info['err_date_end']) > time()) {
         $err = 'true';
         } else {
          $err = '';
          }


?>
<tr style="background-color: <?php echo($bg); ?>;">

<td>
<?php if($info['image']) { ?><img style="width: 80px; height: 80px;" src="<?php echo $info['image']; ?>"><?php } ?>
</td>
<td><?php if($info['type'] == 'album') { echo'<span style="font-size: 10px; font-weight: bold; color: #FFFFFF; background-color: #000000; padding: 2px;">ALBUM</span><br>'; } else { echo'<span style="font-size: 10px; font-weight: bold; color: #FFFFFF; background-color: #000000; padding: 2px;">TRACK</span><br>'; } ?><b>
<span style="font-size: 20px; line-height: 24px;" class="title"><?php echo stripslashes($info['artist']); ?> <?php if($info['title']) { echo '- '.stripslashes($info['title']); } ?><?php if($info['album']) { echo '<br><span style="font-size: 18px; line-height: 10px; color: #333333;">'.stripslashes($info['album']).'</span>'; } ?></span><br>
<?php if($info['public']) { echo '<img title="Public Item" src="eye_icon.gif">'; } ?><?php if($info['date_featured'] != '0000-00-00') { echo '<img title="Featured On '.$info['date_featured'].'" src="star-icon.gif">'; } ?><?php if($err) { echo '<img title="ERR Item Until '.$info['err_end'].'" src="err-icon.png">'; } ?><?php if($info['tasmanian']) { echo '<img title="Tasmanian Item" src="http://www.edgeradio.org.au/images/tas_icon.png">'; } ?>
</td>
<td><?php echo $info['date_added']; ?></td>
	<td>
<script language="javascript" type="text/javascript" >

function jumpto(x){

if (document.form<?php echo $info['id']; ?>.jumpmenu.value != "null") {
document.location.href = x
}
}

</script>


<form name="form<?php echo $info['id']; ?>">
<select name="jumpmenu" onChange="jumpto(document.form<?php echo $info['id']; ?>.jumpmenu.options[document.form<?php echo $info['id']; ?>.jumpmenu.options.selectedIndex].value)">
<option>Action...</option>
<option value="music-manager.php?do=edit&id=<?php echo $info['id']; ?>">Edit</option>
<?php if($user->data['group_id'] == 5) { if(!$info['public']) { ?>
<option value="music-manager.php?do=public&id=<?php echo $info['id']; ?>">Make Public</option>
<?php } else { ?>
<option value="music-manager.php?do=removepublic&id=<?php echo $info['id']; ?>">Remove Public</option>
<?php } } ?>
<?php if($user->data['group_id'] == 5) { if($info['type'] != 'album') { if($info['date_featured'] == '0000-00-00') { ?>
<option value="music-manager.php?do=feat&id=<?php echo $info['id']; ?>">Make Feature</option>
<?php } else { ?>
<option value="music-manager.php?do=removefeat&id=<?php echo $info['id']; ?>">Remove Feature</option>
<?php } } } ?>
<?php if($user->data['group_id'] == 5) { if(!$err) { ?>
<option value="music-manager.php?do=makeerr&id=<?php echo $info['id']; ?>">Make ERR</option>
<?php } else { ?>
<option value="music-manager.php?do=removeerr&id=<?php echo $info['id']; ?>">Remove ERR</option>
<?php } } ?>
<option value="music-manager.php?do=delete&id=<?php echo $info['id']; ?>">Delete</option>
</select>
</form>
</td>
</tr>
<?php
$count++;
}
?>
</table>
<br>

<?php 
    if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;



	if($lastpage > 1)
	{	
		//previous button
		if ($page > 1) 
			$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$prev\"><< Previous</a> ";
	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;' >$counter</span> ";
				else
					$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lastpage\">$lastpage</a> ";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=1\">1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=2\">2</a> ";
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</b> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lpm1\">$lpm1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$lastpage\">$lastpage</a> ";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=1\">1</a> ";
				$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=2\">2</a> ";
				$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; border: 0px; color: #333333;'>...</span> ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span style='font-weight:bold; padding: 2px 5px 2px 5px; color: #333333;'>$counter</span> ";
					else
						$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$counter\">$counter</a> ";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a style='padding: 2px 5px 2px 5px; color: #333333;' href=\"$targetpage?p=$next\">Next >></a>";
		
	}
	?>
	<?=$pagination?>


    <?php
    }
}
else
{
  echo "<h1 class=\"title-head-right\">WOAH</h1>";
        echo "<p>We are now redirecting you to the login page.</p>";
        echo "<p><a href=\"index.php\">Click Here</a> if you are not automatically redirected.</p>";
        echo "<script type=\"text/javascript\">
<!--
window.location = \"index.php\"
//-->
</script>";
    
}
?>
</div>
 <div id="footer">
        <?php include '../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>

<?php include '../templates/common_end.php'; ?>
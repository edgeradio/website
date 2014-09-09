<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edge Radio - 99.3fm in Hobart</title>

<script type="text/javascript" src="tooltip.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="./scripts/songListManager.js"> </SCRIPT>
<script language="javascript">
function showSC(mylink, windowname)
{
if (! window.focus) return true;
var href;
if (typeof(mylink) == 'string')
	href = mylink;
else
	href=mylink.href;
window.open(href,windowname,'width=766,height=500,scrollbars=yes');
return false;
}
</script>

<link rel="stylesheet" href="edge.css" type="text/css"/>



 

</head>

<body style="font-family: Verdana; font-size: 10pt">
<!-- Tool tips  -->
<div id="phonetic_tip" width="100" class="tip">Write the name as you would say it.</div>
<div id="mood_tip" width="100" class="tip">Refers to general atmosphere of the song. Assists with cross-fades between different songs.</div>
<div id="energy_tip" width="100" class="tip">Refers to how chilled or pumped up the song is. Assists with cross-fades between different songs.</div>
<div id="soundcode_tip" width="100" class="tip">Sub genre's or stylistic scenes that artist falls in.</div>
<div id="language_tip" width="100" class="tip">Includes Swearing, Heavy Drug, Sexual Or Violent References of themes</div>



<div align="center">
<?php include("header.inc.htm"); ?>
</div>

<table width="100%" border="0">
	<tr>
		<td bgcolor="#333333"> 
			<div width="750" align="center">
				<marquee width="750" height="20" style="font-family: Verdana; font-size: 14px; color: #CC0000" scrollamount="3" scrolldelay="75" align="middle">
					99.3 FM In Hobart, Tasmania &amp; Webstreaming Globally Now Right Here! Click
					The 'Listen' Link To Get Edge Into Your Ears. New Program Schedule Now
					On. Go To The Program Grid To Check It Out. Post A Message To Your
					Favourite Program From The Grid. The 'School Of Rock' Is Coming, Keep
					Listening To Find Out More........
				</marquee>
			</div>
		</td>
	</tr>
</table>


<div align="center">
<table border="0" cellpadding="0" cellspacing="10" height="300">
	<tr>
		<td width="750"  align="center" noresize="1" background="http://www.edgeradio.org.au/images/bg.gif" valign="top">		
		<!-- Content goes here -->
<?php
	function clean_quotes($str)
	{
		$str = str_replace("&","&amp;",$str);
		$str = str_replace("'", "&#39;", $str);
		$str = str_replace("\"","&#34;", $str);
		return ($str);
	}


	function validate_date($year,$month,$day)
	{
		if (strlen($year) != 4) return (false);
		if (strlen($month) !=2 && strlen($month) !=1) return (false);
		if (strlen($day) != 2 && strlen($day) !=1) return (false);
		$date=$year."-".$month."-".$day;
		return($date);
	}
	
	if(isSet($_POST['submit']))
	{
		
		//check for any errors in the form submission
		$is_errors = false;
		$songs = split('<',$_POST['songs']);
		$song_count = count($songs) - 1;
		$song_list = array();
		echo "<span class=\"redbold\"><b>";
					
		//check to see if at least one song had been added
		if ($song_count <= 0)
		{
			echo "Error: You must enter at least 1 song. <br />";
			$is_errors= true;
		}
		else
		{
			//split songs up into array
			for($i=0; $i < $song_count; $i++)
			{
				$song = split('>',$songs[$i]);
				$temp = array('name'=>$song[0], 'mood'=>$song[1], 'energy'=>$song[2],'sc1'=>$song[3],'sc2'=>$song[4],'sc3'=>$song[5],'language'=>$song[6]);
				array_push($song_list,$temp);
				//check to see if all songs have at least one sound code entered;
				if($song_list[$i]['sc1'] == "" && $song_list[$i]['sc2'] == "" && $song_list[$i]['sc3'] == "")
				{
					echo "Error: You must enter at least 1 Genre Descriptor for each song. <br />";
					$is_errors=true;
				}
			}
			
			
		}
		
		//check that all other feilds of the form are filled out
		
		if (!($rdate = validate_date($_POST['rdate_year'],$_POST['rdate_month'],$_POST['rdate_day'])))
		{
			echo "Error: release date is invalid. <br />";
			$is_errors=true;
		}
		if ($_POST['albumname'] == "")
		{
			echo "Error: You must enter an Album name. <br />";
			$is_errors=true;
		}
		if ($_POST['yourname'] == "")
		{
			echo "Error: You must enter Your Name. <br />";
			$is_errors=true;
		}
		if ($_POST['youremail'] == "")
		{
			echo "Error: You must enter a valid email address. <br />";
			$is_errors=true;
		}
		if ($_POST['artistname'] =="")
		{
			echo "Error: You must enter an Artist name. <br />";
			$is_errors=true;
		}
		echo "</b></span>";
		
		if (!$is_errors)
		{
			//insert album data into database
			include "../inc/database.inc.php";
			// clean up the input to avoid mySql injection attacks.

			
			$artistnote= $_POST['numact']." ".$_POST['actstyle']." act from ".$_POST['actbased'].", 
".$_POST['artistname'];
			if ($_POST['pspelling'])
			{
				$pspelling = clean_quotes($_POST['pspelling']);
				$artistnote = "(Pronounced: ".$_POST['pspelling'].") ".$artistnote;
			}
				
			$artistnote = clean_quotes($artistnote);
			$category = clean_quotes($_POST['category']);
			$role1 = clean_quotes($_POST['role1']);
			$role2 = clean_quotes($_POST['role2']);
			$albumtitle = clean_quotes($_POST['albumname']);
			$artist = clean_quotes($_POST['artistname']);
			$publisher = clean_quotes($_POST['publisher']);
			$label = clean_quotes($_POST['label']);
			$content = clean_quotes($_POST['content']);
			$enteredby = clean_quotes($_POST['yourname']);
			$comments = clean_quotes($_POST['comments']);
			$rdate = clean_quotes($rdate);
			$copies= clean_quotes($_POST['copies']);
			$reviewername = clean_quotes($_POST['yourname']);
			$email = clean_quotes($_POST['email']);
			$phone = clean_quotes($_POST['phone']);
			$touring = clean_quotes($_POST['touring']);
			
			$query = "INSERT INTO reviews_album (title,artist,category,role1,role2,publisher,label,content,releasedate,artistnote,enteredby,email,phone,touring,copies,comments) VALUES ('$albumtitle','$artist','$category','$role1','$role2','$publisher','$label','$content','$rdate','$artistnote','$reviewername','$youremail','$yourphone','$touring','$copies','$comments')";
			$result = mysql_query($query,$db);
			

			
			$query = "SELECT LAST_INSERT_ID()";
			
			$result = mysql_query($query,$db);
			$temp = mysql_fetch_row($result);
			$album_id = $temp[0]; //get the ID of the Album that was just entered.
			
			
			for($i=0; $i < $song_count; $i++)
			{
				$trackTitle = clean_quotes($song_list[$i]['name']);
				$mood = $song_list[$i]['mood'];
				$energy = $song_list[$i]['energy'];
				$sc1 = $song_list[$i]['sc1'];
				$sc2 = $song_list[$i]['sc2'];
				$sc3 = $song_list[$i]['sc3'];
				$language = $song_list[$i]['language'];
				
				$query = "INSERT INTO reviews_track (ALBUM_ID,title,mood,energy,soundCode1,soundCode2,soundCode3,language) VALUES ('$album_id','$trackTitle','$mood','$energy','$sc1','$sc2','$sc3','$language')";
				
				$result = mysql_query($query,$db);
			}
			echo "<b>";
			echo "Thanks!";
			echo "<a href=\"show-album.php?albumid=$album_id\">Click here to view your entry</a><br />";
			echo "<a href=\"review-form.php\">Click here to add another</a>";
			echo "</b>";
		}
	}
	if(!isSet($_POST['submit']) || $is_errors == true)
	{

?>

	<form action="review-form.php" method="post" style="margin-bottom: 0">
	<table width="750" cellspacing="1" bgcolor="#ffffff" cellpadding="0" border="0">
		<tr height = "20" >
			<td width="100%" colspan="2" align="center" class="row1">
				<font sixe="4" color="#CC0000" size="4"><b>Album Review Form</b></font>			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<b><span class="blackbold">Category</span></b>			</td>
			<td width="500" align="left" class="row1">
<?php
				echo	"<select name=\"category\" id=\"category\">";
				if ($_POST['category'] == "R")
					echo	"	<option value=\"R\" selected=\"selected\">Rock</option>";
					else echo	"	<option value=\"R\">Rock</option>";
				if ($_POST['category'] == "HH")
					echo	"	<option value=\"HR\" selected=\"selected\">Hip Hop</option>";
					else echo	"	<option value=\"HR\">Hip Hop</option>";
				if ($_POST['category'] == "E")
					echo	"	<option value=\"E\" selected=\"selected\">Electronic</option>";
					else echo	"	<option value=\"E\">Electronic</option>";
				if ($_POST['category'] == "J")
					echo	"	<option value=\"J\" selected=\"selected\">Jazz</option>";
					else echo	"	<option value=\"J\">Jazz</option>";
				if ($_POST['category'] == "B")
					echo	"	<option value=\"B\" selected=\"selected\">Blues</option>";
					else echo	"	<option value=\"B\">Blues</option>";
				if ($_POST['category'] == "RB")
					echo	"	<option value=\"RB\" selected=\"selected\">Modern Commercial Rythem N Blues</option>";
					else echo	"	<option value=\"RB\">Modern Commercial Rythem N Blues</option>";
				if ($_POST['category'] == "K")
					echo	"	<option value=\"K\" selected=\"selected\">Country</option>";
					else echo	"	<option value=\"K\">Country</option>";
				if ($_POST['category'] == "TP")
					echo	"	<option value=\"TP\" selected=\"selected\">Teen Pop</option>";
					else echo	"	<option value=\"TP\">Teen Pop</option>";
				if ($_POST['category'] == "W")
					echo	"	<option value=\"W\" selected=\"selected\">Australian Indigenous or World or Folk</option>";
					else echo	"	<option value=\"W\">Australian Indigenous or World of Folk</option>";
				if ($_POST['category'] == "S")
					echo	"	<option value=\"S\" selected=\"selected\">Soundtrack or Atmospheric</option>";
					else echo	"	<option value=\"S\">Soundtrack or Atmospheric</option>";
				echo "</select>";			
?>
	

			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<span class="blackbold">Album Name
                </span>
            </td>
			<td width="500" align="left" class="row1">
			<?php 
				if (isSet($_POST['albumname']))
					echo "<input name=\"albumname\" type=\"text\" maxlength=\"50\" value=\"".$_POST['albumname']."\"/>";
				else 
					echo "<input name=\"albumname\" type=\"text\" maxlentgth=\"50\" />";
			?>			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<b><span class="blackbold">Name of Artist/Group</span></b>			</td>
			<td width="500" align="left" class="row1">
			<?php 
				if (isSet($_POST['albumname']))
					echo "<input name=\"artistname\" type=\"text\" maxlength=\"50\" value=\"".$_POST['artistname']."\"/>";
				else 
					echo "<input name=\"artistname\" type=\"text\" maxlentgth=\"50\" />";
			?>			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<span class="blackbold">Phonetic spelling (optional)
                </span><span class="redbold"><a href="#" onMouseOut="popUp(event,'phonetic_tip')" onMouseOver="popUp(event,'phonetic_tip')" onclick="return false">(?)</a></span>

            </td>
			<td width="500" align="left" class="row1">
			<?php 
				if (isSet($_POST['pspelling']))
					echo "<input name=\"pspelling\" type=\"text\" maxlength=\"50\" value=\"".$_POST['pspelling']."\"/>";
				else 
					echo "<input name=\"pspelling\" type=\"text\" maxlentgth=\"50\" />";
			?>			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<b><span class="blackbold">Publisher</span></b><br />
				who is the australian publisher of the work?			</td>
			<td width="500" align="left" class="row1">
			<?php 
				if (isSet($_POST['publisher']))
					echo "<input name=\"publisher\" type=\"text\" maxlength=\"50\" value=\"".$_POST['publisher']."\"/>";
				else 
					echo "<input name=\"publisher\" type=\"text\" maxlentgth=\"50\" />";
			?>			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<b><span class="blackbold">Label</span></b><br /> 
				who is the Australian label issuing the work?			</td>
			<td width="500" align="left" class="row1">
			<?php 
				if (isSet($_POST['label']))
					echo "<input name=\"label\" type=\"text\" maxlength=\"50\" value=\"".$_POST['label']."\"/>";
				else 
					echo "<input name=\"label\" type=\"text\" maxlentgth=\"50\" />";
			?>			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<span class="blackbold">Album Release Date (YYYY-MM-DD)</span><br /> 
				</td>
			<td width="500" align="left" class="row1">
			<?php
				if (isSet($_POST['rdate_year']))
				{echo "<input name=\"rdate_year\" size=\"4\" type=\"text\" maxlength=\"4\" value=\"".$_POST['rdate_year']."\">";} else
				{echo "<input name=\"rdate_year\" size=\"4\" type=\"text\" maxlength=\"4\">";}
				echo "-";
				if (isSet($_POST['rdate_month']))
				{echo "<input name=\"rdate_month\" size=\"2\" type=\"text\" maxlength=\"2\" value=\"".$_POST['rdate_month']."\">";} else
				{echo "<input name=\"rdate_month\" size=\"2\" type=\"text\" maxlength=\"2\">";}
				echo "-";
				if (isSet($_POST['rdate_day']))
				{echo "<input name=\"rdate_day\" size=\"2\" type=\"text\" maxlength=\"2\" value=\"".$_POST['rdate_day']."\">";} else
				{echo "<input name=\"rdate_day\" size=\"2\" type=\"text\" maxlength=\"2\">";}
			?>

					
			</td>
		</tr>
		<tr>
		  <td align="left" class="row2">
		  	<span class="blackbold">Your Name</span>		  </td>
		  <td align="left" class="row1">
		  	<?php 
				if (isSet($_POST['yourname']))
					echo "<input name=\"yourname\" type=\"text\" maxlength=\"50\" value=\"".$_POST['yourname']."\"/>";
				else 
					echo "<input name=\"yourname\" type=\"text\" maxlentgth=\"50\" />";
			?>		  </td>
		  </tr>
		<tr>
		  <td align="left" class="row2"><span class="blackbold"> Contact Email</span></td>
		  <td align="left" class="row1">
		  	<?php 
				if (isSet($_POST['youremail']))
					echo "<input name=\"youremail\" type=\"text\" maxlength=\"50\" value=\"".$_POST['youremail']."\"/>";
				else 
					echo "<input name=\"youremail\" type=\"text\" maxlentgth=\"50\" />";
			?>		  </td>
		  </tr>
		<tr>
		  <td align="left" class="row2"><span class="blackbold">Contact Phone (Optional)</span></td>
		  <td align="left" class="row1">
		  	<?php 
				if (isSet($_POST['yourphone']))
					echo "<input name=\"yourphone\" type=\"text\" maxlength=\"50\" value=\"".$_POST['yourphone']."\"/>";
				else 
					echo "<input name=\"yourphone\" type=\"text\" maxlentgth=\"50\" />";
			?>		  </td>
		  </tr>
		<tr height="30" valign="middle">
		  <td align="center" colspan="2" class="row1"><span class="redbold">Artist Notes</span> </td>
		  </tr>
		<tr>
		  <td align="left" class="row2"><span class="blackbold">Number of People in Act</span></td>
		  <td align="left" class="row1"><select name="numact" id="numact" default="2 Piece">
		    <option value="Solo Artist">Solo Artist</option>
		    <option value="2 Piece">2 Piece</option>
		    <option value="3 Piece">3 Piece</option>
		    <option value="4 Piece">4 Piece</option>
		    <option value="5 Piece">5 Piece</option>
		    <option value="6 Piece">6 Piece</option>
		    <option value="7 Piece">7 Piece</option>
		    <option value="8 Piece">8 Piece</option>
		    <option value=" ">More</option>
		    </select>
		  </td>
		  </tr>
		<tr>
		  <td align="left" class="row2"><span class="blackbold">Where is the act based</span><br />
Country for international or city for Australia. </td>
		  <td align="left" class="row1"><?php 
			if (isSet($_POST['actbased']))
				echo "<input name=\"actbased\" type=\"text\" maxlength=\"20\" value=\"".$_POST['actbased']."\"/>";
			else 
				echo "<input name=\"actbased\" type=\"text\" maxlentgth=\"20\" />";
		?></td>
		  </tr>
		<tr>
		  <td align="left" class="row2"><span class="blackbold">Style</span><br />
Short description of the bands style </td>
		  <td align="left" class="row1"><?php 
			if (isSet($_POST['actstyle']))
				echo "<input type=\"text\" name=\"actstyle\" maxlength=\"50\" value=\"".$_POST['actstyle']."\">";
			else 
				echo "<input name=\"actstyle\" type=\"text\" maxlength=\"50\">";
		?></td>
		  </tr>
		<tr>
			<td width="250" align="left" class="row2">
				<b><span class="blackbold">is this an Australian Artist? </span></b>			</td>
			<td width="500" align="left" class="row1">
				
<?php
				echo "<select name=\"content\" id=\"content\">";
				if ($_POST['content'] == "No")
					echo "	<option selected=\"selected\" value=\"No\">No</option>";
					else echo "	<option value=\"No\">No</option>";
				if ($_POST['content'] == "Yes")
					echo "	<option selected=\"selected\" value=\"Yes\">Yes</option>";
					else echo "	<option value=\"Yes\">Yes</option>";
				echo "</select>";
?>
			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<b><span class="blackbold">Type of Act <br /></span></b> 
				is this a group, solo female artist <br /> or solo Male artist?			</td>
			<td width="500" align="left" class="row1">
<?php
				echo "<select name=\"role1\" id=\"role1\">";
				if ($_POST['role1'] == "G")
					echo "	<option selected=\"selected\" value=\"G\">Group</option>";
					else echo "	<option value=\"G\">Group</option>";
				if ($_POST['role1'] == "F")
					echo "	<option selected=\"selected\" value=\"F\">Solo Female</option>";
					else echo "	<option value=\"F\">Solo Female</option>";
				if ($_POST['role1'] == "M")
					echo "	<option selected=\"selected\" value=\"M\">Solo Male</option>";
					else echo "	<option value=\"M\">Solo Male</option>";
				echo "</select>";
?>
			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<b><span class="blackbold"><br /></span></b> 
				if this is a group is the lead singer male or female?			</td>
			<td width="500" align="left" class="row1">
<?php
				echo "<select name=\"role2\" id=\"role2\">";
				if ($_POST['role2'] == "M")
					echo "	<option selected=\"selected\" value=\"M\">Male</option>";
					else echo "	<option value=\"M\">Male</option>";
				if ($_POST['role2'] == "F")
					echo "	<option selected=\"selected\" value=\"F\">Female</option>";
					else echo "	<option value=\"F\">Female</option>";
				echo "</select>";
?>
		
			</td>
		</tr>

		<tr height="30" valign="middle" >
			<td colspan="2" align="center"  class="row1" >
				<span class="redbold"><b>Best Tracks</b></span><br />
				</b>Enter upto 5 the tracks from this album. The ones you would like to
				hear on the Air.			</td>
		</tr>

		<tr height="520">
			<td width="250" align="left" valign="top" class="row2">
				<table cellpadding="0" cellspacing="5" border="0" width="100%" valign="top" class="row2">
					<tr >
						<td class="row1">
							<b>Song Information</b>						</td>
					</tr>
					<tr>
						<td>
						<b><span class="blackbold">Name</span></b><br />
						<input type="text" name="songName" />						</td>
					</tr>
					<tr>
						<td>
							<span class="blackbold">Mood
			                <a href="#" onMouseOut="popUp(event,'mood_tip')" onMouseOver="popUp(event,'mood_tip')" onclick="return false">(?)</a>

							</span> <br />
							<select name="mood" id="mood">
								<option value="1">Tear Jerker</option>
								<option value="2">Sad</option>
								<option selected="selected" value="3">Average</option>
								<option value="4">Happy</option>
								<option value="5">Ecstatic</option>
							</select>						</td>
					</tr>
					<tr>
						<td>
							<span class="blackbold">Energy
							 <a href="#" onMouseOut="popUp(event,'energy_tip')" onMouseOver="popUp(event,'energy_tip')" onclick="return false">(?)</a>

							</span><br />
							<select name="energy" id="energy">
							  <option value="1">Light (sparse)</option>
							  <option value="2">Soft</option>
							  <option selected="selected" value="3">Average</option>
							  <option value="4">Hard</option>
							  <option value="5">Chainsaw (fast and furious)</option>
							</select>						</td>
					</tr>
					<tr>
						<td>
							<span class="blackbold">Genre Descriptors
							<a href="#" onMouseOut="popUp(event,'soundcode_tip')" onMouseOver="popUp(event,'soundcode_tip')" onclick="return false">(?)</a>

							</span><br />
							<select name="sc1" id="sc1">
							  <option selected="selected">Please select</option>
							  <option value="A">Australian</option>
							  <option value="T">Tasmanian</option>
							  <option value="i">Australian Indigenous</option>
							  <option value="a">African</option>
							  <option value="B">Bluesy</option>
							  <option value="C">Chill</option>
							  <option value="b">Breaks</option>
							  <option value="c">Dance</option>
							  <option value="D">Downbeat</option>
							  <option value="E">Electronica</option>
							  <option value="d">Drum 'n' Bass/Jungle</option>
							  <option value="e">Rockabilly</option>
							  <option value="F">Funk</option>
							  <option value="G">Swing</option>
							  <option value="f">Folk</option>
							  <option value="g">UK Garage</option>
							  <option value="H">Hip-Hop</option>
							  <option value="I">Instrumental</option>
							  <option value="h">House</option>
							  <option value="J">Jazzy</option>
							  <option value="K">Alt Country</option>
							  <option value="L">Live</option>
							  <option value="k">Soul</option>
							  <option value="M">Metal</option>
							  <option value="N">Independant</option>
							  <option value="O">World</option>
							  <option value="P">Punk</option>
							  <option value="o">Atmospheric</option>
							  <option value="p">Progressive</option>
							  <option value="Q">Trance</option>
							  <option value="q">roots</option>
							  <option value="R">Retro</option>
							  <option value="S">Ska</option>
							  <option value="r">Reggae</option>
							  <option value="t">Techno</option>
							  <option value="U">Unplugged</option>
							  <option value="v">Cover Version</option>
							  <option value="W">Rap</option>
							  <option value="X">Hardcore</option>
							  <option value="w">Rocky</option>
							  <option value="Y">Film Related</option>
							  <option value="y">Britpop</option>
							  <option value="x">Tekky</option>
							  <option value="z">Industrial</option>
							  </select>
				
							<br />
							<select name="sc2" id="sc2">
							  <option selected="selected">Please select</option>
							  <option value="A">Australian</option>
							  <option value="T">Tasmanian</option>
							  <option value="i">Australian Indigenous</option>
							  <option value="a">African</option>
							  <option value="B">Bluesy</option>
							  <option value="C">Chill</option>
							  <option value="b">Breaks</option>
							  <option value="c">Dance</option>
							  <option value="D">Downbeat</option>
							  <option value="E">Electronica</option>
							  <option value="d">Drum 'n' Bass/Jungle</option>
							  <option value="e">Rockabilly</option>
							  <option value="F">Funk</option>
							  <option value="G">Swing</option>
							  <option value="f">Folk</option>
							  <option value="g">UK Garage</option>
							  <option value="H">Hip-Hop</option>
							  <option value="I">Instrumental</option>
							  <option value="h">House</option>
							  <option value="J">Jazzy</option>
							  <option value="K">Alt Country</option>
							  <option value="L">Live</option>
							  <option value="k">Soul</option>
							  <option value="M">Metal</option>
							  <option value="N">Independant</option>
							  <option value="O">World</option>
							  <option value="P">Punk</option>
							  <option value="o">Atmospheric</option>
							  <option value="p">Progressive</option>
							  <option value="Q">Trance</option>
							  <option value="q">roots</option>
							  <option value="R">Retro</option>
							  <option value="S">Ska</option>
							  <option value="r">Reggae</option>
							  <option value="t">Techno</option>
							  <option value="U">Unplugged</option>
							  <option value="v">Cover Version</option>
							  <option value="W">Rap</option>
							  <option value="X">Hardcore</option>
							  <option value="w">Rocky</option>
							  <option value="Y">Film Related</option>
							  <option value="y">Britpop</option>
							  <option value="x">Tekky</option>
							  <option value="z">Industrial</option>
							  </select>
							<br />
							<select name="sc3" id="sc3">
							  <option selected="selected">Please select</option>
							  <option value="A">Australian</option>
							  <option value="T">Tasmanian</option>
							  <option value="i">Australian Indigenous</option>
							  <option value="a">African</option>
							  <option value="B">Bluesy</option>
							  <option value="C">Chill</option>
							  <option value="b">Breaks</option>
							  <option value="c">Dance</option>
							  <option value="D">Downbeat</option>
							  <option value="E">Electronica</option>
							  <option value="d">Drum 'n' Bass/Jungle</option>
							  <option value="e">Rockabilly</option>
							  <option value="F">Funk</option>
							  <option value="G">Swing</option>
							  <option value="f">Folk</option>
							  <option value="g">UK Garage</option>
							  <option value="H">Hip-Hop</option>
							  <option value="I">Instrumental</option>
							  <option value="h">House</option>
							  <option value="J">Jazzy</option>
							  <option value="K">Alt Country</option>
							  <option value="L">Live</option>
							  <option value="k">Soul</option>
							  <option value="M">Metal</option>
							  <option value="N">Independant</option>
							  <option value="O">World</option>
							  <option value="P">Punk</option>
							  <option value="o">Atmospheric</option>
							  <option value="p">Progressive</option>
							  <option value="Q">Trance</option>
							  <option value="q">roots</option>
							  <option value="R">Retro</option>
							  <option value="S">Ska</option>
							  <option value="r">Reggae</option>
							  <option value="t">Techno</option>
							  <option value="U">Unplugged</option>
							  <option value="v">Cover Version</option>
							  <option value="W">Rap</option>
							  <option value="X">Hardcore</option>
							  <option value="w">Rocky</option>
							  <option value="Y">Film Related</option>
							  <option value="y">Britpop</option>
							  <option value="x">Tekky</option>
							  <option value="z">Industrial</option>
							</select>
							<br />
							<a href="./sclist.html" onclick="return showSC(this,'sc')">Sound Code Help</a>
													</td>
					</tr>
					<tr>
						<td>
							<b><span class="blackbold">Course Language
							<a href="#" onMouseOut="popUp(event,'language_tip')" onMouseOver="popUp(event,'language_tip')" onclick="return false">(?)</a>

							</span></b>
							<select name="clanguage" id="clanguage">
								<option value="YES">Yes</option>
								<option selected="selected" value="NO">No</option>
							</select>						</td>
					</tr>
					<tr>
						<td>
							<span class="blackbold"><b>Add Song</b></span>
		
							<input type="button" name="add" value="ADD" 
onClick="addSong(songName.value,mood.value,energy.value,sc1.value,sc2.value,sc3.value,clanguage.value,'hello world');songName.value=''" />
							<?php
								if (isSet($_POST['songs']))
									echo "<input  type=\"hidden\" name=\"songs\" id=\"songs\" value=\"".$_POST['songs']."\" />";
								else 
									echo "<input type=\"hidden\" name=\"songs\" id=\"songs\" value=\"\" />";
							?>						</td>
					</tr>
				</table>			</td>

		<td width="500" valign="top" class="row1">
				<div width="500"  id="songDisplay" name="songDisplay"></div>			</td>
			</tr>
		
		<tr valign="middle" height="30">
			<td colspan="2" align="center" class="row1">
				<span class="redbold">Optional Information</span>
			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<span class="blackbold">How many copies are you sending us</span>
							</td>
			<td width="500" align="left" class="row1">
			<?php 
				if (isSet($_POST['publisher']))
					echo "<input name=\"copies\" size=\"2\" type=\"text\" maxlength=\"2\" value=\"".$_POST['publisher']."\"/>";
				else 
					echo "<input name=\"copies\" size=\"2\" type=\"text\" maxlentgth=\"2\" />";
			?>			</td>
		</tr>
		<tr>
			<td width="250" align="left" class="row2">
				<span class="blackbold">Is this act touring Tasmania in the next 12 months</span>
							</td>
			<td width="500" align="left" class="row1">

				<select name="touring">
					<option value="Yes">Yes</option>
					<option selected="selected" value="No">No</option>
				</select>
			</td>
		</tr>

		<tr>
		<td valign="top" class="row2">
			<span class="blackbold">Any other comments</span>		</td>

		<td width="500" class="row1" >
		<?php 
			if (isSet($_POST['comments']))
				echo "<textarea name=\"comments\" cols=\"78\" rows=\"5\" type=\"text\">".$_POST['comments']."</textarea>";
			else 
				echo "<textarea name=\"comments\" cols=\"78\" rows=\"5\" type=\"text\"></textarea>";
		?>		</td>
	</tr>
	<tr>
		<td  height="20" valign="middle" class="row2">
		<b><span class="blackbold">Hit Submit to add your review to our database</span></b>		</td>
		<td class="row1">
			<input name="submit" type="submit" value="submit">		</td>
	</tr>

	</table>
	</form>	
<?php
	}
	echo "<br />";
	include("footer.inc.htm");

?>		
		
		<!-- End of Content -->

		</td>
		
	</tr>


</table>
</div>
<SCRIPT language="javascript">
	printList();
</SCRIPT>

</body>
</html>

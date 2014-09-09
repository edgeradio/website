<table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
<tr valign="top">
	<td class="content" width="100%">
<?php 
	//session_start();
	include "./scripts/minixml.inc.php";
	include "./scripts/utf.inc.php";
	$tempdir="./xml/temp/";
	
	if (isset($_POST['logout']))
	{
		if ($_SESSION['user'] == "tristan it dept")
			unlink($_SESSION['xmlfile']);
		session_destroy();
	}
	
	if (isset($_POST['login']))
	{
		if (!session_is_registered('user'))
		{
		$_POST['username'] = addslashes($_POST['username']);
		$_POST['password'] = addslashes($_POST['password']);
		include("../inc/database.inc.php");
		$query = "SELECT * FROM reviews_users where username='".$_POST['username']."' AND password='".$_POST['password']."'";
		$r = mysql_query($query,$db);
		mysql_close($db);

		function generateCode($length=8) {
        	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        	$code = "";
        	while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,strlen($chars))];
        	}
        	return $code;
		}


		if (mysql_num_rows($r) != 0)
		{
			$_SESSION['user'] = $_POST['username'];
			if ($_SESSION['user'] == "tristan it dept")
			{
				$num = generateCode(10);
				$fname = $tempdir."song".$num."-Song.xml";
				$_SESSION['xmlfile']=$fname;
				$emptyXML = file_get_contents('./xml/song-blank.xml');
				$fh = fopen($fname, 'w') or die("can't open file");
				fwrite($fh, $emptyXML);
			}	
			else
			{
				$fname = "./xml/song-Song-1.xml";
				$_SESSION['xmlfile']=$fname;
				if (!$emptyXML = file_get_contents($fname))
				{ 
					$emptyXML = file_get_contents('./xml/song-blank.xml');
					$fh = fopen($fname, 'w') or die("can't open file");
					fwrite($fh, $emptyXML);
				}
			}
		}
	}}
	
	if ( session_is_registered('user') )
	{
?>
	<table cellpadding="2" cellspacing="2" border="0" width="100%" height="20">
	<tr valign="top">
		<td width="60%" align="left">
		<?php
		if (isSet($_SESSION['xmlfile']))
		{
			
			echo "<a href=\"".$_SESSION['xmlfile']."\"><font class=\"redbold\">"."View Temporary XML"."</font></a>";
			echo "&nbsp;&nbsp;";
			echo "<a href=\"tempxml.php\"><font class=\"redbold\">View XML Details</a>";
			
		}?>
		</td>
		<td width="40%" align="right">
				<form method="post" action="" style="margin-bottom: 0">
		<span class="redbold">
		<? echo "Logged in as:&nbsp;".$_SESSION['user']; ?>
		</span>
		

			<input type="submit" name="logout" value="logout" />
		</form>
		</td>
		</tr>
		</table>
	
<?	
	}else
	{

			
?>
	<form method="post" action="" style="margin-bottom: 0">
	<table cellpadding="2" cellspacing="2" border="0">
	<tr valign="top">
		<td width="50%">
		</td>
		<td width="10%" align="right">
			<span class="redbold">Username:</span>
		</td>
		<td width="10%" align="right">
			<input type="text" name="username" maxlength="20" />
		</td>


		<td width="10%" align="right">
			<span class="redbold">Password:</span>
		</td>
		<td width="10%" align="right">
			<input type="password" name="password" maxlength="20" />
		</td>


		<td width="10%" align="right">
			<input type="submit" name="login" value="Submit" />
		</td>


	</tr>
	</table>
</form>
<?php
	}
?>
	</td>
	</tr>
</table>

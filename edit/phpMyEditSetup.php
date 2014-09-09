<?php

/*
 * phpMyEdit - instant MySQL table editor and code generator
 *
 * phpMyEditSetup.php - interactive table configuration utility (setup)
 * ____________________________________________________________
 *
 * Copyright (c) 1999-2002 John McCreesh <jpmcc@users.sourceforge.net>
 * Copyright (c) 2001-2002 Jim Kraai <jkraai@users.sourceforge.net>
 * Versions 5.0 and higher developed by Ondrej Jombik <nepto@php.net>
 * Copyright (c) 2002-2004 Platon SDG, http://platon.sk/
 * All rights reserved.
 *
 * See README file for more information about this software.
 * See COPYING file for license information.
 *
 * Download the latest version from
 * http://platon.sk/projects/phpMyEdit/
 */

/* $Platon: phpMyEdit/phpMyEditSetup.php,v 1.34 2004/01/16 19:46:32 nepto Exp $ */

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>phpMyEdit Setup</title>
	<style type="text/css">
	<!--
		body  { font-family: "Verdana", "Arial", "Sans-Serif"; text-align: left }
		h1    { color: #004d9c; font-size: 13pt; font-weight: bold }
		h2    { color: #004d9c; font-size: 11pt; font-weight: bold }
		h3    { color: #004d9c; font-size: 11pt; }
		p     { color: #004d9c; font-size: 9pt; }
		table { border: 1px solid #004d9c; border-collapse: collapse; border-spacing: 0px; }
		td    { border: 1px solid; padding: 3px; color: #004d9c; font-size: 9pt; }
		hr
		{
		height: 1px;
		background-color: #000000;
		color: #000000;
		border: solid #000000 0;
		padding: 0;
		margin: 0;
		border-top-width: 1px;
		}
	-->
	</style>
</head>
<body bgcolor="white">

<?php

$hn = @$HTTP_POST_VARS['hn'];
$un = @$HTTP_POST_VARS['un'];
$pw = @$HTTP_POST_VARS['pw'];
$db = @$HTTP_POST_VARS['db'];
$tb = @$HTTP_POST_VARS['tb'];
$id = @$HTTP_POST_VARS['id'];
$submit        = @$HTTP_POST_VARS['submit'];
$options       = @$HTTP_POST_VARS['options'];
$baseFilename  = @$HTTP_POST_VARS['baseFilename'];
$pageTitle     = @$HTTP_POST_VARS['pageTitle'];
$pageHeader    = @$HTTP_POST_VARS['pageHeader'];
$HTMLissues    = @$HTTP_POST_VARS['HTMLissues'];
$CSSstylesheet = @$HTTP_POST_VARS['CSSstylesheet'];

$phpExtension = '.php';
if (isset($baseFilename) && $baseFilename != '') {
	$phpFile = $baseFilename.$phpExtension;
	//$contentFile = $baseFilename.'Content.inc';
	$contentFile = $baseFilename.'.php';
} elseif (isset($tb)) {
	$phpFile = $tb.$phpExtension;
	//$contentFile = $tb.'Content.inc';
	$contentFile = $tb.'.php';
} else {
	$phpFile = 'index'.$phpExtension;
	//$contentFile = 'Content.inc';
	$contentFile = 'phpMyEdit-content.php';
}

$buffer = '';

function echo_html($x)
{
	echo htmlspecialchars($x),"\n";
}

function echo_buffer($x)
{
	global $buffer;
	$buffer .= $x."\n";
}

$self = basename($HTTP_SERVER_VARS['PHP_SELF']);
$dbl  = @mysql_pconnect($hn, $un, $pw);

if ((!$dbl) or empty($submit)) {
	echo '<h1>Please log in to your MySQL database</h1>';
	if (!empty($submit)) {
		echo '<h2>Sorry - login failed - please try again</h2>'."\n";
	}
	if (! isset($hn)) {
		$hn = 'localhost';
	}
	echo '
		<form action="'.htmlspecialchars($self).'" method="POST">
		<table border="1" cellpadding="1" cellspacing="0" summary="Login form">
		<tr>
		<td>Hostname:</td>
		<td><input type="text" name="hn" value="'.htmlspecialchars($hn).'"></td>
		</tr><tr>
		<td>Username:</td>
		<td><input type="text" name="un" value="'.htmlspecialchars($un).'"></td>
		</tr><tr>
		<td>Password:</td>
		<td><input type="password" name="pw" value="'.htmlspecialchars($pw).'"></td>
		</tr>
		</table><br>
		<input type="submit" name="submit" value="Submit">
		</form>'."\n";
} else if (! isset($db)) {
	$dbs     = @mysql_list_dbs($dbl);
	$num_dbs = @mysql_num_rows($dbs);
	echo '<h1>Please select a database</h1>
		<form action="'.htmlspecialchars($self).'" method="POST">
		<input type="hidden" name="hn" value="'.htmlspecialchars($hn).'">
		<input type="hidden" name="un" value="'.htmlspecialchars($un).'">
		<input type="hidden" name="pw" value="'.htmlspecialchars($pw).'">
		<table border="1" cellpadding="1" cellspacing="1" summary="Database selection">'."\n";
	for ($i = 0; $i < $num_dbs; $i++) {
		$db = @mysql_db_name($dbs, $i);
		$checked = ! strcasecmp($un, $db) ? ' checked' : '';
		$db = htmlspecialchars($db);
		echo '<tr><td><input'.$checked.' type="radio" name="db" value="'.$db.'"></td><td>'.$db.'</td></tr>'."\n";
	}
	echo '</table><br>
		<input type="submit" name="submit" value="Submit">
		<input type="submit" name="cancel" value="Cancel">
		</form>'."\n";
} else if (!isset($tb)) {
	echo '<h1>Please select a table from database: '.htmlspecialchars($db).'</h1>
		<form action="'.htmlspecialchars($self).'" method="POST">
		<input type="hidden" name="hn" value="'.htmlspecialchars($hn).'">
		<input type="hidden" name="un" value="'.htmlspecialchars($un).'">
		<input type="hidden" name="pw" value="'.htmlspecialchars($pw).'">
		<input type="hidden" name="db" value="'.htmlspecialchars($db).'">
		<table border="1" cellpadding="1" cellspacing="1" summary="Table selection">'."\n";
	$tbs     = @mysql_list_tables($db, $dbl);
	$num_tbs = @mysql_num_rows($tbs);
	for ($j = 0; $j < $num_tbs; $j++) {
		$tb = @mysql_tablename($tbs, $j);
		$tb = htmlspecialchars($tb);
		$checked = $j == 0 ? ' checked' : '';
		echo '<tr><td><input'.$checked.' type="radio" name="tb" value="'.$tb.'"></td><td>'.$tb.'</td></tr>'."\n";
	}
	echo '</table><br>
		<input type="submit" name="submit" value="Submit">
		<input type="submit" name="cancel" value="Cancel">
		</form>'."\n";
} else if (!isset($id)) {
	echo '  <h1>Please select an identifier from table: '.htmlspecialchars($tb).'</h1>
		<p>
		This field will be used in change, view, copy and delete operations.<br>
		The field should be numeric and must uniquely identify a record.
		</p>
		<p>
		Please note, that there were problems reported by phpMyEdit users
		regarding using MySQL reserved word as unique key name (the example for
				this is "key" name). Thus we recommend you to use another name
		of unique key. Usage of "id" or "ID" should be safe and good idea.
		</p>
		<form action="'.htmlspecialchars($self).'" method="POST">
		<input type="hidden" name="hn" value="'.htmlspecialchars($hn).'">
		<input type="hidden" name="un" value="'.htmlspecialchars($un).'">
		<input type="hidden" name="pw" value="'.htmlspecialchars($pw).'">
		<input type="hidden" name="db" value="'.htmlspecialchars($db).'">
		<input type="hidden" name="tb" value="'.htmlspecialchars($tb).'">
		<table border="1" cellpadding="1" cellspacing="1" summary="Key selection">'."\n";
//		<tr><td><input type="radio" name="id" value="">
//		<td><i>None</i></td><td><i>No id field required</i></td></tr>
	@mysql_select_db($db);
	$tb_desc = @mysql_query("DESCRIBE $tb");
	$fds     = @mysql_list_fields($db,$tb,$dbl);
	for ($j = 0; ($fd = @mysql_field_name($fds, $j)) != false; $j++) {
		$ff = @mysql_field_flags($fds, $j);
		strlen($ff) <= 0 && $ff = '---';
		$checked = stristr($ff, 'primary_key') ? ' checked' : '';
		echo '<tr><td><input',$checked,' type="radio" name="id" value="',htmlspecialchars($fd),'"></td>';
		echo '<td>',htmlspecialchars($fd),'</td>';
		echo '<td>',htmlspecialchars($ff),'</td>';
		$r = @mysql_fetch_array($tb_desc, $j);
	}
	echo '</table><br>
		<input type="submit" name="submit" value="Submit">
		<input type="submit" name="cancel" value="Cancel">
		</form>'."\n";

} else if (!isset($options)) {
	echo '<h1>Please select additional options</h1>
		<form action="'.htmlspecialchars($self).'" method="POST">
		<input type="hidden" name="hn" value="'.htmlspecialchars($hn).'">
		<input type="hidden" name="un" value="'.htmlspecialchars($un).'">
		<input type="hidden" name="pw" value="'.htmlspecialchars($pw).'">
		<input type="hidden" name="db" value="'.htmlspecialchars($db).'">
		<input type="hidden" name="tb" value="'.htmlspecialchars($tb).'">
		<input type="hidden" name="id" value="'.htmlspecialchars($id).'">
		<table border="1" cellpadding="1" cellspacing="1" summary="Additional options">
		<tr><td>Base filename</td><td><input type="text" name=baseFilename value ="'.htmlspecialchars($tb).'"></td></tr>
		<tr><td>Page title</td><td><input type="text" name=pageTitle value ="'.htmlspecialchars($tb).'"></td></tr>
		<tr><td>Page header</td><td><input type="checkbox" name=pageHeader></td></tr>
		<tr><td>HTML header &amp; footer</td><td><input type="checkbox" name=HTMLissues></td></tr>
		<tr><td>CSS basic stylesheet</td><td><input checked type="checkbox" name=CSSstylesheet></td></tr>
		</table><br>
		<input type="submit" name="submit" value="Submit">
		<input type="submit" name="cancel" value="Cancel">
		<input type="hidden" name="options" value="1">
		</form>'."\n";
} else {
	echo '<h1>Here is your phpMyEdit calling program</h1>'."\n";
	echo '<h2>You may now copy and paste it into your PHP editor</h2>'."\n";
	if ($pageHeader) {
		echo_buffer('<h3>'.$pageTitle.'</h3>');
	}
	echo_buffer("<?php

/*
 * IMPORTANT NOTE: This generated file contains only a subset of huge amount
 * of options that can be used with phpMyEdit. To get information about all
 * features offered by phpMyEdit, check official documentation. It is available
 * online and also for download on phpMyEdit project management page:
 *
 * http://www.platon.sk/projects/main_page.php?project_id=5
 */

// MySQL host name, user name, password, database, and table
\$opts['hn'] = '$hn';
\$opts['un'] = '$un';
\$opts['pw'] = '$pw';
\$opts['db'] = '$db';
\$opts['tb'] = '$tb';

// Name of field which is the unique key
\$opts['key'] = '$id';

// Type of key field (int/real/string/date etc.)");

	if ($id == '') {
		echo_buffer("\$opts['key_type'] = '';");
	} else {
		$fds = @mysql_list_fields($db,$tb,$dbl);
		for ($j = 0; ($fd = @mysql_field_name($fds, $j)) != ''; $j++) {
			if ($fd == $id) {
				echo_buffer("\$opts['key_type'] = '".@mysql_field_type($fds, $j)."';");
				break;
			}
		}
	}
	echo_buffer("
// Sorting field(s)
\$opts['sort_field'] = array('$id');

// Number of records to display on the screen
// Value of -1 lists all records in a table
\$opts['inc'] = 15;

// Options you wish to give the users
// A - add,  C - change, P - copy, V - view, D - delete,
// F - filter, I - initial sort suppressed
\$opts['options'] = 'ACPVDF';

// Number of lines to display on multiple selection filters
\$opts['multiple'] = '4';

// Navigation style: B - buttons (default), T - text links, G - graphic links
// Buttons position: U - up, D - down (default)
\$opts['navigation'] = 'DB';

// Display special page elements
\$opts['display'] = array(
	'form'  => true,
	'query' => true,
	'sort'  => true,
	'time'  => true,
	'tabs'  => true
);

/* Get the user's default language and use it if possible or you can
   specify particular one you want to use. Refer to official documentation
   for list of available languages. */
\$opts['language'] = \$HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];

/* Table-level filter capability. If set, it is included in the WHERE clause
   of any generated SELECT statement in SQL query. This gives you ability to
   work only with subset of data from table.

\$opts['filters'] = \"column1 like '%11%' AND column2<17\";
\$opts['filters'] = \"section_id = 9\";
\$opts['filters'] = \"PMEtable0.sessions_count > 200\";
*/

/* Field definitions
   
Fields will be displayed left to right on the screen in the order in which they
appear in generated list. Here are some most used field options documented.

['name'] is the title used for column headings, etc.;
['maxlen'] maximum length to display add/edit/search input boxes
['trimlen'] maximum length of string content to display in row listing
['width'] is an optional display width specification for the column
          e.g.  ['width'] = '100px';
['mask'] a string that is used by sprintf() to format field output
['sort'] true or false; means the users may sort the display on this column
['strip_tags'] true or false; whether to strip tags from content
['nowrap'] true or false; whether this field should get a NOWRAP
['required'] true or false; if generate javascript to prevent null entries
['select'] T - text, N - numeric, D - drop-down, M - multiple selection
['options'] optional parameter to control whether a field is displayed
  L - list, F - filter, A - add, C - change, P - copy, D - delete, V - view
            Another flags are:
            R - indicates that a field is read only
            W - indicates that a field is a password field
            H - indicates that a field is to be hidden and marked as hidden
['URL'] is used to make a field 'clickable' in the display
        e.g.: 'mailto:\$value', 'http://\$value' or '\$page?stuff';
['URLtarget']  HTML target link specification (for example: _blank)
['textarea']['rows'] and/or ['textarea']['cols']
  specifies a textarea is to be used to give multi-line input
  e.g. ['textarea']['rows'] = 5; ['textarea']['cols'] = 10
['values'] restricts user input to the specified constants,
           e.g. ['values'] = array('A','B','C') or ['values'] = range(1,99)
['values']['table'] and ['values']['column'] restricts user input
  to the values found in the specified column of another table
['values']['description'] = 'desc_column'
  The optional ['values']['description'] field allows the value(s) displayed
  to the user to be different to those in the ['values']['column'] field.
  This is useful for giving more meaning to column values. Multiple
  descriptions fields are also possible. Check documentation for this.
*/
");

	@mysql_select_db($db);
	$tb_desc = @mysql_query("DESCRIBE $tb");
	$fds     = @mysql_list_fields($db, $tb, $dbl);
	$num_fds = @mysql_num_fields($fds);
	$ts_cnt  = 0;
	for ($k = 0; $k < $num_fds; $k++) {
		$fd = mysql_field_name($fds,$k);
		$fm = mysql_fetch_field($fds,$k);
		$fn = strtr($fd, '_-.', '   ');
		$fn = preg_replace('/(^| +)id( +|$)/', '\\1ID\\2', $fn); // uppercase IDs
		$fn = ucfirst($fn);
		$row = @mysql_fetch_array($tb_desc);
		echo_buffer('$opts[\'fdd\'][\''.$fd.'\'] = array('); // )
		echo_buffer("  'name'     => '".str_replace('\'','\\\'',$fn)."',");
		$auto_increment = strstr($row[5], 'auto_increment') ? 1 : 0;
		if (substr($row[1],0,3) == 'set') {
			echo_buffer("  'select'   => 'M',");
		} else {
			echo_buffer("  'select'   => 'T',");
		}
		if ($auto_increment) {
			echo_buffer("  'options'  => 'AVCPDR', // auto increment");
		}
		// timestamps are read-only
		else if (@mysql_field_type($fds, $k) == 'timestamp') {
			if ($ts_cnt > 0) {
				echo_buffer("  'options'  => 'AVCPD',");
			} else { // first timestamp
				echo_buffer("  'options'  => 'AVCPDR', // updated automatically (MySQL feature)");
			}
			$ts_cnt++;
		}
		echo_buffer("  'maxlen'   => ".@mysql_field_len($fds,$k).',');
		// blobs -> textarea
		if (@mysql_field_type($fds,$k) == 'blob') {
			echo_buffer("  'textarea' => array(");
			echo_buffer("    'rows' => 5,");
			echo_buffer("    'cols' => 50),");
		}
		// SETs and ENUMs get special treatment
		if ((substr($row[1],0,3) == 'set' || substr($row[1],0,4) == 'enum')
				&& ! (($pos = strpos($row[1], '(')) === false)) {
			$indent = str_repeat(' ', 18);
			$outstr = substr($row[1], $pos + 2, -2);
			$outstr = explode("','", $outstr);
			$outstr = str_replace("''", "'",  $outstr);
			$outstr = str_replace('"', '\\"', $outstr);
			$outstr = implode("\",\n$indent\"", $outstr);
			echo_buffer("  'values'   => array(\n$indent\"".$outstr.'"),');
		}
		// automatic support for Default values
		if ($row[4] != '' && $row[4] != 'NULL') {
			echo_buffer("  'default'  => '".$row[4]."',");
		} else if ($auto_increment) {
			echo_buffer("  'default'  => '0',");
		}
		if (stristr(@mysql_field_flags($fds, $k), 'not_null') && ! $auto_increment) {
			echo_buffer("  'required' => true,");
		}
		echo_buffer("  'sort'     => true");
		//echo_buffer("  'nowrap'   => false,");
		echo_buffer(');');
	}

	echo_buffer("
// Now important call to phpMyEdit
require_once 'phpMyEdit.class.php';
new phpMyEdit(\$opts);

?>
");

	$css_directive = <<<END
<style type="text/css">
	table { border: #004d9c 1px solid; border-collapse: collapse; border-spacing: 0px; width: 100%; }
	th    { border: #004d9c 1px solid; padding: 4px; background: #add8e6; }
	td    { border: #004d9c 1px solid; padding: 3px; }
	hr    { border: 0px solid; padding: 0px; margin: 0px; border-top-width: 1px; height: 1px; }
</style>
END;
	if (! $CSSstylesheet) {
		$css_directive = '';
	}

	if ($HTMLissues) {
		$buffer = <<<END
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>$pageTitle</title>
$css_directive
</head>
<body>
END;
		$buffer .= "\n" . $buffer;
	} else if ($CSSstylesheet) {
		$buffer = $css_directive . $buffer;
	}
	if ($HTMLissues) {
		$buffer .= "</body>\n";
		$buffer .= "</html>\n";
	}
	// write the content include file
	echo 'Trying to write content file to: <b>'.'./'.$contentFile.'</b><br>'."\n";
	$filehandle = @fopen('./'.$contentFile, 'w+');
	if ($filehandle) {
		fwrite($filehandle, $buffer);
		flush($filehandle);
		fclose($filehandle);
		echo 'phpMyEdit content file written successfully<br>';
	} else {
		echo 'phpMyEdit content file was NOT written due to inssufficient privileges.<br>';
		echo 'Please copy and paste content listed below to <i>'.'./'.$contentFile.'</i> file.';
	}
	echo '<br><hr>';
	echo '<pre>';
	echo_html($buffer);
	echo '</pre><hr>'."\n";
}

?>

</body>
</html>


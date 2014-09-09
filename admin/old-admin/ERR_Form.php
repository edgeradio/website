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
<div style="text-align: center; margin: 0 auto; position:relative; top:-16px; background: url(../images/starburst_bg.gif) no-repeat; background-position: top center; min-height:600px; height:100%; z-index:0; font-family:Arial, Helvetica, sans-serif; font-size:14px;">
    <div align="center"><img src="../images/starburst_logo.gif" alt="edge radio 99.3FM" width="640" height="105"/></div>
    


<div style="height:100%; width: 90%; margin-left: auto; margin-right: auto;">
      <div class="rounded">

<h1 class="greyheader">Edge Radio Recommended Form</h1>
  <?php

/*
 * IMPORTANT NOTE: This generated file contains only a subset of huge amount
 * of options that can be used with phpMyEdit. To get information about all
 * features offered by phpMyEdit, check official documentation. It is available
 * online and also for download on phpMyEdit project management page:
 *
 * http://www.platon.sk/projects/main_page.php?project_id=5
 */

// MySQL host name, user name, password, database, and table
$opts['hn'] = 'localhost';


$opts['un'] = 'edge_edge';


$opts['pw'] = 'rAdio_993';


$opts['db'] = 'edge_website';

$opts['tb'] = 'hub';

// Name of field which is the unique key
$opts['key'] = 'id';

// Type of key field (int/real/string/date etc.)
$opts['key_type'] = 'int';

// Sorting field(s)
$opts['sort_field'] = array('StartDate', 'id');

// Number of records to display on the screen
// Value of -1 lists all records in a table
$opts['inc'] = 15;

// Options you wish to give the users
// A - add,  C - change, P - copy, V - view, D - delete,
// F - filter, I - initial sort suppressed
$opts['options'] = 'CPVDF';

// Number of lines to display on multiple selection filters
$opts['multiple'] = '4';

// Navigation style: B - buttons (default), T - text links, G - graphic links
// Buttons position: U - up, D - down (default)
$opts['navigation'] = 'DB';

// Display special page elements
$opts['display'] = array(
	'form'  => true,
	'query' => true,
	'sort'  => true,
	'time'  => true,
	'tabs'  => true
);

/* Get the user's default language and use it if possible or you can
   specify particular one you want to use. Refer to official documentation
   for list of available languages. */
$opts['language'] = $HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'];

/* Table-level filter capability. If set, it is included in the WHERE clause
   of any generated SELECT statement in SQL query. This gives you ability to
   work only with subset of data from table.

$opts['filters'] = "column1 like '%11%' AND column2<17";
$opts['filters'] = "section_id = 9";
$opts['filters'] = "PMEtable0.sessions_count > 200";
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
        e.g.: 'mailto:$value', 'http://$value' or '$page?stuff';
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

$opts['fdd']['id'] = array(
    'name'     => 'ID',
    'select'   => 'T',
    'options'  => 'AVCPDR', // auto increment
    'maxlen'   => 4,
    'default'  => '0',
    'sort'     => true
);
$opts['fdd']['StartDate'] = array(
    'name'     => 'Start Date',
    'select'   => 'T',
    'maxlen'   => 8,
    'required' => true,
    'sort'     => true,
    'default'  => 'YYYYMMDD'
);
$opts['fdd']['EndDate'] = array(
    'name'     => 'End Date',
    'select'   => 'T',
    'maxlen'   => 8,
    'required' => true,
    'sort'     => true,
    'default'  => 'YYYYMMDD'
);
$opts['fdd']['Artist'] = array(
    'name'     => 'Artist',
    'select'   => 'T',
    'maxlen'   => 255,
    'required' => true,
    'sort'     => true
);
$opts['fdd']['Album'] = array(
    'name'     => 'Album',
    'select'   => 'T',
    'maxlen'   => 255,
    'required' => true,
    'sort'     => true
);
$opts['fdd']['Label'] = array(
    'name'     => 'Label',
    'select'   => 'T',
    'maxlen'   => 255,
    'required' => true,
    'sort'     => true
);
$opts['fdd']['Description'] = array(
    'name'     => 'Description',
    'select'   => 'T',
    'maxlen'   => 255,
    'required' => false,
    'sort'     => true
);
$opts['fdd']['URL'] = array(
    'name'     => 'URL (e.g. http://www.google.com/)',
    'select'   => 'T',
    'maxlen'   => 255,
    'required' => false,
    'sort'     => false,
    'strip_tags' => true
);
$opts['fdd']['cover'] = array(
    'name'     => 'Image',
    'select'   => 'T',
    'maxlen'   => 255,
    'required' => false,
    'sort'     => false,
    'strip_tags' => true
);
$opts['fdd']['Archived'] = array(
  'name'     => 'Archived?',
  'select'   => 'T',
  'maxlen'   => 1,
  'required' => true,
  'sort'     => true,
  'values'   => array('N','Y')
);

// Now important call to phpMyEdit
require_once '../edit/phpMyEdit.class.php';
new phpMyEdit($opts);

?>
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

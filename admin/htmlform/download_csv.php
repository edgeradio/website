<?php
// File: download_csv.php
// Author: HTMLForm.com


// Loading Gladius DB library
include '../resources/db/gladius.php';

// Reading form configuration file
$ini_array = parse_ini_file("form_config.ini",true);

// Setting Gladius DB connection
$G = new Gladius();
$G->SetDBRoot(dirname(__FILE__).'/db/');

// Setting Gladius DB database
$db_name = $ini_array['general']['db_name'];
$G->SelectDB($db_name) or die($G->errstr);

// Setting Gladius DB table 
$table_name = $ini_array['general']['table_name'];

// Query
$query = "select * from ".$table_name;
$rs = $G->Query($query);
$data = $rs->GetArray();


// Checking user password for data
$password = "somepassword";
if (!(isset($ini_array['general']['password']) && $ini_array['general']['password']!="") || md5($_POST['txtPassword']) == $ini_array['general']['password']  ) {

// Exporting Array to CSV format
outputCSV($data,$ini_array );

} else { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>HTML form: export to CSV</title>
<link rel="stylesheet" type="text/css" href="../resources/css/validform.custom.css">
<style>

	body
		{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		background-color:#f4f4f4;
		}
		
		
</style>
</head>

<body>
	<h1>Security code to access your data</h1>


	<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    
		<p><label for="txtpassword">Password:</label>

		<br /><input type="password" title="Enter your password" name="txtPassword" /></p>

		<p><input type="submit" name="Submit" value="Login" /></p>

	</form>
</body>
</html>
<?php } 


// Function that exports data Array to CSV format
function outputCSV($data, $ini_array) {


    // deliver header
    header("Content-Type: text/csv; charset=unicode");
    header("Content-Disposition: inline; filename=\"" . $ini_array['general']['db_name']."_data.csv" . "\"");

    // print out document to the browser
    $r=0;
	foreach ($data as $row) {
		$line="";
		$fields="";
		$c=0;
		foreach($row as $label => $value) {
			
			
			$fields.= ($c)?str_replace('|', ';', escape_csv_value(str_replace('"', ' ',html_entity_decode($ini_array['labels'][$label],ENT_QUOTES)))).";":"id;";
			$line.= str_replace('::', ';', escape_csv_value(utf8_decode($value))).";";
			$c+=1;
		}
		
		if ($r==0) { echo $fields."\n"; }
		echo $line."\n";
		$r+=1;
	}
	
	

}


function escape_csv_value($value) {
	$value = str_replace('"', '""', $value); // First off escape all " and make them ""
	if(preg_match('/;/', $value) or preg_match("/\n/", $value) or preg_match('/"/', $value)) { // Check if I have any commas or new lines
		return '"'.$value.'"'; // If I have new lines or commas escape them
	} else {
		return $value; // If no new lines or commas just return the value
	}
}

?>
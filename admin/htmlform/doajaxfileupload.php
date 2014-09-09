<?php
// File: doajaxfileupload.php
// Author: HTMLForm.com

	$error = "";
	$msg = "";
	$fileElementName = $_GET['id'];
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
				
		}
		
	}elseif(empty($_FILES[$_GET['id']]['tmp_name']) || $_FILES[$_GET['id']]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			
						
			if (!file_exists("./uploads")) {
				mkdir("./uploads");
			}
			if (!file_exists("./uploads/".$_GET['id'])) {
				mkdir("./uploads/".$_GET['id']);
			}
			$prefix="";
			while(file_exists("./uploads/".$_GET['id']."/".$prefix.$_FILES[$_GET['id']]['name'])) {
				$prefix="ref".dechex(rand(1,65536))."_";
			}
			copy($_FILES[$_GET['id']]['tmp_name'],"./uploads/".$_GET['id']."/".$prefix.$_FILES[$_GET['id']]['name']);
			$msg .= " " . $prefix.$_FILES[$_GET['id']]['name'] . ", ";
			$msg .= " " . @filesize($_FILES[$_GET['id']]['tmp_name'])." bytes";
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "'\n";
	echo "}";
?>
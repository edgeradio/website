<?php
// File: form_processor.php
// Author: HTMLForm.com


// Loading Gladius DB library
include '../resources/db/gladius.php';

// Reading form configuration file
$ini_array = parse_ini_file("form_config.ini",true);

// If email notification activated....?
if(isset($ini_array['general']['send_email']) && $ini_array['general']['send_email'] && isset($ini_array['general']['email_account']) && $ini_array['general']['email_account']) {


// Composing message and header
    $form_name ="";
    if (isset($ini_array['general']['form_name'])) {
	$form_name  = $ini_array['general']['form_name'];
	} else {
	$form_name  = $ini_array['general']['form_id'];
	}
    $form_name = "HTMLform.com notification: ".$form_name;
    //*** HTML body of the email.
    $strMessage = "<html><head><title>".$form_name."</title></head><body>";
    $strMessage .= valuesAsHtml($ini_array,false,$form_name,"A new entry has been sent");
    $strMessage .= "</body></html>";

    //*** Mail headers.
    $strHeaders = "MIME-Version: 1.0\r\n";
    $strHeaders .= "Content-type: text/html; charset=utf-8\r\n";
    if(isset($ini_array['general']['from_account'])){
	$strHeaders .= "From: ".$ini_array['general']['from_account']." \r\n";
	$strHeaders .= "Reply-To: ".$ini_array['general']['from_account']." \r\n";
    } else {
	$strHeaders .= "From: ".$ini_array['general']['email_account']." \r\n";
	$strHeaders .= "Reply-To: ".$ini_array['general']['email_account']." \r\n";
    }
    


    // Sending mail    
    mail($ini_array['general']['email_account'], html_entity_decode($form_name,ENT_QUOTES).": new entry submitted", $strMessage, $strHeaders);
	

}






// Writting data in database
insertValues($ini_array);

// Processing confirmation message or redirecting to URL
if(isset($ini_array['general']['confirmation_message']) && $ini_array['general']['confirmation_message']) {
   	
   	//*** Set the output to a friendly thank you note.
   	$strOutput = $ini_array['general']['confirmation_message'];
	$redirectURL = "";
	} else {
		if(isset($ini_array['general']['redirect_url']) && $ini_array['general']['redirect_url']) {
			//header("Location: ".$ini_array['general']['redirect_url']);
			$strOutput = "";
			$redirectURL = $ini_array['general']['redirect_url'];
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>HTML Form</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="../resources/css/validform.custom.css" />
<?php if(!$redirectURL) { ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<style>
<?php 
echo "form.validform fieldset.main_fieldset {".(($ini_array['general']['hide_border'] == 'on')?'border:0px;':'')."}\n"; ?>

</style>
<?php } ?>
</head>
<body style="margin:0px">
<?php if($redirectURL) { ?>
    <script type="text/javascript">
	<?php if($ini_array['general']['open_url_within_frame'] == 'on') { ?>
	    window.location.href="<?php echo $ini_array['general']['redirect_url']; ?>";
	<?php } else { ?>
	    top.location.href="<?php echo $ini_array['general']['redirect_url']; ?>";
	<?php } ?>
    </script>
<?php } else { ?>
<?php echo '<form class="validform"><fieldset class="main_fieldset"><span class="confirmation_message">'.$strOutput.'</span><center><img height="128" width="128" src="../resources/images/dialog-ok-bw.png"/></center></fieldset><form>' ?>

        <script type="text/javascript">
		function resizeParentIframe() {

			try{

				parent.document.getElementById('myiframe_<?php echo $ini_array['general']['form_id'];?>').style.height = (document.body.clientHeight+10)+'px';

				parent.document.getElementById('myiframe_<?php echo $ini_array['general']['form_id'];?>').style.width = document.body.clientWidth+'px';

			}

			catch(error) {}

		}

            // Create the tooltips only on document load
            $(document).ready(function() 
            {
            
<?php if($_GET['disableresizing']!='1') { ?>
            resizeParentIframe();
<?php } ?>            
            });
        </script>
<?php } ?>
</body>
</html>


<?php 
// Function that format fields data as HTML code

function get_file_name($element) {

return(($_GET[$element.'_name'])?'/uploads/'.$element.'/'.ltrim($_GET[$element.'_name']):$_GET[$element]);
}

function valuesAsHtml($values, $hideEmpty = FALSE,$form_name,$subject) {
		$strOutput = "<p>".$form_name.".<br/> ".$subject.":</p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		
		$strOutput .= "<br/><b>Fields:</b><br/><br/>";
		
		$strOutput .= "This is a free form. You must register a Plus Account to receive detailed information via email for each new entry.<br>";
		$strOutput .= "Access your data report (as mentioned in http://htmlform.com/how-to-install-your-html-form) to get a detailed list of all the entries.<br><br>";
		
		$strOutput .= "Would you like to create great forms for your websites? Get all the details about our Plus Accounts here:<br>";
		$strOutput .= "http://htmlform.com/plans-and-pricing<br><br>";
		$strOutput .= "Best Regards<br><br>--------------------------------<br>HTMLform.com<br>Easily build your HTML form now.<br>http://htmlform.com";
		
		
		$strOutput .= "</table>";
		
		return $strOutput;		

}


// Function that save data to database
function insertValues($values) {


	$G = new Gladius();
	$G->SetDBRoot(dirname(__FILE__).'/db/');
	$db_name = $values['general']['db_name'];
	$table_name = $values['general']['table_name'];
	$insert_row = "insert into ".$table_name." ";
	$fields = "";
	$data = "";

	foreach ($values['labels'] as $element => $label) {	
			$strSet = "";
			$strValue = get_file_name($element);
		    
			if (is_array($strValue)) {
					$strSet_text = "";
					$vlist=array();
					foreach ($strValue as $option) {
						$vlist[htmlentities($option,ENT_QUOTES, "UTF-8")]=1;
					}
					$llist=array();
					$pair=array();
					$llist=explode(" | ",rtrim(ltrim($label)));
					foreach($llist as $l) {
						$pair=explode(":",$l);
						if(isset($vlist[$pair[1]])) {
							$strSet_text .= "1::";
						} else {
							$strSet_text .= "0::";
						}
					}
					$strSet_text = substr($strSet_text, 0, strlen($strSet_text)-2);
			
					
					$data .= (($data!="")?",":"")."'".$strSet_text."'";
					$fields .= (($fields!="")?",":"").$element;
			}
			else {
					if ($strValue!="") {
						$strSet_text = $strValue;
						$fields .= (($fields!="")?",":"").$element;
						$data .= (($data!="")?",":"")."'".str_replace("'","''",$strSet_text)."'";
					}

			}
	}
	if($fields) {
	$fields ="(".$fields.",ip,datetime)";
	$data ="values(".$data.",'".getenv('REMOTE_ADDR')."','".date( "d/m/Y h:m:s", time() )."')";
	$insert_row .= $fields." ".$data;
	
	$rs = $G->Query('USE '.$db_name);  
	$rs = $G->Query($insert_row);  		
	}	
}		

?>

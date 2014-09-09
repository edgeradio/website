<?php
// File: list_data.php
// Author: HTMLForm.com

function humanize_filesize($size) {
    $units = explode(' ','B KB MB GB TB PB');
    
    for ($i = 0; $size > 1024; $i++) $size /= 1024;

    return round($size, 2) . ' ' . $units[$i];
}


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

// Query register count
$query = "SELECT COUNT(*) FROM ".$table_name;;
$rs = $G->Query($query);
$result = $rs->getArray();
$counter = $result[0][0];

// Query data
$query = "select * from ".$table_name;
$rs = $G->Query($query);
$data = $rs->GetArray();
$view = array();


// Dumping data to an Array
$numrows = sizeof($data);
$datadesc = array();


// Formating as HTML table in two Arrays: headers and lines

	$datadesc = array_reverse($data);
	$length = array();
	$headers="";
	$lines = "";
	$r=1;
	
	
	foreach ($data as $row) {
		$line="";
		$headers="";
		$c=0;
		foreach($row as $label => $value) {
			

			
			if ($r<=250) {
				if($ini_array['types'][$label]=="radio" || $ini_array['types'][$label]=="checkbox") {
					$values_selected = "";
					$possible_values = explode(" | ",rtrim(ltrim($ini_array['labels'][$label])));
					$result = explode('::',$value);
					$i=0;
					foreach($result as $selection) {
						if((int)$selection) {
						   $concat = explode(':',$possible_values[$i]);
						   $values_selected.= $concat[1]." | ";	
						}
						$i+=1;
					}
					$values_selected = substr($values_selected, 0, strlen($values_selected)-2);
					$line.= "<td>".$values_selected."</td>";
				} else if ($ini_array['types'][$label] == 'fileupload') {
                    $_value = explode(',', $value);
                    $fileupload_value = array('path' => trim($_value[0]),
                                              'size' => trim($_value[1]));

                    if ($fileupload_value['size'] > 0) {
                        $line .= sprintf('<td><a class="viewfile-link" target="_blank" href="#here" title="#file">%s</a> (%s)</td>',                                     
                                     $fileupload_value['path'],
                                     humanize_filesize($fileupload_value['size']));
                                     $value=sprintf('%s (%s)',                                     
                                     $fileupload_value['path'],
                                     humanize_filesize($fileupload_value['size']));
                    } else {
                        $line .= '<td>No File</td>';
                    }
                } else 	if($ini_array['types'][$label]=="agreement") {
						$line.= "<td>".(($value=='1')?'yes':'no')."</td>";
					} else {
					$line.= "<td>".$value."</td>";
					}
				if (strlen($value) > $length[$c]) {
					$length[$c] = strlen($value);
				}
				if ($length[$c] > 50) {
					$length[$c] = 50;
				}
			
				$headers = $headers."<th width=\"".($length[$c]*6)."\">";
				$label = (($c)?$ini_array['labels'][$label]:"id");
				$headers = $headers.$label;
				$headers = $headers."</th>";
				if (strlen($label) > $length[$c]) {
					$length[$c] = strlen($label);
				}			
						
				$c+=1;
			}
		}
		$headers = '<th class="actions" width="100">Actions</th>' . $headers;
		if ($r<=250) {
			$actions = '<td class="actions-column">' .
                       '<a href="" title="View data" class="view-link"><img  class="textmiddle" src="../resources/images/icons/information.png" /> View  </a>'.
                       '<a href="delete_entry.php?id=' . $row['id'] . '" title="Delete entry" class="delete-link"><img  class="textmiddle" src="../resources/images/icons/delete.png" /> Delete</a></td>';

			$lines .= "<tr id=\"entry-${row['id']}\">".$actions.$line."</tr>";
			
		}
		$r+=1;
	}	
	$headers = "<tr>".$headers."</tr>"; 


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>HTML form: list your data</title>

<link rel="stylesheet" type="text/css" href="http://htmlform.com/form_builder/htmlform_files/htmlformgrid/css/htmlformgrid/htmlformgrid.css">
<link rel="stylesheet" type="text/css" href="../resources/css/validform.custom.css">
<link rel="stylesheet" href="../resources/libraries/tufte/tufte-graph.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="http://htmlform.com/form_builder/htmlform_files/htmlformgrid/htmlformgrid.js">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.7.1/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script> 

<style>

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        background: #f4f4f4;
        width: 1024px;
    }
		
    h1, h2 {
        margin: 15px 0;
    }

    dl#form-info dt {
        font-weight: bold;
    }

    dl#form-info dt:after {
        content: ':';
    }

    dl#form-info dd {
        padding-left: 30px;
    }

    .tip {
        background: #f9f2bb;
        border: solid 1px #d6cb6f;
        color: #393939;
        margin: 10px 0;
        padding: 10px;
        font-size: 0.9em;
    }

    .tip.important {
        color: red;
    }

    /* stats */
    .plot {
        margin-bottom: 10px;
        width: 510px;
        display: inline-block;
        float: left;
    }

    .plot .chart-type-selector {
        font-size: 0.8em;
        text-transform: uppercase;
        margin: 5px 15px;
        text-align: center;
        display: block;
    }

    .plot .chart-type-selector a {
        padding: 2px 5px;
        margin: 0 5px;
        background: #ddd;
    }

    .plot .chart-type-selector a.selected {
        background: #aaa;
        color: #fff;
    }
    
    /* stats > range selector */
    #stats .range-selector {
        background: #ddd;
        padding: 10px 20px;
        margin-bottom: 20px;
        font-size: 90%;
        text-transform: uppercase;
        border-top: solid 1px #ccc;
        border-bottom: solid 1px #bbb;
    }

    #stats .range-selector span.desc {
        font-weight: bold;
        margin-right: 15px;
        color: #000;
    }

    #stats .range-selector span {
        color: #696969;
        margin-left: 10px;
        margin-right: 10px;
    }

    #stats .range-selector a.reset {
        margin-left: 20px;
    }
    


    .flexigrid div.fbutton .add {
        background: url(css/images/add.png) no-repeat center left;
    }

    .flexigrid div.fbutton .delete {
        background: url(css/images/close.png) no-repeat center left;
    }

        
	
    .textmiddle {vertical-align:middle; border:0px;}
	
    .ui-dialog-title {font-size:18px; border:none;}
	
    .ui-dialog-titlebar {border:none;}
	
    .ui-widget-header {background-color:#f2f2f2;}
		
</style>

	
</head>

<body style="background:#fbfbfb;">



<?php

// Define your username and password

$password = "somepassword";
if (!(isset($ini_array['general']['password']) && $ini_array['general']['password']!="") || md5($_POST['txtPassword']) == $ini_array['general']['password']  ) {


?>

	<iframe src="http://www.htmlform.com/frame_top.php?id=<?=$ini_array['general']['form_id'] ?>&mode=standalone" width=1024 height=125 frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
	<hr>
	
	<table><tr><td>
	<div class="vf__description" style="width: 1024px; margin-top: 20px;">
	<span style="font-size: large;">
                                    <span style="font-family: arial,helvetica,sans-serif;">
	<h1>HTMLform.com Data Query Tool</h1><br/>
	<p>Form ID: <?php echo $ini_array['general']['form_id']; ?></p>
	<p>Form Name: <?php echo $ini_array['general']['form_name']; ?></p><br/>
	<p>Number of records: <?php echo $numrows; ?></p><br/>
	</span></span>
 

    	<div class="tip important">
        <p style="color:red; font-family:Helvetica; font-size:18px;"><strong>This is a free form. You can only manage 5 records. CSV exporting is not allowed.</strong></p>
    	</div><br/>                                   
                                    </span>
                                </span>	

	</div>
	</td></tr></table>
        
	<table class="flexme1">
	<thead>

    		
			<?php echo $headers; ?>
            
	</thead>

	<tbody>
 			<?php echo $lines; ?>
	</tbody>
	</table><br/><br/>
    <div class="tip">
        <h3>How to read the data</h3>
        <p>The records are listed in chronological order, most recent first.</p>
        <p><strong>id</strong>: record ID.</p>  
        <p><strong>IP</strong>: the IP address from which the data was entered.</p>
        <p><strong>Datetime</strong>: Date and time of data entered.</p>
    </div>

    <div class="tip">
        <h3>About the CSV file</h3>
    <p><strong>Multiple choice data</strong> (checkboxes, radio buttons): "1" means "selected" and "0" means "not selected". </p>
    <p>Example: A column with the label "Your opinion: good | Your opinion: bad"  corresponds to a radio button type field with two possible values "good" and "bad". The data "1::0" means "good" selected, and "0::1" means "bad" selected.  </p>
    <p>We use "1" and "0" instead of "selected" and "unselected" because when you export data to CSV and use a spreadsheet it is easier to summarize them.</p>

    </div>
	
    <br/>

	    <!-- standard page dialogs -->
	<div id="delete-confirm-dialog" title="Delete entry?" style="display: none;">
        <p>This feature is only available for Plus Accounts.</p>
	</div>

	<div id="entry-view-dialog" title="View entry" style="display: none; margin-top:20px; ">
        <p>This feature is only available for Plus Accounts.</p>
	</div>

	<div id="file-view-dialog" title="View file" style="display: none; margin-top:20px; ">

        <p>This feature is only available for Plus Accounts.</p>
        <p>Your file is stored in the given path under your installation path.</p>
	</div>

	<script type="text/javascript">


			$('.flexme1').flexigrid			(
			{
			usepager: true,
			title: '<?php echo $ini_array['general']['form_name'] ?>',
			useRp: true,
			rp: 15,
			showTableToggleBtn: false,
			width: 1024,
			height: 175
			}
			);
			// Handle view/delete links

			$('.viewfile-link').live('click', function(e) {
				e.preventDefault();

			

		

			 $('#file-view-dialog').dialog('open');
			});


			$('.view-link').live('click', function(e) {
				e.preventDefault();

			

		

			 $('#entry-view-dialog').dialog('open');
			});

			$('.delete-link').live('click', function(e) {
			  e.preventDefault();
			   // close the view dialog if open
			   $('#entry-view-dialog').dialog('close');
			   $('#delete-confirm-dialog').data('delete-url', $(this).attr('href'))
                                           .dialog('open');
			 });

			$('#delete-confirm-dialog').dialog({
			    resizable: false,
			    autoOpen: false,
			    modal: true,
		            width:550 		
			    
			});

			$('#entry-view-dialog').dialog({
				resizable: true,
				autoOpen: false,
				modal: false,
				width:550
				
			});	

			$('#file-view-dialog').dialog({
				resizable: true,
				autoOpen: false,
				modal: false,
				width:550
				
			});					


	
	</script>

<div id="stats">
        <h2>Stats</h2>

        <div class="range-selector">
            <span class="desc">Date Range:</span>
            <span>From</span>
            <input disabled="disabled" type="text" readonly="readonly" class="start hasDatepicker" id="dp1317378797556">
            <span>to</span>
            <input disabled="disabled" type="text" readonly="readonly" class="end hasDatepicker" id="dp1317378797557">
            <input type="button" value="Reset" class="reset">
        </div>

	<p style="color:red; font-family:Helvetica; font-size:18px;"><strong>This feature is only available for Plus Accounts.</strong></p>
</div>

    <script type="text/javascript">
        $(document).ready(function() {
	
        // Stats-range datepickers
        var dates = $('#stats .range-selector .start, #stats .range-selector .end').datepicker({
            dateFormat: 'yy-mm-dd'
        });



        $('#stats .range-selector a.reset').click(function(e) {
            e.preventDefault();
            dates.datepicker('setDate', null);
            $('#stats .range-selector .ok').click();
        });	
	
	
	
	
      });
      </script>
	


	<iframe src="http://www.htmlform.com/frame_bottom.php?id=<?=$ini_array['general']['form_id'] ?>&mode=standalone" width=1024 height=125 frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>

<?php } else { ?>

	<h1>Security code to access your data</h1>

	<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    
	<p><label for="txtpassword">Password:</label>

	<br /><input type="password" title="Enter your password" name="txtPassword" /></p>



	<p><input type="submit" name="Submit" value="Login" /></p>



</form>

<?php } ?>
</body>
</html>

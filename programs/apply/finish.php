<?php include '../../templates/common_start.php'; ?>
<body>
<?php include '../../templates/navbar.php'; ?>
<div id="main_fluid">
  <div id="main_container">
    <div id="left_column">
    
     <div class="roundednew">
	<ul class="border-light">
	 <li style="color: #C0C0C0;">1. Introduction</li>
	 <li style="color: #C0C0C0;">2. Program/Contact Details</li>
	 <li>3. Confirmation</li>
	 </ul>
	 </div>
    <br />
<?php include '../../inc/sidebar.php'; ?>
    </div>
    <div id="two_column">
<div class="rounded">

 <?php
       $db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_content",$db);
 $result = mysql_query("SELECT * FROM programapp_status LIMIT 1",$db);
  while ($myrow = mysql_fetch_array($result)) {
    if($myrow["status"] == 1) {
    
    if($_POST['soo'] == 'Yes' || $_POST['cop'] == 'Yes' || $_POST['true'] == 'Yes') {

    ?>

        <div class="rounded"><h1>All Done!</h1>
        <p><h3>Thanks for submitting your program application to Edge Radio. We're super duper excited to receive your application but please be aware that this is our busiest time of year, it may take up to two weeks to receive a reply.<h3></p>
        </div>
      
      
      </div>
      
      <br />
      
      <div class="rounded">
        <p><h1>Important Information For New Presenters</h1>
        <div><h3>
      
      <?php
       $db = mysql_connect("localhost", "edge_edge", "rAdio_993");
mysql_select_db("edge_content",$db);
 $result = mysql_query("SELECT * FROM programapp_status LIMIT 1",$db);
 
  while ($myrow = mysql_fetch_array($result)) {
    echo $myrow["training"];
    
    
    }
    
    ?>
        </h3></div>
      
      
      </div>
      
      <br />
      
      <div class="rounded">
      <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Here's what you submitted...</div>
<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('cube.png',10,10,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    if($_POST['reapply']) {
    $this->Cell(100,10,'Reapplication: '.$_POST['title'].'',1,0,'C');
    } else {
    $this->Cell(100,10,'Application: '.$_POST['title'].'',1,0,'C');
    }
    // Line break
    $this->Ln(40);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Title:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['title'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Days NOT Available:',0,1);
$pdf->SetFont('Arial','',12);
foreach ($_POST['dayno'] as $value)
$pdf->Cell(0,5,$value,0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Duration:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['duration'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Type Of Program:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['type'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Description:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,stripslashes($_POST['description']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Short Description:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,stripslashes($_POST['short']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Genre:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['genre'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Example Artists Played On Your Show:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,stripslashes($_POST['art']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Target Audience:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,stripslashes($_POST['audience']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'How Will You Promote It?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,stripslashes($_POST['promo']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'What Do You Want To Achieve As A Presenter On Edge Radio?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,stripslashes($_POST['achieve']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'How Will You Meet Edge Radio\'s Aims And Objectives?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,stripslashes($_POST['aimso']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Notes/Comments:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,stripslashes($_POST['notes']),0,1);
$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'PRESENTER 1',0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Full Name:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['fullname'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Role:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['role'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Have They Undertaken Edge Training?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['training'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Date Of Birth:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['dob'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Are They A Student?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['student'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Address:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['ad'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Suburb:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['suburb'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Email Address:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['email'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Home Phone:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['phone'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Mobile Phone:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['mobile'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Special Needs:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,stripslashes($_POST['spec']),0,1);

$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'PRESENTER 2',0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Full Name:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['fullname1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Role:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['role1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Have They Undertaken Edge Training?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['training1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Date Of Birth:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['dob1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Are They A Student?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['student1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Address:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['ad1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Suburb:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['suburb1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Email Address:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['email1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Home Phone:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['phone1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Mobile Phone:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['mobile1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Special Needs:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,stripslashes($_POST['spec1']),0,1);

$pdf->AddPage();

$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'PRESENTER 3',0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Full Name:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['fullname2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Role:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['role2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Have They Undertaken Edge Training?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['training2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Date Of Birth:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['dob2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Are They A Student?',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['student2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Address:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['ad2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Suburb:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['suburb2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Email Address:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['email2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Home Phone:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['phone2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Mobile Phone:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$_POST['mobile2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Special Needs:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,stripslashes($_POST['spec2']),0,1);
$pdfdoc = $pdf->Output("", "S");
?>

        
        	
		<style>
fieldset {
  padding: 1em;
  border: 0px;
  font: 12px sans-serif;
  }
label {
  float:left;
  padding: 5px; 
  width:150px;
  margin-right:10px;
  padding-top:5px;
  text-align:right;
  font-weight:bold;
  }
</style>
		
		<fieldset>

<label for="1">Title</label>
<div id="1" style="padding: 5px; float: left;"><?php echo $_POST['title']; ?></div>
<div style="clear: both;"></div>

<label for="2">Duration of Program</label>
<div id="4" style="padding: 5px; float: left;"><?php echo $_POST['duration']; ?></div>
<div style="clear: both;"></div>

<label for="4">Type Of Program</label>
<div id="4" style="padding: 5px; float: left;"><?php echo $_POST['type']; ?></div>
<div style="clear: both;"></div>

<label for="7">Description</label>
<div id="7" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['description']; ?></div>
<div style="clear: both;"></div>

<label for="10">Short Description</label>
<div id="10" style="padding: 5px; float: left;"><?php echo $_POST['short']; ?></div>
<div style="clear: both;"></div>

<label for="5">Genre</label>
<div id="5" style="padding: 5px; float: left;"><?php echo $_POST['genre']; ?></div>
<div style="clear: both;"></div>

<label for="6">Example Artists Played On Your Show</label>
<div id="6" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['art']; ?></div>
<div style="clear: both;"></div>

<label for="8">Target Audience</label>
<div id="8" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['audience']; ?></div>
<div style="clear: both;"></div>

<label for="9">How Will You Promote It?</label>
<div id="9" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['promo']; ?></div>
<div style="clear: both;"></div>

<label for="9">What Do You Want To Achieve As A Presenter On Edge Radio?</label>
<div id="9" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['achieve']; ?></div>
<div style="clear: both;"></div>

<label for="9">How Will You Meet Edge Radio’s Aims And Objectives?</label>
<div id="9" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['aimso']; ?></div>
<div style="clear: both;"></div>


<br><br><br>

<label for="2">Days You <u>CANNOT</u> Broadcast On</label>
<div id="2" style="padding: 5px; float: left;">
<?php 
foreach ($_POST['dayno'] as $value) {
   echo $value.'<br>';
} ?>
</div>
<div style="clear: both;"></div>


<br><br><br>


<label for="a">Presenter #1: Full Name</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['fullname']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #1: Role</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['role']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #1: Have You Undertaken The Edge Radio Training Course?</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['training']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #1: Date Of Birth</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['dob']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #1: Student?</label>
<div id="a" style="padding: 5px; float: left;"><?php 
echo $_POST['student']; ?></div>
<div style="clear: both;"></div>

<label for="b0">Presenter #1: Address</label>
<div id="b0" style="padding: 5px; float: left;"><?php echo $_POST['ad']; ?></div>
<div style="clear: both;"></div>

<label for="b">Presenter #1: Suburb</label>
<div id="b" style="padding: 5px; float: left;"><?php echo $_POST['suburb']; ?></div>
<div style="clear: both;"></div>

<label for="c">Presenter #1: Email Address</label>
<div id="c" style="padding: 5px; float: left;"><?php echo $_POST['email']; ?></div>
<div style="clear: both;"></div>

<label for="d">Presenter #1: Home Phone</label>
<div id="d" style="padding: 5px; float: left;"><?php echo $_POST['phone']; ?></div>
<div style="clear: both;"></div>

<label for="e">Presenter #1: Mobile Phone</label>
<div id="e" style="padding: 5px; float: left;"><?php echo $_POST['mobile']; ?></div>
<div style="clear: both;"></div>

<label for="6">Presenter #1: Special Needs</label>
<div id="6" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['spec']; ?></div>
<div style="clear: both;"></div>

<br><br><br>


<label for="a">Presenter #2: Full Name</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['fullname1']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #2: Role</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['role1']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #2: Have They Undertaken The Edge Radio Training Course?</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['training1']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #2: Date Of Birth</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['dob1']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #2: Student?</label>
<div id="a" style="padding: 5px; float: left;"><?php 
echo $_POST['student1']; ?></div>
<div style="clear: both;"></div>

<label for="b1">Presenter #2: Address</label>
<div id="b1" style="padding: 5px; float: left;"><?php echo $_POST['ad1']; ?></div>
<div style="clear: both;"></div>

<label for="b">Presenter #2: Suburb</label>
<div id="b" style="padding: 5px; float: left;"><?php echo $_POST['suburb1']; ?></div>
<div style="clear: both;"></div>

<label for="c">Presenter #2: Email Address</label>
<div id="c" style="padding: 5px; float: left;"><?php echo $_POST['email1']; ?></div>
<div style="clear: both;"></div>

<label for="d">Presenter #2: Home Phone</label>
<div id="d" style="padding: 5px; float: left;"><?php echo $_POST['phone1']; ?></div>
<div style="clear: both;"></div>

<label for="e">Presenter #2: Mobile Phone</label>
<div id="e" style="padding: 5px; float: left;"><?php echo $_POST['mobile1']; ?></div>
<div style="clear: both;"></div>

<label for="6">Presenter #2: Special Needs</label>
<div id="6" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['spec1']; ?></div>
<div style="clear: both;"></div>

<br><br><br>


<label for="a">Presenter #3: Full Name</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['fullname2']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #3: Role</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['role2']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #3: Have They Undertaken The Edge Radio Training Course?</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['training2']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #3: Date Of Birth</label>
<div id="a" style="padding: 5px; float: left;"><?php echo $_POST['dob2']; ?></div>
<div style="clear: both;"></div>

<label for="a">Presenter #3: Student?</label>
<div id="a" style="padding: 5px; float: left;"><?php 
echo $_POST['student2']; ?></div>
<div style="clear: both;"></div>

<label for="b2">Presenter #3: Address</label>
<div id="b2" style="padding: 5px; float: left;"><?php echo $_POST['ad2']; ?></div>
<div style="clear: both;"></div>

<label for="b">Presenter #3: Suburb</label>
<div id="b" style="padding: 5px; float: left;"><?php echo $_POST['suburb2']; ?></div>
<div style="clear: both;"></div>

<label for="c">Presenter #3: Email Address</label>
<div id="c" style="padding: 5px; float: left;"><?php echo $_POST['email2']; ?></div>
<div style="clear: both;"></div>

<label for="d">Presenter #3: Home Phone</label>
<div id="d" style="padding: 5px; float: left;"><?php echo $_POST['phone2']; ?></div>
<div style="clear: both;"></div>

<label for="e">Presenter #3: Mobile Phone</label>
<div id="e" style="padding: 5px; float: left;"><?php echo $_POST['mobile2']; ?></div>
<div style="clear: both;"></div>

<label for="6">Presenter #3: Special Needs</label>
<div id="6" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['spec2']; ?></div>
<div style="clear: both;"></div>

<br><br><br>

<label for="9">Notes/Comments</label>
<div id="9" style="width: 500px; padding: 5px; float: left;"><?php echo $_POST['notes']; ?></div>
<div style="clear: both;"></div>


<?php 

$to = "programs@edgeradio.org.au"; 
$from = "noreply@edgeradio.org.au"; 
if($_POST['reapply']) {
$subject = "Program Reapplication: ".$_POST['title'].""; 
} else {
$subject = "New Program Application: ".$_POST['title'].""; 
}
$message = "<p>Please see the attachment below for more info.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
if($_POST['reapply']) {
$filename = "Reapplication - ".$_POST['title'].".pdf";
} else {
$filename = "Application - ".$_POST['title'].".pdf";
}

// encode data (puts attachment in proper format)
$attachment = chunk_split(base64_encode($pdfdoc));

// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "This is a MIME encoded message.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
mail($to, $subject, $body, $headers);
?>


		</fieldset>
		
		<?php
		} else {
		
		echo'   <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">HOLD ON!</div>
        <div style="padding: 20px 0 20px 0; font-size: 24px;" class="title">You need to agree to our aims and objectives, the cbaa codes of practice and agree that your information provided is correct and up to date! Please go back!</div>';
		
		}
		 } else {
		 
		 echo'<div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">Program Applications Are Currently Closed. Sorry.</div>';
		 
		 }
    }
		?>
</div>
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

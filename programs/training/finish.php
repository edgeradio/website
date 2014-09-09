<?php


$paypal_id = $_GET['cm'];

$datb = mysql_connect("localhost", "edge_edge", "rAdio_993");
 mysql_select_db("edge_content", $datb) or die(mysql_error());
 $result = mysql_query("SELECT * FROM training_applications WHERE id = '$paypal_id'") or die(mysql_error());  
 $anyrowsthere = mysql_num_rows($result);


while($row = mysql_fetch_array($result)) {


require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('cube.png',10,10,30);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(100,10,'Training Paid Notice',1,0,'C');
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
$pdf->Cell(0,5,'Name:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$row['name'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Address-1:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$row['address1'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Address-2:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$row['address2'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Suburb:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$row['suburb'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Postcode:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$row['postcode'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Phone:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,$row['phone'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Email:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$row['email'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Presenter Status:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,5,$row['presenter_status'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Program (If One):',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,stripslashes($row['program']),0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Paypal ID:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,$row['paypal_id'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Paypal Email:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,$row['paypal_email'],0,1);
$pdf->Ln(5);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,5,'Amount Paid:',0,1);
$pdf->SetFont('Arial','',12);
$pdf->MultiCell(0,5,$row['paid'],0,1);

$pdfdoc = $pdf->Output("", "S");


$to = "programs@edgeradio.org.au"; 
$from = "noreply@edgeradio.org.au"; 
$subject = "Training Paid: ".$row['name'].""; 
$message = "<p>Please see the attachment below for more info.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "Training Paid ".$row['id'].".pdf";

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


}
?>

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

        <div style="padding: 20px 0 20px 0; font-size: 48px;" class="title">All Done!</div>
        <div style="padding: 20px 0 20px 0; font-size: 24px;" class="title">Thanks for submitting payment for the edge radio training course. We will see you at the dedicated training dates!</div>
      
      
      </div>
      
    


</div>
      <div id="footer">
        <?php include '../../templates/footer.php'; ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../templates/common_end.php'; ?>

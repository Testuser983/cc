<?php
require('fpdf_protection.php');

$cno = $_POST['cno'];
$email = $_POST['email'];
$name = $_POST['name'];
$subject= $_POST['subject'];
$namesfourletter=strtolower(substr($name,0,4));
$pass= $namesfourletter .'@'. $cno;

// Get the uploaded image
// $image = $_FILES['image']['tmp_name'];
$imageName = $_FILES['compfile']['name'];
$imageTmp = $_FILES['compfile']['tmp_name'];
$imageType = $_FILES['compfile']['type'];

$pdf = new FPDF_Protection();
$pdf->AddPage();
// $pdf->SetMargins(20,0,20);
// // Set the font

$pdf->SetFont('Arial','B',32);

// Add the header
$pdf->Cell(0,20,'COMPLAINT REPORT',1,1,'C');
$pdf->Ln(20);


// Set the font for the rest of the content
$pdf->SetFont('Arial','',15);

// // Add the CNO
// $pdf->Cell(60,10,'CNO: '.$cno);
$pdf->Cell(60,10,'COMPLAINT NUMBER:',1,0,'L');
$pdf->Cell(130,10,$cno,1,1,'L');


// // Add the email
// $pdf->Cell(70,10,'Email: '.$email);
$pdf->Cell(60,10,'EMAIL:',1,0,'L');
$pdf->Cell(130,10,$email,1,1,'L');

//add the name
$pdf->Cell(60,10,'NAME:',1,0,'L');
$pdf->Cell(130,10,$name,1,1,'L');

$pdf->SetFont('Arial','',10);
// // Add the name
// $pdf->Cell(90,10,'Name: '.$name);
$pdf->Cell(60,10,'SUBJECT:',0,0,'L');
// $pdf->Cell(60,10,$subject,1,0,'L');
$pdf->MultiCell(130,5,$subject,1);
$pdf->Ln();

$pdf->SetProtection(array('print', 'copy'), 'userpassword', $pass);


if ($imageTmp && exif_imagetype($imageTmp)) {
    // Create a unique name for the image
    $imagePath = 'uploads/' . uniqid() . '_' . $imageName;

    // Move the uploaded image to the desired location
    move_uploaded_file($imageTmp, $imagePath);

    // Add the image to the PDF
    $pdf->Image($imagePath, 30, 150, 80,80);

// Output the PDF
$pdf->Output();
}
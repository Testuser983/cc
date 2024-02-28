<?php
require('fpdf_protection.php');
include('includes/config.php');

$cno = $_POST['cno'];
$email = $_POST['email'];
$name = $_POST['name'];
$subject= $_POST['subject'];
$contactno=$_POST['contactno'];
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

$pdf->SetFont('Arial','U',25);

// Add the header
$pdf->Cell(0,20,'USER INFORMATION',0,1,'C');
$pdf->SetFont('Arial','',15);
$pdf->Cell(40,10,'USERNAME :',0,0,'L');
$pdf->Cell(0,10,$name,0,1,'L');
$pdf->Cell(40,10,'USER PHONE :',0,0,'L');
$pdf->Cell(0,10,$contactno,0,1,'L');

$pdf->Cell(40,10,'EMAIL :',0,0,'L');
$pdf->Cell(0,10,$email,0,1,'L');
$pdf->Ln(10);


$query=mysqli_query($con,"select test.*,category.categoryName as catname from test join category on category.id=test.category where test.complaintNumber='$cno'");
while($arr=mysqli_fetch_array($query))
{
    $regDate=$arr['regDate'];
    $action=$arr['status'];
    $category=$arr['catname'];
    $resDate=$arr['lastUpdationDate'];
    // $d_id=$arr['department'];
}
// $query1=mysqli_query($con,"select fullName from department where id='$d_id'");
// while($arr2=mysqli_fetch_array($query1))
// {
//     $d_name=$arr2['fullName'];
// }


// Set the font for the rest of the content

$pdf->SetFont('Arial','U',25);
$pdf->Cell(0,20,'COMPLAINT INFORMATION',0,1,'C');
$pdf->SetFont('Arial','',15);

// // Add the CNO
// $pdf->Cell(60,10,'CNO: '.$cno);
$pdf->Cell(60,10,'COMPLAINT DATE :',0,0,'L');
$pdf->Cell(130,10,$regDate,0,1,'L');

$pdf->Cell(60,10,'COMPLAINT NUMBER:',0,0,'L');
$pdf->Cell(130,10,$cno,0,1,'L');


// // Add the email
// $pdf->Cell(70,10,'Email: '.$email);
$pdf->Cell(60,10,'MODE OF COMPLAINT:',0,0,'L');
$pdf->Cell(130,10,'ONLINE',0,1,'L');

//add the name
$pdf->Cell(60,10,'ACTION TAKE:',0,0,'L');
$pdf->Cell(130,10,$action,0,1,'L');
$pdf->Cell(60,10,'CATEGORY:',0,0,'L');
$pdf->Cell(130,10,$category,0,1,'L');
$pdf->Cell(60,10,'RESOLVE DATE:',0,0,'L');
$pdf->Cell(130,10,$resDate,0,1,'L');



$pdf->SetFont('Arial','',15);
// // Add the name
// $pdf->Cell(90,10,'Name: '.$name);
$pdf->Cell(60,10,'SUBJECT:',0,0,'L');
// $pdf->Cell(60,10,$subject,1,0,'L');
$pdf->MultiCell(130,5,$subject,0);
$pdf->Ln();

$pdf->SetProtection(array('print', 'copy'), 'userpassword', $pass);


if ($imageTmp && exif_imagetype($imageTmp)) {
    // Create a unique name for the image
    $imagePath = 'uploads/' . uniqid() . '_' . $imageName;

    // Move the uploaded image to the desired location
    move_uploaded_file($imageTmp, $imagePath);

    // Add the image to the PDF
    $pdf->Image($imagePath, 30, 170, 60,60);
   

}
$pdf->Image('logo.png',150,240,30,30);

// Output the PDF
$pdf->Output();
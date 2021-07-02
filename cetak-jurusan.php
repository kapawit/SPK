<?php
	ob_start();
	require ('includes/fpdf/fpdf.php');

	class PDF extends FPDF{
	
		function PDF($orientation='P', $unit='mm', $size='A4'){
		    $this->FPDF($orientation,$unit,$size);
		}
		
		function Header(){
		    $this->SetFont('Times','B',14);
		    $this->Cell(80);
		    $this->Cell(30,10,'LAPORAN JURUSAN',0,0,'C');
		    $this->Ln(20);
		}
		
		function Footer(){
		    $this->SetY(-15);
		    $this->SetFont('Times','',8);
		    $this->Cell(0,10,$this->PageNo(),0,0,'R');
		}
	
}

include './includes/api.php';

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Cell(40,10,'Jurusan',0,0,'L');

$no = 1;
$q = $conn->prepare("SELECT * FROM jurusan");
while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
	# code...
	$pdf->Cell(40,7,''.$no++.'',1,0,'L');
	$pdf->Cell(40,7,''.$data['namasiswa'].'',1,0,'L');
	$pdf->Cell(40,7,''.$data['jurusan'].'',1,0,'L');

	$pdf->ln();
}
$pdf->Output();
?>
<?php ob_start(); 
include './includes/api.php';
include 'includes/header.php';

require ('includes/fpdf/fpdf.php');

$tgl_awal = @$_GET['tgl_awal'];
$tgl_akhir = @$_GET['tgl_akhir'];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Cell(40,10,'Jurusan',0,0,'L');
$pdf->Cell(190,7,$tgl_awal."  Sampai dengan  " .$tgl_akhir,0,0,'C');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(39,7,'______________________________________________________________________________________________________________________________________________________________',0,1,'C');

$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(35,6,'Nama Siswa',1,0);
$pdf->Cell(25,6,'Jurusan',1,0);
$pdf->Cell(70,6,'Tahun Ajaran',1,0);


	// Load file koneksi.php

	$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
	$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

	if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
		// Buat query untuk menampilkan semua data transaksi
		$query = "SELECT * FROM keputusan";

		$label = "Semua Data Siswa";
	}else{ // Jika terisi
		// Buat query untuk menampilkan data transaksi sesuai periode tanggal
		$query = "SELECT * FROM keputusan WHERE (periode BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";

		$tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
		$tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
		$label = 'Periode  '.$tgl_awal.' s/d '.$tgl_akhir;
	}

		
		$sql = $conn->prepare($query); // Eksekusi/Jalankan query dari variabel $query
		$sql->execute(); // Ambil jumlah data dari hasil eksekusi $sql
		$row = $sql->rowCount(); // Ambil jumlah data dari hasil eksekusi $sql

		if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
			while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
				$periode = date('d-m-Y', strtotime($data['periode'])); // Ubah format tanggal jadi dd-mm-yyyy

				echo "<tr>";
                echo "<td>".$data['namasiswa']."</td>";
                echo "<td>".$data['jurusan']."</td>";
                echo "<td>".$data['tahun_ajaran']."</td>";
                echo "</tr>";
			}
		}else{ // Jika data tidak ada
			echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
		}
		
	$pdf->Output();
?>

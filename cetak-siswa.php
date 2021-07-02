<?php
include './includes/api.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cetak Jurusan Jurusan</title>
</head>
<body>

	<center>SMAN 11 Kota Tangerang Selatan</center>
	<center>Data Jurusan Siswa</center>
	<center>Tahun Ajaran</center>

		<?php
			$q = $conn->prepare("SELECT * FROM Jurusan WHERE tahun_ajaran=$tahun_ajaran AND nama=$nama");
			$q->execute();
    		@$data = $q->fetchAll();
		?>

		<?php
			$q = $conn->prepare("SELECT * FROM siswa WHERE nama=$nama");
			$q->execute();
    		@$data = $q->fetchAll();
		?>

	<br/>
	
	<p>Nama :</p>
	<p>Jenis Kelamin :</p>
	<p>Tanggal Lahir :</p>
	<p>Alamat :</p>
	<p>Tahun Masuk :</p>

	<p>Nilai Hasil Perhitungan :</p>
	<p>Keputusan Jurusan :</p>
	<p>Tahun Ajaran :</p>

	<script>
		window.print();
	</script>>

</body>
</html>>
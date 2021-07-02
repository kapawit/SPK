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
	<center>Laporan Jurusan Grafik</center>
	<center>$tahun_ajaran</center>

	<?php
			$no = 1;
			$q = $conn->prepare("SELECT * FROM Jurusan WHERE jurusan=$jurusan AND tahun_ajaran=$tahun_ajaran");
			$q->execute();
    		@$data = $q->fetchAll();
		?>

	<script>
		window.print();
	</script>>

</body>
</html>>
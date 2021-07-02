<?php
include './includes/api.php';
akses_pengguna(array(0, 2));
include 'includes/header.php';
?>
<h5><span class="fas fa-pen"></span> Cetak Surat Keputusan Jurusan Siswa</h5><hr>

<div class="container">
	<div class="col-xs-12 col-sm-6">
					<!--
					-- Input Group adalah salah satu komponen yang disediakan bootstrap
					-- Untuk lebih jelasnya soal Input Group, silahkan buka link ini : http://viid.me/qb4Mup
					-->
					<div class="input-group">
						<!-- Buat sebuah textbox dan beri id keyword -->
						<input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
						&nbsp
						<span class="input-group-btn">
							<!-- Buat sebuah tombol search dan beri id btn-search -->
							<button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>
							<a href="" class="btn btn-warning">RESET</a>
						</span>
					</div>
				</div>
			</div>
			<br>
			
			<!--
			-- Buat sebuah div dengan id="view" yang digunakan untuk menampung data 
			-- yang ada pada tabel siswa di database
			-->
			<table class="table table-bordered table-sm table-striped small">
			    <tr class="text-center">
			        <th>No</th>
			        <th>Nama Siswa</th>
			        <th>Nilai SAW</th>
			        <th>Jurusan</th>
			        <th>Tahun Ajaran</th>
			        <th>Cetak</th>
			       
			</table>
 
<?php include './includes/footer.php';?>
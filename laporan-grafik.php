<?php
include './includes/api.php';
akses_pengguna(array(0, 2));
include 'includes/header.php';
?>
<h5><span class="fas fa-pen"></span> Cetak Laporan Jurusan Grafik</h5><hr>

<div class="container">

  <label class="mr-sm-2" for="Tahun_ajaran">Tahun Ajaran</label>
  <select id="Tahun_ajaran" name="Tahun_ajaran" class="form-control mb-2 mr-sm-2">
            <option value="">-Pilih Tahun-</option>
            <option value="2019/2020">2019/2020</option>
            <option value="2020/2021">2020/2021</option>
  </select>

  <button class="btn btn-primary" onclick="location.href='./cetak-grafik'"><span class="fas fa-print"></span> Cetak</button>
   <button class="btn btn-danger" onclick="location.href='./index'" type=""><span class="fas fa-times"></span> Keluar</button>
</div>
<?php include './includes/footer.php';?>
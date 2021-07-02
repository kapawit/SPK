<?php
include './includes/api.php';
akses_pengguna(array(0, 2));
include 'includes/header.php';
?>
<h5><span class="fas fa-pen"></span> Cetak Laporan Jurusan</h5><hr>

<form action="laporan-jurusan" method="GET">
<div class="container">
 <label class="mr-sm-2" for="jurusan">Jurusan</label>
 <select id="jurusan" name="jurusan" class="form-grup">
            <option value="">-Pilih Jurusan-</option>
            <option value="IPA">IPA</option>
            <option value="IPS">IPS</option>
  </select>

  <label class="mr-sm-2" for="tahun_ajaran">Tahun Ajaran</label>
  <select id="tahun_ajaran" name="tahun_ajaran" class="form-grup">
             <?php
           $mulai = date('Y') - 50;
           for ($i= $mulai ; $i<$mulai + 100; $i++) {
               $sel = $i == date('Y') ? 'selected = "selected"' : '';
               echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
           }
           ?>
         </select>
       </div>
     </form>

   <button class="btn btn-primary" type="submit"><span class="fas fa-print"></span> Cetak</button>
   <button class="btn btn-danger" onclick="location.href='./index'"><span class="fas fa-times"></span> Keluar</button>
</div>
<?php include './includes/footer.php';?> 
<?php
include './includes/api.php';
akses_pengguna(array(0));

if (!empty($_POST)) {
    $pesan_error = array();
    $namasiswa = $_POST['namasiswa'];
    if ($namasiswa=='') array_push($pesan_error, 'Nama Siswa tidak boleh kosong');

    $jenkel = $_POST['jenkel'];
    if ($jenkel=='') array_push($pesan_error, 'Jenis Kelamin tidak boleh kosong');

    $asal_sekolah = $_POST['asal_sekolah'];
    if ($asal_sekolah=='') array_push($pesan_error, 'Asal Sekolah tidak boleh kosong');

    $masuk = $_POST['masuk'];
    if ($masuk=='') array_push($pesan_error, 'Masuk tidak boleh kosong');

    if (empty($pesan_error)) {
        $q = $conn->prepare("INSERT INTO siswa VALUE (NULL, NULL, '$namasiswa', '$jenkel', '$asal_sekolah', '$masuk')");
        $q->execute();
        header('Location: ./data-siswa');
    }
}
include './includes/header.php';
?>
<h5><span class="fas fa-plus-circle"></span> Tambah Data Siswa</h1><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <label class="mr-sm-2" for="namasiswa">Nama Lengkap</label>
    <input id="namasiswa" name="namasiswa" class="form-control mb-2 mr-sm-2" type="text">

    <label class="mr-sm-2" for="jenkel">Jenis Kelamin</label>
    <select id="jenkel" name="jenkel" class="form-control mb-2 mr-sm-2">
            <option value="">-Pilih-</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
    </select>

    <label class="mr-sm-2" for="asal_sekolah">Asal Sekolah</label>
    <input id="asal_sekolah" name="asal_sekolah" class="form-control mb-2 mr-sm-2" type="text">

    <label class="mr-sm-2" for="masuk">Tahun Masuk</label>
    <select id="masuk" name="masuk" class="form-control mb-2 mr-sm-2">
           <?php
           $mulai = date('Y') - 50;
           for ($i= $mulai ; $i<$mulai + 100; $i++) {
               $sel = $i == date('Y') ? 'selected = "selected"' : '';
               echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
           }
           ?>
    </select>
    <button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Tambah</button>
    <button class="btn btn-danger" type="reset" onclick="location.href='./data-siswa'"><span class="fas fa-times"></span> Batal</button>
    <?php if (!empty($pesan_error)) {
        echo '<hr><div class="alert alert-dismissable alert-danger"><ul>';
        foreach ($pesan_error as $x) {
            echo '<li>'.$x.'</li>';
        }
        echo '</ul></div>';
    }
    ?>
</form>
<?php include './includes/footer.php';?>
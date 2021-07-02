<?php
include './includes/api.php';
akses_pengguna(array(0));

if (!empty($_POST)) {
    $pesan_error = array();
    $id = $_POST['id_siswa'];
    
    $namasiswa = $_POST['namasiswa'];
    if ($namasiswa=='') array_push($pesan_error, 'Nama Siswa tidak boleh kosong');

    $jenkel = $_POST['jenkel'];
    if ($jenkel=='') array_push($pesan_error, 'Jenis Kelamin tidak boleh kosong');

    $asal_sekolah = $_POST['asal_sekolah'];
    if ($asal_sekolah=='') array_push($pesan_error, 'Asal Sekolah tidak boleh kosong');

    $masuk = $_POST['masuk'];
    if ($masuk=='') array_push($pesan_error, 'Masuk tidak boleh kosong');

    if (empty($pesan_error)) {
        $q = $conn->prepare("UPDATE siswa SET namasiswa='$namasiswa', jenkel='$jenkel', asal_sekolah='$asal_sekolah', masuk='$masuk' WHERE id_siswa='$id'");
        $q->execute();
        ob_clean();
        header('Location: ./data-siswa');
        }
    } else if (!empty($_GET)) {
    @$id = $_GET['id_siswa'];
    $q = $conn->prepare("SELECT * FROM siswa WHERE id_siswa='$id'");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        $id_siswa = $data[0];
        $namasiswa = $data[2];
        $jenkel = $data[3];
        $asal_sekolah = $data[4];
        $masuk = $data[5];
    } else header('Location: ./data-siswa');
} else header('Location: ./data-siswa');

include './includes/header.php';
?>
<h5><span class="fas fa-pen"></span> Edit Siswa</h1><hr>
<form method="post" class="mx-auto" style="max-width:400px" autocomplete="off">
    <input type="hidden" name="id_siswa" value="<?=$id_siswa?>">

    <label class="mr-sm-2" for="namasiswa">Nama Lengkap</label>
    <input id="namasiswa" name="namasiswa" class="form-control mb-2 mr-sm-2" type="text" value="<?=$namasiswa?>">

    <label class="mr-sm-2" for="jenkel">Jenis Kelamin</label>
    <select id="jenkel" name="jenkel" class="form-control mb-2 mr-sm-2" value="<?=$jenkel?>">
            <option value="">-Pilih-</option>
            <option value="L">Laki - laki</option>
            <option value="P">Perempuan</option>
    </select>

    <label class="mr-sm-2" for="asal_sekolah">Asal Sekolah</label>
    <input id="asal_sekolah" name="asal_sekolah" class="form-control mb-2 mr-sm-2" type="text" value="<?=$asal_sekolah?>">

    <label class="mr-sm-2" for="masuk">Tahun Masuk</label>
    <select id="masuk" name="masuk" class="form-control mb-2 mr-sm-2" value="<?=$masuk?>">
           <?php
           $mulai = date('Y') - 50;
           for ($i= $mulai ; $i<$mulai + 100; $i++) {
               $sel = $i == date('Y') ? 'selected = "selected"' : '';
               echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
           }
           ?>
    </select>

    <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Simpan</button>
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
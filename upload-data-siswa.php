<?php include './includes/api.php'; require_once "./PHPExcel-1.8/Classes/PHPExcel.php";akses_pengguna(array(0));

if (!empty($_FILES)) {
    $eks = explode('.', $_FILES['file']['name']);
    $eks = $eks[count($eks)-1];
    $file = 'tmp/upload/'.random_int(0, 999999999).'.'.$eks;
    move_uploaded_file($_FILES['file']['tmp_name'], $file);

    //baca excel
    $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
    $excelObj = $excelReader->load($file);
    unlink($file);
    $worksheet = $excelObj->getSheet(0);
    $baris_terakhir = $worksheet->getHighestRow();

    //set kolom
    $baris_mulai_data = @$_POST['baris'];
    $nama = @$_POST['nama'];
    $jenkel = @$_POST['jenkel'];
    $tgllahir = @$_POST['tgllahir'];
    $alamat = @$_POST['alamat'];
    $masuk = @$_POST['masuk'];
    
    $q = $conn->prepare("DELETE FROM alternatif");
    $q->execute();

    for ($baris = $baris_mulai_data; $baris <= $baris_terakhir; $baris++) {
        $q = $conn->prepare("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA='$NAMA_DATABASE' AND TABLE_NAME='alternatif'");
        $q->execute();
        $_next_id = @$q->fetchAll()[0][0];
        $_nama = $worksheet->getCell($nama.$baris)->getValue();

        $q = $conn->prepare("INSERT INTO alternatif VALUE (NULL, '$_nama', '$_jenkel', '$_tgllahir', '$_alamat', '$_masuk')"); //insert nama alternatif
        $q->execute();
    }
    header('Location: ./data-siswa');
} else { include './includes/header.php'; ?>
<h5><span class="fas fa-upload"></span> Upload Data Siswa</h5><hr>
<form enctype="multipart/form-data" method="post" id="form-upload-data-siswa">
    <div class="custom-file mb-2 mr-sm-2">
        <input class="custom-file-input" name="file" id="file" required type="file" accept=".xls,.xlsx">
        <label class="custom-file-label" for="file">File Excel</label>
    </div>

    <button class="btn btn-primary" id="upload" type="submit"><span class="fas fa-upload"></span> Upload</button>
</form>
<?php } include './includes/footer.php';?>
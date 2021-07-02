<?php
include './includes/api.php';
akses_pengguna(array(0));
if (!empty($_POST)) {
    $pesan_error = array();
    $nilai = $_POST['nilai'];
    $alternatif = $_POST['alternatif'];
    $kriteria = $_POST['kriteria'];
    
    if (empty($pesan_error)) {
        $q = $conn->prepare("UPDATE nilai_alternatif SET nilai='$nilai' WHERE alternatif='$alternatif' AND kriteria='$kriteria'");
        $q->execute();
        ob_clean();
        header('Location: ./data-alternatif');
    }
} else if(!empty($_GET)) {

    @$alternatif = $_GET['x']; 
    @$kriteria = $_GET['y'];
    $q = $conn->prepare("SELECT * FROM nilai_alternatif WHERE alternatif='$alternatif' AND kriteria='$kriteria'");
    $q->execute();
    @$data = $q->fetchAll()[0];
    if ($data) {
        $nilai = $data[2];
    }else header('Location: ./data-alternatif');

}else header('Location: ./data-alternatif');

include 'includes/header.php';
?>
<h5><span class="fas fa-pen"></span> Edit Nilai Alternatif</h5><hr>
<form method="post"  class="mx-auto" style="max-width:400px" autocomplete="off">

     <input type="hidden" name="alternatif" value="<?=$alternatif?>">
      <input type="hidden" name="kriteria" value="<?=$kriteria?>">
    <label class="mr-sm-2" for="nilai">Nilai</label>
    <input id="nilai" name="nilai" class="form-control mb-2 mr-sm-2" type="number" value="<?=$nilai?>">

    <button class="btn btn-primary" type="submit"><span class="fas fa-save"></span> Simpan</button>
    <button class="btn btn-danger" type="reset" onclick="location.href='./data-alternatif'"><span class="fas fa-times"></span> Batal</button>

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
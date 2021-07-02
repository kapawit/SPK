<?php include './includes/api.php';
akses_pengguna(array(0));
if (!empty($_GET)) {
    @$id = $_GET['id_siswa'];
    $q = $conn->prepare("DELETE FROM siswa WHERE id_siswa='$id'");
    $q->execute();
    header('Location: ./data-siswa');
} else header('Location: ./data-siswa');
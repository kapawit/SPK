<?php include './includes/api.php';
akses_pengguna(array(0));
include './includes/header.php';
?>
<h5><span class="fas fa-table"></span> Data Siswa</h5><hr>
<table class="table table-striped table-bordered table-sm">
    <tr class="text-center">
        <th>No</th><th>Nama Lengkap</th><th>Jenis Kelamin</th><th>Asal Sekolah</th><th>Tahun Masuk</th><th>Pengaturan</th>
    </tr>
    <?php $no=1; foreach (data_siswa() as $x) {
        echo "<tr>";
        echo "<td class=\"text-center\">$no</td>
            <td>{$x[2]}</td>
            <td class=\"text-center\">{$x[3]}</td>
            <td class=\"text-center\">{$x[4]}</td>
            <td class=\"text-center\">{$x[5]}</td>
         
         <td class=\"text-center\">

        <button onclick=\"location.href='./edit-siswa?id_siswa={$x[0]}'\" class=\"btn btn-primary\"><span class=\"fas fa-pen\"></span> Edit</button> 


        <button onclick=\"location.href='./hapus-siswa?id_siswa={$x[0]}'\" class=\"btn btn-danger\"><span class=\"fas fa-trash-alt\"></span> Hapus</button></td>";
        echo '</tr>';
        $no++;
    } ?>
</table>
<button class="btn btn-primary" onclick="location.href='./tambah-siswa'"><span class="fas fa-plus-circle"></span> Tambah Kriteria</button>
<?php include './includes/footer.php';?>
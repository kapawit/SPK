<?php include './includes/api.php';include './includes/header.php';
//akses_pengguna(array(1));
echo '<h5><span class="fas fa-table"></span> Perhitungan Alternatif</h5><hr>';
if (count(data_alternatif()) > 0 & count(data_kriteria()) > 0 & cek_valid_bobot()) {
?>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>No</th><th>Alternatif</th>
        <?php
        foreach (data_kriteria() as $x) echo "<th>{$x[1]}</th>";

        ?>
    </tr>
    <?php $no = 1;
    foreach (data_alternatif() as $x) {
        echo "<tr><td class=\"text-center\">$no</td><td>{$x[1]}</td>";
        foreach (data_kriteria() as $y) {
            $n = nilai_alternatif($x[0], $y[0]);
            echo "<td class=\"p-2\">
                <div class=\"d-flex justify-content-between\">
            $n
                <button onclick=\"location.href='./editnilai-alternatif?x={$x[0]}&y={$y[0]}'\" class=\"btn btn-sm btn-primary\"><span class=\"fas fa-pen\"></span> Edit</button></div></td>";
        }
        echo '</tr>';
        $no++;
    }
    ?>
</table>
<button class="btn btn-primary" onclick="location.href='./proses-data'"><span class="fas fa-radiation"></span> Proses Data</button>
<?php
} else {
    if (count(data_kriteria()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data kriteria kosong</b>, silahkan hubungi Petugas.</div>';
    if (count(data_alternatif()) < 1) echo '<div class="alert alert-dismissable alert-danger"><b>Data alternatif kosong</b>, silahkan hubungi Petugas.</div>';
    if (!cek_valid_bobot()) echo '<div class="alert alert-dismissable alert-danger"><b>Perbadingan bobot kriteria tidak valid</b>, silahkan hubungi Pakar/Ahli.</div>';
}
include './includes/footer.php';?>
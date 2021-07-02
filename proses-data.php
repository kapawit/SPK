<?php include './includes/api.php';
include './includes/header.php';
//akses_pengguna(array(1));?>
<h5><span class="fas fa-radiation"></span> Proses Data</h5><hr>
<h6>Data</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Alternatif</th>
        <?php
        foreach (data_kriteria() as $x) echo "<th>{$x[1]} ({$x[5]})</th>";
        ?>
    </tr>
    <?php
    $data = array();
    foreach (data_alternatif() as $x) {
        echo "<tr><td>{$x[1]}</td>";
        foreach (data_kriteria() as $y) {
            $n = nilai_alternatif($x[0], $y[0]);
            echo "<td>$n</td>";
            $data[$y[0]][$x[0]] = $n;
        }
        echo '</tr>';
    }
    ?>
</table><hr>
<h6>Normalisasi</h6>
<table class="table table-bordered table-sm table-striped small">
    <tr class="text-center">
        <th>Alternatif</th>
        <?php
        foreach (data_kriteria() as $x) echo "<th>{$x[1]} ({$x[3]})</th>";
        ?>
    </tr>
    <?php
    $data_normalisasi = array();
    $data_hasil = array();
    foreach (data_alternatif() as $x) {
        echo "<tr><td>{$x[1]}</td>";
        foreach (data_kriteria() as $y) {
            if ($y[2]==1) $n = nilai_alternatif($x[0], $y[0])/max($data[$y[0]]);
            else $n = min($data[$y[0]])/nilai_alternatif($x[0], $y[0]);
            echo "<td>$n</td>";
            $data_normalisasi[$y[0]][$x[0]] = $n;
            $data_hasil[$x[0]][$y[0]] = $n*$y[3];
        }
        echo '</tr>';
    }
    ?>
</table><hr>
<?php
// var_dump($data_hasil); // data hasil sudha bener
$hasil = array();
foreach (array_keys($data_hasil) as $x) {
    $hasil[$x]=array_sum($data_hasil[$x]);

    if (empty($id_alternatif['$x'])){
            $q = $conn->prepare("INSERT INTO hasil VALUE (NULL, '$x', '$hasil[$x]')");
            $q->execute();

    }if (!empty(['$x'])){
            $q = $conn->prepare("UPDATE hasil SET nilai_saw='$hasil[$x]' WHERE id_alternatif='$x'");
            $q->execute();

    }
} //insert into hasil nilai ke tabel baru, pake kodisi
// var_dump($hasil); // ini udah bener
arsort($hasil);
// var_dump($hasil); // ini udah bener

?>
<h6>Hasil</h6>
<div id="tempat-hasil">
    <table class="table table-bordered table-sm table-striped small">
        <tr class="text-center">
            <th>Rangking</th><th>Alternatif</th><th>Nilai</th>
        </tr>
        <?php
        $no = 1;
        foreach (array_keys($hasil) as $x) {
            $q = $conn->prepare("SELECT * FROM alternatif WHERE id='$x'");
            $q->execute();
            @$data = $q->fetchAll()[0];
            @$nama = $data[1];
            @$id =  $data[0];
            echo "<tr id=\"baris-$id\"><td>$no</td><td>$nama</td><td>{$hasil[$x]}</td></tr>";
            $no++;
        };
        ?>
    </table>
</div>

<?php include './includes/footer.php';?>
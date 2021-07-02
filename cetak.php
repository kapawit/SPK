<?php
include './includes/api.php';
include 'includes/header.php';
akses_pengguna(array(0));
?>
    <!-- <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- <title>Laporan PDF Plus Filter Periode Tanggal</title> -->

    <!-- Include file CSS Bootstrap -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- Include library Bootstrap Datepicker -->
    <link href="libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <!-- Include library Font Awesome (Dibutuhkan Datepicker) -->
    <link href="libraries/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Include File jQuery -->
   <!--  <script src="js/jquery.min.js"></script> -->

    <div style="padding: 15px;">
        <h3 style="margin-top: 0;"><span  class="fas fa-table"></span><b> Cetak Laporan Jurusan</b></h3>
        <hr />

        <form method="GET" action="cetak.php">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label>Masukan Tanggal</label>
                        <div class="input-group">
                            <input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control mb-2 mr-sm-2 tgl_awal datetimepicker-input" placeholder="Tanggal Awal" data-toggle="datetimepicker" data-target=".tgl_awal" autocomplete="off">
                            <!-- <div class="input-group-append mb-2 mr-sm-2">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control mb-2 mr-sm-2 tgl_akhir datetimepicker-input" placeholder="Tanggal Akhir" data-toggle="datetimepicker" data-target=".tgl_akhir" autocomplete="off"> -->
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

            <?php
            if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                echo '<a href="cetak.php" class="btn btn-danger">RESET</a>';
            ?>
        </form>

        <?php
        // Load file koneksi.php

        $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            // Buat query untuk menampilkan semua data transaksi
            $query = "SELECT alternatif.id, alternatif.nama, siswa.jenkel, siswa.asal_sekolah, keputusan.nilaisaw, keputusan.jurusan, keputusan.tahun_ajaran, keputusan.periode 
                FROM keputusan INNER JOIN alternatif ON keputusan.id_alternatif = alternatif.id INNER JOIN siswa ON siswa.namasiswa = alternatif.nama";

            $url_cetak = "print.php";
            $label = "Semua Data Siswa";
        }else{ // Jika terisi
            // Buat query untuk menampilkan data transaksi sesuai periode tanggal
            $query = "SELECT alternatif.id, alternatif.nama, siswa.jenkel, siswa.asal_sekolah, keputusan.nilaisaw, keputusan.jurusan, keputusan.tahun_ajaran, keputusan.periode 
                FROM keputusan INNER JOIN alternatif ON keputusan.id_alternatif = alternatif.id INNER JOIN siswa ON siswa.namasiswa = alternatif.nama WHERE (periode BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";
                
            $url_cetak = "print.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode '.$tgl_awal.' s/d '.$tgl_akhir;
        }
        ?>
        <hr />
        <h4 style="margin-bottom: 5px;"><b>Data Siswa</b></h4>
        <?php echo $label ?><br />

        <div style="margin-top: 5px;">
            <a href="<?php echo $url_cetak ?>" class="btn btn-success">CETAK PDF</a>
        </div>

        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered table-sm table-striped small">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Jurusan</th>
                        <th>Tahun Ajaran</th>
                        <!-- <th>Periode</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = $conn->prepare($query); // Eksekusi/Jalankan query dari variabel $query
                    $sql->execute(); // Ambil jumlah data dari hasil eksekusi $sql
                    $row = $sql->rowCount(); // Ambil jumlah data dari hasil eksekusi $sql

                    if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
                        while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
                            $periode = date('d-m-Y', strtotime($data['periode'])); // Ubah format tanggal jadi dd-mm-yyyy

                            echo "<tr>";
                            echo "<td>".$data['nama']."</td>";
                            echo "<td>".$data['jurusan']."</td>";
                            echo "<td>".$data['tahun_ajaran']."</td>";
                            // echo "<td>".$periode."</td>";
                            echo "</tr>";
                        }
                    }else{ // Jika data tidak ada
                        echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include File JS Bootstrap -->
    <!-- <script src="js/bootstrap.bundle.min.js"></script> -->

    <!-- Include library Moment (Dibutuhkan untuk Datepicker) -->
    <script src="libraries/moment/moment.min.js"></script>

    <!-- Include library Bootstrap Datepicker -->
    <script src="libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Include File JS Custom (untuk fungsi Datepicker) -->
    <script src="js/custom.js"></script>

    <script>
    $(document).ready(function(){
        setDateRangePicker(".tgl_awal", ".tgl_akhir")
    })
    </script>
<?php include './includes/footer.php';?>

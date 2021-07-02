<?php
include './includes/api.php';
akses_pengguna(array(0));
// proses ajax
if (isset($_POST) && !empty($_POST)) {
    if(isset($_POST['jurusan']) && !empty($_POST['jurusan'])) 
    {
        $jurusan = $_POST['jurusan'];

    }
    if(isset($_POST['tahun_ajaran']) && !empty($_POST['tahun_ajaran'])) 
    {
        $tahun = $_POST['tahun_ajaran'];

    }
    if(isset($_POST['target']) && !empty($_POST['target'])) 
    {
        $target = $_POST['target'];
        foreach ($target as $key => $value) {
                $d = $conn->prepare("INSERT INTO jurusan VALUE (NULL, '$value[nama]', '$value[nilai]', '$jurusan','$tahun')");
                $d->execute();
             }
        }

    $response = array(
        'response' => "sukses"
    );
    echo json_encode($response);
    exit();
}

?> 
<?php
include 'includes/header.php';
?>
<div id="result"></div>
<h5><span class="fas fa-pen"></span> Hasil Keputusan</h5><hr>

<form action="" id="hsl" method="POST">
    <div class="container">
       <label class="mr-sm-2" for="jurusan">Jurusan</label>
       <select id="jurusan" name="jurusan" class="form-control mb-2 mr-sm-2">
        <option value="">-Pilih Jurusan-</option>
        <option value="IPA">IPA</option>
        <option value="IPS">IPS</option>
    </select>

    <label class="mr-sm-2" for="Tahun_ajaran">Tahun Ajaran</label>
    <select id="tahun_ajaran" name="tahun_ajaran" class="form-control mb-2 mr-sm-2">
         <?php
           $mulai = date('Y') - 50;
           for ($i= $mulai ; $i<$mulai + 100; $i++) {
               $sel = $i == date('Y') ? 'selected = "selected"' : '';
               echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
           }
           ?>
    </select>
    <br>
    <h5><span class="fas fa-table"></span> Hasil Keputusan</h5><hr>
    <table id="tableLaporan" class="table table-striped table-bordered table-sm">
        <tr class="text-center">
            <th>No</th><th>Nama Lengkap</th><th>Nilai Matematika</th><th>Tes Psikotes</th><th>Nilai IPA</th><th>Nilai IPS</th><th>Nilai SAW</th><th>Check</th>
        </tr>

        <?php $no = 1;
        foreach (alternatif() as $x) {
            echo "<tr class=\"cek\"><td class=\"text-center\">$no</td><td class=\"text-center nama\">{$x[1]}</td>";
            echo "<input name=\"nama\" type=\"hidden\" value=\"{$x[1]}\">";
            foreach (data_kriteria() as $y) {
                $n = nilai_alternatif($x[0], $y[0]);
                echo "<td class=\"text-center\">$n</td>";
                $data[$y[0]][$x[0]] = $n;
            }
            $b = array();
            foreach (hasil() as $y) {
                $dt = explode(" ", $y[2]);
                array_push($b, $dt[0]);
            }
            echo "<td>";
            echo $b[$no - 1];
            echo "</td>";

            echo "<td class=\"text-center\"><input class=\"slct\" type=\"checkbox\" name=\"input[]\" value=\"".$b[$no - 1]."\"></td>";
            echo '</tr>';
            $no++;
        }
        ?>
    </table>

<button class="btn btn-primary" type="submit"><span class="fas fa-plus-circle"></span> Simpan</button>
</form>

<button class="btn btn-danger" type="reset" onclick="location.href='./laporan-keputusan'"><span class="fas fa-times"></span> Batal</button>

</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#hsl').submit(function (e) {
            e.preventDefault()
            const target = []
            let skipFirst = false
            for (let item of $('#tableLaporan')[0].rows) {
                if (!skipFirst) {
                    skipFirst = true
                    continue
                }
                let isSelected = $(item).find(".slct").is(':checked')
                if (isSelected) {
                    target.push({
                        nama: $(item).find(".nama").html(),
                        nilai: Number($(item).find(".slct").val())
                    })
                }
            }
            const data2 = {
                jurusan:  $('#jurusan').val(),
                tahun_ajaran:  $('#tahun_ajaran').val(),
                target: target
            }
            $.ajax({
                type:'POST',
                data : data2,          
                dataType: 'json',
                beforeSend: function() {
                    $("button").attr("disabled",true);
                },
                complete:function() {
                    $("button").attr("disabled",false);                             
                },
                error: function(xhr, status, error) {
                  var err = eval("(" + xhr.responseText + ")");
                  alert(err.Message);
                },
                success:function(r) {
                  alert(r.response)
                  location.reload();
                }
            });
        });
    });
</script>
<?php include './includes/footer.php';?>
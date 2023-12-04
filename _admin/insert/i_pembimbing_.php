<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-2 text-gray-800">Pilih Pembimbing dan Tempat</h1>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php
            $sql_data_praktikan = "SELECT * FROM tb_praktikan ";
            $sql_data_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
            $sql_data_praktikan .= " WHERE tb_praktik.id_praktik = " . $_GET['i'];
            $sql_data_praktikan .= " ORDER BY tb_praktikan.nama_praktikan ASC";
            // echo $sql_data_praktikan;

            $q_data_praktikan = $conn->query($sql_data_praktikan);
            $r_data_praktikan = $q_data_praktikan->rowCount();
            $j_ptkn = $r_data_praktikan;

            if ($r_data_praktikan > 0) {
                $id_jurusan_pdd = "";
                $id_profesi_pdd = "";
                $no = 0;
                while ($d_data_praktikan = $q_data_praktikan->fetch(PDO::FETCH_ASSOC)) {
                    $id_jurusan_pdd = $d_data_praktikan['id_jurusan_pdd'];
                    $id_profesi_pdd = $d_data_praktikan['id_profesi_pdd'];
                    $praktikan_arr[$no]['id_praktikan'] = $d_data_praktikan['id_praktikan'];
                    $praktikan_arr[$no]['id_praktik'] = $d_data_praktikan['id_praktik'];
                    $praktikan_arr[$no]['no_id_praktikan'] = $d_data_praktikan['no_id_praktikan'];
                    $praktikan_arr[$no]['nama_praktikan'] = $d_data_praktikan['nama_praktikan'];
                    $praktikan_arr[$no]['tgl_lahir_praktikan'] = $d_data_praktikan['tgl_lahir_praktikan'];
                    $praktikan_arr[$no]['telp_praktikan'] = $d_data_praktikan['telp_praktikan'];
                    $praktikan_arr[$no]['wa_praktikan'] = $d_data_praktikan['wa_praktikan'];
                    $praktikan_arr[$no]['email_praktikan'] = $d_data_praktikan['email_praktikan'];
                    $praktikan_arr[$no]['kota_kab_praktikan'] = $d_data_praktikan['kota_kab_praktikan'];
                    $no++;
                }

                echo "<pre>";
                // print_r($praktikan_arr);
                // var_dump($praktikan_arr);
                echo "</pre>";
                $j_ptkn = 15;
                $j_kel = ceil($j_ptkn / 7);
                $j_tim = ceil($j_ptkn / $j_kel);
                $j_tim_ = number_format($j_ptkn / $j_kel, 1);
                $j_t = 0;

                echo "$j_ptkn, $j_kel, $j_tim_, $j_tim";

            ?>
                <form method="POST" id="form_pembb_tempat">
                    <?php
                    $y = 0;
                    for ($x = 1; $x <= $j_kel; $x++) {

                        $j_t += $j_tim;
                        echo "j_t : $j_t, j_prkn : $j_ptkn<br>";
                        if ($j_t > $j_ptkn) {
                            $j_tim -= $j_ptkn - ($j_t - $j_tim);
                            // echo "j_t lebih j_ptkn<br>";
                        } else {
                            $j_tim = ceil($j_ptkn / $j_kel);
                            // echo "j_t kurang j_ptkn<br>";
                        }
                        echo "j_tim : $j_tim<br>";
                        if ($x != 1) {
                            if (explode(".", $j_tim_)[1] <= 5) {
                                $j_tim = $j_tim - 1;
                                echo "> 5 explode : " . explode(".", $j_tim_)[1] . "<br>";
                            } elseif (explode(".", $j_tim_)[1] > 5) {
                                $j_tim = $j_tim;
                                echo "> 5 explode : " . explode(".", $j_tim_)[1] . "<br>";
                            }
                        }
                        $z = 1;
                        while ($j_tim >= $z) {
                            $y++;
                            $z++;
                        }
                        $z--;
                        echo "j_tim : $j_tim, z : $z <hr>";
                        // echo "j_kel : $j_kel, x : $x <hr>";
                    }
                    ?>

                    <div id="simpan_praktik_tarif" class="nav btn justify-content-center text-md">
                        <button type="button" name="simpan_praktik" id="simpan_praktik" class="btn btn-outline-success" onclick="simpan_ked()">
                            <!-- <a class="nav-link" href="#tarif"> -->
                            <i class="fas fa-check-circle"></i>
                            Simpan Pembimbing dan Tempat Praktik
                            <i class="fas fa-check-circle"></i>
                            <!-- </a> -->
                        </button>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="jumbotron">
                    <div class="jumbotron-fluid">
                        <div class="text-gray-700">
                            <h5 class="text-center">Data Praktikan Tidak Ada</h5>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
if (isset($_POST['ubah'])) {
    $sql = "UPDATE `tb_praktikan` SET ";
    $sql .= " `nama_praktikan` = '" . $_POST['nama_praktikan'] . "', ";
    $sql .= " `no_id_praktikan` = '" . $_POST['no_id_praktikan'] . "', ";
    $sql .= " `telp_praktikan` = '" . $_POST['telp_praktikan'] . "', ";
    $sql .= " `wa_praktikan` = '" . $_POST['wa_praktikan'] . "', ";
    $sql .= " `email_praktikan` = '" . $_POST['email_praktikan'] . "', ";
    $sql .= " `kota_kab_praktikan` = '" . $_POST['kota_kab_praktikan'] . "', ";
    $sql .= " `tgl_ubah_praktikan` = '" . date('Y-m-d', time()) . "'";
    $sql .= " WHERE id_praktikan  = " . $_POST['id_praktikan'];
    echo $sql;
    $conn->query($sql);
?>
    <script>
        document.location.href = "?praktikan&u=<?= $_GET['u']; ?>";
    </script>
<?php
} elseif (isset($_POST['hapus'])) {
    $sql = "DELETE FROM `tb_praktikan`";
    $sql .= " WHERE id_praktikan  = " . $_POST['id_praktikan'];
    echo $sql;
    $conn->query($sql);
?>
    <script>
        document.location.href = "?praktikan&u=<?= $_GET['u']; ?>";
    </script>
<?php
}
?>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
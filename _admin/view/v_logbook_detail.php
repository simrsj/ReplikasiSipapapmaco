<div class="container-fluid">
    <div class="card shadow mb-4 card-body">
        <div class="row" style="font-size: small;" class="justify-content-center">
            <?php
            try {
                $sql = "SELECT * FROM tb_praktik ";
                $sql .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
                $sql .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd ";
                $sql .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd ";
                $sql .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd ";
                $sql .= " JOIN tb_jurusan_pdd_jenis ON tb_jurusan_pdd.id_jurusan_pdd_jenis = tb_jurusan_pdd_jenis.id_jurusan_pdd_jenis ";
                $sql .= " WHERE status_praktik = 'Y' ";
                $sql .= " AND tb_praktik.id_praktik = " . decryptString($_GET['data'], $customkey);
                $sql .= " ORDER BY tb_praktik.id_praktik DESC";
                $q = $conn->query($sql);
                $d = $q->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $ex) {
            ?>
                <script>
                    alert('<?= $e->getMessage() ?>');
                    document.location.href = '?error404';
                </script>";
            <?php
            }
            ?>
            <div class="col-lg-4 text-center">
                <b class="text-gray-800">INSTITUSI : </b><br><?= $d['nama_institusi']; ?><br>
                <b class="text-gray-800">JURUSAN : </b><br><?= $d['nama_jurusan_pdd']; ?><br>
            </div>
            <div class="col-lg-4 text-center">
                <b class="text-gray-800">PROFESI : </b><br><?= $d['nama_profesi_pdd']; ?><br>
                <b class="text-gray-800">JENJANG : </b><br><?= $d['nama_jenjang_pdd']; ?>
            </div>
            <div class="col-lg-4 text-center">
                <b class="text-gray-800">TANGGAL MULAI : </b><br><?= tanggal($d['tgl_mulai_praktik']); ?><br>
                <b class="text-gray-800">TANGGAL SELESAI : </b><br><?= tanggal($d['tgl_selesai_praktik']); ?>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4 card-body">
        <?php
        try {
            $sql_praktikan = "SELECT * FROM tb_praktik ";
            $sql_praktikan .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
            $sql_praktikan .= " JOIN tb_praktikan ON tb_praktik.id_praktik = tb_praktikan.id_praktik ";
            $sql_praktikan .= " WHERE status_praktik = 'Y' ";
            $sql_praktikan .= " AND tb_praktik.id_praktik = " . decryptString($_GET['data'], $customkey);
            $q_praktikan = $conn->query($sql_praktikan);
        } catch (Exception $ex) {
        ?>
            <script>
                alert('<?= $e->getMessage() ?>');
                document.location.href = '?error404';
            </script>";
        <?php
        }
        $r_praktikan = $q_praktikan->rowCount();
        ?>
        <?php if ($r_praktikan > 0) { ?>
            <?php
            //Kedokteran Residen
            if ($d['id_profesi_pdd'] == 1) include "_admin/view/v_logbook_detail_ked_residen.php";
            //Kedokteran Co-Ass
            else if ($d['id_profesi_pdd'] == 2) include "_admin/view/v_logbook_detail_ked_coass.php";
            ?>
        <?php } else { ?>
            <div class="jumbotron">
                <div class="jumbotron-fluid">
                    <div class="text-gray-700">
                        <h5 class="text-center">Data Praktikan Tidak Ada</h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
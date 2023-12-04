<?php if (isset($_GET['ptkn']) && $d_prvl['r_praktikan'] == "Y") { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Daftar Praktikan</h1>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                try {
                    $sql_praktik = "SELECT * FROM tb_praktik ";
                    $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
                    $sql_praktik .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd ";
                    $sql_praktik .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd ";
                    $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd ";
                    // $sql_praktik .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                    $sql_praktik .= " JOIN tb_jurusan_pdd_jenis ON tb_jurusan_pdd.id_jurusan_pdd_jenis = tb_jurusan_pdd_jenis.id_jurusan_pdd_jenis ";
                    $sql_praktik .= " WHERE tb_praktik.status_praktik = 'Y' ";
                    $sql_praktik .= " AND tb_praktik.status_praktik = 'Y' ";
                    if ($d_prvl['level_user'] == 2) {
                        $sql_praktik .= " AND tb_praktik.id_institusi = " . $d_prvl['id_institusi'];
                    }
                    $sql_praktik .= " ORDER BY tb_praktik.id_praktik DESC";
                    // echo $sql_praktik . "<br>";
                    $q_praktik = $conn->query($sql_praktik);
                } catch (Exception $ex) {
                    echo "<script>alert('-DATA PRAKTIK-');";
                    echo "document.location.href='?error404';</script>";
                }
                $r_praktik = $q_praktik->rowCount();
                ?>
                <?php if ($r_praktik > 0) { ?>
                    <?php while ($d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div id="accordion<?= md5($d_praktik['id_praktik']) ?>">
                            <div class="card mb-3">
                                <div class="card-header align-items-center bg-gray-200">
                                    <div class="row" style="font-size: small;">
                                        <br><br>
                                        <div class="col-md text-center my-auto">
                                            <?php if ($_SESSION['level_user'] == 1) { ?>
                                                <b class="text-gray-800">INSTITUSI : </b><br><?= $d_praktik['nama_institusi']; ?><br>
                                            <?php } ?>
                                            <b class="text-gray-800">GELOMBANG/KELOMPOK : </b><br><?= $d_praktik['nama_praktik']; ?>
                                        </div>
                                        <div class="col-md text-center my-auto">
                                            <b class="text-gray-800">TANGGAL MULAI : </b><br><?= tanggal($d_praktik['tgl_mulai_praktik']); ?><br>
                                            <b class="text-gray-800">TANGGAL SELESAI : </b><br><?= tanggal($d_praktik['tgl_selesai_praktik']); ?>
                                        </div>
                                        <div class="col-md text-center my-auto">
                                            <b class="text-gray-800">JURUSAN : </b><br><?= $d_praktik['nama_jurusan_pdd']; ?><br>
                                            <b class="text-gray-800">JENJANG : </b><br><?= $d_praktik['nama_jenjang_pdd']; ?>
                                        </div>
                                        <div class="col-md text-center my-auto">
                                            <b class="text-gray-800">PROFESI : </b><br><?= $d_praktik['nama_profesi_pdd']; ?><br>
                                            <b class="text-gray-800">JUMLAH PRAKTIKAN : </b><br><?= $d_praktik['jumlah_praktik']; ?>
                                        </div>
                                        <?php
                                        try {
                                            $sql_jumlah_praktik = "SELECT * FROM tb_praktikan ";
                                            $sql_jumlah_praktik .= " WHERE id_praktik = " . $d_praktik['id_praktik'];
                                            // echo $sql_jumlah_praktik . "<br>";
                                            $q_jumlah_praktik = $conn->query($sql_jumlah_praktik);
                                            $r_jumlah_praktik = $q_jumlah_praktik->rowCount();
                                        } catch (PDOException $ex) {
                                            echo "<script>alert('-DATA JUUMLAH PRAKTIK-');";
                                            echo "document.location.href='?error404';</script>";
                                        }
                                        ?>
                                        <?php
                                        if (
                                            $d_praktik['jumlah_praktik'] == $r_jumlah_praktik &&
                                            ($d_praktik['id_profesi_pdd'] == 1 || $d_praktik['id_profesi_pdd'] == 2)
                                            &&
                                            ($d_praktik['status_alasan'] == "Y" || $d_praktik['status_mess_praktik'] == "Y")
                                        ) {
                                        ?>
                                            <div class="col-md text-center my-auto">
                                                <a title="download akun praktikan" class='btn btn-success btn-sm' href="_print/p_akun_praktikan.php?data=<?= encryptString($d_praktik['id_praktik'], $customkey); ?>" download>
                                                    <i class="fa-solid fa-users"></i> Unduh<br>Akun Praktikan
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <!-- tombol aksi/info proses  -->
                                        <div class="col-md my-auto text-center">
                                            <!-- tombol rincian -->
                                            <a class="btn btn-info btn-sm collapsed" data-toggle="collapse" data-target="#rincian<?= md5($d_praktik['id_praktik']); ?>" title="Rincian">
                                                <i class="fas fa-info-circle"></i> Rincian Data
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- collapse data praktikan -->
                                <div id="rincian<?= md5($d_praktik['id_praktik']); ?>" class="collapse" data-parent="#accordion<?= md5($d_praktik['id_praktik']) ?>">
                                    <div class="card-body" style="font-size: medium;">
                                        <?php if ($d_praktik['status_alasan'] == "T") { ?>
                                            <div class="jumbotron text-center">
                                                <div class="jumbotron-fluid">
                                                    <div class="badge badge-danger text-lg ">Alasan Mess Ditolak</div>
                                                </div>
                                            </div>
                                        <?php } elseif ($d_praktik['status_mess_praktik'] == "T" && $d_praktik['status_alasan'] == NULL) { ?>
                                            <div class="jumbotron text-center">
                                                <div class="jumbotron-fluid">
                                                    <div class="badge badge-danger text-lg ">Alasan Mess Belum DiPilih Admin</div>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <?php
                                            $sql_mess_pilih = "SELECT * FROM tb_mess_pilih";
                                            $sql_mess_pilih .= " WHERE id_praktik = " . $d_praktik['id_praktik'];
                                            // echo $sql_mess_pilih . "<br>";
                                            try {
                                                $q_mess_pilih = $conn->query($sql_mess_pilih);
                                                $r_mess_pilih = $q_mess_pilih->rowCount();
                                            } catch (Exception $ex) {
                                                echo "<script> alert('$ex -DATA MESS PILIH-');";
                                                echo "document.location.href='?error404';</script>";
                                            }
                                            ?>
                                            <?php if ($d_praktik['status_mess_praktik'] == 'T' || $r_mess_pilih > 0) { ?>
                                                <!-- data praktikan -->
                                                <div class="text-gray-700 row mb-0">
                                                    <div class="col">
                                                        <h4 class="font-weight-bold">DATA PRAKTIKAN</h4><br>
                                                    </div>
                                                    <?php if ($d_prvl['c_praktikan'] == 'Y') { ?>
                                                        <div class="col-2 text-right">
                                                            <!-- tombol modal tambah praktikan  -->
                                                            <a title="tambah praktikan" class='btn btn-success btn-sm tambah_init<?= md5($d_praktik['id_praktik']); ?>' href='#' data-toggle="modal" data-target="#mi<?= md5($d_praktik['id_praktik']); ?>">
                                                                <i class="fas fa-plus"></i> Tambah Data
                                                            </a>

                                                            <!-- modal tambah praktikan  -->
                                                            <div class="modal text-center" id="mi<?= md5($d_praktik['id_praktik']); ?>" data-backdrop="static">
                                                                <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header h5">
                                                                            Tambah Praktikan
                                                                        </div>
                                                                        <div class="modal-body text-md">
                                                                            <form class="form-data b" method="post" id="form_t<?= md5($d_praktik['id_praktik']); ?>">
                                                                                Foto Formal : <span style="color:red">*</span><br>
                                                                                <img width="100px" height="120px" id="t_fotoout<?= md5($d_praktik['id_praktik']); ?>" class="mb-2" style="width: 100px; height: 120px; background: url(./_img/defaultfoto.png) center center/cover no-repeat;">
                                                                                <br>
                                                                                <div class="custom-file">
                                                                                    <label class="custom-file-label text-xs" for="customFile" id="labelfoto<?= md5($d_praktik['id_praktik']); ?>">Pilih File</label>
                                                                                    <input type="file" class="custom-file-input mb-1" name="t_foto" id="t_foto<?= md5($d_praktik['id_praktik']); ?>" accept=".jpg">
                                                                                    <span class='i text-xs'>Data unggah harus jpg, Maksimal 200 Kb</span><br>
                                                                                    <div class="text-danger b i text-xs blink" id="err_t_foto<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                    <script>
                                                                                        $('#t_foto<?= md5($d_praktik['id_praktik']); ?>').on('change', function(evt) {
                                                                                            //label input
                                                                                            var fileFoto = $(this).val();
                                                                                            fileFoto = fileFoto.replace(/^.*[\\\/]/, '');
                                                                                            if (fileFoto == "") fileFoto = "Pilih File Foto";
                                                                                            $('#labelfoto<?= md5($d_praktik['id_praktik']); ?>').html(fileFoto);

                                                                                            // load Image
                                                                                            var tgt = evt.target || window.event.srcElement,
                                                                                                files = tgt.files;

                                                                                            if (FileReader && files && files.length) {
                                                                                                var fr = new FileReader();
                                                                                                fr.onload = function() {
                                                                                                    document.getElementById('t_fotoout<?= md5($d_praktik['id_praktik']); ?>').src = fr.result;
                                                                                                }
                                                                                                fr.readAsDataURL(files[0]);
                                                                                            }

                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                                No. ID Praktikan (NIM/NPM/NIP) : <span style="color:red">*</span><br>
                                                                                <input type="text" id="t_no_id<?= md5($d_praktik['id_praktik']); ?>" name="t_no_id" class="form-control" placeholder="Isikan No ID" required>
                                                                                <div class="text-danger b i text-xs blink" id="err_t_no_id<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                Nama Siswa/Mahasiswa : <span style="color:red">*</span><br>
                                                                                <input type="text" id="t_nama<?= md5($d_praktik['id_praktik']); ?>" name="t_nama" class="form-control" placeholder="Inputkan Nama Siswa/Mahasiswa" required>
                                                                                <div class="text-danger b i text-xs blink" id="err_t_nama<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                Tanggal Lahir : <span style="color:red">*</span><br>
                                                                                <input type="date" id="t_tgl<?= md5($d_praktik['id_praktik']); ?>" name="t_tgl" class="form-control" required>
                                                                                <div class="text-danger b i text-xs blink" id="err_t_tgl<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                Alamat : <span style="color:red">*</span><br>
                                                                                <textarea id="t_alamat<?= md5($d_praktik['id_praktik']); ?>" name="t_alamat" class="form-control" rows="2" placeholder="Inputkan Alamat"></textarea>
                                                                                <div class="text-danger b i text-xs blink" id="err_t_alamat<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                No Telepon : <span style="color:red">*</span><br>
                                                                                <input type="number" id="t_telpon<?= md5($d_praktik['id_praktik']); ?>" name="t_telpon" class="form-control" min="1" placeholder="Inputkan No Telpon" required>
                                                                                <div class="text-danger b i text-xs blink" id="err_t_telpon<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                No WhatsApp :<br>
                                                                                <input type="number" id="t_wa<?= md5($d_praktik['id_praktik']); ?>" name="t_wa" class="form-control" min="1" placeholder="Inputkan WhatsApp">
                                                                                <br>
                                                                                E-Mail : <br>
                                                                                <input type="email" id="t_email<?= md5($d_praktik['id_praktik']); ?>" name="t_email" class="form-control" placeholder="Inputkan E-Mail"><br>
                                                                                <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                                                    File Ijazah :<span style="color:red">*</span><br>
                                                                                    <div class="custom-file">
                                                                                        <label class="custom-file-label text-xs" for="customFile" id="labelfileijazah<?= md5($d_praktik['id_praktik']); ?>">Pilih File</label>
                                                                                        <input type="file" class="custom-file-input mb-1" id="t_ijazah<?= md5($d_praktik['id_praktik']); ?>" name="t_ijazah<?= md5($d_praktik['id_praktik']); ?>" accept="application/pdf" required>
                                                                                        <span class='i text-xs'>Data unggah harus pdf, Maksimal 3 Mb</span><br>
                                                                                        <div class="text-xs font-italic text-danger blink" id="err_t_ijazah<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                        <script>
                                                                                            $('#t_ijazah<?= md5($d_praktik['id_praktik']); ?>').on('change', function() {
                                                                                                var fileNameIjazah = $(this).val();
                                                                                                fileNameIjazah = fileNameIjazah.replace(/^.*[\\\/]/, '');
                                                                                                if (fileNameIjazah == "") fileNameIjazah = "Pilih File";
                                                                                                $('#labelfileijazah<?= md5($d_praktik['id_praktik']); ?>').html(fileNameIjazah);
                                                                                            })
                                                                                        </script>
                                                                                    </div>
                                                                                    <br>
                                                                                <?php } ?>
                                                                                File Swab/Sertifikat Vaksin :<br>
                                                                                <div class="custom-file">
                                                                                    <label class="custom-file-label text-xs" for="customFile" id="labelfileswab<?= md5($d_praktik['id_praktik']); ?>">Pilih File</label>
                                                                                    <input type="file" class="custom-file-input mb-1" id="t_swab<?= md5($d_praktik['id_praktik']); ?>" name="t_swab<?= md5($d_praktik['id_praktik']); ?>" accept="application/pdf" required>
                                                                                    <span class='i text-xs'>Data unggah harus pdf, Maksimal 3 Mb</span><br>
                                                                                    <div class="text-xs font-italic text-danger blink" id="err_t_swab<?= md5($d_praktik['id_praktik']); ?>"></div><br>
                                                                                    <script>
                                                                                        $('#t_swab<?= md5($d_praktik['id_praktik']); ?>').on('change', function() {
                                                                                            var fileNameSwab = $(this).val();
                                                                                            fileNameSwab = fileNameSwab.replace(/^.*[\\\/]/, '');
                                                                                            if (fileNameSwab == "") fileNameSwab = "Pilih File";
                                                                                            $('#labelfileswab<?= md5($d_praktik['id_praktik']); ?>').html(fileNameSwab);
                                                                                        })
                                                                                    </script>
                                                                                </div>
                                                                                <br>
                                                                            </form>
                                                                        </div>
                                                                        <div class="modal-footer text-md">
                                                                            <a class="btn btn-danger btn-sm tambah_tutup<?= md5($d_praktik['id_praktik']); ?>" data-dismiss="modal">
                                                                                Kembali
                                                                            </a>
                                                                            &nbsp;
                                                                            <a class="btn btn-success btn-sm tambah<?= md5($d_praktik['id_praktik']); ?>" id="<?= bin2hex(urlencode(base64_encode($d_praktik['id_praktik'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>">
                                                                                Simpan
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <!-- inisiasi tabel data praktikan -->
                                                <div class="loader mt-5 text-center" id="loader<?= md5($d_praktik['id_praktik']); ?>"></div>
                                                <div id="<?= md5("data" . $d_praktik['id_praktik']); ?>"></div>
                                                <script>
                                                    $(document).ready(function() {
                                                        loading_sw2();
                                                        $(function() {
                                                            if (window.location.hash != '') {
                                                                $('.collapse').removeClass('in');
                                                                $(window.location.hash + '.collapse').collapse('show');
                                                            }
                                                        });
                                                        $('#<?= md5("data" . $d_praktik['id_praktik']); ?>')
                                                            .load(
                                                                "_admin/view/v_praktik_praktikanData.php?" +
                                                                "idu=<?= bin2hex(urlencode(base64_encode($_SESSION['id_user'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>" +
                                                                "&idp=<?= bin2hex(urlencode(base64_encode($d_praktik['id_praktik'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>" +
                                                                "&tb=<?= md5($d_praktik['id_praktik']); ?>");
                                                        Swal.close();
                                                    });

                                                    // inisiasi klik modal tambah
                                                    $(".tambah_init<?= md5($d_praktik['id_praktik']); ?>").click(function() {
                                                        loading_sw2();
                                                        $('#err_t_foto<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        $('#err_t_no_id<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        $('#err_t_nama<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        $('#err_t_tgl<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        $('#err_t_alamat<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        $('#err_t_telpon<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                            $('#err_t_ijazah<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        <?php } ?>
                                                        $('#err_t_swab<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                        Swal.close();
                                                    });

                                                    // inisiasi klik modal tambah  tutup
                                                    $(".tambah_tutup<?= md5($d_praktik['id_praktik']); ?>").click(function() {
                                                        $("#form_t<?= md5($d_praktik['id_praktik']); ?>").trigger("reset");
                                                        <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                            $("#file_ijazah<?= md5($d_praktik['id_praktik']); ?>").val("").trigger("change");
                                                        <?php } ?>
                                                        $("#file_swab<?= md5($d_praktik['id_praktik']); ?>").val("").trigger("change");
                                                        $("#t_foto<?= md5($d_praktik['id_praktik']); ?>").val("").trigger("change");
                                                    });

                                                    // inisiasi klik modal tambah simpan
                                                    $(document).on('click', '.tambah<?= md5($d_praktik['id_praktik']); ?>', function() {
                                                        loading_sw2();
                                                        var idp = $(this).attr('id');
                                                        var data_t = $("#form_t<?= md5($d_praktik['id_praktik']); ?>").serializeArray();
                                                        data_t.push({
                                                            name: "idp",
                                                            value: idp
                                                        });
                                                        var t_foto = $('#t_foto<?= md5($d_praktik['id_praktik']); ?>').val();
                                                        var t_no_id = $('#t_no_id<?= md5($d_praktik['id_praktik']); ?>').val();
                                                        var t_nama = $('#t_nama<?= md5($d_praktik['id_praktik']); ?>').val();
                                                        var t_tgl = $('#t_tgl<?= md5($d_praktik['id_praktik']); ?>').val();
                                                        var t_alamat = $('#t_alamat<?= md5($d_praktik['id_praktik']); ?>').val();
                                                        var t_telpon = $('#t_telpon<?= md5($d_praktik['id_praktik']); ?>').val();
                                                        <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                            var t_ijazah = $('#t_ijazah<?= md5($d_praktik['id_praktik']); ?>').val();
                                                        <?php } ?>
                                                        var t_swab = $('#t_swab<?= md5($d_praktik['id_praktik']); ?>').val();

                                                        //eksekusi bila file swab terisi
                                                        if (t_foto != "" && t_foto != undefined) {
                                                            var typeFoto = document.querySelector('#t_foto<?= md5($d_praktik['id_praktik']); ?>').value;
                                                            var getTypeFoto = typeFoto.split('.').pop();

                                                            var fileFoto = document.getElementById("t_foto<?= md5($d_praktik['id_praktik']); ?>").files;
                                                            var getSizeFoto = document.getElementById("t_foto<?= md5($d_praktik['id_praktik']); ?>").files[0].size / 1024;
                                                        }
                                                        <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                            //eksekusi bila file ijazah terisi
                                                            if (t_ijazah != "" && t_ijazah != undefined) {
                                                                var typeIjazah = document.querySelector('#t_ijazah<?= md5($d_praktik['id_praktik']); ?>').value;
                                                                var getTypeIjazah = typeIjazah.split('.').pop();

                                                                var fileIjazah = document.getElementById("t_ijazah<?= md5($d_praktik['id_praktik']); ?>").files;
                                                                var getSizeIjazah = document.getElementById("t_ijazah<?= md5($d_praktik['id_praktik']); ?>").files[0].size / 1024;
                                                            }
                                                        <?php } ?>

                                                        //eksekusi bila file swab terisi
                                                        if (t_swab != "" && t_swab != undefined) {
                                                            var typeSwab = document.querySelector('#t_swab<?= md5($d_praktik['id_praktik']); ?>').value;
                                                            var getTypeSwab = typeSwab.split('.').pop();

                                                            var fileSwab = document.getElementById("t_swab<?= md5($d_praktik['id_praktik']); ?>").files;
                                                            var getSizeSwab = document.getElementById("t_swab<?= md5($d_praktik['id_praktik']); ?>").files[0].size / 1024;
                                                        }

                                                        //cek data from modal tambah bila tidak diiisi
                                                        if (
                                                            t_no_id == "" ||
                                                            t_nama == "" ||
                                                            t_tgl == "" ||
                                                            t_alamat == "" ||
                                                            t_telpon == "" ||
                                                            <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?> getTypeIjazah != 'pdf' ||
                                                                getSizeIjazah > 3072 ||
                                                                t_ijazah == "" ||
                                                                t_ijazah == undefined ||
                                                            <?php } ?>
                                                            //  getTypeSwab != 'pdf' ||
                                                            // getSizeSwab > 256 ||
                                                            // t_swab == "" ||
                                                            // t_swab == undefined
                                                            getTypeFoto != 'jpg' ||
                                                            getSizeFoto > 256 ||
                                                            t_foto == "" ||
                                                            t_foto == undefined
                                                        ) {

                                                            if (t_foto == "" || t_foto == undefined)
                                                                $("#err_t_foto<?= md5($d_praktik['id_praktik']); ?>").html("Foto Harus Dipilih");
                                                            else if (getTypeFoto != "jpg")
                                                                $("#err_t_foto<?= md5($d_praktik['id_praktik']); ?>").html("File Foto Harus jpg");
                                                            else if (getSizeFoto > 256)
                                                                $("#err_t_foto<?= md5($d_praktik['id_praktik']); ?>").html("File Foto Harus Kurang dari 200 Kb");
                                                            else
                                                                $("#err_t_foto<?= md5($d_praktik['id_praktik']); ?>").html("");

                                                            <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                                if (t_ijazah == "" || t_ijazah == undefined)
                                                                    $("#err_t_ijazah<?= md5($d_praktik['id_praktik']); ?>").html("Ijazah Harus Dipilih");
                                                                else if (getTypeIjazah != "pdf")
                                                                    $("#err_t_ijazah<?= md5($d_praktik['id_praktik']); ?>").html("File Ijazah Harus pdf");
                                                                else if (getSizeIjazah > 3072)
                                                                    $("#err_t_ijazah<?= md5($d_praktik['id_praktik']); ?>").html("File Ijazah Harus Kurang dari 200 Kb");
                                                                else
                                                                    $("#err_t_ijazah<?= md5($d_praktik['id_praktik']); ?>").html("");
                                                            <?php } ?>
                                                            // if (t_swab == "" || t_swab == undefined)
                                                            //     $("#err_t_swab<?= md5($d_praktik['id_praktik']); ?>").html("Swab/Serfikat Vaksin Harus Dipilih");
                                                            // else if (getTypeSwab != "pdf")
                                                            //     $("#err_t_swab<?= md5($d_praktik['id_praktik']); ?>").html("Swab/Serfikat Vaksin Harus pdf");
                                                            // else if (getSizeSwab > 256)
                                                            //     $("#err_t_swab<?= md5($d_praktik['id_praktik']); ?>").html("Swab/Serfikat Vaksin Harus Kurang dari 200 Kb");
                                                            // else
                                                            //     $("#err_t_swab<?= md5($d_praktik['id_praktik']); ?>").html("");

                                                            if (t_no_id == "") {
                                                                $("#err_t_no_id<?= md5($d_praktik['id_praktik']); ?>").html("No ID Harus Diisi");
                                                            } else {
                                                                $("#err_t_no_id<?= md5($d_praktik['id_praktik']); ?>").html("");
                                                            }

                                                            if (t_nama == "") {
                                                                $("#err_t_nama<?= md5($d_praktik['id_praktik']); ?>").html("Nama Harus Diisi");
                                                            } else {
                                                                $("#err_t_nama<?= md5($d_praktik['id_praktik']); ?>").html("");
                                                            }

                                                            if (t_tgl == "") {
                                                                $("#err_t_tgl<?= md5($d_praktik['id_praktik']); ?>").html("Tanggal Lahir Harus Dipilih");
                                                            } else {
                                                                $("#err_t_tgl<?= md5($d_praktik['id_praktik']); ?>").html("");
                                                            }

                                                            if (t_alamat == "") {
                                                                $("#err_t_alamat<?= md5($d_praktik['id_praktik']); ?>").html("Alamat Harus Diisi");
                                                            } else {
                                                                $("#err_t_alamat<?= md5($d_praktik['id_praktik']); ?>").html("");
                                                            }

                                                            if (t_telpon == "") {
                                                                $("#err_t_telpon<?= md5($d_praktik['id_praktik']); ?>").html("Telpon Harus Diisi");
                                                            } else {
                                                                $("#err_t_telpon<?= md5($d_praktik['id_praktik']); ?>").html("");
                                                            }

                                                            simpan_tidaksesuai()
                                                        }
                                                        //simpan data tambah bila sudah sesuai
                                                        else {
                                                            $.ajax({
                                                                type: 'POST',
                                                                url: "_admin/exc/x_v_praktik_praktikan_s.php",
                                                                data: data_t,
                                                                dataType: 'JSON',
                                                                success: function(response) {
                                                                    if (response.ket == 'Y') {
                                                                        var data_file = new FormData();
                                                                        var xhttp = new XMLHttpRequest();

                                                                        var fileFoto = document.getElementById("t_foto<?= md5($d_praktik['id_praktik']); ?>").files;
                                                                        data_file.append("t_foto", fileFoto[0]);
                                                                        <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                                            var fileIjazah = document.getElementById("t_ijazah<?= md5($d_praktik['id_praktik']); ?>").files;
                                                                            data_file.append("t_ijazah", fileIjazah[0]);
                                                                        <?php } ?>
                                                                        var fileSwab = document.getElementById("t_swab<?= md5($d_praktik['id_praktik']); ?>").files;
                                                                        data_file.append("t_swab", fileSwab[0]);

                                                                        data_file.append("q", response.q);
                                                                        data_file.append("idpp", response.idpp);
                                                                        data_file.append("profesi", "<?= bin2hex(urlencode(base64_encode(date("Ymd") . "*sm*" . $d_praktik['id_profesi_pdd']))) ?>");
                                                                        data_file.append("idp", idp);

                                                                        xhttp.open("POST", "_admin/exc/x_v_praktik_praktikan_sFile.php", true);

                                                                        xhttp.onload = function() {
                                                                            if (
                                                                                xhttp.response == "<?= bin2hex(urlencode(base64_encode("size"))) ?>" ||
                                                                                xhttp.response == "<?= bin2hex(urlencode(base64_encode("type"))); ?>"
                                                                            ) {
                                                                                simpan_tidaksesuai();
                                                                            } else {
                                                                                console.log("Success");
                                                                                Swal.fire({
                                                                                    allowOutsideClick: true,
                                                                                    // isDismissed: false,
                                                                                    icon: 'success',
                                                                                    html: '<span class="text-lg b">Data Berhasil Tersimpan</span>',
                                                                                    // html: '<a href="?pkd" class="btn btn-outline-primary">OK</a>',
                                                                                    showConfirmButton: false,
                                                                                    backdrop: true,
                                                                                    timer: 5000,
                                                                                    timerProgressBar: true,
                                                                                    didOpen: (toast) => {
                                                                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                                                    }
                                                                                }).then(
                                                                                    function() {
                                                                                        $('#<?= md5("data" . $d_praktik['id_praktik']); ?>')
                                                                                            .load(
                                                                                                "_admin/view/v_praktik_praktikanData.php?" +
                                                                                                "idu=<?= bin2hex(urlencode(base64_encode($_SESSION['id_user'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>" +
                                                                                                "&idp=<?= bin2hex(urlencode(base64_encode($d_praktik['id_praktik'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>" +
                                                                                                "&tb=<?= md5($d_praktik['id_praktik']); ?>");

                                                                                        $('#err_t_no_id<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $('#err_t_nama<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $('#err_t_tgl<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $('#err_t_alamat<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $('#err_t_telpon<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $('#err_t_wa<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $('#err_t_email<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        <?php if ($d_praktik['id_profesi_pdd'] > 0) { ?>
                                                                                            $('#err_t_ijazah<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                            $("#t_ijazah<?= md5($d_praktik['id_praktik']); ?>").val("").trigger("change");
                                                                                        <?php } ?>
                                                                                        $('#err_t_swab<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $('#err_t_foto<?= md5($d_praktik['id_praktik']); ?>').empty();
                                                                                        $("#form_t<?= md5($d_praktik['id_praktik']); ?>").trigger("reset");
                                                                                        $("#t_swab<?= md5($d_praktik['id_praktik']); ?>").val("").trigger("change");
                                                                                        $("#t_foto<?= md5($d_praktik['id_praktik']); ?>").val("").trigger("change");
                                                                                    }

                                                                                );
                                                                            }
                                                                        }
                                                                        xhttp.send(data_file);
                                                                    } else {
                                                                        Swal.fire({
                                                                            allowOutsideClick: true,
                                                                            showConfirmButton: false,
                                                                            icon: 'warning',
                                                                            html: '<div class="text-lg">Mohon Maaf Data Praktikan <br><b>Sudah Penuh</b></div>',
                                                                            timer: 10000,
                                                                            timerProgressBar: true,
                                                                            didOpen: (toast) => {
                                                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                                            }
                                                                        });
                                                                    }
                                                                },
                                                                error: function(response) {
                                                                    console.log(response);
                                                                }
                                                            });
                                                        }
                                                    });
                                                </script>
                                            <?php } else { ?>
                                                <div class="jumbotron">
                                                    <div class="jumbotron-fluid">
                                                        <div class="text-gray-700">
                                                            <h5 class="text-center">Mess Belum Dipilih Admin</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <h3 class='text-center'> Data Pendaftaran Praktikan Anda Tidak Ada</h3>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

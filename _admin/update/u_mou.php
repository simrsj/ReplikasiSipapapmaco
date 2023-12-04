<?php

$exp_arr_id_mou = explode("*sm*", base64_decode(urldecode(hex2bin($_GET['u']))));
$id_mou = $exp_arr_id_mou[1];

try {
    $sql = "SELECT * FROM tb_kerjasama";
    $sql .= " WHERE id = " . $id_mou;

    $q = $conn->query($sql);
    $d = $q->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('- MoU-');";
    echo "document.location.href='?error404';</script>";
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="h3 mb-2 text-gray-800">Ubah Data Kerjasama</h1>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="post" class="form-data text-gray-900" enctype="multipart/form-data" id="form_mou">
                <!-- Nama Institusi, MoU RSJ dan Institusi -->
                <input type="hidden" name="id_mou" id="id_mou" value="<?= $_GET['u']; ?>">
                <div class="row text-center">
                    <div class="col-md-6">
                        Nama Institusi <span style="color:red">*</span><br>
                        <select class="select2-long " name="id_institusi" id="id_institusi" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            try {
                                $sql_institusi = "SELECT * FROM tb_institusi ORDER BY nama_institusi ASC";
                                $q_institusi = $conn->query($sql_institusi);
                            } catch (Exception $ex) {
                                echo "<script>alert('- MoU-');";
                                echo "document.location.href='?error404';</script>";
                            }

                            while ($d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC)) {
                                if ($d['id_institusi'] == $d_institusi['id_institusi']) {
                                    $selected = "selected";
                                } else {

                                    $selected = "";
                                }
                            ?>
                                <option value="<?= $d_institusi['id_institusi']; ?>" <?= $selected; ?>>
                                    <?php
                                    echo $d_institusi['nama_institusi'];
                                    if ($d_institusi['akronim_institusi'] != "") {
                                        echo " (" . $d_institusi['akronim_institusi'] . ")";
                                    }
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-xs font-italic text-danger blink" id="err_id_institusi"></div>
                    </div>
                    <div class="col-md-3">
                        No. PKS RSJ <span style="color:red">*</span><br>
                        <input class="form-control form-control-sm " type="text" name="no_rsj_mou" id="no_rsj_mou" value="<?= $d['no_pks_rsj'] ?>" required>
                        <div class="text-xs font-italic text-danger blink" id="err_no_rsj_mou"></div>
                    </div>
                    <div class="col-md-3">
                        No. PKS Institusi <span style="color:red">*</span><br>
                        <input class="form-control form-control-sm" type="text" name="no_institusi_mou" id="no_institusi_mou" value="<?= $d['no_pks_institusi'] ?>" required>
                        <div class="text-xs font-italic text-danger blink" id="err_no_institusi_mou"></div>
                    </div>
                </div>
                <hr>

                <!-- Tgl Mulai mou,Tgl Selesai mou, Jurusan, profesi, Jenjang-->
                <div class="row text-center">
                    <div class="col-md-2">
                        Tanggal Mulai <span style=" color:red">*</span><br>
                        <input class="form-control form-control-sm" type="date" name="tgl_mulai_mou" id="tgl_mulai_mou" value="<?= $d['tgl_mulai_mou'] ?>" required>
                        <div class="text-xs font-italic text-danger blink" id="err_tgl_mulai_mou"></div>
                    </div>
                    <div class="col-md-2">
                        Tanggal Selesai <span style=" color:red">*</span><br>
                        <input class="form-control form-control-sm" type="date" name="tgl_selesai_mou" id="tgl_selesai_mou" value="<?= $d['tgl_selesai_mou'] ?>" required>
                        <div class="text-xs font-italic text-danger blink" id="err_tgl_selesai_mou"></div>
                    </div>
                    <div class="col-md-3">
                        Jurusan Pendidikan <span style="color:red">*</span><br>
                        <select class="select2" name="id_jurusan_pdd" id="id_jurusan_pdd" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $sql_jurusan = $conn->query("SELECT * FROM tb_jurusan_pdd order by nama_jurusan_pdd ASC");
                            while ($d_jurusan = $sql_jurusan->fetch(PDO::FETCH_ASSOC)) {
                                if ($d['id_jurusan_pdd'] == $d_jurusan['id_jurusan_pdd']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                            ?>
                                <option value="<?= $d_jurusan['id_jurusan_pdd']; ?>" <?= $selected; ?>>
                                    <?= $d_jurusan['nama_jurusan_pdd']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-xs font-italic text-danger blink" id="err_id_jurusan_pdd"></div>
                    </div>
                    <div class="col-md-3">
                        Profesi Pendidikan <span style="color:red">*</span><br>
                        <select class="select2" name="id_profesi_pdd" id="id_profesi_pdd" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $sql_profesi = $conn->query("SELECT * FROM tb_profesi_pdd order by nama_profesi_pdd ASC");
                            while ($d_profesi  = $sql_profesi->fetch(PDO::FETCH_ASSOC)) {
                                if ($d['id_profesi_pdd'] == $d_profesi['id_profesi_pdd']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                            ?>
                                <option value="<?= $d_profesi['id_profesi_pdd']; ?>" <?= $selected; ?>>
                                    <?= $d_profesi['nama_profesi_pdd']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-xs font-italic text-danger blink" id="err_id_profesi_pdd"></div>
                    </div>
                    <div class="col-md-2">
                        Jenjang Pendidikan <span style="color:red">*</span><br>
                        <select class="select2" name="id_jenjang_pdd" id="id_jenjang_pdd" style="width: 100%;" required>
                            <option value="">-- Pilih --</option>
                            <?php
                            $sql_jenjang = $conn->query("SELECT * FROM tb_jenjang_pdd order by nama_jenjang_pdd ASC");
                            while ($d_jenjang = $sql_jenjang->fetch(PDO::FETCH_ASSOC)) {
                                if ($d['id_jenjang_pdd'] == $d_jenjang['id_jenjang_pdd']) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                            ?>
                                <option value="<?= $d_jenjang['id_jenjang_pdd']; ?>" <?= $selected; ?>>
                                    <?= $d_jenjang['nama_jenjang_pdd']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <div class="text-xs font-italic text-danger blink" id="err_id_jenjang_pdd"></div>
                    </div>
                </div>
                <hr>
                <div class="row text-center">
                    <div class="col-md-6">
                        <fieldset class="border p-2">
                            <legend class="h6 pb-2">File MoU :
                                <?php
                                if ($d['file_pks'] != "") {
                                ?>
                                    <div class="text-xs font-italic text-primary">File MoU Sebelumnya : <a href="<?= $d['file_mou']; ?>" class="font-weight-bold" target="_blank">UNDUH</a></div>
                                <?php
                                }
                                ?>
                            </legend>

                            <div class="custom-file">
                                <label class="custom-file-label text-xs" for="customFile" id="file_mou_label">Pilih File</label>
                                <input type="file" class="custom-file-input mb-1" type="file" name="file_mou" id="file_mou" accept="application/pdf" required>
                                <div class="text-xs font-italic">File harus pdf dan ukuranya kurang dari 2 Mb</div>
                                <div class="text-xs font-italic text-danger blink" id="err_file_mou"></div>
                                <script>
                                    $('#file_mou').on('change', function(evt) {
                                        //label input
                                        var label = $(this).val();
                                        label = label.replace(/^.*[\\\/]/, '');
                                        if (label == "") label = "Pilih File";
                                        $('#file_mou_label').html(label);
                                    });
                                </script>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="border p-2">
                            <legend class="h6 pb-2">
                                File PKS : <span style="color:red">*</span>
                                <?php
                                if ($d['file_pks'] != "") {
                                ?>
                                    <div class="text-xs font-italic text-primary">File PKS Sebelumnya : <a href="<?= $d['file_pks']; ?>" class="font-weight-bold" target="_blank">UNDUH</a></div>
                                <?php
                                }
                                ?>
                            </legend>
                            <div class="custom-file">
                                <label class="custom-file-label text-xs" for="customFile" id="file_pks_label">Pilih File</label>
                                <input type="file" class="custom-file-input mb-1" type="file" name="file_pks" id="file_pks" accept="application/pdf" required>
                                <div class="text-xs font-italic">File harus pdf dan ukuranya kurang dari 2 Mb</div>
                                <div class="text-xs font-italic text-danger blink" id="err_file_pks"></div>
                                <script>
                                    $('#file_pks').on('change', function(evt) {
                                        //label input
                                        var label = $(this).val();
                                        label = label.replace(/^.*[\\\/]/, '');
                                        if (label == "") label = "Pilih File";
                                        $('#file_pks_label').html(label);

                                    });
                                </script>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <hr>
                <i class="font-weight-bold"><span style="color:red">*</span> : Wajib diisi</i>
                <div class="row col-md-auto justify-content-center">
                    <button type="button" id="tombol_data_phn" class="btn btn-outline-primary" onclick="ubah_mou()">
                        &nbsp;Ubah Data Kerjasama &nbsp;
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function ubah_mou() {

        var id_institusi = document.getElementById("id_institusi").value;
        var no_rsj_mou = document.getElementById("no_rsj_mou").value;
        var no_institusi_mou = document.getElementById("no_institusi_mou").value;
        var tgl_mulai_mou = document.getElementById("tgl_mulai_mou").value;
        var tgl_mulai_mou = document.getElementById("tgl_selesai_mou").value;
        var id_jurusan_pdd = document.getElementById("id_jurusan_pdd").value;
        var id_profesi_pdd = document.getElementById("id_profesi_pdd").value;
        var id_jenjang_pdd = document.getElementById("id_jenjang_pdd").value;
        var file_mou = document.getElementById("file_mou").value;
        var file_pks = document.getElementById("file_pks").value;

        var getTypeMOU = "";
        var getSizeMOU = "";
        //eksekusi bila file MoU terisi
        if (file_mou != "") {
            //Cari ekstensi file MoU yg diupload
            var typeMOU = document.querySelector('#file_mou').value;
            var getTypeMOU = typeMOU.split('.').pop();

            //cari ukuran file MoU yg diupload
            var fileMOU = document.getElementById("file_mou").files;
            var getSizeMOU = document.getElementById("file_mou").files[0].size / 1024;
        } else {
            var getTypeMOU = "pdf";
            var getSizeMOU = 1;
        }

        //eksekusi bila file PKS terisi
        if (file_pks != "") {

            //Cari ekstensi file PKS yg diupload
            var typePKS = document.querySelector('#file_pks').value;
            var getTypePKS = typePKS.split('.').pop();

            //cari ukuran file PKS yg diupload
            var filePKS = document.getElementById("file_pks").files;
            var getSizePKS = document.getElementById("file_pks").files[0].size / 1024;
        }

        //Notif Bila tidak diisi
        if (
            id_institusi == "" ||
            no_rsj_mou == "" ||
            no_institusi_mou == "" ||
            tgl_mulai_mou == "" ||
            tgl_selesai_mou == "" ||
            id_jurusan_pdd == "" ||
            id_profesi_pdd == "" ||
            id_jenjang_pdd == "" ||
            file_pks == "" ||
            getTypeMOU != 'pdf' ||
            getSizeMOU > 2048 ||
            getTypePKS != 'pdf' ||
            getSizePKS > 2048
        ) {

            //warning Toast bila ada data wajib yg berlum terisi
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'warning',
                title: '<center>DATA WAJIB ADA YANG BELUM TERISI</center>'
            });

            if (id_institusi == "") {
                document.getElementById("err_id_institusi").innerHTML = "Institusi Harus Dipilih";
            } else {
                document.getElementById("err_id_institusi").innerHTML = "";
            }

            if (no_rsj_mou == "") {
                document.getElementById("err_no_rsj_mou").innerHTML = "No. MoU RSJ Harus Diisi";
            } else {
                document.getElementById("err_no_rsj_mou").innerHTML = "";
            }

            if (no_institusi_mou == "") {
                document.getElementById("err_no_institusi_mou").innerHTML = "No. MoU Institusi Harus Diisi";
            } else {
                document.getElementById("err_no_institusi_mou").innerHTML = "";
            }

            if (tgl_mulai_mou == "") {
                document.getElementById("err_tgl_mulai_mou").innerHTML = "Tgl Mulai MoU Harus Dipilih";
            } else {
                document.getElementById("err_tgl_mulai_mou").innerHTML = "";
            }

            if (tgl_selesai_mou == "") {
                document.getElementById("err_tgl_selesai_mou").innerHTML = "Tgl Selesai MoU Harus Dipilih";
            } else {
                document.getElementById("err_tgl_selesai_mou").innerHTML = "";
            }

            if (id_jurusan_pdd == "") {
                document.getElementById("err_id_jurusan_pdd").innerHTML = "Jurusan Harus Dipilih";
            } else {
                document.getElementById("err_id_jurusan_pdd").innerHTML = "";
            }

            if (id_profesi_pdd == "") {
                document.getElementById("err_id_profesi_pdd").innerHTML = "Profesi Harus Dipilih";
            } else {
                document.getElementById("err_id_profesi_pdd").innerHTML = "";
            }

            if (id_jenjang_pdd == "") {
                document.getElementById("err_id_jenjang_pdd").innerHTML = "Jenjang Harus Dipilih";
            } else {
                document.getElementById("err_id_jenjang_pdd").innerHTML = "";
            }

            if (file_pks == "") {
                document.getElementById("err_file_pks").innerHTML = "File PKS Harus Diisi";
            } else {
                document.getElementById("err_file_pks").innerHTML = "";
            }


            //Toast bila upload file MoU selain pdf
            if (getTypeMOU != 'pdf') {
                document.getElementById("err_file_mou").innerHTML = "File MoU Harus pdf";
            } //Toast bila upload file MoU diatas 1 Mb 
            else if (getSizeMOU > 1024) {
                document.getElementById("err_file_mou").innerHTML = "Ukuran File MoU Harus Kurang dari 1 Mb";
            }

            //Toast bila upload file PKS selain pdf
            if (getTypePKS != 'pdf') {
                document.getElementById("err_file_pks").innerHTML = "File PKS Harus pdf";
            } //Toast bila upload file proposal_kak diatas 1 Mb
            else if (getSizePKS > 1024) {
                document.getElementById("err_file_pks").innerHTML = "Ukuran File PKS Harus Kurang dari 1 Mb";
            }
        } else {
            var data_kerjasama = $('#form_mou').serializeArray();
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_u_mou_s.php",
                data: data_kerjasama,
                success: function() {
                    //ambil data file yang diupload
                    var data_file = new FormData();
                    var xhttp = new XMLHttpRequest();

                    var fileMOU = document.getElementById("file_mou").files;
                    data_file.append("file_mou", fileMOU[0]);

                    var filePKS = document.getElementById("file_pks").files;
                    data_file.append("file_pks", filePKS[0]);

                    var id_mou = document.getElementById("id_mou").value;
                    data_file.append("id_mou", id_mou);

                    xhttp.open("POST", "_admin/exc/x_u_mou_sFile.php", true);
                    xhttp.send(data_file);
                    Swal.fire({
                        allowOutsideClick: false,
                        // isDismissed: false,
                        icon: 'success',
                        title: '<span class"text-xs"><b>DATA KERJASAMA</b><br>Berhasil Terubah',
                        showConfirmButton: false,
                        html: '<a href="?kerjasama" class="btn btn-outline-primary">OK</a>',
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    }).then(
                        function() {
                            document.location.href = "?kerjasama";
                        }
                    );
                },
                error: function(response) {
                    console.log(response.responseText);
                    alert('eksekusi query gagal');
                }
            });
        }
    }
</script>
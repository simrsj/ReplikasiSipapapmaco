<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
$exp_ar_id = explode('*sm*', base64_decode(urldecode(hex2bin($_GET['idu']))));
$id = $exp_ar_id[0];
$exp_ar_idp = explode('*sm*', base64_decode(urldecode(hex2bin($_GET['idp']))));
$idp = $exp_ar_idp[0];
// echo "<pre>" . print_r($exp_ar_id) . "</pre>";

$sql_prvl = "SELECT * FROM tb_user_privileges ";
$sql_prvl .= " JOIN tb_user ON tb_user_privileges.id_user = tb_user.id_user";
$sql_prvl .= " WHERE tb_user.id_user = " . $id;
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('-DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);

$sql_data_praktikan = "SELECT * FROM tb_praktikan ";
$sql_data_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
$sql_data_praktikan .= " WHERE tb_praktik.id_praktik = " . $idp;
if ($d_prvl['level_user'] == 2) {
    $sql_data_praktikan .= " AND tb_praktik.id_institusi = " . $d_prvl['id_institusi'];
}
$sql_data_praktikan .= " ORDER BY tb_praktikan.nama_praktikan ASC";
// echo "$sql_data_praktikan<br>";
try {
    $q_data_praktikan = $conn->query($sql_data_praktikan);
    $q_data_praktikan1 = $conn->query($sql_data_praktikan);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRAKTIKAN-');";
    echo "document.location.href='?error404';</script>";
}
$r_data_praktikan = $q_data_praktikan->rowCount();
$d_data_praktikan1 = $q_data_praktikan1->fetch(PDO::FETCH_ASSOC);

if ($r_data_praktikan > 0) {
?>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable<?= $_GET['tb']; ?>">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">NO ID</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tgl Lahir</th>
                    <th scope="col">No. HP</th>
                    <th scope="col">No. WA</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">ALAMAT</th>
                    <?php if ($d_data_praktikan1['id_profesi_pdd'] > 0) { ?>
                        <th scope="col">IJAZAH</th>
                    <?php } ?>
                    <th scope="col">SWAB/Sertifikat<br>Vaksin</th>
                    <th scope="col">Foto</th>
                    <th scope="col">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_jumlah_tarif = 0;
                $no = 1;
                while ($d_data_praktikan = $q_data_praktikan->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $d_data_praktikan['no_id_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['nama_praktikan']; ?></td>
                        <td><?= tanggal_minimal($d_data_praktikan['tgl_lahir_praktikan']); ?></td>
                        <td><?= $d_data_praktikan['telp_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['wa_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['email_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['alamat_praktikan']; ?></td>
                        <?php if ($d_data_praktikan1['id_profesi_pdd'] > 0) { ?>
                            <td class="text-center">
                                <?php if ($d_data_praktikan['file_ijazah_praktikan'] != "") { ?>
                                    <a href="<?= $d_data_praktikan['file_ijazah_praktikan']; ?>" download="Ijazah Praktikan.pdf" target="_blank" class="btn btn-outline-success btn-sm">
                                        Unduh
                                    </a>
                                <?php } else { ?>
                                    <span class="badge badge-warning text-dark">Belum Ada</span>
                                <?php } ?>

                            </td>
                        <?php } ?>
                        <td class="text-center">
                            <?php if ($d_data_praktikan['file_swab_praktikan'] != "") { ?>
                                <a href="<?= $d_data_praktikan['file_swab_praktikan']; ?>" download="Swab_Serfikat Vaksin Praktikan.pdf" target="_blank" class="btn btn-outline-success btn-sm">
                                    Unduh
                                </a>
                            <?php } else { ?>
                                <span class="badge badge-warning text-dark">Belum Ada</span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <?php if ($d_data_praktikan['foto_praktikan'] != "") { ?>

                                <!-- tombol modal foto praktikan  -->
                                <a title="tambah praktikan" class='btn btn-info btn-sm' href='#' data-toggle="modal" data-target="#foto<?= md5($d_data_praktikan['id_praktikan']); ?>">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- modal foto praktikan  -->
                                <div class="modal " id="foto<?= md5($d_data_praktikan['id_praktikan']); ?>">
                                    <div class="modal-dialog modal-xs" style="width: 230px; height:260px">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <img src="<?= $d_data_praktikan['foto_praktikan'] ?>" width="200px" height="250px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <span class="badge badge-warning text-dark">Belum Ada</span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group" role="group" aria-label="Basic example">
                                <?php if ($d_prvl['u_praktikan'] == 'Y') { ?>
                                    <!-- tombol modal ubah praktikan  -->
                                    <a title="Ubah" class='btn btn-outline-primary ubah_init<?= md5($d_data_praktikan['id_praktikan']); ?>' id="<?= bin2hex(urlencode(base64_encode($d_data_praktikan['id_praktikan'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>" href='#' data-toggle="modal" data-target="#mu<?= md5($d_data_praktikan['id_praktikan']); ?>">
                                        <i class="far fa-edit"></i>
                                    </a>

                                    <!-- modal ubah praktikan  -->
                                    <div class="modal fade text-center" id="mu<?= md5($d_data_praktikan['id_praktikan']); ?>" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header h5">
                                                    Ubah Praktikan
                                                </div>
                                                <div class="modal-body text-md">
                                                    <form class="form-data b" method="post" id="form_u<?= md5($d_data_praktikan['id_praktikan']); ?>">
                                                        <input type="hidden" name="idprkn" id="idprkn<?= md5($d_data_praktikan['id_praktikan']); ?>" value="" required>

                                                        Foto Formal : <span style="color:red">*</span><br>
                                                        <img width="100px" height="120px" id="u_fotoout<?= md5($d_data_praktikan['id_praktikan']); ?>" class="mb-2" style="width: 100px; height: 120px; background: url(./_img/defaultfoto.png) center center/cover no-repeat;">
                                                        <br>
                                                        <div class="custom-file">
                                                            <label class="custom-file-label text-xs" for="customFile" id="labelfoto<?= md5($d_data_praktikan['id_praktikan']); ?>">Pilih File</label>
                                                            <input type="file" class="custom-file-input mb-1" name="u_foto" id="u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>" accept=".jpg">
                                                            <span class='i text-xs'>Data unggah harus jpg, Maksimal 200 Kb</span><br>
                                                            <div class="text-danger b i text-xs blink" id="err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>"></div><br>
                                                            <script>
                                                                $('#u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>').on('change', function(evt) {
                                                                    //label input
                                                                    var fileFoto = $(this).val();
                                                                    fileFoto = fileFoto.replace(/^.*[\\\/]/, '');
                                                                    if (fileFoto == "") fileFoto = "Pilih File Foto";
                                                                    $('#labelfoto<?= md5($d_data_praktikan['id_praktikan']); ?>').html(fileFoto);

                                                                    // load Image
                                                                    var tgt = evt.target || window.event.srcElement,
                                                                        files = tgt.files;

                                                                    if (FileReader && files && files.length) {
                                                                        var fr = new FileReader();
                                                                        fr.onload = function() {
                                                                            document.getElementById('u_fotoout<?= md5($d_data_praktikan['id_praktikan']); ?>').src = fr.result;
                                                                        }
                                                                        fr.readAsDataURL(files[0]);
                                                                    }
                                                                });
                                                            </script>
                                                        </div>
                                                        No. ID Praktikan (NIM/NPM/NIP) : <span style="color:red">*</span><br>
                                                        <input type="text" id="u_no_id<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_no_id" class="form-control" placeholder="Isikan No ID" required>
                                                        <div class="text-danger b i text-xs blink" id="err_u_no_id"></div><br>
                                                        Nama Siswa/Mahasiswa : <span style="color:red">*</span><br>
                                                        <input type="text" id="u_nama<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_nama" class="form-control" placeholder="Inputkan Nama Siswa/Mahasiswa" required>
                                                        <div class="text-danger b i text-xs blink" id="err_u_nama"></div><br>
                                                        Tanggal Lahir : <span style="color:red">*</span><br>
                                                        <input type="date" id="u_tgl<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_tgl" class="form-control" required>
                                                        <div class="text-danger b i text-xs blink" id="err_u_tgl"></div><br>
                                                        Alamat : <span style="color:red">*</span><br>
                                                        <textarea id="u_alamat<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_alamat" class="form-control" rows="2" placeholder="Inputkan Alamat"></textarea>
                                                        <div class="text-danger b i text-xs blink" id="err_u_alamat"></div><br>
                                                        No Telepon : <span style="color:red">*</span><br>
                                                        <input type="number" id="u_telp<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_telp" class="form-control" min="1" placeholder="Inputkan No Telpon" required>
                                                        <div class="text-danger b i text-xs blink" id="err_u_telpon"></div><br>
                                                        No WhatsApp :<br>
                                                        <input type="number" id="u_wa<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_wa" class="form-control" min="1" placeholder="Inputkan WhatsApp">
                                                        <div class="text-danger b i text-xs blink" id="err_u_wa"></div><br>
                                                        E-Mail : <br>
                                                        <input type="email" id="u_email<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_email" class="form-control" placeholder="Inputkan E-Mail">
                                                        <div class="text-danger b i text-xs blink" id="err_u_email"></div><br>
                                                        <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?>
                                                            File Ijazah :<span style="color:red">*</span><br>
                                                            <div class="custom-file">
                                                                <label class="custom-file-label text-xs" for="customFile" id="labelfileijazahu<?= md5($d_data_praktikan['id_praktikan']); ?>">Pilih File</label>
                                                                <input type="file" class="custom-file-input mb-1" id="u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_ijazah<?= md5($d_data_praktikan['id_praktik']); ?>" accept="application/pdf" required>
                                                                <span class='i text-xs'>Data unggah harus pdf, Maksimal 3 Mb</span><br>
                                                                <div class="text-xs font-italic text-danger blink" id="err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>"></div><br>
                                                                <script>
                                                                    $('#u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>').on('change', function() {
                                                                        var fileNameIjazah = $(this).val();
                                                                        fileNameIjazah = fileNameIjazah.replace(/^.*[\\\/]/, '');
                                                                        if (fileNameIjazah == "") fileNameIjazah = "Pilih File";
                                                                        $('#labelfileijazahu<?= md5($d_data_praktikan['id_praktikan']); ?>').html(fileNameIjazah);
                                                                    })
                                                                </script>
                                                            </div>
                                                            <br>
                                                        <?php } ?>
                                                        File Swab/Sertifikat Vaksin :<br>
                                                        <div class="custom-file">
                                                            <label class="custom-file-label text-xs" for="customFile" id="labelfileswabu<?= md5($d_data_praktikan['id_praktikan']); ?>">Pilih File</label>
                                                            <input type="file" class="custom-file-input mb-1" id="u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>" name="u_swab<?= md5($d_data_praktikan['id_praktik']); ?>" accept="application/pdf" required>
                                                            <span class='i text-xs'>Data unggah harus pdf, Maksimal 3 Mb</span><br>
                                                            <div class="text-xs font-italic text-danger blink" id="err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>"></div><br>
                                                            <script>
                                                                $('#u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>').on('change', function() {
                                                                    var fileNameSwab = $(this).val();
                                                                    fileNameSwab = fileNameSwab.replace(/^.*[\\\/]/, '');
                                                                    if (fileNameSwab == "") fileNameSwab = "Pilih File";
                                                                    $('#labelfileswabu<?= md5($d_data_praktikan['id_praktikan']); ?>').html(fileNameSwab);
                                                                })
                                                            </script>
                                                        </div>
                                                        <br>
                                                    </form>
                                                </div>
                                                <div class="modal-footer text-md">
                                                    <a class="btn btn-danger btn-sm ubah_tutup<?= md5($d_data_praktikan['id_praktikan']); ?>" data-dismiss="modal">
                                                        Kembali
                                                    </a>
                                                    &nbsp;
                                                    <a class="btn btn-primary btn-sm ubah<?= md5($d_data_praktikan['id_praktikan']); ?>" id="<?= bin2hex(urlencode(base64_encode($d_data_praktikan['id_praktikan'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>">
                                                        Ubah
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $(".ubah_init<?= md5($d_data_praktikan['id_praktikan']); ?>").click(function() {
                                            // console.log("ubah_init");

                                            Swal.fire({
                                                title: 'Mohon Ditunggu . . .',
                                                html: '<div class="loader mb-5 mt-5 text-center"></div>',
                                                allowOutsideClick: false,
                                                showConfirmButton: false,
                                                backdrop: true
                                            });
                                            $('#err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_no_id<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_nama<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_tgl<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_alamat<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_telpon<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_wa<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_email<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?>
                                                $('#err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            <?php } ?>
                                            $('#err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $("#form_u<?= md5($d_data_praktikan['id_praktikan']); ?>").trigger("reset");
                                            $.ajax({
                                                type: 'POST',
                                                url: "_admin/view/v_praktik_praktikanGetData.php",
                                                data: {
                                                    idprkn: $(this).attr('id')
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    $('#idprkn<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.idprkn);
                                                    $('#u_no_id<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.u_no_id);
                                                    $('#u_nama<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.u_nama);
                                                    $('#u_tgl<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.u_tgl);
                                                    $('#u_telp<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.u_telp);
                                                    $('#u_wa<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.u_wa);
                                                    $('#u_email<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.u_email);
                                                    $('#u_alamat<?= md5($d_data_praktikan['id_praktikan']); ?>').val(response.u_alamat);
                                                },
                                                error: function(response) {
                                                    alert(response.responseText);
                                                    console.log(response.responseText);
                                                }
                                            });
                                            <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?>
                                                $('#err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            <?php } ?>
                                            $('#err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            $('#err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                            Swal.close();
                                        });

                                        // inisiasi klik modal ubah  tutup
                                        $(".ubah_tutup<?= md5($d_data_praktikan['id_praktikan']); ?>").click(function() {
                                            // console.log("tambah_tutup<?= md5($d_data_praktikan['id_praktikan']); ?>");
                                            $("#form_u<?= md5($d_data_praktikan['id_praktikan']); ?>").trigger("reset");
                                            $('#mu<?= md5($d_data_praktikan['id_praktikan']); ?>').modal('hide');
                                        });

                                        $(document).on('click', '.ubah<?= md5($d_data_praktikan['id_praktikan']); ?>', function() {

                                            Swal.fire({
                                                title: 'Mohon Ditunggu . . .',
                                                html: '<div class="loader mb-5 mt-5 text-center"></div>',
                                                allowOutsideClick: false,
                                                showConfirmButton: false,
                                                backdrop: true
                                            });
                                            var u_foto = $('#u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            var u_no_id = $('#u_no_id<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            var u_nama = $('#u_nama<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            var u_tgl = $('#u_tgl<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            var u_alamat = $('#u_alamat<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            var u_telpon = $('#u_telpon<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?>
                                                var u_ijazah = $('#u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            <?php } ?>
                                            var u_swab = $('#u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>').val();
                                            var idpp = $(this).attr('id');

                                            var data_u = $('#form_u<?= md5($d_data_praktikan['id_praktikan']); ?>').serializeArray();
                                            data_u.push({
                                                name: "idprkn",
                                                value: idpp
                                            });

                                            //eksekusi bila file foto terisi
                                            if (u_foto != "" && u_foto != undefined) {

                                                //Cari ekstensi file swab yg diupload
                                                var typeFoto = document.querySelector('#u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>').value;
                                                var getTypeFoto = typeFoto.split('.').pop();

                                                //cari ukuran file Swab yg diupload
                                                var fileFoto = document.getElementById("u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").files;
                                                var getSizeFoto = document.getElementById("u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").files[0].size / 1024;

                                            }

                                            <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?>
                                                //eksekusi bila file ijazah terisi
                                                if (u_ijazah != "" && u_ijazah != undefined) {

                                                    //Cari ekstensi file ijazah yg diupload
                                                    var typeIjazah = document.querySelector('#u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>').value;
                                                    var getTypeIjazah = typeIjazah.split('.').pop();

                                                    //cari ukuran file Ijazah yg diupload
                                                    var fileIjazah = document.getElementById("u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").files;
                                                    var getSizeIjazah = document.getElementById("u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").files[0].size / 1024;

                                                }
                                            <?php } ?>

                                            //eksekusi bila file swab terisi
                                            if (u_swab != "" && u_swab != undefined) {

                                                //Cari ekstensi file swab yg diupload
                                                var typeSwab = document.querySelector('#u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>').value;
                                                var getTypeSwab = typeSwab.split('.').pop();

                                                //cari ukuran file Swab yg diupload
                                                var fileSwab = document.getElementById("u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").files;
                                                var getSizeSwab = document.getElementById("u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").files[0].size / 1024;

                                            }

                                            //cek data from modal tambah bila tidak diiisi
                                            if (
                                                u_no_id == "" ||
                                                u_nama == "" ||
                                                u_tgl == "" ||
                                                u_alamat == "" ||
                                                u_telpon == "" ||
                                                <?php
                                                if ($d_data_praktikan['id_profesi_pdd'] > 0) {
                                                ?> getTypeIjazah != 'pdf' ||
                                                    getSizeIjazah > 3072 ||
                                                    u_ijazah == "" ||
                                                    u_ijazah == undefined ||
                                                <?php
                                                }
                                                ?>
                                                // getTypeSwab != 'pdf' ||
                                                // getSizeSwab > 256 ||
                                                // u_swab == "" ||
                                                // u_swab == undefined ||
                                                getTypeFoto != 'jpg' ||
                                                getSizeFoto > 256 ||
                                                u_foto == "" ||
                                                u_foto == undefined
                                            ) {
                                                if (u_foto == "" || u_foto == undefined)
                                                    $("#err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Foto Harus Dipilih");
                                                else if (getTypeFoto != "jpg")
                                                    $("#err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").html("File Foto Harus jpg");
                                                else if (getSizeFoto > 256)
                                                    $("#err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").html("File Foto Harus Kurang dari 200 Kb");
                                                else
                                                    $("#err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");


                                                <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?>
                                                    if (u_ijazah == "" || u_ijazah == undefined)
                                                        $("#err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Ijazah Harus Dipilih");
                                                    else if (getTypeIjazah != "pdf")
                                                        $("#err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").html("File Ijazah Harus pdf");
                                                    else if (getSizeIjazah > 256)
                                                        $("#err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").html("File Ijazah Harus Kurang dari 200 Kb");
                                                    else
                                                        $("#err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");
                                                <?php } ?>

                                                // if (u_swab == "" || u_swab == undefined)
                                                //     $("#err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Swab/Serfikat Vaksin Harus Dipilih");
                                                // else if (getTypeSwab != "pdf")
                                                //     $("#err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Swab/Serfikat Vaksin Harus pdf");
                                                // else if (getSizeSwab > 256)
                                                //     $("#err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Swab/Serfikat Vaksin Harus Kurang dari 200 Kb");
                                                // else
                                                //     $("#err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");


                                                if (u_no_id == "") {
                                                    $("#err_u_no_id<?= md5($d_data_praktikan['id_praktikan']); ?>").html("No ID Harus Diisi");
                                                } else {
                                                    $("#err_u_no_id<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");
                                                }

                                                if (u_nama == "") {
                                                    $("#err_u_nama<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Nama Harus Diisi");
                                                } else {
                                                    $("#err_u_nama<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");
                                                }

                                                if (u_tgl == "") {
                                                    $("#err_u_tgl<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Tanggal Lahir Harus Dipilih");
                                                } else {
                                                    $("#err_u_tgl<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");
                                                }

                                                if (u_alamat == "") {
                                                    $("#err_u_alamat<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Alamat Harus Diisi");
                                                } else {
                                                    $("#err_u_alamat<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");
                                                }

                                                if (u_telpon == "") {
                                                    $("#err_u_telpon<?= md5($d_data_praktikan['id_praktikan']); ?>").html("Telpon Harus Diisi");
                                                } else {
                                                    $("#err_u_telpon<?= md5($d_data_praktikan['id_praktikan']); ?>").html("");
                                                }

                                                Swal.fire({
                                                    allowOutsideClick: true,
                                                    showConfirmButton: false,
                                                    icon: 'warning',
                                                    html: '<div class="text-lg b">DATA ADA YANG TIDAK SESUAI</div>',
                                                    timer: 3000,
                                                    timerProgressBar: true,
                                                    backdrop: true,
                                                    didOpen: (toast) => {
                                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                    }
                                                });
                                            }
                                            //simpan data ubah bila sudah sesuai
                                            else {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "_admin/exc/x_v_praktik_praktikan_u.php",
                                                    data: data_u,
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        console.log("Ubah Data Praktikan")
                                                        var data_file = new FormData();
                                                        var xhttp = new XMLHttpRequest();

                                                        var fileFoto = document.getElementById("u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").files;
                                                        data_file.append("t_foto", fileFoto[0]);
                                                        <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?>
                                                            var fileIjazah = document.getElementById("u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").files;
                                                            data_file.append("t_ijazah", fileIjazah[0]);
                                                        <?php } ?>
                                                        var fileSwab = document.getElementById("u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").files;
                                                        data_file.append("t_swab", fileSwab[0]);

                                                        data_file.append("q", response.q);
                                                        data_file.append("idpp", response.idpp);
                                                        data_file.append("profesi", "<?= bin2hex(urlencode(base64_encode(date("Ymd") . "*sm*" . $d_data_praktikan['id_profesi_pdd']))) ?>");
                                                        console.log(response.q);
                                                        console.log(response.idpp);
                                                        xhttp.open("POST", "_admin/exc/x_v_praktik_praktikan_sFile.php", true);

                                                        xhttp.onload = function() {
                                                            if (xhttp.response == "<?= bin2hex(urlencode(base64_encode("size"))) ?>") {
                                                                console.log("size too big");
                                                                Swal.fire({
                                                                    allowOutsideClick: true,
                                                                    icon: 'warning',
                                                                    html: '<span class="text-danger text-lg text-center">Ukuran File Terlalu Besar</span>',
                                                                    showConfirmButton: false,
                                                                    backdrop: true,
                                                                    timer: 5000,
                                                                    timerProgressBar: true
                                                                });
                                                            } else if (xhttp.response == "<?= bin2hex(urlencode(base64_encode("type"))); ?>") {
                                                                console.log("Tipe Different");
                                                                Swal.fire({
                                                                    allowOutsideClick: true,
                                                                    icon: 'warning',
                                                                    html: '<span class="text-danger text-lg text-center">Tipe File Berbeda</span>',
                                                                    showConfirmButton: false,
                                                                    backdrop: true,
                                                                    timer: 5000,
                                                                    timerProgressBar: true
                                                                });
                                                            } else {
                                                                console.log("Success");
                                                                Swal.fire({
                                                                    allowOutsideClick: true,
                                                                    showConfirmButton: false,
                                                                    backdrop: true,
                                                                    icon: 'success',
                                                                    html: '<div class="text-lg b">Data Praktikan<br>Berhasil Diubah</div>',
                                                                    timer: 3000,
                                                                    timerProgressBar: true,
                                                                    didOpen: (toast) => {
                                                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                                    }
                                                                }).then(
                                                                    function() {
                                                                        $('#mu<?= md5($d_data_praktikan['id_praktikan']) ?>').on('hidden.bs.modal', function(e) {
                                                                            $('#<?= md5("data" . $d_data_praktikan['id_praktik']); ?>')
                                                                                .load("_admin/view/v_praktik_praktikanData.php?idu=<?= $_GET['idu']; ?>&idp=<?= $_GET['idp']; ?>&tb=<?= $_GET['tb'] ?>");
                                                                        });
                                                                        $('#err_u_no_id<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $('#err_u_nama<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $('#err_u_tgl<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $('#err_u_alamat<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $('#err_u_telpon<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $('#err_u_wa<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $('#err_u_email<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        <?php if ($d_data_praktikan['id_profesi_pdd'] > 0) { ?> $('#err_u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                            $("#u_ijazah<?= md5($d_data_praktikan['id_praktikan']); ?>").val("").trigger("change");
                                                                        <?php } ?> $('#err_u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $('#err_u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>').empty();
                                                                        $("#form_u<?= md5($d_data_praktikan['id_praktikan']); ?>").trigger("reset");
                                                                        $("#u_swab<?= md5($d_data_praktikan['id_praktikan']); ?>").val("").trigger("change");
                                                                        $("#u_foto<?= md5($d_data_praktikan['id_praktikan']); ?>").val("").trigger("change");

                                                                        $('#mu<?= md5($d_data_praktikan['id_praktikan']); ?>').modal('toggle');
                                                                        Swal.close();
                                                                    }
                                                                );
                                                            }
                                                        }
                                                        xhttp.send(data_file);
                                                    },
                                                    error: function(response) {
                                                        console.log(response);
                                                    }
                                                });
                                            }
                                        });
                                    </script>
                                <?php } ?>
                                <?php if ($d_prvl['d_praktikan'] == 'Y') { ?>
                                    <!-- tombol modal hapus praktikan  -->
                                    <a title="Hapus" class='btn btn-outline-danger' href='#' data-toggle="modal" data-target="#md<?= md5($d_data_praktikan['id_praktikan']); ?>">
                                        <i class="far fa-trash-alt"></i>
                                    </a>

                                    <!-- modal hapus praktikan  -->
                                    <div class="modal text-center" id="md<?= md5($d_data_praktikan['id_praktikan']); ?>">
                                        <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header h5">
                                                    Hapus Praktikan
                                                </div>
                                                <div class="modal-footer text-md">
                                                    <a class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                                                        Kembali
                                                    </a>
                                                    &nbsp;
                                                    <a class="btn btn-outline-danger btn-sm hapus<?= md5($d_data_praktikan['id_praktikan']); ?>" id="<?= bin2hex(urlencode(base64_encode($d_data_praktikan['id_praktikan'] . "*sm*" . date('Y-m-d H:i:s', time())))); ?>" data-dismiss="modal">
                                                        Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).on('click', '.hapus<?= md5($d_data_praktikan['id_praktikan']); ?>', function() {
                                            console.log("hapus data praktikan");
                                            $.ajax({
                                                type: 'POST',
                                                url: "_admin/exc/x_v_praktik_praktikan_h.php",
                                                data: {
                                                    "idprkn": $(this).attr('id')
                                                },
                                                success: function() {
                                                    Swal.fire({
                                                        allowOutsideClick: true,
                                                        showConfirmButton: false,
                                                        backdrop: true,
                                                        icon: 'success',
                                                        html: '<div class="text-lg b">Data Praktikan<br>Berhasil Diubah</div>',
                                                        timer: 3000,
                                                        timerProgressBar: true,
                                                        didOpen: (toast) => {
                                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                        }
                                                    }).then(
                                                        function() {
                                                            $('#<?= md5("data" . $d_data_praktikan['id_praktik']); ?>')
                                                                .load("_admin/view/v_praktik_praktikanData.php?idu=<?= $_GET['idu']; ?>&idp=<?= $_GET['idp']; ?>&tb=<?= $_GET['tb'] ?>");
                                                            $('#md<?= md5($d_data_praktikan['id_praktikan']); ?>').modal('hide');
                                                            Swal.close();
                                                        }
                                                    );
                                                },
                                                error: function(response) {
                                                    console.log(response);
                                                    alert('eksekusi query gagal');
                                                }
                                            });
                                        });
                                    </script>
                                <?php } ?>
                            </div>
                            <script>
                                <?php if (isset($_GET['acc'])) { ?>
                                    $('#<?= $_GET['acc'] ?>').addClass('show');
                                <?php } ?>
                                $(document).ready(function() {
                                    $('#dataTable<?= $_GET['tb'] ?>').DataTable();
                                });
                            </script>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $('.loader').hide();
        alert = function() {};
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/datatable.js";
        ?>
    </script>
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
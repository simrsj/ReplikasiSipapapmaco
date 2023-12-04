<?php
if (isset($_GET['pkd']) && isset($_GET['u']) && $d_prvl['u_pkd'] == "Y") {

    //data PKD 
    $sql_pkd = "SELECT * FROM tb_pkd WHERE id_pkd = " . base64_decode(urldecode($_GET['pkd']));
    try {
        $q_pkd = $conn->query($sql_pkd);
        $d_pkd = $q_pkd->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PRIVILEGES-');";
        echo "document.location.href='?error404';</script>";
    }

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="h3 mb-2 text-gray-800" id="title_praktik">Ubah Pemakaian Kekayaan Daerah</h1>
            </div>
        </div>
        <form class="form-data text-gray-900" method="post" enctype="multipart/form-data" id="form_u">
            <!-- Data Pengajuan PKD  -->
            <div id="data_praktik_input">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <!-- Data PKD -->
                        <div class="row">
                            <div class="col-md-12 text-lg b text-center text-gray-100 badge bg-primary mb-3">DATA PKD</div>
                        </div>
                        <!-- Nama Pemohon, Rincian, Tanggal Pelaksanaan, dan File Surat -->
                        <div class="row">
                            <div class="col-md">
                                Nama Pemohon : <span style="color:red">*</span><br>
                                <input id="pemohon" name="pemohon" class="form-control form-control-xs" placeholder="Isikan Pemohon dari Institusi/Perorangan" value="<?= $d_pkd['nama_pemohon_pkd'] ?>" required>
                                <div class="text-danger b i text-xs blink" id="err_pemohon"></div>
                            </div>
                            <div class="col-md">
                                Rincian : <span style="color:red">*</span><br>
                                <textarea id="rincian" name="rincian" class="form-control form-control-xs" rows="4" placeholder="Isikan Rincian" required><?= $d_pkd['rincian_pkd'] ?></textarea>
                                <div class="text-danger b i text-xs blink" id="err_rincian"></div>
                            </div>
                            <div class="col-md-2">
                                Tanggal Pelaksanaan: <span style="color:red">*</span><br>
                                <input type="date" class="form-control form-control-xs" name="tgl_pel" id="tgl_pel" value="<?= $d_pkd['tgl_pel_pkd'] ?>" required>
                                <div class="text-danger b i text-xs blink" id="err_tgl_pel"></div>
                            </div>
                            <div class="col-md">
                                File Surat :<span style="color:red">*</span><a href="<?= $d_pkd['file_surat_pkd'] ?>" class="text-xs" download="FILE_PKD">File Sebelumnya</a><br>
                                <div class="custom-file">
                                    <label class="custom-file-label text-xs" for="customFile" id="labelfilesurat">Pilih File</label>
                                    <input type="file" class="custom-file-input mb-1" id="file_surat" name="file_surat" accept="application/pdf" required>
                                    <span class='i text-xs'>Data unggah harus .pdf dan maksimal ukuran file 1 Mb</span><br>
                                    <div class="text-xs font-italic text-danger blink" id="err_file_surat"></div><br>
                                    <script>
                                        $('#file_surat').on('change', function() {
                                            var fileSurat = $(this).val();
                                            fileSurat = fileSurat.replace(/^.*[\\\/]/, '');
                                            if (fileSurat == "") fileSurat = "Pilih File";
                                            $('#labelfilesurat').html(fileSurat);
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                        <!-- Koordinator -->
                        <div class=" row">
                            <div class="col-md-12 text-lg b text-center text-gray-100 badge bg-primary">KORDINATOR</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Nama : <span style="color:red">*</span><br>
                                <input type="text" class="form-control form-control-xs" name="nama_koordinator" id="nama_koordinator" placeholder="Isi Nama Koordinator" value="<?= $d_pkd['nama_kor_pkd'] ?>" required>
                                <span class="text-danger b  i text-xs blink" id="err_nama_koordinator"></span>
                            </div>
                            <div class="col-md-4">
                                Email :<br>
                                <input type="text" class="form-control form-control-xs" name="email_koordinator" id="email_koordinator" placeholder="Isi Email Koordinator" value="<?= $d_pkd['email_kor_pkd'] ?>">
                            </div>
                            <div class="col-md-4">
                                Telpon : <span style="color:red">*</span><br>
                                <input type="number" class="form-control form-control-xs" name="telp_koordinator" id="telp_koordinator" placeholder="Isi Telpon Koordinator" min="1" value="<?= $d_pkd['telp_kor_pkd'] ?>" required>
                                <i style='font-size:12px;'>Isian hanya berupa angka</i>
                                <br><span class="text-danger b  i text-xs blink" id="err_telp_koordinator"></span>
                            </div>
                        </div>

                        <!-- Tombol Ubah Praktik-->
                        <div id="ubah_pkd" class="nav btn justify-content-center text-md">
                            <button type="button" name="ubah" id="ubah" class="btn btn-outline-primary">
                                <i class="fas fa-check-circle"></i>
                                Ubah Data PKD
                                <i class="fas fa-check-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script type="text/javascript">
        $("#ubah").click(function() {

            Swal.fire({
                title: 'Mohon Ditunggu . . .',
                html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100" />',
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            var data_pkd = $('#form_u').serializeArray();
            data_pkd.push({
                name: "idu",
                value: '<?= urlencode(base64_encode($_SESSION['id_user'])) ?>'
            }, {
                name: "idpkd",
                value: '<?= $_GET['pkd'] ?>'
            });

            var pemohon = $("#pemohon").val();
            var rincian = $("#rincian").val();
            var tgl_pel = $("#tgl_pel").val();
            var file_surat = $("#file_surat").val();
            var nama_koordinator = $("#nama_koordinator").val();
            var telp_koordinator = $("#telp_koordinator").val();

            //eksekusi bila file surat terisi
            if (file_surat != "" && file_surat != undefined) {

                //Cari ekstensi file surat yg diupload
                var typeSurat = document.querySelector('#file_surat').value;
                var getTypeSurat = typeSurat.split('.').pop();

                //cari ukuran file surat yg diupload
                var fileSurat = document.getElementById("file_surat").files;
                var getSizeSurat = document.getElementById("file_surat").files[0].size / 1024;

                // console.log("Size Surat : " + getSizeSurat);
                // console.log("Size Surat : " + fileSurat);

                //Toast bila upload file surat selain pdf
                if (getTypeSurat != 'pdf') {

                    Swal.fire({
                        allowOutsideClick: true,
                        showConfirmButton: false,
                        icon: 'warning',
                        title: '<div class="text-md text-center">File Surat Harus <b>.pdf</b></div>',
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    $("#err_file_surat").html("File Surat Harus pdf");
                } //Toast bila upload file surat diatas 1 Mb 
                else if (getSizeSurat > 1024) {
                    Swal.fire({
                        allowOutsideClick: true,
                        showConfirmButton: false,
                        icon: 'warning',
                        title: '<div class="text-md text-center">File Surat Harus <br><b>Kurang dari 1 Mb</b></div>',
                        timer: 10000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    $("#err_file_surat").html("File Surat Harus Kurang dari 1 Mb");
                }
            }

            //Notif Bila tidak diisi
            if (
                pemohon == "" ||
                rincian == "" ||
                tgl_pel == "" ||
                file_surat == "" ||
                file_surat == undefined ||
                nama_koordinator == "" ||
                telp_koordinator == ""
            ) {
                //warning Toast bila ada data wajib yg berlum terisi
                Swal.fire({
                    allowOutsideClick: true,
                    showConfirmButton: false,
                    icon: 'warning',
                    title: '<center>DATA WAJIB ADA YANG BELUM TERISI</center>',
                    timer: 10000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                //notif pemohon 
                if (pemohon == "") {
                    $("#err_pemohon").html("Pemohon Harus Diisi");
                } else {
                    $("#err_pemohon").html("");
                }

                //notif rincian 
                if (rincian == "") {
                    $("#err_rincian").html("Rincian Harus Diisi");
                } else {
                    $("#err_rincian").html("");
                }

                //notif tgl_pel 
                if (tgl_pel == "") {
                    $("#err_tgl_pel").html("Tanggal Pelaksanaan Harus Dipilih");
                } else {
                    $("#err_tgl_pel").html("");
                }

                //notif file_surat 
                if (file_surat == "" || file_surat == undefined) {
                    $("#err_file_surat").html("File Surat Harus Dipilih");
                } else {
                    $("#err_file_surat").html("");
                }

                //notif nama_koordinator
                if (nama_koordinator == "") {
                    $("#err_nama_koordinator").html("Nama Koordinator Harus Diisi");
                } else {
                    $("#err_nama_koordinator").html("");
                }

                //notif telp_koordinator
                if (telp_koordinator == "") {
                    $("#err_telp_koordinator").html("Telpon Koordinator Harus Diisi");
                } else {
                    $("#err_telp_koordinator").html("");
                }
            }
            //simpan data pkd
            else if (
                pemohon != "" &&
                rincian != "" &&
                tgl_pel != "" &&
                file_surat != "" &&
                file_surat != undefined &&
                nama_koordinator != "" &&
                telp_koordinator != "" &&
                getTypeSurat == 'pdf' &&
                getSizeSurat <= 1024
            ) {
                //Simpan Data pkd dan Tarif
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_u_pkd_u.php?",
                    data: data_pkd,
                    dataType: "json",
                    success: function(response) {
                        //ambil data file yang diupload
                        var data_file = new FormData();
                        var xhttp = new XMLHttpRequest();

                        var fileSurat = document.getElementById("file_surat").files;
                        data_file.append("file_surat", fileSurat[0]);
                        data_file.append("id", response.id);
                        data_file.append("q", response.q);
                        xhttp.responseType = 'json';
                        xhttp.open("POST", "_admin/exc/x_u_pkd_uFile.php", true);
                        xhttp.onload = function() {
                            if (xhttp.response == "size") {
                                Swal.fire({
                                    allowOutsideClick: true,
                                    icon: 'warning',
                                    html: '<span class="text-danger text-lg text-center">Ukuran File Terlalu Besar</span>',
                                    showConfirmButton: false,
                                    timer: 5000,
                                    timerProgressBar: true
                                });
                            } else if (xhttp.response == "type") {
                                Swal.fire({
                                    allowOutsideClick: true,
                                    icon: 'warning',
                                    html: '<span class="text-danger text-lg text-center">Tipe File Harus PDF</span>',
                                    showConfirmButton: false,
                                    timer: 5000,
                                    timerProgressBar: true
                                });
                            } else {
                                Swal.fire({
                                    allowOutsideClick: true,
                                    // isDismissed: false,
                                    icon: 'success',
                                    title: '<span class"text-xs"><b>DATA PKD</b><br>Berhasil Tersimpan',
                                    // html: '<a href="?pkd" class="btn btn-outline-primary">OK</a>',
                                    showConfirmButton: false,
                                    timer: 5000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                }).then(
                                    function() {
                                        document.location.href = "?pkd";
                                    }
                                );
                            }
                        }
                        xhttp.send(data_file);


                    },
                    error: function(response) {
                        console.log(response.responseText);
                        alert('eksekusi query gagal');
                    }
                });
            } else console.log("Data Wajib PKD Belum Diisi dan/ tidak sesuai");
        });
    </script>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

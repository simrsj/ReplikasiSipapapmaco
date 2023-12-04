<?php
if (isset($_GET['ptkn']) && isset($_GET['i']) && $d_prvl['c_praktikan'] == "Y") {
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="h3 mb-2 text-gray-800" id="title_praktik">Tambah Data Praktikan</h1>
            </div>
        </div>
        <!-- form Tambah Data Praktikan  -->
        <form class="form-data text-gray-900" method="post" enctype="multipart/form-data" id="form_praktik">
            <div id="data_praktik_input">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">

                        <!-- Jurusan, Jenjang, profesi dan Akreditasi -->
                        <div class="row">
                            <div class="col-3">
                                No. ID PRAKTIKAN (NIM/NPM/NIP) : <span style="color:red">*</span><br>
                                <input type="text" id="no_id" name="no_id" class="form-control" required>
                                <div class="text-danger b i text-xs blink" id="err_no_id"></div>
                            </div>
                            <div class="col">
                                NAMA SISWA/MAHASISWA : <span style="color:red">*</span><br>
                                <input type="text" id="nama" name="nama" class="form-control" required>
                                <div class="text-danger b i text-xs blink" id="err_nama"></div>
                            </div>
                            <div class="col-2">
                                TANGGAL LAHIR : <span style="color:red">*</span><br>
                                <input type="date" id="tgl" name="tgl" class="form-control" required>
                                <div class="text-danger b i text-xs blink" id="err_tgl"></div>
                            </div>
                            <div class="col-2">
                                ALAMAT : <span style="color:red">*</span><br>
                                <textarea id="alamat" name="alamat" id="" class="form-control" rows="1"></textarea>
                                <div class="text-danger b i text-xs blink" id="err_alamat"></div>
                            </div>
                        </div>

                        <!-- Tombol Simpan Praktik-->
                        <div id="simpan_praktik_tarif" class="nav btn justify-content-center">
                            <div id="simpan_praktik_tarif" class="nav btn justify-content-center text-md">
                                <button type="button" name="simpan_praktik" id="simpan_praktik" class="btn btn-outline-success">
                                    <i class="fas fa-check-circle"></i>
                                    Simpan Data Praktikan
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script type="text/javascript">
        $('#jurusan').on('select2:select', function() {
            $('#jenjangData').load('_admin/insert/i_praktikDataJenjang.php?jur=' + $("#jurusan").val());
            $('#jenjangKet').fadeOut(0);
            $('#jenjangData').fadeIn(0);
            $('#profesiData').fadeOut(0);
            $('#profesiKet').fadeIn(0);
        });

        $("#simpan_praktik").click(function() {

            var data_praktik = $('#form_praktik').serializeArray();
            var id = $("#id").val();
            var user = $("#user").val();
            var institusi = $("#institusi").val();
            var kelompok = $("#kelompok").val();
            var jumlah = $("#jumlah").val();
            var jurusan = $("#jurusan").val();
            var jenjang = $("#jenjang").val();
            var profesi = $("#profesi").val();
            var tgl_mulai = $("#tgl_mulai").val();
            var tgl_selesai = $("#tgl_selesai").val();
            var no_surat = $("#no_surat").val();
            var file_surat = $("#file_surat").val();
            var nama_koordinator = $("#nama_koordinator").val();
            var email_koordinator = $("#email_koordinator").val();
            var telp_koordinator = $("#telp_koordinator").val();
            var pilih_mess = $('input[name="pilih_mess"]:checked').val();

            //Notif Bila tidak diisi
            if (
                institusi == "" ||
                kelompok == "" ||
                jumlah == "" ||
                jurusan == "" ||
                jenjang == "" ||
                profesi == "" ||
                tgl_mulai == "" ||
                tgl_selesai == "" ||
                no_surat == "" ||
                file_surat == "" ||
                file_surat == undefined ||
                nama_koordinator == "" ||
                telp_koordinator == "" ||
                pilih_mess == undefined
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

                //notif institusi 
                if (institusi == "") {
                    $("#err_institusi").html("Institusi Harus Dipilih");
                } else {
                    $("#err_institusi").html("");
                }

                //notif kelompok 
                if (kelompok == "") {
                    $("#err_kelompok").html("Nama Kelompok Harus Diisi");
                } else {
                    $("#err_kelompok").html("");
                }

                //notif jumlah 
                if (jumlah == "") {
                    $("#err_jumlah").html("Jumlah Praktik Harus Diisi");
                } else {
                    $("#err_jumlah").html("");
                }

                //notif jurusan 
                if (jurusan == "") {
                    $("#err_jurusan").html("Jurusan Harus Diisi");
                } else {
                    $("#err_jurusan").html("");
                }

                //notif jenjang 
                if (jenjang == "") {
                    $("#err_jenjang").html("Jenjang Harus Diisi");
                } else {
                    $("#err_jenjang").html("");
                }

                //notif profesi 
                if (profesi == "") {
                    $("#err_profesi").html("Profesi Harus Diisi");
                } else {
                    $("#err_profesi").html("");
                }

                //notif tgl_mulai 
                if (tgl_mulai == "") {
                    $("#err_tgl_mulai").html("Tanggal Mulai Praktik Harus Diisi");
                } else {
                    $("#err_tgl_mulai").html("");
                }

                //notif tgl_selesai 
                if (tgl_selesai == "") {
                    $("#err_tgl_selesai").html("Tanggal Selesai Praktik Harus Diisi");
                } else {
                    $("#err_tgl_selesai").html("");
                }

                //notif no_surat 
                if (no_surat == "") {
                    $("#err_no_surat").html("No. Surat Institusi Harus Diisi");
                } else {
                    $("#err_no_surat").html("");
                }

                // notif file_surat
                if (file_surat == "" || file_surat == undefined) {
                    $("#err_file_surat").html("File Surat Harus Unggah");
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

                //notif telp_koordinator
                if (pilih_mess == undefined) {
                    $("#err_pilih_mess").html("Pemakai Harus Dipilih");
                } else {
                    $("#err_pilih_mess").html("");
                }
            }

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
                        title: '<div class="text-md text-center">File Surat Harus <b>.pdf</b></div>'
                    });
                    $("#err_file_surat").html("File Surat Harus pdf");
                } //Toast bila upload file surat diatas 1 Mb 
                else if (getSizeSurat > 1024) {
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
                        title: '<div class="text-md text-center">File Surat Harus <br><b>Kurang dari 1 Mb</b></div>'
                    });
                    $("#err_file_surat").html("File Surat Harus Kurang dari 1 Mb");
                }
            }

            //Alert jika Tanggal Selesai kurang dari tanggal mulai
            if (
                (tgl_selesai <= tgl_mulai) &&
                (tgl_mulai != "" && tgl_selesai != "") ||
                (tgl_mulai == "" && tgl_selesai == "")
            ) {
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
                })

                Toast.fire({
                    icon: 'warning',
                    title: '<center><b>Tanggal Selesai</b> Harus Lebih dari <b>Tanggal Mulai</b></center>'
                })
                $("#err_tgl_selesai").html("<b>Tanggal Selesai</b> Harus Lebih dari <b>Tanggal Mulai</b>");
            }
            //bila tanggal mulai dan selesai sesuai
            else { //Cek Data Ketersediaan Jadwal Praktik
                $.ajax({
                    type: 'POST',
                    url: "_admin/insert/i_praktik_valTgl.php",
                    data: data_praktik,
                    dataType: 'json',
                    success: function(response) {
                        //notif jika jadwal dan/ jumlah praktik melebihi kuota
                        if (response.ket == 'T') {
                            console.log('Jadwal Praktik Tidak Bisa');
                            Swal.fire({
                                allowOutsideClick: false,
                                icon: 'error',
                                showConfirmButton: false,
                                html: '<span class"text-xs"><b>Kuota Jadwal Praktik</b> yang dipilih <b>Penuh</b>' +
                                    '<br>Silahkan Cek Kembali Informasi Jadwal Praktik<br><br>' +
                                    '<a href="?info_diklat" class="btn btn-outline-primary">Cek Informasi Jadwal Praktik</a>',
                                timer: 10000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            }).then(
                                function() {
                                    // document.location.href = "?ptk";
                                }
                            );
                        }
                        //eksekusi bila jadwal tersedia
                        else if (response.ket == 'Y') {
                            console.log('Jadwal Praktik Bisa');
                            //simpan data praktik dan data tarif
                            if (
                                institusi != "" &&
                                kelompok != "" &&
                                jumlah != "" &&
                                jurusan != "" &&
                                jenjang != "" &&
                                profesi != "" &&
                                tgl_mulai != "" &&
                                tgl_selesai != "" &&
                                no_surat != "" &&
                                file_surat != undefined &&
                                getTypeSurat == 'pdf' &&
                                getSizeSurat <= 1024 &&
                                nama_koordinator != "" &&
                                telp_koordinator != "" &&
                                pilih_mess != undefined
                            ) {
                                //push data pilih_mess
                                data_praktik.push({
                                    name: 'pilih_mess',
                                    value: pilih_mess
                                });

                                //Simpan Data Praktik dan Tarif
                                $.ajax({
                                    type: 'POST',
                                    url: "_admin/exc/x_i_praktik_s.php?",
                                    data: data_praktik,
                                    success: function() {
                                        //ambil data file yang diupload
                                        var data_file = new FormData();
                                        var xhttp = new XMLHttpRequest();

                                        var fileSurat = document.getElementById("file_surat").files;
                                        data_file.append("file_surat", fileSurat[0]);

                                        var id = document.getElementById("id").value;
                                        data_file.append("id", id);

                                        xhttp.open("POST", "_admin/exc/x_i_praktik_fileSurat_s.php", true);
                                        xhttp.send(data_file);

                                        Swal.fire({
                                            allowOutsideClick: false,
                                            // isDismissed: false,
                                            icon: 'success',
                                            title: '<span class"text-xs"><b>DATA PRAKTIK</b><br>Berhasil Tersimpan',
                                            showConfirmButton: false,
                                            timer: 5000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                            }
                                        }).then(
                                            function() {
                                                document.location.href = "?ptk";
                                            }
                                        );
                                    },
                                    error: function(response) {
                                        console.log(response.responseText);
                                        alert('eksekusi query gagal');
                                    }
                                });
                            } else console.log("Data Wajib Praktik Belum Diisi dan/ tidak sesuai");
                        } else alert("ERROR CEK TANGGAL PRAKTIK");
                    }
                    // ,
                    // error: function() {
                    //     // console.log(response.responseText);
                    //     alert('eksekusi query Val.Jadwal Praktik gagal');
                    // }
                });
            }
        });
    </script>

<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
// error_reporting(0);
$sql_prvl = "SELECT * FROM tb_user_privileges WHERE id_user = " . decryptString($_GET['id'], $customkey);
$q_prvl = $conn->query($sql_prvl);
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);

$sql_user = "SELECT * FROM tb_user ";
$sql_user .= " ORDER BY tb_user.nama_user ASC";
// echo $sql_user;
$q_user = $conn->query($sql_user);
$r_user = $q_user->rowCount();

if ($r_user > 0) {
?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <div class="table-responsive">
        <table class="table table-striped text-sm" id="dataTable">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">No</th>
                    <th scope="col">Nama Akun</th>
                    <th scope="col">Institusi</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">No. Telp.</th>
                    <th scope="col">Tanggal Dibuat</th>
                    <th scope="col">Tanggal Ubah</th>
                    <th scope="col">Terakhir Login</th>
                    <th scope="col">Level</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aktivasi</th>
                    <th scope="col" width="80px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($d_user = $q_user->fetch(PDO::FETCH_ASSOC)) {

                    $sql_institusi = "SELECT * FROM tb_institusi WHERE id_institusi = " . $d_user['id_institusi'];
                    $q_institusi = $conn->query($sql_institusi);
                    $d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC);
                ?>
                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $d_user['nama_user']; ?></td>
                        <td>
                            <?php
                            if ($d_user['id_institusi'] == 0) {
                                echo "-";
                            } else {
                                echo $d_institusi['nama_institusi'];
                            }
                            ?>
                        </td>
                        <td><?= $d_user['email_user']; ?></td>
                        <td><?= $d_user['no_telp_user']; ?></td>
                        <td class="text-center"><?= $d_user['tgl_buat_user']; ?></td>
                        <td class="text-center"><?= $d_user['tgl_ubah_user']; ?></td>
                        <td class="text-center">
                            <?php
                            if ($d_user['terakhir_login_user'] != "") {
                                echo $d_user['terakhir_login_user'];
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($d_user['level_user'] == 1) {
                            ?>
                                <span class="badge badge-primary">ADMIN</span>
                            <?php
                            } elseif ($d_user['level_user'] == 2) {
                            ?>
                                <span class="badge badge-success">INSITUSI</span>
                            <?php
                            } elseif ($d_user['level_user'] == 3) {
                            ?>
                                <span class="badge badge-warning">KEUANGAN</span>
                            <?php
                            } elseif ($d_user['level_user'] == 4) {
                            ?>
                                <span class="badge badge-primary">PEMBIMBING</span>
                            <?php
                            } elseif ($d_user['level_user'] == 5) {
                            ?>
                                <span class="badge badge-success">PRAKTIKAN</span>
                            <?php
                            } else {
                            ?>
                                <span class="text-danger">ERROR!</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($d_user['status_user'] == 'Y') {
                            ?>
                                <span class="badge badge-success">AKTIF</span>
                            <?php

                            } else if ($d_user['status_user'] == 'T') {
                            ?>
                                <span class="badge badge-danger">TIDAK AKTIF</span>
                            <?php
                            } else {
                            ?>
                                <span class="text-danger">ERROR!</span>

                            <?php
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($d_user['status_aktivasi_user'] == 'Y') {
                            ?>
                                <span class="badge badge-success">AKTIF</span>
                            <?php

                            } else if ($d_user['status_aktivasi_user'] == 'T') {
                            ?>
                                <span class="badge badge-danger">TIDAK AKTIF</span>
                            <?php
                            } else {
                            ?>
                                <span class="text-danger">ERROR!</span>

                            <?php
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                            if ($d_prvl['u_akun'] == 'Y' && $d_user['id_user'] != 1) {
                            ?>
                                <a class="btn btn-primary btn-xs ubah_init" title="Ubah Akun" id="<?= $d_user['id_user']; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                            <?php
                            } else {
                                echo "-";
                            }
                            if ($d_prvl['u_akun'] == 'Y' && $d_user['id_user'] != 1) {
                            ?>
                                <a href="?aku&ha=<?= $d_user['id_user']; ?>" class="btn btn-success btn-xs" title="Hak Akses">
                                    <i class="fas fa-list"></i>
                                </a>
                            <?php
                            } else {
                                echo "-";
                            }
                            if ($d_prvl['d_akun'] == 'Y' && $d_user['id_user'] != 1) {
                            ?>
                                <a class="btn btn-danger btn-xs hapus" title="Hapus Akun" id="<?= $d_user['id_user']; ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            <?php
                            } else {
                                echo "-";
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
} else {
?>
    <h3 class='text-center'> Data Akun Anda Tidak Ada</h3>
<?php
}
?>
<script>
    <?php if ($d_prvl['u_akun'] == "Y") { ?>
        $(".ubah_init").click(function() {
            document.getElementById("err_u_nama").innerHTML = "";
            document.getElementById("err_u_telp").innerHTML = "";
            document.getElementById("err_u_email").innerHTML = "";
            document.getElementById("err_u_username").innerHTML = "";
            document.getElementById("err_u_password").innerHTML = "";
            document.getElementById("err_u_passwordx").innerHTML = "";
            document.getElementById("err_u_level").innerHTML = "";
            document.getElementById("err_u_foto").innerHTML = "";
            document.getElementById("err_u_status").innerHTML = "";
            document.getElementById("form_ubah").reset();

            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: "_admin/view/v_akunGetData.php",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {

                    document.getElementById("form_ubah").reset();

                    $("#u_id_user").val(response.id_user);
                    $("#u_nama").val(response.nama_user);
                    $("#u_telp").val(response.no_telp_user);
                    $("#u_email").val(response.email_user);
                    $("#u_username").val(response.username_user);
                    $('#u_level').val(response.level_user).trigger('change');
                    $('#u_status').val(response.status_user).trigger('change');

                    $("#foto_akun").empty();
                    console.log(response.id_user);
                    if (response.foto_user == '' || response.foto_user == null) {
                        $("#foto_akun").append('FOTO <br> TIDAK ADA');
                    } else {
                        $('#foto_akun')
                            .append(
                                '<img src="' + response.foto_user + '" width="80px" height="80px">'
                            );
                    }

                    $("#file_foto").empty();
                    if (response.foto_user != '' || response.foto_user == null) {
                        $('#file_foto')
                            .append(
                                'Foto Sebelumnya : <a href="' + response.foto_user + '" target="_blank" download>' +
                                '<u><b>UNDUH</b></u>' +
                                '</a>'
                            );
                    }
                },
                error: function(response) {
                    alert(response.responseText);
                    console.log(response.responseText);
                }
            });

            $("#data_ubah").fadeIn(0);
            $("#data_tambah").fadeOut(0);

            var ubahScrollAnimate = $("html, body, input");
            ubahScrollAnimate.stop().animate({
                scrollTop: 0
            }, 500, 'swing', function() {
                $('#u_nama').focus();
            });

        });
        $(".ubah_tutup").click(function() {
            document.getElementById("err_u_nama").innerHTML = "";
            document.getElementById("err_u_telp").innerHTML = "";
            document.getElementById("err_u_email").innerHTML = "";
            document.getElementById("err_u_username").innerHTML = "";
            document.getElementById("err_u_password").innerHTML = "";
            document.getElementById("err_u_passwordx").innerHTML = "";
            document.getElementById("err_u_foto").innerHTML = "";
            document.getElementById("err_u_level").innerHTML = "";
            document.getElementById("err_u_status").innerHTML = "";
            document.getElementById("form_ubah").reset();
            $("#data_ubah").fadeOut(0);
        });
        $(document).on('click', '.ubah', function() {
            var data = $('#form_ubah').serialize();

            var nama = $("#u_nama").val();
            var telp = $("#u_telp").val();
            var email = $("#u_email").val();
            var username = $("#u_username").val();
            var level = $('#u_level').val();
            var status = $('#u_status').val();
            var password = $('#u_password').val();
            var passwordx = $('#u_passwordx').val();
            var foto = $('#u_foto').val();

            //cek data from tambah bila tidak diiisi
            if (
                nama == "" ||
                telp == "" ||
                email == "" ||
                username == "" ||
                password == "" ||
                passwordx == "" ||
                password != passwordx ||
                level == "" ||
                status == ""
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
                });

                Toast.fire({
                    icon: 'warning',
                    title: '<div class="text-md text-center">Data Wajib ada yang belum diisi</div>'
                });

                if (nama == "") {
                    document.getElementById("err_u_nama").innerHTML = "Nama Harus Diisi";
                } else {
                    document.getElementById("err_u_nama").innerHTML = "";
                }

                if (telp == "") {
                    document.getElementById("err_u_telp").innerHTML = "Telepon Harus Diisi";
                } else {
                    document.getElementById("err_u_telp").innerHTML = "";
                }

                if (email == "") {
                    document.getElementById("err_u_email").innerHTML = "Email Harus Diisi";
                } else {
                    document.getElementById("err_u_email").innerHTML = "";
                }

                if (username == "") {
                    document.getElementById("err_u_username").innerHTML = "Username Harus Diisi";
                } else {
                    document.getElementById("err_u_username").innerHTML = "";
                }

                if (password == "") {
                    document.getElementById("err_u_password").innerHTML = "Password Harus Diisi";
                } else {
                    document.getElementById("err_u_password").innerHTML = "";
                }

                if (passwordx == "") {
                    document.getElementById("err_u_passwordx").innerHTML = "Ulangi Password Harus Diisi";
                } else {
                    document.getElementById("err_u_passwordx").innerHTML = "";
                }

                if (password != passwordx) {
                    document.getElementById("err_u_password").innerHTML = "Password Tidak Sama";
                    document.getElementById("err_u_passwordx").innerHTML = "Password Tidak Sama";
                }

                if (level == "") {
                    document.getElementById("err_u_level").innerHTML = "Level Harus Dpilih";
                } else {
                    document.getElementById("err_u_level").innerHTML = "";
                }

                if (status == "") {
                    document.getElementById("err_u_status").innerHTML = "Level Harus Dpilih";
                } else {
                    document.getElementById("err_u_status").innerHTML = "";
                }
            }

            //eksekusi bila data wajib terisi dan sesuai
            if (
                nama != "" &&
                telp != "" &&
                email != "" &&
                username != "" &&
                password != "" &&
                passwordx != "" &&
                password == passwordx &&
                level != "" &&
                status != ""
            ) {

                //eksekusi bila file Foto terisi
                if (foto != "") {

                    //Cari ekstensi file Foto yg diupload
                    var typeFoto = document.querySelector('#u_foto').value;
                    var getTypeFoto = typeFoto.split('.').pop();

                    //cari ukuran file Foto yg diupload
                    var getSizeFoto = document.getElementById("u_foto").files[0].size / 1024;

                    //Toast bila upload Foto selain png/jpg/jpeg
                    if (getTypeFoto != 'png' && getTypeFoto != 'jpg' && getTypeFoto != 'jpeg') {
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
                            title: '<div class="text-md text-center">Foto Harus <b>.png</b>/<b>.jpg</b>/<b>.jpeg</b></div>'
                        });
                        document.getElementById("err_u_foto").innerHTML = "Foto Harus PNG/JPG/JPEG";
                    } //Toast bila upload file Foto diatas 200 Kb 
                    else if (getSizeFoto > 256) {
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
                            title: '<div class="text-md text-center">Ukuran File Foto Harus <br><b>Kurang dari 200 Kb </b></div>'
                        });
                        document.getElementById("err_u_foto").innerHTML = "Ukuran Foto Harus Kurang dari 200 Kb ";
                    } //eksekusi  jika foto sesuai 
                    else {
                        $.ajax({
                            type: 'POST',
                            url: "_admin/exc/x_v_akun_u.php",
                            data: data,
                            success: function() {

                                $('#data_akun').load('_admin/view/v_akunData.php?id=<?= $_GET['id'] ?>');

                                var data_file = new FormData();
                                var xhttp = new XMLHttpRequest();

                                var foto = document.getElementById("u_foto").files;
                                data_file.append("u_foto", foto[0]);

                                var u_id_user = document.getElementById("u_id_user").value;
                                data_file.append("id_user", u_id_user);

                                var foto_asal = document.getElementById("foto_asal").value;
                                data_file.append("foto_asal", foto_asal);

                                xhttp.open("POST", "_admin/exc/x_v_akun_sFile.php", true);
                                xhttp.send(data_file);

                                Swal.fire({
                                    allowOutsideClick: false,
                                    icon: 'success',
                                    title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Diubah</b></div>',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    }
                                });
                                document.getElementById("err_u_nama").innerHTML = "";
                                document.getElementById("err_u_telp").innerHTML = "";
                                document.getElementById("err_u_email").innerHTML = "";
                                document.getElementById("err_u_username").innerHTML = "";
                                document.getElementById("err_u_password").innerHTML = "";
                                document.getElementById("err_u_passwordx").innerHTML = "";
                                document.getElementById("err_u_level").innerHTML = "";
                                document.getElementById("form_ubah").reset();
                                $("#u_level").val("").trigger("change");
                                $("#u_status").val("").trigger("change");
                                $("#data_ubah").fadeOut(0);
                            },
                            error: function(response) {
                                console.log(response.responseText);
                            }
                        });
                    }
                } //eksekusi jika foto tidak ada 
                else {
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_v_akun_u.php",
                        data: data,
                        success: function() {

                            $('#data_akun').load('_admin/view/v_akunData.php?id=<?= $_GET['id'] ?>');

                            Swal.fire({
                                allowOutsideClick: false,
                                icon: 'success',
                                title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Diubah</b></div>',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            });

                            document.getElementById("err_u_nama").innerHTML = "";
                            document.getElementById("err_u_telp").innerHTML = "";
                            document.getElementById("err_u_email").innerHTML = "";
                            document.getElementById("err_u_username").innerHTML = "";
                            document.getElementById("err_u_password").innerHTML = "";
                            document.getElementById("err_u_passwordx").innerHTML = "";
                            document.getElementById("err_u_level").innerHTML = "";
                            document.getElementById("err_u_foto").innerHTML = "";
                            document.getElementById("form_tambah").reset();
                            $("#u_status").val("").trigger("change");
                            $("#u_level").val("").trigger("change");
                            $("#data_ubah").fadeOut(0);
                        },
                        error: function(response) {
                            console.log(response.responseText);
                        }
                    });
                }
            }
        });
    <?php } ?>

    <?php if ($d_prvl['d_akun'] == "Y") { ?>
        $(document).on('click', '.hapus', function() {
            Swal.fire({
                position: 'top',
                title: 'Hapus Data ?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#1cc88a',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Kembali',
                confirmButtonText: 'Ya',
                allowOutsideClick: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_v_akun_d.php",
                        data: {
                            "id_user": $(this).attr('id')
                        },
                        success: function() {
                            $('#data_akun').load('_admin/view/v_akunData.php?id=<?= $_GET['id']; ?>');

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            });

                            Toast.fire({
                                icon: 'success',
                                title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Dihapus</div>'
                            });
                        },
                        error: function(response) {
                            console.log(response.responseText);
                            alert('eksekusi query gagal');
                        }
                    });
                }
            });
        });
    <?php } ?>
    $('.loader').hide();
</script>
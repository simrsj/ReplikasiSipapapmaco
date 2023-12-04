<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

if (isset($_GET['forgot_pass_user'])) {
    $crypt_decode = base64_decode(urldecode($_GET['crypt']));
    // echo $crypt_decode . "<br>";
    $arr = explode("_",  $crypt_decode);
    // echo "<pre>";
    // echo print_r($arr);
    // echo "</pre>";

    $sql_cek_hass_pass = "SELECT * FROM tb_user";
    $sql_cek_hass_pass .= " WHERE hash_password_user = '" . urlencode($_GET['crypt']) . "'";
    // echo "<br>" . $sql_cek_hass_pass;
    try {
        $q_cek_hass_pass = $conn->query($sql_cek_hass_pass);
        $d_cek_hass_pass = $q_cek_hass_pass->fetch(PDO::FETCH_ASSOC);
        $r_cek_hass_pass = $q_cek_hass_pass->rowCount();
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA HASH PASSWORD USER-');";
        echo "document.location.href='?error404';</script>";
    }
    if ($r_cek_hass_pass > 0) {
?>
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-6 col-lg-6 col-md-5">
                    <div class="card card-md o-hidden border-0 shadow-lg my-2">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-md">
                                    <div class="p-3">
                                        <div class="text-center">
                                            <div class="h6 text-gray-900 b">MASUKAN <i>PASSWORD</i> BARU</div>
                                            <form class="form-group" id="f_forgot_pass">
                                                <input class="form-control mb-2" type="password" id="password" name="password" placeholder="isi password" required>
                                                <div class="text-xs text-danger i blink mb-2" id="err_password"></div>
                                                <input class="form-control mb-2" type="password" id="password_u" name="password_u" placeholder="isi ulangi password" required>
                                                <div class="text-xs text-danger i blink mb-2" id="err_password_u"></div>
                                                <a class="btn btn-outline-success col password" id="simpan"><i class="fa-solid fa-key"></i> Simpan Password</a>
                                            </form>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $('#err_email').empty();
                                                $("#f_forgot_pass").trigger("reset");
                                            });

                                            $(document).on('click', '.password', async function() {
                                                var password = $('#password').val();
                                                var password_u = $('#password_u').val();
                                                Swal.fire({
                                                    title: 'Mohon Ditunggu . . .',
                                                    html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100" />' +
                                                        '  <p>Harap Tunggu</p>',
                                                    // add html attribute if you want or remove
                                                    showConfirmButton: false,
                                                });
                                                //cek data from bila tidak diiisi
                                                if (
                                                    password == "" ||
                                                    password_u == ""
                                                ) {
                                                    if (password == "") $("#err_password").html("Password Harus Diisi");
                                                    else $("#err_password").html("");

                                                    if (password_u == "") $("#err_password_u").html("Ulangi Password Harus Diisi");
                                                    else $("#err_password_u").html("");

                                                    Swal.fire({
                                                        icon: 'warning',
                                                        title: 'Data Ada yang Belum Terisi',
                                                        allowOutsideClick: true,
                                                        showConfirmButton: false,
                                                    });
                                                }

                                                //simpan data registrasi bila sudah sesuai
                                                if (
                                                    password != "" &&
                                                    password_u != ""
                                                ) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: "_log-sign/exc/x_lupa_password_baru.php",
                                                        data: {
                                                            'idu': '<?= urlencode(base64_encode($arr[1])); ?>',
                                                            'password': password,
                                                            'password_u': password_u
                                                        },
                                                        dataType: 'JSON',
                                                        success: function(response) {
                                                            if (response.ket == 'Y') {
                                                                console.log(response.ket);
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    html: '<div class="b"><i>Reset Password</i> Berhasil Disimpan</div><hr>' +
                                                                        'Silahkan Lakukan <b>LOGIN</b> <br><a href="?login" class="btn btn-outline-primary mt-2">Klik Disini</a>',
                                                                    showConfirmButton: false,
                                                                    timer: 10000,
                                                                    timerProgressBar: true,
                                                                    didOpen: (toast) => {
                                                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                                    }
                                                                });
                                                            } else if (response.ket == 'T') {
                                                                Swal.fire({
                                                                    icon: 'warning',
                                                                    html: '<div class="b"><i>Reset Password</i> Gagal</div><hr>' +
                                                                        'Cek kembali <b><i>Password</i></b> dan Ulangi <b><i>Password</i></b>',
                                                                    showConfirmButton: false,
                                                                    timer: 10000,
                                                                    timerProgressBar: true,
                                                                    didOpen: (toast) => {
                                                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                                    }
                                                                });
                                                            } else {
                                                                Swal.fire({
                                                                    icon: 'ERROR',
                                                                    title: 'ERROR!!!',
                                                                    showConfirmButton: false,
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    } else {
        echo "<script>alert('Not Found');document.location.href='?error404';</script>";
    }
} else {
    echo "<script>alert('Unauthorized');document.location.href='?error401';</script>";
}

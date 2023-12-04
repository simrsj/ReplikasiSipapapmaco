<?php
if (isset($_GET['act_user']) && isset($_GET['crypt'])) {

    $crypt_decode = base64_decode(urldecode(hex2bin($_GET['crypt'])));
    // echo $crypt_decode . "<br>";
    $arr = explode("*sm*",  $crypt_decode);
    $id_user = base64_decode(urldecode(hex2bin($arr[1])));
    // echo "<pre>";
    // echo print_r($arr);
    // echo "</pre>";

    $sql_akun = "SELECT * FROM tb_user";
    $sql_akun .= " WHERE id_user = " . $id_user;
    // echo "<br>" . $sql_akun;
    try {
        $q_akun = $conn->query($sql_akun);
    } catch (Exception $ex) {
        echo "<script>alert('ERROR DATA USER');";
        echo "document.location.href='?error404';</script>";
    }
    $r_akun = $q_akun->rowCount();

    //jika data akun aktivasi ada di database
    if ($r_akun > 0) {

        $sql_u_aktivasi = "UPDATE tb_user SET";
        $sql_u_aktivasi .= " status_aktivasi_user = 'Y'";
        $sql_u_aktivasi .= " WHERE id_user = " . $id_user;
        // echo "<br>" . $sql_u_aktivasi;

        $sql_u_aktivasi_privilages = "UPDATE tb_user_privileges SET";
        $sql_u_aktivasi_privilages .= " c_praktik = 'Y',";
        $sql_u_aktivasi_privilages .= " r_praktik = 'Y',";
        $sql_u_aktivasi_privilages .= " c_praktikan = 'Y',";
        $sql_u_aktivasi_privilages .= " r_praktikan = 'Y',";
        $sql_u_aktivasi_privilages .= " u_praktikan = 'Y',";
        $sql_u_aktivasi_privilages .= " d_praktikan = 'Y',";
        $sql_u_aktivasi_privilages .= " r_praktik_mess = 'Y',";
        $sql_u_aktivasi_privilages .= " r_praktik_pembimbing = 'Y',";
        // $sql_u_aktivasi_privilages .= " r_praktik_tarif = 'Y',";
        $sql_u_aktivasi_privilages .= " c_praktik_bayar = 'Y',";
        $sql_u_aktivasi_privilages .= " r_praktik_bayar = 'Y',";
        $sql_u_aktivasi_privilages .= " u_praktik_bayar = 'Y',";
        $sql_u_aktivasi_privilages .= " d_praktik_bayar = 'Y',";
        $sql_u_aktivasi_privilages .= " r_praktik_nilai = 'Y',";
        $sql_u_aktivasi_privilages .= " r_arsip_praktik = 'Y',";
        $sql_u_aktivasi_privilages .= " c_arsip_praktik = 'Y'";
        $sql_u_aktivasi_privilages .= " WHERE id_user = " . $id_user;
        // echo "<br>" . $sql_u_aktivasi_privilages;
        try {
            $conn->query($sql_u_aktivasi);
            $conn->query($sql_u_aktivasi_privilages);
        } catch (Exception $ex) {
            echo "<script>alert('$ex -DATA AKTIVASI USER-');";
            echo "document.location.href='?error404';</script>";
        }
?>
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-7 col-md-5">
                    <div class="card card-md o-hidden border-0 shadow-lg my-2">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-md">
                                    <div class="p-3">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900">Registrasi Akun Berhasil DI <span class="badge badge-primary"> AKTIVASI</span></h1>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <h3 class="h4 text-gray-900">Silahkan Lakukan <span class="badge badge-primary">LOGIN</span></h3>
                                        </div>
                                        <div class="text-center">
                                            <a class="btn btn-outline-primary" href="?login">LOGIN</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
    //jika data akun aktivasi tidak ada di database
    else {
        echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
    }
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

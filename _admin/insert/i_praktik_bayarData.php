<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
//data privileges 
$sql_prvl = "SELECT * FROM tb_user_privileges ";
$sql_prvl .= " JOIN tb_user ON tb_user_privileges.id_user = tb_user.id_user";
$sql_prvl .= " WHERE tb_user.id_user = " . base64_decode(urldecode($_GET['idu']));
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);
if ($d_prvl['c_praktik_bayar'] == 'Y') {

    //query data praktik
    $sql_praktik = "SELECT * FROM tb_praktik ";
    $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
    $sql_praktik .= " WHERE id_praktik = " . base64_decode(urldecode($_GET['idp']));
    try {
        $q_praktik = $conn->query($sql_praktik);
        $d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PRAKTIK-');document.location.href='?error404';</script>";
    }

    //data tarif praktik
    $sql_bayar = "SELECT * FROM tb_bayar";
    $sql_bayar .= " WHERE id_praktik = '" . base64_decode(urldecode($_GET['idp'])) . "'";
    // echo $id_praktik . "<br>";

    try {
        $q_bayar = $conn->query($sql_bayar);
    } catch (Exception $ex) {
        echo "<script> alert('$ex -DATA BAYAR-'); ";
        echo "document.location.href='?error404'; </script>";
    }
    $r_bayar = $q_bayar->rowCount();

    if ($r_bayar > 0) {

?>
        <div class="table-responsive">
            <div class="row col-lg h4 mb-2 text-gray-800">Data Pembayaran </div>
            <table class="table table-hover  text-md">
                <thead class="table-dark text-md">
                    <tr>
                        <th>No</th>
                        <th>Atas Nama</th>
                        <th>Pembayaran Melalui</th>
                        <th>Nomor Rekening/Transfer</th>
                        <th>Tanggal Transfer</th>
                        <th>File Bukti Pembayaran</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <?php if ($d_prvl['level_user'] == "1") { ?>
                            <th>Verifikasi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($d_bayar = $q_bayar->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $d_bayar['atas_nama_bayar']; ?></td>
                            <td><?= $d_bayar['melalui_bayar']; ?></td>
                            <td><?= $d_bayar['noRek_bayar']; ?></td>
                            <td><?= tanggal($d_bayar['tgl_transfer_bayar']); ?></td>
                            <td> <a href="<?= $d_bayar['file_bayar']; ?>" class="btn btn-outline-success btn-sm" download="bukti file pembayaran">Unduh File</a></td>
                            <td><?= $d_bayar['ket_bayar']; ?></td>
                            <td>
                                <?php if ($d_bayar['status_bayar'] == 'T') { ?>
                                    <span class="badge badge-primary">Proses<br>Verifikasi</span>
                                <?php } elseif ($d_bayar['status_bayar'] == 'TERIMA') { ?>
                                    <span class="badge badge-success">Diterima</span>
                                <?php } elseif ($d_bayar['status_bayar'] == 'TOLAK') { ?>
                                    <span class="badge badge-danger">Ditolak</span>
                                <?php } else { ?>
                                    <span class="badge badge-danger">ERROR</span>
                                <?php } ?>
                            </td>
                            <?php if ($d_prvl['level_user'] == "1") { ?>
                                <!-- verfikasi pembayaran  -->
                                <td>
                                    <!-- tombol modal detail praktik  -->
                                    <a title="verifikasi" class='btn btn-outline-primary btn-sm' href='#' data-toggle="modal" data-target="#verifikasi<?= md5($d_bayar['id_bayar']); ?>">
                                        Klik
                                    </a>
                                    <!-- modal detail praktik  -->
                                    <div class="modal fade" id="verifikasi<?= md5($d_bayar['id_bayar']); ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md text-left">
                                                            Verifikasi Data Pembayaran ?
                                                        </div>
                                                        <div class="col-md text-right">
                                                            <form id="form_verif" method="POST">
                                                                <a class="btn btn-outline-success btn-sm verif<?= md5($d_bayar['id_bayar']); ?>" id="TERIMA" data-dismiss="modal">
                                                                    Terima
                                                                </a>
                                                                <a class="btn btn-outline-danger btn-sm verif<?= md5($d_bayar['id_bayar']); ?>" id="TOLAK" data-dismiss="modal">
                                                                    Tolak
                                                                </a>
                                                                <a class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                                    Kembali
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        <?php if ($d_prvl['level_user'] == "1") { ?>
                                            //arsip
                                            $(document).on('click', '.verif<?= md5($d_bayar['id_bayar']); ?>', function() {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "_admin/exc/x_i_praktik_bayar_verifkasi.php",
                                                    data: {
                                                        "status": $(this).attr('id'),
                                                        "idb": '<?= urlencode(base64_encode($d_bayar['id_bayar'])); ?>',
                                                    },
                                                    success: function() {
                                                        console.log('berhasil verifikasi')

                                                        $('#verifikasi<?= md5($d_bayar['id_bayar']); ?>').on('hidden.bs.modal', function(e) {
                                                            $('#data_bayar')
                                                                .load(
                                                                    "_admin/insert/i_praktik_bayarData.php?" +
                                                                    "idu=<?= $_GET['idu'] ?>" +
                                                                    "&idp=<?= $_GET['idp'] ?>"
                                                                );
                                                        });
                                                        const Toast = Swal.mixin({
                                                            toast: true,
                                                            position: 'top-end',
                                                            showConfirmButton: false,
                                                            timer: 2500,
                                                            timerProgressBar: true,
                                                            didOpen: (toast) => {
                                                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                            }
                                                        });

                                                        Toast.fire({
                                                            icon: 'success',
                                                            title: 'Data Berhasil Diverifkasi'
                                                        });
                                                    },
                                                    error: function(response) {
                                                        console.log(response.responseText);
                                                        alert('eksekusi query gagal');
                                                    }
                                                });
                                            });
                                        <?php } ?>
                                    </script>
                                </td>
                            <?php } ?>
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
        <h3 class="text-center jumbotron jumbotron-fluid"> Data Pemabayaran Tidak Ada</h3>
<?php
    }
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

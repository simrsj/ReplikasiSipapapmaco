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
// echo $sql_prvl . "<br>";
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);

if ($d_prvl['r_praktik_bayar'] == "Y") {
    $sql_praktik_bayar = "SELECT * FROM tb_praktik ";
    $sql_praktik_bayar .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
    $sql_praktik_bayar .= " WHERE status_praktik = 'Y'";
    if ($d_prvl['level_user'] == 2) {
        $sql_praktik_bayar .= " AND tb_praktik.id_institusi = " . $d_prvl['id_institusi'];
    }
    $sql_praktik_bayar .= " ORDER BY tb_praktik.id_praktik DESC";
    // echo $sql_praktik_bayar . "<br>";
    try {
        $q_praktik_bayar = $conn->query($sql_praktik_bayar);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PRAKTIK-');";
        echo "document.location.href='?error404';</script>";
    }
    $r_praktik_bayar = $q_praktik_bayar->rowCount();
    if ($r_praktik_bayar > 0) {
?>
        <div class="table-responsive text-md">
            <table class="table table-striped table-bordered m-auto display" width="100%" id="table-search-each">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <?php if ($d_prvl['level_user'] == 1) { ?>
                            <th> Nama Institusi </th>
                        <?php } ?>
                        <th>Nama<br>Kelompok</th>
                        <th>Kode<br>Bayar</th>
                        <th>Tgl Mulai<br>(YYYY-MM-DD)</th>
                        <th>Tgl Selesai<br>(YYYY-MM-DD)</th>
                        <th>Status</th>
                        <th width="120px">Data<br>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($d_praktik_bayar = $q_praktik_bayar->fetch(PDO::FETCH_ASSOC)) {
                        //sql tarif pilih
                        $sql_tarif_pilih = "SELECT * FROM tb_tarif_pilih";
                        $sql_tarif_pilih .= " WHERE id_praktik = " . $d_praktik_bayar['id_praktik'];
                        $sql_tarif_pilih .= " AND status_tarif_pilih = 'Y'";
                        // echo $sql_tarif_pilih . "<br>";
                        try {
                            $q_tarif_pilih = $conn->query($sql_tarif_pilih);
                        } catch (Exception $ex) {
                            echo "<script> alert('$ex -DATA TARIF PILIH-'); ";
                            echo "document.location.href='?error404'; </script>";
                        }
                        $r_tarif_pilih = $q_tarif_pilih->rowCount();

                        //sql bayar
                        $sql_bayar = "SELECT * FROM tb_bayar";
                        $sql_bayar .= " WHERE id_praktik = " . $d_praktik_bayar['id_praktik'];
                        $sql_bayar .= " ORDER BY tgl_input_bayar DESC";
                        // echo $sql_bayar . "<br>";
                        try {
                            $q_bayar = $conn->query($sql_bayar);
                        } catch (Exception $ex) {
                            echo "<script> alert('$ex -DATA BAYAR-'); ";
                            echo "document.location.href='?error404'; </script>";
                        }
                        $d_bayar = $q_bayar->fetch(PDO::FETCH_ASSOC);
                        $r_bayar = $q_bayar->rowCount();
                    ?>
                        <tr class="text-center">
                            <td class="align-middle"><?= $no; ?></td>
                            <?php if ($d_prvl['level_user'] == 1) { ?>
                                <td class="align-middle"> <?= $d_praktik_bayar['nama_institusi'] ?> </td>
                            <?php } ?>
                            <td class="align-middle"> <?= $d_praktik_bayar['nama_praktik'] ?> </td>
                            <td class="align-middle">
                                <span class="badge badge-danger">
                                    <?= $d_praktik_bayar['kode_bayar_praktik'] ?>
                                </span>
                            </td>
                            <td class="align-middle"> <?= $d_praktik_bayar['tgl_mulai_praktik'] ?> </td>
                            <td class="align-middle"> <?= $d_praktik_bayar['tgl_selesai_praktik'] ?> </td>
                            <td class="align-middle">
                                <?php
                                #status
                                // jika tarif belum ada 

                                if ($r_tarif_pilih < 1) {
                                ?>
                                    <span class="badge badge-secondary">Tarif <br>Belum Dipilih</span>
                                <?php
                                }
                                // jika tarif sudah ada dan belum dibayar 
                                else if ($r_tarif_pilih > 0 && $r_bayar < 1) {
                                ?>
                                    <span class="badge badge-danger">Belum Dibayar</span>
                                <?php
                                }
                                // jika tarif sudah ada dan sudah dibayar, menuggu verifikasi admin
                                else if ($r_tarif_pilih > 0 && $r_bayar > 0 && $d_bayar['status_bayar'] == 'T') {
                                ?>
                                    <span class="badge badge-primary">Proses<br>Verifikasi</span>
                                <?php
                                }
                                // jika tarif sudah ada dan sudah dibayar, menuggu verifikasi admin
                                else if ($r_tarif_pilih > 0 && $r_bayar > 0 && $d_bayar['status_bayar'] == 'TERIMA') {
                                ?>
                                    <span class="badge badge-success">Verifikasi<br>Berhasil</span>
                                <?php
                                }
                                // jika tarif sudah ada dan sudah dibayar, verifikasi gagal oleh admin
                                else if ($r_tarif_pilih > 0 && $r_bayar > 0 && $d_bayar['status_bayar'] == 'TOLAK') {
                                ?>
                                    <span class="badge badge-danger">Verifikasi<br>Gagal</span>
                                <?php
                                } else {
                                ?>
                                    <span class="badge badge-danger">ERROR</span>
                                <?php
                                }

                                ?>
                            </td>
                            <td class="align-middle">
                                <?php
                                if ($r_tarif_pilih > 0) {
                                ?>
                                    <a class="btn btn-outline-success" href="?pbyr=<?= urlencode(base64_encode($d_praktik_bayar['id_praktik'])) ?>&i">
                                        <i class="fa-solid fa-money-bill"></i> Cek
                                    </a>
                                <?php
                                } else if ($r_tarif_pilih < 1) {
                                ?>
                                    <span class="badge badge-secondary">Tarif<br>Belum Dipilih</span>
                                <?php
                                } else {
                                ?>
                                    <span class="badge badge-danger">ERROR</span>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        $no++;
                        ?>
                    <?php
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <?php if ($d_prvl['level_user'] == 1) { ?>
                            <th></th>
                        <?php } ?>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php
    } else {
    ?>
        <h3 class="text-center jumbotron jumbotron-fluid"> Data Bayar Tidak Ada</h3>
<?php
    }
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

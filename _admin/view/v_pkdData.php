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
if ($d_prvl['c_pkd'] == "Y") {
    $sql_pkd = "SELECT * FROM tb_pkd ";
    $sql_pkd .= " ORDER BY tgl_tambah_pkd DESC";
    // echo $sql_pkd."<br>";
    try {
        $q_pkd = $conn->query($sql_pkd);
        $r_pkd = $q_pkd->rowCount();
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PKD NARSUM-');";
        echo "document.location.href='?error404';</script>";
    }
    if ($r_pkd > 0) {
?>
        <div class="table-responsive text-md">
            <!-- <div class="h6 b text-center">
                Hilang/Munculkan Kolom Tabel:
                <div class="m-1">
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="1">Nama Institusi</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="2">Nama Institusi</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="3">Nama Institusi</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="4">Nama Institusi</a>
                </div>
            </div> 
            <hr>-->
            <table class="table table-striped table-bordered m-auto display" width="100%" id="table-search-each">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No<br><br></th>
                        <th>Pemohon<br><br></th>
                        <th width="30%">Rincian<br><br></th>
                        <th>Tgl<br>Pelaksanaan<br><br></th>
                        <th>Nama<br>Koordinator<br><br></th>
                        <th>Telpon<br>Koordinator<br><br></th>
                        <th>E-Mail<br>Koordinator<br><br></th>
                        <th>Biaya/Tarif<br><br></th>
                        <th>File<br>Surat<br><br></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($d_pkd = $q_pkd->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr class="text-center">
                            <td class="align-middle"><?= $no; ?></td>
                            <td class="align-middle"><?= $d_pkd['nama_pemohon_pkd'] ?></td>
                            <td class="align-middle"><?= $d_pkd['rincian_pkd'] ?></td>
                            <td class="align-middle"><?= tanggal($d_pkd['tgl_pel_pkd']) ?></td>
                            <td class="align-middle"><?= $d_pkd['nama_kor_pkd'] ?></td>
                            <td class="align-middle"><?= $d_pkd['telp_kor_pkd'] ?></td>
                            <td class="align-middle"><?= $d_pkd['email_kor_pkd'] ?></td>
                            <td class="align-middle b">
                                <?php
                                $sql_pkdt = "SELECT * FROM tb_pkd_tarif";
                                $sql_pkdt .= " WHERE id_pkd = " . $d_pkd['id_pkd'];
                                // echo $sql_pkdt."<br>";
                                $sql_pkdtt = "SELECT SUM(total_pkd_tarif) AS total FROM tb_pkd_tarif WHERE id_pkd = " . $d_pkd['id_pkd'];
                                // echo $sql_pkdtt . "<br>";
                                try {
                                    $q_pkdt = $conn->query($sql_pkdt);
                                    $q_pkdtt = $conn->query($sql_pkdtt);
                                    $d_pkdtt = $q_pkdtt->fetch(PDO::FETCH_ASSOC);
                                    $r_pkdt = $q_pkdt->rowCount();
                                } catch (Exception $ex) {
                                    echo "<script>alert('$ex -DATA PKD NARSUM-');";
                                    echo "document.location.href='?error404';</script>";
                                }
                                if ($r_pkdt > 0) {
                                ?>
                                    <?= "Rp " . number_format($d_pkdtt['total'], 0, '.', '.'); ?>
                                <?php
                                } else {
                                ?>
                                    <span class="badge badge-danger">Data Biaya/Tarif Tidak Ada</span>
                                <?php
                                }
                                ?>
                                <br>
                                <!-- Tombol Modal Biaya/Tarif  -->

                                <a title="Rincian Biaya/Tarif" class='btn btn-outline-info btn-sm ' href='?pkd=<?= urlencode(base64_encode($d_pkd['id_pkd'])) ?>&pkdt'>
                                    <i class="fa-solid fa-circle-info"></i> Rincian
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="<?= $d_pkd['file_surat_pkd'] ?>" class="btn btn-outline-primary btn-sm" download="file_pkd">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            </td>
                            <td class="align-middle">
                                <div class="btn-group" role="group">
                                    <?php if ($d_prvl['u_pkd'] == 'Y') { ?>
                                        <!-- tombol modal ubah tarif  -->
                                        <a title="Ubah" class='btn btn-outline-primary btn-sm' href='?pkd=<?= urlencode(base64_encode($d_pkd['id_pkd'])) ?>&u'>
                                            <i class="far fa-edit"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($d_prvl['d_pkd'] == 'Y') { ?>
                                        <!-- tombol modal hapus pilih tarif  -->
                                        <a title="Hapus" class='btn btn-outline-danger btn-sm' href='#' data-toggle="modal" data-target="#md<?= $no; ?>">
                                            <i class="far fa-trash-alt"></i>
                                        </a>

                                        <!-- modal hapus pilih tarif  -->
                                        <div class="modal fade text-center" id="md<?= $no; ?>">
                                            <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-body h5">
                                                        <div class="row">
                                                            <div class="col-lg text-left">
                                                                Hapus Data PKD ?
                                                            </div>
                                                            <div class="col-lg text-right">
                                                                <a class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                                                                    Kembali
                                                                </a>
                                                                &nbsp;
                                                                <a class="btn btn-outline-danger btn-sm hapus<?= $no; ?>" id="<?= urlencode(base64_encode($d_pkd['id_pkd'])); ?>" data-dismiss="modal">
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <script>
                                        <?php if ($d_prvl['d_pkd'] == 'Y') { ?>
                                            // hapus data tarif 
                                            $(document).on('click', '.hapus<?= $no; ?>', function() {
                                                console.log("hapus data tarif Pilih");
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "_admin/exc/x_v_pkd_h.php",
                                                    data: {
                                                        "idpkd": $(this).attr('id'),
                                                        "idu": "<?= $_GET['idu'] ?>"
                                                    },
                                                    success: function() {
                                                        Swal.fire({
                                                            allowOutsideClick: true,
                                                            showConfirmButton: false,
                                                            backdrop: true,
                                                            icon: 'success',
                                                            html: '<div class="text-lg b">Data PKD <br>Berhasil Dihapus</div>',
                                                            timer: 5000,
                                                            timerProgressBar: true,
                                                        }).then(
                                                            function() {
                                                                Swal.fire({
                                                                    title: 'Mohon Ditunggu . . .',
                                                                    html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100">',
                                                                    // add html attribute if you want or remove
                                                                    allowOutsideClick: false,
                                                                    showConfirmButton: false,
                                                                    backdrop: true,
                                                                });
                                                                $('#data_pdk')
                                                                    .load("_admin/view/v_pkdData.php?&idu=<?= $_GET['idu']; ?>");
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
                                        <?php } ?>
                                    </script>
                                </div>
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script>
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
                    <h5 class="text-center"> Data PKD Tidak Ada</h5>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</>";
}

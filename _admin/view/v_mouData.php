<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_admin/dashboard_adminData.php";

try {
    $sql_mou = "SELECT * FROM tb_kerjasama ";
    $sql_mou .= " JOIN tb_institusi ON tb_kerjasama.id_institusi = tb_institusi.id_institusi";
    $sql_mou .= " JOIN tb_jurusan_pdd ON tb_kerjasama.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
    $sql_mou .= " JOIN tb_jenjang_pdd ON tb_kerjasama.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
    $sql_mou .= " JOIN tb_profesi_pdd ON tb_kerjasama.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
    $sql_mou .= " WHERE tb_kerjasama.arsip IS NULL";
    $sql_mou .= " ORDER BY tb_institusi.nama_institusi ASC";
    // echo "$sql_mou<br>";

    $q_mou = $conn->query($sql_mou);
    $r_mou = $q_mou->rowCount();
    $d_mou = $q_mou->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('-MoU-');";
    echo "document.location.href='?error404';</script>";
}

if ($r_mou > 0) {
?>

    <!-- Data Jumlah MoU -->
    <div class="row justify-content-center ">
        <div class="col-md">
            <div class="row no-gutters align-items-center text-center">
                <div class="col">
                    Berlaku (Aktif) :
                    <span class="badge badge-success text-lg"><?= $dashboard_dma; ?></span>
                </div>
                <div class="col">
                    Tidak Berlaku (Kedaluwarsa) :
                    <span class="badge badge-danger text-lg"><?= $dashboard_dmb; ?></span>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class='table-responsive'>
        <table class='table table-striped table-hover text-md' id="dataTable">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope='col'>No</th>
                    <th width="150px">Tanggal Akhir PKS <br> (Status)</th>
                    <th>Nama Institusi</th>
                    <th>No <br>PKS Institusi</th>
                    <th>No <br>PKS RSJ</th>
                    <th width="150px"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $q_mou_a = $conn->query($sql_mou);
                $no = 1;
                ?>
                <?php while ($d_mou = $q_mou_a->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td class="text-center my-auto"><?= $no; ?></td>
                        <td class="text-center text-capitalize my-auto">
                            <?php if ($d_mou['tgl_selesai_mou'] == NULL) { ?>
                                <span class="badge badge-primary text-xs">
                                    <?= $d_mou['ket_mou']; ?>
                                </span>
                                <form method="POST">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-outline-dark">Validasi : </button>
                                        <button type="submit" class="btn btn-outline-success" name="terima_pengajuan_mou">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="submit" class="btn btn-outline-danger" name="tolak_pengajuan_mou">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <?php
                                echo tanggal_min_alt($d_mou['tgl_selesai_mou']) . "<br>";

                                $date_end = strtotime($d_mou['tgl_selesai_mou']);
                                $date_now = strtotime(date('Y-m-d', time()));
                                $date_diff = ($date_now - $date_end) / 24 / 60 / 60;
                                ?>

                                <?php if ($date_diff <= 0) { ?>
                                    <span class="badge badge-success text-xs">
                                        <?= tanggal_sisa($d_mou['tgl_selesai_mou'], date('Y-m-d', time())); ?>
                                    </span>
                                <?php } else if ($date_diff > 0) { ?>
                                    <span class="badge badge-danger text-xs">Tidak Berlaku</span>
                                <?php } ?>
                            <?php } ?>
                        </td>
                        <td>
                            <?= $d_mou['nama_institusi']; ?>
                            <?php if ($d_mou['akronim_institusi'] != NULL) { ?>
                                <?= " (" . $d_mou['akronim_institusi'] . ")"; ?>
                            <?php } ?>
                        </td>
                        <td><?= $d_mou['no_pks_institusi']; ?></td>
                        <td><?= $d_mou['no_pks_rsj']; ?></td>
                        <td class="text-center my-auto">

                            <!-- tombol rincian -->
                            <a title="Rincian" href='#' class="btn btn-info btn-sm" data-toggle="modal" data-target="#m_r_m<?= $d_mou['id']; ?>">
                                <i class="fas fa-info-circle"></i>
                            </a>

                            <!-- modal rincian -->
                            <div class="modal fade text-left" data-backdrop="static" data-keyboard="false" id="m_r_m<?= $d_mou['id']; ?>">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title h5" id="exampleModalXlLabel">DATA MOU : </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <b>Nama Instansi : </b><br>
                                            <?= $d_mou['nama_institusi']; ?><br><br>
                                            <b>No PKS RSJ : </b>
                                            <?= $d_mou['no_pks_rsj']; ?><br><br>
                                            <b>No PKS Institusi : </b>
                                            <?= $d_mou['no_pks_institusi']; ?><br><br>
                                            <b>Jurusan : </b>
                                            <?= $d_mou['nama_jurusan_pdd']; ?><br><br>
                                            <b>Jenjang : </b>
                                            <?= $d_mou['nama_jenjang_pdd']; ?><br><br>
                                            <b>Profesi : </b>
                                            <?= $d_mou['nama_profesi_pdd']; ?><br><br>
                                            <!-- <b>Akreditasi Institusi : </b>
                                                            <?= $d_mou['nama_akreditasi']; ?><br><br> -->
                                            <b>Tangga Mulai MoU : </b>
                                            <?php
                                            if ($d_mou['tgl_mulai_mou'] == NULL) {
                                                echo "-";
                                            } else {
                                                echo tanggal($d_mou['tgl_mulai_mou']);
                                            }
                                            ?>
                                            <br><br>
                                            <b>Tangga Selesai MoU : </b>
                                            <?php
                                            if ($d_mou['tgl_selesai_mou'] == NULL) {
                                                echo "-";
                                            } else {
                                                echo tanggal($d_mou['tgl_selesai_mou']);
                                            }
                                            ?><br><br>
                                            <b>Status MoU : </b>
                                            <?php
                                            $date_end = strtotime($d_mou['tgl_selesai_mou']);
                                            $date_now = strtotime(date('Y-m-d', time()));
                                            $date_diff = ($date_now - $date_end) / 24 / 60 / 60;

                                            if ($date_diff <= 0) {
                                            ?>
                                                <span class="badge badge-success text-md">MASIH BERLAKU</span>
                                            <?php
                                            } elseif ($date_diff > 0) {
                                            ?>
                                                <span class="badge badge-danger text-md">TIDAK BERLAKU</span>
                                            <?php
                                            }
                                            ?><br><br>

                                            <b>File MoU : </b>
                                            <?php
                                            if ($d_mou['file_mou'] == NULL) {
                                            ?>
                                                <span class="badge badge-danger text-md">DATA FILE TIDAK ADA</span>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= $d_mou['file_mou']; ?> " target="_blank" class="btn btn-success btn-sm">
                                                    <i class="fas fa-file-download"></i> Unduh
                                                </a>
                                            <?php
                                            }
                                            ?><br><br>

                                            <b>File PKS : </b>
                                            <?php
                                            if ($d_mou['file_mou'] == NULL) {
                                            ?>
                                                <span class="badge badge-danger text-md">DATA FILE TIDAK ADA</span>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="<?= $d_mou['file_pks']; ?> " target="_blank" class="btn btn-success btn-sm">
                                                    <i class="fas fa-file-download"></i> Unduh
                                                </a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- tombol ubah  -->
                            <a title="Ubah" href='?kerjasama&u=<?= bin2hex(urlencode(base64_encode(date("Ymd") . time() . "*sm*" . $d_mou['id']))); ?>' class=" btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- tombol arsip  -->
                            <button title="Arsip" id="<?= bin2hex(urlencode(base64_encode(date("Ymd") . time() . "*sm*" . $d_mou['id']))); ?>" class="btn btn-secondary btn-sm arsip">
                                <i class="fas fa-archive"></i>
                            </button>
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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(".arsip").click(function() {
            var id = $(this).attr('id');
            Swal.fire({
                position: 'top',
                title: 'Yakin ?',
                html: "<span class='b'>ARSIPKAN</span> KERJASAMA <br> " +
                    "<span class='b text-danger blink'>Setelah data diarsipkan tidak akan bisa kembali diaktifkan''</span>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1cc88a',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Kembali',
                confirmButtonText: 'Ya',
                allowOutsideClick: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'GET',
                        url: "_admin/exc/x_v_mou_a.php?id=" + id,
                        success: function() {
                            Swal.fire({
                                allowOutsideClick: false,
                                // isDismissed: false,
                                icon: 'success',
                                title: '<div class="font-weight-bold text-center">DATA BERHASIL DIARSIPKAN</div>',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            }).then(
                                $('#data_kerjasama').load("_admin/view/v_mouData.php")
                            );
                        },
                        error: function(response) {
                            console.log(response.responseText);
                            alert('eksekusi query gagal');
                        }
                    });
                }
            });
        });
    </script>
<?php
} else {
?>
    <h3> Data MoU Tidak Ada</h3>
<?php
}
?>
<script>
    $('.loader').hide();
    alert = function() {};
</script>
<?php
error_reporting(0);
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

// echo "<pre>" . print_r($_POST) . "</pre>";

//data privileges 
$id = decryptString($_GET['idu'], $customkey);

$sql_prvl = "SELECT * FROM tb_user_privileges ";
$sql_prvl .= " JOIN tb_user ON tb_user_privileges.id_user = tb_user.id_user";
$sql_prvl .= " WHERE tb_user.id_user = " . $id;
// echo $sql_prvl;
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);
if ($d_prvl['r_praktik'] == "Y") {
    // echo $sql_praktik;
    try {
        $sql_praktik = "SELECT * FROM tb_praktik ";
        $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi ";
        $sql_praktik .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd ";
        $sql_praktik .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd ";
        $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd ";
        $sql_praktik .= " JOIN tb_jurusan_pdd_jenis ON tb_jurusan_pdd.id_jurusan_pdd_jenis = tb_jurusan_pdd_jenis.id_jurusan_pdd_jenis ";
        $sql_praktik .= " WHERE status_praktik = 'Y' ";
        if ($d_prvl['level_user'] == 2) {
            $sql_praktik .= " AND  tb_institusi.id_institusi = " . $d_prvl['id_institusi'];
        }
        $sql_praktik .= " ORDER BY tb_praktik.id_praktik DESC";
        $q_praktik = $conn->query($sql_praktik);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PRAKTIK-');";
        echo "document.location.href='?error404';</script>";
    }
    $r_praktik = $q_praktik->rowCount();
?>
    <?php if ($r_praktik > 0) { ?>
        <div class="table-responsive text-md">
            <div class="h6 b text-center">
                <?php $no_col = 1; ?>
                Hilang/Munculkan Kolom Tabel:
                <div class="m-1">
                    <?php if ($d_prvl['level_user'] == 1) { ?>
                        <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Nama Institusi</a>
                    <?php } ?>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Nama Kelompok</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Jumlah Praktik</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Tanggal Mulai</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Tanggal Selesai</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Mess</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Data Praktikan</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Pembimbing</a>
                    <?php if ($d_prvl['level_user'] == 1) { ?>
                        <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Tarif</a>
                    <?php } ?>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Pembayaran</a>
                    <a class="toggle-vis btn btn-outline-primary btn-xs" data-column="<?= $no_col++ ?>">Nilai</a>
                </div>
            </div>
            <hr>
            <table class="table table-striped table-bordered m-auto display" width="100%" id="table-search-each">
                <thead class="table-dark text-center">
                    <tr>
                        <th rowspan="">No</th>
                        <?php if ($d_prvl['level_user'] == 1) { ?>
                            <th rowspan="" width="150px">
                                Nama Institusi
                            </th>
                        <?php } ?>
                        <th rowspan="">
                            Nama Kelompok
                        </th>
                        <th rowspan="">
                            Jumlah <br> Praktikan
                        </th>
                        <th rowspan="">
                            Tgl Mulai<br> (YYYY-MM-DD)
                        </th>
                        <th rowspan="">
                            Tgl Selesai <br> (YYYY-MM-DD)
                        </th>
                        <th>Mess</th>
                        <th>Data Praktikan</th>
                        <th>Pembimbing </th>
                        <?php if ($d_prvl['level_user'] == 1) { ?>
                            <th>Tarif</th>
                        <?php } ?>
                        <th>Pembayaran</th>
                        <th>Nilai</th>
                        <th rowspan="">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr class="text-center">
                            <!-- No Urut -->
                            <td class="align-middle"><?= $no; ?></td>
                            <?php if ($d_prvl['level_user'] == 1) { ?>
                                <td class="align-middle">
                                    <?= $d_praktik['nama_institusi'] ?>
                                </td>
                            <?php } ?>
                            <!-- Nama Praktik -->
                            <td class="align-middle">
                                <?= $d_praktik['nama_praktik'] ?>
                            </td>
                            <!-- Jumlah Praktik -->
                            <td class="align-middle">
                                <?= $d_praktik['jumlah_praktik'] ?>
                            </td>
                            <!-- Tgl Mulai Praktik -->
                            <td class="align-middle"><?= $d_praktik['tgl_mulai_praktik'] ?></td>
                            <!-- Tgl Selesai Praktik -->
                            <td class="align-middle"><?= $d_praktik['tgl_selesai_praktik'] ?></td>
                            <!-- Status Mess Praktik  -->
                            <td class="align-middle">
                                <?php if ($d_praktik['status_mess_praktik'] == 'Y') { ?>
                                    <?php
                                    $sql_mess_pilih = "SELECT * FROM tb_mess_pilih ";
                                    $sql_mess_pilih .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess";
                                    $sql_mess_pilih .= " WHERE id_praktik=" . $d_praktik['id_praktik'];
                                    try {
                                        $q_mess_pilih = $conn->query($sql_mess_pilih);
                                        $d_mess_pilih = $q_mess_pilih->fetch(PDO::FETCH_ASSOC);
                                        $r_mess_pilih = $q_mess_pilih->rowCount();
                                    } catch (Exception $ex) {
                                        echo "<script>alert('- STATUS MESS PRAKTIK-');";
                                        echo "document.location.href='?error404';</script>";
                                    }
                                    ?>
                                    <?php if ($r_mess_pilih > 0) { ?>
                                        <fieldset class="border-1 m-1 p-1">
                                            <?= $d_mess_pilih['nama_mess']; ?>
                                            <br>
                                            <?= $d_mess_pilih['telp_pemilik_mess']; ?>
                                        </fieldset>
                                    <?php } else if ($r_mess_pilih < 1) { ?>
                                        <div class="badge badge-warning text-dark">Belum Dipilih <br>Admin</div>
                                    <?php } ?>
                                    <?php
                                    //teks status dan privileges praktik mess
                                    if ($d_prvl['c_praktik_mess'] == 'Y' && $r_mess_pilih < 1) { ?>
                                        <a title="Lihat" class='btn btn-outline-primary  btn-sm text-sm' href='?ptk=<?= urlencode(base64_encode($d_praktik['id_praktik'])); ?>&m_i'>
                                            <i class="fa-regular fa-circle-check"></i> Pilih
                                        </a>
                                    <?php } else if ($d_prvl['u_praktik_mess'] == 'Y') { ?>
                                        <a title="Lihat" class='btn btn-outline-primary btn-sm text-sm' href='?ptk=<?= urlencode(base64_encode($d_praktik['id_praktik'])); ?>&m_u'>
                                            <font-awesome-icon icon="fa-regular fa-pen-to-square" /> Ubah
                                        </a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <span class="badge badge-danger">Tidak Pakai Mess</span>

                                    <!-- tombol modal Alasan Tidak Memilih Mess  -->
                                    <a title="Alasan Tidak Memilih Mess" class='btn btn-outline-danger btn-xs m-1' href='#' data-toggle="modal" data-target="#alasan_mess_<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>">
                                        <i class="fa-solid fa-circle-info"></i> Cek Alasan
                                    </a>

                                    <!-- modal Alasan Tidak Memilih Mess  -->
                                    <div class="modal text-center" id="alasan_mess_<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>">
                                        <div class="modal-dialog modal-lg text-lg">
                                            <div class="modal-content">
                                                <div class="modal-header h5 bg-danger text-white">
                                                    Alasan Penolakaan Mess/Pemondokan
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="badge badge-success">Alasan Institusi</div>
                                                    <p>"<?= $d_praktik['alasan_institusi']; ?>"</p>
                                                    <hr>
                                                    <div class="badge badge-primary">Alasan Admin</div>
                                                    <?php if ($d_praktik['alasan_admin'] != "") { ?>
                                                        <?php if ($d_praktik['status_alasan'] == "Y") { ?>
                                                            <div class="b u text-primary">DITERIMA</div>
                                                        <?php } else { ?>
                                                            <div class="b u text-danger">DITOLAK</div>
                                                        <?php } ?>
                                                        <p>"<?= $d_praktik['alasan_admin']; ?>"</p>
                                                    <?php } else { ?>
                                                        <div class="i text-danger">Belum direspon ADMIN</div>
                                                        <br>
                                                    <?php } ?>

                                                    <?php if ($d_prvl['level_user'] == 1) { ?>
                                                        <div class="jumbotron">
                                                            <div class="jumbotron-fluid">
                                                                <form class="form-group justify-content-center" id="form_alasan<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>">
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-auto boxed-check-group boxed-check-primary justify-content-center">
                                                                            <label class="boxed-check">
                                                                                <input class="boxed-check-input" type="radio" name="radio<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" id="respond_alasan_mess1<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" value="Y">
                                                                                <div class="boxed-check-label">Ya</div>
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-auto boxed-check-group boxed-check-danger justify-content-center">
                                                                            <label class="boxed-check">
                                                                                <input class="boxed-check-input" type="radio" name="radio<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" id="respond_alasan_mess2<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" value="T">
                                                                                <div class="boxed-check-label">Tidak</div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div id="err_radio<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" class="text-xs text-danger font-italic blink"></div>
                                                                    <br>
                                                                    Keterangan <span class="text-danger">*</span><br>
                                                                    <textarea class="form-control mb-2" id="ket<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" name="ket<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" rows="4"></textarea>
                                                                    <div id="err_ket<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" class="text-xs font-italic  blink text-danger "></div>
                                                                    <br>
                                                                    <a class="btn btn-success simpan_alasan<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>" id="<?= bin2hex(urlencode(base64_encode(date("Ymd") . time() . "*sm*" . $d_praktik['id_praktik']))) ?>">
                                                                        Simpan
                                                                    </a>
                                                                </form>
                                                                <script>
                                                                    $(document).on('click', '.simpan_alasan<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>', function() {

                                                                        var data_alasan = $('#form_alasan<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>').serializeArray();
                                                                        var radio = $('input[name="radio<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>"]:checked').val();
                                                                        var ket = $("#ket<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>").val();

                                                                        data_alasan.push({
                                                                            name: 'idp',
                                                                            value: $(this).attr('id')
                                                                        }, {
                                                                            name: 'encrypt',
                                                                            value: '<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>'
                                                                        });


                                                                        //Notif Bila tidak diisi
                                                                        if (
                                                                            radio == undefined ||
                                                                            ket == ""
                                                                        ) {
                                                                            //warning Toast bila ada data wajib yg berlum terisi
                                                                            Swal.fire({
                                                                                allowOutsideClick: true,
                                                                                showConfirmButton: false,
                                                                                icon: 'warning',
                                                                                title: '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>',
                                                                                timer: 10000,
                                                                                timerProgressBar: true,
                                                                                didOpen: (toast) => {
                                                                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                                                }
                                                                            });

                                                                            //notif telp_koordinator
                                                                            if (radio == undefined) $("#err_radio<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>").html(" Pilih Respond");
                                                                            else $("#err_radio<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>").html("");

                                                                            //notif telp_koordinator
                                                                            if (ket == "") $("#err_ket<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>").html("Keterangan Harus Dipilih");
                                                                            else $("#err_ket<?= md5(date('Y-m-d', time()) . $d_praktik['id_praktik']); ?>").html("");
                                                                        } else {
                                                                            //Simpan Data Praktik dan Tarif
                                                                            $.ajax({
                                                                                type: 'POST',
                                                                                url: "_admin/exc/x_v_praktikData_alasan.php?",
                                                                                data: data_alasan,
                                                                                success: function() {

                                                                                    Swal.fire({
                                                                                        allowOutsideClick: true,
                                                                                        // isDismissed: false,
                                                                                        icon: 'success',
                                                                                        title: '<span class"text-xs"><b>DATA ALASAN</b><br>Berhasil Tersimpan</span>',
                                                                                        showConfirmButton: false,
                                                                                        timer: 5000,
                                                                                        timerProgressBar: true,
                                                                                        didOpen: (toast) => {
                                                                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                                                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                                                        }
                                                                                    }).then(
                                                                                        function() {
                                                                                            location.reload();
                                                                                        }
                                                                                    );
                                                                                },
                                                                                error: function(response) {
                                                                                    console.log(response.responseText);
                                                                                    alert('eksekusi query gagal');
                                                                                }
                                                                            });
                                                                        }
                                                                    });
                                                                </script>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </td>
                            <!-- status data praktikan-->
                            <td class="align-middle">
                                <?php if ($d_praktik['status_alasan'] == "T") { ?>
                                    <div class="badge badge-danger text-center">Alasan Mess Ditolak</div>
                                <?php } else { ?>
                                    <?php
                                    $sql_praktikan = "SELECT * FROM tb_praktikan ";
                                    $sql_praktikan .= " WHERE id_praktik=" . $d_praktik['id_praktik'];
                                    try {
                                        $q_praktikan = $conn->query($sql_praktikan);
                                    } catch (Exception $ex) {
                                        echo "<script>alert('$ex -MESS PILIH PRAKTIK-');";
                                        echo "document.location.href='?error404';</script>";
                                    }
                                    $d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC);
                                    $r_praktikan = $q_praktikan->rowCount();
                                    ?>

                                    <?php if ($d_praktik['status_mess_praktik'] == 'T') { ?>
                                        <?php if ($d_praktik['status_alasan'] == 'T') { ?>
                                            <span class="badge badge-danger">Alasan Mess Ditolak</span>
                                        <?php } else if ($d_praktik['status_alasan'] == 'Y') { ?>
                                            <?php if ($r_praktikan > 0 && $d_praktik['jumlah_praktik'] != $r_praktikan) { ?>
                                                <span class="badge badge-warning text-dark">Data Praktikan<br>Belum Semuanya</span>
                                            <?php } else if ($r_praktikan > 0 && $d_praktik['jumlah_praktik'] == $r_praktikan) { ?>
                                                <span class="badge badge-success">Sudah Dipilih</span>
                                            <?php } else { ?>
                                                <span class="badge badge-secondary">Belum Dipilih</span>
                                            <?php } ?>
                                            <br>
                                            <a href="?ptkn#rincian<?= md5($d_praktik['id_praktik']); ?>" class="btn btn-outline-info btn-xs">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        <?php } else { ?>
                                            <span class="badge badge-secondary text-wrap">Alasan Mess<br>Belum direspon ADMIN</span>
                                        <?php } ?>
                                    <?php } else if ($d_praktik['status_mess_praktik'] == 'Y') { ?>
                                        <?php if ($d_praktik['status_mess_praktik'] == 'Y' && $r_mess_pilih < 1) { ?>
                                            <span class="badge badge-warning text-dark">Mess <br>Belum Dipilih</span>
                                        <?php } else if ($r_praktikan > 0 && $d_praktik['jumlah_praktik'] != $r_praktikan) { ?>
                                            <span class="badge badge-warning text-dark">Data Praktikan<br>Belum Semuanya</span>
                                        <?php } else if ($r_praktikan > 0 && $d_praktik['jumlah_praktik'] == $r_praktikan) { ?>
                                            <span class="badge badge-success">Sudah Dipilih</span>
                                        <?php } else { ?>
                                            <span class="badge badge-secondary">Belum Dipilih</span>
                                        <?php } ?>
                                        <br>
                                        <a href="?ptkn#rincian<?= md5($d_praktik['id_praktik']); ?>" class="btn btn-outline-info btn-xs">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    <?php } ?>
                                <?php } ?>
                            </td>
                            <!-- status pembimbing praktik  -->
                            <td class="align-middle">
                                <?php if ($d_praktik['status_alasan'] == "T") { ?>
                                    <div class="badge badge-danger text-center">Alasan Mess Ditolak</div>
                                <?php } else { ?>
                                    <?php
                                    $sql_praktik_pembimbing = "SELECT * FROM tb_pembimbing_pilih ";
                                    $sql_praktik_pembimbing .= " WHERE id_praktik=" . $d_praktik['id_praktik'];
                                    // echo $sql_praktik_pembimbing.$d_praktik['id_praktik'];
                                    try {
                                        $q_praktik_pembimbing = $conn->query($sql_praktik_pembimbing);
                                    } catch (Exception $ex) {
                                        echo "<script>alert('$ex -PRAKTIK PEMBIMBING-');";
                                        echo "document.location.href='?error404';</script>";
                                    }
                                    $r_praktik_pembimbing = $q_praktik_pembimbing->rowCount();

                                    if ($r_praktikan < 1) { ?>
                                        <span class="badge badge-warning text-dark">Data Praktikan<br>Belum Diinput</span>
                                    <?php } else if ($r_praktikan > 0 && $d_praktik['jumlah_praktik'] != $r_praktikan) { ?>
                                        <span class="badge badge-warning text-dark">Data Praktikan<br>Belum Semuanya</span>
                                    <?php } else if ($r_praktik_pembimbing > 0) { ?>
                                        <span class="badge badge-success">Sudah Dipilih</span>
                                    <?php } else { ?>
                                        <span class="badge badge-secondary">Belum Dipilih</span>
                                    <?php } ?>
                                    <br>
                                    <a href="?pmbb#rincian<?= md5($d_praktik['id_praktik']); ?>" class="btn btn-outline-info btn-xs">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                <?php } ?>
                            </td>
                            <?php if ($d_prvl['level_user'] == 1) { ?>
                                <!-- status Tarif praktik  -->
                                <?php
                                try {
                                    $sql_praktik_tarif = "SELECT * FROM tb_tarif_pilih ";
                                    $sql_praktik_tarif .= " WHERE id_praktik=" . $d_praktik['id_praktik'];
                                    $sql_praktik_tarif .= " AND status_tarif_pilih = 'Y'";
                                    // echo $sql_praktik_tarif.$d_praktik['id_praktik'];
                                    $q_praktik_tarif = $conn->query($sql_praktik_tarif);
                                    $r_praktik_tarif = $q_praktik_tarif->rowCount();
                                } catch (Exception $ex) {
                                    echo "<script>alert('-PRAKTIK TARIF-');";
                                    echo "document.location.href='?error404';</script>";
                                }
                                ?>
                                <td class="align-middle">
                                    <?php if ($d_praktik['status_alasan'] == "T") { ?>
                                        <div class="badge badge-danger text-center">Alasan Mess Ditolak</div>
                                    <?php } else { ?>
                                        <?php
                                        if ($r_praktik_pembimbing < 1) { ?>
                                            <span class="badge badge-warning text-dark">Pembimbing<br>Belum Dipilih</span>
                                        <?php } else if ($r_praktik_tarif > 0) { ?>
                                            <span class="badge badge-success">Sudah Dipilih</span>
                                        <?php } else { ?>
                                            <span class="badge badge-secondary">Belum Dipilih</span>
                                        <?php } ?>
                                        <br>
                                        <?php if ($d_prvl['r_praktik_tarif'] == 'Y') { ?>
                                            <a href="?ptrf#rincian<?= md5($d_praktik['id_praktik']); ?>" class="btn btn-outline-info btn-xs">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                            <!-- status bayar praktik  -->
                            <td class="align-middle">
                                <?php if ($d_praktik['status_alasan'] == "T") { ?>
                                    <div class="badge badge-danger text-center">Alasan Mess Ditolak</div>
                                <?php } else { ?>
                                    <?php
                                    $sql_praktik_bayar = "SELECT * FROM tb_bayar ";
                                    $sql_praktik_bayar .= " WHERE id_praktik=" . $d_praktik['id_praktik'];
                                    try {
                                        $q_praktik_bayar = $conn->query($sql_praktik_bayar);
                                    } catch (Exception $ex) {
                                        echo "<script>alert('$ex -PRAKTIK BAYAR-');";
                                        echo "document.location.href='?error404';</script>";
                                    }
                                    $d_praktik_bayar = $q_praktik_bayar->fetch(PDO::FETCH_ASSOC);
                                    $r_praktik_bayar = $q_praktik_bayar->rowCount();

                                    if ($r_praktik_tarif > 0 && $r_praktik_bayar > 0) {
                                        if ($d_praktik_bayar['status_bayar'] == 'T') {
                                    ?>
                                            <span class="badge badge-primary m-1">Proses Verifikasi</span>
                                        <?php
                                        } elseif ($d_praktik_bayar['status_bayar'] == 'TERIMA') {
                                        ?>
                                            <span class="badge badge-success  m-1">Verifikasi<br>Diterima</span>
                                        <?php
                                        } elseif ($d_praktik_bayar['status_bayar'] == 'TOLAK') {
                                        ?>
                                            <span class="badge badge-danger  m-1">Verifikasi<br>Ditolak</span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge badge-danger">ERROR</span>
                                        <?php
                                        }
                                    } else if ($r_praktik_tarif > 0 && $r_praktik_bayar < 1) {
                                        ?>
                                        <span class="badge badge-danger">Belum Dibayar</span>
                                    <?php
                                    } else if ($r_praktik_tarif < 1) {
                                    ?>
                                        <span class="badge badge-secondary">Tarif Praktik<br>Belum Dipilih</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge badge-danger">ERROR</span>
                                    <?php
                                    }
                                    ?>
                                    <br>
                                    <a href="?pbyr" class="btn btn-outline-info btn-xs">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                <?php } ?>
                            </td>
                            <!-- status nilai praktik  -->
                            <td class="align-middle">
                                <?php if ($d_praktik['status_alasan'] == "T") { ?>
                                    <div class="badge badge-danger text-center">Alasan Mess Ditolak</div>
                                <?php } else { ?>
                                    <?php
                                    try {
                                        // jika jurusan praktik keperawatan
                                        if ($d_praktik['id_jurusan_pdd'] == 2) {
                                            $sql_praktik_nilai = "SELECT * FROM tb_nilai_kep";
                                        }
                                        // jika jurusan praktik selain keperawatan
                                        else {
                                            $sql_praktik_nilai = "SELECT * FROM tb_nilai_upload";
                                        }
                                        $sql_praktik_nilai .= " WHERE id_praktik=" . $d_praktik['id_praktik'];
                                        $q_praktik_nilai = $conn->query($sql_praktik_nilai);
                                    } catch (Exception $ex) {
                                        echo "<script>alert('$ex -PRAKTIK NILAI-');";
                                        echo "document.location.href='?error404';</script>";
                                    }
                                    $r_praktik_nilai = $q_praktik_nilai->rowCount();
                                    ?>
                                    <?php if ($r_praktik_nilai > 0) { ?>
                                        <span class="badge badge-success">Sudah DiNilai</span>
                                    <?php } else { ?>
                                        <span class="badge badge-secondary">Belum Ada</span>
                                    <?php } ?>
                                    <br>
                                    <a href="?pnilai#rincian<?= md5($d_praktik['id_praktik']); ?>" class="btn btn-outline-info btn-xs">
                                        <i class="fa-solid fa-eye"></i> Cek
                                    </a>
                                <?php } ?>
                            </td>
                            <!-- Aksi praktik  -->
                            <td class="align-middle">
                                <div class="btn-group" role="group">
                                    <!-- tombol modal detail praktik  -->
                                    <a title="Detail" class='btn btn-info btn-xs' data-toggle="modal" data-target="#detail<?= $no; ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <!-- modal detail praktik  -->
                                    <div class="modal" id="detail<?= $no; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header h5">
                                                    Detail Data Praktik
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-md">
                                                    <?php if ($d_prvl['level_user'] == 1) { ?>
                                                        Nama Institusi : <br>
                                                        <b><?= $d_praktik['nama_institusi'] ?></b>
                                                        <br><br>
                                                    <?php } ?>
                                                    Nama Kelompok : <br>
                                                    <b><?= $d_praktik['nama_praktik'] ?></b>
                                                    <br><br>
                                                    Jumlah Praktikan Kelompok : <br>
                                                    <b><?= $d_praktik['nama_praktik'] ?></b>
                                                    <br><br>
                                                    Jurusan : <br>
                                                    <b><?= $d_praktik['nama_jurusan_pdd'] ?></b>
                                                    <br><br>
                                                    Jenjang : <br>
                                                    <b><?= $d_praktik['nama_jenjang_pdd'] ?></b>
                                                    <br><br>
                                                    Profesi : <br>
                                                    <b><?= $d_praktik['nama_profesi_pdd'] ?></b>
                                                    <br><br>
                                                    Koordinator : <br>
                                                    <b><?= $d_praktik['nama_koordinator_praktik'] ?></b>
                                                    <br><br>
                                                    Telpon Koordinator : <br>
                                                    <b><?= $d_praktik['telp_koordinator_praktik'] ?></b>
                                                    <br><br>
                                                    E-Mail Koordinator : <br>
                                                    <b><?= $d_praktik['email_koordinator_praktik'] ?></b>
                                                    <br><br>
                                                    <hr class="p-0 m-0 bg-gray-500">
                                                    <div class="row">
                                                        <div class="col-md">
                                                            Surat Pengajuan:<br>
                                                            <b>
                                                                <a href="<?= $d_praktik['surat_praktik'] ?>" download="Surat Pengajuan" class="btn btn-outline-success btn-sm">
                                                                    <i class="fas fa-file"></i> Unduh Surat
                                                                </a>
                                                            </b>
                                                        </div>
                                                        <div class="col-md">
                                                            Akreditasi Institusi: <br>
                                                            <b>
                                                                <a href="<?= $d_praktik['akred_institusi_praktik'] ?>" download="Akreditasi Institusi" class="btn btn-outline-success btn-sm">
                                                                    <i class="fas fa-file"></i> Unduh File
                                                                </a>
                                                            </b>
                                                        </div>
                                                        <div class="col-md">
                                                            Akreditasi Jurusan: <br>
                                                            <b>
                                                                <a href="<?= $d_praktik['akred_jurusan_praktik'] ?>" download="Akreditasi Jurusan" class="btn btn-outline-success btn-sm">
                                                                    <i class="fas fa-file"></i> Unduh File
                                                                </a>
                                                            </b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if ($d_prvl['u_praktik'] == "Y") { ?>
                                        <!-- tombol ubah praktik  -->
                                        <a title="Ubah" class='btn btn-primary btn-xs' href='?ptk&u&idp=<?= encryptString($d_praktik['id_praktik'], $customkey) . "&idu=" . encryptString($_SESSION['id_user'], $customkey); ?>'>
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($d_prvl['d_praktik'] == "Y") { ?>
                                        <!-- tombol modal hapus praktik  -->
                                        <a title="Hapus" class='btn btn-danger btn-xs hapus<?= md5($d_praktik['id_praktik']); ?>' id="<?= urlencode(base64_encode($d_praktik['id_praktik'])); ?>" href='#'>
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($d_prvl['level_user'] == "1") { ?>
                                        <!-- tombol modal arsip praktik  -->
                                        <a title="Arsip" class='btn btn-outline-secondary btn-xs arsip<?= md5($d_praktik['id_praktik']); ?>' id="<?= urlencode(base64_encode($d_praktik['id_praktik'])); ?>" href='#'>
                                            <i class="fa-solid fa-box-archive"></i>
                                        </a>
                                    <?php } ?>
                                </div>
                                <script>
                                    <?php if ($d_prvl['d_praktik'] == "Y") { ?>
                                        //hapus
                                        $(document).on('click', '.hapus<?= md5($d_praktik['id_praktik']); ?>', function() {
                                            Swal.fire({
                                                position: 'top',
                                                title: 'Hapus Data Praktik ?',
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
                                                        url: "_admin/exc/x_v_praktik_h.php",
                                                        data: {
                                                            "idp": $(this).attr('id')
                                                        },
                                                        success: function() {
                                                            $('#data_praktik')
                                                                .load(
                                                                    "_admin/view/v_praktikData.php?&idu=<?= $_GET['idu']; ?>");
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
                                    <?php if ($d_prvl['level_user'] == "1") { ?>
                                        //arsip
                                        $(document).on('click', '.arsip<?= md5($d_praktik['id_praktik']); ?>', function() {
                                            Swal.fire({
                                                position: 'top',
                                                title: 'Arsip Data Praktik ?',
                                                icon: 'warning',
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
                                                        url: "_admin/exc/x_v_praktik_arsip.php",
                                                        data: {
                                                            "idp": $(this).attr('id')
                                                        },
                                                        success: function() {
                                                            $('#data_praktik')
                                                                .load(
                                                                    "_admin/view/v_praktikData.php?&idu=<?= $_GET['idu']; ?>");
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
                                                                title: '<b>Data Berhasil Diarsip</b>'
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
                                </script>
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
                        <th></th>
                        <th></th>
                        <th></th>
                        <?php if ($d_prvl['level_user'] == 1) { ?>
                            <th></th>
                        <?php } ?>
                        <th></th>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    <?php } else { ?>
        <div class="jumbotron">
            <div class="jumbotron-fluid">
                <div class="text-gray-700">
                    <h5 class="text-center b text-danger">Data Praktik Anda Tidak Ada</h5>
                </div>
            </div>
        </div>
    <?php } ?>
    <script>
        $('.loader').hide();
        // alert = function() {};
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/datatable.js";
        ?>
    </script>
<?php
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

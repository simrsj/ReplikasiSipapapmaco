<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
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

// $sql_praktik_tarif = "SELECT * FROM tb_tarif_pilih ";
// $sql_praktik_tarif .= " JOIN tb_praktik ON tb_tarif_pilih.id_praktik = tb_praktik.id_praktik ";
// $sql_praktik_tarif .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik.id_praktik = " . base64_decode(urldecode($_GET['idp']));
// $sql_praktik_tarif .= " ORDER BY tb_tarif_pilih.nama_jenis_tarif_pilih ASC";

$sql_praktik_tarif = "SELECT * FROM tb_tarif_pilih ";
$sql_praktik_tarif .= " JOIN tb_praktik ON tb_tarif_pilih.id_praktik = tb_praktik.id_praktik ";
$sql_praktik_tarif .= " WHERE tb_praktik.status_praktik = 'Y' ";
$sql_praktik_tarif .= " AND tb_praktik.id_praktik = " . base64_decode(urldecode($_GET['idp']));
if ($d_prvl['level_user'] == 2) {
    $sql_praktik_tarif .= " AND tb_tarif_pilih.status_tarif_pilih = 'Y'";
}
$sql_praktik_tarif .= " ORDER BY tb_tarif_pilih.nama_tarif_pilih ASC";
// echo "$sql_praktik_tarif<br>";
try {
    $q_praktik_tarif = $conn->query($sql_praktik_tarif);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRAKTIK');";
    echo "document.location.href='?error404';</script>";
}
$r_praktik_tarif = $q_praktik_tarif->rowCount();

if ($r_praktik_tarif > 0) {
?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="<?= $_GET['tb'] ?>">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Jenis tarif</th>
                    <th scope="col">Nama Tarif </th>
                    <th scope="col">Tarif </th>
                    <th scope="col">Satuan </th>
                    <th scope="col">Frekuensi </th>
                    <th scope="col">Kuantitas </th>
                    <th scope="col">Total Tarif </th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_jumlah_tarif = 0;
                $no = 1;
                while ($d_praktik_tarif = $q_praktik_tarif->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr class="text-center align-middle my-auto">
                        <td class="align-middle "><?= $no; ?></td>
                        <td class="align-middle "><?= $d_praktik_tarif['nama_jenis_tarif_pilih']; ?></td>
                        <td class="align-middle "><?= $d_praktik_tarif['nama_tarif_pilih']; ?></td>
                        <td class="align-middle text-left"><?= "Rp" . number_format($d_praktik_tarif['nominal_tarif_pilih'], 0, ",", "."); ?></td>
                        <td class="align-middle "><?= $d_praktik_tarif['nama_satuan_tarif_pilih']; ?></td>
                        <td class="align-middle "><?= $d_praktik_tarif['frekuensi_tarif_pilih']; ?></td>
                        <td class="align-middle "><?= $d_praktik_tarif['kuantitas_tarif_pilih']; ?></td>
                        <td class="align-middle text-left"> <?= "Rp" . number_format($d_praktik_tarif['jumlah_tarif_pilih'], 0, ",", "."); ?></td>
                        <td class="align-middle ">
                            <?php if ($d_praktik_tarif['status_tarif_pilih'] == 'Y') { ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php } else if ($d_praktik_tarif['status_tarif_pilih'] == 'T') { ?>
                                <span class="badge badge-danger">Tidak Aktif</span>
                            <?php } else { ?>
                                <span class="badge badge-danger">ERROR!!!</span>
                            <?php } ?>
                        </td>
                        <td class="align-middle">
                            <div class="btn-group" role="group">
                                <?php if ($d_prvl['u_praktik_tarif'] == 'Y') { ?>
                                    <!-- tombol modal ubah tarif  -->
                                    <a title="Ubah" class='btn btn-outline-primary btn-xs ubah_init<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>' href='#' data-toggle="modal" data-target="#mu<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <!-- modal ubah tarif  -->
                                    <div class="modal text-center" id="mu<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>" data-backdrop="static">
                                        <div class="modal-dialog modal-dialog-scrollable modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header h5">
                                                    Ubah Tarif
                                                </div>
                                                <div class="modal-body text-md m-0">
                                                    <form class="form-data b" method="post" id="<?= md5('form_u' . $d_praktik_tarif['id_tarif_pilih']); ?>">
                                                        <input type="hidden" id="<?= md5('id_tarif_pilih' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('id_tarif_pilih' . $d_praktik_tarif['id_tarif_pilih']); ?>" value="">
                                                        Jenis Tarif : <span style="color:red">*</span><br>
                                                        <select class="select2 form-control" id="<?= md5('u_jenis_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('u_jenis_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>" required>
                                                            <option value="">-- Pilih Jenis Tarif --</option>
                                                            <?php
                                                            $sql_jenis_tarif = "SELECT * FROM tb_tarif_jenis";
                                                            $sql_jenis_tarif .= " ORDER BY nama_tarif_jenis ASC";
                                                            // echo $sql_jenis_tarif . "<br>";
                                                            try {
                                                                $q_jenis_tarif = $conn->query($sql_jenis_tarif);
                                                            } catch (Exception $ex) {
                                                                echo "<script>alert('$ex -DATA JENIS TARIF');";
                                                                echo "document.location.href='?error404';</script>";
                                                            }
                                                            while ($d_jenis_tarif = $q_jenis_tarif->fetch(PDO::FETCH_ASSOC)) {
                                                            ?>
                                                                <option value="<?= $d_jenis_tarif['nama_tarif_jenis'] ?>">
                                                                    <?= $d_jenis_tarif['nama_tarif_jenis'] ?>
                                                                </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <div class="text-danger b i text-xs blink" id="<?= md5('err_u_jenis_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>"></div><br>
                                                        Nama Tarif : <span style="color:red">*</span>
                                                        <input type="text" id="<?= md5('u_nama' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('u_nama' . $d_praktik_tarif['id_tarif_pilih']); ?>" class="form-control form-control-xs" placeholder="Isikan Nama Tarif" required>
                                                        <div class="text-danger b i text-xs blink" id="<?= md5('err_u_nama' . $d_praktik_tarif['id_tarif_pilih']); ?>"></div><br>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                Tarif : <span style="color:red">*</span>
                                                                <input type="number" id="<?= md5('u_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('u_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>" class="form-control form-control-xs" min="1" placeholder="Isikan Tarif" required>
                                                                <div class="text-danger b i text-xs blink" id="<?= md5('err_u_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>"></div><br>
                                                            </div>
                                                            <div class="col-md">
                                                                Satuan : <span style="color:red">*</span>
                                                                <select class="select2 form-control" id="<?= md5('u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>" required>
                                                                    <option value="">-- Pilih Satuan Tarif --</option>
                                                                    <?php
                                                                    $sql_satuan_tarif = "SELECT * FROM tb_tarif_satuan";
                                                                    $sql_satuan_tarif .= " ORDER BY nama_tarif_satuan ASC";
                                                                    echo $sql_satuan_tarif . "<br>";
                                                                    try {
                                                                        $q_satuan_tarif = $conn->query($sql_satuan_tarif);
                                                                    } catch (Exception $ex) {
                                                                        echo "<script>alert('$ex -DATA SATUAN TARIF');";
                                                                        echo "document.location.href='?error404';</script>";
                                                                    }
                                                                    while ($d_satuan_tarif = $q_satuan_tarif->fetch(PDO::FETCH_ASSOC)) {
                                                                    ?>
                                                                        <option value="<?= $d_satuan_tarif['nama_tarif_satuan'] ?>">
                                                                            <?= $d_satuan_tarif['nama_tarif_satuan'] ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <div class="text-danger b i text-xs blink" id="<?= md5('err_u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>"></div><br>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md">
                                                                Frekuensi : <span style="color:red">*</span>
                                                                <input type="number" id="<?= md5('u_frekuensi' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('u_frekuensi' . $d_praktik_tarif['id_tarif_pilih']); ?>" class="form-control form-control-xs" min="1" placeholder="Isikan Frekeunsi" required>
                                                                <div class="text-danger b i text-xs blink" id="<?= md5('err_u_frekuensi' . $d_praktik_tarif['id_tarif_pilih']); ?>"></div><br>
                                                            </div>
                                                            <div class="col-md">
                                                                Kuantitas : <span style="color:red">*</span>
                                                                <input type="number" id="<?= md5('u_kuantitas' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('u_kuantitas' . $d_praktik_tarif['id_tarif_pilih']); ?>" class="form-control form-control-xs" min="1" placeholder="Isikan Kuantitas" required>
                                                                <div class="text-danger b i text-xs blink" id="<?= md5('err_u_kuantitas' . $d_praktik_tarif['id_tarif_pilih']); ?>"></div><br>
                                                            </div>
                                                            <div class="col-md">
                                                                Status : <span style="color:red">*</span>
                                                                <select class="select2 form-control" id="<?= md5('u_status' . $d_praktik_tarif['id_tarif_pilih']); ?>" name="<?= md5('u_status' . $d_praktik_tarif['id_tarif_pilih']); ?>" required>
                                                                    <option value="">-- Pilih Status Tarif --</option>
                                                                    <option value="Y">Aktif</option>
                                                                    <option value="T">Tidak Aktif</option>
                                                                </select>
                                                                <div class="text-danger b i text-xs blink" id="<?= md5('err_u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>"></div><br>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer text-md">
                                                    <a class="btn btn-danger btn-sm" data-dismiss="modal">
                                                        Kembali
                                                    </a>
                                                    &nbsp;
                                                    <a class="btn btn-primary btn-sm ubah<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>" id="<?= urlencode(base64_encode($d_praktik_tarif['id_tarif_pilih'])); ?>" data-dismiss="modal">
                                                        Ubah
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        //ubah initial
                                        $(".ubah_init<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>").click(function() {

                                            Swal.fire({
                                                title: "Mohon Ditunggu",
                                                html: '<div class="loader mb-5 mt-5 text-center"></div>',
                                                // html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100" />',
                                                allowOutsideClick: false,
                                                showConfirmButton: false,
                                                backdrop: true,
                                            });
                                            console.log("ubah_init");
                                            $("#<?= md5('err_u_jenis_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>").empty();
                                            $('#<?= md5('err_u_nama' . $d_praktik_tarif['id_tarif_pilih']); ?>').empty();
                                            $('#<?= md5('err_u_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>').empty();
                                            $("#<?= md5('err_u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>").empty();
                                            $('#<?= md5('err_u_frekuensi' . $d_praktik_tarif['id_tarif_pilih']); ?>').empty();
                                            $('#<?= md5('err_u_kuantitas' . $d_praktik_tarif['id_tarif_pilih']); ?>').empty();
                                            $('#<?= md5('err_u_status' . $d_praktik_tarif['id_tarif_pilih']); ?>').empty();
                                            $.ajax({
                                                type: 'POST',
                                                url: "_admin/view/v_praktik_tarifGetData.php",
                                                data: {
                                                    idptrf: '<?= urlencode(base64_encode($d_praktik_tarif['id_tarif_pilih'])) ?>'
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    $('#<?= md5('id_tarif_pilih' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.id_tarif_pilih);
                                                    $('#<?= md5('u_jenis_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.u_nama_jenis).trigger("change");
                                                    $('#<?= md5('u_nama' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.u_nama);
                                                    $('#<?= md5('u_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.u_tarif);
                                                    $('#<?= md5('u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.u_satuan).trigger("change");
                                                    $('#<?= md5('u_frekuensi' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.u_frekuensi);
                                                    $('#<?= md5('u_kuantitas' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.u_kuantitas);
                                                    $('#<?= md5('u_status' . $d_praktik_tarif['id_tarif_pilih']); ?>').val(response.u_status).trigger("change");
                                                    // console.log(response.u_tarif);
                                                    Swal.close();
                                                },
                                                error: function(response) {
                                                    console.log(response.responseText);
                                                }
                                            });
                                        });

                                        $(document).on('click', '.ubah<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>', function() {
                                            Swal.fire({
                                                title: "Mohon Ditunggu",
                                                html: '<div class="loader mb-5 mt-5 text-center"></div>',
                                                allowOutsideClick: false,
                                                showConfirmButton: false,
                                                backdrop: true,
                                            });
                                            console.log('ubah');
                                            var data_u = $('#<?= md5('form_u' . $d_praktik_tarif['id_tarif_pilih']); ?>').serializeArray();
                                            data_u.push({
                                                name: "idptrf",
                                                value: $(this).attr('id')
                                            }, {
                                                name: "idp",
                                                value: '<?= urlencode(base64_encode($d_praktik_tarif['id_praktik'])) ?>'
                                            }, );

                                            var id_tarif_pilih = $('#id_tarif_pilih<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>').val();
                                            var u_jenis_tarif = $('#u_jenis_tarif<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>').val();
                                            var u_nama = $('#u_nama<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>').val();
                                            var u_tarif = $('#u_tarif<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>').val();
                                            var u_satuan = $('#u_satuan<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>').val();
                                            var u_frekuensi = $('#u_frekuensi<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>').val();
                                            var u_kuantitas = $('#u_kuantitas<?= md5($d_praktik_tarif['id_tarif_pilih']); ?>').val();

                                            //cek data from ubah bila tidak diiisi
                                            if (
                                                id_tarif_pilih == "" ||
                                                u_jenis_tarif == "" ||
                                                u_nama == "" ||
                                                u_tarif == "" ||
                                                u_satuan == "" ||
                                                u_frekuensi == "" ||
                                                u_kuantitas == ""
                                            ) {
                                                // console.log("error data");

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
                                                    icon: 'warning',
                                                    title: '<span class"text-center"><b>DATA ADA YANG BELUM TERISI</b></span>',
                                                }).then(
                                                    function() {}
                                                );

                                                if (u_jenis_tarif == "") {
                                                    $("#<?= md5('err_u_jenis_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("Jenis Tarif Harus Dipilih");
                                                } else {
                                                    $("#<?= md5('err_u_jenis_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("");
                                                }

                                                if (u_nama == "") {
                                                    $("#<?= md5('err_u_nama' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("Nama Tarif Harus Diisi");
                                                } else {
                                                    $("#<?= md5('err_u_nama' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("");
                                                }

                                                if (u_tarif == "") {
                                                    $("#<?= md5('err_u_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("Tarif Pilih Harus Diisi");
                                                } else {
                                                    $("#<?= md5('err_u_tarif' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("");
                                                }

                                                if (u_satuan == "") {
                                                    $("#<?= md5('err_u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("Satuan Pilih Harus Dipilih");
                                                } else {
                                                    $("#<?= md5('err_u_satuan' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("");
                                                }

                                                if (u_frekuensi == "") {
                                                    $("#<?= md5('err_u_frekuensi' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("Frekuensi Harus Diisi");
                                                } else {
                                                    $("#<?= md5('err_u_frekuensi' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("");
                                                }

                                                if (u_kuantitas == "") {
                                                    $("#<?= md5('err_u_kuantitas' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("Kuamtitas Harus Diisi");
                                                } else {
                                                    $("#<?= md5('err_u_kuantitas' . $d_praktik_tarif['id_tarif_pilih']); ?>").html("");
                                                }
                                            }

                                            //simpan data ubah bila sudah sesuai
                                            if (
                                                id_tarif_pilih != "" &&
                                                u_jenis_tarif != "" &&
                                                u_nama != "" &&
                                                u_tarif != "" &&
                                                u_satuan != "" &&
                                                u_frekuensi != "" &&
                                                u_kuantitas != ""
                                            ) {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "_admin/exc/x_v_praktik_tarif_u.php",
                                                    data: data_u,
                                                    success: function() {

                                                        $('#mu<?= md5($d_praktik_tarif['id_tarif_pilih']) ?>').on('hidden.bs.modal', function(e) {});
                                                        $('#<?= $_GET['tb'] ?>')
                                                            .load("_admin/view/v_praktik_tarifData.php?" +
                                                                "idu=<?= $_GET['idu']; ?>" +
                                                                "&idp=<?= $_GET['idp']; ?>" +
                                                                "&tb=<?= $_GET['tb']; ?>",
                                                                function() {
                                                                    Swal.close();
                                                                })
                                                    },
                                                    error: function(response) {
                                                        console.log(response);
                                                    }
                                                });
                                            }
                                        });
                                    </script>
                                <?php } ?>
                                <?php if ($d_prvl['d_praktik_tarif'] == 'Y') { ?>
                                    <!-- tombol modal hapus pilih tarif  -->
                                    <a title="Hapus" class='btn btn-outline-danger btn-xs' href='#' data-toggle="modal" data-target="#md<?= $no; ?>">
                                        <i class="far fa-trash-alt"></i>
                                    </a>

                                    <!-- modal hapus pilih tarif  -->
                                    <div class="modal text-center" id="md<?= $no; ?>">
                                        <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                            <div class="modal-content">
                                                <div class="modal-body h5">
                                                    <div class="row">
                                                        <div class="col-lg text-left">
                                                            Hapus Tarif Praktik ?
                                                        </div>
                                                        <div class="col-lg text-right">
                                                            <a class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                                                                Kembali
                                                            </a>
                                                            &nbsp;
                                                            <a class="btn btn-outline-danger btn-sm hapus<?= $no; ?>" id="<?= urlencode(base64_encode($d_praktik_tarif['id_tarif_pilih'])); ?>" data-dismiss="modal">
                                                                Hapus
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <script>
                                        // hapus data tarif 
                                        $(document).on('click', '.hapus<?= $no; ?>', function() {
                                            console.log("hapus data tarif Pilih");
                                            $.ajax({
                                                type: 'POST',
                                                url: "_admin/exc/x_v_praktik_tarif_h.php",
                                                data: {
                                                    "idptrf": $(this).attr('id')
                                                },
                                                success: function() {

                                                    $('#md<?= $no; ?>').on('hidden.bs.modal', function(e) {
                                                        $('#<?= $_GET['tb'] ?>')
                                                            .load("_admin/view/v_praktik_tarifData.php?" +
                                                                "idu=<?= $_GET['idu']; ?>" +
                                                                "&idp=<?= $_GET['idp']; ?>" +
                                                                "&tb=<?= $_GET['tb'] ?>");
                                                    });
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
                                                        title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Dihapus</b></div>'
                                                    });

                                                },
                                                error: function(response) {
                                                    console.log(response);
                                                    alert('eksekusi query gagal');
                                                }
                                            });
                                        });
                                    </script>
                                <?php } ?>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#<?= $_GET['tb'] ?>').DataTable();
                                    $(".select2").select2({
                                        placeholder: "-- Pilih --",
                                        allowClear: true,
                                        width: "100%",
                                    });
                                });
                                Swal.close();
                            </script>
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
    <div class="jumbotron">
        <div class="jumbotron-fluid">
            <div class="text-gray-700">
                <h5 class="text-center">Data Tarif Tidak Ada</h5>
            </div>
        </div>
    </div>
<?php
}
?>
<script>
    Swal.close();
</script>
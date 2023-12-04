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
    $d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
if ($d_prvl['r_pkd'] == "Y") {
    $sql_pkd_tarif = "SELECT * FROM tb_pkd_tarif ";
    $sql_pkd_tarif .= " WHERE id_pkd = " . base64_decode(urldecode($_GET['idpkd']));
    // echo $sql_pkd_tarif;
    try {
        $q_pkd_tarif = $conn->query($sql_pkd_tarif);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PRAKTIK-');";
        echo "document.location.href='?error404';</script>";
    }
    $r_pkd_tarif = $q_pkd_tarif->rowCount();
    if ($r_pkd_tarif > 0) {
?>
        <div class="table-responsive text-md">
            <table class="table table-striped table-bordered" id="dataTables">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Tarif</th>
                        <th>Frekuensi</th>
                        <th>Tarif</th>
                        <th>Satuan</th>
                        <th>Jumlah Tarif</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($d_pkd_tarif = $q_pkd_tarif->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr class="text-center">
                            <td class="align-middle "><?= $no; ?></td>
                            <td class="align-middle "><?= $d_pkd_tarif['nama_pkd_tarif']; ?></td>
                            <td class="align-middle "><?= $d_pkd_tarif['frekuensi_pkd_tarif']; ?></td>
                            <td class="align-middle "><?= "Rp " . number_format($d_pkd_tarif['jumlah_pkd_tarif'], 0, '.', '.'); ?></td>
                            <td class="align-middle "><?= $d_pkd_tarif['satuan_pkd_tarif']; ?></td>
                            <td class="align-middle "><?= "Rp " . number_format($d_pkd_tarif['total_pkd_tarif'], 0, '.', '.'); ?></td>
                            <td class="align-middle ">

                                <div class="btn-group" role="group">
                                    <?php if ($d_prvl['u_pkd'] == 'Y') { ?>
                                        <!-- tombol modal ubah tarif  -->
                                        <a title="Ubah" class='btn btn-outline-primary btn-sm ubah_init<?= $no; ?>' href='#' data-toggle="modal" data-target="#update<?= $no; ?>">
                                            <i class="far fa-edit"></i>
                                        </a>

                                        <!-- modal ubah praktikan  -->
                                        <div class="modal text-center" id="update<?= $no; ?>">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header h5">
                                                        Ubah Tarif
                                                    </div>
                                                    <div class="modal-body text-md">
                                                        <form class="form-data b" method="post" id="form_u<?= $no ?>">
                                                            Nama Tarif : <span style="color:red">*</span><br>
                                                            <input type="text" id="u_nama<?= $no ?>" name="u_nama" class="form-control" placeholder="Isikan nama Tarif" required>
                                                            <div class="text-danger b i text-xs blink" id="err_u_nama<?= $no ?>"></div><br>
                                                            <div class="row">
                                                                <div class="col-md">
                                                                    Frekuensi : <span style="color:red">*</span><br>
                                                                    <input type="number" min="1" id="u_frek<?= $no ?>" name="u_frek" class="form-control form-control-xs" placeholder="Isikan Frekuensi" required>
                                                                    <div class="text-danger b i text-xs blink" id="err_u_frek<?= $no ?>"></div>
                                                                </div>
                                                                <div class="col-md">
                                                                    Satuan : <span style="color:red">*</span>
                                                                    <select class="select2 form-control" id="u_satuan<?= $no ?>" name="u_satuan" required>
                                                                        <option value="">-- Pilih Satuan Tarif --</option>
                                                                        <?php
                                                                        $sql_satuan_tarif = "SELECT * FROM tb_tarif_satuan";
                                                                        $sql_satuan_tarif .= " ORDER BY nama_tarif_satuan ASC";
                                                                        // echo $sql_satuan_tarif . "<br>";
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
                                                                    <div class="text-danger b i text-xs blink" id="err_u_satuan<?= $no ?>"></div>
                                                                </div>
                                                                <div class="col-md">
                                                                    Tarif (Rp) : <span style="color:red">*</span><br>
                                                                    <input type="number" min="1" id="u_jumlah<?= $no ?>" name="u_jumlah" class="form-control form-control-xs" placeholder="Isikan Tarif" required>
                                                                    <div class="text-danger b i text-xs blink" id="err_u_tarif<?= $no ?>"></div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer text-md">
                                                        <a class="btn btn-danger btn-sm" data-dismiss="modal">
                                                            Kembali
                                                        </a>
                                                        &nbsp;
                                                        <a class="btn btn-primary btn-sm ubah<?= $no; ?>">
                                                            Ubah
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                                Hapus Tarif PKD ?
                                                            </div>
                                                            <div class="col-lg text-right">
                                                                <a class="btn btn-outline-secondary btn-sm" data-dismiss="modal">
                                                                    Kembali
                                                                </a>
                                                                &nbsp;
                                                                <a class="btn btn-outline-danger btn-sm hapus<?= $no; ?>" id="<?= urlencode(base64_encode($d_pkd_tarif['id_pkd_tarif'])); ?>" data-dismiss="modal">
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
                                        <?php if ($d_prvl['u_pkd'] == 'Y') { ?>
                                            //ubah initial
                                            $(".ubah_init<?= $no ?>").click(function() {
                                                console.log("ubah_init");
                                                $("#err_u_nama<?= $no ?>").empty();
                                                $("#err_u_frek<?= $no ?>").empty();
                                                $("#err_u_satuan<?= $no ?>").empty();
                                                $("#err_u_tarif<?= $no ?>").empty();
                                                $("#form_u<?= $no ?>").trigger("reset");
                                                $("#u_satuan<?= $no ?>").val("").trigger("change");
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "_admin/view/v_pkd_tarifGetData.php",
                                                    data: {
                                                        idpkdt: '<?= urlencode(base64_encode($d_pkd_tarif['id_pkd_tarif'])) ?>'
                                                    },
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        $('#idpkdt<?= $no; ?>').val(response.idpkdt);
                                                        $('#u_nama<?= $no; ?>').val(response.u_nama);
                                                        $('#u_frek<?= $no; ?>').val(response.u_frek);
                                                        $('#u_satuan<?= $no; ?>').val(response.u_satuan).trigger("change");
                                                        $('#u_jumlah<?= $no; ?>').val(response.u_jumlah);
                                                    },
                                                    error: function(response) {
                                                        console.log(response.responseText);
                                                    }
                                                });
                                            });

                                            // ubah data tarif 
                                            $(document).on('click', '.ubah<?= $no; ?>', function() {
                                                console.log("ubah");
                                                var data_u = $("#form_u<?= $no; ?>").serializeArray();
                                                data_u.push({
                                                    name: "idu",
                                                    value: "<?= $_GET['idu']; ?>"
                                                }, {
                                                    name: "idpkdt",
                                                    value: "<?= urlencode(base64_encode($d_pkd_tarif['id_pkd_tarif'])); ?>"
                                                });

                                                var u_nama = $('#u_nama<?= $no; ?>').val();
                                                var u_frek = $('#u_frek<?= $no; ?>').val();
                                                var u_satuan = $('#u_satuan<?= $no; ?>').val();
                                                var u_tarif = $('#u_tarif<?= $no; ?>').val();
                                                // console.log(u_satuan);

                                                //cek data from modal ubah bila tidak diiisi
                                                if (
                                                    u_nama == "" ||
                                                    u_frek == "" ||
                                                    u_satuan == "" ||
                                                    u_satuan == undefined ||
                                                    u_tarif == ""
                                                ) {
                                                    if (u_nama == "") {
                                                        $("#err_u_nama<?= $no ?>").html("Nama Harus Diisi");
                                                    } else {
                                                        $("#err_u_nama<?= $no ?>").html("");
                                                    }

                                                    if (u_frek == "") {
                                                        $("#err_u_frek<?= $no ?>").html("Frekuensi Harus Diisi");
                                                    } else {
                                                        $("#err_u_frek<?= $no ?>").html("");
                                                    }

                                                    if (u_satuan == "" || u_satuan == undefined) {
                                                        $("#err_u_satuan<?= $no ?>").html("Satuan Harus Dipilih");
                                                    } else {
                                                        $("#err_u_satuan<?= $no ?>").html("");
                                                    }

                                                    if (u_tarif == "") {
                                                        $("#err_u_tarif<?= $no ?>").html("Tarif Harus Diisi");
                                                    } else {
                                                        $("#err_u_tarif<?= $no ?>").html("");
                                                    }

                                                    Swal.fire({
                                                        allowOutsideClick: true,
                                                        showConfirmButton: false,
                                                        icon: 'warning',
                                                        html: '<div class="text-lg b">DATA WAJIB ADA YANG BELUM TERISI</div>',
                                                        timer: 5000,
                                                        timerProgressBar: true,
                                                        didOpen: (toast) => {
                                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                                        }
                                                    });
                                                } else {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: "_admin/exc/x_v_pkd_tarif_u.php",
                                                        data: data_u,
                                                        success: function() {
                                                            Swal.fire({
                                                                allowOutsideClick: true,
                                                                showConfirmButton: false,
                                                                backdrop: true,
                                                                icon: 'success',
                                                                html: '<div class="text-lg b">Data Tarif <br>Berhasil Diubah</div>',
                                                                timer: 5000,
                                                                timerProgressBar: true,
                                                            }).then(
                                                                function() {
                                                                    Swal.fire({
                                                                        title: 'Mohon Ditunggu . . .',
                                                                        html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100" />',
                                                                        // add html attribute if you want or remove
                                                                        allowOutsideClick: false,
                                                                        showConfirmButton: false,
                                                                        backdrop: true,
                                                                    });
                                                                    $('#<?= md5("data" . base64_decode(urldecode($_GET['idpkd']))); ?>')
                                                                        .load(
                                                                            "_admin/view/v_pkd_tarifData.php?" +
                                                                            "idpkd=<?= $_GET['idpkd']; ?>&" +
                                                                            "idu=<?= $_GET['idu'] ?>");
                                                                    $('#update<?= $no; ?>').modal('toggle');
                                                                    Swal.close();
                                                                });
                                                        },
                                                        error: function(response) {
                                                            console.log(response);
                                                            alert('eksekusi query gagal');
                                                        }
                                                    });
                                                }
                                            });
                                        <?php } ?>
                                        <?php if ($d_prvl['d_pkd'] == 'Y') { ?>
                                            // hapus data tarif 
                                            $(document).on('click', '.hapus<?= $no; ?>', function() {
                                                console.log("hapus data tarif Pilih");
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "_admin/exc/x_v_pkd_tarif_h.php",
                                                    data: {
                                                        "idpkdt": $(this).attr('id'),
                                                        "idu": "<?= $_GET['idu'] ?>"
                                                    },
                                                    success: function() {

                                                        Swal.fire({
                                                            allowOutsideClick: true,
                                                            showConfirmButton: false,
                                                            backdrop: true,
                                                            icon: 'success',
                                                            html: '<div class="text-lg b">Data Tarif <br>Berhasil Dihapus</div>',
                                                            timer: 5000,
                                                            timerProgressBar: true,
                                                        }).then(
                                                            function() {

                                                                Swal.fire({
                                                                    title: 'Mohon Ditunggu . . .',
                                                                    html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100" />',
                                                                    // add html attribute if you want or remove
                                                                    allowOutsideClick: false,
                                                                    showConfirmButton: false,
                                                                    backdrop: true,
                                                                });
                                                                $('#<?= md5("data" . base64_decode(urldecode($_GET['idpkd']))); ?>')
                                                                    .load(
                                                                        "_admin/view/v_pkd_tarifData.php?" +
                                                                        "idpkd=<?= $_GET['idpkd']; ?>&" +
                                                                        "idu=<?= $_GET['idu'] ?>");
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
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function() {
                $('#dataTables').DataTable();
                $(".select2").select2({
                    placeholder: "-- Pilih --",
                    allowClear: true,
                    width: "100%",
                });
            });
        </script>
    <?php
    } else {
    ?>
        <h3 class="text-center"> Data Praktik Tidak Ada</h3>
<?php
    }
} else {
    // echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

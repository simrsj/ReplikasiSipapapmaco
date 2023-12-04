<?php
if (isset($_GET['pkd']) && isset($_GET['pkdt']) && $d_prvl['r_pkd'] == "Y") {
    $sql_pkd = "SELECT * FROM tb_pkd ";
    $sql_pkd .= "WHERE id_pkd = " . base64_decode(urldecode($_GET['pkd']));
    // echo $sql_pkd . "<br>";
    $sql_pkdtt = "SELECT SUM(total_pkd_tarif) AS total FROM tb_pkd_tarif WHERE id_pkd = " . base64_decode(urldecode($_GET['pkd']));
    // echo $sql_pkdtt . "<br>";
    try {
        $q_pkd = $conn->query($sql_pkd);
        $d_pkd = $q_pkd->fetch(PDO::FETCH_ASSOC);
        $q_pkdtt = $conn->query($sql_pkdtt);
        $d_pkdtt = $q_pkdtt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PKD-');";
        echo "document.location.href='?error404';</script>";
    }
?>
    <div class="container-fluid">
        <!-- Data pkd -->
        <div class="card shadow mb-4 mt-3">
            <div class="card-body">
                <div class="row text-center h6 text-gray-900 ">
                    <div class="col-md-6">
                        Nama Pemohon :
                        <b><?= $d_pkd['nama_pemohon_pkd']; ?></b>
                        <hr>
                        Rincian :
                        <b><?= $d_pkd['rincian_pkd']; ?></b>
                    </div>
                    <div class="col-md-6">
                        Tanggal Pelaksanaan :
                        <b><?= tanggal($d_pkd['tgl_pel_pkd']); ?></b>
                        <hr>
                        Total Biaya/Tarif:
                        <b><?= "Rp " . number_format($d_pkdtt['total'], 0, '.', '.'); ?></b>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">

            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-lg-10">
                        <h1 class="h4  text-gray-800">Daftar Tarif PKD</h1>
                    </div>
                    <?php if ($d_prvl['c_pkd'] == 'Y') { ?>
                        <div class="col-2 text-right">
                            <!-- tombol modal tambah praktikan  -->
                            <a title="tambah" class='btn btn-outline-success btn-sm tambah_init' href='#' data-toggle="modal" data-target="#mi">
                                <i class="fas fa-plus"></i> Tambah
                            </a>

                            <!-- modal tambah praktikan  -->
                            <div class="modal fade text-center" id="mi" data-backdrop="static">
                                <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header h5">
                                            Tambah Tarif
                                        </div>
                                        <div class="modal-body text-md">
                                            <form class="form-data b" method="post" id="form_t">
                                                Nama Tarif : <span style="color:red">*</span><br>
                                                <input type="text" id="t_nama" name="t_nama" class="form-control" placeholder="Isikan nama Tarif" required>
                                                <div class="text-danger b i text-xs blink" id="err_t_nama"></div><br>
                                                <div class="row">
                                                    <div class="col-md">
                                                        Frekuensi : <span style="color:red">*</span><br>
                                                        <input type="number" min="1" id="t_frek" name="t_frek" class="form-control form-control-xs" placeholder="Isikan Frekuensi" required>
                                                        <div class="text-danger b i text-xs blink" id="err_t_frek"></div>
                                                    </div>
                                                    <div class="col-md">
                                                        Satuan : <span style="color:red">*</span>
                                                        <select class="select2 form-control" id="t_satuan" name="t_satuan" required>
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
                                                        <div class="text-danger b i text-xs blink" id="err_t_satuan"></div>
                                                    </div>
                                                    <div class="col-md">
                                                        Tarif (Rp) : <span style="color:red">*</span><br><input type="number" min="1" id="t_tarif" name="t_tarif" class="form-control form-control-xs" placeholder="Isikan Tarif" required>
                                                        <div class="text-danger b i text-xs blink" id="err_t_tarif"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer text-md">
                                            <a class="btn btn-danger btn-sm tambah_tutup" data-dismiss="modal">
                                                Kembali
                                            </a>
                                            &nbsp;
                                            <a class="btn btn-success btn-sm tambah" id="<?= $_GET['pkd']; ?>">
                                                Simpan
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- inisiasi tabel data tarif -->
                <div id="<?= md5("data" . base64_decode(urldecode($_GET['pkd']))); ?>"></div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                Swal.fire({
                    title: 'Mohon Ditunggu . . .',
                    html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-3" width="100" height="100" />',
                    // add html attribute if you want or remove
                    allowOutsideClick: false,
                    showConfirmButton: false,
                });
                $('#<?= md5("data" . base64_decode(urldecode($_GET['pkd']))); ?>')
                    .load(
                        "_admin/view/v_pkd_tarifData.php?" +
                        "idpkd=<?= $_GET['pkd']; ?>&" +
                        "idu=<?= urlencode(base64_encode($_SESSION['id_user'])); ?>");
                Swal.close();
            });

            // inisiasi klik modal tambah
            $(".tambah_init").click(function() {
                console.log("tambah_init");
                $('#err_t_nama').empty();
                $('#err_t_frek').empty();
                $('#err_t_satuan').empty();
                $('#err_t_tarif').empty();
                $("#form_t").trigger("reset");
                $("#t_satuan").val("").trigger("change");
            });

            // inisiasi klik modal tambah simpan
            $(document).on('click', '.tambah', function() {

                // console.log("tambah");
                var data_t = $("#form_t").serializeArray();
                data_t.push({
                    name: "idu",
                    value: "<?= urlencode(base64_encode($_SESSION['id_user'])); ?>"
                }, {
                    name: "idpkd",
                    value: $(this).attr('id')
                });

                var t_nama = $('#t_nama').val();
                var t_frek = $('#t_frek').val();
                var t_satuan = $('#t_satuan').val();
                var t_tarif = $('#t_tarif').val();

                //cek data from modal tambah bila tidak diiisi
                if (
                    t_nama == "" ||
                    t_frek == "" ||
                    t_satuan == "" ||
                    t_tarif == ""
                ) {
                    if (t_nama == "") {
                        $("#err_t_nama").html("Nama Harus Diisi");
                    } else {
                        $("#err_t_nama").html("");
                    }

                    if (t_frek == "") {
                        $("#err_t_frek").html("Frekuensi Harus Diisi");
                    } else {
                        $("#err_t_frek").html("");
                    }

                    if (t_satuan == "") {
                        $("#err_t_satuan").html("Satuan Harus Dipilih");
                    } else {
                        $("#err_t_satuan").html("");
                    }

                    if (t_tarif == "") {
                        $("#err_t_tarif").html("Tarif Harus Diisi");
                    } else {
                        $("#err_t_tarif").html("");
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
                }

                //simpan data tambah bila sudah sesuai
                if (
                    t_nama != "" &&
                    t_frek != "" &&
                    t_satuan != "" &&
                    t_tarif != ""
                ) {
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_v_pkd_tarif_s.php",
                        data: data_t,
                        success: function() {
                            $('#err_t_nama').empty();
                            $('#err_t_frek').empty();
                            $('#err_t_satuan').empty();
                            $('#err_t_tarif').empty();
                            $("#form_t").trigger("reset");
                            $("#t_satuan").val("").trigger("change");

                            Swal.fire({
                                allowOutsideClick: true,
                                showConfirmButton: false,
                                icon: 'success',
                                html: '<div class="text-lg b">Data Tarif <br>Berhasil Tersimpan</div>',
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
                                    });
                                    $('#<?= md5("data" . base64_decode(urldecode($_GET['pkd']))); ?>')
                                        .load(
                                            "_admin/view/v_pkd_tarifData.php?" +
                                            "idpkd=<?= $_GET['pkd']; ?>&" +
                                            "idu=<?= urlencode(base64_encode($_SESSION['id_user'])); ?>");
                                    Swal.close();
                                }
                            );
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    });
                }
            });
        </script>
    </div>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

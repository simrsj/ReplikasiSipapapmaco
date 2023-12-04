<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";

$sql_pertanyaan = "SELECT * FROM tb_kuesioner_pertanyaan";
// echo $sql_pertanyaan;
try {
    $q_pertanyaan = $conn->query($sql_pertanyaan);
    $r_pertanyaan = $q_pertanyaan->rowCount();
} catch (Exception $ex) {
?>
    <script>
        alert("<?= $ex->getMessage() . $ex->getLine() ?>");
        document.location.href = '?error404';
    </script>
<?php
}
?>
<?php if ($r_pertanyaan > 0) { ?>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">No&nbsp;&nbsp;&nbsp;</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Pertanyaan</th>
                    <th scope="col">Jawaban</th>
                    <!-- <th scope="col">Waktu Tambah</th> -->
                    <!-- <th scope="col">Waktu Ubah</th> -->
                    <th scope="col">Keterangan </th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php while ($d_pertanyaan = $q_pertanyaan->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <th scope="row" width="20px"><?= $no; ?></th>
                        <td><?= $d_pertanyaan['jenis']; ?></td>
                        <td><?= $d_pertanyaan['pertanyaan']; ?></td>
                        <td class=" text-center  ">
                            <?php
                            $sql_p_jawaban = "SELECT * FROM tb_kuesioner_jawaban";
                            $sql_p_jawaban .= " WHERE id_pertanyaan = " . $d_pertanyaan['id'];
                            // echo $sql_p_jawaban;
                            try {
                                $q_p_jawaban = $conn->query($sql_p_jawaban);
                                $r_p_jawaban = $q_p_jawaban->rowCount();
                            } catch (Exception $ex) {
                            ?>
                                <script>
                                    alert("<?= $ex->getMessage() . $ex->getLine() . $sql_p_jawaban ?>");
                                    document.location.href = '?error404';
                                </script>
                            <?php
                            }
                            ?>
                            <?php if ($r_p_jawaban > 0) { ?>
                                <div id="accordion" class="my-auto">
                                    <div class="card" data-toggle="collapse" data-target="#j<?= $no; ?>">
                                        <div class="card-header text-center bg-info  m-0 p-1">
                                            <a class=" text-white col ">
                                                <i class="fas fa-eye"></i> Lihat
                                            </a>
                                        </div>
                                        <div id="j<?= $no; ?>" class="collapse  m-0 p-0" aria-labelledby=" headingThree" data-parent="#accordion">
                                            <div class="card-body  m-0 p-0">
                                                <ul class=" list-group">
                                                    <?php while ($d_p_jawaban = $q_p_jawaban->fetch(PDO::FETCH_ASSOC)) { ?>
                                                        <li class="list-group-item"><?= $d_p_jawaban['jawaban'] . " (" . $d_p_jawaban['nilai'] . ")"; ?></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="badge badge-danger blink">Data Tidak Ada</div>
                            <?php } ?>
                        </td>
                        <!-- <td><?= $d_pertanyaan['tgl_tambah']; ?></td> -->
                        <!-- <td><?= $d_pertanyaan['tgl_ubah']; ?></td> -->
                        <td class="text-center my-auto"><?= $d_pertanyaan['ket']; ?></td>
                        <td class="text-center my-auto">

                            <!-- tombol modal ubah  -->
                            <a href="#" class="btn btn-primary btn-sm ubah_init<?= $no ?>" data-toggle="modal" data-target="#modal_ubah<?= $no ?>">
                                <i class="fa fa-edit"></i> Ubah
                            </a>
                            <!-- modal ubah  -->
                            <div class="modal text-center" id="modal_ubah<?= $no ?>" data-backdrop="static">
                                <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header h5 bg-primary text-light">
                                            Ubah Pertanyaan
                                        </div>
                                        <div class="modal-body text-md">
                                            <form class="form-data b" method="post" id="form<?= $no; ?>">
                                                Ubah Pertanyaan <span style="color:red">*</span><br>
                                                <input type="text" id="pertanyaan<?= $no; ?>" name="pertanyaan" class="form-control" placeholder="isikan pertanyaan" required value="<?= $d_pertanyaan['pertanyaan'] ?>">
                                                <div class="text-danger b i text-xs blink err" id="err_pertanyaan<?= $no; ?>"></div>
                                                Keterangan<br>
                                                <textarea id="ket<?= $no; ?>" name="ket" class="form-control"><?= $d_pertanyaan['ket'] ?></textarea>
                                            </form>
                                        </div>
                                        <div class="modal-footer text-md">
                                            <a class="btn btn-danger btn-sm tambah_tutup" data-dismiss="modal">
                                                Kembali
                                            </a>
                                            &nbsp;
                                            <a onClick="ubah('<?= $no; ?>', '<?= encryptString($d_pertanyaan['id'], $customkey) ?>' );" class="btn btn-primary btn-sm ">
                                                Ubah
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- tombol modal hapus pertanyaan   -->
                            <a title="Hapus Pertanyaan" class='btn btn-danger btn-sm hapus ' id="<?= encryptString($d_pertanyaan['id'], $customkey) ?>">
                                <i class="fas fa-trash"></i> Hapus
                            </a>

                            <!-- modal hapus pertanyaan   -->
                            <div class="modal text-center" id="<?= md5("hapus" . $no) ?>" data-backdrop="static">
                                <div class="modal-dialog modal-dialog-scrollable  modal-md">
                                    <div class="modal-content">
                                        <div class="modal-header h5 bg-danger text-light">
                                            Yakin Hapus Pertanyaan?
                                        </div>
                                        <div class="modal-body text-md">
                                            <div class="i b text-uppercase"><?= $d_pertanyaan['pertanyaan']; ?></div>
                                        </div>
                                        <div class="modal-footer text-md">
                                            <a class="btn btn-secondary btn-sm" data-dismiss="modal">
                                                Kembali
                                            </a>
                                            &nbsp;
                                            <a class="btn btn-success btn-sm hapus">
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <a href="?kuesioner&jawaban=<?= encryptString($d_pertanyaan['id'], $customkey) ?>&pertanyaan=<?= encryptString($d_pertanyaan['pertanyaan'], $customkey) ?>" title="ubah" class="btn btn-primary btn-sm mt-2">
                                <i class="fa-regular fa-pen-to-square"></i> Ubah Jawaban
                            </a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="jumbotron">
        <div class="jumbotron-fluid">
            <div class="text-gray-700">
                <h5 class="text-center">Data Pertanyaan Pembimbing Tidak Ada</h5>
            </div>
        </div>
    </div>
<?php } ?>
</div>
<script>
    function ubah(x, y) {
        loading_sw2();
        var data = $("#form" + x).serializeArray();
        data.push({
            name: "id",
            value: y
        });
        var pertanyaan = $("#pertanyaan" + x).val();

        //cek data from modal tambah bila tidak diiisi
        if (pertanyaan == "") {
            pertanyaan == "" ? $("#err_pertanyaan" + x).html("Harus Diisi") : $("#err_pertanyaan" + x).html("");
            custom_alert(true, 'warning', '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>', 10000);
        }
        //simpan data tambah bila sudah sesuai
        else {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_kuesioner_u.php",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    if (response.ket == "success") {
                        $('.err').html("");
                        loading_sw2();
                        $('#modal_ubah' + x).modal('hide');
                        custom_alert(true, 'success', '<center>DATA BERHASIL DIUBAH</center>', 10000);
                        $('#data_pertanyaan').load('_admin/view/v_kuesionerData.php');
                    } else custom_alert(true, 'error', '<center>DATA GAGAL DIUBAH <br>' + response.ket + '</center>', 10000);
                },
                error: function(response) {
                    custom_alert(true, 'error', '<center>DATA ERROR <br>' + response.ket + '</center>', 10000);
                }
            });
        }
    };
    $(document).ready(function() {
        $('#dataTable').DataTable();
        Swal.close();
        $(document).on('click', '.hapus', function() {
            Swal.fire({
                position: 'top',
                html: "<span class='b'>HAPUS DATA?</span>",
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
                        type: 'POST',
                        url: "_admin/exc/x_v_kuesioner_h.php",
                        data: {
                            "id": $(this).attr('id')
                        },
                        dataType: "JSON",
                        success: function(response) {
                            response.ket == "error" ? hapus_gagal() : hapus_berhasil("?kuesioner");
                        },
                        error: function() {
                            error();
                        }
                    });
                }
            })
        });
    });
</script>
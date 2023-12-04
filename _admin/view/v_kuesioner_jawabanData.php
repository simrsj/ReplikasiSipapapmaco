<?php

include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/crypt.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
// error_reporting(0);
$id_pertanyaan = decryptString($_GET['idpt'], $customkey);
try {
    $sql_jawaban = "SELECT ";
    $sql_jawaban .= " tb_kuesioner_jawaban.id as id, ";
    $sql_jawaban .= " tb_kuesioner_jawaban.id_pertanyaan as idpt, ";
    $sql_jawaban .= " tb_kuesioner_jawaban.tgl_tambah as tgl_tambah_idj, ";
    $sql_jawaban .= " tb_kuesioner_jawaban.tgl_ubah as tgl_ubah_idj, ";
    $sql_jawaban .= " jawaban, ";
    $sql_jawaban .= " nilai";
    $sql_jawaban .= " FROM tb_kuesioner_jawaban ";
    $sql_jawaban .= " JOIN tb_kuesioner_pertanyaan ON tb_kuesioner_jawaban.id_pertanyaan = tb_kuesioner_pertanyaan.id";
    $sql_jawaban .= " WHERE tb_kuesioner_jawaban.id_pertanyaan = " . $id_pertanyaan;
    $sql_jawaban .= " ORDER BY tb_kuesioner_jawaban.tgl_ubah DESC, tb_kuesioner_jawaban.tgl_tambah DESC";
    // echo "$sql_jawaban<br>";
    $q_jawaban = $conn->query($sql_jawaban);
    $r_jawaban = $q_jawaban->rowCount();
} catch (PDOException $ex) {
?>
    <script>
        alert("<?= $ex->getMessage() . $ex->getLine() ?>");
        document.location.href = '?error404';
    </script>
<?php
}
?>
<?php if ($r_jawaban > 0) { ?>
    <div class="table-responsive">
        <table class="table table-striped table-bordered " id="dataTable">
            <thead class="">
                <tr class="text-center">
                    <th scope='col'>No&nbsp;&nbsp;</th>
                    <th>Tanggal Tambah&nbsp;&nbsp;</th>
                    <th>Tanggal Ubah&nbsp;&nbsp;</th>
                    <th>Jawaban&nbsp;&nbsp;</th>
                    <th>Nilai&nbsp;&nbsp;</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no0 = 1;
                while ($d_jawaban = $q_jawaban->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td class="text-center"><?= $no0; ?></td>
                        <td><?= $d_jawaban['tgl_tambah_idj']; ?></td>
                        <td class="text-center"><?= ($d_jawaban['tgl_ubah_idj'] != NULL) ? $d_jawaban['tgl_ubah_idj'] : "-"; ?></td>
                        <td><?= $d_jawaban['jawaban']; ?></td>
                        <td><?= $d_jawaban['nilai']; ?></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary btn-sm ubah_init" data-toggle="modal" data-target="#modal_ubah<?= $no0; ?>">
                                <i class=" fa fa-edit"></i> Ubah
                            </a>

                            <div class="modal" id="modal_ubah<?= $no0; ?>" tabindex="-1" role="dialog" aria-labelledby="modal_ubah<?= $no0; ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-left">
                                            <form id="form_u<?= $no0; ?>" method="post">
                                                <div class="row">
                                                    <div class="col-xl">
                                                        <label for="jawaban<?= $no0; ?>">Jawaban <span class="text-danger">*</span></label>
                                                        <input id="jawaban<?= $no0; ?>" name="jawaban" class="form-control" value="<?= $d_jawaban['jawaban']; ?>">
                                                        <div class="err text-danger b i text-xs blink mb-2" id="err_jawaban<?= $no0; ?>"></div>
                                                    </div>
                                                    <div class="col-xl">
                                                        <label for="nilai<?= $no0; ?>">Nilai <span class="text-danger">*</span></label>
                                                        <input type="number" min="0" max="100" id="nilai<?= $no0; ?>" name="nilai" class="form-control" value="<?= $d_jawaban['nilai']; ?>">
                                                        <div class=" i text-xs ">Isian Berupa Angka dan Lebih Sama Dengan 0 (Nol) sampai 100 (Seratus)</div>
                                                        <div class="err text-danger b i text-xs blink mb-2" id="err_nilai<?= $no0; ?>"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                Kembali
                                            </button>
                                            <a onClick="ubah('<?= $no0; ?>', '<?= encryptString($d_jawaban['id'], $customkey) ?>' )" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-danger btn-sm hapus" id="<?= encryptString($d_jawaban['id'], $customkey) ?>">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php
                    $no0++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        $(".ubah_init").click(function() {
            $(".err").html("");
        });

        function ubah(x, y) {
            var data_form = $('#form_u' + x).serializeArray();
            data_form.push({
                name: "idj",
                value: y
            });
            var jawaban = $("#jawaban" + x).val();
            var nilai = $("#nilai" + x).val();

            if (
                jawaban == "" ||
                nilai == "" ||
                nilai < 0 ||
                nilai > 100
            ) {
                custom_alert(true, 'warning', '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>', 10000);
                (jawaban == "") ? $("#err_jawaban" + x).html("Harus Diisi"): $("#err_jawaban" + x).html("");
                (nilai == "" || nilai < 0 || nilai > 100) ? $("#err_nilai" + x).html("Isian Tidak Sesuai"): $("#err_nilai" + x).html("");
            } else {
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_kuesioner_jawaban_u.php",
                    data: data_form,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.ket == "success") {
                            $('#modal_ubah' + x).modal('hide')
                            custom_alert(true, 'success', '<center>DATA BERHASIL DIRUBAH</center>', 10000);
                            $('#data_jawaban')
                                .load(
                                    "_admin/view/v_kuesioner_jawabanData.php?idpt=<?= $_GET['idpt'] ?>");
                        } else custom_alert(true, 'error', '<center>DATA GAGAL DISIMPAN <br>' + response.ket + '</center>', 10000);
                    },
                    error: function(response) {
                        custom_alert(true, 'error', '<center>DATA ERROR <br>' + response.ket + '</center>', 10000);
                    }
                });
            }
        }

        $(document).on('click', '.hapus', function() {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data akan Permanen Terhapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#858796',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Kembali'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_v_kuesioner_jawaban_h.php",
                        data: {
                            idj: $(this).attr('id')
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.ket == "success") {
                                custom_alert(true, 'success', '<center>DATA BERHASIL DIHAPUS</center>', 10000);
                                loading_sw2();
                                $('#data_jawaban')
                                    .load(
                                        "_admin/view/v_kuesioner_jawabanData.php?idpt=<?= $_GET['idpt'] ?>");
                            } else custom_alert(true, 'error', '<center>DATA GAGAL DIUBAH <br>' + response.ket + '</center>', 10000);
                        },
                        error: function(response) {
                            custom_alert(true, 'error', '<center>DATA ERROR <br>' + response.ket + '</center>', 10000);
                        }
                    });
                }
            })
        });
    </script>
<?php } else { ?>
    <div class="jumbotron border-2 m-2 shadow">
        <div class="jumbotron-fluid">
            <div class="text-gray-700">
                <h5 class="text-center">Data Tidak Ada</h5>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    $(document).ready(function() {
        Swal.close();
        $('#dataTable').DataTable();
    });
</script>
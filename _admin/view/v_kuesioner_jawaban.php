<?php

if (isset($_GET['kuesioner']) && isset($_GET['jawaban']) && $d_prvl['level_user'] == 1) {
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Data Jawaban Pertanyaan "<b><?= decryptString($_GET['pertanyaan'], $customkey) ?></b>"</h1>
            </div>
            <div class="col-lg-2 my-auto text-right">

                <a title="Tambah Jawaban" class="btn btn-success btn-sm tambah_init" href="#" data-toggle="modal" data-target="#modal_tambah">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>

                <!-- Modal Tambah Jawaban  -->
                <div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-left">
                                <form id="form_t" method="post">
                                    <div class="row">
                                        <div class="col-xl">
                                            <label for="jawaban">Jawaban <span class="text-danger">*</span></label>
                                            <input id="jawaban" name="jawaban" class="form-control">
                                            <div class="err text-danger b i text-xs blink mb-2" id="err_jawaban"></div>
                                        </div>
                                        <div class="col-xl">
                                            <label for="nilai">Nilai <span class="text-danger">*</span></label>
                                            <input type="number" min="0" max="100" id="nilai" name="nilai" class="form-control">
                                            <div class=" i text-xs ">Isian Berupa Angka dan Lebih Sama Dengan 0 (Nol)</div>
                                            <div class="err text-danger b i text-xs blink mb-2" id="err_nilai"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                    Kembali
                                </button>
                                <a href="#" class="btn btn-success btn-sm tambah"><i class="fa fa-save"></i> Simpan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="data_jawaban"></div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data_jawaban')
                .load(
                    "_admin/view/v_kuesioner_jawabanData.php?idpt=<?= $_GET['jawaban'] ?>");
            $('#loader').remove();
        });
        $(".tambah_init").click(function() {
            $(".err").html("");
            $("#form_t").trigger("reset");
        });
        $(document).on('click', '.tambah', function() {
            loading_sw2();
            var data_form = $('#form_t').serializeArray();
            data_form.push({
                name: "idpt",
                value: "<?= $_GET['jawaban'] ?>"
            });
            var jawaban = $("#jawaban").val();
            var nilai = $("#nilai").val();
            if (
                jawaban == "" ||
                nilai == "" ||
                nilai < 0
            ) {
                custom_alert(true, 'warning', '<center>DATA WAJIB ADA YANG BELUM TERISI/TIDAK SESUAI</center>', 10000);
                (jawaban == "") ? $("#err_jawaban").html("Harus Diisi"): $("#err_jawaban").html("");
                (nilai == "" || nilai < 0) ? $("#err_nilai").html("Isian Tidak Sesuai"): $("#err_nilai").html("");
            } else {
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_kuesioner_jawaban_t.php",
                    data: data_form,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.ket == "SUCCESS") {
                            $('#modal_tambah').modal('hide')
                            custom_alert(true, 'success', '<center>DATA BERHASIL DISIMPAN</center>', 10000);
                            $('#data_jawaban')
                                .load(
                                    "_admin/view/v_kuesioner_jawabanData.php?idpt=<?= $_GET['jawaban'] ?>");
                        } else custom_alert(true, 'error', '<center>DATA GAGAL DISIMPAN <br>' + response.ket + '</center>', 10000);
                    },
                    error: function(response) {
                        custom_alert(true, 'error', '<center>DATA ERROR <br>' + response.ket + '</center>', 10000);
                    }
                });
            }
        });
    </script>
<?php
} else {
    echo "<script>alert('Maaf anda tidak punya hak akses');document.location.href='?error401';</script>";
}
?>
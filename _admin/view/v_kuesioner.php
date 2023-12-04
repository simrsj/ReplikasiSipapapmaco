<?php

if (isset($_GET['kuesioner']) && $d_prvl['level_user'] == 1) {
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Pertanyaan Kuesioner Pembimbing</h1>
            </div>
            <div class="col-lg-2 my-auto text-right">

                <!-- tombol modal tambah  -->
                <a title="tambah pertanyaan" class='btn btn-success btn-sm tambah_ini' href='#' data-toggle="modal" data-target="#mt">
                    <i class="fas fa-plus"></i> Tambah
                </a>

                <!-- modal tambah  -->
                <div class="modal text-center" id="mt" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-scrollable  modal-md">
                        <div class="modal-content">
                            <div class="modal-header h5">
                                Tambah Pertanyaan
                            </div>
                            <div class="modal-body text-md">
                                <form class="form-data b" method="post" id="form_t">
                                    Tambah Pertanyaan <span style="color:red">*</span><br>
                                    <input type="text" id="t_pertanyaan" name="t_pertanyaan" class="form-control" placeholder="isikan pertanyaan" required>
                                    <div class="text-danger b i text-xs blink" id="err_t_pertanyaan"></div>
                                    Keterangan<br>
                                    <textarea id="t_ket" name="t_ket" class="form-control"> </textarea>
                                    <div class="text-danger b i text-xs blink" id="err_t_ket"></div>
                                </form>
                            </div>
                            <div class="modal-footer text-md">
                                <a class="btn btn-danger btn-sm tambah_tutup" data-dismiss="modal">
                                    Kembali
                                </a>
                                &nbsp;
                                <a class="btn btn-success btn-sm tambah">
                                    Simpan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4 card-body" id="data_pertanyaan"></div>
    </div>

    <script>
        $(document).ready(function() {
            loading_sw2();
            $('#data_pertanyaan').load('_admin/view/v_kuesionerData.php');
        });

        // inisiasi klik modal tambah
        $(".tambah_init").click(function() {
            loading_sw2();
            $('#err_t_pertanyaan').empty();
            $('#err_t_ket').empty();
            Swal.close();
        });

        // inisiasi klik modal tambah simpan
        $(document).on('click', '.tambah', function() {
            loading_sw2();
            var data_t = $("#form_t").serializeArray();
            var t_pertanyaan = $('#t_pertanyaan').val();

            //cek data from modal tambah bila tidak diiisi
            if (t_pertanyaan == "") {
                t_pertanyaan == "" ? $("#err_t_pertanyaan").html("Pertanyaan Harus Diisi") : $("#err_t_pertanyaan").html("");
                simpan_tidaksesuai();
            }
            //simpan data tambah bila sudah sesuai
            else {
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_kuesioner_t.php",
                    data: data_t,
                    success: function() {
                        simpan_berhasil("");
                        setTimeout(function() {
                            loading_sw2()
                            $('#data_pertanyaan').load('_admin/view/v_kuesionerData.php');
                            $('#err_t_pertanyaan').empty();
                            Swal.close();
                        }, 5000);
                    },
                    error: function() {
                        console.log("ERROR SIMPAN KUESIONER PEMBIMBING");
                        Swal.close();
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
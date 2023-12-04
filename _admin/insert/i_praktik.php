<?php
if (isset($_GET['ptk']) && isset($_GET['i']) && $d_prvl['c_praktik'] == "Y") {
    // echo "<pre>";
    // echo print_r($_SESSION);
    // echo "</pre>";
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="h3 mb-2 text-gray-800" id="title_praktik">Pengajuan Praktik</h1>
            </div>
        </div>
        <form class="form-data text-gray-900" method="post" enctype="multipart/form-data" id="form_praktik">
            <!-- Data Pengajuan Praktik  -->
            <div id="data_praktik_input">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <!-- Data Praktikan -->
                        <div class="row">
                            <div class="col-md-12 text-lg b text-center text-gray-100 badge bg-primary mb-3">DATA PRAKTIK</div>
                        </div>
                        <!-- Nama Institusi, Nama Kelompok, dan Jumlah Praktik -->
                        <div class="row">
                            <?php
                            //Cari id_praktik
                            $no = 1;
                            $sql = "SELECT MAX(id_praktik) AS ID FROM tb_praktik ORDER BY id_praktik ASC";
                            $q = $conn->query($sql);
                            $d = $q->fetch(PDO::FETCH_ASSOC);
                            $id_praktik = $d['ID'] + 1;
                            ?>
                            <input name="id" id="id" value="<?= urlencode(base64_encode($id_praktik)); ?>" hidden>
                            <input name="user" id="user" value="<?= urlencode(base64_encode($_SESSION['id_user'])); ?>" hidden>
                            <div class="col-md">
                                <?php if ($d_user['level_user'] == 2) { ?>
                                    <?php
                                    $sql_institusi = "SELECT * FROM tb_user";
                                    $sql_institusi .= " JOIN tb_institusi ON tb_user.id_institusi = tb_institusi.id_institusi";
                                    $sql_institusi .= " WHERE tb_institusi.id_institusi = " . $_SESSION['id_institusi'];
                                    // echo $sql_institusi;
                                    $q_institusi = $conn->query($sql_institusi);
                                    $d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    Nama Institusi :
                                    <div class="b text-uppercase">
                                        <?= $d_institusi['nama_institusi']; ?>
                                        <?php if ($d_institusi['akronim_institusi'] != "") echo " (" . $d_institusi['akronim_institusi'] . ")"; ?>
                                        <input name="institusi" id="institusi" value="<?= $_SESSION['id_institusi']; ?>" hidden>
                                    </div>
                                <?php } else { ?>
                                    Nama Institusi : <span style="color:red">*</span><br>
                                    <?php
                                    $sql_institusi = "SELECT * FROM tb_institusi";
                                    $sql_institusi .= " ORDER BY tb_institusi.nama_institusi ASC";

                                    $q_institusi = $conn->query($sql_institusi);
                                    $r_institusi = $q_institusi->rowCount();
                                    ?>
                                    <?php if ($r_institusi > 0) { ?>
                                        <select class='select2 form-control' name='institusi' id="institusi" required>
                                            <option value="">-- <i>Pilih</i>--</option>
                                            <?php
                                            $no = 1;
                                            while ($d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <option value='<?= $d_institusi['id_institusi']; ?>'>
                                                    <?= $d_institusi['nama_institusi'];
                                                    if ($d_institusi['akronim_institusi'] != '') {
                                                        echo " (" . $d_institusi['akronim_institusi'] . ")";
                                                    }
                                                    ?>
                                                </option>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                        </select>
                                        <!-- <del><i style='font-size:12px;'>Daftar Institusi yang MoU-nya masih berlaku</i></del> -->
                                        <div class="text-danger b  i text-xs blink" id="err_institusi"></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="col-md">
                                Nama Gelombang/Kelompok : <span style="color:red">*</span><br>
                                <input type="text" class="form-control form-control-xs" name="kelompok" id="kelompok" placeholder="Isi Gelombang/Kelompok" required>
                                <div class="text-danger b  i text-xs blink" id="err_kelompok"></div>
                            </div>
                            <div class="col-md-2">
                                Jumlah Praktik: <span style="color:red">*</span><br>
                                <input type="number" min="1" class="form-control form-control-xs" name="jumlah" id="jumlah" placeholder="Isi Jumlah Praktik" required>
                                <div class="text-danger b  i text-xs blink" id="err_jumlah"></div>
                            </div>
                        </div>
                        <br>

                        <!-- Jurusan, Jenjang, profesi dan Akreditasi -->
                        <div class="row">
                            <div class="col-md-4">
                                Jurusan : <span style="color:red">*</span><br>
                                <?php
                                $sql_jurusan_pdd = "SELECT * FROM  tb_jurusan_pdd ORDER BY nama_jurusan_pdd ASC";
                                $q_jurusan_pdd = $conn->query($sql_jurusan_pdd);
                                ?>

                                <select class='select2' name='jurusan' id="jurusan" required>
                                    <option value="">-- <i>Pilih</i>--</option>
                                    <?php while ($d_jurusan_pdd = $q_jurusan_pdd->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <option value='<?= $d_jurusan_pdd['id_jurusan_pdd']; ?>'><?= $d_jurusan_pdd['nama_jurusan_pdd']; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="text-danger b i text-xs blink" id="err_jurusan"></div>
                            </div>
                            <div class="col-md-4">
                                Jenjang : <span style="color:red">*</span><br>
                                <div class="loader-small" id="jenjangLoader" style="display: none;"></div>
                                <div id="jenjangData" style="display: none;"></div>
                                <span id="jenjangKet" class="b i">Pilih Jurusan Terlebih Dahulu</span>
                                <div class="text-danger b i text-xs blink" id="err_jenjang"></div>
                            </div>
                            <div class="col-md-4">
                                Profesi : <span style="color:red">*</span><br>
                                <span id="profesiData" style="display: none;">
                                    <input type="hidden" id="profesi" name="profesi" value="0">
                                </span>
                                <span id="profesiKet" class="b i">
                                    Pilih Jenjang Terlebih Dahulu
                                </span>
                                <div class="text-danger b  i text-xs blink" id="err_profesi"></div>
                            </div>
                        </div>
                        <br>

                        <!-- Tanggal Mulai, Tanggal Selesai, No Surat Institusi Surat dan Tanggal Surat Institusi -->
                        <div class="row">
                            <div class="col-md-2">
                                Tanggal Mulai Praktik : <span style="color:red">*</span><br>
                                <input type="date" class="form-control form-control-xs" name="tgl_mulai_praktik" id="tgl_mulai" required>
                                <span class="text-danger b  i text-xs blink" id="err_tgl_mulai"></span>
                            </div>
                            <div class="col-md-2">
                                Tanggal Selesai Praktik: <span style="color:red">*</span><br>
                                <input type="date" class="form-control form-control-xs" name="tgl_selesai_praktik" id="tgl_selesai" required>
                                <span class="text-danger b  i text-xs blink" id="err_tgl_selesai"></span>
                            </div>
                            <div class="col-md">
                                No. Surat Institusi : <span style="color:red">*</span><br>
                                <input type="text" class="form-control form-control-xs" name="no_surat" placeholder="Isi No Surat Institusi" id="no_surat" required>
                                <span class="text-danger b  i text-xs blink" id="err_no_surat"></span>
                            </div>
                            <div class="col-md-2">
                                Tanggal Surat Institusi : <span style="color:red">*</span><br>
                                <input type="date" class="form-control form-control-xs" name="tgl_surat" id="tgl_surat" required>
                                <span class="text-danger b  i text-xs blink" id="err_tgl_surat"></span>
                            </div>
                        </div>
                        <br>
                        <!-- File Surat Institusi, File Akreditasi Insitutsi, File Akreditasi Jurusan -->
                        <div class="row">
                            <div class="col-md">
                                File Surat Institusi :<span style="color:red">*</span><br>
                                <div class="custom-file">
                                    <label class="custom-file-label text-xs" for="customFile" id="labelfilesuratinstitusi">Pilih File</label>
                                    <input type="file" class="custom-file-input mb-1" id="file_surat" name="file_surat" accept="application/pdf" required>
                                    <span class='i text-xs'>Data unggah harus .pdf dan maksimal ukuran file 3 Mb</span><br>
                                    <div class="text-xs font-italic text-danger blink" id="err_file_surat"></div><br>
                                    <script>
                                        $('#file_surat').on('change', function() {
                                            var fileSuratInstitusi = $(this).val();
                                            fileSuratInstitusi = fileSuratInstitusi.replace(/^.*[\\\/]/, '');
                                            if (fileSuratInstitusi == "") fileSuratInstitusi = "Pilih File";
                                            $('#labelfilesuratinstitusi').html(fileSuratInstitusi);
                                        })
                                    </script>
                                </div>
                            </div>
                            <div class="col-md">
                                File Akreditasi Institusi :<span style="color:red">*</span><br>
                                <div class="custom-file">
                                    <label class="custom-file-label text-xs" for="customFile" id="labelfileakredinstitusi">Pilih File</label>
                                    <input type="file" class="custom-file-input mb-1" id="file_akred_institusi" name="file_akred_institusi" accept="application/pdf" required>
                                    <span class='i text-xs'>Data unggah harus pdf, Maksimal 3 Mb</span><br>
                                    <div class="text-xs font-italic text-danger blink" id="err_file_akred_institusi"></div><br>
                                    <script>
                                        $('#file_akred_institusi').on('change', function() {
                                            var fileNameInstitusi = $(this).val();
                                            fileNameInstitusi = fileNameInstitusi.replace(/^.*[\\\/]/, '');
                                            if (fileNameInstitusi == "") fileNameInstitusi = "Pilih File";
                                            $('#labelfileakredinstitusi').html(fileNameInstitusi);
                                        })
                                    </script>
                                </div>
                            </div>
                            <div class="col-md">
                                File Akreditasi Jurusan :<span style="color:red">*</span><br>
                                <div class="custom-file">
                                    <label class="custom-file-label text-xs" for="customFile" id="labelfileakredjururusan">Pilih File</label>
                                    <input type="file" class="custom-file-input mb-1" id="file_akred_jurusan" name="file_akred_jurusan" accept="application/pdf" required>
                                    <span class='i text-xs'>Data unggah harus pdf, Maksimal 3 Mb</span><br>
                                    <div class="text-xs font-italic text-danger blink" id="err_file_akred_jurusan"></div><br>
                                    <script>
                                        $('#file_akred_jurusan').on('change', function() {
                                            var fileNameAkredJur = $(this).val();
                                            fileNameAkredJur = fileNameAkredJur.replace(/^.*[\\\/]/, '');
                                            if (fileNameAkredJur == "") fileNameAkredJur = "Pilih File";
                                            $('#labelfileakredjururusan').html(fileNameAkredJur);
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>

                        <!-- Koordinator -->
                        <div class=" row">
                            <div class="col-md-12 text-lg b text-center text-gray-100 badge bg-primary">KORDINATOR</div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-4">
                                Nama : <span style="color:red">*</span><br>
                                <input type="text" class="form-control form-control-xs" name="nama_koordinator" id="nama_koordinator" placeholder="Isi Nama Koordinator" value="<?= $d_user['nama_user']; ?>" required>
                                <span class="text-danger b  i text-xs blink" id="err_nama_koordinator"></span>
                            </div>
                            <div class="col-md-4">
                                Email :<br>
                                <input type="text" class="form-control form-control-xs" name="email_koordinator" id="email_koordinator" placeholder="Isi Email Koordinator" value="<?= $d_user['email_user']; ?>">
                            </div>
                            <div class="col-md-4">
                                Telpon : <span style="color:red">*</span><br>
                                <input type="number" class="form-control form-control-xs" name="telp_koordinator" id="telp_koordinator" placeholder="Isi Telpon Koordinator" min="1" value="<?= $d_user['no_telp_user']; ?>" required>
                                <i style='font-size:12px;'>Isian hanya berupa angka</i>
                                <br><span class="text-danger b  i text-xs blink" id="err_telp_koordinator"></span>
                            </div>
                        </div>

                        <!-- Pakai Mess -->
                        <div class=" row">
                            <div class="col-md-12 text-lg b text-center text-gray-100 badge bg-primary">MESS</div>
                        </div>
                        <div id="data_pilih_mess">
                            <div class="text-center mb-1">
                                Pemakaian Mess/Pemondokan : <span class="text-danger">*</span><br>
                            </div>
                            <div class="row boxed-check-group boxed-check-xs boxed-check-primary justify-content-center">
                                <label class="boxed-check">
                                    <input class="boxed-check-input" type="radio" name="pilih_mess" id="pilih_mess1" value="Y">
                                    <div class="boxed-check-label">Ya</div>
                                </label>
                                &nbsp;
                                &nbsp;
                                <label class="boxed-check">
                                    <input class="boxed-check-input" type="radio" name="pilih_mess" id="pilih_mess2" value="T">
                                    <div class="boxed-check-label">Tidak</div>
                                </label>
                            </div>
                            <div class="text-danger b i text-xs blink mb-4" id="err_pilih_mess"></div>
                            <div class=" col-6 mx-auto animated--grow-in alasan" style="display: none;">
                                <div class="text-center">
                                    Alasan<span class="text-danger">*</span><br>
                                </div>
                                <textarea id="uraian_alasan" name="uraian_alasan" class="form-control"></textarea>
                                <div class="text-danger b i text-xs blink" id="err_uraian_alasan"></div>
                                Minimal 50 Karakter, <span id="count_text" style="display: none;">Karakter yang telah diinputkan <span id="count_alasan" class="b">0</span></span>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#pilih_mess1').on('click', function() {
                                        $(".alasan").css("display", "none");
                                        $('#simpan_praktik').attr('disabled', false);
                                    });
                                    $('#pilih_mess2').on('click', function() {
                                        $(".alasan").css("display", "block");
                                        $('#simpan_praktik').attr('disabled', true);
                                    });
                                    // ketika pengguna mengetik di dalam textarea
                                    $('#uraian_alasan').on('input', function() {

                                        $("#count_text").css("display", "block");
                                        // hitung jumlah karakter yang dimasukkan
                                        var count = $(this).val().length;

                                        // tampilkan jumlah karakter di dalam span
                                        $('#count_alasan').text(count);

                                        // jika jumlah karakter kurang dari 50
                                        if (count < 50) {
                                            // nonaktifkan tombol submit
                                            $('#simpan_praktik').attr('disabled', true);
                                            $("#count_alasan").addClass("text-danger");
                                        } else {
                                            // aktifkan tombol submit
                                            $('#simpan_praktik').attr('disabled', false);
                                            $("#count_alasan").removeClass("text-danger");
                                            $("#count_alasan").addClass("text-success");
                                        }
                                    });
                                });
                            </script>
                            <hr>
                            <div class="i text-left mb-3">
                                <span class="text-danger">*</span>: Wajib Diisi/Dipilih
                            </div>
                        </div>

                        <!-- Tombol Simpan Praktik-->
                        <div id="simpan_praktik_tarif" class="nav btn justify-content-center">
                            <div id="simpan_praktik_tarif" class="nav btn justify-content-center text-md">
                                <button type="button" name="simpan_praktik" id="simpan_praktik" class="btn btn-success">
                                    <i class="fas fa-check-circle"></i>
                                    Simpan Data Praktik
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>

    <script type="text/javascript">
        $('#jurusan').on('select2:select', function() {
            console.log("pilih jurusan");
            $('#jenjangData').load('_admin/insert/i_praktikDataJenjang.php?jur=' + $("#jurusan").val());
            $('#jenjangKet').fadeOut(0);
            $('#jenjangData').fadeIn(0);
            $('#profesiData').fadeOut(0);
            $('#profesiKet').fadeIn(0);
        });

        $("#simpan_praktik").click(function() {

            Swal.fire({
                title: 'Mohon Ditunggu . . .',
                html: ' <img src="./_img/d3f472b06590a25cb4372ff289d81711.gif" class="rotate mb-4 mt-4" width="100" height="100" />',
                allowOutsideClick: false,
                showConfirmButton: false,
            });
            var data_praktik = $('#form_praktik').serializeArray();
            var id = $("#id").val();
            var user = $("#user").val();
            var institusi = $("#institusi").val();
            var kelompok = $("#kelompok").val();
            var jumlah = $("#jumlah").val();
            var jurusan = $("#jurusan").val();
            var jenjang = $("#jenjang").val();
            var profesi = $("#profesi").val();
            var tgl_mulai = $("#tgl_mulai").val();
            var tgl_selesai = $("#tgl_selesai").val();
            var no_surat = $("#no_surat").val();
            var tgl_surat = $("#tgl_surat").val();
            var file_surat = $("#file_surat").val();
            var file_akred_institusi = $("#file_akred_institusi").val();
            var file_akred_jurusan = $("#file_akred_jurusan").val();
            var nama_koordinator = $("#nama_koordinator").val();
            var email_koordinator = $("#email_koordinator").val();
            var telp_koordinator = $("#telp_koordinator").val();
            var pilih_mess = $('input[name="pilih_mess"]:checked').val();
            var alasan_mess = $("#uraian_alasan").val();

            //eksekusi bila file surat terisi
            if (file_surat != "" && file_surat != undefined) {

                //Cari ekstensi file surat yg diupload
                var typeSurat = document.querySelector('#file_surat').value;
                var getTypeSurat = typeSurat.split('.').pop();

                //cari ukuran file surat yg diupload
                var fileSurat = document.getElementById("file_surat").files;
                var getSizeSurat = document.getElementById("file_surat").files[0].size / 1024;
            }

            //eksekusi bila file akreditasi institusi terisi
            if (file_akred_institusi != "" && file_akred_institusi != undefined) {

                //Cari ekstensi file surat yg diupload
                var typeAkredInstitusi = document.querySelector('#file_akred_institusi').value;
                var getTypeAkredInstitusi = typeAkredInstitusi.split('.').pop();

                //cari ukuran file surat yg diupload
                var fileAkredInstitusi = document.getElementById("file_akred_institusi").files;
                var getSizeAkredInstitusi = document.getElementById("file_akred_institusi").files[0].size / 1024;
            }

            //eksekusi bila file akreditasi institusi terisi
            if (file_akred_jurusan != "" && file_akred_jurusan != undefined) {

                //Cari ekstensi file surat yg diupload
                var typeAkredJurusan = document.querySelector('#file_akred_jurusan').value;
                var getTypeAkredJurusan = typeAkredJurusan.split('.').pop();

                //cari ukuran file surat yg diupload
                var fileAkredJurusan = document.getElementById("file_akred_jurusan").files;
                var getSizeAkredJurusan = document.getElementById("file_akred_jurusan").files[0].size / 1024;
            }

            //Notif Bila tidak diisi
            if (
                institusi == "" ||
                kelompok == "" ||
                jumlah == "" ||
                jurusan == "" ||
                jenjang == "" ||
                profesi == "" ||
                tgl_mulai == "" ||
                tgl_selesai == "" ||
                no_surat == "" ||
                tgl_surat == "" ||
                file_surat == "" ||
                file_surat == undefined ||
                file_akred_institusi == "" ||
                file_akred_institusi == undefined ||
                file_akred_jurusan == "" ||
                file_akred_jurusan == undefined ||
                nama_koordinator == "" ||
                telp_koordinator == "" ||
                pilih_mess == undefined ||
                getTypeSurat != 'pdf' ||
                getSizeSurat > 3072 ||
                getTypeAkredInstitusi != 'pdf' ||
                getSizeAkredInstitusi > 3072 ||
                getTypeAkredJurusan != 'pdf' ||
                getSizeAkredJurusan > 3072
            ) {
                //warning Toast bila ada data wajib yg berlum terisi
                simpan_tidaksesuai();

                //notif File Surat Institusi 
                if (getTypeSurat == "") $("#err_file_surat").html("File Surat Institusi Harus pdf");
                else if (getSizeSurat == "") $("#err_file_surat").html("File Surat Institusi Harus Kurang dari 3 Mb");
                else $("#err_file_surat").html("");

                //notif File Akreditasi Institusi 
                if (getTypeAkredInstitusi == "") $("#err_file_akred_institusi").html("File Akreditasi Institusi Harus pdf");
                else if (getSizeAkredInstitusi == "") $("#err_file_akred_institusi").html("File Akreditasi Institusi Harus Kurang dari 3 Mb");
                else $("#err_file_akred_institusi").html("");

                //notif File Akreditasi Jurusan 
                if (getTypeAkredJurusan == "") $("#err_file_akred_jurusan").html("File Akreditasi Jurusan Harus pdf");
                else if (getSizeAkredJurusan == "") $("#err_file_akred_jurusan").html("File Akreditasi Jurusan Harus Kurang dari 3 Mb");
                else $("#err_file_akred_jurusan").html("");

                //notif institusi 
                if (institusi == "") $("#err_institusi").html("Institusi Harus Dipilih");
                else $("#err_institusi").html("");

                //notif kelompok 
                if (kelompok == "") $("#err_kelompok").html("Nama Kelompok Harus Diisi");
                else $("#err_kelompok").html("");

                //notif jumlah 
                if (jumlah == "") $("#err_jumlah").html("Jumlah Praktik Harus Diisi");
                else $("#err_jumlah").html("");

                //notif jurusan 
                if (jurusan == "") $("#err_jurusan").html("Jurusan Harus Diisi");
                else $("#err_jurusan").html("");

                //notif jenjang 
                if (jenjang == "") $("#err_jenjang").html("Jenjang Harus Diisi");
                else $("#err_jenjang").html("");

                //notif profesi 
                if (profesi == "") $("#err_profesi").html("Profesi Harus Diisi");
                else $("#err_profesi").html("");

                //notif tgl_mulai 
                if (tgl_mulai == "") $("#err_tgl_mulai").html("Tanggal Mulai Praktik Harus Diisi");
                else $("#err_tgl_mulai").html("");

                //notif tgl_selesai 
                if (tgl_selesai == "") $("#err_tgl_selesai").html("Tanggal Selesai Praktik Harus Diisi");
                else $("#err_tgl_selesai").html("");

                //notif no_surat 
                if (no_surat == "") $("#err_no_surat").html("No. Surat Institusi Harus Diisi");
                else $("#err_no_surat").html("");

                //notif tgl_surat 
                if (tgl_surat == "") $("#err_tgl_surat").html("Tanggal Surat Institusi Harus Diisi");
                else $("#err_tgl_surat").html("");

                // notif file_surat
                if (file_surat == "" || file_surat == undefined) $("#err_file_surat").html("File Surat Harus Unggah");
                else $("#err_file_surat").html("");

                // notif file_akred_institusi
                if (file_akred_institusi == "" || file_akred_institusi == undefined) $("#err_file_akred_institusi").html("File Akreditasi Institusi Harus Unggah");
                else $("#err_file_akred_institusi").html("");

                // notif file_akred_jurusan
                if (file_akred_jurusan == "" || file_akred_jurusan == undefined) $("#err_file_akred_jurusan").html("File Akreditasi Jurusan Harus Unggah");
                else $("#err_file_akred_jurusan").html("");

                //notif nama_koordinator
                if (nama_koordinator == "") $("#err_nama_koordinator").html("Nama Koordinator Harus Diisi");
                else $("#err_nama_koordinator").html("");

                //notif telp_koordinator
                if (telp_koordinator == "") $("#err_telp_koordinator").html("Telpon Koordinator Harus Diisi");
                else $("#err_telp_koordinator").html("");

                //notif telp_koordinator
                if (pilih_mess == undefined) $("#err_pilih_mess").html("Pemakaian Mess Harus Dipilih");
                else $("#err_pilih_mess").html("");
            }

            //notif alasan mess 
            if (pilih_mess == "T") {
                if (alasan_mess == "") $("#err_uraian_alasan").html("Alasan Tidak Memilih Mess Harus Diisi");
                else $("#err_uraian_alasan").html("");
            }

            //Alert jika Tanggal Selesai kurang dari tanggal mulai
            if (
                (tgl_selesai <= tgl_mulai) &&
                (tgl_mulai != "" && tgl_selesai != "") ||
                (tgl_mulai == "" && tgl_selesai == "")
            ) {
                simpan_tidaksesuai();
                $("#err_tgl_selesai").html("<b>Tanggal Selesai</b> Harus Lebih dari <b>Tanggal Mulai</b>");
            }
            //bila tanggal mulai dan selesai sesuai
            else {
                //Cek Data Ketersediaan Jadwal Praktik
                console.log("Cek Jadwal Praktik . . .");
                $.ajax({
                    type: 'POST',
                    url: "_admin/insert/i_praktik_valTgl.php",
                    data: data_praktik,
                    dataType: 'json',
                    success: function(response) {
                        //notif jika jadwal dan/ jumlah praktik melebihi kuota
                        if (response.ket == 'T') {
                            simpan_tidaksesuai();
                            console.log('Jadwal Praktik Tidak Bisa');
                        }
                        //eksekusi bila jadwal tersedia
                        else if (response.ket == 'Y') {
                            //simpan data praktik dan data tarif
                            if (
                                institusi != "" &&
                                kelompok != "" &&
                                jumlah != "" &&
                                jurusan != "" &&
                                jenjang != "" &&
                                profesi != "" &&
                                tgl_mulai != "" &&
                                tgl_selesai != "" &&
                                no_surat != "" &&
                                tgl_surat != "" &&
                                file_surat != undefined &&
                                getTypeSurat == 'pdf' &&
                                file_akred_institusi != undefined &&
                                getTypeAkredInstitusi == 'pdf' &&
                                file_akred_jurusan != undefined &&
                                getTypeAkredJurusan == 'pdf' &&
                                file_surat != undefined &&
                                getTypeSurat == 'pdf' &&
                                getSizeSurat <= 3072 &&
                                getSizeAkredInstitusi <= 3072 &&
                                getSizeAkredJurusan <= 3072 &&
                                nama_koordinator != "" &&
                                telp_koordinator != "" &&
                                pilih_mess != undefined
                            ) {
                                //push data pilih_mess
                                data_praktik.push({
                                    name: 'pilih_mess',
                                    value: pilih_mess
                                });

                                //Simpan Data Praktik dan Tarif
                                $.ajax({
                                    type: 'POST',
                                    url: "_admin/exc/x_i_praktik_s.php?",
                                    data: data_praktik,
                                    success: function() {
                                        //ambil data file yang diupload
                                        var data_file = new FormData();
                                        var xhttp = new XMLHttpRequest();

                                        var fileSurat = document.getElementById("file_surat").files;
                                        data_file.append("file_surat", fileSurat[0]);

                                        var fileAkredInstitusi = document.getElementById("file_akred_institusi").files;
                                        data_file.append("file_akred_institusi", fileAkredInstitusi[0]);

                                        var fileAkredJurusan = document.getElementById("file_akred_jurusan").files;
                                        data_file.append("file_akred_jurusan", fileAkredJurusan[0]);

                                        var id = document.getElementById("id").value;
                                        data_file.append("id", id);

                                        xhttp.open("POST", "_admin/exc/x_i_praktik_sFile.php", true);
                                        xhttp.send(data_file);
                                        simpan_berhasil("?ptk");
                                    },
                                    error: function(response) {
                                        error();
                                    }
                                });
                            } else console.log("Data Wajib Praktik Belum Diisi dan/ tidak sesuai");
                        } else alert("ERROR CEK TANGGAL PRAKTIK");
                    }
                });
            }
        });
    </script>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

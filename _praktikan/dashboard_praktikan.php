<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-header text-center bg-success text-light text-lg rounded-sm b">
            Selamat Datang
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-light b">
            Data Identitas Anda
        </div>
        <div class="card-body  text-center">
            <div class="row">
                <div class="col-md-2 my-auto align-middle text-center">
                    <img src="<?= $d_praktikan['foto_praktikan'] ?>" height="150" alt="foto praktikan"><br><br>
                </div>
                <div class="col-md-5">
                    <b>Nama Lengkap : </b><br>
                    <?= $d_praktikan['nama_praktikan'] ?><br><br>
                    <b>Tanggal Lahir : </b><br>
                    <?= tanggal($d_praktikan['tgl_lahir_praktikan']) ?><br><br>
                    <b>No. Telepon : </b><br>
                    <?= $d_praktikan['telp_praktikan'] ?><br><br>
                    <b>No. WhatsApp : </b><br>
                    <?= $d_praktikan['wa_praktikan'] ?><br><br>
                </div>
                <div class="col-md-5">
                    <b>E-Mail : </b><br>
                    <?= $d_praktikan['email_praktikan'] ?><br><br>
                    <b>Alamat : </b><br>
                    <?= $d_praktikan['alamat_praktikan'] ?><br><br>
                    <b>File Swab/Sertifikat Vaksin : </b><br>
                    <a href="<?= $d_praktikan['file_swab_praktikan'] ?>" download class="btn btn-outline-success btn-sm">
                        <i class="fas fa-file"></i> Unduh
                    </a><br><br>
                    <?php
                    if ($d_praktikan['id_jenjang_pdd'] == 9) {
                    ?>
                        <b>File Ijazah : </b><br>
                        <a href="<?= $d_praktikan['file_ijazah_praktikan'] ?>" download class="btn btn-outline-success btn-sm">
                            <i class="fas fa-file"></i> Unduh
                        </a><br><br>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header bg-primary text-light b">
            Data Praktik Anda
        </div>
        <div class="card-body  text-center">
            <div class="row">
                <div class="col-md-3">
                    <b>Nama Institusi : </b><br>
                    <?= $d_praktikan['nama_institusi'] ?><br><br>
                    <b>Nama Kelompok : </b><br>
                    <?= $d_praktikan['nama_praktik'] ?><br><br>
                    <b>Periode Stase : </b><br>
                    <?= tanggal($d_praktikan['tgl_mulai_praktik']) . " - " . tanggal($d_praktikan['tgl_selesai_praktik']) ?><br><br>
                </div>
                <div class="col-md-3">
                    <b>Jurusan : </b><br>
                    <?= $d_praktikan['nama_jurusan_pdd'] ?><br><br>
                    <b>Jenjang : </b><br>
                    <?= $d_praktikan['nama_jenjang_pdd'] ?><br><br>
                    <b>Profesi : </b><br>
                    <?= $d_praktikan['nama_profesi_pdd'] ?><br><br>
                </div>
                <div class="col-md-3">
                    <b>Nama Koordiantor : </b><br>
                    <?= $d_praktikan['nama_koordinator_praktik'] ?><br><br>
                    <b>Nomor Koordiantor : </b><br>
                    <?= $d_praktikan['telp_koordinator_praktik'] ?><br><br>
                    <b>Email Koordiantor : </b><br>
                    <?= $d_praktikan['email_koordinator_praktik'] ?><br><br>
                </div>
                <div class="col-md-3">
                    <b>Surat Pengajuan : </b><br>
                    <a href="<?= $d_praktikan['surat_praktik'] ?>" download class="btn btn-outline-success btn-sm">
                        <i class="fas fa-file"></i> Unduh
                    </a><br><br>
                    <b>Akreditasi Institusi : </b><br>
                    <a href="<?= $d_praktikan['akred_institusi_praktik'] ?>" download class="btn btn-outline-success btn-sm">
                        <i class="fas fa-file"></i> Unduh
                    </a><br><br>
                    <b>Akreditasi Jurusan : </b><br>
                    <a href="<?= $d_praktikan['akred_jurusan_praktik'] ?>" download class="btn btn-outline-success btn-sm">
                        <i class="fas fa-file"></i> Unduh
                    </a><br><br>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
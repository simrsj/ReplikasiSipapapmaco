<?php if (isset($_GET['pkd']) && $d_prvl['r_pkd'] == "Y") { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h4 mb-2 text-gray-800">Daftar Pengajuan Pemakaian Kekayaan Daerah (PKD)</h1>
            </div>
            <?php if ($d_prvl['c_pkd'] == "Y") { ?>
                <div class="col-lg-2 text-right">
                    <a href="?pkd&i" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div id="data_pdk"></div>
            </div>
        </div>
    </div>
    <script>
        $('#data_pdk')
            .load(
                "_admin/view/v_pkdData.php?&idu=<?= urlencode(base64_encode($_SESSION['id_user'])); ?>");
    </script>
<?php } else {
    // echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

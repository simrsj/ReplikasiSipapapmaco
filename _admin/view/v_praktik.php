<?php if (isset($_GET['ptk']) && $d_prvl['r_praktik'] == "Y") { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h4 mb-2 text-gray-800">Daftar Praktik</h1>
            </div>
            <?php if ($d_prvl['c_praktik'] == "Y") { ?>
                <div class="col-lg-2 text-right">
                    <a href="?ptk&i" class="btn btn-outline-success btn-sm">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="card shadow mb-4">
            <div class="loader mt-5 text-center"></div>
            <div class="card-body">
                <div id="data_praktik"></div>
            </div>
        </div>
    </div>
    <script>
        $('#data_praktik')
            .load(
                "_admin/view/v_praktikData.php?&idu=<?= encryptString($_SESSION['id_user'], $customkey) ?>"
            );
    </script>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

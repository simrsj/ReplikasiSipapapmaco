<?php
if (isset($_GET['aku']) && isset($_GET['ha']) && $d_prvl['u_akun'] == 'Y') {
    $sql_user_prvl = "SELECT * FROM tb_user ";
    $sql_user_prvl .= " JOIN tb_user_privileges ON tb_user.id_user = tb_user_privileges.id_user ";
    $sql_user_prvl .= " WHERE tb_user.id_user=" . $_GET['ha'];
    // echo $sql_user_prvl;
    $q_user_prvl = $conn->query($sql_user_prvl);
    $d_user_prvl = $q_user_prvl->fetch(PDO::FETCH_ASSOC);
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Daftar Hak Akses Akun</h1>
            </div>
        </div>
        <div class="card shadow mb-4 card-body">
            <div id="data_ha"></div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#data_ha').load('_admin/view/v_akun_hak_akses_getData.php?ha=<?= $_GET['ha']; ?>');
        });
    </script>
<?php
} else {
    echo "<script>alert('Maaf anda tidak punya hak akses');document.location.href='?error401';</script>";
}
?>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";

$sql_user_prvl = "SELECT * FROM tb_user ";
$sql_user_prvl .= " JOIN tb_user_privileges ON tb_user.id_user = tb_user_privileges.id_user ";
$sql_user_prvl .= " WHERE tb_user.id_user=" . $_GET['ha'];
// echo $sql_user_prvl;
$q_user_prvl = $conn->query($sql_user_prvl);
$d_user_prvl = $q_user_prvl->fetch(PDO::FETCH_ASSOC);
?>
<form method="post" id="form_ubah">
    <input type="hidden" name="id_user" id="id_user" value="<?= $d_user_prvl['id_user']; ?>">
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col ">Nama Hak Akses</th>
                    <th scope="col">Create/Tambah</th>
                    <th scope="col">Read/Melihat/Melihat</th>
                    <th scope="col">Update/Mengubah</th>
                    <th scope="col">Delete/Menghapus</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <!-- Kuota  -->
                <tr>
                    <td><em>Kuota</em></td>
                    <td>
                        <?php
                        $c_kuotaY = "";
                        $c_kuotaT = "";
                        if ($d_user_prvl['c_kuota'] == 'Y') $c_kuotaY = "checked";
                        else if ($d_user_prvl['c_kuota'] == 'T')  $c_kuotaT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_kuota" id="c_kuotaY" value="Y" <?= $c_kuotaY; ?>><label for="c_kuotaY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_kuota" id="c_kuotaT" value="T" <?= $c_kuotaT; ?>><label for="c_kuotaT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_kuota"></div>
                    </td>
                    <td>
                        <?php
                        $r_kuotaY = "";
                        $r_kuotaT = "";
                        if ($d_user_prvl['r_kuota'] == 'Y') $r_kuotaY = "checked";
                        else if ($d_user_prvl['r_kuota'] == 'T')  $r_kuotaT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_kuota" id="r_kuotaY" value="Y" <?= $r_kuotaY; ?>><label for="r_kuotaY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_kuota" id="r_kuotaT" value="T" <?= $r_kuotaT; ?>><label for="r_kuotaT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_kuota"></div>
                    </td>
                    <td>
                        <?php
                        $u_kuotaY = "";
                        $u_kuotaT = "";
                        if ($d_user_prvl['u_kuota'] == 'Y') $u_kuotaY = "checked";
                        else if ($d_user_prvl['u_kuota'] == 'T')  $u_kuotaT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_kuota" id="u_kuotaY" value="Y" <?= $u_kuotaY; ?>><label for="u_kuotaY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_kuota" id="u_kuotaT" value="T" <?= $u_kuotaT; ?>><label for="u_kuotaT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_kuota"></div>
                    </td>
                    <td>
                        <?php
                        $d_kuotaY = "";
                        $d_kuotaT = "";
                        if ($d_user_prvl['d_kuota'] == 'Y') $d_kuotaY = "checked";
                        else if ($d_user_prvl['d_kuota'] == 'T')  $d_kuotaT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_kuota" id="d_kuotaY" value="Y" <?= $d_kuotaY; ?>><label for="d_kuotaY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_kuota" id="d_kuotaT" value="T" <?= $d_kuotaT; ?>><label for="d_kuotaT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_kuota"></div>
                    </td>
                </tr>
                <!-- Akun  -->
                <tr>
                    <td>Akun</td>
                    <td>
                        <?php
                        $c_akunY = "";
                        $c_akunT = "";
                        if ($d_user_prvl['c_akun'] == 'Y') $c_akunY = "checked";
                        else if ($d_user_prvl['c_akun'] == 'T')  $c_akunT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_akun" id="c_akunY" value="Y" <?= $c_akunY; ?>><label for="c_akunY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_akun" id="c_akunT" value="T" <?= $c_akunT; ?>><label for="c_akunT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_akun"></div>
                    </td>
                    <td>
                        <?php
                        $r_akunY = "";
                        $r_akunT = "";
                        if ($d_user_prvl['r_akun'] == 'Y') $r_akunY = "checked";
                        else if ($d_user_prvl['r_akun'] == 'T')  $r_akunT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_akun" id="r_akunY" value="Y" <?= $r_akunY; ?>><label for="r_akunY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_akun" id="r_akunT" value="T" <?= $r_akunT; ?>><label for="r_akunT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_akun"></div>
                    </td>
                    <td>
                        <?php
                        $u_akunY = "";
                        $u_akunT = "";
                        if ($d_user_prvl['u_akun'] == 'Y') $u_akunY = "checked";
                        else if ($d_user_prvl['u_akun'] == 'T')  $u_akunT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_akun" id="u_akunY" value="Y" <?= $u_akunY; ?>><label for="u_akunY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_akun" id="u_akunT" value="T" <?= $u_akunT; ?>><label for="u_akunT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_akun"></div>
                    </td>
                    <td>
                        <?php
                        $d_akunY = "";
                        $d_akunT = "";
                        if ($d_user_prvl['d_akun'] == 'Y') $d_akunY = "checked";
                        else if ($d_user_prvl['d_akun'] == 'T')  $d_akunT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_akun" id="d_akunY" value="Y" <?= $d_akunY; ?>><label for="d_akunY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_akun" id="d_akunT" value="T" <?= $d_akunT; ?>><label for="d_akunT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_akun"></div>
                    </td>
                </tr>
                <!-- Praktik  -->
                <tr>
                    <td>Praktik</td>
                    <td>
                        <?php
                        $c_praktikY = "";
                        $c_praktikT = "";
                        if ($d_user_prvl['c_praktik'] == 'Y') $c_praktikY = "checked";
                        else if ($d_user_prvl['c_praktik'] == 'T')  $c_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_praktik" id="c_praktikY" value="Y" <?= $c_praktikY; ?>><label for="c_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_praktik" id="c_praktikT" value="T" <?= $c_praktikT; ?>><label for="c_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_praktik"></div>
                    </td>
                    <td>
                        <?php
                        $r_praktikY = "";
                        $r_praktikT = "";
                        if ($d_user_prvl['r_praktik'] == 'Y') $r_praktikY = "checked";
                        else if ($d_user_prvl['r_praktik'] == 'T')  $r_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_praktik" id="r_praktikY" value="Y" <?= $r_praktikY; ?>><label for="r_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_praktik" id="r_praktikT" value="T" <?= $r_praktikT; ?>><label for="r_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_praktik"></div>
                    </td>
                    <td>
                        <?php
                        $u_praktikY = "";
                        $u_praktikT = "";
                        if ($d_user_prvl['u_praktik'] == 'Y') $u_praktikY = "checked";
                        else if ($d_user_prvl['u_praktik'] == 'T')  $u_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_praktik" id="u_praktikY" value="Y" <?= $u_praktikY; ?>><label for="u_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_praktik" id="u_praktikT" value="T" <?= $u_praktikT; ?>><label for="u_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_praktik"></div>
                    </td>
                    <td>
                        <?php
                        $d_praktikY = "";
                        $d_praktikT = "";
                        if ($d_user_prvl['d_praktik'] == 'Y') $d_praktikY = "checked";
                        else if ($d_user_prvl['d_praktik'] == 'T')  $d_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_praktik" id="d_praktikY" value="Y" <?= $d_praktikY; ?>><label for="d_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_praktik" id="d_praktikT" value="T" <?= $d_praktikT; ?>><label for="d_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_praktik"></div>
                    </td>
                </tr>
                <!-- Praktik Mess -->
                <tr>
                    <td>Praktik Mess</td>
                    <td>
                        <?php
                        $c_praktik_messY = "";
                        $c_praktik_messT = "";
                        if ($d_user_prvl['c_praktik_mess'] == 'Y') $c_praktik_messY = "checked";
                        else if ($d_user_prvl['c_praktik_mess'] == 'T')  $c_praktik_messT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_praktik_mess" id="c_praktik_messY" value="Y" <?= $c_praktik_messY; ?>><label for="c_praktik_messY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_praktik_mess" id="c_praktik_messT" value="T" <?= $c_praktik_messT; ?>><label for="c_praktik_messT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_praktik_mess"></div>
                    </td>
                    <td>
                        <?php
                        $r_praktik_messY = "";
                        $r_praktik_messT = "";
                        if ($d_user_prvl['r_praktik_mess'] == 'Y') $r_praktik_messY = "checked";
                        else if ($d_user_prvl['r_praktik_mess'] == 'T')  $r_praktik_messT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_praktik_mess" id="r_praktik_messY" value="Y" <?= $r_praktik_messY; ?>><label for="r_praktik_messY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_praktik_mess" id="r_praktik_messT" value="T" <?= $r_praktik_messT; ?>><label for="r_praktik_messT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_praktik_mess"></div>
                    </td>
                    <td>
                        <?php
                        $u_praktik_messY = "";
                        $u_praktik_messT = "";
                        if ($d_user_prvl['u_praktik_mess'] == 'Y') $u_praktik_messY = "checked";
                        else if ($d_user_prvl['u_praktik_mess'] == 'T')  $u_praktik_messT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_praktik_mess" id="u_praktik_messY" value="Y" <?= $u_praktik_messY; ?>><label for="u_praktik_messY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_praktik_mess" id="u_praktik_messT" value="T" <?= $u_praktik_messT; ?>><label for="u_praktik_messT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_praktik_mess"></div>
                    </td>
                    <td>
                        <?php
                        $d_praktik_messY = "";
                        $d_praktik_messT = "";
                        if ($d_user_prvl['d_praktik_mess'] == 'Y') $d_praktik_messY = "checked";
                        else if ($d_user_prvl['d_praktik_mess'] == 'T')  $d_praktik_messT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_praktik_mess" id="d_praktik_messY" value="Y" <?= $d_praktik_messY; ?>><label for="d_praktik_messY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_praktik_mess" id="d_praktik_messT" value="T" <?= $d_praktik_messT; ?>><label for="d_praktik_messT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_praktik_mess"></div>
                    </td>
                </tr>
                <!-- Praktikan -->
                <tr>
                    <td>Praktikan</td>
                    <td>
                        <?php
                        $c_praktikanY = "";
                        $c_praktikanT = "";
                        if ($d_user_prvl['c_praktikan'] == 'Y') $c_praktikanY = "checked";
                        else if ($d_user_prvl['c_praktikan'] == 'T')  $c_praktikanT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_praktikan" id="c_praktikanY" value="Y" <?= $c_praktikanY; ?>><label for="c_praktikanY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_praktikan" id="c_praktikanT" value="T" <?= $c_praktikanT; ?>><label for="c_praktikanT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_praktikan"></div>
                    </td>
                    <td>
                        <?php
                        $r_praktikanY = "";
                        $r_praktikanT = "";
                        if ($d_user_prvl['r_praktikan'] == 'Y') $r_praktikanY = "checked";
                        else if ($d_user_prvl['r_praktikan'] == 'T')  $r_praktikanT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_praktikan" id="r_praktikanY" value="Y" <?= $r_praktikanY; ?>><label for="r_praktikanY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_praktikan" id="r_praktikanT" value="T" <?= $r_praktikanT; ?>><label for="r_praktikanT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_praktikan"></div>
                    </td>
                    <td>
                        <?php
                        $u_praktikanY = "";
                        $u_praktikanT = "";
                        if ($d_user_prvl['u_praktikan'] == 'Y') $u_praktikanY = "checked";
                        else if ($d_user_prvl['u_praktikan'] == 'T')  $u_praktikanT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_praktikan" id="u_praktikanY" value="Y" <?= $u_praktikanY; ?>><label for="u_praktikanY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_praktikan" id="u_praktikanT" value="T" <?= $u_praktikanT; ?>><label for="u_praktikanT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_praktikan"></div>
                    </td>
                    <td>
                        <?php
                        $d_praktikanY = "";
                        $d_praktikanT = "";
                        if ($d_user_prvl['d_praktikan'] == 'Y') $d_praktikanY = "checked";
                        else if ($d_user_prvl['d_praktikan'] == 'T')  $d_praktikanT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_praktikan" id="d_praktikanY" value="Y" <?= $d_praktikanY; ?>><label for="d_praktikanY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_praktikan" id="d_praktikanT" value="T" <?= $d_praktikanT; ?>><label for="d_praktikanT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_praktikan"></div>
                    </td>
                </tr>
                <!-- Praktik Pembimbing -->
                <tr>
                    <td>Praktik Pembimbing</td>
                    <td>
                        <?php
                        $c_praktik_pembimbingY = "";
                        $c_praktik_pembimbingT = "";
                        if ($d_user_prvl['c_praktik_pembimbing'] == 'Y') $c_praktik_pembimbingY = "checked";
                        else if ($d_user_prvl['c_praktik_pembimbing'] == 'T')  $c_praktik_pembimbingT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_praktik_pembimbing" id="c_praktik_pembimbingY" value="Y" <?= $c_praktik_pembimbingY; ?>><label for="c_praktik_pembimbingY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_praktik_pembimbing" id="c_praktik_pembimbingT" value="T" <?= $c_praktik_pembimbingT; ?>><label for="c_praktik_pembimbingT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_praktik_pembimbing"></div>
                    </td>
                    <td>
                        <?php
                        $r_praktik_pembimbingY = "";
                        $r_praktik_pembimbingT = "";
                        if ($d_user_prvl['r_praktik_pembimbing'] == 'Y') $r_praktik_pembimbingY = "checked";
                        else if ($d_user_prvl['r_praktik_pembimbing'] == 'T')  $r_praktik_pembimbingT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_praktik_pembimbing" id="r_praktik_pembimbingY" value="Y" <?= $r_praktik_pembimbingY; ?>><label for="r_praktik_pembimbingY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_praktik_pembimbing" id="r_praktik_pembimbingT" value="T" <?= $r_praktik_pembimbingT; ?>><label for="r_praktik_pembimbingT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_praktik_pembimbing"></div>
                    </td>
                    <td>
                        <?php
                        $u_praktik_pembimbingY = "";
                        $u_praktik_pembimbingT = "";
                        if ($d_user_prvl['u_praktik_pembimbing'] == 'Y') $u_praktik_pembimbingY = "checked";
                        else if ($d_user_prvl['u_praktik_pembimbing'] == 'T')  $u_praktik_pembimbingT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_praktik_pembimbing" id="u_praktik_pembimbingY" value="Y" <?= $u_praktik_pembimbingY; ?>><label for="u_praktik_pembimbingY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_praktik_pembimbing" id="u_praktik_pembimbingT" value="T" <?= $u_praktik_pembimbingT; ?>><label for="u_praktik_pembimbingT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_praktik_pembimbing"></div>
                    </td>
                    <td>
                        <?php
                        $d_praktik_pembimbingY = "";
                        $d_praktik_pembimbingT = "";
                        if ($d_user_prvl['d_praktik_pembimbing'] == 'Y') $d_praktik_pembimbingY = "checked";
                        else if ($d_user_prvl['d_praktik_pembimbing'] == 'T')  $d_praktik_pembimbingT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_praktik_pembimbing" id="d_praktik_pembimbingY" value="Y" <?= $d_praktik_pembimbingY; ?>><label for="d_praktik_pembimbingY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_praktik_pembimbing" id="d_praktik_pembimbingT" value="T" <?= $d_praktik_pembimbingT; ?>><label for="d_praktik_pembimbingT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_praktik_pembimbing"></div>
                    </td>
                </tr>
                <!-- Praktik Tarif -->
                <tr>
                    <td>Praktik Tarif</td>
                    <td>
                        <?php
                        $c_praktik_tarifY = "";
                        $c_praktik_tarifT = "";
                        if ($d_user_prvl['c_praktik_tarif'] == 'Y') $c_praktik_tarifY = "checked";
                        else if ($d_user_prvl['c_praktik_tarif'] == 'T')  $c_praktik_tarifT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_praktik_tarif" id="c_praktik_tarifY" value="Y" <?= $c_praktik_tarifY; ?>><label for="c_praktik_tarifY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_praktik_tarif" id="c_praktik_tarifT" value="T" <?= $c_praktik_tarifT; ?>><label for="c_praktik_tarifT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_praktik_tarif"></div>
                    </td>
                    <td>
                        <?php
                        $r_praktik_tarifY = "";
                        $r_praktik_tarifT = "";
                        if ($d_user_prvl['r_praktik_tarif'] == 'Y') $r_praktik_tarifY = "checked";
                        else if ($d_user_prvl['r_praktik_tarif'] == 'T')  $r_praktik_tarifT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_praktik_tarif" id="r_praktik_tarifY" value="Y" <?= $r_praktik_tarifY; ?>><label for="r_praktik_tarifY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_praktik_tarif" id="r_praktik_tarifT" value="T" <?= $r_praktik_tarifT; ?>><label for="r_praktik_tarifT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_praktik_tarif"></div>
                    </td>
                    <td>
                        <?php
                        $u_praktik_tarifY = "";
                        $u_praktik_tarifT = "";
                        if ($d_user_prvl['u_praktik_tarif'] == 'Y') $u_praktik_tarifY = "checked";
                        else if ($d_user_prvl['u_praktik_tarif'] == 'T')  $u_praktik_tarifT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_praktik_tarif" id="u_praktik_tarifY" value="Y" <?= $u_praktik_tarifY; ?>><label for="u_praktik_tarifY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_praktik_tarif" id="u_praktik_tarifT" value="T" <?= $u_praktik_tarifT; ?>><label for="u_praktik_tarifT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_praktik_tarif"></div>
                    </td>
                    <td>
                        <?php
                        $d_praktik_tarifY = "";
                        $d_praktik_tarifT = "";
                        if ($d_user_prvl['d_praktik_tarif'] == 'Y') $d_praktik_tarifY = "checked";
                        else if ($d_user_prvl['d_praktik_tarif'] == 'T')  $d_praktik_tarifT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_praktik_tarif" id="d_praktik_tarifY" value="Y" <?= $d_praktik_tarifY; ?>><label for="d_praktik_tarifY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_praktik_tarif" id="d_praktik_tarifT" value="T" <?= $d_praktik_tarifT; ?>><label for="d_praktik_tarifT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_praktik_tarif"></div>
                    </td>
                </tr>
                <!-- Praktik Bayar -->
                <tr>
                    <td>Praktik Bayar</td>
                    <td>
                        <?php
                        $c_praktik_bayarY = "";
                        $c_praktik_bayarT = "";
                        if ($d_user_prvl['c_praktik_bayar'] == 'Y') $c_praktik_bayarY = "checked";
                        else if ($d_user_prvl['c_praktik_bayar'] == 'T')  $c_praktik_bayarT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_praktik_bayar" id="c_praktik_bayarY" value="Y" <?= $c_praktik_bayarY; ?>><label for="c_praktik_bayarY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_praktik_bayar" id="c_praktik_bayarT" value="T" <?= $c_praktik_bayarT; ?>><label for="c_praktik_bayarT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_praktik_bayar"></div>
                    </td>
                    <td>
                        <?php
                        $r_praktik_bayarY = "";
                        $r_praktik_bayarT = "";
                        if ($d_user_prvl['r_praktik_bayar'] == 'Y') $r_praktik_bayarY = "checked";
                        else if ($d_user_prvl['r_praktik_bayar'] == 'T')  $r_praktik_bayarT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_praktik_bayar" id="r_praktik_bayarY" value="Y" <?= $r_praktik_bayarY; ?>><label for="r_praktik_bayarY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_praktik_bayar" id="r_praktik_bayarT" value="T" <?= $r_praktik_bayarT; ?>><label for="r_praktik_bayarT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_praktik_bayar"></div>
                    </td>
                    <td>
                        <?php
                        $u_praktik_bayarY = "";
                        $u_praktik_bayarT = "";
                        if ($d_user_prvl['u_praktik_bayar'] == 'Y') $u_praktik_bayarY = "checked";
                        else if ($d_user_prvl['u_praktik_bayar'] == 'T')  $u_praktik_bayarT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_praktik_bayar" id="u_praktik_bayarY" value="Y" <?= $u_praktik_bayarY; ?>><label for="u_praktik_bayarY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_praktik_bayar" id="u_praktik_bayarT" value="T" <?= $u_praktik_bayarT; ?>><label for="u_praktik_bayarT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_praktik_bayar"></div>
                    </td>
                    <td>
                        <?php
                        $d_praktik_bayarY = "";
                        $d_praktik_bayarT = "";
                        if ($d_user_prvl['d_praktik_bayar'] == 'Y') $d_praktik_bayarY = "checked";
                        else if ($d_user_prvl['d_praktik_bayar'] == 'T')  $d_praktik_bayarT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_praktik_bayar" id="d_praktik_bayarY" value="Y" <?= $d_praktik_bayarY; ?>><label for="d_praktik_bayarY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_praktik_bayar" id="d_praktik_bayarT" value="T" <?= $d_praktik_bayarT; ?>><label for="d_praktik_bayarT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_praktik_bayar"></div>
                    </td>
                </tr>
                <!-- Praktik Nilai -->
                <tr>
                    <td>Praktik Nilai</td>
                    <td>
                        <?php
                        $c_praktik_nilaiY = "";
                        $c_praktik_nilaiT = "";
                        if ($d_user_prvl['c_praktik_nilai'] == 'Y') $c_praktik_nilaiY = "checked";
                        else if ($d_user_prvl['c_praktik_nilai'] == 'T')  $c_praktik_nilaiT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_praktik_nilai" id="c_praktik_nilaiY" value="Y" <?= $c_praktik_nilaiY; ?>><label for="c_praktik_nilaiY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_praktik_nilai" id="c_praktik_nilaiT" value="T" <?= $c_praktik_nilaiT; ?>><label for="c_praktik_nilaiT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_praktik_nilai"></div>
                    </td>
                    <td>
                        <?php
                        $r_praktik_nilaiY = "";
                        $r_praktik_nilaiT = "";
                        if ($d_user_prvl['r_praktik_nilai'] == 'Y') $r_praktik_nilaiY = "checked";
                        else if ($d_user_prvl['r_praktik_nilai'] == 'T')  $r_praktik_nilaiT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_praktik_nilai" id="r_praktik_nilaiY" value="Y" <?= $r_praktik_nilaiY; ?>><label for="r_praktik_nilaiY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_praktik_nilai" id="r_praktik_nilaiT" value="T" <?= $r_praktik_nilaiT; ?>><label for="r_praktik_nilaiT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_praktik_nilai"></div>
                    </td>
                    <td>
                        <?php
                        $u_praktik_nilaiY = "";
                        $u_praktik_nilaiT = "";
                        if ($d_user_prvl['u_praktik_nilai'] == 'Y') $u_praktik_nilaiY = "checked";
                        else if ($d_user_prvl['u_praktik_nilai'] == 'T')  $u_praktik_nilaiT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_praktik_nilai" id="u_praktik_nilaiY" value="Y" <?= $u_praktik_nilaiY; ?>><label for="u_praktik_nilaiY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_praktik_nilai" id="u_praktik_nilaiT" value="T" <?= $u_praktik_nilaiT; ?>><label for="u_praktik_nilaiT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_praktik_nilai"></div>
                    </td>
                    <td>
                        <?php
                        $d_praktik_nilaiY = "";
                        $d_praktik_nilaiT = "";
                        if ($d_user_prvl['d_praktik_nilai'] == 'Y') $d_praktik_nilaiY = "checked";
                        else if ($d_user_prvl['d_praktik_nilai'] == 'T')  $d_praktik_nilaiT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_praktik_nilai" id="d_praktik_nilaiY" value="Y" <?= $d_praktik_nilaiY; ?>><label for="d_praktik_nilaiY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_praktik_nilai" id="d_praktik_nilaiT" value="T" <?= $d_praktik_nilaiT; ?>><label for="d_praktik_nilaiT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_praktik_nilai"></div>
                    </td>
                </tr>
                <!-- Arsip Praktik -->
                <tr>
                    <td>Arsip Praktik</td>
                    <td>
                        <?php
                        $c_arsip_praktikY = "";
                        $c_arsip_praktikT = "";
                        if ($d_user_prvl['c_arsip_praktik'] == 'Y') $c_arsip_praktikY = "checked";
                        else if ($d_user_prvl['c_arsip_praktik'] == 'T')  $c_arsip_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_arsip_praktik" id="c_arsip_praktikY" value="Y" <?= $c_arsip_praktikY; ?>><label for="c_arsip_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_arsip_praktik" id="c_arsip_praktikT" value="T" <?= $c_arsip_praktikT; ?>><label for="c_arsip_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_arsip_praktik"></div>
                    </td>
                    <td>
                        <?php
                        $r_arsip_praktikY = "";
                        $r_arsip_praktikT = "";
                        if ($d_user_prvl['r_arsip_praktik'] == 'Y') $r_arsip_praktikY = "checked";
                        else if ($d_user_prvl['r_arsip_praktik'] == 'T')  $r_arsip_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_arsip_praktik" id="r_arsip_praktikY" value="Y" <?= $r_arsip_praktikY; ?>><label for="r_arsip_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_arsip_praktik" id="r_arsip_praktikT" value="T" <?= $r_arsip_praktikT; ?>><label for="r_arsip_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_arsip_praktik"></div>
                    </td>
                    <td>
                        <?php
                        $u_arsip_praktikY = "";
                        $u_arsip_praktikT = "";
                        if ($d_user_prvl['u_arsip_praktik'] == 'Y') $u_arsip_praktikY = "checked";
                        else if ($d_user_prvl['u_arsip_praktik'] == 'T')  $u_arsip_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_arsip_praktik" id="u_arsip_praktikY" value="Y" <?= $u_arsip_praktikY; ?>><label for="u_arsip_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_arsip_praktik" id="u_arsip_praktikT" value="T" <?= $u_arsip_praktikT; ?>><label for="u_arsip_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_arsip_praktik"></div>
                    </td>
                    <td>
                        <?php
                        $d_arsip_praktikY = "";
                        $d_arsip_praktikT = "";
                        if ($d_user_prvl['d_arsip_praktik'] == 'Y') $d_arsip_praktikY = "checked";
                        else if ($d_user_prvl['d_arsip_praktik'] == 'T')  $d_arsip_praktikT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_arsip_praktik" id="d_arsip_praktikY" value="Y" <?= $d_arsip_praktikY; ?>><label for="d_arsip_praktikY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_arsip_praktik" id="d_arsip_praktikT" value="T" <?= $d_arsip_praktikT; ?>><label for="d_arsip_praktikT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_arsip_praktik"></div>
                    </td>
                </tr>
                <!-- PKD -->
                <tr>
                    <td>PKD</td>
                    <td>
                        <?php
                        $c_pkdY = "";
                        $c_pkdT = "";
                        if ($d_user_prvl['c_pkd'] == 'Y') $c_pkdY = "checked";
                        else if ($d_user_prvl['c_pkd'] == 'T')  $c_pkdT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_pkd" id="c_pkdY" value="Y" <?= $c_pkdY; ?>><label for="c_pkdY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_pkd" id="c_pkdT" value="T" <?= $c_pkdT; ?>><label for="c_pkdT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_pkd"></div>
                    </td>
                    <td>
                        <?php
                        $r_pkdY = "";
                        $r_pkdT = "";
                        if ($d_user_prvl['r_pkd'] == 'Y') $r_pkdY = "checked";
                        else if ($d_user_prvl['r_pkd'] == 'T')  $r_pkdT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_pkd" id="r_pkdY" value="Y" <?= $r_pkdY; ?>><label for="r_pkdY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_pkd" id="r_pkdT" value="T" <?= $r_pkdT; ?>><label for="r_pkdT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_pkd"></div>
                    </td>
                    <td>
                        <?php
                        $u_pkdY = "";
                        $u_pkdT = "";
                        if ($d_user_prvl['u_pkd'] == 'Y') $u_pkdY = "checked";
                        else if ($d_user_prvl['u_pkd'] == 'T')  $u_pkdT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_pkd" id="u_pkdY" value="Y" <?= $u_pkdY; ?>><label for="u_pkdY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_pkd" id="u_pkdT" value="T" <?= $u_pkdT; ?>><label for="u_pkdT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_pkd"></div>
                    </td>
                    <td>
                        <?php
                        $d_pkdY = "";
                        $d_pkdT = "";
                        if ($d_user_prvl['d_pkd'] == 'Y') $d_pkdY = "checked";
                        else if ($d_user_prvl['d_pkd'] == 'T')  $d_pkdT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_pkd" id="d_pkdY" value="Y" <?= $d_pkdY; ?>><label for="d_pkdY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_pkd" id="d_pkdT" value="T" <?= $d_pkdT; ?>><label for="d_pkdT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_pkd"></div>
                    </td>
                </tr>
                <!-- Log Book -->
                <tr>
                    <td>Log Book</td>
                    <td>
                        <?php
                        $c_logbookY = "";
                        $c_logbookT = "";
                        if ($d_user_prvl['c_logbook'] == 'Y') $c_logbookY = "checked";
                        else if ($d_user_prvl['c_logbook'] == 'T')  $c_logbookT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="c_logbook" id="c_logbookY" value="Y" <?= $c_logbookY; ?>><label for="c_logbookY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="c_logbook" id="c_logbookT" value="T" <?= $c_logbookT; ?>><label for="c_logbookT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_c_logbook"></div>
                    </td>
                    <td>
                        <?php
                        $r_logbookY = "";
                        $r_logbookT = "";
                        if ($d_user_prvl['r_logbook'] == 'Y') $r_logbookY = "checked";
                        else if ($d_user_prvl['r_logbook'] == 'T')  $r_logbookT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="r_logbook" id="r_logbookY" value="Y" <?= $r_logbookY; ?>><label for="r_logbookY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="r_logbook" id="r_logbookT" value="T" <?= $r_logbookT; ?>><label for="r_logbookT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_r_logbook"></div>
                    </td>
                    <td>
                        <?php
                        $u_logbookY = "";
                        $u_logbookT = "";
                        if ($d_user_prvl['u_logbook'] == 'Y') $u_logbookY = "checked";
                        else if ($d_user_prvl['u_logbook'] == 'T')  $u_logbookT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="u_logbook" id="u_logbookY" value="Y" <?= $u_logbookY; ?>><label for="u_logbookY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="u_logbook" id="u_logbookT" value="T" <?= $u_logbookT; ?>><label for="u_logbookT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_u_logbook"></div>
                    </td>
                    <td>
                        <?php
                        $d_logbookY = "";
                        $d_logbookT = "";
                        if ($d_user_prvl['d_logbook'] == 'Y') $d_logbookY = "checked";
                        else if ($d_user_prvl['d_logbook'] == 'T')  $d_logbookT = "checked";
                        else echo "ERROR!";
                        ?>
                        <input type="radio" name="d_logbook" id="d_logbookY" value="Y" <?= $d_logbookY; ?>><label for="d_logbookY">Ya</label>&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="d_logbook" id="d_logbookT" value="T" <?= $d_logbookT; ?>><label for="d_logbookT">Tidak</label>
                        <div class="text-center text-danger font-weight-bold font-italic text-xs blink" id="err_d_logbook"></div>
                    </td>
                </tr>
            </tbody>
            </tbody>
        </table>
    </div>
    <div class="form-inline navbar nav-link justify-content-end">
        <button type="button" name="ubah" class="btn btn-success mb-2 ubah">
            Ubah
        </button>
    </div>
</form>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $(document).on('click', '.ubah', function() {
        var data = $('#form_ubah').serialize();
        var id_user = $("#id_user").val();
        var c_kuota = $("input[name='c_kuota']:checked").val();
        var r_kuota = $("input[name='r_kuota']:checked").val();
        var u_kuota = $("input[name='u_kuota']:checked").val();
        var d_kuota = $("input[name='d_kuota']:checked").val();
        var c_akun = $("input[name='c_akun']:checked").val();
        var r_akun = $("input[name='r_akun']:checked").val();
        var u_akun = $("input[name='u_akun']:checked").val();
        var d_akun = $("input[name='d_akun']:checked").val();
        var c_praktik = $("input[name='c_praktik']:checked").val();
        var r_praktik = $("input[name='r_praktik']:checked").val();
        var u_praktik = $("input[name='u_praktik']:checked").val();
        var d_praktik = $("input[name='d_praktik']:checked").val();
        var c_praktik_mess = $("input[name='c_praktik_mess']:checked").val();
        var r_praktik_mess = $("input[name='r_praktik_mess']:checked").val();
        var u_praktik_mess = $("input[name='u_praktik_mess']:checked").val();
        var d_praktik_mess = $("input[name='d_praktik_mess']:checked").val();
        var c_praktik_pembimbing = $("input[name='c_praktik_pembimbing']:checked").val();
        var r_praktik_pembimbing = $("input[name='r_praktik_pembimbing']:checked").val();
        var u_praktik_pembimbing = $("input[name='u_praktik_pembimbing']:checked").val();
        var d_praktik_pembimbing = $("input[name='d_praktik_pembimbing']:checked").val();
        var c_praktik_tarif = $("input[name='c_praktik_tarif']:checked").val();
        var r_praktik_tarif = $("input[name='r_praktik_tarif']:checked").val();
        var u_praktik_tarif = $("input[name='u_praktik_tarif']:checked").val();
        var d_praktik_tarif = $("input[name='d_praktik_tarif']:checked").val();
        var c_praktik_bayar = $("input[name='c_praktik_bayar']:checked").val();
        var r_praktik_bayar = $("input[name='r_praktik_bayar']:checked").val();
        var u_praktik_bayar = $("input[name='u_praktik_bayar']:checked").val();
        var d_praktik_bayar = $("input[name='d_praktik_bayar']:checked").val();
        var c_praktik_nilai = $("input[name='c_praktik_nilai']:checked").val();
        var r_praktik_nilai = $("input[name='r_praktik_nilai']:checked").val();
        var u_praktik_nilai = $("input[name='u_praktik_nilai']:checked").val();
        var d_praktik_nilai = $("input[name='d_praktik_nilai']:checked").val();
        var c_arsip_praktik = $("input[name='c_arsip_praktik']:checked").val();
        var r_arsip_praktik = $("input[name='r_arsip_praktik']:checked").val();
        var u_arsip_praktik = $("input[name='u_arsip_praktik']:checked").val();
        var d_arsip_praktik = $("input[name='d_arsip_praktik']:checked").val();
        var c_pkd = $("input[name='c_pkd']:checked").val();
        var r_pkd = $("input[name='r_pkd']:checked").val();
        var u_pkd = $("input[name='u_pkd']:checked").val();
        var d_pkd = $("input[name='d_pkd']:checked").val();
        var c_logbook = $("input[name='c_logbook']:checked").val();
        var r_logbook = $("input[name='r_logbook']:checked").val();
        var u_logbook = $("input[name='u_logbook']:checked").val();
        var d_logbook = $("input[name='d_logbook']:checked").val();
        var c_praktikan = $("input[name='c_praktikan']:checked").val();
        var r_praktikan = $("input[name='r_praktikan']:checked").val();
        var u_praktikan = $("input[name='u_praktikan']:checked").val();
        var d_praktikan = $("input[name='d_praktikan']:checked").val();

        // console.log(c_kuota + r_kuota + u_kuota + d_kuota);

        if (
            id_user != "" &&
            c_kuota != "" &&
            r_kuota != "" &&
            u_kuota != "" &&
            d_kuota != "" &&
            c_akun != "" &&
            r_akun != "" &&
            u_akun != "" &&
            d_akun != "" &&
            c_praktik != "" &&
            r_praktik != "" &&
            u_praktik != "" &&
            d_praktik != "" &&
            c_praktik_mess != "" &&
            r_praktik_mess != "" &&
            u_praktik_mess != "" &&
            d_praktik_mess != "" &&
            c_praktik_pembimbing != "" &&
            r_praktik_pembimbing != "" &&
            u_praktik_pembimbing != "" &&
            d_praktik_pembimbing != "" &&
            c_praktik_tarif != "" &&
            r_praktik_tarif != "" &&
            u_praktik_tarif != "" &&
            d_praktik_tarif != "" &&
            c_praktik_bayar != "" &&
            r_praktik_bayar != "" &&
            u_praktik_bayar != "" &&
            d_praktik_bayar != "" &&
            c_praktik_nilai != "" &&
            r_praktik_nilai != "" &&
            u_praktik_nilai != "" &&
            d_praktik_nilai != "" &&
            c_arsip_praktik != "" &&
            r_arsip_praktik != "" &&
            u_arsip_praktik != "" &&
            d_arsip_praktik != "" &&
            c_pkd != "" &&
            r_pkd != "" &&
            u_pkd != "" &&
            d_pkd != "" &&
            c_logbook != "" &&
            r_logbook != "" &&
            u_logbook != "" &&
            d_logbook != "" &&
            c_praktikan != "" &&
            r_praktikan != "" &&
            u_praktikan != "" &&
            d_praktikan != ""
        ) {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_akun_hak_akses_u.php",
                data: data,
                success: function() {
                    $('#data_ha').load('_admin/view/v_akun_hak_akses_getData.php?ha=<?= $_GET['ha']; ?>');
                    Swal.fire({
                        allowOutsideClick: false,
                        icon: 'success',
                        title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Diubah</b></div>',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }
    });
</script>
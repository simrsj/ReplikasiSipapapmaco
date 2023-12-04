<?php
$r_bayar = $conn->query("SELECT *FROM tb_bayar WHERE id_praktik = " . $_GET['ub'])->rowCount();
if ($r_bayar == 0) {
?>
    <script type="text/javascript">
        alert('Data Tidak Ada');
        document.location.href = "?ptk";
    </script>
<?php
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="h3 mb-2 text-gray-800">Ubah Data Pembayaran</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4 ">
                <div class="card-body ">
                    <form class="form-group" method="post" enctype="multipart/form-data">
                        <?php
                        $q_bayar = $conn->query("SELECT * FROM tb_bayar WHERE id_praktik = " . $_GET['ub']);
                        $d_bayar = $q_bayar->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <b>Atas Nama : </b><br>
                        <input class="form-control" type="text" nama="atas_nama_bayar" value="<?= $d_bayar['atas_nama_bayar']; ?>"><br>
                        <b>No. Rekening/Lainnya : </b><br>
                        <input class="form-control" type="number" nama="no_bayar" value="<?= $d_bayar['no_bayar']; ?>"><br>
                        <b>Pembayaran Melalui : </b><br>
                        <input class="form-control" type="text" nama="melalui_bayar" value="<?= $d_bayar['melalui_bayar']; ?>"><br>
                        <b>Tanggal Bayar : </b><br>
                        <input class="form-control" type="date" nama="tgl_bayar" value="<?= $d_bayar['tgl_bayar']; ?>"><br>
                        <b>Unggah File : </b><br>
                        <i style='font-size:12px;'>File sebelumnya
                            <a href="<?= $d_bayar['file_bayar'] ?>">Download</a>
                        </i><br>
                        <input type="file" nama="file_bayar"><br>
                        <div class="modal-footer">
                            <input name="id_praktik" value="<?= $d_praktik['id_praktik'] ?>" hidden>
                            <input name="id_bayar" value="<?= $d_bayar['id_bayar'] ?>" hidden>
                            <input type="submit" name="ubah_bayar" value="Ubah" class="btn btn-primary btn-sm">
                            <a href="?ptk" class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['ubah_bayar'])) {

    $no_id_bayar = 0;
    while ($d_bayar = $conn->query("SELECT id_bayar FROM tb_bayar ORDER BY id_bayar ASC")->fetch(PDO::FETCH_ASSOC)) {
        if ($no_id_bayar != $d_bayar[0]) {
            $no_id_bayar = $d_bayar[0] + 1;
            break;
        } elseif ($no_id_bayar == 0) {
            $no_id_bayar;
            break;
        }
        $no_id_bayar = $d_bayar[0] + 1;
    }

    //alamat file surat masuk
    $alamat_unggah = "./_file/bayar";

    //ubah Nama File
    $_FILES['file_bayar']['name'] = "bayar_" . $no_id_bayar . "_" . $_POST['id_praktik'] . "-" . date('Y-m-d', time()) . ".pdf";

    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    //pembuatan alamat bila tidak ada
    if (!is_dir($alamat_unggah)) {
        mkdir($alamat_unggah, 0777, $rekursif = true);
    }

    //unggah surat dan data praktik
    if (!is_null($_FILES['file_bayar'])) {
        $file_bayar = (object) @$_FILES['file_bayar'];

        //mulai unggah file surat praktik
        if ($file_bayar->size > 1000 * 1000) {
            echo "
                <script>
                    alert('File Harus dibawah 1 Mb');
                </script>
                ";
        } elseif ($file_bayar->type !== 'application/pdf') {
            echo "
                <script>
                    alert('File Surat Harus .pdf');
                </script>
            ";
        } else {
            $unggah_file_bayar = move_uploaded_file(
                $file_bayar->tmp_name,
                "{$alamat_unggah}/{$file_bayar->name}"
            );
            $link_file_bayar = "{$alamat_unggah}/{$file_bayar->name}";
        }
    }
    $sql_insert_bayar = " INSERT INTO tb_bayar (
        id_bayar, 
        id_praktik,
        atas_nama_bayar, 
        no_bayar, 
        melalui_bayar,
        tgl_bayar, 
        file_bayar
    ) VALUE (
        '" . $no_id_bayar . "',
        '" . $_POST['id_praktik'] . "',
        '" . $_POST['atas_nama_bayar'] . "',
        '" . $_POST['no_bayar'] . "',        
        '" . $_POST['melalui_bayar'] . "',        
        '" . $_POST['tgl_bayar'] . "',
        '" . $link_file_bayar . "'
    )";
    echo $sql_insert_bayar . "<br>";
    // $conn->query($sql_insert_bayar);


    //SQL ubah status praktik
    $sql_ubah_status_praktik = "UPDATE tb_praktik
    SET status_cek_praktik = 'PEMBAYARAN'
    WHERE id_praktik = " . $_POST['id_praktik'];

    // echo $sql_ubah_status_praktik . "<br>";
    $conn->query($sql_ubah_status_praktik);
?>
    <script type="text/javascript">
        document.location.href = "?ptk";
    </script>
<?php
}

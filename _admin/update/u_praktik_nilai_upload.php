<?php if (isset($_GET['pnilai']) && isset($_GET['pmbb']) && isset($_GET['upu']) && $d_prvl['c_praktik_nilai'] == "Y") {
    $id_praktik = base64_decode(urldecode($_GET['pnilai']));
    $id_pembimbing = base64_decode(urldecode($_GET['pmbb']));;

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Ubah Nilai</h1>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                $sql_data_praktikan = "SELECT * FROM tb_pembimbing_pilih ";
                $sql_data_praktikan .= " JOIN tb_praktikan ON tb_pembimbing_pilih.id_praktikan = tb_praktikan.id_praktikan";
                $sql_data_praktikan .= " JOIN tb_pembimbing ON tb_pembimbing_pilih.id_pembimbing = tb_pembimbing.id_pembimbing";
                $sql_data_praktikan .= " JOIN tb_unit ON tb_pembimbing_pilih.id_unit = tb_unit.id_unit";
                $sql_data_praktikan .= " WHERE tb_pembimbing_pilih.id_praktik = " . $id_praktik . " AND tb_pembimbing_pilih.id_pembimbing = " . $id_pembimbing;
                $sql_data_praktikan .= " ORDER BY tb_praktikan.nama_praktikan ASC";
                // echo $sql_data_praktikan . "<br>";
                try {
                    $q_data_praktikan = $conn->query($sql_data_praktikan);
                    $q1_data_praktikan = $conn->query($sql_data_praktikan);
                } catch (Exception $ex) {
                    echo "<script>alert('$ex -DATA PRAKTIKAN-');";
                    echo "document.location.href='?error404';</script>";
                }
                $r_data_praktikan = $q_data_praktikan->rowCount();
                $j_ptkn = $r_data_praktikan;
                $d1_data_praktikan = $q1_data_praktikan->fetch(PDO::FETCH_ASSOC);
                if ($r_data_praktikan > 0) {
                ?>
                    <form method="POST" id="form_nilai_upload">
                        <!-- data praktikan  -->
                        <div class="row justify-content-between mb-0 pb-0">
                            <div class="col-md-auto text-left">
                                Nama Pembimbing : <?= $d1_data_praktikan['nama_pembimbing']; ?><br>
                                Ruangan : <?= $d1_data_praktikan['nama_unit']; ?>
                            </div>
                            <div class="col-md-3">
                                Unggah File Update :
                                <div class="custom-file">
                                    <label class="custom-file-label text-sm text-primary " for="customFile" id="labelfileinput">
                                        <span class="blink">Pilih Update File Nilai Praktik</span>
                                    </label>
                                    <input type="file" class="custom-file-input mb-1" id="nilai_upload" name="nilai_upload" accept="application/pdf" required placeholder="asdasd">
                                    <span class='i text-xs'>File Data Nilai Harus .pdf dan ukuran file kurang dari 1Mb</span><br>
                                    <div class="text-xs font-italic text-danger blink text-center" id="err_nilai_upload"></div><br>
                                    <script>
                                        $('.custom-file-input').on('change', function() {
                                            var fileName = $(this).val();
                                            $('#labelfileinput').html(fileName);
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                        <span class="table-responsive">
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">NIM / NPM / NIS</th>
                                        <th scope="col">No. HP </th>
                                        <th scope="col">No. WA </th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">ASAL KOTA / KABUPATEN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($d_data_praktikan = $q_data_praktikan->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <input type="hidden" name="id_unit" id="id_unit" value="<?= $d_data_praktikan['id_unit']; ?>">
                                        <input type="hidden" name="id_praktik" id="id_praktik" value="<?= $d_data_praktikan['id_praktik']; ?>">
                                        <input type="hidden" name="id_pembimbing" id="id_pembimbing" value="<?= $d_data_praktikan['id_pembimbing']; ?>">
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $d_data_praktikan['nama_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['telp_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['wa_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['wa_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['email_praktikan']; ?></td>
                                            <td><?= $d_data_praktikan['alamat_praktikan']; ?></td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </span>
                        <!-- tombol simpan pilih Pembimbing dan Ruangan  -->
                        <center>
                            <button type="button" name="simpan_nilai_upload" id="simpan_nilai_upload" class="btn btn-outline-success">
                                <i class="fas fa-file-upload"></i>
                                Ubah Nilai Praktik
                            </button>
                        </center>
                    </form>
                <?php
                } else {
                ?>
                    <div class="jumbotron">
                        <div class="jumbotron-fluid">
                            <div class="text-gray-700">
                                <h5 class="text-center">Data Praktikan Tidak Ada</h5>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#simpan_nilai_upload").click(function() {
                var nilai_upload = $('#nilai_upload').val();
                if (nilai_upload == "") {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'warning',
                        title: '<div class="text-center font-weight-bold text-uppercase">Data NILAI Belum dipilih</b></div>'
                    });

                    document.getElementById("err_nilai_upload").innerHTML = "File Nilai Belum Dipilih";
                    // console.log("Belum Upload");

                }

                //eksekusi bila file nilai terisi
                if (nilai_upload != "") {

                    //Cari ekstensi file nilai yg diupload
                    var typeNilai = document.querySelector('#nilai_upload').value;
                    var getTypeNilai = typeNilai.split('.').pop();

                    //cari ukuran file nilai yg diupload
                    var fileNilai = document.getElementById("nilai_upload").files;
                    var getSizeNilai = document.getElementById("nilai_upload").files[0].size / 1024;

                    // console.log("Size Nilai : " + getSizeNilai);
                    // console.log("Size Nilai : " + fileNilai);

                    //Toast bila upload file nilai selain pdf
                    if (getTypeNilai != 'pdf') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 10000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        Toast.fire({
                            icon: 'warning',
                            title: '<div class="text-md text-center">File Nilai Harus <b>.pdf</b></div>'
                        });
                        document.getElementById("err_nilai_upload").innerHTML = "File Nilai Harus pdf";
                    } //Toast bila upload file nilai diatas 1 Mb 
                    else if (getSizeNilai > 1024) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 10000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        Toast.fire({
                            icon: 'warning',
                            title: '<div class="text-md text-center">File Nilai Harus <br><b>Kurang dari 1 Mb</b></div>'
                        });
                        document.getElementById("err_nilai_upload").innerHTML = "File Nilai Harus Kurang dari 1 Mb";
                    } else {
                        //simpan file upload
                        var data_file = new FormData();
                        var xhttp = new XMLHttpRequest();

                        var fileNilai = document.getElementById("nilai_upload").files;
                        data_file.append("nilai_upload", fileNilai[0]);

                        data_file.append("idnu", "<?= $_GET['idnu'] ?>");

                        xhttp.open("POST", "_admin/exc/x_u_praktik_nilai_upload_uFileNilai.php", true);
                        xhttp.send(data_file);

                        Swal.fire({
                            allowOutsideClick: false,
                            // isDismissed: false,
                            icon: 'success',
                            title: '<span class"text-xs"><b>Data Nilai Berhasil disimpan',
                            showConfirmButton: false,
                            html: '<a href="?pnilai" class="btn btn-outline-primary">OK</a>',
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then(
                            function() {
                                document.location.href = "?pnilai";
                            }
                        );
                    }
                }

            });


        });
    </script>
<?php
} else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}
?>
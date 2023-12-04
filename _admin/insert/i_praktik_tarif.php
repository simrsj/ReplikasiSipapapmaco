<?php
if (isset($_GET['ptrf']) && isset($_GET['i']) && $d_prvl['c_praktik_tarif'] == "Y") {
    //data praktik
    $sql_praktik = "SELECT * FROM tb_praktik";
    $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
    $sql_praktik .= " WHERE tb_praktik.id_praktik = " . base64_decode(urldecode($_GET['ptrf']));
    // echo $sql_praktik."<br>";
    try {
        $q_praktik = $conn->query($sql_praktik);
    } catch (Exception $ex) {
        echo "<script>alert('$ex -DATA PRAKTIK');";
        echo "document.location.href='?error404';</script>";
    }
    $d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);

?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 text-gray-800">Pilih Tarif</h1>
            </div>
        </div>
        <!-- Data Praktik -->
        <div class="card shadow mb-4 mt-3">
            <div class="card-body">
                <div class="row text-center h6 text-gray-900 ">
                    <div class="col">
                        <?php if ($_SESSION['level_user'] == 1) { ?>
                            Nama Institusi : <br>
                            <b><?= $d_praktik['nama_institusi']; ?></b>
                            <hr class="p-0 m-1">
                        <?php } ?>
                        Nama Kelompok/Gelombang :<br>
                        <b><?= $d_praktik['nama_praktik']; ?></b>
                        <hr class="p-0 m-1">
                        Jumlah Praktik :<br>
                        <b><?= $d_praktik['jumlah_praktik']; ?></b>
                    </div>
                    <div class="col my-auto">
                        Tanggal Mulai :<br>
                        <b><?= tanggal($d_praktik['tgl_mulai_praktik']); ?></b>
                        <hr class="p-0 m-1">
                        Tanggal Selesai :<br>
                        <b><?= tanggal($d_praktik['tgl_selesai_praktik']); ?></b>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <?php
            //data tarif
            $sql_data_tarif = "SELECT * FROM tb_tarif ";
            $sql_data_tarif .= " JOIN tb_tarif_satuan ON tb_tarif.id_tarif_satuan= tb_tarif_satuan.id_tarif_satuan";
            $sql_data_tarif .= " JOIN tb_tarif_jenis ON tb_tarif.id_tarif_jenis= tb_tarif_jenis.id_tarif_jenis";
            $sql_data_tarif .= " WHERE tb_tarif.id_jurusan_pdd = " . $d_praktik['id_jurusan_pdd'];
            $sql_data_tarif .= " ORDER BY tb_tarif_jenis.nama_tarif_jenis ASC";
            // echo "$sql_data_tarif<br>";
            try {
                $q_data_tarif = $conn->query($sql_data_tarif);
            } catch (Exception $ex) {
                echo "<script>alert('$ex -DATA PRAKTIK');";
                echo "document.location.href='?error404';</script>";
            }
            // print_r($q_data_tarif);
            $r_data_tarif = $q_data_tarif->rowCount();
            if ($r_data_tarif > 0) {
            ?>
                <div class="card-body">
                    <form method="POST" id="form_ptrf">
                        <div class="text-center h5">
                            Bila ada tarif yang tidak digunakan <br>
                            isikan <span class="b text-danger">Frekuensi</span> dan <span class="b text-danger">Kuantitas</span> dengan <span class="b text-danger">Angka 0 (Nol)</span>
                        </div>
                        <hr>
                        <table class=" table table-striped table-bordered" style="width:100%">
                            <thead class="thead-dark">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Jenis Tarif</th>
                                    <th scope="col">Nama Tarif</th>
                                    <th scope="col" width="300px">Satuan</th>
                                    <th scope="col" width="150px">Tarif</th>
                                    <th scope="col" width="1px">Frekuensi</th>
                                    <th scope="col" width="1px">Kuantitas</th>
                                    <th scope="col" width="200px">Jumlah Tarif</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($d_data_tarif = $q_data_tarif->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr class="text-center">
                                        <td><?= $no; ?></td>
                                        <td>
                                            <?= $d_data_tarif['nama_tarif_jenis']; ?>
                                            <input type="hidden" name="nama_tarif_jenis<?= $no; ?>" id="nama_tarif_jenis<?= $no; ?>" value="<?= $d_data_tarif['nama_tarif_jenis'] ?>">
                                        </td>
                                        <td>
                                            <?= $d_data_tarif['nama_tarif']; ?>
                                            <input type="hidden" name="nama_tarif<?= $no; ?>" id="nama_tarif<?= $no; ?>" value="<?= $d_data_tarif['nama_tarif'] ?>">
                                        </td>
                                        <td>
                                            <?= $d_data_tarif['nama_tarif_satuan']; ?>
                                            <input type="hidden" name="nama_tarif_satuan<?= $no; ?>" id="nama_tarif_satuan<?= $no; ?>" value="<?= $d_data_tarif['nama_tarif_satuan'] ?>">
                                        </td>
                                        <td class="text-left">
                                            <?= "Rp " . number_format($d_data_tarif['jumlah_tarif'], 0, ",", "."); ?>
                                            <input type="hidden" name="tarif<?= $no; ?>" id="tarif<?= $no; ?>" value="<?= $d_data_tarif['jumlah_tarif'] ?>">
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" max="1" name="frekuensi<?= $no; ?>" id="frekuensi<?= $no; ?>" value="0" required>
                                            <div class="text-xs font-italic text-danger b blink" id="err_frekuensi<?= $no; ?>"></div>
                                        </td>
                                        <td>
                                            <input class="form-control" type="number" max="1" name="kuantitas<?= $no ?>" id="kuantitas<?= $no; ?>" value="0" required>
                                            <div class="text-xs font-italic text-danger b blink" id="err_kuantitas<?= $no; ?>"></div>
                                        </td>
                                        <td class="text-left">
                                            <div id="jumlahTarif<?= $no; ?>">Rp 0</div>
                                        </td>
                                    </tr>
                                <?php
                                    $baris_tarif = $no;
                                    $no++;
                                }
                                ?>
                                <!-- jumlah total tarif  -->
                                <!-- <tr>
                                    <td colspan="7" class="text-right b h5">Jumlah Total :</td>
                                    <td class="text-left b h5">
                                        <div id="jumlahTotalTarif">Rp 0</div>
                                        <script>
                                        </script>
                                    </td>
                                </tr> -->
                                <script>
                                    $(document).ready(function() {
                                        <?php
                                        $no = 1;
                                        while ($r_data_tarif >= $no) {
                                        ?>
                                            // var jumlahTotal = 0;
                                            var jumlahFr<?= $no ?> = 0;
                                            var jumlahKu<?= $no ?> = 0;
                                            $('#kuantitas<?= $no; ?>').change(function() {
                                                // jumlahTotal = jumlahTotal - jumlahFr<?= $no ?>;
                                                var frekuensi = $("#frekuensi<?= $no; ?>").val();
                                                var kuantitas = $("#kuantitas<?= $no; ?>").val();
                                                var tarif = $("#tarif<?= $no; ?>").val();

                                                jumlahFr<?= $no ?> = frekuensi * kuantitas * tarif;
                                                $("#jumlahTarif<?= $no; ?>").html('Rp ' + jumlahFr<?= $no ?>.toLocaleString());
                                                // jumlahTotal = jumlahTotal + jumlahFr<?= $no ?>;
                                                // $("#jumlahTotalTarif<?= $no; ?>").html('Rp ' + jumlahTotal.toLocaleString());
                                            });
                                            $('#frekuensi<?= $no; ?>').change(function() {
                                                // jumlahTotal = jumlahTotal - jumlahKu<?= $no ?>;
                                                var frekuensi = $("#frekuensi<?= $no; ?>").val();
                                                var kuantitas = $("#kuantitas<?= $no; ?>").val();
                                                var tarif = $("#tarif<?= $no; ?>").val();

                                                jumlahKu<?= $no ?> = frekuensi * kuantitas * tarif;
                                                $("#jumlahTarif<?= $no; ?>").html('Rp ' + jumlahKu<?= $no ?>.toLocaleString());
                                                // jumlahTotal = jumlahTotal + jumlahKu<?= $no ?>;
                                                // $("#jumlahTotalTarif<?= $no; ?>").html('Rp ' + jumlahTotal.toLocaleString());
                                            });
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    });
                                </script>
                                <!-- jumlah data praktikan  -->
                                <input type="hidden" name="jumlah_praktik_input" id="jumlah_praktik_input" value="<?= $no - 1;  ?>">
                            </tbody>
                        </table>
                    </form>

                    <!-- tombol simpan pilih Pembimbing dan atau Ruangan  -->
                    <a name="simpan_ptrf" id="simpan_ptrf" class="btn btn-outline-success text-center col">
                        <i class="fas fa-check-circle"></i> Simpan
                    </a>
                </div>
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
    <script>
        $("#simpan_ptrf").click(function() {
            var data_ptrf = $('#form_ptrf').serializeArray();
            //push data pilih_mess
            data_ptrf.push({
                name: 'idu',
                value: '<?= urlencode(base64_encode($_SESSION['id_user'])) ?>'
            }, {
                name: 'idp',
                value: '<?= urlencode(base64_encode($d_praktik['id_praktik'])) ?>'
            }, {
                name: 'bt',
                value: '<?= $baris_tarif; ?>'
            });
            var x_ptrf = "Y";

            //Notif Bila tidak diisi
            function alertDataTidakTerisi() {
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
                    title: '<center>DATA ADA YANG BELUM TERISI</center>'
                });
            }
            <?php
            $no = 1;
            while ($r_data_tarif >= $no) {
            ?>
                var frekuensi<?= $no; ?> = $('#frekuensi<?= $no; ?>').val();
                var kuantitas<?= $no; ?> = $('#kuantitas<?= $no; ?>').val();

                //warning Toast bila ada data wajib yg berlum terisi
                if (frekuensi<?= $no; ?> == "") {
                    $("#err_frekuensi<?= $no; ?>").html("Mohon Diisi");
                    alertDataTidakTerisi();
                    x_ptrf = "T";
                } else {
                    $("#err_frekuensi<?= $no; ?>").html("");
                }
                if (kuantitas<?= $no; ?> == "") {
                    $("#err_kuantitas<?= $no; ?>").html("Mohon Diisi");
                    alertDataTidakTerisi();
                    x_ptrf = "T";
                } else {
                    $("#err_kuantitas<?= $no; ?>").html("");
                }
            <?php
                $no++;
            }
            ?>


            //eksekusi bila sesuai
            if (x_ptrf == 'Y') {
                console.log("Tambah Tarif Praktik ");

                //Simpan praktik tarif
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_i_praktik_tarif_s.php",
                    data: data_ptrf,
                    success: function() {
                        Swal.fire({
                            allowOutsideClick: false,
                            // isDismissed: false,
                            icon: 'success',
                            title: '<span class"text-xs"><b>DATA TARIF</b><br>Berhasil Tersimpan',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then(
                            function() {
                                // document.location.href = "?ptk";
                            }
                        );
                    },
                    error: function() {
                        console.log('eksekusi simpan pilihan mess/pemondokan gagal');
                    }
                });
            }
        });
    </script>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

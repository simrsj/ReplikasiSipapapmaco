<?php
if (isset($_GET['pmbb']) && isset($_GET['i']) && $d_prvl['c_praktik_pembimbing'] == "Y") {
    //data praktik
    $sql_praktik = "SELECT * FROM tb_praktik";
    $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
    $sql_praktik .= " WHERE tb_praktik.id_praktik = " . base64_decode(urldecode($_GET['pmbb']));
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
                <h1 class="h3 text-gray-800">Pilih Pembimbing dan Ruangan</h1>
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
            <div class="card-body">
                <?php
                //data praktikan
                $sql_data_praktikan = "SELECT * FROM tb_praktikan ";
                $sql_data_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
                $sql_data_praktikan .= " WHERE tb_praktikan.id_praktik = " . base64_decode(urldecode($_GET['pmbb']));
                $sql_data_praktikan .= " ORDER BY tb_praktikan.nama_praktikan ASC";
                // echo $sql_data_praktikan;
                try {
                    $q_data_praktikan = $conn->query($sql_data_praktikan);
                } catch (Exception $ex) {
                    echo "<script>alert('$ex -DATA PRAKTIK');";
                    echo "document.location.href='?error404';</script>";
                }
                $r_data_praktikan = $q_data_praktikan->rowCount();
                // echo $r_data_praktikan;
                if ($r_data_praktikan > 0) {
                ?>
                    <form method="POST" id="form_pembb_ruangan">
                        <!-- data praktikan  -->
                        <div class="">
                            <table class="table table-striped" style="width:100%">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th scope="col">No</th>
                                        <th scope="col">No ID</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Pilih<br>Pembimbing</th>
                                        <?php if ($d_praktik['id_jurusan_pdd'] != 1) { ?>
                                            <th scope="col">Pilih<br>Ruangan</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($d_data_praktikan = $q_data_praktikan->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <input type="hidden" name="jurusan" id="jurusan" value="<?= $d_data_praktikan['id_jurusan_pdd']; ?>">
                                        <input type="hidden" name="jumlah_praktik" id="jumlah_praktik" value="<?= $d_data_praktikan['jumlah_praktik']; ?>">
                                        <input type="hidden" name="id_praktik" id="id_praktik" value="<?= $_GET['pmbb']; ?>">
                                        <input type="hidden" name="id_praktikan<?= $no; ?>" id="id_praktikan<?= $no; ?>" value="<?= $d_data_praktikan['id_praktikan']; ?>">
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $d_data_praktikan['nama_praktikan']; ?></td>
                                            <td class="text-center"><?= $d_data_praktikan['no_id_praktikan']; ?></td>
                                            <td class="text-center">
                                                <?php

                                                $id_jurusan_pdd = $d_data_praktikan['id_jurusan_pdd'];
                                                $id_jenjang_pdd = $d_data_praktikan['id_jenjang_pdd'];
                                                $id_profesi_pdd = $d_data_praktikan['id_profesi_pdd'];

                                                //jika profesi kosong
                                                if ($id_profesi_pdd == "") $id_profesi_pdd = 0;

                                                $sql_pmbb = "SELECT * FROM tb_pembimbing ";
                                                $sql_pmbb .= " WHERE id_jurusan_pdd = " . $id_jurusan_pdd;
                                                $sql_pmbb .= " AND id_jenjang_pdd >= " . $id_jenjang_pdd;
                                                $sql_pmbb .= " AND id_profesi_pdd >= " . $id_profesi_pdd;
                                                $sql_pmbb .= " AND status_pembimbing = 'Y'";
                                                $sql_pmbb .= " ORDER BY kali_pembimbing ASC, nama_pembimbing ASC";
                                                // echo $sql_pmbb . "<br>";
                                                try {
                                                    $q_pmbb = $conn->query($sql_pmbb);
                                                } catch (Exception $ex) {
                                                    echo "<script>alert('$ex -DATA PEMBIMBING');";
                                                    echo "document.location.href='?error404';</script>";
                                                }
                                                ?>
                                                <select class='select2' aria-label='Default select example' name="id_pembimbing<?= $no; ?>" id="id_pembimbing<?= $no; ?>" required>
                                                    <option value="">-- Pilih --</option>
                                                    <?php
                                                    while ($d_pmbb = $q_pmbb->fetch(PDO::FETCH_ASSOC)) {
                                                        $sql_pmbb_kali = "SELECT * FROM tb_pembimbing_pilih ";
                                                        $sql_pmbb_kali .= " WHERE id_pembimbing =" . $d_pmbb['id_pembimbing'];
                                                        $sql_pmbb_kali .= " GROUP BY id_praktik";
                                                        // echo $sql_pmbb . "<br>";
                                                        try {
                                                            $q_pmbb_kali = $conn->query($sql_pmbb_kali);
                                                        } catch (Exception $ex) {
                                                            echo "<script>alert('$ex -DATA PEMBIMBING KALI');";
                                                            echo "document.location.href='?error404';</script>";
                                                        }
                                                    ?>
                                                        <option value="<?= $d_pmbb['id_pembimbing']; ?>">
                                                            <?= "(" . $q_pmbb_kali->rowCount() . ") " . $d_pmbb['nama_pembimbing']; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                                <script>
                                                    var options = $('#id_pembimbing<?= $no; ?> option');
                                                    var arr = options.map(function(_, o) {
                                                        return {
                                                            t: $(o).text(),
                                                            v: o.value
                                                        };
                                                    }).get();
                                                    arr.sort(function(o1, o2) {
                                                        return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
                                                    });
                                                    options.each(function(i, o) {
                                                        o.value = arr[i].v;
                                                        $(o).text(arr[i].t);
                                                    });
                                                </script>
                                                <span id="err_pmbb<?= $no; ?>" class="text-danger text-xs font-italic blink"></span>
                                            </td>
                                            <?php
                                            if ($id_jurusan_pdd != 1) {
                                            ?>
                                                <td class="text-center">
                                                    <?php
                                                    $sql_unit = "SELECT * FROM tb_unit";
                                                    $sql_unit .= " ORDER BY nama_unit ASC";
                                                    try {
                                                        $q_unit = $conn->query($sql_unit);
                                                    } catch (Exception $ex) {
                                                        echo "<script>alert('$ex -DATA UNIT');";
                                                        echo "document.location.href='?error404';</script>";
                                                    }
                                                    ?>
                                                    <select class='select2' aria-label='Default select example' name='id_unit<?= $no; ?>' id="id_unit<?= $no; ?>" required>
                                                        <option value="">-- Pilih --</option>
                                                        <?php
                                                        while ($d_unit = $q_unit->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                            <option value="<?= $d_unit['id_unit']; ?>">
                                                                <?= $d_unit['nama_unit']; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span id="err_unit<?= $no; ?>" class="text-danger text-xs font-italic blink"></span>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                    <input type="hidden" name="jumlah_praktik_input" id="jumlah_praktik_input" value="<?= $no - 1;  ?>">
                                </tbody>
                            </table>
                        </div>
                        <hr>

                        <!-- tombol simpan pilih Pembimbing dan atau Ruangan  -->
                        <div class="nav btn justify-content-center text-md">
                            <button type="button" name="simpan_pmbb_tmp" id="simpan_pmbb_tmp" class="btn btn-outline-success">
                                <i class="fas fa-check-circle"></i>
                                Simpan
                            </button>
                        </div>
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
        $("#simpan_pmbb_tmp").click(function() {
            var data_pembimbing = $('#form_pembb_ruangan').serializeArray();
            var jumlah_praktik = $('#jumlah_praktik').val();
            var jumlah_praktik_input = $('#jumlah_praktik_input').val();
            var jurusan = $('#jurusan').val();
            console.log(jumlah_praktik);
            console.log(jumlah_praktik_input);
            //Jika Jumlah Praktik tidak sesuai dengan data praktikan
            if (jumlah_praktik != jumlah_praktik_input) {
                Swal.fire({
                    allowOutsideClick: false,
                    // isDismissed: false,
                    icon: 'error',
                    title: '<span class"text-xs">' +
                        '<b>DATA PRAKTIKAN</b> <br> ' +
                        'TIDAK SESUAI DENGAN<br>' +
                        '<b>JUMLAH PRAKTIK</b><br>' +
                        'Sesuaikan kembali di menu <b>DATA PRAKTIKAN praktikan</b><br>' +
                        '</span>',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
            } else {
                //Notif jika tida diisi Pembimbing 
                var no = 1;
                var pmbb = 0;
                while (no <= jumlah_praktik) {
                    console.log("no: " + no + "jumlah_praktik: " + jumlah_praktik);
                    if ($('#id_pembimbing' + no).val() == "") {
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
                        $("#err_pmbb" + no).html("<br>Pembimbing Harus Dipilih");
                        pmbb++;
                    } else {
                        $("#err_pmbb" + no).html("");
                    }
                    no++;

                }

                //Notif jika tidak diisi Unit
                var no = 1;
                var unit = 0;
                if (jurusan != 1) {
                    while (no <= jumlah_praktik) {
                        console.log("no: " + no + "jumlah_praktik: " + jumlah_praktik);
                        if (document.getElementById('id_unit' + no).value == "") {
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
                            document.getElementById("err_unit" + no).innerHTML = "<br> Ruangan Harus Dipilih";
                            unit++;
                        } else {
                            document.getElementById("err_unit" + no).innerHTML = "";
                        }
                        no++;
                    }
                }
            }

            //jika data sudah diisi semua
            if (pmbb == 0 && unit == 0 && jumlah_praktik == jumlah_praktik_input) {
                if (jurusan == 1) {
                    $title = '<span class"text-xs"><b>DATA Pembimbing</b><br>Berhasil Tersimpan';
                } else {
                    $title = '<span class"text-xs"><b>DATA Pembimbing</b> dan <b>Ruangan</b><br>Berhasil Tersimpan';
                }
                console.log("Simpan PMBB");
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_i_praktik_pembimbing_s.php?",
                    data: data_pembimbing,
                    success: function() {
                        Swal.fire({
                            allowOutsideClick: true,
                            // isDismissed: false,
                            icon: 'success',

                            title: $title,
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then(
                            function() {
                                document.location.href = "?pmbb#rincian<?= md5(base64_decode(urldecode($_GET['pmbb']))); ?>";
                            }
                        );
                    },
                    error: function(response) {
                        console.log(response.responseText);
                        alert('eksekusi query gagal');
                    }
                });
            }
        });
    </script>
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

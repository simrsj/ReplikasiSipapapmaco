<?php
$id_praktik = base64_decode(urldecode($_GET['ptk']));

//query data praktik
$sql_praktik = "SELECT * FROM tb_praktik ";
$sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
$sql_praktik .= " WHERE id_praktik = $id_praktik";
try {
    $q_praktik = $conn->query($sql_praktik);
    $d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRAKTIK-');document.location.href='?error404';</script>";
}

//query data mess yg sudah dipilih
$sql_mess_pilih = "SELECT * FROM tb_mess_pilih ";
$sql_mess_pilih .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess ";
$sql_mess_pilih .= " WHERE id_praktik = $id_praktik";
// echo $sql_mess_pilih . "<br>";
try {
    $q_mess_pilih = $conn->query($sql_mess_pilih);
    $d_mess_pilih = $q_mess_pilih->fetch(PDO::FETCH_ASSOC);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA MESS PILIH-');document.location.href='?error404';</script>";
}

if ($d_prvl['u_praktik_mess'] == 'Y' && $q_mess_pilih->rowCount() > 0) {
    $jumlah_praktik = $d_praktik['jumlah_praktik'];
?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 h4 text-gray-900">
                Ubah Mess/Pemondokan
            </div>
        </div>
        <!-- Data Praktik -->
        <div class="card shadow mb-4 mt-3">
            <div class="card-body">
                <div class="row text-center h6 text-gray-900 ">
                    <div class="col my-auto">
                        Nama Institusi :
                        <b><?= $d_praktik['nama_institusi']; ?></b>
                        <hr>
                        Jumlah Praktik :
                        <b><?= $d_praktik['jumlah_praktik']; ?></b>
                    </div>
                    <div class="col my-auto">
                        Tanggal Mulai :
                        <b><?= tanggal($d_praktik['tgl_mulai_praktik']); ?></b>
                        <hr>
                        Tanggal Selesai :
                        <b><?= tanggal($d_praktik['tgl_selesai_praktik']); ?></b>
                    </div>
                    <div class="col my-auto">
                        Mess yang Dipilih :
                        <b><?= $d_mess_pilih['nama_mess']; ?></b>
                        <hr>
                        Nama Pemilik :
                        <b><?= $d_mess_pilih['nama_pemilik_mess']; ?></b>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pilih Mess/Pemondokan -->
        <div class="card shadow mb-4 mt-3">
            <div class="card-body">
                <?php
                $sql_mess = "SELECT * FROM tb_mess ";
                $sql_mess .= " WHERE status_mess = 'Y'";
                // echo $sql_mess . "<br>";
                try {
                    $q_mess = $conn->query($sql_mess);
                } catch (Exception $ex) {
                    echo "<script>alert('Maaf Data Tidak Ada');document.location.href='?error404';</script>";
                }

                $r_mess = $q_mess->rowCount();
                if ($r_mess > 0) {
                ?>

                    <input type="hidden" name="jumlah_mess" id="jumlah_mess" value="<?= $r_mess; ?>">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th scope='col'>No</th>
                                    <th>Nama Mess</th>
                                    <th>Nama Pemilik</th>
                                    <th>Kontak Pemilik</th>
                                    <th>Kepemilikan Mess</th>
                                    <th>Kapasitas Total</th>
                                    <th>Status Kuota</th>
                                    <th>Cek Jadwal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <input type="hidden" name="mess<?= $no; ?>" id="mess<?= $no; ?>" value="<?= $d_mess['id_mess']; ?>">
                                    <tr class="text-center">
                                        <td><?= $no; ?></td>
                                        <td class="text-left"><?= $d_mess['nama_mess']; ?></td>
                                        <td><?= $d_mess['nama_pemilik_mess']; ?></td>
                                        <td><?= $d_mess['telp_pemilik_mess']; ?></td>
                                        <td>
                                            <?php if ($d_mess['kepemilikan_mess'] == 'dalam') { ?>
                                                <span class="badge badge-primary">Dalam</span>
                                            <?php } else if ($d_mess['kepemilikan_mess'] == 'luar') { ?>
                                                <span class="badge badge-success">Luar</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">ERROR</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($d_mess['kepemilikan_mess'] == 'dalam') { ?>
                                                <?= $d_mess['kapasitas_t_mess']; ?>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($d_mess['kepemilikan_mess'] == 'dalam') { ?>
                                                <div class="ketersediaan_mess<?= $no; ?>"></div>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($d_mess['kepemilikan_mess'] == 'dalam') { ?>
                                                <!-- tombol cek jadwal mess -->
                                                <a class='btn btn-outline-dark btn-sm cekJadwalMess<?= $no; ?>' id='<?= $d_mess['id_mess']; ?>' href='#' data-toggle='modal' data-target='#modalMess<?= $d_mess['id_mess']; ?>'>
                                                    <i class="fas fa-info-circle"></i> Rincian
                                                </a>

                                                <!-- modal cek jadwal mess  -->
                                                <div class="modal fade" id="modalMess<?= $d_mess['id_mess']; ?>">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-lg ">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-uppercase font-weight-bold">
                                                                <b><?= $d_mess['nama_mess']; ?></b>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body p-0">
                                                                <div id="dataJadwalMess<?= $no; ?>"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                -
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                } else {
                ?>
                    <h3> Data Mess Tidak Ada</h3>
                <?php
                }
                ?>

                <!-- tombol pemilihan mess/pemondokan -->
                <nav id="navbar-tarif" class="navbar justify-content-center">
                    <a class='nav-link btn btn-outline-success' href='#' data-toggle='modal' data-target='#pilih_mess'>
                        PILIH MESS/PEMONDOKAN
                    </a>
                </nav>

                <!-- modal pemilihan mess/pemondokan -->
                <div class="modal fade text-left " id="pilih_mess" data-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form class="form-data text-gray-900" method="post" enctype="multipart/form-data" id="form_sMess">
                                <div class="modal-header">
                                    <b>PILIH MESS/PEMONDOKAN</b>
                                </div>
                                <div class="modal-body text-center">
                                    <span class="text-lg font-weight-bold">Nama Mess <span style="color:red">*</span></span>

                                    <!-- data pilih mess kosong -->
                                    <select class="select2" name="id_mess" id="id_mess" required>
                                    </select>
                                    <div id="err_mess" class="text-danger text-xs font-italic blink mb-3"></div>
                                    <div class="jumbotron">
                                        <div class="jumbotron-fluid">
                                            "Pilihan yang dimunculkan <br>
                                            <b>dipioritaskan Mess yang dari RSJ (Dalam)</b>, <br>
                                            bila Mess RSJ <b>tidak bisa menampung praktikan</b> <br>
                                            maka <b>pilihan otomatis</b> akan dialihkan ke <b>Mess/Pemondokan diluar</b>"
                                        </div>
                                    </div>
                                    <input type="hidden" name="idp" id="idp" value="<?= urlencode(base64_encode($id_praktik)); ?>">
                                    <input type="hidden" name="idu" id="idu" value="<?= urlencode(base64_encode($_SESSION['id_user'])); ?>">
                                    <input type="hidden" name="idtp" id="idtp" value="<?= urlencode(base64_encode($d_mess_pilih['id_tarif_pilih'])); ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-sm" id="ubah_mess">UBAH</button>
                                    <button class="btn btn-outline-dark btn-sm" type="button" data-dismiss="modal">KEMBALI</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            <?php
            //Perulangan jumlah mess/pemodalan yang aktif
            $no1 = 1;
            while ($no1 <= $r_mess) {
            ?>
                $(".cekJadwalMess<?= $no1; ?>").click(function() {
                    var id = $(this).attr('id');
                    var xhttp = new XMLHttpRequest();

                    xhttp.open("GET", "_admin/insert/i_praktik_mess_dataJadwal.php?id=" + id, true);
                    xhttp.send();

                    xhttp.onreadystatechange = function() {
                        document.getElementById("dataJadwalMess<?= $no1; ?>").innerHTML = xhttp.responseText;
                    };
                });

                var id_mess = $('#mess<?= $no1; ?>').val();
                $.ajax({
                    type: 'POST',
                    url: "_admin/insert/i_praktik_mess_dataTgl.php?",
                    data: {
                        id_m: $('#mess<?= $no1; ?>').val(),
                        jp: <?= $jumlah_praktik ?>,
                        tgl_m: "<?= $d_praktik['tgl_mulai_praktik'] ?>",
                        tgl_s: "<?= $d_praktik['tgl_selesai_praktik'] ?>",
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.messKet == 'T') {
                            $('.ketersediaan_mess<?= $no1; ?>').html('<span class="badge badge-success">Kosong</span>');
                        } else if (response.messKet == 'Y') {
                            $('.ketersediaan_mess<?= $no1; ?>').html('<span class="badge badge-danger">Penuh</span>');
                        } else {
                            $('.ketersediaan_mess<?= $no1; ?>').html('<span class="badge badge-danger">ERROR!!!</span>');
                        }
                        // $('#option_mess').append(response.messOption).trigger("change");
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            <?php
                $no1++;
            }
            ?>

            //select option pilih mess/pemondokan
            $.ajax({
                type: 'POST',
                url: "_admin/insert/i_praktik_mess_selectOption.php?",
                data: {
                    jp: "<?= $jumlah_praktik; ?>",
                    tgl_m: "<?= $d_praktik['tgl_mulai_praktik']; ?>",
                    tgl_s: "<?= $d_praktik['tgl_selesai_praktik']; ?>"
                },
                dataType: 'json',
                success: function(response) {
                    $('#id_mess').append(response.option).trigger("change");
                },
                error: function(response) {
                    console.log(response.ket);
                    alert('eksekusi query gagal');
                }
            });

            //eksekusi pengecekan ubah pilihan mess/pemondokan
            $("#ubah_mess").click(function() {

                var mess = $('#id_mess').val();

                //Notif Bila tidak dipilih mess/pemondokan
                if (mess == "") {

                    //warning Toast bila ada data wajib yg berlum terisi
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
                        title: '<center>DATA BELUM DIPILIH</center>'
                    });

                    //notif makan tidak diisi
                    if (mess == "") {
                        document.getElementById("err_mess").innerHTML = "Pilih Mess/Pemondokan";
                    } else {
                        document.getElementById("err_mess").innerHTML = "";
                    }
                }

                //ubah pilihan mess/pemodokan bila sudah sesuais
                if (mess != "") {
                    var data_pilih_mess = $('#form_sMess').serializeArray();

                    //ubah pilihan mess/pemondokan
                    $.ajax({
                        type: 'POST',
                        url: "_admin/exc/x_u_praktik_mess_u.php",
                        data: data_pilih_mess,
                        success: function() {
                            Swal.fire({
                                allowOutsideClick: false,
                                // isDismissed: false,
                                icon: 'success',
                                title: '<span class"text-xs"><b>DATA MESS</b><br>Berhasil Diubah',
                                showConfirmButton: false,
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            }).then(
                                function() {
                                    document.location.href = "?ptk";
                                }
                            );
                        },
                        error: function() {
                            console.log('eksekusi ubah pilihan mess/pemondokan gagal');
                        }
                    });
                }

            });

        });
    </script>
<?php } else {
    echo "<script>alert('Unauthorized');document.location.href='?error401';</script>";
}

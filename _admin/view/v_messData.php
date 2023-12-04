<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
?>

<div class="card shadow mb-4">
    <div class="card-body">
        <?php
        $sql_mess = "SELECT * FROM tb_mess order by nama_mess ASC";
        $q_mess = $conn->query($sql_mess);
        $r_mess = $q_mess->rowCount();
        if ($r_mess > 0) {
        ?>
            <div class="table-responsive text-sm">
                <table class="table table-hover" id="dataTable">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope='col'>No</th>
                            <th>Nama Mess</th>
                            <th>
                                Nama Pemilik
                                <hr class="p-0 m-0 bg-gray-100">
                                Telepon
                                <hr class="p-0 m-0 bg-gray-100">
                                Email
                            </th>
                            <th>Kapasitas Total</th>
                            <th>
                                Tarif Tanpa Makan
                                <hr class="p-0 m-0 bg-gray-100">
                                Tarif Dengan Makan
                            </th>
                            <th>Kepemilikan</th>
                            <th>
                                Action
                                <hr class="p-0 m-0 bg-gray-100">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $d_mess['nama_mess']; ?></td>
                                <td class="text-center">
                                    <?= $d_mess['nama_pemilik_mess']; ?>
                                    <hr class="p-0 m-0 bg-gray-100">
                                    <?= $d_mess['telp_pemilik_mess']; ?>
                                    <hr class="p-0 m-0 bg-gray-100">
                                    <?= $d_mess['email_pemilik_mess']; ?>
                                </td>
                                <td class="text-center"><?= $d_mess['kapasitas_t_mess']; ?></td>
                                <td class="text-center">
                                    <?= "Rp " . number_format($d_mess['tarif_tanpa_makan_mess'], 0, ",", "."); ?>
                                    <hr class="p-0 m-0 bg-gray-100">
                                    <?= "Rp " . number_format($d_mess['tarif_dengan_makan_mess'], 0, ",", "."); ?>
                                </td>
                                <td class="text-center text-md">
                                    <?php
                                    if ($d_mess['kepemilikan_mess'] == 'dalam') {
                                        echo "<span class='badge badge-success text-uppercase'>" . $d_mess['kepemilikan_mess'] . "</span>";
                                    } elseif ($d_mess['kepemilikan_mess'] == 'luar') {
                                        echo "<span class='badge badge-primary text-uppercase'>" . $d_mess['kepemilikan_mess'] . "</span>";
                                    }
                                    ?>
                                </td>
                                <td class="text-center text-md">
                                    <button title="Ubah" class='btn btn-primary btn-xs ubah_init' id='<?= $d_mess['id_mess']; ?>'>
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button title="Hapus" class='btn btn-outline-danger btn-xs hapus' id='<?= $d_mess['id_mess']; ?>'>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <hr class="m-1 bg-gray-500">
                                    <?php
                                    if ($d_mess['status_mess'] == 'Y') {
                                    ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php
                                    } else {
                                    ?>
                                        <span class="badge badge-danger">Non-Aktif</span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <?php
                                $no++;
                                ?>
                            </tr>
                        <?php
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
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $(".ubah_init").click(function() {
        // console.log("ubah_init");
        $('#err_u_nama_mess').empty();
        $('#err_u_nama_pemilik_mess').empty();
        $('#err_u_telp_pemilik_mess').empty();
        $('#err_u_kepemilikan_mess').empty();
        $('#err_u_tarif_tanpa_makan_mess').empty();
        $('#err_u_tarif_dengan_makan_mess').empty();
        $('#err_u_kapsitas_total_mess').empty();
        $('#err_u_alamat_mess').empty();
        $('#err_u_fasilitas_mess').empty();
        $('#err_u_status_mess').empty();

        $('#form_ubah_mess').trigger("reset");
        $('#u_kepemilikan_mess').val('').trigger("change");
        $('#u_status_mess').val('').trigger("change");
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "_admin/view/v_messGetData.php",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $('#u_id_mess').val(response.id_mess);
                $('#u_nama_mess').val(response.nama_mess);
                $('#u_nama_pemilik_mess').val(response.nama_pemilik_mess);
                $('#u_telp_pemilik_mess').val(response.telp_pemilik_mess);
                $('#u_email_pemilik_mess').val(response.email_pemilik_mess);
                $('#u_kepemilikan_mess').val(response.kepemilikan_mess).trigger('change');
                $('#u_tarif_tanpa_makan_mess').val(response.tarif_tanpa_makan_mess);
                $('#u_tarif_dengan_makan_mess').val(response.tarif_dengan_makan_mess);
                $('#u_kapasitas_total_mess').val(response.kapasitas_t_mess);
                $('#u_alamat_mess').val(response.alamat_mess);
                $('#u_fasilitas_mess').val(response.fasilitas_mess);
                $('#u_status_mess').val(response.status_mess).trigger('change');

                // console.log('id mess ' + response.id_mess);
            },
            error: function(response) {
                alert(response.responseText);
                console.log(response.responseText);
            }
        });

        $("#data_tambah_mess").fadeOut(1);
        $("#data_ubah_mess").fadeIn(1);

        var ubahScrollAnimate = $("html, body, input");
        ubahScrollAnimate.stop().animate({
            scrollTop: 0
        }, 500, 'swing', function() {
            $('#u_nama_mess').focus();
        });
    });

    $(".ubah_tutup").click(function() {
        $('#err_u_nama_mess').empty();
        $('#err_u_nama_pemilik_mess').empty();
        $('#err_u_telp_pemilik_mess').empty();
        $('#err_u_kepemilikan_mess').empty();
        $('#err_u_tarif_tanpa_makan_mess').empty();
        $('#err_u_tarif_dengan_makan_mess').empty();
        $('#err_u_kapsitas_total_mess').empty();
        $('#err_u_alamat_mess').empty();
        $('#err_u_fasilitas_mess').empty();
        $('#err_u_status_mess').empty();

        $('#form_ubah_mess').trigger("reset");
        $('#u_kepemilikan_mess').val('').trigger("change");
        $('#u_status_mess').val('').trigger("change");

        $("#data_ubah_mess").fadeOut(1);
    });

    $(document).on('click', '.ubah', function() {
        var data = $('#form_ubah_mess').serialize();

        var u_id_mess = $('#u_id_mess').val();
        var u_nama_mess = $('#u_nama_mess').val();
        var u_nama_pemilik_mess = $('#u_nama_pemilik_mess').val();
        var u_telp_pemilik_mess = $('#u_telp_pemilik_mess').val();
        // var u_email_pemilik_mess = $('#u_email_pemilik_mess').val();
        var u_kepemilikan_mess = $('#u_kepemilikan_mess').val();
        var u_tarif_tanpa_makan_mess = $('#u_tarif_tanpa_makan_mess').val();
        var u_tarif_dengan_makan_mess = $('#u_tarif_dengan_makan_mess').val();
        var u_kapasitas_total_mess = $('#u_kapasitas_total_mess').val();
        var u_alamat_mess = $('#u_alamat_mess').val();
        var u_fasilitas_mess = $('#u_fasilitas_messs').val();
        var u_status_mess = $('#u_status_mess').val();

        //cek data from tambah bila tidak diiisi
        if (
            u_nama_mess == "" ||
            u_nama_pemilik_mess == "" ||
            u_telp_pemilik_mess == "" ||
            u_kepemilikan_mess == "" ||
            u_tarif_tanpa_makan_mess == "" ||
            u_tarif_dengan_makan_mess == "" ||
            u_kapasitas_total_mess == "" ||
            u_alamat_mess == "" ||
            u_fasilitas_mess == "" ||
            u_status_mess == ""
        ) {
            if (u_nama_mess == "") {
                document.getElementById("err_u_nama_mess").innerHTML = "Nama Mess Harus Diisi";
            } else {
                document.getElementById("err_u_nama_mess").innerHTML = "";
            }

            if (u_nama_pemilik_mess == "") {
                document.getElementById("err_u_nama_pemilik_mess").innerHTML = "Nama Pemilik Harus Diisi";
            } else {
                document.getElementById("err_u_nama_pemilik_mess").innerHTML = "";
            }

            if (u_telp_pemilik_mess == "") {
                document.getElementById("err_u_telp_pemilik_mess").innerHTML = "Telpon Pemilik Harus Diisi";
            } else {
                document.getElementById("err_u_telp_pemilik_mess").innerHTML = "";
            }


            if (u_kepemilikan_mess == "") {
                document.getElementById("err_u_kepemilikan_mess").innerHTML = "Kepemilikan Harus Dipilih";
            } else {
                document.getElementById("err_u_kepemilikan_mess").innerHTML = "";
            }

            if (u_tarif_tanpa_makan_mess == "") {
                document.getElementById("err_u_tarif_tanpa_makan_mess").innerHTML = "Tarif Tanpa Makan Mess Harus Diisi";
            } else {
                document.getElementById("err_u_tarif_tanpa_makan_mess").innerHTML = "";
            }

            if (u_tarif_dengan_makan_mess == "") {
                document.getElementById("err_u_tarif_dengan_makan_mess").innerHTML = "Tarif Dengan Makan Mess Harus Diisi";
            } else {
                document.getElementById("err_u_tarif_dengan_makan_mess").innerHTML = "";
            }

            if (u_kapasitas_total_mess == "") {
                document.getElementById("err_u_kapasitas_total_mess").innerHTML = "Kapasitas Total Mess Harus Diisi";
            } else {
                document.getElementById("err_u_kapasitas_total_mess").innerHTML = "";
            }

            if (u_alamat_mess == "") {
                document.getElementById("err_u_alamat_mess").innerHTML = "Alamat Mess Harus Diisi";
            } else {
                document.getElementById("err_u_alamat_mess").innerHTML = "";
            }

            if (u_fasilitas_mess == "") {
                document.getElementById("err_u_fasilitas_mess").innerHTML = "Fasilitas Mess Harus Diisi";
            } else {
                document.getElementById("err_u_fasilitas_mess").innerHTML = "";
            }

            if (u_status_mess == "") {
                document.getElementById("err_u_status_mess").innerHTML = "Status Mess Harus Dipilih";
            } else {
                document.getElementById("err_u_status_mess").innerHTML = "";
            }
        }

        if (
            u_nama_mess != "" &&
            u_nama_pemilik_mess != "" &&
            u_telp_pemilik_mess != "" &&
            u_kepemilikan_mess != "" &&
            u_tarif_tanpa_makan_mess != "" &&
            u_tarif_dengan_makan_mess != "" &&
            u_kapasitas_total_mess != "" &&
            u_alamat_mess != "" &&
            u_fasilitas_mess != ""
        ) {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_mess_u.php",
                data: data,
                success: function() {
                    Swal.fire({
                        allowOutsideClick: false,
                        // isDismissed: false,
                        icon: 'success',
                        title: '<span class"text-xs"><b>Data Mess</b><br>Berhasil Dirubah',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    $('#data_mess').load("_admin/view/v_messData.php");

                    $('#err_u_nama_mess').empty();
                    $('#err_u_nama_pemilik_mess').empty();
                    $('#err_u_telp_pemilik_mess').empty();
                    $('#err_u_kepemilikan_mess').empty();
                    $('#err_u_tarif_tanpa_makan_mess').empty();
                    $('#err_u_tarif_dengan_makan_mess').empty();
                    $('#err_u_kapsitas_total_mess').empty();
                    $('#err_u_alamat_mess').empty();
                    $('#err_u_fasilitas_mess').empty();
                    $('#err_u_status_mess').empty();

                    $('#form_ubah_mess').trigger("reset");
                    $('#u_kepemilikan_mess').val('').trigger("change");
                    $('#u_status_mess').val('').trigger("change");

                    $("#data_ubah_mess").fadeOut(1);
                },
                error: function(response) {
                    console.log(response.responseText);
                }
            });
        }
    });

    $(document).on('click', '.hapus', function() {
        console.log("hapus");
        Swal.fire({
            position: 'top',
            title: 'Hapus Data Mess ?',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Kembali',
            confirmButtonText: 'Ya',
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_mess_h.php",
                    data: {
                        "h_id_mess": $(this).attr('id')
                    },
                    success: function() {
                        $('#data_mess').load("_admin/view/v_messData.php");

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
                            icon: 'success',
                            title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Dihapus</b></div>'
                        });
                    },
                    error: function(response) {
                        console.log(response.responseText);
                        alert('eksekusi query gagal');
                    }
                });
            }
        });
    });
</script>
<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/tanggal_waktu.php";
?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <?php
            $sql_pembimbing = "SELECT * FROM tb_pembimbing";
            $sql_pembimbing .= " JOIN tb_pembimbing_jenis ON tb_pembimbing.id_pembimbing_jenis = tb_pembimbing_jenis.id_pembimbing_jenis ";
            $sql_pembimbing .= " JOIN tb_jenjang_pdd ON tb_pembimbing.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
            $sql_pembimbing .= " ORDER BY nama_pembimbing ASC";

            try {
                $q_pembimbing = $conn->query($sql_pembimbing);
                $r_pembimbing = $q_pembimbing->rowCount();
            } catch (Exception $ex) {
                echo "<script>alert('$ex -DATA PKD-');";
                echo "document.location.href='?error404';</script>";
            }

            if ($r_pembimbing > 0) {
            ?>
                <div class="table-responsive text-xs">
                    <table class="table table-striped" id="dataTable">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope='col'>No</th>
                                <th>NIP/NIPK</th>
                                <th>Nama Pembimbing</th>
                                <th>Jenis Pembimbing</th>
                                <th>Jenjang <br>Pendidikan</th>
                                <th>Kali <br>Membimbing</th>
                                <th>
                                    Action
                                    <hr class="p-0 m-0 bg-gray-100">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="my-auto">
                            <?php
                            $no = 1;
                            while ($d_pembimbing = $q_pembimbing->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $d_pembimbing['no_id_pembimbing']; ?></td>
                                    <td><?= $d_pembimbing['nama_pembimbing']; ?></td>
                                    <td><?= $d_pembimbing['nama_pembimbing_jenis'] . " (" . $d_pembimbing['akronim_pembimbing_jenis'] . ")"; ?></td>
                                    <td><?= $d_pembimbing['nama_jenjang_pdd']; ?></td>
                                    <td class="text-center">
                                        <?php

                                        $sql_kali = "SELECT * FROM tb_pembimbing_pilih ";
                                        $sql_kali .= " WHERE id_pembimbing = " . $d_pembimbing['id_pembimbing'];
                                        $sql_kali .= " GROUP BY id_praktik";
                                        try {
                                            $q_kali = $conn->query($sql_kali);
                                            echo $q_kali->rowCount();
                                        } catch (Exception $ex) {
                                            echo "<script>alert('$ex -KALI PEMBIMBING-');";
                                            echo "document.location.href='?error404';</script>";
                                        }
                                        ?>
                                        <br>
                                        <a href="?d_pmbb=<?= bin2hex(urlencode(base64_encode($d_pembimbing['id_pembimbing']))) ?>&detail" class="btn btn-outline-info btn-xs">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    <td class="text-center text-md">
                                        <a title="Ubah" class='btn btn-primary btn-xs ubah_init' id='<?= $d_pembimbing['id_pembimbing']; ?>'>
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a title="Hapus" class='btn btn-outline-danger btn-xs hapus' id='<?= $d_pembimbing['id_pembimbing']; ?>'>
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <hr class="m-1 bg-gray-500">
                                        <?php
                                        if ($d_pembimbing['status_pembimbing'] == 'Y') {
                                        ?>
                                            <span class="badge badge-success">Aktif</span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge badge-danger">Non-aktif</span>
                                        <?php
                                        }
                                        ?>

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
                <h3> Data Pembimbing Tidak Ada</h3>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $(".ubah_init").click(function() {
        // console.log("ubah_init");
        $('#err_u_nama_pembimbing').empty();
        $('#err_u_nipnipk_pembimbing').empty();
        $('#err_u_jenis_pembimbing').empty();
        $('#err_u_jenjang_pembimbing').empty();
        $('#err_u_kali_pembimbing').empty();
        $('#err_u_status_pembimbing').empty();

        $('#form_ubah_pembimbing').trigger("reset");
        $('#u_jenis_pembimbing').val('').trigger("change");
        $('#u_jenjang_pembimbing').val('').trigger("change");
        $('#u_status_pembimbing').val('').trigger("change");
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "_admin/view/v_daftarPembimbingGetData.php",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                $('#u_id_pembimbing').val(response.id_pembimbing);
                $('#u_nama_pembimbing').val(response.nama_pembimbing);
                $('#u_nipnipk_pembimbing').val(response.no_id_pembimbing);
                $('#u_jenis_pembimbing').val(response.id_pembimbing_jenis).trigger('change');
                $('#u_jenjang_pembimbing').val(response.id_jenjang_pdd).trigger('change');
                $('#u_kali_pembimbing').val(response.kali_pembimbing);
                $('#u_status_pembimbing').val(response.status_pembimbing).trigger('change');
                // console.log('' + response.u_id_pembimbing);
            },
            error: function(response) {
                alert(response.responseText);
                console.log(response.responseText);
            }
        });

        $("#data_tambah_pembimbing").fadeOut(1);
        $("#data_ubah_pembimbing").fadeIn(1);
        $('#u_nama_pembimbing').focus();
    });

    $(".ubah_tutup").click(function() {
        $('#err_u_nama_pembimbing').empty();
        $('#err_u_nipnipk_pembimbing').empty();
        $('#err_u_jenis_pembimbing').empty();
        $('#err_u_jenjang_pembimbing').empty();
        $('#err_u_kali_pembimbing').empty();
        $('#err_u_status_pembimbing').empty();

        $('#form_ubah_pembimbing').trigger("reset");
        $('#u_jenis_pembimbing').val('').trigger("change");
        $('#u_jenjang_pembimbing').val('').trigger("change");

        $("#data_ubah_pembimbing").fadeOut(1);
    });

    $(document).on('click', '.ubah', function() {
        var data = $('#form_ubah_pembimbing').serialize();

        var u_id_pembimbing = $('#u_id_pembimbing').val();
        var u_nama_pembimbing = $('#u_nama_pembimbing').val();
        var u_nipnipk_pembimbing = $('#u_nipnipk_pembimbing').val();
        var u_jenis_pembimbing = $('#u_jenis_pembimbing').val();
        var u_jenjang_pembimbing = $('#u_jenjang_pembimbing').val();
        var u_kali_pembimbing = $('#u_kali_pembimbing').val();
        var u_status_pembimbing = $('#u_status_pembimbing').val();
        // console.log("id : " + u_id_pembimbing);

        //cek data from tambah bila tidak diiisi
        if (
            u_id_pembimbing == "" ||
            u_nama_pembimbing == "" ||
            u_nipnipk_pembimbing == "" ||
            u_jenis_pembimbing == "" ||
            u_jenjang_pembimbing == "" ||
            u_kali_pembimbing == "" ||
            u_status_pembimbing == ""
        ) {
            if (u_nama_pembimbing == "") {
                document.getElementById("err_u_nama_pembimbing").innerHTML = "Nama Pembimbing Harus Diisi";
            } else {
                document.getElementById("err_u_nama_pembimbing").innerHTML = "";
            }

            if (u_nipnipk_pembimbing == "") {
                document.getElementById("err_u_nipnipk_pembimbing").innerHTML = "NIP/NIPK Harus Diisi";
            } else {
                document.getElementById("err_u_nipnipk_pembimbing").innerHTML = "";
            }

            if (u_jenis_pembimbing == "") {
                document.getElementById("err_u_jenis_pembimbing").innerHTML = "Jenis Pembimbing Harus Dipilih";
            } else {
                document.getElementById("err_u_jenis_pembimbing").innerHTML = "";
            }

            if (u_jenjang_pembimbing == "") {
                document.getElementById("err_u_jenjang_pembimbing").innerHTML = "Jenjang Pembimbing Harus Dipilih";
            } else {
                document.getElementById("err_u_jenjang_pembimbing").innerHTML = "";
            }

            if (u_kali_pembimbing == "") {
                document.getElementById("err_u_kali_pembimbing").innerHTML = "Kali Membimbing Harus Diisi";
            } else {
                document.getElementById("err_u_kali_pembimbing").innerHTML = "";
            }

            if (u_status_pembimbing == "") {
                document.getElementById("err_u_status_pembimbing").innerHTML = "Status Harus Dipilih";
            } else {
                document.getElementById("err_u_status_pembimbing").innerHTML = "";
            }
        }

        if (
            u_id_pembimbing != "" &&
            u_nama_pembimbing != "" &&
            u_nipnipk_pembimbing != "" &&
            u_jenis_pembimbing != "" &&
            u_jenjang_pembimbing != "" &&
            u_kali_pembimbing != "" &&
            u_status_pembimbing != ""
        ) {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_daftarPembimbing_u.php",
                data: data,
                success: function(response) {
                    Swal.fire({
                        allowOutsideClick: false,
                        // isDismissed: false,
                        icon: 'success',
                        title: '<span class"text-xs"><b>Data Pembimbing</b><br>Berhasil Dirubah',
                        showConfirmButton: false,
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    $('#data_daftarPembimbing').load("_admin/view/v_daftarPembimbingData.php");

                    $('#err_u_nama_pembimbing').empty();
                    $('#err_u_nipnipk_pembimbing').empty();
                    $('#err_u_jenis_pembimbing').empty();
                    $('#err_u_jenjang_pembimbing').empty();
                    $('#err_u_kali_pembimbing').empty();
                    $('#err_u_status_pembimbing').empty();

                    $('#form_ubah_pembimbing').trigger("reset");
                    $('#u_jenis_pembimbing').val('').trigger("change");
                    $('#u_jenjang_pembimbing').val('').trigger("change");

                    $("#data_ubah_pembimbing").fadeOut(1);
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
            title: 'Hapus Data Pembimbing ?',
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
                    url: "_admin/exc/x_v_daftarPembimbing_h.php",
                    data: {
                        "h_id_pembimbing": $(this).attr('id')
                    },
                    success: function() {
                        $('#data_daftarPembimbing').load("_admin/view/v_daftarPembimbingData.php");

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
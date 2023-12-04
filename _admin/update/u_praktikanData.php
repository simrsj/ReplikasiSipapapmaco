<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";

$sql_praktikan = "SELECT * FROM tb_praktikan ";
$sql_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
$sql_praktikan .= " WHERE tb_praktik.id_praktik = " . $_GET['u'];
$sql_praktikan .= " ORDER BY tb_praktikan.nama_praktikan ASC";
// echo $sql_praktikan;

$q_data_praktikan = $conn->query($sql_praktikan);
$r_data_praktikan = $q_data_praktikan->rowCount();

if ($r_data_praktikan > 0) {
?>
    <div class="table-responsive text-xs">
        <table class="table table-striped" id="dataTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM / NPM / NIS </th>
                    <th scope="col">No. HP</th>
                    <th scope="col">No. WA</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">ASAL KOTA / KABUPATEN</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_jumlah_tarif = 0;
                $no = 1;
                while ($d_data_praktikan = $q_data_praktikan->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $d_data_praktikan['nama_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['no_id_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['telp_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['wa_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['email_praktikan']; ?></td>
                        <td><?= $d_data_praktikan['kota_kab_praktikan']; ?></td>
                        <td>
                            <?php
                            if ($d_data_praktikan['status_praktikan'] == 'y') {
                            ?>
                                <span class="badge badge-success">Aktif</span>
                            <?php
                            } elseif ($d_data_praktikan['status_praktikan'] == 't') {
                            ?>
                                <span class="badge badge-danger">Non-Aktif</span>
                            <?php

                            } else {
                            ?>
                                <span class="badge badge-danger blink">ERROR!</span>
                            <?php
                            }
                            ?>
                        </td>
                        <td>
                            <button id="<?= $d_data_praktikan['id_praktikan']; ?>" class="btn btn-primary btn-sm ubah_init" title="UBAH"> <i class="fa fa-edit"></i> </button>
                            <button id="<?= $d_data_praktikan['id_praktikan']; ?>" class="btn btn-danger btn-sm hapus" title="HAPUS"> <i class="fa fa-trash"></i> </button>
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
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $(".ubah_init").click(function() {
        document.getElementById("err_nama").innerHTML = "";
        document.getElementById("err_no_id").innerHTML = "";
        document.getElementById("err_no_hp").innerHTML = "";
        document.getElementById("err_no_wa").innerHTML = "";
        document.getElementById("err_email").innerHTML = "";
        document.getElementById("err_asal").innerHTML = "";
        document.getElementById("form_ubah_praktikan").reset();
        $("#data_ubah_praktikan").fadeIn('slow');
        $("#data_tambah_praktikan").fadeOut('fast');

        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "_admin/update/u_praktikanGetData.php",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {

                document.getElementById("form_ubah_praktikan").reset();

                document.getElementById("id_praktikan").value = response.id_praktikan;
                document.getElementById("nama_praktikan").value = response.nama_praktikan;
                document.getElementById("no_id_praktikan").value = response.no_id_praktikan;
                document.getElementById("telp_praktikan").value = response.telp_praktikan;
                document.getElementById("wa_praktikan").value = response.wa_praktikan;
                document.getElementById("email_praktikan").value = response.email_praktikan;
                document.getElementById("kota_kab_praktikan").value = response.kota_kab_praktikan;
            },
            error: function(response) {
                alert(response.responseText);
                console.log(response.responseText);
            }
        });

        $("#data_tambah_test").fadeOut('slow');
    });

    $(".ubah_tutup").click(function() {
        document.getElementById("err_nama").innerHTML = "";
        document.getElementById("err_no_id").innerHTML = "";
        document.getElementById("err_no_hp").innerHTML = "";
        document.getElementById("err_no_wa").innerHTML = "";
        document.getElementById("err_email").innerHTML = "";
        document.getElementById("err_asal").innerHTML = "";
        document.getElementById("form_ubah_praktikan").reset();
        $("#data_ubah_praktikan").fadeOut('slow');
    });

    $(document).on('click', '.ubah', function() {
        var data = $('#form_ubah_praktikan').serialize();
        var nama_praktikan = document.getElementById("nama_praktikan").value;
        var no_id_praktikan = document.getElementById("no_id_praktikan").value;
        var telp_praktikan = document.getElementById("telp_praktikan").value;
        var wa_praktikan = document.getElementById("wa_praktikan").value;
        var email_praktikan = document.getElementById("email_praktikan").value;
        var kota_kab_praktikan = document.getElementById("kota_kab_praktikan").value;

        //cek data from ubah bila tidak diiisi
        if (
            nama_praktikan == "" ||
            no_id_praktikan == "" ||
            telp_praktikan == "" ||
            wa_praktikan == "" ||
            email_praktikan == "" ||
            kota_kab_praktikan == ""
        ) {
            if (nama_praktikan == "") {
                document.getElementById("err_nama").innerHTML = "Nama Harus Diisi";
            } else {
                document.getElementById("err_nama").innerHTML = "";
            }

            if (no_id_praktikan == "") {
                document.getElementById("err_no_id").innerHTML = "NIM / NPM / NIS Harus Diisi";
            } else {
                document.getElementById("err_no_id").innerHTML = "";
            }

            if (telp_praktikan == "") {
                document.getElementById("err_no_hp").innerHTML = "No. Telp Harus Diisi";
            } else {
                document.getElementById("err_no_hp").innerHTML = "";
            }

            if (wa_praktikan == "") {
                document.getElementById("err_no_wa").innerHTML = "No. WA Harus Diisi";
            } else {
                document.getElementById("err_no_wa").innerHTML = "";
            }

            if (email_praktikan == "") {
                document.getElementById("err_email").innerHTML = "Email Harus Diisi";
            } else {
                document.getElementById("err_email").innerHTML = "";
            }

            if (kota_kab_praktikan == "") {
                document.getElementById("err_asal").innerHTML = "Kota/Kabupaten Harus Diisi";
            } else {
                document.getElementById("err_asal").innerHTML = "";
            }

        } else {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_u_praktikan_u.php",
                data: data,
                success: function() {
                    $('#data_praktikan').load('_admin/update/u_praktikanData.php?u=<?= $_GET['u']; ?>');

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
                        title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Diubah</b></div>'
                    });
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
            title: 'Non-Aktifkan Data Praktikan?',
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
                    url: "_admin/exc/x_u_praktikan_h.php",
                    data: {
                        "id_praktikan": $(this).attr('id')
                    },
                    success: function() {
                        $('#data_praktikan').load('_admin/update/u_praktikanData.php?u=<?= $_GET['u']; ?>');

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
                            title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil Dinonaktifkan</b></div>'
                        });
                    },
                    error: function(response) {
                        console.log(response.responseText);
                        alert('eksekusi query gagal');
                    }
                });
            }
        })
    });
</script>
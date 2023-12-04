<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
$sql_prvl = "SELECT * FROM tb_user_privileges WHERE id_user = " . base64_decode(urldecode($_GET['idu']));
// echo $sql_prvl;
try {
    $q_prvl = $conn->query($sql_prvl);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA PRIVILEGES-');";
    echo "document.location.href='?error404';</script>";
}
$d_prvl = $q_prvl->fetch(PDO::FETCH_ASSOC);

$sql_kuota = "SELECT * FROM tb_kuota ORDER BY tb_kuota.nama_kuota ASC";
// echo $sql_kuota;
try {
    $q_data_kuota = $conn->query($sql_kuota);
} catch (Exception $ex) {
    echo "<script>alert('$ex -DATA KUOTA-');";
    echo "document.location.href='?error404';</script>";
}
$r_data_kuota = $q_data_kuota->rowCount();

if ($r_data_kuota > 0) {
?>
    <div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Kuota</th>
                    <th scope="col">Jumlah Kuota </th>
                    <th scope="col">Keterangan </th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_jumlah_tarif = 0;
                $no = 1;
                while ($d_data_kuota = $q_data_kuota->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no; ?></th>
                        <td><?= $d_data_kuota['nama_kuota']; ?></td>
                        <td><?= $d_data_kuota['jumlah_kuota']; ?></td>
                        <td><?= $d_data_kuota['ket_kuota']; ?></td>
                        <td class="text-center">
                            <?php if ($d_prvl['u_kuota'] == "Y") { ?>
                                <button id="<?= $d_data_kuota['id_kuota']; ?>" class="btn btn-primary btn-sm ubah_init" title="UBAH" href="#page-top">
                                    <i class="fa fa-edit"></i> Ubah
                                </button>
                            <?php } ?>
                            <!-- <?php if ($d_prvl['d_kuota'] == "Y") { ?>
                                <button id="<?= $d_data_kuota['id_kuota']; ?>" class="btn btn-danger btn-sm hapus" title="HAPUS">
                                    <i class="fa fa-trash"></i> Hapus
                                </button>
                            <?php } ?> -->
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

    <?php if ($d_prvl['u_kuota'] == "Y") { ?>
        $(".ubah_init").click(function() {
            document.getElementById("err_u_nama").innerHTML = "";
            document.getElementById("err_u_jumlah").innerHTML = "";
            document.getElementById("form_ubah_kuota").reset();
            $("#data_ubah_kuota").fadeIn('slow');
            $("#data_tambah_kuota").fadeOut('fast');

            var id = $(this).attr('id');
            $.ajax({
                type: 'POST',
                url: "_admin/view/v_kuotaGetData.php",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {

                    document.getElementById("form_ubah_kuota").reset();

                    document.getElementById("u_id_kuota").value = response.id_kuota;
                    document.getElementById("u_nama_kuota").value = response.nama_kuota;
                    document.getElementById("u_jumlah_kuota").value = response.jumlah_kuota;
                    document.getElementById("u_ket_kuota").value = response.ket_kuota;
                },
                error: function(response) {
                    alert(response.responseText);
                    console.log(response.responseText);
                }
            });

            $("#data_tambah_test").fadeOut('slow');

            $("#u_nama_kuota").focus();
        });

        $(".ubah_tutup").click(function() {
            document.getElementById("err_u_nama").innerHTML = "";
            document.getElementById("err_u_jumlah").innerHTML = "";
            document.getElementById("form_ubah_kuota").reset();
            $("#data_ubah_kuota").fadeOut('slow');
        });

        $(document).on('click', '.ubah', function() {
            var data = $('#form_ubah_kuota').serialize();
            var nama_kuota = document.getElementById("u_nama_kuota").value;
            var jumlah_kuota = document.getElementById("u_jumlah_kuota").value;
            var ket_kuota = document.getElementById("u_ket_kuota").value;

            //cek data from ubah bila tidak diiisi
            if (
                nama_kuota == "" ||
                jumlah_kuota == ""
            ) {
                if (nama_kuota == "") {
                    document.getElementById("err_u_nama").innerHTML = "Nama Harus Diisi";
                } else {
                    document.getElementById("err_u_nama").innerHTML = "";
                }

                if (jumlah_kuota == "") {
                    document.getElementById("err_u_jumlah").innerHTML = "Kuota Harus Diisi";
                } else {
                    document.getElementById("err_u_jumlah").innerHTML = "";
                }

            } else {
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_kuota_u.php",
                    data: data,
                    success: function() {
                        $('#data_kuota').load('_admin/view/v_kuotaData.php?idu=<?= $_GET['idu'] ?>');

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
    <?php } ?>

    <?php if ($d_prvl['d_kuota'] == "Y") { ?>
        $(document).on('click', '.hapus', function() {
            console.log("hapus");
            Swal.fire({
                position: 'top',
                title: 'Hapus Data Praktikan?',
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
                        url: "_admin/exc/x_v_kuota_h.php",
                        data: {
                            "id_kuota": $(this).attr('id')
                        },
                        success: function() {
                            $('#data_kuota').load('_admin/view/v_kuotaData.php?idu=<?= $_GET['idu'] ?>');

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
                                title: '<div class="text-center font-weight-bold text-uppercase">Data Berhasil DIHAPUS</b></div>'
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
    <?php } ?>
</script>
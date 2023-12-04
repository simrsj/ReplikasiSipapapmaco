<?php
include $_SERVER['DOCUMENT_ROOT'] . "/SM/_add-ons/koneksi.php";
?>
<div class="card shadow mb-4">
    <div class="card-body">
        <?php
        $sql = "SELECT * FROM tb_tempat ";
        $sql .= " JOIN tb_jurusan_pdd_jenis ON tb_tempat.id_jurusan_pdd_jenis = tb_jurusan_pdd_jenis.id_jurusan_pdd_jenis";
        $sql .= " JOIN tb_tarif_satuan ON tb_tempat.id_tarif_satuan = tb_tarif_satuan.id_tarif_satuan";
        // $sql .= " WHERE status_tempat = 'Y'";
        $sql .= " ORDER BY nama_tempat ASC";
        $q = $conn->query($sql);
        if ($q->rowCount() > 0) {
        ?>
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope='col'>No</th>
                            <th>Nama Tempat</th>
                            <th>Jenis Jurusan</th>
                            <th>Kapasitas</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Keterangan</th>
                            <th>
                                Tombol
                                <hr class="p-0 m-0 bg-gray-100">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($d = $q->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $d['nama_tempat']; ?></td>
                                <td class="text-center"><?= $d['nama_jurusan_pdd_jenis']; ?></td>
                                <td class="text-center"><?= $d['kapasitas_tempat']; ?></td>
                                <td><?= $d['nama_tarif_satuan']; ?></td>
                                <td><?= "Rp " . number_format($d['tarif_tempat'], 0, '.', '.'); ?></td>
                                <td class="text-center"><?= $d['ket_tempat']; ?></td>
                                <td class="text-center">
                                    <button title="Ubah" class='btn btn-primary btn-sm ubah_init' id="<?= $d['id_tempat']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button title="Hapus" class='btn btn-danger btn-sm hapus' id="<?= $d['id_tempat']; ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <br>
                                    <?php
                                    if ($d['status_tempat'] == 'Y') {
                                    ?>
                                        <div class="badge badge-success">Aktif</div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="badge badge-danger">Tidak Aktif</div>
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
            <h3 class="text-center"> Data Tempat Tidak Ada</h3>
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
        document.getElementById("err_u_nama_tempat").innerHTML = "";
        document.getElementById("err_u_kapasitas_tempat").innerHTML = "";
        document.getElementById("err_u_tarif_tempat").innerHTML = "";
        document.getElementById("err_u_tarif_satuan").innerHTML = "";
        document.getElementById("err_u_jenis_jurusan").innerHTML = "";
        document.getElementById("form_ubah_tempat").reset();
        $("#data_ubah_tempat").fadeIn(1);
        $("#data_tambah_tempat").fadeOut(1);

        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "_admin/view/v_tempatGetData.php",
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {

                document.getElementById("form_ubah_tempat").reset();
                // $("#form_ubah_tempat").empty();

                document.getElementById("u_id_tempat").value = response.u_id_tempat;
                // document.getElementById("u_id_tarif_jenis").value = response.u_id_tarif_jenis;
                document.getElementById("u_nama_tempat").value = response.u_nama_tempat;
                document.getElementById("u_kapasitas_tempat").value = response.u_kapasitas_tempat;
                // document.getElementById("u_jenis_jurusan").value = response.u_id_jurusan_pdd_jenis;
                $('#u_jenis_jurusan').val(response.u_id_jurusan_pdd_jenis).trigger('change');
                document.getElementById("u_tarif_tempat").value = response.u_tarif_tempat;
                // document.getElementById("u_tarif_satuan").value = response.u_id_tarif_satuan;
                $('#u_tarif_satuan').val(response.u_id_tarif_satuan).trigger('change');


                document.getElementById("u_ket_tempat").value = response.u_ket_tempat;
                // document.getElementById("u_status_tempat").value = response.u_status_tempat;
                $('#u_status_tempat').val(response.u_status_tempat).trigger('change');
            },
            error: function(response) {
                alert(response.responseText);
                console.log(response.responseText);
            }
        });

        $("#data_tambah_tempat").fadeOut(1);
        $('#u_nama_tempat').focus();
    });

    $(".ubah_tutup").click(function() {
        document.getElementById("err_u_nama_tempat").innerHTML = "";
        document.getElementById("err_u_kapasitas_tempat").innerHTML = "";
        document.getElementById("err_u_tarif_tempat").innerHTML = "";
        document.getElementById("err_u_tarif_satuan").innerHTML = "";
        document.getElementById("err_u_jenis_jurusan").innerHTML = "";
        document.getElementById("form_ubah_tempat").reset();
        $("#data_ubah_tempat").fadeOut(1);
    });

    $(document).on('click', '.ubah', function() {
        var data = $('#form_ubah_tempat').serialize();

        var u_nama_tempat = $('#u_nama_tempat').val();
        var u_kapasitas_tempat = $('#u_kapasitas_tempat').val();
        var u_tarif_tempat = $('#u_tarif_tempat').val();
        var u_tarif_satuan = $('#u_tarif_satuan').val();
        var u_jenis_jurusan = $('#u_jenis_jurusan').val();
        var u_ket_tempat = $('#u_ket_tempat').val();
        var u_status_tempat = $('#u_status_tempat').val();

        //cek data from ubah bila tidak diiisi

        if (
            u_nama_tempat == "" ||
            u_kapasitas_tempat == "" ||
            u_tarif_tempat == "" ||
            u_tarif_satuan == "" ||
            u_jenis_jurusan == "" ||
            u_ket_tempat == "" ||
            u_status_tempat == ""
        ) {
            if (u_nama_tempat == "") {
                document.getElementById("err_u_nama_tempat").innerHTML = "Nama Harus Diisi";
            } else {
                document.getElementById("err_u_nama_tempat").innerHTML = "";
            }

            if (u_kapasitas_tempat == "") {
                document.getElementById("err_u_kapasitas_tempat").innerHTML = "Kapasitas Harus Diisi";
            } else {
                document.getElementById("err_u_kapasitas_tempat").innerHTML = "";
            }

            if (u_tarif_tempat == "") {
                document.getElementById("err_u_tarif_tempat").innerHTML = "Tarif Harus Diisi";
            } else {
                document.getElementById("err_u_tarif_tempat").innerHTML = "";
            }

            if (u_tarif_satuan == "") {
                document.getElementById("err_u_tarif_satuan").innerHTML = "Satuan Harus Dipilih";
            } else {
                document.getElementById("err_u_tarif_satuan").innerHTML = "";
            }

            if (u_jenis_jurusan == "") {
                document.getElementById("err_u_jenis_jurusan").innerHTML = "Jenis jurusan Harus Dipilih";
            } else {
                document.getElementById("err_u_jenis_jurusan").innerHTML = "";
            }

            if (u_status_tempat == "") {
                document.getElementById("err_u_status_tempat").innerHTML = "Status Harus Dipilih";
            } else {
                document.getElementById("err_u_status_tempat").innerHTML = "";
            }
        } else {
            $.ajax({
                type: 'POST',
                url: "_admin/exc/x_v_tempat_u.php",
                data: data,
                success: function() {
                    $('#data_tempat').load('_admin/view/v_tempatData.php?');

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
            title: 'Hapus Data Tempat ?',
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
                    url: "_admin/exc/x_v_tempat_h.php",
                    data: {
                        "id_tempat": $(this).attr('id')
                    },
                    success: function() {
                        $('#data_tempat').load('_admin/view/v_tempatData.php?');

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
</script>
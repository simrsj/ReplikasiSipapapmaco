<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10">
            <h1 class="h3 mb-2 text-gray-800">Daftar Validasi Profil Institusi</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive text-xs">
                <?php
                $sql_institusi = "SELECT * FROM tb_institusi ";
                $sql_institusi .= "WHERE tempStatus_institusi IN ('pengajuan')";
                $sql_institusi .= "ORDER BY nama_institusi ASC";
                $q_institusi = $conn->query($sql_institusi);
                $r_institusi = $q_institusi->rowCount();
                if ($r_institusi > 0) {
                ?>
                    <table class='table table-striped' id="dataTable">
                        <thead class="thead-dark text-center align-content-center">
                            <tr>
                                <th scope='col'>No</th>
                                <th>Nama Institusi</th>
                                <th>Akronim </th>
                                <th>Logo </th>
                                <th>Alamat </th>
                                <th>Akreditasi </th>
                                <th>Tanggal <br>Berlaku Akreditasi</th>
                                <th>File Akreditasi</th>
                                <th>Terima/Tolak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($d_institusi = $q_institusi->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $d_institusi['nama_institusi']; ?></td>
                                    <td>
                                        <?php
                                        if ($d_institusi['tempAkronim_institusi'] == '') {
                                        ?>
                                            <span class="badge badge-danger">Tidak Ada</span>
                                        <?php
                                        } else {
                                            echo $d_institusi['tempAkronim_institusi'];
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a title="Lihat Logo" class='btn btn-info btn-xs' href='#' data-toggle='modal' data-target='<?= "#see_" . $d_institusi['id_institusi']; ?>'>
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>

                                        <!-- Lihat Logo  -->
                                        <div class="modal fade" id="<?= "see_" . $d_institusi['id_institusi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <img src="<?= $d_institusi['tempLogo_institusi']; ?>" width="250px" height="250px">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        echo $d_institusi['tempAlamat_institusi'];
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        echo $d_institusi['tempAkred_institusi'];
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        echo tanggal($d_institusi['tempTglAkhirAkred_institusi']);
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= $d_institusi['tempFileAkred_institusi']; ?>" class="btn btn-success btn-xs">
                                            <i class="fas fa-file-download"></i> Download
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-xs terima" id="<?= $d_institusi['id_institusi']; ?>">
                                            <i class="far fa-check-circle"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs tolak" id="<?= $d_institusi['id_institusi']; ?>">
                                            <i class="far fa-times-circle"></i>
                                        </button>
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
            <h3 class="text-center text-justify"> Data Institusi Tidak Ada</h3>
        <?php
                }
        ?>
        </div>
    </div>
</div>
<script>
    $(".terima").click(function() {

        var id = $(this).attr('id');
        // console.log("terima profil");
        Swal.fire({
            position: 'top',
            title: 'Yakin ?',
            html: "<span class='text-success text-uppercase font-weight-bold'>Penerimaan</span> Data Pengajuan Profil Institusi",
            icon: 'warning',
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
                    url: "_admin/exc/x_v_institusi_val.php?",
                    data: {
                        'id': id,
                        'status': 'terima'
                    },
                    success: function() {
                        Swal.fire({
                            allowOutsideClick: false,
                            // isDismissed: false,
                            icon: 'success',
                            title: '<div class="text-md text-center">DATA PENGAJUAN PROFIL INSTITUSI <br> <b>DITERIMA</b></div>',
                            showConfirmButton: false,
                            timer: 500000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then(
                            function() {
                                document.location.href = "?ins&val";
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
    });

    $(".tolak").click(function() {

        var id = $(this).attr('id');
        // console.log("tolak profil");
        Swal.fire({
            position: 'top',
            title: 'Yakin ?',
            html: "<span class='text-danger text-uppercase font-weight-bold'>Penolakan</span> Data Pengajuan Profil Institusi" +
                '<textarea id="ketValTolakProfilIns" class="swal2-input" placeHolder="Isi Ket. Penolakan "></textarea>',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Kembali',
            confirmButtonText: 'Ya',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                var ketValTolakProfilIns = document.getElementById('ketValTolakProfilIns').value;
                $.ajax({
                    type: 'POST',
                    url: "_admin/exc/x_v_institusi_val.php?",
                    data: {
                        'id': id,
                        'status': 'tolak',
                        'ket': ketValTolakProfilIns
                    },
                    success: function() {
                        Swal.fire({
                            allowOutsideClick: false,
                            // isDismissed: false,
                            icon: 'error',
                            title: '<div class="text-md text-center">DATA PENGAJUAN PROFIL INSTITUSI <br> <b>DITOLAK</b></div>',
                            showConfirmButton: false,
                            timer: 500000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        }).then(
                            function() {
                                document.location.href = "?ins&val";
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
    });
</script>
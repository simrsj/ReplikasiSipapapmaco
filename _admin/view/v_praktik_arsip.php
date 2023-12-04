<?php if (isset($_GET['pars']) && $d_prvl['r_arsip_praktik'] == "Y" && $d_prvl['status_aktivasi_user'] == "Y") { ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="h3 mb-2 text-gray-800">Daftar Arsip Praktikan</h1>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <?php
                $sql_praktik_a = "SELECT * FROM tb_praktik  ";
                $sql_praktik_a .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                $sql_praktik_a .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
                $sql_praktik_a .= " JOIN tb_jenjang_pdd ON tb_praktik.id_jenjang_pdd = tb_jenjang_pdd.id_jenjang_pdd";
                $sql_praktik_a .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                // $sql_praktik_a .= " JOIN tb_akreditasi ON tb_praktik.id_akreditasi = tb_akreditasi.id_akreditasi ";
                $sql_praktik_a .= " WHERE tb_praktik.status_praktik = 'ARSIP'";
                $sql_praktik_a .= " ORDER BY tb_praktik.tgl_selesai_praktik ASC";

                $q_praktik_a = $conn->query($sql_praktik_a);
                $r_praktik_a = $q_praktik_a->rowCount();

                if ($r_praktik_a > 0) {
                ?>
                    <div class="table-responsive">
                        <table class="table table-striped " style="vertical-align: middle;" id="dataTable">
                            <thead class="thead-dark text-center ">
                                <tr>
                                    <th scope='col'>No</th>
                                    <th>Institusi</th>
                                    <th>Kelompok / Gelombang</th>
                                    <th>Jurusan</th>
                                    <th>Jenjang</th>
                                    <th>Profesi</th>
                                    <th>Tanggal <br>Mulai dan Selesai</th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($d_praktik_a = $q_praktik_a->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $d_praktik_a['nama_institusi']; ?></td>
                                        <td><?= $d_praktik_a['nama_praktik']; ?></td>
                                        <td><?= $d_praktik_a['nama_jurusan_pdd']; ?></td>
                                        <td><?= $d_praktik_a['nama_jenjang_pdd']; ?></td>
                                        <td><?= $d_praktik_a['nama_profesi_pdd']; ?></td>
                                        <td><?= tanggal_minimal($d_praktik_a['tgl_mulai_praktik']); ?> <br><?= tanggal_minimal($d_praktik_a['tgl_selesai_praktik']); ?></td>
                                        <td>
                                            <button type="button" id="<?= $d_praktik_a['id_praktik']; ?>" class="btn btn-outline-success btn-sm aktif">
                                                Aktifkan
                                            </button> &nbsp;
                                            <a href="?pars&dp=<?= $d_praktik_a['id_praktik'] ?>" class="btn btn-outline-primary btn-sm" title="Data Praktikan">
                                                <i class="fas fa-fw fa-users"></i>
                                            </a>
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
                    <h3 class='text-center'> Data Arsip Praktik Anda Tidak Ada</h3>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.aktif', function() {
            console.log("AKTIF");
            var id = $(this).attr('id');
            Swal.fire({
                position: 'top',
                html: "<span class='text-success text-uppercase font-weight-bold'>AKTIFKAN</span> Praktik Kembali ?",
                icon: 'question',
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
                        url: "_admin/exc/x_v_praktik_arsip_aktivasiPraktik.php?",
                        data: {
                            "id": id
                        },
                        success: function() {
                            Swal.fire({
                                allowOutsideClick: false,
                                // isDismissed: false,
                                icon: 'success',
                                title: '<div class="text-center">PRAKTIKAN KEMBALI AKTIF</div>',
                                showConfirmButton: false,
                                html: '<a href="?pars" class="btn btn-primary">OK</a>',
                                timer: 5000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            }).then(
                                function() {
                                    document.location.href = "?pars";
                                }
                            );
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
<?php } else {
    echo "<script>alert('unauthorized');document.location.href='?error401';</script>";
}

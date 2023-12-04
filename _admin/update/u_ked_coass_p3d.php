<div class="container-fluid">
    <?php
    $idpr = urldecode(decryptString($_GET['u'], $customkey));
    try {
        $sql_praktikan = "SELECT * FROM tb_praktikan ";
        $sql_praktikan .= " JOIN tb_praktik ON tb_praktikan.id_praktik = tb_praktik.id_praktik";
        $sql_praktikan .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
        $sql_praktikan .= " WHERE id_praktikan = " .  $idpr;
        // echo "$sql_praktikan<br>";
        $q_praktikan = $conn->query($sql_praktikan);
        $d_praktikan = $q_praktikan->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
        echo "<script>alert('DATA BIMBINGAN PRAKTIKAN')</script>;";
        echo "<script>document.location.href='?error404';</script>";
    }
    ?>
    <div class="card shadow  m-2">
        <div class="card-header b text-center">
            Data Praktikan
        </div>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-md">
                    <img height="100" height="80" src="<?= $d_praktikan['foto_praktikan'] ?>">
                </div>
                <div class="col-md">
                    Nama Praktikan : <br>
                    <strong><?= $d_praktikan['nama_praktikan'] ?></strong><br>
                    No. ID Praktikan : <br>
                    <strong><?= $d_praktikan['no_id_praktikan'] ?></strong>
                </div>
                <div class="col-md">
                    Nama Institusi : <br>
                    <strong> <?= $d_praktikan['nama_institusi'] ?> </strong><br>
                    Nama Kelompok/Gelombang/Praktik : <br>
                    <strong> <?= $d_praktikan['nama_praktik'] ?></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card shadow m-2 rounded-5">
                <div class="card-header b ">
                    Pencapaian Kompetensi Keterampilan (P3D)
                </div>
                <div class="card-body text-center">
                    <div class="table-responsive text-sm">
                        <form id="form_nilai" method="post">
                            <table class="table table-striped table-bordered ">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th scope='col'>No</th>
                                        <th>Pertanyaan</th>
                                        <th>I</th>
                                        <th>II</th>
                                        <th>III</th>
                                        <th>IV</th>
                                    </tr>
                                    <tr class="text-center bg-secondary">
                                        <th colspan="2 text-right" class="text-right">Pilih Semua-></th>
                                        <th class="text-center"><input type="checkbox" class="checkbox-md" id="i_all"></th>
                                        <th class="text-center"><input type="checkbox" class="checkbox-md" id="ii_all"></th>
                                        <th class="text-center"><input type="checkbox" class="checkbox-md" id="iii_all"></th>
                                        <th class="text-center"><input type="checkbox" class="checkbox-md" id="iv_all"></th>

                                        <script>
                                            function checkboxi() {
                                                var totalCheckbox = $('.checkboxi').length;
                                                var totalChecked = $('.checkboxi:checked').length;

                                                if (totalChecked == totalCheckbox) {
                                                    $("#i_all").prop("checked", true);
                                                } else {
                                                    $("#i_all").prop("checked", false);
                                                }
                                            }

                                            function checkboxii() {
                                                var totalCheckbox = $('.checkboxii').length;
                                                var totalChecked = $('.checkboxii:checked').length;

                                                if (totalChecked == totalCheckbox) {
                                                    $("#ii_all").prop("checked", true);
                                                } else {
                                                    $("#ii_all").prop("checked", false);
                                                }
                                            }

                                            function checkboxiii() {
                                                var totalCheckbox = $('.checkboxiii').length;
                                                var totalChecked = $('.checkboxiii:checked').length;

                                                if (totalChecked == totalCheckbox) {
                                                    $("#iii_all").prop("checked", true);
                                                } else {
                                                    $("#iii_all").prop("checked", false);
                                                }
                                            }

                                            function checkboxiv() {
                                                var totalCheckbox = $('.checkboxiv').length;
                                                var totalChecked = $('.checkboxiv:checked').length;

                                                if (totalChecked == totalCheckbox) {
                                                    $("#iv_all").prop("checked", true);
                                                } else {
                                                    $("#iv_all").prop("checked", false);
                                                }
                                            }
                                            $(document).ready(function() {
                                                $("#i_all").click(function() {
                                                    if ($(this).is(":checked")) {
                                                        $(".checkboxi").prop("checked", true);
                                                    } else {
                                                        $(".checkboxi").prop("checked", false);
                                                    }
                                                });
                                                $("#ii_all").click(function() {
                                                    if ($(this).is(":checked")) {
                                                        $(".checkboxii").prop("checked", true);
                                                    } else {
                                                        $(".checkboxii").prop("checked", false);
                                                    }
                                                });
                                                $("#iii_all").click(function() {
                                                    if ($(this).is(":checked")) {
                                                        $(".checkboxiii").prop("checked", true);
                                                    } else {
                                                        $(".checkboxiii").prop("checked", false);
                                                    }
                                                });
                                                $("#iv_all").click(function() {
                                                    if ($(this).is(":checked")) {
                                                        $(".checkboxiv").prop("checked", true);
                                                    } else {
                                                        $(".checkboxiv").prop("checked", false);
                                                    }
                                                });
                                            });
                                        </script>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    try {
                                        $sql_pertanyaan = "SELECT * FROM tb_pertanyaan ";
                                        $sql_pertanyaan .= " WHERE kategori_pertanyaan = 'P3D'";
                                        // echo "$sql_pertanyaan<br>";
                                        $q_pertanyaan = $conn->query($sql_pertanyaan);
                                    } catch (Exception $ex) {
                                        echo "<script>alert('DATA PRAKTIKAN');</script>";
                                        echo "<script>document.location.href='?error404';</script>";
                                    }
                                    $no = 1;
                                    ?>
                                    <?php while ($d_pertanyaan = $q_pertanyaan->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <tr>
                                            <td class="text-center"><?= $no; ?></td>
                                            <td><?= $d_pertanyaan['pertanyaan']; ?></td>
                                            <td>
                                                <input type="checkbox" class="checkbox-md checkboxi" id="i<?= $no ?>" name="i<?= $no ?>" onclick="checkboxi()" value="Y">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="checkbox-md checkboxii" id="ii<?= $no ?>" name="ii<?= $no ?>" onclick="checkboxii()" value="Y">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="checkbox-md checkboxiii" id="iii<?= $no ?>" name="iii<?= $no ?>" onclick="checkboxiii()" value="Y">
                                            </td>
                                            <td>
                                                <input type="checkbox" class="checkbox-md checkboxiv" id="iv<?= $no ?>" name="iv<?= $no ?>" onclick="checkboxiv()" value="Y">
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <a class="btn btn-success btn-sm col" href="#" data-toggle="modal" data-target="#modal_simpan">
                                SIMPAN
                            </a>
                            <!-- Logout Modal-->
                            <div class="modal" id="modal_simpan" tabindex="-1" role="dialog" aria-labelledby="modal_simpan" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <i class="fa-regular fa-circle-question fa-7x"></i><br>
                                            <div class="b text-lg">Yakin Simpan?</div>
                                            <div class="i blink text-danger mb-1">(data yang lama akan terhapus)</div>
                                            <a class="btn btn-success btn-sm simpan">Simpan</a>&nbsp;&nbsp;
                                            <button class="btn btn-danger btn-sm" type="button" data-dismiss="modal" aria-label="Close">
                                                Kembali
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script>
                            $(document).on('click', '.simpan', function() {
                                var data_form = $("#form_nilai").serializeArray();
                                data_form.push({
                                    name: "idpr",
                                    value: "<?= encryptString($d_praktikan['id_praktikan'], $customkey) ?>"
                                }, {
                                    name: "no",
                                    value: "<?= $q_pertanyaan->rowCount(); ?>"
                                });
                                $.ajax({
                                    type: 'POST',
                                    url: "_admin/exc/x_u_ked_coass_p3d.php",
                                    data: data_form,
                                    dataType: "JSON",
                                    success: function(response) {
                                        <?php
                                        if (isset($_GET['admin']))
                                            $link = "?logbook&data=" . $_GET['admin'];
                                        else
                                            $link = "?ked_coass_p3d";
                                        ?>
                                        if (response.ket == "ERROR") error();
                                        else simpan_berhasil("<?= $link ?>");
                                    },
                                    error: function(response) {
                                        console.log(response);
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
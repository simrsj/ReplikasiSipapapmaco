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
        ?>
            <script>
                alert("<?= $ex->getMessage() . $ex->getLine() ?>");
                document.location.href = '?error404';
            </script>";
        <?php
        }
        try {
            $sql_nilai = "SELECT * FROM tb_nilai_ked_coass ";
            $sql_nilai .= " WHERE id_praktikan = " .  $idpr;
            // echo "$sql_nilai<br>";
            $q_nilai = $conn->query($sql_nilai);
            $r_nilai = $q_nilai->rowCount();
            if ($r_nilai < 1) {
                $sql_nilai_tambah = "INSERT INTO tb_nilai_ked_coass (id_praktikan, tgl_tambah) VALUES (" . $idpr . ", '" . date('Y-m-d') . "')";
                $conn->query($sql_nilai_tambah);
            }
        } catch (Exception $ex) {
            echo "<script>alert('DATA PRAKTIKAN');</script>";
            echo "<script>document.location.href='?error404';</script>";
        }
        ?>
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow  m-2">
                    <div class="card-header b text-center">
                        Data Praktikan
                    </div>
                    <div class="card-body text-center">
                        <img height="100" height="80" src="<?= $d_praktikan['foto_praktikan'] ?>"><br>
                        Nama Praktikan : <br>
                        <strong><?= $d_praktikan['nama_praktikan'] ?></strong> <br>
                        No. ID Praktikan : <br>
                        <strong><?= $d_praktikan['no_id_praktikan'] ?></strong> <br>
                        Nama Institusi : <br>
                        <strong> <?= $d_praktikan['nama_institusi'] ?> </strong><br>
                        Nama Kelompok/Gelombang/Praktik : <br>
                        <strong> <?= $d_praktikan['nama_praktik'] ?></strong>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="card shadow m-2 rounded-5">
                    <div class="card-header b">
                        Data Nilai
                    </div>
                    <div class="card-body text-center">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th scope='col'>No</th>
                                        <th>Materi</th>
                                        <th width="100">Nilai<br>(0-100)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form id="form_nilai" method="post">
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>BST (BEDSIDE TEACHING)</td>
                                            <td>
                                                <input class="form-control" type="number" min="0" max="100" name="bst" id="bst" value="<?= $d_praktikan['bst'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_bst"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>CRS (CASE REPORT SESSION/TUTORIAL)</td>
                                            <td>
                                                <input class="form-control" type="number" min=0 max=100 name="crs" id="crs" value="<?= $d_praktikan['crs'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_crs"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>CSS (CLINICAL SCIENCE SESSION/REFERAT/JOURNAL READING)</td>
                                            <td>
                                                <input class="form-control" type="number" min=0 max=100 name="css" id="css" value="<?= $d_praktikan['css'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_css"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>MINI C-EX (MINI CLINICAL EXAMINATION)</td>
                                            <td>
                                                <input class="form-control" type="number" min=0 max=100 name="minicex" id="minicex" value="<?= $d_praktikan['minicex'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_minicex"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>RPS (RESOURCE PERSON SESION)</td>
                                            <td>
                                                <input class="form-control" type="number" min=0 max=100 name="rps" id="rps" value="<?= $d_praktikan['rps'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_rps"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td>OSLER (OBJECTIVE STRUKTURED LONG EXAMINATION STRUKTURED)</td>
                                            <td>
                                                <input class="form-control" type="number" min=0 max=100 name="osler" id="osler" value="<?= $d_praktikan['osler'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_osler"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td>DOPS (DIRECT OBSERVATION PROCEDURAL SKILLS)</td>
                                            <td>
                                                <input class="form-control" type="number" min=0 max=100 name="dops" id="dops" value="<?= $d_praktikan['dops'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_dops"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">8</td>
                                            <td>CBD (CASE BASED DISCUSSION)</td>
                                            <td>
                                                <input class="form-control" type="number" min=0 max=100 name="cbd" id="cbd" value="<?= $d_praktikan['cbd'] ?>">
                                                <div class="b blink i text-xs text-danger" id="err_cbd"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <a class="btn btn-success btn-sm col simpan">SIMPAN</a>
                                            </td>
                                        </tr>
                                    </form>
                                    <script>
                                        // inisiasi klik modal tambah simpan
                                        $(document).on('click', '.simpan', function() {
                                            var data_form = $("#form_nilai").serializeArray();
                                            var bst = $('#bst').val();
                                            var crs = $('#crs').val();
                                            var css = $('#css').val();
                                            var minicex = $('#minicex').val();
                                            var rps = $('#rps').val();
                                            var osler = $('#osler').val();
                                            var dops = $('#dops').val();
                                            var dops = $('#cbd').val();

                                            //cek data from modal tambah bila tidak diiisi
                                            if (
                                                bst == "" ||
                                                crs == "" ||
                                                css == "" ||
                                                minicex == "" ||
                                                rps == "" ||
                                                osler == "" ||
                                                dops == "" ||
                                                cbd == ""
                                            ) {
                                                simpan_tidaksesuai();
                                                bst == "" ? $("#err_bst").html("Isi Nilai") : $("#err_bst").html("");
                                                crs == "" ? $("#err_crs").html("Isi Nilai") : $("#err_crs").html("");
                                                css == "" ? $("#err_css").html("Isi Nilai") : $("#err_css").html("");
                                                minicex == "" ? $("#err_minicex").html("Isi Nilai") : $("#err_minicex").html("");
                                                rps == "" ? $("#err_rps").html("Isi Nilai") : $("#err_rps").html("");
                                                osler == "" ? $("#err_osler").html("Isi Nilai") : $("#err_osler").html("");
                                                dops == "" ? $("#err_dops").html("Isi Nilai") : $("#err_dops").html("");
                                                cbd == "" ? $("#err_cbd").html("Isi Nilai") : $("#err_cbd").html("");
                                            }
                                            //cek data from modal tambah bila range nilai tidak sesuai
                                            else if (
                                                (bst < 0 || bst > 100) ||
                                                (crs < 0 || crs > 100) ||
                                                (css < 0 || css > 100) ||
                                                (minicex < 0 || minicex > 100) ||
                                                (rps < 0 || rps > 100) ||
                                                (osler < 0 || osler > 100) ||
                                                (dops < 0 || dops > 100) ||
                                                (cbd < 0 || cbd > 100)
                                            ) {
                                                simpan_tidaksesuai();
                                                bst < 0 || bst > 100 ? $("#err_bst").html("Tidak Sesuai") : $("#err_bst").html("");
                                                crs < 0 || crs > 100 ? $("#err_crs").html("Tidak Sesuai") : $("#err_crs").html("");
                                                css < 0 || css > 100 ? $("#err_css").html("Tidak Sesuai") : $("#err_css").html("");
                                                minicex < 0 || minicex > 100 ? $("#err_minicex").html("Tidak Sesuai") : $("#err_minicex").html("");
                                                rps < 0 || rps > 100 ? $("#err_rps").html("Tidak Sesuai") : $("#err_rps").html("");
                                                osler < 0 || osler > 100 ? $("#err_osler").html("Tidak Sesuai") : $("#err_osler").html("");
                                                dops < 0 || dops > 100 ? $("#err_dops").html("Tidak Sesuai") : $("#err_dops").html("");
                                                cbd < 0 || cbd > 100 ? $("#err_cbd").html("Tidak Sesuai") : $("#err_cbd").html("");
                                            } else {
                                                data_form.push({
                                                    name: "idpr",
                                                    value: "<?= encryptString($d_praktikan['id_praktikan'], $customkey) ?>"
                                                });

                                                $.ajax({
                                                    type: 'POST',
                                                    url: "_admin/exc/x_u_ked_coass_nilai.php",
                                                    data: data_form,
                                                    dataType: "JSON",
                                                    success: function(response) {
                                                        <?php
                                                        if (isset($_GET['admin']))
                                                            $link = "?logbook&data=" . $_GET['admin'];
                                                        else
                                                            $link = "?ked_coass_nilai";
                                                        ?>
                                                        if (response.ket == "ERROR") error();
                                                        else simpan_berhasil("<?= $link ?>");
                                                    },
                                                    error: function(response) {
                                                        console.log(response);
                                                    }
                                                });
                                            }
                                        });
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
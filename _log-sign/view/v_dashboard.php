  <!-- DATA PRAKTIKAN -->
  <div class="row m-1">
    <div class="col-md p-0">
      <div class=" p-2 shadow-lg m-1 mb-2 bd-blur">
        <div class="h6 text-center text-gray-900 mb-1"><span class="badge badge-primary">DATA PRAKTIK</span></div>
        <hr class="border-light m-2">
        <?php
        $sql_praktik = "SELECT * FROM tb_praktik";
        $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
        $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
        $sql_praktik .= " JOIN tb_profesi_pdd ON tb_praktik.id_profesi_pdd = tb_profesi_pdd.id_profesi_pdd";
        $sql_praktik .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
        $sql_praktik .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "'";
        // $sql_praktik = "SELECT * FROM tb_praktik";
        // $sql_praktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
        // $sql_praktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
        // $sql_praktik .= " WHERE tb_praktik.status_praktik = 'Y'";
        // $sql_praktik .= " ORDER BY tb_praktik.tgl_selesai_praktik ASC";
        // echo $sql_praktik;
        $q_praktik = $conn->query($sql_praktik);
        $r_praktik = $q_praktik->rowCount();

        // echo $cal . "-" . $r_praktik . "-" . $round_col . "<br>";
        if ($r_praktik > 0) {
          $round_col = ceil(12 / $r_praktik);
        ?>
          <div class="row text-xs align-center justify-content-center my-auto mr-auto text-light">
            <?php
            while ($d_praktik = $q_praktik->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <div class="col-md-<?= $round_col; ?> text-center  mb-4">
                <span class="b">
                  <?= $d_praktik['nama_institusi'] ?> <br>
                  <?= $d_praktik['akronim_institusi'] != NULL ? " (" . $d_praktik['akronim_institusi'] . ")" : "" ?>
                </span><br>
                <div class="flip-container">
                  <?php if ($d_praktik['logo_institusi'] == '') { ?>
                    <span class="badge badge-danger">Data Logo Tidak Ada</span>
                  <?php } else { ?>
                    <img src="<?= $d_praktik['logo_institusi']; ?>" class="img-fluid rounded flip-image" alt="<?= $d_praktik['nama_institusi']; ?>" width="70px" height="70px">
                  <?php }  ?>
                </div>
                <?= $d_praktik['nama_jurusan_pdd']; ?> <br>
                <?php if ($d_praktik['id_profesi_pdd'] != 0) { ?>
                  (<?= $d_praktik['nama_profesi_pdd']; ?>)
                <?php } ?>
                <br>
                <?= $d_praktik['jumlah_praktik']; ?> Orang
              </div>
            <?php
            }
            ?>
          </div>
        <?php
        } else {
        ?>
          <div class="jumbotron text-center my-auto">
            <div class="display-4 my-auto text-lg text-uppercase b mb-2">Praktikan Tidak Ada </div>
            <p class="lead mt-2 mb-0">
              <a class="btn btn-outline-success" href="?reg" target="_blank" role="button">Ayo Daftar !!! </a>
            </p>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <!-- DATA MESS, KETERANGAN DAN PEMONDOKAN-->
  <div class="row m-1">
    <!-- DATA MESS DAN KETERANGAN  -->
    <div class="col-md-6 m-0 p-0">
      <!-- DATA MESS-->
      <div class=" p-2 shadow-lg m-1 mb-2 bd-blur">
        <div class="h6 text-center text-gray-900 mb-1"><span class="badge badge-primary">DATA MESS</span></div>
        <hr class="border-light m-2">
        <?php
        $sql_mess = "SELECT * FROM tb_mess ";
        $sql_mess .= " WHERE nama_pemilik_mess = 'RS Jiwa Provinsi Jawa Barat' ";
        $sql_mess .= " ORDER BY tb_mess.nama_mess ASC";

        $q_mess = $conn->query($sql_mess);
        $r_mess = $q_mess->rowCount();
        ?>
        <div class="table-responsive text-xs">
          <table class="m-0">
            <thead class="text-gray-100 text-center b">
              <tr>
                <th scope='col'>NO</th>
                <th>NAMA MESS</th>
                <th>KAPASITAS<br>TOTAL</th>
                <th>KAPASITAS<br>TERISI</th>
                <th>KAPASITAS<br>SISA</th>
                <th>BOR</th>
                <th>LOS</th>
                <th>TOI</th>
                <th>RINCIAN</th>
              </tr>
            </thead>
            <tbody class="text-gray-100 text-center">
              <?php
              $no = 1;
              $jumlah_terisi = 0;
              while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                $sql_mess1 = "SELECT tb_praktik.id_praktik, nama_mess, nama_institusi, nama_jurusan_pdd, jumlah_praktik, tgl_mulai_praktik, tgl_selesai_praktik, praktik_tgl  FROM tb_praktik";
                $sql_mess1 .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                $sql_mess1 .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                $sql_mess1 .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                $sql_mess1 .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                $sql_mess1 .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess";
                $sql_mess1 .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "' AND  tb_mess.id_mess = " . $d_mess['id_mess'];
                $sql_mess1 .= " ORDER BY tb_mess.nama_mess ASC";
                // echo $sql_mess1 . "<br>";
                $q_mess1 = $conn->query($sql_mess1);
                $jumlah_terisi = 0;
                while ($d_mess1 = $q_mess1->fetch(PDO::FETCH_ASSOC)) {
                  $jumlah_terisi += $d_mess1['jumlah_praktik'];
                }
              ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $d_mess['nama_mess']; ?></td>
                  <td class="text-center"><?= $d_mess['kapasitas_t_mess']; ?></td>
                  <td class="text-center"><?= $jumlah_terisi; ?></td>
                  <td class="text-center"><?= $d_mess['kapasitas_t_mess'] - $jumlah_terisi; ?></td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                  <td class="text-center">
                    <button class="btn btn-outline-light btn-xs" data-toggle="collapse" data-target="#c_<?= $d_mess['id_mess']; ?>">
                      <i class="fas fa-info-circle"></i>
                    </button>

                    <!-- data detail mess  -->
                <tr class="text-dark">
                  <td colspan="10" class="p-0">
                    <div id="accordion<?= $d_mess['id_mess']; ?>">
                      <div id="c_<?= $d_mess['id_mess']; ?>" class="collapse" data-parent="#accordion<?= $d_mess['id_mess']; ?>">
                        <?php
                        $sql_messPraktik = "SELECT * FROM tb_praktik";
                        $sql_messPraktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                        $sql_messPraktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                        $sql_messPraktik .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                        $sql_messPraktik .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                        $sql_messPraktik .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "'  AND tb_mess_pilih.id_mess = " . $d_mess['id_mess'];
                        // echo $sql_messPraktik . "<br>";
                        $q_messPraktik = $conn->query($sql_messPraktik);
                        if ($q_messPraktik->rowCount() > 0) {
                        ?>
                          <table class="table table-hover table-striped text-center">
                            <thead class="table-light">
                              <tr class="font-weight-bold ">
                                <th>Nama Institusi</th>
                                <th>Jurusan</th>
                                <th>Jumlah Praktik</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              while ($d_messPraktik = $q_messPraktik->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                                <tr>
                                  <td><?= $d_messPraktik['nama_institusi']; ?></td>
                                  <td><?= $d_messPraktik['nama_jurusan_pdd']; ?></td>
                                  <td><?= $d_messPraktik['jumlah_praktik']; ?></td>
                                  <td><?= tanggal($d_messPraktik['tgl_mulai_praktik']); ?></td>
                                  <td><?= tanggal($d_messPraktik['tgl_selesai_praktik']); ?></td>
                                </tr>
                              <?php
                              }
                              ?>
                            </tbody>
                          </table>
                        <?php
                        } else {
                        ?>
                          <div class="jumbotron">
                            <div class="jumbotron-fluid font-weight-bold text-center">
                              DATA PRAKTIK TIDAK ADA
                            </div>
                          </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </td>
                </tr>
                </td>
                </tr>
              <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- DATA KETERANGAN-->
      <!-- <div class=" p-2 shadow-lg m-1 mb-2 bd-blur">
        <div class="h6 text-center text-gray-900 mb-1"><span class="badge badge-primary">KETERANGAN</span></div>
                <hr class="border-light m-2">
        <?php
        $sql_mess = "SELECT * FROM tb_mess ";
        $sql_mess .= " WHERE nama_pemilik_mess = 'RS Jiwa Provinsi Jawa Barat' ";
        $sql_mess .= " ORDER BY tb_mess.nama_mess ASC";

        $q_mess = $conn->query($sql_mess);
        $r_mess = $q_mess->rowCount();
        ?>
        <div class="table-responsive text-xs">
          <table class="m-0">
            <thead class="text-light">
              <tr class="font-weight-bold">
                <th scope='col'>NO</th>
                <th>NAMA MESS/PEMONDOKAN</th>
                <th>TOTAL KAPASITAS</th>
                <th>TOTAL TERISI</th>
                <th>BOR</th>
                <th>LOS</th>
                <th>TOI</th>
              </tr>
            </thead>
            <tbody class="text-light">
              <?php
              $no = 1;
              $jumlah_terisi = 0;
              while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                $sql_mess1 = "SELECT tb_praktik.id_praktik, nama_mess, nama_institusi, nama_jurusan_pdd, jumlah_praktik, tgl_mulai_praktik, tgl_selesai_praktik, praktik_tgl  FROM tb_praktik";
                $sql_mess1 .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                $sql_mess1 .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                $sql_mess1 .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                $sql_mess1 .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                $sql_mess1 .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess";
                $sql_mess1 .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "' AND  tb_mess.id_mess = " . $d_mess['id_mess'];
                $sql_mess1 .= " ORDER BY tb_mess.nama_mess ASC";
                // echo $sql_mess1 . "<br>";
                $q_mess1 = $conn->query($sql_mess1);
                $jumlah_terisi = 0;
                while ($d_mess1 = $q_mess1->fetch(PDO::FETCH_ASSOC)) {
                  $jumlah_terisi += $d_mess1['jumlah_praktik'];
                }
              ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $d_mess['nama_mess']; ?></td>
                  <td><?= $d_mess['nama_pemilik_mess']; ?></td>
                  <td><?= $d_mess['nama_pemilik_mess']; ?></td>
                </tr>
              <?php
                $no++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div> -->
    </div>

    <!-- DATA PEMONDOKAN-->
    <div class="col-md-6 p-0">
      <div class=" p-2 shadow-lg m-1 mb-2 bd-blur">
        <div class="h6 text-center text-gray-900 mb-1"><span class="badge badge-primary">DATA PEMONDOKAN</span></div>
        <hr class="border-light m-2">
        <?php
        $sql_mess = "SELECT * FROM tb_mess ";
        $sql_mess .= " WHERE nama_pemilik_mess != 'RS Jiwa Provinsi Jawa Barat' AND status_mess = 'y'";
        $sql_mess .= " ORDER BY tb_mess.nama_mess ASC";

        $q_mess = $conn->query($sql_mess);
        $r_mess = $q_mess->rowCount();
        ?>
        <div class="table-responsive text-xs">
          <table class="m-0">
            <thead class="text-gray-100 text-center b">
              <tr>
                <th scope='col'>NO</th>
                <th>NAMA MESS</th>
                <th>KAPASITAS<br>TOTAL</th>
                <th>KAPASITAS<br>TERISI</th>
                <th>KAPASITAS<br>SISA</th>
                <th>RINCIAN</th>
              </tr>
            </thead>
            <thead class="text-gray-100 text-center">
              <?php
              $no = 1;
              $jumlah_terisi = 0;
              while ($d_mess = $q_mess->fetch(PDO::FETCH_ASSOC)) {
                $sql_mess1 = "SELECT tb_praktik.id_praktik, nama_mess, nama_institusi, nama_jurusan_pdd, jumlah_praktik, tgl_mulai_praktik, tgl_selesai_praktik, praktik_tgl  FROM tb_praktik";
                $sql_mess1 .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                $sql_mess1 .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                $sql_mess1 .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                $sql_mess1 .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                $sql_mess1 .= " JOIN tb_mess ON tb_mess_pilih.id_mess = tb_mess.id_mess";
                $sql_mess1 .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "' AND  tb_mess.id_mess = " . $d_mess['id_mess'];
                $sql_mess1 .= " ORDER BY tb_mess.nama_mess ASC";
                // echo $sql_mess1 . "<br>";
                $q_mess1 = $conn->query($sql_mess1);
                $jumlah_terisi = 0;
                while ($d_mess1 = $q_mess1->fetch(PDO::FETCH_ASSOC)) {
                  $jumlah_terisi += $d_mess1['jumlah_praktik'];
                }
              ?>
                <tr>
                  <td><?= $no; ?></td>
                  <td><?= $d_mess['nama_mess']; ?></td>
                  <td class="text-center"><?= $d_mess['kapasitas_t_mess']; ?></td>
                  <td class="text-center"><?= $jumlah_terisi; ?></td>
                  <td class="text-center"><?= $d_mess['kapasitas_t_mess'] - $jumlah_terisi; ?></td>
                  <td class="text-center">
                    <button class="btn btn-outline-light btn-xs" data-toggle="collapse" data-target="#c_<?= $d_mess['id_mess']; ?>">
                      <i class="fas fa-info-circle"></i>
                    </button>

                    <!-- data detail mess  -->
                <tr>
                  <td colspan="7" class="p-0">
                    <div id="accordion<?= $d_mess['id_mess']; ?>">
                      <div id="c_<?= $d_mess['id_mess']; ?>" class="collapse" data-parent="#accordion<?= $d_mess['id_mess']; ?>">
                        <?php
                        $sql_messPraktik = "SELECT * FROM tb_praktik";
                        $sql_messPraktik .= " JOIN tb_institusi ON tb_praktik.id_institusi = tb_institusi.id_institusi";
                        $sql_messPraktik .= " JOIN tb_jurusan_pdd ON tb_praktik.id_jurusan_pdd = tb_jurusan_pdd.id_jurusan_pdd";
                        $sql_messPraktik .= " JOIN tb_mess_pilih ON tb_praktik.id_praktik = tb_mess_pilih.id_praktik";
                        $sql_messPraktik .= " JOIN tb_praktik_tgl ON tb_praktik.id_praktik = tb_praktik_tgl.id_praktik";
                        $sql_messPraktik .= " WHERE tb_praktik.status_praktik = 'Y' AND tb_praktik_tgl.praktik_tgl = '" . date('Y-m-d', time()) . "'  AND tb_mess_pilih.id_mess = " . $d_mess['id_mess'];

                        // echo $sql_messPraktik . "<br>";
                        $q_messPraktik = $conn->query($sql_messPraktik);
                        if ($q_messPraktik->rowCount() > 0) {
                        ?>
                          <table class="table table-hover table-striped text-center">
                            <thead class="table-light">
                              <tr class="font-weight-bold ">
                                <th>Nama Institusi</th>
                                <th>Jurusan</th>
                                <th>Jumlah Praktik</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              while ($d_messPraktik = $q_messPraktik->fetch(PDO::FETCH_ASSOC)) {
                              ?>
                                <tr>
                                  <td><?= $d_messPraktik['nama_institusi']; ?></td>
                                  <td><?= $d_messPraktik['nama_jurusan_pdd']; ?></td>
                                  <td><?= $d_messPraktik['jumlah_praktik']; ?></td>
                                  <td><?= tanggal($d_messPraktik['tgl_mulai_praktik']); ?></td>
                                  <td><?= tanggal($d_messPraktik['tgl_selesai_praktik']); ?></td>
                                </tr>
                              <?php
                              }
                              ?>
                            </tbody>
                          </table>
                        <?php
                        } else {
                        ?>
                          <div class="jumbotron text-dark">
                            <div class="jumbotron-fluid font-weight-bold text-center">
                              DATA PRAKTIK TIDAK ADA
                            </div>
                          </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </td>
                </tr>
                </td>
                </tr>
              <?php
                $no++;
              }
              ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    var span = document.getElementById("jam");
    time();

    function time() {
      var d = new Date();
      var s = formattedNumber = ("0" + d.getSeconds()).slice(-2);
      var m = formattedNumber = ("0" + d.getMinutes()).slice(-2);
      var h = formattedNumber = ("0" + d.getHours()).slice(-2);
      span.textContent = h + ":" + m + ":" + s;
    }
    setInterval(time, 1000);
  </script>
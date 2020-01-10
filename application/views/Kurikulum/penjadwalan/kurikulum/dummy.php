

<!-- ==================================================== START TAB KELOLA -->

<div class="tab-pane <?php echo $this->session->flashdata('tab_loc') == null ? 'active' : '' ?>" id="jammengajar">
  <div class="box formmapel">
    <form class="form-horizontal form_head" action="/action_page.php">
      <div class="form-group">
        <label class="control-label col-sm-2" for="guru">Pilih jumlah guru:</label>
        <div class="col-sm-10">
          <select class="form-control" id="guru">
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
          </select>
        </div>
      </div>
    </form>
  </div>
  <div class="box formmapel" style="padding: 1.5em;">
    <!-- /.box-header -->
    <blockquote style="font-size: 1em;padding-left: 0em;color: #f44336;">
      <ul>
        <li>Pilih <b>Nama</b> guru, kemudian pilih <b>Mata Pelajaran</b> yang diampu dan isi <b>Jam Minim Mengajar</b></li>
        <li>Kemudian <b>Submit</b></li>
      </ul>
    </blockquote>

    <div class="box-body">
      <form method="post" action="<?php echo site_url('kurikulum/simpanjammengajar'); ?>">
        <div>
          <!-- <div class="box-header jarakbox" style="padding-top: : 0px"> -->

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th rowspan="3"><center>No.</center></th>
                  <th rowspan="3"><center>Nama</center></th>
                  <th rowspan="3"><center>NIP</center></th>
                  <!--  <th rowspan="3">Kode Guru</th> -->
                  <th rowspan="3"><center>Golongan</center></th>
                  <th rowspan="3"><center>Jabatan Guru</center></th>
                  <th rowspan="3"><center>Ijazah</center></th>
                  <th rowspan="3"><center>Mata pelajaran</center></th>
                  <th rowspan="3"><center>Jam Minim Mengajar</center></th>
                  <!-- <th rowspan="3"><center>Jumlah jam</center></th> -->
                </tr>
              </thead>
              <tbody  style="text-align: center; padding-bottom: 5px" id="guru_tampil">

                <?php
                for ($a = 1;$a <=10;$a++) {
                  ?>
                  <tr id="baris<?php echo $a ?>" class="hidden_tampilan">
                    <td class="fit"><?php echo $a; ?></td>
                    <td>
                      <select name="NIP<?php echo $a; ?>" id="NIP<?php echo $a; ?>" onchange="getinfoguru(<?php echo $a; ?>);" class="form-control">
                        <option value="">...</option>
                        <?php
                        foreach ($tabel_pegawai as $row_pegawai) {
                          ?>
                          <option value="<?php echo $row_pegawai->NIP; ?>"><?php echo $row_pegawai->Nama; ?></option>
                          <?php
                        }
                        ?>
                      </select></td>

                      <td><span id="NIP_text<?php echo $a; ?>">-</span></td>
                      <td><span id="Golongan_text<?php echo $a; ?>">-</span></td>
                      <td><span id="pangkat_text<?php echo $a; ?>">-</span></td>
                      <td><span id="Pendidikan_text<?php echo $a; ?>">-</span></td>
                      <td>
                        <select class="kodemapel form-control" name="id_namamapel<?php echo $a; ?>">
                          <option value="">...</option>
                          <?php
                          foreach ($tabel_namamapel as $row_namamapel) {
                            ?>
                            <option value="<?php echo $row_namamapel->id_namamapel; ?>"><?php echo $row_namamapel->nama_mapel; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </td>
                      <td><input type="text" name="jatah_minim_mgjr<?php echo $a; ?>" class="form-control"></td>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </form>

        </div>

        <div class="text-right pd-right-50 pd-bottom-15">
          <button class="btn btn-danger btn-dark-blue pd-right-50 pd-left-50" type="submit">Simpan</button>
        </div>

      </div>

    </div>
    <!-- ==================================================== END TAB KELOLA -->
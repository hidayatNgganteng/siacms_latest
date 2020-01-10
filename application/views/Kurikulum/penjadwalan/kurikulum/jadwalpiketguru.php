<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1 class="text-center" style="color:navy;">Jadwal Piket Guru<br></h1>
    <!-- <center><small>Tahun Ajaran 2016-2017</small></center> -->

    <ol class="breadcrumb">
      <li><a href="dashboard.php">Dashboard</a></li>
    </ol>
  </section>


  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->

    <!-- /.row -->
    <!-- Main row -->
    <div class="row">

      <!-- /.col -->
      <div class="col-md-12">
        <div class="nav-tabs-custom">

          <ul class="nav nav-tabs">
            <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
              <li  class="<?php if($this->session->userdata('jabatan') != 'Guru') : ?>active<?php endif ?>"><a href="#kelolajadwalpiket" data-toggle="tab" alt="test kursor">Kelola Jadwal Piket Guru</a></li>
            <?php endif ?>
            <li class="<?php if($this->session->userdata('jabatan') == 'Guru') : ?>active<?php endif ?>"><a href="#jadwalpiket" data-toggle="tab">Lihat Jadwal Piket Guru</a></li>
            
            <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
            <li class="<?php echo $this->session->flashdata('tab_pos') == 3 ? 'active' : '' ?>"><a href="#pengaturan" data-toggle="tab">Pengaturan </a></li>
            <?php endif ?>
          </ul>

          <div class="tab-content">
            <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
              <div class="<?php if($this->session->userdata('jabatan') != 'Guru') : ?>active<?php endif ?> tab-pane" id="kelolajadwalpiket">

                <div class="formmapel" style="display: block;padding: 1.5em;margin-bottom: 1.5em;">
                  <?php
                  if($this->session->userdata('jabatan') != 'Guru') :
                    ?>
                    <blockquote style="font-size: 1em;padding-left: 1em;border-left: 5px solid #f44336;color: #f44336;margin:0;">
                      Isikan Jumlah Guru Piket per Hari                  
                    </blockquote>
                  <?php endif ?>
                  <div class="row">
                    <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
                      <div class="col-xs-6" style="margin: 1em 0;">
                        <span style="font-weight: bold;">Pilih Jumlah Guru : </span>
                        <select class="kodepiket form-control" id="piket">
                          <option value="1" selected>1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                        </select>
                      </div>
                    <?php endif ?>
                    <div class="<?php if($this->session->userdata('jabatan') != 'Guru') { ?>col-xs-6<?php } else {?>col-xs-12<?php } ?>" style="margin: 1em 0;">

                      <span style="font-weight: bold;">Tahun Ajaran : </span>
                      <select class="kodepiket form-control" id="pilih_id_tahun_ajaran" onchange="document.location='<?php echo site_url('kurikulum/jadwalpiketguru'); ?>/' + document.getElementById('pilih_id_tahun_ajaran').value;">
                        <?php
                        foreach ($tabel_tahunajaran as $row_tahunajaran) :
                          ?>
                          <option value="<?php echo $row_tahunajaran->id_tahun_ajaran; ?>" <?php if ($id_tahun_ajaran == $row_tahunajaran->id_tahun_ajaran) { echo " selected"; } ?>>
                            Semester <?php echo $row_tahunajaran->semester; ?> <?php echo $row_tahunajaran->tahun_ajaran; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                </div>
                <div class="box formmapel" style="padding: 0.5em;">

                  <div class="box-body">
                    <form method="post" action="<?php echo site_url('kurikulum/simpanjadwalpiketguru'); ?>">
                      <input type="hidden" name="id_tahun_ajaran" id="get_tahunajaran">
                      <table class="table table-bordered table-striped tabelmapel_ table-hover">
                        <thead>
                          <!-- <input type="text" name="id_tahun_ajaran" placeholder="periode"> -->
                          <tr>
                            <th class="tengah" rowspan="2">No.</th>
                            <?php if($check['senin'] == 'on'): ?>
                            <th>Senin</th>
                            <?php endif; ?>
                            <?php if($check['selasa'] == 'on'): ?>
                            <th>Selasa</th>
                            <?php endif; ?>
                            <?php if($check['rabu'] == 'on'): ?>
                            <th>Rabu</th>
                            <?php endif; ?>
                            <?php if($check['kamis'] == 'on'): ?>
                            <th>Kamis</th>
                            <?php endif; ?>
                            <?php if($check['jumat'] == 'on'): ?>
                            <th>Jumat</th>
                            <?php endif; ?>
                            <?php if($check['sabtu'] == 'on'): ?>
                            <th>Sabtu</th>
                            <?php endif; ?>
                            <?php if($check['minggu'] == 'on'): ?>
                            <th>Minggu</th>
                            <?php endif; ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          for ($i=1;$i<=7;$i++) {
                            ?>
                            <tr id="baris<?php echo $i; ?>" class="hidden_tampilan">

                              <td class="fit"><?php echo $i; ?></td>
                              
                              <?php if($check['senin'] == 'on'): ?>
                              <th>
                                <select class="kodepiket form-control" name="NIP_senin<?php echo $i; ?>">
                                  <option value="">...</option>
                                  <?php
                                  foreach ($tabel_pegawai as $row_pegawai) {
                                    ?>
                                    <option value="<?php echo $row_pegawai->NIP; ?>" <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_senin[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </th>
                              <?php endif; ?>
                              <?php if($check['selasa'] == 'on'): ?>
                              <th>
                                <select class="kodepiket form-control" name="NIP_selasa<?php echo $i; ?>">
                                  <option value="">...</option>
                                  <?php
                                  foreach ($tabel_pegawai as $row_pegawai) {
                                    ?>
                                    <option value="<?php echo $row_pegawai->NIP; ?>" <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_selasa[$i-1]->NIP) { echo " selected"; } ?>><!-- ?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </th>
                              <?php endif; ?>
                              <?php if($check['rabu'] == 'on'): ?>
                              <th>
                                <select class="kodepiket form-control" name="NIP_rabu<?php echo $i; ?>">
                                  <option value="">...</option>
                                  <?php
                                  foreach ($tabel_pegawai as $row_pegawai) {
                                    ?>

                                    <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_rabu[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </th>
                              <?php endif; ?>
                              <?php if($check['kamis'] == 'on'): ?>
                              <th>
                               <select class="kodepiket form-control" name="NIP_kamis<?php echo $i; ?>">
                                <option value="">...</option>
                                <?php
                                foreach ($tabel_pegawai as $row_pegawai) {
                                  ?>
                                  <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_kamis[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </th>
                              <?php endif; ?>
                              <?php if($check['jumat'] == 'on'): ?>
                            <th>
                              <select class="kodepiket form-control" name="NIP_jumat<?php echo $i; ?>">
                                <option value="">...</option>
                                <?php
                                foreach ($tabel_pegawai as $row_pegawai) {
                                  ?>
                                  <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_jumat[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </th>
                              <?php endif; ?>
                              <?php if($check['sabtu'] == 'on'): ?>
                            <th>
                              <select class="kodepiket form-control" name="NIP_sabtu<?php echo $i; ?>">
                                <option value="">...</option>
                                <?php
                                foreach ($tabel_pegawai as $row_pegawai) {
                                  ?>
                                  <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_sabtu[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </th>
                              <?php endif; ?>
                              <?php if($check['minggu'] == 'on'): ?>
                            <th>
                              <select class="kodepiket form-control" name="NIP_minggu<?php echo $i; ?>">
                                <option value="">...</option>
                                <?php
                                foreach ($tabel_pegawai as $row_pegawai) {
                                  ?>
                                  <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if ($row_pegawai->NIP == @$tabel_jadwalpiketguru_minggu[$i-1]->NIP) { echo " selected"; } ?>><!-- <?php echo $row_pegawai->kode_guru; ?>.  --><?php echo $row_pegawai->nama_panggilan; ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </th>
                              <?php endif; ?>
                          </tr>
                          <?php
                        }
                        ?>

                      </tbody>

                    </table>
                    <button class="btn btn-danger" type="submit">Submit</button>
                  </form>
                </div>
                <!-- /.box-body -->
              </div> 
            </div>
          <?php endif ?>

          <div class="tab-pane <?php if($this->session->userdata('jabatan') == 'Guru') : ?>active<?php endif ?>" id="jadwalpiket">
            <div class="box formmapel" style="padding: 1em;">

              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped tabelmapel_">
                  <thead>

                    <th> 
                      <!-- ini code asli -->
                      <!-- <?php
                            foreach ($tabel_tahunajaran as $row_tahunajaran) {
                             if ($id_tahun_ajaran == $row_tahunajaran->id_tahun_ajaran) { echo $row_tahunajaran->semester." ".$row_tahunajaran->tahun_ajaran; } 
                            }
                            ?> -->

                            <!-- ini code modifikasi supaa bisa milih tahun ajaran yg mau ditampilin -->
                            <!-- <select class="kodepiket" name="id_tahun_ajaran" id="pilih_id_tahun_ajaran" onchange="document.location='<?php echo site_url('kurikulum/jadwalpiketguru'); ?>/' + document.getElementById('pilih_id_tahun_ajaran').value;">
                              <?php
                            foreach ($tabel_tahunajaran as $row_tahunajaran) {
                            ?>
                            <option value="<?php echo $row_tahunajaran->id_tahun_ajaran; ?>" <?php if ($id_tahun_ajaran == $row_tahunajaran->id_tahun_ajaran) { echo " selected"; } ?>><?php echo $row_tahunajaran->semester; ?>. <?php echo $row_tahunajaran->tahun_ajaran; ?></option>
                            <?php
                            }
                            ?>
                          </select> -->
                        </th>
                        <tr class="barishari">
                          <th class="tengah">No.</th>
                          <?php if($check['senin'] == 'on'): ?>
                          <th class="tengah">Senin</th>
                          <?php endif; ?>
                          <?php if($check['selasa'] == 'on'): ?>
                          <th class="tengah">Selasa</th>
                          <?php endif; ?>
                          <?php if($check['rabu'] == 'on'): ?>
                          <th class="tengah">Rabu</th>
                          <?php endif; ?>
                          <?php if($check['kamis'] == 'on'): ?>
                          <th class="tengah">Kamis</th>
                          <?php endif; ?>
                          <?php if($check['jumat'] == 'on'): ?>
                          <th class="tengah">Jumat</th>
                          <?php endif; ?>
                          <?php if($check['sabtu'] == 'on'): ?>
                          <th class="tengah">Sabtu</th>
                          <?php endif; ?>
                          <?php if($check['minggu'] == 'on'): ?>
                          <th class="tengah">Minggu</th>
                          <?php endif; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        for($i=1;$i<=7;$i++) {
                          ?>
                          <tr>
                            <td class="fit"><?php echo $i; ?></td>
                            <?php if($check['senin'] == 'on'): ?>
                            <th><?php echo @$tabel_jadwalpiketguru_senin[$i-1]->nama_panggilan; ?> </th>
                            <?php endif; ?>
                            <?php if($check['selasa'] == 'on'): ?>
                            <th><?php echo @$tabel_jadwalpiketguru_selasa[$i-1]->nama_panggilan; ?> </th>
                            <?php endif; ?>
                            <?php if($check['rabu'] == 'on'): ?>
                            <th><?php echo @$tabel_jadwalpiketguru_rabu[$i-1]->nama_panggilan; ?> </th>
                            <?php endif; ?>
                            <?php if($check['kamis'] == 'on'): ?>
                            <th><?php echo @$tabel_jadwalpiketguru_kamis[$i-1]->nama_panggilan; ?> </th>
                            <?php endif; ?>
                            <?php if($check['jumat'] == 'on'): ?>
                            <th><?php echo @$tabel_jadwalpiketguru_jumat[$i-1]->nama_panggilan; ?> </th>
                            <?php endif; ?>
                            <?php if($check['sabtu'] == 'on'): ?>
                            <th><?php echo @$tabel_jadwalpiketguru_sabtu[$i-1]->nama_panggilan; ?> </th>
                            <?php endif; ?>
                            <?php if($check['minggu'] == 'on'): ?>
                            <th><?php echo @$tabel_jadwalpiketguru_minggu[$i-1]->nama_panggilan; ?> </th>
                            <?php endif; ?>

                          </tr>
                          <?php
                        }
                        ?>
                      </tbody>

                    </table>
                    <!-- <a class="btnjdwl btn btn-default" href="<?php echo site_url('kurikulum/printjadwalpiketguru/'.$id_tahun_ajaran); ?>" target="_blank"><i class="fa fa-print text-red "></i> Print</a> -->
                    <button class="btnjdwl btn btn-default" onclick="window.open('<?php echo site_url('kurikulum/printjadwalpiketguru/'.$id_tahun_ajaran); ?>', 'winpopup', 'menubar=no,toolbar=no,resizeable=yes,statusbar=no,top=50,left=50,width=800,height=600');"><i class="fa fa-print text-red "></i> Print</button>
                  </div>
                  <!-- /.box-body -->
                </div>             
              </div>              


              <div class="tab-pane <?php echo $this->session->flashdata('tab_pos') == 3 ? 'active' : '' ?>" id="pengaturan">

                <div> <?php echo $this->session->flashdata('warning') ?></div>
                <!-- DATA MAPEL KELAS 7 -->
                <div class="box formmapel">
                  <div class="box-header" style="background-color:#5c8a8a">
                    <h3 class="box-title" style="color:white">Pengaturan</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body" style="padding: 1.5em;">
                    
                    <form action="<?= site_url('kurikulum/pengaturan_jadwalpiketguru') ?>" method="POST">
                     
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="senin" <?= ($check["senin"] == "on") ? 'checked': ''; ?>>
                        <label class="custom-control-label">Senin</label>
                      </div>  
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="selasa" <?= ($check["selasa"] == "on") ? 'checked': ''; ?>>
                        <label class="custom-control-label">Selasa</label>
                      </div>                              
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="rabu" <?= ($check["rabu"] == "on") ? 'checked': ''; ?>>
                        <label class="custom-control-label">Rabu</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="kamis" <?= ($check["kamis"] == "on") ? 'checked': ''; ?>>
                        <label class="custom-control-label">Kamis</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="jumat" <?= ($check["jumat"] == "on") ? 'checked': ''; ?>>
                        <label class="custom-control-label">Jum'at</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="sabtu" <?= ($check["sabtu"] == "on") ? 'checked': ''; ?>>
                        <label class="custom-control-label">Sabtu</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="minggu" <?= ($check["minggu"] == "on") ? 'checked': ''; ?>>
                        <label class="custom-control-label">Minggu</label>
                      </div>
                      <br/>
                      <input type="submit" class="btn" value="kirim">
                    </form>
                  </div>
                  <!-- /.box-body -->
                </div>                    
              </div> 


            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
      <!-- modal -->


      
    </section>
    <!-- /.content -->
  </div>
  <script>
    $(document).ready(function(){
      var val_ = $("#pilih_id_tahun_ajaran").val();
      $("#get_tahunajaran").val(val_);

      $("#baris1").addClass('show_tampilan')

      $('#piket').on('change', function() {
        const value = this.value
        
        for(var i = 1; i <= 10; i++) {
          if (i <= value) {
            $(`#baris${i}`).addClass('show_tampilan')
          } else {
            $(`#baris${i}`).removeClass('show_tampilan')
          }
        }
      });

      // $("#pilih_id_tahun_ajaran").on("change",function(){
      //   var val_this = $(this).val();
      //   $("#get_tahunajaran").val(val_this);
      // });
      // console.log("test");
    });
  </script>
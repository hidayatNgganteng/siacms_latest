<!DOCTYPE html>
<html>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <center style="color: navy;">Presensi Siswa SMP Yogyakarta <br></center>
          <center><small>Tahun Ajaran <?php echo $judul_tahun_ajaran; ?></small></center>
        </h1>
        <ol class="breadcrumb">
          <li><a href="dashboard.php">Dashboar d</a></li>
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
                <li class="active"><a href="#presensisiswa" data-toggle="tab">Presensi Siswa</a></li>

                <?php if($this->session->userdata('jabatan') == 'Admin Presensi') : ?>
                  <li><a href="#imporpresensi" data-toggle="tab">Import Presensi</a></li>
                <?php endif; ?>
                <li><a href="#laporanbulanan" data-toggle="tab">Laporan Presensi Per Bulan</a></li>
                <li><a href="#laporanpresensi" data-toggle="tab">Laporan Presensi Per Tahun</a></li>
                <li><a href="#laporanpersemester" data-toggle="tab">Laporan Presensi Per Semester</a></li>
                <?php if($this->session->userdata('jabatan') == 'Admin Presensi') : ?>
                  <li><a href="#pengaturan" data-toggle="tab">Pengaturan</a></li>
                <?php endif; ?>

              </ul>

              <div class="tab-content">

                <!-- =========================================================================================== START PRESENSI -->
                <div class="active tab-pane" id="presensisiswa">
                  <div class="box" style="border-top: 0;">
                    <!-- /.box-header -->
                    <div class="box-body formmapel" style="padding: 1em;padding-top: 0;">
                      <div class="box-header">
                        <h3 class="box-title text-center" style="width: 100%;">Presensi Siswa</h3>
                      </div>
                      <select id="pilihkelaspresensi" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
                        <option value="">Pilih Kelas</option>
                        <?php
                        foreach ($kelas_reguler_berjalan as $d){
                          ?>
                          <option value="<?php echo $d->id_kelas_reguler_berjalan; ?>" <?php if ($id_kelas_reguler_berjalan == $d->id_kelas_reguler_berjalan) { echo " selected"; } ?>><?php echo $d->nama_kelas;?></option>
                          <?php
                        }?>
                      </select>


                      <div class="posisikanan">
                        <select name="bulan" id="bulan" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
                          <option value="1" <?php if ($bln == '01') { echo " selected"; } ?>>Januari</option>
                          <option value="2" <?php if ($bln == '02') { echo " selected"; } ?>>Februari</option>
                          <option value="3" <?php if ($bln == '03') { echo " selected"; } ?>>Maret</option>
                          <option value="4" <?php if ($bln == '04') { echo " selected"; } ?>>April</option>
                          <option value="5" <?php if ($bln == '05') { echo " selected"; } ?>>Mei</option>
                          <option value="6" <?php if ($bln == '06') { echo " selected"; } ?>>Juni</option>
                          <option value="7" <?php if ($bln == '07') { echo " selected"; } ?>>Juli</option>
                          <option value="8" <?php if ($bln == '08') { echo " selected"; } ?>>Agustus</option>
                          <option value="9" <?php if ($bln == '09') { echo " selected"; } ?>>September</option>
                          <option value="10" <?php if ($bln == '10') { echo " selected"; } ?>>Oktober</option>
                          <option value="11" <?php if ($bln == '11') { echo " selected"; } ?>>November</option>
                          <option value="12" <?php if ($bln == '12') { echo " selected"; } ?>>Desember</option>
                        </select>
                        <select name="tahun" id="tahun" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
                          <option value="2017" <?php if ($thn == '2017') { echo " selected"; } ?>>2017</option>
                          <option value="2018" <?php if ($thn == '2018') { echo " selected"; } ?>>2018</option>
                          <option value="2019" <?php if ($thn == '2019') { echo " selected"; } ?>>2019</option>
                          <option value="2020" <?php if ($thn == '2020') { echo " selected"; } ?>>2020</option>
                        </select>
                      </div>

                      <br/><br/>
                      <?php if($this->session->userdata('jabatan') == 'Admin Presensi') : ?>
                        <div style="overflow-x: auto;">
                        <form method="post" action="<?php echo site_url('kurikulum/simpanpresensi'); ?>">
                          <input type="hidden" name="bln" value="<?php echo $bln; ?>">
                          <input type="hidden" name="thn" value="<?php echo $thn; ?>">
                          <input type="hidden" name="id_kelas_reguler_berjalan" value="<?php echo $id_kelas_reguler_berjalan; ?>">

                          <div style="overflow: auto;">
                            <table class="table table-bordered table-striped" style="width: 100%;border:0;">
                              <thead>
                                <tr class="barishari" style="background: #1e88e5;color: #eceff1;">
                                  <th class="fit" style="border: 0;border-radius: 1.5em 0 0 0;">No</th>
                                  <th style="border: 0;">Nama Siswa</th>
                                  <th style="border: 0;">NISN</th>
                                  <?php
                                  for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
                                    ?>
                                    <?php if($i == 31) { ?>
                                      <th style="border: 0;border-radius: 0 1.5em 0 0;"><?php echo $i; ?></th>
                                    <?php } else { ?>
                                      <th style="border: 0"><?php echo $i; ?></th>
                                    <?php } ?>
                                    <?php
                                  }
                                  ?>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                 <?php
                                 $z=0; 
                                 foreach ($siswaperkelas as $rowsiswa) {
                                  $z++;
                                  ?>
                                  <tr>
                                    <td><?php echo $z; ?></td>
                                    <td><?php echo $rowsiswa->nisn; ?></td>
                                    <td><?php echo $rowsiswa->nama; ?></td>
                                    <?php
                            //for($i=1;$i<=date('t');$i++) {
                                    for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
                                      ?>
                                      <th style="background: #42a5f5;border: 0.1px solid #90caf9;">
                                        <?php
                                //echo @$libur[$thn][ltrim($bln, "0")][ltrim($i, "0")];
                                        if ((@$libur[$thn][ltrim($bln, "0")][ltrim($i, "0")] == "") && (@$liburnasional[ltrim($bln, "0")][ltrim($i, "0")] == "")) {
                                          ?>
                                          <select class="kodeguru"  name="presensi_<?php echo $rowsiswa->nisn; ?>_<?php echo $i; ?>">
                                           <option value="">-</option>
                                           <?php if($check['h'] === 'on'):?>
                                             <option value="H" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "H") { echo " selected"; } ?>>H</option>
                                           <?php endif;?>
                                           <?php if($check['s'] === 'on'):?>
                                             <option value="S" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "S") { echo " selected"; } ?>>S</option>
                                           <?php endif;?>
                                           <?php if($check['i'] === 'on'):?>
                                             <option value="I" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "I") { echo " selected"; } ?>>I</option>
                                           <?php endif;?>
                                           <?php if($check['a'] === 'on'):?>
                                             <option value="A" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "A") { echo " selected"; } ?>>A</option> 
                                           <?php endif;?>
                                         </select>
                                         <?php
                                       }
                                       ?>
                                     </th>
                                     <?php
                                   }
                                   ?>
                                 </tr>

                                 <?php 
                               }
                               ?>

                             </tbody>
                           </table>
                         </div>
                         <br>

                         <a class="pull-right btn-jdwl" href="<?php  echo site_url('kurikulum/exportpresensi/'.@$this->uri->segment(3)); ?>">Export</a> 
                         <!-- <button type="button" class="pull-right btn-jdwl" onclick="document.location='<?php //echo site_url('akademik/exportpresensi/'.@$this->uri->segment(3)); ?>">Export</button> -->


                         <button class=" btn btn-danger pull-right" style="margin-right: 20px;">Submit</button>
                       </form>
                     </div>
                     <?php endif; ?>

                   </div>
                   
                   <div class="box-body formmapel" style="padding: 1em;margin-top: 1em;">
                    <div class="box-header">
                      <h3 class="box-title center" style="width: 100%;text-align: center;">Presensi Siswa Bulan <?php if ($bln == '01') { echo "Januari";} elseif ($bln == '02') {echo "Februari";} elseif ($bln == '03') {echo "Maret";} elseif ($bln == '04') {echo "April";} elseif ($bln == '05') {echo "Mei";} elseif ($bln == '06') {echo "Juni";} elseif ($bln == '07') {echo "Juli";} elseif ($bln == '08') {echo "Agustus";} elseif ($bln == '09') {echo "September";} elseif ($bln == '10') {echo "Oktober";} elseif ($bln == '11') {echo "November";} elseif ($bln == '12') {echo "Desember";}?></h3>
                    </div>
                    <div style="overflow-x: auto;">
                    <table class="table table-bordered table-striped" style="width: 100%;border:0;">
                      <thead>
                        <tr class="barishari" style="background: #1e88e5;color: #eceff1;">
                          <th class="fit" style="border: 0;border-radius: 1em 0 0 0;">No</th>
                          <th style="border: 0;">NINS</th>
                          <th style="border: 0;">Nama Siswa</th>
                          <?php
                          
                          for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
                            ?>
                            <?php if($i == cal_days_in_month(CAL_GREGORIAN, $bln, $thn)) { ?>
                              <th style="border: 0;border-radius: 0 1em 0 0;"><?php echo $i; ?></th>
                            <?php } else { ?>
                              <th style="border: 0"><?php echo $i; ?></th>
                            <?php } ?>
                            <?php
                          }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $z=0; 
                          foreach ($siswaperkelas as $rowsiswa) {
                            $z++;
                            ?>
                            <tr>
                              <td><?php echo $z; ?></td>
                              <td><?php echo $rowsiswa->nisn; ?></td>
                              <td><?php echo $rowsiswa->nama; ?></td>
                              <?php
              //for($i=1;$i<=date('t');$i++) { 
                              for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
                                ?>
                                <th>
                                  <?php 
                                  if(isset($check[strtolower(@$datpresensi[$rowsiswa->nisn][$i])]) && $check[strtolower(@$datpresensi[$rowsiswa->nisn][$i])] === 'on')
                                    echo @$datpresensi[$rowsiswa->nisn][$i]; 
                                  ?>
                                </th>
                                <?php
                              }
                              ?>
                            </tr>
                            <?php 
                          }
                          ?> 
                        </tbody>

                      </table>
                    </div>

                    </div>

                  </div> 
                </div>
                <!-- =========================================================================================== END PRESENSI -->

                <!-- =============================================================================================== START IMPORT PRESENSI -->

                <div class="tab-pane" id="imporpresensi">
                 <form class="form-horizontal formmapel" action="<?php echo base_url('kurikulum/importpresensi'); ?>" method="post" enctype="multipart/form-data" style="padding: 2em;">
                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                      <div class="col-xs-2"></div>
                      <div class="col-xs-8">
                        <div class="col-md-12">
                          <label>Pilih Kelas : </label>

                          <select name="kelasimportpresensi" class="pull-left form-control">
                            <option value="">Pilih kelas</option>
                            <?php
                            foreach ($kelas_reguler_berjalan as $d){
                              ?>
                              <option value="<?php echo $d->id_kelas_reguler_berjalan; ?>" <?php if ($id_kelas_reguler_berjalan == $d->id_kelas_reguler_berjalan) { echo " selected"; } ?>><?php echo $d->nama_kelas;?></option>
                              <?php
                            }?>
                          </select>

                        </div>
                        <div class="col-sm-12">
                          <label for="inputKurikulum" class="control-label">Pilih File :</label>
                          <input type="file" class="" required="required" name="filepresensi" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-danger pull-right" style="margin: 1em 0;margin-bottom: 0;">Submit</button>
                      </div>
                      <div class="col-xs-2"></div>

                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    </div>
                  </div>
                </form>

              </div>
              <!-- =============================================================================================== END IMPORT PRESENSI -->

              <!-- =============================================================================================== START LAPORAN BULAN -->
              <div class=" tab-pane" id="laporanbulanan">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title" style="width: 100%">Laporan Presensi Siswa Per Bulan</h3>
                    <form class="pull-left">
                      <select name="bulan" id="bulan_" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan_').value;">
                        <option value="1" <?php if ($bln == '01') { echo " selected"; } ?>>Januari</option>
                        <option value="2" <?php if ($bln == '02') { echo " selected"; } ?>>Februari</option>
                        <option value="3" <?php if ($bln == '03') { echo " selected"; } ?>>Maret</option>
                        <option value="4" <?php if ($bln == '04') { echo " selected"; } ?>>April</option>
                        <option value="5" <?php if ($bln == '05') { echo " selected"; } ?>>Mei</option>
                        <option value="6" <?php if ($bln == '06') { echo " selected"; } ?>>Juni</option>
                        <option value="7" <?php if ($bln == '07') { echo " selected"; } ?>>Juli</option>
                        <option value="8" <?php if ($bln == '08') { echo " selected"; } ?>>Agustus</option>
                        <option value="9" <?php if ($bln == '09') { echo " selected"; } ?>>September</option>
                        <option value="10" <?php if ($bln == '10') { echo " selected"; } ?>>Oktober</option>
                        <option value="11" <?php if ($bln == '11') { echo " selected"; } ?>>November</option>
                        <option value="12" <?php if ($bln == '12') { echo " selected"; } ?>>Desember</option>
                      </select>
                      <select name="tahun" id="tahun_" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun_').value+'/'+document.getElementById('bulan').value;">
                        <option value="2017" <?php if ($thn == '2017') { echo " selected"; } ?>>2017</option>
                        <option value="2018" <?php if ($thn == '2018') { echo " selected"; } ?>>2018</option>
                        <option value="2019" <?php if ($thn == '2019') { echo " selected"; } ?>>2019</option>
                        <option value="2020" <?php if ($thn == '2020') { echo " selected"; } ?>>2020</option>
                      </select>
                    </form>
                    <form class="posisikanan">
                      <select id="pilihkelasperbulan_" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelasperbulan_').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
                        <option value="">Pilih Kelas</option>
                        <?php
                        foreach ($kelas_reguler_berjalan as $d){
                          ?>
                          <option value="<?php echo $d->id_kelas_reguler_berjalan; ?>" <?php if ($id_kelas_reguler_berjalan == $d->id_kelas_reguler_berjalan) { echo " selected"; } ?>><?php echo $d->nama_kelas;?></option>
                          <?php
                        }?>
                      </select></form>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div style="overflow: auto">
                        <table class="table table-bordered table-striped" style="width: 100%">
                          <thead>
                            <tr class="barishari" style="background: #1e88e5;color: #eceff1;">
                              <th style="border: 0;border-radius: 1em 0 0 0;">Bulan</th>
                              <th style="border: 0;" class="fit">Nomor Absen</th>
                              <th style="border: 0;" class="fit">Nama Siswa</th>
                              <?php if($check['s'] === 'on'):?>
                                <th style="border: 0;" class="fit">Sakit</th>
                              <?php endif;?>
                              <?php if($check['i'] === 'on'):?>
                                <th style="border: 0;" class="fit">Ijin</th>
                              <?php endif;?>
                              <?php if($check['a'] === 'on'):?>
                                <th style="border: 0;" class="fit">Absen</th>
                              <?php endif;?>
                              <?php if($check['h'] === 'on'):?>
                                <th style="border: 0;border-radius: 0 1em 0 0;" class="fit">hadir</th>
                              <?php endif;?>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            if ($this->uri->segment(5) == "") {
                              $i = date("m");
                            } else {
                              $i = $this->uri->segment(5);
                            }
                            ?>
                            <tr>
                              <th class="fit" rowspan="<?php echo count($siswaperkelas)+1; ?>"><?php
                              if ($i == 1) {
                                echo "Januari";
                              } else if ($i == 2) {
                                echo "Februari";
                              } else if ($i == 3) {
                                echo "Maret";
                              } else if ($i == 4) {
                                echo "April";
                              } else if ($i == 5) {
                                echo "Mei";
                              } else if ($i == 6) {
                                echo "Juni";
                              } else if ($i == 7) {
                                echo "Juli";
                              } else if ($i == 8) {
                                echo "Agustus";
                              } else if ($i == 9) {
                                echo "September";
                              } else if ($i == 10) {
                                echo "Oktober";
                              } else if ($i == 11) {
                                echo "November";
                              } else if ($i == 12) {
                                echo "Desember";
                              }
                        //echo $i;
                              ?></th>
                            </tr>
                            <?php
                            $z=0;
                            foreach ($siswaperkelas as $rowsiswa) {
                              $z++;
                              ?>
                              <tr>
                                <td><?php echo $z; ?></td>
                                <td><?php echo $rowsiswa->nama; ?></td>
                                <?php if($check['s'] === 'on'):?>
                                  <th><?php echo $datpresensibulanan[$rowsiswa->nisn][$i]['S']; ?></th>
                                <?php endif;?>
                                <?php if($check['i'] === 'on'):?>
                                  <th><?php echo $datpresensibulanan[$rowsiswa->nisn][$i]['I']; ?></th>
                                <?php endif;?>
                                <?php if($check['a'] === 'on'):?>
                                  <th><?php echo $datpresensibulanan[$rowsiswa->nisn][$i]['A']; ?></th>
                                <?php endif;?>
                                <?php if($check['h'] === 'on'):?>
                                  <th><?php echo $datpresensibulanan[$rowsiswa->nisn][$i]['H']; ?></th>
                                <?php endif;?>
                              </tr>
                              <?php
                            }
                            ?>

                          </tbody>
                        </table>
                      </div>
                      <a class="btn btnjdwl" href="<?php echo site_url('kurikulum/cetak_presensi_/'.$id_kelas_reguler_berjalan.'/'.$thn.'/'.$bln); ?>">PRINT</a>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <!-- =============================================================================================== END LAPORAN BULAN -->

                <!-- =============================================================================================== START LAPORAN TAHUN -->
                <!-- /.tab-pane -->
                <div class=" tab-pane" id="laporanpresensi">
                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Laporan Presensi Siswa Per Tahun</h3>
                      <form class="posisikanan">
                        <select id="pilihkelasperbulan" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelasperbulan').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
                          <option value="">Pilih Kelas</option>
                          <?php
                          foreach ($kelas_reguler_berjalan as $d){
                            ?>
                            <option value="<?php echo $d->id_kelas_reguler_berjalan; ?>" <?php if ($id_kelas_reguler_berjalan == $d->id_kelas_reguler_berjalan) { echo " selected"; } ?>><?php echo $d->nama_kelas;?></option>
                            <?php
                          }?>
                        </select></form>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div style="overflow: auto">
                          <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                              <tr class="barishari" style="background: #1e88e5;color: #eceff1;">
                                <th style="border: 0;border-radius: 1em 0 0 0;">Bulan</th>
                                <th style="border: 0;" class="fit">Nomor Absen</th>
                                <th style="border: 0;" class="fit">Nama Siswa</th>
                                <?php if($check['s'] === 'on'):?>
                                  <th style="border: 0;" class="fit">Sakit</th>
                                <?php endif;?>
                                <?php if($check['i'] === 'on'):?>
                                  <th style="border: 0;" class="fit">Ijin</th>
                                <?php endif;?>
                                <?php if($check['a'] === 'on'):?>
                                  <th style="border: 0;" class="fit">Absen</th>                                  
                                <?php endif;?>
                                <?php if($check['h'] === 'on'):?>
                                  <th style="border: 0;border-radius: 0 1em 0 0;" class="fit">Hadir</th>                                  
                                <?php endif;?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              for ($i=1;$i<=12;$i++) {
                                ?>
                                <tr>
                                  <th class="fit" rowspan="<?php echo count($siswaperkelas)+1; ?>"><?php
                                  if ($i == 1) {
                                    echo "Januari";
                                  } else if ($i == 2) {
                                    echo "Februari";
                                  } else if ($i == 3) {
                                    echo "Maret";
                                  } else if ($i == 4) {
                                    echo "April";
                                  } else if ($i == 5) {
                                    echo "Mei";
                                  } else if ($i == 6) {
                                    echo "Juni";
                                  } else if ($i == 7) {
                                    echo "Juli";
                                  } else if ($i == 8) {
                                    echo "Agustus";
                                  } else if ($i == 9) {
                                    echo "September";
                                  } else if ($i == 10) {
                                    echo "Oktober";
                                  } else if ($i == 11) {
                                    echo "November";
                                  } else if ($i == 12) {
                                    echo "Desember";
                                  }
                      //echo $i;
                                  ?></th>
                                </tr>
                                <?php
                                $z=0;
                                foreach ($siswaperkelas as $rowsiswa) {
                                  $z++;
                                  ?>
                                  <tr>
                                    <td><?php echo $z; ?></td>
                                    <td><?php echo $rowsiswa->nama; ?></td>
                                    <?php if($check['s'] === 'on'):?>
                                      <th><?php echo $datpresensibulan[$rowsiswa->nisn][$i]['S']; ?></th>                                  
                                    <?php endif;?>
                                    <?php if($check['i'] === 'on'):?>
                                      <th><?php echo $datpresensibulan[$rowsiswa->nisn][$i]['I']; ?></th>                                  
                                    <?php endif;?>
                                    <?php if($check['a'] === 'on'):?>
                                      <th><?php echo $datpresensibulan[$rowsiswa->nisn][$i]['A']; ?></th>                                  
                                    <?php endif;?>
                                    <?php if($check['h'] === 'on'):?>
                                      <th><?php echo $datpresensibulan[$rowsiswa->nisn][$i]['H']; ?></th>                                  
                                    <?php endif;?>
                                  </tr>
                                  <?php
                                }
                              }
                              ?>

                            </tbody>
                          </table>
                        </div>
                        <a class="btn btnjdwl" href="<?php echo site_url('kurikulum/cetak_presensi/'.$id_kelas_reguler_berjalan.'/'.$thn.'/'.$bln); ?>">PRINT</a>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>

                  <!-- =============================================================================================== END LAPORAN TAHUN -->



                  <!-- =============================================================================================== START LAPORAN SEMESTER -->
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="laporanpersemester">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title">Laporan Presensi Siswa Per Semester</h3>
                        <form class="posisikanan">
                          <select id="pilihkelassemester" onchange="document.location='<?php echo site_url('kurikulum/presensi'); ?>/'+document.getElementById('pilihkelassemester').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
                            <option value="">Pilih Kelas</option>
                            <?php
                            foreach ($kelas_reguler_berjalan as $d){
                              ?>
                              <option value="<?php echo $d->id_kelas_reguler_berjalan; ?>" <?php if ($id_kelas_reguler_berjalan == $d->id_kelas_reguler_berjalan) { echo " selected"; } ?>><?php echo $d->nama_kelas;?></option>
                              <?php
                            }?>
                          </select>
                        </form>

                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div style="overflow: auto">
                          <table class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                              <tr class="barishari" style="background: #1e88e5;color: #eceff1;">
                                <th style="border: 0;border-radius: 1em 0 0 0;">Semester</th>
                                <th style="border: 0;" class="fit">Nomor Absen</th>
                                <th style="border: 0;" class="fit">Nama Siswa</th>
                                <?php if($check['s'] === 'on'):?>
                                  <th style="border: 0;" class="fit">Sakit</th>
                                <?php endif;?>
                                <?php if($check['i'] === 'on'):?>
                                  <th style="border: 0;" class="fit">Ijin</th>
                                <?php endif;?>
                                <?php if($check['a'] === 'on'):?>
                                  <th style="border: 0;" class="fit">Absen</th>
                                <?php endif;?>
                                <?php if($check['h'] === 'on'):?>
                                  <th style="border: 0;border-radius: 0 1em 0 0;" class="fit">Hadir</th>
                                <?php endif;?>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              for ($i=1;$i<=2;$i++) {
                                ?>
                                <tr>
                                  <th class="fit" rowspan="<?php echo count($siswaperkelas)+1; ?>">Semester <?php 
                                  if ($i == 1) {
                                    echo "Ganjil";
                                  } else {
                                    echo "Genap";
                                  }
                        //echo $i;
                                  ?></th>
                                </tr>
                                <?php
                                $z=0; 
                                foreach ($siswaperkelas as $rowsiswa) {
                                  $z++;
                                  ?>
                                  <tr>
                                    <td><?php echo $z; ?></td>
                                    <td><?php echo $rowsiswa->nama; ?></td>
                                    <?php if($check['s'] === 'on'):?>
                                      <th><?php echo $datpresensisemester[$rowsiswa->nisn][$i]['S']; ?></th>
                                    <?php endif;?>
                                    <?php if($check['i'] === 'on'):?>
                                      <th><?php echo $datpresensisemester[$rowsiswa->nisn][$i]['I']; ?></th>
                                    <?php endif;?>
                                    <?php if($check['a'] === 'on'):?>
                                      <th><?php echo $datpresensisemester[$rowsiswa->nisn][$i]['A']; ?></th>
                                    <?php endif;?>
                                    <?php if($check['h'] === 'on'):?>
                                      <th><?php echo $datpresensisemester[$rowsiswa->nisn][$i]['H']; ?></th>
                                    <?php endif;?>
                                  </tr>
                                  <?php
                                }

                              }
                              ?>

                            </tbody>
                          </table>
                        </div>
                        <a class="btn btnjdwl" href="<?php echo site_url('kurikulum/cetak_presensisem/'.$id_kelas_reguler_berjalan.'/'.$thn.'/'.$bln); ?>">PRINT</a>
                        <!-- <button class="btn btnjdwl">PRINT</button> -->
                      </div>
                      <!-- /.box-body -->
                    </div> 
                  </div>

                  <!-- =============================================================================================== END LAPORAN SEMESTER -->




                  <!-- =============================================================================================== START PENGATURAN-->
                  <div class="tab-pane" id="pengaturan">
                    <div class="box">
                      <div class="box-header">
                        <h3 class="box-title" style="width: 100%">Pengaturan</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body" style="padding: 1.5em;">

                        <form action="<?= site_url('kurikulum/pengaturan_presensi') ?>" method="POST">

                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="h" <?= ($check["h"] == "on") ? 'checked': ''; ?>>
                            <label class="custom-control-label">Hadir</label>
                          </div>                              
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="s" <?= ($check["s"] == "on") ? 'checked': ''; ?>>
                            <label class="custom-control-label">Sakit</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="i" <?= ($check["i"] == "on") ? 'checked': ''; ?>>
                            <label class="custom-control-label">Ijin</label>
                          </div>
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="a" <?= ($check["a"] == "on") ? 'checked': ''; ?>>
                            <label class="custom-control-label">Absen</label>
                          </div>
                          <br/>
                          <input type="submit" class="btn" value="kirim">
                        </form>
                      </div>
                      <!-- /.box-body -->
                    </div>
                  </div>
                  <!-- =============================================================================================== END PENGATURAN-->

                </div>
                <!-- /.tab-content -->
              </div>
              <!-- /.nav-tabs-custom -->
            </div>
          </div>
        </section>
      </div>
    </div>

  </body>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->


  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {

      $("#baris_1").addClass('show_tampilan');
      $("#baris1").addClass('show_tampilan');

      $('#pilihbulanan').on('change', function() {
        const value = this.value

        for(var i = 1; i <= 12; i++) {
          if (i <= value) {
            $(`#baris${i}`).addClass('show_tampilan');
            $(`#baris_${i}`).addClass('show_tampilan');
          // $(`#barisdata${i}`).addClass('show_tampilan');
        } else {
          $(`#baris${i}`).removeClass('show_tampilan');
          $(`#baris_${i}`).removeClass('show_tampilan');
          // $(`#barisdata${i}`).removeClass('show_tampilan');
        }
      }
    });

      $("#trig_modal_pengaturan").click(function() {
        $("#modal_pengaturan").modal('show');
      });
      var max_fields      = 50; //maximum input boxes allowed
      var wrapper         = $(".bigbox-mapel"); //Fields wrapper
      var add_button      = $("#tambahmapel"); //Add button ID
      var box_mapel       = `<div class="box-mapel">
      <div class="form-group formgrup jarakform">
      <label for="inputKurikulum" class="col-sm-2 control-label">Nama Mata Pelajaran</label>
      <div class="col-sm-4">
      <input type="text" class="form-control" id="inputName" placeholder="Nama Mata Pelajaran">
      </div>
      </div>

      <div class="form-group formgrup jarakform">
      <label for="inputKurikulum" class="col-sm-2 control-label">KKM</label>
      <div class="col-sm-4">
      <input type="text" class="form-control" id="inputName" placeholder="KKM">
      </div>
      </div>

      <div class="form-group formgrup jarakform">
      <label for="inputKurikulum" class="col-sm-2 control-label">Jam Belajar</label>
      <div class="col-sm-4">
      <input type="text" class="form-control" id="inputName" placeholder="Jam Belajar">
      </div>
      </div>
      <i class="fa fa-minus-circle text-red tambahmapel"></i><a style="color:red" href="#" class="remove_field"> Hapus mapel</a>

      </div>`;
      
      var x = 1; //initlal text box count
      $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
          if(x < max_fields){ //max input box allowed
              x++; //text box increment
              $(wrapper).append(box_mapel); //add input box
            }
          });
      
      $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
      })
    });
  </script>
  </html>


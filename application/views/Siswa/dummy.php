
<!-- ================================================================================================ START TAB PRESENSI SISWA -->
<div class="active tab-pane" id="presensisiswa">
  <div class="box" style="border-top: 0;">
    <!-- /.box-header -->
    <?php if($this->session->userdata("jabatan") == "Siswa") : ?>
      <div class="box-body formmapel" style="padding: 1em;padding-top: 0;">
        <div class="box-header">
          <h3 class="box-title text-center" style="width: 100%;">Presensi Siswa</h3>
        </div>

        <?php
        if (($this->session->userdata("jabatan") == "Kurikulum") || ($this->session->userdata("jabatan") == "Guru")|| ($this->session->userdata("jabatan") == "Karyawan") ) {
          ?>

          <br/><br/>

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
                    <?php
                          //for($i=1;$i<=date('t');$i++) {
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
                             <option value="H" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "H") { echo " selected"; } ?>>H</option>
                             <option value="S" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "S") { echo " selected"; } ?>>S</option>
                             <option value="I" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "I") { echo " selected"; } ?>>I</option>
                             <option value="A" <?php if (@$datpresensi[$rowsiswa->nisn][$i] == "A") { echo " selected"; } ?>>A</option> 
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

           <a class="pull-right btn-jdwl" href="<?php  echo site_url('penilaian/akademik/exportpresensi/'.@$this->uri->segment(3)); ?>">Export</a> 
           <!-- <button type="button" class="pull-right btn-jdwl" onclick="document.location='<?php //echo site_url('akademik/exportpresensi/'.@$this->uri->segment(3)); ?>">Export</button> -->


           <button class=" btn btn-danger pull-right" style="margin-right: 20px;">Submit</button>
         </form>

       <?php } ?>
     </div>
   <?php endif ?>

   <div class="box-body formmapel" style="padding: 1em;margin-top: 1em;">

    <div class="box-header">
      <h3 class="box-title center" style="width: 100%;text-align: center;">Presensi Siswa Bulan <?php if ($bln == '01') { echo "Januari";} elseif ($bln == '02') {echo "Februari";} elseif ($bln == '03') {echo "Maret";} elseif ($bln == '04') {echo "April";} elseif ($bln == '05') {echo "Mei";} elseif ($bln == '06') {echo "Juni";} elseif ($bln == '07') {echo "Juli";} elseif ($bln == '08') {echo "Agustus";} elseif ($bln == '09') {echo "September";} elseif ($bln == '10') {echo "Oktober";} elseif ($bln == '11') {echo "November";} elseif ($bln == '12') {echo "Desember";}?></h3>
    </div>
    <select id="pilihkelaspresensi" onchange="document.location='<?php echo site_url('penilaian/akademik/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
      <option value="">Pilih Kelas</option>
      <?php
      foreach ($kelas_reguler_berjalan as $d){
        ?>
        <option value="<?php echo $d->id_kelas_reguler_berjalan; ?>" <?php if ($id_kelas_reguler_berjalan == $d->id_kelas_reguler_berjalan) { echo " selected"; } ?>><?php echo $d->nama_kelas;?></option>
        <?php
      }?>
    </select>
    <div class="posisikanan">
      <select name="bulan" id="bulan" onchange="document.location='<?php echo site_url('penilaian/akademik/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
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
      <select name="tahun" id="tahun" onchange="document.location='<?php echo site_url('akademik/presensi'); ?>/'+document.getElementById('pilihkelaspresensi').value+'/'+document.getElementById('tahun').value+'/'+document.getElementById('bulan').value;">
        <option value="2017" <?php if ($thn == '2017') { echo " selected"; } ?>>2017</option>
        <option value="2018" <?php if ($thn == '2018') { echo " selected"; } ?>>2018</option>
      </select>
    </div>
    <table class="table table-bordered table-striped" style="width: 100%;border:0;margin-top: 1em;">
      <thead>
        <tr class="barishari" style="background: #1e88e5;color: #eceff1;">
          <th class="fit" style="border: 0;border-radius: 1em 0 0 0;">No</th>
          <th style="border: 0;">Nama Siswa</th>
          <?php
        //for($i=1;$i<=date('t');$i++) {
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
              <td><?php echo $rowsiswa->nama; ?></td>
              <?php
              //for($i=1;$i<=date('t');$i++) {
              for($i=1;$i<=cal_days_in_month(CAL_GREGORIAN, $bln, $thn);$i++) {
                ?>
                <th><?php echo @$datpresensi[$rowsiswa->nisn][$i]; ?>
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
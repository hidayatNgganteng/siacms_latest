<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Manajemen waktu untuk Jadwal Mata Pelajaran<br></center>
      <!-- <center><small>Tahun Ajaran 2016-2017 Semester 1 Kurikulum 2013</small></center> -->
    </h1>
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

            <li data_tab="10" id="get_data" class="tab_loc <?php echo $this->session->flashdata('tab_loc') == 1 ? 'active' : '' ?>"><a href="#tabkelola" data-toggle="tab">Data Jam Belajar</a></li>
            <li data_tab="9" id="get_data" class="tab_loc <?php echo $this->session->flashdata('tab_loc') == 2 ? 'active' : '' ?>"><a href="#tabpengaturan" data-toggle="tab">Pengaturan Hari</a></li>

          </ul>
          <div class="tab-content" style="padding: 1.5em;">

            <!--===================================================START TAB PENGATURAN -->

            <div class="tab-pane <?php echo $this->session->flashdata('tab_loc') == 2 ? 'active' : '' ?>" href="#tabpengaturan" id="tabpengaturan">
              <h4><center><b>Pengaturan Hari</b></center></h4>
              <h5><center><b>Pilihlah Hari Untuk Kelola Jam Belajar</b></center></h5><br>
              
              <div class="box formmapel">
                <div class="box-header" style="background-color:#5c8a8a">
                  <h3 class="box-title" style="color:white">Hari Belajar</h3>
                </div>
                <div style="padding:20px;">
                  <form id="form_pengaturan_hari" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo site_url('kurikulum/savepengaturanhari'); ?>">  
                    <input type="hidden" name="tab_loc" value="2" id="tab_loc">
                    <?php
                    foreach ($tabel_pengaturan_hari as $tabel) 
                    { 
                     ?><input type="checkbox" class="flat" name="nilai_<?php echo $tabel->id_pengaturan; ?>" value="1" <?php 
                     if ($tabel->nilai == "1") 
                      { echo " checked"; } ?>>
                    <label><?php echo $tabel->atribut; ?></label><br> 
                    <?php 
                  }
                  ?>
                  <br>
                  <div class="modal-footer" align="center">
                    <button type="submit" class="btn btn-success" >Aktifkan Hari</button>
                  </div>    
                </form>
              </div>
            </div>
          </div> 
          <!--===================================================END TAB PENGATURAN -->

          <!--===================================================START TAB KELOLA -->
          <div class="tab-pane <?php echo $this->session->flashdata('tab_loc') == null ||  $this->session->flashdata('tab_loc') == 1 ? 'active' : '' ?>" href="#tabkelola" id="tabkelola">
            <h4><center><b>Kelola Jam Belajar</b></center></h4>
            <br>
            <form id="form_kelola_belajar" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo site_url('kurikulum/saveharirentang'); ?>">  
              <input type="hidden" name="tab_loc" value="1" id="tab_loc">
              <?php
              foreach ($hari_aktif as $hari) { 
                $count = 0;
                $data= [];
                foreach($tabel_hari_rentang as $jadwal) {
                  if($jadwal->hari=== $hari) {
                    $count += 1;
                    $data[] = [
                      'mulai' => $jadwal->jam_mulai,
                      'selesai' => $jadwal->jam_selesai,
                    ];
                  }
                }
                if($count == 0) {
                  $count = 1;
                  $data[] = [
                    'mulai' => '',
                    'selesai' => '',
                  ];
                }
                ?>
                <div class="box formmapel">
                  <div class="box-header" style="background-color:#5c8a8a">
                    <h3 class="box-title" style="color:white">Jadwal <?=$hari?></h3>
                  </div>
                  <div style="padding:20px;">
                    <div class="form-group">
                      <label class="control-label col-sm-2" >Pilih jumlah jam:</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="jumjam_<?=$hari?>" id="jumjam_<?=$hari?>" onchange="pilih('<?=$hari?>')" >
                          <option value="1" <?= $count == 1? 'selected':''?>>1</option>
                          <option value="2" <?= $count == 2? 'selected':''?>>2</option>
                          <option value="3" <?= $count == 3? 'selected':''?>>3</option>
                          <option value="4" <?= $count == 4? 'selected':''?>>4</option>
                          <option value="5" <?= $count == 5? 'selected':''?>>5</option>
                          <option value="6" <?= $count == 6? 'selected':''?>>6</option>
                          <option value="7" <?= $count == 7? 'selected':''?>>7</option>
                          <option value="8" <?= $count == 8? 'selected':''?>>8</option>
                          <option value="9" <?= $count == 9? 'selected':''?>>9</option>
                          <option value="10" <?= $count == 10? 'selected':''?>>10</option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <table class="table table-striped projects">
                      <thead>
                        <tr>
                          <th style="width: 7%">No</th>
                          <th style="width: 7.5%">Jam Ke-</th>
                          <th>Jam Mulai</th>
                          <th>Jam Selesai</th>
                        </tr>
                      </thead>
                      <tbody id = "tbody_<?=$hari?>">                  
                        <?php for($w = 1 ; $w <= $count ; $w++) : ?>
                        <tr >
                          <td><input type="text" class="form-control" value="<?= $w ?>" style="text-align: center" readonly></td>
                          <td><input type="text" class="form-control" value="<?= $w ?>" name="<?=$hari?>_jam_ke_1" style="text-align: center" readonly></td>
                          <td><input type="time" class="form-control" name="<?=$hari?>_jam_mulai_<?= $w ?>" id="<?=$hari?>_jam_mulai_<?= $w ?>" required value= "<?=$data[$w-1]['mulai']?>"></td>
                          <td><input type="time" class="form-control" name="<?=$hari?>_jam_selesai_<?= $w ?>" id="<?=$hari?>_jam_selesai_<?= $w ?>" required value= "<?=$data[$w-1]['selesai']?>"></td>                        
                        </tr>
                        <?php endfor;?>
                      </tbody>
                    </table></div></div>
                    <?php 
                  }
                  ?>
                  <br>
                  <div class="modal-footer" align="center">
                    <button type="submit" class="btn btn-success" >Simpan</button>
                  </div>    
                </form>
              </div> 
              <!--===================================================END TAB KELOLA -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <input type="hidden" id="hari_aktif" value='<?= json_encode($hari_aktif) ?>'>
  <script>

  function pilih(hari) {
    var jumlah_jam = document.getElementById("jumjam_"+hari).value;   
    var old = getNilai(hari, jumlah_jam);
    console.log(old);
    $("#tbody_"+hari).empty(); 
    tabBody = document.getElementById('tbody_'+hari);
    for(var i = 1 ; i <= jumlah_jam ; i ++) {        
      row = document.createElement('tr');
      cell1 = document.createElement('td');
      cell2 = document.createElement('td');
      cell3 = document.createElement('td');
      cell4 = document.createElement('td');

      var input = document.createElement('div');
      input.innerHTML = '<input type="text" class = "form-control" value = "'+i+'" style="text-align: center" readonly>';
      cell1.appendChild(input.firstChild);

      var input = document.createElement('div');
      input.innerHTML = '<input type="text" class = "form-control" value = "'+i+'" name="'+hari+'_jam_ke_'+i+'" style="text-align: center" readonly>';
      cell2.appendChild(input.firstChild);
      
      var input = document.createElement('div');
      input.innerHTML = '<input type="time" class = "form-control" name="'+hari+'_jam_mulai_'+i+'" id="'+hari+'_jam_mulai_'+i+'" value="'+old[i-1].jam_mulai+'" required>';
      cell3.appendChild(input.firstChild);
      
      var input = document.createElement('div');
      input.innerHTML = '<input type="time" class = "form-control" name="'+hari+'_jam_selesai_'+i+'" id="'+hari+'_jam_selesai_'+i+'" value="'+old[i-1].jam_selesai+'"  required>';
      cell4.appendChild(input.firstChild);

      row.appendChild(cell1);
      row.appendChild(cell2);
      row.appendChild(cell3);
      row.appendChild(cell4);
      tabBody.appendChild(row);
    }
  }
  function getNilai(hari, jum) {
    var data = [];
    for(var i = 1 ; i <= jum ; i ++) {       
        var el = document.getElementById(hari+"_jam_mulai_"+i);
        if (typeof(el) != 'undefined' && el != null){
          data.push({
          jam_mulai : document.getElementById(hari+"_jam_mulai_"+i).value,
          jam_selesai : document.getElementById(hari+"_jam_selesai_"+i).value
        });
        }else{
          data.push({
            jam_mulai : '',
            jam_selesai : ''
          });
        }
     }
     return data;
  }

    var hari_aktif = JSON.parse(document.getElementById("hari_aktif").value);
    $(document).ready(function() {
      console.log(hari_aktif);
      for(var w = 0 ; w < hari_aktif.length ; w ++) {

      }
      $(".tab_loc").click(function() {
        var data_tab = $(this).attr('data_tab');
        $("#tab_loc").val(data_tab);
      });

    });
  </script>
  <!-- /.content-wrapper
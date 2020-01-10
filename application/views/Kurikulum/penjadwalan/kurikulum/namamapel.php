<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Tambah Mata Pelajaran<br></center>
      <!-- <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="dashboard.php">Dashboard</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="row" >
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tambah_mapel" data-toggle="tab">Tambah Mata Pelajaran</a></li>            
            <li><a href="#datanamamapel" data-toggle="tab">Data Mata Pelajaran </a></li>            
            <li><a href="#pengaturanmapel" data-toggle="tab">Pengaturan </a></li>
          </ul>


          <div class="tab-content" style="padding:1.5em;">


            <div class="active tab-pane" id="tambah_mapel">
              <div class="box formmapel">
                <div class="box-header" style="background-color:     #5c8a8a">
                  <h3 class="box-title" style="color:white">Tambah Otomatis</h3>
                </div>
                <div class="box-body">
                  <table id="tambah_otomatis_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="fit">No</th>
                        <th>Mata Pelajaran</th>
                        <th>Warna</th>
                        <th>Aktif</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=1;
                      foreach ($tabel_mapel_default as $row_mapel_default) {
                        $flag = false;
                        $color = "";
                        foreach ($tabel_namamapel as $row_namamapel) {
                          if (strtolower($row_mapel_default->nama_mapel) == strtolower($row_namamapel->nama_mapel)){
                            $flag= true;
                            $color = $row_namamapel->warna;
                          }   
                        }
                        ?>
                        <tr>
                          <form id="formmapel_<?php echo $row_mapel_default->id_mapel ?>" style="display:block;" class="form-horizontal formmapel" method="post" action="<?php echo site_url('kurikulum/checkmapel'); ?>">
                            <input type="hidden" class="form-control" id="nama" name="nama_mapel" value="<?php echo $row_mapel_default->nama_mapel ?>">
                            <td class="fit"><?php echo $i; ?></td>
                            <td><?php echo $row_mapel_default->nama_mapel; ?></td>
                            <td>
                              <select type="text" class="form-control" id="warna" name="warna_mapel" placeholder="Warna" value=" style="width: 120px;">
                                <?php foreach($warna as $war): if($war->aktif == 1): ?>
                                  <option  value="<?= $war->warna ?>" style="background-color:<?= $war->warna ?>;" <?php if ($color === $war->warna) { echo " selected"; } ?>><?= $war->nama ?></option>
                                <?php endif;endforeach;?>  
                              </select>
                            </td>
                            <!-- <td><span style="background-color: <?php echo $row_mapel_default->warna; ?>;"><?php echo $row_mapel_default->warna; ?></span></td> -->
                            <td>
                              <input name ="aktif_mapel" type="checkbox" class="btn btn-info" <?php echo $flag ? "checked" : ""; ?> onclick="check(<?php echo $row_mapel_default->id_mapel ?>);"></input>
                            </td>
                          </form>           
                        </tr>
                        <?php
                        $i++;  
                        ?>
                        
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>


                </div>
              </div>

              <div class="formmapel">
                <div class="box-header" style="background-color:#5c8a8a">
                  <h3 class="box-title" style="color:white">Tambah Manual</h3>
                </div>
                <form id="formmapel" class="form-horizontal" method="post" action="<?php echo site_url('kurikulum/simpanmapeldefault'); ?>" style="padding: 1em;">
                  <input type="hidden" name="id_mapel" id="id_mapel"  value="<?php echo @$edit_mapel->id_mapel; ?>"/>
                  <p style="color: #ff0000"> > Isi <b>Nama Mata Pelajaran</b> dengan <b>Mata Pelajaran</b> yang ada di sekolah.<br>

                  </p>


                  <div class="bigbox-mapel"> 
                    <div class="box-mapel">
                      <div class="form-group formgrup jarakform">
                        <label for="inputKurikulum" class="col-sm-2 control-label">Nama Mata Pelajaran</label>
                        <div class="col-sm-4">
                          <input type="text" required class="form-control" id="nama_mapel" name="nama_mapel" placeholder="Nama Mata Pelajaran" value="<?php echo @$edit_mapel->nama_mapel; ?>">
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>

            <div> 
              <?php echo $this->session->flashdata('warning') ?>
            </div>

            <!-- /.tab-pane --======================================================================================================================START-->
            <div class="tab-pane" id="datanamamapel">
              <!-- DATA MAPEL KELAS 7 -->
              <div class="box formmapel">
                <div class="box-header" style="background-color:     #5c8a8a">
                  <h3 class="box-title" style="color:white">Data Mata Pelajaran</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                  <table id="datanamamapel_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="fit">No</th>
                        <th>Mata Pelajaran</th>
                        <th>Warna</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      ?>
                      <?php
                      $i=0;
                      foreach ($tabel_namamapel as $row_namamapel) {
                        $i++; 
                        ?>
                        <tr>

                          <td class="fit"><?php echo $i; ?></td>
                          <td><?php echo $row_namamapel->nama_mapel; ?></td>
                          <td><span style="background-color: <?php echo $row_namamapel->warna; ?>;"><font color= "<?php echo $row_namamapel->warna; ?>">Magnifico</font></span></td>
                          <td> 
                            <a class="btn btn-block btn-primary button-action btnedit edit_mapel" href="#" data_id="<?php echo $row_namamapel->id_namamapel; ?>" data_nama="<?php echo $row_namamapel->nama_mapel; ?>" data_warna="<?php echo $row_namamapel->warna; ?>"> Edit </a>
                            <a onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-primary button-action btnhapus" href="<?php echo site_url('kurikulum/hapusnamamapel/'.$row_namamapel->id_namamapel); ?>" > Hapus </a>
                          </td>               
                        </tr>
                        <?php

                        ?> 
                        <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>

            </div>
            <!-- /.tab-pane==============================================================END -->

            <!-- /.tab-pane --======================================================================================================================START-->
            <div class="tab-pane" id="pengaturanmapel">
              <!-- DATA MAPEL KELAS 7 -->
              <div class="box formmapel">
                <div class="box-header" style="background-color:     #5c8a8a">
                  <h3 class="box-title" style="color:white">Pengaturan</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body" style = "padding :30px;">
                  
                  <table id="warna_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="fit">No</th>
                        <th>Nama</th>
                        <th>Warna</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      ?>
                      <?php
                      $i=0;
                      foreach ($warna as $w) {
                        $i++; 
                        ?>
                        <tr>
                          <td class="fit"><?php echo $i; ?></td>
                          <td><?php echo $w->nama; ?></td>
                          <td><span style="background-color: <?php echo $w->warna; ?>;"><font color= "<?php echo $w->warna; ?>">Magnifico</font></span></td>
                          <td><?php echo $w->aktif == 1 ? "Aktif" : "Tidak"; ?></td>
                          <td> 
                            <a class="btn btn-block btn-primary button-action btnedit edit_warna" href="#" data_id="<?php echo $w->id; ?>" 
                              data_nama="<?php echo $w->nama; ?>" data_warna="<?php echo $w->warna; ?>"  data_aktif="<?php echo $w->aktif; ?>"> Edit </a>
                              <a onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-primary button-action btnhapus" 
                              href="<?php echo site_url('kurikulum/hapuswarnamapel/'.$w->id); ?>" > Hapus </a>
                            </td>               
                          </tr>
                          <?php

                          ?> 
                          <?php
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>



                <div class="formmapel">
                  <div class="box-header" style="background-color:#5c8a8a">
                    <h3 class="box-title" style="color:white">Tambah Warna</h3>
                  </div>
                  <form id="formmapel" class="form-horizontal" method="post" action="<?php echo site_url('kurikulum/simpanwarnamapel'); ?>" style="padding: 1em;">
                    <input type = "hidden" id="id_warna" name = "id" >
                    <div class="bigbox-mapel"> 
                      <div class="box-mapel">
                        <div class="form-group formgrup jarakform">
                          <label for="inputKurikulum" class="col-sm-2 control-label">Nama Warna</label>
                          <div class="col-sm-4">
                            <input type="text" required class="form-control" id="nama_warna" name="nama" placeholder="Nama Mata Pelajaran" value="<?php echo @$edit_warna->warna; ?>">
                          </div>
                        </div>
                        <div class="form-group formgrup jarakform">
                          <label for="inputKurikulum" class="col-sm-2 control-label">Warna</label>
                          <div class="col-sm-4">
                            <input type="color" required class="form-control" id="warna_warna" name="warna"  value="<?php echo @$edit_warna->warna; ?>">
                          </div>
                        </div>
                        <div class="form-group formgrup jarakform">
                          <label for="inputKurikulum" class="col-sm-2 control-label">Status</label>
                          <div class="col-sm-4">
                            <input type="checkbox" id="aktif_warna" name="aktif" value="1"> Aktif
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Simpan</button>
                      </div>
                    </div>
                  </form>
                </div>

                
              </div>
              <!-- /.tab-pane==============================================================END -->
            </div>
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>


<div class="modal fade" id="edit_mapel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="margin-top: 50vh; transform: translateY(-175px)">
    <div class="modal-content" style="height:350px; padding: 20px;">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Edit Mata Pelajaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formmapel" style="display:block;" class="form-horizontal" method="post" action="<?php echo site_url('kurikulum/simpannamamapel'); ?>#datanamamapel">
        <div class="modal-body">
          
          <input type="hidden" name="id_namamapel" id="id_mapel_modal"  value=""/>

          <div class="bigbox-mapel"> 
            <div class="box-mapel">
              <div class="form-group formgrup jarakform">
                <label for="inputKurikulum" class="col-sm-4 control-label" style="text-align: left">Nama Mata Pelajaran</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="nama_mapel_modal" name="nama" placeholder="Nama Mata Pelajaran" value="">
                </div>
              </div>

              <div class="form-group formgrup jarakform">
                <label for="inputKurikulum" class="col-sm-4 control-label" style="text-align: left">Pilih Warna</label>
                <div class="col-sm-8">
                  
                  <select type="text" class="form-control" id="warna" name="warna" placeholder="Warna" value=" style="width: 120px;">
                    <?php foreach($warna as $war): if($war->aktif == 1): ?>
                      <option  value="<?= $war->warna ?>" style="background-color:<?= $war->warna ?>;" <?php if ($color === $war->warna) { echo " selected"; } ?>><?= $war->nama ?></option>
                    <?php endif;endforeach;?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->

<script>
  function check(id)
  {
  //formmapel_
  document.getElementById('formmapel_'+id).submit();

}
$(document).ready(function() {
  
  $('#tambah_otomatis_table').DataTable();
  $('#datanamamapel_table').DataTable();
  $('#warna_table').DataTable();

  $(".edit_mapel").click(function() {
    var id = $(this).attr('data_id')
    var nama = $(this).attr('data_nama')
    var warna = $(this).attr('data_warna')
    $("#id_mapel_modal").attr('value', id)
    $("#nama_mapel_modal").attr('value', nama)
    $(`${warna}`).attr('selected', true)
    $("#edit_mapel_modal").modal('show')
  })

  $(".edit_warna").click(function() {
    var id = $(this).attr('data_id')
    var nama = $(this).attr('data_nama')
    var warna = $(this).attr('data_warna')
    var aktif = $(this).attr('data_aktif')

    $("#id_warna").attr('value', id)
    $("#nama_warna").attr('value', nama)
    $("#warna_warna").attr('value', warna)
    console.log(aktif);
    document.getElementById("aktif_warna").checked = aktif == 1;
  })

  if (location.hash) {
    $("a[href='" + location.hash + "']").tab("show");
  }
  $(document.body).on("click", "a[data-toggle='tab']", function(event) {
    location.hash = this.getAttribute("href");
  });
})

$(window).on("popstate", function() {
  //  var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
  //  $("a[href='" + anchor + "']").tab("show");
});
</script>
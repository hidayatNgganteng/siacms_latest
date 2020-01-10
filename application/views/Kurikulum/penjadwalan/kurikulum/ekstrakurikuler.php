<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Jadwal Ekstrakurikuler<br></center>
      <!--  <center><small>Tahun Ajaran 2016-2017 Kurikulum 2013</small></center> -->
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
            <?php if($this->session->userdata('jabatan') == 'Ekskul') : ?>
              <li class="<?php echo $this->session->flashdata('position_tab') == null || $this->session->flashdata('position_tab') == 1 ? 'active' : '' ?>"><a href="#dataekskul" data-toggle="tab"><?php if (@$edit_jadwalekskul) { echo "Edit"; } else { echo "Tambah"; } ?> Jadwal Ekskul</a></li>
            <?php endif ?>
            <li class="<?php echo $this->session->flashdata('position_tab') == 2 || $this->session->userdata('jabatan') !== 'Ekskul' ? 'active' : '' ?>"><a href="#dataekstrakurikuler" data-toggle="tab">Data Ekskul </a></li>
            
            <?php if($this->session->userdata('jabatan') == 'Ekskul') : ?>
            <li class="<?php echo $this->session->flashdata('position_tab') == 3 ? 'active' : '' ?>"><a href="#pengaturan" data-toggle="tab">Pengaturan </a></li>
            <?php endif ?>
          </ul>


          <div class="tab-content">


            <?php
            if($this->session->userdata('jabatan') == 'Ekskul') :
              ?>
              <div class="tab-pane <?php echo  $this->session->flashdata('position_tab') == null || $this->session->flashdata('position_tab') == 1 ? 'active' : '' ?>" id="dataekskul">

                <div class="formmapel" style="padding: 1em;padding-top: 0;">
              <!-- <div class="box-header" style="background-color:     #5c8a8a">
                <h3 class="box-title" style="color:white">Tambah Manual</h3>
              </div> -->
              <div class="row" >
                <div class="col-xs-12" style="background: #64b5f6;border-radius: 1em 1em 0 0;margin-bottom: 1em;">
                  <h3 class="text-center" style="color: white;">Formulir Data Ekstrakurikuler</h3>
                </div>
              </div>
              <form style="display:block;" class="form-horizontal" method="post" action="<?php echo site_url('kurikulum/simpanjadwalekskul'); ?>">
                <input type="hidden" name="id_jadwal_ekskul" value="<?php echo @$edit_jadwalekskul->id_jadwal_ekskul; ?>">
                <?php if($check['hari'] === 'on'): ?>
                <div class="form-group formgrup jarakform">
                  <label class="col-sm-4 control-label">Hari : </label>
                  <div class="col-sm-5">
                    <select required="required" class="form-control" name="hari" value="<?php echo $row_jadwalekskul->hari; ?>" style="width: 120px;">
                      <option value="">Pilih Hari</option>
                      <option value="Senin" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Senin") echo "selected";?>> Senin </option>
                      <option value="Selasa" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Selasa") echo "selected";?>> Selasa </option>
                      <option value="Rabu" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Rabu") echo "selected";?>> Rabu </option>
                      <option value="Kamis" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Kamis") echo "selected";?>> Kamis </option>
                      <option value="Jumat" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Jumat") echo "selected";?>> Jumat</option>
                      <option value="Sabtu" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Sabtu") echo "selected";?>> Sabtu </option>
                      <option value="Minggu" <?php if (isset($row_jadwalekskul->hari) && $row_jadwalekskul->hari=="Minggu") echo "selected";?>> Minggu </option>    
                    </select>
                  </div>
                </div>
                <?php endif; ?>
                <?php if($check['jam_mulai'] === 'on'): ?>
                <div class="bigbox-mapel"> 
                  <div class="box-mapel">
                    <div class="form-group formgrup jarakform">
                      <label for="jam_mulai" class="col-sm-4 control-label">Jam Mulai : </label>
                      <div class="col-sm-5">
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="Waktu" value="<?php echo @$edit_jadwalekskul->jam_mulai; ?>">
                      </div>
                    </div>
                    <?php endif; ?>
                    <?php if($check['jam_selesai'] === 'on'): ?>
                    <div class="form-group formgrup jarakform">
                      <label for="jam_selesai" class="col-sm-4 control-label">Jam Selesai : </label>
                      <div class="col-sm-5">
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Waktu" value="<?php echo @$edit_jadwalekskul->jam_selesai; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php if($check['jenis_kls_tambahan'] === 'on'): ?>
                <div class="form-group formgrup jarakform">
                  <label class="col-sm-4 control-label">Jenis Ekstrakurikuler : </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="id_jenis_kls_tambahan" id="kelas1" onchange="fetch_select_ekskul(this.value, 'ekskul1');">
                      <option value="">Pilih Ekskul</option>
                      <?php
                      foreach ($tabel_jenisklstambahan as $row_jenisklstambahan) { ?>
                        <option value="<?php echo $row_jenisklstambahan->id_jenis_kls_tambahan; ?>" <?php if (@$edit_jadwalekskul->id_jenis_kls_tambahan == $row_jenisklstambahan->id_jenis_kls_tambahan) { echo " selected"; } ?>><?php echo $row_jenisklstambahan->jenis_kls_tambahan; ?></option><?php
                      } ?>
                    </select>
                  </div>
                </div>
                <?php endif; ?>
                <?php if($check['tempat'] === 'on'): ?>
                <div class="bigbox-mapel"> 
                  <div class="box-mapel">
                    <div class="form-group formgrup jarakform">
                      <label for="tempat" class="col-sm-4 control-label">Tempat : </label>
                      <div class="col-sm-5">
                        <input type="text" class="form-control" id="tempat" name="tempat" placeholder="tempat" value="<?php echo @$edit_jadwalekskul->tempat; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <?php endif; ?>
                <?php if($check['pembimbing'] === 'on'): ?>
                <div class="form-group formgrup jarakform">
                  <label class="col-sm-4 control-label">Pembimbing : </label>
                  <div class="col-sm-5">
                    <select class="form-control" name="id_pembimbing">
                      <option value="">Pilih Pembimbing</option>
                      <?php
                      foreach ($tabel_pembimbing as $row_pembimbing) { ?>
                        <option value="<?php echo $row_pembimbing->id_pembimbing; ?>"  <?php if (@$edit_jadwalekskul->id_pembimbing == $row_pembimbing->id_pembimbing) { echo " selected"; } ?>><?php echo $row_pembimbing->nama_pembimbing; ?></option> <?php
                      }?>
                    </select>
                  </div>
                </div>
                <?php endif; ?>


                <div class="form-group">
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary pull-right" style="margin-right: 2em;">Submit</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        <?php endif ?>
        <!-- /.tab-pane -->

        <!-- /.tab-pane -->
        <div class="tab-pane <?php echo $this->session->flashdata('position_tab') == 2  || $this->session->userdata('jabatan') !== 'Ekskul' ? 'active' : '' ?>" id="dataekstrakurikuler" style="padding: 1em;">          
          <div> <?php echo $this->session->flashdata('warning') ?></div>
          <div class="box-body formmapel" style="padding: 0;">
            <div class="box-header" style="background-color:     #5c8a8a">
              <h3 class="box-title" style="color:white">Data Jadwal Ekstrakurikuler </h3>
            </div>
            <div style="padding: 1.5em;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th class="fit">No.</th>
                    <?php if($check['hari'] === 'on'): ?>
                    <th>Hari</th>
                    <?php endif; ?>
                    <?php if($check['jam_mulai'] === 'on'): ?>
                    <th>Jam Mulai</th>
                    <?php endif; ?>
                    <?php if($check['jam_selesai'] === 'on'): ?>
                    <th>Jam Selesai</th>
                    <?php endif; ?>
                    <?php if($check['jenis_kls_tambahan'] === 'on'): ?>
                    <th>Jenis Ekstrakurikuler</th>
                    <?php endif; ?>
                    <?php if($check['tempat'] === 'on'): ?>
                    <th>Tempat</th>
                    <?php endif; ?>
                    <?php if($check['pembimbing'] === 'on'): ?>
                    <th>Pembimbing</th>
                    <?php endif; ?>
                    <?php
                    if($this->session->userdata('jabatan') == 'Ekskul') :
                      ?>
                      <th>Action</th>
                    <?php endif ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=0;
                  foreach ($tabel_jadwalekskul as $row_jadwalekskul) {
                    $i++;
                    ?>
                    <tr>
                      <td class="fit"><?php echo $i; ?></td>
                      <?php if($check['hari'] === 'on'): ?>
                      <td><?php echo $row_jadwalekskul->hari; ?></td>
                      <?php endif; ?>
                      <?php if($check['jam_mulai'] === 'on'): ?>
                      <td><?php echo substr($row_jadwalekskul->jam_mulai, 0, 5); ?></td>
                      <?php endif; ?>
                      <?php if($check['jam_selesai'] === 'on'): ?>
                      <td><?php echo substr($row_jadwalekskul->jam_selesai, 0, 5); ?></td>
                      <?php endif; ?>
                      <?php if($check['jenis_kls_tambahan'] === 'on'): ?>
                      <td><?php echo $row_jadwalekskul->jenis_kls_tambahan; ?></td>
                      <?php endif; ?>
                      <?php if($check['tempat'] === 'on'): ?>
                      <td><?php echo $row_jadwalekskul->tempat; ?></td>
                      <?php endif; ?>
                      <?php if($check['pembimbing'] === 'on'): ?>
                      <td><?php echo $row_jadwalekskul->nama_pembimbing; ?></td>
                      <?php endif; ?>
                      <?php
                      if($this->session->userdata('jabatan') == 'Ekskul') :
                        ?>
                        <td> 
                          <button
                          class="btn btn-block btn-primary button-action btnedit edit_jadwal_eskul_trigger"
                          id_jadwal_eskul="<?php echo $row_jadwalekskul->id_jadwal_ekskul ?>"
                          hari="<?php echo $row_jadwalekskul->hari ?>"
                          jam_mulai="<?php echo $row_jadwalekskul->jam_mulai ?>"
                          jam_selesai="<?php echo $row_jadwalekskul->jam_selesai ?>"
                          jenis_eskul="<?php echo preg_replace('/\s+/', '', $row_jadwalekskul->jenis_kls_tambahan); ?>"
                          tempat="<?php echo $row_jadwalekskul->tempat ?>"
                          pembimbing="<?php echo preg_replace('/\s+/', '', $row_jadwalekskul->nama_pembimbing); ?>"
                          >Edit</button>
                          <a onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-primary button-action btnhapus" href="<?php echo site_url('kurikulum/hapusjadwalekskul/'.$row_jadwalekskul->id_jadwal_ekskul); ?>" > Hapus </a>
                        </td>               
                      <?php endif ?>
                    </tr>
                    <?php
                  }
                  ?>
                </tbody>
              </table>             
              <button class="btnjdwl btn btn-default" onclick="window.open('<?php echo site_url('ekstrakurikuler/printjadwalekskul'); ?>', 'winpopup', 'menubar=no,toolbar=no,resizeable=yes,statusbar=no,top=50,left=50,width=800,height=600');" style="margin: 1em 0;"><i class="fa fa-print text-red "></i> Print</button>
            </div>
          </div>
          <!-- /.box-body -->
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

              <form action="<?= site_url('ekstrakurikuler/pengaturan_ekstrakurikuler') ?>" method="POST">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" checked disabled>
                  <input type="checkbox" class="custom-control-input" name="no" checked hidden>
                  <label class="custom-control-label">Nomor</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="hari" <?= ($check["hari"] == "on") ? 'checked': ''; ?>>
                  <label class="custom-control-label">Hari</label>
                </div>  
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="jam_mulai" <?= ($check["jam_mulai"] == "on") ? 'checked': ''; ?>>
                  <label class="custom-control-label">Jam Mulai</label>
                </div>                              
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="jam_selesai" <?= ($check["jam_selesai"] == "on") ? 'checked': ''; ?>>
                  <label class="custom-control-label">Jam Selesai</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="jenis_kls_tambahan" <?= ($check["jenis_kls_tambahan"] == "on") ? 'checked': ''; ?>>
                  <label class="custom-control-label">Jenis Ekstrakulikuler</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="tempat" <?= ($check["tempat"] == "on") ? 'checked': ''; ?>>
                  <label class="custom-control-label">Tempat</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="pembimbing" <?= ($check["pembimbing"] == "on") ? 'checked': ''; ?>>
                  <label class="custom-control-label">Pembimbing</label>
                </div>
                <br/>
                <input type="submit" class="btn" value="kirim">
              </form>
            </div>
            <!-- /.box-body -->
          </div>                    
        </div> 


        <!-- TAB CONETENT -->
      </div>

    </div>
  </div>
  <!-- /.tab-content -->
</div>
</section>
<!-- /.nav-tabs-custom -->
</div>

<div id="modal_tambah_eskul" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?php echo site_url('kurikulum/tambah_jenis_kls_tambahan'); ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Ekstrakulikuler</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="jenis_kls_tambahan" class="form-control" placeholder="Nama ekstrakulikuler">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modal_edit_eskul" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" action="<?php echo site_url('kurikulum/edit_jenis_kls_tambahan'); ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Ekstrakulikuler</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id_kls_tambahan" id="id_kls_tambahan" class="form-control">
            <input type="text" name="jenis_kls_tambahan" id="jenis_kls_tambahan" class="form-control" placeholder="Nama ekstrakulikuler">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modal_edit_jadwal_eskul" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" class="form-horizontal" action="<?php echo site_url('kurikulum/simpanjadwalekskul'); ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Jadwal Ekstrakulikuler</h4>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id_jadwal_ekskul" value="" id="modal_id_jadwal_eskul">
          <div class="form-group formgrup jarakform">
            <label class="col-sm-2 control-label">Hari</label>
            <div class="col-sm-8">
              <select required="required" class="form-control" name="hari" value="<?php echo $row_jadwalekskul->hari; ?>">
                <option value="">Pilih Hari</option>
                <option value="Senin" id="Senin"> Senin </option>
                <option value="Selasa" id="Selasa"> Selasa </option>
                <option value="Rabu" id="Rabu"> Rabu </option>
                <option value="Kamis" id="Kamis"> Kamis </option>
                <option value="Jumat" id="Jumat"> Jumat</option>
                <option value="Sabtu" id="Sabtu"> Sabtu </option>
                <option value="Minggu" id="Minggu"> Minggu </option>    
              </select>
            </div>
          </div>

          <div class="bigbox-mapel"> 
            <div class="box-mapel">
              <div class="form-group formgrup jarakform">
                <label for="modal_jam_mulai" class="col-sm-2 control-label">Jam Mulai</label>
                <div class="col-sm-8">
                  <input type="time" class="form-control" id="modal_jam_mulai" name="jam_mulai" placeholder="Waktu" value="<?php echo @$edit_jadwalekskul->jam_mulai; ?>">
                </div>
              </div>
              <div class="form-group formgrup jarakform">
                <label for="modal_jam_selesai" class="col-sm-2 control-label">Jam Selesai</label>
                <div class="col-sm-8">
                  <input type="time" class="form-control" id="modal_jam_selesai" name="jam_selesai" placeholder="Waktu" value="<?php echo @$edit_jadwalekskul->jam_selesai; ?>">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group formgrup jarakform">
            <label class="col-sm-2 control-label">Jenis Ekstrakurikuler</label>
            <div class="col-sm-8">
              <select class="form-control" name="id_jenis_kls_tambahan" id="kelas1" onchange="fetch_select_ekskul(this.value, 'ekskul1');">
                <option value="">Pilih Ekskul</option>
                <?php
                foreach ($tabel_jenisklstambahan as $row_jenisklstambahan) { ?>
                  <option value="<?php echo $row_jenisklstambahan->id_jenis_kls_tambahan; ?>" id="modal_<?php echo preg_replace('/\s+/', '', $row_jenisklstambahan->jenis_kls_tambahan); ?>"><?php echo $row_jenisklstambahan->jenis_kls_tambahan; ?></option><?php
                } ?>
              </select>
            </div>
          </div>

          <div class="bigbox-mapel"> 
            <div class="box-mapel">
              <div class="form-group formgrup jarakform">
                <label for="modal_tempat" class="col-sm-2 control-label">Tempat</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="modal_tempat" name="tempat" placeholder="tempat" value="<?php echo @$edit_jadwalekskul->tempat; ?>">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group formgrup jarakform">
            <label class="col-sm-2 control-label">Pembimbing</label>
            <div class="col-sm-8">
              <select class="form-control" name="id_pembimbing">
                <option value="">Pilih Pembimbing</option>
                <?php
                foreach ($tabel_pembimbing as $row_pembimbing) { ?>
                  <option value="<?php echo $row_pembimbing->id_pembimbing; ?>" id="modal_<?php echo preg_replace('/\s+/', '', $row_pembimbing->nama_pembimbing); ?>"><?php echo $row_pembimbing->nama_pembimbing; ?></option> <?php
                }?>
              </select>
            </div>
          </div>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $("#tambah_eskul_trigger").click(function() {
      $("#modal_tambah_eskul").modal('show')
    })

    $(".edit_eskul_trigger").click(function() {
      var id = $(this).attr('id_eskul')
      var name = $(this).attr('name_eskul')

      $("#id_kls_tambahan").val(id)
      $("#jenis_kls_tambahan").val(name)
      $("#modal_edit_eskul").modal('show')
    })

    $(".edit_jadwal_eskul_trigger").click(function() {
      var id_jadwal_eskul = $(this).attr('id_jadwal_eskul')
      var hari = $(this).attr('hari')
      var jam_mulai = $(this).attr('jam_mulai')
      var jam_selesai = $(this).attr('jam_selesai')
      var jenis_eskul = $(this).attr('jenis_eskul')
      var tempat = $(this).attr('tempat')
      var pembimbing = $(this).attr('pembimbing')

      $("#modal_id_jadwal_eskul").val(id_jadwal_eskul)
      $(`#${hari}`).attr('selected', true)
      $("#modal_jam_mulai").val(jam_mulai)
      $("#modal_jam_selesai").val(jam_selesai)
      $("#modal_tempat").val(tempat)
      $(`#modal_${jenis_eskul}`).attr('selected', true)
      $(`#modal_${pembimbing}`).attr('selected', true)  
      $("#modal_edit_jadwal_eskul").modal('show')
    })
  })
</script>
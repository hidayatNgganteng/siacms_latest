<script type="text/javascript">
  function fetch_select_mapel(val, cmb)
  {
   $('#'+cmb).html('<option value="">Please Wait ... </option>');
   $.ajax({
     type: 'post',
     url: '<?php echo site_url('kurikulum/getmapelkelastambahan'); ?>',
     //data: 'nama=' + jsnama + '&instansi=' + jsinstansi + '&hp=' + jshp  + '&email=' + jsemail,
     data: {
       id:val
     },
     success: function (response) {
       document.getElementById('#'+cmb).innerHTML=response; 
     }
   });
 } 
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <center style="color:navy;">Jadwal Tambahan<br></center>
      <!-- <center><small>Tahun Ajaran 2016-2017</small></center> -->
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
            <li class="active"><a href="#datajadwaltambahan" data-toggle="tab">Data Jadwal Tambahan</a></li>    
            <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
              <li><a class = "active" href="#kelolajadwaltambahan" data-toggle="tab"><?php if (@$edit_jadwaltambahan) { echo "Edit"; } else { echo "Tambah"; } ?> Jadwal Tambahan</a></li>
            <?php endif ?>          
            <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
            <li class=""><a href="#pengaturanjadwaltambahan" data-toggle="tab">Pengaturan</a></li>
            <?php endif ?>         
          </ul>
          <div class="tab-content">


            <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
              <div class="tab-pane" id="pengaturanjadwaltambahan">
                <div class="box">
                 <div class="box-header">
                   <h3 class="text-center">Pengaturan Jadwal Tambahan</h3>
                   <p class="text-center">Berikan tanda centang pada atribut formulir yang ingin di isi.</p>
                 </div>
                 <hr>
                 <div style="padding:20px;">                
                  <form action="<?= site_url('kurikulum/pengaturan_jadwaltambahan') ?>" method="POST">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" checked disabled>
                      <input type="checkbox" class="custom-control-input" name="no" checked hidden>
                      <label class="custom-control-label">Nomor</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="tanggal" <?= ($check["tanggal"] == "on") ? 'checked': ''; ?>>
                      <label class="custom-control-label">Tanggal</label>
                    </div>                             
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="kelas" <?= ($check["kelas"] == "on") ? 'checked': ''; ?>>
                      <label class="custom-control-label">Kelas</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="mapel" <?= ($check["mapel"] == "on") ? 'checked': ''; ?>>
                      <label class="custom-control-label">Mata Pelajaran</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="guru" <?= ($check["guru"] == "on") ? 'checked': ''; ?>>
                      <label class="custom-control-label">Guru</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" name="jam_mulai_selesai" <?= ($check["jam_mulai_selesai"] == "on") ? 'checked': ''; ?>>
                      <label class="custom-control-label">Jam Mulai & Selesai</label>
                    </div>
                    <br/>
                    <input type="submit" class="btn" value="kirim">
                  </form>
                </div>
              </div>
            </div>


            

            <!-- /.tab-pane -->
            <div class="tab-pane" id="kelolajadwaltambahan">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                  <form method="post" action="<?php echo site_url('kurikulum/simpanjadwaltambahan'); ?>">
                    <input type="hidden" name="id_jadwal_tambahan" value="<?php echo @$edit_jadwaltambahan->id_jadwal_tambahan; ?>">
                    <table id="example1" class="table tabelmapel" style="border: 0;">

                      <tbody style="border: 0;">

                        <?php if($check['tanggal'] == 'on'): ?>
                          <tr>
                            <th>Tanggal</th>
                            <th><input class="form-control" type="date" name="tgl_tambahan" placeholder="Tanggal pelaksaan les" value="<?php echo @$edit_jadwaltambahan->tgl_tambahan; ?>"></th>
                          </tr>
                        <?php endif; ?>
                        <?php if($check['kelas'] == 'on'): ?>
                          <tr>
                            <th>Kelas</th>
                            <th>
                              <?php 
                              foreach(kelas_reguler() as $kl) :
                                if(isset($edit_jadwaltambahan) && $kl->id_kelas_reguler == $edit_jadwaltambahan->id_kelas_tambahan) :
                                  ?>
                                  <input type="radio" name="id_kelas_tambahan" value="<?= $kl->id_kelas_reguler; ?>" checked="checked">
                                  <label><?= $kl->nama_kelas; ?></label>
                                  <?php else : ?>
                                    <input type="radio" name="id_kelas_tambahan" value="<?= $kl->id_kelas_reguler; ?>">
                                    <label><?= $kl->nama_kelas; ?></label>
                                    <?php 

                                  endif;
                                endforeach;
                              else:

                                foreach(kelas_reguler() as $kl) :
                                  ?>
                                  <input type="radio" name="id_kelas_tambahan" value="<?= $kl->id_kelas_reguler; ?>" >
                                  <label><?= $kl->nama_kelas; ?></label>
                                  <?php 
                                endforeach; 
                                ?>
                                
                              </th>
                            </tr>
                          <?php endif; ?>
                          <?php if($check['mapel'] == 'on'): ?>
                            <tr>
                              <th>Mata Pelajaran</th>
                              <?php
                              function kelas_tambahan() {
                                $ci =& get_instance();
                                return $ci->db->get('kelas_reguler')->result();
                              }
                              ?>
                              <th>
                                <select class="kodemapel form-control" name="id_namamapel">
                                  <option value="">Pilih Mapel</option>
                                  <?php
                                  foreach ($tabel_namamapel as $row_namamapel) {
                                    ?>
                                    <option value="<?php echo $row_namamapel->id_namamapel; ?>" <?php if (@$edit_jadwaltambahan->id_namamapel == $row_namamapel->id_namamapel) { echo " selected"; } ?>><?php echo $row_namamapel->nama_mapel; ?></option> 
                                    <?php
                                  }
                                  ?>
                                </select> 
                              </th>
                            </tr>
                          <?php endif; ?>
                          <?php if($check['guru'] == 'on'): ?>
                            <tr>
                              <th>Guru</th>
                              <th>
                                <select class="kodeguru form-control" name="NIP">
                                  <option value="">Pilih Guru</option>
                                  <?php
                                  foreach ($tabel_pegawai as $row_pegawai) {
                                    ?>
                                    <option value="<?php echo $row_pegawai->NIP; ?>"  <?php if (@$edit_jadwaltambahan->NIP == $row_pegawai->NIP) { echo " selected"; } ?>><?php echo $row_pegawai->kode_guru; ?>. <?php echo $row_pegawai->nama_panggilan; ?></option>
                                    <?php
                                  }
                                  ?>
                                </select>
                              </th>
                            </tr>
                          <?php endif; ?>
                          <?php if($check['jam_mulai_selesai'] == 'on'): ?>
                            <tr>
                              <th>Jam Mulai</th>
                              <th><input type="time" class="form-control" name="jam_mulai" placeholder="Waktu" value="<?php echo @$edit_jadwaltambahan->jam_mulai; ?>"></th>
                            </tr>
                            <tr>
                              <th>Jam Selesai</th>
                              <th><input type="time" class="form-control" name="jam_selesai" placeholder="Waktu" value="<?php echo @$edit_jadwaltambahan->jam_selesai; ?>"></th>
                            </tr>
                          <?php endif; ?>
                        </tbody>

                      </table>
                      <button class="btn btn-danger" type="submit">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php endif ?>


            <!-- DATA MAPEL KELAS 7 -->
            <div class="tab-pane active" id="datajadwaltambahan">
              <div> <?php echo $this->session->flashdata('warning') ?></div>
              <div class="box">
                <div class="box-header" style="background-color:     #5c8a8a">
                  <h3 class="box-title" style="color:white">Data Jadwal Tambahan </h3>
                </div>
                <!-- /.box-header -->

                <?php
                function tgl_indo($tanggal) {
                  $tgl = substr($tanggal, 8, 2);
                  $bln = substr($tanggal, 5, 2);
                  $thn = substr($tanggal, 0, 4);
                  if ($bln == "1") { $bulan = "Januari"; } 
                  if ($bln == "2") { $bulan = "Februari"; } 
                  if ($bln == "3") { $bulan = "Maret"; } 
                  if ($bln == "4") { $bulan = "April"; } 
                  if ($bln == "5") { $bulan = "Mei"; } 
                  if ($bln == "6") { $bulan = "Juni"; } 
                  if ($bln == "7") { $bulan = "Juli"; } 
                  if ($bln == "8") { $bulan = "Agustus"; } 
                  if ($bln == "9") { $bulan = "September"; } 
                  if ($bln == "10") { $bulan = "Oktober"; } 
                  if ($bln == "11") { $bulan = "November"; } 
                  if ($bln == "12") { $bulan = "Desember"; } 
                  return $tgl." ".$bulan." ".$thn;
                }
                ?>
                <?php
                function kelas_reguler() {
                  $ci =& get_instance();
                  return $ci->db->get('kelas_reguler')->result();
                }
                ?>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="fit">No</th>
                        <?php if($check['tanggal'] == 'on'): ?>
                          <th>Tanggal</th>
                        <?php endif; ?>
                        <?php if($check['kelas'] == 'on'): ?>
                          <th>Kelas</th>
                        <?php endif; ?>
                        <?php if($check['mapel'] == 'on'): ?>
                          <th>Mata Pelajaran</th>
                        <?php endif; ?>
                        <?php if($check['guru'] == 'on'): ?>
                          <th>Guru</th>
                        <?php endif; ?>
                        <?php if($check['jam_mulai_selesai'] == 'on'): ?>
                          <th>Jam Mulai</th>
                          <th>Jam Selesai</th>
                        <?php endif; ?>
                        <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
                          <th>Action</th>
                        <?php endif ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i=0;
                      foreach ($tabel_jadwaltambahan as $row_jadwaltambahan) {
                        $i++; 
                        ?>
                        <tr>
                          <td class="fit"><?php echo $i; ?></td>
                          <?php if($check['tanggal'] == 'on'): ?>
                            <th><?php echo tgl_indo($row_jadwaltambahan->tgl_tambahan); ?></th>
                          <?php endif; ?>
                          
                          <?php if($check['kelas'] == 'on'): ?>
                            <th>
                              <?php 
                              foreach(kelas_reguler() as $kr){
                                if($row_jadwaltambahan->id_kelas_tambahan == $kr->id_kelas_reguler) {
                                  echo $kr->nama_kelas;
                                }
                              }
                              ?>
                            </th>
                          <?php endif; ?>
                          <?php if($check['mapel'] == 'on'): ?>
                            <th><?php echo $row_jadwaltambahan->nama_mapel; ?></th>
                          <?php endif; ?>
                          <?php if($check['guru'] == 'on'): ?>
                            <th><?php echo $row_jadwaltambahan->Nama; ?></th>
                          <?php endif; ?>
                          <?php if($check['jam_mulai_selesai'] == 'on'): ?>
                            <th><?php echo substr($row_jadwaltambahan->jam_mulai, 0, 5); ?></th>
                            <th><?php echo substr($row_jadwaltambahan->jam_selesai, 0, 5); ?></th>
                          <?php endif; ?>
                          <?php if($this->session->userdata('jabatan') != 'Guru') : ?>
                            <td> 
                              
                              <button
                              class="btn btn-danger btn-dark-blue btnedit block"
                              
                              tgl_tambahan="<?php echo $row_jadwaltambahan->tgl_tambahan; ?>"
                              id_kelas_tambahan="<?php echo $row_jadwaltambahan->id_kelas_tambahan; ?>"
                              jam_mulai="<?php echo $row_jadwaltambahan->jam_mulai; ?>"
                              jam_selesai="<?php echo $row_jadwaltambahan->jam_selesai; ?>"
                              id_jadwal_tambahan="<?php echo $row_jadwaltambahan->id_jadwal_tambahan; ?>"
                              id_namamapel="<?php echo $row_jadwaltambahan->id_namamapel; ?>"
                              NIP="<?php echo $row_jadwaltambahan->NIP; ?>"
                              >
                              Edit
                            </button>

                            <a onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger btn-primary button-action btnhapus" href="<?php echo site_url('kurikulum/hapusjadwaltambahan/'.$row_jadwaltambahan->id_jadwal_tambahan); ?>" > Hapus </a>
                          </td>
                        <?php endif ?>
                      </tr>
                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div> 
          </div>
        </div>

      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
</section>
</div>
<!-- /.row (main row) -->
<!-- modal -->


<div id="modal_edit" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" class="form-horizontal" action="<?php echo site_url('kurikulum/simpanjadwaltambahan'); ?>">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Jadwal Tambahan</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_jadwal_tambahan" value="" id="modal_id_jadwal_tambahan">
          <table id="example1" class="table tabelmapel" style="border: 0;">

            <tbody style="border: 0;">

              <?php if($check['tanggal'] == 'on'): ?>
                <tr>
                  <th>Tanggal</th>
                  <th><input class="form-control" type="date" name="tgl_tambahan" id="modal_tgl_tambahan" placeholder="Tanggal pelaksaan les" ></th>
                </tr>
              <?php endif; ?>
              <?php if($check['kelas'] == 'on'): ?>
                <tr>
                  <th>Kelas</th>
                  <th>
                    <?php 
                    foreach(kelas_reguler() as $kl) :
                      ?>
                      <input type="radio" name="id_kelas_tambahan" id="modal_kelas_<?= $kl->id_kelas_reguler; ?>" value="<?= $kl->id_kelas_reguler; ?>"  >
                      <label><?= $kl->nama_kelas; ?></label>
                      <?php 
                    endforeach; 
                    ?>                    
                  </th>
                </tr>
              <?php endif; ?>
              <?php if($check['mapel'] == 'on'): ?>
                <tr>
                  <th>Mata Pelajaran</th>                 
                  <th>
                    <select class="kodemapel form-control" name="id_namamapel" id="modal_id_namamapel">
                      <option value="">Pilih Mapel</option>
                      <?php
                      foreach ($tabel_namamapel as $row_namamapel) {
                        ?>
                        <option value="<?php echo $row_namamapel->id_namamapel; ?>" id="modal_mapel_<?php echo $row_namamapel->id_namamapel; ?>">
                          <?php echo $row_namamapel->nama_mapel; ?></option> 
                          <?php
                        }
                        ?>
                      </select> 
                    </th>
                  </tr>
                <?php endif; ?>
                <?php if($check['guru'] == 'on'): ?>
                  <tr>
                    <th>Guru</th>
                    <th>
                      <select class="kodeguru form-control" name="NIP" id="modal_NIP">
                        <option value="">Pilih Guru</option>
                        <?php
                        foreach ($tabel_pegawai as $row_pegawai) {
                          ?>
                         <option value="<?php echo $row_pegawai->NIP; ?>" id="modal_nip_<?php echo $row_pegawai->NIP; ?>" > <?php echo $row_pegawai->kode_guru; ?> - <?php echo $row_pegawai->nama_panggilan; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </th>
                  </tr>
                <?php endif; ?>
                <?php if($check['jam_mulai_selesai'] == 'on'): ?>
                  <tr>
                    <th>Jam Mulai</th>
                    <th><input type="time" class="form-control" name="jam_mulai" placeholder="Waktu" id="modal_jam_mulai" ></th>
                  </tr>
                  <tr>
                    <th>Jam Selesai</th>
                    <th><input type="time" class="form-control" name="jam_selesai" placeholder="Waktu" id="modal_jam_selesai" ></th>
                  </tr>
                <?php endif; ?>
              </tbody>

            </table>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){

      $(".btnedit").click(function() {
        var id_jadwal_tambahan = $(this).attr('id_jadwal_tambahan')
        var tgl_tambahan = $(this).attr('tgl_tambahan')
        
        var id_kelas_tambahan = $(this).attr('id_kelas_tambahan')
        var jam_mulai = $(this).attr('jam_mulai')
        var jam_selesai = $(this).attr('jam_selesai')

        var id_namamapel = $(this).attr('id_namamapel')
        var NIP = $(this).attr('NIP')

        $("#modal_id_jadwal_tambahan").val(id_jadwal_tambahan)
        $("#modal_tgl_tambahan").val(tgl_tambahan)
        
        $("#modal_jam_mulai").val(jam_mulai)
        $("#modal_jam_selesai").val(jam_selesai)

        $("#modal_kelas_"+id_kelas_tambahan).attr('checked', true)
        
        $("#modal_nip_"+NIP).attr('selected', true)
        $("#modal_mapel_"+id_namamapel).attr('selected', true)
        
        
        $("#modal_edit").modal('show')
      })
    });
  </script>

<!-- /.tab-pane -->

<!-- ==================================================== START TAB DATA MENGAJAR -->
<div class="tab-pane <?php echo $this->session->flashdata('tab_loc') == 2 ? 'active' : '' ?>" id="kelolajammengajar">
  <div> <?php echo $this->session->flashdata('warning') ?></div>
  <div class="box formmapel" style="padding: 1.5em;">

    <!-- /.box-header -->
    <div class="box-body">
      <div>
        <!-- <div class="box-header jarakbox" style="overflow: auto"> -->

          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th >No.</th>
                <th >Nama</th>
                <th >NIP</th>
                <!-- <th >Kode Guru</th> -->
                <th >Golongan</th>
                <th >Jabatan</th>
                <th >Ijazah</th>
                <th >Mata pelajaran</th>
                <th >Jam Mengajar per Minggu</th>
                <!-- <th ><center>Jumlah jam</center></th> -->
                <th >Action</th>

              </tr>
            </thead>
            <tbody>
              <?php
              $i=0;
              foreach ($tabel_jammengajar as $row_jammengajar) {
                $i++;
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row_jammengajar->Nama; ?></td>
                  <td><?php echo $row_jammengajar->NIP; ?></td>
                  <!-- <td><?php echo $row_jammengajar->kode_guru; ?></td> -->
                  <td><?php echo $row_jammengajar->Golongan; ?></td>
                  <td><?php echo $row_jammengajar->pangkat; ?></td>
                  <td><?php echo $row_jammengajar->Pendidikan; ?></td>
                  <td><?php echo $row_jammengajar->nama_mapel; ?></td>
                  <td><?php echo $row_jammengajar->jatah_minim_mgjr; ?></td>
                  <!-- <td><?php echo substr($total_durasi[$row_jammengajar->id_jam_mgjr], 0, 5); ?></td> -->
                  <td>
                    <button
                    class="btn btn-danger btn-dark-blue edit_jam_mengajar_trigger"
                    data_id="<?php echo $row_jammengajar->id_jam_mgjr; ?>"
                    data_nip="<?php echo $row_jammengajar->NIP; ?>"
                    data_nama_mapel="<?php echo preg_replace('/\s+/', '', $row_jammengajar->id_namamapel); ?>"
                    data_minim_mengajar="<?php echo $row_jammengajar->jatah_minim_mgjr	; ?>">
                    Edit
                  </button>
                  <a onclick="return confirm('Apakah Anda yakin?')" href="<?php echo site_url('kurikulum/hapusjammengajar/'.$row_jammengajar->id_jam_mgjr); ?>" class="btn btn-danger">Hapus</a>
                </td>

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
<!-- ==================================================== START TAB DATA MENGAJAR -->
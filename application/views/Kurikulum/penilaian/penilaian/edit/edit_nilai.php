<html>
<body>
  <div class="modal-dialog " >

    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <center style="font-size: 20px"><b>Ubah Nilai Siswa</b></center> <br>
   </div>
   <div class="modal-content"> 
    <form class="form-horizontal formgrup" action="<?php echo base_url('penilaian/penilaian/ubah_nilai/'.$f->id_nilai_siswa); ?>" method="post" >
      <div style="padding-left: 130px;" > 
        <div class="box-mapel">

          <div class="form-group formgrup jarakform">
            <input type="hidden" name="nisn" value="<?php echo $f->nisn ?>">
            <input type="hidden" name="katnilai" value="<?php echo $f->kategori_nilai_id ?>">
            <input type="hidden" name="jenis_na" value="<?php echo $f->jenis_na_id ?>">
            <input type="hidden" name="mapel" value="<?php echo $f->mapel_id ?>">
            <input type="hidden" name="id" value="<?php echo $f->id_nilai_siswa; ?>"> 

          </div> 

          <div class="form-group formgrup jarakform">
            <label for="bts_a" class="col-sm-2 control-label">NISN</label>
            <div class="col-sm-4">
              <input type="text" name="nisn" class="form-control"  value="<?php echo $f->nisn ; ?>" readonly>
            </div>
          </div>
          <br>
          <div class="form-group formgrup jarakform">
            <label for="nilai" class="col-sm-2 control-label">Nilai</label>
            <div class="col-sm-4">
              <input type="text" name="nilai" class="form-control"  value="<?php echo $f->Nilai_siswa ; ?>">
            </div>
          </div> 
        </div>
        <div class="modal-footer">
          <div class="">
            <div class="col-sm-offset-2 col-sm-10">
              <button class="btn btn-success" type="submit">Submit</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div> 

</body>
</html>


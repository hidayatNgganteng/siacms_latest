<?php
class Cetak extends CI_Controller{
	function __construct(){
	    parent::__construct();
	    $this->load->model('penilaian/M_data'); 
	  }

	 function printkaldik(){
	    $kaldik = $this->M_data->getkaldik('2018-01-01', '2018-12-31');
	    $tanggallibur = $this->M_data->gettanggallibur('2018-01-01', '2018-12-31');
	    foreach ($kaldik as $rowkaldik) {
	      $awal = strtotime($rowkaldik->tgl_awal);
	      $akhir = strtotime($rowkaldik->tgl_akhir);
	      $tgl = $awal;
	      $i = 0;
	      while ($tgl <= $akhir) {
	        $libur[date('Y', $tgl)][ltrim(date('m', $tgl), "0")][ltrim(date('d', $tgl), "0")] = $rowkaldik->nama_kaldik;
	        $simbol[date('Y', $tgl)][ltrim(date('m', $tgl), "0")][ltrim(date('d', $tgl), "0")] = $rowkaldik->simbol_kaldik;
	        $tgl = $tgl + (60 * 60 * 24);
	        $i++;
	        if ($i>1000) { break; }
	      }
	    }

	    foreach ($tanggallibur as $rowtanggallibur) {
	      $awal = strtotime($rowtanggallibur->tanggal_awal);
	      $akhir = strtotime($rowtanggallibur->tanggal_akhir);
	      $tgl = $awal;
	      $i = 0;
	      while ($tgl <= $akhir) {
	        $libur[date('Y', $tgl)][ltrim(date('m', $tgl), "0")][ltrim(date('d', $tgl), "0")] = $rowtanggallibur->nama_libur;
	        $simbol[date('Y', $tgl)][ltrim(date('m', $tgl), "0")][ltrim(date('d', $tgl), "0")] = 'libur_nasional.png';
	        $tgl = $tgl + (60 * 60 * 24);
	        $i++;
	        if ($i>1000) { 
				break; 
			}
	      }
		}		

	    $data['libur'] = $libur;
	    $data['simbol'] = $simbol;
		$data['kaldik'] = $kaldik;
		
	    $this->load->view('kurikulum/penilaian/KBM/printkaldik', $data);

	  }
}
?>
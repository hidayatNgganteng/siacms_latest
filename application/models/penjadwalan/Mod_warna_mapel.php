<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mod_warna_mapel extends CI_Model {
	public function get(){
		return $this->db->get('warna_mapel')->result();
	}
	public function insert($data){
		$this->db->insert('warna_mapel', $data);
	}
	public function delete($id) {
		$this->db->where('id',$id);
		$this->db->delete('warna_mapel');
	}
	public function select($id) {
		$this->db->where('id',$id); 
		return $this->db->get('warna_mapel')->row();
	}
	public function update($data, $id) {
		$this->db->where('id',$id); 
		$this->db->update('warna_mapel', $data);		
	}
}

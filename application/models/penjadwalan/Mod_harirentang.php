<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mod_harirentang extends CI_Model
{

    public function get($where = array(), $order = "hari asc, jam_ke asc")
    {
        $this->db->where($where);
        $this->db->order_by($order);
        return $this->db->get('hari_rentang')->result();
    }

    public function insert($data)
    {
        $this->db->insert('hari_rentang', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_rentang_jam', $id);
        $this->db->delete('hari_rentang');
    }

    public function select($id)
    {
        $this->db->where('id_rentang_jam', $id);
        return $this->db->get('hari_rentang')->row();
    }

    public function update($data, $id)
    {
        $this->db->where('id_rentang_jam', $id);
        $this->db->update('hari_rentang', $data);
    }

    public function deleteAll($id_tahun_ajaran, $hari)
    {
        $this->db->where('id_tahun_ajaran', $id_tahun_ajaran);
        $this->db->where('hari', $hari);
        $this->db->delete('hari_rentang');
    }

    public function selectdata($hari, $jam_ke, $thn_ajaran = 0)
    {
        $this->db->where('hari', $hari);
        $this->db->where('jam_ke', $jam_ke);
        if ($thn_ajaran != 0) {
            $this->db->where('id_tahun_ajaran', $thn_ajaran);
        }
        return $this->db->get('hari_rentang')->row();
    }

    public function getbyTahunDanHari($idTahun, $hari)
    {
		$array = array('hari' => $hari, 'id_tahun_ajaran' => $idTahun);
		
        $this->db->where($array);
        return $this->db->get('hari_rentang')->result();
    }
}

<?php

class Mod_pengaturan_presensi extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
            // Your own constructor code
    }

    function update($data)
    {
        $masak = [];
        $skema = $this->db->list_fields('pengaturan_presensi');
        foreach ($skema as $key) {
            $masak[$key] = "off";
        }
        foreach ($data as $key => $value) {
            $masak[$key] = $value;
        }
        $this->db->truncate("pengaturan_presensi");
        $this->db->insert("pengaturan_presensi", $masak);
    }

    function get_check(){
        $data = $this->db->get('pengaturan_presensi')->result_array();
        if(empty($data)) {
            $skema = $this->db->list_fields('pengaturan_presensi');
            $masak = [];
            foreach ($skema as $key) {
                $masak[$key] = "off";
            }
            return $masak;
        }
        return $data[0];
    }
}
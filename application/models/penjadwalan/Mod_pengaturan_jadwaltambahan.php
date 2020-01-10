<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_pengaturan_jadwaltambahan extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
            // Your own constructor code
    }

    function update($data)
    {
        $masak = [];
        $skema = $this->db->list_fields('pengaturan_jadwaltambahan');
        foreach ($skema as $key) {
            $masak[$key] = "off";
        }
        foreach ($data as $key => $value) {
            $masak[$key] = $value;
        }
        $this->db->truncate("pengaturan_jadwaltambahan");
        $this->db->insert("pengaturan_jadwaltambahan", $masak);
    }

    function get_check(){
        $data = $this->db->get('pengaturan_jadwaltambahan')->result_array();
        if(empty($data)) {
            $skema = $this->db->list_fields('pengaturan_jadwaltambahan');
            $masak = [];
            foreach ($skema as $key) {
                $masak[$key] = "off";
            }
            return $masak;
        }
        return $data[0];
    }
	
}

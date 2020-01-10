<?php

class Mod_pengaturan_jadwalpiketguru extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
            // Your own constructor code
    }

    function update($data)
    {
        $masak = [];
        $skema = $this->db->list_fields('pengaturan_jadwalpiketguru');
        foreach ($skema as $key) {
            $masak[$key] = "off";
        }
        foreach ($data as $key => $value) {
            $masak[$key] = $value;
        }
        $this->db->truncate("pengaturan_jadwalpiketguru");
        $this->db->insert("pengaturan_jadwalpiketguru", $masak);
    }

    function get_check(){
        $data = $this->db->get('pengaturan_jadwalpiketguru')->result_array();
        if(empty($data)) {
            $skema = $this->db->list_fields('pengaturan_jadwalpiketguru');
            $masak = [];
            foreach ($skema as $key) {
                $masak[$key] = "off";
            }
            return $masak;
        }
        return $data[0];
    }
}
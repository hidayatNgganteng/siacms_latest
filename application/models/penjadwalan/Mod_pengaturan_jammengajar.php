<?php

class Mod_pengaturan_jammengajar extends CI_Model {

    public function __construct()
    {
            parent::__construct();
            $this->load->database();
            // Your own constructor code
    }

    function update($data)
    {
        $masak = [];
        $skema = $this->db->list_fields('pengaturan_jammengajar');
        foreach ($skema as $key) {
            $masak[$key] = "off";
        }
        foreach ($data as $key => $value) {
            $masak[$key] = $value;
        }
        $this->db->truncate("pengaturan_jammengajar");
        $this->db->insert("pengaturan_jammengajar", $masak);
    }

    function get_check(){
        $data = $this->db->get('pengaturan_jammengajar')->result_array();
        if(empty($data)) {

            $skema = $this->db->list_fields('pengaturan_jammengajar');
            $masak = [];
            foreach ($skema as $key) {
                $masak[$key] = "off";
            }
            return $masak;
        }
        return $data[0];
    }
}
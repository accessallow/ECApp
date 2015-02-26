<?php

class Key_value_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_value($key){
        $q = $this->db->get_where('values',array(
           'vkey' => $key 
        ));
        $q = $q->result();
        if($q == null) {return false;}
        else{
            $q = $q[0];
            return $q->value;
        }
    }
    public function set_value($key,$value){
        $q = $this->db->get_where('values',array(
           'vkey' => $key 
        ));
        $q = $q->result();
        if($q == null) {
            $this->db->insert('values',array(
                'vkey' => $key,
                'value' => $value
            ));
        }
        else{
           $this->db->update('values',array(
               'value' => $value
           ),array(
               'vkey' => $key
           ));
        }
    }
}
<?php

class Bill_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all($id = null) {
        $query = null;
        if ($id) {
            $query = $this->db->get_where('bills', array(
                'tag' => 1,
                'id' => $id
            ));
        } else {
            $query = $this->db->get_where('bills', array(
                'tag' => 1
            ));
        }
        return $query->result();
    }

    public function add_new($bill) {
        $bill['tag'] = 1;
        $this->db->insert('bills', $bill);
    }

    public function update($id, $bill) {
        $bill['tag'] = 1;
        $this->db->update('bills', $bill, array(
            'id' => $id
        ));
    }

    public function delete($id) {
        $this->db->update('bills', array(
            'tag' => 0
                ), array(
            'id' => $id
        ));
    }

    public function sum_bills($field_name,$whereArray) {
        $this->db->select_sum($field_name);
        $query = $this->db->get_where('bills',$whereArray);
        $q = $query->result();
        return $q[0];
    }
    function count_bills($whereArray) {
        $this->db->where($whereArray);
        $this->db->from('bills');
        $q = $this->db->count_all_results();

        return $q;
    }

}

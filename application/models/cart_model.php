<?php

class Cart_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if ($this->session->userdata('list1') == null) {
            $this->session->set_userdata('list1', array());
        }
        if ($this->session->userdata('list2') == null) {
            $this->session->set_userdata('list2', array());
        }
    }
    public function cart1_products(){
        $this->load->database();
        $list1 = $this->session->userdata('list1');
        $where_clause = "(";
        $first = true;
        foreach($list1 as $l){
            if($first){
                $where_clause = $where_clause."".$l;
                $first = false;
            }else{
                $where_clause = $where_clause.",".$l;
            }
            
        }
        $where_clause = $where_clause.")";
        $q = $this->db->query("select * from products where id in $where_clause;");
        $q = $q->result();
        return $q;
    }

    public function clear_cart1() {
        $this->session->unset_userdata('list1');
    }

    public function clear_cart2() {
        $this->session->unset_userdata('list2');
    }

    public function add_product_to_cart1($product_id) {
        $list1 = $this->session->userdata('list1');
        $list1[] = $product_id;
        $this->session->set_userdata('list1', $list1);
    }

    public function is_already_inside($product_id) {
        $list1 = $this->session->userdata('list1');
        foreach ($list1 as $l) {
            if ($l == $product_id) {
                return true;
            }
        }
        return false;
    }

    function get_index_from_list1($product_id) {
        $list1 = $this->session->userdata('list1');
        $i = 0;
        foreach ($list1 as $l) {
            if ($l == $product_id) {
                return $i;
            }
            $i++;
        }
        return null;
    }

    function get_index_from_list2($product_id) {
        $list2 = $this->session->userdata('list2');
        $i = 0;
        foreach ($list2 as $l) {
            if ($l['product_id'] == $product_id) {
                return $i;
            }
            $i++;
        }
        return null;
    }

    public function is_already_inside_cart2($product_id) {
        $list2 = $this->session->userdata('list2');
        foreach ($list2 as $l) {
            if ($l['product_id'] == $product_id) {
                return true;
            }
        }
        return false;
    }

    public function remove_from_cart1($product_id) {
        if ($this->is_already_inside($product_id) == true) {
            $list1 = $this->session->userdata('list1');
            unset($list1[$this->get_index_from_list1($product_id)]);
            $this->session->set_userdata('list1', $list1);
        }
    }

    public function remove_from_cart2($product_id) {
        if ($this->is_already_inside_cart2($product_id) == true) {
            $list2 = $this->session->userdata('list2');
            unset($list2[$this->get_index_from_list2($product_id)]);
            $this->session->set_userdata('list2', $list2);
        }
    }

    public function add_product_to_cart2($product_id, $rate, $quantity, $total) {
        $product_data = array(
            'product_id' => $product_id,
            'rate' => $rate,
            'quantity' => $quantity,
            'total' => $total
        );
        $list2 = $this->session->userdata('list2');
        $list2[] = $product_data;
        $this->session->set_userdata('list2', $list2);
    }

    public function get_first_list() {
        return $this->session->userdata('list1');
    }

    public function get_second_list() {
        return $this->session->userdata('list2');
    }

}

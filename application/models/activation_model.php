<?php

class Activation_model extends CI_Model {

    var $a_p = null; //product_code
    var $a_k = null; //activation_key
    var $a_c = null; //counter
    var $a_t = null; //timestamp
    var $a_n = null; //activator_name

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function generate_key($product_code) {
        // returns md5 encoded string
        return md5($this->key_logic($product_code));
    }

    public function validate_key($product_code, $key) {
        if (strcmp($key, $this->generate_key($product_code)) == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function key_logic($input) {
        // returns plain string 
        $r_a = str_split($input);

        $n_a = null;
        $i = 0;
        foreach ($r_a as $char) {
            $n_a[$i] = (chr(ord($char) - 6));
            $i++;
        }
        //echo $a.' => '.implode($n_a);
        return implode($n_a);
    }

    public function add_activation($data) {
        $this->a_p = $data['product_code'];
        $this->a_k = $data['activation_key'];
        $this->a_c = 0;
        $this->a_t = time();
        $this->a_n = $data['activator_name'];

        $this->db->insert('products_a', $this);
    }

    public function decrease_lease($product_code, $value) {

        $p = $this->db->get_where('products_a', array(
            'a_p' => $product_code
        ));
        $p = $p[0];

        $new_value = $p->a_c - $value; // substracted 

        $q = $this->db->update('products_a', array(
            'a_p' => $product_code
                ), array(
            'a_c' => $new_value
        ));
    }

    public function get_lease($product_code) {
        $p = $this->db->get_where('products_a', array(
            'a_p' => $product_code
        ));
        $p = $p[0];

        return $p->a_c;
    }

    public function is_this_activation_used($product_code) {
        $p = $this->db->get_where('products_a', array(
            'a_p' => $product_code
        ));
        if ($p->length > 0)
            return true;
        else
            return false;
    }

    public function get_latest_activation_details() {
        $p = $this->db->get_where('products_a', array(
            'a_p' => $product_code
        ));
    }

}

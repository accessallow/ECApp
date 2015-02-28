<?php

class Activation_model extends CI_Model {

    var $p_c = null; //product_code
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
        
        list($user,$time,$lease) = explode(":", $data['product_code']);
        
        $counter = $this->get_total_activation_counter();
        $this->cascade_zero();
        $updated_counter = $counter + $lease;
        
        
        
        
        $this->p_c = $data['product_code'];
        $this->a_k = $data['product_key'];
        $this->a_c = $updated_counter;
        $this->a_t = time();
        $this->a_n = $data['activator_name'];

        $this->db->insert('products_a', $this);
    }
    
    public function cascade_zero(){
        $this->db->update('products_a',array(
            'a_c'=> 0
        ));
    }

    public function decrease_lease($product_code, $value) {
//        echo "<br/>Inside decrease_lease = <br/>" .
//        " product_code = $product_code & value = $value";

        $p = $this->db->get_where('products_a', array(
            'p_c' => $product_code
        ));
        $p = $p->result();
        if ($p != null) {
            $p = $p[0];


            if ($p->a_c == 0) {
                $new_value = 0;
            } else {
                $new_value = $p->a_c - $value; // substracted 
            }

            $q = $this->db->update('products_a', array(
                'a_c' => $new_value
                    ), array(
                'p_c' => $product_code
            ));
        }
    }

    public function get_lease($product_code) {
        $p = $this->db->get_where('products_a', array(
            'p_c' => $product_code
        ));
        $p = $p[0];

        return $p->a_c;
    }

    public function is_this_activation_used($product_code) {
        $p = $this->db->get_where('products_a', array(
            'p_c' => $product_code
        ));
        $p = $p->result();
        
        if (sizeof($p) > 0)
            return true;
        else
            return false;
    }

    public function get_latest_activation_details() {
        $this->db->where('a_c !=', 0);

        $p = $this->db->get('products_a');
        $p = $p->result();
        if ($p != null) {
            $p = $p[0];
        }
        return $p; //array
    }

    public function get_total_activation_counter() {
        $this->db->select_sum('a_c');
        $p = $this->db->get('products_a');
        $p = $p->result();
        $p = $p[0];
        return $p->a_c;
    }

    public function get_all_activations() {
        $q = $this->db->get('products_a');
        return $q->result();
    }

    public function is_product_activated() {
        if ($this->get_total_activation_counter() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function degrade() {
        $a = $this->get_latest_activation_details();
        if($a!=null){
        $product_code = $a->p_c;
//        echo "called decrease lease = Product code = "
//        . $product_code . " & current counter = " . $a->a_c;
        $this->decrease_lease($product_code, 1);
        }
    }
    
    public function get_activation_data(){
        $activation_data = null;
        
        if($this->is_product_activated() == true){
            $activation_data['activation_status'] = true;
        }else{
             $activation_data['activation_status'] = false;
        }
        $activation_data['counter'] = $this->get_total_activation_counter();
        
        return $activation_data;
    }

}

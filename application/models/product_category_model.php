<?php
 
class Product_category_model extends CI_Model {

    
    var $product_category_name = "";

    public function __construct() {
        $this->load->database();
    }

    function insert($name) {
        $this->product_category_name = $name;

        $this->db->insert("product_category", $this);
    }

    function edit($id, $name) {
        $this->product_category_name = $name;

        $this->db->update("product_category", $this, array('id' => $id));
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete("product_category");
    }

    function get_all_entries() {
        $query = $this->db->get("product_category");
        return $query->result();
    }

    function get_one_category($id) {

        $query = $this->db->get_where("product_category", array('id' => $id));
        return $query->result();
    }
    function get_category_name($id){
        $a = $this->get_one_category($id);
        return $a[0]->product_category_name;
    }

}

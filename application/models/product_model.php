<?php
//done 
class Product_model extends CI_Model {

    var $product_name = "";
    var $product_brand = "";
    var $product_category = "";
    var $product_description = "";

    public function __construct() {
        $this->load->database();
    }

    function insert($name, $brand, $category, $description) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_category = $category;
        $this->product_description = $description;
        $this->db->insert("products", $this);
    }

    function edit($id,$name, $brand, $category, $description) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_category = $category;
        $this->product_description = $description;

        $this->db->update('products', $this, array('id' => $id));
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('products');
    }

    function get_all_entries() {
        $query = $this->db->get('products');
        return $query->result();
    }
    function get_all_entries_joined(){
        $query = $this->db->query('SELECT p.id,p.product_name,p.product_brand,c.product_category_name as \'product_category\','
                . 'p.product_description FROM products p,product_category c WHERE p.product_category = c.id;');
        return $query->result();
    }

    function get_one_product($id) {

        $query = $this->db->get_where('products', array('id' => $id));
        return $query->result();
    }

}

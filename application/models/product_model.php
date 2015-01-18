<?php

//done 
class ProductTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Product_model extends CI_Model {

    var $product_name = "";
    var $product_brand = "";
    var $product_category = "";
    var $product_description = "";
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name, $brand, $category, $description) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_category = $category;
        $this->product_description = $description;
        $this->tag = ProductTags::$available;
        
        $this->db->insert("products", $this);
    }

    function edit($id, $name, $brand, $category, $description) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_category = $category;
        $this->product_description = $description;
        $this->tag = ProductTags::$available;

        $this->db->update('products', $this, array('id' => $id));
    }

    function delete($id) {

        $data = array('tag' => ProductTags::$deleted);
        $this->db->where('id', $id);
        $this->db->update('products', $data);
    }

    function get_all_entries() {
        $query = $this->db->get_where('products',array('tag'=>  ProductTags::$available));
        return $query->result();
    }
    function get_really_all_entries() {
        /* 
         * this function will return all the product records whether
         * they are deleted or available not does not matter..
         * use it with caution
         * it is returning dead-products...you will not want to mess with
         * dead things   
         */
        $query = $this->db->get_where('products');
        return $query->result();
    }

    function get_all_entries_joined() {
        $query = $this->db->query('SELECT p.id,p.product_name,p.product_brand,c.product_category_name as \'product_category\','
                . 'p.product_description FROM products p,product_category c WHERE p.product_category = c.id and p.tag = '.ProductTags::$available.';');
        return $query->result();
    }
    
    function get_all_entries_joined_no_matter_what() {
        $query = $this->db->query('SELECT p.id,p.product_name,p.product_brand,c.product_category_name as \'product_category\','
                . 'p.product_description FROM products p,product_category c WHERE p.product_category = c.id;');
        return $query->result();
    }

    function get_one_product($id) {

        $query = $this->db->get_where('products', array('id' => $id,'tag'=>  ProductTags::$available));
        return $query->result();
    }
    
    function get_one_product_no_matter_what($id) {

        $query = $this->db->get_where('products', array('id' => $id));
        return $query->result();
    }
    
    

}

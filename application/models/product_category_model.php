<?php

class ProductCategoryTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Product_category_model extends CI_Model {

    var $product_category_name = "";
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name) {
        $this->product_category_name = $name;
        $this->tag = ProductCategoryTags::$available;

        $this->db->insert("product_category", $this);
    }

    function edit($id, $name) {
        $this->product_category_name = $name;
        $this->tag = ProductCategoryTags::$available;
        
        $this->db->update("product_category", $this, array('id' => $id));
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->update("product_category",array('tag'=>  ProductCategoryTags::$deleted));
    }

    function get_all_entries() {
        $query = $this->db->get_where("product_category",array('tag'=>  ProductCategoryTags::$available));
        return $query->result();
    }

    function get_one_category($id) {

        $query = $this->db->get_where("product_category", array('id' => $id,'tag'=>  ProductCategoryTags::$available));
        return $query->result();
    }

    function get_category_name($id) {
        $a = $this->get_one_category($id);
        return $a[0]->product_category_name;
    }

}

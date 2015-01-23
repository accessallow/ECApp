<?php

class ProductSellerMappingTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Product_seller_mapping_model extends CI_Model {

    var $product_id = "";
    var $seller_id = "";
    var $product_price = "";
    var $tag = null;

    public function __construct() {
        $this->load->database();
    }

    function insert($p_id, $s_id, $p_price) {
        $this->product_id = $p_id;
        $this->seller_id = $s_id;
        $this->product_price = $p_price;
        $this->tag = ProductSellerMappingTags::$available;

        $this->db->insert("product_seller_mapping", $this);
    }

    function edit($id, $p_id, $s_id, $p_price) {
        $this->product_id = $p_id;
        $this->seller_id = $s_id;
        $this->product_price = $p_price;
        $this->tag = ProductSellerMappingTags::$available;

        $this->db->update('product_seller_mapping', $this, array('id' => $id));
    }

    function delete($id) {
        $data = array('tag' => ProductSellerMappingTags::$deleted);
        $this->db->where('id', $id);
        $this->db->update('product_seller_mapping', $data);
    }

    function get_all_entries($dead = false) {
        //get_all_entries(true): will return really all record,alive or dead
        //get_all_entries(): will return only alive records
        if (!$dead) {
            $this->db->where(array('tag' => ProductSellerMappingTags::$available));
            $query = $this->db->get('product_seller_mapping');
        } else {
            $query = $this->db->get('product_seller_mapping');
        }
        return $query->result();
    }

    function get_all_entries_joined_extended($product_id, $seller_id) {
        if ($product_id) {
            //send all sellers who sell product of $product_id
            //in ascending order of price
        } elseif ($seller_id) {
            //send all products who are sold by seller $seller_id
            //in ascending order of alphabets in product
        } else {
            //send all the mappings in ascending order of product,price
        }
    }

    function get_one_mapping($id, $dead = false) {
        $query = null;
        if (!$dead) {
            // will execute if nothing is passed in dead-means record is live
            $query = $this->db->get_where('product_seller_mapping', array('id' => $id, 'tag' => ProductSellerMappingTags::$available));
        } else {
            // will execute if true is set - dealing with a dead record
            $query = $this->db->get_where('product_seller_mapping', array('id' => $id));
        }
        return $query->result();
    }

    //not needed function anymore
    function get_sellers_list($product_id) {
        $query = $this->db->get_where('product_seller_mapping', array('product_id' => $product_id));
        return $query->result();
    }

    function edit_price($id, $price) {
        //$this->product_price = $price; 
        $this->db->where(array('id' => $id, 'tag' => ProductSellerMappingTags::$available));
        $this->db->update('product_seller_mapping', array('product_price' => $price));
    }

}

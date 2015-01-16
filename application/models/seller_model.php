<?php

class SellerTags {

    public static $deleted = 0;
    public static $available = 1;

}

class Seller_model extends CI_Model {

var $seller_name = "";
var $seller_phone_number = "";
var $seller_address = "";
var $tag = NULL;

    public function __construct()
	{
		$this->load->database();
	}

    function insert($name, $phone, $address) {
        $this->seller_name = $name;
        $this->seller_phone_number = $phone;
        $this->seller_address = $address;
        $this->tag = SellerTags::$available;

        $this->db->insert("seller", $this);
    }

    function edit($id, $name, $phone, $address) {
        $this->seller_name = $name;
        $this->seller_phone_number = $phone;
        $this->seller_address = $address;
        $this->tag = SellerTags::$available;

        $this->db->update('seller', $this, array('id' => $id));

    }
    
    function delete($id){
        
        $this->db->where('id', $id);
        $this->db->update('seller',array('tag'=>  SellerTags::$deleted)); 
    }
    
    function get_all_entries(){
         $query = $this->db->get_where('seller',array('tag'=>  SellerTags::$available));
         return $query->result();
    }
    function get_one_seller($id){
        
        $query = $this->db->get_where('seller',array('id'=>$id,'tag'=> SellerTags::$available));
        return $query->result();
    }
    function get_all_other_entries($product_id){
        $query = $this->db->query("SELECT * FROM seller WHERE id not in (select seller_id as id from product_seller_mapping where product_id=$product_id)and tag=".SellerTags::$available.";");
        return $query->result();
    }
    

}



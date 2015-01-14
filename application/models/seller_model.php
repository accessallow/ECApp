<?php

class Seller_model extends CI_Model {

var $seller_name = "";
var $seller_phone_number = "";
var $seller_address = "";

    public function __construct()
	{
		$this->load->database();
	}

    function insert($name, $phone, $address) {
        $this->seller_name = $name;
        $this->seller_phone_number = $phone;
        $this->seller_address = $address;

        $this->db->insert("seller", $this);
    }

    function edit($id, $name, $phone, $address) {
        $this->seller_name = $name;
        $this->seller_phone_number = $phone;
        $this->seller_address = $address;

        $this->db->update('seller', $this, array('id' => $id));

    }
    
    function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('seller'); 
    }
    
    function get_all_entries(){
         $query = $this->db->get('seller');
         return $query->result();
    }
    function get_one_seller($id){
        
        $query = $this->db->get_where('seller',array('id'=>$id));
        return $query->result();
    }
    function get_all_other_entries($product_id){
        $query = $this->db->query("SELECT * FROM seller WHERE id not in (select seller_id as id from product_seller_mapping where product_id=$product_id);");
        return $query->result();
    }
    

}

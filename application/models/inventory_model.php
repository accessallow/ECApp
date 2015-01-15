<?php
//done 
class Product_model extends CI_Model {

    var $product_id = "";
    var $quantity = "";
    var $payment = "";
    var $seller_id = "";
    var $date="";
    var $description="";
    var $tag="";

    public function __construct() {
        $this->load->database();
    }

    function insert($product_id,$quantity , $payment, $seller_id,$date,$description) {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->payment= $payment;
        $this->seller_id = $seller_id;
        $this->date = $date;
        $this->product_description = $description;
        $this->tag = InventoryTags::$available;
        
        $this->db->insert("inventory", $this);
    }

    function edit($id,$product_id,$quantity , $payment, $seller_id,$date,$description) {
       $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->payment= $payment;
        $this->seller_id = $seller_id;
        $this->date = $date;
        $this->product_description = $description;

        $this->db->update('inventory', $this, array('id' => $id));
    }

    function delete($id) {
//        we do not delete anything here, we just set the tag to deleted
        
        $data = array('tag'=>  InventoryTags::$deleted);
        $this->db->where('id', $id);
        $this->db->update('inventory',$data);
    }

    function get_all_entries() {
        // selecting records whose tag is set to available
        // those will be our active records
        $query = $this->db->get_where('inventory',array('tag'=>  InventoryTags::$available));
        return $query->result();
    }
    

    function get_one_inventory($id) {

        $query = $this->db->get_where('products', array('id' => $id,'tag'=>  InventoryTags::$available));
        return $query->result();
    }

}

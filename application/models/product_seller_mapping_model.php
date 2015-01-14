<?php
//done 
class Product_seller_mapping_model extends CI_Model {

    var $product_id = "";
    var $seller_id = "";
    var $product_price = "";
    

    public function __construct(){
        $this->load->database();
    }

    function insert($p_id, $s_id, $p_price) {
        $this->product_id = $p_id;
        $this->seller_id = $s_id;
        $this->product_price = $p_price;
       
        $this->db->insert("product_seller_mapping", $this);
    }

    function edit($id,$p_id, $s_id, $p_price) {
        $this->product_id = $p_id;
        $this->seller_id = $s_id;
        $this->product_price = $p_price; 

        $this->db->update('product_seller_mapping', $this, array('id' => $id));
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('product_seller_mapping');
    }

    function get_all_entries() {
        $query = $this->db->get('product_seller_mapping');
        return $query->result();
    }

    function get_one_mapping($id) {

        $query = $this->db->get_where('product_seller_mapping', array('id' => $id));
        return $query->result();
    }
    function get_sellers_list($product_id){
        $query = $this->db->get_where('product_seller_mapping',array('product_id'=>$product_id));
        return $query->result();
    }
    function edit_price($id,$price){
        //$this->product_price = $price; 
        $this->db->where('id',$id);
        $this->db->update('product_seller_mapping', array('product_price' => $price));
    }

}

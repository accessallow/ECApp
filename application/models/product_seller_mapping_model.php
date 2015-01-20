<?php



class ProductSellerMappingTags {

    public static $deleted = 0;
    public static $available = 1;

}

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
    function get_all_entries_joined_extended($product_id,$seller_id){
        if($product_id){
            //send all sellers who sell product of $product_id
            //in ascending order of price
        }elseif($seller_id){
            //send all products who are sold by seller $seller_id
            //in ascending order of alphabets in product
        }else{
            //send all the mappings in ascending order of product,price
        }
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

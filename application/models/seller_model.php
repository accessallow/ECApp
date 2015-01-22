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

    public function __construct() {
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

    function delete($id) {

        $this->db->where('id', $id);
        $this->db->update('seller', array('tag' => SellerTags::$deleted));
    }

    function get_all_entries($product_id) {
        //empty object,will be filled in the ifs accordingly
        $query = null;

        if ($product_id) {
            $queryString = "select 
                            s.id,
                            s.seller_name,
                            s.seller_phone_number,
                            s.seller_address,
                            psm.product_price
                            from 
                            seller s,
                            product_seller_mapping psm
                            where
                            (
                            s.tag = ".SellerTags::$available." and
                            psm.tag = 1 and
                            s.id = psm.seller_id and
                            psm.product_id = $product_id
                            )
                            order by 
                            psm.product_price asc;";
            $query = $this->db->query($queryString);
        } else {
            $query = $this->db->get_where('seller', array('tag' => SellerTags::$available));
        }

        return $query->result();
    }

    function get_all_entries_no_matter_what() {
        $query = $this->db->get_where('seller');
        return $query->result();
    }

    function get_one_seller($id) {

        $query = $this->db->get_where('seller', array('id' => $id, 'tag' => SellerTags::$available));
        return $query->result();
    }

    function get_one_seller_no_matter_what($id) {

        $query = $this->db->get_where('seller', array('id' => $id));
        return $query->result();
    }

    function get_all_other_entries($product_id) {
        // get all the selle
        $query = $this->db->query("SELECT * FROM seller WHERE id not in (select seller_id as id from product_seller_mapping where product_id=$product_id)and tag=" . SellerTags::$available . ";");
        return $query->result();
    }

    function get_all_other_entries_no_matter_what($product_id) {
        $query = $this->db->query("SELECT * FROM seller WHERE id not in (select seller_id as id from product_seller_mapping where product_id=$product_id);");
        return $query->result();
    }
    
    function get_sellers_for_this_product($product_id){
        $queryString = "select
                        s.id as 'seller_id',
                        s.seller_name,
                        psm.product_price,
                        s.seller_phone_number,
                        s.seller_address
                        from 
                        seller s,
                        product_seller_mapping psm
                        where
                        (
                        s.id = psm.seller_id and
                        psm.product_id = $product_id and
                        s.tag = 1 and
                        psm.tag = 1
                        )
                        order by psm.product_price asc
                        ;";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    ///////////////////////////////////////////////
    ///////////////METADATA QUERIES////////////////
    ///////////////////////////////////////////////
    function get_total_number_of_sellers($whereArray) {
        $this->db->where($whereArray);
        $this->db->from('seller');
        $q = $this->db->count_all_results();

        return $q;
    }

}

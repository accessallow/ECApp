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
        $query = $this->db->get_where('products', array('tag' => ProductTags::$available));
        return $query->result();
    }

    function get_all_entries_no_matter_what() {
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

    function get_all_entries_joined($category_id = null) {
        if ($category_id) {
            $queryString = "SELECT p.id,p.product_category as 'product_category_id',
            p.product_name,p.product_brand,c.product_category_name as 'product_category',
                p.product_description FROM products p,product_category c 
                WHERE p.product_category = c.id and
                p.product_category = $category_id and
                p.tag = " . ProductTags::$available . ";";
        } else {
            $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,c.product_category_name as 'product_category',
                p.product_description FROM products p,product_category c 
                WHERE p.product_category = c.id and p.tag = " . ProductTags::$available . ";";
        }

        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_all_entries_joined_no_matter_what() {
        $query = $this->db->query('SELECT p.id,p.product_name,p.product_brand,c.product_category_name as \'product_category\','
                . 'p.product_description FROM products p,product_category c WHERE p.product_category = c.id;');
        return $query->result();
    }

    function get_one_product($id) {

        $query = $this->db->get_where('products', array('id' => $id, 'tag' => ProductTags::$available));
        return $query->result();
    }

    function get_one_product_no_matter_what($id) {

        $query = $this->db->get_where('products', array('id' => $id));
        return $query->result();
    }

    function give_me_price($product_id,$seller_id){
 // this can blow in future..use with caution
        $query = $this->db->get_where('product_seller_mapping',
                array(
                    'product_id'=>$product_id,
                    'seller_id'=>$seller_id,
                    'tag'=>  ProductTags::$available
                ));
        return $query->result();
//        $resultArray = $query->result();
//        $PriceObject = $resultArray[0];
//        return $PriceObject->product_price;
    }
    
    function get_products_from_this_seller($seller_id){
        $queryString = "select 
                        p.id,
                        p.product_name,
                        p.product_brand,
                        psm.product_price,
                        (select product_category_name from product_category where product_category.id=p.product_category) as 'product_category',
                        p.product_category as 'product_category_id',
                        p.product_description
                        from
                        products p,
                        product_seller_mapping psm
                        where
                        (
                        p.id = psm.product_id and
                        psm.seller_id = $seller_id and
                        p.tag=1 and
                        psm.tag=1
                        )
                        order by 
                        p.product_name asc;";
        $query = $this->db->query($queryString);
        return $query->result();
    }
    ///////////////////////////////////////////////
    ///////////////METADATA QUERY FUNCTIONS//////////
    ///////////////////////////////////////////////

    function get_total_products($whereArray) {
        $this->db->where($whereArray);
        $this->db->from('products');
        $q = $this->db->count_all_results();

        return $q;
    }

    function get_total_categorized_products($category_id) {
        $this->db->where(array('product_category' => $category_id));
        $this->db->from('products');
        $q = $this->db->count_all_results();

        return $q;
    }

}

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
    var $stock = null;
    var $tag = NULL;

    public function __construct() {
        $this->load->database();
    }

    function insert($name, $brand, $category, $description) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_category = $category;
        $this->product_description = $description;
        $this->stock = 0;
        $this->tag = ProductTags::$available;

        $this->db->insert("products", $this);
        
    }

    function edit($id, $name, $brand, $category, $description,$stock) {
        $this->product_name = $name;
        $this->product_brand = $brand;
        $this->product_category = $category;
        $this->product_description = $description;
        $this->stock = $stock;
        $this->tag = ProductTags::$available;

        $this->db->update('products', $this, array('id' => $id));
    }

    function delete($id) {

        $data = array('tag' => ProductTags::$deleted);
        $this->db->where('id', $id);
        $this->db->update('products', $data);
    }

    function get_all_entries($where=null) {
        $where['tag'] = ProductTags::$available;
        $this->db->order_by("product_name","asc");
        $query = $this->db->get_where('products', $where);
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
                p.product_description,p.stock FROM products p,product_category c 
                WHERE (p.product_category = c.id and
                p.product_category = $category_id and
                p.tag = " . ProductTags::$available . ")"
                    . "order by p.product_name asc;";
        } else {
            $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,c.product_category_name as 'product_category',
                p.product_description,p.stock FROM products p,product_category c 
                WHERE ( p.product_category = c.id and p.tag = " . ProductTags::$available . ""
                    . ") order by p.product_name asc;";
        }

        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_one_product_joined($product_id) {
        $queryString = "SELECT p.id,c.id as 'product_category_id',
                p.product_name,p.product_brand,c.product_category_name as 'product_category',
                p.product_description,p.stock FROM products p,product_category c 
                WHERE ( p.product_category = c.id and 
                p.id = $product_id
                and p.tag = " . ProductTags::$available . ""
                . ") order by p.product_name asc;";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    function get_all_entries_joined_no_matter_what() {
        $query = $this->db->query('SELECT p.id,p.product_name,p.product_brand,c.product_category_name as \'product_category\','
                . 'p.product_description,p.stock FROM products p,product_category c WHERE p.product_category = c.id;');
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

    

    function get_products_from_this_seller($seller_id) {
        $queryString = "select 
                        p.id as 'id',
                        psm.id as 'mapping_id',
                        p.product_name,
                        p.product_brand,
                        psm.product_price,
                        (select product_category_name from product_category where product_category.id=p.product_category) as 'product_category',
                        p.product_category as 'product_category_id',
                        p.product_description,
                        p.stock
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

    function get_products_which_this_seller_dont_sell($seller_id) {
        $queryString = "select 
                        *
                        from 
                        products 
                        where
                        id 
                        not in(select distinct product_id
                        from product_seller_mapping
                        where seller_id = $seller_id
                        and tag = 1
                        ) and tag = 1;
                        ";
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
        $this->db->where(array('product_category' => $category_id,'tag' => 1));
        $this->db->from('products');
        $q = $this->db->count_all_results();

        return $q;
    }

    function count_my_sellers($product_id) {
        $this->db->where(array(
            'product_id' => $product_id,
            'tag' => ProductTags::$available
        ));
        $this->db->from('product_seller_mapping');
        $a = $this->db->count_all_results();
        return $a;
    }

    function my_best_rate($product_id) {
        $mysellers = $this->count_my_sellers($product_id);
        if ($mysellers == 0) {
            return 0;
        } else {
            $where = array(
                'product_id' => $product_id,
                'tag' => ProductTags::$available
            );
            $this->db->select_min('product_price');
            $query = $this->db->get_where('product_seller_mapping', $where);

            $r = $query->result();
            $r = $r[0];
            return $r->product_price;
        }
    }

    function my_best_seller($product_id) {
        $mysellers = $this->count_my_sellers($product_id);
        if ($mysellers == 0) {
            return "Nil";
        } else {
            $best_price = $this->my_best_rate($product_id);
            $where = array(
                'product_id' => $product_id,
                'product_price' => $best_price,
                'tag' => ProductTags::$available
            );
            $q = $this->db->get_where('product_seller_mapping', $where);
            $q = $q->result();
            $q = $q[0];
            $where = array(
                'id' => $q->seller_id,
                'tag' => ProductTags::$available
            );
            $q = $this->db->get_where('seller', $where);
            $q = $q->result();
            $q = $q[0];
            return $q->seller_name;
        }
    }

        
    function update_my_stock($product_id,$count){
        $this->db->update('products',
                array('stock'=>$count), //this to update
                array('id'=>$product_id)); //where id=blah
    }

}

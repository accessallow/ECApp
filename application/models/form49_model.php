<?php

//done 
class Form49Tags {

    public static $deleted = 0;
    public static $available = 1;

}

class Form49_model extends CI_Model {

    var $shop_name = null;
    var $address = null;
    var $tin_number = null;
    var $invoice_number = null;
    var $date = null;
    var $total_value = null;
    var $total_quantity = null;
    var $dispatch_location = null;
    var $destination = null;
    var $category = null;
    var $product = null;
    var $description = null;
    var $transport_value = null;
    var $billty_number = null;
    var $vehicle_number = null;
    var $form_c = null;
    var $tag = null;
    

    public function __construct() {
        $this->load->database();
    }

    function insert($data) {
        
        $this->shop_name = $data['shop_name'];
        $this->address = $data['address'];
        $this->tin_number = $data['tin_number'];
        $this->invoice_number = $data['invoice_number'];
        $this->date = $data['date'];
        $this->total_value = $data['total_value'];
        $this->total_quantity = $data['total_quantity'];
        $this->dispatch_location = $data['dispatch_location'];
        $this->destination = $data['destination'];
        $this->category = $data['category'];
        $this->product = $data['product'];
        $this->description = $data['description'];
        $this->transport_value = $data['transport_value'];
        $this->billty_number = $data['billty_number'];
        $this->vehicle_number = $data['vehicle_number'];
        $this->form_c = $data['form_c'];
        $this->tag = Form49Tags::$available;
        
        $this->db->insert("form49", $this);
        
    }

    function edit($id, $data) {
        $this->shop_name = $data['shop_name'];
        $this->address = $data['address'];
        $this->tin_number = $data['tin_number'];
        $this->invoice_number = $data['invoice_number'];
        $this->date = $data['date'];
        $this->total_value = $data['total_value'];
        $this->total_quantity = $data['total_quantity'];
        $this->dispatch_location = $data['dispatch_location'];
        $this->destination = $data['destination'];
        $this->category = $data['category'];
        $this->product = $data['product'];
        $this->description = $data['description'];
        $this->transport_value = $data['transport_value'];
        $this->billty_number = $data['billty_number'];
        $this->vehicle_number = $data['vehicle_number'];
        $this->form_c = $data['form_c'];
        $this->tag = Form49Tags::$available;

        $this->db->update('form49', $this, array('id' => $id));
    }

    function delete($id) {

        $data = array('tag' => Form49Tags::$deleted);
        $this->db->where('id', $id);
        $this->db->update('form49', $data);
    }

    function get_all_entries() {
        
        $query = $this->db->get_where('form49', array('tag' => Form49Tags::$available));
        return $query->result();
    }
    function get_all_entries_joined(){
        $sql = "select
                f.id as 'id',
                f.shop_name,f.address,f.tin_number,f.invoice_number,
                f.`date`,f.total_value,f.total_quantity,f.dispatch_location,f.destination,
                f.category as 'product_category_id',
                c.product_category_name as 'category',
                f.product as 'product_id',
                p.product_name as 'product',
                f.description,f.transport_value,f.billty_number,f.vehicle_number,f.form_c 
                from
                form49 f,products p,product_category c
                where
                f.product = p.id and
                f.category = c.id and
                f.tag = 1;
                ";
        $r = $this->db->query($sql);
        return $r->result();
    }
    function get_one_product($where) {
        
        $where['tag'] = Form49Tags::$available;
        $query = $this->db->get_where('form49', $where);
        return $query->result();
    }

    ///////////////////////////////////////////////
    /////////////METADATA QUERY FUNCTIONS//////////
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

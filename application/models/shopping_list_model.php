<?php

class Shopping_list_tags {

    public static $deleted = 0;
    public static $available = 1;

}

class Shopping_list_model extends CI_Model {

    var $list_name = "";
    var $date_created = "";
    var $date_modified = "";
    var $tag = null;

    public function __construct() {
        $this->load->database();
    }

    public function get_all_entries() {
        $query = $this->db->get_where('shopping_lists', array(
            'tag' => Shopping_list_tags::$available
        ));
        return $query->result();
    }

    public function get_one_entry($list_id) {
        $query = $this->db->get_where('shopping_lists', array(
            'id' => $list_id,
            'tag' => Shopping_list_tags::$available
                )
        );
        return $query->result();
    }

    public function add_entry($data) {
        $this->list_name = $data['list_name'];
        $this->date_created = $data['date_created'];
        $this->date_modified = $data['date_modified'];

        $this->tag = Shopping_list_tags::$available;
        $this->db->insert('shopping_lists', $this);
        //done : inserted
    }

    public function edit_entry($list_id, $data) {
        $this->list_name = $data['list_name'];
        $this->date_created = $data['date_created'];
        $this->date_modified = $data['date_modified'];
        $this->tag = Shopping_list_tags::$available;
        $this->db->update('shopping_lists', $this, array('id' => $list_id));
        //done : update
    }

    public function delete_entry($list_id) {
        $this->db->update('shopping_lists', array('tag' => Shopping_list_tags::$deleted), array('id' => $list_id));
        // a graceful delete
        $this->db->update('shopping_list_items',
                array('tag'=>  Shopping_list_tags::$deleted),
                array('list_id'=>$list_id));
    }

    public function get_all_items_from_list($list_id) {
        $sql = "select 
                sli.id,
                sli.list_id,
                sli.product_id,
                p.product_name,
                p.product_brand,
                sli.seller_id,
                s.seller_name,
                sli.rate,
                sli.quantity,
                sli.total_price,
                sli.description
                from 
                shopping_list_items sli,
                products p,
                seller s 
                where 
                sli.product_id = p.id and
                sli.seller_id = s.id and
                sli.list_id = $list_id and
                sli.tag = 1
                order by s.seller_name,p.product_name
                ;";

        $q = $this->db->query($sql);
        return $q->result();
    }

    public function get_all_items_of_a_seller_from_list($list_id, $seller_id) {
        $sql = "select 
                sli.id,
                sli.list_id,
                sli.product_id,
                p.product_name,
                p.product_brand,
                sli.seller_id,
                s.seller_name,
                sli.rate,
                sli.quantity,
                sli.total_price,
                sli.description
                from 
                shopping_list_items sli,
                products p,
                seller s 
                where 
                sli.product_id = p.id and
                sli.seller_id = s.id and
                sli.seller_id = $seller_id and
                sli.list_id = $list_id and
                sli.tag = 1
                order by s.seller_name,p.product_name
                ;";

        $q = $this->db->query($sql);
        return $q->result();
    }

    public function add_an_item_to_list($data) {
        $data['tag'] = Shopping_list_tags::$available;
        $this->db->insert('shopping_list_items', $data);
    }

    public function get_one_item($item_id) {
        $query = $this->db->get_where('shopping_list_items', array(
            'id' => $item_id,
            'tag' => Shopping_list_tags::$available
        ));
        return $query->result();
    }

    public function update_one_item($item_id, $data) {
        $this->db->update('shopping_list_items', $data, array(
            'id' => $item_id
        ));
        // I like this active Record thing
    }

    public function delete_one_item($item_id) {
        $this->db->update('shopping_list_items', array('tag' => Shopping_list_tags::$deleted), array('id' => $item_id));
        //graceful delete again :)
    }
    
    public function count_entries_of_product($product_id){
        $this->db->where(array(
            'product_id' => $product_id,
            'tag' => 1
        ));
        $this->db->from('shopping_list_items');
        $r = $this->db->count_all_results();
        
        return $r;
    }

}

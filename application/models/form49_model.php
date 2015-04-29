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
    var $form_number = null;
    var $form_date = null;
    var $invoice_number = null;
    var $date = null;
    var $total_value = null;
    var $total_quantity = null;
    var $dispatch_location = null;
    var $destination = null;
    var $category = null;
    //var $product = null;
    //var $description = null;
    var $transport_value = null;
    var $billty_number = null;
    var $vehicle_number = null;
    var $form_c = null;
    var $product_percent = null;
    var $cst_percent = null;
    var $tag = null;

    public function __construct() {
        $this->load->database();
    }

    function insert($data) {

        $this->shop_name = $data['shop_name'];
        $this->address = $data['address'];
        $this->tin_number = $data['tin_number'];
        $this->invoice_number = $data['invoice_number'];
        $this->form_number = $data['form_number'];
        $this->form_date = $data['form_date'];
        $this->date = $data['date'];
        $this->total_value = $data['total_value'];
        $this->total_quantity = $data['total_quantity'];
        $this->dispatch_location = $data['dispatch_location'];
        $this->destination = $data['destination'];
        $this->category = $data['category'];
//        $this->product = $data['product'];
//        $this->description = $data['description'];
        $this->transport_value = $data['transport_value'];
        $this->billty_number = $data['billty_number'];
        $this->vehicle_number = $data['vehicle_number'];
        $this->form_c = $data['form_c'];
        $this->product_percent = $data['product_percent'];
        $this->cst_percent = $data['cst_percent'];
        $this->tag = Form49Tags::$available;

        $this->db->insert("form49", $this);
    }

    function edit($id, $data) {
        $this->shop_name = $data['shop_name'];
        $this->address = $data['address'];
        $this->tin_number = $data['tin_number'];
        $this->invoice_number = $data['invoice_number'];
        $this->form_number = $data['form_number'];
        $this->form_date = $data['form_date'];
        $this->date = $data['date'];
        $this->total_value = $data['total_value'];
        $this->total_quantity = $data['total_quantity'];
        $this->dispatch_location = $data['dispatch_location'];
        $this->destination = $data['destination'];
        $this->category = $data['category'];
//        $this->product = $data['product'];
//        $this->description = $data['description'];
        $this->transport_value = $data['transport_value'];
        $this->billty_number = $data['billty_number'];
        $this->vehicle_number = $data['vehicle_number'];
        $this->form_c = $data['form_c'];
        $this->product_percent = $data['product_percent'];
        $this->cst_percent = $data['cst_percent'];
        
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

    function get_all_entries_joined($id = null) {
        $breakString = '';
        if ($id != null) {
            $breakString = 'f.id = ' . $id . ' and ';
        }


//        $sql = "select
//                f.id as 'id',
//                f.shop_name,f.address,f.tin_number,f.invoice_number,
//                f.`date`,f.total_value,f.total_quantity,f.dispatch_location,f.destination,
//                f.category as 'product_category_id',
//                c.product_category_name as 'category',
//                f.product as 'product_id',
//                p.product_name as 'product',
//                f.description,f.transport_value,f.billty_number,f.vehicle_number,f.form_c 
//                from
//                form49 f,products p,product_category c
//                where
//                f.product = p.id and
//                f.category = c.id and
//                $breakString
//                f.tag = 1;
//                ";

        $sql = "select
                f.id as 'id',
                f.shop_name,f.address,f.tin_number,f.invoice_number,f.form_number,f.form_date,
                f.`date`,f.total_value,f.total_quantity,f.dispatch_location,f.destination,
                f.category as 'product_category_id',
                c.product_category_name as 'category',
                f.transport_value,f.billty_number,f.vehicle_number,f.form_c,f.product_percent,f.cst_percent
                from
                form49 f,product_category c
                where
                f.category = c.id and
                $breakString
                f.tag = 1;
                ";


        $r = $this->db->query($sql);
        return $r->result();
    }

    function get_one_form($where) {

        $where['tag'] = Form49Tags::$available;
        $query = $this->db->get_where('form49', $where);
        return $query->result();
    }

}

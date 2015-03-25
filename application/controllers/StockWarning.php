<?php

class StockWarning extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_model');
    }

    public function index() {
        $data['json_fetch_link'] = site_url('StockWarning/index_json');
        $data['total_stockzero_products']  = $this->product_model->get_total_products(array(
            'stock' => 0,
            'tag' => 1
        ));

        $this->load->view('template/header',$this->activation_model->get_activation_data());
        $this->load->view('stockwarn/dashboard', $data);
        $this->load->view('template/footer');
    }

    public function index_json() {
        
        $this->load->model('shopping_list_model');
        $products = $this->product_model->get_all_entries(array(
            'stock' => 0
        ));
        foreach ($products as $p) {
            $p->item_count = $this->shopping_list_model->count_entries_of_product($p->id);
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }

    public function add_seller_wizard($product_id) {
        $this->load->model('product_model');
        $q = $this->product_model->get_one_product_joined($product_id);
        $p = $q[0];
        
        $data['product_name'] = $p->product_name;
        $data['category'] = $p->product_category;
        $data['stock'] = $p->stock;
        $data['brand'] = $p->product_brand;
        
        $data['json_fetch_url'] = site_url('Seller/index_json?product_id='.$p->id);
        $data['back_url'] = site_url('StockWarning');
        $data['forward_url'] = site_url('ShoppingList/add_item_to_shopping_list?product_id='.$p->id.'&seller_id=');

        $this->load->view('template/header',$this->activation_model->get_activation_data());
        $this->load->view('stockwarn/add_seller_wizard', $data);
        $this->load->view('template/footer');
    }

}

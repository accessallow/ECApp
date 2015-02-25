<?php

class StockWarning extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $data['json_fetch_link'] = site_url('StockWarning/index_json');
        
        $this->load->view('template/header');
        $this->load->view('stockwarn/dashboard',$data);
        $this->load->view('template/footer');
    }
    public function index_json(){
        $this->load->model('product_model');
        $this->load->model('shopping_list_model');
        $products = $this->product_model->get_all_entries(array(
            'stock'=>0
        ));
        foreach($products as $p){
            $p->item_count = $this->shopping_list_model->count_entries_of_product($p->id);
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }
    
}

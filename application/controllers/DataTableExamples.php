<?php

class DataTableExamples extends MY_Controller {

    public function __construct() {

        parent::__construct();
    }
    public function index(){
        $this->load->model('product_model');
        $products = $this->product_model->get_all_entries_joined();
//        echo "<pre>";
//        echo var_dump($products);
//        echo "</pre>";
        
        
        $data['products'] = $products;
        
        $this->load->view('template/header',$this->activation_model->get_activation_data());
        $this->load->view('data_table/product',$data);
        $this->load->view('template/footer');
        
    }
    
}


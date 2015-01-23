<?php

class Product_seller_mapping extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }
  ////////////////////////////////////////////
  /////////////////JSON SPITTERS///////////////
  /////////////////////////////////////////////
    
    
    
  ////////////////////////////////////////////
    public function SellersOfAProduct($product_id) {
        //unleashing the dragons
        $this->load->model('product_model');
        $this->load->model('product_seller_mapping_model');
        $this->load->model('product_category_model');
        $this->load->model('seller_model');

        //now command the dragons to spit on the fire
        $data['product'] = $this->product_model->get_one_product($product_id);
        $data['sellers'] = $this->seller_model->get_all_entries(null);
        $data['categories'] = $this->product_category_model->get_all_entries();
        $data['list'] = $this->product_seller_mapping_model->get_sellers_list($product_id);

        //firing the views
        $this->load->view('template/header');
        $this->load->view('product/sellers/list_all', $data);
        $this->load->view('template/footer');
    }

    public function ProductsFromASeller($seller_id){
        //not needed anymore..already implemented in products
    }
    public function All(){
        // get all the mappnings and show a list
    }
    public function add_new_seller_to_a_product($product_id) {
        if ($this->input->post('product_id')) {

            $this->load->model("product_seller_mapping_model");

            $this->product_seller_mapping_model->insert($this->input->post("product_id"),
            $this->input->post("seller_id"),
            $this->input->post("product_price")
            );
            $this->Sellers($product_id);
        } else { 
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->model('product_model');
            $data['product'] = $this->product_model->get_one_product($product_id);
            $this->load->model('seller_model');
            $data['sellers'] = $this->seller_model->get_all_other_entries($product_id);
            
            $this->load->view("template/header");
            $this->load->view("product/sellers/add_new", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit_a_mapping($mapping_id) {
         if(isset($mapping_id)&& !$this->input->post('mapping_id')){
            $this->load->model("product_seller_mapping_model");
            $data['mapping'] = $this->product_seller_mapping_model->get_one_mapping($mapping_id);
            $this->load->model("seller_model");
            $data['sellers']=$this->seller_model->get_all_entries();
            $this->load->model("product_model");
            $data['products'] = $this->product_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/sellers/edit",$data);
            $this->load->view("template/footer");
        }
        else if($this->input->post('mapping_id')) {
            $this->load->model("product_seller_mapping_model");
            
            $this->product_seller_mapping_model->edit($this->input->post("mapping_id"),
                    $this->input->post("product_id"),
                    $this->input->post("seller_id"),
                    $this->input->post("product_price")
                    );
            $this->Sellers($this->input->post('product_id'));
            
        } else {
            $this->load->model("product_category_model");
            $data['categories']=$this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/edit",$data);
            $this->load->view("template/footer");
        }
    }
    
    public function edit_price_of_a_mapping($mapping_id=NULL){
        if($this->input->post('mapping_id')&& $this->input->post('product_price')){
            $this->load->model('product_seller_mapping_model');
            $this->product_seller_mapping_model->edit_price($this->input->post('mapping_id'),
                    $this->input->post('product_price'));
        }
        $this->Sellers($this->input->post('product_id'));
    }

    public function delete_a_mapping($id) {     
        //fun in coding is back, reinvented my way of working with views,good job!!!!
    // post will send id and product_id         
        if($this->input->post('mapping_id')) {
             $this->load->model("product_seller_mapping_model");
             $this->product_seller_mapping_model->delete($this->input->post('mapping_id'));
             $this->Sellers($this->input->post('product_id'));
        } else {
            $this->load->model("product_seller_mapping_model");
            $this->load->model("product_model");
            $this->load->model("seller_model");
            
            $mapping_object = $this->product_seller_mapping_model->get_one_mapping($id)[0];
            
            $data['mapping_id'] = $mapping_object->id;
            $data['product_id'] = $mapping_object->product_id;
            $data['product_price'] = $mapping_object->product_price;
            
            $product_object = $this->product_model->get_one_product($mapping_object->product_id)[0];
            $data['product_name'] = $product_object->product_name;
            
            $seller_object = $this->seller_model->get_one_seller($mapping_object->seller_id)[0];
            $data['seller_name'] = $seller_object->seller_name;
            
            $this->load->view("template/header");
            $this->load->view("product/sellers/delete",$data);
            $this->load->view("template/footer");
        }
    }

}

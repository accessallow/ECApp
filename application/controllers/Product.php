<?php

class Product extends CI_Controller {
    public function __construct(){
    
            parent::__construct();
           
    }

    public function index() {
            $this->load->model("product_model");
           // $data["products"] = $this->product_model->get_all_entries();
            $data = null;
            
            if($this->input->get('product_category_id')){
                $category_id = $this->input->get('product_category_id');
                $this->load->model('product_category_model');
                $categoryObject = $this->product_category_model->get_one_category($category_id);
                $data['category_name'] = $categoryObject[0]->product_category_name;
                $data['total_products_under_this_category'] = $this->product_model->get_total_categorized_products($category_id);
            
                $data['label'] = "Products under category : ".$categoryObject[0]->product_category_name;
                $data['get_all_link'] = '<a class="badge" href="'.URL_X.'Product/">Get all</a>';
                $data['json_fetch_link'] = URL_X.'Product/index_json?product_category_id='.$category_id;
                
            }else{
                $data['label'] = "All products";
                $data['json_fetch_link'] = URL_X.'Product/index_json';
            }
            
            $data['total_products'] = $this->product_model->get_total_products();
            $data['total_uncategorized_products'] = $this->product_model->get_total_categorized_products(1000);
            
           // $this->load->model("product_category_model");
           // $data['categories']=$this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/list_all_products",$data);
            $this->load->view("template/footer");
    }
    
    public function index_json(){
        $this->load->model("product_model");
        if($this->input->get('product_category_id')){
            $category_id = $this->input->get('product_category_id');
            $products = $this->product_model->get_all_entries_joined($category_id);
        }else{
            $products = $this->product_model->get_all_entries_joined(null);
        }
        
        
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }
    
    public function show_catalogue(){
        $this->load->view('catalogue');
    }

    public function add_new() {
        if($this->input->post('product_name')) {
            
            $this->load->model("product_model");
            
            $this->product_model->insert($this->input->post("product_name"),
                    $this->input->post("product_brand"),
                    $this->input->post("product_category"),
                    $this->input->post("product_description")
                    );
            $this->index();
        } else {
            $this->load->model("product_category_model");
            $data['categories']=$this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/add_new",$data);
            $this->load->view("template/footer");
        }
    }

    public function delete($id=NULL) {
         if($this->input->post('id')) {
             $this->load->model("product_model");
             $this->product_model->delete($this->input->post('id'));
             $this->index();
        } else {
            $this->load->model("product_model");
            $data['product'] = $this->product_model->get_one_product($id);
            
            $this->load->view("template/header");
            $this->load->view("product/delete",$data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id=NULL) {
        if($id){
            $this->load->model("product_model");
            $data['product'] = $this->product_model->get_one_product($id);
            $this->load->model("product_category_model");
            $data['categories']=$this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/edit",$data);
            $this->load->view("template/footer");
        }
        else if($this->input->post('product_name')) {
            $this->load->model("product_model");
            
            $this->product_model->edit($this->input->post("id"),
                    $this->input->post("product_name"),
                    $this->input->post("product_brand"),
                    $this->input->post("product_category"),
                    $this->input->post("product_description")
                    );
            $this->index();
        } else {
            $this->load->model("product_category_model");
            $data['categories']=$this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/edit",$data);
            $this->load->view("template/footer");
        }
    }
    
   

}

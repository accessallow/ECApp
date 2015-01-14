<?php
//done
class Product extends CI_Controller {
    public function __construct(){
    
            parent::__construct();
           
    }

    public function index() {
            $this->load->model("product_model");
            $data["products"] = $this->product_model->get_all_entries();
            $this->load->model("product_category_model");
            $data['categories']=$this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/list_all_products",$data);
            $this->load->view("template/footer");
    }
    
    public function index_json(){
        $this->load->model("product_model");
        $products = $this->product_model->get_all_entries_joined();
        
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

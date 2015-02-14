<?php

class Product_category extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model("product_category_model");
        $data["categories"] = $this->product_category_model->get_all_entries();
        $data['json_fetch_link'] = site_url('Product_category/index_json');
        
        $this->load->view("template/header");
        $this->load->view("product/category/list_all_categories", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        $this->load->model("product_category_model");
        $categories = $this->product_category_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($categories));
    }

    public function add_new() {
        if ($this->input->post('product_category_name')) {

            $this->load->model("product_category_model");

            $this->product_category_model->insert($this->input->post("product_category_name"));
            $this->index();
        } else {
            $this->load->view("template/header");
            $this->load->view("product/category/add_new");
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
            $this->load->model("product_category_model");
            $this->product_category_model->delete($this->input->post('id'));
            $this->index();
        } else {
            $this->load->model("product_category_model");
            $data['category'] = $this->product_category_model->get_one_category($id);

            $this->load->view("template/header");
            $this->load->view("product/category/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->load->model("product_category_model");
            $data['category'] = $this->product_category_model->get_one_category($id);
            $this->load->view("template/header");
            $this->load->view("product/category/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('product_category_name')) {
            $this->load->model("product_category_model");

            $this->product_category_model->edit($this->input->post("id"), $this->input->post("product_category_name")
            );
            $this->index();
        } else {
            $this->load->view("template/header");
            $this->load->view("product/category/edit");
            $this->load->view("template/footer");
        }
    }

}

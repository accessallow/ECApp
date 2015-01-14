<?php

class Seller extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model("seller_model");
        $data["sellers"] = $this->seller_model->get_all_entries();
        $this->load->view("template/header");
        $this->load->view("seller/list_all", $data);
        $this->load->view("template/footer");
    }
     public function index_angular() {
       
        $this->load->view("template/header");
        $this->load->view("seller/list_all_sellers");
        $this->load->view("template/footer");
    }
    public function index_json(){
        $this->load->model("seller_model");
        $sellers = $this->seller_model->get_all_entries();
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($sellers));
    }

    public function add_new() {
        if ($this->input->post('seller_name')) {

            $this->load->model("seller_model");

            $this->seller_model->insert($this->input->post("seller_name"), $this->input->post("seller_phone_number"), $this->input->post("seller_address"));
            $this->index();
        } else {
            $this->load->view("template/header");
            $this->load->view("seller/add_new");
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
            $this->load->model("seller_model");
            $this->seller_model->delete($this->input->post('id'));
            $this->index();
        } else {
            $this->load->model("seller_model");
            $data['seller'] = $this->seller_model->get_one_seller($id);

            $this->load->view("template/header");
            $this->load->view("seller/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->load->model("seller_model");
            $data['seller'] = $this->seller_model->get_one_seller($id);
            $this->load->view("template/header");
            $this->load->view("seller/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('seller_name')) {
            $this->load->model("seller_model");

            $this->seller_model->edit($this->input->post("id"), $this->input->post("seller_name"), $this->input->post("seller_phone_number"), $this->input->post("seller_address"));
            $this->index();
        } else {
            $this->load->view("template/header");
            $this->load->view("seller/edit");
            $this->load->view("template/footer");
        }
    }

}

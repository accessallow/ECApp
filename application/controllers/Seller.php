<?php

class Seller extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index_old() {
        $this->load->model("seller_model");
        $data["sellers"] = $this->seller_model->get_all_entries();
        $this->load->view("template/header");
        $this->load->view("seller/list_all", $data);
        $this->load->view("template/footer");
    }

    // now this is new and current
    public function index() {
        $this->load->model("seller_model");
        $data['total_sellers_alive'] = $this->seller_model->get_total_number_of_sellers(array("tag" => SellerTags::$available));

        if ($this->input->get('product_id')) {
            // it means now we will have to mention sellers who
            // sell the product having this product_id
            $product_id = $this->input->get('product_id');
            $data['fetch_json_link'] = URL_X . 'Seller/index_json?product_id=' . $product_id;
            //lets fetch that product_details
            $this->load->model('product_model');
            $r = $this->product_model->get_one_product($product_id);
            $product_name = $r[0]->product_name;
            $data['label'] = "Sellers who sell the Product : ".$product_name;
        } else {
            $data['fetch_json_link'] = URL_X . 'Seller/index_json';
            $data['label'] = "All sellers";
        }
        $this->load->view("template/header");
        $this->load->view("seller/list_all_sellers", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        $this->load->model("seller_model");
        //empty object
        $sellers = null;
        // now the if condition
        if ($this->input->get('product_id')) {
            // take that product_id from GET input set
            $product_id = $this->input->get('product_id');
            //now we will call up get_all_entries with another argument
            $sellers = $this->seller_model->get_all_entries($product_id);
        } else {
            //we passed null because we want all sellers this time
            $sellers = $this->seller_model->get_all_entries(null);
            //our model is smart.it will handle the difference :D
        }

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

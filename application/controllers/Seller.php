<?php

class Seller extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('seller_model');
    }

    public function index_old() {

        $data["sellers"] = $this->seller_model->get_all_entries();
        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("seller/list_all", $data);
        $this->load->view("template/footer");
    }

    // now this is new and current
    public function index() {

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
            $product_brand = $r[0]->product_brand;
            $data['label'] = "Sellers who sell the Product : " . $product_name . "- "
                    . "<small>Brand: " . $product_brand . '</small>';
            //set a different label for the add button
            $data['addButtonLabel'] = "Attach a seller to this product";
            $data['add_link'] = URL_X . 'Product_seller_mapping/add_new_seller_to_a_product/' . $product_id;
            //we are dealing with a mapping so edit link will not be present
            $data['delete_link'] = URL_X . 'Product_seller_mapping/delete_a_mapping/';
        } else {
            // full seller list page
            $data['edit_link'] = URL_X . 'Seller/edit/';
            $data['delete_link'] = URL_X . 'Seller/delete/';
            $data['fetch_json_link'] = URL_X . 'Seller/index_json';
            $data['label'] = "All sellers";
            $data['addButtonLabel'] = "Add a seller to system";
            $data['add_link'] = URL_X . 'Seller/add_new/';
        }
        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("seller/list_all_sellers", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {

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



            $this->seller_model->insert(
                    $this->input->post("seller_name"), $this->input->post("seller_phone_number"), $this->input->post("seller_mail_id"), $this->input->post("seller_tin_number"), $this->input->post("seller_address"));
            $this->session->set_flashdata('Seller saved');
            redirect('Seller/add_new');
        } else {
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("seller/add_new");
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {

            $this->seller_model->delete($this->input->post('id'));
            redirect('Seller');
        } else {

            $data['seller'] = $this->seller_model->get_one_seller($id);

            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("seller/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id) {

            $data['seller'] = $this->seller_model->get_one_seller($id);
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("seller/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('seller_name')) {


            $this->seller_model->edit(
                    $this->input->post("id"), $this->input->post("seller_name"), $this->input->post("seller_phone_number"), $this->input->post("seller_mail_id"), $this->input->post("seller_tin_number"), $this->input->post("seller_address"));
            redirect('Seller');
        } else {
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("seller/edit");
            $this->load->view("template/footer");
        }
    }

    public function get_one_seller_json($seller_id) {

        $s = $this->seller_model->get_one_seller($seller_id);
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($s));
    }

    public function single_seller($seller_id) {
        $data = null;
        
        $seller = $this->seller_model->get_one_seller($seller_id);
        $seller = $seller[0];

        $data = $seller;
        $data->seller_edit_link = site_url('Seller/edit/' . $seller->id);
        $data->seller_delete_link = site_url('Seller/delete/' . $seller->id);
        $data->products_count = $this->seller_model->count_my_products($seller->id);
        $data->view_my_products_link = site_url('Product?seller_id=' . $seller->id);
        
        $data->inventory_count = $this->seller_model->count_my_inventory($seller->id);
        $data->view_my_inventory_link = site_url('Inventory?seller_id=' . $seller->id);
       
        $data->upload_new_link = site_url('FileUpload/add_new?attachment_type=2&attachment_id='.$seller->id);
        $data->uploads_json_fetch_link = site_url('FileUpload/get_uploads/'.$seller->id.'/2');
        $data->upload_base = base_url('assets/uploads/');
        
        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("seller/single_seller", $data);
        $this->load->view("template/footer");
    }

}

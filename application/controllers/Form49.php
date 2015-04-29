<?php

class Form49 extends MY_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model("form49_model");
    }

    // functions that spit a view
    public function index() {
        $this->load->model("product_model");
        // $data["products"] = $this->product_model->get_all_entries();
        $data = null;

        if ($this->input->get('product_category_id')) {
            $category_id = $this->input->get('product_category_id');
            $this->load->model('product_category_model');
            $categoryObject = $this->product_category_model->get_one_category($category_id);
            $data['category_name'] = $categoryObject[0]->product_category_name;
            $data['total_products_under_this_category'] = $this->product_model->get_total_categorized_products($category_id);

            $data['label'] = "Products under category : " . $categoryObject[0]->product_category_name;
            $data['get_all_link'] = '<a class="badge" href="' . URL_X . 'Product/">Get all</a>';
            $data['json_fetch_link'] = URL_X . 'Product/index_json?product_category_id=' . $category_id;
            $data['addButtonLabel'] = "Add a product to catalogue";
            $data['add_link'] = URL_X . "Product/add_new";
        } elseif ($this->input->get('seller_id')) {
            $seller_id = $this->input->get('seller_id');
            $this->load->model('seller_model');
            $r = $this->seller_model->get_one_seller($seller_id);
            $sellerObj = $r[0];
            $seller_name = $sellerObj->seller_name;
            $data['label'] = "Products from seller :" . $seller_name;
            // you need to set label
            // you need to set json_fetch_link
            $data['json_fetch_link'] = URL_X . 'Product/get_products_from_this_seller?seller_id=' . $seller_id;
            $data['addButtonLabel'] = "Attach a product to this seller";
            $data['add_link'] = URL_X . "Product/add_new";
            $data['detach_link'] = URL_X . 'Product_seller_mapping/delete_a_mapping/';
        } else {
            $data['label'] = "All form49 records";
            $data['json_fetch_link'] = site_url('Form49/index_json');
            $data['addButtonLabel'] = "Add a form to records";
            $data['add_link'] = site_url("Form49/add_new");
        }

        $data['total_products'] = $this->product_model->get_total_products(array('tag' => 1));
        $data['total_uncategorized_products'] = $this->product_model->get_total_categorized_products(1000);

        // $this->load->model("product_category_model");
        // $data['categories']=$this->product_category_model->get_all_entries();
        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("form49/dashboard", $data);
        $this->load->view("template/footer");
    }

    public function get($id) {

        $f = $this->form49_model->get_all_entries_joined($id);
        $f = $f[0];


        $data['form'] = $f;

        $data['form_edit_link'] = site_url('Form49/edit/' . $id);
        $data['form_delete_link'] = site_url('Form49/delete/' . $id);

        $data['upload_new_link'] = site_url('FileUpload/add_new?attachment_type=4&attachment_id=' . $id);
        $data['uploads_json_fetch_link'] = site_url('FileUpload/get_uploads/' . $id . '/4');
        $data['upload_base'] = base_url('assets/uploads/');

        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("form49/single", $data);
        $this->load->view("template/footer");
    }

    public function add_new() {
        if ($this->input->post('shop_name')) {

//                 These two lines where removed from the code below
//                'product' => $this->input->post('product'),
//                'description' => $this->input->post('description'),


            $f = array(
            'shop_name' => $this->input->post('shop_name'),
            'address' => $this->input->post('address'),
            'tin_number' => $this->input->post('tin_number'),
            'invoice_number' => $this->input->post('invoice_number'),
            'form_number' => $this->input->post('form_number'),
            'form_date' => $this->input->post('form_date'),
            'date' => $this->input->post('date'),
            'total_value' => $this->input->post('total_value'),
            'total_quantity' => $this->input->post('total_quantity'),
            'dispatch_location' => $this->input->post('dispatch_location'),
            'destination' => $this->input->post('destination'),
            'category' => $this->input->post('category'),
            'transport_value' => $this->input->post('transport_value'),
            'billty_number' => $this->input->post('billty_number'),
            'vehicle_number' => $this->input->post('vehicle_number'),
            'form_c' => $this->input->post('form_c'),
            'product_percent' => $this->input->post('product_percent'),
            'cst_percent' => $this->input->post('cst_percent')
            );

            $this->form49_model->insert($f);

            $this->session->set_flashdata('message', 'Form saved.');

            redirect('Form49/add_new');
        } else {
            $this->load->model('key_value_model');

            if ($this->key_value_model->get_value('seller_id') != null) {
                $data['seller'] = true;
                $this->load->model('seller_model', 'sm');
                $seller = $this->sm->get_one_seller($this->key_value_model->get_value('seller_id'));
                $seller = $seller[0];
                $data['seller_data'] = $seller;
            }
            if ($this->input->get('seller_id')) {
                $data['seller'] = true;
                $this->load->model('seller_model', 'sm');
                $seller = $this->sm->get_one_seller($this->input->get('seller_id'));
                $seller = $seller[0];
                $data['seller_data'] = $seller;
            }
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();

            $this->load->model('product_model');
            $data['products'] = $this->product_model->get_all_entries_joined();

            $data['form_submit_url'] = site_url('Form49/add_new');
            $data['back_url'] = site_url('Form49');


            $data['set_date'] = $this->key_value_model->get_value('date');

            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("form49/add_new", $data);
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {

            $this->form49_model->delete($this->input->post('id'));
            redirect('Form49');
        } else {

            $data['delete_form_url'] = site_url('Form49/delete/' . $id);
            $data['confirmation_line'] = "Are you sure want to delete this form entry?";
            $data['back_url'] = site_url('Form49');
            $data['item_id'] = $id;

            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("common/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id == null) {
            redirect('Form49');
        }
        if ($this->input->post('shop_name')) {

            $f = array(
                'shop_name' => $this->input->post('shop_name'),
                'address' => $this->input->post('address'),
                'tin_number' => $this->input->post('tin_number'),
                'invoice_number' => $this->input->post('invoice_number'),
                'form_number' => $this->input->post('form_number'),
                'form_date' => $this->input->post('form_date'),
                'date' => $this->input->post('date'),
                'total_value' => $this->input->post('total_value'),
                'total_quantity' => $this->input->post('total_quantity'),
                'dispatch_location' => $this->input->post('dispatch_location'),
                'destination' => $this->input->post('destination'),
                'category' => $this->input->post('category'),
                'transport_value' => $this->input->post('transport_value'),
                'billty_number' => $this->input->post('billty_number'),
                'vehicle_number' => $this->input->post('vehicle_number'),
                'form_c' => $this->input->post('form_c'),
                'product_percent' => $this->input->post('product_percent'),
                'cst_percent' => $this->input->post('cst_percent')
            );
            $this->form49_model->edit($id, $f);

            redirect('Form49');
        } else {
            $data['edit'] = true;
            $f = $this->form49_model->get_one_form(array(
                'id' => $id
            ));
            $data['form'] = $f[0];
            $data['form_submit_url'] = site_url('Form49/edit/' . $id);
            $data['back_url'] = site_url('Form49');


            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("form49/add_new", $data);
            $this->load->view("template/footer");
        }
    }

    // functions that spit json
    public function index_json() {
        $forms = null;
        $this->load->model("form49_model");
        if ($this->input->get('product_category_id')) {
            $category_id = $this->input->get('product_category_id');
            $forms = $this->form49_model->get_all_entries_joined($category_id);
        } else {
            $forms = $this->form49_model->get_all_entries_joined();
        }


        $this->output->set_content_type('application/json')
                ->set_output(json_encode($forms));
    }

}

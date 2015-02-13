<?php

class Form49 extends CI_Controller {

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
            $data['label'] = "All form records";
            $data['json_fetch_link'] = site_url('Form49/index_json');
            $data['addButtonLabel'] = "Add a form to records";
            $data['add_link'] = site_url("Form49/add_new");
        }

        $data['total_products'] = $this->product_model->get_total_products(array('tag' => 1));
        $data['total_uncategorized_products'] = $this->product_model->get_total_categorized_products(1000);

        // $this->load->model("product_category_model");
        // $data['categories']=$this->product_category_model->get_all_entries();
        $this->load->view("template/header");
        $this->load->view("form49/dashboard", $data);
        $this->load->view("template/footer");
    }

    public function single_product($product_id) {
        $this->load->model('product_model');
        $p = $this->product_model->get_one_product_joined($product_id);
        $p = $p[0];

        //Data for panel-1
        $data['id'] = $p->id;
        $data['product_name'] = $p->product_name;
        $data['category'] = $p->product_category;
        $data['brand'] = $p->product_brand;
        $data['description'] = $p->product_description;

        $data['product_edit_link'] = site_url('Product/edit/' . $product_id);
        $data['product_delete_link'] = site_url('Product/delete/' . $product_id);

        //data for panel-2
        $data['sellers_count'] = $this->product_model->count_my_sellers($product_id);
        $data['best_rate'] = $this->product_model->my_best_rate($product_id);
        $data['best_seller'] = $this->product_model->my_best_seller($product_id);
        $data['stock'] =  $p->stock;
        $data['do_stock_zero_link'] = site_url('Product/DoStockZero/'.$p->id);

        $this->load->view("template/header");
        $this->load->view("product/single_product", $data);
        $this->load->view("template/footer");
    }
    
    public function add_new() {
        if ($this->input->post('shop_name')) {

            
            
            $f = array(
                'shop_name' => $this->input->post('shop_name'),
                'address' => $this->input->post('address'),
                'tin_number' => $this->input->post('tin_number'),
                'invoice_number' => $this->input->post('invoice_number'),
                'date' => $this->input->post('date'),
                'total_value' => $this->input->post('total_value'),
                'total_quantity' => $this->input->post('total_quantity'),
                'dispatch_location' => $this->input->post('dispatch_location'),
                'destination' => $this->input->post('destination'),
                'category' => $this->input->post('category'),
                'product' => $this->input->post('product'),
                'description' => $this->input->post('description'),
                'transport_value' => $this->input->post('transport_value'),
                'billty_number' => $this->input->post('billty_number'),
                'vehicle_number' => $this->input->post('vehicle_number'),
                'form_c' => $this->input->post('form_c')
            );

            $this->form49_model->insert($f);
            
            
            redirect('Form49/add_new');
        } else {
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            
            $this->load->model('product_model');
            $data['products'] = $this->product_model->get_all_entries_joined(); 
            
            $data['form_submit_url'] = site_url('Form49/add_new');
            $data['back_url'] = site_url('Form49');
            
            $this->load->view("template/header");
            $this->load->view("form49/add_new", $data);
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('id')) {
            $this->load->model("product_model");
            $this->product_model->delete($this->input->post('id'));
            redirect('Product');
        } else {
            $this->load->model("product_model");
            $data['product'] = $this->product_model->get_one_product($id);

            $this->load->view("template/header");
            $this->load->view("product/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id) {
            $this->load->model("product_model");
            $data['product'] = $this->product_model->get_one_product($id);
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/edit", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('product_name')) {
            $this->load->model("product_model");

            $this->product_model->edit($this->input->post("id"),
                    $this->input->post("product_name"),
                    $this->input->post("product_brand"), 
                    $this->input->post("product_category"), 
                    $this->input->post("product_description"),
                    $this->input->post('stock')
            );
           redirect('Product');
        } else {
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("product/edit", $data);
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

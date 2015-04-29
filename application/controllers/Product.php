<?php

class Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

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
            $data['add_link'] = URL_X . "Product_seller_mapping/add_new_product_to_a_seller/".$seller_id;
            $data['detach_link'] = URL_X . 'Product_seller_mapping/delete_a_mapping/';
        } else {
            $data['label'] = "All products";
            $data['json_fetch_link'] = URL_X . 'Product/index_json';
            $data['addButtonLabel'] = "Add a product to catalogue";
            $data['add_link'] = URL_X . "Product/add_new";
        }

        $data['total_products'] = $this->product_model->get_total_products(array('tag' => 1));
        $data['total_uncategorized_products'] = $this->product_model->get_total_categorized_products(1000);

        // $this->load->model("product_category_model");
        // $data['categories']=$this->product_category_model->get_all_entries();



        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("product/list_all_products", $data);
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
        $data['stock'] = $p->stock;
        $data['do_stock_zero_link'] = site_url('Product/DoStockZero/' . $p->id);
        //attachment type = 1 for product
        $data['upload_new_link'] = site_url('FileUpload/add_new?attachment_type=1&attachment_id=' . $p->id);
        $data['uploads_json_fetch_link'] = site_url('FileUpload/get_uploads/' . $p->id . '/1');
        $data['upload_base'] = base_url('assets/uploads/');

        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("product/single_product", $data);
        $this->load->view("template/footer");
    }

    public function DoStockZero($product_id) {
        $this->load->model('product_model');
        $this->product_model->update_my_stock($product_id, 0);
        redirect('Product/single_product/' . $product_id);
    }

    public function index_json() {
        $this->load->model("product_model");
        if ($this->input->get('product_category_id')) {
            $category_id = $this->input->get('product_category_id');
            $products = $this->product_model->get_all_entries_joined($category_id);
        } else {
            $products = $this->product_model->get_all_entries_joined(null);
        }


        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }

    public function get_sellers_for_this_product() {
        $sellers = null;
        if ($this->input->get('product_id')) {
            $product_id = $this->input->get('product_id');
            $this->load->model('seller_model');
            $sellers = $this->seller_model->get_sellers_for_this_product($product_id);
        } else {
            $sellers = null;
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($sellers));
    }

    public function get_products_from_this_seller() {
        $products = null;
        if ($this->input->get('seller_id')) {
            $seller_id = $this->input->get('seller_id');
            $this->load->model('product_model');
            $products = $this->product_model->get_products_from_this_seller($seller_id);
        } else {
            //nothing..
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }

    public function give_me_price() {
        if ($this->input->get('product_id') &&
                $this->input->get('seller_id')) {

            $product_id = $this->input->get('product_id');
            $seller_id = $this->input->get('seller_id');
            $this->load->model('product_seller_mapping_model');
            $result = $this->product_seller_mapping_model->give_me_price($product_id, $seller_id);

            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($result));
        }
    }

    public function show_catalogue() {
        $this->load->view('catalogue');
    }

    public function add_new() {
        if ($this->input->post('product_name')) {

            $this->load->model("product_model");

            $this->product_model->insert($this->input->post("product_name"), $this->input->post("product_brand"), $this->input->post("product_category"), $this->input->post("product_description")
            );
            $this->session->set_flashdata('message', 'Product saved.');

            redirect('Product/add_new');
        } else {
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();

            $this->load->model('key_value_model');
            $data['category_id'] = $this->key_value_model->get_value('category_id');


            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("product/add_new", $data);
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

            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("product/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        
        if ($this->input->post('product_name')) {
            
            $this->load->model("product_model");

            $this->product_model->edit($this->input->post("id"), $this->input->post("product_name"), $this->input->post("product_brand"), $this->input->post("product_category"), $this->input->post("product_description"), $this->input->post('stock')
            );
            redirect('Product');
        }elseif ($id) {
           
            $this->load->model("product_model");
            $data['product'] = $this->product_model->get_one_product($id);
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $data['form_submit_url'] = site_url('Product/edit/'.$id);
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("product/edit", $data);
            $this->load->view("template/footer");
        } else {
            
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("product/edit", $data);
            $this->load->view("template/footer");
        }
    }
    
    public function save_varient($id = NULL) {
        if ($this->input->post('product_name')) {
            $this->load->model("product_model");

            $this->product_model->insert($this->input->post("product_name"), $this->input->post("product_brand"), $this->input->post("product_category"), $this->input->post("product_description")
            );
            redirect('Product');
        } elseif ($id) {
            $this->load->model("product_model");
            $data['product'] = $this->product_model->get_one_product($id);
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $data['form_submit_url'] = site_url('Product/save_varient/'.$id);
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("product/edit", $data);
            $this->load->view("template/footer");
        }else {
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("product/edit", $data);
            $this->load->view("template/footer");
        }
    }
    

}

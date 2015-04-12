<?php

//done
class Inventory extends MY_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->model('inventory_model');

        $data = null;
        $product_id = null;
        $product_name = null;
        $seller_id = null;
        $seller_name = null;
        $date = null;

        $product_id = $this->input->get('product_id');
        $seller_id = $this->input->get('seller_id');
        $date = $this->input->get('date');

        //if nothing is set
        $sum = $this->inventory_model->get_sum_of_payments(null, null);
        $data['sum'] = $sum[0]->payment;

        if ($product_id) {
            // $product_id = $this->input->get('product_id');
            $this->load->model('product_model');
            $productObject = $this->product_model->get_one_product_no_matter_what($product_id);
            $sum = $this->inventory_model->get_sum_of_payments($product_id, NULL);
            $data['sum'] = $sum[0]->payment;
            $data['product_id'] = $product_id;
            $data['product_name'] = $productObject[0]->product_name;
            $product_name = $productObject[0]->product_name;
        }
        if ($seller_id) {
            //$seller_id = $this->input->get('seller_id');
            $this->load->model('seller_model');
            $sellerObject = $this->seller_model->get_one_seller_no_matter_what($seller_id);
            $sum = $this->inventory_model->get_sum_of_payments(NULL, $seller_id);
            $data['sum'] = $sum[0]->payment;
            $data['seller_id'] = $this->input->get('seller_id');
            $data['seller_name'] = $sellerObject[0]->seller_name;
            $seller_name = $sellerObject[0]->seller_name;
        }
        if ($date) {
            //$date = $this->input->get('date');
            $sum = $this->inventory_model->get_sum_of_payments(NULL, null, $date);
            $data['sum'] = $sum[0]->payment;
            $data['date'] = $date;
        }


        if ($product_id && $seller_id && $date) {
            $data = array(
                'url' => site_url('Inventory/index_json?product_id=' . $product_id . "&seller_id=" . $seller_id . "&date=" . $date),
                'label' => "Inventories for Product : " . $product_name . " for seller: $seller_name for Date : $date",
                'should_set_link' => 1,
                'seller_url' => site_url('Inventory?product_id=' . $product_id . '&date=' . $date . '&seller_id='),
                'date_url' => site_url('Inventory?product_id=' . $product_id . '&seller_id=' . $seller_id . '&date='),
                'add_new_link' => site_url('Inventory/add_new?product_id=' . $product_id),
                'add_new_label' => "Attach an inventory to this product"
            );
        } elseif ($product_id && $seller_id) {
            $data = array(
                'url' => site_url('Inventory/index_json?product_id=' . $product_id . "&seller_id=" . $seller_id),
                'label' => "Inventories for Product :  $product_name by Seller : $seller_name",
                'should_set_link' => 1,
                'seller_url' => site_url("Inventory?product_id=$product_id&seller_id="),
                'date_url' => site_url("Inventory?product_id=$product_id&seller_id=$seller_id&date="),
                'add_new_link' => site_url('Inventory/add_new?product_id=' . $product_id),
                'add_new_label' => "Attach an inventory to this product"
            );
        } elseif ($product_id && $date) {
            $data = array(
                'url' => site_url('Inventory/index_json?product_id=' . $product_id . "&date=" . $date),
                'label' => "Inventories for Product : $product_name on Date : $date",
                'should_set_link' => 1,
                'seller_url' => site_url("Inventory?product_id=$product_id&date=$date&seller_id="),
                'date_url' => site_url("Inventory?product_id=$product_id&date="),
                'add_new_link' => site_url('Inventory/add_new?product_id=' . $product_id),
                'add_new_label' => "Attach an inventory to this product"
            );
        } elseif ($seller_id && $date) {
            $data = array(
                'url' => site_url('Inventory/index_json?seller_id=' . $seller_id . "&date=" . $date),
                'label' => "Inventories for Seller : $seller_name on Date: $date",
                'should_set_link' => 1,
                'seller_url' => site_url("Inventory?seller_id="),
                'date_url' => site_url("Inventory?seller_id=$seller_id&date="),
                'add_new_link' => site_url('Inventory/add_new?product_id=' . $product_id),
                'add_new_label' => "Attach an inventory to this product",
            );
        } elseif ($product_id) {
            $data = array(
                'url' => site_url('Inventory/index_json?product_id=' . $product_id),
                'label' => "Inventories for Product : " . $product_name,
                'should_set_link' => 1,
                'seller_url' => site_url("Inventory?product_id=$product_id&seller_id="),
                'date_url' => site_url("Inventory?product_id=$product_id&date="),
                'add_new_link' => site_url('Inventory/add_new?product_id=' . $product_id),
                'add_new_label' => "Attach an inventory to this product"
            );
        } elseif ($seller_id) {
            $data = array(
                'url' => site_url('Inventory/index_json?seller_id=' . $seller_id),
                'label' => "Inventories for Seller : " . $seller_name,
                'should_set_link' => 1,
                'seller_url' => site_url("Inventory?seller_id="),
                'date_url' => site_url("Inventory?seller_id=$seller_id&date="),
                'add_new_link' => site_url('Inventory/add_new?seller_id=' . $seller_id),
                'add_new_label' => "Attach an inventory to this seller"
            );
        } elseif ($date) {
            $data = array(
                'url' => site_url('Inventory/index_json?date=' . $date),
                'label' => "Inventories for date : " . $date,
                'should_set_link' => 1,
                'seller_url' => site_url("Inventory?date=$date&seller_id="),
                'date_url' => site_url("Inventory?date="),
                'add_new_link' => site_url('Inventory/add_new'),
                'add_new_label' => "Add new inventory"
            );
        } else {
            $data = array(
                'url' => site_url('Inventory/index_json'),
                'label' => "All Inventories",
                'should_set_link' => 0,
                'seller_url' => site_url("Inventory?seller_id="),
                'date_url' => site_url("Inventory?date="),
                'add_new_link' => site_url('Inventory/add_new'),
                'add_new_label' => "Add new inventory"
            );
        }



        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("inventory/list_all_inventory", $data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        $this->load->model("inventory_model");
        $product_id = null;
        $seller_id = null;
        $date = null;

        if ($this->input->get('product_id'))
            $product_id = $this->input->get('product_id');
        if ($this->input->get('seller_id'))
            $seller_id = $this->input->get('seller_id');
        if ($this->input->get('date'))
            $date = $this->input->get('date');


//        if ($product_id && $seller_id && $date) {
//            $products = $this->inventory_model->get_all_entries_joined_extended($product_id, $seller_id, $date);
//        } elseif ($product_id && $seller ) {
//            $products = $this->inventory_model->get_all_entries_joined_extended($product_id, $seller_id, null);
//        }elseif ($product_id && $date) {
//            $products = $this->inventory_model->get_all_entries_joined_extended($product_id, null, $date);
//        } elseif ($seller_id && $date) {
//            $products = $this->inventory_model->get_all_entries_joined_extended(null, $seller_id, $date);
//        }elseif ($product_id) {
//            $products = $this->inventory_model->get_all_entries_joined_extended($product_id, null, null);
//        } else if ($seller_id) {
//            $products = $this->inventory_model->get_all_entries_joined_extended(null, $seller_id, null);
//        } else if ($date) {
//            $products = $this->inventory_model->get_all_entries_joined_extended(null, null, $date);
//        } else {
//            $products = $this->inventory_model->get_all_entries_joined_extended(null, null, null);
//        }

        $products = $this->inventory_model->get_all_entries_joined_extended($product_id, $seller_id, $date);

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }

    public function add_new() {
        if ($this->input->post('product_id')) {

            $this->load->model("inventory_model");

            $date = new DateTime($this->input->post('date'));
            //insert into inventory
            $this->inventory_model->insert(
                    $this->input->post("product_id"), $this->input->post("quantity"), $this->input->post("payment"), $this->input->post("seller_id"), $this->input->post("rate"), date_format($date, 'Y-m-d'), $this->input->post("description")
            );
            //get product details, update its stock
            $this->load->model('product_model');
            $p = $this->product_model->get_one_product($this->input->post('product_id'));
            $p = $p[0];
            $currentStock = $p->stock;
            $newStock = $currentStock + $this->input->post('quantity');
            $this->product_model->update_my_stock($p->id, $newStock);
            //update mapping with new price (or same price)
            $this->load->model('product_seller_mapping_model');
            $this->product_seller_mapping_model->insert(
                    $this->input->post('product_id'), $this->input->post('seller_id'), $this->input->post('rate')
            );
            $this->session->set_flashdata('message', 'Inventory saved.');
            //graceful redirect
            redirect('Inventory/add_new');
        } else {
            // just show the form to fill
            $data = null;
            //setting up conditional variables
            if ($this->input->get('product_id')) {
                $data['product_id'] = $this->input->get('product_id');
            }
            $this->load->model('key_value_model');

            if ($this->key_value_model->get_value('seller_id') != null) {
                $data['seller'] = true;
                $this->load->model('seller_model', 'sm');
                $seller = $this->sm->get_one_seller($this->key_value_model->get_value('seller_id'));
                $seller = $seller[0];
                $data['seller_data'] = $seller;
                $data['seller_id'] = $seller->id;
            }

            if ($this->input->get('seller_id')) {
                $data['seller_id'] = $this->input->get('seller_id');
            }

            $this->load->model("seller_model");
            $data["sellers"] = $this->seller_model->get_all_entries(null);
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->model("product_model");
            $data["products"] = $this->product_model->get_all_entries_joined();

            $this->load->model('key_value_model');
            $data['set_date'] = $this->key_value_model->get_value('date');

            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("inventory/add_new_inventory", $data);
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('inventory_id')) {
            $this->load->model("inventory_model");
            $this->inventory_model->delete($this->input->post('inventory_id'));
            redirect('Inventory');
        } else {

            $this->load->model("inventory_model");
            //  $inventoryObject = $this->inventory_model->get_one_inventory_joined($id)[0];
            $r = $this->inventory_model->get_one_inventory_joined($id);
            $inventoryObject = $r[0];

            $data['inventory_id'] = $inventoryObject->id;
            $data['product_name'] = $inventoryObject->product_name;
            $data['seller_name'] = $inventoryObject->seller_name;
            $data['rate'] = $inventoryObject->rate;
            $data['date'] = $inventoryObject->date;
            $data['quantity'] = $inventoryObject->quantity;
            $data['payment'] = $inventoryObject->payment;
            $data['description'] = $inventoryObject->description;

            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("inventory/delete_inventory", $data);
            $this->load->view("template/footer");
        }
    }

    public function edit($id = NULL) {
        if ($id) {
            //sent inventory object
            $this->load->model("inventory_model");
            $data['inventory'] = $this->inventory_model->get_one_inventory($id);

            // now sending product_list
            // ghost alert : using witchcraft spell
            $this->load->model("product_model");
            $data['products'] = $this->product_model->get_all_entries_no_matter_what();

            // ghost alert : using witchcraft spell
            $this->load->model("seller_model");
            $data["sellers"] = $this->seller_model->get_all_entries_no_matter_what();


            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("inventory/edit_inventory", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('product_id')) {

            // this will execute if post data is sent to this function : updating the data
            $this->load->model("inventory_model");
            $date = new DateTime($this->input->post('date'));

            $this->inventory_model->edit($this->input->post("inventory_id"), $this->input->post("product_id"), $this->input->post("quantity"), $this->input->post("payment"), $this->input->post("seller_id"), $this->input->post("rate"), date_format($date, 'Y-m-d'), $this->input->post("description")
            );


            redirect('Inventory');
        } else {


            //this wont execute just wrote is for fun
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("inventory/edit_inventory", $data);
            $this->load->view("template/footer");
        }
    }

    public function single_inventory($id) {
        $data['upload_new_link'] = site_url('FileUpload/add_new?attachment_type=3&attachment_id=' . $id);
        $data['uploads_json_fetch_link'] = site_url('FileUpload/get_uploads/' . $id . '/3');
        $data['upload_base'] = base_url('assets/uploads/');

        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("inventory/single_inventory", $data);
        $this->load->view("template/footer");
    }

}

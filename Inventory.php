<?php

//done
class Inventory extends CI_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $this->load->view("template/header");
        $this->load->view("inventory/list_all_inventory");
        $this->load->view("template/footer");
    }

    public function index_json() {
        $this->load->model("inventory_model");
        $products = $this->inventory_model->get_all_entries_joined();

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }

    public function add_new() {
        if ($this->input->post('product_id')) {

            $this->load->model("inventory_model");



            $this->inventory_model->insert(
                    $this->input->post("product_id"), 
                    $this->input->post("quantity"), 
                    $this->input->post("payment"), 
                    $this->input->post("seller_id"),
                    $this->input->post("date"),
                    $this->input->post("description")
            );

            $this->index();
        } else {
            $this->load->model("seller_model");
            $data["sellers"] = $this->seller_model->get_all_entries();
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->model("product_model");
            $data["products"] = $this->product_model->get_all_entries();

            $this->load->view("template/header");
            $this->load->view("inventory/add_new_inventory", $data);
            $this->load->view("template/footer");
        }
    }

    public function delete($id = NULL) {
        if ($this->input->post('inventory_id')) {
            $this->load->model("inventory_model");
            $this->inventory_model->delete($this->input->post('inventory_id'));
            $this->index();
        } else {
            
            $this->load->model("inventory_model");
            $inventoryObject = $this->inventory_model->get_one_inventory_joined($id)[0];
            
            $data['inventory_id'] = $inventoryObject->id;
            $data['product_name'] = $inventoryObject->product_name;
            $data['seller_name'] = $inventoryObject->seller_name;
            $data['date'] = $inventoryObject->date;
            $data['quantity'] = $inventoryObject->quantity;
            $data['payment'] = $inventoryObject->payment;
            $data['description'] = $inventoryObject->description;

            $this->load->view("template/header");
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
            
            
            $this->load->view("template/header");
            $this->load->view("inventory/edit_inventory", $data);
            $this->load->view("template/footer");
            
            
            
        } else if ($this->input->post('product_id')) {
            
            // this will execute if post data is sent to this function : updating the data
            $this->load->model("inventory_model");

            $this->inventory_model->edit($this->input->post("inventory_id"),
                    $this->input->post("product_id"), 
                    $this->input->post("quantity"), 
                    $this->input->post("payment"), 
                    $this->input->post("seller_id"),
                    $this->input->post("date"),
                    $this->input->post("description")
            );
            $this->index();
            
            
            
        } else {
            
            
            //this wont execute just wrote is for fun
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->view("template/header");
            $this->load->view("inventory/edit_inventory", $data);
            $this->load->view("template/footer");
        }
    }

}

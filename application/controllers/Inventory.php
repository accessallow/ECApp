<?php

//done
class Inventory extends MY_Controller {

    public function __construct() {

        parent::__construct();
    }

    public function index() {
        $data=null;
        if($this->input->get('product_id')){
            $product_id = $this->input->get('product_id');
            
            $this->load->model('product_model');
            $productObject = $this->product_model->get_one_product_no_matter_what($product_id);
            
            $this->load->model('inventory_model');
            $sum =$this->inventory_model->get_sum_of_payments($product_id,NULL);
            $data['sum'] = $sum[0]->payment;
            
            $data['product_id'] = $product_id;
            $data['product_name'] = $productObject[0]->product_name;
            
        }elseif($this->input->get('seller_id')){
            $seller_id = $this->input->get('seller_id');
            
            $this->load->model('seller_model');
            $sellerObject = $this->seller_model->get_one_seller_no_matter_what($seller_id);
            
            $this->load->model('inventory_model');
            $sum =$this->inventory_model->get_sum_of_payments(NULL,$seller_id);
            $data['sum'] = $sum[0]->payment;
            
            
            $data['seller_id'] = $this->input->get('seller_id');
            $data['seller_name'] = $sellerObject[0]->seller_name;
        }else{
            $this->load->model('inventory_model');
            $sum =$this->inventory_model->get_sum_of_payments(null,null);
            $data['sum'] = $sum[0]->payment;
        }
        $this->load->view("template/header",$this->activation_model->get_activation_data());
        $this->load->view("inventory/list_all_inventory",$data);
        $this->load->view("template/footer");
    }

    public function index_json() {
        $this->load->model("inventory_model");
        $products=NULL;
        
        if ($this->input->get('product_id')) {
            $products = $this->inventory_model->get_all_entries_joined_extended($this->input->get('product_id'),NULL);
        } else if ($this->input->get('seller_id')) {
            $products = $this->inventory_model->get_all_entries_joined_extended(NULL,$this->input->get('seller_id'));
        }else{
            $products = $this->inventory_model->get_all_entries_joined_extended(NULL,NULL);
        }

        $this->output->set_content_type('application/json')
                ->set_output(json_encode($products));
    }

    public function add_new() {
        if ($this->input->post('product_id')) {

            $this->load->model("inventory_model");

            $date = new DateTime($this->input->post('date'));
            //insert into inventory
            $this->inventory_model->insert(
                    $this->input->post("product_id"), 
                    $this->input->post("quantity"),
                    $this->input->post("payment"), 
                    $this->input->post("seller_id"),
                    $this->input->post("rate"), 
                    date_format($date, 'Y-m-d'), 
                    $this->input->post("description")
            );
            //get product details, update its stock
            $this->load->model('product_model');
            $p = $this->product_model->get_one_product($this->input->post('product_id'));
            $p = $p[0];
            $currentStock = $p->stock;
            $newStock = $currentStock + $this->input->post('quantity');
            $this->product_model->update_my_stock($p->id,$newStock);
            //update mapping with new price (or same price)
            $this->load->model('product_seller_mapping_model');
            $this->product_seller_mapping_model->insert(
                    $this->input->post('product_id'),
                    $this->input->post('seller_id'),
                    $this->input->post('rate')
                    );
            
            //graceful redirect
            redirect('Inventory/add_new');
        } else {
            // just show the form to fill
            $data = null;
            //setting up conditional variables
            if($this->input->get('product_id')){
                $data['product_id'] = $this->input->get('product_id');
            }
            if($this->input->get('seller_id')){
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

            $this->load->view("template/header",$this->activation_model->get_activation_data());
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

            $this->load->view("template/header",$this->activation_model->get_activation_data());
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


            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("inventory/edit_inventory", $data);
            $this->load->view("template/footer");
        } else if ($this->input->post('product_id')) {

            // this will execute if post data is sent to this function : updating the data
            $this->load->model("inventory_model");
            $date = new DateTime($this->input->post('date'));

            $this->inventory_model->edit($this->input->post("inventory_id"), 
                    $this->input->post("product_id"), 
                    $this->input->post("quantity"),
                    $this->input->post("payment"), 
                    $this->input->post("seller_id"), 
                    $this->input->post("rate"),
                    date_format($date, 'Y-m-d'),  
                    $this->input->post("description")
            );
            
            
            redirect('Inventory');
        } else {


            //this wont execute just wrote is for fun
            $this->load->model("product_category_model");
            $data['categories'] = $this->product_category_model->get_all_entries();
            $this->load->view("template/header",$this->activation_model->get_activation_data());
            $this->load->view("inventory/edit_inventory", $data);
            $this->load->view("template/footer");
        }
    }

    public function single_inventory($id){
        $data['upload_new_link'] = site_url('FileUpload/add_new?attachment_type=3&attachment_id='.$id);
        $data['uploads_json_fetch_link'] = site_url('FileUpload/get_uploads/'.$id.'/3');
        $data['upload_base'] = base_url('assets/uploads/');
        
        $this->load->view("template/header",$this->activation_model->get_activation_data());
        $this->load->view("inventory/single_inventory", $data);
        $this->load->view("template/footer");
    }
}

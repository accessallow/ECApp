<?php

class Bill extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cart_model');
        $this->load->model('bill_model');
    }

    public function load_view_embedded($view, $data = null) {
        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view($view, $data);
        $this->load->view("template/footer");
    }

    public function index() {
        $data = array(
            'product_fetch_url' => site_url('Product/index_json'),
            'list1_append_url' => site_url('Bill/add_to_raw_list'),
            'reload_cart1_url' => site_url('Bill/view_list_1'),
            'cart_reset_url' => site_url('Bill/clear_list_1')
        );
        $this->load_view_embedded('bill/dashboard', $data);
    }

    public function view_list_1() {
//        $first_list = $this->cart_model->get_first_list();
//        foreach ($first_list as $f) {
//            echo "<li class=\"list-group-item\">".$f."</li>";
//        }
        $data['products'] = $this->cart_model->cart1_products();
        $this->load->view('bill/pallete', $data);
    }

    public function add_to_raw_list($product_id) {
        if ($this->cart_model->is_already_inside($product_id) == false) {
            $this->cart_model->add_product_to_cart1($product_id);
        }
    }

    public function view_list_2() {

        //$this->cart_model->add_product_to_cart2(3,3,1,1);


        $second_list = $this->cart_model->get_second_list();
        foreach ($second_list as $l) {
            echo "<br/>" . $l['product_id'] . ">>" . $l['rate'] . ">>" . $l['quantity'] . ">>" . $l['total'];
        }
    }

    public function add_to_final_list($product_id, $rate, $quantity, $total) {
        if ($this->cart_model->is_already_inside_cart2($product_id) == false) {
            $this->cart_model->add_product_to_cart2($product_id, $rate, $quantity, $total);
        }
    }

    public function minus_list_1($product_id) {
        $this->cart_model->remove_from_cart1($product_id);
    }

    public function minus_list_2($product_id) {
        $this->cart_model->remove_from_cart2($product_id);
    }

    public function clear_list_1() {
        $this->cart_model->clear_cart1();
    }

    public function clear_list_2() {
        $this->cart_model->clear_cart2();
    }

    public function add_new() {
        if ($this->input->post('bill_number')) {
            $bill = array(
                'bill_number' => $this->input->post('bill_number'),
                'seller_id' => $this->input->post('seller_id'),
                'total' => $this->input->post('total'),
                'cheque' => $this->input->post('cheque'),
                'cash' => $this->input->post('cash'),
                'pending' => $this->input->post('pending'),
                'date' => $this->input->post('date'),
            );
            $this->load->model('bill_model');
            $this->bill_model->add_new($bill);
            $this->set_success_flash("Payment bill saved successfully.");
            redirect('Bill/add_new');
        } else {
            $data = array(
                'back_url' => site_url('Bill/dashboard'),
                'form_submit_url' => site_url('Bill/add_new')
            );

            $this->load->model('key_value_model');
            $data['set_date'] = $this->key_value_model->get_value('date');


            $data['seller_id'] = $this->key_value_model->get_value('seller_id');

            if ($this->input->get('seller_id')) {
                $data['seller_id'] = $this->input->get('seller_id');
            }

            $this->load->model("seller_model");
            $data["sellers"] = $this->seller_model->get_all_entries(null);

            $this->load_view_embedded('bill/add_bill', $data);
        }
    }

    public function update($id) {
        if ($this->input->post('bill_id')) {
            $bill_id = $this->input->post('bill_id');
            $bill = array(
                'bill_number' => $this->input->post('bill_number'),
                'seller_id' => $this->input->post('seller_id'),
                'total' => $this->input->post('total'),
                'cheque' => $this->input->post('cheque'),
                'cash' => $this->input->post('cash'),
                'pending' => $this->input->post('pending'),
                'date' => $this->input->post('date'),
            );
            $this->load->model('bill_model');
            $this->bill_model->update($bill_id, $bill);
            //$this->set_success_flash("Payment bill saved successfully.");
            redirect('Bill/dashboard');
        } else {
            $bill = $this->bill_model->get_all($id);
            $bill = $bill[0];

            $data = array(
                'edit' => true,
                'bill' => $bill,
                'back_url' => site_url('Bill/dashboard'),
                'form_submit_url' => site_url('Bill/update/' . $id)
            );

//            $this->load->model('key_value_model');
//            $data['set_date'] = $this->key_value_model->get_value('date');
//            $data['seller_id'] = $this->key_value_model->get_value('seller_id');

            $this->load->model("seller_model");
            $data["sellers"] = $this->seller_model->get_all_entries(null);

            $this->load_view_embedded('bill/add_bill', $data);
        }
    }

    public function dashboard() {
        $bills = $this->bill_model->get_all();
        $this->load->model('seller_model');
        $sellers = $this->seller_model->get_all_entries();
        $s_array = null;
        foreach ($sellers as $s) {
            $s_array[$s->id] = $s->seller_name;
        }
        foreach ($bills as $b) {
            $b->seller_name = $s_array[$b->seller_id];
        }
        $data = array(
            'bills' => $bills,
            'addButtonLabel' => 'Add new payment bill',
            'add_link' => site_url('Bill/add_new'),
            'label' => 'Payment bills',
            'total_bills' => $this->bill_model->count_bills(array('tag' => 1)),
            'total_money' => $this->bill_model->sum_bills('total', array('tag' => 1))->total,
            'total_cash' => $this->bill_model->sum_bills('cash', array('tag' => 1))->cash,
            'total_cheque' => $this->bill_model->sum_bills('cheque', array('tag' => 1))->cheque,
            'total_pending' => $this->bill_model->sum_bills('pending', array('tag' => 1))->pending
        );
        $this->load_view_embedded("bill/dashboard", $data);
    }

    public function delete($id) {
        if ($this->input->post('id')) {

            $this->bill_model->delete($this->input->post('id'));
            redirect('Bill/dashboard');
        } else {

            $data['delete_form_url'] = site_url('Bill/delete/' . $id);
            $data['confirmation_line'] = "Are you sure want to delete this bill entry?";
            $data['back_url'] = site_url('Bill/dashboard');
            $data['item_id'] = $id;

            $this->load->view("template/header", $this->activation_model->get_activation_data());
            $this->load->view("common/delete", $data);
            $this->load->view("template/footer");
        }
    }

    public function single($id) {
        $data['upload_new_link'] = site_url('FileUpload/add_new?attachment_type=5&attachment_id=' . $id);
        $data['uploads_json_fetch_link'] = site_url('FileUpload/get_uploads/' . $id . '/5');
        $data['upload_base'] = base_url('assets/uploads/');

        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("bill/single", $data);
        $this->load->view("template/footer");
    }

}

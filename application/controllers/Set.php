<?php

class Set extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('key_value_model');
        $this->load->model('product_category_model', 'pcm');
        $this->load->model('seller_model', 'sm');
    }

    public function index() {
        $data = null;

/////////////////////////////////////////////////////////////////////////////
        if ($this->key_value_model->get_value('date')) {
            $data['date'] = $this->key_value_model->get_value('date');
            $data['message_date'] = "Date  : " . $data['date'];
        } else {
            $data['date'] = '';
            $data['message_date'] = 'No date set!';
        }

        if ($this->key_value_model->get_value('category_id')) {
            $c_id = $this->key_value_model->get_value('category_id');

            $data['category'] = $this->pcm->get_category_name($c_id);
            $data['category_id'] = $c_id;
            $data['message_category'] = "Category : " . $data['category'];
        } else {
            $data['category'] = '';
            $data['category_id'] = 0;
            $data['message_category'] = 'No category set!';
        }

        if ($this->key_value_model->get_value('seller_id')) {
            $s_id = $this->key_value_model->get_value('seller_id');
            $data['seller'] = $this->sm->get_seller_name($s_id);
            $data['seller_id'] = $s_id;
            $data['message_seller'] = "Seller : " . $data['seller'];
        } else {
            $data['seller'] = '';
            $data['seller_id'] = 0;
            $data['message_seller'] = 'No seller set!';
        }
////////////////////////////////////////////////////////////////////////////////
        if($this->input->get('seller_id')){
            $data['seller_id'] = $this->input->get('seller_id');
        }
        if($this->input->get('category_id')){
            $data['category_id'] = $this->input->get('category_id');
        }

///////////////////////////////////////////////////////////////////////////////
        if ($this->input->post('date')) {
            $this->key_value_model->set_value('date', $this->input->post('date'));
            $data['date'] = $this->input->post('date');
            $data['message'] = "<strong>New date set !!!</strong>"
                    . "<br/> Date  = " . $data['date'];
            //redirect('Set');
        }
        if ($this->input->post('category_id')) {
            $this->key_value_model->set_value('category_id', $this->input->post('category_id'));
            $data['category'] = $this->pcm->get_category_name(
                    $this->key_value_model->get_value('category_id')
            );
            $data['message_category'] = "<strong>New category set !!!</strong>"
                    . "<br/> Category  = " . $data['category'];
            //redirect('Set');
        }
        if ($this->input->post('seller_id')) {
            $this->key_value_model->set_value('seller_id', $this->input->post('seller_id'));
            $data['seller'] = $this->sm->get_seller_name(
                    $this->key_value_model->get_value('seller_id')
            );
            $data['message_seller'] = "<strong>New seller set !!!</strong>"
                    . "<br/> Seller  = " . $data['seller'];
            //redirect('Set');
        }
///////////////////////////////////////////////////////////////////////////////////
        $data['categories'] = $this->pcm->get_all_entries();
        $data['sellers'] = $this->sm->get_all_entries();


        $data['form_submit_url'] = site_url('Set');
        $data['back_url'] = site_url('Product');

        $this->load->view("template/header", $this->activation_model->get_activation_data());
        $this->load->view("set/dashboard", $data);
        $this->load->view("template/footer");
    }

}

<?php

class Activation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('activation_model');
    }

    public function index() {
        $this->previous_activations();
    }

    public function register() {
        if ($this->input->post('product_code')&&$this->input->post('product_key')
                &&$this->input->post('activator_name')) {
            
            $product_code = $this->input->post('product_code');
            $product_key = $this->input->post('product_key');
            $activator_name = $this->input->post('activator_name');
            
            $this->load->model('activation_model');
            $condition_1 = $this->activation_model->validate_key($product_code,$product_key);
            $condition_2 = $this->activation_model->is_this_activation_used($product_code);
            
            if($condition_1&&!$condition_2){
                $data = array(
                    'product_code' => $product_code,
                    'product_key'  => $product_key,
                    'activator_name' => $activator_name
                );
                $this->activation_model->add_activation($data);
                $this->activation_successful($data);
            }else{
                 $this->activation_failure();
            }
            
        } else {
            $this->load->view('register/header',$this->activation_model->get_activation_data());
            $this->load->view('register/activate');
            $this->load->view('register/footer');
        }
    }

    public function activation_successful($data) {
        $this->load->view('register/header',$this->activation_model->get_activation_data());
        $this->load->view('register/successful',$data);
        $this->load->view('register/footer');
    }
     public function activation_failure() {
        $this->load->view('register/header',$this->activation_model->get_activation_data());
        $this->load->view('register/failure');
        $this->load->view('register/footer');
    }

    public function previous_activations() {
        $this->load->view('register/header',$this->activation_model->get_activation_data());
        $this->load->view('register/previous');
        $this->load->view('register/footer');
    }

    public function index_json() {
        $this->load->model('activation_model');
        $activations = $this->activation_model->get_all_activations();
        
        foreach($activations as $a){
            $a->a_t = date('m/d/Y H:i:s',$a->a_t);
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($activations));
    }

}

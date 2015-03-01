<?php

class Date extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('key_value_model');
    }
    public function index(){
        $data = null; 
        
        if($this->key_value_model->get_value('date')){
            $data['date'] = $this->key_value_model->get_value('date');
            $data['message'] = "Date  = ".$data['date'];
        }else{
            $data['date'] =     '';
            $data['message'] = 'No date set!';
        }
        
        if($this->input->post('date')){
            $this->key_value_model->set_value('date',$this->input->post('date'));
            $data['date'] = $this->input->post('date');
            $data['message'] = "<strong>New date set !!!</strong>"
                    . "<br/> Date  = ".$data['date'];
        }
        
        
        $data['form_submit_url'] = site_url('Date');
        $data['back_url'] = site_url('Product');
        
        $this->load->view("template/header",$this->activation_model->get_activation_data());
        $this->load->view("date/dashboard",$data);
        $this->load->view("template/footer");
    }
}

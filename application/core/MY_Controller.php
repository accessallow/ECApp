<?php
//core/micontroller
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        
        //Authentication check
        if (1||$this->session->userdata('login')) {
            
            //Activation releted common code
            $this->load->model('activation_model');
            $this->activation_model->degrade();
            $activated = $this->activation_model->is_product_activated();
            if ($activated == false) {
                redirect('Activation/register');
            }
            
            
            
        } else {
                redirect('Front/login');
        }
    }

}
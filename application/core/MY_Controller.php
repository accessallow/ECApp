<?php

//core/micontroller
class MY_Controller extends CI_Controller {

    var $message = null;
    var $alert_type = null;
    var $icon_class = null;
    var $data = null;

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');


        //Authentication check
        if ($this->session->userdata('login')) {

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

    function set_success_flash($message) {
        $this->session->set_flashdata('alert_class', 'alert-success');
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('glyphicon_class', 'glyphicon-ok-circle');
    }

    function set_error_flash($message) {
        $this->session->set_flashdata('alert_class', 'alert-danger');
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('glyphicon_class', 'glyphicon-remove-circle');
    }

    function set_info_flash($message) {
        $this->session->set_flashdata('alert_class', 'alert-info');
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('glyphicon_class', 'glyphicon-info-sign');
    }

}

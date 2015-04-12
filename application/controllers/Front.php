<?php

class Front extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function login() {
        if ($this->input->post('password')) {
            $this->load->model('key_value_model');
            $pwd = $this->key_value_model->get_value('password');
            $p = $this->input->post('password');

            if (strcmp($pwd, $p) == 0) {
                $this->session->set_userdata('login', true);
                redirect('Product');
            } else {
                $this->session->set_flashdata('message', 'Login failure.');
                redirect('Front/login');
            }
        } else {

            $this->load->view('common/login');
        }
    }

    public function password() {
        $this->load->model('key_value_model');
        $data = null;
        if ($this->input->post('current_pwd') && $this->input->post('new_pwd')) {
            $a = $this->input->post('current_pwd');
            $b = $this->input->post('new_pwd');

            if (strcmp($a,$this->key_value_model->get_value('password'))==0) {
                
                $this->key_value_model->set_value('password',$b);
                
                $this->session->set_flashdata('message', 'Password changed.');
                $this->session->set_flashdata('glyph', 'glyphicon-ok');
                $this->session->set_flashdata('alert', 'success');
            } else {
                $this->session->set_flashdata('message', 'Password not changed.');
                $this->session->set_flashdata('glyph', 'glyphicon-remove');
                $this->session->set_flashdata('alert', 'danger');
            }
            
            redirect('Front/password');
        } else {
            $this->load->model('activation_model');
            $data['form_submit_url'] = site_url('Front/password');
        }

        $this->load->view('template/header', $this->activation_model->get_activation_data());
        $this->load->view('common/change_password', $data);
        $this->load->view('template/footer');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Front/login');
    }

}

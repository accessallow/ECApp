<?php

class Pg_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function check_auth(){
        if ($this->session->userdata('root')) {
            
        }else{
            redirect('Pg_admin/login');
        }
    }
    public function index() {
        if ($this->session->userdata('root')) {

            $data['form_submit_url'] = site_url('Pg_admin/create_key');

            $this->load->view('Pg_admin/header');
            $this->load->view('Pg_admin/navbar');
            $this->load->view('Pg_admin/home', $data);
            $this->load->view('Pg_admin/footer');
        } else {
            redirect('Pg_admin/login');
        }
    }

    public function login() {
        if ($this->input->post('username') && $this->input->post('password')) {

            $my_username = "fgsdf6stdfsfhdgfsd77t";
            $my_password = "hdhywvyf7fjfedkdjbhsfkk";


            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ((strcmp($username, $my_username) == 0) && (strcmp($password, $my_password) == 0)) {
                $login_data = array(
                    'name' => "Pankaj Tiwari",
                    'root' => true
                );
                $this->session->set_userdata($login_data);
                redirect('Pg_admin/');
            } else {
                redirect('Pg_admin/login');
            }
        } else {
            if ($this->session->userdata('root')) {
                redirect('Pg_admin/');
            } else {

                $data['form_submit_url'] = site_url('Pg_admin/login');
                //deliver a form
                $this->load->view('Pg_admin/header');
                $this->load->view('Pg_admin/login_form', $data);
                $this->load->view('Pg_admin/footer');
            }
        }
    }

    public function create_key() {
        if ($this->input->post('username') && $this->input->post('datetime') && $this->input->post('lease')) {
            $product_code_string = $this->input->post('username')
                    . ':' . $this->input->post('datetime') . ':' . $this->input->post('lease');

            $this->load->model('activation_model');
            $product_key = $this->activation_model->generate_key($product_code_string);

            $data['product_code'] = $product_code_string;
            $data['product_key'] = $product_key;
            $data['forward_link'] = site_url('Pg_admin');

            $this->load->view('Pg_admin/header');
            $this->load->view('Pg_admin/navbar');
            $this->load->view('Pg_admin/key_created', $data);
            $this->load->view('Pg_admin/footer');
            
            
        } else {
            redirect('Pg_admin');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('Pg_admin/login');
    }

}

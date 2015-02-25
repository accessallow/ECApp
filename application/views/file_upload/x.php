<?php

class FileUpload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index($error = null) {
        $data['files'] = scandir('./assets/uploads', 1);
        $data['error'] = $error['error'];
        $this->load->view('file_upload/file_view', $data);
    }

    public function upload() {
        $user = 'pankajtiwari';
        $time = time();
        $file_name = $user . '_' . $time;

        $config = array(
            'upload_path' => "./assets/uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'file_name' => $file_name
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('file_upload/upload_success', $data);
        } else {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('file_upload/file_view', $error);

            $this->index($error);
        }
    }

    public function insert() {
        $this->load->model('upload_model');
    }

    public function add_new() {
        if ($this->input->get('attachment_id') && $this->input->get('attachment_type')) {
            $data['attachment_id'] = $this->input->get('attachment_id');
            $data['attachment_type'] = $this->input->get('attachment_type');
            $data['back_url'] = site_url('Product/single_product/'.$this->input->get('attachment_id'));
            
            $this->load->view('template/header');
            $this->load->view('file_upload/new_upload', $data);
            $this->load->view('template/footer');
        }else{
            redirect('Product');
        }
    }
    public function upload_new() {
        $user = 'upload';
        $time = time();
        $file_name = $user . '_' . $time;

        $config = array(
            'upload_path' => "./assets/uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'file_name' => $file_name
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            $this->load->model('upload_model');
            
            $this->load->view('file_upload/upload_success', $data);
        } else {
            $error = array('error' => $this->upload->display_errors());
            //$this->load->view('file_upload/file_view', $error);

            $this->index($error);
        }
    }

}

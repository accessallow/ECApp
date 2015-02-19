<?php 
class FileUpload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index() {
        $this->load->view('file_upload/file_view', array('error' => ' ' ));
    }

    public function upload() {
        $config = array(
            'upload_path' => "./assets/uploads/",
            'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE
//            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
//            'max_height' => "768",
//            'max_width' => "1024"
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('file_upload/upload_success', $data);
        } else {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('file_upload/file_view', $error);
        }
    }

}

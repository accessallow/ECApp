<?php

class FileUpload extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('upload_model');
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

    public function add_new() {
        //only adding form
        if ($this->input->get('attachment_id') && $this->input->get('attachment_type')) {
            $data['attachment_id'] = $this->input->get('attachment_id');
            $data['attachment_type'] = $this->input->get('attachment_type');
            $data['back_url'] = site_url($this->get_controller($this->input->get('attachment_type'), 
                        $this->input->get('attachment_id')));

            $this->load->view('template/header', $this->activation_model->get_activation_data());
            $this->load->view('file_upload/new_upload', $data);
            $this->load->view('template/footer');
        } else {
            redirect('Product');
        }
    }

    public function upload_new() {
        if ($this->input->post('attachment_id') && $this->input->post('attachment_type')) {
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
                $upload_entry = array(
                    'attachment_type' => $this->input->post('attachment_type'),
                    'attachment_id' => $this->input->post('attachment_id'),
                    'description' => $this->input->post('upload_description'),
                    'file_name' => $data['upload_data']['file_name']
                );
                $this->upload_model->insert($upload_entry);

//                switch ($this->input->post('attachment_type')) {
//                    case 1:
//                        redirect('Product/single_product/' . $this->input->post('attachment_id'));
//                        //echo 'Product/single_product/'.$this->input->post('attachment_id');
//                        break;
//                    case 2:
//                        redirect('Seller/single/' . $this->input->post('attachment_id'));
//                        //echo 'Product/single_product/'.$this->input->post('attachment_id');
//                        break;
//                }
                redirect($this->get_controller($this->input->post('attachment_type'), 
                        $this->input->post('attachment_id')));

                //$this->load->view('file_upload/upload_success', $data);
            } else {
                $error = array('error' => $this->upload->display_errors());
                //$this->load->view('file_upload/file_view', $error);

                $this->index($error);
            }
        } else {
            echo "variables not set!!!\n";
        }
    }

    public function get_controller($attachment_type, $attachment_id) {
        $controller = null;
        switch ($attachment_type) {
            case 1: $controller = 'Product/single_product/' . $attachment_id;
                break;
            case 2: $controller = 'Seller/single_seller/' . $attachment_id;
                break;
            case 3: $controller = 'Inventory/single_inventory/' . $attachment_id;
                break;
            case 4: $controller = 'Form49/get/' . $attachment_id;
                break;
            case 5: $controller = 'Bill/single/' . $attachment_id;
                break;
        }
        return $controller;
    }

    public function get_uploads($attachment_id = null, $attachment_type = null) {
        if ($attachment_id != null && $attachment_type != null) {

            $this->load->model('upload_model');
            $r = $this->upload_model->get_all_uploads(
                    array(
                        'attachment_id' => $attachment_id,
                        'attachment_type' => $attachment_type
                    )
            );
            $this->output->set_content_type('application/json')
                    ->set_output(json_encode($r));
        } else {
            echo "No output";
        }
    }

    public function single($id, $attachment_type, $attachment_id) {

        $u = $this->upload_model->get_all_uploads(array(
            'id' => $id
        ));
        $upload = $u[0];

        $data['image_fq_name'] = base_url('assets/uploads/' . $upload->file_name);
        $data['description'] = $upload->description;


        $data['back_url'] = site_url($this->get_controller($attachment_type, $attachment_id));
        $data['form_submit_url'] = site_url("FileUpload/update/$id/$attachment_type/$attachment_id");
        $data['delete_link'] = site_url("FileUpload/delete/$id/$attachment_type/$attachment_id");
        $data['attachment_type'] = $attachment_type;
        $data['attachment_id'] = $attachment_id;

        $this->load->view('template/header', $this->activation_model->get_activation_data());
        $this->load->view('file_upload/upload_single', $data);
        $this->load->view('template/footer');
    }

    public function delete($id, $attachment_type, $attachment_id) {
        //@multiroute



        if ($this->input->post('id')) {

            $this->upload_model->delete($this->input->post('id'));
            redirect($this->get_controller($attachment_type, $attachment_id));
        }



        $data['back_url'] = site_url($this->get_controller($attachment_type, $attachment_id));
        $data['delete_form_url'] = site_url("FileUpload/delete/$id/$attachment_type/$attachment_id");
        $data['confirmation_line'] = 'Are you sure want to delete this upload?';
        $data['item_id'] = $id;

        $this->load->view('template/header', $this->activation_model->get_activation_data());
        $this->load->view('common/delete', $data);
        $this->load->view('template/footer');
    }

    public function update($id, $attachment_type, $attachment_id) {
        if ($this->input->post('attachment_type') && $this->input->post('attachment_id')) {
            $this->upload_model->update($id, $this->input->post('upload_description'));
            //echo "updated...";
        }
        redirect($this->get_controller($attachment_type, $attachment_id));
        //echo "update failed!";
    }

}

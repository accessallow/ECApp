<?php

class UploadTags{
    public static  $deleted = 0;
    public static  $available = 1;
}
class Upload_model extends CI_Model{
    
    var $attachment_id = null;
    var $attachment_type = null;
    var $file_name = null;
    var $description = null;
    var $tag = null;
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insert($data){
        $this->attachment_id = $data['attachment_id'];
        $this->attachment_type = $data['attachment_type'];
        $this->file_name = $data['file_name'];
        $this->description = $data['description'];
        $this->tag = UploadTags::$available;
        
        $this->db->insert('uploads',$this);
    }
    public function update($id,$decription){
        $this->db->update('uploads',array(
            'description' => $decription
        ),array(
            'id' => $id
        ));
    }
    public function get_all_uploads($where=null){
        
        $where['tag'] = UploadTags::$available;
        
        $query = $this->db->get_where('uploads',$where);
        return $query->result();
    }
    public function delete($id){
        $data = array(
            'tag'=>  UploadTags::$deleted
        );
        $this->db->update('uploads',$data,array('id'=>$id));
    }
}


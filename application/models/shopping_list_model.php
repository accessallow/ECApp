<?php
class Shopping_list_tags{
    public static $deleted = 0;
    public static $available = 1;
}

class Shopping_list_model extends CI_Model{
    var $list_name = "";
    var $date_created = "";
    var $date_modfied = "";
    var $tag = null;
    
    public function __construct() {
        $this->load->database();
    }
    public function get_all_entries(){
        $this->db->get_where('shopping_lists',array(
            'tag'=>  Shopping_list_tags::$available
        ));
    }
    public function get_one_entry($list_id){
        $query = $this->db->get_where('shopping_lists',
                    array(
                            'id'=>$list_id,
                            'tag'=>  Shopping_list_tags::$available
                    )
                );
        return $query->result();
    }
    public function add_entry($data){
        $this->list_name = $data['list_name'];
        $this->date_created = $data['date_created'];
        $this->date_modfied = $data['date_modified'];
        $this->tag = Shopping_list_tags::$available;
        $this->db->insert('shopping_lists',$this);
        //done : inserted
    }
    public function edit_entry($list_id,$data){
        $this->list_name = $data['list_name'];
        $this->date_created = $data['date_created'];
        $this->date_modfied = $data['date_modified'];
        $this->tag = Shopping_list_tags::$available;
        $this->db->update('shopping_lists',$this,array('id'=>$list_id));
        //done : update
    }
    public function delete_entry($list_id){
        $this->db->update('shopping_lists',
                array('tag'=>  Shopping_list_tags::$deleted),
                array('id'=>$list_id));
        // a graceful delete
    }
    public function get_shopping_list($list_id){
        //get all items from $list_id shopping list
    }
    
}
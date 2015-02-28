<?php

Class Shop extends MY_Controller{
  public function index(){
      $this->load->view("list_all_items");
  }  
  public function insert(){
      if($this->input->post('')){
          
      }
      
      
      $this->load->view("forms/insert_item");
  }
}
?>
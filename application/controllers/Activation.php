<?php

class Activation extends CI_Controller{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->load->model('activation_model');
        $p_code = "pankaj_tiwari";
        echo "p_code = ".$p_code."<br/>";
        $key = $this->activation_model->generate_key($p_code);
        echo "key = ".$key."<br/>";
        echo "___Validation___<br/>";
        echo $this->activation_model->validate_key($p_code,$key);
        
        echo "<br/><hr/>";
        
         $p_code = "pankaj_tiwari";
        echo "p_code = ".$p_code."<br/>";
        $key = $this->activation_model->generate_key($p_code);
        echo "key = ".$key."<br/>";
        echo "___Validation___<br/>";
        echo $this->activation_model->validate_key($p_code,$key);
        
    }
    
}
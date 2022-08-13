<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller{    
    function __construct(){
        parent::__construct();        
        $this->load->model('settings_model');         
    }

    public function index(){
       
    }

    public function getSettings(){                   
        echo json_encode($result= $this->settings_model->getSettings());        
    }

    public function updateDollarRate(){        
        echo json_encode($this->settings_model->updateDollarRate());
    }



}
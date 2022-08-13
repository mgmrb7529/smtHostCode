<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
    
    function __construct(){
        parent::__construct();

        $this->load->model('login_model');
    }

    public function index(){               
        $this->session->unset_userdata('validated');
        $this->load->view('users/login');
        $this->load->view('template/footer');
    }

    public function validate(){             
        $username = $this->input->post('userName');
        $pw=$this->input->post('password');               
      
        $result = $this->login_model->validate($username,$pw);        

         if(!$result){                         
             echo 0;
         }else{            
            echo 1;
         }                 
    }
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client extends CI_Controller{
    
    function __construct(){
        parent::__construct();        
         $this->load->model('client_model','client');
         $this->sd=$this->session->userdata();       
    }
    
    public function index(){        
        if (isset($this->sd['validated']) && ($this->sd['validated']==true) && ($this->sd['admin']==1)){            
           $this->load->view('template/header');
           $this->load->view('clients/index');
           $this->load->view('template/footer');
        }else{            
            header('Location:'.base_url());
        }       
    }
    
     public function showAll(){
        $query=  $this->client->showAll();
        if($query){
          $result['clients']  = $this->client->showAll();
        }
        echo json_encode($result);
    }


     public function addclient(){
        $config = array(
        array('field' => 'name',
              'label' => 'Name',
              'rules' => 'trim|required|max_length[50]'
             ),
        array('field' => 'email',
              'label' => 'Email',
              'rules' => 'trim|required|max_length[50]'
             ),
        array('field' => 'conPerson',
              'label' => 'Contact Person',
              'rules' => 'trim|required|max_length[50]'
             ),
        array('field' => 'mobileNo',
              'label' => 'Mobile No',
              'rules' => 'trim|required|max_length[10]'
             ),
        array('field' => 'telNo',
              'label' => 'Telephone No',
              'rules' => 'trim|max_length[10]'
             ),
        array('field' => 'expDate',
              'label' => 'Expire Date',
              'rules' => 'trim|required'
             ),
        array('field' => 'value',
              'label' => 'Price',
              'rules' => 'trim|required'
            ),
        array('field' => 'dollarValue',
            'label' => 'Dollar Price',
            'rules' => 'trim|required'
            )
         );    

        $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'name'=>form_error('name'),
                'email'=>form_error('email'),
                'conPerson'=>form_error('conPerson'),
                'mobileNo'=>form_error('mobileNo'),
                'telNo'=>form_error('telNo'),
                'expDate'=>form_error('expDate'),
                'value'=>form_error('value'),
                'dollarValue'=>form_error('dollarValue')
            );

         }else{
            $data = array(
            'name'=> $this->input->post('name'),
            'email'=> $this->input->post('email'), 
            'conPerson'=> $this->input->post('conPerson'), 
            'mobileNo'=> $this->input->post('mobileNo'), 
            'telNo'=> $this->input->post('telNo'), 
            'value'=> $this->input->post('value'), 
            'expDate'=> $this->input->post('expDate'), 
            'host'=>$this->input->post('host'),
            'dollarValue'=> $this->input->post('dollarValue') 
            );
          

            if($this->client->addclient($data)){
                   $result['error'] = false;
                   $result['msg'] ='client added successfully';
            }            
       } 
        echo json_encode($result);
      }


     public function updateClient(){        		
        $config = array(
        array('field' => 'name',
              'label' => 'Name',
              'rules' => 'trim|required'
             ),
        array('field' => 'email',
              'label' => 'Email',
              'rules' => 'trim|required'
             ),
        array('field' => 'conPerson',
              'label' => 'Contact Person',
              'rules' => 'trim|required'
             ),
        array('field' => 'mobileNo',
              'label' => 'Mobile No',
              'rules' => 'trim|required'
             ),
        array('field' => 'expDate',
              'label' => 'Expire Date',
              'rules' => 'trim|required'
             ),
        array('field' => 'value',
              'label' => 'Price',
              'rules' => 'trim|required'
            ),
        array('field' => 'dollarValue',
            'label' => 'Dollar Price',
            'rules' => 'trim|required'
            )
         );    

        $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'name'=>form_error('name'),
                'email'=>form_error('email'),
                'conPerson'=>form_error('conPerson'),
                'mobileNo'=>form_error('mobileNo'),
                'expDate'=>form_error('expDate'),
                'value'=>form_error('value'),
                'dollarValue'=>form_error('dollarValue')
            );

         }else{
            $inactive=0; 
            $id = $this->input->post('id');            
            if($this->input->post('inactive')==true){
                $inactive=1;
            }else{
                $inactive=0;
            }
            
                       
            $data = array(
            'name'=> $this->input->post('name'),
            'email'=> $this->input->post('email'), 
            'conPerson'=> $this->input->post('conPerson'), 
            'mobileNo'=> $this->input->post('mobileNo'), 
            'telNo'=> $this->input->post('telNo'), 
            'value'=> $this->input->post('value'), 
            'dollarValue'=> $this->input->post('dollarValue'), 
            'expDate'=> $this->input->post('expDate'),
            'host'=>$this->input->post('host'),
            'inactive'=>false
            );
                      
     

            if($this->client->updateClient($id,$data)){
                $result['error'] = false;
                $result['msg'] ='client added successfully';
            }else{
                $result['error'] = true;
                $result['msg'] ='There is an error';
            } 
        }      
        echo json_encode($result);
     }


    public function deleteClient(){
         $id = $this->input->post('id');
        if($this->client->deleteClient($id)){
             $msg['error'] = false;
             $msg['success'] = 'Client deleted successfully';
        }else{
             $msg['error'] = true;
        }
        echo json_encode($msg);
         
    }
    
    public function searchclient(){
         $value = $this->input->post('text');
          $query =  $this->client->searchclient($value);
           if($query){
               $result['clients']= $query;
           }
           
        echo json_encode($result);
         
    }

    public function getTotal(){
      $result=$this->client->getTotal();     
      echo json_encode($result);
    }

    public function get_monthTotal(){
      $result=$this->client->get_monthTotal();
      echo json_encode($result); 
    }

    public function getMonthList(){      
      $Monthno = $this->input->post('Monthno');
      $result=$this->client->getMonthList($Monthno);
      echo json_encode($result);
    }
    
    public function getPaymentHistory(){
        $id = $this->input->post('id');
        $result=$this->client->getPaymentHistory($id);
        echo json_encode($result);
    }
    
}
    

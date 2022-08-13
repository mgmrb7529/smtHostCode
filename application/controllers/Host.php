<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Host extends CI_Controller{
    
    function __construct(){
        parent::__construct();
         $this->load->model('host_model','host');
         $this->sd=$this->session->userdata();
    }
    public function index(){
        if (isset($this->sd['validated']) && ($this->sd['validated']==true)&& ($this->sd['admin']==1)){ 
            $this->load->view('template/header');
            $this->load->view('hosts/index');
            $this->load->view('template/footer');
        }else{            
            header('Location:'.base_url()); 
        } 
    }
    
     public function showAll(){
        $query= $this->host->showAll();
        if($query){
          $result['hosts']  = $this->host->showAll();
        }
        echo json_encode($result);
    }


     public function addhost(){
        $config = array(
        array('field' => 'company',
              'label' => 'Company',
              'rules' => 'trim|required|max_length[50]'
             ),
        array('field' => 'name',
              'label' => 'Name',
              'rules' => 'trim|required|max_length[50]'
             ),
        array('field' => 'url',
              'label' => 'url',
              'rules' => 'trim|required|max_length[50]'
             ),
        array('field' => 'expDate',
              'label' => 'Expire Date',
              'rules' => 'trim|required'
             ),
        array('field' => 'value',
              'label' => 'Price',
              'rules' => 'trim|required'
             )
         );    

        $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'company'=>form_error('company'),
                'name'=>form_error('name'),
                'url'=>form_error('url'),                
                'expDate'=>form_error('expDate'),
                'value'=>form_error('value')
            );

         }else{
            $data = array(
            'company'=> $this->input->post('company'),  
            'name'=> $this->input->post('name'),
            'url'=> $this->input->post('url'),             
            'value'=> $this->input->post('value'), 
            'expDate'=> $this->input->post('expDate'), 
            );

           

            if($this->host->addhost($data)){
                   $result['error'] = false;
                   $result['msg'] ='host added successfully';
            }            
       } 
        echo json_encode($result);
      }


     public function updateHost(){		
        $config = array(
        array('field' => 'company',
              'label' => 'Company',
              'rules' => 'trim|required'
             ),
        array('field' => 'name',
              'label' => 'Name',
              'rules' => 'trim|required'
             ),
        array('field' => 'url',
              'label' => 'url',
              'rules' => 'trim|required'
             ),        
        array('field' => 'expDate',
              'label' => 'Expire Date',
              'rules' => 'trim|required'
             ),
        array('field' => 'value',
              'label' => 'Price',
              'rules' => 'trim|required'
             )
         );    

        $this->form_validation->set_rules($config);
         if ($this->form_validation->run() == FALSE) {
            $result['error'] = true;
            $result['msg'] = array(
                'company'=>form_error('company'),
                'name'=>form_error('name'),
                'url'=>form_error('url'),                
                'expDate'=>form_error('expDate'),
                'value'=>form_error('value')
            );

         }else{
            $id = $this->input->post('id');
            $data = array(
            'company'=> $this->input->post('company'),  
            'name'=> $this->input->post('name'),
            'url'=> $this->input->post('url'),             
            'value'=> $this->input->post('value'), 
            'expDate'=> $this->input->post('expDate')
            );
            

            if($this->host->updatehost($id,$data)){
                $result['error'] = false;
                $result['msg'] ='host added successfully';
            } 
        }      
        echo json_encode($result);
     }


    public function deletehost(){
         $id = $this->input->post('id');
        if($this->host->deletehost($id)){
             $msg['error'] = false;
             $msg['success'] = 'host deleted successfully';
        }else{
             $msg['error'] = true;
        }
        echo json_encode($msg);
         
    }
    
    public function searchhost(){
         $value = $this->input->post('text');
          $query =  $this->host->searchhost($value);
           if($query){
               $result['hosts']= $query;
           }
           
        echo json_encode($result);
         
    }

    public function getTotal(){
      $result=$this->host->getTotal();     
      echo json_encode($result);
    }

    public function get_monthTotal(){
      $result=$this->host->get_monthTotal();
      echo json_encode($result); 
    }

    public function getMonthList(){      
      $HostID = $this->input->post('id');
      $result=$this->host->getMonthList($HostID);
      echo json_encode($result);
    }
}
    

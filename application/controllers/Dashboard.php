<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('dashboard_model'); 
        $this->load->model('invoice_model'); 
        $this->sd=$this->session->userdata();
    }

    public function index(){
        if (isset($this->sd['validated']) && ($this->sd['validated']==true)){ 
            $this->load->view('template/header');
            $this->load->view('dashboard/index');
            $this->load->view('template/footer');    
        }else{            
            header('Location:'.base_url());        
        } 
    }

    public function showInvoices(){
        $query ="";
        $query=  $this->dashboard_model->showInvoices();
        if($query){
          $result['invoices']  = $this->dashboard_model->showInvoices();
        } 
        echo json_encode($result);
    }

    public function updateReceipt(){
    	$id = $this->input->post('id');
        $dataForInvoice = array('paid'=> ($this->input->post('payment')+$this->input->post('paid')));
        $dataForReceipt=array(
                              'date' => date('y-m-d'),                               
                              'invoiceID'=>$this->input->post('id'),
                              'amount'=>$this->input->post('payment')
                            );         

        if($this->invoice_model->updateReceipt($id,$dataForInvoice,$dataForReceipt)){
            $result['error'] = false;
            $result['msg'] ='client added successfully';
        } 
        echo json_encode($result);
    }

    public function deleteInvoice(){
        $id=$this->input->post('id');
        $name=$this->input->post('name');        
        $dataForCustomer=array('expDate'=>$this->input->post('periodFrom'));
        
        if($this->invoice_model->deleteInvoice($id,$name,$dataForCustomer)){
            $result['error'] = false;
            $result['msg'] ='Invoice is deleted successfully';
        } 
        echo json_encode($result);
    }
    

    public function getPaidTot(){        
        echo json_encode($this->dashboard_model->getPaidTot());
    }

    private function sendInvoice(){
        echo "string";
        // $this->email->from('ceo@softmastergroup.com', 'Manjula');
        // $this->email->to('manjula7529@gmail.com'); 
        // $this->email->subject('Email Test');
        // $this->email->message('Testing the email class.');
        // $this->email->send();
    }
    
}
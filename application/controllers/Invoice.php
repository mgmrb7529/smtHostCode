<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoice extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('invoice_model');              
    }

    public function index(){
       
    }

    public function addInvoice(){ 
        $drate=$this->input->post('Drate');       
    	$mydate=date('y-m-d');
        $mydate=date_create($mydate);
        date_add($mydate,date_interval_create_from_date_string("30 day"));
        $mydate=date_format($mydate,"Y-m-d");
    	$this->invoice_model->addInvoice($mydate,$drate);
    }

    public function get_given_month_invoices(){      
      $Monthno = $this->input->post('Monthno');     
      $result=$this->invoice_model->get_given_month_invoices($Monthno);
      echo json_encode($result);
    }
    
}
<?php 
class Dashboard_model extends CI_Model{
	public function showInvoices(){
	   $this->db->select('`invoices`.`id`
    					, `invoices`.`date`
    					, `invoices`.`clientID`
    					, `clients`.`name`
    					, `invoices`.`description`
    					, `invoices`.`periodFrom`
    					, `invoices`.`periodTo`
    					, `invoices`.`amount`
                        , `invoices`.`amountInDollar`
    					, `invoices`.`paid`
    					, `clients`.`email`');
	   $this->db->from('invoices');
	   $this->db->join('clients','clients.id=invoices.clientID');
	   	
       //$this->db->where('paid',0);        
       $this->db->where('YEAR(date)', date('Y'));        
       $this->db->where('MONTH(date)', date('m'));
       $this->db->or_where('paid',0);        
       $query = $this->db->get();

        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getPaidTot(){
        $query=$this->db->query('SELECT SUM(`paid`) AS tp FROM `smthosting`.`invoices` where(MONTH(date)='.date('m').') and (YEAR(date)='.date('Y').')');
        if($query->num_rows() > 0){
            return $query->result_array()[0];
        }else{
            return 0;
        }
    }
	
}
<?php 
class Invoice_model extends CI_Model{
	
	public function addInvoice($mydate,$drate){
       
		$this->db->where('expDate<=', $mydate);
		$this->db->where('inactive=', 0);
		$query=$this->db->get('clients');

        if($query->num_rows() > 0){        	
            for($i = 0; $i<$query->num_rows(); $i++){
            	$date=$query->row($i)->expDate;
            	$nextDate=date_create($date);
				date_add($nextDate,date_interval_create_from_date_string("1 year"));
				$nextDate=date_format($nextDate,"Y-m-d");
            	
            	// Update expDate and Last Invice No
            	$field=array('expDate'=>$nextDate);
            	$this->db->where('id', $query->row($i)->id);
        		$this->db->update('clients', $field); 
        		//-----------------------------------
        		
	            $entries[] = array(
	                'date'=>$date,
	                'clientID'=>$query->row($i)->id,
	                'description'=>'Anual web hosting charges ',
	                'periodFrom'=>$date,
	                'periodTo'=>$nextDate,
	                'amount'=>$query->row($i)->value,
					'amountInDollar'=>$query->row($i)->dollarValue,
					'dollarRate'=>$drate
	            );	            
        	}

        	$this->db->insert_batch('invoices', $entries); 
       

		    if($this->db->affected_rows() > 0){
		       return true;
		    }else{
		       return false;
		    }
		    
        }else{
            return false;
        }
    }


    public function updateReceipt($id,$field,$data){
    	// Update Invoice Paid field
        $this->db->where('id', $id);
        $this->db->update('invoices', $field);      
        
        // Insert into Receipt
        return $this->db->insert('receipts', $data);
    }

    public function get_given_month_invoices($Monthno){
    	$query=$this->db->query("SELECT `invoices`.`id`,
    									`invoices`.`date`,
    									`clients`.`name`,
    									`invoices`.`periodFrom`,
    									`invoices`.`periodTo`,
    									`invoices`.`amount`,
										`invoices`.`amountInDollar`,
    									`invoices`.`paid`
									FROM
										`smthosting`.`clients`
    								INNER JOIN 
    									`smthosting`.`invoices` ON (`clients`.`id` = `invoices`.`clientID`)
    								WHERE (MONTH(`invoices`.`date`)=".$Monthno.")and(YEAR(`invoices`.`date`)=".date("Y").")");
    	if($query->num_rows() > 0){
			$queryTot=$this->db->query("SELECT SUM(amount) AS tot,SUM(`paid`) AS paidtot FROM invoices
										WHERE (MONTH(`invoices`.`date`)=".$Monthno.")and(YEAR(`invoices`.`date`)=".date("Y").")");
            
			$result['det']=$query->result();
			$result['sum']=$queryTot->result();
			return $result;
        }else{
            return false;
        }
    }

    public function deleteInvoice($id,$name,$data){
    	$this->db->where('name',$name);
    	$this->db->update('clients',$data);

    	$this->db->where('id', $id);
        return $this->db->delete('invoices');       

    }

    

}
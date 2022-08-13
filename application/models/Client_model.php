<?php 
class Client_model extends CI_Model{
    public function showAll(){
       $query = $this->db->get('clients');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
    public function addClient($data){
        return $this->db->insert('clients', $data);
    }

    public function updateClient($id,$field){
        
        $this->db->where('id', $id);
        $this->db->update('clients', $field);     

        
        if($this->db->affected_rows() >0){            
            return true;
        }else{            
            return false;
        }
    }

      public function deleteClient($id){
        $this->db->where('id', $id);
        $this->db->delete('clients');
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
        
       }

       public function getPaymentHistory($id){
            $query=$this->db->query("SELECT 
                                        `clients`.`id`,
                                        `clients`.`name`,
                                        `invoices`.`date`,
                                        `invoices`.`description`,
                                        `invoices`.`periodFrom`,
                                        `invoices`.`periodTo`,
                                        `invoices`.`amount`,
                                        `invoices`.`paid`,
                                        `invoices`.`id` as invNo
                                    FROM
                                        `smthosting`.`clients`
                                    INNER JOIN 
                                        `smthosting`.`invoices`
                                    ON 
                                        (`clients`.`id` = `invoices`.`clientID`)
                                    WHERE 
                                        (`clients`.`id`= ".$id.");");
            return $query->result();
       }

    public function searchClient($match) {
        $field = array('name','email','conPerson','mobileNo','TelNo');    
        $this->db->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get('clients');
         if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getTotal(){
        if ($this->session->userdata('admin')==1){
            // Anual Total
            $this->db->select_sum('value');  
            $this->db->where('inactive',0);      
            $result['anual'] = $this->db->get('clients')->row()->value;

            //Monthly Total
            $this->db->select_sum('value');
            $this->db->where('MONTH(expDate)', date('m'));
            $this->db->where('inactive',0);
            $result['month'] = $this->db->get('clients')->row()->value;
            return $result;
        }else{
            return false;
        }
    }

    public function get_monthTotal(){
        $query=$this->db->query('SELECT MONTHNAME(expDate) AS `Month` ,MONTH(expDate) AS `Monthno` ,SUM(`value`) AS `tot`,COUNT(`id`) AS `noof` FROM `smthosting`.`clients` WHERE `inactive`=0 GROUP BY `Monthno`');
        
        if(($query->num_rows() > 0)&&($this->session->userdata('admin')==1)){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getMonthList($Monthno){
        $query=$this->db->query('SELECT `name`,`value`,`expDate` FROM `smthosting`.`clients` WHERE (`inactive`=0)AND(MONTH(expDate) ='.$Monthno.');');
        
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }
}
?>
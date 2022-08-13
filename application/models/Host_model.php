<?php 
class Host_model extends CI_Model{
   
    public function showAll(){
 
       $query=$this->db->query('SELECT `hosts`.`id`,`hosts`.`name`,`hosts`.`url`,`hosts`.`expDate`,`hosts`.`value` , `hosts`.`company` , SUM(`clients`.`value`)AS inc 
            FROM   `smthosting`.`hosts` LEFT JOIN `smthosting`.`clients` ON (`hosts`.`id` = `clients`.`host`) 
            GROUP BY `hosts`.`id`, `hosts`.`name`, `hosts`.`url`, `hosts`.`expDate`, `hosts`.`value`, `hosts`.`company`'); 
       // $query = $this->db->get('hosts');
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }


    public function addHost($data){
        return $this->db->insert('hosts', $data);
    }

    public function updateHost($id,$field){
        $this->db->where('id', $id);
        $this->db->update('hosts', $field);       

        
        if($this->db->affected_rows() >0){            
            return true;
        }else{            
            return false;
        }
    }

      public function deleteHost($id){
        $this->db->where('id', $id);
        $this->db->delete('hosts');
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
        
       }

    public function searchHost($match) {
        $field = array('name','url');    
        $this->db->like('concat('.implode(',',$field).')',$match);
        $query = $this->db->get('hosts');
         if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    public function getMonthList($HostID){
        $query=$this->db->query('SELECT `name`,`value`,`expDate` FROM `smthosting`.`clients` WHERE (host ='.$HostID.');');
        
        if($query->num_rows() > 0){
            return $query->result();
        }else{
            return false;
        }
    }

    
}
?>
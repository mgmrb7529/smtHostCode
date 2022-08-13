<?php
    class Settings_model extends CI_Model{
        public function getSettings(){           
           
                      
            $query=$this->db->query("SELECT * FROM `settings`");
            return $query->result();
        }

        public function updateDollarRate(){
           
            // Get Today Dollar Rate --------------------------------
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://apilayer.net/api/live?access_key=6d7c2904f2a6a39eb1c6d4cf56667eeb&currencies=LKR&source=USD&format=1");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);     
            //-------------------------------------------------------
            $result=json_decode($output);
            if($result->success){
               //Update Database
               $rate=$result->quotes->USDLKR;
               $data = array('dollarRate' => $rate);
               $this->db->update('settings',$data);  
            }
            $query=$this->db->query("SELECT * FROM `settings`");
            return $query->result();
           //---------------------------------------------------------
        }

    }


?>
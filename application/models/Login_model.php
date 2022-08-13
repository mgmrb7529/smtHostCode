<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{
    function __construct() {
        parent::__construct();
        
    }

    public function validate($user,$pw){
     
        // grab user input
        $username = $this->security->xss_clean($user);
        $password = $this->security->xss_clean($pw);
        
       
        // Prep the query
           $this->db->where('userName', $username);
           $this->db->where('password', $password);               
          $query = $this->db->get('users');
                  
        if($query->num_rows() == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'userid' => $row->id,
                    'fname' => $row->fname,
                    'lname' => $row->lname,
                    'username' => $row->userName,
                    'admin'=>$row->admin,
                    'validated' => true
                    );

            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }
}
?>
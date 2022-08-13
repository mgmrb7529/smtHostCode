<?php
require APPPATH . 'libraries/REST_Controller.php';    

class Mobapp extends REST_Controller {
    public function __construct() { parent::__construct();}

	public function index_get()
	{
        
        $data = $this->db->get("m_employee")->result();
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');        
        $this->response($data, REST_Controller::HTTP_OK);
	}


    public function index_post(){
    } 


    public function index_put($id)
    {
    }

    public function index_delete($id)
    {
    }    	

}
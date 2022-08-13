<?php
require APPPATH . 'libraries/REST_Controller.php';    

class Invoice extends REST_Controller {
    public function __construct() { parent::__construct();}

	public function index_get($id = 0)
	{
        if(!empty($id)){
            $data = $this->db->get_where("invoices", ['id' => $id])->row_array();
        }else{
            $data = $this->db->get("invoices")->result();
        }   
        $this->response($data, REST_Controller::HTTP_OK);

	}


    public function index_post(){
        $input = $this->input->post();
        $this->db->insert('invoices',$input);
        $this->response(['Invoice created successfully.'], REST_Controller::HTTP_OK);
    } 


    public function index_put($id)
    {
        $input = $this->put();
        $this->db->update('invoices', $input, array('id'=>$id));
        $this->response(['Invoice updated successfully.'], REST_Controller::HTTP_OK);
    }

    public function index_delete($id)
    {
        $this->db->delete('invoices', array('id'=>$id));
        $this->response(['Invoice deleted successfully.'], REST_Controller::HTTP_OK);
    }    	

}
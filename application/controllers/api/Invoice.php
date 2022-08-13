<?php
require APPPATH . 'libraries/REST_Controller.php'; 
   

class Invoice extends REST_Controller {
    public function __construct() { parent::__construct();}

	public function index_get($id = 0)
	{
        // if(!empty($id)){
        //     $data = $this->db->get_where("invoices", ['id' => $id])->row_array();
        // }else{
        //     $data = $this->db->get("invoices")->result();            
        // }   

        $sql="SELECT
                          `invoices`.`id`,
                          `invoices`.`clientID`,
                          `invoices`.`amount`,
                          `invoices`.`paid`,
                          `clients`.`name`,
                          YEAR (DATE),
                          MONTH (DATE)
                        FROM
                          `invoices`
                          INNER JOIN `clients`
                            ON (
                              `invoices`.`clientID` = `clients`.`id`
                            )
                        WHERE (YEAR (date)=date ('Y')) AND (MONTH (date)=date ('m'))";
        
       //$this->db->where('paid',0);        
       //$this->db->where('YEAR(date)', date('Y'));        
       //$this->db->where('MONTH(date)', date('m'));
       //$this->db->or_where('paid',0);        
       
       $query=$this->db->query($sql);

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');

       $this->response($query->result(), REST_Controller::HTTP_OK);       
       
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

    public function showInvoices(){
       $this->db->select('`invoices`.`id`
                        , `invoices`.`date`
                        , `invoices`.`clientID`
                        , `clients`.`name`
                        , `invoices`.`description`
                        , `invoices`.`periodFrom`
                        , `invoices`.`periodTo`
                        , `invoices`.`amount`
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

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
    }
    
	public function index()
	{
		$data['reps']=array();
		$tbl=$this->session->userdata('prefix').'reps';
			// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['reps']=$this->Common_model->select($tbl);
		}
		
		$this->show_front('Rep/reps', $data);
	}
	// save location (edit or new)
	public function saveRep(){
		if($this->input->post('rep_name') && !empty($this->input->post('rep_name'))){
				// check loc code number of digits
			//$rep_name = $this->input->post('rep_name');
			$data=array(
					'name'=>$this->input->post('rep_name'),
					'rep_phone'=>$this->input->post('rep_phone')
				);
			$tbl=$this->session->userdata('prefix').'reps';
			// update row if loc id exist
			if($this->input->post('rep_id') and !empty($this->input->post('rep_id'))){
				$result=$this->Common_model->update($tbl, array('id_rep'=> $this->input->post('rep_id')), $data);

				if($result){ // in case when record successfully update
					echo 'OK::Rep has been updated Successfully::success::update';
				} else {
					echo 'OK::Rep Not Updated. Try again::error';
				}
			} 
			// if loc id not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					echo 'OK::New Rep has been added Successfully::success::add::'.$result;
				} else {
					echo 'OK::Rep Not Added. Try again::error';
				} // end of else
			} // end of outer else
	}// end of outer most if
	}// end of function

	// delete location 
	public function delRep(){
		if($this->input->post('repId') and !empty($this->input->post('repId'))){
			// delete row where opId match
			$tbl=$this->session->userdata('prefix').'reps';
			$result=$this->Common_model->delete($tbl, array('id_rep'=> $this->input->post('repId')));
			if($result>0){ // in case when record successfully deleted
				echo 'OK::Rep has been deleted Successfully::success';
			} else {
				echo 'OK::Rep Not Deleted. Try again::error';
			}
		} // end of if
	} // end of function

	public function getRepById(){
		if($this->input->post('repId') and !empty($this->input->post('repId'))){
			
			//$tbl=$this->session->userdata('prefix').'roomtypes';
			$tbl=$this->session->userdata('prefix').'reps';
			$where = array($tbl.'.id_rep'=> $this->input->post('repId'));
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($tbl, $tableList)){
				//$vehicles=$this->Common_model->select_fields_where($tbl, '*', array('id_location'=>$this->input->post('locId')));
				$rep=$this->Common_model->select_fields_where($tbl, '*', $where, true);
				if($rep){
					echo 'OK::Rep data fetched::success::'.json_encode($rep);
				} else {
					echo 'OK::Record Not found::error';
				}
			} 
			
		}// end of outer if
	} // end of function

}

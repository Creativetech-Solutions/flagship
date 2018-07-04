<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Touroperator extends MY_Controller {

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
    // main tour operators list page
	public function index()
	{
		$data['operators']=array();
		// get the touroperator from db
		$tbl=$this->session->userdata('prefix').'touroperator';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['operators']=$this->Common_model->select($tbl);
		} 
		$this->show_front('tour/tours', $data);
	}

	// delete tour operator  -- call by ajx
	public function delOperator(){
		if($this->input->post('opId') and !empty($this->input->post('opId'))){
			// delete row where opId match
			$tbl=$this->session->userdata('prefix').'touroperator';
			$result=$this->Common_model->delete($tbl, array('id'=> $this->input->post('opId')));
			if($result>0){ // in case when record successfully deleted
				echo 'OK::Tour Operator has been deleted Successfully::success';
			} else {
				echo 'OK::Tour Operator Not Deleted. Try again::error';
			}
		} // end of if
	} 

	// edit tour operator record -- call by ajax
	public function saveOperator(){ 
		if($this->input->post('op_name') and !empty($this->input->post('op_name'))){
			$data=array(
					'tour_operator'=>$this->input->post('op_name'),
					//'cell'=>$this->input->post('rep_cell')
				);
			$tbl=$this->session->userdata('prefix').'touroperator';
			// update row where opId exist
			if($this->input->post('opId') and !empty($this->input->post('opId'))){
				$result=$this->Common_model->update($tbl, array('id'=> $this->input->post('opId')), $data);

				if($result){ // in case when record successfully update
					echo 'OK::Tour Operator has been updated Successfully::success::update';
				} else {
					echo 'OK::Tour Operator Not Updated. Try again::error';
				}
			} 
			// if opId not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					//get record corresponding to that id
					$data=$this->Common_model->select_fields_where($tbl, '*', array('id'=>$result), true);
					if($data){ // in case if row successfully fetch
						echo 'OK::New Tour Operator has been added Successfully::success::add::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Tour Operator has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Tour Operator Not Added. Try again::error';
				} // end of else
			} // end of outer else
		}// end of outer most if
	} // end of function
}

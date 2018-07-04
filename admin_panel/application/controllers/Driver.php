<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends MY_Controller {

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
    // main Drivers list page
	public function index()
	{
		$data['drivers']=$data['vehicles']=array();
		// get the touroperator from db
		$tbl=$this->session->userdata('prefix').'transport';
		$tblVehicle=$this->session->userdata('prefix').'vehicles';
		$vdata=$tbl.'.* , COUNT('.$tblVehicle.'.id_vehicle) as TotalVehicles';
	    $join=array(
	  			array(
	  				'table'=>$tblVehicle,
	  				'condition'=> $tbl.'.id_transport = '.$tblVehicle.'.id_transport',
	  				'type'=>'LEFT'
	  				)
	  		);
	    $group_by=$tbl.'.id_transport';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['drivers']=$this->Common_model->select_fields_where_like_join($tbl, $vdata, $join,'','','','',$group_by);
			$data['vehicles'] = $this->Common_model->select($tblVehicle);
		} 
		$this->show_front('driver/drivers', $data);
	}

	// delete Driver  -- call by ajx
	public function delDriver(){
		if($this->input->post('drId') and !empty($this->input->post('drId'))){
			// delete row where opId match
			$tbl=$this->session->userdata('prefix').'transport';
			$result=$this->Common_model->delete($tbl, array('id_transport'=> $this->input->post('drId')));
			if($result>0){ // in case when record successfully deleted
				echo 'OK::Transport Supplier has been deleted Successfully::success';
			} else {
				echo 'OK::Transport Supplier Not Deleted. Try again::error';
			}
		} // end of if
	} 

	// edit Driver record -- call by ajax
	public function saveDriver(){ 
		if($this->input->post('dr_name') and !empty($this->input->post('dr_name'))){
			$data=array(
					'name'=>$this->input->post('dr_name')
				);
			$tbl=$this->session->userdata('prefix').'transport';
			// update row where opId exist
			if($this->input->post('drId') and !empty($this->input->post('drId'))){
				$result=$this->Common_model->update($tbl, array('id_transport'=> $this->input->post('drId')), $data);

				if($result){ // in case when record successfully update
					echo 'OK::Transport Supplier has been updated Successfully::success::update';
				} else {
					echo 'OK::Transport Supplier Not Updated. Try again::error';
				}
			} 
			// if drId not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					//get record corresponding to that id
					$data=$this->Common_model->select_fields_where($tbl, '*', array('id_transport'=>$result), true);
					if($data){ // in case if row successfully fetch
						echo 'OK::New Transport Supplier has been added Successfully::success::add::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Transport Supplier has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Driver Not Added. Try again::error';
				}
			} // end of else
		} // end of outer if
	}// end of save driver function

	// get vehicles list by driver id
	public function getVehicleByDrId(){
		if($this->input->post('drId') and !empty($this->input->post('drId'))){
			
			$tbl=$this->session->userdata('prefix').'vehicles';
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($tbl, $tableList)){
				$vehicles=$this->Common_model->select_fields_where($tbl, '*', array('id_transport'=>$this->input->post('drId')));
				if($vehicles){
					echo 'OK::Vehicles data fetched::success::'.json_encode($vehicles);
				} else {
					echo 'OK::Record Not found::error';
				}
			} 
			
		}// end of outer if
	} // end of function

	public function getDriverByVehicle(){

			$tbl=$this->session->userdata('prefix').'transport';
			$tblVehicle=$this->session->userdata('prefix').'vehicles';
			$vdata=$tbl.'.* , COUNT('.$tblVehicle.'.id_vehicle) as TotalVehicles';
		    $join=array(
		  			array(
		  				'table'=>$tblVehicle,
		  				'condition'=> $tbl.'.id_transport = '.$tblVehicle.'.id_transport',
		  				'type'=>'LEFT'
		  				)
		  		);
		    $group_by=$tbl.'.id_transport';
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
		    $where = '';
		if($this->input->post('transportId') && !empty($this->input->post('transportId'))){
		    $where = array($tblVehicle.'.id_transport'=>$this->input->post('transportId'));

		} // end of if
			if(in_array($tbl, $tableList) && in_array($tblVehicle, $tableList)){
			    $data['drivers'] = $this->Common_model->select_fields_where_like_join($tbl, $vdata, $join, $where, '','','',$group_by);
			    
				if($data['drivers']){
					$this->load->view('driver/drivers_list', $data); 
				} else {
					echo 'OK::Record Not found::error';
				}
			} 

	}// end of function
}

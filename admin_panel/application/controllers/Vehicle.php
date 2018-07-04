<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends MY_Controller {

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
	 * @see https://codeigniter.com/user_guid_vehiclee/general/urls.html
	 */
	public function __construct()
    {
        parent::__construct();
    }
    // main tour operators list page
	public function index()
	{
		$vdata['vehicles']=array();

		$tbl_vehicle=$this->session->userdata('prefix').'vehicles';
		$tbl_transport=$this->session->userdata('prefix').'transport';
		$data='*,'.$tbl_vehicle.'.name as vehicle_name, '.$tbl_transport.'.name as driver';
		$join=array(
					array(
					'table'=>$tbl_transport,
					'condition'=>$tbl_vehicle.'.id_transport='.$tbl_transport.'.id_transport',
					'type'=>'inner'
					)
				);
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl_vehicle, $tableList) and in_array($tbl_transport, $tableList)){
			$vdata['vehicles']=$this->Common_model->select_fields_where_like_join($tbl_vehicle, $data, $join);
		} 
		if(in_array($tbl_transport, $tableList)){
			$vdata['transporters']=$this->Common_model->select($tbl_transport);
		}
		$this->show_front('vehicle/vehicles', $vdata);
	}
// delete tour operator  -- call by ajx
	public function delVehicle(){
		if($this->input->post('vehicleId') and !empty($this->input->post('vehicleId'))){
			// delete row where vehicleid_vehicle match
			$tbl=$this->session->userdata('prefix').'vehicles';
			$result=$this->Common_model->delete($tbl, array('id_vehicle'=> $this->input->post('vehicleId')));
			if($result>0){ // in case when record successfully deleted
				echo 'OK::Vehicle has been deleted Successfully::success';
			} else {
				echo 'OK::Vehicle Not Deleted. Try again::error';
			}
		} // end of if
	} 

	// save vehicle record
	public function saveVehicle(){
		if($this->input->post('vehicle_name') and !empty($this->input->post('vehicle_name'))){
			$data=array(
					'name'=>$this->input->post('vehicle_name'),
					'id_transport'=>$this->input->post('transportId')
				);
			$tbl=$this->session->userdata('prefix').'vehicles';
			// update row if vehicleid exist
			if($this->input->post('vehicleId') and !empty($this->input->post('vehicleId'))){
				$result=$this->Common_model->update($tbl, array('id_vehicle'=> $this->input->post('vehicleId')), $data);

				if($result){ // in case when record successfully update
					$data=$this->getVehicle($this->input->post('vehicleId'));
					if($data){
						echo 'OK::Vehicle has been updated Successfully::success::update::'.json_encode($data);
					}
				} else {
					echo 'OK::Vehicle Not Updated. Try again::error';
				}
			} 
			// if vehicleid_vehicle not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					$data=$this->getVehicle($result);

					if($data){ // in case if row successfully fetch
						echo 'OK::New Vehicle has been added Successfully::success::add::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Tour Operator has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Vehicle Not Added. Try again::error';
				}
			} // end of else
		} // end of outer most if
	} // end of save vechile function

	function getVehicle($result){
		//get record corresponding to that id_vehicle
					//$data=$this->Common_model->select_fields_where($tbl, '*', array('id_vehicle'=>$result), true);
		$tbl=$this->session->userdata('prefix').'vehicles';
		$tbl_transport=$this->session->userdata('prefix').'transport';
		$data='*,'.$tbl.'.name as vehicle, '.$tbl_transport.'.name as driver';
		$join=array(
					array(
					'table'=>$tbl_transport,
					'condition'=>$tbl.'.id_transport='.$tbl_transport.'.id_transport',
					'type'=>'inner'
					)
				);
		$where=array($tbl.'.id_vehicle'=>$result);
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList) and in_array($tbl_transport, $tableList)){
			$data=$this->Common_model->select_fields_where_like_join($tbl, $data, $join, $where, true);
			return $data;
		} 

	}// end of getvehicle function

	// get data from table indicated by key
	public function getData(){
		if($this->input->post('tbl')){
			if($this->input->post('tbl')=='vehicles' or $this->input->post('tbl')=='transport'){
				$tbl=$this->session->userdata('prefix').$this->input->post('tbl');
				$tableList=getTables(); // define in custom helper
				// check if the tbl exist in db 
				if(in_array($tbl, $tableList)){
					$data=$this->Common_model->select($tbl);
					if($data){
						echo 'OK::Data Fetched::success::'.json_encode($data);
					} else {
						echo 'OK::Data not found::error';
					}
				} 
			} // end of inner if
		} // end of outermost if
	}// end of function getdata

	// get vehicle by id 
	public function getVehicleById(){
		if($this->input->post('vehicleId')){
			$data['vehicles']=array();

			$tbl_vehicle=$this->session->userdata('prefix').'vehicles';
			$tbl_transport=$this->session->userdata('prefix').'transport';
			$data='*,'.$tbl_vehicle.'.name as vehicle_name, '.$tbl_transport.'.name as driver';
			$join=array(
						array(
						'table'=>$tbl_transport,
						'condition'=>$tbl_vehicle.'.id_transport='.$tbl_transport.'.id_transport',
						'type'=>'inner'
						)
					);
			$where=array($tbl_vehicle.'.id_vehicle'=>$this->input->post('vehicleId'));
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($tbl_vehicle, $tableList) and in_array($tbl_transport, $tableList)){
				$vdata['vehicles']=$this->Common_model->select_fields_where_like_join($tbl_vehicle, $data, $join, $where);
			} 
			$this->load->view('vehicle/vehicle_list',$vdata);
		} // end of outer if
	}// end of function

	public function getVehicleByDriverId(){
		if($this->input->post('driverId')){
			$data['vehicles']=array();

			$tbl_vehicle=$this->session->userdata('prefix').'vehicles';
			$tbl_transport=$this->session->userdata('prefix').'transport';
			$data='*,'.$tbl_vehicle.'.name as vehicle_name, '.$tbl_transport.'.name as driver';
			$join=array(
						array(
						'table'=>$tbl_transport,
						'condition'=>$tbl_vehicle.'.id_transport='.$tbl_transport.'.id_transport',
						'type'=>'inner'
						)
					);
			$where=array($tbl_vehicle.'.id_transport'=>$this->input->post('driverId'));
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($tbl_vehicle, $tableList) and in_array($tbl_transport, $tableList)){
				$vdata['vehicles']=$this->Common_model->select_fields_where_like_join($tbl_vehicle, $data, $join, $where);
			} 
			$this->load->view('vehicle/vehicle_list',$vdata);
		} // end of outer if
	}
}

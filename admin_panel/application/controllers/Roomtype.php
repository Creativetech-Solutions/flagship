<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roomtype extends MY_Controller {

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
		$vdata['roomtypes']=array();

		$tbl=$this->session->userdata('prefix').'roomtypes';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){ 
			$vdata['roomtypes']=$this->Common_model->select_fields($tbl, '*', FALSE, 'room_type');
		}
		$tbl=$this->session->userdata('prefix').'location';
		if(in_array($tbl, $tableList)){
			$vdata['locations']=$this->Common_model->select($tbl);
		} 
		$this->show_front('roomtype/roomtypes', $vdata);
	}
// delete tour operator  -- call by ajx
	public function delRoomType(){
		if($this->input->post('roomId') and !empty($this->input->post('roomId'))){
			// delete row where vehicleid_vehicle match
			$tbl=$this->session->userdata('prefix').'roomtypes';
			$result=$this->Common_model->delete($tbl, array('id_room'=> $this->input->post('roomId')));
			if($result>0){ // in case when record successfully deleted
				echo 'OK::Room Type has been deleted Successfully::success';
			} else {
				echo 'OK::Room Type Not Deleted. Try again::error';
			}
		} // end of if
	} 

	// save vehicle record
	public function saveRoomtype(){
		if($this->input->post('roomtype') and !empty($this->input->post('roomtype'))){
			$data=array(
					'room_type'=>$this->input->post('roomtype')
				);
			$tbl=$this->session->userdata('prefix').'roomtypes';
			// update row if vehicleid exist
			if($this->input->post('roomtypeId') and !empty($this->input->post('roomtypeId'))){
				$result=$this->Common_model->update($tbl, array('id_room'=> $this->input->post('roomtypeId')), $data);

				if($result){ // in case when record successfully update
					$data=$this->getRoomType($this->input->post('roomtypeId'));
					if($data){
						echo 'OK::Room Type has been updated Successfully::success::update::'.json_encode($data);
					}
				} else {
					echo 'OK::Room Type Not Updated. Try again::error';
				}
			} 
			// if roomtype id not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);
				
				if($result){ // in case when record successfully added
					$data=$this->getRoomType($result);

					if($data){ // in case if row successfully fetch
						echo 'OK::New Room Type has been added Successfully::success::add::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Tour Operator has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Room Type Not Added. Try again::error';
				}
			} // end of else
		} // end of outer most if
	} // end of save vechile function

	function getRoomType($result){
		//get record corresponding to that id_vehicle
					//$data=$this->Common_model->select_fields_where($tbl, '*', array('id_vehicle'=>$result), true);
		$tbl=$this->session->userdata('prefix').'roomtypes';
		$where=array($tbl.'.id_room'=>$result);
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data=$this->Common_model->select_fields_where($tbl, '*', $where, true);
			return $data;
		} 

	}// end of getvehicle function


	// get vehicle by id 
	public function getRoomTypeByLocId(){
		$data['roomtypes']=array();

		$tbl=$this->session->userdata('prefix').'roomtypes';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){

			if($this->input->post('locId') && !empty($this->input->post('locId'))) {
				$where=array($tbl.'.id_location'=>$this->input->post('locId'));

				$vdata['roomtypes']=$this->Common_model->select_fields_where($tbl, '*', $where);
			} else {
				$vdata['roomtypes']=$this->Common_model->select($tbl);
			}
		} 
		$this->load->view('roomtype/roomtype_list',$vdata);
	}// end of function


	public function getLocationsList(){
		$vdata['locations']=array();

		$tbl=$this->session->userdata('prefix').'location';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){ 
			$vdata['location']=$this->Common_model->select($tbl);
		}

		$locations=array();
		if(!empty($vdata['location'])){
			foreach($vdata['location'] as $loc){
				array_push($locations, array(
											'id'=>$loc->id_location,
											'text'=>$loc->name
										));
			}
			echo 'OK::Record Found::success::'.json_encode($locations);
		} else {
			echo 'OK::Record Not Found::error';
		}
	} // end of function
}

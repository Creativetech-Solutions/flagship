<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flight extends MY_Controller {

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
       	$this->load->model('Common_model');
    }
    // main Flights list page
	public function index()
	{
		$data['flights']=array();
		// get the flight from db
		$tbl=$this->session->userdata('prefix').'flights';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['flights']=$this->Common_model->select($tbl);
		} 
		$this->show_front('flight/flights', $data);
	}

	// delete Flight  -- call by ajx
	public function delFlight(){
		if($this->input->post('flightId') and !empty($this->input->post('flightId'))){
			// delete row where opId match
			$tbl=$this->session->userdata('prefix').'flights';
			$result=$this->Common_model->delete($tbl, array('id_flight'=> $this->input->post('flightId')));

			if($result>0){ // in case when record successfully deleted
				echo 'OK::Flight has been deleted Successfully::success';
			} else {
				echo 'OK::Flight Not Deleted. Try again::error';
			}
		} // end of if
	} 

	// edit Flight record -- call by ajax
	public function saveFlight(){ 
		if($this->input->post('flight_num') and !empty($this->input->post('flight_num'))){
			$data=array(
					'flight_number'=>$this->input->post('flight_num')
				);
			$tbl=$this->session->userdata('prefix').'flights';
			// update row where opId exist
			if($this->input->post('flightId') and !empty($this->input->post('flightId'))){
				$result=$this->Common_model->update($tbl, array('id_flight'=> $this->input->post('flightId')), $data);

				if($result){ // in case when record successfully update
					echo 'OK::Flight has been updated Successfully::success::update';
				} else {
					echo 'OK::Flight Not Updated. Try again::error';
				}
			} 
			// if flightid not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					//get record corresponding to that id
					$data=$this->Common_model->select_fields_where($tbl, '*', array('id_flight'=>$result), true);
					if($data){ // in case if row successfully fetch
						echo 'OK::New Flight has been added Successfully::success::add::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Flight has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Flight Not Added. Try again::error';
				}
			} // end of else
		} //  end of outer if
	} // end of save flight function

	// get flight times by flight id -- call by ajax
	public function getFlightTimesById(){
		if($this->input->post('flightId')){
			$flightId=$this->input->post('flightId');
			$data['fl_times']=array();
			// get the flight from db
			$tbl=$this->session->userdata('prefix').'flighttime';
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($tbl, $tableList)){
				$data['fl_times']=$this->Common_model->select_fields_where($tbl,'*',array('id_flight'=>$flightId));
			} 
			$this->load->view('flight/flight_times', $data);

		} // end of outer if
	}// end of function

	// update flight time -- call by ajax
	public function updateFlightTime(){
		if($this->input->post('flightId') && $this->input->post('fltime_id') && $this->input->post('fltime')){
			if(!empty($this->input->post('flightId')) && !empty($this->input->post('fltime_id'))){
				// get the flight from db
				$tbl=$this->session->userdata('prefix').'flighttime';
				// get the db tables list
				$tableList=getTables(); // define in custom helper
				// check if the tbl exist in db 
				if(in_array($tbl, $tableList)){
					$result=$this->Common_model->update($tbl,
						array('id_flight'=>$this->input->post('flightId'),'id_fltime'=>$this->input->post('fltime_id')),
						array('flight_time'=>$this->input->post('fltime')));
					if($result){
						echo 'OK::Flight Time has been updated successfully::success';
					} else {
						echo 'OK::Record not edited. Try again::error';
					}
				} 
			}
		} // end of if
	}// end of function
	// delete flight time
	public function delFlightTime(){
		if($this->input->post('flightId') && $this->input->post('fltime_id')){
					if(!empty($this->input->post('flightId')) && !empty($this->input->post('fltime_id'))){
						// get the flight from db
						$tbl=$this->session->userdata('prefix').'flighttime';
						// get the db tables list
						$tableList=getTables(); // define in custom helper
						// check if the tbl exist in db 
						if(in_array($tbl, $tableList)){
							$result=$this->Common_model->delete($tbl,
								array('id_flight'=>$this->input->post('flightId'),'id_fltime'=>$this->input->post('fltime_id')));
							if($result>0){
								echo 'OK::One Record has been deleted successfully::success';
							} else {
								echo 'OK::Record not deleted. Try again::error';
							}
						} 
					}
				} // end of if
	}// end of function

	// add new flight time
	public function addFlightTime(){
		if($this->input->post('fl_time') and $this->input->post('flightId')){

			$tbl=$this->session->userdata('prefix').'flighttime';
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($tbl, $tableList)){
				$data=array(
					'id_flight'=>$this->input->post('flightId'),
					'flight_time'=>$this->input->post('fl_time')

					);
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					//get record corresponding to that id
					$data=$this->Common_model->select_fields_where($tbl, '*', array('id_fltime'=>$result), true);
					if($data){ // in case if row successfully fetch
						echo 'OK::New Flight Time has been added Successfully::success::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Flight has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Flight Not Added. Try again::error';
				} // end of else
			} // end of inner if
		} // end of outer if
	} // end of addflighttime function

	// get times list
	public function getTimes(){
		$tbl=$this->session->userdata('prefix').'flighttime';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
		// get the flight times from db
			$times=$this->Common_model->select($tbl);
			//$time= $times[0]->flight_time;
			/*echo date('m/d', $time);
			echo $time;
			echo date('Y-m-d h:m', strtotime($time));*/
			if($times){
				echo 'OK::Flight times fetched::success::'.json_encode($times);
			} else {
				echo 'OK::No Record::error';
			}// end of else
		} // end of if
	} // end of function

	// get flight record by time 
	public function getFlightByTime(){
		if($this->input->post('timeId') && !empty($this->input->post('timeId'))){
			$data=array();
			$flights=$this->session->userdata('prefix').'flights';
			$flightime=$this->session->userdata('prefix').'flighttime';
			$join=array(
						array(
						'table'=>$flightime,
						'condition'=>$flights.'.id_flight='.$flightime.'.id_flight',
						'type'=>'inner'
						)
					);
			$where=array($flightime.'.id_fltime'=>$this->input->post('timeId'));
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($flights, $tableList) and in_array($flightime, $tableList)){
				$data['flights']=$this->Common_model->select_fields_where_like_join($flights, '*', $join, $where);
				
				$this->load->view('flight/flight_list', $data);
			} 
			
		} // end of outer if
	} // end of function

	public function getFlights(){
		$data['flights']=array();
		// get the flight from db
		$tbl=$this->session->userdata('prefix').'flights';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['flights']=$this->Common_model->select($tbl);
		} 
		$this->load->view('flight/flight_list', $data);
	} // end of function

	// get flights in time range specify
	public function getFlightByTimeRange(){
		if($this->input->post('from') && $this->input->post('to')){
			$from=$this->input->post('from');
			$to=$this->input->post('to');
			$flightIds=$this->getFlightIds($from, $to);
			
			if(!empty($flightIds)){
				$flights=$this->session->userdata('prefix').'flights';
				/*$flightime=$this->session->userdata('prefix').'flighttime';
				$join=array(
							array(
							'table'=>$flightime,
							'condition'=>$flights.'.id_flight='.$flightime.'.id_flight',
							'type'=>'inner'
							)
						);*/
				$where_in = array(
					'field'=>$flights.'.id_flight',
					'in_array'=>$flightIds
					);
				$data['flights'] = $this->Common_model->select_fields_where_in_like_join($flights, '*', '', '', $where_in);
			} else {
				$data=array();
			}
				$this->load->view('flight/flight_list', $data);
			// get flight records from db , where flight id is in flightIds array
			
		} // end of outer if
	} // end of function

	protected function getFlightIds($from, $to){
		$timefrom= strtotime($from);
		$timeTo=strtotime($to);
		// get the flight times from db
		$tbl=$this->session->userdata('prefix').'flighttime';
		// get the db tables list
		$tableList=getTables(); // define in custom helper

		$flightIds=array(); 
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$times=$this->Common_model->select($tbl);
			if(is_array($times) && !empty($times)){
				foreach($times as $time){
					$timeStr=strtotime($time->flight_time);
					if($timeStr>=$timefrom && $timeStr<=$timeTo){
						array_push($flightIds, $time->id_flight);
					} // end of if
				} // end of foreach
			} // end of inner if
		} // end of outer if
		return $flightIds;
	} // end of function


	// flightclass section

	public function classesList(){
		$data['fl_classes']=array();
		// get the flight from db
		$tbl=$this->session->userdata('prefix').'flightclass';
		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['fl_classes']=$this->Common_model->select($tbl);
		} 
		$this->show_front('flight/flight_class', $data);
	}// end of function 

	public function saveFlightClass(){
		if($this->input->post('fl_class') and !empty($this->input->post('fl_class'))){
			$data=array(
					'class'=>$this->input->post('fl_class')
				);
			$tbl=$this->session->userdata('prefix').'flightclass';
			// update row where opId exist
			if($this->input->post('fl_class_id') and !empty($this->input->post('fl_class_id'))){
				$result=$this->Common_model->update($tbl, array('id'=> $this->input->post('fl_class_id')), $data);

				if($result){ // in case when record successfully update
					echo 'OK::Flight Class has been updated Successfully::success::update';
				} else {
					echo 'OK::Flight Class Not Updated. Try again::error';
				}
			} 
			// if fl_class_id not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					//get record corresponding to that id
					$data=$this->Common_model->select_fields_where($tbl, '*', array('id'=>$result), true);
					if($data){ // in case if row successfully fetch
						echo 'OK::New Flight Class has been added Successfully::success::add::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Flight Class has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Flight Class Not Added. Try again::error';
				}
			} // end of else
		} //  end of outer if
	} // end of function 

	// delete Flight  -- call by ajx
	public function delFlightClass(){
		if($this->input->post('fl_class_id') and !empty($this->input->post('fl_class_id'))){
			// delete row where opId match
			$tbl=$this->session->userdata('prefix').'flightclass';
			$result=$this->Common_model->delete($tbl, array('id'=> $this->input->post('fl_class_id')));

			if($result>0){ // in case when record successfully deleted
				echo 'OK::Flight Class has been deleted Successfully::success';
			} else {
				echo 'OK::Flight Class Not Deleted. Try again::error';
			}
		} // end of if
	} 

}

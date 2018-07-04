<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends MY_Controller {

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
		$data['coasts']=$data['roomtypes']=$data['locations']=array();
		$tbl=$this->session->userdata('prefix').'loc_coast';
		$tbl_loc=$this->session->userdata('prefix').'location';
		$join=array(
				array(
				'table'=>$tbl,
				'condition'=>$tbl_loc.'.zone='.$tbl.'.id',
				'type'=>'left'
				)
			);
			// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['coasts']=$this->Common_model->select($tbl);

			if(in_array($tbl_loc, $tableList)){
				$data['locations']=$this->Common_model->select_fields_where_like_join($tbl_loc, '*', $join);
			}
		}

		$tbl=$this->session->userdata('prefix').'roomtypes';
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){
			$data['roomtypes']=$this->Common_model->select($tbl);
		}
		
		$this->show_front('location/locations', $data);
	}
	//
	/*public function listing(){
		$tbl=$this->session->userdata('prefix').'location';

		$tblzone=$this->session->userdata('prefix').'loc_coast';
		$selectData = array($tbl.'.id_location AS ID, '.$tbl.'.name AS Location, '.$tbl.'.loc_code as Code ,'.$tblzone.'.coast As Zone',false);
		 $join=array(
				array(
				'table'=>$tblzone,
				'condition'=>$tbl.'.zone='.$tblzone.'.id',
				'type'=>'inner'
				)
			);

		// get the db tables list
		$tableList=getTables(); // define in custom helper
		// check if the tbl exist in db 
		if(in_array($tbl, $tableList)){

            $addColumns = array(
                'ActionButtons' => array('<div class="col-md-12 text-center"><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-loc"><i data-toggle="tooltip" title="Edit" class=" ml-fa fa fa-pencil fa-6 "></i> Edit</a>&nbsp; &nbsp;<a data-id="del-loc" class="btn btn-sm btn-danger del-loc" data-toggle="modal" data-target="#confirm_modal"><i data-toggle="tooltip" title="Delete" data-placement="right"  class="fa fa-trash-o ml-fa"></i> Delete</a></div>','ID'),

            	'roomtypes'=>array('<a data-target="#roomtypes" data-toggle="modal" class="btn btn-success btn-xs roomtypes">Room Types</a>','ID')
            );
            $returnedData = $this->Common_model->select_fields_joined_DT($selectData, $tbl,$join,'','','','',$addColumns, $orderby);
             print_r($returnedData); 
            //echo json_encode($returnedData);
		} 
	} */// end of function

	// get location by id 
	public function getLocationById(){
		if($this->input->post('locId')){
			$tbl=$this->session->userdata('prefix').'location';
			$tblzone=$this->session->userdata('prefix').'loc_coast';
			// get tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			 $join=array(
				array(
				'table'=>$tblzone,
				'condition'=>$tbl.'.zone='.$tblzone.'.id',
				'type'=>'left'
				)
			);
			 $where = array('id_location'=> $this->input->post('locId'));
			if(in_array($tbl, $tableList)){
				$result=$this->Common_model->select_fields_where_like_join($tbl, '*', $join, $where, true);

				if($result){ // in case when record successfully update
					echo 'OK::Data fetched successfully::success::'.json_encode($result);
				} else {
					echo 'OK::Data not found.::error';
				}
			}
		} // end of if
	}// end of function

	// save location (edit or new)
	public function saveLocation(){
		if($this->input->post('loc_name') and $this->input->post('loc_zone') && $this->input->post('loc_code')){
			if(!empty($this->input->post('loc_name')) and !empty($this->input->post('loc_zone')) && !empty($this->input->post('loc_code'))){
				// check loc code number of digits
				$loc_code = $this->input->post('loc_code');
				$loc_code_num = preg_replace("/[^0-9]/", "", $loc_code);
				if(strlen($loc_code_num)==0){
					$loc_code_num = '000'.$loc_code_num;
				}
				else if(strlen($loc_code_num)==1){
					$loc_code_num = '00'.$loc_code_num;
				}
				else if(strlen($loc_code_num)==2){
					$loc_code_num = '0'.$loc_code_num;
				}
				$loc_code_char = preg_replace('/\d+/u', '', $loc_code);
				$loc_code = $loc_code_num.$loc_code_char;
				$data=array(
						'name'=>$this->input->post('loc_name'),
						'zone'=>$this->input->post('loc_zone'),
						'loc_code'=>$loc_code
					);
			$tbl=$this->session->userdata('prefix').'location';
			// update row if loc id exist
			if($this->input->post('loc_id') and !empty($this->input->post('loc_id'))){
				$result=$this->Common_model->update($tbl, array('id_location'=> $this->input->post('loc_id')), $data);

				if($result){ // in case when record successfully update
					$tblzone=$this->session->userdata('prefix').'loc_coast';
					 $join=array(
						array(
						'table'=>$tblzone,
						'condition'=>$tbl.'.zone='.$tblzone.'.id',
						'type'=>'inner'
						)
					);
					 $where = array('id_location'=> $this->input->post('loc_id'));

					$data=$this->Common_model->select_fields_where_like_join($tbl, '*', $join, $where, true);
					echo 'OK::Location has been updated Successfully::success::update::'.json_encode($data);
				} else {
					echo 'OK::Location Not Updated. Try again::error';
				}
			} 
			// if loc id not exist, means user want to add new record
			else {
				$result=$this->Common_model->insert_record($tbl, $data);

				if($result){ // in case when record successfully added
					//get record corresponding to that id
					$tblzone=$this->session->userdata('prefix').'loc_coast';
					 $join=array(
						array(
						'table'=>$tblzone,
						'condition'=>$tbl.'.zone='.$tblzone.'.id',
						'type'=>'inner'
						)
					);
					 $where = array('id_location'=> $result);
					
					$data=$this->Common_model->select_fields_where_like_join($tbl, '*', $join, $where, true);
					if($data){ // in case if row successfully fetch
						echo 'OK::New Location has been added Successfully::success::add::'.json_encode($data);
					}
					else { // in case when row added, but not fetch due to some error
						//echo 'OK::New Tour Operator has been added Successfully::success::add::'.json_encode($data);
					}
				} else {
					echo 'OK::Location Not Added. Try again::error';
				} // end of else
			} // end of outer else
		}// end of outer most if
	}// end of outer most if
	}// end of function

	// delete location 
	public function delLocation(){
		if($this->input->post('locId') and !empty($this->input->post('locId'))){
			// delete row where opId match
			$tbl=$this->session->userdata('prefix').'location';
			$result=$this->Common_model->delete($tbl, array('id_location'=> $this->input->post('locId')));
			if($result>0){ // in case when record successfully deleted
				echo 'OK::Location has been deleted Successfully::success';
			} else {
				echo 'OK::Location Not Deleted. Try again::error';
			}
		} // end of if
	} // end of function

	public function getRoomByLocId(){
		if($this->input->post('locId') and !empty($this->input->post('locId'))){
			
			//$tbl=$this->session->userdata('prefix').'roomtypes';
			$tbl=$this->session->userdata('prefix').'room_loc';
			$tbl_roomtype=$this->session->userdata('prefix').'roomtypes';
			$join=array(
				array(
				'table'=>$tbl_roomtype,
				'condition'=>$tbl_roomtype.'.id_room ='.$tbl.'.id_roomtype',
				'type'=>'inner'
				)
			);
			$where = array($tbl.'.id_location'=> $this->input->post('locId'));
			// get the db tables list
			$tableList=getTables(); // define in custom helper
			// check if the tbl exist in db 
			if(in_array($tbl, $tableList)){
				//$vehicles=$this->Common_model->select_fields_where($tbl, '*', array('id_location'=>$this->input->post('locId')));
				$roomtypes=$this->Common_model->select_fields_where_like_join($tbl, '*', $join, $where);
				if($roomtypes){
					echo 'OK::Room data fetched::success::'.json_encode($roomtypes);
				} else {
					echo 'OK::Record Not found::error';
				}
			} 
			
		}// end of outer if
	} // end of function

	public function removeRoomTypeByLoc(){
		if($this->input->post('locRoomId') && !empty($this->input->post('locRoomId'))){
			$tbl=$this->session->userdata('prefix').'room_loc';
			$tableList=getTables(); // define in custom helper
			if(in_array($tbl, $tableList)){
				$result=$this->Common_model->delete($tbl, array('id_room_loc'=>$this->input->post('locRoomId')));
				if($result>0){
					echo 'OK::Room Type has been removed Successfully::success';
				} else {
					echo 'OK::Not Removed. Try again::error';
				}
			}
		} // end of if
	} // end of function

	// assign room type to location
	public function assignRoomType(){
		if($this->input->post('roomtypeId') && !empty($this->input->post('roomtypeId'))){
			if($this->input->post('locId') && !empty($this->input->post('locId'))){
				$tbl=$this->session->userdata('prefix').'room_loc';
				$data = array(
						'id_location'=>$this->input->post('locId'),
						'id_roomtype'=>$this->input->post('roomtypeId')
					);
				$tableList=getTables(); // define in custom helper
				if(in_array($tbl, $tableList)){
					// check if already exist, 
					$result=$this->Common_model->select_fields_where($tbl, array('COUNT(id_room_loc) as Total'), $data, true );
					if($result->Total==0){
							$insertId=$this->Common_model->insert_record($tbl, $data);
							if($insertId){
								$tbl_roomtype=$this->session->userdata('prefix').'roomtypes';
								$join=array(
									array(
									'table'=>$tbl_roomtype,
									'condition'=>$tbl_roomtype.'.id_room ='.$tbl.'.id_roomtype',
									'type'=>'inner'
									)
								);
								$where = array($tbl.'.id_room_loc'=> $insertId);
								$data=$this->Common_model->select_fields_where_like_join($tbl, '*', $join, $where, true);
								echo 'OK::Room Type has been assigned Successfully::success::'.json_encode($data);
							}
						} 
					else {
						echo 'OK::Room Type already assigned::error';
					}
				}
			} // end of if
		} // end of outer if
	} // end of function

	public function getIds(){
		$tbl=$this->session->userdata('prefix').'roomtypes';
		$result=$this->Common_model->select($tbl);
		$data=array();
		foreach($result as $row){
			$array = array(
				'id_location'=>$row->id_location,
				'id_roomtype'=>$row->id_room
			);
			$tbl=$this->session->userdata('prefix').'room_loc';
			$this->Common_model->insert_record($tbl, $array);
		}

	} // end of function

}

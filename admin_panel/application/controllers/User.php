<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Cruise_model');
		$this->load->helper('custom_helper');
		$this->load->library('form_validation');
		$this->load->library('upload');
	}
	// load all users data
	public function index()
	{	$tbl='users';
		$join=array(
			array(
				'table'=>'user_levels',
				'condition'=>$tbl.'.userlevel=user_levels.level_id',
				'type'=>'inner')
			);
		$data['users']=$this->Cruise_model->select_fields_where_like_join($tbl, '*', $join);
		$data['userlevels']=$this->Cruise_model->select('user_levels');
		$this->show_front('user/users',$data);
	}
	
	// edit user page

	public function editUser(){
		$userId=$this->uri->segment(3);
		if($userId and !empty($userId)) {
			$data['user'] = $this->Cruise_model->select_fields_where('users', '*', array('id' => $userId), true);
			if(!isset($data['user']->id)) 
				redirect(base_url('/user'));
			$data['roles'] = $this->Cruise_model->select('user_levels');

		}
		
		$this->show_front('user/edit_user',$data);
	}

	// edit user record
	public function saveData(){
		$this->userValidation();
		if($this->form_validation->run() == FALSE){
			echo 'OK::'.validations_errors().'::error';
		}
		if(!$this->input->post('userid') or empty($this->input->post('userid'))){
			echo 'OK::Error! Record Not Updated. Try again::error';
		}
		else {
			$id=$this->input->post('userid');
			$tbl='users';
			$result = $this->Cruise_model->select_fields_where($tbl, '*', array('id'=>$id), true);

			// here check if last edit time is same as when edit form page loads

			if($result->last_edit && $this->input->post('last_edit') && $result->last_edit==$this->input->post('last_edit')){
				$data=$this->userInputData();
				$id=$this->input->post('userid');
				// last edit time and edit by
				$data['last_edit'] = date('Y-m-d h:m:s');
				$data['edit_by'] = $this->session->userdata('userid');
				if($this->input->post('register_time')){
					$regdate=date('Y-m-d h:m:s', strtotime($this->input->post('register_time')));
					$data['created']=$regdate;
				}

				if($this->input->post('last_log')){
					$logindate=date('Y-m-d h:m:s', strtotime($this->input->post('last_log')));
					$data['lastlogin']=$logindate;
				}
				if($this->input->post('last_ip'))
					$data['lastip']=$this->input->post('last_ip');
				if($this->input->post('password') and !empty($this->input->post('password')))
					$data['password']=md5($this->input->post('password'));
				if (!empty($_FILES['avatar']['name'])){ 
					$config['upload_path'] = "../admin-panel-bgi/uploads";
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']     = '4096'; // 4mb
					$config['max_width'] = '1024';
					$config['max_height'] = '768';
					$this->upload->initialize($config);
					// check if image uploaded or not
					if ( ! $this->upload->do_upload('avatar')){
		               echo 'OK::'.$this->upload->display_errors().'::error';
		            }
		           else {
		                 $uploadData = $this->upload->data();
		                 $data['avatar']=$uploadData['file_name'];
		             } // end of else
				} // end of if

				// update record in database
				 
				 $tableList=getCruiseTable();
		         // update record in db
		         if(in_array($tbl, $tableList)){
		             $response=$this->Cruise_model->update($tbl, array('id'=>$id),$data);
		             if($response){
		             	// check if the superadmin is editing his own record, then update session variables
		             	if($id==$this->session->userdata('userid')){
		         			$sessionData=array(
		    					'userlevel'=>$data['userlevel'],
		    					'username'=>$data['username'],
		    					'name'=>$data['fname'].' '.$data['lname']
		    					); 
		         			// check avatar changes
		         			if(isset($data['avatar']) && !empty($data['avatar'])){
		         				$sessionData['useravatar']=$data['avatar'];
		         			}
		         			$this->session->set_userdata($sessionData);
		             	}
		             	echo 'OK::Record has been updated successfully::success::'.$data['last_edit'];
		             } else {
		             	echo 'OK::Error! Record Not Updated. Try again::error';
		             } // end of else
		         } // end of if
			} else { // when last edit time not match which means some other user recently edit the record, then reload the page, 
				$result = $this->Cruise_model->select_fields_where($tbl,'*',array('id'=>$result->edit_by), true);
				if($result){
					$fname = $result->fname;
					$lname = $result->lname;
					$msg = "Your changes can't be saved. ".$fname." ".$lname." has updated this record. Please refresh to see the changings.";
				} else {
					$msg = "Your changes not saved, another user has updated this record";
				}
				//$this->session->set_flashdata('block_msg', $msg);
				echo 'OK::'.$msg.'::block';
			}
		}
			
	} // end of function

	// add new user
	public function addUser(){
		$tbl='user_levels';
		$data=array();
		$tableList=getCruiseTable();
		if(in_array($tbl, $tableList)) {
			$data['roles'] = $this->Cruise_model->select($tbl);
		}
		$this->show_front('user/add_user',$data);
	}

	// save new user record
	public function addNewUser(){
		$this->userValidation();
		$this->form_validation->set_rules('password', 'Password', 'required');

		/*if (empty($_FILES['avatar']['name']))
			$this->form_validation->set_rules('avatar', 'Avatar', 'required');*/

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('form_error',validation_errors());
			$this->session->set_flashdata('postData', $this->input->post());
			redirect(base_url('user/addUser'));
		}
		else {
			$data=$this->userInputData();
			$data['password']=md5($this->input->post('password'));
			// echo '<pre>';
			// echo $this->uploadImg();
			
			if (!empty($_FILES['avatar']['name'])) {
				$config['upload_path'] = "../admin-panel-bgi/uploads";
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']     = '4096'; // 4mb
				$config['max_width'] = '1024';
				$config['max_height'] = '768';
				$this->upload->initialize($config);
			// check if image uploaded or not

				if ( ! $this->upload->do_upload('avatar')){
	                $this->session->set_flashdata('form_error', $this->upload->display_errors());
					$this->session->set_flashdata('postData', $this->input->post());
	                redirect(base_url('user/addUser'));
	            }
	           else {
	                 $uploadData = $this->upload->data();
	                 $data['avatar'] = $uploadData['file_name'];
	             }
             }

                 $data['created'] = date("Y-m-d H:i:s");
                 // check if username already exist
                $record=$this->Cruise_model->select_fields_where('users', array('COUNT(1) as total'), array('username'=>$data['username']),ture);
                if($record->total>0){
                	$this->session->set_flashdata('form_error', 'Username '.$data['username'].' Already Exists');
	                $this->session->set_flashdata('postData', $this->input->post());
                	redirect(base_url('user/addUser'));
                } else {
					 $this->Cruise_model->insert_record('users', $data);
					 $this->session->set_flashdata('form_success', 'New User has been Added Successfully');
                }
				 // insert record in db
                 redirect(base_url('user'));
			
		}
	}

	// upload image
	protected function uploadImg(){
		// upload profile picture (avatar)
		$filename=basename($_FILES["avatar"]["name"]);
		$target_dir = $this->frontEndPath."/admin-panel-bgi/uploads";
		$target_file = $target_dir .$filename ;
		$uploadOk = 0;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
	    $check = getimagesize($_FILES["avatar"]["tmp_name"]);
	    if($check !== false) { // file is an image

			// Check if file already exists
			while(file_exists($target_file)) { // file already exists
			    $target_file=$target_dir.$filename.rand();
			}
				// Check file size
			if (!$_FILES["avatar"]["size"] > 500000) {
			    // Allow certain file formats
				if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
				|| $imageFileType == "gif" ) {
				   if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
				        $uploadOk = 1;
				    } else {
				        $uploadOk = 0;
		    		}
				}
				else {
					$this->session->set_flashdata('form_error','Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
					$uploadOk = 0;
				}
			} else {
				$this->session->set_flashdata('form_error','Image Size is too large');
				$uploadOk = 0;
			}
			
	    } else { // file is not an image
	    	$this->session->set_flashdata('form_error','Choosed File in not an image');
			$uploadOk = 0;
	    }
	    return $uploadOk;
	}
	// user input data
	protected function userInputData(){
		$data=array();
		$data['fname']=$this->input->post('fname');
		$data['lname']=$this->input->post('lname');
		$data['username']=$this->input->post('username');
		$data['email']=$this->input->post('email');
		$data['active']=$this->input->post('status');
		$data['newsletter']=$this->input->post('newsletter');
		$data['userlevel']=$this->input->post('level');
		if($this->input->post('notes') && !empty($this->input->post('notes')))
			$data['notes']=$this->input->post('notes');
		if($this->input->post('country') && !empty($this->input->post('country')))
			$data['country']=$this->input->post('country');
		return $data;
	}
	// user form validations
	protected function userValidation(){
		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('newsletter', 'Status', 'required');
		$this->form_validation->set_rules('level', 'Status', 'required');
	}

	// delete user
	public function delUser(){
		if($this->input->post('userId') and !empty($this->input->post('userId'))){
			// delete row where opId match
			$tbl='users';
			$result=$this->Cruise_model->delete($tbl, array('id'=> $this->input->post('userId')));
			if($result>0){ // in case when record successfully deleted
				echo 'OK::User has been deleted Successfully::success';
			} else {
				echo 'OK::User Not Deleted. Try again::error';
			}
		} // end of if
	} // end of deluser function

	// get user by status
	public function getUserByInvoker(){
		if($this->input->post('key')){
			$data=array();
			$tbl='users';
			$join=array(
				array(
					'table'=>'user_levels',
					'condition'=>$tbl.'.userlevel=user_levels.level_id',
					'type'=>'inner')
				);
			if($this->input->post('invoker')=='status') // where condition on base of invoker
				$where=array('active'=>$this->input->post('key'));
			else if($this->input->post('invoker')=='level') 
				$where=array('userlevel'=>$this->input->post('key'));
			$data['users']=$this->Cruise_model->select_fields_where_like_join($tbl, '*', $join, $where);
			$data['userStatuses'] = $this->userStatus;
			$this->load->view('user/user_list',$data);
		}
	} // end of function

	// get all users 
	public function getAllUsers(){
		$data=array();
			$tbl='users';
			$join=array(
				array(
					'table'=>'user_levels',
					'condition'=>$tbl.'.userlevel=user_levels.level_id',
					'type'=>'inner')
				);
			$data['users']=$this->Cruise_model->select_fields_where_like_join($tbl, '*', $join);
			$data['userStatuses'] = $this->userStatus;
			$this->load->view('user/user_list',$data);
	}
}

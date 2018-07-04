<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller {
	public function __construct()
    {
        parent::__construct();
       	$this->load->model('Cruise_model');
    }

    // login page
    public function index(){
    	if($this->session->userdata('userlevel') && $this->session->userdata('userlevel')==9){
    		redirect(base_url('/'));
    	}
    	$this->load->view('login');
    }

    // check login credientails -- function call by ajax
    public function login(){
    	if($this->input->post('username') && $this->input->post('password')){
    		if(!empty($this->input->post('username')) && !empty($this->input->post('password'))){
    			$username=$this->input->post('username');
    			$password=md5($this->input->post('password'));
    			$records=$this->Cruise_model->select_fields_where('users','*', array('username'=>$username, 'password'=>$password, 'userlevel'=>9), true);
    			if(count($records)>0 && isset($records->id) && $records->userlevel==9){
    				$data=array(
    					'userlevel'=>$records->userlevel,
    					'username'=>$records->username,
    					'userid'=>$records->id,
    					'name'=>$records->fname.' '.$records->lname,
    					'last'=>$records->lastlogin
    					); 

                        // check if user avatar file path exist
                        if(is_url_exist($this->frontEndPath.'admin-panel-fll/uploads/'.$records->avatar) && !empty($records->avatar)){
                            $data['useravatar']=$records->avatar;
                        } else {
                            $data['useravatar']=$this->defaultImg;
                        }
    				    //$this->session->set_userdata($data);
                        $_SESSION['userlevel'] = $data['userlevel'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['userid'] = $data['userid'];
                        $_SESSION['name'] = $data['name'];
                        $_SESSION['last'] = $data['last'];
                        $_SESSION['useravatar'] = $data['useravatar'];
    				echo 'OK::Successfully Logged In. Redirecting...::success::'.json_encode($records);
    			} else {
    				echo 'OK::Incorrect Username or Password::error';
    			} //end of else
    		} // end of outer if
    	} // end of outer most if
    } // end of login function

    // logout function
    public function logout(){
    	$this->session->sess_destroy();
    	redirect('/account');
    }
}

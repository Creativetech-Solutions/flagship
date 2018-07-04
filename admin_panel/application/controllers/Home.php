<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

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
	public function __construct(){
		parent::__construct();
		$this->load->model('Cruise_model');
	}
	public function index()
	{	
		$this->show_front('dashboard');
	}
	// configure new database connection
	public function configure(){
		if($this->input->post('destination') && !empty($this->input->post('destination'))) {
			$db=$this->input->post('destination');
			$redirectTo = '';
			switch ($db) {
		    case 'A':
		     	$this->session->set_userdata( 
		     		array('db_name' =>'cocoa_anu',
		     			  'prefix'=>'anu_',
                          'cruise_db'=>'cruisecontrol_anu'
		     			 )
		     		);	
		        break;
		    case 'B':
		     	$this->session->set_userdata( 
		     		array('db_name' =>'cocoa_bgi',
		     			  'prefix'=>'bgi_',
						  'cruise_db'=>'cruisecontrol_bgi'
		     			 )
		     		);	
		     	$redirectTo = 'http://25.88.101.58/admin_panel/';
		     	// set base url to bgi folder
		     	$this->config->set_item('base_url',"http://25.88.101.58/admin_panel/") ;
		        break;
		    case 'G':
		     	$this->session->set_userdata( 
		     		array('db_name' =>'cocoa_gnd',
		     			  'prefix'=>'gnd_',
						  'cruise_db'=>'cruisecontrol_gnd'
		     			 )
		     		);	
		    	break;
		    case 'S':
		     	$this->session->set_userdata( 
		     		array('db_name' =>'cocoa_skb',
		     			  'prefix'=>'skb_',
						  'cruise_db'=>'cruisecontrol_skb'
		     			 )
		     		);	
		    	break;
		    default:
		     	$this->session->set_userdata( 
		     		array('db_name' =>'cocoa_fll',
		     			  'prefix'=>'fll_',
						  'cruise_db'=>'cruisecontrol_fll'
		     			 )
		     		);	
		     	$redirectTo = 'http://25.114.31.88/admin_panel/';
		     	// set base url to bgi folder
		     	$this->config->set_item('base_url',"http://25.114.31.88/admin_panel/") ;
			} // end of switch

			if(!empty($redirectTo))
				redirect($redirectTo);
			else if($this->input->post('path') and !empty($this->input->post('path'))){
				redirect($this->input->post('path'));
			}
		} // end of if
		redirect(base_url('/'));
	}
}

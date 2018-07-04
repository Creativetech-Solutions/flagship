<?php

/**
 * @property CI_Email $email It resides all the methods which can be used in most of the controllers.
 * @property CI_Session $session It resides all the methods which can be used in most of the controllers.
 * @property CI_Input input It resides all the methods which can be used in most of the controllers.
 * @property CI_DB_driver db It resides all the methods which can be used in most of the controllers.
 * @property Facebook $facebook It resides all the methods which can be used in most of the controllers.
 * @property Common_model $Common_model It resides all the methods which can be used in most of the controllers.
 */
class MY_Controller extends CI_Controller{
    public $frontEndPath;
    public $userStatus;

    public function __construct()
    {
        parent::__construct();
        // to load assets from front end
        $this->frontEndPath='http://localhost/flights_project/';
        $this->defaultImg='blank.png';
     /*   $cruiseDb='mysqli://root:chocolate@localhost/cocoa_admin?char_set=utf8&dbcollat=utf8_general_ci&cache_on=true&cachedir=';*/
        $this->cruiseDb = $this->load->database('cruiseDb', TRUE);
        // check if db name store in session, then configure that db, by default selected db will be FLL - Florida
        if(!$this->session->userdata('db_name') or !$this->session->userdata('cruise_db')){
            $this->session->set_userdata(
                    array('db_name' =>'cocoa_bgi',
                          'prefix'=>'bgi_',
                          'cruise_db'=>'cruisecontrol_bgi'
                         )
                    );  
        }
        $this->db->db_select($this->session->userdata('db_name'));
        $this->cruiseDb->db_select($this->session->userdata('cruise_db'));
        $this->userStatus = [
            'y' => 'Active',
            'n' => 'InActive',
            'b' => 'Banned',
            't' => 'Pending'
        ];

        // check prefix name in session and set base url accordingly
        if($this->session->userdata('prefix') == 'fll_'){
            // set base url to bgi folder
            $this->config->set_item('base_url',"http://".$_SERVER['HTTP_HOST']."/flagship_project/admin_panel/") ;
        }
        // load common model
        
        $this->load->model('Common_model');
        // load helper
        $this->load->helper('custom_helper');
        $this->counter=countRecords();// define in custom helper
    }

    public function show_front($viewPath,$data = array()){
        if(!$this->session->userdata('userlevel') or !$this->session->userdata('userlevel')==9){
            redirect(base_url('/account'));
        } 
        $this->load->view('components/header',$data);
        $this->load->view($viewPath,$data);
        $this->load->view('components/footer',$data);
    }

}
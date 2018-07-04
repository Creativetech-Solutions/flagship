<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Server extends MY_Controller {

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
	public function index(){
		$sql="SHOW MASTER STATUS";
		$query = $this->db->query($sql);
		echo '<pre>'; print_r($query->result());

		exec('mysqldump --user=root --password=chocolate --host=localhost cruisecontrol_bgi > file.sql');
		

	}

	function dumpDatabase(){

        $prefs = array(     
                'format'      => 'sql',             
                'filename'    => 'my_db_backup.sql'
              );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.sql';
        $save = '/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 


        $this->load->helper('download');
        force_download($db_name, $backup); 

        $this->db->db_select('cruisecontrol_bgi');
		$this->dumpDatabase();exit(0);
	}

}

<?php
// get list of db tables
function getTables(){
	$ci=&get_instance();
	return $ci->db->list_tables();
}

// cruise tables list
function getCruiseTable(){
	$ci=&get_instance();
	return $ci->cruiseDb->list_tables();
}

// check file url 
if(!function_exists('is_url_exist')){
    function is_url_exist($url){
        if(empty($url)){
            return false;
        }
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if($code == 200){
            $status = true;
        }else{
            $status = false;
        }
        curl_close($ch);
        return $status;
    }
}

// record counts
function countRecords(){
	$ci=&get_instance();
	$ci->load->model('Cruise_model');
	$ci->load->model('Common_model');
	$users=$operators=$vehicles=$flights=$locations=$transport=$activeUsers=$fl_class=$suppliers=$modes=$roomtypes=0;
	//  count total users count
	$activeUsers=$ci->Cruise_model->count_all_rows('users', array('active'=>'y'));
	// count active users
	$users=$ci->Cruise_model->count_all_rows('users');
	//  count tour operators
	$tableList=getTables(); // define in custom helper
	// check if the tbl exist in db 
	$tbl=$ci->session->userdata('prefix').'touroperator';	
	if(in_array($tbl, $tableList)){
		$operators=$ci->Common_model->count_all_rows($tbl);
	} 
	// check if the tbl exist in db 
	$tbl=$ci->session->userdata('prefix').'vehicles';	
	if(in_array($tbl, $tableList)){
		$vehicles=$ci->Common_model->count_all_rows($tbl);
	} 
	// check if the tbl exist in db 
	$tbl=$ci->session->userdata('prefix').'flights';	
	if(in_array($tbl, $tableList)){
		$flights=$ci->Common_model->count_all_rows($tbl);
	} // check if the tbl exist in db 
	$tbl=$ci->session->userdata('prefix').'location';	
	if(in_array($tbl, $tableList)){
		$locations=$ci->Common_model->count_all_rows($tbl);
	} 
	$tbl=$ci->session->userdata('prefix').'transport';	
	if(in_array($tbl, $tableList)){
		$transport=$ci->Common_model->count_all_rows($tbl);
	}  
	$tbl=$ci->session->userdata('prefix').'flightclass';	
	if(in_array($tbl, $tableList)){
		$fl_class=$ci->Common_model->count_all_rows($tbl);
	}  
	$tbl=$ci->session->userdata('prefix').'fsft_touroperator';	
	if(in_array($tbl, $tableList)){
		$suppliers=$ci->Common_model->count_all_rows($tbl);
	}   
	$tbl=$ci->session->userdata('prefix').'transporttype';	
	if(in_array($tbl, $tableList)){
		$modes=$ci->Common_model->count_all_rows($tbl);
	}    
	$tbl=$ci->session->userdata('prefix').'roomtypes';	
	if(in_array($tbl, $tableList)){
		$roomtypes=$ci->Common_model->count_all_rows($tbl, null, 'room_type');
	}    
	$tbl=$ci->session->userdata('prefix').'reps';	
	if(in_array($tbl, $tableList)){
		$reps=$ci->Common_model->count_all_rows($tbl);
	} 
	$data=array(
		'users'=>$users,
		'operators'=>$operators,
		'vehicles'=>$vehicles,
		'locations'=>$locations,
		'transport'=>$transport,
		'flights'=>$flights,
		'activeUsers'=>$activeUsers,
		'fl_class'=>$fl_class,
		'suppliers'=>$suppliers,
		'modes'=>$modes,
		'roomtypes'=>$roomtypes,
		'reps'=>$reps
		);
	return $data;
}
?>
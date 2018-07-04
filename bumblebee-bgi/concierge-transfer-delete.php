<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']) || isset($_POST['action'])){

	$reservation_id = $_GET['reservation'];
	$ref = $_GET['ref'];
	if(isset($_GET['id']))
	{
	$transfer_id = $_GET['id'];
	$sql=mysql_query("delete from bgi_additional_transfer WHERE id='$transfer_id'");
	$useraction="delete concierge transfer from reservation: $ref";

	}

	if(isset($_POST['action']) && $_POST['action'] == 'delete_hotel'){
	    $id = $_POST['id'];
	    // delete all rooms with that hotel id
	    mysql_query("delete from bgi_hotel_rooms WHERE ad_hotel_id='$id'");
	 	 $sql2 = mysql_query("delete from bgi_additional_hotels WHERE id='$id'");
		$useraction="delete additional hotel from reservation: $ref";
	}


	//Activity Log info
	$loggedinas=$_GET['logger'];
	//log activity
	$activity = "INSERT INTO bgi_activity ". 
	        "(log_user, user_action, log_time) ". 
	        "VALUES ('$loggedinas', '$useraction', NOW())";
	        $retval = mysql_query( $activity, $conn );
	        
	        //Update system log
	    $sql_1 = "UPDATE bgi_reservations ". 
	        "SET modified_date = NOW(), modified_by = '$loggedinas'". 
	        "WHERE ref_no_sys = '$ref'";
	        $retval1 = mysql_query( $sql_1, $conn );
	        
	if(isset($sql))
	{
		echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=14'</script>";
	}
	if(isset($sql2))
	{
		echo "ok";
	}
	mysql_close($conn);

}



?>
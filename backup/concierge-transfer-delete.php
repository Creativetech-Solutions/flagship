<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$transfer_id = $_GET['id'];
$reservation_id = $_GET['reservation'];
$sql=mysql_query("delete from bgi_additional_transfer WHERE id='$transfer_id'");

//Activity Log info
$loggedinas=$_GET['logger'];
$ref = $_GET['ref'];
$useraction="delete concierge transfer from reservation: $ref";
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
        
if($sql)
{
	echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=14'</script>";
}
mysql_close($conn);
}

?>
<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$transport_id = $_GET['transport'];
$vehicle_id=$_GET['id'];
$sql=mysql_query("delete from skb_vehicles where id_vehicle='$vehicle_id'");

//Activity Log info
$loggedinas=$_GET['logger'];
$vehicle=$_GET['vehicle'];
$useraction="delete vehicle: $vehicle";
//log activity
$activity = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

if($sql)
{
	echo "<script>window.location='transport-details.php?id=".$transport_id."&ok=4'</script>";
}
}

?>
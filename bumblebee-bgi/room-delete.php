<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$location_id = $_GET['location'];
$room_id=$_GET['id'];
$sql=mysql_query("delete from bgi_roomtypes where id_room='$room_id'");

//Activity Log info
$loggedinas=$_GET['logger'];
$room_type=$_GET['roomtype'];
$useraction="delete room type: $room_type";

//log activity
$activity = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

if($sql)
{
	echo "<script>window.location='location-details.php?id=".$location_id."&ok=4'</script>";
}
}

?>
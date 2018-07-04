<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$flight_id = $_GET['flight'];
$flighttime_id=$_GET['id'];
$sql=mysql_query("delete from anu_flighttime where id_fltime='$flighttime_id'");

//Activity Log info
$loggedinas=$_GET['logger'];
$flight_time=$_GET['flight_time'];
$useraction="delete flight time: $flight_time";
//log activity
$activity = "INSERT INTO anu_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );
        
if($sql)
{
header('location:flight-details.php?id=' . $flight_id . '');
}
}

?>
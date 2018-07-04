<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{

$flight_id=$_GET['id'];
$flighttimerows = mysql_query("SELECT * FROM bgi_flighttime WHERE id_flight='$flight_id'");
$flighttime_count = mysql_num_rows($flighttimerows);
if ($flighttime_count > 0){
    $sql=mysql_query("delete bgi_flights, bgi_flighttime from bgi_flights, bgi_flighttime where bgi_flights.id_flight='$flight_id' and bgi_flighttime.id_flight='$flight_id'");
} else {
    $sql=mysql_query("delete from bgi_flights where id_flight='$flight_id'");
}

//Activity Log info
$loggedinas=$_GET['logger'];
$flight=$_GET['flight'];
$useraction="delete flight number: $flight";
//log activity
$activity = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

if($sql)
{
	echo "<script>window.location='flight-list.php?ok=2'</script>";
}
}

?>
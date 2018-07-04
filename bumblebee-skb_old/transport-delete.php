<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{   
$transport_id=$_GET['id'];
$vehiclerows = mysql_query("SELECT * FROM skb_vehicles WHERE id_transport='$transport_id'");
$vehicle_count = mysql_num_rows($vehiclerows);
if ($vehicle_count > 0){
    $sql=mysql_query("delete skb_transport, skb_vehicles from skb_transport, skb_vehicles where skb_transport.id_transport='$transport_id' and skb_vehicles.id_transport='$transport_id'");
} else {
    $sql=mysql_query("delete from skb_transport where id_transport='$transport_id'");
}

//Activity Log info
$loggedinas=$_GET['logger'];
$transport=$_GET['transport'];
$useraction="delete transport item: $transport";
//log activity
$activity = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );
if($sql)
{
header('location:transport-list.php');
}
}

?>
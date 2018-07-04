<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$location_id=$_GET['id'];
$roomrows = mysql_query("SELECT * FROM skb_roomtypes WHERE id_location='$location_id'");
$room_count = mysql_num_rows($roomrows);
if ($room_count > 0){
    $sql=mysql_query("delete skb_location, skb_roomtypes from skb_location, skb_roomtypes where skb_location.id_location='$location_id' and skb_roomtypes.id_location='$location_id'");
} else {
    $sql=mysql_query("delete from skb_location where id_location='$location_id'");
}

//Activity Log info
$loggedinas=$_GET['logger'];
$location=$_GET['location'];
$useraction="delete location item: $location";
//log activity
$activity = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );
        
if($sql)
{
header('location:location-list.php');
}
}

?>
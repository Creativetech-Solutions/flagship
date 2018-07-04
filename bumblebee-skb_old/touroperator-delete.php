<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{

$operator_id=$_GET['id'];
$sql=mysql_query("delete from skb_touroperator where id='$operator_id'");


//Activity Log info
$loggedinas=$_GET['logger'];
$tour_operator=$_GET['touroperator'];
$useraction="delete tour operator: $tour_operator";
//log activity
$activity = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

if($sql)
{
header('location:touroperator-list.php');
}
}

?>
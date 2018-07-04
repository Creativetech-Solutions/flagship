<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{

$rep_id=$_GET['id'];
$sql=mysql_query("delete from anu_reps WHERE id_rep='$rep_id'");


//Activity Log info
$loggedinas=$_GET['logger'];
$rep_name=$_GET['rep'];
$useraction="delete rep: $rep_name";
//log activity
$activity = "INSERT INTO anu_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

if($sql)
{
header('location:rep-list.php');
}
}

?>
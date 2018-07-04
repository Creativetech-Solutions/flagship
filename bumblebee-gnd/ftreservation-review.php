<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$reservation_id=$_GET['id'];
$notify = 0;
$getnotify = mysql_fetch_row(mysql_query("SELECT * FROM gnd_reservations WHERE id='$reservation_id'"));
if ($getnotify[47] > 0){
    $sql = "UPDATE gnd_reservations ". 
        "SET ftnotify = '$notify'". 
        "WHERE id = '$reservation_id'";
        $retval = mysql_query( $sql, $conn );
} else {
    header('location:view-ftreservations.php');
}

        
if($sql)
{
header('location:view-ftreservations.php');
}
}

?>
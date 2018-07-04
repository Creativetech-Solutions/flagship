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
$getnotify = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reservations WHERE id='$reservation_id'"));
if ($getnotify[47] > 0){
    $sql = "UPDATE bgi_reservations ". 
        "SET ftnotify = '$notify'". 
        "WHERE id = '$reservation_id'";
        $retval = mysql_query( $sql, $conn );
} else {
	echo "<script>window.location='view-ftreservations-arr.php'</script>";
}

        
if($sql)
{
	echo "<script>window.location='view-ftreservations-arr.php'</script>";
}
}

?>
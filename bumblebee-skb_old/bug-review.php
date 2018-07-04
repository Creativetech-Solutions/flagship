<?php

/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$bug_id=$_GET['id'];
$status = 0;
$getstatus = mysql_fetch_row(mysql_query("SELECT * FROM skb_bugs WHERE id='$bug_id'"));
if ($getstatus[5] > 0){
    $sql = "UPDATE skb_bugs ". 
        "SET active = '$status'". 
        "WHERE id = '$bug_id'";
        $retval = mysql_query( $sql, $conn );
} else {
    header('location:bug-report.php');
}

        
if($sql)
{
header('location:bug-report.php');
}
}

?>
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
$getstatus = mysql_fetch_row(mysql_query("SELECT * FROM bgi_bugs WHERE id='$bug_id'"));
if ($getstatus[5] > 0){
    $sql = "UPDATE bgi_bugs ". 
        "SET active = '$status'". 
        "WHERE id = '$bug_id'";
        $retval = mysql_query( $sql, $conn );
} else {
    echo "<script>window.location='bug-report.php'</script>";
}

        
if($sql)
{
echo "<script>window.location='bug-report.php'</script>";
}
}

?>
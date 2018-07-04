<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
  if (!$user->levelCheck("2,9,"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
ob_start();
/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('config.php');

if(isset($_GET['id']))
{
$ref_no = $_GET['ref'];
$reservation_id=$_GET['reservation'];
$guest_id = $_GET['id'];

//get reservation A/C/I count
 $reservations = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reservations WHERE id='" . $reservation_id . "'"));
 $fasttrack = $reservations[12];
 $adult = $reservations[8];
 $child = $reservations[9];
 $infant = $reservations[10];
 

//determine if guest is Adult, Child, Infant and decrease count by 1

 $guest_check = mysql_fetch_row(mysql_query("SELECT * FROM bgi_guest WHERE id='" . $guest_id . "'"));
 $adult_check = $guest_check[5];
 $child_check = $guest_check[6];
 $infant_check = $guest_check[7];
         
         if($adult_check >= 1){
            --$adult;
            }
             
             $sql1 = "UPDATE bgi_reservations ". 
         "SET adult = '$adult'". 
         "WHERE id = '$reservation_id'";
         $retval1 = mysql_query( $sql1, $conn );
             
         
         if ($child_check >= 1){
             --$child;
            }
             
             $sql2 = "UPDATE bgi_reservations ". 
         "SET child = '$child'". 
         "WHERE id = '$reservation_id'";
         $retval2 = mysql_query( $sql2, $conn );
             
         
         if ($infant_check >= 1){
             --$infant;
            }
             
             $sql3 = "UPDATE bgi_reservations ". 
         "SET infant = '$infant'". 
         "WHERE id = '$reservation_id'";
         $retval3 = mysql_query( $sql3, $conn );

            

$sql=mysql_query("delete from bgi_guest where id='$guest_id'");

//Activity Log info
$loggedinas=$_GET['logger'];
$guest = $_GET['guest'];
$useraction="delete guest: $guest from ref#:$ref_no";

//log activity
$activity = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

    //Update system log
    $sql_4 = "UPDATE bgi_reservations ". 
        "SET modified_date = NOW(), modified_by = '$loggedinas'". 
        "WHERE ref_no_sys = '$ref_no'";
        $retval4 = mysql_query( $sql_4, $conn );

if($sql)
{
	if ($fasttrack == 1) {
                echo "<script>window.location='ftreservation-details.php?id=".$reservation_id."&ok=4'</script>";
            } else {
                echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=4'</script>";
            }
}
mysql_close($conn);
}
ob_end_flush();
?>
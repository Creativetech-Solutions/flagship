<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-gnd/init.php");
  
  if (!$user->levelCheck("2,3,5,6,7,9,"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
ob_start();
/**
 * @author Alvin herbert
 * @copyright 2015
 */

include ('header.php');

if(isset($_GET['id']))
{
$ref_no = $_GET['ref'];
$reservation_id=$_GET['reservation'];
$guest_id = $_GET['id'];

//get reservation A/C/I count
/**
 * $reservations = mysql_fetch_row(mysql_query("SELECT * FROM gnd_reservations WHERE id='" . $reservation_id . "'"));
 * $adult = $reservations[8];
 * $child = $reservations[9];
 * $infant = $reservations[10];
 */

//determine if guest is Adult, Child, Infant and decrease count by 1
/**
 * $guest_check = mysql_fetch_row(mysql_query("SELECT * FROM gnd_guest WHERE id='" . $reservation_id . "'"));
 * $adult_check = $guest_check[5];
 * $child_check = $guest_check[6];
 * $infant_check = $guest_check[7];
 *         
 *         if($adult_check >= 1){
 *            $adult_set = $adult - 1;
 *            } else {
 *             $adult_set = $adult;
 *            }
 *             
 *             $sql1 = "UPDATE gnd_reservations ". 
 *         "SET adult = '$adult_set'". 
 *         "WHERE id = '$reservation_id'";
 *         $retval1 = mysql_query( $sql1, $conn );
 *             
 *         
 *         if ($child_check >= 1){
 *             $child_set = $child - 1;
 *            } else {
 *             $child_set = $child;
 *            }
 *             
 *             $sql2 = "UPDATE gnd_reservations ". 
 *         "SET child = '$child_set'". 
 *         "WHERE id = '$reservation_id'";
 *         $retval2 = mysql_query( $sql2, $conn );
 *             
 *         
 *         if ($infant_check >= 1){
 *             $infant_set = $infant - 1;
 *            } else {
 *             $infant_set = $infant;
 *            }
 *             
 *             $sql3 = "UPDATE gnd_reservations ". 
 *         "SET infant = '$infant_set'". 
 *         "WHERE id = '$reservation_id'";
 *         $retval3 = mysql_query( $sql3, $conn );
 */
            

$sql=mysql_query("delete from gnd_guest where id='$guest_id'");

//Activity Log info
$loggedinas=$_GET['logger'];
$guest = $_GET['guest'];
$useraction="delete guest: $guest from ref#:$ref_no";

//log activity
$activity = "INSERT INTO gnd_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$useraction', NOW())";
        $retval = mysql_query( $activity, $conn );

if($sql)
{
header('location:reservation-details.php?id=' . $reservation_id . '');
mysql_close($conn);
}
}
ob_end_flush();
?>

<?php
ob_start();
/**
 * @author Alvin Herbert
 * @copyright 2015
 */


if(isset($_REQUEST['sect']) && !empty($_REQUEST['sect'])){
    $section = $_REQUEST['sect'];
} else {
    $section = 'gh';
}

include('header.php');
include('select.class.php');
$loggedinas = $row->fname . ' ' . $row->lname;
$reservation = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reservations WHERE id='" . QuoteSmart($_GET['id']) . "'"));
$get_arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $reservation[16] . "'"));
$get_arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $reservation[15] . "'"));
$get_dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $reservation[28] . "'"));
$get_dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $reservation[27] . "'"));
$get_arr_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $reservation[21] . "'"));  
$get_arr_location = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $reservation[22] . "'"));
$get_arr_roomtype = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $reservation[23] . "'"));  
$get_arr_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $reservation[19] . "'"));
$get_arr_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM bgi_vehicles WHERE id_vehicle='" . $reservation[20] ."'"));
$get_dpt_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $reservation[30] . "'"));
$get_dpt_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM bgi_vehicles WHERE id_vehicle='" . $reservation[31] . "'"));
$get_touroperator = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $reservation[5] . "'"));
$get_dptpickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $reservation[32] . "'"));
$get_dptdropoff = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $reservation[33] . "'"));
$get_flightclass = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $reservation[17] . "'"));
$get_dpt_flightclass = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $reservation[55] . "'"));
$get_reptype = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $reservation[24] . "'"));
$flagship_ref = $reservation[40];

//Get and count how many guests are on this reservation
$guestrows = mysql_query("SELECT * FROM bgi_guest WHERE ref_no_sys='$flagship_ref'");
$guest_count = mysql_num_rows($guestrows);

$mainGuestInfo = mysql_query("SELECT * FROM bgi_guest WHERE ref_no_sys='$flagship_ref' LIMIT 1");
$mainGuestInfo = mysql_fetch_row($mainGuestInfo); 

$departurerows = mysql_query("SELECT * FROM bgi_departures WHERE ref_no_sys='$flagship_ref'");
$departure_count = mysql_num_rows($departurerows);
$arrivalrows = mysql_query("SELECT * FROM bgi_arrivals WHERE ref_no_sys='$flagship_ref'");
$arrival_count = mysql_num_rows($arrivalrows);
$transferrows = mysql_query("SELECT * FROM bgi_transfer WHERE ref_no_sys='$flagship_ref'");
$transfer_count = mysql_num_rows($transferrows);
$transport_arr = mysql_query("SELECT * FROM bgi_resdrivers WHERE ref_no_sys='$flagship_ref' AND res_type=1");
$arr_count = mysql_numrows($transport_arr);

$transport_dpt = mysql_query("SELECT * FROM bgi_resdrivers WHERE ref_no_sys='$flagship_ref' AND res_type=2");
$dpt_count = mysql_numrows($transport_dpt);
// conceirge transfer 

$concerigeTransfer = mysql_query("SELECT * FROM bgi_additional_transfer WHERE ref_no_sys='$flagship_ref'");
$concerige_transfer_count = mysql_num_rows($concerigeTransfer);
//Get tour operator list

$adHotels = mysql_query("SELECT * FROM bgi_additional_hotels WHERE ref_no_sys='$flagship_ref'");
$adHotelsCount = mysql_num_rows($adHotels);
//Get tour operator list

$operselect = mysql_query("SELECT * FROM bgi_touroperator ORDER BY tour_operator ASC");
$dptlocationselect = mysql_query("SELECT * FROM bgi_location ORDER BY name ASC");
$classselect = mysql_query("SELECT * FROM bgi_flightclass ORDER BY class ASC");
$dpt_classselect = mysql_query("SELECT * FROM bgi_flightclass ORDER BY class ASC");
$reptypeselect = mysql_query("SELECT * FROM bgi_reptype ORDER BY id ASC");
$roomtypeselect = mysql_query("SELECT * FROM bgi_roomtypes WHERE id_location='" . $reservation[22] . "' ORDER BY id_room ASC");
   
if(!$reservation) {
    echo "<script>window.location='view-reservations.php'</script>";
	exit;
}
site_header('Reservation Details');

if(isset($_POST['update']))
{

//Sanitize data

    $tour_notes         = QuoteSmart($_POST['tour_notes']); 
    $guest_cell = $_POST['guest_cell'];
    $guest_email = $_POST['guest_email'];
    $user_action = "update reservation: $title_name. $first_name $last_name #ref:$flagship_ref";
   
    
	$sql = "UPDATE bgi_reservations ". 
        "SET tour_notes = '$tour_notes' ". 
        "WHERE ref_no_sys = '$flagship_ref'";
        $retval = mysql_query( $sql, $conn );   
    
    // update guest email and cell
 

    $sql_2 = "UPDATE bgi_guest ".
        "SET email = '$guest_email', cell ='$guest_cell'".
        "WHERE ref_no_sys = '$flagship_ref'";
        mysql_query( $sql_2, $conn );   

    //Log user action
    $sql_4 = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval4 = mysql_query( $sql_4, $conn );      
        
        if(!$retval)
            {
                die('Could not enter data: ' . mysql_error());
            }
            echo "<script>window.location='reservation-details.php?id=".$reservation[0]."&ok=1'</script>";         
        mysql_close($conn);
        
	}
    ob_end_flush();
?>

                  
                        
                    <?php include ('profile.php'); ?>
                    <?php include ('navigation.php'); ?>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                <?php include ('vert-navigation.php'); ?>
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="dashboard.php">Home</a></li>
                    <li>Reservations</li>
                    <li><a href="view-reservations-arr.php">View Reservations</a></li>
                    <li class="active"><a href="reservation-details.php?id=<?php echo $reservation[0]; ?>">Reservation - <?php echo $reservation[2]; ?> <?php echo $reservation[3]; ?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Viewing reservation for <?php echo $reservation[1]; ?>. <?php echo $reservation[2]; ?> <?php echo $reservation[3]; ?></strong></h3>
                                </div>
                                <div class="panel-body"><!-- System info -->
                                    <div class="col-md-3">
                                        <div class="widget widget-success widget-item-icon">
                                            <div class="widget-item-left">
                                                <span class="fa fa-cloud"></span>
                                            </div>
                                            <div class="widget-data">
                                                <div class="widget-title">System Info</div>
                                                <div class="widget-subtitle"><strong>Reference#: <?php echo $reservation[40]; ?></strong></div>
                                                <div class="widget-subtitle">
                                                    Status: <?php echo ($reservation[43]< 2) ? '<span class="label label-info">Active</span>' : '<span class="label label-danger">Cancelled</span>'; ?>
                                                    <div class="clearfix"></div>
                                                    Created: <?php echo $reservation[36]; ?><br />
                                                    Created by: <?php echo $reservation[37]; ?><br />
                                                    Modified: <?php echo $reservation[38]; ?><br />
                                                    Modified by: <?php echo $reservation[39]; ?>
                                                </div>
                                            </div>
                                            <div class="left20"> 
                                            <div class="form-group"><!-- available driver selection -->
                                                <button name="update" class="btn btn-warning" id="update" type="submit">Update</button>
                                            </div>
                                            </div>    
                                        </div>  
                                    </div>
                                </div><!-- end system info -->
                                <div class="panel-body">
                                    <h4>Gh Reservation Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-9"><!-- first name / last name fields -->
                                            <label class="left20">First name</label> <input type="text" class="form-control right20 text-capitalize" placeholder="First name" id="first_name" name="first_name" readonly="true" value="<?php echo $reservation[2]; ?>">
                                            <label>Last name</label> <input type="text" class="form-control text-capitalize right20" readonly="true" placeholder="Last name" id="last_name" name="last_name" value="<?php echo $reservation[3]; ?>">
                                            <div class="form-group col-xs-3"><!-- title selection -->
                                            <select class="form-control select" id="title-name" disabled="disabled" readonly="true" name="title_name">
                                                <option value="" <?php echo ($reservation[1] == '') ? 'selected' : ''; ?>>Select title</option>
                                                <option <?php echo ($reservation[1] == 'Mr') ? 'selected' : ''; ?>>Mr</option>
                                                <option <?php echo ($reservation[1] == 'Mrs') ? 'selected' : ''; ?>>Mrs</option>
                                                <option <?php echo ($reservation[1] == 'Ms') ? 'selected' : ''; ?>>Ms</option>
                                                <option <?php echo ($reservation[1] == 'Dr') ? 'selected' : ''; ?>>Dr</option>
                                                <option <?php echo ($reservation[1] == 'Sir') ? 'selected' : ''; ?>>Sir</option>
                                                <option <?php echo ($reservation[1] == 'Lord') ? 'selected' : ''; ?>>Lord</option>
                                                <option <?php echo ($reservation[1] == 'Lady') ? 'selected' : ''; ?>>Lady</option>
                                                <option <?php echo ($reservation[1] == 'Captain') ? 'selected' : ''; ?>>Captain</option>
                                                <option <?php echo ($reservation[1] == 'Professor') ? 'selected' : ''; ?>>Professor</option>
                                                <option <?php echo ($reservation[1] == 'Viscount') ? 'selected' : ''; ?>>Viscount</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $mainGuestEmail = $mainGuestCell = '';
                                        if(isset($mainGuestInfo[9])) {
                                            if(!empty($mainGuestInfo[9]))
                                                $mainGuestEmail = $mainGuestInfo[9];
                                            if(!empty($mainGuestInfo[10]))
                                                $mainGuestCell = $mainGuestInfo[10];
                                        } 
                                     ?>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-12">
                                            <label>Guest Cell</label> <input type="text" class="form-control right20 text-capitalize" placeholder="Guest Cell" id="guest-cell" name="guest_cell" value="<?=$mainGuestCell?>" autocomplete="off">
                                            <label>Guest Email</label> <input type="text" class="form-control right20" placeholder="Guest Email" id="guest-email" name="guest_email" value="<?=$mainGuestEmail?>" autocomplete="off">
                                        </div>
                                    </div>   
                                    
                                   
                                    <div class="form-group">
                                        <div class="col-xs-7">                                            
                                            <label>Rep Notes</label>
                                            <textarea class="form-control text-lowercase" rows="5" id="tour-notes" name="tour_notes" placeholder="Rep notes: additional rep comments and details here"><?php echo $reservation[11]; ?></textarea>
                                        </div>
                                    </div>
                                    <hr />
                            </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->             
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>             
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        
        
        <!-- END THIS PAGE PLUGINS -->       
        
        <!-- START TEMPLATE -->      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>

<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
        <!--Select2-->
        <script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->
        <script>
             $('body').on('keyup', function(e){
                var ele = $(e.target);
                if(ele.attr('class') == 'triggerTourOp'){
                    $('#tour-oper').select2('open'); 
                }
                else if(ele.find('#select2-tour-oper-container').length){ 
                    $('#oper-code').focus(); 
                //console.log($(e.target).find('#select2-tour-oper-container'));
                }

            })

         $(document).on('keyup', 'input[type="text"]:not(#tour-ref-no)', function(e){
            var $str = $(this).val();
            $(this).val($str.substr(0,1).toUpperCase()+$str.substr(1).toLowerCase());
        })

       

        </script>
        <?php
            if(isset($_GET['ok'])){
                $ok = $_GET['ok'];
                if($ok == 1)  {
                    echo '<script> alert("Reservation successfully updated"); </script>';
                }elseif ($ok == 2) {
                    echo '<script> alert("Guest successfully added"); </script>';
                } elseif ($ok == 3) {
    				echo '<script> alert("Guest successfully updated"); </script>';
    			} elseif ($ok == 4) {
    				echo '<script> alert("Guest successfully removed"); </script>';
    			} elseif ($ok == 5) {
    				echo '<script> alert("Arrival details successfully added"); </script>';
    			} elseif ($ok == 6) {
    				echo '<script> alert("Departure details successfully added"); </script>';
    			} elseif ($ok == 7) {
    				echo '<script> alert("Arrival details successfully updated"); </script>';
    			} elseif ($ok == 8) {
    				echo '<script> alert("Departure details successfully updated"); </script>';
    			} elseif ($ok == 9) {
    				echo '<script> alert("Transfer details successfully added"); </script>';
    			} elseif ($ok == 10) {
    					echo '<script> alert("Transfer details successfully updated"); </script>';
    		    } elseif ($ok == 11) {
    				echo '<script> alert("Transfer details successfully removed"); </script>';
    			} elseif ($ok == 12) {
    				echo '<script> alert("arrival details successfully removed"); </script>';
    			} elseif ($ok == 13) {
    				echo '<script> alert("departure details successfully removed"); </script>';
    			}elseif ($ok == 14) {
                    echo '<script> alert("Concierge Transfer details successfully removed"); </script>';
                }elseif ($ok == 15) {
                    echo '<script> alert("Concierge Transfer details successfully added"); </script>';
                }elseif ($ok == 16) {
                    echo '<script> alert("Concierge Transfer details successfully updated"); </script>';
                }elseif ($ok == 17) {
                    echo '<script> alert("Additional Hotel successfully added"); </script>';
                }elseif ($ok == 18) {
                    echo '<script> alert("Additional Hotel successfully updated"); </script>';
                }
            }
        ?> 
    </body>
</html>
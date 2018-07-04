<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-anu/init.php");
  
  if (!$user->levelCheck("3,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
ob_start();
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');
include('select.class.php');
$loggedinas = $row->fname . ' ' . $row->lname;
$reservation = mysql_fetch_row(mysql_query("SELECT * FROM anu_reservations WHERE id='" . QuoteSmart($_GET['id']) . "' AND fast_track = 1"));
$get_arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM anu_flights WHERE id_flight='" . $reservation[16] . "'"));
$get_arr_time = mysql_fetch_row(mysql_query("SELECT * FROM anu_flighttime WHERE id_fltime='" . $reservation[15] . "'"));
$get_dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM anu_flights WHERE id_flight='" . $reservation[28] . "'"));
$get_dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM anu_flighttime WHERE id_fltime='" . $reservation[27] . "'"));
$get_arr_pickup = mysql_fetch_row(mysql_query("SELECT * FROM anu_location WHERE id_location='" . $reservation[21] . "'"));  
$get_arr_location = mysql_fetch_row(mysql_query("SELECT * FROM anu_location WHERE id_location='" . $reservation[22] . "'"));
$get_arr_roomtype = mysql_fetch_row(mysql_query("SELECT * FROM anu_roomtypes WHERE id_room='" . $reservation[23] . "'"));  
$get_arr_driver = mysql_fetch_row(mysql_query("SELECT * FROM anu_transport WHERE id_transport='" . $reservation[19] . "'"));
$get_arr_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM anu_vehicles WHERE id_vehicle='" . $reservation[20] ."'"));
$get_dpt_driver = mysql_fetch_row(mysql_query("SELECT * FROM anu_transport WHERE id_transport='" . $reservation[30] . "'"));
$get_dpt_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM anu_vehicles WHERE id_vehicle='" . $reservation[31] . "'"));
$get_touroperator = mysql_fetch_row(mysql_query("SELECT * FROM anu_touroperator WHERE id='" . $reservation[5] . "'"));
$get_dptpickup = mysql_fetch_row(mysql_query("SELECT * FROM anu_location WHERE id_location='" . $reservation[32] . "'"));
$get_dptdropoff = mysql_fetch_row(mysql_query("SELECT * FROM anu_location WHERE id_location='" . $reservation[33] . "'"));
$flagship_ref = $reservation[40];

//Get and count how many guests are on this reservation
$guestrows = mysql_query("SELECT * FROM anu_guest WHERE ref_no_sys='$flagship_ref'");
$guest_count = mysql_num_rows($guestrows);

//Get tour operator list
$operselect = mysql_query("SELECT * FROM anu_touroperator ORDER BY tour_operator ASC");
$dptlocationselect = mysql_query("SELECT * FROM anu_location ORDER BY name ASC");

$iamstatus = "";

// check status
if ($reservation[43]< 2){
    $status = '<span class="label label-info">Active</span>';
    $status_label = "Active";
    $iamstatus = "selected";
} else {
    $status = '<span class="label label-danger">Cancelled</span>';
    $status_label = "Cancelled";
}

if(!$reservation) {
	header('Location: view-ftreservations.php');
	exit;
}
site_header('Fast Track Reservation Details');

if(isset($_POST['update']))
{

//Sanitize data
    $title_name         = QuoteSmart($_POST['title_name']);
    $first_name         = QuoteSmart($_POST['first_name']);
	$last_name          = QuoteSmart($_POST['last_name']);
	$pnr                = QuoteSmart($_POST['pnr']);
    $tour_oper          = QuoteSmart($_POST['tour_oper']);
    $oper_code          = QuoteSmart($_POST['oper_code']);
    $tour_ref_no        = QuoteSmart($_POST['tour_ref_no']);
    $affiliates         = QuoteSmart($_POST['affiliates']);        
    $adults             = QuoteSmart($_POST['adults']);
    $children           = QuoteSmart($_POST['children']);
    $infants            = QuoteSmart($_POST['infants']);
    $tour_notes         = QuoteSmart($_POST['tour_notes']);
    $arr_date           = QuoteSmart($_POST['arr_date']);
    $arr_time           = QuoteSmart($_POST['arr_time']);
    $arr_flight_no      = QuoteSmart($_POST['arr_flight_no']);
    $flight_class       = QuoteSmart($_POST['flight_class']);
    $arr_transport      = QuoteSmart(implode(', ',$_POST['arr_transport']));
    $arr_driver         = QuoteSmart($_POST['arr_driver']);
    $arr_vehicle_no     = QuoteSmart($_POST['arr_vehicle_no']);
    $arr_pickup         = QuoteSmart($_POST['arr_pickup']);
    $arr_dropoff        = QuoteSmart($_POST['arr_dropoff']);
    $room_type          = QuoteSmart($_POST['room_type']);
    $rep_type           = QuoteSmart($_POST['rep_type']);
    $client_reqs        = QuoteSmart(implode(', ',$_POST['client_reqs']));
    $res_status         = QuoteSmart($_POST['res_status']);    
    $child_age          = QuoteSmart($_POST['child_age']);
    $infant_age         = QuoteSmart($_POST['infant_age']);
    $guest_pnr          = QuoteSmart($_POST['guest_pnr']);
    $dpt_date           = QuoteSmart($_POST['dpt_date']);
    $dpt_time           = QuoteSmart($_POST['dpt_time']);
    $dpt_flight_no      = QuoteSmart($_POST['dpt_flight_no']);
    $dpt_transport      = QuoteSmart(implode(', ',$_POST['dpt_transport']));
    $dpt_driver         = QuoteSmart($_POST['dpt_driver']);
    $dpt_vehicle_no     = QuoteSmart($_POST['dpt_vehicle_no']);
    $dpt_pickup         = QuoteSmart($_POST['dpt_pickup']);
    $dpt_dropoff        = QuoteSmart($_POST['dpt_dropoff']);
    $pickup_time        = QuoteSmart($_POST['pickup_time']);
    $dpt_notes          = QuoteSmart($_POST['dpt_notes']);
    $arr_transport_notes = QuoteSmart($_POST['arr_transport_notes']);
    $arr_hotel_notes     = QuoteSmart($_POST['arr_hotel_notes']);
    $dpt_transport_notes = QuoteSmart($_POST['dpt_transport_notes']);
    $ftres = 1;
    $user_action = "update reservation: $title_name. $first_name $last_name #ref:$flagship_ref";
    
    
    //Post driver info to jobsheet
    if ($arr_driver > 0 && $arr_count > 0){
        $res_type_arr = 1;
        $sql2 = "UPDATE anu_resdrivers ". 
        "SET transport = '$arr_driver', vehicle = '$arr_vehicle_no', ref_no_sys = '$flagship_ref', adult = '$adults', child = '$children', infant = '$infants', tour_operator = '$tour_oper', location = '$arr_pickup', pickup_time = '$arr_time',  comments = '$arr_transport_notes', flight_time = '$arr_time', flight_no = '$arr_flight_no', infant_seats = '$infant_seats', child_seats = '$child_seats', booster_seats = '$booster_seats', title_name = '$title_name', first_name = '$first_name', last_name = '$last_name', transport_date = '$arr_date'". 
        "WHERE ref_no_sys = '$flagship_ref' AND res_type = 1";
        $retval2 = mysql_query( $sql2, $conn );
    } elseif ($arr_driver > 0 && $arr_count == 0){
        $res_type_arr = 1;
        $sql2 = "INSERT INTO anu_resdrivers ". 
        "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) ". 
        "VALUES ('$arr_driver', '$arr_vehicle_no', '$flagship_ref', '$adults', '$children', '$infants', '$tour_oper', '$arr_pickup', '$arr_time', '$arr_transport_notes', '$arr_time', '$arr_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$arr_date', '$res_type_arr')";
        $retval2 = mysql_query( $sql2, $conn );
    } 
    
    if ($dpt_driver > 0 && $dpt_count > 0){
        $res_type_dpt = 2;
        $sql3 = "UPDATE anu_resdrivers ". 
        "SET transport = '$dpt_driver', vehicle = '$dpt_vehicle_no', ref_no_sys = '$flagship_ref', adult = '$adults', child = '$children', infant = '$infants', tour_operator = '$tour_oper', location = '$dpt_pickup', pickup_time = '$dpt_time',  comments = '$dpt_transport_notes', flight_time = '$dpt_time', flight_no = '$dpt_flight_no', infant_seats = '$infant_seats', child_seats = '$child_seats', booster_seats = '$booster_seats', title_name = '$title_name', first_name = '$first_name', last_name = '$last_name', transport_date = '$dpt_date'". 
        "WHERE ref_no_sys = '$flagship_ref' AND res_type = '2'";
        $retval3 = mysql_query( $sql3, $conn );
    } elseif ($dpt_driver > 0 && $dpt_count == 0){
        $res_type_dpt = 2;
        $sql3 = "INSERT INTO anu_resdrivers ". 
        "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) ". 
        "VALUES ('$dpt_driver', '$dpt_vehicle_no', '$flagship_ref', '$adults', '$children', '$infants', '$tour_oper', '$dpt_pickup', '$pickup_time', '$dpt_transport_notes', '$dpt_time', '$dpt_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$dpt_date', '$res_type_dpt')";
        $retval3 = mysql_query( $sql3, $conn );
    }
    
    //Put all this stuff into the database
    $sql = "UPDATE anu_reservations ". 
        "SET title_name = '$title_name', first_name = '$first_name', last_name = '$last_name', pnr = '$pnr', tour_operator = '$tour_oper', operator_code = '$oper_code', tour_ref_no = '$tour_ref_no', adult = '$adults', child = '$children', infant = '$infants', tour_notes = '$tour_notes', fast_track = '$ftres', affiliates = '$affiliates', arr_date = '$arr_date', arr_time = '$arr_time', arr_flight_no = '$arr_flight_no', flight_class = '$flight_class', arr_transport = '$arr_transport', arr_driver = '$arr_driver', arr_vehicle = '$arr_vehicle_no', arr_pickup = '$arr_pickup', arr_dropoff = '$arr_dropoff', room_type = '$room_type', rep_type = '$rep_type', client_reqs = '$client_reqs', dpt_date = '$dpt_date', dpt_time = '$dpt_time', dpt_flight_no = '$dpt_flight_no', dpt_transport = '$dpt_transport', dpt_driver = '$dpt_driver', dpt_vehicle = '$dpt_vehicle_no', dpt_pickup = '$dpt_pickup', dpt_dropoff = '$dpt_dropoff', dpt_pickup_time = '$pickup_time', dpt_notes = '$dpt_notes', modified_date = NOW(), modified_by = '$loggedinas', status = '$res_status', arr_transport_notes = '$arr_transport_notes', dpt_transport_notes = '$dpt_transport_notes', arr_hotel_notes = '$arr_hotel_notes'". 
        "WHERE ref_no_sys = '$flagship_ref'";
        $retval = mysql_query( $sql, $conn );
  
    $sql_1 = "UPDATE anu_guest ". 
        "SET title_name = '$guest_title_name', first_name = '$guest_first_name', last_name = '$guest_last_name', adult = '$guest_adult', child_age = '$child_age', infant_age = '$infant_age', pnr = '$guest_pnr' ". 
        "WHERE ref_no_sys = '$flagship_ref'";
        $retval1 = mysql_query( $sql_1, $conn );
        
    //Log user action
    $sql_4 = "INSERT INTO anu_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval4 = mysql_query( $sql_4, $conn );
        
        if(! $retval )
            {
                die('Could not enter data: ' . mysql_error());
            }     
        echo "<script>alert('Reservation successfully updated');</script>";   
            
        mysql_close($conn);
        $ok= $_GET['id'];
        header('Location:ftreservation-details.php?id=' . $ok . '');
	}
    ob_end_flush();
?>
                    <script type="text/javascript">
                                    $(document).ready(function(){
                                        //$("#arr-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#arr-driver").change(function(){
                                            $("#arr-vehicle-no").attr("disabled","disabled");
                                            $("#arr-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#arr-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#arr-vehicle-no").removeAttr("disabled");
                                                $("#arr-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        
                                        //$("#dpt-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#dpt-driver").change(function(){
                                            $("#dpt-vehicle-no").attr("disabled","disabled");
                                            $("#dpt-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#dpt-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#dpt-vehicle-no").removeAttr("disabled");
                                                $("#dpt-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        
                                        //$("#arr-time").attr("disabled","disabled");
                                        
                                        $("#arr-flight-no").change(function(){
                                            $("#arr-time").attr("disabled","disabled");
                                            $("#arr-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#arr-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#arr-time").removeAttr("disabled");
                                                $("#arr-time").html(data);
                                                
                                            });
                                        });
                                        
                                        //$("#dpt-time").attr("disabled","disabled");
                                        
                                        $("#dpt-flight-no").change(function(){
                                            $("#dpt-time").attr("disabled","disabled");
                                            $("#dpt-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#dpt-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#dpt-time").removeAttr("disabled");
                                                $("#dpt-time").html(data);
                                                
                                            });
                                        });
                                        
                                        //$("#room-type").attr("disabled","disabled");
                                        
                                        $("#arr-dropoff").change(function(){
                                            $("#room-type").attr("disabled","disabled");
                                            $("#room-type").html("<option>Loading rooms ...</option>");
                                        
                                            var locationid = $("#arr-dropoff option:selected").attr('value');
                                        
                                            $.post("select_roomtype.php", {locationid:locationid}, function(data){
                                                $("#room-type").removeAttr("disabled");
                                                $("#room-type").html(data);
                                                
                                            });
                                        });
                                    });
                                </script>
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
                    <li>Fast Track</li>
                    <li><a href="view-ftreservations.php">View Fast Track Reservations</a></li>
                    <li class="active"><a href="ftreservation-details.php?id=<?php echo $reservation[0]; ?>">Fast Track Reservation - <?php echo $reservation[2]; ?> <?php echo $reservation[3]; ?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <!-- Force modified by -->
                            <div class="form-group form-inline col-xs-4 hidden">
                                <label class="col-md-2 control-label" style="margin-right: 20px;">Force created </label> 
                                <input type="text" class="form-control" id="modified-by" name="modified_by" readonly value="Administrator"/>
                            </div>
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
                                                    Status: <?php echo $status; ?>
                                                    <div class="clearfix"></div>
                                                    Created: <?php echo $reservation[36]; ?><br />
                                                    Created by: <?php echo $reservation[37]; ?><br />
                                                    Modified: <?php echo $reservation[38]; ?><br />
                                                    Modified by: <?php echo $reservation[39]; ?>
                                                </div>
                                            </div>
                                            <div class="form-group left20"><!-- available driver selection -->
                                                <label class="left20">Reservation Status:
                                                    <select class="form-control form-inline" id="res-status" name="res_status">
                                                        <option value="2" <?php echo $iamstatus; ?>>Cancelled</option>
                                                        <option value="1" <?php echo $iamstatus; ?>>Active</option>    
                                                    </select>
                                                </label> 
                                                <button class="btn btn-default left20" onclick="goBack()" type="button">Exit</button>
                                                <button name="update" class="btn btn-warning" id="update" type="submit">Update</button>        
                                            </div>                            
                                        </div>
                                    </div>
                                </div><!-- end system info -->
                                <div class="panel-body">
                                    <h4>Tour Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-7"><!-- first name / last name fields -->
                                            <input type="text" class="form-control left20" placeholder="Last name" id="last_name" name="last_name" value="<?php echo $reservation[3]; ?>">                                                                                
                                            <input type="text" class="form-control left20" placeholder="First name" id="first_name" name="first_name" value="<?php echo $reservation[2]; ?>">
                                            <div class="form-group col-xs-3"><!-- title selection -->
                                            <select class="form-control select" id="title-name" name="title_name">
                                                <option><?php echo $reservation[1]; ?></option>
                                                <option>Mr</option>
                                                <option>Mrs</option>
                                                <option>Ms</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- Passenger name record field -->
                                        <input type="text" class="form-control" placeholder="Passenger name record (PNR)" id="pnr" name="pnr" value="<?php echo $reservation[4]; ?>">
                                    </div>
                                    
                                    <div class="form-group col-xs-7"><!-- tour operator selection -->                                       
                                            <?php
                                            // Error handling for operselect
                                            if($operselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                            
                                            //Show selected tour operator and list all the others 
                                            echo '<select class="form-control select" id="tour-oper" name="tour_oper">';
                                            while ($row = mysql_fetch_array($operselect)) {
                                                if ($row['id'] == $get_touroperator[0]) {
                                                echo "<option value='" . $row['id'] . "' selected>" . $row['tour_operator'] . "</option>";
                                                } else {
                                                echo "<option value='" . $row['id'] . "'>" . $row['tour_operator'] . "</option>";
                                                }
                                            }
                                                echo "</select>"
                                            ?>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- operator code field -->
                                        <input type="text" class="form-control" placeholder="operator code" id="oper-code" name="oper_code" value="<?php echo $reservation[6]; ?>">
                                    </div>
                                    <div class="form-group col-xs-7"><!-- reference number field -->
                                        <input type="text" class="form-control" placeholder="reference number" id="tour-ref-no" name="tour_ref_no" value="<?php echo $reservation[7]; ?>">
                                    </div>
                                    <div class="form-group col-xs-7"><!-- affiliates field -->
                                        <input type="text" class="form-control" placeholder="afilliates" id="affiliates" name="affiliates" value="<?php echo $reservation[13]; ?>">
                                    </div>                                                                        
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9"><!-- number of persons traveling -->
			                                    <input type="number" min=0 max=99 class="right20 form-control" id="adults" name="adults" value="<?php echo $reservation[8]; ?>" placeholder="Select # of Adults">
                                                <input type="number" min=0 max=99 class="right20 form-control" id="children" name="children" value="<?php echo $reservation[9]; ?>" placeholder="Select # of Children">
                                                <input type="number" min=0 max=99 class="form-control" id="infants" name="infants" value="<?php echo $reservation[10]; ?>" placeholder="Select # of Infants">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-7">                                            
                                            <textarea class="form-control" rows="5" id="tour-notes" name="tour_notes" placeholder="additional comments and details here"><?php echo $reservation[11]; ?></textarea>
                                        </div>
                                    </div>
                                    <hr />
                                <h5>Reservation has <?php echo $guest_count; ?> guest(s)</h5>
                                <?php
                                if ($guest_count == 0){
                                    $hideme = 'hidden';
                                    } else {
                                        $hideme = '';
                                }
                                ?>
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><a href="add-guest.php?reservation=<?php echo $reservation[0]; ?>&ref=<?php echo $reservation[40]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Guest"></i> Add Guest</a></h3>    
                                </div>
                                <div class="panel-body" <?php echo $hideme;?>>
                                    <table id="guest-listing" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Adult</th>
                                                <th>Child Age</th>
                                                <th>Infant Age</th>
                                                <th>PNR</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($guestrows)) {

                                                $guest_adult = $row[5];
                                                if ($guest_adult > 0){
                                                    $guest_adult_check = '<i class="fa fa-check-square-o"></i>';
                                                    } else {
                                                        $guest_adult_check = "";
                                                    }
                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $guest_title = $row[1];
                                                $guest_first_name = $row[3];
                                                $guest_last_name = $row[4];
                                                $guest_adult = $row[5];
                                                $guest_child_age = $row[6];
                                                $guest_infant_age = $row[7];
                                                $guest_pnr = $row[8];   
                                                
                                                echo '<tr>
                                                        <td>' . $guest_title . '</td>
                                                        <td>' . $guest_first_name . '</td>
                                                        <td>' . $guest_last_name . '</td>
                                                        <td>' . $guest_adult_check . '</td>
                                                        <td>' . $guest_child_age . '</td>
                                                        <td>' . $guest_infant_age . '</td>
                                                        <td>' . $guest_pnr . '</td>
                                                        <td><a href="guest-details.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit guest"></i></a> | <a href="guest-delete.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&guest=' . $guest_first_name . ' ' . $guest_last_name . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete guest"></i></a></td>                                                       
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                  
                                </div>
                                </div>
                                <hr />
                                <h4>Arrival Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <div class="input-group date col-xs-3 right20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="arr_date" id="arr-date" placeholder="Arrival date" value="<?php echo $reservation[14]; ?>"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <select class="form-control" id="arr-flight-no" name="arr_flight_no">
                                        <option value="<?php echo $get_arr_flight_no[0]; ?>"><?php echo $get_arr_flight_no[1]; ?></option>
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <select class="form-control left20" id="arr-time" name="arr_time">
                                        <option value="<?php echo $get_arr_time[0]; ?>"><?php echo $get_arr_time[2]; ?></option>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- flight class selection -->
                                        <select class="form-control input-group" id="flight-class" name="flight_class">
                                            <option><?php echo $reservation[17]; ?></option>
                                            <option>Select flight class</option>
                                            <option>Business Class</option>
                                            <option>Club World</option>
                                            <option>Economy</option>
                                            <option>First Class</option>
                                            <option>Premium Economy</option>      
                                        </select>
                                    </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <?php include ('transport_mode_arrupdate.php'); ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <select class="form-control" id="arr-driver" name="arr_driver">
                                        <option value="<?php echo $get_arr_driver[0] ?>"><?php echo $get_arr_driver[1]; ?></option>
                                        <?php echo $opt->ShowTransport(); ?>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <select class="form-control" id="arr-vehicle-no" name="arr_vehicle_no">
                                        <option value="<?php echo $get_arr_vehicle[0] ?>"><?php echo $get_arr_vehicle[2]; ?></option> 
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <textarea class="form-control" rows="5" id="arr-transport-notes" name="arr_transport_notes" placeholder="additional transport comments and details here"><?php echo $reservation[44]; ?></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <select class="form-control" id="arr-pickup" name="arr_pickup">
                                        <option value="<?php echo $get_arr_pickup[0]; ?>"><?php echo $get_arr_pickup[1]; ?></option>
                                        <option value="0">Pickup Location</option>
                                        <option value="56">Airport</option>
                                        <option value="57">Seaport</option>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <select class="form-control" id="arr-dropoff" name="arr_dropoff">
                                        <option value="<?php echo $get_arr_location[0]; ?>"><?php echo $get_arr_location[1]; ?></option>
                                        <?php echo $opt->ShowLocation(); ?>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- room type selection -->
                                    <select class="form-control" id="room-type" name="room_type">
                                        <option value="<?php echo $get_arr_roomtype[0]; ?>"><?php echo $get_arr_roomtype[2]; ?></option>  
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <textarea class="form-control" rows="5" id="arr-hotel-notes" name="arr_hotel_notes" placeholder="additional hotel comments and details here"><?php echo $reservation[46]; ?></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- representation type selection -->
                                    <select class="form-control" id="rep-type" name="rep_type">
                                        <option><?php echo $reservation[24]; ?></option>
                                        <option>Representation</option>
                                        <option>Meet &amp; Greet</option>
                                        <option>Full Rep</option>
                                        <option>No Rep</option>
                                        <option>Intransit</option> 
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-7">                                        
                                        <select multiple class="form-control select" id="client-reqs" name="client_reqs[]">
                                            <option selected><?php echo $reservation[25]; ?></option>
                                            <option>Additional Requirements</option>
                                            <option>Child Seats</option>
                                            <option>Infant Seats</option>
                                            <option>Booster Seats</option>
                                            <option>Champagne</option>
                                            <option>Lounge Voucher</option>
                                            <option>Cold Towels</option>
                                            <option>Bottled Water</option>
                                            <option>Flowers</option>
                                            <option>Chocolates</option>
                                            <option>Rum punch Kits</option>
                                            <option>Spice Kits</option>
                                            <option>Carhire</option>
                                            <option>Wine</option>
                                            <option>Pre-booked Excursions</option>
                                        </select>
                                        <span class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>  
                                    </div>
                                <div class="clearfix"></div>
                                <hr />
                                <h4>Departure Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <div class="input-group date col-xs-3 right20" data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker"  name="dpt_date" id="dpt-date" placeholder="Departure date" value="<?php echo $reservation[26]; ?>"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <select class="form-control" id="dpt-flight-no" name="dpt_flight_no">
                                        <option value="<?php echo $get_dpt_flight_no[0]; ?>"><?php echo $get_dpt_flight_no[1]; ?></option>
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <select class="form-control left20" id="dpt-time" name="dpt_time">
                                        <option value="<?php $get_dpt_time[0]; ?>"><?php echo $get_dpt_time[2]; ?></option>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <?php include ('transport_mode_dptupdate.php'); ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <select class="form-control" id="dpt-driver" name="dpt_driver">
                                        <option value="<?php echo $get_dpt_driver[0] ?>"><?php echo $get_dpt_driver[1]; ?></option>
                                        <?php echo $opt->ShowTransport(); ?>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <select class="form-control" id="dpt-vehicle-no" name="dpt_vehicle_no">
                                        <option value="<?php echo $get_dpt_vehicle[0] ?>"><?php echo $get_dpt_vehicle[2]; ?></option> 
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <textarea class="form-control" rows="5" id="dpt-transport-notes" name="dpt_transport_notes" placeholder="additional transport comments and details here"><?php echo $reservation[45]; ?></textarea>
                                    </div>
                                 </div>
                                <div class="clearfix"></div>
                                    <div class="form-group col-xs-4"><!-- pickup location selection -->
                                        <?php
                                            // Error handling for dptlocationselect
                                            if($dptlocationselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                            
                                            echo '<select class="form-control select" id="dpt-pickup" name="dpt_pickup">';
                                             //Show selected location and list all the others 
                                            while ($row = mysql_fetch_array($dptlocationselect)) {
                                                if ($row['id_location'] == $get_dptpickup[0]) {
                                                echo "<option value='" . $row['id_location'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                                }
                                            }
                                                echo "</select>"
                                            ?>
                                    </div>
                                    <div class="form-group"><!-- pickup time -->
                                        <div class="input-group bootstrap-timepicker col-xs-3">
                                            <input type="text" class="form-control timepicker24" name="pickup_time" id="pickup-time" placeholder="Pickup time" value="<?php echo $reservation[34]; ?>"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                        <?php
                                            // Error handling for dptlocationselect
                                            if($dptlocationselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                             
                                            echo '<select class="form-control select" id="dpt-dropoff" name="dpt_dropoff">';
                                            //reset dptlocationselect for second loop
                                            mysql_data_seek($dptlocationselect, 0);
                                             //Show selected location and list all the others 
                                            while ($row = mysql_fetch_array($dptlocationselect)) {
                                                if ($row['id_location'] == $get_dptdropoff[0]) {
                                                echo "<option value='" . $row['id_location'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                                }
                                            }
                                                echo "</select>"
                                            ?>
                                    </div>  
                                <div class="form-group"><!-- departure notes -->
                                        <div class="col-xs-7">                                            
                                            <textarea class="form-control" rows="5" id="dpt-notes" name="dpt_notes" placeholder="additional comments and details here"><?php echo $reservation[35]; ?></textarea>
                                        </div>
                                </div>
                                <div class="form-group col-xs-7 hidden"><!-- creation date saver -->
                                        <input type="text" class="form-control" id="creation-date" name="creation_date" value="<?php echo $reservation[36]; ?>">
                                </div>
                                <div class="panel-footer">
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>
                                    <button class="btn btn-default right20" onclick="goBack()" type="button">Exit</button>
                                    <button name="update" class="btn btn-warning" id="update" type="submit">Update</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>                              
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press Yes to logout current user. Press No if you want to continue working. </p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->             
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/clone-form-td.js"></script>              
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>              
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <!-- END THIS PAGE PLUGINS -->       
        
        <!-- START TEMPLATE -->      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->  
                
    </body>
</html>
<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  $url = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
  if (!$user->levelCheck("2,9,1,10"))
      redirect_to("index.php");
      
  if ($user->levelCheck("10")){
    require_once("rep-edit-reservation.php");
    exit;
  }
  $row = $user->getUserData();
?> 
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

    $title_name         = QuoteSmart($_POST['title_name']);
    $first_name         = QuoteSmart($_POST['first_name']);
	$last_name          = QuoteSmart($_POST['last_name']);
	$pnr                = QuoteSmart($_POST['pnr']);
    $tour_oper          = QuoteSmart($_POST['tour_oper']);
    $oper_code          = QuoteSmart($_POST['oper_code']);
    $tour_ref_no        = QuoteSmart($_POST['tour_ref_no']);
    $adults             = QuoteSmart($_POST['adults']);
   // $teens             = QuoteSmart($_POST['teens']);
    $children           = QuoteSmart($_POST['children']);
    $infants            = QuoteSmart($_POST['infants']);
    $tour_notes         = QuoteSmart($_POST['tour_notes']);
    
    $res_status         = QuoteSmart($_POST['res_status']);  
    $dpt_notes          = QuoteSmart($_POST['dpt_notes']);  
   
    $guest_cell = $_POST['guest_cell'];
    $guest_email = $_POST['guest_email'];
    $user_action = "update reservation: $title_name. $first_name $last_name #ref:$flagship_ref";
   
    
	$sql = "UPDATE bgi_reservations ". 
        "SET title_name = '$title_name', first_name = '$first_name', last_name = '$last_name', pnr = '$pnr', tour_operator = '$tour_oper', operator_code = '$oper_code', tour_ref_no = '$tour_ref_no', adult = '$adults', child = '$children', infant = '$infants', tour_notes = '$tour_notes', modified_date = NOW(), modified_by = '$loggedinas', status = '$res_status', dpt_notes ='$dpt_notes' ". 
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

                    
                    <script type="text/javascript">
                                    $(document).ready(function(){
                                        //$("#arr-vehicle-no").attr("disabled","disabled");
                                         $('.select2').select2({
                                            minimumInputLength: 3
                                        });                                        
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
                    <li>Reservations</li>
                    <li><a href="view-reservations-arr.php">View Reservations</a></li>
                    <li class="active"><a href="reservation-details.php?id=<?php echo $reservation[0]; ?>">Reservation - <?php echo $reservation[2]; ?> <?php echo $reservation[3]; ?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form id="update-reservation" class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
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
                                                <label>Reservation Status:
                                                    <select class="form-control form-inline" id="res-status" name="res_status">
                                                        <option value="2" <?php echo ($reservation[43] == 2) ? 'selected' : ''; ?>>Cancelled</option>
                                                        <option value="1" <?php echo ($reservation[43] == 1) ? 'selected' : ''; ?>>Active</option>    
                                                    </select>
                                                </label>
                                                <button class="btn btn-default left20" onclick="goBack()" type="button">Exit</button>
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
                                            <label class="left20">First name</label> <input type="text" class="form-control right20 text-capitalize" placeholder="First name" id="first_name" name="first_name" value="<?php echo $reservation[2]; ?>">
                                            <label>Last name</label> <input type="text" class="form-control text-capitalize right20" placeholder="Last name" id="last_name" name="last_name" value="<?php echo $reservation[3]; ?>">
                                            <div class="form-group col-xs-3"><!-- title selection -->
                                            <select class="form-control select" id="title-name" name="title_name">
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
                                    <div class="form-group col-xs-7"><!-- Passenger name record field -->
                                        <label>Passenger name record (PNR)</label>
                                        <input type="text" class="form-control" placeholder="Passenger name record (PNR)" id="pnr" name="pnr" value="<?php echo $reservation[4]; ?>">
                                    </div>
                                    
           <input type="text" style="height:0;width:0;border:none" class="triggerTourOp" />
                                    <div class="form-group col-xs-7"><!-- tour operator selection -->                                     
                                            <label>Tour Operator</label>
                                            <?php
                                            // Error handling for operselect
                                            if($operselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                            
                                            //Show selected tour operator and list all the others 
                                            echo '<select class="form-control select select2" id="tour-oper" name="tour_oper">';
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
                                        <label>Operator code/Brand</label>
                                        <input type="text" class="form-control" placeholder="operator code" id="oper-code" name="oper_code" value="<?php echo $reservation[6]; ?>">
                                    </div>
                                    <div class="form-group col-xs-7"><!-- reference number field -->
                                        <label>Reference number</label>
                                        <input type="text" class="form-control" placeholder="reference number" id="tour-ref-no" name="tour_ref_no" style="text-transform: none" value="<?php echo $reservation[7]; ?>">
                                        <span class="ref_no_check" data-old-ref="<?=$reservation[7]?>" data-id="0" style="font-size:12px;color:red"></span>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9"><!-- number of persons traveling -->
			                                    <input type="number" min=0 max=99 class="form-control" id="adults" name="adults" value="<?php echo $reservation[8]; ?>" placeholder="Select # of Adults"> Adult(s)
                                              <!--   <input type="number" min=0 max=99 class="left20 form-control" id="teens" name="teens" value="<?php echo $reservation[70]; ?>" placeholder="Select # of Teens"> Teens: 12 yrs - 17yrs -->
                                                <input type="number" min=0 max=11 class="left20 form-control" id="children" name="children" value="<?php echo $reservation[9]; ?>" placeholder="Select # of Children"> Children: 13 months - 11yrs
                                                <input type="number" min=0 max=12 class="left20 form-control" id="infants" name="infants" value="<?php echo $reservation[10]; ?>" placeholder="Select # of Infants"> Infant(s): 12 months and under
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-7">                                            
                                            <label>Rep Notes</label>
                                            <textarea class="form-control text-lowercase" rows="5" id="tour-notes" name="tour_notes" placeholder="Rep notes: additional rep comments and details here"><?php echo $reservation[11]; ?></textarea>
                                        </div>
                                    </div>
                                    <hr />
                                <h5>Reservation has <?php echo $guest_count; ?> guest(s)</h5>
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><a href="add-guest.php?reservation=<?php echo $reservation[0]; ?>&ref=<?php echo $reservation[40]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Guest"></i> Add Guest</a></h3>    
                                </div>
                                <div class="panel-body" <?php echo ($guest_count == 0) ? 'hidden' : ''; ?>>
                                    <table id="guest-listing" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Adult</th>
                                                <th>Teen Age</th>
                                                <th>Child Age</th>
                                                <th>Infant Age</th>
                                                <th>PNR</th>
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
                                                $guest_teen_age = $row[11];
                                                $guest_infant_age = $row[7];
                                                $guest_pnr = $row[8]; 
                                               /* $guest_email = $row[9];
                                                $guest_cell = $row[10];   */  
                                                
                                                echo '<tr>
                                                        <td><a href="guest-details.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit guest"></i></a> | <a href="guest-delete.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&guest=' . $guest_first_name . ' ' . $guest_last_name . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete guest"></i></a></td>
                                                        <td>' . $guest_title . '</td>
                                                        <td>' . $guest_first_name . '</td>
                                                        <td>' . $guest_last_name . '</td>
                                                        <td>' . $guest_adult_check . '</td>
                                                        <td>' . $guest_teen_age . '</td>
                                                        <td>' . $guest_child_age . '</td>
                                                        <td>' . $guest_infant_age . '</td>
                                                        <td>' . $guest_pnr . '</td>                                                       
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                  
                                </div>
                                </div>
                                <hr />
                                
                                <!-- arrival details -->
                                <h5>Reservation has <?php echo $arrival_count; ?> arrival(s)</h5>
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><a href="add-arrival.php?reservation=<?php echo $reservation[0]; ?>&ref=<?php echo $reservation[40]; ?>&sect=gh"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Arrival"></i> Add Arrival</a></h3>    
                                </div>
                                <div class="panel-body table-responsive">
                                    <table id="arrival-listing" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Arrival Date</th>
                                                <th>Flight #</th>
                                                <th>Flight time</th>
                                                <th>Flight class</th>
                                                <th>Rep Service</th>
                                                <th>Transport</th>
                                                <th>FSFT</th>
                                                <th>Transport Supplier</th>
                                                <th>Vehicle</th>
                                                <th>PU Location</th>
                                                <th>Dropoff Location</th>
                                                <th>Room type</th>
                                                <th>Room #</th>
                                                <th>No. of Rooms</th>
                                                <th>Arr & Trans notes</th>
                                                <th>Hotel notes</th>
                                                <th>Excursion Name</th>
                                                <th>Excursion Date</th>
                                                <th>Excursion Pickup</th>
                                                <th>Excursion Confirm By</th>
                                                <th>Excursion Confirm Date</th>
                                                <th>Excursion Guests</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($arrivalrows)) {
                                                /*echo '<pre>';
                                                print_r($row); exit;*/
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[4] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[3] . "'"));
                                                $arr_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[9] . "'"));  
                                                $arr_dropoff = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[10] . "'"));
                                                $room_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $row[11] . "'"));  
                                                $arr_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[7] . "'"));
                                                $arr_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM bgi_vehicles WHERE id_vehicle='" . $row[8] ."'"));
                                                $arr_flightclass = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[5] . "'"));
                                                $arr_reptype = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $row[12] . "'"));
                                                

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $arr_date = $row[2];
                                                $client_reqs = $row[13];
                                                $rooms = $row[22];
                                                $room_no = $row[23];
                                                $arr_transnotes = $row[14];
                                                $hotel_notes = $row[15];
                                                $arr_transport =  $row[6];
                                                $arrFastTrack = empty($row['fast_track'])?'N':'Y';

                                                $excusrion_name = $row[27];
                                                $excursion_date = $row[28];
                                                $excursion_pickup = $row[29];
                                                $excursion_confirm_by = $row[30];
                                                $excursion_confirm_date = $row[31];
                                                $excursion_guests = $row[32];
                                                
                                                if ($row[24] == 1){
                                                    $arrmain = '*';
                                                    $arrmain_edit = 'Edit main arrival';
                                                    $arrmain_nodel = 'hidden';
                                                } else {
                                                    $arrmain = '';
                                                    $arrmain_edit = 'Edit arrival';
                                                    $arrmain_nodel = '';
                                                }
                                                
                                                echo '<tr>
                                                        <td><a href="arrival-details.php?arrival_id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '&sect='.$section.'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . $arrmain_edit .'"></i></a> <span ' . $arrmain_nodel . '>| <a href="arrival-delete.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete arrival"></i></a></span></td>
                                                        <td>' . $arrmain .' ' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $arr_flightclass[1] . '</td>
                                                        <td>' . $arr_reptype[1] . '</td>
                                                        <td>' . $arr_transport . '</td>
                                                        <td>' . $arrFastTrack . '</td>
                                                        <td>' . $arr_driver[1] . '</td>
                                                        <td>' . $arr_vehicle[2] . '</td>
                                                        <td>' . $arr_pickup[1] . '</td>
                                                        <td>' . $arr_dropoff[1] . '</td>
                                                        <td>' . $room_type[2] . '</td>
                                                        <td>' . $room_no . '</td>
                                                        <td>' . $rooms . '</td>
                                                        <td>' . $arr_transnotes . '</td>
                                                        <td>' . $hotel_notes . '</td>  
                                                        <td>' . $excusrion_name . '</td>  
                                                        <td>' . $excursion_date . '</td> 
                                                        <td>' . $excursion_pickup . '</td>   
                                                        <td>' . $excursion_confirm_by . '</td>  
                                                        <td>' . $excursion_confirm_date . '</td>  
                                                        <td>' . $excursion_guests . '</td>                                                       
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                  
                                </div>
                                </div>
                                <hr />
                                <!-- end arrival details -->

                                <!-- hotel details -->
                                <h5>Reservation has <?php echo $adHotelsCount; ?> Hotel(s)</h5>
                                <div class="panel panel-default">
                                <?php if($adHotelsCount < 5) { ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title"><a href="additional-hotel.php?ref=<?=$reservation[40]?>&reservation=<?php echo $reservation[0]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Arrival"></i> Add Hotel</a></h3>  
                                </div>
                                <?php } ?>
                                <div class="panel-body table-responsive">
                                    <table id="arrival-listing" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Hotel Name</th>
                                                <th>Hotel Check In Date</th>
                                                <th>Number of Rooms</th>
                                                <th>Room Type</th>
                                                <th>Room Number</th>
                                                <th>Last Name On Room</th>
                                                <th>Hotel Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($adHotels)) {
                                                // get hotel by id
                                                $loc = '';
                                                if(isset($row['loc_id'])){
                                                     $loc = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row['loc_id'] . "'"));
                                                     if(isset($loc[1])) $loc = $loc[1];
                                                }
                                                $room_type = '';
                                                if(isset($row['room_type'])){
                                                    $room_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $row['room_type'] . "'"));
                                                    if(isset($room_type[2])) $room_type = $room_type[2];
                                                }
                                                $checkInDate = $row['hotel_checkin'];
                                                if($checkInDate == '0000-00-00'){
                                                    $checkInDate = "";
                                                }
                                                echo '<tr>
                                                        <td><a href="additional-hotel-detail.php?reservation='.$reservation[0].'&ref='. $reservation[40].'&ad_hotel_id='.$row[0].'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Hotel"></i></a> | <a href="#" data-id="'.$row[0].'" class="delete-hotel"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete Hotel"></i></a></td> 
                                                            <td>'.$loc.'</td> 
                                                            <td>'.$checkInDate.'</td> 
                                                            <td>'.$row['no_of_rooms'].'</td>   
                                                            <td>'.$room_type.'</td>  
                                                            <td>'.$row['room_no'].'</td>  
                                                            <td>'.$row['room_lname'].'</td>       
                                                            <td>'.$row['hotel_notes'].'</td>                    
                                                        </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                  
                                </div>
                                </div>
                                <hr />
                                <!-- end hotel details -->

                                <!-- transfer details -->
                                <h5>Inter-Hotel Transfer has <?php echo $transfer_count; ?> transfer(s)</h5>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><a href="add-transfer.php?reservation=<?php echo $reservation[0]; ?>&ref=<?php echo $reservation[40]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Tranfster"></i> Add Inter-Hotel transfer</a></h3>    
                                    </div>
                                    <div class="panel-body table-responsive">
                                        <table id="transfer-listing" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Pickup</th>
                                                    <th>PU Date</th>
                                                    <th>PU Time</th>
                                                    <th>Dropoff</th>
                                                    <th>Transport</th>
                                                    <th>Transport Supplier</th>
                                                    <th>Vehicle</th>
                                                    <th>Transfer notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                while($row = mysql_fetch_array($transferrows)) {
                                                    
                                                    
                                                    $transfer_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[2] . "'"));  
                                                    $transfer_dropoff = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[5] . "'"));  
                                                    $transfer_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM bgi_vehicles WHERE id_vehicle='" . $row[7] ."'"));
                                                    $transfer_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[8] . "'"));
                                                    

                                                    //assign names to results that are readable
                                                    $id = $row[0];
                                                    $transfer_date = $row[3];
                                                    $transfer_time = $row[4];
                                                    $transfer_notes = $row[9];
                                                    $transfer_transport =  $row[6];
                                                    
                                                    echo '<tr>
                                                            <td><a href="transfer-details.php?transfer_id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Transfer"></i></a> | <a href="transfer-delete.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete transfer"></i></a></td>
                                                            <td>' . $transfer_pickup[1] . '</td>
                                                            <td>' . $transfer_date . '</td>
                                                            <td>' . $transfer_time . '</td>
                                                            <td>' . $transfer_dropoff[1] . '</td>
                                                            <td>' . $transfer_transport . '</td>
                                                            <td>' . $transfer_driver[1] . '</td>
                                                            <td>' . $transfer_vehicle[2] . '</td>
                                                            <td>' . $transfer_notes . '</td>                                                       
                                                    </tr>';
                                                }
                                            ?>
                                            </tbody>
                                        </table>                                  
                                    </div>
                                </div>
                                <hr />
                                <!-- transfer details -->
                                <h5>Concierge Transfer has <?php echo $concerige_transfer_count; ?> transfer(s)</h5>
                                <div class="panel panel-default">
                                <?php if($concerige_transfer_count < 6) { ?>
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><a href="add-concierge-transfer.php?reservation=<?php echo $reservation[0]; ?>&ref=<?php echo $reservation[40]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Tranfster"></i> Add Concierge Transfer</a></h3>    
                                    </div>
                                <?php } ?>
                                    <div class="panel-body table-responsive">
                                        <table id="concierge-transfer-listing" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Pickup</th>
                                                    <th>PU Date</th>
                                                    <th>PU Time</th>
                                                    <th>Dropoff</th>
                                                    <th>Transport</th>
                                                    <th>Transport Supplier</th>
                                                    <th>Vehicle</th>
                                                    <th>Concierge Notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                while($row = mysql_fetch_array($concerigeTransfer)) {
                                                    
                                                    
                                                    $concerige_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[2] . "'"));  
                                                    $concerige_dropoff = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[5] . "'"));  
                                                    $concerige_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM bgi_vehicles WHERE id_vehicle='" . $row[7] ."'"));
                                                    $concerige_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[8] . "'"));
                                                    

                                                    //assign names to results that are readable
                                                    $id = $row[0];
                                                    $concerige_date = $row[3];
                                                    $concerige_time = $row[4];
                                                    $concerige_notes = $row[9];
                                                    $concerige_transport =  $row[6];
                                                    
                                                    echo '<tr>
                                                            <td><a href="concierge-transfer-details.php?transfer_id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Concierge Transfer"></i></a> | <a href="concierge-transfer-delete.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete transfer"></i></a></td>
                                                            <td>' . $concerige_pickup[1] . '</td>
                                                            <td>' . $concerige_date . '</td>
                                                            <td>' . $concerige_time . '</td>
                                                            <td>' . $concerige_dropoff[1] . '</td>
                                                            <td>' . $concerige_transport . '</td>
                                                            <td>' . $concerige_driver[1] . '</td>
                                                            <td>' . $concerige_vehicle[2] . '</td>
                                                            <td>' . $concerige_notes . '</td>                                                       
                                                    </tr>';
                                                }
                                            ?>
                                            </tbody>
                                        </table>                                  
                                    </div>
                                </div>
                                <hr />
                                <!-- end transfer details -->
                                <!-- departure details -->
                                <h5>Reservation has <?php echo $departure_count; ?> departure(s)</h5>
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><a href="add-departure.php?reservation=<?php echo $reservation[0]; ?>&ref=<?php echo $reservation[40]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Departure"></i> Add Departure</a></h3>    
                                </div>
                                <div class="panel-body table-responsive">
                                    <table id="departure-listing" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Departure Date</th>
                                                <th>Flight #</th>
                                                <th>Flight time</th>
                                                <th>Flight class</th>
                                                <th>Transport</th>
                                                <th>FSFT</th>
                                                <th>Transport Supplier</th>
                                                <th>Vehicle</th>
                                                <th>PU Location</th>
                                                <th>PU Time</th>
                                                <th>Dropoff Location</th>
                                                <th>Dpt & Trans notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($departurerows)) {
                                               // echo '<pre>'; print_r($row); echo '</pre>'; exit;
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[4] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[3] . "'"));
                                                $dpt_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[9] . "'"));  
                                                $dpt_dropoff = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[10] . "'"));  
                                                $dpt_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[7] . "'"));
                                                $dpt_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM bgi_vehicles WHERE id_vehicle='" . $row[8] ."'"));
                                                $dpt_flightclass = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[5] . "'"));

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $dpt_date = $row[2];
                                                $pickup_time = $row[11];
                                                $dpt_transnotes = $row[13];
                                                $dpt_transport =  $row[6];

                                                if($row[16]==1) 
                                                    $fsft = 'Y';
                                                else $fsft = 'N';
                                                if ($row[14] == 1){
                                                    $dptmain = '*';
                                                    $dptmain_edit = 'Edit main departure';
                                                    $dptmain_nodel = 'hidden';
                                                } else {
                                                    $dptmain = '';
                                                    $dptmain_edit = 'Edit departure';
                                                    $dptmain_nodel = '';
                                                }
                                                
                                                echo '<tr>
                                                        <td><a href="departure-details.php?departure_id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '&sect='.$section.'"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="' . $dptmain_edit . '"></i></a> <span ' . $dptmain_nodel .'>| <a href="departure-delete.php?id=' . $id . '&reservation=' . $reservation[0] . '&ref=' . $reservation[40] . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete departure"></i></a></span></td>
                                                        <td>' . $dptmain .' ' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_time[2] . '</td>
                                                        <td>' . $dpt_flightclass[1] . '</td>
                                                        <td>' . $dpt_transport . '</td>
                                                        <td>' . $fsft . '</td>
                                                        <td>' . $dpt_driver[1] . '</td>
                                                        <td>' . $dpt_vehicle[2] . '</td>
                                                        <td>' . $dpt_pickup[1] . '</td>
                                                        <td>' . $pickup_time . '</td>
                                                        <td>' . $dpt_dropoff[1] . '</td>
                                                        <td>' . $dpt_transnotes . '</td>                                                       
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                  
                                </div>
                                </div>
                                <hr />
                                <!-- end departure details -->
                                <div class="form-group"><!-- departure notes -->
                                        <div class="col-xs-7">                                            
                                            <textarea class="form-control text-lowercase" rows="5" id="dpt-notes" name="dpt_notes" placeholder="Accounting notes: additional accounting comments and details here"><?php echo $reservation[35]; ?></textarea>
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
                                    <input type="hidden" name="update" />
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

         $(document).on('click','.delete-hotel', function(e){
            e.preventDefault();
            var ref = $(this);
            var $id = $(this).attr('data-id');
            if($id != ''){
                $.ajax({
                    url:"concierge-transfer-delete.php?reservation=<?=$reservation[0]?>&ref=<?=$reservation[40]?>&logger=<?=$loggedinas?>",
                    type:"POST",
                    data:{action:'delete_hotel',id:$id},
                    success:function(data){
                        if(data == 'ok') {
                            ref.parents('tr').remove();
                            alert('Additional Hotel Successfully Removed');
                        }
                    }
                });
            }
         })

        $(document).on('focusout', '#tour-ref-no', function(e){
            var ref = $(this);
            var ref_no = ref.val();
            var old_ref_no = $('.ref_no_check').attr('data-old-ref');
            if(ref_no != "" && ref_no != old_ref_no){
                $.ajax({
                    url: "<?=$url?>/custom_updates/check_field_exist.php",
                    type:"POST",
                    data:{ref_no:ref_no},
                    success:function(output){
                        output = JSON.parse(output);
                        ref.parents('.form-group').find('.ref_no_check').html(output["message"]).attr('data-id', output["exist"]);
                    }
                });
            }
        })

        $(document).on('click','#update', function(e){
            e.preventDefault();
            if($('#first-name').val() != '' && $('#last-name').val() != '' && $('.ref_no_check').attr('data-id') == 0){
                $('#update-reservation').submit(); 
            } else {
                $('html, body').animate({
                    scrollTop: $("#first_name").offset().top
                }, 2000);
            }
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
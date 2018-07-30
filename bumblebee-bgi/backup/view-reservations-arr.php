<?php
error_reporting(0);
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
  if (!$user->levelCheck("2,9,1,10"))
      redirect_to("index.php");
      
  if ($row->userlevel == 2){
        $group = '2';
    } elseif ($row->userlevel == 3){
        $group = '3';
    }
      
  $row = $user->getUserData();
/*echo "<pre>";
print_r($row);
echo "</pre>";*/

?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');

//Grab all reservation info
$reservationQuery = "SELECT * FROM bgi_reservations WHERE ( fast_track = 0 OR ftnotify = 1) AND status = 1";
if(isset($_POST['fromDate'])){
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    if(validateDate($fromDate) and validateDate($toDate)){
        $reservationQuery .= " AND (arr_date BETWEEN '".$fromDate."' AND '".$toDate."')";
        $dateRangeText = date('F d, Y',strtotime($fromDate)). ' - ' .date('F d, Y',strtotime($toDate));
    }

}

//echo  $reservationQuery;

$reservations = mysql_query($reservationQuery);
if(mysql_errno()){
    echo mysql_error();
}
// echo "<pre>";
// print_r(mysql_fetch_array($reservations));
// echo "</pre>";

site_header('Reservation List - Arrivals');

?>
<style type="text/css">
    .repNotes, .arrNotes, .accNotes, .hotelNotes{
        -ms-word-wrap:break-word;
        word-wrap:break-word;
        max-width: 400px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        cursor: pointer;
    }

</style>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        $.datepicker.regional[""].dateFormat = 'yyyy-mm-dd';
        $.datepicker.setDefaults($.datepicker.regional['']);
	       } );
        new FixedHeader( document.getElementById('res-arrivals') );

/* Add a click handler to the rows */
	$("#res-arrivals tbody tr").on('click',function(event) {
		$("#res-arrivals tbody tr").removeClass('row_selected');
		$(this).addClass('row_selected');
	});

</script>

<style type="text/css">
    ul.panel-controls > li{
        display: block;
        overflow: hidden;
        float: none;
    }
</style>

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
                    <li class="active"><a href="view-reservations-arr.php">View Reservations - Arrivals</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Reservations - Arrivals</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h3>Arrivals Schedules | <?php echo date("Y-m-d H:i"); ?></h3>
                                        
                            <form name="reportselect">
                            <select name="menu" onChange="window.document.location.href=this.options[this.selectedIndex].value;" value="GO" class="form-control">
                                <option selected="selected">Arrivals</option>
                                <option value="view-reservations.php">Arrivals &amp; Departures</option>
                                <option value="view-reservations-dpt.php">Departures</option>
                                <option value="view-flight-arr.php">Arrival Flight</option>
                                
                            </select>
                            </form>

                                    </div>                                     
                                    <!-- Date picker -->
                                    <ul class="panel-controls panel-controls-title">                                        
                                        <li>
                                            <label for="reportrange" style="display: block;">Arrival Date Filter</label>
                                            <div id="reportrange" class="dtrange">
                                                <span></span><b class="caret"></b>
                                            </div>                                     
                                        </li>
                                        <li>
                                            <button class="btn btn-success" style="align-self: center; margin-top: 10px; margin-left: auto; margin-right: auto; float: right;" id="exportBtn">Export Excel</button>
                                        </li>
                                    </ul>                                    
                                    
                                </div>
                               
                                <div class="panel-body table-responsive">
                                    <table id="res-arrivals" class="table table-hover display">
                                        <?php if ($user->levelCheck("2,9,10")) : ?>
                                        <thead>
                                            <tr>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Confirmation Number</th>
                                                <th>T/O</th>
                                                <th>Operator Code</th>
                                                <th>Ref #</th>
                                                <th>Adult</th>
                                                <th>Child</th>
                                                <th>Infant</th>
                                                <th>Rep</th>
                                                <th>Rep Service</th>
                                                <th>Pickup Location</th>
                                                <th>Hotel</th>
                                                <th>Room Type</th>
                                                <th>Room No</th>
                                                <th>No of Rooms</th>
                                                <th>Hotel Notes</th>
                                                <th>Trans Type</th>
                                                <th>FSFT</th>
                                                <th>Inf Seat</th>
                                                <th>Car Seat</th>
                                                <th>Boost Seat</th>
                                                <th>Arr Reqs</th>
                                                <th>Vouchers</th>
                                                <th>Additional Reqs</th>
                                                <th>A</th>
                                                <th>C</th>
                                                <th>I</th>
                                                <th>Arr Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arr Time</th>
                                                <th>Luggage Vehicle</th>
                                                <th>Class</th>
                                                <th>Dpt Date</th>
                                                <th>Dpt Flight #</th>
                                                <th>Dpt Transport Mode</th>
                                                <th>Dpt Transport Supplier</th>
                                                <th>Dpt Vehicle</th>
                                                <th>Dpt Pickup Location</th>
                                                <th>Dpt Pickup Time</th>
                                                <th>Dpt Dropoff Location</th>
                                                <th>Arr &amp; Trans Notes</th>
                                                <th>Rep Notes</th>
                                                <th>Acct Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            while($row = mysql_fetch_array($reservations)) {
                                              
                                                 $data[] = $row;
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                $rep_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $row[24] . "'"));
                                                $flight_class = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[17] . "'"));
                                                $rep_name = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reps WHERE id_rep='" . $row[42] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[22] . "'"));
                                                $room_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $row[23] . "'"));
                                                $dpt_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[30] . "'"));
                                                $dpt_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM skb_vehicles WHERE id_vehicle ='" . $row[31] . "'"));
                                                $dpt_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location ='" . $row[32] . "'"));

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $operator_code = $row[6];
                                                $ref_no = $row[7];
                                                $adult = $row[8];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $arr_date = $row[14];
                                                $transport_type = $row[18];
                                                $infant_seat = $row[48];
                                                $car_seat = $row[49];
                                                $booster_seat = $row[50];
                                                $cold_towel = $row[53];
                                                $bottled_water = $row[54];
                                                $client_reqs = $row[25];
                                                $adult = $row[8];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $dpt_date = $row[26];
                                                $arr_notes = $row[44];
                                                $rep_notes = $row[11];
                                                $acc_notes = $row[35];
//                                                $roomType = $row[23];
                                                $room_no = $row[57];
                                                $rooms = $row[56];
                                                $arr_hotel_notes = $row[46];
                                                $dpt_transport = $row[29];
                                                $dpt_pickup_time = $row[34];
                                                $vouchers = $row[51];
                                                $conf_num = $row[40];
                                                
                                                if ($row[53]>0){
                                                        $ct= ''. $cold_towel . 'CT(s)';
                                                    } else {
                                                        $ct='No CT';
                                                    
                                                    }
                                                    
                                                if ($row[54]>0){
                                                        $bw= ''. $bottled_water . 'BW';
                                                    } else {
                                                        $bw='No BW';
                                                    
                                                    }
                                                
                                                if ($row[12]>0){
                                                        $fsft='Y';
                                                    } else {
                                                        $fsft='N';                                                    
                                                    }
                                                
                                                if ($group == 3){
                                                        $ftlink='ft';
                                                    } else {
                                                        $ftlink='';
                                                    
                                                    }
                                                
                                                if ($row[42]>0){
                                                        $rep = $rep_name[1];
                                                    } else {
                                                        $rep='Not Assigned';
                                                    
                                                    }


                                                if($row[21] === '56'){
                                                    $arr_pickup = 'Airport';
                                                }elseif($row[21] === '57'){
                                                    $arr_pickup = 'Seaport';
                                                }else{
                                                    $arr_pickup = '';
                                                }

                                                if($row[33] === '56'){
                                                    $dpt_drop_off = 'Airport';
                                                }elseif($row[33] === '57'){
                                                    $dpt_drop_off = 'Seaport';
                                                }else{
                                                    $dpt_drop_off = $row[33];
                                                }
                                                
                                                echo '<tr>
                                                        <td><a href="'. $ftlink .'reservation-details.php?id=' . $id . '&sect=gh"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="View / Edit reservation"></i></a></td>
                                                        <td>' . $title_name . '</td>
                                                        <td>' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $conf_num . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $operator_code . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $adult . '</td>
                                                        <td>' . $child . '</td>
                                                        <td>' . $infant . '</td>
                                                        <td>' . $rep . '</td>
                                                        <td>' . $rep_type[1] . '</td>
                                                        <td>' . $arr_pickup . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td>' . $room_type[2] . '</td>
                                                        <td>' . $room_no . '</td>
                                                        <td>' . $rooms . '</td>
                                                        <td class="hotelNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">'  . $arr_hotel_notes . '</td>
                                                        <td>' . $transport_type . '</td>
                                                        <td>' . $fsft . '</td>
                                                        <td>' . $infant_seat . '</td>
                                                        <td>' . $car_seat . '</td>
                                                        <td>' . $booster_seat . '</td>
                                                        <td>' . $bw . '/' . $ct . '</td>
                                                        <td>' . $vouchers . '</td>
                                                        <td>' . $client_reqs . '</td>
                                                        <td>' . $adult . '</td>
                                                        <td>' . $child . '</td>
                                                        <td>' . $infant . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $row['luggage_vehicle'] . '</td>                                                        
                                                        <td>' . $flight_class[1] . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_transport . '</td>
                                                        <td>' . $dpt_driver[1] . '</td>
                                                        <td>' . $dpt_vehicle[2] . '</td>
                                                        <td>' . (!empty($dpt_pickup[1])?$dpt_pickup[1]:$row[32]) . '</td>
                                                        <td>' . $dpt_pickup_time . '</td>
                                                        <td>' . $dpt_drop_off . '</td>
                                                        <td class="arrNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">' . $arr_notes . '</td>
                                                        <td class="repNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">' . $rep_notes . '</td>
                                                        <td class="accNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">' . $acc_notes . '</td>
                                                </tr>';
                                            }/*echo '<pre>';
                                            print_r($data); exit;*/
                                        ?>
                                        </tbody>
                                        <?php else: ?>
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>T/O</th>
                                                <th>Ref #</th>
                                                <th>Rep</th>
                                                <th>Rep Service</th>
                                                <th>Hotel</th>
                                                <th>Trans Type</th>
                                                <th>FSFT</th>
                                                <th>Inf Seat</th>
                                                <th>Car Seat</th>
                                                <th>Boost Seat</th>
                                                <th>Arr Reqs</th>
                                                <th>Additional Reqs</th>
                                                <th>A</th>
                                                <th>C</th>
                                                <th>I</th>
                                                <th>Arr Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arr Time</th>
                                                <th>Class</th>
                                                <th>Dpt Date</th>
                                                <th>Arr &amp; Trans Notes</th>
                                                <th>Rep Notes</th>
                                                <th>Acct Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($reservations)) {
                                                
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));                                                   
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                $rep_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $row[24] . "'"));
                                                $flight_class = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[17] . "'"));
                                                $rep_name = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reps WHERE id_rep='" . $row[42] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[22] . "'"));

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $ref_no = $row[7];
                                                $arr_date = $row[14];
                                                $transport_type = $row[18];
                                                $infant_seat = $row[48];
                                                $car_seat = $row[49];
                                                $booster_seat = $row[50];
                                                $cold_towel = $row[53];
                                                $bottled_water = $row[54];
                                                $client_reqs = $row[25];
                                                $adult = $row[8];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $dpt_date = $row[26];
                                                $arr_notes = $row[44];
                                                $rep_notes = $row[11];
                                                $acc_notes = $row[35];
                                                
                                                if ($row[53]>0){
                                                        $ct= ''. $cold_towel . 'CT(s)';
                                                    } else {
                                                        $ct='No CT';
                                                    
                                                    }
                                                    
                                                if ($row[54]>0){
                                                        $bw= ''. $bottled_water . 'BW';
                                                    } else {
                                                        $bw='No BW';
                                                    
                                                    }
                                                
                                                if ($row[12]>0){
                                                        $fsft='Y';
                                                    } else {
                                                        $fsft='N';
                                                    
                                                    }
                                                
                                                if ($row[42]>0){
                                                        $rep = $rep_name[1];
                                                    } else {
                                                        $rep='Not Assigned';
                                                    
                                                    }
                                                
                                                echo '<tr>
                                                        <td>' . $title_name . '</td>
                                                        <td>' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $rep . '</td>
                                                        <td>' . $rep_type[1] . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td>' . $transport_type . '</td>
                                                        <td>' . $fsft . '</td>
                                                        <td>' . $infant_seat . '</td>
                                                        <td>' . $car_seat . '</td>
                                                        <td>' . $booster_seat . '</td>
                                                        <td>' . $bw . '/' . $ct . '</td>
                                                        <td>' . $client_reqs . '</td>
                                                        <td>' . $adult . '</td>
                                                        <td>' . $child . '</td>
                                                        <td>' . $infant . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $flight_class[1] . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $arr_notes . '</td>
                                                        <td>' . $rep_notes . '</td>
                                                        <td>' . $acc_notes . '</td>
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                        <?php endif; ?>
                                    </table>                                    
                                    
                                </div>
                            </div>
                            <!-- END DATATABLE EXPORT -->
                        </div>
                    </div>

                </div>         
                <!-- END PAGE CONTENT WRAPPER -->
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->    

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->        
        
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

<div class="modal fade" id="repNotesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="arrNotesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="accNotesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hotelNotesModal" tabindex="-1" role="dialog" aria-labelledby="hotelNotes" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="hotelNotes">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!--                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
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
        
        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="css/buttons.dataTables.min.css" type="text/css">
<script type="text/javascript" src="js/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/buttons.flash.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

        <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/base64.js"></script>
        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>        
        <!-- END THIS PAGE PLUGINS-->  
        
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/jquery.dataTables.columnFilter.js"></script>      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
<!--        <script type="text/javascript" src="js/demo_dashboard.js"></script>       -->
        <script type="text/javascript" src="js/jquery.redirect.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
<script type="text/javascript">
    $(function(){
       $("#exportBtn").on("click",function(){
//            location.href = "custom_updates/export_excel.php";
            location.href = "custom_updates/export_reservations_excel.php";
       });


        //Code for DatePicker Submit
        $("body").on("click",".range_inputs > button.applyBtn",function(e){
            console.log("im working");
            var fromDate = $(this).parents(".range_inputs").find("div.daterangepicker_start_input > input#max").val();
            var toDate = $(this).parents(".range_inputs").find("div.daterangepicker_end_input > input#min").val();
            var postFilterData = {
                fromDate:fromDate,
                toDate:toDate
            };
            var postURL = window.location.href;
            $.redirect(postURL,postFilterData,'POST','_SELF');
        });

        
        //Rep Notes
        $(".repNotes").on("click",function(){
            var m = $("#repNotesModal");
            var modalLabel = m.find("#myModalLabel");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Rep Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });

        //Arr Notes
        $(".arrNotes").on("click",function(){
            var m = $("#arrNotesModal");
            var modalLabel = m.find("#myModalLabel");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Arrival and Transport Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });

        //Arr Notes
        $(".accNotes").on("click",function(){
            var m = $("#accNotesModal");
            var modalLabel = m.find("#myModalLabel");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Acct/Dpt Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });

        //Hotel Notes
        $(".hotelNotes").on("click",function(){
            var m = $("#hotelNotesModal");
            var modalLabel = m.find("#hotelNotes");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Hotel Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });


        //datatables
        $('#res-arrivals').DataTable( {
            "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
            "dom": 'T<"clear">lBfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Export current page',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'excel',
                    text: 'Export all pages',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    }
                }
            ]
        });

    });
    $(function(){

        /* reportrange */
        if($("#reportrange").length > 0){
            $("#reportrange").daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    //'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    //'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    //'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    //'This Month': [moment().startOf('month'), moment().endOf('month')],
                    //'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'YYYY-MM-DD',
                separator: ' to ',
                startDate: moment().subtract('days', 29),
                endDate: moment()
            },function(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            <?php

            if(isset($dateRangeText) and !empty($dateRangeText)){
                echo "$(\"#reportrange span\").html('".$dateRangeText."');";
                echo "console.log('".$dateRangeText."')";
            }else{
                echo "$(\"#reportrange span\").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));";
            }
            ?>
        }

        /* end reportrange */

    });
</script>
    </body>
</html>
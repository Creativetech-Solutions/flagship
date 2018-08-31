<?php
  error_reporting(0);
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
  if (!$user->levelCheck("2,9,1"))
      redirect_to("index.php");
  
  if ($row->userlevel == 2){
        $group = '2';
    } elseif ($row->userlevel == 3){
        $group = '3';
    }
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');
site_header('Reservation List - Arrivals');

//Grab all reservation info
$reservationQuery = "SELECT * FROM bgi_reservations  WHERE ( fast_track = 0 OR ftnotify = 1) AND status != 2";
if(isset($_POST['fromDate'])){
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    if(validateDate($fromDate) and validateDate($toDate)){
        $reservationQuery .= " AND (dpt_date BETWEEN '".$fromDate."' AND '".$toDate."')";
        $dateRangeText = date('F d, Y',strtotime($fromDate)). ' - ' .date('F d, Y',strtotime($toDate));
    }

}

$reservations = mysql_query($reservationQuery);
if(mysql_errno()){
    echo mysql_error();
}


?>
<style type="text/css">
    ul.panel-controls > li{
        display: block;
        overflow: hidden;
        float: none;
    }
    .hide_ele{display:none;}
</style>


                    <?php include ('profile.php'); ?>
                   <?php include ('navigation.php'); ?>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <div class="modal-body col-md-12">
                <div class="col-md-12">
                    <label class="hide_ele">Select Transport Supplier</label>
                    <select id="select_data" class="select2 form-control select_data" style="width:95%">
                    </select>
                </div>
                <div class="col-md-12"><br>
                    <label class="hide_ele">Select Vehicles</label>
                    <select id="select_vehicle" class="form-control hide_ele" style="width:95%">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button data-id="" action="" type="button" class="btn btn-primary save-change">Save changes</button>
            </div>
        </div>
    </div>
</div>

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <?php include ('vert-navigation.php'); ?>
                <!-- START BREADCRUMB -->
                <!--<ul class="breadcrumb">
                    <li><a href="dashboard.php">Home</a></li>
                    <li>Reservations</li>
                    <li class="active"><a href="view-reservations-dpt.php">View Reservations - Departures</a></li>
                </ul>-->
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Reservations - Departures</h2>
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
                                        <h3>Departure Schedules | <?php echo date("Y-m-d H:i"); ?></h3>
                            <form name="reportselect">
                            <select name="menu" onChange="window.document.location.href=this.options[this.selectedIndex].value;" value="GO" class="form-control">
                                <option selected="selected">Departures</option>
                                <option value="view-reservations.php">Arrivals &amp; Departures</option>
                                <option value="view-reservations-arr_new.php">Arrivals</option>-reservations-dpt.php">Departures</option>
                                <option value="view-flight-arr.php">Arrival Flight</option>
                            </select>
                            </form>
                                    </div>                                     
                                    <!-- Date picker -->
                                    <ul class="panel-controls panel-controls-title">                                        
                                        <li>
                                            <label for="reportrange" style="display: block;">Departures Date Filter</label>
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
                                        <?php if ($user->levelCheck("2,9")) : ?>
                                        <thead>
                                            <tr>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Confirmation Number</th>
                                                <th>T/O</th>
                                                <th>Ref #</th>
                                                <th>Rep</th>
                                                <th>Rep Service</th>
                                                <th>Hotel</th>
                                                <th>Transport Mode</th>
                                                <th>Transport Supplier</th>
                                                <th>Vehicle</th>
                                                <th>Pickup Time</th>
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
                                                <th>Class</th>
                                                <th>PU Time</th>
                                                <th>Dropoff</th>
                                                <th>Dpt Date</th>
                                                <th>Dpt Flight#</th>
                                                <th>Dpt Time</th>
                                                <th>Dpt &amp; Trans Notes</th>
                                                <th>Rep Notes</th>
                                                <th>Acct Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($reservations)) {
                                                //echo '<pre>'; print_r($row); exit;
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[27] . "'"));                                                   
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                $rep_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $row[24] . "'"));
                                                $flight_class = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[55] . "'"));
                                                $rep_name = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reps WHERE id_rep='" . $row[42] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[22] . "'"));
                                                $dpt_dropoff = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[33] . "'"));

                                                $transport_mode = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transporttype WHERE id='" . $row[29] . "'"));

                                                $driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[30] . "'"));

                                                $vehicle = mysql_fetch_row(mysql_query("SELECT * FROM skb_vehicles WHERE id_vehicle='" . $row[31] . "'"));

                                                if(isset($transport_mode[0])){
                                                    $trans_mode = $transport_mode[1];
                                                    $trans_mode_id = $transport_mode[0];
                                                } else {
                                                    $trans_mode = '';
                                                    $trans_mode_id = 0;
                                                }

                                                if(isset($driver[0])){
                                                    $trans_dr = $driver[1];
                                                    $trans_dr_id = $driver[0];
                                                } else {
                                                    $trans_dr = '';
                                                    $trans_dr_id = 0;
                                                }

                                                if(isset($vehicle[0])){
                                                    $trans_vcl = $vehicle[2];
                                                    $trans_vcl_id = $vehicle[0];
                                                } else {
                                                    $trans_vcl = '';
                                                    $trans_vcl_id = 0;
                                                }


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
                                                $dpt_notes = $row[45];
                                                $rep_notes = $row[11];
                                                $acc_notes = $row[35];
                                                $putime = $row[34];
                                                $conf_num = $row[40];
                                               
                                              /*  $transport_mode = $row[29];
                                                $driver = $row[30];
                                                $vehicle = $row[31];*/
                                                $pickup = $row[34];

                                                
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
                                                
                                                echo '<tr data-id="'.$id.'">
                                                        <td><a href="reservation-details.php?id=' . $id . '"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View / Edit reservation"></i></a></td>
                                                        <td>' . $title_name . '</td>
                                                        <td>' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $conf_num . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $rep . '</td>
                                                        <td>' . $rep_type[1] . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td class="transport_mode" data-id="'.$trans_mode_id.'"><em data-toggle="tooltip" data-placement="top" title="Edit \'Transport Mode\'" style="width:10%;float:right;z-index: 1;position: relative;" data-placement="right"><i style="color:#1e4394; cursor:pointer" class="fa fa-pencil" data-target="#myModal" data-toggle="modal"></i></em><span>' . $trans_mode . '</span></td>
                                                        <td class="driver" data-id="'.$trans_dr_id.'"><em data-toggle="tooltip" data-placement="top" title="Edit \'Transport Driver\'" style="width:10%;float:right;z-index: 1;position: relative;" data-placement="right"><i style="color:#1e4394; cursor:pointer" class="fa fa-pencil" data-target="#myModal" data-toggle="modal"></i></em><span>' . $trans_dr . '</span></td>
                                                        <td class="vehicle" data-id="'.$trans_vcl_id.'"><em data-toggle="tooltip" data-placement="top" title="Edit \'Vehicle\'" style="width:10%;float:right;z-index: 1;position: relative;" data-placement="right"><i style="color:#1e4394; cursor:pointer" class="fa fa-pencil" data-target="#myModal" data-toggle="modal"></i></em><span>' . $trans_vcl . '</span></td>
                                                        <td class="pickup_time" data-id="'.$pickup.'"><em data-toggle="tooltip" data-placement="top" title="Edit \'Pickup Time\'" style="width:10%;float:right;z-index: 1;position: relative;" data-placement="right"><i style="color:#1e4394; cursor:pointer" class="fa fa-pencil" data-target="#myModal" data-toggle="modal"></i></em><span>' . $pickup . '</span></td>
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
                                                        <td>' . $flight_class[1] . '</td>
                                                        <td>' . $putime . '</td>
                                                        <td>' . $dpt_dropoff[1] . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_time[2] . '</td>
                                                        <td>' . $dpt_notes . '</td>
                                                        <td>' . $rep_notes . '</td>
                                                        <td>' . $acc_notes . '</td>
                                                </tr>';
                                            }
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
                                                <th>Class</th>
                                                <th>Dpt Date</th>
                                                <th>Dpt Flight#</th>
                                                <th>Dpt Time</th>
                                                <th>Dpt &amp; Trans Notes</th>
                                                <th>Rep Notes</th>
                                                <th>Acct Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($reservations)) {
                                                
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[27] . "'"));                                                 
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
                                                $dpt_notes = $row[45];
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
                                                        $bw='N0 BW';
                                                    
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
                                                        <td>' . $flight_class[1] . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_time[2] . '</td>
                                                        <td>' . $dpt_notes . '</td>
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
        <script type="text/javascript" src="js/demo_dashboard.js"></script>

<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
<script type="text/javascript" src="js/jquery.redirect.js"></script>
<!--Select2-->
<script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

<script type="text/javascript" language="javascript" class="init">


    $(function(){
        $("#exportBtn").on("click",function(){
            console.log('Hello World');
//            location.href = "custom_updates/export_excel.php";
            location.href = "custom_updates/export_reservations_excel.php";
        });

        //Code for DatePicker SUbmit
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

        //datatables
        $('#res-arrivals').DataTable({
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


    $(document).ready(function() {
     $('.select2').select2({
        });

        $.datepicker.regional[""].dateFormat = 'yyyy-mm-dd';
        $.datepicker.setDefaults($.datepicker.regional['']);
       /* $('#res-arrivals').DataTable( {
            "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
            dom: 'T<"clear">lfrtip',
            "order": [[ 2, "asc" ]],
            scrollY:        200,
            deferRender:    true,
            scroller:       true,
            tableTools: {
                "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "copy",
                    {
                        "sExtends": "pdf",
                        "sButtonText": "Save to PDF",
                        "sPdfOrientation": "landscape",
                        "sPdfMessage": "Departure Schedules"
                    },
                    {
                        "sExtends": "xls",
                        "sButtonText": "Save to Excel"
                    }
                    //"print"
                ]
            }
        });*/

        // on edit modal open
     $('#myModal').on('show.bs.modal', function (e) {
            var parent = $(e.relatedTarget).parents('td');
            var targetClass = parent.attr('class');
            var id = parent.attr('data-id');
            var rId = parent.parents('tr').attr('data-id');
            $('.save-change').attr('action',targetClass);
            $('.save-change').attr('data-id',rId);
            console.log(id);
                var data = {action:targetClass}
                if(targetClass == 'pickup_time'){
                   // $(".select_data").html('<option value="'+id+'">'+id+'</option>');
                   // $(".select_data").val(id).trigger('change');
                    $('#myModalLabel').html('Pickup Time');
                } 
                else if(targetClass == 'driver') {
                    $('#myModalLabel').html('Transport Supplier'); 
                    var vehicleId = $('tbody').find('tr[data-id="'+rId+'"]').find('.vehicle').attr('data-id');
                    $('.hide_ele').show();
                    $('#select_vehicle').select2();
                }
                else if(targetClass == 'transport_mode') 
                    $('#myModalLabel').html('Transport Mode');

                else if(targetClass == 'vehicle') {
                    $('#myModalLabel').html('Vehicle');
                    $('#select_vehicle').select2();
                    $('.hide_ele').show();
                    var trans_supp_id = $('tbody').find('tr[data-id="'+rId+'"]').find('.driver').attr('data-id');
                    var vehicleId = id;
                    id = trans_supp_id;

                }
                $.ajax({
                    url:"custom_updates/select_data.php",
                    data:data,
                    type:"POST",
                    success:function(data){
                        if(targetClass=='driver' || targetClass=='vehicle'){
                            var data = JSON.parse(data); 
                            $('#select_data').html(data['driver']);
                            $('#select_vehicle').html(data['vehicle']);
                        } else
                            $('#myModal').find('.select_data').html(data);
                            if(targetClass == 'pickup_time'){
                                $("#select_data").append($('<option>', {value: id, text: id}));
                             }
                        if(id!="")
                            $("#select_data").val(id).trigger('change');
                        if(typeof vehicleId!='undefined' && vehicleId!=""){
                            $("#select_vehicle").val(vehicleId).trigger('change');
                        }
                    }
                });
            

            
        });

     // on click on edit modal save changes button 
     $('.save-change').on('click', function(e){
         var action = $(this).attr('action');
         var rId = $(this).attr('data-id');
         var id = $('#select_data').val();
         var text = $('#select_data :selected').text();
         if(action=='pickup_time' && id!=0) id = text;

         var data = {action:action, id:id, rId:rId};
         if(action =='driver' || action =='vehicle'){
             var vehicleId = $('#select_vehicle').val();
             var vehText = $('#select_vehicle :selected').text();
             data['vehicleId'] = vehicleId;
             action = 'driver';
         }
         if(id!=0){
            $.ajax({
                url:"custom_updates/update_data.php",
                data:data,
                type:"POST",
                success:function(data){
                  //  $('#myModal').find('.select_data').html(data);
                  //  $(".select_data").val(id).trigger('change');
                    $('#myModal').modal('toggle');
                    // check action and set value accordingly
                    var invoker = $('tbody').find('tr[data-id="'+rId+'"]').find('td.'+action);
                    invoker.attr('data-id', id);
                    invoker.find('span').html(text);
                    if(typeof vehicleId!='undefined' && vehicleId!=""){
                        var invoker = $('tbody').find('tr[data-id="'+rId+'"]').find('td.vehicle');
                        invoker.attr('data-id', vehicleId);
                        invoker.find('span').html(vehText);
                    }
                }
            });
         }
         
     })


     $('#myModal').on('hidden.bs.modal', function () {
        if($('#select_vehicle').data('select2'))
            $('#select_vehicle').select2("destroy");
        $('.hide_ele').hide();
    })

    } );
    //new FixedHeader( document.getElementById('res-arrivals') );

    /* Add a click handler to the rows */
    $("#res-arrivals tbody tr").on('click',function(event) {
        $("#res-arrivals tbody tr").removeClass('row_selected');
        $(this).addClass('row_selected');
    });

</script>
    </body>
</html>
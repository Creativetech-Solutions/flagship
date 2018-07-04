<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
  if (!$user->levelCheck("2,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');
site_header('Reservation Cancellations List');



//Grab all reservation info
$query = "SELECT * FROM bgi_reservations as res
    left join bgi_arrivals as arr on res.arr_flight_no = arr.id
    left join bgi_departures as dep on res.arr_flight_no = dep.id WHERE res.status=2";


if(isset($_REQUEST['sect']) && $_REQUEST['sect']=='fsft'){
    $query .= ' && res.fast_track = 1';
    $title = 'Fast Track Cancelled Reservations';
}
else {
    $_REQUEST['sect'] = 'gh';
    $query .= ' && (res.fast_track = 0 || res.ftnotify = 1)';
    $title = 'Ground Handling Cancelled Reservations';
}

$reservations = mysql_query($query);


?>
<style>
    .buttons-pdf{background-color:#95b75d!important;background-image: none!important;color:white!important;}
</style>
<link rel="stylesheet" href="css/buttons.dataTables.min.css" type="text/css">
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
                    <li>Reports</li>
                    <li class="active"><a href="view-cancellations.php">View Cancellations</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> <?=$title?></h2>
                     <!-- Date picker -->
                                             
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Arrival & Departure Schedules</h3> 
                                      <ul class="panel-controls panel-controls-title text-right">                       
                                        <li class="pull-right" style="width:100%">
                                            <label for="reportrange" style="display: block;">Created Date Filter</label>
                                            <div id="reportrange" class="dtrange pull-right" >
                                                <span></span><b class="caret"></b>
                                            </div>                                     
                                        </li>              
                                    <a href="dompdf.php?sect=<?=$_REQUEST['sect']?>" class="pull-right btn btn-success export_pdf" style="margin-top: 10px;">Export Pdf</a>   
                                    </ul>  

                                </div>
                                <div class="panel-body table-responsive">
                                    <table id="res-arrivals" class="table table-hover">
                                        <?php if ($user->levelCheck("2,9")) : ?>
                                        <thead>
                                            <tr>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>T/O</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Ref #</th>
                                                <th>Rep</th>
                                                <th>Rep Service(Meet &amp; Greet)</th>
                                                <th>Hotel</th>
                                                <th>Arr Trans Type</th>
                                                <th>Arr Trans Supplier</th>
                                                <th>Arr Vehicle</th>
                                                <th>IS / CS / BS</th>
                                                <th>CT / BW</th>
                                                <th>A / T / C / I</th>
                                                <th>Arr Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arr Time</th>
                                                <th>Excursion Name</th>
                                                <th>Excursion Date</th>
                                                <th>Excursion Pickup Time</th>
                                                <th>Excursion Confirmed By Whom</th>
                                                <th>Excursion Date of Confirmation</th>
                                                <th>Excursion Number of Guests</th>
                                                <th>Arrival &amp; Transportation Notes</th>
                                                <th>Dept Trans</th>
                                                <th>Dept Supplier</th>
                                                <th>Dept Vehicle</th>
                                                <th>Dept Date</th>
                                                <th>Depart Flight#  </th>
                                                <th>Depart Time</th>
                                                <th>Pick Up Location</th>
                                                <th>Pick Up Time</th>
                                                <th>Departure &amp; Transportation Notes</th>
                                                <th>Rep Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $value = 1;
                                        if(isset($_POST['fromDate']) && isset($_POST['toDate'])){
                                            $value = 0;
                                            $fromDate = strtotime($_POST['fromDate']);
                                            $toDate = strtotime($_POST['toDate']);
                                                $dateRangeText = date('M d, Y',$fromDate). ' - ' .date('M d, Y',$toDate);

                                        }
                                        if(isset($reservations) && !empty($reservations)){
                                            while($row = mysql_fetch_array($reservations)) {
                                                if($value==0){
                                                    if(!empty($row['creation_date'])){
                                                        $date = strtotime($row['creation_date']);
                                                        if($date > $fromDate && $date < $toDate){
                                                            $value=1;
                                                        }
                                                    } // end of if
                                                }
                                                if($value==1){

                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));                                                   
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[27] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[27] . "'"));
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                $rep_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $row[24] . "'"));
                                                $flight_class = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[17] . "'"));
                                                $rep_name = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reps WHERE id_rep='" . $row[42] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[22] . "'"));
                                                $arr_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[19] . "'"));
                                                $dep_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[30] . "'"));

                                                $arr_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM skb_vehicles WHERE id_vehicle='" . $row[20] . "'"));
                                                $dep_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM skb_vehicles WHERE id_vehicle='" . $row[31] . "'"));
                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $ref_no = $row[7];
                                                $rep = $row[42];
                                                $arr_transport_type = $row[18];
                                                $arr_supp = $arr_driver[1];
                                                $arr_veh = $arr_vehicle[2];
                                                $infant_seat = $row[48];
                                                $car_seat = $row[49];
                                                $booster_seat = $row[50];
                                                $cold_towel = $row[53];
                                                $bottled_water = $row[54];
                                                $client_reqs = $row[25];
                                                $adult = $row[8];
                                                $teen = $row[70];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $arr_date = $row[14];
                                                $arr_fl_no = $row[16];
                                                $arr_time = $row[15];
                                                $excursion_name = $row[92];
                                                $excursion_date = $row[93];
                                                $excursion_pick_time = $row[94];
                                                $excursion_conf_by_whom = $row[95];
                                                $excursion_dt_conf= $row[96];
                                                $excursion_num_of_guest = $row[97];
                                                $arr_trans_note = $row[44];
                                                $rep_notes = $row[11];

                                                $dpt_transport = $row[29];
                                                $dpt_supp = $dep_driver[1];
                                                $dpt_veh = $dep_vehicle[2];
                                                $dpt_date = $row[26];
                                                $dpt_fl_no = $row[28];
                                                $dpt_time = $row[27];
                                                $dpt_pick_loc = $row[32];
                                                $dpt_pick_time = $row[34];
                                                $dpt_notes = $row[45];
                                                
                                                
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
                                                        $rep = $rep_name;
                                                    } else {
                                                        $rep='Not Assigned';
                                                    
                                                    }
                                                echo '<tr>
                                                        <td><a href="reservation-details.php?id=' . $id . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="View / Edit reservation"></i></a></td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $rep[1] . '</td>
                                                        <td>' . $rep_type[1] . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td>' . $arr_transport_type . '</td>
                                                        <td>' . $arr_supp . '</td>
                                                        <td>' . $arr_veh . '</td>
                                                        <td>' . $infant_seat . ' / ' . $car_seat . ' / ' . $booster_seat . '</td>
                                                        <td>' . $bw . ' / ' . $ct . '</td>
                                                        <td>' . $adult . ' / ' . $teen  . ' / ' . $child . ' / ' . $infant . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_fl_no . '</td>
                                                        <td>' . $arr_time . '</td>
                                                        <td>' . $excursion_name . '</td>
                                                        <td>' . $excursion_date . '</td>
                                                        <td>' . $excursion_pick_time . '</td>
                                                        <td>' . $excursion_conf_by_whom . '</td>
                                                        <td>' . $excursion_dt_conf . '</td>
                                                        <td>' . $excursion_num_of_guest . '</td>
                                                        <td>' . $arr_trans_note . '</td>
                                                        <td>' . $dpt_transport . '</td>
                                                        <td>' . $dpt_supp . '</td>
                                                        <td>' . $dpt_veh . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_fl_no . '</td>
                                                        <td>' . $dpt_time . '</td>
                                                        <td>' . $dpt_pick_loc . '</td>
                                                        <td>' . $dpt_pick_time . '</td>
                                                        <td><span class="dptNotes" data-placement="top" data-toggle="tooltip" data-original-title="Edit \'Click to See All \'" style="display: block;overflow: hidden;text-overflow: ellipsis;width: 400px;word-break: break-all;word-wrap: break-word;cursor:pointer;">' . $dpt_notes . '</span></td>
                                                        <td><span class="repNotes" data-placement="top" data-toggle="tooltip" data-original-title="Edit \'Click to See All \'" style="display: block;overflow: hidden;text-overflow: ellipsis;width: 400px;word-break: break-all;word-wrap: break-word;cursor:pointer;">' . $rep_notes . '</span></td>
                                                </tr>';
                                                }
                                            }
                                        }
                                            
                                        ?>
                                        </tbody>
                                        <?php else: ?>
                                        <thead>
                                            <tr>
                                                <th>T/O</th>
                                                <th>Ref #</th>
                                                <th>Rep</th>
                                                <th>Rep Service</th>
                                                <th>Hotel</th>
                                                <th>Trans Type</th>
                                                <th>FSFT</th>
                                                <th>IS / CS  BS</th>
                                                <th>Arr Reqs</th>
                                                <th>Additional Reqs</th>
                                                <th>A / T / C / I</th>
                                                <th>Arr Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arr Time</th>
                                                <th>Class</th>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Dpt Date</th>
                                                <th>Dpt Flight#</th>
                                                <th>Dpt Time</th>
                                                <th>Arr &amp; Trans Notes</th>
                                                <th>Dpt &amp; Trans Notes</th>
                                                <th>Rep Notes</th>
                                                <th>Acct Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($reservations)) {
                                                
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));                                                   
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[27] . "'"));
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
                                                $teen = $row[70];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $dpt_date = $row[26];
                                                $arr_notes = $row[44];
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
                                                        $bw='No BW';
                                                    
                                                    }
                                                
                                                if ($row[12]>0){
                                                        $fsft='Y';
                                                    } else {
                                                        $fsft='N';
                                                    
                                                    }
                                                
                                                if ($row[42]>0){
                                                        $rep = $rep_name;
                                                    } else {
                                                        $rep='Not Assigned';
                                                    
                                                    }
                                                
                                                echo '<tr>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $rep[1] . '</td>
                                                        <td>' . $rep_type[1] . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td>' . $transport_type . '</td>
                                                        <td>' . $fsft . '</td>
                                                        <td>' . $infant_seat . ' / ' . $car_seat . ' / ' . $booster_seat . '</td>
                                                        <td>' . $bw . '/' . $ct . '</td>
                                                        <td>' . $client_reqs . '</td>
                                                        <td>' . $adult  . ' / ' . $teen . ' / ' . $child . ' / ' . $infant . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $flight_class[1] . '</td>
                                                        <td>' . $title_name . '</td>
                                                        <td>' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_time[2] . '</td>
                                                        <td>' . $arr_notes . '</td>
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

<div class="modal fade" id="repNotes" tabindex="-1" role="dialog" aria-labelledby="repNotesLabel" aria-hidden="true">
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
<div class="modal fade" id="arrNotes" tabindex="-1" role="dialog" aria-labelledby="repNotesLabel" aria-hidden="true">
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
<div class="modal fade" id="dptNotes" tabindex="-1" role="dialog" aria-labelledby="repNotesLabel" aria-hidden="true">
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
<div class="modal fade" id="acctNotes" tabindex="-1" role="dialog" aria-labelledby="repNotesLabel" aria-hidden="true">
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
        <script type="text/javascript" src="js/plugins/datatables/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="js/plugins/datatables/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!--        <script type="text/javascript" src="js/plugins/datatables/dataTables.tableTools.js"></script>-->
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
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>

<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
        <script type="text/javascript" src="js/jquery.redirect.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#res-arrivals').dataTable( {
            "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
            "dom": 'T<"clear">lBfrtip',
            "order": [[ 1, "asc" ]],
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
        } );

        /* Add a click handler to the rows */
        $("#res-arrivals tbody tr").on('click',function(event) {
            $("#res-arrivals tbody tr").removeClass('row_selected');
            $(this).addClass('row_selected');
        });



        //Custom Code Syed Haider Hassan
        $(".repNotes").on("click",function(){
            var m = $("#repNotes");
            var modalLabel = m.find("#myModalLabel");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Rep Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });
        $(".arrNotes").on("click",function(){
            var m = $("#repNotes");
            var modalLabel = m.find("#myModalLabel");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Arr & Trans Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });
        $(".dptNotes").on("click",function(){
            var m = $("#repNotes");
            var modalLabel = m.find("#myModalLabel");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Dpt & Trans Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });
        $(".acctNotes").on("click",function(){
            var m = $("#repNotes");
            var modalLabel = m.find("#myModalLabel");
            var modalBody = m.find(".modal-body");

            modalLabel.text("Acct Notes");
            modalBody.html($(this).html());

            m.modal('show');
        });
        //End of Custom Code Syed Haider Hassan
      
        //Code for DatePicker Submit
        $("body").on("click",".range_inputs > button.applyBtn",function(e){
            var fromDate = $(this).parents(".range_inputs").find("div.daterangepicker_start_input > input#max").val();
            var toDate = $(this).parents(".range_inputs").find("div.daterangepicker_end_input > input#min").val();
            var postFilterData = {
                fromDate:fromDate,
                toDate:toDate,
            };
            var postURL = window.location.href; 
            $.redirect(postURL,postFilterData,'POST','_SELF');
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
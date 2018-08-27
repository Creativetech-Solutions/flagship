<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
  if (!$user->levelCheck("2,9,1"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');



//Grab all reservation info
$reservationQuery = "SELECT * FROM bgi_reservations WHERE (fast_track = 1 OR ftnotify = 1) AND status != 2";
if(isset($_POST['fromDate'])){
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];
    if(validateDate($fromDate) and validateDate($toDate)){
        $reservationQuery .= " AND (arr_date BETWEEN '".$fromDate."' AND '".$toDate."' OR dpt_date BETWEEN '".$fromDate."' AND '".$toDate."')";
        $dateRangeText = date('F d, Y',strtotime($fromDate)). ' - ' .date('F d, Y',strtotime($toDate));
    }
}

//echo  $reservationQuery;
$reservations = mysql_query($reservationQuery);
if(mysql_errno()){
    echo mysql_error();
}


site_header('Fast track Reservation List');
?>

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
                    <li class="active"><a href="view-reservations.php">View Reservations</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Reservations</h2>
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
                                        <h3>Arrivals & departures Schedules | <?php echo date("Y-m-d H:i"); ?></h3>
                                        
                            <form name="reportselect">
                            <select name="menu" onChange="window.document.location.href=this.options[this.selectedIndex].value;" value="GO" class="form-control">
                                <option selected="selected">Arrivals &amp; Departures</option>
                                <option value="view-ftreservations-arr_new.php">Arrivals</option>
                                <option value="view-ftreservations-dpt.php">Departures</option>
                                <option value="view-ftflight-arr.php">Arrival Flight</option>
                            </select>
                            </form>
                                    </div>                                     
                                    <!-- Date picker -->
                                    <ul class="panel-controls panel-controls-title">                                        
                                        <li>
                                            <label for="reportrange" style="display: block;">Date Filter</label>
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
                                                <th>Tour Operator</th>
                                                <th>Reference #</th>
                                                <th>Arrival Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arrival Time</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Confirmation Number</th>
                                                <th>Depart Date</th>
                                                <th>Depart Flight#</th>
                                                <th>Depart Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($reservations)) {
                                                
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[27] . "'"));                                                     
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_fsft_touroperator WHERE id='" . $row[5] . "'"));
                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $ref_no = $row[7];
                                                $arr_date = $row[14];
                                                $dpt_date = $row[26];
                                                $conf_num = $row[40];
                                                
                                                if ($row[12]>0){
                                                        $displayft='*';
                                                    } else {
                                                        $displayft='';
                                                    
                                                    }
                                                
                                                echo '<tr>
                                                        <td><a href="ftreservation-details.php?id=' . $id . '"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="View / Edit reservation"></i></a>' . $displayft . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $title_name . '. ' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $conf_num . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_time[2] . '</td>                                                        
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                        <?php else: ?>
                                        <thead>
                                            <tr>
                                                <th>Tour Operator</th>
                                                <th>Ref #</th>
                                                <th>Arrival Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arrival Time</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Depart Date</th>
                                                <th>Depart Flight#</th>
                                                <th>Depart Time</th>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($reservations)) {
                                                
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[27] . "'"));                                                     
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $ref_no = $row[7];
                                                $arr_date = $row[14];
                                                $dpt_date = $row[26];
                                                if ($row[12]>0){
                                                    $displayft='*';
                                                    } else {
                                                        $displayft='';
                                                    }
                                                
                                                echo '<tr>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $title_name . '. ' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_time[2] . '</td>
                                                        <td>' . $displayft . '</td>
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
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->

<script type="text/javascript" language="javascript" class="init">

    $(function(){
        $("#exportBtn").on("click",function(){
//            location.href = "custom_updates/export_excel.php";
            location.href = "custom_updates/export_fsft_reservations_excel.php";
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
    });

    $(document).ready(function() {
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

        /* Add a click handler to the rows */
        $("#res-arrivals tbody tr").on('click', function (event) {
            $("#res-arrivals tbody tr").removeClass('row_selected');
            $(this).addClass('row_selected');
        });
</script>
    </body>
</html>
<?php

    error_reporting(0);
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
site_header('Hotel Reconfirmation Listing');


if(isset($_GET['page']))
    $page = $_GET['page'];

else 
    $page = 1;

$offset = ($page*10) - 10;


//Grab all reservation info
$arrivalConfirmations = "SELECT SQL_CALC_FOUND_ROWS * FROM bgi_reservations WHERE status != 2";

if(isset($_POST['fromDate'])){
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    if(validateDate($fromDate) and validateDate($toDate)){
        $arrivalConfirmations .= " AND arr_date BETWEEN '".$fromDate."' AND '".$toDate."'";
        $dateRangeText = date('F d, Y',strtotime($fromDate)). ' - ' .date('F d, Y',strtotime($toDate));
    }
}
if(isset($_GET['name']) && !empty($_GET['name']))
    $_POST['name'] = $_GET['name'];


if(isset($_POST['name']) || isset($_POST['arr_date']) || isset($_POST['dept_date'])){
    
    if(isset($_POST['name']) && !empty($_POST['name'])){
        $arrivalConfirmations .= " AND (first_name LIKE '%".$_POST['name']."%' OR last_name LIKE '%".$_POST['name']."%' OR tour_ref_no LIKE '%".$_POST['name']."%' OR flight_class LIKE '%".$_POST['name']."%' OR ref_no_sys LIKE '%".$_POST['name']."%' OR dpt_notes LIKE '%".$_POST['name']."%' OR tour_notes LIKE '%".$_POST['name']."%')";

    } else $_POST['name'] = '';

    if (isset($_POST['arr_date']) && !empty($_POST['arr_date'])){
        $arrivalConfirmations .= " AND arr_date = '".date('Y-m-d', strtotime($_POST['arr_date']))."'";
    } else $_POST['arr_date'] = '';

    if (isset($_POST['dept_date']) && !empty($_POST['dept_date'])){
        $arrivalConfirmations .= " AND dpt_date = '".date('Y-m-d', strtotime($_POST['dept_date']))."'";
    } else $_POST['dept_date'] = '';

    if(!isset($_GET['name']) || empty($_GET['name']))
        $offset = 0;
    
}
$arrivalConfirmations .= " LIMIT 10 OFFSET ".$offset;

$reservations = mysql_query($arrivalConfirmations);
if(mysql_errno()){ 
    echo mysql_error();
}
$totalRows = mysql_fetch_row(mysql_query("SELECT FOUND_ROWS()"));

if(isset($totalRows[0]))
    $totalRows = $totalRows[0];

?>
<style type="text/css">
    .repNotes{
        -ms-word-wrap:break-word;
        word-wrap:break-word;
max-width: 400px;
    overflow: hidden;
        white-space: nowrap;
text-overflow: ellipsis;
        cursor: pointer;
    }

</style>
<style type="text/css">
    ul.panel-controls > li{
        display: block;
        overflow: hidden;
        float: none;
    }
</style>
<style>
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    border: 1px solid #ddd;
}

.pagination a.active {
    background: linear-gradient(to bottom, white 0%, #dcdcdc 100%);
      color: #333 !important;
     border: 1px solid #979797;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.pagination a:first-child {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}

.pagination a:last-child {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
.panel-controls-title.dt-picker-wrap{    position: absolute; right: 10px; top: 47%;}
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
                <!--<ul class="breadcrumb">
                    <li><a href="dashboard.php">Home</a></li>
                    <li>Reservations</li>
                    <li class="active"><a href="arrival-reconfirmation.php">Arrivals - Hotel Reconfirmation</a></li>
                </ul>-->
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Hotel Reconfirmation Listing</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading" style="position:relative">
                                    
                                    <h3 class="panel-title">Arrivals Schedules</h3>


                                     <ul class="panel-controls panel-controls-title" style="width: 100%;">    
                                        <li class="pull-left" style="width: 83%;">
                                            
                                            <form id="mainFilterForm" action="arrival-reconfirmation.php" method="POST">
                                                <div class="panel-body table-responsive" style="padding-left:0">
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="arrivalDate">Search For:</label>
                                                        <input type="text" class="form-control" value="<?=$_POST['name']?>" name="name" placeholder="Search" />
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="locCoast">Arrival Date</label>
                                                        <input type="text" value="<?=$_POST['arr_date']?>" name="arr_date" class="form-control datepicker" placeholder="Search" autocomplete="off" />
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <label for="tourOperator">Departure Date</label>
                                                        <input type="text" value="<?=$_POST['dept_date']?>" name="dept_date" class="form-control datepicker" placeholder="Search" autocomplete="off"  />
                                                    </div>
                                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                        <button type="submit"  class="btn btn-default" style="margin-top: 20px;" id="applyFilterBtn"> Apply Filter </button>
                                                    </div>
                                                </div>
                                            </form>   
                                        </li>  
                                    </ul>
                                    <ul class="panel-controls panel-controls-title dt-picker-wrap">
                                        <li>
                                            <div class="dtrange" id="reportrange">
                                                <span>August 3, 2016 - September 1, 2016</span><b class="caret"></b>
                                            </div>
                                        </li>
                                    </ul>

                                </div> 





                                <div class="panel-body table-responsive">
                                    <table id="res-arrivals" class="table table-hover display">
                                        <?php if ($user->levelCheck("2,9")) : ?>
                                        <thead>
                                            <tr>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>Accommodation</th>
                                                <th>Room Type</th>
                                                <th># of Rooms</th>
                                                <th>Arrival Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arrival Time</th>
                                                <th>Guest(s)</th>
                                                <th>Ref #</th>
                                                <th>T/O</th>
                                                <th>A</th>
                                                <th>C</th>
                                                <th>I</th>
                                                <th>Depart Date</th>
                                                <th>Date Reconfirmed</th>
                                                <th>Reconf With</th>
                                                <th>Hotel Notes</th>
                                                <th>Rep Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            
                                            while($row = mysql_fetch_array($reservations)) {
                                                
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));
                                                $room_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $row[23] . "'"));
                                                $guest = mysql_query("SELECT * FROM bgi_guest WHERE ref_no_sys='" . $row[40] . "'");
                                                $guest_count = mysql_num_rows($guest);
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));                                                     
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[22] . "'"));
                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $ref_no = $row[7];
                                                $adult = $row[8];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $rep_notes = $row[11];
                                                $arr_date = $row[14];
                                                $dpt_date = $row[26];
                                                $ref_no_sys = $row[40];
                                                $hotel_notes = $row[46];
                                                $rooms = $row[56];
                                                $dateReconfirmed = $row[58];
                                                if(!empty($dateReconfirmed)){
                                                    $dateReconfirmed = date('F d, Y',strtotime($dateReconfirmed));
                                                }
                                                $reconf_with = $row[59];
                                                $guest_name = ""; //reset guest name loop to null each iteration
                                                
                                                    while ($row1 = mysql_fetch_array($guest)){
                                                    $guest_name.= "<br />$row1[title_name]. $row1[first_name] $row1[last_name]";
                                                    } 
                                                
                                                if ($row[12]>0){
                                                    $displayft='*';
                                                    
                                                    } else {
                                                        $displayft='';
                                                    
                                                    }
                                                    
                                                echo '<tr data-id="'.$id.'">
                                                        <td><a href="reservation-details.php?id=' . $id . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="View / Edit reservation"></i></a> ' . $displayft . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td>' . $room_type[2] . '</td>
                                                        <td>' . $rooms . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td><strong>' . $title_name . '. ' . $first_name . ' ' . $last_name . '</strong>' . $guest_name . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $adult . '</td>
                                                        <td>' . $child . '</td>
                                                        <td>' . $infant . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td class="date-reconf"><span style="float:left;padding-right:30px;overflow:hidden;width:90%;">' . $dateReconfirmed . '</span><em data-toggle="tooltip" data-placement="top" title="Edit \'Reconfirmed Date\'" style="width:10%;float:right;" data-placement="right"><i style="color:#1e4394; cursor:pointer" class="fa fa-pencil" data-target="#reconfirmedDate" data-toggle="modal"></i></em></td>
                                                        <td><span style="float:left;padding-right:30px;overflow:hidden;width:90%;">' . $reconf_with . '</span><em data-toggle="tooltip" data-placement="top" title="Edit \'Reconfirmed With\'" style="width:10%;float:right;" data-placement="right"><i style="color:#1e4394; cursor:pointer" class="fa fa-pencil" data-target="#reconfWith" data-toggle="modal"></i></em></td>
                                                        <td><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Hotel Notes"></i><a href="#" id="hotel_note" class="editable editable-click editable-empty" data-type="text" data-pk="1" data-placement="right" data-placeholder="Hotel Notes" data-title="Add Hotel Notes">' . $hotel_notes . '</a></td>
                                                        <td class="repNotes" data-placement="top" data-toggle="tooltip" data-original-title="Edit \'Click to See All \'">' . $rep_notes . '</td>
                                                </tr>';
                                        }
                                        ?>
                                        </tbody>
                                        <?php endif; ?>
                                    </table>
                                    <div class="center">
                                      <div class="pagination">
                                        <a href="?page=1">First</a>
                                        <?php
                                            $lastpage = ceil($totalRows/10);
                                            if($page <= 4){
                                                $pagi_start = 1;
                                                if ($lastpage >= 5)
                                                    $page_end = 5;
                                                else $page_end = $lastpage;
                                            }
                                            else if($page > 4 && $page < $lastpage - 2){
                                                $pagi_start = $page - 2;
                                                $page_end = $page + 2;
                                            } else {
                                                $pagi_start = $lastpage - 4;
                                                $page_end = $lastpage;
                                            }
                                            if($page != 1)
                                             echo '<a href="?page='.($page-1).'">Prev</a>';
                                            for($i = $pagi_start; $i <= $page_end; $i++){
                                                if($i < $page-3) continue;
                                                if ($i > $page+3) break;
                                                $active = ($page == $i) ? 'active':'';
                                                echo '<a class="'.$active.'" href="?page='.$i.'">'.$i.'</a>';
                                            }

                                            if($page != $lastpage)
                                                echo '<a href="?page='.($page+1).'">Next</a>';
                                        ?>
                                        <a href="?page=<?=$lastpage?>">Last</a>

                                        <div class="pull-right">
                                            <span>Records : <?=$totalRows?></span>
                                        </div>
                                      </div>
                                    </div>                                    
                                    
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div class="modal fade" id="reconfWith" tabindex="-1" role="dialog" aria-labelledby="ReconfWith" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Reconf With</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="reservationID" />
                <div class="form-group">
                    <label for="reconfWithInput">Name</label>
                    <input type="text" class="form-control" id="reconfWithInput" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveReconfWith">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="reconfirmedDate" tabindex="-1" role="dialog" aria-labelledby="ReconfirmedDate" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Date Reconfirmed</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="reservationID" />
                <div class="form-group">
                    <label for="arr-date">Name</label>
                    <div class="input-group date col-xs-8 right20" data-date-format="mm-dd-yyyy">
                        <input type="text" class="form-control datepicker" name="arr_date" id="arr-date" placeholder="Arrival date"/>
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveReconfirmedDate">Save changes</button>
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
        <!--<script type="text/javascript" src="js/bootstrap-editable.min.js"></script> -->      
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
<script type="text/javascript" src="js/jquery.redirect.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
<script type="text/javascript">
    $(document).ready(function() {
        //Code for DatePicker SUbmit
        $("body").on("click", ".range_inputs > button.applyBtn", function (e) {
            var fromDate = $(this).parents(".range_inputs").find("div.daterangepicker_start_input > input#max").val();
            var toDate = $(this).parents(".range_inputs").find("div.daterangepicker_end_input > input#min").val();
            var postFilterData = {
                fromDate: fromDate,
                toDate: toDate
            };
            var postURL = window.location.href;
            $.redirect(postURL, postFilterData, 'POST', '_SELF');
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
$(document).on('click','.pagination a', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var search = $('input[name="name"]').val();
        if(search !="")
            href += '&name='+search;
        location.assign(href);
    });
</script>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        $('#res-arrivals').DataTable( {
            "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
            //"order": [[ 0, 'asc' ], [ 3, 'asc' ]],
            "dom": 'T<"clear">Brt',
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Export current page',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                       columns: 'thead th:not(:first-child)'
                    }
                },
                {
                    extend: 'excel',
                    text: 'Export all pages',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        },
                        columns: 'thead th:not(:first-child)'
                    },
                    
                    action: function (e, dt, button, config)
                    {
                        location.href = "custom_updates/export_arrival_information.php";
                    }
                }
            ]
        } );

        /* Add a click handler to the rows */
        $("#res-arrivals tbody tr").on('click',function(event) {
            $("#res-arrivals tbody tr").removeClass('row_selected');
            $(this).addClass('row_selected');
        });

        $(document).ready(function() {
        $.datepicker.regional[""].dateFormat = 'yy-mm-dd';
        $.datepicker.setDefaults($.datepicker.regional['']);
         } );

        $('#reconfWith').on('shown.bs.modal', function (e) {
            var btn = e.relatedTarget;
            var spanTag = $(btn).parent().find('span');
            var reservationID = $(btn).parents('tr').attr('data-id');
            $(this).find('#reservationID').val(reservationID);
            //We ALso Need to Show the column value in input.
            var currentArrDate = $(btn).parents("tr").find("td").eq(15).find('span').text();
            var inputText = $('#reconfWithInput');
            inputText.val(currentArrDate);
            inputText.focus();
        });

        $('#reconfirmedDate').on('shown.bs.modal', function (e) {
            var btn = e.relatedTarget;
            var spanTag = $(btn).parent().find('span');
            var reservationID = $(btn).parents('tr').attr('data-id');
            $(this).find('#reservationID').val(reservationID);
            $('#arr-date').focus()
        });

        $("#saveReconfWith").on("click",function(e){
            var reservationID = $('#reconfWith').find('#reservationID').val();
            var reconfWith = $('#reconfWith').find('#reconfWithInput').val();

            var data = {
                id:reservationID,
                reconfWith:reconfWith
            };

            $.ajax({
                url:"custom_updates/update_reconf.php",
                data:data,
                type:"POST",
                success:function(output){
                    var data = output.split("::");

                    if(data[0] === "OK"){
                        $("#res-arrivals").find('tr[data-id='+reservationID+']').find('td').eq(15).find('span').text(reconfWith);
                        $('#reconfWith').modal('hide');
                    }
                }
            });
        });
    });

    $(".repNotes").on("click",function(){
        var m = $("#myModal");
        var modalLabel = m.find("#myModalLabel");
        var modalBody = m.find(".modal-body");

            modalLabel.text("Rep Notes");
            modalBody.html($(this).html());

        m.modal('show');
    });



    $("#saveReconfirmedDate").on("click",function(){
        var m = $('#reconfirmedDate');
        var reservationID = m.find('#reservationID').val();
        var reconfirmedDate = m.find('#arr-date').val();

        var data = {
            id:reservationID,
            date: reconfirmedDate
        };

        $.ajax({
            url:"custom_updates/update_reconfirmed_date.php",
            data:data,
            type:"POST",
            success:function(output){
                var data = output.split("::");
                if(data[0] === "OK"){
                   // location.reload();
                   $("#reconfirmedDate").modal('hide');
                   $('#res-arrivals').find('tr[data-id="'+reservationID+'"]').find('.date-reconf').find('span').html(data[2]);
                }
            }

        });
    });

</script>
    </body>
</html>
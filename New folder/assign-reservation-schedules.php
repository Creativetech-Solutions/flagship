<?php
$url = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
  define("_VALID_PHP", true);
  require_once("../admin-panel-fll/init.php");
  
  if (!$user->levelCheck("2,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();

/*ini_set('display_errors', 'On');
error_reporting(E_ALL &~ E_DEPRECATED);*/
include('header.php');
site_header('Assign Reservation Reps');
$loggedinas = $row->fname . ' ' . $row->lname;


if($_POST){
    $selectedDate = isset($_POST['date'])?$_POST['date']:'';
    $selectedFlightNum = isset($_POST['flightNumID'])?$_POST['flightNumID']:'';
    $selectedTourOperator =  isset($_POST['tourOperator'])?$_POST['tourOperator']:'';
    $selectedRepType =  isset($_POST['repType'])?$_POST['repType']:'';
    $reservationIDs = isset($_POST['reservationIDs'])?$_POST['reservationIDs']:'';
    if (!empty($reservationIDs)) {
        $repName = $_POST['repName'];
        if(!empty($repName) and is_numeric($repName)){
            $assigned = 1;
        }else{
            $assigned = 0;
        }

        $updateReps_sql = "UPDATE fll_reservations ".
            "SET modified_date = NOW(), modified_by = '$loggedinas', assigned = '$assigned', rep = '$repName'".
            " WHERE id IN ($reservationIDs)";
            mysql_query($updateReps_sql);
        if(mysql_error()){
            echo "<br>".$updateReps_sql;
            exit;
        }
    }


    //This is for Arrivals only if date under arrivals gets selected.
    if (!empty($selectedDate) and $selectedRepType === 'Arrivals') {
        $selectedDate = date('Y-m-d', strtotime($selectedDate));
        //Grab all reservation info
        $query = "SELECT
                    r.id AS ReservationID,
                    CONCAT(title_name,' ', first_name,' ',last_name) AS resUserName,
                    fto.`tour_operator` AS TourOperator, r.`adult` AS Adult, 
                    r.`child` AS Child, 
                    r.`infant` AS Infant, 
                    r.`tour_notes` AS TourNotes,
                    flights.arr_date AS arrivalDate,
                    flights.arr_time AS flightTime,
                    flights.`arr_flight_no` AS FlightID,
                    fc.class AS FlightClass,
                    loc.name AS Hotel,
                    r.`affiliates` AS Affiliate
                FROM fll_reservations r
                INNER JOIN fll_arrivals flights ON flights.`ref_no_sys` = `r`.`ref_no_sys`
                INNER JOIN fll_flights ff ON flights.`arr_flight_no` = ff.`id_flight`
                LEFT JOIN fll_touroperator fto ON fto.`id` = r.`tour_operator`
                LEFT JOIN `fll_flightclass` fc ON fc.`id` = flights.flight_class
                LEFT JOIN fll_location loc ON loc.`id_location` = flights.`arr_dropoff`
                WHERE r.`assigned` = 0
                AND flights.arr_date = '$selectedDate'
                ".(!empty($selectedFlightNum)?' AND ff.`id_flight` ='.$selectedFlightNum:'').(!empty($selectedTourOperator)?' AND r.tour_operator = '.$selectedTourOperator:'')." GROUP BY ReservationID";
        $reservations = mysql_query($query);
            //Arrivals reservation result
            if(isset($reservations)){
                $resultReservations = array();
                while($reservationRow = mysql_fetch_array($reservations)){
                    array_push($resultReservations,$reservationRow);
                }
            }
    } //end of if  arrivals selectedDate statement
    else if(!empty($selectedDate) and $selectedRepType === 'Departures'){
        $selectedDate = date('Y-m-d', strtotime($selectedDate));
        //Grab all reservation info
        $query = "SELECT
                    r.id AS ReservationID,
                    CONCAT(title_name,' ', first_name,' ',last_name) AS resUserName,
                    fto.`tour_operator` AS TourOperator, r.`adult` AS Adult, 
                    r.`child` AS Child, 
                    r.`infant` AS Infant, 
                    r.`tour_notes` AS TourNotes,
                    flights.dpt_date AS departureDate,
                    flights.dpt_time AS flightTime,
                    flights.`dpt_flight_no` AS FlightID,
                    fc.class AS FlightClass,
                    loc.name AS Hotel,
                    r.`affiliates` AS Affiliate
                FROM fll_reservations r
                INNER JOIN fll_departures flights ON flights.`ref_no_sys` = `r`.`ref_no_sys`
                INNER JOIN fll_flights ff ON flights.`dpt_flight_no` = ff.`id_flight`
                LEFT JOIN fll_touroperator fto ON fto.`id` = r.`tour_operator`
                LEFT JOIN `fll_flightclass` fc ON fc.`id` = flights.flight_class
                LEFT JOIN fll_location loc ON loc.`id_location` = flights.`dpt_dropoff`
                WHERE r.`assigned` = 0
                AND flights.dpt_date = '$selectedDate'
                ".(!empty($selectedFlightNum)?' AND ff.`id_flight` ='.$selectedFlightNum:'').(!empty($selectedTourOperator)?' AND r.tour_operator = '.$selectedTourOperator:'')." GROUP BY ReservationID";
        $reservations = mysql_query($query);
        //Departures reservation result
        if(isset($reservations)){
            $resultReservations = array();
            while($reservationRow = mysql_fetch_array($reservations)){
                array_push($resultReservations,$reservationRow);
            }
        }
    }//end of elseif  departures selectedDate statement


}//end of main if $_POST


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
                    <li>Team Assignment</li>                    
                    <li class="active"><a href="assign-reservation-schedules.php">Assign</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Assign Airport Reps</h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Assign Airport Reps</h3>
                                </div>
                                <form id="mainFilterForm">
                                <div class="panel-body table-responsive">
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="flightDateType">Flight Date Type</label>
                                        <select class="form-control selector2" id="flightDateType" name="flightDateType">
                                            <?php include('custom_updates/select_flight_dates.php'); ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="flightNumber">Flight Number</label>
                                        <select class="form-control selector2" id="flightNumber" name="flightNumber">
                                        </select>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <label for="tourOperator">Tour Operator</label>
                                        <?php include('tour_oper_select.php'); ?>
                                    </div>
                                    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <a href="#" class="btn btn-default" style="margin-top: 20px;" id="applyFilterBtn"> Apply Filter </a>
                                    </div>

                                    <?php
                                    if(isset($resultReservations) and !empty($resultReservations)){
                                        ?>
                                    <div class="dataTables_wrapper no-footer">
                                        <table class="table" id="resultsTable">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Tour Operator</th>
                                                <th>Affiliate</th>
                                                <th>A</th>
                                                <th>C</th>
                                                <th>I</th>
                                                <th> <?= substr($selectedRepType, 0, -1);?> Time</th>
                                                <th>Flight Class</th>
                                                <th>Hotel</th>
                                                <th>Notes</th>
                                            </tr>
                                            </thead>
                                                <tbody>
                                                <?php
                                                    foreach($resultReservations as $key=>$row){
                                                        echo '<tr data-id="'.$row['ReservationID'].'">';
                                                        echo "
                                                                <td>".$row['resUserName']."</td>
                                                                <td>".$row['TourOperator']."</td>
                                                                <td>".$row['Affiliate']."</td>
                                                                <td>".$row['Adult']."</td>
                                                                <td>".$row['Child']."</td>
                                                                <td>".$row['Infant']."</td>
                                                                <td>".$row['flightTime']."</td>
                                                                <td>".$row['FlightClass']."</td>
                                                                <td>".$row['Hotel']."</td>
                                                                <td>".$row['TourNotes']."</td>
                                                             ";
                                                        echo '</tr>';
                                                    }
                                                ?>
                                                </tbody>
                                            </table>
                                    </div>
                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <label for="repType">Rep Type</label>
                                            <select class="form-control selector2" name="repType" id="repType">
                                                <option value="<?=$selectedRepType?>"><?=$selectedRepType?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <label for="repName">Rep Name</label>
                                            <select class="form-control selector2" name="repName" id="repName">
                                            <?php include('custom_updates/rep_select.php'); ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                            <a href="#" class="btn btn-default" style="margin-top: 20px;" id="assignAirportReps"> Assign Airport Reps</a>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                </div>
                                </form>
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
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!--<script type="text/javascript" src="js/plugins/datatables/dataTables.tableTools.js"></script>-->
        <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/base64.js"></script>
<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
<!--Select2-->
<script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript" src="js/jquery.redirect.js"></script>
<!-- END THIS PAGE PLUGINS-->
        
        <!-- START TEMPLATE -->      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>


<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
<script type="text/javascript" language="javascript" class="init">
    $(function(){

        //If Page Was Being Filtered, Then We Also Need to Load the Selected Values of Ajax Also.
        <?php if(isset($selectedFlightNum) and !empty($selectedFlightNum)) {
        ?>
        select_flight_numbers();
        <?php
            }
        ?>

        //On Page Load Request the FlightNumbers
        var flightDateType = $("#flightDateType");
        var loadedSelectedOption = flightDateType.find("option:selected");


        flightDateType.on('change',select_flight_numbers); // End of on change function
        function select_flight_numbers(){
            var selectedOption = $("#flightDateType").find("option:selected");
            var selectedOptionText = selectedOption.text();
            var selectedOptionGroup = selectedOption.closest('optgroup').attr('data-label');
            var prevSelectedFlight = "<?=(isset($selectedFlightNum) and !empty($selectedFlightNum))?$selectedFlightNum:'0'?>";
            $.ajax({
                url:'<?=$url?>/custom_updates/select_flight_numbers.php',
                type:"POST",
                data: {date:selectedOptionText,type:selectedOptionGroup,flight:prevSelectedFlight},
                success:function(output){
                    $("#flightNumber").html(output);
                }
            });
        }

        $(".selector2").select2();
//        $('#resultsTable').DataTable();

        $('#applyFilterBtn').on('click',function(){
            var form = $('#mainFilterForm');
            var flightDateSelector = $('#flightDateType');
            var flightNumber = $('#flightNumber');
            var tourOperator = $("#tour-oper").find('option:selected').val();
            var postFilterData = {
                date:flightDateSelector.find('option:selected').text(),
                flightNumID:flightNumber.find('option:selected').val(),
                repType:flightDateSelector.find('option:selected').closest('optgroup').attr('data-label')
            };
            if(tourOperator){
                postFilterData.tourOperator = tourOperator;
            }
            var postURL = "<?=$url?>/assign-reservation-schedules.php";
            $.redirect(postURL,postFilterData,'POST','_SELF');
        });

        $("#assignAirportReps").on('click',function(){
            console.log('hello');
            var table = $('#resultsTable');
            var ids = [];
            var repName = $('#repName').val();
            $.each(table.find('tbody tr'),function(){
                var dataID = $(this).attr('data-id');
                ids.push(dataID);
            });
            var postData = {
                reservationIDs: ids.join(),
                repName:repName,
                value: 'assign'
            };
            console.log(postData);
//            return;
            var postURL = "<?=$url?>/assign-reservation-schedules.php";
            $.redirect(postURL,postData,'POST','_SELF');
        });
    }); // End of document Ready Function.
</script>
</body>
</html>
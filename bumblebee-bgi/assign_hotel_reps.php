<?php
$url = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
define("_VALID_PHP", true);
require_once("../admin-panel-bgi/init.php");

if (!$user->levelCheck("2,9"))
    redirect_to("index.php");

$row = $user->getUserData();


include('header.php');
site_header('Assign Reservation Reps');
$loggedinas = $row->fname . ' ' . $row->lname;


if($_POST){ 


  //echo '<pre>'; print_r($_POST); exit;
    $selectedDate = isset($_POST['date'])?$_POST['date']:'';
    if(!empty($selectedDate)){
        $selectedDate = date('Y-m-d',strtotime($selectedDate));
    }
    $selectedHotel = isset($_POST['hotel'])?$_POST['hotel']:'';
    $selectedTourOperator = isset($_POST['tourOperator'])?$_POST['tourOperator']:'';

    //Reservations IDs Will only Be Posted After the Filter Process Has Been Completed
    $selectedRepType =  isset($_POST['repType'])?$_POST['repType']:'';
    $reservationIDs = isset($_POST['reservationIDs'])?$_POST['reservationIDs']:[];
    if (!empty($reservationIDs)) {
        $repName = $_POST['repName'];
      

        $updateReps_sql = "UPDATE bgi_reservations ".
            "SET modified_date = NOW(), modified_by = '$loggedinas', hotel_rep = '$repName'".
            " WHERE id IN ($reservationIDs)";
        mysql_query($updateReps_sql);
        if(mysql_error()){
            echo "<br>";
            echo '<pre>';
                var_dump($updateReps_sql);
            echo '</pre>';
            exit;
        }
    }

    if (!empty($selectedDate) || $selectedHotel || $selectedTourOperator) {
//        $selectedDate = date('Y-m-d', strtotime($selectedDate));
        //Grab all reservation info
        $query = "SELECT
                    r.id AS ReservationID,
                    CONCAT(title_name,' ', first_name,' ',last_name) AS resUserName,
                    fto.`tour_operator` AS TourOperator, r.`adult` AS Adult, 
                    r.`child` AS Child, 
                    r.`infant` AS Infant, 
                    r.`tour_notes` AS TourNotes,
                    flights.arr_date AS arrivalDate,
                    flights.`arr_flight_no` AS FlightID,
                    ft.flight_time AS ArrivalTime,
                    flights.arr_hotel_notes AS HotelNotes,
                    loc.name AS Hotel
                FROM bgi_reservations r
                INNER JOIN bgi_arrivals flights ON flights.`ref_no_sys` = `r`.`ref_no_sys`
                LEFT JOIN bgi_location loc ON loc.id_location = flights.arr_dropoff
                LEFT JOIN bgi_touroperator fto ON fto.`id` = r.`tour_operator`
                LEFT JOIN bgi_flighttime ft ON ft.`id_fltime` = flights.`arr_time`
                WHERE r.`hotel_rep` = ''
                ".(!empty($selectedHotel)?' AND loc.`id_location` ='.$selectedHotel:'')."
                ".(!empty($selectedDate)?' AND (flights.`arr_date` ="'.$selectedDate.'" OR 
                    r.`arr_date`= "'.$selectedDate.'")':'')." 
                ".(!empty($selectedTourOperator)?' AND fto.`id` ="'.$selectedTourOperator.'"':'')." 
                GROUP BY ReservationID";
               
               
        $reservations = mysql_query($query);

        //reservation result
        if(isset($reservations)){
            $resultReservations = array();
            while($reservationRow = mysql_fetch_array($reservations)){
                array_push($resultReservations,$reservationRow);
            }
        }
    } //end of if selectedDate statement


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
        <h2><span class="fa fa-arrow-circle-o-left"></span> Assign Hotel Reps</h2>
    </div>
    <!-- END PAGE TITLE -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">

                <!-- START DATATABLE EXPORT -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Assign Hotel Reps</h3>
                    </div>
                    <form id="mainFilterForm">
                        <div class="panel-body table-responsive">
                            <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                <label for="arrivalDate">Arrival Date</label>
                                <input type="text" class="form-control datepicker" id="arrivalDate" value="<?=(isset($selectedDate) && !empty($selectedDate)?date('m/d/Y',strtotime($selectedDate)):'')?>" name="arrivalDate" placeholder="Arrival Date" />
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                <label for="locCoast">Hotels</label>
                                <select class="form-control selector2" id="locCoast" name="locCoast">
                                    <option value="0">Select Hotel</option>
                                    <?php include('custom_updates/select_loc_coast.php'); ?>
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
                                            <th>Arrival Time</th>
                                            <th>Hotel</th>
                                            <th>Hotel Notes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach($resultReservations as $key=>$row){
                                            if(empty($row['ArrivalTime']))  $row['ArrivalTime'] = '00:00';
                                            echo '<tr data-id="'.$row['ReservationID'].'">';
                                            echo "
                                                                <td>".$row['resUserName']."</td>
                                                                <td>".$row['TourOperator']."</td>
                                                                <td>".$row['resUserName']."</td>
                                                                <td>".$row['Adult']."</td>
                                                                <td>".$row['Child']."</td>
                                                                <td>".$row['Infant']."</td>
                                                                <td>".$row['ArrivalTime']."</td>
                                                                <td>".$row['Hotel']."</td>
                                                                <td>".$row['HotelNotes']."</td>
                                                             ";
                                            echo '</tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    <label for="repName">Rep Name</label>
                                    <select class="form-control selector2" name="repName" id="repName">
                                        <?php include('custom_updates/rep_select.php'); ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    <a href="#" class="btn btn-default" style="margin-top: 20px;" id="assignAirportReps"> Assign Hotel Reps</a>
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
            var arrivalDate = $('#arrivalDate');
            var locCoast = $('#locCoast');
            var tourOperator = $("#tour-oper").find('option:selected').val();
            var postFilterData = {
                date:arrivalDate.val(),
                hotel:locCoast.find('option:selected').val()
            };
            if(tourOperator){
                postFilterData.tourOperator = tourOperator;
            }
            var postURL = "<?=$url?>/assign_hotel_reps.php";
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
            var postURL = "<?=$url?>/assign_hotel_reps.php";
            $.redirect(postURL,postData,'POST','_SELF');
        });

        // generate hotels on base of date
      /*  $('#arrivalDate').datepicker({ 
            onSelect: function(dateText, inst) {
                var date = $(this).val();
                console.log(date);

            }
        });*/

    }); // End of document Ready Function.

    $('#arrivalDate').datepicker( {
        onSelect: function(date) {
            if(date != ''){
                $.ajax({
                    url:'<?=$url?>/custom_updates/select_loc_coast.php',
                    type:"POST",
                    data:{arrdate:date,type:"hotel_rep"},
                    success:function(data){
                        $('#locCoast').html(data).select2();
                    },
                    error:function(){

                    }

                })
            } // end of if
        }
    });


    $('#locCoast').on('select2:close', function(e){
         var locId = $(this).val();
         var arrDate = $('#arrivalDate').val();
         if(locId != ''){
            $.ajax({
                    url:'<?=$url?>/tour_oper_select.php',
                    type:"POST",
                    data:{locId:locId, arrDate:arrDate},
                    success:function(data){
                        $('#tour-oper').html(data).select2();
                    },
                    error:function(){

                    }

                })
         }
    })
</script>
</body>
</html>
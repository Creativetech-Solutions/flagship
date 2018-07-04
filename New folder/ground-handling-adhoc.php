<style type="text/css">
    .list-group-item {
        /* position: relative; */
        display: block;
        padding: 10px 15px;
        margin-bottom: -1px;
        background-color: #fff;
         border: 0px !important;
    }
    .marginBotBox{
        margin-bottom: 25px;
    }

    .report_btns a{ margin-left:4px;     margin-top: 4px;}

    @-moz-document url-prefix() {
        .calendar.left{min-width: 300px}
        .calendar.right{min-width: 300px}
    }

</style>
<?php
$url = '//' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
define("_VALID_PHP", true);
require_once("../admin-panel-fll/init.php");
if (!$user->levelCheck("3,5,6,7,9"))
    redirect_to("index.php");
$row = $user->getUserData();
?>
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */
include('ref.php');
include('fast_ref.php');
include('header.php');
include('select.class.php');
$countrycode = "FLL";
$fsref = "$countrycode-$flagship_ref";
$fastRef = "$countrycode-$flagship_fast_ref";
$loggedinas = $row->fname . ' ' . $row->lname;
site_header('Add Reservations');
$report_tile ="";
$reportheading = 'Create Ad-hoc Report';
$selectedCheckBoxesNames = [];
$reportId='';
if(!isset($_REQUEST['sect'])){
    $_REQUEST['sect']='gh';
}
if(isset($_REQUEST['report_id']) && !empty($_REQUEST['report_id'])){
    $reportId=$_REQUEST['report_id'];
    $result = mysql_query("SELECT * FROM fll_reports WHERE id=".$reportId);
    if($result){
        $reportData = mysql_fetch_row($result);
        $report_tile = $reportData[1];
        $reportData = json_decode($reportData[2], true);
        //print_r($reportData);
        $selectedCheckBoxesNames = array_column($reportData, 'name');
        
    $reportheading = 'Edit Ad-hoc Report';
    }

}
else {
    if($_REQUEST['sect']=='fsft'){
        $fsft = 1;
    } else {
        $fsft = 0;
    }
    $query = 'SELECT `id`, `name` FROM fll_reports WHERE fsft = '.$fsft;
     if($row->userlevel!=9)
        $query .= ' WHERE user_id ='.$_SESSION['userid'];
    $result = mysql_query($query);

}
// select already saved reports
 

?>


<?php include('profile.php'); ?>
<?php include('navigation.php'); ?>
<!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->

<!-- PAGE CONTENT -->
<div class="page-content">
    <?php include('vert-navigation.php'); ?>
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li>Ground Handling</li>
        <li class="active">Add Hoc Report</li>
    </ul>
    <!-- END BREADCRUMB -->

    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12">
                <form id="adhocReportForm" class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">

                            <h3 class="panel-title"><strong><?=$reportheading?></strong></h3>

                            <span class="pull-right"><buton class="btn btn-default" type="button" id="generateReportBtn">Generate Report</buton></span>
                        </div>
                        
                        <div class="col-md-12 report_btns">
                            <?php
                                if(isset($result)){
                                        while($row = mysql_fetch_assoc($result)){
                                            echo '<a class="btn btn-danger btn-sm" href="adhoc_report.php?report_id='.$row['id'].'&sect='.$_REQUEST['sect'].'">'.$row['name'].'</a>';
                                        }
                                    }
                             ?>

                             <ul class="panel-controls panel-controls-title text-right" style="margin-left: 20px;">                       
                                        <li class="pull-right" style="width:100%">
                                            <label for="reportrange" style="display: block;">Arrival Date Filter</label>
                                            <div id="reportrange" class="dtrange pull-right" >
                                                <span></span><b class="caret"></b>
                                            </div>                                     
                                        </li>              
                                    </ul>  
                        </div>
                        <div class="panel-body">
                            <div class="row col-md-12 marginBotBox">
                                <div class="form-group">
                                    <label for="reportName">Report Name</label>
                                    <input type="text" value="<?=$report_tile?>" class="form-control" id="reportName" name="reportName" />
                                    <input type="hidden" value="<?=$reportId?>" name="reportId" />
                                </div>
                            </div> 
                            <div class="row">
                                <h4>Select Options</h4>
                                <div class="col-md-4">
                                    <div class="col-xs-12 marginBotBox">
                                        <h4><strong>Reservation Information</strong></h4>
                                        <label for="selectAllPersonalInformationCheckbox"><input type="checkbox" class="selectAllCheckboxes" id="selectAllPersonalInformationCheckbox">Select All</label>
                                        <ul class="list-group">
                                        <input type="hidden" name="R.id::Id" value="1" />
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" id="title" name="R.title_name::Title_Name" <?=in_array('R.title_name::Title_Name', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Title</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" id="firstName" name="R.first_name::First_Name" <?=in_array('R.first_name::First_Name', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>First Name</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" id="lastName" name="R.last_name::Last_Name" <?=in_array('R.last_name::Last_Name', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Last Name</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" id="PNR" name="R.pnr::PNR" <?=in_array('R.pnr::PNR', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Passenger Name Record (PNR)</strong>
                                            </li>

                                            <?php if($_REQUEST['sect'] == 'fsft'){ ?>
                                             
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" id="arr_service_only" name="R.id::Arrival_Service_Only" <?=in_array('R.id::Arrival_Service_Only', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Arrival Service Only</strong>
                                                </li>

                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" id="client" name="R.T.tour_operator::Client" <?=in_array('R.T.tour_operator::Client', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Client</strong>
                                                </li>
                                            <?php } else {?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" id="tour_operator" name="R.T.tour_operator::Tour_Operator" <?=in_array('R.T.tour_operator::Tour_Operator', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Tour Operator</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" id="operator_code" name="R.operator_code::Operator_Code" <?=in_array('R.operator_code::Operator_Code', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Operator Code/Brand</strong>
                                                </li>
                                               <?php  } ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" id="tour_ref_no" name="R.tour_ref_no::Reference_No" <?=in_array('R.tour_ref_no::Reference_No', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Reference #</strong>
                                                </li>
                                                <li class="list-group-item">
                                                        <input class="a_c_i" type="checkbox" value="1" id="adult" name="R.adult::Adult" <?=in_array('R.adult::Adult', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong># of Adults</strong>
                                                </li>
                                                <li class="list-group-item">
                                                        <input class="a_c_i" type="checkbox" value="1" id="child" name="R.child::Child" <?=in_array('R.child::Child', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong># of Children</strong>
                                                </li>
                                                <li class="list-group-item">
                                                        <input class="a_c_i" type="checkbox" value="1" id="infant" name="R.infant::Infant" <?=in_array('R.infant::Infant', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong># of Infants</strong>
                                                </li>
                                                        <input type="hidden" value="1" id="a_c_i" name="R.id::A_C_I" 
                                                        <?php 
                                                        if(in_array('R.infant::Infant', $selectedCheckBoxesNames) || in_array('R.child::Child', $selectedCheckBoxesNames) || in_array('R.child::Adult', $selectedCheckBoxesNames)){
                                                            echo 'checked';
                                                            }?> /> 
                                                <li class="list-group-item">
                                                        <input type="checkbox" value="1" id="tour_notes" name="R.tour_notes::Rep_Notes" <?=in_array('R.tour_notes::Rep_Notes', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Rep Notes</strong>
                                                </li>
                                                  <?php if($_REQUEST['sect'] == 'fsft'){ ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" id="payment_type" name="R.payment_type::Payment_Type" <?=in_array('R.payment_type::Payment_Type', $selectedCheckBoxesNames)?'checked':''?>/> 
                                                <strong>Payment Type</strong>
                                                </li>
                                                <?php } ?>
                                        </ul>
                                    </div>
                                     <div class="col-xs-12 marginBotBox">
                                        <h4><strong>Guests Information</strong></h4>
                                        <label for="selectAllActivities"><input type="checkbox" class="selectAllCheckboxes" id="selectAllActivities">Select All</label>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.G.title_name::Guest_Title_Name" <?=in_array('R.G.title_name::Guest_Title_Name', $selectedCheckBoxesNames)?'checked':''?>/>
                                                <strong>Title Name</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.G.first_name::Guest_First_Name" <?=in_array('R.G.first_name::Guest_First_Name', $selectedCheckBoxesNames)?'checked':''?>/>
                                                <strong>First Name</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.G.last_name::Guest_Last_Name" <?=in_array('R.G.last_name::Guest_Last_Name', $selectedCheckBoxesNames)?'checked':''?>/>
                                                <strong>Last Name</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.G.pnr::Guest_PNR" <?=in_array('R.G.pnr::Guest_PNR', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>PNR</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.G.adult::Guest_Adult" <?=in_array('R.G.adult::Guest_Adult', $selectedCheckBoxesNames)?'checked':''?>/>
                                                <strong>Adult</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.G.child_age::Guest_Child_Age" <?=in_array('R.G.child_age::Guest_Child_Age', $selectedCheckBoxesNames)?'checked':''?>/>
                                                <strong>Child</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.G.infant_age::Guest_Infant_Age" <?=in_array('R.G.infant_age::Guest_Infant_Age', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Infant</strong>
                                            </li>
                                            <?php if($_REQUEST['sect'] == 'fsft'){ ?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" id="total_amount" name="R.sup_total_amount::Price" <?=in_array('R.sup_total_amount::Price', $selectedCheckBoxesNames)?'checked':''?>/> 
                                            <strong>Price</strong>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-sm-12 col-xs-12 marginBotBox" >
                                        <h4><strong>Arrivals Information</strong></h4>
                                        <label for="selectAllArrivalsInformation"><input type="checkbox" class="selectAllCheckboxes" id="selectAllArrivalsInformation">Select All</label>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.arr_date::Arr_Date" <?=in_array('R.A.arr_date::Arr_Date', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Date</strong>
                                            </li>
                                            <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.fast_track::Fast_Track" <?=in_array('R.A.fast_track::Fast_Track', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Fast Track</strong>
                                            </li>
                                            <?php }?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.FAR.flight_number::Arr_Flight" <?=in_array('R.FAR.flight_number::Arr_Flight', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Flight No</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.arr_time::Arr_Time" <?=in_array('R.A.arr_time::Arr_Time', $selectedCheckBoxesNames)?'checked':''?>/>
                                                <strong>Time</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.FCA.class::Arr_Flight_Class" <?=in_array('R.FCA.class::Arr_Flight_Class', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Flight Class</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.arr_transport::Arr_Transport" <?=in_array('R.A.arr_transport::Arr_Transport', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Transport</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.DDA.name::Arr_Driver" <?=in_array('R.DDA.name::Arr_Driver', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Driver</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.AV.name::Arr_Vehicle" <?=in_array('R.AV.name::Arr_Vehicle', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Vehicle</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.arr_transport_notes::Arr_and_Transport_Notes" <?=in_array('R.A.arr_transport_notes::Arr_and_Transport_Notes', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Arrival &amp; Transport Notes</strong>
                                            </li>
                                            <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.AL.name::Arr_Pickup" <?=in_array('R.AL.name::Arr_Pickup', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Pickup</strong>
                                            </li>
                                            <?php } ?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.ADL.name::Arr_Dropoff" <?=in_array('R.ADL.name::Arr_Dropoff', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Dropoff</strong>
                                            </li>
                                            <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.RP.rep_type::Arr_Rep_Type" <?=in_array('R.RP.rep_type::Arr_Rep_Type', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Rep Type</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.client_reqs::Arr_Client_Reqs" <?=in_array('R.A.client_reqs::Arr_Client_Reqs', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Client Reqs</strong>
                                            </li>
                                            <?php } ?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.infant_seats::Arr_Infant_Seats" <?=in_array('R.A.infant_seats::Arr_Infant_Seats', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Infant Seats</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.child_seats::Arr_Child_Seats" <?=in_array('R.A.child_seats::Arr_Child_Seats', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Child Seats</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.booster_seats::Arr_Booster_Seats" <?=in_array('R.A.booster_seats::Arr_Booster_Seats', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Booster Seats</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.vouchers::Arr_Vouchers" <?=in_array('R.A.vouchers::Arr_Vouchers', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Vouchers</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.cold_towel::Arr_Cold_Towel" <?=in_array('R.A.cold_towel::Arr_Cold_Towel', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Cold Towel</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.bottled_water::Arr_Bottled_Water" <?=in_array('R.A.bottled_water::Arr_Bottled_Water', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Bottled Water</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.luggage_vehicle::Arr_Lugguage_Vehicle" <?=in_array('R.A.luggage_vehicle::Arr_Lugguage_Vehicle', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Luggage Vehicle</strong>
                                            </li>
                                             <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.excursion_name::Arr_Excursion_Name" <?=in_array('R.A.excursion_name::Arr_Excursion_Name', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Excursion Name</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.excursion_date::Arr_Excursion_Date" <?=in_array('R.A.excursion_date::Arr_Excursion_Date', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Excursion Date</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.excursion_pickup::Arr_Excursion_Pickup" <?=in_array('R.A.excursion_pickup::Arr_Excursion_Pickup', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Excursion Pickup</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.excursion_confirm_by::Arr_Excursion_Confirm_By" <?=in_array('R.A.excursion_confirm_by::Arr_Excursion_Confirm_By', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Excursion Confirm By</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.excursion_confirm_date::Arr_Confirm_Date" <?=in_array('R.A.excursion_confirm_date::Arr_Confirm_Date', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Excursion Confirm Date</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.excursion_guests::Arr_Excursion_Guests" <?=in_array('R.A.excursion_guests::Arr_Excursion_Guests', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Excursion Guests</strong>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>


                                    <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                    <div class="col-sm-12 col-xs-12 marginBotBox" >
                                        <h4><strong>Hotel</strong></h4>
                                        <label for="selectAllArrivalsInformation"><input type="checkbox" class="selectAllCheckboxes" id="selectAllArrivalsInformation">Select All</label>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.ADL.name::Hotel_Arr_Dropoff" <?=in_array('R.ADL.name::Hotel_Arr_Dropoff', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Dropoff Location</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.RA.room_type::Arr_Room_Type" <?=in_array('R.RA.room_type::Arr_Room_Type', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Room Type</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.rooms::Arr_No_of_Rooms" <?=in_array('R.A.rooms::Arr_No_of_Rooms', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong># of Rooms</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.room_no::Arr_Room" <?=in_array('R.A.room_no::Arr_Room', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Room No</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.room_last_name::Arr_Room_Last_Name" <?=in_array('R.A.room_last_name::Arr_Room_Last_Name', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Last Name on Room</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.LC.coast::Zone" <?=in_array('R.LC.coast::Zone', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Zone</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.ADL.loc_code::Code" <?=in_array('R.ADL.loc_code::Code', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Code</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.A.arr_hotel_notes::Arr_Hotel_Notes" <?=in_array('R.A.arr_hotel_notes::Arr_Hotel_Notes', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Hotel Notes</strong>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php }?>
                                    <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                    <div class="col-sm-12 col-xs-12 marginBotBox" >
                                        <h4><strong>Arrival Additional Rooms</strong></h4>
                                        <label for="selectAllAddRooms"><input type="checkbox" class="selectAllCheckboxes" id="selectAllAddRooms">Select All</label>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.RAR.room_type::Additional_Room_Type" <?=in_array('R.RAR.room_type::Additional_Room_Type', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Room Type</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.AR.room_number::Additional_Room_Number" <?=in_array('R.AR.room_number::Additional_Room_Number', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Room Number</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.AR.last_name::Additional_Last_Name" <?=in_array('R.AR.last_name::Additional_Last_Name', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Last Name on Room</strong>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-4 marginBotBox">

                                    <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                    <div class="col-sm-12 col-xs-12 marginBotBox" >
                                        <h4><strong>Additional Arrival Transfer</strong></h4>
                                        <label for="selectAllAddTransport"><input type="checkbox" class="selectAllCheckboxes" id="selectAllAddTransport">Select All</label>
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.AT.transport_mode::Additional_Transport_Mode" <?=in_array('R.AT.transport_mode::Additional_Transport_Mode', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Transport Mode</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.ATD.name::Additional_Transport_Supplier" <?=in_array('R.ATD.name::Additional_Transport_Supplier', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Transport Supplier</strong>
                                            </li>
                                            <li class="list-group-item">
                                                <input type="checkbox" value="1" name="R.ATV.name::Additional_Vehicle" <?=in_array('R.ATV.name::Additional_Vehicle', $selectedCheckBoxesNames)?'checked':''?> />
                                                <strong>Vehicle</strong>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-12 marginBotBox">
                                             <h4><strong>Arrival Inter-Hotel Transfer</strong></h4>
                                            <label for="selectAllArrIntelHotel"><input type="checkbox" class="selectAllCheckboxes" id="selectAllArrIntelHotel">Select All</label>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.L.name::Inter_Hotel_Pickup" <?=in_array('R.L.name::Inter_Hotel_Pickup', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup Location</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.I.pickup_date::Inter_Hotel_Pickup_Date" <?=in_array('R.I.pickup_date::Inter_Hotel_Pickup_Date', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup Date</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.I.pickup_time::Inter_Hotel_Pickup_Time" <?=in_array('R.I.pickup_time::Inter_Hotel_Pickup_Time', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup Time</strong>
                                                </li>
                                                <?php /* ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.I.pickup::Pickup_Location" <?=in_array('R.I.pickup::Pickup_Location', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Transport Mode</strong>
                                                </li>
                                                <?php */ ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.IL.name::Inter_Hotel_Dropoff_Location" <?=in_array('R.IL.name::Inter_Hotel_Dropoff_Location', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Dropoff Location</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.I.transport::Inter_Hotel_Transport" <?=in_array('R.I.transport::Inter_Hotel_Transport', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Transport Supplier</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.IV.name::Inter_Hotel_Vehicle" <?=in_array('R.IV.name::Inter_Hotel_Vehicle', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Vehicle</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.I.transfer_notes::Inter_Hotel_Transfer_Details" <?=in_array('R.I.transfer_notes::Inter_Hotel_Transfer_Details', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Inter Hotel Transfer Details</strong>
                                                </li>
                                            </ul>
                                    </div>

                                    <div class="col-md-12 marginBotBox">
                                             <h4><strong>Concierge Transfer </strong></h4>
                                            <label for="selectAllArrivalsTransfer"><input type="checkbox" class="selectAllCheckboxes" id="selectAllArrivalsTransfer">Select All</label>
                                            <ul class="list-group">
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.ADP.name::Additional_Pickup_Location" <?=in_array('R.ADP.name::Additional_Pickup_Location', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup Location</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.AD.pickup_date::Additional_Pickup_Date" <?=in_array('R.AD.pickup_date::Additional_Pickup_Date', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup Date</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.ADPT.flight_time::Additional_Pickup_Time" <?=in_array('R.ADPT.flight_time::Additional_Pickup_Time', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup Time</strong>
                                                </li>
                                                <?php /* ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.AD.pickup::Pickup_Location" <?=in_array('R.AD.pickup::Pickup_Location', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Transport Mode</strong>
                                                </li>
                                                <?php */ ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.ADDL.name::Additional_Dropoff_Location" <?=in_array('R.ADDL.name::Additional_Dropoff_Location', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Dropoff Location</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.AD.transport::Additional_Transport" <?=in_array('R.AD.transport::Additional_Transport', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Transport Supplier</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.ADAV.name::Additional_Vehicle" <?=in_array('R.ADAV.name::Additional_Vehicle', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Vehicle</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.AD.transfer_notes::Concierge_Notes" <?=in_array('R.AD.transfer_notes::Concierge_Notes', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Concierge Notes</strong>
                                                </li>
                                            </ul>
                                    </div>


                                    <?php } ?>
                                    <div class="col-md-12 marginBotBox">
                                        <h4><strong>Departure Information</strong></h4>
                                        <label for="selectAllAdminAir"><input type="checkbox" class="selectAllCheckboxes" id="selectAllAdminAir">Select All</label>
                                         <ul class="list-group">
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.D.dpt_date::Dept_Date" <?=in_array('R.D.dpt_date::Dept_Date', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Date</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.F.flight_number::Dept_Flight_No" <?=in_array('R.F.flight_number::Dept_Flight_No', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Flight No</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.FT.flight_time::Dept_Time" <?=in_array('R.FT.flight_time::Dept_Time', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Time</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.FC.class::Dept_Flight_Class" <?=in_array('R.FC.class::Dept_Flight_Class', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Flight Class</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.D.dpt_transport::Dept_Transport" <?=in_array('R.D.dpt_transport::Dept_Transport', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Transport</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.DD.name::Dept_Driver" <?=in_array('R.DD.name::Dept_Driver', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Driver</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.DV.name::Dept_Vehicle" <?=in_array('R.DV.name::Dept_Vehicle', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Vehicle</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.DPL.name::Dept_Pickup" <?=in_array('R.DPL.name::Dept_Pickup', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.D.dpt_pickup_time::Dept_Pickup_Time" <?=in_array('R.D.dpt_pickup_time::Dept_Pickup_Time', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Pickup Time</strong>
                                                </li>

                                                <?php if($_REQUEST['sect'] == 'gh'){ ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.DDL.name::Dept_Dropoff" <?=in_array('R.DDL.name::Dept_Dropoff', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Dropoff</strong>
                                                </li>
                                                <?php } ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.D.dpt_transport_notes::Dept_Transport_Notes" <?=in_array('R.D.dpt_transport_notes::Dept_Transport_Notes', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Transport Notes</strong>
                                                </li>
                                                <?php /* 
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.D.dpt_main::Dept_Main" <?=in_array('R.D.dpt_main::Dept_Main', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Main</strong>
                                                </li>
                                                 */ ?>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.D.dpt_jet_center::Dept_Jet_Center" <?=in_array('R.D.dpt_jet_center::Dept_Jet_Center', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Jet Center</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    <input type="checkbox" value="1" name="R.dpt_notes::Accounting_Notes" <?=in_array('R.dpt_notes::Accounting_Notes', $selectedCheckBoxesNames)?'checked':''?> />
                                                    <strong>Accounting Notes</strong>
                                                </li>
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        </div><!--end of div panel panel-default-->
                </form><!--end of form-->
            </div><!--end of div col-md-12-->
        </div><!--end of div row-->
    </div> <!--end of div page-content-wrap-->
    <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->


<!-- START PRELOADS -->
<audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
<!-- END PRELOADS -->

<!-- START SCRIPTS -->
<!-- START PLUGINS -->
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
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
<!--Select2-->
<script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
<!-- END THIS PAGE PLUGINS -->
    <script type="text/javascript" src="js/plugins/moment.min.js"></script>
    <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script> 

<!-- START TEMPLATE -->
<script type="text/javascript" src="js/relCopy.jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/actions.js"></script>

<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
<!--Select2-->
<script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
<!-- END TEMPLATE -->
<script type="text/javascript" src="js/jquery.redirect.js"></script>

<script type="text/javascript">
    $(function(){
        $('.selectAllCheckboxes').on('change',function(){
            var MainBoxDiv = $(this).parent().parent();

            if($(this).is(':checked')){
                MainBoxDiv.find('ul.list-group').find('input[type="checkbox"]').prop('checked',true);

            }else{
                MainBoxDiv.find('ul.list-group').find('input[type="checkbox"]').prop('checked',false);
            }

        });

        $('#generateReportBtn').on('click',function(){
            // get to and from dates 
            var fromDate = $(".range_inputs").find("div.daterangepicker_start_input > input#max").val();
            var toDate = $(".range_inputs").find("div.daterangepicker_end_input > input#min").val();
            //
            var field = $('#reportName');
             var reportName = field.val();
             if(reportName == ''){
                field.css('border-color','#b64645');
                alert('Please Enter Report Name');
                return false;
             }
             if(!$('input:checked').length){
                alert('Please Select Some Field');
                return false;
             }
                //Getting All Inputs.
            var formData =   $('#adhocReportForm').serializeArray();
            var postURL = '<?=$url?>/adhoc_report.php?sect=<?=$_REQUEST["sect"]?>&fromDate='+fromDate+'&toDate='+toDate;
            //Just Redirect it.
            $.redirect(postURL,formData,'POST');

        });
    });


    $(function(){

        /* reportrange */
        if($("#reportrange").length > 0){
            $("#reportrange").daterangepicker({
                ranges: {
                    'Today': [moment().subtract(3, 'month'), moment().subtract(3, 'month')],
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
                startDate: moment().subtract(3, 'years'),
                endDate: moment()
            },function(start, end) { 
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            });

            <?php

            if(isset($dateRangeText) and !empty($dateRangeText)){
                echo "$(\"#reportrange span\").html('".$dateRangeText."');";
                echo "console.log('".$dateRangeText."')";
            }else{
                echo "$(\"#reportrange span\").html(moment().subtract(3, 'years').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));";
            }
            ?>
        }

        /* end reportrange */
        // on click any of adult , child or infant checkbox, checked hidden a_c_i
        $('.a_c_i').click(function() {
          if ($(this).is(':checked')) {
            $('#a_c_i').prop('checked');
          } else {
            $('#a_c_i').prop('checked',false);
          }
        });
    });
</script>
</body>
</html>

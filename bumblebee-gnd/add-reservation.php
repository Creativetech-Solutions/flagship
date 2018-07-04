<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
  define("_VALID_PHP", true);
  require_once("../admin-panel-gnd/init.php");
  
  if (!$user->levelCheck("2,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */
include ('ref.php');
include('header.php');
include ('select.class.php');
$countrycode = "GND";
$fsref = "$countrycode-$flagship_ref";
$loggedinas = $row->fname . ' ' . $row->lname;
site_header('Add Reservations');



if(isset($_POST['addreservation']))
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
    $infant_seats       = QuoteSmart($_POST['infant_seats']);
    $child_seats        = QuoteSmart($_POST['child_seats']);
    $booster_seats      = QuoteSmart($_POST['booster_seats']);
    $vouchers           = QuoteSmart($_POST['vouchers']);
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
    $arr_hotel_notes = QuoteSmart($_POST['arr_hotel_notes']);
    $dpt_transport_notes = QuoteSmart($_POST['dpt_transport_notes']);
    $user_action = "add new reservation: $title_name. $first_name $last_name #ref:$fsref";
    
    $ftres = isset($_POST['ftres']) ? 1 : 0;
    if ($ftres > 0){
        $ftnotify = 1;
    }
    for($i=0; $i < count($_POST["guest_title_name"]); $i++) {
        if ($i>=1){
            $guest_title_name = QuoteSmart($_POST['guest_title_name'][$i]);
            $guest_first_name = QuoteSmart($_POST['guest_first_name'][$i]);
            $guest_last_name = QuoteSmart($_POST['guest_last_name'][$i]);
            $guest_adult = isset($_POST['guest_adult'][$i]) ? 1 : 0;
            $child_age = QuoteSmart($_POST['child_age'][$i]);
            $infant_age         = QuoteSmart($_POST['infant_age'][$i]);
            $guest_pnr          = QuoteSmart($_POST['guest_pnr'][$i]);
            
        $sql_1 = "INSERT INTO gnd_guest ". 
        "(ref_no_sys, title_name, first_name, last_name, adult, child_age, infant_age, pnr) ". 
        "VALUES ('$fsref', '$guest_title_name', '$guest_first_name', '$guest_last_name', '$guest_adult', '$child_age', '$infant_age', '$guest_pnr')";
        $retval1 = mysql_query( $sql_1, $conn );
        }
    }
    
    //Post driver info to jobsheet
    if ($arr_driver > 0){
        $res_type_arr = 1;
        $sql5 = "INSERT INTO gnd_resdrivers ". 
        "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) ". 
        "VALUES ('$arr_driver', '$arr_vehicle_no', '$fsref', '$adults', '$children', '$infants', '$tour_oper', '$arr_pickup', '$arr_time', '$arr_transport_notes', '$arr_time', '$arr_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$arr_date', '$res_type_arr')";
        $retval5 = mysql_query( $sql5, $conn );
    }
    
    if ($dpt_driver > 0){
        $res_type_dpt = 2;
        $sql6 = "INSERT INTO gnd_resdrivers ". 
        "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) ". 
        "VALUES ('$dpt_driver', '$dpt_vehicle_no', '$fsref', '$adults', '$children', '$infants', '$tour_oper', '$dpt_pickup', '$pickup_time', '$dpt_transport_notes', '$dpt_time', '$dpt_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$dpt_date', '$res_type_dpt')";
        $retval6 = mysql_query( $sql6, $conn );
    }

    //Put all the remaining stuff into the database
	$sql = "INSERT INTO gnd_reservations ". 
        "(title_name, first_name, last_name, pnr, tour_operator, operator_code, tour_ref_no, adult, child, infant, tour_notes, fast_track, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, dpt_date, dpt_time, dpt_flight_no, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_notes, creation_date, created_by, ref_no_sys, arr_transport_notes, dpt_transport_notes, arr_hotel_notes, ftnotify, infant_seats, child_seats, booster_seats, vouchers) ". 
        "VALUES ('$title_name', '$first_name', '$last_name', '$pnr', '$tour_oper', '$oper_code', '$tour_ref_no', '$adults', '$children', '$infants', '$tour_notes', '$ftres', '$arr_date', '$arr_time', '$arr_flight_no', '$flight_class', '$arr_transport', '$arr_driver', '$arr_vehicle_no', '$arr_pickup', '$arr_dropoff', '$room_type', '$rep_type', '$client_reqs', '$dpt_date', '$dpt_time', '$dpt_flight_no', '$dpt_transport', '$dpt_driver', '$dpt_vehicle_no', '$dpt_pickup', '$dpt_dropoff', '$pickup_time', '$dpt_notes', NOW(), '$loggedinas', '$fsref', '$arr_transport_notes', '$dpt_transport_notes', '$arr_hotel_notes', '$ftnotify', '$infant_seats', '$child_seats', '$booster_seats', '$vouchers')";
        $retval = mysql_query( $sql, $conn );
    
    
    //Log user action
    $sql_4 = "INSERT INTO gnd_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval4 = mysql_query( $sql_4, $conn );      
        
        
        if(!$retval)
            {
                die('Could not enter data: ' . mysql_error());
            }        

        header('Location:add-reservation.php?ok=1');  
        mysql_close($conn);
	}
?>
<?php 
$ok= isset($_GET['ok']);
if($ok)  {
    echo '<script> alert("Reservation successfully added"); </script>';
    }
    ?>
    <style type="text/css">
    .reqs-box {
        display: none;
    }
</style>
    <!-- start additional requirements toggle -->           
    <script type="text/javascript">
        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                if($(this).attr("value")=="clientreqs"){
                    $(".clientreqs").toggle();
                }            
            });
        });
    </script>
                <!-- Guest Clone -->
                <script>
                    $(function(){
                        var removeLink = ' <input class="remove btn btn-danger" type="button" id="btnDel" value="remove guest" onclick="$(this).parent().slideUp(function(){ $(this).remove() }); return false" />';
                        $('a.addguest').relCopy({limit: 0, append: removeLink});
                    });
                </script>

               <script type="text/javascript">
               //<![CDATA[
                function disp_confirm() {
                    var name=confirm("Pressing OK will Clear all form data.")
                    if(name==true) {
                        return true;
                    }
                    else {
                        return false;
                    }
                    }
                //]]>
                </script>  
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#arr-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#arr-driver").change(function(){
                                            $("#arr-vehicle-no").attr("disabled","disabled");
                                            $("#arr-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#arr-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#arr-vehicle-no").removeAttr("disabled");
                                                $("#arr-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#dpt-driver").change(function(){
                                            $("#dpt-vehicle-no").attr("disabled","disabled");
                                            $("#dpt-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#dpt-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#dpt-vehicle-no").removeAttr("disabled");
                                                $("#dpt-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#arr-time").attr("disabled","disabled");
                                        
                                        $("#arr-flight-no").change(function(){
                                            $("#arr-time").attr("disabled","disabled");
                                            $("#arr-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#arr-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#arr-time").removeAttr("disabled");
                                                $("#arr-time").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-time").attr("disabled","disabled");
                                        
                                        $("#dpt-flight-no").change(function(){
                                            $("#dpt-time").attr("disabled","disabled");
                                            $("#dpt-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#dpt-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#dpt-time").removeAttr("disabled");
                                                $("#dpt-time").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#room-type").attr("disabled","disabled");
                                        
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
                    <li><a href="#">Reservations</a></li>
                    <li class="active">Add Reservation</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add-reservations" class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add Reservation</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <h4>Tour Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-7"><!-- first name / last name fields -->
                                            <input type="text" class="form-control right20 left20" placeholder="First name" id="first-name" name="first_name" value="" required>
                                            <input type="text" class="form-control" placeholder="Last name" id="last-name" name="last_name" value="" required>
                                            <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftres" name="ftres"> Fast Track
                                        </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check the box if this is a Fast Track reservation"></i>
                                            <div class="form-group col-xs-3"><!-- title selection -->
                                            <select class="form-control select" id="title-name" name="title_name">
                                                <option>Select title</option>
                                                <option>Mr</option>
                                                <option>Mrs</option>
                                                <option>Ms</option>
                                                <option>Dr</option>
                                                <option>Sir</option>
                                                <option>Lord</option>
                                                <option>Lady</option>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- Passenger name record field -->
                                        <input type="text" class="form-control" placeholder="Passenger name record (PNR)" id="pnr" name="pnr" value="">
                                    </div>
                                    
                                    <div class="form-group col-xs-7"><!-- tour operator selection -->                                       
                                            <?php include ('tour_oper_select.php'); ?>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- operator code field -->
                                        <input type="text" class="form-control" placeholder="operator code / brand" id="oper-code" name="oper_code" value="">
                                    </div>
                                    <div class="form-group col-xs-7"><!-- reference number field -->
                                        <input type="text" class="form-control" placeholder="reference number" id="tour-ref-no" name="tour_ref_no" value="">
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9"><!-- number of persons traveling -->
			                                    <input type="number" min=0 max=99 class="form-control" id="adults" name="adults" value="" placeholder="Select # of Adults"> Adult(s)
                                                <input type="number" min=0 max=99 class="left20 form-control" id="children" name="children" value="" placeholder="Select # of Children"> Children
                                                <input type="number" min=0 max=99 class="left20 form-control" id="infants" name="infants" value="" placeholder="Select # of Infants"> Infant(s)                                            
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-7">                                            
                                            <textarea class="form-control" rows="5" id="tour-notes" name="tour_notes" placeholder="additional comments and details here"></textarea>
                                        </div>
                                    </div>
                                    <hr />
                                <!-- guests -->
                                <h5>Add Guest <a href="#" class="addguest" rel=".guest"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Add Guest"></i></a></h5>
                                <div class="guest" style="margin-bottom: 15px;">
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-12"><!-- guest first name / guest last name fields -->
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Valid Titles: Mr | Mrs | Ms | Miss | Master | Dr | Sir | Lord | Lady"></i> <input type="text" class="form-control" placeholder="Title" id="guest-title-name" name="guest_title_name[]" value="">
                                            <input type="text" class="form-control right20 left20" placeholder="First name" id="guest-first-name" name="guest_first_name[]" value="">
                                            <input type="text" class="form-control right20" placeholder="Last name" id="guest-last-name" name="guest_last_name[]" value="">
                                            <input type="text" class="form-control" placeholder="Guest PNR" id="guest-pnr" name="guest_pnr[]" value="">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-7"><!-- guest first name / guest last name fields -->
                                        <label class="checkbox-inline right20 label_checkboxitem">
                                        <input class="icheckbox" type="checkbox" id="guest-adult" name="guest_adult[]"> Adult
                                        </label>
                                            <input type="number" min=0 max=11 class="form-control" id="child_age" name="child_age[]" value="" placeholder="Age of child - years"> Years
                                            <input type="number" min=0 max=23 class="left20 form-control" id="infant_age" name="infant_age[]" value="" placeholder="Age of infant - months"> Months
                                        </div>
                                    </div>
                                </div>
                                <!-- end guest -->
                                
                                <hr />
                                <h4>Arrival Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <div class="input-group date col-xs-4 right20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="arr_date" id="arr-date" placeholder="Arrival date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <select class="form-control" id="arr-flight-no" name="arr_flight_no">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <select class="form-control left20" id="arr-time" name="arr_time">
                                        <option value="0">Flight ETA [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <select class="form-control select" id="flight-class" name="flight_class">
                                        <option selected="true">Select flight class</option>
                                        <option>First Class</option>
                                        <option>Club Class</option>
                                        <option>Business Class</option>
                                        <option>Upper Class</option>
                                        <option>Premium Economy</option>
                                        <option>Economy</option>
                                        <option>World Traveller</option>
                                        <option>World Traveller Plus</option>
                                        </select> 
                                </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <?php include ('transport_mode_arr.php'); ?>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <select class="form-control" id="arr-driver" name="arr_driver">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <select class="form-control left20" id="arr-vehicle-no" name="arr_vehicle_no">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <textarea class="form-control" rows="5" id="arr-transport-notes" name="arr_transport_notes" placeholder="additional transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <select class="form-control" id="arr-pickup" name="arr_pickup">
                                        <option>Pickup Location</option>
                                        <option>Airport</option>
                                        <option>Seaport</option>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <select class="form-control" id="arr-dropoff" name="arr_dropoff">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- room type selection -->
                                    <select class="form-control" id="room-type" name="room_type">
                                        <option>Room Type</option>     
                                    </select>
                                </div>
                                 <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <textarea class="form-control" rows="5" id="arr-hotel-notes" name="arr_hotel_notes" placeholder="additional hotel comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- representation type selection -->
                                    <select class="form-control" id="rep-type" name="rep_type">
                                        <option>Representation</option>
                                        <option>Meet &amp; Greet</option>
                                        <option>Full Rep</option>
                                        <option>No Rep</option>
                                        <option>Intransit</option> 
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <div class="form-group col-xs-7 checkbox"><!-- additional requirements show -->
                                <label>
                                 <input type="checkbox" value="clientreqs"> Add Requirements
                                </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements and amount"></i>
                                <br /><br />
                                </div>
                                <div class="clientreqs reqs-box">
                                    <div class="form-group col-xs-7">                                        
                                        <select multiple class="form-control select" id="client-reqs" name="client_reqs[]">
                                            <option selected="true">Additional Requirements</option>
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
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9">
                                                <input type="number" min=0 max=99 class="right20 form-control" id="infant-seats" name="infant_seats" value="" placeholder="Infant Seats">
                                                <input type="number" min=0 max=99 class="form-control" id="child-seats" name="child_seats" value="" placeholder="Child Seats">
                                            </div>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9">
                                                <input type="number" min=0 max=99 class="right20 form-control" id="booster-seats" name="booster_seats" value="" placeholder="Booster Seats">
                                                <input type="number" min=0 max=99 class="right20 form-control" id="vouchers" name="vouchers" value="" placeholder="Lounge Vouchers">
                                            </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                <h4>Departure Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <div class="input-group date col-xs-3 right20" data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker"  name="dpt_date" id="dpt-date" placeholder="Departure date"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <select class="form-control" id="dpt-flight-no" name="dpt_flight_no">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <select class="form-control left20" id="dpt-time" name="dpt_time">
                                        <option value="0">Flight ETD [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                       
                                    <?php include ('transport_mode_dpt.php'); ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <select class="form-control" id="dpt-driver" name="dpt_driver">
                                        <?php echo $opt->ShowTransport(); ?>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <select class="form-control left20" id="dpt-vehicle-no" name="dpt_vehicle_no">
                                        <option value="0">Vehicle #</option>   
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <textarea class="form-control" rows="5" id="dpt-transport-notes" name="dpt_transport_notes" placeholder="additional transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                
                                    <div class="form-group col-xs-4"><!-- pickup location selection -->
                                        <?php include ('dpt_pickup_select.php'); ?>
                                    </div>
                                    <div class="form-group"><!-- pickup time -->
                                        <div class="input-group bootstrap-timepicker col-xs-3">
                                            <input type="text" class="form-control timepicker24" name="pickup_time" id="pickup-time" placeholder="Pickup time" value=""/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                        <?php include ('dpt_location_select.php'); ?>
                                    </div>    
                                <div class="form-group"><!-- departure notes -->
                                        <div class="col-xs-7">                                            
                                            <textarea class="form-control" rows="5" id="dpt-notes" name="dpt_notes" placeholder="additional comments and details here"></textarea>
                                        </div>
                                    </div>
                                <div class="panel-footer">
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addreservation" class="btn btn-primary" id="add" type="submit">Submit</button>
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
        <script type="text/javascript" src="js/relCopy.jquery.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->  
                
    </body>
</html>
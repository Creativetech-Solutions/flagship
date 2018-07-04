<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
  define("_VALID_PHP", true);
  require_once("../admin-panel-skb/init.php");
  
  if (!$user->levelCheck("2,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

/*echo '<pre>';
    var_dump($row);
echo '</pre>';
exit;*/
include ('ref.php');
include('header.php');
include ('select.class.php');
$fsref = $_GET['ref'];
$reservation_id = $_GET['reservation'];
if(isset($_GET['fsft_ref']))
    $fast_track_ref = $_GET['fsft_ref'];
$loggedinas = $row->fname . ' ' . $row->lname;
site_header('Add Arrival');


if(isset($_POST['addarrival']))
{
    //Sanitize data
    $arr_date           = QuoteSmart($_POST['arr_date']);
    $fast_track           = QuoteSmart($_POST['ftres']);
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
    $arr_transport_notes = QuoteSmart($_POST['arr_transport_notes']);
    $arr_hotel_notes = QuoteSmart($_POST['arr_hotel_notes']);
    $infant_seats       = QuoteSmart($_POST['infant_seats']);
    $child_seats        = QuoteSmart($_POST['child_seats']);
    $booster_seats      = QuoteSmart($_POST['booster_seats']);
    $vouchers           = QuoteSmart($_POST['vouchers']);
    $bottled_water = QuoteSmart($_POST['bottled_water']);
    $cold_towels = QuoteSmart($_POST['cold_towels']);
    $rooms       = QuoteSmart($_POST['no_of_rooms']);
    $room_no       = QuoteSmart($_POST['room_no']);
    
    $user_action = "add new arrival: #ref:$fsref";
    $fast_track = empty($fast_track) ? 0 : 1;
    $ftres = isset($_POST['ftres']) ? 1 : 0;
    if ($ftres > 0){
        $ftnotify = 1;
    }
   
        //Put all the remaining stuff into the database
	$sql = "INSERT INTO skb_arrivals ". 
        "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no, fast_track) ".
        "VALUES ('$fsref', '$arr_date', '$arr_time', '$arr_flight_no', '$flight_class', '$arr_transport', '$arr_driver', '$arr_vehicle_no', '$arr_pickup', '$arr_dropoff', '$room_type', '$rep_type', '$client_reqs', '$arr_transport_notes', '$arr_hotel_notes', '$infant_seats', '$child_seats', '$booster_seats', '$vouchers', '$cold_towels', '$bottled_water', '$rooms', '$room_no','$fast_track')";
        $retval = mysql_query( $sql, $conn );

    if(!empty(mysql_errno())){
        die(mysql_error());
    }
    
    //Update system log
    $sql_1 = "UPDATE skb_reservations ". 
        "SET modified_date = NOW(), modified_by = '$loggedinas'". 
        "WHERE ref_no_sys = '$fsref'";
        $retval1 = mysql_query( $sql_1, $conn );

    //If Error in mysql_query() then roll back;
    if(!empty(mysql_errno())){
        die(mysql_error());
    }
    
    //Log user action
    $sql_2 = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval2 = mysql_query( $sql_2, $conn );      
        
        
        if(!empty(mysql_errno()))
            {
                echo $sql_1;
                die('Could not enter data: ' . mysql_error());
            }

        mysql_close($conn);
        echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=5'</script>";

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
                    <li><a href="reservation-details.php?id=<?php echo $reservation_id; ?>">Reservation - <?php echo $fsref; ?></a></li>
                    <li class="active">Add Departure</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add-reservations" class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Arrival Details</strong></h3>
                                </div>
                                <div class="panel-body">                                                                        
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <label class="right20">Arrival Date</label>
                                        <div class="input-group date col-xs-4 right20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="arr_date" id="arr-date" placeholder="Arrival date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <!-- Fasttrack Checkbox-->
                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftres" name="ftres">
                                            Fast Track
                                        </label>
                                        <i class="fa fa-question-circle left20" data-toggle="tooltip"
                                                   data-placement="top" title="Check the box if this is a Fast Track reservation">
                                        </i>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label>Flight number</label>
                                    <select class="form-control" id="arr-flight-no" name="arr_flight_no">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label class="left20">Flight time</label>
                                    <select class="form-control left20" id="arr-time" name="arr_time">
                                        <option value="0">Flight ETA [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php include ('flightclass_select.php'); ?>
                                </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <label>Transport mode</label>
                                    <?php include ('transport_mode_arr.php'); ?>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="arr-driver" name="arr_driver">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="arr-vehicle-no" name="arr_vehicle_no">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Arrival &amp; Transport notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-transport-notes" name="arr_transport_notes" placeholder="Arrival &amp; Transportation notes: additional arrival &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <?php include ('arr_pickup_select.php'); ?>
                                </div>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label>Dropoff Location</label>
                                    <select class="form-control" id="arr-dropoff" name="arr_dropoff">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-3"><!-- room type selection -->
                                    <label>Room type</label>
                                    <select class="form-control" id="room-type" name="room_type">
                                        <option>Room Type</option>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-2"><!-- room number -->
                                    <label class="left20 right20">Room number</label>
                                    <input class="form-control left20" id="room-no" name="room_no" placeholder="Room number">
                                </div>
                                <div class="form-group col-xs-2"><!-- number of rooms -->
                                    <label style="margin-left: 40px;">Number of Rooms</label>
                                    <input type="number" min=0 max=99 class="form-control" style="margin-left: 40px;" id="no-of-rooms" name="no_of_rooms" value="" placeholder="Number of Rooms">
                                </div>
                                 <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Hotel notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-hotel-notes" name="arr_hotel_notes" placeholder="Hotel notes: additional hotel comments and details here"></textarea>
                                    </div>
                                 </div>

                                    <?php if(isset($fast_track_ref) && !$fast_track_ref){
                                        ?>
                                        <div class="form-group col-xs-7"><!-- representation type selection -->
                                            <label>Representation Type</label>
                                            <select multiple class="form-control rep-type" id="rep_type" name="rep_type[]">
                                                <option value="0">Select Representation</option>
                                                <?php include ('reptype_select_multiple.php'); ?>
                                            </select>
                                        </div>
                                    <?php
                                    }
                                    ?>
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
                                       <?php include ('clientreqs_select.php'); ?>
                                        <span class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9">
                                                <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control" id="cold-towels" name="cold_towels" value="" placeholder="Cold Towels">
                                                <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control" id="bottled-water" name="bottled_water" value="" placeholder="Bottled Water">
                                                <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control" id="vouchers" name="vouchers" value="" placeholder="Vouchers">
                                            </div>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9">
                                                <label class="right20">Infant Seats</label><input type="number" min=0 max=99 class="right20 form-control" id="infant-seats" name="infant_seats" value="" placeholder="Infant Seats">
                                                <label class="right20">Child Seats</label><input type="number" min=0 max=99 class="right20 form-control" id="child-seats" name="child_seats" value="" placeholder="Child Seats">
                                                <label class="right20">Booster Seats</label><input type="number" min=0 max=99 class="form-control" id="booster-seats" name="booster_seats" value="" placeholder="Booster Seats">
                                            </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addarrival" class="btn btn-primary" id="add" type="submit">Submit</button>
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
        </div>
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
        
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/relCopy.jquery.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
<script type="text/javascript">
    $('.rep-type').select2();
</script>
        <?php 
$ok= isset($_GET['ok']);
if($ok)  {
    echo '<script> alert("Reservation successfully added"); </script>';
    }
    ?>        
    </body>
</html>
<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-skb/init.php");
  
  if (!$user->levelCheck("2,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
ob_start();
/**
 * @author Alvin Herbert
 * @copyright 2015
 */
if(isset($_REQUEST['sect']) && !empty($_REQUEST['sect'])){
    $section = $_REQUEST['sect'];
} else {
    $section = 'gh';
}
include('header.php');
include('select.class.php');
$loggedinas = $row->fname . ' ' . $row->lname;
$reservation_id = $_GET['reservation'];
$reservation = mysql_fetch_row(mysql_query("SELECT * FROM skb_departures WHERE id='" . QuoteSmart($_GET['departure_id']) . "'"));
$get_dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM skb_flights WHERE id_flight='" . $reservation[4] . "'"));
$get_dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM skb_flighttime WHERE id_fltime='" . $reservation[3] . "'"));
$get_dptpickup = mysql_fetch_row(mysql_query("SELECT * FROM skb_location WHERE id_location='" . $reservation[9] . "'"));  
$get_dptdropoff = mysql_fetch_row(mysql_query("SELECT * FROM skb_location WHERE id_location='" . $reservation[10] . "'"));
$get_dpt_driver = mysql_fetch_row(mysql_query("SELECT * FROM skb_transport WHERE id_transport='" . $reservation[7] . "'"));
$get_dpt_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM skb_vehicles WHERE id_vehicle='" . $reservation[8] ."'"));
$get_flightclass = mysql_fetch_row(mysql_query("SELECT * FROM skb_flightclass WHERE id='" . $reservation[5] . "'"));
$get_reptype = mysql_fetch_row(mysql_query("SELECT * FROM skb_reptype WHERE id='" . $reservation[12] . "'"));
$flagship_ref = $reservation[1];

$selectedFastTrack = $reservation[16];

$transport_arr = mysql_query("SELECT * FROM skb_resdrivers WHERE ref_no_sys='$flagship_ref' AND res_type=1");
$dpt_count = mysql_numrows($transport_arr);

//Get tour operator list
$classselect = mysql_query("SELECT * FROM skb_flightclass ORDER BY class ASC");
$dptlocationselect = mysql_query("SELECT * FROM skb_location ORDER BY name ASC");
$reptypeselect = mysql_query("SELECT * FROM skb_reptype ORDER BY id ASC");
$roomtypeselect = mysql_query("SELECT * FROM skb_roomtypes WHERE id_location='" . $reservation[10] . "' ORDER BY id_room ASC");

$iamstatus = "";
$vouchers = $reservation[17];
$cold_towel = $reservation[18];
$bottled_water = $reservation[19];
//echo '<pre>'; print_r($reservation); exit;
if(!$reservation) {
    echo "<script>window.location='view-reservations.php'</script>";
	exit;
}
site_header('Departure Details');

if(isset($_POST['update']))
{

//Sanitize data

    $dpt_date           = QuoteSmart($_POST['dpt_date']);
    $dpt_time           = QuoteSmart($_POST['dpt_time']);
    $dpt_flight_no      = QuoteSmart($_POST['dpt_flight_no']);
    $flight_class       = QuoteSmart($_POST['dpt_flight_class']);
    $dpt_transport      = QuoteSmart(implode(', ',$_POST['dpt_transport']));
    $dpt_driver         = QuoteSmart($_POST['dpt_driver']);
    $dpt_vehicle_no     = QuoteSmart($_POST['dpt_vehicle_no']);
    $dpt_pickup         = QuoteSmart($_POST['dpt_pickup']);
    $dpt_pickup_time         = QuoteSmart($_POST['pickup_time']);
    $dpt_dropoff        = QuoteSmart($_POST['dpt_dropoff']);   
    $dpt_transport_notes = QuoteSmart($_POST['dpt_transport_notes']);     
    $dpt_vouchers = QuoteSmart($_POST['dpt_vouchers']);     
    $dpt_cold_towels = QuoteSmart($_POST['dpt_cold_towels']);     
    $dpt_bottled_water = QuoteSmart($_POST['dpt_bottled_water']);     
    $user_action = "update arrival details: #ref:$flagship_ref";

    if($section == 'gh'){
         $ftres = empty($_POST['ftres']) ? 0 : 1;
        if ($ftres > 0){
            $ftnotify = 1;
        } else {
            $ftnotify = 0;
        }
    }
   // echo $ftnotify; exit;
    $sql = "UPDATE skb_departures ".
    "SET dpt_date = '$dpt_date', dpt_time = '$dpt_time', dpt_flight_no = '$dpt_flight_no', flight_class = '$flight_class', dpt_transport = '$dpt_transport', dpt_driver = '$dpt_driver', dpt_vehicle = '$dpt_vehicle_no', dpt_pickup = '$dpt_pickup', dpt_dropoff = '$dpt_dropoff', dpt_pickup_time = '$dpt_pickup_time', dpt_transport_notes = '$dpt_transport_notes'";
    if($section == 'gh') 
        $sql .= ", dpt_vouchers = '$dpt_vouchers', dpt_cold_towel = '$dpt_cold_towels', dpt_bottled_water = '$dpt_bottled_water', fast_track = '$ftnotify'";
    $sql .= " WHERE id = '$reservation[0]'";
    $retval = mysql_query( $sql, $conn );
    
    if ($reservation[14] == 1){
    $sql_1 = "UPDATE skb_reservations ".
    "SET dpt_date = '$dpt_date', dpt_time = '$dpt_time', dpt_flight_no = '$dpt_flight_no', flight_class = '$flight_class', dpt_transport = '$dpt_transport', dpt_driver = '$dpt_driver', dpt_vehicle = '$dpt_vehicle_no', dpt_pickup = '$dpt_pickup', dpt_dropoff = '$dpt_dropoff', dpt_pickup_time = '$dpt_pickup_time', dpt_transport_notes = '$dpt_transport_notes'";
    if($section == 'gh'){
        $sql_1 .= ", dpt_vouchers = '$dpt_vouchers', dpt_cold_towel = '$dpt_cold_towels', dpt_bottled_water = '$dpt_bottled_water'";
    }
    
    $sql_1 .= " WHERE ref_no_sys = '$reservation[1]'";
    $retval1 = mysql_query( $sql_1, $conn );
    } 
    if($ftnotify == 1){
        $sql_12 = "UPDATE skb_reservations SET `ftnotify` = 1 WHERE ref_no_sys = '$reservation[1]'";
        mysql_query( $sql_12, $conn );
    }
    //Log user action
    $sql_2 = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval2 = mysql_query( $sql_2, $conn );  
    
    //Update system log
    $sql_3 = "UPDATE skb_reservations ". 
        "SET modified_date = NOW(), modified_by = '$loggedinas'". 
        "WHERE ref_no_sys = '$reservation[1]'";
        $retval3 = mysql_query( $sql_3, $conn );     
        
        if(!$retval)
            {
                die('Could not enter data: ' . mysql_error());
            }
            if($section == 'fsft')
                echo "<script>window.location='ftreservation-details.php?id=".$reservation_id."&ok=5'</script>";
            else 
                echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=5'</script>";        
        mysql_close($conn);
        
	}
    ob_end_flush();
?>

                    
                    <script type="text/javascript">
                                    $(document).ready(function(){
                                        //$("#dpt-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#dpt-driver").change(function(){
                                            $("#dpt-vehicle-no").attr("disabled","disabled");
                                            $("#dpt-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#dpt-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#dpt-vehicle-no").removeAttr("disabled");
                                                $("#dpt-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        
                                        //$("#dpt-time").attr("disabled","disabled");
                                        
                                        $("#dpt-flight-no").change(function(){
                                            $("#dpt-time").attr("disabled","disabled");
                                            $("#dpt-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#dpt-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#dpt-time").removeAttr("disabled");
                                                $("#dpt-time").html(data);
                                                
                                            });
                                        });
                                        
                                        //$("#room-type").attr("disabled","disabled");
                                        
                                        $("#dpt-dropoff").change(function(){
                                            $("#room-type").attr("disabled","disabled");
                                            $("#room-type").html("<option>Loading rooms ...</option>");
                                        
                                            var locationid = $("#dpt-dropoff option:selected").attr('value');
                                        
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
                    <li>Reservations</li>
                    <li><a href="view-reservations-arr.php">View Reservations</a></li>
                    <li class="active"><a href="reservation-details.php?id=<?php echo $reservation_id; ?>">Reservation - <?php echo $reservation[1]; ?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Viewing arrival details for <?php echo $reservation[1]; ?></strong></h3>
                                </div>

                                <div class="panel-body">                                                                        
                                <!-- end arrival details -->
                                <h4>Departure Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <div class="input-group date col-xs-3 right20" data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker"  name="dpt_date" id="dpt-date" placeholder="Departure date" value="<?php echo $reservation[2]; ?>"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                        <?php if($section == 'gh'){?>
                                        <!-- Fasttrack Checkbox-->
                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftres" name="ftres" value="1"
                                            <?php if(empty($selectedFastTrack) || $selectedFastTrack==0) echo ''; else echo 'checked="checked"'?>>
                                            Fast Track
                                        </label>
                                        <i class="fa fa-question-circle left20" data-toggle="tooltip"
                                           data-placement="top" title="Check the box if this is a Fast Track reservation">
                                        </i>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <select class="form-control" id="dpt-flight-no" name="dpt_flight_no">
                                        <option value="<?php echo $get_dpt_flight_no[0]; ?>"><?php echo $get_dpt_flight_no[1]; ?></option>
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <select class="form-control left20" id="dpt-time" name="dpt_time">
                                        <option value="<?php echo $get_dpt_time[0]; ?>"><?php echo $get_dpt_time[2]; ?></option>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- departure flight class selection -->                                     
                                            <?php
                                            // Error handling for classselect
                                            if($classselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                            
                                            //Show selected flight class and list all the others 
                                            echo '<select class="form-control select" id="dpt_flight-class" name="dpt_flight_class">
                                            <option>flight class not specified</option>';
                                            while ($row = mysql_fetch_array($classselect)) {
                                                if ($row['id'] == $get_flightclass[0]) {
                                                echo "<option value='" . $row['id'] . "' selected>" . $row['class'] . "</option>";
                                                } else {
                                                echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                                }
                                            }
                                                echo "</select>"
                                            ?>
                                </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <?php
                                    $sql = "SELECT * FROM skb_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select multiple class="form-control select" id="dpt-transport" name="dpt_transport[]">
                                    <option selected="true">' . $reservation[6] . '</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <select class="form-control" id="dpt-driver" name="dpt_driver">
                                        <option value="<?php echo $get_dpt_driver[0] ?>"><?php echo $get_dpt_driver[1]; ?></option>
                                        <?php echo $opt->ShowTransport(); ?>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <select class="form-control left20" id="dpt-vehicle-no" name="dpt_vehicle_no">
                                        <option value="<?php echo $get_dpt_vehicle[0] ?>"><?php echo $get_dpt_vehicle[2]; ?></option> 
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <textarea class="form-control" rows="5" id="dpt-transport-notes" name="dpt_transport_notes" placeholder="Departure & Transportation notes: additional departure & transport comments and details here"><?php echo $reservation[13]; ?></textarea>
                                    </div>
                                 </div>
                                <div class="clearfix"></div>
                                    <div class="form-group col-xs-4"><!-- pickup location selection -->
                                        <?php
                                            // Error handling for dptlocationselect
                                            if($dptlocationselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                             
                                            echo '<select class="form-control select" id="dpt-pickup" name="dpt_pickup">';
                                             //Show selected location and list all the others 
                                            while ($row = mysql_fetch_array($dptlocationselect)) {
                                                if ($row['id_location'] == $get_dptpickup[0]) {
                                                echo "<option value='" . $row['id_location'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                                }
                                            }
                                                echo "</select>"
                                            ?>
                                    </div>
                                    <div class="form-group"><!-- pickup time -->
                                        <div class="input-group bootstrap-timepicker col-xs-3">
                                            <input type="text" class="form-control timepicker24" name="pickup_time" id="pickup-time" placeholder="Pickup time" value="<?php echo $reservation[11]; ?>"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                        <?php
                                            // Error handling for dptlocationselect
                                            if($dptlocationselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                            
                                            echo '<select class="form-control select" id="dpt-dropoff" name="dpt_dropoff">';
                                            //reset dptlocationselect for second loop
                                            mysql_data_seek($dptlocationselect, 0);
                                             //Show selected location and list all the others 
                                            while ($row = mysql_fetch_array($dptlocationselect)) {
                                                if ($row['id_location'] == $get_dptdropoff[0]) {
                                                echo "<option value='" . $row['id_location'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                                }
                                            }
                                                echo "</select>"
                                            ?>
                                    </div>   
                                    <?php if($section == 'gh') { ?>
                                    <div class="form-group col-lg-12">
                                        <label>Add Requirements
                                        </label>
                                    </div>
                                    <div class="form-group dpt_clientreqs">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="dpt_vouchers" name="dpt_vouchers" value="<?=$vouchers?>" placeholder="Vouchers">
                                            <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_cold-towels" name="dpt_cold_towels" value="<?=$cold_towel?>" placeholder="Cold Towels">
                                            <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_bottled-water" name="dpt_bottled_water" value="<?=$bottled_water?>" placeholder="Bottled Water">
                                        </div>
                                    </div> 
                                    <?php } ?>
                                <div class="panel-footer">
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>
                                    <button class="btn btn-default right20" onclick="goBack()" type="button">Exit</button>
                                    <button name="update" class="btn btn-warning" id="update" type="submit">Update</button>
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
        <!--<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>-->
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
        <!-- END THIS PAGE PLUGINS -->       
        
        <!-- START TEMPLATE -->      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>

<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->
        <?php
            if(isset($_GET['ok'])){
                $ok = $_GET['ok'];
            if($ok == 1)  {
                echo '<script> alert("Reservation successfully updated"); </script>';
            } elseif ($ok == 2) {
                echo '<script> alert("Guest successfully added"); </script>';
                } elseif ($ok == 3) {
					echo '<script> alert("Guest successfully updated"); </script>';
					} elseif ($ok == 4) {
						echo '<script> alert("Guest successfully removed"); </script>';
						}
            }
        ?> 
    </body>
</html>
<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
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

    $fast_track_ref = $_GET['fsft_ref'];
//check ftnotify , that if that reservation is both in f
/*$ftnotify = mysql_fetch_row(mysql_query("SELECT `ftnotify` FROM bgi_reservations WHERE id = '$reservation_id'"));
if(isset($ftnotify[0])) $ftnotify = $ftnotify[0]; 
else $ftnotify='';*/
$getArrivalQuery = "SELECT * FROM bgi_arrivals WHERE id='" . QuoteSmart($_GET['arrival_id']) . "'";
//$reservation = mysql_fetch_row(mysql_query($getArrivalQuery));
$reservation = mysql_fetch_row(mysql_query($getArrivalQuery));
$get_arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $reservation[4] . "'"));
$get_arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $reservation[3] . "'"));
$get_arr_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $reservation[9] . "'"));  
$get_arr_location = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $reservation[10] . "'"));
$get_arr_roomtype = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $reservation[11] . "'"));  
$get_arr_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $reservation[7] . "'"));
$get_arr_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM skb_vehicles WHERE id_vehicle='" . $reservation[8] ."'"));
$get_flightclass = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $reservation[5] . "'"));
$selectedFastTrack = $reservation[26];

//Need to get rep type.
$repTypeQuery = "SELECT * FROM bgi_reptype WHERE id IN (" . $reservation[12] . ")";
$get_reptype = mysql_query($repTypeQuery);
$selectedRepTypesArray = array();
while($repTypeRow=mysql_fetch_array($get_reptype)){
    $selectedRepTypesArray[] = $repTypeRow['id'];
}


$excursion_name = $reservation[27];
$excursion_date = $reservation[28];
$excursion_pickup = $reservation[29];
$excursion_confirm_by = $reservation[30];
$excursion_confirm_date = $reservation[31];
$excursion_guests = $reservation[32];

$flagship_ref = $reservation[1];
$transport_arr = mysql_query("SELECT * FROM bgi_resdrivers WHERE ref_no_sys='$flagship_ref' AND res_type=1");
$arr_count = mysql_numrows($transport_arr);

//Get tour operator list
$classselect = mysql_query("SELECT * FROM bgi_flightclass ORDER BY class ASC");
$reptypeselect = mysql_query("SELECT * FROM bgi_reptype ORDER BY id ASC");
$roomtypeselect = mysql_query("SELECT * FROM bgi_roomtypes WHERE id_location='" . $reservation[10] . "' ORDER BY id_room ASC");

if(!$reservation) {
    echo "<script>window.location='view-reservations.php'</script>";
	exit;
}
site_header('Arrival Details');
if(isset($_POST['update']))
{

//Sanitize data

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
    $rep_type           = QuoteSmart(implode(', ',$_POST['rep_type']));
    $client_reqs        = QuoteSmart(implode(', ',$_POST['client_reqs']));
    $infant_seats       = QuoteSmart($_POST['infant_seats']);
    $child_seats        = QuoteSmart($_POST['child_seats']);
    $booster_seats      = QuoteSmart($_POST['booster_seats']);
    $vouchers           = QuoteSmart($_POST['vouchers']);
    $bottled_water      = QuoteSmart($_POST['bottled_water']);
    $cold_towels        = QuoteSmart($_POST['cold_towels']);
    $arr_transport_notes = QuoteSmart($_POST['arr_transport_notes']);
    $arr_hotel_notes     = QuoteSmart($_POST['arr_hotel_notes']);
    $rooms       = QuoteSmart($_POST['no_of_rooms']);
    $room_no       = QuoteSmart($_POST['room_no']);        
    $room_lastname       = QuoteSmart($_POST['arr0_room_last_name']);        
    $user_action = "update arrival details: #ref:$flagship_ref";
   // echo '<pre>'; print_r($_POST); echo '</pre>'; exit;
    if($section == 'gh'){
        //Excursion
        $excursion_name = QuoteSmart(@$_POST['excursion_name']);
        $excursion_date = QuoteSmart(@$_POST['excursion_date']);
        $excursion_pickup = QuoteSmart(@$_POST['excursion_pickup']);
        $excursion_confirm_by = QuoteSmart(@$_POST['excursion_confirm_by']);
        $excursion_confirm_date = QuoteSmart(@$_POST['excursion_confirm_date']);
        $excursion_guests = QuoteSmart(@$_POST['excursion_guests']);


         $ftres = empty($_POST['ftres']) ? 0 : 1;
        if ($ftres > 0){
            $ftnotify = 1;
        } else {
            $ftnotify = 0;
        }
    }
   
    
    $sql = "UPDATE bgi_arrivals ".
    "SET arr_date = '$arr_date', arr_time = '$arr_time', arr_flight_no = '$arr_flight_no', flight_class = '$flight_class', arr_transport = '$arr_transport', arr_driver = '$arr_driver', arr_vehicle = '$arr_vehicle_no', arr_pickup = '$arr_pickup', arr_dropoff = '$arr_dropoff', room_type = '$room_type', rep_type = '$rep_type', client_reqs = '$client_reqs', arr_transport_notes = '$arr_transport_notes', arr_hotel_notes = '$arr_hotel_notes', infant_seats = '$infant_seats', child_seats = '$child_seats', booster_seats = '$booster_seats', vouchers = '$vouchers', cold_towel = '$cold_towels', bottled_water = '$bottled_water', rooms = '$rooms', room_no = '$room_no', room_last_name = '$room_lastname'";
    if($section == 'gh') {
        $sql .= ", excursion_name = '$excursion_name', excursion_date = '$excursion_date', excursion_pickup = '$excursion_pickup', excursion_confirm_by = '$excursion_confirm_by', excursion_confirm_date = '$excursion_confirm_date', excursion_guests = '$excursion_guests'  , fast_track = '$ftnotify'";
    }
    $sql .= " WHERE id = '$reservation[0]'";
    $retval = mysql_query( $sql, $conn );

    //check if its main arrival.
    if ($reservation[24] == 1){
    $sql_1 = "UPDATE bgi_reservations ".
    "SET arr_date = '$arr_date', arr_time = '$arr_time', arr_flight_no = '$arr_flight_no', flight_class = '$flight_class', arr_transport = '$arr_transport', arr_driver = '$arr_driver', arr_vehicle = '$arr_vehicle_no', arr_pickup = '$arr_pickup', arr_dropoff = '$arr_dropoff', room_type = '$room_type', rep_type = '$rep_type', client_reqs = '$client_reqs', arr_transport_notes = '$arr_transport_notes', arr_hotel_notes = '$arr_hotel_notes', infant_seats = '$infant_seats', child_seats = '$child_seats', booster_seats = '$booster_seats', vouchers = '$vouchers', cold_towel = '$cold_towels', bottled_water = '$bottled_water', rooms = '$rooms', room_no = '$room_no'";
    

    $sql_1 .= "WHERE ref_no_sys = '$reservation[1]'";
    $retval1 = mysql_query( $sql_1, $conn );
    }
     if($ftnotify == 1){
        $sql_12 = "UPDATE bgi_reservations SET `ftnotify` = 1 WHERE ref_no_sys = '$reservation[1]'";
        mysql_query( $sql_12, $conn );
    }
    
    //Log user action
    $sql_2 = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval2 = mysql_query( $sql_2, $conn ); 
       
   //Update system log
    $sql_3 = "UPDATE bgi_reservations ". 
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
                                        //$("#arr-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#arr-driver").change(function(){
                                            $("#arr-vehicle-no").attr("disabled","disabled");
                                            $("#arr-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#arr-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#arr-vehicle-no").removeAttr("disabled");
                                                $("#arr-vehicle-no").html(data);
                                            });
                                        });
                                        
                                        //$("#arr-time").attr("disabled","disabled");
                                        
                                        $("#arr-flight-no").change(function(){
                                            $("#arr-time").attr("disabled","disabled");
                                            $("#arr-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#arr-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#arr-time").removeAttr("disabled");
                                                $("#arr-time").html(data);
                                                
                                            });
                                        });
                                        
                                        //$("#room-type").attr("disabled","disabled");
                                        
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
                                <h4>Arrival Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <?php if(empty($reservation[2]) || $reservation[2] == '0000-00-00'){
                                                $reservation[2] = date('Y-m-d');
                                            }; ?>
                                        <div class="input-group date col-xs-3 right20" data-date-format="mm-dd-yyyy">
                                                <label for="arr-date">Arrival Date</label>
                                                <input type="text" class="form-control datepicker" name="arr_date" id="arr-date" placeholder="Arrival date" value="<?php echo $reservation[2]; ?>"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
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
                                    <label for="arr-flight-no">Select Flight</label>
                                    <select class="form-control" id="arr-flight-no" name="arr_flight_no">
                                        <option value="<?php echo $get_arr_flight_no[0]; ?>"><?php echo $get_arr_flight_no[1]; ?></option>
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label for="arr-time">Select Flight Time</label>
                                    <select class="form-control left20" id="arr-time" name="arr_time">
                                        <option value="<?php echo $get_arr_time[0]; ?>"><?php echo $get_arr_time[2]; ?></option>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- arrival flight class selection -->
                                    <label for="flight-class">Flight Class</label>
                                            <?php
                                            // Error handling for classselect
                                            if($classselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                            
                                            //Show selected flight class and list all the others 
                                            echo '<select class="form-control select" id="flight-class" name="flight_class">
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
                                    <label for="arr-transport">Transport mode</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="arr-transport" name="arr_transport[]">';
                                    echo '<option>Transportation Mode</option>';
                                    if(!empty($reservation[6]))
                                    echo '<option selected="true">' . $reservation[6] . '</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label for="arr-driver">Transport Supplier</label>
                                    <select class="form-control" id="arr-driver" name="arr_driver">
                                    <?php if(!empty($get_arr_driver[1])) { ?>
                                        <option value="<?php echo $get_arr_driver[0]; ?>"><?php echo $get_arr_driver[1]; ?></option>
                                        <?php } ?>
                                        <?php echo $opt->ShowTransport(); ?>   
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label for="arr-vehicle-no">Vehicle</label>
                                    <select class="form-control left20" id="arr-vehicle-no" name="arr_vehicle_no">
                                    <?php if(!empty($get_arr_vehicle[2])) 
                                            $veh = $get_arr_vehicle[2];
                                           else 
                                            $veh = 'Vehicle';
                                       ?>
                                        <option value="<?php echo $get_arr_vehicle[0]; ?>">
                                        <?php echo $veh; ?>
                                        </option> 
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label for="arr-transport-notes">Arrival & Transport notes</label>
                                        <textarea class="form-control" rows="5" id="arr-transport-notes" name="arr_transport_notes" placeholder="Arrival & transportation notes: additional arrival & transport comments and details here"><?php echo $reservation[14]; ?></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <label for="arr-pickup">Pickup Location</label>
                                    <select class="form-control" id="arr-pickup" name="arr_pickup">
                                        <option <?php echo ($get_arr_pickup[0] == '') ? 'selected="selected"' : ''; ?>>Pickup Location</option>
                                        <option <?php echo ($get_arr_pickup[0] == '56') ? 'selected="selected"' : ''; ?>>Airport</option>
                                        <option <?php echo ($get_arr_pickup[0] == '57') ? 'selected="selected"' : ''; ?>>Seaport</option>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="arr-dropoff">Dropoff Location</label>
                                    <select class="form-control select2" id="arr-dropoff" name="arr_dropoff">
                                        <option value="<?php echo $get_arr_location[0]; ?>"><?php echo $get_arr_location[1]; ?></option>
                                        <?php echo $opt->ShowLocation(); ?>    
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-7"><!-- number of rooms -->
                                    <label for="no-of-rooms">Number of Rooms</label>
                                    <input type="number" min=0 max=99 class="form-control" id="no-of-rooms" name="no_of_rooms" value="<?php echo $reservation[22]; ?>" placeholder="Number of Rooms">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-3" style="margin-right: 10px !important;"><!-- room type selection -->
                                    <label for="room-type">Room Type</label>
                                  <select class="form-control" id="room-type" name="room_type">
                                      <?php
                                      if(isset($roomtypeselect) and !empty($roomtypeselect)){
                                          while ($row = mysql_fetch_assoc($roomtypeselect)){
                                              echo "<option value='".$row['id_room']."'".((isset($get_arr_roomtype[0]) and ($get_arr_roomtype[0] == $row['id_room']))?' selected="selected" ':'').">".$row['room_type']."</option>";
                                          }
                                      }
                                      ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-2" style="margin-right: 10px !important;"><!-- room number -->
                                    <label class="" for="room-no">Room Number</label>
                                    <input class="form-control right20" id="room-no" name="room_no" placeholder="Room number" value="<?php echo $reservation[23]; ?>">
                                </div>
                                <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                    <label class="right20">Last Name</label>
                                    <input class="form-control" id="arr0_room_last_name" name="arr0_room_last_name" placeholder="Guest Last Name" value="<?=$reservation[34]?>">
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label for="arr-hotel-notes">Hotel Notes</label>
                                        <textarea class="form-control" rows="5" id="arr-hotel-notes" name="arr_hotel_notes" placeholder="Hotel notes: additional hotel comments and details here"><?php echo $reservation[15]; ?></textarea>
                                    </div>
                                 </div>

                                    <?php
                                    if(!$fast_track_ref){
                                        ?>
                                        <div class="form-group col-xs-7"><!-- representation type selection -->
                                            <label for="rep-type">Representation Type</label>
                                            <?php
                                            // Error handling for classselect
                                            if($classselect === FALSE) {
                                                die(mysql_error());
                                            }

                                            //Show selected flight class and list all the others
                                            echo '<select multiple class="form-control rep-type" id="rep-type" name="rep_type[]">';
                                            while ($row = mysql_fetch_array($reptypeselect)) {
                                                if (in_array($row['id'],$selectedRepTypesArray)) {
                                                    echo "<option value='" . $row['id'] . "' selected='selected'>" . $row['rep_type'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row['id'] . "'>" . $row['rep_type'] . "</option>";
                                                }
                                            }
                                            echo "</select>";
                                            ?>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                <div class="clearfix"></div>
                                <div class="form-group col-xs-7">                                        
                                        <select multiple class="form-control select" id="client-reqs" name="client_reqs[]">                                      
                                            <option selected><?php echo $reservation[13]; ?></option>
                                            <?php
                                            $sql = "SELECT * FROM bgi_clientreqs";
                                            if($section == 'gh'){
                                                $sql .= " WHERE section = 0 OR section = 2";
                                            }
                                            $sql .=" ORDER BY id ASC";
                                            $result = mysql_query($sql);
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['reqs'] . "'>" . $row['reqs'] . "</option>";
                                                };
                                            ?>
                                        </select>
                                        <span class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>  
                                </div>
                                <div class="form-group">                                         
                                            <div class="form-inline col-xs-9">
                                                <label class="right20" for="cold-towels">Cold Towels</label>
                                                <input type="number" min=0 max=99 class="right20 form-control" id="cold-towels" name="cold_towels" value="" placeholder="Cold Towels" value="<?php echo $reservation[20]; ?>">
                                                <label class="right20" for="bottled-water">Bottled Water</label>
                                                <input type="number" min=0 max=99 class="right20 form-control" id="bottled-water" name="bottled_water" value="" placeholder="Bottled Water" value="<?php echo $reservation[21]; ?>">
                                                <label class="right20" for="vouchers">Vouchers</label>
                                                <input type="number" min=0 max=99 class="form-control" id="vouchers" name="vouchers" value="" placeholder="Vouchers" value="<?php echo $reservation[19]; ?>">
                                            </div>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-9">
                                                <label for="infant-seats" class="right20">Infant Seats</label>
                                                <input type="number" min=0 max=99 class="right20 form-control" id="infant-seats" name="infant_seats" value="" placeholder="Infant Seats" value="<?php echo $reservation[16]; ?>">
                                                <label for="child-seats" class="right20">Child Seats</label>
                                                <input type="number" min=0 max=99 class="right20 form-control" id="child-seats" name="child_seats" value="" placeholder="Child Seats" value="<?php echo $reservation[17]; ?>">
                                                <label for="booster-seats" class="right20">Booster Seats</label>
                                                <input type="number" min=0 max=99 class="form-control" id="booster-seats" name="booster_seats" value="" placeholder="Booster Seats" value="<?php echo $reservation[18]; ?>">
                                            </div>
                                    </div>
                                    <?php 
                                        if($section == 'gh'){ 
                                            // set excursion date
                                                if(!empty($excursion_date)){
                                                    $exDate = date('Y',strtotime($excursion_date));
                                                    if($exDate <= '1990')
                                                        $exDate = '';
                                                    else 
                                                        $exDate = date('Y-m-d',strtotime($excursion_date));
                                                } else 
                                                    $exDate = $excursion_date;

                                                 // set date of conifrm 
                                                if(!empty($excursion_confirm_date)){
                                                    $exConfDate = date('Y',strtotime($excursion_confirm_date));
                                                    if($exConfDate <= '1990')
                                                        $exConfDate = '';
                                                    else 
                                                        $exConfDate = date('Y-m-d',strtotime($excursion_confirm_date));
                                                } else 
                                                    $exConfDate = $excursion_confirm_date;   
                                            ?>
                                            <div class="form-group"> 
                                                <div class="form-inline col-xs-6 col-sm-12">
                                                    <label class="right20">Excursion Name</label><input type="text" class="right20 form-control" id="excursion_name" name="excursion_name" placeholder="Excursion Name" value="<?=$excursion_name?>">
                                                    <label class="right20">Excursion Date</label><input type="text" class="right20 form-control datepicker" id="excursion_date" name="excursion_date" placeholder="Excursion Date" value="<?=$exDate?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inline col-xs-6 col-sm-12">
                                                    <label class="right20">Pickup Time</label><input type="text" class="form-control timepicker24" id="pickup_time" name="excursion_pickup" placeholder="Pickup Time" value="<?=$excursion_pickup?>">
                                                    <label class="right20">Confirmed By Whom</label><input type="text" class="form-control" id="excursion_confirm_by" name="excursion_confirm_by" placeholder="Confirmed By Whom" value="<?=$excursion_confirm_by?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-inline col-xs-6 col-sm-12">
                                                    <label class="right20">Date of Confirmation</label><input type="text" class="form-control datepicker" id="excursion_confirm_date" name="excursion_confirm_date" placeholder="Excursion Confirm Date" value="<?=$exConfDate?>">
                                                    <label class="right20">Number of Guests</label><input type="number" class="form-control" id="excursion_guests" name="excursion_guests" placeholder="Number of Guests" value="<?=$excursion_guests?>">
                                                </div>
                                            </div>
                                        <?php }
                                    ?>
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
<!--Select2-->
<script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
        <!-- END THIS PAGE PLUGINS -->       
        
        <!-- START TEMPLATE -->      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
        <!-- END SCRIPTS -->

<script type="text/javascript">
    $(function () {
        $('.rep-type').select2();
    });
     $('.select2').select2({
        minimumInputLength: 3
    });

    $('.timepicker24').timepicker({
        defaultTime: '',
        showMeridian:false
    });
</script>

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
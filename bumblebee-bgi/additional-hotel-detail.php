<?php
$url = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
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

$getArrivalQuery = "SELECT * FROM bgi_additional_hotels WHERE id='" . QuoteSmart($_GET['ad_hotel_id']) . "'";

$reservation = mysql_fetch_row(mysql_query($getArrivalQuery));
$get_location = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $reservation[2] . "'"));
$get_roomtype = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $reservation[4] . "'"));  

// get rooms against that arrival
$adHotelId = $_GET['ad_hotel_id'];
$adHotelRooms = mysql_query("SELECT * FROM bgi_hotel_rooms WHERE ad_hotel_id ='" . $adHotelId . "'");
$tot_rooms = mysql_affected_rows();
$roomtypeselect = mysql_query("SELECT * FROM bgi_roomtypes WHERE id_location='" . $reservation[2] . "' ORDER BY id_room ASC");

$flagship_ref = $reservation[1];
site_header('Additional Hotel Details');
if(isset($_POST['update']))
{

//Sanitize data

    $dropoff        = QuoteSmart($_POST['dropoff']);
    $hotel_notes     = QuoteSmart($_POST['hotel_notes']);
    $rooms       = QuoteSmart($_POST['no_of_rooms']);   
    $hotelCheckIn       = QuoteSmart($_POST['hotel_check_in']);   
    $user_action = "update additional hotel details details: #ref:$flagship_ref";
    if($section == 'gh'){
        $roomIds =   $_POST['roomId'];
        $roomTypes = $_POST['room_type'];
        $roomNos =   $_POST['room_no'];
        $roomLastNames = $_POST['arr0_room_last_name'];

        $roomData = [];
        if(is_array($roomTypes) && !empty($roomTypes)){
            $i = 1;
            foreach($roomTypes as $key => $roomType){
                if($i == 1){// for additional hote table
                    $room_type      = $roomType;
                    $room_no        = $roomNos[$key];
                    $room_lastname  = $roomLastNames[$key];   
                } 
                $tempArray = [
                    'id'          => $roomIds[$key],
                    'room_type'   => $roomType,
                    'room_no' => $roomNos[$key],
                    'room_lname'   => $roomLastNames[$key],
                ];
                array_push($roomData, $tempArray);
                $i += 1;
            }
        }
        // get new added room 
        for($i = 1; $i<=5; $i++){
            if(isset($_POST['arr_room_type'.$i])){
                $newRoomType        = $_POST['arr_room_type'.$i];
                $newRoomNo          = $_POST['arr_room_no'.$i];
                $newRoomLastName    = $_POST['arr_room_last_name'.$i];

                $tempArray = [
                    'id'          => '',
                    'room_type'   => $newRoomType,
                    'room_no' => $newRoomNo,
                    'room_lname'   => $newRoomLastName,
                ];
                array_push($roomData, $tempArray);
            }
        }

        // update room table
        if(is_array($roomData) && !empty($roomData)){
            foreach($roomData as $data){
                if($data['id'] == ''){
                    unset($data['id']);
                    $data['ad_hotel_id'] = $adHotelId;
                    mysql_query(build_sql_insert('bgi_hotel_rooms', $data), $conn);
                } else {
                    $id = $data['id'];
                    $room_type = $data['room_type'];
                    $room_number = $data['room_no'];
                    $last_name = $data['room_lname'];
                    // update the records 
                    mysql_query("UPDATE bgi_hotel_rooms SET `room_type`= '$room_type', `room_no`='$room_number', `room_lname`='$last_name' WHERE id = '$id'", $conn);
                }
            }
        }

  
    } 
    $sql = "UPDATE bgi_additional_hotels ".
    "SET loc_id = '$dropoff', no_of_rooms ='$rooms', room_type = '$room_type', room_no = '$room_no', room_lname = '$room_lastname', hotel_notes = '$hotel_notes', hotel_checkin = '$hotelCheckIn' WHERE id = '$adHotelId'";
   
    $retval = mysql_query( $sql, $conn );

    
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
            
            echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=18'</script>";


    ob_end_flush();       

        mysql_close($conn);
        
    }

?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#arr-dropoff").change(function(){
                        $(".roomtype").attr("disabled","disabled");
                        $(".roomtype").html("<option>Loading rooms ...</option>");
                    
                        var locationid = $("#arr-dropoff option:selected").attr('value');
                    
                        $.post("select_roomtype.php", {locationid:locationid}, function(data){
                            $(".roomtype").removeAttr("disabled");
                            $(".roomtype").html(data);
                            
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
                                    <h3 class="panel-title"><strong>Viewing Additional Hotel Details for <?php echo $reservation[1]; ?></strong></h3>
                                </div>

                                <div class="panel-body">                                                                        
                                <!-- end arrival details -->
                                <h4>Additional Hotel Details</h4>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="arr-dropoff">Hotel Name</label>
                                    <select class="form-control select2" id="arr-dropoff" name="dropoff">
                                        <option value="<?php echo $get_location[0]; ?>"><?php echo $get_location[1]; ?></option>
                                        <?php echo $opt->ShowLocation(); ?>    
                                    </select>
                                </div>

                                <div class="form-group col-xs-7">
                                    <label class="right20">Hotel Check In Date</label>
                                     <div class="input-group date col-xs-7 right20" data-date-format="mm-dd-yyyy">
                                        <input type="text" class="form-control datepicker" id="hot_check_in_dt" value="<?=$reservation[8] == '0000-00-00' ? '':$reservation[8]?>" name="hotel_check_in" placeholder="Hotel Check In">
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                                <div class="form-group col-xs-7"><!-- number of rooms -->
                                    <label for="no-of-rooms">Number of Rooms</label>
                                    <input type="number" min=0 max=99 class="form-control" id="no-of-rooms" name="no_of_rooms" value="<?php echo $reservation[3]; ?>" placeholder="Number of Rooms">
                                </div>
                                <div class="clearfix"></div>
                                <?php
                                    if($section == 'gh'){ ?>
                                <div class="sub-room-div">
                                    <?php  
                                        $locRoomTypes = [];
                                            while ($row = mysql_fetch_assoc($roomtypeselect))
                                                array_push($locRoomTypes, $row);
                                    if($tot_rooms != 0){
                                    while($room = mysql_fetch_array($adHotelRooms)){
                                    ?>
                                    <div class="roomDiv">
                                        <div class="clearfix"></div>
                                        <div class="form-group col-xs-3" style="margin-right: 10px !important;"><!-- room type selection -->
                                          <label for="room-type">Room Type</label>
                                          <select class="form-control roomtype" id="room-type" name="room_type[]">
                                              <?php
                                              if(isset($locRoomTypes) and !empty($locRoomTypes)){
                                                  foreach($locRoomTypes as $locRoomType){
                                                      echo "<option value='".$locRoomType['id_room']."'".((isset($room['room_type']) and ($room['room_type'] == $locRoomType['id_room']))?' selected="selected" ':'').">".$locRoomType['room_type']."</option>";
                                                  }
                                              }
                                              ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="roomId[]" value="<?=$room['id']?>" />
                                        <div class="form-group col-xs-2" style="margin-right: 10px !important;"><!-- room number -->
                                            <label class="" for="room-no">Room Number</label>
                                            <input class="form-control right20" id="room-no" name="room_no[]" placeholder="Room number" value="<?php echo $room['room_no']; ?>">
                                        </div>
                                        <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                            <label class="right20">Last Name</label>
                                            <input class="form-control" type="text" id="arr0_room_last_name" name="arr0_room_last_name[]" placeholder="Guest Last Name" value="<?=$room['room_lname']?>">
                                        </div>
                                    </div>
                                    <?php } } else { ?>
                                    <div class="roomDiv">
                                        <div class="clearfix"></div>
                                        <div class="form-group col-xs-3" style="margin-right: 10px !important;"><!-- room type selection -->
                                          <label for="room-type">Room Type</label>
                                          <select class="form-control roomtype" id="room-type" name="room_type[]">
                                            <option value="">Room Type</option>
                                              <?php
                                              if(isset($locRoomTypes) and !empty($locRoomTypes)){
                                                  foreach($locRoomTypes as $locRoomType){
                                                      echo "<option value='".$locRoomType['id_room']."'".((isset($room['room_type']) and ($room['room_type'] == $locRoomType['id_room']))?' selected="selected" ':'').">".$locRoomType['room_type']."</option>";
                                                  }
                                              }
                                              ?>
                                            </select>
                                        </div>
                                        <input type="hidden" name="roomId[]" value="<?=$room['id']?>" />
                                        <div class="form-group col-xs-2" style="margin-right: 10px !important;"><!-- room number -->
                                            <label class="" for="room-no">Room Number</label>
                                            <input class="form-control right20" id="room-no" name="room_no[]" placeholder="Room number" value="">
                                        </div>
                                        <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                            <label class="right20">Last Name</label>
                                            <input class="form-control" type="text" id="arr0_room_last_name" name="arr0_room_last_name[]" placeholder="Guest Last Name" value="">
                                        </div>
                                    </div>

                                      <?php  }?>
                                </div>
                                <div id="sub-forms-div">
                                <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label for="arr-hotel-notes">Hotel Notes</label>
                                        <textarea class="form-control" rows="5" id="arr-hotel-notes" name="hotel_notes" placeholder="Hotel notes: additional hotel comments and details here"><?php echo $reservation[7]; ?></textarea>
                                    </div>
                                 </div>

                                <div class="clearfix"></div>
                                
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
 <?php if($section == 'gh'){ ?>
    $(document).on('click','.addRoomBtn',function(){
        var currentBtn = $(this);
        var subRoomsDiv = $('#sub-forms-div');
        var currentArrivalID = '';
        var totalCurrentDivs = $('.sub-room-div').find('div.roomDiv').length + subRoomsDiv.find('div.roomDiv').length;
        var maxRooms = 5;
        var locId = $('#arr-dropoff').val();
        if(totalCurrentDivs<maxRooms){
            //We Would be Adding More Guests Now to our specified Div.
            //New Way, Now More Guests Forms will be added through the jquery/ajax
            $.ajax({
                url: "<?=$url?>/custom_updates/sub_room_form.php",
                type: "POST",
                data: {req: "roomCount", dataID: totalCurrentDivs, arrID:currentArrivalID, locationid:locId},
                success: function (output) {
                    subRoomsDiv.append(output);
                    currentBtn.parent().hide();
                    console.log(totalCurrentDivs);
                    console.log(maxRooms);
                    if(totalCurrentDivs==(maxRooms-1)){
                        subRoomsDiv.find('div.roomDiv').last().find('.addRoomBtn').hide();
                        console.log('total 5 added');
                    }
                }
            });
        }
    });

    $(document).on('click','.removeBtn',function(){
        var removeBtn = $(this);
        var mainDiv = $('#sub-forms-div');
        removeBtn.parents('.roomDiv').remove();

        //Now we need to check what button to show
        var totalCurrentDivs = mainDiv.find('div.roomDiv').length;
        console.log(totalCurrentDivs);
        if(totalCurrentDivs){
            mainDiv.find('.roomDiv').last().find('.actionButtons').show();
        }else{
            mainDiv.prev().show();
        }
    });

     $(document).on('keyup', 'input[type="text"]', function(e){
        var $str = $(this).val();
        $(this).val($str.substr(0,1).toUpperCase()+$str.substr(1).toLowerCase());
    })

    function checkRooms(){
        $totalRooms = $('.sub-room-div').find('.roomDiv').length; console.log($totalRooms);
        if($totalRooms < 5) {
            $('.sub-room-div').after('<div class="form-group col-lg-1" style="margin-top: 20px;"><a class="btn btn-default addRoomBtn" data-id="0"><i class="fa fa-plus"></i> Add Room</a></div>');
        }
    }
     // on load 
    window.onload = function(){
        checkRooms();
    }
    <?php } ?>

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
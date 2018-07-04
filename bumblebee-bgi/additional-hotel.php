<?php
$url = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
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
$loggedinas = $row->fname . ' ' . $row->lname;
site_header('Add Hotel');
if(isset($_GET['reservation']))
    $reservationId = $_GET['reservation'];
//echo '<pre>'; print_r($_POST); exit;
if(isset($_GET['sect']) && !empty($_GET['sect'])){
    $section = $_GET['sect'];
} else 
    $section = 'gh';

if(isset($_POST['addHotel']))
{
    //Sanitize data
    $arr_dropoff        = QuoteSmart($_POST['arr_dropoff']);
    $arr_hotel_notes = QuoteSmart($_POST['arr_hotel_notes']);
    $no_of_rooms       = QuoteSmart($_POST['no_of_rooms']);
    $hotel_check_in       = QuoteSmart($_POST['hotel_check_in']);
   // $room_no       = QuoteSmart($_POST['room_no']);
    
    $user_action = "add new hotel: #ref:$fsref";
    $fast_track = empty($fast_track) ? 0 : 1;
    $ftres = isset($_POST['ftres']) ? 1 : 0;
    if ($ftres > 0){
        $ftnotify = 1;
    }
    $lastAdHotelID = 0;
    for($room = 1; $room <=5 ; $room++){
         if(isset($_POST['arr0_room_no'.$room])){
            $room_type  = $_POST['arr0_room_type'.$room];
            $room_no    = $_POST['arr0_room_no'.$room];
            $room_lname = $_POST['arr0_room_last_name'.$room];
        }
            
        if($room == 1) {
            
            //Put all the remaining stuff into the database
            $sql = "INSERT INTO bgi_additional_hotels ". 
                "(ref_no_sys, loc_id, no_of_rooms, room_type, room_no, room_lname, hotel_notes, hotel_checkin) VALUES 
                 ('$fsref', '$arr_dropoff', '$no_of_rooms', '$room_type', '$room_no', '$room_lname','$arr_hotel_notes', '$hotel_check_in')";    
            $retval = mysql_query( $sql, $conn );
            if(mysql_errno())
                $lastAdHotelID = 0;
            else
                $lastAdHotelID = mysql_insert_id();
        }
        if(!empty($room_type) && $lastAdHotelID > 0){
           
            $sql_room = "INSERT INTO bgi_hotel_rooms ".
                "(ad_hotel_id, room_type, room_no, room_lname) ".
                "VALUES ('$lastAdHotelID', '$room_type', '$room_no', '$room_lname')";
            $resource_room = mysql_query( $sql_room, $conn );
        }
        $room_no = $room_type = $room_lname = '';
    }

    //Update system log
    $sql_1 = "UPDATE bgi_reservations ". 
        "SET modified_date = NOW(), modified_by = '$loggedinas'". 
        "WHERE ref_no_sys = '$fsref'";
        $retval1 = mysql_query( $sql_1, $conn );

    //If Error in mysql_query() then roll back;
    if(!empty(mysql_errno())){
        die(mysql_error());
    }
    
    //Log user action
    $sql_2 = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval2 = mysql_query( $sql_2, $conn );      
        
        
        if(!empty(mysql_errno()))
            {
                echo $sql_1;
                die('Could not enter data: ' . mysql_error());
            }

        mysql_close($conn);
        echo "<script>window.location='reservation-details.php?id=".$reservationId."&ok=17'</script>";

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
                                       
                                        $("#room-type").attr("disabled","disabled");
                                        
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
                    <li><a href="#">Reservations</a></li>
                    <li><a href="reservation-details.php?id=<?php echo $reservation_id; ?>">Reservation - <?php echo $fsref; ?></a></li>
                    <li class="active">Add Hotel</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add-reservations" class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add Hotel</strong></h3>
                                </div>
                                <div class="panel-body">                              
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label>Hotel Name</label>
                                    <select class="form-control select2" id="arr-dropoff" name="arr_dropoff">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                       
                                <div class="form-group col-xs-7">
                                    <label class="right20">Hotel Check In Date</label>
                                     <div class="input-group date col-xs-7 right20" data-date-format="mm-dd-yyyy">
                                        <input type="text" class="form-control datepicker" id="hot_check_in_dt" name="hotel_check_in" placeholder="Hotel Check In">
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>

                                <div class="form-group col-xs-7"><!-- number of rooms -->
                                    <label>Number of Rooms</label>
                                    <input type="number" min=0 max=99 class="form-control" id="no-of-rooms" name="no_of_rooms" value="" placeholder="Number of Rooms">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-lg-3 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room type selection -->
                                    <label>Room type</label>
                                    <select class="form-control roomtype" id="arr0_room_type" name="arr0_room_type1">
                                        <option>Room Type</option>     
                                    </select>
                                </div>
                                <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                    <label class="right20">Room number</label>
                                    <input class="form-control" id="arr0_room-no" name="arr0_room_no1" placeholder="Room number">
                                </div>
                                <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                    <label class="right20">Last Name</label>
                                    <input type="text" class="form-control" id="arr0_room_last_name1" name="arr0_room_last_name1" placeholder="Guest Last Name">
                                </div>
                                <?php if($section == 'gh') {?>
                                <div class="form-group col-lg-1" style="margin-top: 20px;">
                                    <a class="btn btn-default addRoomBtn" data-id="0"><i class="fa fa-plus"></i> Add Room</a>
                                </div>
                                <?php } ?>
                                    <div id="sub-forms-div0" data-id="1">
                                    </div>
                                 <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Hotel notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-hotel-notes" name="arr_hotel_notes" placeholder="Hotel notes: additional hotel comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="clearfix"></div>
                                <hr />
                                <div class="panel-footer">
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addHotel" class="btn btn-primary" id="add" type="submit">Submit</button>
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
    $('.select2').select2({
        minimumInputLength: 3
    });

    $(document).on('click','.addRoomBtn',function(){
        var currentBtn = $(this);
        var currentArrivalID = currentBtn.attr('data-id');
        var subRoomsDiv = $('#sub-forms-div'+currentArrivalID);
        console.log(subRoomsDiv);
        var totalCurrentDivs = subRoomsDiv.find('div.roomDiv').length + 2;
        var maxRooms = 6;
        var locId = $(this).parents('#add-reservations').find('#arr-dropoff').val();
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
        var currentArrivalID = removeBtn.attr('data-id');
        var mainDiv = $('#sub-forms-div'+currentArrivalID);
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
   
    $('.timepicker24').timepicker({
        defaultTime: '',
        showMeridian:false
    });
    
     $(document).on('keyup', 'input[type="text"]', function(e){
        var $str = $(this).val();
        $(this).val($str.substr(0,1).toUpperCase()+$str.substr(1).toLowerCase());
    })
</script>
        <?php 
$ok= isset($_GET['ok']);
if($ok)  {
    echo '<script> alert("Hotel successfully added"); </script>';
    }
    ?>        
    </body>
</html>
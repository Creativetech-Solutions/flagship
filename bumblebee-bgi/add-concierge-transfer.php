<?php
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
include ('ref.php');
include('header.php');
include ('select.class.php');
$fsref = $_GET['ref'];
$reservation_id = $_GET['reservation'];
$loggedinas = $row->fname . ' ' . $row->lname;
site_header('Add Concierge Transfer');



if(isset($_POST['addtransfer']))
{

//Sanitize data

    $pickup         = QuoteSmart($_POST['arr_pickup']);
    $pickup_date    = QuoteSmart($_POST['pickup_date']);
    $pickup_time    = QuoteSmart($_POST['pickup_time']);
    $dropoff        = QuoteSmart($_POST['dropoff']);
    $transport      = QuoteSmart($_POST['arr_transport']);
    $driver         = QuoteSmart($_POST['driver']);
    $vehicle        = QuoteSmart($_POST['vehicle_no']);
    $transfer_notes = QuoteSmart($_POST['transfer_notes']);
    
    $user_action = "add new Inter-Hotel transfer: $fsref";

   
        //Put all the remaining stuff into the database
	$sql = "INSERT INTO bgi_additional_transfer ". 
        "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ". 
        "VALUES ('$fsref', '$pickup','$pickup_date', '$pickup_time', '$dropoff', '$transport', '$vehicle', '$driver', '$transfer_notes')";
        $retval = mysql_query( $sql, $conn );

    if(!$retval)
    {
        die('Could not enter data: ' . mysql_error());
    }


    //Update system log
    $sql_1 = "UPDATE bgi_reservations ". 
        "SET modified_date = NOW(), modified_by = '$loggedinas'". 
        "WHERE ref_no_sys = '$fsref'";
        $retval1 = mysql_query( $sql_1, $conn );

    if(!$retval1)
    {
        die('Could not enter data: ' . mysql_error());
    }
    
    //Log user action
    $sql_2 = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval2 = mysql_query( $sql_2, $conn );

    if(!$retval2)
    {
        die('Could not enter data: ' . mysql_error());
    }


    echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=15'</script>";
        mysql_close($conn);
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

            $('#arr-pickup, #dropoff').select2({
                minimumInputLength: 3
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
                                        $("#vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#driver").change(function(){
                                            $("vehicle-no").attr("disabled","disabled");
                                            $("#vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#vehicle-no").removeAttr("disabled");
                                                $("#vehicle-no").html(data);
                                                
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
                    <li class="active">Add Transfer</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add-reservations" class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add Concierge Transfer</strong></h3>
                                </div>
                                <div class="panel-body">
                                <div class="form-group col-xs-4 right20"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <?php include ('arr_pickup_select.php'); ?>
                                </div>                                                                        
                                <div class="form-group col-xs-3">
                                        <!-- arrival date -->
                                        <label class="left20">Pickup Date</label>
                                        <div class="input-group date left20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="pickup_date" id="pickup-date" placeholder="Pickup date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                
                                <div class="form-group col-xs-2"><!-- pickup time -->
                                        <label>Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" class="form-control timepicker24" name="pickup_time" id="pickup-time" placeholder="Pickup time"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>

                                <div class="form-group col-xs-5"> <!-- transport mode field -->                                      
                                    <label class="left20">Transport mode</label>
                                    <div class="left20">
                                    <?php 

                                        $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                            $result = mysql_query($sql);

                                            echo '<select class="form-control select" id="arr-transport" name="arr_transport">';
                                            echo '<option value="">Select Transport Mode</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                            }
                                            echo "</select>";
                                    ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                 <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label>Dropoff Location</label>
                                    <select class="form-control select" id="dropoff" name="dropoff">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="driver" name="driver">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="vehicle-no" name="vehicle_no">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
 
                                  <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Concierge Transfer Notes</label>
                                        <textarea class="form-control" rows="5" id="transfer-notes" name="transfer_notes" placeholder="Concierge Transfer Notes: additional concierge transfer details here"></textarea>
                                    </div>
                                 </div>

             
                                <div class="panel-footer">
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addtransfer" class="btn btn-primary" id="add" type="submit">Submit</button>
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
        <script type="text/javascript" src="js/relCopy.jquery.js"></script>
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>

        <!--  Script for Inactivity-->
        <script type="text/javascript" src="assets/store.js/store.min.js"></script>
        <script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
        <script type="text/javascript" src="js/customScripting.js"></script>
        <script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->      
        <script>
            $('.timepicker24').timepicker({
                defaultTime: '',
                showMeridian:false
            });
        </script>   
    </body>
</html>
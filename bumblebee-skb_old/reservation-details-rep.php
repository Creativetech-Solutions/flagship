<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-skb/init.php");
  
  if (!$user->levelCheck("2,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
ob_start();
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');
include('select.class.php');
$loggedinas = $row->fname . ' ' . $row->lname;
$reservation = mysql_fetch_row(mysql_query("SELECT * FROM skb_reservations WHERE id='" . QuoteSmart($_GET['id']) . "'"));
$get_rep = mysql_fetch_row(mysql_query("SELECT * FROM skb_reps WHERE id_rep='" . $reservation[42] . "'"));
$repselect = mysql_query("SELECT * FROM skb_reps ORDER BY name ASC");
$flagship_ref = $reservation[40];

//select assignment
if ($reservation[52] == 1)
{
    $assignment_select = '<option>Select assignment</option>
                                        <option value="1" selected>Airport Representation</option>
                                        <option value="2">Hotel Representation</option> ';
} elseif ($reservation[52] == 2) {
    $assignment_select = '<option>Select assignment</option>
                                        <option value="1">Airport Representation</option>
                                        <option value="2" selected>Hotel Representation</option> ';
} else {
    $assignment_select = '<option selected>Select assignment</option>
                                        <option value="1">Airport Representation</option>
                                        <option value="2">Hotel Representation</option>';
}


    
if(!$reservation) {
	header('Location: view-reservations.php');
	exit;
}
site_header('Reservation Schedules');

if(isset($_POST['update']))
{

//Sanitize data

    $rep_name       = QuoteSmart($_POST['rep_name']);
    if ($rep_name > 0){
    $assigned = 1;
    } else {
    $assigned = 0;
    }
    $assignment     = QuoteSmart($_POST['assignment']);
    $rep_action = mysql_fetch_row(mysql_query("SELECT * FROM skb_reps WHERE id_rep='" . $rep_name . "'"));
    $user_action = "Assign team $rep_action[1] / update reservation: $title_name. $first_name $last_name #ref:$flagship_ref";
    
//Put all this stuff into the database
    
	$sql = "UPDATE skb_reservations ". 
        "SET modified_date = NOW(), modified_by = '$loggedinas', assigned = '$assigned', rep = '$rep_name', assignment ='$assignment'". 
        "WHERE ref_no_sys = '$flagship_ref'";
        $retval = mysql_query( $sql, $conn );
    
    //Log user action
    $sql_4 = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval4 = mysql_query( $sql_4, $conn );
    
        
        if(! $retval )
            {
                die('Could not enter data: ' . mysql_error());
            }               
                
        header('Location:reservation-details-rep.php?id=' . $reservation[0] . '&ok=1');    
        mysql_close($conn);
        
	}
    ob_end_flush();
?>
<?php 
    $ok= isset($_GET['ok']);
    if($ok)  {
        echo '<script> alert("Reservation successfully updated"); </script>';
        }
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
                    <li>Reservations</li>
                    <li>Team Assignment</li>                    
                    <li><a href="assign-reservation-schedules.php">Assign</a></li>
                    <li class="active">Assign Rep</li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <!-- reference number generator-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Viewing reservation for <?php echo $reservation[1]; ?>. <?php echo $reservation[2]; ?> <?php echo $reservation[3]; ?></strong></h3>
                                </div>
                                <div class="panel-body"><!-- System info -->
                                    <div class="col-md-3">
                                        <div class="widget widget-success widget-item-icon">
                                            <div class="widget-item-left">
                                                <span class="fa fa-cloud"></span>
                                            </div>
                                            <div class="widget-data">
                                                <div class="widget-title">System Info</div>
                                                <div class="widget-subtitle"><strong>Reference#: <?php echo $reservation[40]; ?></strong></div>
                                                <div class="widget-subtitle">
                                                    Created: <?php echo $reservation[36]; ?><br />
                                                    Created by: <?php echo $reservation[37]; ?><br />
                                                    Modified: <?php echo $reservation[38]; ?><br />
                                                    Modified by: <?php echo $reservation[39]; ?>
                                                </div>
                                            </div>                            
                                        </div>
                                    </div>
                                </div><!-- end system info -->
                                <div class="panel-body">                                                                                                
                                <div class="panel-body">
                                    <h4>Assign a rep</h4>
                                </div>
                                                                                                       
                                    <div class="panel-body col-xs-7">
                                <div class="form-group col-xs-2"><!-- Rep assignment -->
                                    <?php
                                            // Error handling for operselect
                                            if($repselect === FALSE) {
                                                die(mysql_error()); 
                                            }
                                            
                                            //Show selected tour operator and list all the others 
                                            echo '<select class="form-control select" id="rep-name" name="rep_name">';
                                            echo '<option>Select a Rep</option>';
                                            while ($row = mysql_fetch_array($repselect)) {
                                                if ($row['id_rep'] == $get_rep[0]) {
                                                echo "<option value='" . $row['id_rep'] . "' selected>" . $row['name'] . "</option>";
                                                } else {
                                                
                                                echo "<option value='" . $row['id_rep'] . "'>" . $row['name'] . "</option>";
                                                }
                                            }
                                                echo "</select>"
                                            ?>
                                </div>
                                <div class="form-group col-xs-2"><!-- Rep assignment -->
                                   <select class="form-control left20" id="assignment" name="assignment">
                                        <?php echo $assignment_select; ?>    
                                    </select>
                                </div>
                                </div>
                                <div class="clearfix"></div>                                
                                <div>
                                    <button class="btn btn-default left20 right20" onclick="goBack()" type="button">Cancel</button>                                    
                                    <button name="update" class="btn btn-warning" id="update" type="submit">Assign Rep</button></div>
                                   
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
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->  
                
    </body>
</html>
<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-gnd/init.php");
  
  if (!$user->levelCheck("6,7,9,1"))
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

$transport_id = $_GET['transport'];
$transport_name = $_GET['transport_name'];
    
site_header('Add Vehicle');

if(isset($_POST['addvehicle']))
{

//Sanitize data

    $vehicle_name = QuoteSmart($_POST['vehicle_name']);
    $loggedinas = $row->fname . ' ' . $row->lname;
         
	$sql = "INSERT INTO gnd_vehicles ". 
        "(id_transport, name) ". 
        "VALUES ('$transport_id', '$vehicle_name')";
        $retval = mysql_query( $sql, $conn );
 
    $user_action = "add vehicle: $vehicle_name for $transport_name";
    
    //Log user action
    $sql_1 = "INSERT INTO gnd_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval1 = mysql_query( $sql_1, $conn );
  
        
        if(!$retval )
            {
                die('Could not enter data: ' . mysql_error());
            }               
        echo '<script> alert("Vehicle successfully added"); </script>';
                
        header('Location:transport-details.php?id=' . $transport_id . '');
        mysql_close($conn);
	}
ob_end_flush();
?>
                    <script type="text/javascript">
               //<![CDATA[
                function disp_confirm() {
                    var name=confirm("Pressing OK will Clear all data.")
                    if(name==true) {
                        return true;
                    }
                    else {
                        return false;
                    }
                    }
                //]]>
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
                    <li>Data Center</li>
                    <li><a href="transport-list.php">Transport</a></li>
                    <li><a href="transport-details.php?id=<?php echo $transport_id; ?>"><?php echo $transport_name; ?></a></li>
                    <li class="active"><a href="add-vehicle.php?transport=<?php echo $transport_id; ?>&transport_name=<?php echo $transport_name; ?>">Add Vehicle</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add Vehicle > <a href="transport-details.php?id=<?php echo $transport_id; ?>"><?php echo $transport_name; ?></a> </strong></h3>
                                </div>
                                <div class="panel-body">
                                    <h4>Vehicle Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group col-xs-7"><!-- Vehicle name record field -->
                                        <input type="text" class="form-control" placeholder="vehicle name" id="vehicle-name" name="vehicle_name" autofocus="true">
                                    </div>
                                <div class="panel-footer">
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addvehicle" class="btn btn-primary" id="add" type="submit">Submit</button>
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
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>             
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
<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-anu/init.php");
  
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
$loggedinas = $row->fname . ' ' . $row->lname;
$transport = mysql_fetch_row(mysql_query("SELECT * FROM anu_transport WHERE id_transport='" . QuoteSmart($_GET['id']) . "'"));
$transport_id = $_GET['id'];

$vehicles = mysql_query("SELECT * FROM anu_vehicles WHERE id_transport = $transport_id");
    
site_header('Transport Details');

if(isset($_POST['update']))
{

    //Sanitize data
    $transport_name = QuoteSmart($_POST['transport_name']);
         
	$sql = "UPDATE anu_transport ". 
        "SET name = '$transport_name' ". 
        "WHERE id_transport = '$transport_id'";
        $retval = mysql_query( $sql, $conn );
        
    $user_action = "update transport: $transport_name";
    
     //Log user action
    $sql_1 = "INSERT INTO anu_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval1 = mysql_query( $sql_1, $conn );
    
  
        
        if(! $retval )
            {
                die('Could not enter data: ' . mysql_error());
            }                               
       header('Location:transport-details.php?id=' . $transport_id . '');
        mysql_close($conn);
	}
ob_end_flush();
?>
                        
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
                    <li class="active"><a href="transport-details.php?id=<?php echo $transport_id; ?>"><?php echo $transport[1]; ?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Viewing details for <?php echo $transport[1]; ?></strong></h3>
                                </div>
                                <div class="panel-body">
                                    <h4>Transport Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group col-xs-7"><!-- Location name record field -->
                                        <input type="text" class="form-control" placeholder="transport name" id="transport-name" name="transport_name" value="<?php echo $transport[1]; ?>">
                                    </div>
                                <div class="panel-footer">
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>
                                    <button class="btn btn-default right20" onclick="goBack()" type="button">Exit</button>
                                    <button name="update" class="btn btn-success" id="update" type="submit" onclick="update_confirm()"><span class="fa fa-refresh"></span> Update</button>
                                </div>
                            </div>
                            </form>
                            <div class="panel-heading">
                                    <h3 class="panel-title"><a href="add-vehicle.php?transport=<?php echo $transport[0]; ?>&transport_name=<?php echo $transport[1]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Add Vehicle"></i> Add Vehicle</a></h3>
                                </div>
                                <div class="panel-body">
                                <form name="frmTransport" method="post" action="<?php $_PHP_SELF ?>">
                                    <table id="transport-listing" class="table table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th>Vehicle Number</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($vehicles)) {

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $vehicle_name = $row[2];
                                                    
                                                
                                                echo '<tr>
                                                        <td>' . $vehicle_name . '</td>
                                                        <td><a href="vehicle-details.php?id=' . $id . '&transport=' . $transport[0] . '&transport_name=' . $transport[1] . '&logger=' . $loggedinas . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Vehicle"></i></a> | <a href="vehicle-delete.php?id=' . $id . '&transport=' . $transport[0] . '&vehicle=' . $vehicle_name . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete ' . $vehicle_name . '"></i></a></td>                                                       
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                  
                                    </form>
                                </div>
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
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
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
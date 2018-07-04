<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-skb/init.php");
  
  if (!$user->levelCheck("2,9,1"))
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
$location = mysql_fetch_row(mysql_query("SELECT * FROM skb_location WHERE id_location='" . QuoteSmart($_GET['id']) . "'"));
$location_id = $_GET['id'];

$room_types = mysql_query("SELECT * FROM skb_roomtypes WHERE id_location = $location_id");
    
    if ($location[2] == 1){
        $zone_tag = 'East';
    } elseif ($location[2] == 2){
        $zone_tag = 'West';
    } elseif ($location[2] == 3){
        $zone_tag = 'North';
    } elseif ($location[2] == 4){
        $zone_tag = 'South';
    } elseif ($location[2] == 0){
        $zone_tag = 'Zone not assigned';
    }
    
site_header('Location Details');

if(isset($_POST['update']))
{

    //Sanitize data
    $location_name = QuoteSmart($_POST['location_name']);
    $zone          = QuoteSmart($_POST['zone']);
    $sorting_order          = QuoteSmart($_POST['sorting_order']);
         
	$sql = "UPDATE skb_location ". 
        "SET name = '$location_name', zone = '$zone', sorting_order = '$sorting_order' ". 
        "WHERE id_location = '$location_id'";
        $retval = mysql_query( $sql, $conn );
        
    $user_action = "update location: $location_name";
    
     //Log user action
    $sql_1 = "INSERT INTO skb_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval1 = mysql_query( $sql_1, $conn );
    
  
        
        if(! $retval )
            {
                die('Could not enter data: ' . mysql_error());
            }               
        echo "<script>window.location='location-details.php?id=".$location_id."&ok=1'</script>";
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
                    <li><a href="location-list.php">Locations</a></li>
                    <li class="active"><a href="location-details.php?id=<?php echo $location_id; ?>"><?php echo $location[1]; ?></a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Viewing details for <?php echo $location[1]; ?></strong></h3>
                                </div>
                                <div class="panel-body">
                                    <h4>Location Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group col-xs-7"><!-- Location name record field -->
                                        <label for="location-name">Location Name</label>
                                        <input type="text" class="form-control" placeholder="location name" id="location-name" name="location_name" value="<?php echo $location[1]; ?>">
                                    </div>
                                    <div class="clearfix"></div>

                                    <div class="form-group col-xs-4"><!-- Zone selection -->
                                        <label for="zone">Zone</label>
                                            <select class="form-control select select_ttl" id="zone" name="zone">
                                                <option value="<?php echo $location[2]; ?>" selected><?php echo $zone_tag; ?></option>
                                                <option value="1">East</option>
                                                <option value="2">West</option>
                                                <option value="3">North</option>
                                                <option value="4">South</option>
                                            </select>
                                    </div>
                                    <div class="form-group col-xs-3"><!-- Sorting order field -->
                                        <label for="sorting-order">Sorting Order</label>
                                        <input type="text" class="form-control left20" placeholder="Sorting order" id="sorting-order" name="sorting_order" value="<?php echo $location[3]; ?>">
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
                                    <h3 class="panel-title"><a href="add-roomtype.php?location=<?php echo $location[0]; ?>&location_name=<?php echo $location[1]; ?>"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Click to Add Room Type"></i> Add Room Type</a></h3>
                                </div>
                                <div class="panel-body">
                                <form name="frmLocation" method="post" action="<?php $_PHP_SELF ?>">
                                    <table id="location-listing" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Room Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($room_types)) {

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $type_name = $row[2];
                                                    
                                                
                                                echo '<tr>
                                                        <td><a href="room-details.php?id=' . $id . '&location=' . $location[0] . '&location_name=' . $location[1] . '&logger=' . $loggedinas . '"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Room Type"></i></a> | <a href="room-delete.php?id=' . $id . '&location=' . $location[0] . '&roomtype=' . $type_name . '&logger=' . $loggedinas . '"><i class="fa fa-ban" data-toggle="tooltip" data-placement="top" title="Delete ' . $type_name . '"></i></a></td>
                                                        <td>' . $type_name . '</td>
                                                                                                               
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
        <script type="text/javascript" src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>           
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="css/buttons.dataTables.min.css" type="text/css">
<script type="text/javascript" src="js/plugins/datatables/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/buttons.flash.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.tableTools.js"></script>
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>             
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
                echo '<script> alert("Location successfully updated"); </script>';
            } elseif ($ok == 2) {
					echo '<script> alert("Room Type successfully added"); </script>';
                } elseif ($ok == 3) {
						echo '<script> alert("Room Type successfully updated"); </script>';
					} elseif ($ok == 4) {
							echo '<script> alert("Room Type successfully removed"); </script>';
                }
            }
    ?>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
        $('#location-listing').DataTable( {
            "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
            "dom": 'T<"clear">lBfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Export current page',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        }
                    }
                },
                {
                    extend: 'excel',
                    text: 'Export all pages',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        }
                    }
                }

            ]
        });
    });
</script>
    </body>
</html>
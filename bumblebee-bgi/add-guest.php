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

include('header.php');
include('select.class.php');

$reservation_id = $_GET['reservation'];
$ref_no = $_GET['ref'];
    
site_header('Add Guest');

$reservation = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reservations WHERE id='" . $reservation_id . "'"));
$adult = $reservation[8];
$child = $reservation[9];
$infant = $reservation[10];
$fasttrack = $reservation[12];

if(isset($_POST['addguest']))
{

//Sanitize data

            $guest_title_name = QuoteSmart($_POST['guest_title_name']);
            $guest_first_name = QuoteSmart($_POST['guest_first_name']);
            $guest_last_name = QuoteSmart($_POST['guest_last_name']);
            $guest_email = QuoteSmart($_POST['guest_email']);
            $guest_cell = QuoteSmart($_POST['guest_cell']);
            $guest_adult = isset($_POST['guest_adult']) ? 1 : 0;
            $teen_age = QuoteSmart($_POST['teen_age']);
            $child_age = QuoteSmart($_POST['child_age']);
            $infant_age         = QuoteSmart($_POST['infant_age']);
            $guest_pnr          = QuoteSmart($_POST['guest_pnr']);
            
        $sql = "INSERT INTO bgi_guest ". 
        "(ref_no_sys, title_name, first_name, last_name, adult,teen_age, child_age, infant_age, pnr, email, cell) ". 
        "VALUES ('$ref_no', '$guest_title_name', '$guest_first_name', '$guest_last_name', '$guest_adult','$teen_age', '$child_age', '$infant_age', '$guest_pnr', '$guest_email', '$guest_cell')";
        $retval = mysql_query( $sql, $conn );
        
        if(isset($_POST['guest_adult'])){
            ++$adult;
            
            $sql2 = "UPDATE bgi_reservations ". 
        "SET adult = '$adult'". 
        "WHERE id = '$reservation_id'";
        $retval2 = mysql_query( $sql2, $conn );
            }
        
        if ($child_age >= 1){
            ++$child;
            
            $sql3 = "UPDATE bgi_reservations ". 
        "SET child = '$child'". 
        "WHERE id = '$reservation_id'";
        $retval3 = mysql_query( $sql3, $conn );
            }
        
        if ($infant_age >= 1){
            ++$infant;
            
            $sql4 = "UPDATE bgi_reservations ". 
        "SET infant = '$infant'". 
        "WHERE id = '$reservation_id'";
        $retval4 = mysql_query( $sql4, $conn );
            }
        
    $loggedinas = $row->fname . ' ' . $row->lname;
        
    $user_action = "add guest: $guest_title_name. $guest_first_name $guest_last_name for Ref# $ref_no";
    
    //Update system log
    $sql_5 = "UPDATE bgi_reservations ". 
        "SET modified_date = NOW(), modified_by = '$loggedinas'". 
        "WHERE ref_no_sys = '$ref_no'";
        $retval5 = mysql_query( $sql_5, $conn );
                    
    //Log user action
    $sql_1 = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval1 = mysql_query( $sql_1, $conn );
  
        
        if(!$retval )
            {
                die('Could not enter data: ' . mysql_error());
            }
            if ($fasttrack == 1) {
                echo "<script>window.location='ftreservation-details.php?id=".$reservation_id."&ok=2'</script>";
            } else {
                echo "<script>window.location='reservation-details.php?id=".$reservation_id."&ok=2'</script>";
            }
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
                    <li>Reservations</li>
                    <li><a href="view-reservations.php">View Reservations</a></li>
                    <li><a href="reservation-details.php?id=<?php echo $reservation_id; ?>">Reservation - <?php echo $ref_no; ?></a></li>
                    <li class="active"><a href="add-guest.php?reservation=<?php echo $reservation_id; ?>&ref=<?php echo $ref_no; ?>">Add Guest</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add Guest > <a href="reservation-details.php?id=<?php echo $reservation_id; ?>"> Ref# <?php echo $ref_no; ?></a> </strong></h3>
                                </div>
                                <div class="panel-body">
                                    <h4>Guest Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group">                                         
                                                            <div class="form-inline col-xs-12"><!-- guest first name / guest last name fields -->
                                                                <label>First name</label> <input type="text" class="form-control right20 text-capitalize" placeholder="First name" id="guest-first-name" name="guest_first_name">
                                                                <label>Last name</label> <input type="text" class="form-control right20 text-capitalize" placeholder="Last name" id="guest-last-name" name="guest_last_name">
                                                                <label>PNR</label> <input type="text" class="form-control" placeholder="Guest PNR" id="guest-pnr" name="guest_pnr" value="">
                                                                <div class="form-group col-xs-2">
                                                                    <select class="form-control select" id="guest-title-name" name="guest_title_name">
                                                                        <option value="">Select title</option>
                                                                        <option>Mr</option>
                                                                        <option>Mrs</option>
                                                                        <option>Ms</option>
                                                                        <option>Miss</option>
                                                                        <option>Master</option>
                                                                        <option>Dr</option>
                                                                        <option>Sir</option>
                                                                        <option>Lord</option>
                                                                        <option>Lady</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-12">
                                            <label>Guest Cell</label> <input type="text" class="form-control right20 text-capitalize" placeholder="Guest Cell" id="guest-cell" name="guest_cell" autocomplete="off">
                                            <label>Guest Email</label> <input type="text" class="form-control right20" placeholder="Guest Email" id="guest-email" name="guest_email" autocomplete="off">
                                        </div>
                                    </div>  
                    <div class="clearfix"></div>
                    <div class="form-group">                                         
                        <div class="form-inline col-xs-7"><!-- guest first name / guest last name fields -->
                            <label class="checkbox-inline right20 label_checkboxitem">
                                <input type="checkbox" id="guest-adult" name="guest_adult"> Adult
                            </label>
                            <input type="number" min=12 max=17 class="right20 form-control" id="teen_age" name="teen_age" value="" placeholder="Teen- 12 yrs - 17 yrs"> Years
                            <input type="number" min=0 max=11 class="right20 form-control" id="child_age" name="child_age" value="" placeholder="Child - 13 months - 11 yrs"> Years
                            <input type="number" min=0 max=23 class="form-control" id="infant_age" name="infant_age" value="" placeholder="Infant - 12 months or less"> Months
                        </div>
                    </div>
                                <div class="panel-footer">
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addguest" class="btn btn-primary" id="add" type="submit">Submit</button>
                                </div>
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
        <!--<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>-->
        <script type="text/javascript" src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>           
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type="text/javascript" src="js/plugins/icheck/icheck.min.js"></script>
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
    <script>
             $(document).on('keyup', 'input[type="text"]', function(e){
                var $str = $(this).val();
                $(this).val($str.substr(0,1).toUpperCase()+$str.substr(1).toLowerCase());
            })
    </script>    
    </body>
</html>
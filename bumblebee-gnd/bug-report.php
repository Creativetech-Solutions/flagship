<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-gnd/init.php");
  
  if (!$user->levelCheck("2,3,4,5,6,7,9,1"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');
site_header('Bug Reports');

//Grab all tour operator info
$bugs = mysql_query("SELECT * FROM gnd_bugs");

if(isset($_POST['addbug']))
{

//Sanitize data

    $title = QuoteSmart($_POST['title']);
    $page_name = QuoteSmart($_POST['page_name']);
    $details = QuoteSmart($_POST['bug_details']);
    $loggedinas = $row->fname . ' ' . $row->lname;
         
	$sql = "INSERT INTO gnd_bugs ". 
        "(bug_title, page, details, reporter) ". 
        "VALUES ('$title', '$page_name', '$details', '$loggedinas')";
        $retval = mysql_query( $sql, $conn );
        
    $user_action = "bug reported: $title";
    
    //Log user action
    $sql_1 = "INSERT INTO gnd_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval1 = mysql_query( $sql_1, $conn );
  
        
        if(!$retval )
            {
                die('Could not enter data: ' . mysql_error());
            }               
        
                
        header('Location:bug-report.php?ok=1');
        mysql_close($conn);
	}
ob_end_flush();
?>
<?php 
$ok= isset($_GET['ok']);
if($ok)  {
    echo '<script> alert("Bug successfully recorded"); </script>';
    }
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
                <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
	   $('#bug-listing').DataTable( {
            "order": [[ 1, "asc" ]],
            "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]]
	       } );
    } );
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
                    
                    <?php if ($user->is_Admin()) : ?>
                    <li>Developer</li>                                        
                    <li class="active"><a href="bug-report.php">Bug Reports</a></li>
                    <?php else: ?> 
                    <li>Reports</li>                    
                    <li class="active"><a href="bug-report.php">Report a bug</a></li>
                    <?php endif; ?>                    
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">
                    <?php if ($user->is_Admin()) : ?>
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Bug Reports</h2>
                    <?php else: ?> 
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Report a bug</h2>
                    <?php endif; ?>                    
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($user->is_Admin()) : ?>
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                <h3>Reported Bugs</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                </ul>
                                </div>
                                <div class="panel-body">
                                <form name="frmRep" method="post" action="<?php $_PHP_SELF ?>">
                                    <table id="bug-listing" class="table table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th>Bug</th>
                                                <th>Affected page</th>
                                                <th>Details</th>
                                                <th>Submitted by</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($bugs)) {

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $bug_title = $row[1];
                                                $bug_page = $row[2];
                                                $bug_details = $row[3];
                                                $reporter = $row[4];
                                                $active = $row[5];
                                                
                                                
                                                if ($active > 0){
                                                    $status = 'Pending | <a href="bug-review.php?id=' . $id . '"><i class="fa fa-check-square-o" data-toggle="tooltip" data-placement="top" title="Click to clear Bug"></i></a>';
                                                } else {
                                                    $status = 'Cleared';
                                                }                                                
                                                
                                                echo '<tr>
                                                        <td>' . $bug_title . '</td>
                                                        <td><a href="' . $bug_page . '" target="_self">' . $bug_page . '</a></td>
                                                        <td>' . $bug_details . '</td>
                                                        <td>' . $reporter . '</td>
                                                        <td>' . $status . ' </td>                                                                                                               
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                  
                                    </form>
                                </div>
                            </div>
                            <!-- END DATATABLE EXPORT -->
                            <?php endif; ?>
                            <form class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Report a bug</strong></h3>
                                    <?php if ($user->is_Admin()) : ?>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                                <div class="panel-body">
                                    <h4>Bug Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group col-xs-7"><!-- Bug Title -->
                                        <input type="text" class="form-control" placeholder="Bug title" id="title" name="title" autofocus="true">
                                    </div>
                                    <div class="form-group col-xs-7"><!-- Page Name -->
                                        <input type="text" class="form-control" placeholder="What page was the bug found on? | e.g. reservations.php" id="page-name" name="page_name">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-7">                                            
                                            <textarea class="form-control" rows="5" id="bug-details" name="bug_details" placeholder="Include as many details about the problem found here"></textarea>
                                        </div>
                                    </div>
                                <div class="panel-footer">
                                    <script>
                                        function goBack() {
                                            window.history.back();
                                        }
                                    </script>
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addbug" class="btn btn-primary" id="add" type="submit">Report this Bug</button>
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
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <button class="btn btn-success btn-lg mb-control-yes">Yes</button>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->        
        
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
        <!-- END PLUGINS -->
        
        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>      
        <!-- END THIS PAGE PLUGINS-->  
        
        <!-- START TEMPLATE -->      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->                 
    </body>
</html>
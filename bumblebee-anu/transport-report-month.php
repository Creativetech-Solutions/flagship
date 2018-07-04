<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-anu/init.php");
  
  if (!$user->levelCheck("2,3,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include('header.php');
site_header('Transport Report');


//Grab all reservation info
$transport = mysql_query("SELECT * FROM anu_resdrivers WHERE transport_date > DATE_SUB(NOW(), INTERVAL 1 MONTH) ORDER BY transport_date");
?>
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
	   $('#transfer-queue').DataTable( {
            "order": [[ 1, "asc" ]],
            dom: 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "assets/swf/copy_csv_xls_pdf.swf",
                "aButtons": [
                    "copy",
                    {
                        "sExtends": "pdf",
                        "sButtonText": "Save to PDF",
                        "sPdfOrientation": "landscape",
                        "sPdfMessage": "Transport Report"
                    },
                    //"print"
                ]            
            }
	       } );
    } );
</script>
<!--end table ordering --> 
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
                    <li>Reports</li>                    
                    <li class="active"><a href="transport-report-month.php">Transport Report - This Month</a></li>
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Transport Report </h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <!-- START DATATABLE EXPORT -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Transfers <form>
                            <select id="report_select" class="form-control">
                                <option value="" selected>This Month</option>
                                <option value="transport-report-day.php">Today</option>
                                <option value="transport-report.php">This Week</option>
                            </select>
                            <script>
                                $(function(){
                                    $('#report_select').bind('change', function () {
                                        var url = $(this).val(); // get selected value
                                        if (url) { // require a URL
                                        window.location = url; // redirect
                                    }
                                return false;
                                    });
                                });
                            </script>
                        </form></h3>
                                </div>
                                <div class="panel-body">
                                    <table id="transfer-queue" class="table table-hover datatable">
                                        <thead>
                                            <tr>
                                                <th>Driver</th>
                                                <th>Guest(s)</th>
                                                <th>Date</th>
                                                <th>Flight # | PU Time</th>                                               
                                                <th>A/C/I</th>
                                                <th>Tour Operator</th>
                                                <th>Location</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($transport)) {
                                                
                                                $driver = mysql_fetch_row(mysql_query("SELECT * FROM anu_transport WHERE id_transport='" . $row[1] . "'"));
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM anu_touroperator WHERE id='" . $row[7] . "'"));
                                                $flight = mysql_fetch_row(mysql_query("SELECT * FROM anu_flights WHERE id_flight='" . $row[13] . "'"));
                                                $pickup = mysql_fetch_row(mysql_query("SELECT * FROM anu_flighttime WHERE id_fltime='" . $row[9] . "'"));
                                                $location = mysql_fetch_row(mysql_query("SELECT * FROM anu_location WHERE id_location='" . $row[8] . "'"));
                                                $guest = mysql_query("SELECT * FROM anu_guest WHERE ref_no_sys='" . $row[3] . "'");
                                                $guest_name = ""; //reset guest name loop to null each iteration
                                                
                                                    while ($row1 = mysql_fetch_array($guest)){
                                                    $guest_name.= "<br /> |  $row1[title_name]. $row1[first_name] $row1[last_name]";
                                                    } 
                                                $guest_count = mysql_num_rows($guest);
                                                
                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $drivers = $driver[1];
                                                $adult = $row[4];
                                                $child = $row[5];
                                                $infant = $row[6];
                                                $date = $row[20];
                                                $rate = $row[11];
                                                $title_name = $row[17];
                                                $first_name = $row[18];
                                                $last_name = $row[19];
                                                
                                                echo '<tr>
                                                        <td>' . $drivers . ' | ' . $rate . '</td>
                                                        <td><strong> ' . $title_name . '. ' . $first_name . ' ' . $last_name . '</strong>' . $guest_name . '</td>
                                                        <td>' . $date . '</td>
                                                        <td>' . $flight[1] . ' | ' . $pickup[2] . '</td>                                                        
                                                        <td>' . $adult . '/' . $child . '/' . $infant . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $location[1] . '</td>
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>                                    
                                    
                                </div>
                            </div>
                            <!-- END DATATABLE EXPORT -->
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
        <script type="text/javascript" src="js/plugins/datatables/dataTables.tableTools.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>
        <script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/base64.js"></script>        
        <!-- END THIS PAGE PLUGINS-->  
        
        <!-- START TEMPLATE -->      
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->                 
    </body>
</html>
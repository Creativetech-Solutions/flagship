<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-gnd/init.php");
  
  if (!$user->levelCheck("1,2,3,4,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
  $news = $core->renderNews();
?> 
<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

include_once('header.php');

site_header('Dashboard');

//Grab all reservation info
$res = mysql_query("SELECT * FROM gnd_reservations WHERE arr_date >= DATE(NOW()) AND status = 1");
$res_count = mysql_num_rows($res);
if ($res_count < 1){
    $res_count = 'Zero';
} 

if ($res_count == 1) {
    $res_text = '';
} else {
    $res_text = 's';
}

$transport = mysql_query("SELECT * FROM gnd_resdrivers WHERE transport_date >= DATE(NOW())");
$transport_count = mysql_num_rows($transport);

if ($transport_count < 1){
    $transport_count = 'Zero';
} 

if ($transport_count == 1) {
    $transport_text = '';
} else {
    $transport_text = 's';
}
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
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Dashboard</li>
                    <li>GND</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->
                                        
                    <div class="row">
                    <div class="col-md-12">
                    <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong><i class="fa fa-exclamation-circle"></i></strong> Please report any bug or problems immediately using the <strong><a href="bug-report.php"><i class="fa fa-bug"></i> Report a Bug</a></strong> section.
                            </div>
                    </div>
                        <div class="col-md-3">
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-primary widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>                                                     
                            </div>                        
                            <!-- END WIDGET CLOCK -->    
                        </div>
                        <div class="col-md-3">
                            <div class="widget widget-success widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $res_count; ?></div>
                                    <div class="widget-title">Active Reservation<?php echo $res_text;?></div>
                                    <div class="widget-subtitle"><a href="add-reservation.php"><i class="fa fa-plus-square"></i> Add New</a> | <a href="view-reservations.php"><span class="fa fa-calendar"></span> View Reservations</a></div>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="widget widget-success widget-item-icon">
                                <div class="widget-item-left">
                                    <span class="fa fa-truck"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count"><?php echo $transport_count; ?></div>
                                    <div class="widget-title">Active Transfer<?php echo $transport_text ?></div>
                                    <div class="widget-subtitle"><a href="transport-queue.php"><span class="fa fa-calendar"></span> View Transport Queue</a></div>
                                </div>                            
                            </div>
                        </div>
                        <!-- NEWS WIDGET -->
                            <?php if($news):?>
                            <div class="col-md-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">News &amp; Announcements</h3>         
                                </div>
                                <div class="panel-body scroll" style="height: 230px;">                              
                                    <h6><?php echo $news->title ?></h6>
                                    <p>
                                        <?php echo cleanOut($news->body);?> 
                                        <span class="text-muted"><i class="fa fa-clock-o"></i> <?php echo $news->cdate ?></span>
                                    </p>                        
                                </div>
                            </div>
                            </div>
                            <?php endif;?>
                            <!-- END NEWS WIDGET -->
                    </div>
                    <!-- END WIDGETS -->    
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
                        <p>Press Yes to logout or Press No if you want to continue working.</p>
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
        <script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>
        
        <script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>       
        <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
        <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>                 
        
        <script type="text/javascript" src="js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <!--<script type="text/javascript" src="js/settings.js"></script>-->
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
        
        <script type="text/javascript" src="js/demo_dashboard.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>
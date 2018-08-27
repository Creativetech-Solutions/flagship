<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

$ftrows = mysql_query("SELECT ftnotify FROM bgi_reservations WHERE ftnotify = 1 AND status != 2");
if($ftrows){
$ft_count = mysql_num_rows($ftrows);
} else {
    $ft_count = 0;
}

if ($ft_count > 0){
    $showftnotify = '<div class="informer informer-warning left20">+' . $ft_count . '</div>';
} else {
    $showftnotify = '';
}
?>
<li class="xn-title">Navigation - BGI <span class="flag-icon flag-icon-us"></span></li>
<li class="active">
    <a href="dashboard.php"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
</li> 
<?php if ($user->levelCheck("9,2,10")) : ?>
<li class="xn-openable"><!-- reservations drop down -->
    <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Reservations</span></a>
    <ul>
        <li><a href="add-reservation.php"><span class="fa fa-pencil"></span> Add Reservation</a></li>
        <!-- <li><a href="view-reservations-arr.php"><span class="fa fa-calendar"></span> View Reservation</a></li> -->
        <li><a href="view-reservations-arr_new.php"><span class="fa fa-calendar"></span> View Reservation</a></li>
        <?php if ($user->levelCheck("9,2")) : ?>
        <li class="xn-openable"><!-- Flight control dropdown -->
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Rep Assignment</span></a>
            <ul>
                <li><a href="assign-reservation-schedules.php"><span class="glyphicon glyphicon-transfer"></span> Assign Airport Reps</a></li>
                <li><a href="assign_hotel_reps.php"><span class="glyphicon glyphicon-transfer"></span> Assign Hotel Reps</a></li>
                <li><a href="reservation-schedules.php"><span class="fa fa-random"></span> View rep assignments</a></li>
            </ul>
        </li>
        <li><a href="arrival-reconfirmation.php"><span class="glyphicon glyphicon-transfer"></span> Hotel Reconfirmation</a></li>
        <?php endif; ?>
    </ul>
</li>
<?php else: ?>
<li hidden></li>
<?php endif; ?>
<?php if ($user->levelCheck("9,2,10")) : ?>
<li class="xn-openable"><!-- fast track drop down -->
    <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Fast Track</span><?php echo $showftnotify; ?></a>
    <ul>
        <li><a href="add-fasttrack.php"><span class="fa fa-pencil"></span> Add Reservation</a></li>
        <!-- <li><a href="view-ftreservations-arr.php"><span class="fa fa-calendar"></span> View FSFT Reservations</a></li> -->
        <li><a href="view-ftreservations-arr_new.php"><span class="fa fa-calendar"></span> View FSFT Reservation </a></li>
        <?php if ($user->levelCheck("9,2")) : ?>
        <li class="xn-openable"><!-- Flight control dropdown -->
            <a href="#"><span class="fa fa-users"></span> <span class="xn-text">Rep Assignment</span></a>
            <ul>
                <li><a href="assign-ftreservation-schedules.php#"><span class="glyphicon glyphicon-transfer"></span> Assign</a></li>
                <li><a href="fasttrack-schedules.php"><span class="fa fa-random"></span> View rep assignments</a></li>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</li>
<?php else: ?>
<li hidden></li>
<?php endif; ?>
<?php if ($user->levelCheck("9,2")) : ?>
<li class="xn-openable"><!-- Reports dropdown -->
            <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Reports</span></a>
            <ul>
                <li class="xn-openable"><!-- Reports dropdown -->
                    <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text"> Ground Handling</span></a>
                    <ul>
                        <li><a href="ground-handling-adhoc.php?sect=gh"><span class="fa fa-list"></span> All Reports (ad hocs)</a></li>
                        <li><a href="cancellations.php?sect=gh"><span class="fa fa-chain-broken"></span> Cancellations</a></li>
                    </ul>
                </li>
                <li class="xn-openable"><!-- Reports dropdown -->
                    <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text"> FSFT</span></a>
                    <ul>
                        <li><a href="ground-handling-adhoc.php?sect=fsft"><span class="fa fa-list"></span> All Reports (ad hocs)</a></li>
                        <li><a href="cancellations.php?sect=fsft"><span class="fa fa-chain-broken"></span> Cancellations </a></li>
                    </ul>
                </li>
                <li class=""><!-- Reports dropdown -->
                    <a href="ground-handling-adhoc.php?sect=all"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Transfers</span></a>
                </li>
			<!-- 	<li><a href="view-cancellations.php"><span class="fa fa-calendar"></span>Cancellations</a></li> -->
            </ul>
        </li>

 <li><a href="bug-report.php"><span class="fa fa-bug"></span> Report a Bug</a></li>
<?php else: ?>
<li hidden></li>
<?php endif; ?>
<?php if ($user->levelCheck("9,2,1")) : ?>
<!-- <li class="xn-openable">
    <a href="#"><span class="fa fa-cloud"></span> <span class="xn-text">Data Center</span></a>
    <ul>
        <li><a href="location-list.php"><span class="fa fa-building-o"></span> Locations</a></li>
        <li><a href="flight-list.php"><span class="fa fa-plane"></span> Flights</a></li>
        <li><a href="transport-list.php"><span class="fa fa-truck"></span> Transport</a></li>
        <li><a href="touroperator-list.php"><span class="fa fa-globe"></span> Tour Operators</a></li>
		<li><a href="rep-list.php"><span class="fa fa-users"></span> Reps</a></li>
    </ul>
</li> -->
<?php else: ?>
<li hidden></li>
<?php endif; ?>
<?php if ($user->levelCheck("7")) : ?>
<li class="xn-openable"><!-- Admin drop down --> 
    <a href="#"><span class="fa fa-shield"></span> <span class="xn-text">Administrator</span></a>
    <ul>
        <li><a href="users.php"><span class="fa fa-users"></span> Users</a></li>
        <li><a href="news.php"><span class="fa fa-coffee"></span> News Manager</a></li>
        <li><a href="activity-log.php"><span class="fa fa-list"></span> Activity Logs</a></li>
    </ul>
</li>
<?php else: ?> 
<li hidden></li>
<?php endif; ?>
<?php if ($user->is_Admin()) : ?>
<li class="xn-openable"><!-- Developer drop down --> 
    <a href="#"><span class="fa fa-terminal"></span> <span class="xn-text">Developer</span></a>
    <ul>
        <li><a href="system.php"><span class="fa fa-gears"></span> System</a></li>
        <li><a href="users.php"><span class="fa fa-users"></span> Users</a></li>
        <li><a href="news.php"><span class="fa fa-coffee"></span> News Manager</a></li>
        <li><a href="bug-report.php"><span class="fa fa-bug"></span> Bug Reports</a></li>
        <li><a href="activity-log.php"><span class="fa fa-list"></span> Activity Logs</a></li>
        <li><a href="dbschema.php"><span class="fa fa-cloud"></span> DB Schema</a></li>
    </ul>
</li>
</ul>
<?php else: ?> 
<li hidden></li>
</ul>
<?php endif; ?>
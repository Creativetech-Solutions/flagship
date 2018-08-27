<?php
$conn = mysqli_connect('localhost','root','chocolate','cocoa_bgi');

$today = date('Y-m-d');
/*$query = "UPDATE bgi_reservations r SET guest_status = 'Departed' WHERE (SELECT MAX(d.`dpt_date`) FROM bgi_departures d WHERE d.`ref_no_sys` = r.`ref_no_sys`) = '$today' ";*/

$query = "UPDATE bgi_reservations r SET r.`status` = 4 WHERE (SELECT MAX(d.`dpt_date`) FROM bgi_departures d WHERE d.`ref_no_sys` = r.`ref_no_sys`) = '$today' and r.`status` != 2 ";
mysqli_query($conn, $query);
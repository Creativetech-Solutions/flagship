<?php
$conn = mysqli_connect('localhost','root','chocolate','cocoa_bgi');

$today = date('Y-m-d');
$query = "UPDATE bgi_reservations r SET guest_status = 'In House' WHERE (SELECT MIN(a.`arr_date`) FROM bgi_arrivals a WHERE a.`ref_no_sys` = r.`ref_no_sys`) = '$today' ";
mysqli_query($conn, $query);
<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

if(isset($_POST['action'])){
	$id = $_POST['id'];
	$rId = $_POST['rId'];
	$vehId = $_POST['vehicleId'];
	if($_POST['action'] == 'driver' || $_POST['action']=='vehicle'){
		$sql = "UPDATE bgi_reservations SET dpt_driver = '$id' WHERE id = '$rId'";
	$result = mysql_query($sql);
		$sql = "UPDATE bgi_reservations SET dpt_vehicle = '$vehId' WHERE id = '$rId'";

	}

	else if($_POST['action'] == 'pickup_time'){
		$sql = "UPDATE bgi_reservations SET dpt_pickup_time = '$id' WHERE id = '$rId'";
	}

	else if($_POST['action'] == 'transport_mode'){
		$sql = "UPDATE bgi_reservations SET dpt_transport = '$id' WHERE id = '$rId'";
	}
		$result = mysql_query($sql);
}
?>
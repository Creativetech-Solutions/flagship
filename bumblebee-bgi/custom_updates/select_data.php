<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

if((isset($_POST['action'])) && ($_POST['action'] == 'driver' || $_POST['action'] == 'vehicle')){
	$sql = "SELECT * FROM bgi_transport ORDER BY id_transport ASC";
	$result = mysql_query($sql);
	$data = array();

	$data['driver'] = '<option value="0" selected="selected">Select </option>';
	while ($row = mysql_fetch_array($result)) {
	    $data['driver'] .= "<option value='" . $row['id_transport'] . "'>" . $row['name'] . "</option>";
	}

	$sql = "SELECT * FROM skb_vehicles ORDER BY id_vehicle ASC";
	$result = mysql_query($sql);

	$data['vehicle'] = '<option value="0" selected="selected">Select </option>';
	while ($row = mysql_fetch_array($result)) {
	    $data['vehicle'] .= "<option value='" . $row['id_vehicle'] . "'>" . $row['name'] . "</option>";
	}

	echo json_encode($data);
}

else if(isset($_POST['action']) && $_POST['action'] == 'pickup_time'){
	$sql = "SELECT * FROM bgi_flighttime ORDER BY id_fltime ASC";
	$result = mysql_query($sql);

	echo '<option value="0" selected="selected">Select </option>';
	while ($row = mysql_fetch_array($result)) {
	    echo "<option value='" . $row['id_fltime'] . "'>" . $row['flight_time'] . "</option>";
	}
}

else if(isset($_POST['action']) && $_POST['action'] == 'transport_mode'){
	$sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
	$result = mysql_query($sql);

	echo '<option value="0" selected="selected">Select </option>';
	while ($row = mysql_fetch_array($result)) {
	    echo "<option value='" . $row['id'] . "'>" . $row['transport_type'] . "</option>";
	}
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 12/6/2016
 * Time: 4:43 PM
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_luggage_vehicle ORDER BY id ASC";
$result = mysql_query($sql);

if(!isset($lug_veh_id))
	$lug_veh_id = '';

while ($row = mysql_fetch_array($result)) {
    echo "<option ".($lug_veh_id == $row['id'] ? "selected='selected'":"")." value='" . $row['id'] . "'>" . $row['vehicle'] . "</option>";
}

?>
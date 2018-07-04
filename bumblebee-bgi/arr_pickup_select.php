<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_location ORDER BY name ASC";
$result = mysql_query($sql);
if(!isset($select2)) $select2 = '';
echo '<select class="form-control select '.$select2.'" id="arr-pickup" name="arr_pickup">
      <option>Pickup Location</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";

?>
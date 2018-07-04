<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_skb");

$sql = "SELECT * FROM skb_flightclass ORDER BY id ASC";
$result = mysql_query($sql);

echo '<select class="form-control select" id="dpt-flight-class" name="dpt_flight_class">
      <option>Select flight class</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
}
echo "</select>";

?>
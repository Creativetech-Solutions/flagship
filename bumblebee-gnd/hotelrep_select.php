<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_gnd");

$sql = "SELECT * FROM gnd_reps WHERE hotel = 1 ORDER BY name ASC";
$result = mysql_query($sql);

echo '<select class="form-control left20" id="rep-name-hotel" name="rep_name_hotel">
      <option value="0">Select Hotel Rep</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id_rep'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";

?>
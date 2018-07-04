<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_reps WHERE airport = 1 ORDER BY name ASC";
$result = mysql_query($sql);

echo '<select class="form-control" id="rep-name-airport" name="rep_name_airport">
      <option value="0">Select Airport Rep</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id_rep'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";

?>
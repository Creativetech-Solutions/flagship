<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
 
mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
$result = mysql_query($sql);

echo '<select multiple class="form-control select" id="arr-transport" name="arr_transport[]">
        <option selected="true">' . $reservation[18] . '</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
}
echo "</select>";

?>
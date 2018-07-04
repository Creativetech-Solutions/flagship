<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_fsft_touroperator ORDER BY tour_operator ASC";
$result = mysql_query($sql);

echo '<select class="form-control select" id="tour-oper" name="tour_oper">
      <option>Select Client</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option data-price='".$row['amount']."' value='" . $row['id'] . "'>" . $row['tour_operator'] . "</option>";
}
echo "</select>";
?>
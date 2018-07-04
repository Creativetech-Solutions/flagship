<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_skb");

$sql = "SELECT * FROM skb_touroperator ORDER BY tour_operator ASC";
$result = mysql_query($sql);

echo '<select class="form-control select" id="tour-oper" name="tour_oper">
      <option>Select tour operator</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['tour_operator'] . "</option>";
}
echo "</select>";

?>
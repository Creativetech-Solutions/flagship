<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_skb");

$sql = "SELECT * FROM skb_reps ORDER BY name ASC";
$result = mysql_query($sql);

echo '<select class="form-control" id="rep-name" name="rep_name">
      <option value="0">Select a Rep</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id_rep'] . "'>" . $row['name'] . "</option>";
}
echo "</select>";

?>
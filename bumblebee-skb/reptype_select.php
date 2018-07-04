<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_skb");

$sql = "SELECT * FROM skb_reptype ORDER BY id ASC";
$result = mysql_query($sql);

echo '<select class="form-control" id="rep-type" name="rep_type">
        <option value="0">Select Representation</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['rep_type'] . "</option>";
}
echo "</select>";
?>
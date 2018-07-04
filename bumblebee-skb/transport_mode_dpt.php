<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_skb");

$sql = "SELECT * FROM skb_transporttype ORDER BY id ASC";
$result = mysql_query($sql);

echo '<select class="form-control select" id="dpt-transporttype" name="dpt_transporttype">';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
}
echo "</select>";
?>
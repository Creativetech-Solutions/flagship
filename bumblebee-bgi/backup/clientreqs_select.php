<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_clientreqs";
if($section == 'gh')
	$sql .= " WHERE section = 0 OR section = 2";
$sql .= " ORDER BY id ASC";
$result = mysql_query($sql);

echo '<select multiple class="form-control clientReqs" id="client-reqs" name="client_reqs[]" style="width:100%">';
        //<option selected="true">Additional Requirements</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['reqs'] . "'>" . $row['reqs'] . "</option>";
}
echo "</select>";
?>
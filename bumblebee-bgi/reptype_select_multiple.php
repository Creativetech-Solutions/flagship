<?php
/**
 * Created by PhpStorm.
 * User: Syed Haider Hassan
 * Date: 11/17/2016
 * Time: 5:13 PM
 */


mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_reptype ORDER BY id ASC";
$result = mysql_query($sql);

while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['rep_type'] . "</option>";
}
?>

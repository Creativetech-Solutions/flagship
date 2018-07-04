<?php
/**
 * Created by PhpStorm.
 * User: HI
 * Date: 12/6/2016
 * Time: 4:43 PM
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_luggage_vehicle ORDER BY id ASC";
$result = mysql_query($sql);


while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id'] . "'>" . $row['vehicle'] . "</option>";
}

?>
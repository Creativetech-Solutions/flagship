<?php
/**
 * Created by PhpStorm.
 * User: Syed Haider Hassan
 * Date: 12/6/2016
 * Time: 12:00 PM
 *
 * its the new file. old file is in parent directory.
 */

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
$result = mysql_query($sql);


while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
}

?>
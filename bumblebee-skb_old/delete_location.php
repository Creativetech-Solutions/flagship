<?php
include ('header.php');
echo $_POST['location'][$i];
$rowCount = count($_POST['location']);
for($i=0;$i<$rowCount;$i++) {
mysql_query("DELETE FROM skb_location WHERE id_location='" . $_POST['location'][$i] . "'");
}
//header("Location:location-list.php");
?>
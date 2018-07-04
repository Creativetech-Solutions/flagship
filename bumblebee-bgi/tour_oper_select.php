<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
error_reporting(E_ALL &~ E_DEPRECATED);
mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

if(isset($_POST['locId']) && !empty($_POST['locId'])){
	$locId = $_POST['locId'];
	$sql = "SELECT t.`id`, t.`tour_operator` FROM `bgi_reservations` r
             INNER JOIN `bgi_arrivals` flights ON flights.`ref_no_sys` = r.`ref_no_sys`
             LEFT JOIN `bgi_location` loc ON loc.`id_location` = flights.`arr_dropoff`
             LEFT JOIN `bgi_touroperator` t ON t.`id` = r.`tour_operator`
            WHERE loc.`id_location` = '$locId'";

   if(isset($_POST['arrDate']) && !empty($_POST['arrDate'])){
		$arrdate = date('Y-m-d',strtotime($_POST['arrDate']));
		$sql .= " AND (r.`arr_date` = '$arrdate' OR flights.`arr_date` = '$arrdate')";
   }
   $sql .= ' GROUP BY t.`id`';
}
else {
	$sql = "SELECT t.`id`, t.`tour_operator` FROM bgi_touroperator t ";
}
$sql .= ' ORDER BY t.id ASC';


$result = mysql_query($sql);
echo '<select class="form-control selector2 onselection" id="tour-oper" 
name="tour_oper"  >
      <option value="0">Select tour operator</option>';
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['id'] . "' ".((isset($selectedTourOperator) and !empty($selectedTourOperator) and $selectedTourOperator==$row['id'])?' selected="selected"':'').">" . $row['tour_operator'] . "</option>";
}
echo "</select>";
?>
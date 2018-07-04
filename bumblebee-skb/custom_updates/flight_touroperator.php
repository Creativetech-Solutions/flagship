<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
error_reporting(E_ALL &~ E_DEPRECATED);
mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_skb");


$query = 'SELECT '.
'TA.id, TA.tour_operator, assigned FROM skb_touroperator TA
LEFT JOIN skb_reservations R on TA.id = R.tour_operator';

/*$query = 'SELECT '.
'* FROM skb_reservations R';*/

$flightType =$_POST['type'];
$fl_no = $_POST['fl_no'];
$fl_date = $_POST['fl_date'];
$fl_date = date('Y-m-d',strtotime($fl_date));
if($flightType === 'Arrivals'){
	//$query .= ' LEFT JOIN skb_arrivals A on R.ref_no_sys = A.ref_no_sys'; 
	$table = 'skb_arrivals';
	$whereDateCol = 'arr_date';
    $whereFlightCol = 'arr_flight_no';
}
elseif($flightType === 'Departures'){
	//$query .= ' LEFT JOIN skb_departures D on R.ref_no_sys = D.ref_no_sys';
	$table = 'skb_departures';
	$whereDateCol = 'dpt_date';
    $whereFlightCol = 'dpt_flight_no';
}

$query .= ' LEFT JOIN  '.$table.' on R.ref_no_sys = '.$table.'.ref_no_sys';
if(isset($fl_date) && !empty($fl_date)){
	$query .= ' WHERE '.$table.'.'.$whereDateCol.' = "'.$fl_date.'"';
} if(isset($fl_no) && !empty($fl_no)){
	$query .= ' && '.$table.'.'.$whereFlightCol.' = "'.$fl_no.'"';
} 
$query .= ' GROUP BY TA.id';
$result = mysql_query($query) or die(mysql_error());

//echo '<select multiple="multiple" class="form-control selector2" id="tour-oper" name="tour_oper[]">
echo '<option value="0">Select tour operator</option>';
while ($row = mysql_fetch_array($result)) {
if($row['assigned']==1){
	 echo "<option data-id='".$row['assigned']."' disabled='disabled' value='" . $row['id'] . "' ".((isset($selectedTourOperator) and !empty($selectedTourOperator) and $selectedTourOperator==$row['id'])?' selected="selected"':'').">" . $row['tour_operator'] . "</option>";
} else {
    echo "<option data-id='".$row['assigned']."' value='" . $row['id'] . "' ".((isset($selectedTourOperator) and !empty($selectedTourOperator) and $selectedTourOperator==$row['id'])?' selected="selected"':'').">" . $row['tour_operator'] . "</option>";
}
 // print_r($row);
}
?>
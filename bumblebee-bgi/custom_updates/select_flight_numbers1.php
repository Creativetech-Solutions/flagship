<?php
/**
 * Created by PhpStorm.
 * User: Syed Haider Hassan
 * Date: 12/6/2016
 * Time: 7:08 PM
 */
error_reporting(E_ALL &~ E_DEPRECATED);
if($_POST){
    //Date
    $selectedDate = $_POST['date'];
    $filterDate = date('Y-m-d',strtotime($selectedDate));
    //flight type
    $flightType =$_POST['type'];
   /* if($flightType){
        if($flightType === 'Arrivals'){
            $table = '`bgi_arrivals` flight';
            $whereColumn = 'arr_date';
            $column = 'arr_flight_no';
        }elseif($flightType === 'Departures'){
            $table = '`bgi_departures` flight';
            $whereColumn = 'dpt_date';
            $column = 'dpt_flight_no';
        }
    }else{
        echo 'bad post';
        exit;
    }*/

    //If Date Was Already Been Filtered, we need to show the date.
    $flight = $_POST['flight'];
}

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");
$selectedDateFlights_sql = $selectedDateFlights_sql2 = '';
// check arrival exist with give date
$arrivalExists = mysql_query("SELECT id FROM bgi_arrivals WHERE `arr_date` = '$filterDate'");
if($arrivalExists) {
    $row = mysql_fetch_row($arrivalExists);
    if(isset($row[0]) && !empty($row[0])){
        $selectedDateFlights_sql = "SELECT ff.id_flight AS flightNumberID, ff.flight_number  from bgi_arrivals flight INNER JOIN bgi_flights ff ON `ff`.`id_flight` = `flight`.`arr_flight_no` where `arr_date` = '$filterDate' AND `arr_flight_no` != 0 GROUP BY ff.id_flight";
    }
}

// check departure exist with give date
$depExists = mysql_query("SELECT id FROM bgi_departures WHERE `arr_date` = '$filterDate'");
if($depExists) {
    $row = mysql_fetch_row($depExists);
    if(isset($row[0]) && !empty($row[0])){
        
        $selectedDateFlights_sql2 = "SELECT ff.id_flight AS flightNumberID, ff.flight_number  from bgi_departures flight INNER JOIN bgi_flights ff ON `ff`.`id_flight` = `flight`.`dpt_flight_no` where `dpt_date` = '$filterDate' AND `dpt_flight_no` != 0 GROUP BY ff.id_flight";
    }
}
/*$selectedDateFlights_sql = "SELECT ff.id_flight AS flightNumberID, ff.flight_number  from $table INNER JOIN bgi_flights ff ON `ff`.`id_flight` = flight.$column where `$whereColumn` = '$filterDate' AND `$column` != 0 GROUP BY ff.id_flight";*/


    echo "<option value='0'>Select Flight Number</option>";
if(!empty($selectedDateFlights_sql)){
    $selectedDateFlights_resource = mysql_query($selectedDateFlights_sql);
    while ($row = mysql_fetch_array($selectedDateFlights_resource)) {
        echo "<option value='".$row['flightNumberID']."' ".((isset($flight) and !empty($flight) and $flight == $row['flightNumberID'])?'selected="selected"':'').">".$row['flight_number']."</option>";
    }
}
else if(!empty($selectedDateFlights_sql2)){
    $selectedDateFlights_resource = mysql_query($selectedDateFlights_sql2);
    while ($row = mysql_fetch_array($selectedDateFlights_resource)) {
        echo "<option value='".$row['flightNumberID']."' ".((isset($flight) and !empty($flight) and $flight == $row['flightNumberID'])?'selected="selected"':'').">".$row['flight_number']."</option>";
    }
}
<?php
error_reporting(E_ALL &~ E_DEPRECATED);
define("_VALID_PHP", true);
require_once("../../admin-panel-bgi/init.php");
include('../header.php');

$file_ending = "xls";
$filename = 'Reservations-'.date('Y-m-d H_i_s').'.'.$file_ending;


require_once('../../phpExcel/PHPExcel.php');


//header info for browser
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

/**
 * On the REPORT for Five Star Fast Track, they need 3 additional fields when they print that report from excel: 1- Rep  Assinged  2. An area for a Signature, 3 Reps Comments
 */

/*******Start of Formatting for Excel*******/
$reservations = mysql_query("SELECT 
  R.id AS ReservationID,
  R.title_name AS Title,
  R.first_name AS First_Name,
  R.last_name AS Last_Name,
  CONCAT(bgi_guest.title_name, ' ' ,bgi_guest.first_name, ' ', bgi_guest.last_name) AS Guest,
  bgi_guest.adult AS Guest_Adult,
  bgi_guest.child_age AS Guest_Child_Age,
  bgi_guest.infant_age AS Guest_Infant_Age,
  bgi_guest.pnr AS Guest_PNR,
  tour_operator AS Tour_Operator,
  tour_ref_no AS Ref_No,
  CASE WHEN rep = '' THEN 'Not Assigned' ELSE bgi_reps.name END AS Rep,
  bgi_reptype.rep_type AS RepType,
  bgi_location.name AS `Name`,
  R.arr_transport AS Trans_Type,
  CASE WHEN R.fast_track = 0 THEN 'N' ELSE 'Y' END AS FSFT,
  R.infant_seats AS Inf_Seat,
  R.child_seats AS Car_Seat,
  R.booster_seats AS Boost_Seat,
  R.client_reqs AS Client_Reqs,
  R.adult AS `A`,
  R.child AS `C`,
  R.infant AS `I`,
  R.arr_date AS Arr_Date,
  flight_number AS Arr_Flight,
  bgi_flighttime.flight_time AS Arr_Time,
  bgi_flightclass.class AS Class,
  dpt_date AS Dpt_Date,
  R.arr_transport_notes AS Arr_Trans_Notes,
  R.tour_notes AS Rep_Notes,
  R.dpt_notes AS Acct_Notes,
  R.ref_no_sys AS RefNoSys,
  bgi_guest.id AS GuestID,
  FA.id AS FlightArrivalID,
  FA.arr_date AS ArrDate,
  FA.arr_time AS ArrTime,
  FA.arr_flight_no AS ArrFlightNo,
  FA.arr_transport AS ArrTransport,
  FC.class AS FlightClass,
  FAD.name AS ArrDriver,
  FAV.name AS ArrVehicle  
   
   FROM bgi_reservations R
   LEFT JOIN bgi_reps ON bgi_reps.id_rep = R.rep
   LEFT JOIN bgi_reptype ON bgi_reptype.id = R.rep_type
   LEFT JOIN bgi_location ON bgi_location.id_location = R.arr_dropoff
   LEFT JOIN bgi_flights ON bgi_flights.id_flight = R.arr_flight_no
   LEFT JOIN bgi_flighttime ON bgi_flighttime.id_fltime = R.arr_time
   LEFT JOIN bgi_flightclass ON bgi_flightclass.id = R.flight_class
   LEFT JOIN bgi_guest ON bgi_guest.ref_no_sys = R.ref_no_sys
   LEFT JOIN bgi_arrivals FA ON FA.ref_no_sys = R.ref_no_sys
   LEFT JOIN bgi_flightclass FC ON FA.flight_class = FC.id
   LEFT JOIN bgi_transport FAD ON FAD.id_transport = FA.arr_driver
   LEFT JOIN bgi_vehicles FAV ON FAV.id_vehicle = FA.arr_driver
    WHERE R.status != 2
   ");

if(mysql_errno()){
    echo mysql_error();
}

$reservations_assoc = array();

while($row = mysql_fetch_assoc($reservations)){
    array_push($reservations_assoc,$row);
}

//print_r($reservations_assoc);


$exportArray =array();

//Now we can run foreach
foreach($reservations_assoc as $key=>$row){
    if(empty($row['RefNoSys'])){
        continue;
    }
    if(!array_key_exists($row['RefNoSys'],$exportArray)){
        $exportArray[$row['RefNoSys']] = array(
            'ID'=> $row['ReservationID'],
            'Confirmation Number'=> $row['RefNoSys'],
            'Title'=> $row['Title'],
            'First Name'=> $row['First_Name'],
            'Last Name'=> $row['Last_Name'],
            'Guests'=> array(),
            'Arrivals' => array(),
            'T/O'=> $row['Tour_Operator'],
            'Ref#'=> $row['Ref_No'],
            'Rep'=> $row['Rep'],
            'Rep Type'=> $row['RepType'],
            'Name'=> $row['Name'],
            'Transport Type'=> $row['Trans_Type'],
            'Rep Notes' =>$row['Rep_Notes'],
            'Signature' => ''
        );

    }

    //Adding Guests Information.
    if(!empty($row['GuestID'])){
        if(!array_key_exists($row['GuestID'],$exportArray[$row['RefNoSys']]['Guests'])){
            $exportArray[$row['RefNoSys']]['Guests'][$row['GuestID']]['Guest Name'] = $row['Guest'];
            $exportArray[$row['RefNoSys']]['Guests'][$row['GuestID']]['Guest Adult'] = $row['Guest_Adult'];
            $exportArray[$row['RefNoSys']]['Guests'][$row['GuestID']]['Guest Child Age'] = $row['Guest_Child_Age'];
            $exportArray[$row['RefNoSys']]['Guests'][$row['GuestID']]['Guest Infant Age'] = $row['Guest_Infant_Age'];
            $exportArray[$row['RefNoSys']]['Guests'][$row['GuestID']]['Guest PNR'] = $row['Guest_PNR'];
        }
    }


    //Adding Arrivals Information.
    if(!empty($row['FlightArrivalID'])){
        if(!array_key_exists($row['FlightArrivalID'],$exportArray[$row['RefNoSys']]['Arrivals'])){
            $exportArray[$row['RefNoSys']]['Arrivals'][$row['FlightArrivalID']]['Arrival Date'] = !empty($row['ArrDate'])?date('d-M-Y',strtotime($row['ArrDate'])):'';
            $exportArray[$row['RefNoSys']]['Arrivals'][$row['FlightArrivalID']]['Arrival Time'] = $row['ArrTime'];
            $exportArray[$row['RefNoSys']]['Arrivals'][$row['FlightArrivalID']]['Arrival Flight No'] = $row['ArrFlightNo'];
            $exportArray[$row['RefNoSys']]['Arrivals'][$row['FlightArrivalID']]['Arrival Flight Class'] = $row['FlightClass'];
            $exportArray[$row['RefNoSys']]['Arrivals'][$row['FlightArrivalID']]['Arrival Transport'] = $row['ArrTransport'];
            $exportArray[$row['RefNoSys']]['Arrivals'][$row['FlightArrivalID']]['Arrival Driver'] = $row['ArrDriver'];
            $exportArray[$row['RefNoSys']]['Arrivals'][$row['FlightArrivalID']]['Arrival Vehicle'] = $row['ArrVehicle'];
        }
    }
}

//print_r($exportArray);

//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character


$tempArray = array();
//echoString($exportArray,$sep);

$tempKeys = array();
foreach ($exportArray as $key => $subArray) {
    foreach($subArray as $subArrayKey => $data){
        if (!is_array($data)) {
            $tempArray[] = $subArrayKey;
        } else {
            foreach($data as $subArrayDataKey => $subArrayData){
                if(!in_array($subArrayKey,$tempKeys)){
                    $tempKeys[] = $subArrayKey;
                    foreach($subArrayData as $subKey => $subVal){
                        $tempArray[] = $subKey;
                    }
                }
            }
        }
    }
    break;
}

//print_r($exportArray);

$excelDataArray =array();
$tempKeys = array();
//Now Make Array for the Data
$i = 0;
foreach ($exportArray as $key => $subArray) {
    $mainCount = 0;
    $arrayToAdd = array();

    $arrayToAdd[$i][1] = $subArray['ID'];
    $arrayToAdd[$i][2] = $subArray['Confirmation Number'];
    $arrayToAdd[$i][3] = $subArray['Title'];
    $arrayToAdd[$i][4] = $subArray['First Name'];
    $arrayToAdd[$i][5] = $subArray['Last Name'];

    //For Guests
    $guestCount = $i;
    foreach($subArray['Guests'] as $guestKey=> $guestRow){
        if($guestCount !== $i){
            $arrayToAdd[$guestCount][1] = 'Do';
            $arrayToAdd[$guestCount][2] = 'Do';
            $arrayToAdd[$guestCount][3] = 'Do';
            $arrayToAdd[$guestCount][4] = 'Do';
        }

        $arrayToAdd[$guestCount][5] = $guestRow['Guest Name'];
        $arrayToAdd[$guestCount][6] = $guestRow['Guest Adult'];
        $arrayToAdd[$guestCount][7] = $guestRow['Guest Child Age'];
        $arrayToAdd[$guestCount][8] = $guestRow['Guest Infant Age'];
        $arrayToAdd[$guestCount][9] = $guestRow['Guest PNR'];
        $guestCount++;
    }

    $mainCount = $guestCount;


    $arrivalsCount = $i;
    $totalArrivals = count($subArray['Arrivals']);
    if($subArray['Arrivals']){
        for($n=$i;$n<=$mainCount;$n++){
            $arrayToAdd[$n][10] = ' - ';
            $arrayToAdd[$n][11] = ' - ';
            $arrayToAdd[$n][12] = ' - ';
            $arrayToAdd[$n][13] = ' - ';
            $arrayToAdd[$n][14] = ' - ';
            $arrayToAdd[$n][15] = ' - ';
            $arrayToAdd[$n][16] = ' - ';
        }
    }else{
        foreach($subArray['Arrivals'] as $arrivalsKey => $arrivalsRow){
            if($mainCount>$arrivalsCount and $arrivalsCount !== $i){

                $arrayToAdd[$arrivalsCount][1] = '//';
                $arrayToAdd[$arrivalsCount][2] = '//';
                $arrayToAdd[$arrivalsCount][3] = '//';
                $arrayToAdd[$arrivalsCount][4] = '//';
                //Now Adding Empty Guest Values for Empty Columns
                $arrayToAdd[$arrivalsCount][5] = '//';
                $arrayToAdd[$arrivalsCount][6] = '//';
                $arrayToAdd[$arrivalsCount][7] = '//';
                $arrayToAdd[$arrivalsCount][8] = '//';
                $arrayToAdd[$arrivalsCount][9] = '//';
            }
            $arrayToAdd[$arrivalsCount][10] = $arrivalsRow['Arrival Date'];
            $arrayToAdd[$arrivalsCount][11] = $arrivalsRow['Arrival Time'];
            $arrayToAdd[$arrivalsCount][12] = $arrivalsRow['Arrival Flight No'];
            $arrayToAdd[$arrivalsCount][13] = $arrivalsRow['Arrival Flight Class'];
            $arrayToAdd[$arrivalsCount][14] = $arrivalsRow['Arrival Transport'];
            $arrayToAdd[$arrivalsCount][15] = $arrivalsRow['Arrival Driver'];
            $arrayToAdd[$arrivalsCount][16] = $arrivalsRow['Arrival Vehicle'];
            $arrivalsCount++;
        }

        if($arrivalsCount<$mainCount){
            $remainingEmptyArrivals = $mainCount - $arrivalsCount;
            $startPoint = $i+$arrivalsCount;

            for($n=$startPoint;$n<$remainingEmptyArrivals;$n++){
                $arrayToAdd[$n][10] = '//';
                $arrayToAdd[$n][11] = '//';
                $arrayToAdd[$n][12] = '//';
                $arrayToAdd[$n][13] = '//';
                $arrayToAdd[$n][14] = '//';
                $arrayToAdd[$n][15] = '//';
                $arrayToAdd[$n][16] = '//';
            }
        }
    }

    if($arrivalsCount>$mainCount){
        $mainCount=$arrivalsCount;
    }

    $arrayToAdd[$i][17] = $subArray['T/O'];
    $arrayToAdd[$i][18] = $subArray['Ref#'];
    $arrayToAdd[$i][19] = $subArray['Rep'];
    $arrayToAdd[$i][20] = $subArray['Rep Type'];
    $arrayToAdd[$i][21] = $subArray['Name'];
    $arrayToAdd[$i][22] = $subArray['Transport Type'];

    for($n=$i+1;$n<=$mainCount;$n++){
        $arrayToAdd[$n][17] = '//';
        $arrayToAdd[$n][18] = '//';
        $arrayToAdd[$n][19] = '//';
        $arrayToAdd[$n][20] = '//';
        $arrayToAdd[$n][21] = '//';
        $arrayToAdd[$n][22] = '//';
    }

    foreach($arrayToAdd as $subKey=>$array){
        array_push($excelDataArray,$array);
    }



    $i++;
}

//print_r($excelDataArray);

$objPHPExcel = new PHPExcel();
// Auto size columns for each worksheet
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

    $sheet = $objPHPExcel->getActiveSheet();
    $objPHPExcel->getActiveSheet()->fromArray($tempArray, null, 'A1');
    $objPHPExcel->getActiveSheet()->fromArray($excelDataArray, null, 'A2');
    $cellIterator = $sheet->getRowIterator()->current()->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(true);
    /** @var PHPExcel_Cell $cell */
    foreach ($cellIterator as $cell) {
        $sheet->getColumnDimension($cell->getColumn())->setAutoSize(true);
    }
}
/*$doc->setActiveSheetIndex(0);
$doc->getActiveSheet()->fromArray($tempArray, null, 'A1');*/

// Do your stuff here
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

$writer->save('php://output');
exit;

//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($reservations); $i++) {
    echo mysql_field_name($reservations,$i) . "\t";
}
print("\n");
//end of printing column names
//start while loop to get data
while($row = mysql_fetch_row($reservations))
{
    $schema_insert = "";
    for($j=0; $j<mysql_num_fields($reservations);$j++)
    {
        if(!isset($row[$j]))
            $schema_insert .= "NULL".$sep;
        elseif ($row[$j] != "")
            $schema_insert .= "$row[$j]".$sep;
        else
            $schema_insert .= "".$sep;
    }
    $schema_insert = str_replace($sep."$", "", $schema_insert);
    $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
    $schema_insert .= "\t";
    print(trim($schema_insert));
    print "\n";
}
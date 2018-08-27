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

$conn = mysqli_connect('localhost','root','chocolate','cocoa_bgi');

$arrivalConfirmations = "SELECT * FROM bgi_reservations WHERE status != 2";
$reservations = mysqli_query($conn ,$arrivalConfirmations);
if(mysqli_errno($conn)){
    echo mysqli_error($conn);
}

$reservations_assoc = array();

$header = array();
$count= 1;
//echo '<pre>';
$excelLabels = [
    'arr_dropoff' => 'Accommodation',
	'room_type' => 'Room Type',
	'rooms' => '# of Rooms',
	'arr_date' => 'Arrival Date',
	'arr_flight_no' => 'Arr Flight',
	'arr_time' => 'Arrival Time',
	'ref_no_sys' => 'Guest(s)',
	'tour_ref_no' => 'Ref #',
	'tour_operator' => 'T/O',
	'adult' => 'A',
	'child' => 'C',
	'infant' => 'I',
	'dpt_date' => 'Depart Date',
	'date_reconfirmed' => 'Date Reconfirmed',
	'reconf_with' => 'Reconf With',
	'arr_hotel_notes' => 'Hotel Notes',
	'tour_notes' => 'Rep Notes',
];

while($row = mysqli_fetch_assoc($reservations)){
	//$hotel = printf ("%s (%s)\n", $row["first_name"], $row["tour_operator"]);
	$hotel = mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM bgi_location WHERE id_location='" . $row['arr_dropoff'] . "'"));
	$row['arr_dropoff']=$hotel[1];
	$room_type = mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM bgi_roomtypes WHERE id_room='" . $row['room_type'] . "'"));
	$row['room_type']=$room_type[2];
	$rooms = $row['rooms'];
	$arr_date = $row['arr_date'];
	$arr_flight_no = mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM bgi_flights WHERE id_flight='" . $row['arr_flight_no'] . "'"));
    $row['arr_flight_no']=$arr_flight_no[1];
	$arr_time = mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row['arr_time'] . "'"));
    $row['arr_time'] = $arr_time[2];
	$guest = mysqli_query($conn,"SELECT * FROM bgi_guest WHERE ref_no_sys='" . $row['ref_no_sys'] . "'");
	$guest_name = ""; //reset guest name loop to null each iteration
                                                
                                                    while ($row1 = mysqli_fetch_assoc($guest)){
                                                    $guest_name.= "$row1[title_name] $row1[first_name] $row1[last_name]";
                                                    } 
	$row['ref_no_sys']=$guest_name;
	$ref_no=$row['tour_ref_no'];
	$tour_oper = mysqli_fetch_row(mysqli_query($conn,"SELECT * FROM bgi_touroperator WHERE id='" . $row['tour_operator'] . "'"));
	$row['tour_operator']=$tour_oper[1];
	 $adult=$row['adult'];
    $child=$row['child'];
    $infant=$row['infant'];
	$dpt_date=$row['dpt_date'];
	$dateReconfirmed=$row['date_reconfirmed'];
                                                if(!empty($dateReconfirmed)){
                                                    $dateReconfirmed = date('F d, Y',strtotime($dateReconfirmed));
                                                }
	 $reconf_with=$row['reconf_with'];
	 $hotel_notes=$row['arr_hotel_notes'];
	 $rep_notes=$row['tour_notes'];
	
												
	
	$temp = [
    'arr_dropoff' => $row['arr_dropoff'],
	'room_type' => $row['room_type'],
	'rooms' => $row['rooms'],
	'arr_date' => $row['arr_date'],
	'arr_flight_no' => $row['arr_flight_no'],
	'arr_time' => $row['arr_time'],
	'ref_no_sys' => $row['ref_no_sys'],
	'tour_ref_no' => $row['tour_ref_no'],
	'tour_operator' => $row['tour_operator'],
	'adult' => $row['adult'],
	'child' => $row['child'],
	'infant' => $row['infant'],
	'dpt_date' => $row['dpt_date'],
	'date_reconfirmed' => $row['date_reconfirmed'],
	'reconf_with' => $row['reconf_with'],
	'arr_hotel_notes' => $row['arr_hotel_notes'],
	'tour_notes' => $row['tour_notes'],
];

   

    array_push($reservations_assoc,$temp);
    $count++;
		
//print_r($row);

	
	//$hotel[1]=$row[22];
	
	
}
//exit;





$excelHeaders = array_values($excelLabels);

/*echo '<pre>';
print_r($reservations_assoc);
exit;*/

$sep = "\t"; //tabbed character



//print_r($excelDataArray);

$objPHPExcel = new PHPExcel();
// Auto size columns for each worksheet
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

    $sheet = $objPHPExcel->getActiveSheet();
    $objPHPExcel->getActiveSheet()->fromArray($excelHeaders, null, 'A1');
    $objPHPExcel->getActiveSheet()->fromArray($reservations_assoc, null, 'A2');
    $sheet->getStyle('A1:'.$sheet->getHighestColumn().'1')->getFont()->setBold(true);
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

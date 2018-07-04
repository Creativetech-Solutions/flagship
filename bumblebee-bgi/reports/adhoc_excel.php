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

//require('adhoc-generate.php');


require('adhoc-generate.php');

$dataArray = [];
$previousRow = [];

$count = 1;
foreach($resultData as $key=>$row){

  // $previousRow[$key]=$row;
  $previousRow[$count]=$row;
    foreach($row as $key_in=>$val){
      if(isset($previousRow[$key-1]) && $previousRow[$key-1]['Id']==$row['Id']){
       if($previousRow[$key-1][$key_in]==$val){
          $row[$key_in] = '//';
       }

      }

       $row[$key_in] = html_entity_decode($row[$key_in]);
       $count++;
  }
  

    array_push($dataArray, $row);
  
 // print_r($row);
} // end of foreach


 //print_r($previousRow);

$objPHPExcel = new PHPExcel();
// Auto size columns for each worksheet
foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

    $objPHPExcel->setActiveSheetIndex($objPHPExcel->getIndex($worksheet));

    $sheet = $objPHPExcel->getActiveSheet();
    $objPHPExcel->getActiveSheet()->fromArray($columns, null, 'A1');
    $objPHPExcel->getActiveSheet()->fromArray($dataArray, null, 'A2');
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


//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($dataArray); $i++) {
    echo mysql_field_name($dataArray,$i) . "\t";
}
print("\n");
//end of printing column names
//start while loop to get data
while($row = mysql_fetch_row($dataArray))
{
    $schema_insert = "";
    for($j=0; $j<mysql_num_fields($dataArray);$j++)
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
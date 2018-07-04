<?php
error_reporting(E_ALL &~ E_DEPRECATED);
define("_VALID_PHP", true);
require_once("../../admin-panel-bgi/init.php");
include('../header.php');

$file_ending = "xls";
$filename = 'Reservations-'.date('Y-m-d H_i_s').'.'.$file_ending;
//header info for browser
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

/*******Start of Formatting for Excel*******/
$reservations = mysql_query("SELECT 
  title_name AS Title,
  first_name AS First_Name,
  last_name AS Last_Name,
  tour_operator AS Tour_Operator,
  tour_ref_no AS Ref_No,
  CASE WHEN rep = '' THEN 'Not Assigned' ELSE bgi_reps.name END AS Rep,
  bgi_reptype.rep_type AS RepType,
  bgi_location.name AS `Name`,
  arr_transport AS Trans_Type,
  CASE WHEN R.fast_track = 0 THEN 'N' ELSE 'Y' END AS FSFT,
  infant_seats AS Inf_Seat,
  child_seats AS Car_Seat,
  booster_seats AS Boost_Seat,
  client_reqs AS Client_Reqs,
  adult AS `A`,
  child AS `C`,
  infant AS `I`,
  arr_date AS Arr_Date,
  flight_number AS Arr_Flight,
  bgi_flighttime.flight_time AS Arr_Time,
  bgi_flightclass.class AS Class,
  dpt_date AS Dpt_Date,
  arr_transport_notes AS Arr_Trans_Notes,
  tour_notes AS Rep_Notes,
  dpt_notes AS Acct_Notes
  
   
   FROM bgi_reservations R
   LEFT JOIN bgi_reps ON bgi_reps.id_rep = R.rep
   LEFT JOIN bgi_reptype ON bgi_reptype.id = R.rep_type
   LEFT JOIN bgi_location ON bgi_location.id_location = R.arr_dropoff
   LEFT JOIN bgi_flights ON bgi_flights.id_flight = R.arr_flight_no
   LEFT JOIN bgi_flighttime ON bgi_flighttime.id_fltime = R.arr_time
   LEFT JOIN bgi_flightclass ON bgi_flightclass.id = R.flight_class
    WHERE R.status = 1
   ");

if(mysql_errno()){
    echo mysql_error();
}

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
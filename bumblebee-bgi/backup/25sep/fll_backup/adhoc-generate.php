<?php
//Pre Defined Settings.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect('localhost','root','chocolate','cocoa_bgi');

$start=0;
$limit=25;

if(isset($_GET['id']))
{
$id=$_GET['id'];
$start=($id-1)*$limit;
}
else {
    $id=1;
}

  
if(empty($_POST)){ 

    if(isset($_SESSION['adhoc_report'])) // check if report setting save in session, than use that
        $_POST = $_SESSION['adhoc_report'];
    if(isset($_REQUEST['report_id']) && !empty($_REQUEST['report_id'])) { 
    // for edit report , when user click on generated report button
        $result = mysqli_query($conn, "SELECT `setting` FROM bgi_reports WHERE id=".$_REQUEST['report_id']);
        if(!empty($result)){
            $TotalRows = mysqli_num_rows($result);
        }
        if(isset($TotalRows) and $TotalRows > 0){
            $row = mysqli_fetch_row($result);
                // save setting in session, as well as in post variable that's used below
                $_POST = $_SESSION['adhoc_report'] = json_decode($row[0], true);
        } // end of if
    }
    } else {
        // save selected report fields(post data) in session, to use when reload
        $_SESSION['adhoc_report'] = $_POST;
    }

ini_set('memory_limit', '9999999999');
ini_set('max_execution_time', 0);
    $postItems = [];
   // $reportSettings = [];
    foreach($_POST as $postedItem){
        if(!empty($postedItem['value'])){
            if($postedItem['name']=='reportName') {
                // save report name in session, to use later when create pdf or save report
                $_SESSION['reportName'] = ucwords($postedItem['value']);
            }
            else if($postedItem['name']=='reportId'){
                 $reportId = $postedItem['value'];
            }
            else {
               // array_push($reportSettings, $postedItem['name']);
                $explodeAlias = explode('::', $postedItem['name']);
                $postedItemArray = explode('.',$explodeAlias[0]);
                
                //$postedItemArray = explode('.',$postedItem['name']);
                $postedItemBackTicks = '`'.implode('`.`',$postedItemArray).'`'.' as '. $explodeAlias[1];
                $postItems[] = $postedItemBackTicks;
            }
        }//End of If Statement
    }//End of Foreach Statement.
//$_SESSION['report_settings'] = json_encode($reportSettings);
function selectData($postItems){
    if(empty($postItems)){
        return false;
    }

    $selectData = [];
    foreach($postItems as $postItem){
        $explodedPostedItem = explode('.',$postItem); 
        $columnName = end($explodedPostedItem);
        $totalItemsInExplodedArray = count($explodedPostedItem);
        $RelatedTable = $explodedPostedItem[$totalItemsInExplodedArray-2];
        $selectData[] = $RelatedTable.'.'.$columnName;
    }
    return implode(',', $selectData);
}





$query = 'SELECT ';

$selectData = selectData($postItems);

if($_REQUEST['sect'] == 'fsft') 
    $selectData = $selectData.', R.ftnotify as GH';

$query .= $selectData . ', R.ref_no_sys as Ref_no_sys FROM bgi_reservations R';

if(strpos($selectData, '`tour_operator`')){
    $query .= ' LEFT JOIN bgi_touroperator T on R.tour_operator = T.id';
}

/*if(strpos($selectData, 'Reps')){
    $query .= ' LEFT JOIN bgi_reps RE on R.rep = RE.id_rep';
}*/

if(strpos($selectData,'`G`')){
    $query .= ' LEFT JOIN bgi_guest G on R.ref_no_sys = G.ref_no_sys';
}
if(strpos($selectData,'`D`') || strpos($selectData, '`flight_time`') || strpos($selectData, '`flight_number`') || strpos($selectData, 'Dept_Flight_Class') || strpos($selectData, 'Dept_Driver') || strpos($selectData, 'Dept_Dropoff') || strpos($selectData, 'Dept_Pickup') || strpos($selectData, 'Dept_Vehicle')){

    $query .= ' LEFT JOIN bgi_departures D on R.ref_no_sys = D.ref_no_sys';
    if(strpos($selectData, '`flight_time`')){
        $query .= ' LEFT JOIN bgi_flighttime FT on D.dpt_time = FT.id_fltime';
    }
    if(strpos($selectData, '`flight_number`')){
        $query .= ' LEFT JOIN bgi_flights F on D.dpt_flight_no = F.id_flight';
    }
    if(strpos($selectData, 'Dept_Flight_Class')){
        $query .= ' LEFT JOIN bgi_flightclass FC on D.flight_class = FC.id';
    }
    if(strpos($selectData, 'Dept_Driver')){
        $query .= ' LEFT JOIN bgi_transport DD on D.dpt_driver = DD.id_transport';
    }
    if(strpos($selectData, 'Dept_Pickup')){
        $query .= ' LEFT JOIN bgi_location DPL on D.dpt_pickup = DPL.id_location';
    }
    if(strpos($selectData, 'Dept_Dropoff')){
        $query .= ' LEFT JOIN bgi_location DDL on D.dpt_dropoff = DDL.id_location';
    }
    if(strpos($selectData, 'Dept_Vehicle')){
        $query .= ' LEFT JOIN bgi_vehicles DV on D.dpt_vehicle = DV.id_vehicle';
    }
}
if(strpos($selectData,'`A`') || strpos($selectData, '`rep_type`') || strpos($selectData, '`room_type`') || strpos($selectData, 'Arr_Flight') || strpos($selectData, 'Arr_Flight_Class') || strpos($selectData, 'Arr_Driver') || strpos($selectData, 'Arr_Vehicle') || strpos($selectData, 'Arr_Pickup') || strpos($selectData, 'Arr_Dropoff') ||
    strpos($selectData, 'Zone') || strpos($selectData, 'Location_Code') || strpos($selectData, 'Hotel_Arr_Dropoff') || strpos($selectData, 'Arr_Time')){
    $query .= ' LEFT JOIN bgi_arrivals A on R.ref_no_sys = A.ref_no_sys';

    if(strpos($selectData,'`AR`') || strpos($selectData, 'Additional_Room_Type')){
        $query .= ' LEFT JOIN bgi_arrivals_rooms AR on A.id = AR.arrival_id';

        if(strpos($selectData, 'Additional_Room_Type')){
            $query .= ' LEFT JOIN bgi_roomtypes RAR on AR.room_type = RAR.id_room';
        }
    }

    if(strpos($selectData,'`AT`') || strpos($selectData, 'Additional_Vehicle') || strpos($selectData, 'Additional_Transport_Supplier')){
        $query .= ' LEFT JOIN bgi_arrivals_transports AT on A.id = AT.arrival_id';

        if(strpos($selectData, 'Additional_Vehicle')){
            $query .= ' LEFT JOIN bgi_vehicles ATV on AT.vehicle = ATV.id_vehicle';
        }
        if(strpos($selectData, 'Additional_Transport_Supplier')){
            $query .= ' LEFT JOIN bgi_transport ATD on AT.driver = ATD.id_transport';
        }
    }

    if(strpos($selectData, '`rep_type`')){
        $query .= ' LEFT JOIN bgi_reptype RP on A.rep_type = RP.id';
    }

    if(strpos($selectData, 'Arr_Room_Type')){
        $query .= ' LEFT JOIN bgi_roomtypes RA on A.room_type = RA.id_room';
    }

    if(strpos($selectData, 'Arr_Flight')){
        $query .= ' LEFT JOIN bgi_flights FAR on A.arr_flight_no = FAR.id_flight';
    }

    if(strpos($selectData, 'Arr_Flight_Class')){
        $query .= ' LEFT JOIN bgi_flightclass FCA on A.flight_class = FCA.id';
    }

    if(strpos($selectData, 'Arr_Driver')){
        $query .= ' LEFT JOIN bgi_transport DDA on A.arr_driver = DDA.id_transport';
    }
    if(strpos($selectData, 'Arr_Vehicle')){
        $query .= ' LEFT JOIN bgi_vehicles AV on A.arr_vehicle = AV.id_vehicle';
    }
    if(strpos($selectData, 'Arr_Pickup')){
        $query .= ' LEFT JOIN bgi_location AL on A.arr_pickup = AL.id_location';
    }
    if(strpos($selectData, 'Arr_Dropoff') || strpos($selectData, 'Zone') || strpos($selectData, 'Location_Code') || 
        strpos($selectData, 'Hotel_Arr_Dropoff')){
        $query .= ' LEFT JOIN bgi_location ADL on A.arr_dropoff = ADL.id_location';
        if(strpos($selectData,'Zone')){
            $query .= ' LEFT JOIN bgi_loc_coast LC on ADL.zone= LC.id';
        }
    }
    if(strpos($selectData, 'Arr_Time')){
        $query .= ' LEFT JOIN bgi_flighttime FAT on A.arr_time = FAT.id_fltime';
    }
    
}
if(strpos($selectData,'`I`') || strpos($selectData, 'Inter_Hotel_Pickup') || strpos($selectData, 'Inter_Hotel_Dropoff_Location') || strpos($selectData, 'Inter_Hotel_Vehicle')){
    $query .= ' LEFT JOIN bgi_transfer I on R.ref_no_sys = I.ref_no_sys';
    if(strpos($selectData, 'Inter_Hotel_Pickup')){
        $query .=' LEFT JOIN bgi_location L on I.pickup = L.id_location';
    }
    if(strpos($selectData, 'Inter_Hotel_Dropoff_Location')){
        $query .=' LEFT JOIN bgi_location as IL on I.dropoff = IL.id_location';
    }
    if(strpos($selectData, 'Inter_Hotel_Vehicle')){
        $query .=' LEFT JOIN bgi_vehicles as IV on I.vehicle = IV.id_vehicle';
    }
}
if(strpos($selectData,'`AD`') || strpos($selectData, 'Additional_Pickup_Location') || strpos($selectData, 'Additional_Pickup_Time') || strpos($selectData, 'Additional_Dropoff_Location') || strpos($selectData, 'Additional_Vehicle')){
    $query .= ' LEFT JOIN bgi_additional_transfer AD on R.ref_no_sys = AD.ref_no_sys';

    if(strpos($selectData, 'Additional_Pickup_Location')){
        $query .= ' LEFT JOIN bgi_location ADP on AD.pickup = ADP.id_location';
    }
    if(strpos($selectData, 'Additional_Pickup_Time')){
        $query .= ' LEFT JOIN bgi_flighttime ADPT on AD.pickup_time = ADPT.id_fltime';
    }
    if(strpos($selectData, 'Additional_Dropoff_Location')){
        $query .=' LEFT JOIN bgi_location as ADDL on AD.dropoff = ADDL.id_location';
    }
    if(strpos($selectData, 'Additional_Vehicle')){
        $query .=' LEFT JOIN bgi_vehicles as ADAV on AD.vehicle = ADAV.id_vehicle';
    }
}

if(isset($_REQUEST['sect']) && $_REQUEST['sect']=='fsft'){ 
    $query .= ' WHERE (R.fast_track=1 || R.ftnotify=1) && R.status=1';
} else {
    $_REQUEST['sect'] = 'gh';
    $query .= ' WHERE (R.fast_track=0 || R.ftnotify=1) && R.status=1';
}


if(!isset($_REQUEST['fromDate']) || !isset($_REQUEST['toDate'])){
    if(isset($_SESSION['repFromDate'])){
        $_REQUEST['fromDate'] = $_SESSION['repFromDate'];
        $_REQUEST['toDate'] = $_SESSION['repToDate'];
    }
}

if(isset($_REQUEST['fromDate']) && isset($_REQUEST['toDate'])){
    $_SESSION['repFromDate'] = $_REQUEST['fromDate'];
    $_SESSION['repToDate'] = $_REQUEST['toDate'];

    $fromDate = strtotime($_REQUEST['fromDate']);
    $toDate = strtotime($_REQUEST['toDate']);
    $dateRangeText = date('M d, Y',$fromDate). ' - ' .date('M d, Y',$toDate);
    
    $fromDate = $_REQUEST['fromDate'];
    $toDate = $_REQUEST['toDate'];
    $query .= ' && (R.arr_date between CAST("'.$fromDate.'" AS DATE) AND CAST("'.$toDate.'" AS DATE))';
}

/*if(isset($_REQUEST['query'])){
    $searchText = $_REQUEST['query'];
     $query .= ' && (R.first_name LIKE "%'.$searchText.'%" || R.last_name LIKE "%'.$searchText.'%" || R.pnr LIKE "%'.$searchText.'%" || R.tour_operator LIKE "%'.$searchText.'%" || R.operator_code LIKE "%'.$searchText.'%" || R.tour_notes LIKE "%'.$searchText.'%" || R.flight_class LIKE "%'.$searchText.'%" || R.arr_transport LIKE "%'.$searchText.'%" || R.rep_type LIKE "%'.$searchText.'%" || R.client_reqs LIKE "%'.$searchText.'%" || R.dpt_transport LIKE "%'.$searchText.'%" || R.dpt_pickup LIKE "%'.$searchText.'%" || R.dpt_dropoff LIKE "%'.$searchText.'%" || R.dpt_notes LIKE "%'.$searchText.'%" || R.modified_by LIKE "%'.$searchText.'%" || R.arr_hotel_notes LIKE "%'.$searchText.'%" || R.dpt_transport_notes LIKE "%'.$searchText.'%")' ;
}*/
$query .= ' ORDER BY R.id';
//echo $query; exit;


$queryResource = mysqli_query($conn,$query);

if(!empty($queryResource)){
    $TotalRows = mysqli_num_rows($queryResource);
}
if(isset($TotalRows) and $TotalRows > 0){
    // output data of each row
    $resultData = [];
    $allReps = [];
  
    while($row = mysqli_fetch_assoc($queryResource)) {
        if(isset($row['Child'])){
            $child =$row['Child'];
            unset($row['Child']);
        }
        else $child = '-';
        if(isset($row['Infant'])){
            $infant = $row['Infant'];
            unset($row['Infant']);
        }
        else $infant = '-';
        if(isset($row['Adult'])){
            $adult = $row['Adult'];
            unset($row['Adult']);
        }
        else $adult = '-';
        if($adult!='-'|| $child!='-'||$infant!='-'){
             $row['A_C_I'] = $adult.' / '.$child.' / '.$infant;
        } else {
            unset($row['A_C_I']);
        }

        if(isset($row['Payment_Type'])){
            $paymentType = $row['Payment_Type'];
            if($paymentType=='0') 
                $row['Payment_Type']='Not Defined';
            else {
                $result = mysqli_query($conn, "SELECT `payment_type` FROM bgi_payment_type WHERE id = '$paymentType'");
                $record = mysqli_fetch_row($result);
                    if(isset($record[0]) && !empty($record[0])){
                        $row['Payment_Type']=$record[0];
                    } else {
                        $row['Payment_Type']='Not Defined';
                    }
            }
        }
        // check for arrival service only  
        if(isset($row['Ref_no_sys']) && isset($row['Arrival_Service_Only'])){  
            $ref_no_sys = $row['Ref_no_sys'];
            $innerQuery = mysqli_query($conn,"SELECT COUNT(id) FROM bgi_departures WHERE ref_no_sys = '$ref_no_sys'");
            $innerQuery = mysqli_fetch_row($innerQuery);
            if($innerQuery>0){
                $row['Arrival_Service_Only'] = 'No';
            } else {
                $row['Arrival_Service_Only'] = 'Yes';
            }
           unset($row['Ref_no_sys']);
        } else {
            unset($row['Ref_no_sys']);
            unset($row['Arrival_Service_Only']);
        }
        // check fast track 
        if(isset($row['Arr_Fast_Track'])){
            if($row['Arr_Fast_Track']==1 || $_REQUEST['sect']=='fsft')
                $row['Arr_Fast_Track'] = 'Y';
            else 
                $row['Arr_Fast_Track'] = 'N';
        } 
        if(isset($row['Dep_Fast_Track'])){
            if($row['Dep_Fast_Track']==1 || $_REQUEST['sect']=='fsft')
                $row['Dep_Fast_Track'] = 'Y';
            else 
                $row['Dep_Fast_Track'] = 'N';
        }

        // check reps 
        if(isset($row['Reps']))
            $row['Reps'] = json_decode($row['Reps'], true); 
       
        //echo '<pre>'; print_r($row['Reps']) ; 
        if(isset($row['Reps']) && is_array($row['Reps']) && !empty($row['Reps'])){
            $ids = $row['Reps'];
            $ids = implode("','",$ids);
            $query = "SELECT `name` FROM bgi_reps WHERE id_rep IN ('".$ids."')"; 
            $query = mysqli_query($conn, $query) or die(mysql_error());
            $allReps = [];
            while($record = mysqli_fetch_array($query)){
                if(isset($record[0]))
                    $allReps[] = $record[0];
            }
            if(isset($allReps) && is_array($allReps)){
                $row['Reps'] = implode(",   ", $allReps);
            }
        }

       if(isset($row['GH'])){
            if($row['GH'] == 1)
                $row['GH'] = 'Y';
            else $row['GH'] = 'N';
            $row = array('GH'=>$row['GH']) + $row;
        }

        $resultData[] = $row;
    }
    $rIds = [];
    $guestIds = [];
    $testArray = [];
    // here wo make the array of reservation and guest columns, that will use later to duplicte the main reservation
    $reservationCols = ['GH','Id','Title_Name','First_Name','Last_Name','PNR','Arrival_Service_Only','Client','Tour_Operator','Operator_Code','Reference_No','Adult','Child','Infant','A_C_I','Tour_Notes','Reps','Payment_Type'];
    $guestCols=['Guest_Title_Name','Guest_First_Name','Guest_Last_Name','Guest_PNR','Guest_Adult','Guest_Child_Age','Guest_Infant_Age','Price','Guest_id'];

    $countKeys = [];
    //echo '<pre>';
    foreach($resultData as $key=>$data){ 
          //  print_r($data);
        $tempRow = $data;
        $newKey = $data['Id'];
        $currentKeys = array_keys($data);
        // make new $testarray, with unique main keys by joining guest_id and reservationid
        if(isset($data['Guest_id']) && !empty($data['Guest_id'])) $newKey .= $newKey.$data['Guest_id'];

        if( in_array($data['Id'], $rIds) && 
            (!isset($data['Guest_id']) || in_array($data['Guest_id'], $guestIds)) ) { 
                foreach($currentKeys as $akey){
                    if(in_array($akey, $countKeys)) 
                        $count = $countKeys[$akey];
                    else 
                        $count = 1;
                    // exlude the reservation and guest fields as they will show in multiple rows
                    if(!in_array($akey, $reservationCols) && !in_array($akey, $guestCols)){
                        if(isset($data[$akey])){
                            // add new column when muliple rows exist for arrival, departure ,rooms, hotel
                            $count++;
                            $countKeys[$akey] = $count;
                            $testArray[$newKey][$akey.$count] = $data[$akey]; 
                        }
                    }
                }
        } else {
            if(isset($data['Guest_id'])) array_push($guestIds, $data['Guest_id']);
            // here code start to show main reservation twice
            if(!in_array($data['Id'], $rIds)){
                $repeatReservation = [];
                foreach($currentKeys as $akey){
                    if(in_array($akey, $reservationCols))
                        $repeatReservation[$akey] = $data[$akey];
                    else 
                        $repeatReservation[$akey] = '';
                }
                array_push($rIds, $data['Id']);
                $testArray[] = $repeatReservation;
            } 
            $testArray[$newKey] = $data; 
        }
    }
  //  exit;

    /* here code start to get all all sub indexes of $testarray */
    $allIndexes = [];
    foreach($testArray as $key=>$row){
        $indexes = array_keys($row);
        foreach($indexes as $index){
            if(!in_array($index, $allIndexes)){
                array_push($allIndexes, $index);
            }

        }
    }
    

    /* here as every main index in testarray has different variable subindexes, that create issue in datatable,
        so here we make equal number of subindexes for each main index
    */
    $dataArray = [];
    foreach($testArray as $key=>$row){
        foreach($allIndexes as $index){
            if(isset($testArray[$key][$index])) 
                $dataArray[$key][$index] = $testArray[$key][$index];
            else 
                $dataArray[$key][$index] = ''; // set empty value if index not exist
        }
    }

    $resultData = $dataArray;
    if(!empty($resultData)){

        $columns = array_map(function($column){
            $column = str_replace('_', ' ', $column);
            $column = ucfirst($column);
            return $column;
        },$allIndexes);
    } 

}  else{
    echo 'No Record Found';
}
mysqli_close($conn);














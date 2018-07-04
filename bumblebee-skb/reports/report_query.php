<?php
    

if(isset($_REQUEST['sect']) && $_REQUEST['sect']=='fsft'){ 
    $query .= ' WHERE R.fast_track=1 && R.status!=2';
} else {
    $_REQUEST['sect'] = 'gh';
$query .= ' WHERE R.fast_track=0 && R.status!=2';
}

if(isset($_REQUEST['fromDate']) && isset($_REQUEST['toDate'])){

    $fromDate = strtotime($_REQUEST['fromDate']);
    $toDate = strtotime($_REQUEST['toDate']);
    $dateRangeText = date('M d, Y',$fromDate). ' - ' .date('M d, Y',$toDate);

    $fromDate = $_REQUEST['fromDate'];
    $toDate = $_REQUEST['toDate'];
    $query .= ' && (R.arr_date between CAST("'.$fromDate.'" AS DATE) AND CAST("'.$toDate.'" AS DATE))';
}

if(isset($_REQUEST['query'])){
    $searchText = $_REQUEST['query'];
    $query .= ' && (R.first_name LIKE "%'.$searchText.'%" || R.last_name LIKE "%'.$searchText.'%" || R.pnr LIKE "%'.$searchText.'%" || R.tour_operator LIKE "%'.$searchText.'%" || R.operator_code LIKE "%'.$searchText.'%" || R.tour_notes LIKE "%'.$searchText.'%" || R.flight_class LIKE "%'.$searchText.'%" || R.arr_transport LIKE "%'.$searchText.'%" || R.rep_type LIKE "%'.$searchText.'%" || R.client_reqs LIKE "%'.$searchText.'%" || R.dpt_transport LIKE "%'.$searchText.'%" || R.dpt_pickup LIKE "%'.$searchText.'%" || dpt_dropoff LIKE "%'.$searchText.'%" || dpt_notes LIKE "%'.$searchText.'%" || R.modified_by LIKE "%'.$searchText.'%" || R.arr_hotel_notes LIKE "%'.$searchText.'%" || R.dpt_transport_notes LIKE "%'.$searchText.'%")' ;
}


// print_r($query); exit;
$sqlrows=mysqli_num_rows(mysqli_query($conn,$query));

if(!isset($_REQUEST['all'])) 
    $query .= ' LIMIT  '.$start.', '.$limit;


$queryResource = mysqli_query($conn,$query);



if(!empty($queryResource)){
    $TotalRows = mysqli_num_rows($queryResource);
}
if(isset($TotalRows) and $TotalRows > 0){
    // output data of each row
    $resultData = [];
    
    while($row = mysqli_fetch_assoc($queryResource)) {
      
        $resultData[] = $row;
    }
    if(!empty($resultData)){
        $columns = array_keys($resultData[0]);
        $columns = array_map(function($column){
            $column = str_replace('_', ' ', $column);
            $column = ucfirst($column);
            return $column;
        },$columns);
    }
}else{
    echo 'No Record Found';
}
 ?>
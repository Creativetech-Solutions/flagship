<?php 
/*header("Content-Type: text/html; charset=ISO-8859-1");
header('Cache-Control: no cache');
session_cache_limiter('private_no_expire');*/
// session_start();
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
$url = '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
error_reporting(E_ALL &~ E_DEPRECATED);
  define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
  
  if (!$user->levelCheck("2,9,10"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */
include ('ref.php');
include('header.php');
include ('select.class.php');
$countrycode = "BGI";
$fsref = "$countrycode-$flagship_ref";
$loggedinas = $row->fname . ' ' . $row->lname;
site_header('Add Reservations');

// echo '<pre>'; print_r($_POST); exit;

if(isset($_POST['addreservation']))
{
    //Arrivals And Departures Flight Details
    $arrivals = true;
    $departures = true;
    if(isset($_POST['arrivalsDivCheckBox']) && $_POST['arrivalsDivCheckBox']){
        $arrivals = false;
    };
    if(isset($_POST['departuresDivCheckBox']) && $_POST['departuresDivCheckBox']){
        $departures = false;
    };

    //Sanitize data
    $title_name             = QuoteSmart(@$_POST['title_name']);
    $first_name             = QuoteSmart(@$_POST['first_name']);
	$last_name              = QuoteSmart(@$_POST['last_name']);
	$pnr                    = QuoteSmart(@$_POST['pnr']);
    $tour_oper              = QuoteSmart(@$_POST['tour_oper']);
    $oper_code              = QuoteSmart(@$_POST['oper_code']);
    $tour_ref_no            = QuoteSmart(@$_POST['tour_ref_no']);
    $tour_notes             = QuoteSmart(@$_POST['tour_notes']);

    if(!empty($_POST['room_type'])){
        $room_type = QuoteSmart($_POST['room_type']);
    }else{
        $room_type = '';
    }

    $rep_type               = (isset($_POST['rep_type']) and !empty($_POST['rep_type']))?QuoteSmart(implode(', ',@$_POST['rep_type'])):'';
    $client_reqs            = QuoteSmart(implode(', ',@$_POST['client_reqs']));
    $infant_seats           = QuoteSmart(@$_POST['infant_seats']);
    $child_seats            = QuoteSmart(@$_POST['child_seats']);
    $booster_seats          = isset($_POST['booster_seats'])?QuoteSmart($_POST['booster_seats']):'';
    $vouchers               = QuoteSmart(@$_POST['vouchers']);
    $dpt_flight_class       = QuoteSmart(@$_POST['dpt_flight_class']);
    $rooms                  = QuoteSmart(@$_POST['no_of_rooms']);
    $room_no                = QuoteSmart(@$_POST['room_no']);
    $arr_main               = 1;
    $dpt_main               = 1;

    //if departures
    if($departures){
        $dpt_date               = QuoteSmart(@$_POST['dpt_date']);
        $dpt_time               = QuoteSmart(@$_POST['dpt_time']);
        $dpt_flight_no          = QuoteSmart(@$_POST['dpt_flight_no']);
        $dpt_pickup             = QuoteSmart(@$_POST['dpt_pickup']);
        $dpt_dropoff            = QuoteSmart(@$_POST['dpt_dropoff']);
        $pickup_time            = QuoteSmart(@$_POST['pickup_time']);
        $dpt_notes              = QuoteSmart(@$_POST['dpt_notes']);
        $dpt_transport_notes    = QuoteSmart(@$_POST['dpt_transport_notes']);
        // requrirement
        $dpt_vouchers          = QuoteSmart(@$_POST['dpt_vouchers']);
        $dpt_cold_towels            = QuoteSmart(@$_POST['dpt_cold_towels']);
        $dpt_bottled_water            = QuoteSmart(@$_POST['dpt_bottled_water']);
    }else{
        $dpt_date               = '0000-00-00';
        $dpt_time               = "";
        $dpt_flight_no          = "";
        $dpt_transport          = "";
        $dpt_driver             = "";
        $dpt_vehicle_no         = "";
        $dpt_pickup             = "";
        $dpt_dropoff            = "";
        $pickup_time            = "";
        $dpt_notes              = "";
        $dpt_vouchers           = "";
        $dpt_cold_towels        = "";
        $dpt_bottled_water      = "";
    }

    //if arrivals
    if($arrivals){
        $arr_date               = QuoteSmart(@$_POST['arr_date']);
        $arr_time               = QuoteSmart(@$_POST['arr_time']);
        $arr_flight_no          = QuoteSmart(@$_POST['arr_flight_no']);
        $flight_class           = QuoteSmart(@$_POST['flight_class']);
        /*    if(isset($_POST['arr_transport'])){
            $arr_transport          =  $_POST['arr_transport'];
        }else{
            $arr_transport          = '';
        }
 
        $arr_driver             = $_POST['arr_driver']; 
        $arr_vehicle_no         = $_POST['arr_vehicle_no'];*/
        $arr_pickup             = QuoteSmart(@$_POST['arr_pickup']);
        $arr_dropoff            = QuoteSmart(@$_POST['arr_dropoff']);
        $arr_transport_notes    = QuoteSmart(@$_POST['arr_transport_notes']);
        $arr_hotel_notes        = QuoteSmart(@$_POST['arr_hotel_notes']);
        //requirements
        $bottled_water          = QuoteSmart(@$_POST['bottled_water']);
        $cold_towels            = QuoteSmart(@$_POST['cold_towels']);
        $adults                 = QuoteSmart(@$_POST['adults']);
        //$teen                 = QuoteSmart(@$_POST['teen']);
        $children               = QuoteSmart(@$_POST['children']);
        $infants                = QuoteSmart(@$_POST['infants']);
    }else{
        $arr_date               = '';
        $arr_time               = '';
        $arr_flight_no          = '';
        $flight_class           = '';
        $arr_transport          = '';
        $arr_driver             = '';
        $arr_vehicle_no         = '';
        $arr_pickup             = '';
        $arr_dropoff            = '';
        $arr_transport_notes    = '';
        $arr_hotel_notes        = '';
        //requirements
        $bottled_water          = '';
        $cold_towels            = '';
        $adults                 = '';
       // $teen                 = '';
        $children               = '';
        $infants                = '';
    }

    //Excursion
    $excursion_name = QuoteSmart(@$_POST['excursion_name']);
    $excursion_date = QuoteSmart(@$_POST['excursion_date']);
    $excursion_pickup = QuoteSmart(@$_POST['excursion_pickup']);
    $excursion_confirm_by = QuoteSmart(@$_POST['excursion_confirm_by']);
    $excursion_confirm_date = QuoteSmart(@$_POST['excursion_confirm_date']);
    $excursion_guests = QuoteSmart(@$_POST['excursion_guests']);

    //Arrival Rooms
        //Room0
    $arr0_room_type = $_POST['arr0_room_type'];
    $arr0_room_no = $_POST['arr0_room_no'];
    $arr0_room_last_name = $_POST['arr0_room_last_name'];
        //Room1
    if(isset($_POST['arr0_room_no2'])){
        $arr0_room_type1 = $_POST['arr0_room_type1'];
        $arr0_room_no1 = $_POST['arr0_room_no1'];
        $arr0_room_last_name1 = $_POST['arr0_room_last_name1'];
    }
        //Room2
    if(isset($_POST['arr0_room_no2'])){
        $arr0_room_type2 = $_POST['arr0_room_type2'];
        $arr0_room_no2 = $_POST['arr0_room_no2'];
        $arr0_room_last_name2 = $_POST['arr0_room_last_name2'];
    }
        //Room3
    if(isset($_POST['arr0_room_no3'])){
        $arr0_room_type3 = $_POST['arr0_room_type3'];
        $arr0_room_no3 = $_POST['arr0_room_no3'];
        $arr0_room_last_name3 = $_POST['arr0_room_last_name3'];
    }
        //Room4
    if(isset($_POST['arr0_room_no4'])){
        $arr0_room_type4 = $_POST['arr0_room_type4'];
        $arr0_room_no4 = $_POST['arr0_room_no4'];
        $arr0_room_last_name4 = $_POST['arr0_room_last_name4'];
    }
        //Room5
    if(isset($_POST['arr0_room_no5'])){
        $arr0_room_type5 = $_POST['arr0_room_type5'];
        $arr0_room_no5 = $_POST['arr0_room_no5'];
        $arr0_room_last_name5 = $_POST['arr0_room_last_name5'];
    }

    //JetCenter
    if(isset($_POST['jetCenter'])){
        $jetCenter   = 1;
    }else{
        $jetCenter   = 0;
    }

    //Arrivals Transport Mode.
    $arr_transport_mode = $_POST['arr_transport'];
    $arrdriver = $_POST['arr_driver'];
    $arr_vehicle = $_POST['arr_vehicle_no'];
    $arr_luggage_vehicle_no = $_POST['arr_luggage_vehicle_no'];

    $arr_transport  = $arr_driver = $arr_vehicle_no = '';

    $arrival_transport_array = array();
    if(!empty($arr_transport_mode) and is_array($arr_transport_mode)){
        $i = 0;
        foreach($arr_transport_mode as $key=>$val){
            if($i == 0){
                $arr_transport = $val;
                $arr_driver = $arrdriver[$key];
                $arr_vehicle_no = $arr_vehicle[$key];

            }
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arrdriver[$key],
                'vehicle' => $arr_vehicle[$key],
                // 'luggage_vehicle' => $arr_luggage_vehicle_no[$key]
            );
            $arrival_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }

    // departure transport mode 

    //departure Transport Mode.
    $dpt_transporttype = $_POST['dpt_transporttype'];
    $dpttransport = $_POST['dpt_transport'];
    $dptdriver = $_POST['dpt_driver'];
    $dptvehicle_no = $_POST['dpt_vehicle_no'];
    //$dpt_luggage_vehicle_no = $_POST['arr_luggage_vehicle_no'];

    $dpt_transport  = $dpt_driver = $dpt_vehicle_no = '';

    $dpt_transport_array = array();
    if(!empty($dptdriver) and is_array($dptdriver)){
        $i = 0;
        foreach($dptdriver as $key=>$val){
            if($i == 0){
                $dpt_transport = $dpt_transporttype;
                $dpt_driver = $val;
                $dpt_vehicle_no = $dptvehicle_no[$key];

                $transmode = $dpt_transporttype;
            } else 
                $transmode = $dpttransport[$key];

            $tempArray = array(
                'transport_mode' => $transmode,
                'driver' => $val,
                'vehicle' => $dptvehicle_no[$key]
            );
            $dpt_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }

    //Arrival 1
    $arr_date1              = QuoteSmart(@$_POST['arr_date1']);
    $arr_time1              = QuoteSmart(@$_POST['arr_time1']);
    $arr_flight_no1         = QuoteSmart(@$_POST['arr_flight_no1']);
    $flight_class1          = QuoteSmart(@$_POST['flight_class1']);
    $arr_pickup1            = QuoteSmart(@$_POST['arr_pickup1']);
    $arr_dropoff1           = QuoteSmart(@$_POST['arr_dropoff1']);
    $room_type1             = QuoteSmart(@$_POST['room_type1']);
    $rep_type1              = (isset($_POST['rep_type1']) and !empty($_POST['rep_type1']))?QuoteSmart(implode(', ',@$_POST['rep_type1'])):'';
    $client1_reqs           = !empty($_POST['client1_reqs'])?QuoteSmart(implode(', ',$_POST['client1_reqs'])):'';
    $arr_transport_notes1   = QuoteSmart(@$_POST['arr_transport_notes1']);
    $arr_hotel_notes1       = QuoteSmart(@$_POST['arr_hotel_notes1']);
    $infant_seats1          = QuoteSmart(@$_POST['infant_seats1']);
    $child_seats1           = QuoteSmart(@$_POST['child_seats1']);
    $booster_seats1         = QuoteSmart(@$_POST['booster_seats1']);
    $vouchers1              = QuoteSmart(@$_POST['vouchers1']);
    $cold_towels1           = QuoteSmart(@$_POST['cold_towels1']);
    $bottled_water1         = QuoteSmart(@$_POST['bottled_water1']);
    $rooms1                 = QuoteSmart(@$_POST['no_of_rooms1']);
    $room_no1               = QuoteSmart(@$_POST['room_no1']);

    //Excursion 1
    $excursion_name1 = QuoteSmart(@$_POST['excursion_name1']);
    $excursion_date1 = QuoteSmart(@$_POST['excursion_date1']);
    $excursion_pickup1 = QuoteSmart(@$_POST['excursion_pickup1']);
    $excursion_confirm_by1 = QuoteSmart(@$_POST['excursion_confirm_by1']);
    $excursion_confirm_date1 = QuoteSmart(@$_POST['excursion_confirm_date1']);
    $excursion_guests1 = QuoteSmart(@$_POST['excursion_guests1']);
    //Arrival Rooms
    //Room0
    $arr1_room_type = $_POST['arr1_room_type'];
    $arr1_room_no = $_POST['arr1_room_no'];
    $arr1_room_last_name = $_POST['arr1_room_last_name'];
    //Room1
    if(isset($_POST['arr1_room_no1'])){
        $arr1_room_type1 = $_POST['arr1_room_type1'];
        $arr1_room_no1 = $_POST['arr1_room_no1'];
        $arr1_room_last_name1 = $_POST['arr1_room_last_name1'];
    }
    //Room2
    if (isset($_POST['arr1_room_no2'])) {
        $arr1_room_type2 = $_POST['arr1_room_type2'];
        $arr1_room_no2 = $_POST['arr1_room_no2'];
        $arr1_room_last_name2 = $_POST['arr1_room_last_name2'];
    }
    //Room3
    if (isset($_POST['arr1_room_no3'])) {
        $arr1_room_type3 = $_POST['arr1_room_type3'];
        $arr1_room_no3 = $_POST['arr1_room_no3'];
        $arr1_room_last_name3 = $_POST['arr1_room_last_name3'];
    }
    //Room4
    if (isset($_POST['arr1_room_no4'])) {
        $arr1_room_type4 = $_POST['arr1_room_type4'];
        $arr1_room_no4 = $_POST['arr1_room_no4'];
        $arr1_room_last_name4 = $_POST['arr1_room_last_name4'];
    }
    //Room5
    if (isset($_POST['arr1_room_no5'])) {
        $arr1_room_type5 = $_POST['arr1_room_type5'];
        $arr1_room_no5 = $_POST['arr1_room_no5'];
        $arr1_room_last_name5 = $_POST['arr1_room_last_name5'];
    }

 
    //Arrivals Transport Mode.
    $arr_transport_mode = $_POST['arr1_transport'];
    $arrdriver = $_POST['arr1_driver'];
    $arr_vehicle = $_POST['arr1_vehicle_no'];

    $arr1_transport  = $arr_driver1 = $arr_vehicle_no1 = '';

    $arrival1_transport_array = array();
    if(!empty($arr_transport_mode) and is_array($arr_transport_mode)){
        $i = 0;
        foreach($arr_transport_mode as $key=>$val){
            if($i == 0){
                $arr1_transport = $val;
                $arr_driver1 = $arrdriver[$key];
                $arr_vehicle_no1 = $arr_vehicle[$key];
            }
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arrdriver[$key],
                'vehicle' => $arr_vehicle[$key]
            );
            $arrival1_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }



    //Arrival 2
    $arr_date2              = QuoteSmart(@$_POST['arr_date2']);
    $arr_time2              = QuoteSmart(@$_POST['arr_time2']);
    $arr_flight_no2         = QuoteSmart(@$_POST['arr_flight_no2']);
    $flight_class2          = QuoteSmart(@$_POST['flight_class2']);
    $arr_pickup2            = QuoteSmart(@$_POST['arr_pickup2']);
    $arr_dropoff2           = QuoteSmart(@$_POST['arr_dropoff2']);
    $room_type2             = QuoteSmart(@$_POST['room_type2']);
    $rep_type2              = (isset($_POST['rep_type2']) and !empty($_POST['rep_type2']))?QuoteSmart(implode(', ',@$_POST['rep_type2'])):'';
    $client2_reqs           = !empty($_POST['client2_reqs'])?QuoteSmart(implode(', ',$_POST['client2_reqs'])):'';
    $arr_transport_notes2   = QuoteSmart(@$_POST['arr_transport_notes2']);
    $arr_hotel_notes2       = QuoteSmart(@$_POST['arr_hotel_notes2']);
    $infant_seats2          = QuoteSmart(@$_POST['infant_seats2']);
    $child_seats2           = QuoteSmart(@$_POST['child_seats2']);
    $booster_seats2         = QuoteSmart(@$_POST['booster_seats2']);
    $vouchers2              = QuoteSmart(@$_POST['vouchers2']);
    $cold_towels2           = QuoteSmart(@$_POST['cold_towels2']);
    $bottled_water2         = QuoteSmart(@$_POST['bottled_water2']);
    $rooms2                 = QuoteSmart(@$_POST['no_of_rooms2']);
    $room_no2               = QuoteSmart(@$_POST['room_no2']);
    //Excursion 2
    $excursion_name2 = QuoteSmart(@$_POST['excursion_name2']);
    $excursion_date2 = QuoteSmart(@$_POST['excursion_date2']);
    $excursion_pickup2 = QuoteSmart(@$_POST['excursion_pickup2']);
    $excursion_confirm_by2 = QuoteSmart(@$_POST['excursion_confirm_by2']);
    $excursion_confirm_date2 = QuoteSmart(@$_POST['excursion_confirm_date2']);
    $excursion_guests2 = QuoteSmart(@$_POST['excursion_guests2']);
    //Arrival Rooms
    //Room0
    $arr2_room_type = $_POST['arr2_room_type'];
    $arr2_room_no = $_POST['arr2_room_no'];
    $arr2_room_last_name = $_POST['arr2_room_last_name'];
    //Room1
    if (isset($_POST['arr2_room_no1'])) {
        $arr2_room_type1 = $_POST['arr2_room_type1'];
        $arr2_room_no1 = $_POST['arr2_room_no1'];
        $arr2_room_last_name1 = $_POST['arr2_room_last_name1'];
    }
    //Room2
    if (isset($_POST['arr2_room_no2'])) {
        $arr2_room_type2 = $_POST['arr2_room_type2'];
        $arr2_room_no2 = $_POST['arr2_room_no2'];
        $arr2_room_last_name2 = $_POST['arr2_room_last_name2'];
    }
    //Room3
    if (isset($_POST['arr2_room_no3'])) {
        $arr2_room_type3 = $_POST['arr2_room_type3'];
        $arr2_room_no3 = $_POST['arr2_room_no3'];
        $arr2_room_last_name3 = $_POST['arr2_room_last_name3'];
    }
    //Room4
    if (isset($_POST['arr2_room_no4'])) {
        $arr2_room_type4 = $_POST['arr2_room_type4'];
        $arr2_room_no4 = $_POST['arr2_room_no4'];
        $arr2_room_last_name4 = $_POST['arr2_room_last_name4'];
    }
    //Room5
    if (isset($_POST['arr2_room_no5'])) {
        $arr2_room_type5 = $_POST['arr2_room_type5'];
        $arr2_room_no5 = $_POST['arr2_room_no5'];
        $arr2_room_last_name5 = $_POST['arr2_room_last_name5'];
    }

     //Arrivals Transport Mode.
    $arr_transport_mode = $_POST['arr2_transport'];
    $arrdriver = $_POST['arr2_driver'];
    $arr_vehicle = $_POST['arr2_vehicle_no'];

    $arr2_transport  = $arr_driver2 = $arr_vehicle_no2 = '';

    $arrival2_transport_array = array();
    if(!empty($arr_transport_mode) and is_array($arr_transport_mode)){
        $i = 0;
        foreach($arr_transport_mode as $key=>$val){
            if($i == 0){
                $arr2_transport = $val;
                $arr_driver2 = $arrdriver[$key];
                $arr_vehicle_no2 = $arr_vehicle[$key];
            }
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arrdriver[$key],
                'vehicle' => $arr_vehicle[$key]
            );
            $arrival2_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }

    //Arrival 3
    $arr_date3              = QuoteSmart(@$_POST['arr_date3']);
    $arr_time3              = QuoteSmart(@$_POST['arr_time3']);
    $arr_flight_no3         = QuoteSmart(@$_POST['arr_flight_no3']);
    $flight_class3          = QuoteSmart(@$_POST['flight_class3']);
    $arr_pickup3            = QuoteSmart(@$_POST['arr_pickup3']);
    $arr_dropoff3           = QuoteSmart(@$_POST['arr_dropoff3']);
    $room_type3             = QuoteSmart(@$_POST['room_type3']);
    $rep_type3              =  (isset($_POST['rep_type3']) and !empty($_POST['rep_type3']))?QuoteSmart(implode(', ',@$_POST['rep_type3'])):'';
    $client3_reqs           = !empty($_POST['client3_reqs'])?QuoteSmart(implode(', ',$_POST['client3_reqs'])):'';
    $arr_transport_notes3   = QuoteSmart(@$_POST['arr_transport_notes3']);
    $arr_hotel_notes3       = QuoteSmart(@$_POST['arr_hotel_notes3']);
    $infant_seats3          = QuoteSmart(@$_POST['infant_seats3']);
    $child_seats3           = QuoteSmart(@$_POST['child_seats3']);
    $booster_seats3         = QuoteSmart(@$_POST['booster_seats3']);
    $vouchers3              = QuoteSmart(@$_POST['vouchers3']);
    $cold_towels3           = QuoteSmart(@$_POST['cold_towels3']);
    $bottled_water3         = QuoteSmart(@$_POST['bottled_water3']);
    $rooms3                 = QuoteSmart(@$_POST['no_of_rooms3']);
    $room_no3               = QuoteSmart(@$_POST['room_no3']);
    //Excursion 2
    $excursion_name3 = QuoteSmart(@$_POST['excursion_name3']);
    $excursion_date3 = QuoteSmart(@$_POST['excursion_date3']);
    $excursion_pickup3 = QuoteSmart(@$_POST['excursion_pickup3']);
    $excursion_confirm_by3 = QuoteSmart(@$_POST['excursion_confirm_by3']);
    $excursion_confirm_date3 = QuoteSmart(@$_POST['excursion_confirm_date3']);
    $excursion_guests3 = QuoteSmart(@$_POST['excursion_guests3']);
    //Arrival Rooms
    //Room0
    if (isset($_POST['arr3_room_no'])) {
        $arr3_room_type = $_POST['arr3_room_type'];
        $arr3_room_no = $_POST['arr3_room_no'];
        $arr3_room_last_name = $_POST['arr3_room_last_name'];
    }
    //Room1
    if (isset($_POST['arr3_room_no1'])) {
        $arr3_room_type1 = $_POST['arr3_room_type1'];
        $arr3_room_no1 = $_POST['arr3_room_no1'];
        $arr3_room_last_name1 = $_POST['arr3_room_last_name1'];
    }
    //Room2
    if (isset($_POST['arr3_room_no2'])) {
        $arr3_room_type2 = $_POST['arr3_room_type2'];
        $arr3_room_no2 = $_POST['arr3_room_no2'];
        $arr3_room_last_name2 = $_POST['arr3_room_last_name2'];
    }
    //Room3
    if (isset($_POST['arr3_room_no3'])) {
        $arr3_room_type3 = $_POST['arr3_room_type3'];
        $arr3_room_no3 = $_POST['arr3_room_no3'];
        $arr3_room_last_name3 = $_POST['arr3_room_last_name3'];
    }
    //Room4
    if (isset($_POST['arr3_room_no4'])) {
        $arr3_room_type4 = $_POST['arr3_room_type4'];
        $arr3_room_no4 = $_POST['arr3_room_no4'];
        $arr3_room_last_name4 = $_POST['arr3_room_last_name4'];
    }
    //Room5
    if (isset($_POST['arr3_room_no5'])) {
        $arr3_room_type5 = $_POST['arr3_room_type5'];
        $arr3_room_no5 = $_POST['arr3_room_no5'];
        $arr3_room_last_name5 = $_POST['arr3_room_last_name5'];
    }

  //Arrivals Transport Mode.
    $arr_transport_mode = $_POST['arr3_transport'];
    $arrdriver = $_POST['arr3_driver'];
    $arr_vehicle = $_POST['arr3_vehicle_no'];

    $arr3_transport  = $arr_driver3 = $arr_vehicle_no3 = '';

    $arrival3_transport_array = array();
    if(!empty($arr_transport_mode) and is_array($arr_transport_mode)){
        $i = 0;
        foreach($arr_transport_mode as $key=>$val){
            if($i == 0){
                $arr3_transport = $val;
                $arr_driver3 = $arrdriver[$key];
                $arr_vehicle_no3 = $arr_vehicle[$key];
            }
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arrdriver[$key],
                'vehicle' => $arr_vehicle[$key]
            );
            $arrival3_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }


    //Departure 1
    $dpt_date1              = QuoteSmart(@$_POST['dpt_date1']);
    $dpt_time1              = QuoteSmart(@$_POST['dpt_time1']);
    $dpt_flight_no1         = QuoteSmart(@$_POST['dpt_flight_no1']);
    $dpt_flight_class1      = QuoteSmart(@$_POST['dpt_flight_class1']);
    $dpt_pickup1            = QuoteSmart(@$_POST['dpt_pickup1']);
    $dpt_dropoff1           = QuoteSmart(@$_POST['dpt_dropoff1']);
    $pickup_time1           = QuoteSmart(@$_POST['pickup_time1']);
    $dpt_transport_notes1   = QuoteSmart(@$_POST['dpt_transport_notes1']);
    // requrirement
    $dpt_vouchers1          = QuoteSmart(@$_POST['dpt_vouchers1']);
    $dpt_cold_towels1           = QuoteSmart(@$_POST['dpt_cold_towels1']);
    $dpt_bottled_water1            = QuoteSmart(@$_POST['dpt_bottled_water1']);
    //JetCenter 1
    if(isset($_POST['jetCenter1'])){
        $jetCenter1   = 1;
    }else{
        $jetCenter1   = 0;
    }
    

    //departure Transport Mode.
    $dpttransport = $_POST['dpt1_transport'];
    $dptdriver = $_POST['dpt1_driver'];
    $dptvehicle_no = $_POST['dpt1_vehicle_no'];
    //$dpt_luggage_vehicle_no = $_POST['arr_luggage_vehicle_no'];

    $dpt1_transport  = $dpt_driver1 = $dpt_vehicle_no1 = '';

    $dpt1_transport_array = array();
    if(!empty($dpttransport) and is_array($dpttransport)){
        $i = 0;
        foreach($dpttransport as $key=>$val){
            if($i == 0){
                $dpt1_transport = $val;
                $dpt_driver1 = $dptdriver[$key];
                $dpt_vehicle_no1 = $dptvehicle_no[$key];

            }
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $dptdriver[$key],
                'vehicle' => $dptvehicle_no[$key]
            );
            $dpt1_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }



    //Departure 2
    $dpt_date2              = QuoteSmart(@$_POST['dpt_date2']);
    $dpt_time2              = QuoteSmart(@$_POST['dpt_time2']);
    $dpt_flight_no2         = QuoteSmart(@$_POST['dpt_flight_no2']);
    $dpt_flight_class2      = QuoteSmart(@$_POST['dpt_flight_class2']);
    $dpt2_transport         = !empty($_POST['dpt2_transport'])?QuoteSmart($_POST['dpt2_transport']):'';
    $dpt_driver2            = QuoteSmart(@$_POST['dpt_driver2']);
    $dpt_vehicle_no2        = QuoteSmart(@$_POST['dpt_vehicle_no2']);
    $dpt_pickup2            = QuoteSmart(@$_POST['dpt_pickup2']);
    $dpt_dropoff2           = QuoteSmart(@$_POST['dpt_dropoff2']);
    $pickup_time2           = QuoteSmart(@$_POST['pickup_time2']);
    $dpt_transport_notes2   = QuoteSmart(@$_POST['dpt_transport_notes2']);
    // requrirement
    $dpt_vouchers2          = QuoteSmart(@$_POST['dpt_vouchers2']);
    $dpt_cold_towels2           = QuoteSmart(@$_POST['dpt_cold_towels2']);
    $dpt_bottled_water2           = QuoteSmart(@$_POST['dpt_bottled_water2']);
    //JetCenter 2
    if(isset($_POST['jetCenter2'])){
        $jetCenter2   = 1;
    }else{
        $jetCenter2   = 0;
    }
    
     //departure Transport Mode.
    $dpttransport = $_POST['dpt2_transport'];
    $dptdriver = $_POST['dpt2_driver'];
    $dptvehicle_no = $_POST['dpt2_vehicle_no'];
    //$dpt_luggage_vehicle_no = $_POST['arr_luggage_vehicle_no'];

    $dpt2_transport  = $dpt_driver2 = $dpt_vehicle_no2 = '';

    $dpt2_transport_array = array();
    if(!empty($dpttransport) and is_array($dpttransport)){
        $i = 0;
        foreach($dpttransport as $key=>$val){
            if($i == 0){
                $dpt2_transport = $val;
                $dpt_driver2 = $dptdriver[$key];
                $dpt_vehicle_no2 = $dptvehicle_no[$key];

            }
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $dptdriver[$key],
                'vehicle' => $dptvehicle_no[$key]
            );
            $dpt2_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }

    //Departure 3
    $dpt_date3              = QuoteSmart(@$_POST['dpt_date3']);
    $dpt_time3              = QuoteSmart(@$_POST['dpt_time3']);
    $dpt_flight_no3         = QuoteSmart(@$_POST['dpt_flight_no3']);
    $dpt_flight_class3      = QuoteSmart(@$_POST['dpt_flight_class3']);
    $dpt3_transport         = !empty($_POST['dpt3_transport'])?QuoteSmart($_POST['dpt3_transport']):'';
    $dpt_driver3            = QuoteSmart(@$_POST['dpt_driver3']);
    $dpt_vehicle_no3        = QuoteSmart(@$_POST['dpt_vehicle_no3']);
    $dpt_pickup3            = QuoteSmart(@$_POST['dpt_pickup3']);
    $dpt_dropoff3           = QuoteSmart(@$_POST['dpt_dropoff3']);
    $pickup_time3           = QuoteSmart(@$_POST['pickup_time3']);
    $dpt_transport_notes3   = QuoteSmart(@$_POST['dpt_transport_notes3']);
    // requrirement
    $dpt_vouchers3         = QuoteSmart(@$_POST['dpt_vouchers3']);
    $dpt_cold_towels3          = QuoteSmart(@$_POST['dpt_cold_towels3']);
    $dpt_bottled_water3           = QuoteSmart(@$_POST['dpt_bottled_water3']);
    //JetCenter 3
    if(isset($_POST['jetCenter3'])){
        $jetCenter3   = 1;
    }else{
        $jetCenter3   = 0;
    }
    
     //departure Transport Mode.
    $dpttransport = $_POST['dpt3_transport'];
    $dptdriver = $_POST['dpt3_driver'];
    $dptvehicle_no = $_POST['dpt3_vehicle_no'];
    $dpt_luggage_vehicle_no = $_POST['arr_luggage_vehicle_no'];

    $dpt3_transport  = $dpt_driver3 = $dpt_vehicle_no3 = '';

    $dpt3_transport_array = array();
    if(!empty($dpttransport) and is_array($dpttransport)){
        $i = 0;
        foreach($dpttransport as $key=>$val){
            if($i == 0){
                $dpt3_transport = $val;
                $dpt_driver3 = $dptdriver[$key];
                $dpt_vehicle_no3 = $dptvehicle_no[$key];

            }
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $dptdriver[$key],
                'vehicle' => $dptvehicle_no[$key]
            );
            $dpt3_transport_array[$key] = $tempArray;
            $i += 1;
        }
    }


    //Transfer
    $transfer_pickup        = QuoteSmart(@$_POST['transfer_pickup']);
    $transfer_time          = QuoteSmart(@$_POST['transfer_pickup_time']);
    $transfer_pickup_date   = QuoteSmart(@$_POST['transfer_pickup_date']);
    $transfer_transport     = !empty($_POST['transfer_transport'])?QuoteSmart(implode(', ',$_POST['transfer_transport'])):'';
    $transfer_dropoff       = QuoteSmart(@$_POST['transfer_dropoff']);
    $transfer_driver        = QuoteSmart(@$_POST['transfer_driver']);
    $transfer_vehicle_no    = QuoteSmart(@$_POST['transfer_vehicle_no']);
    $transfer_notes         = QuoteSmart(@$_POST['transfer_notes']);
    
    //Transfer 1
    $transfer_pickup1       = QuoteSmart(@$_POST['transfer_pickup1']);
    $transfer_time1         = QuoteSmart(@$_POST['transfer_pickup_time1']);
    $transfer_pickup_date1  = QuoteSmart(@$_POST['transfer_pickup_date1']);
    $transfer1_transport    = !empty($_POST['transfer1_transport'])?QuoteSmart(implode(', ',$_POST['transfer1_transport'])):'';
    $transfer_dropoff1      = QuoteSmart(@$_POST['transfer_dropoff1']);
    $transfer_driver1       = QuoteSmart(@$_POST['transfer_driver1']);
    $transfer_vehicle_no1   = QuoteSmart(@$_POST['transfer_vehicle_no1']);
    $transfer_notes1        = QuoteSmart(@$_POST['transfer_notes1']);

    //Transfer 2
    $transfer_pickup2       = QuoteSmart(@$_POST['transfer_pickup2']);
    $transfer_time2         = QuoteSmart(@$_POST['transfer_pickup_time2']);
    $transfer_pickup_date2  = QuoteSmart(@$_POST['transfer_pickup_date2']);
    $transfer_transport2    = !empty($_POST['transfer2_transport'])?QuoteSmart(implode(', ',$_POST['transfer2_transport'])):'';
    $transfer_dropoff2      = QuoteSmart(@$_POST['transfer_dropoff2']);
    $transfer_driver1       = QuoteSmart(@$_POST['transfer_driver2']);
    $transfer_vehicle_no2   = QuoteSmart(@$_POST['transfer_vehicle_no2']);
    $transfer_notes2        = QuoteSmart(@$_POST['transfer_notes2']);
    
    //Transfer 3
    $transfer_pickup3       = QuoteSmart(@$_POST['transfer_pickup3']);
    $transfer_time3         = QuoteSmart(@$_POST['transfer_pickup_time3']);
    $transfer_pickup_date3  = QuoteSmart(@$_POST['transfer_pickup_date3']);
    $transfer3_transport    = !empty($_POST['transfer3_transport'])?QuoteSmart(implode(', ',$_POST['transfer3_transport'])):'';
    $transfer_dropoff3      = QuoteSmart(@$_POST['transfer_dropoff3']);
    $transfer_driver3       = QuoteSmart(@$_POST['transfer_driver3']);
    $transfer_vehicle_no3   = QuoteSmart(@$_POST['transfer_vehicle_no3']);
    $transfer_notes3        = QuoteSmart(@$_POST['transfer_notes3']);



    //Additional Transfer
    $add_transfer_active        = QuoteSmart(@$_POST['add_transfer_active']);
    $add_transfer_pickup        = QuoteSmart(@$_POST['add_transfer_pickup']);
    $add_transfer_time          = QuoteSmart(@$_POST['add_transfer_pickup_time']);
    $add_transfer_pickup_date   = QuoteSmart(@$_POST['add_transfer_pickup_date']);
    $add_transfer_transport     = !empty($_POST['add_transfer_transport'])?QuoteSmart($_POST['add_transfer_transport']):'';
    $add_transfer_dropoff       = QuoteSmart(@$_POST['add_transfer_dropoff']);
    $add_transfer_driver        = QuoteSmart(@$_POST['add_transfer_driver']);
    $add_transfer_vehicle_no    = QuoteSmart(@$_POST['add_transfer_vehicle_no']);
    $add_transfer_notes         = QuoteSmart(@$_POST['add_transfer_notes']);

    //Additional Transfer 1
    $add_transfer1_active        = QuoteSmart(@$_POST['add_transfer1_active']);
    $add_transfer_pickup1       = QuoteSmart(@$_POST['add_transfer_pickup1']);
    $add_transfer_time1         = QuoteSmart(@$_POST['add_transfer_pickup_time1']);
    $add_transfer_pickup_date1  = QuoteSmart(@$_POST['add_transfer_pickup_date1']);
    $add_transfer1_transport    = !empty($_POST['add_transfer_transport1'])?QuoteSmart($_POST['add_transfer_transport1']):'';
    $add_transfer_dropoff1      = QuoteSmart(@$_POST['add_transfer_dropoff1']);
    $add_transfer_driver1       = QuoteSmart(@$_POST['add_transfer_driver1']);
    $add_transfer_vehicle_no1   = QuoteSmart(@$_POST['add_transfer_vehicle_no1']);
    $add_transfer_notes1        = QuoteSmart(@$_POST['add_transfer_notes1']);

    //Additional Transfer 2
    $add_transfer2_active        = QuoteSmart(@$_POST['add_transfer2_active']);
    $add_transfer_pickup2       = QuoteSmart(@$_POST['add_transfer_pickup2']);
    $add_transfer_time2         = QuoteSmart(@$_POST['add_transfer_pickup_time2']);
    $add_transfer_pickup_date2  = QuoteSmart(@$_POST['add_transfer_pickup_date2']);
    $add_transfer_transport2    = !empty($_POST['add_transfer_transport2'])?QuoteSmart($_POST['add_transfer_transport2']):'';
    $add_transfer_dropoff2      = QuoteSmart(@$_POST['add_transfer_dropoff2']);
    $add_transfer_driver1       = QuoteSmart(@$_POST['add_transfer_driver2']);
    $add_transfer_vehicle_no2   = QuoteSmart(@$_POST['add_transfer_vehicle_no2']);
    $add_transfer_notes2        = QuoteSmart(@$_POST['add_transfer_notes2']);

    //Additional Transfer 3
    $add_transfer3_active        = QuoteSmart(@$_POST['add_transfer3_active']);
    $add_transfer_pickup3       = QuoteSmart(@$_POST['add_transfer_pickup3']);
    $add_transfer_time3         = QuoteSmart(@$_POST['add_transfer_pickup_time3']);
    $add_transfer_pickup_date3  = QuoteSmart(@$_POST['add_transfer_pickup_date3']);
    $add_transfer3_transport    = !empty($_POST['add_transfer_transport3'])?QuoteSmart($_POST['add_transfer_transport3']):'';
    $add_transfer_dropoff3      = QuoteSmart(@$_POST['add_transfer_dropoff3']);
    $add_transfer_driver3       = QuoteSmart(@$_POST['add_transfer_driver3']);
    $add_transfer_vehicle_no3   = QuoteSmart(@$_POST['add_transfer_vehicle_no3']);
    $add_transfer_notes3        = QuoteSmart(@$_POST['add_transfer_notes3']);

    //Additional Transfer 4
    $add_transfer4_active        = QuoteSmart(@$_POST['add_transfer4_active']);
    $add_transfer_pickup4       = QuoteSmart(@$_POST['add_transfer_pickup4']);
    $add_transfer_time4         = QuoteSmart(@$_POST['add_transfer_pickup_time4']);
    $add_transfer_pickup_date4  = QuoteSmart(@$_POST['add_transfer_pickup_date4']);
    $add_transfer4_transport    = !empty($_POST['add_transfer_transport4'])?QuoteSmart($_POST['add_transfer_transport4']):'';
    $add_transfer_dropoff4      = QuoteSmart(@$_POST['add_transfer_dropoff4']);
    $add_transfer_driver4       = QuoteSmart(@$_POST['add_transfer_driver4']);
    $add_transfer_vehicle_no4   = QuoteSmart(@$_POST['add_transfer_vehicle_no4']);
    $add_transfer_notes4        = QuoteSmart(@$_POST['add_transfer_notes4']);

    //Additional Transfer 5
    $add_transfer5_active        = QuoteSmart(@$_POST['add_transfer5_active']);
    $add_transfer_pickup5       = QuoteSmart(@$_POST['add_transfer_pickup5']);
    $add_transfer_time5         = QuoteSmart(@$_POST['add_transfer_pickup_time5']);
    $add_transfer_pickup_date5  = QuoteSmart(@$_POST['add_transfer_pickup_date5']);
    $add_transfer5_transport    = !empty($_POST['add_transfer_transport5'])?QuoteSmart($_POST['add_transfer_transport5']):'';
    $add_transfer_dropoff5      = QuoteSmart(@$_POST['add_transfer_dropoff5']);
    $add_transfer_driver5       = QuoteSmart(@$_POST['add_transfer_driver5']);
    $add_transfer_vehicle_no5   = QuoteSmart(@$_POST['add_transfer_vehicle_no5']);
    $add_transfer_notes5        = QuoteSmart(@$_POST['add_transfer_notes5']);


    //Custom Code for dynamic Guest.
    $guestTitleName = $_POST['guest_title_name'];
    $guestFirstName = $_POST['guest_first_name'];
    $guestLastName = $_POST['guest_last_name'];
    $guestCell = $_POST['guest_cell'];
    $guestEmail = $_POST['guest_email'];
    if(isset($_POST['guest_adult']))
    $guestAdult = $_POST['guest_adult'];
    $guestTeenAge = $_POST['teen_age'];
    $guestChildAge = $_POST['child_age'];
    $guestInfantAge = $_POST['infant_age'];
    $guestPNR = $_POST['guest_pnr'];

    //Phase2
    //Luggage Vehicle Check
    $luggageVehicle = (isset($_POST['luggageVehicle']) and !empty($_POST['luggageVehicle']))?'Yes':'No';
    $luggageVehicle1 = (isset($_POST['luggageVehicle1']) and !empty($_POST['luggageVehicle1']))?'Yes':'No';
    $luggageVehicle2 = (isset($_POST['luggageVehicle2']) and !empty($_POST['luggageVehicle2']))?'Yes':'No';
    $luggageVehicle3 = (isset($_POST['luggageVehicle3']) and !empty($_POST['luggageVehicle3']))?'Yes':'No';



    // Number of Total Guests
    $totalNumberOfGuests = $_POST['totalGuests'];

    if(empty($totalNumberOfGuests) or !is_numeric($totalNumberOfGuests)){
        $total_guests = 1;
    }else{
        $total_guests = intval($totalNumberOfGuests);
    }

    $guestsArray = array();
    $guestCounter = 1;
    foreach($guestFirstName as $key=>$val){
        if($guestCounter != 1){
            $guestCell = '';
            $guestEmail = '';
        } 
        if (!empty($guestTitleName[$key]) || !empty($guestFirstName[$key]) || !empty($guestLastName[$key]) || !empty($guestCell[$key]) || !empty($guestEmail[$key])){
            $arrayToPush = array(
                'guestTitle' => $guestTitleName[$key],
                'guestFirstName' => $guestFirstName[$key],
                'guestLastName' => $guestLastName[$key],
                'guestAdult' => $guestAdult[$key],
                'guestCell' => $guestCell,
                'guestEmail' => $guestEmail,
                'guestChildAge' => $guestChildAge[$key],
                'guestTeenAge' => $guestTeenAge[$key],
                'guestInfantAge' => $guestInfantAge[$key],
                'guestPNR' => $guestPNR[$key]
            );
            array_push($guestsArray,$arrayToPush);
            $guestCounter += 1;
        }

    }

    
    $user_action = "add new reservation: $title_name. $first_name $last_name #ref:$fsref";
    
    $ftres = isset($_POST['ftres']) ? 1 : 0;
    $ftres1 = isset($_POST['ftres1']) ? 1 : 0;
    $ftres2 = isset($_POST['ftres2']) ? 1 : 0;
    $ftres3 = isset($_POST['ftres3']) ? 1 : 0;

    $ftdepres = isset($_POST['ftdepres']) ? 1 : 0;
    $ftdepres1 = isset($_POST['ftdepres1']) ? 1 : 0;
    $ftdepres2 = isset($_POST['ftdepres2']) ? 1 : 0;
    $ftdepres3 = isset($_POST['ftdepres3']) ? 1 : 0;

    if ($ftres > 0 || $ftdepres > 0){
        $ftnotify = 1;
    } else $ftnotify = 0;




    //Now Just Loop the GUests the the guests table
  
    if(!empty($guestsArray)){
        foreach($guestsArray as $guest){
            $sqlGuestQuery = "INSERT INTO bgi_guest ".
                "(ref_no_sys, title_name, first_name, last_name, adult, child_age, infant_age, pnr, email, cell, teen_age )".
                "VALUES ('$fsref', '".$guest['guestTitle']."', '".$guest['guestFirstName']."', '".$guest['guestLastName']."', '".(!empty($guest['guestAdult'])?1:0)."', '".$guest['guestChildAge']."', '".$guest['guestInfantAge']."', '".$guest['guestPNR']."', '".$guest['guestEmail']."', '".$guest['guestCell']."', '".$guest['guestTeenAge']."')";
            $retval1 = mysql_query( $sqlGuestQuery, $conn );
            if(mysql_errno()){
                echo $sqlGuestQuery;
                die(mysql_error());
            }
        }
    }

    //If Depends on the checkbox, if not selected, then arrivals queries would execute.
    if($arrivals){
        $sql_5 = "INSERT INTO bgi_arrivals ".
            "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no, arr_main, luggage_vehicle, fast_track,excursion_name,excursion_date,excursion_pickup,excursion_confirm_by,excursion_confirm_date,excursion_guests,room_last_name, luggage_vehicle_id) ".
            "VALUES ('$fsref', '$arr_date', '$arr_time', '$arr_flight_no', '$flight_class', '$arr_transport', '$arr_driver', '$arr_vehicle_no', '$arr_pickup', '$arr_dropoff', '$arr0_room_type', '$rep_type', '$client_reqs', '$arr_transport_notes', '$arr_hotel_notes', '$infant_seats', '$child_seats', '$booster_seats', '$vouchers', '$cold_towels', '$bottled_water', '$rooms', '$arr0_room_no', '$arr_main', '$luggageVehicle','$ftres','$excursion_name','$excursion_date','$excursion_pickup','$excursion_confirm_by','$excursion_confirm_date','$excursion_guests','$arr0_room_last_name', '$arr_luggage_vehicle_no')";
        $retval5 = mysql_query( $sql_5, $conn );
        /*    echo $sql_5;
            exit;*/

        if(mysql_errno()){
            echo $sql_5;
            echo "<br/>".mysql_error();
            $lastArrival0ID = 0;
        }else{
            $lastArrival0ID = mysql_insert_id();
        }

        if(!empty($lastArrival0ID)){
            //Need to Insert Arrival Id Column in array also
            array_walk($arrival_transport_array,function(&$subArray,$key,$lastArrival0ID){
                $subArray['arrival_id'] = $lastArrival0ID;
            },$lastArrival0ID);
            foreach($arrival_transport_array as $subArray){
                $arrivals_transport_sql = build_sql_insert('bgi_arrivals_transports',$subArray);
                //Now Run the Queries for this.
                $arrivals_transport_resource = mysql_query($arrivals_transport_sql,$conn);
                if(mysql_errno()) {
                    echo $arrivals_transport_sql;
                    echo "<br/>LINE::".__LINE__."::". mysql_error();
                }
            }

            //Insert the First Arrival Room Details.
            //For Room 0
            $sql_arrival0_room = "INSERT INTO bgi_arrivals_rooms ".
                "(arrival_id, room_type, room_number, last_name) ".
                "VALUES ('$lastArrival0ID', '$arr0_room_type', '$arr0_room_no', '$arr0_room_last_name')";
            $resource_arrival0_room = mysql_query( $sql_arrival0_room, $conn );
            if(mysql_errno()) {
                echo $sql_arrival0_room;
                echo "<br/>" . mysql_error();
                echo "Error near LINE::".__LINE__;
            }

            //now, we need to check if there is another rooms selected or not.
            if(!empty($arr0_room_no1)){
                $sql_arrival0_room1 = "INSERT INTO bgi_arrivals_rooms ".
                    "(arrival_id, room_type, room_number, last_name) ".
                    "VALUES ('$lastArrival0ID', '$arr0_room_type1', '$arr0_room_no1', '$arr0_room_last_name1')";
                $resource_arrival0_room1 = mysql_query( $sql_arrival0_room1, $conn );
                if(mysql_errno()) {
                    echo '<pre>';
                    echo $resource_arrival0_room1;
                    echo "<br/>".__LINE__."::". mysql_error();
                    echo "Error near LINE::".__LINE__;
                    echo '</pre>';
                }
            }

            if(!empty($arr0_room_no2)){
                $sql_arrival0_room2 = "INSERT INTO bgi_arrivals_rooms ".
                    "(arrival_id, room_type, room_number, last_name) ".
                    "VALUES ('$lastArrival0ID', '$arr0_room_type2', '$arr0_room_no2', '$arr0_room_last_name2')";
                $resource_arrival0_room2 = mysql_query( $sql_arrival0_room2, $conn );
                if(mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival0_room2;
                    echo "<br/>".__LINE__."::". mysql_error();
                    echo "Error near LINE::".__LINE__;
                    echo '</pre>';
                }
            }

            if(!empty($arr0_room_no3)){
                $sql_arrival0_room13= "INSERT INTO bgi_arrivals_rooms ".
                    "(arrival_id, room_type, room_number, last_name) ".
                    "VALUES ('$lastArrival0ID', '$arr0_room_type3', '$arr0_room_no3', '$arr0_room_last_name3')";
                $resource_arrival0_room3 = mysql_query( $sql_arrival0_room13, $conn );
            }

            if(!empty($arr0_room_no4)){
                $sql_arrival0_room4 = "INSERT INTO bgi_arrivals_rooms ".
                    "(arrival_id, room_type, room_number, last_name) ".
                    "VALUES ('$lastArrival0ID', '$arr0_room_type4', '$arr0_room_no4', '$arr0_room_last_name4')";
                $resource_arrival0_room4 = mysql_query( $sql_arrival0_room4, $conn );
            }

            if(!empty($arr0_room_no5)){
                $sql_arrival0_room5 = "INSERT INTO bgi_arrivals_rooms ".
                    "(arrival_id, room_type, room_number, last_name) ".
                    "VALUES ('$lastArrival0ID', '$arr0_room_type5', '$arr0_room_no5','$arr0_room_last_name5')";
                $resource_arrival0_room5 = mysql_query( $sql_arrival0_room5, $conn );
            }
        }

        $arrival1active = QuoteSmart($_POST['arrival1active']);
        if($arrival1active == 1){
            $sql_6 = "INSERT INTO bgi_arrivals ".
                "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no,luggage_vehicle, fast_track,excursion_name,excursion_date,excursion_pickup,excursion_confirm_by,excursion_confirm_date,excursion_guests, luggage_vehicle_id) ".
                "VALUES ('$fsref', '$arr_date1', '$arr_time1', '$arr_flight_no1', '$flight_class1', '$arr1_transport', '$arr_driver1', '$arr_vehicle_no1', '$arr_pickup1', '$arr_dropoff1', '$room_type1', '$rep_type1', '$client1_reqs', '$arr_transport_notes1', '$arr_hotel_notes1', '$infant_seats1', '$child_seats1', '$booster_seats1', '$vouchers1', '$cold_towels1', '$bottled_water1', '$rooms1', '$room_no1', '$luggageVehicle1','$ftres1','$excursion_name1','$excursion_date1','$excursion_pickup1','$excursion_confirm_by1','$excursion_confirm_date1','$excursion_guests1', '$arr_luggage_vehicle_no')";
            $retval6 = mysql_query( $sql_6, $conn );
            if(mysql_errno()){
                echo "<br/>".__LINE__."::". mysql_error();
                $lastArrival1ID = 0;
            }else{
                $Arr0roomIDs = array();
                $lastArrival1ID = mysql_insert_id();
            }


            //Now we need to check if we have rooms.
            if(!empty($lastArrival1ID)) {

                //Need to Insert Arrival Id Column in array also
                array_walk($arrival1_transport_array,function(&$subArray,$key,$lastArrival1ID){
                    $subArray['arrival_id'] = $lastArrival1ID;
                },$lastArrival1ID);

                foreach($arrival1_transport_array as $subArray){
                    $arrivals1_transport_sql = build_sql_insert('bgi_arrivals_transports',$subArray);
                    //Now Run the Queries for this.
                    $arrivals1_transport_resource = mysql_query($arrivals1_transport_sql,$conn);
                    if(mysql_errno()) {
                        echo $arrivals1_transport_sql;
                        echo "<br/>LINE::".__LINE__."::". mysql_error();
                    }
                }

                //Insert the First Arrival Room Details.
                //For Room 0
                $sql_arrival1_room = "INSERT INTO bgi_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival1ID', '$arr1_room_type', '$arr1_room_no', '$arr1_room_last_name')";
                $resource_arrival1_room = mysql_query($sql_arrival1_room, $conn);
                if (mysql_errno()) {
                    echo $sql_arrival1_room;
                    echo "<br/>" . mysql_error();
                    echo "Error near LINE::" . __LINE__;
                }else{
                    array_push($arr0RoomID,$Arr0roomIDs);
                }

                //now, we need to check if there is another rooms selected or not.
                //Arr1 Room1
                if(!empty($arr1_room_no1)){
                    $sql_arrival1_room1 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival1ID', '$arr1_room_type1', '$arr1_room_no1', '$arr1_room_last_name1')";
                    $resource_arrival1_room1 = mysql_query( $sql_arrival1_room1, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival1_room1;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                //now, we need to check if there is another rooms selected or not.
                //Arr1 Room2
                if(!empty($arr1_room_no2)){
                    $sql_arrival1_room2 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival1ID', '$arr1_room_type2', '$arr1_room_no2', '$arr1_room_last_name2')";
                    $resource_arrival1_room2 = mysql_query( $sql_arrival1_room2, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival1_room2;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                // Arr1 Room3
                if(!empty($arr1_room_no3)){
                    $sql_arrival1_room3 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival1ID', '$arr1_room_type3', '$arr1_room_no3', '$arr1_room_last_name3')";
                    $resource_arrival1_room3 = mysql_query( $sql_arrival1_room3, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival1_room3;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                // Arr1 Room4
                if(!empty($arr1_room_no4)){
                    $sql_arrival1_room4 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival1ID', '$arr1_room_type4', '$arr1_room_no4', '$arr1_room_last_name4')";
                    $resource_arrival1_room4 = mysql_query( $sql_arrival1_room3, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival1_room4;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                // Arr1 Room5
                if(!empty($arr1_room_no5)){
                    $sql_arrival1_room5 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival1ID', '$arr1_room_type5', '$arr1_room_no5', '$arr1_room_last_name5')";
                    $resource_arrival1_room5 = mysql_query( $sql_arrival1_room5, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival1_room5;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }
            }
        }//Enf of First If Statement, if arrival1 is selected

        $arrival2active = QuoteSmart($_POST['arrival2active']);
        if($arrival2active == 1){
            $sql_7 = "INSERT INTO bgi_arrivals ".
                "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no,luggage_vehicle, fast_track,excursion_name,excursion_date,excursion_pickup,excursion_confirm_by,excursion_confirm_date,excursion_guests) ".
                "VALUES ('$fsref', '$arr_date2', '$arr_time2', '$arr_flight_no2', '$flight_class2', '$arr2_transport', '$arr_driver2', '$arr_vehicle_no2', '$arr_pickup2', '$arr_dropoff2', '$arr2_room_type', '$rep_type2', '$client2_reqs', '$arr_transport_notes2', '$arr_hotel_notes2', '$infant_seats2', '$child_seats2', '$booster_seats2', '$vouchers2', '$cold_towels2', '$bottled_water2', '$rooms2', '$arr2_room_no', '$luggageVehicle2','$ftres2','$excursion_name2','$excursion_date2','$excursion_pickup2','$excursion_confirm_by2','$excursion_confirm_date2','$excursion_guests2')";
            $retval7 = mysql_query( $sql_7, $conn );
            if(mysql_errno()){
                echo "<br/>".__LINE__."::". mysql_error();
                $lastArrival2ID = 0;
            }else{
                $lastArrival2ID = mysql_insert_id();
            }


            if(!empty($lastArrival2ID)) {

                //Need to Insert Arrival Id Column in array also
                array_walk($arrival2_transport_array,function(&$subArray,$key,$lastArrival2ID){
                    $subArray['arrival_id'] = $lastArrival2ID;
                },$lastArrival2ID);

                foreach($arrival2_transport_array as $subArray){
                    $arrivals2_transport_sql = build_sql_insert('bgi_arrivals_transports',$subArray);
                    //Now Run the Queries for this.
                    $arrivals2_transport_resource = mysql_query($arrivals2_transport_sql,$conn);
                    if(mysql_errno()) {
                        echo $arrivals2_transport_sql;
                        echo "<br/>LINE::".__LINE__."::". mysql_error();
                    }
                }

                //Arr2 Room0
                //Insert the First Arrival Room Details.
                $sql_arrival2_room = "INSERT INTO bgi_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival2ID', '$arr2_room_type', '$arr2_room_no', '$arr2_room_last_name')";
                $resource_arrival2_room = mysql_query($sql_arrival2_room, $conn);
                if (mysql_errno()) {
                    echo $sql_arrival2_room;
                    echo "<br/>" . mysql_error();
                    echo "Error near LINE::" . __LINE__;
                }

                //Arr2 Room1
                if(!empty($arr2_room_no1)){
                    $sql_arrival2_room1 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival2ID', '$arr2_room_type1', '$arr2_room_no1', '$arr2_room_last_name1')";
                    $resource_arrival2_room1 = mysql_query( $sql_arrival2_room1, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival2_room1;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                //Arr2 Room2
                if(!empty($arr2_room_no1)){
                    $sql_arrival2_room2 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival2ID', '$arr2_room_type2', '$arr2_room_no2', '$arr2_room_last_name2')";
                    $resource_arrival2_room2 = mysql_query( $sql_arrival2_room2, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival2_room2;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                //Arr2 Room3
                if(!empty($arr2_room_no3)){
                    $sql_arrival2_room3 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival2ID', '$arr2_room_type3', '$arr2_room_no3', '$arr2_room_last_name3')";
                    $resource_arrival2_room3 = mysql_query( $sql_arrival2_room3, $conn);
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival2_room3;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                //Arr2 Room4
                if(!empty($arr1_room_no4)){
                    $sql_arrival2_room4 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival2ID', '$arr2_room_type4', '$arr2_room_no4', '$arr2_room_last_name4')";
                    $resource_arrival2_room4 = mysql_query( $sql_arrival2_room4, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival2_room4;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }

                //Arr2 Room5
                if(!empty($arr2_room_no5)){
                    $sql_arrival2_room5 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival2ID', '$arr2_room_type5', '$arr2_room_no5', '$arr2_room_last_name5')";
                    $resource_arrival2_room5 = mysql_query( $sql_arrival2_room5, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival2_room5;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }
            }
        }

        $arrival3active = QuoteSmart($_POST['arrival3active']);
        if($arrival3active == 1){
            $sql_8 = "INSERT INTO bgi_arrivals ".
                "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no, luggage_vehicle, fast_track,excursion_name,excursion_date,excursion_pickup,excursion_confirm_by,excursion_confirm_date,excursion_guests) ".
                "VALUES ('$fsref', '$arr_date3', '$arr_time3', '$arr_flight_no3', '$flight_class3', '$arr3_transport', '$arr_driver3', '$arr_vehicle_no3', '$arr_pickup3', '$arr_dropoff3', '$room_type3', '$rep_type3', '$client3_reqs', '$arr_transport_notes3', '$arr_hotel_notes3', '$infant_seats3', '$child_seats3', '$booster_seats3', '$vouchers3', '$cold_towels3', '$bottled_water3', '$rooms3', '$room_no3', '$luggageVehicle3','$ftres3','$excursion_name3','$excursion_date3','$excursion_pickup3','$excursion_confirm_by3','$excursion_confirm_date3','$excursion_guests3')";
            $retval8 = mysql_query( $sql_8, $conn );
            if(mysql_errno()){
                echo "<br/>".__LINE__."::". mysql_error();
                $lastArrival3ID = 0;
            }else{
                $lastArrival3ID = mysql_insert_id();
            }

            if(!empty($lastArrival3ID)){
                //Need to Insert Arrival Id Column in array also
                array_walk($arrival3_transport_array,function(&$subArray,$key,$lastArrival3ID){
                    $subArray['arrival_id'] = $lastArrival3ID;
                },$lastArrival3ID);

                foreach($arrival3_transport_array as $subArray){
                    $arrivals3_transport_sql = build_sql_insert('bgi_arrivals_transports',$subArray);
                    //Now Run the Queries for this.
                    $arrivals3_transport_resource = mysql_query($arrivals3_transport_sql,$conn);
                    if(mysql_errno()) {
                        echo $arrivals3_transport_sql;
                        echo "<br/>LINE::".__LINE__."::". mysql_error();
                    }
                }
                //Arr3 Room0
                //Insert the First Arrival Room Details.
                $sql_arrival3_room = "INSERT INTO bgi_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival3ID', '$arr3_room_type', '$arr3_room_no', '$arr3_room_last_name')";
                $resource_arrival3_room = mysql_query($sql_arrival3_room, $conn);
                if (mysql_errno()) {
                    echo $sql_arrival3_room;
                    echo "<br/>" . mysql_error();
                    echo "Error near LINE::" . __LINE__;
                }
                //Arr3 Room1
                if(!empty($arr3_room_no1)){
                    $sql_arrival3_room1 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival3ID', '$arr3_room_type1', '$arr3_room_no1', '$arr3_room_last_name1')";
                    $resource_arrival3_room1 = mysql_query( $sql_arrival3_room1, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival3_room1;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }
                //Arr3 Room2
                if(!empty($arr3_room_no2)){
                    $sql_arrival3_room2 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival3ID', '$arr3_room_type2', '$arr3_room_no2', '$arr3_room_last_name2')";
                    $resource_arrival3_room2 = mysql_query( $sql_arrival3_room2, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival3_room2;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }
                //Arr3 Room3
                if(!empty($arr3_room_no3)){
                    $sql_arrival3_room3 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival3ID', '$arr3_room_type3', '$arr3_room_no3', '$arr3_room_last_name3')";
                    $resource_arrival3_room3 = mysql_query( $sql_arrival3_room3, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival3_room3;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }
                //Arr3 Room4
                if(!empty($arr3_room_no4)){
                    $sql_arrival3_room4 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival3ID', '$arr3_room_type4', '$arr3_room_no4', '$arr3_room_last_name4')";
                    $resource_arrival3_room4 = mysql_query( $sql_arrival3_room4, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival3_room4;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }
                //Arr3 Room5
                if(!empty($arr3_room_no5)){
                    $sql_arrival3_room5 = "INSERT INTO bgi_arrivals_rooms ".
                        "(arrival_id, room_type, room_number, last_name) ".
                        "VALUES ('$lastArrival3ID', '$arr3_room_type5', '$arr3_room_no5', '$arr3_room_last_name5')";
                    $resource_arrival3_room5 = mysql_query( $sql_arrival3_room5, $conn );
                    if(mysql_errno()) {
                        echo '<pre>';
                        echo $sql_arrival3_room5;
                        echo "<br/>".__LINE__."::". mysql_error();
                        echo '</pre>';
                    }
                }
            }
        }
    }


    function insertAdditionalTransport($dataArray, $conn){
          if(mysql_errno()){
                $lastArrival0ID = 0;
            }else{
                $lastArrival0ID = mysql_insert_id();
            }

            if(!empty($lastArrival0ID)){
                //Need to Insert Arrival Id Column in array also
                array_walk($dataArray,function(&$subArray,$key,$lastArrival0ID){
                    $subArray['dept_id'] = $lastArrival0ID;
                },$lastArrival0ID);
                foreach($dataArray as $subArray){
                    $dpt_transport_sql = build_sql_insert('bgi_departure_transports',$subArray);
                    //Now Run the Queries for this.
                    $dpt_transport_resource = mysql_query($dpt_transport_sql,$conn);
                    if(mysql_errno()) {
                        //echo $arrivals_transport_sql;
                        echo "<br/>LINE::".__LINE__."::". mysql_error();
                    }
                }
            }    
    }

    //If Depends on the checkbox, if not selected, then departures queries would execute.
    if($departures){
        $sql_9 = "INSERT INTO bgi_departures ".
            "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes, dpt_main, dpt_jet_center, fast_track, dpt_vouchers, dpt_bottled_water, dpt_cold_towel) ".
            "VALUES ('$fsref', '$dpt_date', '$dpt_time', '$dpt_flight_no', '$dpt_flight_class', '$dpt_transport', '$dpt_driver', '$dpt_vehicle_no', '$dpt_pickup', '$dpt_dropoff', '$pickup_time', '$dpt_transport_notes', '$dpt_main','$jetCenter', '$ftdepres','$dpt_vouchers','$dpt_bottled_water','$dpt_cold_towels')";  
        $retval9 = mysql_query( $sql_9, $conn );

         // insert additional transport modes 
        insertAdditionalTransport($dpt_transport_array, $conn);


        $departure1active = QuoteSmart($_POST['departure1active']);
        if($departure1active == 1){
            $sql_10 = "INSERT INTO bgi_departures ".
                "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes,dpt_jet_center, fast_track, dpt_vouchers, dpt_bottled_water, dpt_cold_towel) ".
                "VALUES ('$fsref', '$dpt_date1', '$dpt_time1', '$dpt_flight_no1', '$dpt_flight_class1', '$dpt1_transport', '$dpt_driver1', '$dpt_vehicle_no1', '$dpt_pickup1', '$dpt_dropoff1', '$pickup_time1', '$dpt_transport_notes1','$jetCenter1', '$ftdepres1','$dpt_vouchers1','$dpt_bottled_water1','$dpt_cold_towels1')";
            $retval10 = mysql_query( $sql_10, $conn );
         // insert additional transport modes 
        insertAdditionalTransport($dpt1_transport_array);
        }
   


        $departure2active = QuoteSmart($_POST['departure2active']);
        if($departure2active == 1){
            $sql_11 = "INSERT INTO bgi_departures ".
                "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes,dpt_jet_center, fast_track, dpt_vouchers, dpt_bottled_water, dpt_cold_towel) ".
                "VALUES ('$fsref', '$dpt_date2', '$dpt_time2', '$dpt_flight_no2', '$dpt_flight_class2', '$dpt2_transport', '$dpt_driver2', '$dpt_vehicle_no2', '$dpt_pickup2', '$dpt_dropoff2', '$pickup_time2', '$dpt_transport_notes2','$jetCenter2', '$ftdepres2','$dpt_vouchers2','$dpt_bottled_water2','$dpt_cold_towels2')";
            $retval11 = mysql_query( $sql_11, $conn );
         // insert additional transport modes 
        insertAdditionalTransport($dpt2_transport_array);
        }

        $departure3active = QuoteSmart($_POST['departure3active']);
        if($departure3active == 1){
            $sql_12 = "INSERT INTO bgi_departures ".
                "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes,dpt_jet_center, fast_track, dpt_vouchers, dpt_bottled_water, dpt_cold_towel) ".
                "VALUES ('$fsref', '$dpt_date3', '$dpt_time3', '$dpt_flight_no3', '$dpt_flight_class3', '$dpt3_transport', '$dpt_driver3', '$dpt_vehicle_no3', '$dpt_pickup3', '$dpt_dropoff3', '$pickup_time3', '$dpt_transport_notes3','$jetCenter3', '$ftdepres3','$dpt_vouchers3','$dpt_bottled_water3','$dpt_cold_towels3')";
            $retval12 = mysql_query( $sql_12, $conn );
         // insert additional transport modes 
        insertAdditionalTransport($dpt3_transport_array);
        }
    }
    
    $transfermainactive = QuoteSmart($_POST['transfermainactive']);
    if($transfermainactive == 1){
    $sql_13 = "INSERT INTO bgi_transfer ". 
        "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ". 
        "VALUES ('$fsref', '$transfer_pickup','$transfer_pickup_date', '$transfer_time', '$transfer_dropoff', '$transfer_transport', '$transfer_vehicle_no', '$transfer_driver', '$transfer_notes')";
        $retval13 = mysql_query( $sql_13, $conn);
    }
    
    $transfer1active = QuoteSmart($_POST['transfer1active']);
    if($transfer1active == 1){    
    $sql_14 = "INSERT INTO bgi_transfer ". 
        "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ". 
        "VALUES ('$fsref', '$transfer_pickup1','$transfer_pickup_date1', '$transfer_time1', '$transfer_dropoff1', '$transfer1_transport', '$transfer_vehicle_no1', '$transfer_driver1', '$transfer_notes1')";
        $retval14 = mysql_query( $sql_14, $conn );
    }
    
    $transfer2active = QuoteSmart($_POST['transfer2active']);
    if($transfer2active == 1){
    $sql_15 = "INSERT INTO bgi_transfer ". 
        "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ". 
        "VALUES ('$fsref', '$transfer_pickup2','$transfer_pickup_date2', '$transfer_time2', '$transfer_dropoff2', '$transfer2_transport', '$transfer_vehicle_no2', '$transfer_driver2', '$transfer_notes2')";
        $retval15 = mysql_query( $sql_15, $conn );
    }
    
    $transfer3active = QuoteSmart($_POST['transfer3active']);
    if($transfer3active == 1){
    $sql_16 = "INSERT INTO bgi_transfer ". 
        "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ". 
        "VALUES ('$fsref', '$transfer_pickup3','$transfer_pickup_date3', '$transfer_time3', '$transfer_dropoff3', '$transfer3_transport', '$transfer_vehicle_no3', '$transfer_driver3', '$transfer_notes3')";
        $retval16 = mysql_query( $sql_16, $conn );
    }

 



    //For Additional Transfers

    //Additional Transfer
    if($add_transfer_active == 1){
        $addTransferActive_sql = "INSERT INTO bgi_additional_transfer ".
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ".
            "VALUES ('$fsref', '$add_transfer_pickup','$add_transfer_pickup_date', '$add_transfer_time', '$add_transfer_dropoff', '$add_transfer_transport', '$add_transfer_vehicle_no', '$add_transfer_driver', '$add_transfer_notes')";
        $addTransferActive_resource = mysql_query( $addTransferActive_sql, $conn);
        if(mysql_errno()){
            echo $addTransferActive_sql;
            echo '<br />'.__LINE__.'::'.mysql_error();
        }
    }
    //Additional Transfer 1
    if($add_transfer1_active == 1){
        $addTransfer1Active_sql = "INSERT INTO bgi_additional_transfer ".
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ".
            "VALUES ('$fsref', '$add_transfer_pickup1','$add_transfer_pickup_date1', '$add_transfer_time1', '$add_transfer_dropoff1', '$add_transfer1_transport', '$add_transfer_vehicle_no1', '$add_transfer_driver1', '$add_transfer_notes1')";
        $addTransfer1Active_resource= mysql_query( $addTransfer1Active_sql, $conn );
        if(mysql_errno()){
            echo $addTransfer1Active_sql;
            echo '<br />'.__LINE__.'::'.mysql_error();
        }
    }
    //Additional Transfer 2
    if($add_transfer2_active == 1){
        $addTransfer2Active_sql = "INSERT INTO bgi_additional_transfer ".
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ".
            "VALUES ('$fsref', '$add_transfer_pickup2','$add_transfer_pickup_date2', '$add_transfer_time2', '$add_transfer_dropoff2', '$add_transfer2_transport', '$add_transfer_vehicle_no2', '$add_transfer_driver2', '$add_transfer_notes2')";
        $addTransfer2Active_resource= mysql_query( $addTransfer2Active_sql, $conn );
        if(mysql_errno()){
            echo $addTransfer2Active_sql;
            echo '<br />'.__LINE__.'::'.mysql_error();
        }
    }
    //Additional Transfer 3
    if($add_transfer3_active == 1){
        $addTransfer3Active_sql = "INSERT INTO bgi_additional_transfer ".
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ".
            "VALUES ('$fsref', '$add_transfer_pickup3','$add_transfer_pickup_date3', '$add_transfer_time3', '$add_transfer_dropoff3', '$add_transfer3_transport', '$add_transfer_vehicle_no3', '$add_transfer_driver3', '$add_transfer_notes3')";
        $addTransfer3Active_resource= mysql_query( $addTransfer3Active_sql, $conn );
        if(mysql_errno()){
            echo $addTransfer3Active_sql;
            echo '<br />'.__LINE__.'::'.mysql_error();
        }
    }
    //Additional Transfer 3
    if($add_transfer4_active == 1){
        $addTransfer4Active_sql = "INSERT INTO bgi_additional_transfer ".
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ".
            "VALUES ('$fsref', '$add_transfer_pickup4','$add_transfer_pickup_date4', '$add_transfer_time4', '$add_transfer_dropoff4', '$add_transfer4_transport', '$add_transfer_vehicle_no4', '$add_transfer_driver4', '$add_transfer_notes4')";
        $addTransfer4Active_resource= mysql_query( $addTransfer4Active_sql, $conn );
        if(mysql_errno()){
            echo $addTransfer4Active_sql;
            echo '<br />'.__LINE__.'::'.mysql_error();
        }
    }
    //Additional Transfer 3
    if($add_transfer5_active == 1){
        $addTransfer5Active_sql = "INSERT INTO bgi_additional_transfer ".
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) ".
            "VALUES ('$fsref', '$add_transfer_pickup5','$add_transfer_pickup_date5', '$add_transfer_time5', '$add_transfer_dropoff5', '$add_transfer5_transport', '$add_transfer_vehicle_no5', '$add_transfer_driver5', '$add_transfer_notes5')";
        $addTransfer5Active_resource= mysql_query( $addTransfer5Active_sql, $conn );
        if(mysql_errno()){
            echo $addTransfer5Active_sql;
            echo '<br />'.__LINE__.'::'.mysql_error();
        }
    }

    //Post driver info to jobsheet
    if ($arr_driver > 0){
        $res_type_arr = 1;
        $sql_17 = "INSERT INTO bgi_resdrivers ". 
        "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) ". 
        "VALUES ('$arr_driver', '$arr_vehicle_no', '$fsref', '$adults', '$children', '$infants', '$tour_oper', '$arr_pickup', '$arr_time', '$arr_transport_notes', '$arr_time', '$arr_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$arr_date', '$res_type_arr')";
        $retval17 = mysql_query( $sql_17, $conn );
    }
    
    if ($dpt_driver > 0){
        $res_type_dpt = 2;
        $sql_18 = "INSERT INTO bgi_resdrivers ". 
        "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) ". 
        "VALUES ('$dpt_driver', '$dpt_vehicle_no', '$fsref', '$adults',  '$children', '$infants', '$tour_oper', '$dpt_pickup', '$pickup_time', '$dpt_transport_notes', '$dpt_time', '$dpt_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$dpt_date', '$res_type_dpt')";
        $retval18 = mysql_query( $sql_18, $conn );
    }

    //Put all the remaining stuff into the database
	$sql = "INSERT INTO bgi_reservations ". 
        "(title_name, first_name, last_name, pnr, tour_operator, operator_code, tour_ref_no, adult,child, infant, tour_notes, fast_track, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, dpt_date, dpt_time, dpt_flight_no, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_notes, creation_date, created_by, ref_no_sys, arr_transport_notes, dpt_transport_notes, arr_hotel_notes, ftnotify, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, dpt_flight_class, rooms, room_no, total_guests, luggage_vehicle, dpt_vouchers, dpt_bottled_water, dpt_cold_towel) ".
        "VALUES ('$title_name', '$first_name', '$last_name', '$pnr', '$tour_oper', '$oper_code', '$tour_ref_no', '$adults', '$children', '$infants', '$tour_notes', '$ftres', '$arr_date', '$arr_time', '$arr_flight_no', '$flight_class', '$arr_transport', '$arr_driver', '$arr_vehicle_no', '$arr_pickup', '$arr_dropoff', '$arr0_room_type', '$rep_type', '$client_reqs', '$dpt_date', '$dpt_time', '$dpt_flight_no', '$dpt_transport', '$dpt_driver', '$dpt_vehicle_no', '$dpt_pickup', '$dpt_dropoff', '$pickup_time', '$dpt_notes', NOW(), '$loggedinas', '$fsref', '$arr_transport_notes', '$dpt_transport_notes', '$arr_hotel_notes', '$ftnotify', '$infant_seats', '$child_seats', '$booster_seats', '$vouchers', '$cold_towels', '$bottled_water', '$dpt_flight_class', '$rooms', '$arr0_room_no', '$total_guests','$luggageVehicle','$dpt_vouchers','$dpt_bottled_water','$dpt_cold_towels')";
        $retval = mysql_query( $sql, $conn );
        $insertId = mysql_query('SELECT LAST_INSERT_ID()');
        $insertId = mysql_fetch_array($insertId);
        $insertId = $insertId[0];
        if(isset($insertId) && !empty($insertId)){
            $sysRefNo = mysql_query("SELECT `ref_no_sys` FROM bgi_reservations WHERE id = '$insertId'");
            $sysRefNo = mysql_fetch_array($sysRefNo);
            $sysRefNo = $sysRefNo[0];
        }

    if(mysql_errno()){
        echo "<br/>".mysql_error();
    }
    
    
    //Log user action
    $sql_19 = "INSERT INTO bgi_activity ". 
        "(log_user, user_action, log_time) ". 
        "VALUES ('$loggedinas', '$user_action', NOW())";
        $retval19 = mysql_query( $sql_19, $conn );
        
            if(!$retval)
            {
                die('Could not enter data: ' . mysql_error());
            }
    mysql_close($conn);

    /*if (isset($_POST['redirect_to']) && !empty($_POST['redirect_to']))
        echo "<script>window.location='".$_POST['redirect_to'].".php?id=".$insertId."&sect=gh'</script>";
    */ 

    
    if(isset($sysRefNo) && !empty($sysRefNo))
        // echo "<script>window.location='add-reservation.php?ok=1&sysRef=$sysRefNo'</script>";
        header('Location: add-reservation.php?ok=1&sysRef='.$sysRefNo);
    else
        // echo "<script>window.location='add-reservation.php?ok=1'</script>";
        header('Location: add-reservation.php?ok=1=');
}

?>

    <style type="text/css">
    .reqs-box {
        display: none;
    }
        .numericCol{
            width:100px !important;
        }
</style>
    <!-- start additional requirements toggle -->           
    <script type="text/javascript">
        

        $(document).ready(function(){
            $('input[type="checkbox"]').click(function(){
                if($(this).attr("value")=="clientreqs"){
                    $(".clientreqs").toggle();
                }        
            });
            $('input[type="checkbox"]').click(function(){
                if($(this).attr("value")=="clientreqs1"){
                    $(".clientreqs1").toggle();
                }        
            });
            $('input[type="checkbox"]').click(function(){
                if($(this).attr("value")=="clientreqs2"){
                    $(".clientreqs2").toggle();
                }        
            });
            $('input[type="checkbox"]').click(function(){
                if($(this).attr("value")=="clientreqs3"){
                    $(".clientreqs3").toggle();
                }        
            });


            // for departure need requirement
            $('.dpt_client_reqs').click(function(){
                var eleClass =$(this).attr('value'); 
                $('.'+eleClass).toggle();
            })
        });
    </script>

               <script type="text/javascript">
               //<![CDATA[
                function disp_confirm() {
                    var name=confirm("Pressing OK will Clear all form data.")
                    if(name==true) {
                        return true;
                    }
                    else {
                        return false;
                    }
                    }
                //]]>
                </script>  
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $("#arr-vehicle-no").attr("disabled","disabled");
                                        $("#arr-vehicle-no1").attr("disabled","disabled");
                                        $("#arr-vehicle-no2").attr("disabled","disabled");
                                        $("#arr-vehicle-no3").attr("disabled","disabled");
                                        
                                        /* hide all arrivals */
                                        $('#arrival1show').hide();
                                        $('#arrival2show').hide();
                                        $('#arrival3show').hide();
                                        
                                        /* hide all departures */
                                        $('#departure1show').hide();
                                        $('#departure2show').hide();
                                        $('#departure3show').hide();
                                        
                                        /* hide all transfers */
                                        $('#transfermainshow').hide();
                                        $('#transfer1show').hide();
                                        $('#transfer2show').hide();
                                        $('#transfer3show').hide();                                        
                                        
                                        /* hide all guest */
                                        $('#guest1show').hide();
                                        $('#guest2show').hide();
                                        $('#guest3show').hide(); 
                                        
                                        $("#arr-driver").change(function(){
                                            $("#arr-vehicle-no").attr("disabled","disabled");
                                            $("#arr-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#arr-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#arr-vehicle-no").removeAttr("disabled");
                                                $("#arr-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#dpt-driver").change(function(){
                                            $("#dpt-vehicle-no").attr("disabled","disabled");
                                            $("#dpt-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#dpt-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#dpt-vehicle-no").removeAttr("disabled");
                                                $("#dpt-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#arr-time").attr("disabled","disabled");
                                        
                                        $("#arr-flight-no").change(function(){
                                            $("#arr-time").attr("disabled","disabled");
                                            $("#arr-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#arr-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#arr-time").removeAttr("disabled");
                                                $("#arr-time").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-time").attr("disabled","disabled");
                                        
                                        $("#dpt-flight-no").change(function(){
                                            $("#dpt-time").attr("disabled","disabled");
                                            $("#dpt-time").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#dpt-flight-no option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#dpt-time").removeAttr("disabled");
                                                $("#dpt-time").html(data);
                                                
                                            });
                                        });
                                        
                                        $(".arr0_room_type").attr("disabled","disabled");
                                        
                                        $("#arr-dropoff").change(function(){
                                            console.log('test');
                                            var parent = $(this).parents('.arrivalsDiv');
                                            parent.find(".arr0_room_type").attr("disabled","disabled");
                                            parent.find(".arr0_room_type").html("<option>Loading rooms ...</option>");
                                        
                                            var locationid = $("#arr-dropoff option:selected").attr('value');
                                        
                                            $.post("select_roomtype.php", {locationid:locationid}, function(data){
                                                parent.find(".arr0_room_type").removeAttr("disabled");
                                                parent.find(".arr0_room_type").html(data);
                                                
                                            });
                                        });
                                        
                                        /* arrival 1 */
                                        $("#arr-driver1").change(function(){
                                            $("#arr-vehicle-no1").attr("disabled","disabled");
                                            $("#arr-vehicle-no1").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#arr-driver1 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#arr-vehicle-no1").removeAttr("disabled");
                                                $("#arr-vehicle-no1").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-vehicle-no1").attr("disabled","disabled");
                                                                                
                                        $("#dpt-driver1").change(function(){
                                            $("#dpt-vehicle-no1").attr("disabled","disabled");
                                            $("#dpt-vehicle-no1").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#dpt-driver1 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#dpt-vehicle-no1").removeAttr("disabled");
                                                $("#dpt-vehicle-no1").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#arr-time1").attr("disabled","disabled");
                                        
                                        $("#arr-flight-no1").change(function(){
                                            $("#arr-time1").attr("disabled","disabled");
                                            $("#arr-time1").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#arr-flight-no1 option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#arr-time1").removeAttr("disabled");
                                                $("#arr-time1").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-time1").attr("disabled","disabled");
                                        
                                        $("#dpt-flight-no1").change(function(){
                                            $("#dpt-time1").attr("disabled","disabled");
                                            $("#dpt-time1").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#dpt-flight-no1 option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#dpt-time1").removeAttr("disabled");
                                                $("#dpt-time1").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#room-type1").attr("disabled","disabled");
                                        
                                        $("#arr-dropoff1").change(function(){ 
                                            var roomTypeSelector1 = $("#arr1_room_type");
                                            var parent = $(this).parents('.arrivalsDiv').find('.arr1_room_type');
                                            parent.attr("disabled","disabled");
                                            parent.html("<option>Loading rooms ...</option>");
                                        
                                            var locationid = $("#arr-dropoff1 option:selected").attr('value');
                                        
                                            $.post("select_roomtype.php", {locationid:locationid}, function(data){
                                                parent.removeAttr("disabled");
                                                parent.html(data);
                                            });
                                        });
                                        /* end arrival 1 */
                                        
                                        /* arrival 2 */
                                        $("#arr-driver2").change(function(){
                                            $("#arr-vehicle-no2").attr("disabled","disabled");
                                            $("#arr-vehicle-no2").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#arr-driver2 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#arr-vehicle-no2").removeAttr("disabled");
                                                $("#arr-vehicle-no2").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-vehicle-no2").attr("disabled","disabled");
                                                                                
                                        $("#dpt-driver2").change(function(){
                                            $("#dpt-vehicle-no2").attr("disabled","disabled");
                                            $("#dpt-vehicle-no2").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#dpt-driver2 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#dpt-vehicle-no2").removeAttr("disabled");
                                                $("#dpt-vehicle-no2").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#arr-time2").attr("disabled","disabled");
                                        
                                        $("#arr-flight-no2").change(function(){
                                            $("#arr-time2").attr("disabled","disabled");
                                            $("#arr-time2").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#arr-flight-no2 option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#arr-time2").removeAttr("disabled");
                                                $("#arr-time2").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-time2").attr("disabled","disabled");
                                        
                                        $("#dpt-flight-no2").change(function(){
                                            $("#dpt-time2").attr("disabled","disabled");
                                            $("#dpt-time2").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#dpt-flight-no2 option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#dpt-time2").removeAttr("disabled");
                                                $("#dpt-time2").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#room-type2").attr("disabled","disabled");
                                        
                                        $("#arr-dropoff2").change(function(){
                                            var roomTypeSelector2 = $("#arr2_room_type");
                                            var parent = $(this).parents('.arrivalsDiv').find('.arr2_room_type');
                                            parent.attr("disabled","disabled");
                                            parent.html("<option>Loading rooms ...</option>");
                                        
                                            var locationid = $("#arr-dropoff2 option:selected").attr('value');
                                        
                                            $.post("select_roomtype.php", {locationid:locationid}, function(data){
                                                parent.removeAttr("disabled");
                                                parent.html(data);
                                                
                                            });
                                        });
                                        /* end arrival 2 */
                                        
                                        /* arrival 3 */
                                        $("#arr-driver3").change(function(){
                                            $("#arr-vehicle-no3").attr("disabled","disabled");
                                            $("#arr-vehicle-no3").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#arr-driver3 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#arr-vehicle-no3").removeAttr("disabled");
                                                $("#arr-vehicle-no3").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-vehicle-no3").attr("disabled","disabled");
                                                                                
                                        $("#dpt-driver3").change(function(){
                                            $("#dpt-vehicle-no3").attr("disabled","disabled");
                                            $("#dpt-vehicle-no3").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#dpt-driver3 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#dpt-vehicle-no3").removeAttr("disabled");
                                                $("#dpt-vehicle-no3").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#arr-time3").attr("disabled","disabled");
                                        
                                        $("#arr-flight-no3").change(function(){
                                            $("#arr-time3").attr("disabled","disabled");
                                            $("#arr-time3").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#arr-flight-no3 option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#arr-time3").removeAttr("disabled");
                                                $("#arr-time3").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#dpt-time3").attr("disabled","disabled");
                                        
                                        $("#dpt-flight-no3").change(function(){
                                            $("#dpt-time3").attr("disabled","disabled");
                                            $("#dpt-time3").html("<option>Loading flight times ...</option>");
                                        
                                            var flightid = $("#dpt-flight-no3 option:selected").attr('value');
                                        
                                            $.post("select_flighttime.php", {flightid:flightid}, function(data){
                                                $("#dpt-time3").removeAttr("disabled");
                                                $("#dpt-time3").html(data);
                                                
                                            });
                                        });
                                        
                                        $("#room-type3").attr("disabled","disabled");
                                        
                                        $("#arr-dropoff3").change(function(){
                                            var roomTypeSelector3 = $("#arr3_room_type");
                                            var parent = $(this).parents('.arrivalsDiv').find('.arr3_room_type');
                                            parent.attr("disabled","disabled");
                                            parent.html("<option>Loading rooms ...</option>");
                                        
                                            var locationid = $("#arr-dropoff3 option:selected").attr('value');
                                        
                                            $.post("select_roomtype.php", {locationid:locationid}, function(data){
                                                parent.removeAttr("disabled");
                                                parent.html(data);
                                            });
                                        });
                                        /* end arrival 3 */
                                        
                                        /* transfer */
                                        $("#transfer-vehicle-no").attr("disabled","disabled");
                                                                                
                                        $("#transfer-driver").change(function(){
                                            $("#transfer-vehicle-no").attr("disabled","disabled");
                                            $("#transfer-vehicle-no").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#transfer-driver option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#transfer-vehicle-no").removeAttr("disabled");
                                                $("#transfer-vehicle-no").html(data);
                                                
                                            });
                                        });
                                        /* end transfer */
                                        
                                        /* transfer 1 */
                                        $("#transfer-vehicle-no1").attr("disabled","disabled");
                                                                                
                                        $("#transfer-driver1").change(function(){
                                            $("#transfer-vehicle-no1").attr("disabled","disabled");
                                            $("#transfer-vehicle-no1").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#transfer-driver1 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#transfer-vehicle-no1").removeAttr("disabled");
                                                $("#transfer-vehicle-no1").html(data);
                                                
                                            });
                                        });
                                        /* end transfer 1 */
                                        
                                        /* transfer 2 */
                                        $("#transfer-vehicle-no1").attr("disabled","disabled");
                                                                                
                                        $("#transfer-driver2").change(function(){
                                            $("#transfer-vehicle-no2").attr("disabled","disabled");
                                            $("#transfer-vehicle-no2").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#transfer-driver2 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#transfer-vehicle-no2").removeAttr("disabled");
                                                $("#transfer-vehicle-no2").html(data);
                                                
                                            });
                                        });
                                        /* end transfer 2 */
                                        
                                        /* transfer 3 */
                                        $("#transfer-vehicle-no3").attr("disabled","disabled");
                                                                                
                                        $("#transfer-driver3").change(function(){
                                            $("#transfer-vehicle-no3").attr("disabled","disabled");
                                            $("#transfer-vehicle-no3").html("<option>Loading vehicles ...</option>");
                                        
                                            var driverid = $("#transfer-driver3 option:selected").attr('value');
                                        
                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                $("#transfer-vehicle-no3").removeAttr("disabled");
                                                $("#transfer-vehicle-no3").html(data);
                                                
                                            });
                                        });
                                        /* end transfer 3 */
                                        
                                        /* guest hide show */
                                        $('body').on('click','#guest1,.addGuest',function(e) {
                                            e.preventDefault();
                                            var NumberOfGuests = $("#totalGuests");
                                            var totalGuests = NumberOfGuests.val();
                                            if(totalGuests){
                                                //Lets Find Out How Many No of Guests have been Assigned so far.
                                                totalGuests = parseInt(totalGuests) - 1;
                                                var currentBtn = $(this);
                                                var guestsDiv = $("#guestPlaceHolder");
                                                var totalCurrentDivs = guestsDiv.find('div.guestShow').length;
                                                var applicableDivs = totalCurrentDivs + 1;
                                                if(totalGuests < (applicableDivs)){
                                                    console.log('totalGuests:'+totalGuests);
                                                    console.log('applicableGuests:'+applicableDivs);
                                                    return false;
                                                }

                                                //New Way, Now More Guests Forms will be added through the jquery/ajax
                                                $.ajax({
                                                    url:"<?=$url?>/custom_updates/sub_guest_form.php",
                                                    type:"POST",
                                                    data:{req:"guestCount",dataID:totalCurrentDivs},
                                                    success:function(output){
                                                        guestsDiv.append(output);
                                                        currentBtn.hide();
                                                    }
                                                });
                                            }else{
                                                return false;
                                            }
                                        });

                                        $('body').on("click",".removeGuest",function(e){
                                            e.preventDefault();
                                            if($(this).parents('.guestShow').is(':last-child')){
                                                $(this).parents('.guestShow').remove();

                                                //Now Show the button to the last div only if exist.
                                                var lastDivButton = $("#guestPlaceHolder").find(".guestShow:last-child").find('.addGuest');
                                                if(lastDivButton.length){
                                                    lastDivButton.show();
                                                }else{
                                                    $('#guest1').show();
                                                }

                                                console.log($("#guestPlaceHolder").find(".guestShow:last-child"));
                                            }else{
                                                $(this).parents('.guestShow').remove();
                                            }

                                        });
                                
                                        $('#remguest1').click(function(e) {
                                            e.preventDefault();
                                            $('#guest1show').hide().find('input:text').val('');
                                            $('#guest1').show();
                                            document.getElementById('guest1active').value="0";
                                        });
                                        
                                        $('#guest2').click(function(e) {
                                            e.preventDefault();
                                            $('#guest2show').show();
                                            $('#guest2').hide();
                                            $('#guest3').show();
                                            document.getElementById('guest2active').value="1";
                                        });
                                        
                                        $('#remguest2').click(function(e) {
                                            e.preventDefault();
                                            $('#guest2show').hide().find('input:text').val('');
                                            $('#guest2').show();
                                            document.getElementById('guest2active').value="0";
                                        });
                                        
                                        $('#guest3').click(function(e) {
                                            e.preventDefault();
                                            $('#guest3show').show();
                                            $('#guest3').hide();
                                            document.getElementById('guest3active').value="1";
                                        });
                                        
                                        $('#remguest3').click(function(e) {
                                            e.preventDefault();
                                            $('#guest3show').hide().find('input:text').val('');
                                            $('#guest3').show();
                                            document.getElementById('guest3active').value="0";
                                        });
                                        /* end guesthide show */
                                        
                                        /* arrival hide show */
                                        $('#arrival1').click(function(e) {
                                            e.preventDefault();
                                            $('#arrival1show').show();
                                            $('#arrival1').hide();
                                            document.getElementById('arrival1active').value="1";
                                        });
                                
                                        $('#remarrival1').click(function(e) {
                                            e.preventDefault();
                                            $('#arrival1show').hide().find('input:text').val('');
                                            $('#arrival1').show();
                                            document.getElementById('arrival1active').value="0";
                                        });
                                        
                                        $('#arrival2').click(function(e) {
                                            e.preventDefault();
                                            $('#arrival2show').show();
                                            $('#arrival2').hide();
                                            $('#arrival3').show();
                                            document.getElementById('arrival2active').value="1";
                                        });
                                        
                                        $('#remarrival2').click(function(e) {
                                            e.preventDefault();
                                            $('#arrival2show').hide().find('input:text').val('');
                                            $('#arrival2').show();
                                            document.getElementById('arrival2active').value="0";
                                        });
                                        
                                         $('#arrival3').click(function(e) {
                                            e.preventDefault();
                                            $('#arrival3show').show();
                                            $('#arrival3').hide();
                                            document.getElementById('arrival3active').value="1";
                                        });
                                        
                                        $('#remarrival3').click(function(e) {
                                            e.preventDefault();
                                            $('#arrival3show').hide().find('input:text').val('');
                                            $('#arrival3').show();
                                            document.getElementById('arrival3active').value="0";
                                        });
                                        /* end arrival hide show */
                                        

                                        /* Concerige Transfer start*/

                                        $(document).on('change', '.concerige-supplier',function(){
                                            var vehicleField = $(this).parents('.additional-transfer-div').find('.concerige-vehicle');
                                            vehicleField.attr("disabled","disabled");
                                            vehicleField.html("<option>Loading vehicles ...</option>");

                                           /* var driverid = $(this).parents('.form-group').find("concerige-supplier option:selected").attr('value');*/
                                            var elementId = $(this).attr('id');
                                            var driverid = $("#"+elementId+" option:selected").attr('value');
                                            

                                            $.post("select_vehicle.php", {driverid:driverid}, function(data){
                                                vehicleField.removeAttr("disabled");
                                                vehicleField.html(data);
                                                
                                            });
                                        });
                                        
                                        /* Concerige Transfer End*/

                                        /* transfer hide show */
                                        $('#transfermain').click(function(e) {
                                            e.preventDefault();
                                            $('#transfermainshow').show();
                                            $('#transfermain').hide();
                                            document.getElementById('transfermainactive').value="1";
                                        });
                                        
                                        $('#remtransfermain').click(function(e) {
                                            e.preventDefault();
                                            $('#transfermainshow').hide().find('input:text').val('');
                                            $('#transfermain').show();
                                            document.getElementById('transfermainactive').value="0";
                                        });
                                        
                                        $('#transfer1').click(function(e) {
                                            e.preventDefault();
                                            $('#transfer1show').show();
                                            $('#transfer1').hide();
                                            document.getElementById('transfer1active').value="1";
                                        });
                                
                                        
                                        $('#remtransfer1').click(function(e) {
                                            e.preventDefault();
                                            $('#transfer1show').hide().find('input:text').val('');
                                            $('#transfer1').show();
                                            document.getElementById('transfer1active').value="0";
                                        });
                                        
                                        $('#transfer2').click(function(e) {
                                            e.preventDefault();
                                            $('#transfer2show').show();
                                            $('#transfer2').hide();
                                            $('#transfer3').show();
                                            document.getElementById('transfer2active').value="1";
                                        });
                                        
                                        $('#remtransfer2').click(function(e) {
                                            e.preventDefault();
                                            $('#transfer2show').hide().find('input:text').val('');
                                            $('#transfer2').show();
                                            document.getElementById('transfer2active').value="0";
                                        });
                                        
                                        $('#transfer3').click(function(e) {
                                            e.preventDefault();
                                            $('#transfer3show').show();
                                            $('#transfer3').hide();
                                            document.getElementById('transfer3active').value="1";
                                        });
                                        
                                        $('#remtransfer3').click(function(e) {
                                            e.preventDefault();
                                            $('#transfer3show').hide().find('input:text').val('');
                                            $('#transfer3').show();
                                            document.getElementById('transfer3active').value="0";
                                        });
                                        /* end transferhide show */
                                        
                                        /* departure hide show */
                                        $('#departure1').click(function(e) {
                                            e.preventDefault();
                                            $('#departure1show').show();
                                            $('#departure1').hide();
                                            document.getElementById('departure1active').value="1";
                                        });
                                
                                        $('#remdeparture1').click(function(e) {
                                            e.preventDefault();
                                            $('#departure1show').hide().find('input:text').val('');
                                            $('#departure1').show();
                                            document.getElementById('departure1active').value="0";
                                        });
                                        
                                        $('#departure2').click(function(e) {
                                            e.preventDefault();
                                            $('#departure2show').show();
                                            $('#departure2').hide();
                                            $('#departure3').show();
                                            document.getElementById('departure2active').value="1";
                                        });
                                        
                                        $('#remdeparture2').click(function(e) {
                                            e.preventDefault();
                                            $('#departure2show').hide().find('input:text').val('');
                                            $('#departure2').show();
                                            document.getElementById('departure2active').value="0";
                                        });
                                        
                                        $('#departure3').click(function(e) {
                                            e.preventDefault();
                                            $('#departure3show').show();
                                            $('#departure3').hide();
                                            document.getElementById('departure3active').value="1";
                                        });
                                        
                                        $('#remdeparture3').click(function(e) {
                                            e.preventDefault();
                                            $('#departure3show').hide().find('input:text').val('');
                                            $('#departure3').show();
                                            document.getElementById('departure3active').value="0";
                                        });
                                        /* end departure hide show */   

                                    });

            
                                </script>
                    <?php include ('profile.php'); ?>
                    <?php include ('navigation.php'); ?>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            


            <!-- PAGE CONTENT -->
            <div class="page-content">
                <?php include ('vert-navigation.php'); ?>
                <!-- START BREADCRUMB -->
                <!--<ul class="breadcrumb">
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="#">Reservations</a></li>
                    <li class="active">Add Reservation</li>
                </ul>-->
                <!-- END BREADCRUMB -->
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <form id="add-reservations" class="form-horizontal" method="post" action="<?php $_PHP_SELF ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <?php 
                                        if(isset($_GET['sysRef']) && !empty($_GET['sysRef'])){
                                            echo '<div style="font-weight: bold;color: green;font-size: 14px;">Reservation Added with Ref # '.$_GET['sysRef'].'</div>';
                                        }
                                    ?>
                                    <h3 class="panel-title"><strong>Add Reservation</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <h4>Reservation Details</h4>
                                </div>
                                <div class="panel-body">                                                                        
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-8"><!-- first name / last name fields -->
                                            <div class="form-group col-xs-3"><!-- title selection -->

                                            <select class="form-control select" id="title-name" name="title_name" tabindex="0">
                                                <option value="">Select title</option>
                                                <option>Mr</option>
                                                <option>Mrs</option>
                                                <option>Ms</option>
                                                <option>Dr</option>
                                                <option>Sir</option>
                                                <option>Lord</option>
                                                <option>Lady</option>
                                                <option>Captain</option>
                                                <option>Professor</option>
                                                <option>Viscount</option>
                                            </select>
                                            </div>
                                            <label class="left20">First name</label> <input type="text" autocomplete="off" class="form-control right20 text-capitalize" placeholder="First name" id="first-name" name="first_name" value="" required>
                                            <label>Last name</label> <input type="text" class="form-control text-capitalize" placeholder="Last name" id="last-name" autocomplete="off" name="last_name" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-12">
                                            <label>Guest Cell</label> <input type="text" class="form-control right20 text-capitalize" placeholder="Guest Cell" id="guest-cell" name="guest_cell" value="" autocomplete="off">
                                            <label>Guest Email</label> <input type="text" class="form-control right20" placeholder="Guest Email" id="guest-email" name="guest_email" value="" autocomplete="off">
                                        </div>
                                    </div>   
                                    <div class="clearfix"></div>
                                    <div class="form-group col-xs-7"><!-- Passenger name record field -->
                                        <label>Passenger name record (PNR)</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="Passenger name record (PNR)" id="pnr" name="pnr" value="">
                                    </div>
                                    
                                    <div class="form-group col-xs-7"><!-- tour operator selection -->           <input type="text" style="height:0;width:0;border:none" class="triggerTourOp" />                            
                                            <label>Tour Operator</label>
                                            <?php include ('tour_oper_select.php'); ?>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- operator code field -->
                                        <label>Operator code/Brand</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="operator code / brand" id="oper-code" name="oper_code" value="">
                                    </div>
                                    <div class="form-group col-xs-7"><!-- reference number field -->
                                        <label>Reference number</label>
                                        <input type="text" class="form-control" autocomplete="off" placeholder="reference number" id="tour-ref-no" name="tour_ref_no" value="" style="text-transform: none">
                                        <span class="ref_no_check" data-id="0" style="font-size:12px;color:red"></span>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-10"><!-- number of persons traveling -->
			                                    <input type="number" min=0 max=99 class="form-control" id="adults" name="adults" value="" placeholder="Select # of Adults" style="width:160px"> Adult(s)  &nbsp;&nbsp;&nbsp;
                                                <!-- <input type="number" min=0 max=99 class="form-control" id="teen" name="teen" value="" placeholder="Select # of Teens" style="width:160px"> Teen(s): 12 yrs – 17 yrs    -->           
                                                <input type="number" min=0 max=99 class="left20 form-control" id="children" name="children" value="" placeholder="Select # of Children" style="width:160px"> Children: 13 months - 11yrs                          
                                            </div>                          
                                            <div class="form-inline col-xs-10">
                                                <input type="number" min=0 max=99 class="left20 form-control" id="infants" name="infants" value="" placeholder="Select # of Infants" style="width:160px"> Infant(s): 12 months and under                                       
                                            </div>        
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-7">                                            
                                            <label>Rep Notes</label>
                                            <textarea class="form-control text-lowercase" rows="5" id="tour-notes" name="tour_notes" placeholder="Rep notes: additional rep comments and details here"></textarea>
                                        </div>
                                    </div>
                                    <hr />
                                <!-- guests main-->
                                <div id="guestmain">
                                <h5>Guest Details</h5>
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-12"><!-- guest first name / guest last name fields -->
                                            <label class="left20">First name</label> <input type="text" class="form-control right20 text-capitalize" placeholder="First name" id="guest-first-name" name="guest_first_name[]" value="" autocomplete="off">
                                            <label>Last name</label> <input type="text" class="form-control right20 text-capitalize" placeholder="Last name" id="guest-last-name" name="guest_last_name[]" value="" autocomplete="off">
                                            <label>PNR</label> <input type="text" class="form-control" placeholder="Guest PNR" id="guest-pnr" name="guest_pnr[]" value="">
                                            <div class="form-group col-xs-2" autocomplete="off">
                                                                    <select class="form-control select" id="guest-title-name" name="guest_title_name[]">
                                                                        <option value="">Select title</option>
                                                                        <option>Mr</option>
                                                                        <option>Mrs</option>
                                                                        <option>Ms</option>
                                                                        <option>Miss</option>
                                                                        <option>Master</option>
                                                                        <option>Dr</option>
                                                                        <option>Sir</option>
                                                                        <option>Lord</option>
                                                                        <option>Lady</option>
                                                                    </select>
                                                                </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">                                         
                                        <div class="form-inline col-xs-8  guest-fields"><!-- guest first name / guest last name fields -->
                                            <label class="checkbox-inline right20 label_checkboxitem">
                                            <input type="checkbox" id="guest-adult" name="guest_adult[]"> Adult
                                            </label>
                                            <input type="number" min=12 max=17 class="form-control" id="teen_age" name="teen_age[]" value="" placeholder="Teen - 12 yrs - 17 yrs"> Years
                                            &nbsp;&nbsp;&nbsp;<input type="number" min=0 max=11 class="form-control" id="child_age" name="child_age[]" value="" placeholder="Child - 13 months - 11 yrs"> Years 
                                    <div class="clearfix"></div>
                                            <input type="number" min=0 max=23 class="form-control" id="infant_age" name="infant_age[]" value="" placeholder="Infant - 12 months or less" style="margin-left:69px"> Months
                                            <input type="number" min=0 max=23 class="left20 form-control" id="totalGuests" name="totalGuests" value="" placeholder="Guests Total No"> Guests
                                        </div>
                                    </div>
                                    <div><button id="guest1" class="btn btn-warning">Add guest</button></div>
                                    <div class="clearfix"></div>
                                    <hr />
                                    </div>

                                <!-- end guest main -->
                                    <div id="guestPlaceHolder">
                                    </div>

                                    <!-- arrival main -->
                                <h4>Arrival Details <label class="checkbox-inline label_checkboxitem" style="margin-left:10px;padding-top: 0;">
                                        <input type="checkbox" id="arrivalsDivCheckBox" name="arrivalsDivCheckBox"> No Flight Details
                                    </label></h4>
                                <div class="arrivalsDiv" data-id="0" id="arrivalsDiv">
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <label class="right20">Arrival Date</label>
                                        <div class="input-group date col-xs-4 right20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="arr_date" id="arr-date" placeholder="Arrival date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftres" name="ftres"> Fast
                                            Track
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"
                                           title="Check the box if this is a Fast Track reservation">
                                        </i>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label for="arr-flight-no">Flight number</label>
                                    <select class="form-control" id="arr-flight-no" name="arr_flight_no">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label for="arr-time" class="left20">Flight time</label>
                                    <select class="form-control left20" id="arr-time" name="arr_time">
                                        <option value="0">Flight ETA [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php include ('flightclass_select.php'); ?>
                                </div>
                                <div class="form-group col-xs-12 col-lg-7"> <!-- transport mode field -->
                                    <label>Transport mode</label>
                                    <?php include ('transport_mode_arr.php'); ?>
                                </div>
                                    <a data-id="transport_mode" data-toggle="modal" data-target="#add_mdl" class="btn btn-success" style="float:left;margin-top:20px;margin-left:3px;"><i class="fa fa-plus"></i></a>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-12 col-lg-3"><!-- available driver selection -->
                                    <label for="arr-driver">Transport Supplier</label>
                                    <select class="form-control" id="arr-driver" name="arr_driver[]" required="required">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-12 col-lg-3"><!-- vehicle # selection -->
                                    <label for="arr-vehicle-no" class="left20">Vehicle</label>
                                    <select class="form-control left20" id="arr-vehicle-no" name="arr_vehicle_no[]">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-xs-6"><!-- vehicle # selection -->
                                        <label for="arr-luggage-vehicle-no">Luggage Vehicle</label>
                                        <select class="form-control arr_luggage_vehicle" id="arr-luggage-vehicle-no" name="arr_luggage_vehicle_no">
                                            <option value="0">Select luggage vehicle</option>
                                            <?php include ('custom_updates/luggage_vehicle.php');?>
                                        </select>
                                    </div>

                                    <div class="left20 actionBtnsArrTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addArrTransportBtn left20" data-id="0"><i class="fa fa-plus"></i> Additional Arrival Transfer</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="arrTransportsDiv">
                                    </div>
                                    
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Arrival &amp; Transport notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-transport-notes" name="arr_transport_notes" placeholder="Arrival &amp; Transportation notes: additional arrival &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <label for="arr-pickup">Pickup Location</label>
                                    <select class="form-control" id="arr-pickup" name="arr_pickup">
                                        <option value="0">Pickup Location</option>
                                        <option value="56">Airport</option>
                                        <option value="57">Seaport</option>      
                                    </select>
                                </div><input type="text" style="height:0;width:0;border:none" class="triggerDropOff" />
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="arr-dropoff">Dropoff Location</label>
                                    <select class="form-control dropSelect arr_dropoff onselection select2" id="arr-dropoff" name="arr_dropoff">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-lg-2 col-md-6 col-xs-6"><!-- number of rooms -->
                                        <label>Number of Rooms</label>
                                        <input type="number" min=0 max=99 class="form-control" id="no-of-rooms" name="no_of_rooms" value="" placeholder="Number of Rooms">
                                    </div>
                                <div class="clearfix"></div>
                                    <div class="form-group col-lg-3 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room type selection -->
                                    <label for="arr0_room_type">Room type</label>
                                    <select class="form-control arr0_room_type right20" id="arr0_room_type" name="arr0_room_type">
                                        <option>Room Type</option>
                                    </select>
                                </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                    <label for="arr0_room_no" class="right20">Room number</label>
                                    <input class="form-control right20" id="arr0_room-no" name="arr0_room_no" placeholder="Room number">
                                </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;">
                                        <label for="arr0_room_last_name">Last Name</label>
                                        <input type="text" class="form-control right20" id="arr0_room_last_name" name="arr0_room_last_name" placeholder="Guest last name">
                                    </div>
                                    <div class="form-group col-lg-1" style="margin-top: 20px;">
                                        <a class="btn btn-default addRoomBtn" data-id="0"><i class="fa fa-plus"></i> Add Room</a>
                                    </div>
                                    <div id="sub-forms-div0" data-id="0">
                                    </div>
                                    <div class="clearfix"></div>
                                 <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Hotel notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-hotel-notes" name="arr_hotel_notes" placeholder="Hotel notes: additional hotel comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- representation type selection -->
                                    <label for="rep_type">Representation Type</label>
                                    <select multiple class="form-control rep-type" id="rep_type" name="rep_type[]">
                                        <option value="0">Select Representation</option>
                                    <?php include ('reptype_select_multiple.php'); ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                    <div class="form-group col-lg-8">
                                        <label>
                                            <input type="checkbox" id="luggageVehicle" name="luggageVehicle"> Luggage Vehicle
                                        </label>
                                    </div>
                                <div class="form-group col-xs-7 checkbox"><!-- additional requirements show -->
                                <label>
                                 <input type="checkbox" value="clientreqs"> Add Requirements
                                </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements and amount"></i>
                                <br /><br />
                                </div>
                                <div class="clientreqs reqs-box">
                                    <div class="form-group col-xs-7">                                        
                                       <?php
                                       $section = 'gh';
                                        include ('clientreqs_select.php'); ?>
                                        <span class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="cold-towels" name="cold_towels" value="" placeholder="Cold Towels">
                                                <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="bottled-water" name="bottled_water" value="" placeholder="Bottled Water">
                                                <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="vouchers" name="vouchers" value="" placeholder="Vouchers">
                                            </div>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Infant Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="infant-seats" name="infant_seats" value="" placeholder="Infant Seats">
                                                <label class="right20">Child Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="child-seats" name="child_seats" value="" placeholder="Child Seats">
                                                <label class="right20">Booster Seats</label><input type="number" min=0 max=99 class="form-control numericCol" id="booster-seats" name="booster_seats" value="" placeholder="Booster Seats">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Excursion Name</label><input type="text" class="right20 form-control" id="excursion_name" name="excursion_name" placeholder="Excursion Name">
                                                <label class="right20">Excursion Date</label><input type="text" class="right20 form-control datepicker" id="excursion_date" name="excursion_date" placeholder="Excursion Date">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Pickup Time</label><input type="text" class="form-control timepicker24" id="pickup_time" name="excursion_pickup" placeholder="Pickup Time">
                                            <label class="right20">Confirmed By Whom</label><input type="text" class="form-control" id="excursion_confirm_by" name="excursion_confirm_by" placeholder="Confirmed By Whom">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Date of Confirmation</label><input type="text" class="form-control datepicker" id="excursion_confirm_date" name="excursion_confirm_date" placeholder="Excursion Confirm Date">
                                            <label class="right20">Number of Guests</label><input type="number" class="form-control" id="excursion_guests" name="excursion_guests" placeholder="Number of Guests">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <button id="arrival1" class="btn btn-warning">Add Arrival</button>
                                <div class="clearfix"></div>
                                </div>
                                <!-- end arrival main -->
                                
                                <!-- arrival 1 -->
                                <div class="arrivalsDiv" data-id="1" id="arrival1show">
                                <input type="hidden" id="arrival1active" name="arrival1active" value="0" />
                                <hr />
                                <h4>Arrival Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <label class="right20">Arrival Date</label>
                                        <div class="input-group date col-xs-4 right20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="arr_date1" id="arr-date1" placeholder="Arrival date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftres1" name="ftres1"> Fast Track
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"
                                           title="Check the box if this is a Fast Track reservation">
                                        </i>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label for="arr-flight-no1">Flight number</label>
                                    <select class="form-control" id="arr-flight-no1" name="arr_flight_no1">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label for="arr-time1" class="left20">Flight time</label>
                                    <select class="form-control left20" id="arr-time1" name="arr_time1">
                                        <option value="0">Flight ETA [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_flightclass ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="flight-class1" name="flight_class1">
                                        <option>Select flight class</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <label>Transport mode</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="arr-transport1" name="arr1_transport[]">
                                        <option>Arrival Transport mode</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                            }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label for="arr-driver1">Transport Supplier</label>
                                    <select class="form-control" id="arr-driver1" name="arr1_driver[]">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="arr-vehicle-no1" name="arr1_vehicle_no[]">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>

                                    <div class="left20 actionBtnsArrTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addArrTransportBtn left20" data-id="1"><i class="fa fa-plus"></i> Add Transport</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="arrTransportsDiv">
                                    </div>

                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Arrival &amp; Transport notes</label>
                                        <textarea class="form-control text lowercase" rows="5" id="arr-transport-notes1" name="arr_transport_notes1" placeholder="Arrival &amp; Transportation notes: additional arrival &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <label for="arr-pickup1">Pickup Location</label>
                                    <select class="form-control" id="arr-pickup1" name="arr_pickup1">
                                        <option value="0">Pickup Location</option>
                                        <option value="56">Airport</option>
                                        <option value="57">Seaport</option>      
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="arr-dropoff1">Dropoff Location</label>
                                    <select class="form-control dropSelect arr_dropoff" id="arr-dropoff1" name="arr_dropoff1">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                    <div class="form-group col-lg-2 col-md-6 col-xs-6"><!-- number of rooms -->
                                        <label>Number of Rooms</label>
                                        <input type="number" min=0 max=99 class="form-control" id="no-of-rooms1" name="no_of_rooms1" value="" placeholder="Number of Rooms">
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-lg-3 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room type selection -->
                                        <label for="arr1_room_type">Room type</label>
                                        <select class="form-control arr1_room_type right20" id="arr1_room_type" name="arr1_room_type">
                                            <option>Room Type</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                        <label for="arr1_room_no" class="right20">Room number</label>
                                        <input class="form-control right20" id="arr1_room-no" name="arr1_room_no" placeholder="Room number">
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;">
                                        <label for="arr1_room_last_name">Last Name</label>
                                        <input type="text" class="form-control right20" id="arr1_room_last_name" name="arr1_room_last_name" placeholder="Guest last name">
                                    </div>
                                    <div class="form-group col-lg-1" style="margin-top: 20px;">
                                        <a class="btn btn-default addRoomBtn" data-id="1"><i class="fa fa-plus"></i> Add Room</a>
                                    </div>
                                    <div id="sub-forms-div1" data-id="1">
                                    </div>
                                    <div class="clearfix"></div>
                                 <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Hotel notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-hotel-notes1" name="arr_hotel_notes1" placeholder="Hotel notes: additional hotel comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7">
                                    <!-- representation type selection -->
                                    <label for="rep_type1">Representation Type</label>
                                    <select multiple class="form-control rep-type" id="rep_type1" name="rep_type1[]">
                                        <option value="0">Select Representation</option>
                                        <?php include('reptype_select_multiple.php'); ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                    <div class="form-group col-lg-8">
                                        <label>
                                            <input type="checkbox" id="luggageVehicle1" name="luggageVehicle1"> Luggage Vehicle
                                        </label>
                                    </div>
                                <div class="form-group col-xs-7 checkbox"><!-- additional requirements show -->
                                <label>
                                 <input type="checkbox" value="clientreqs1"> Add Requirements
                                </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements and amount"></i>
                                <br /><br />
                                </div>
                                <div class="clientreqs1 reqs-box">
                                <?php /* ?>
                                    <div class="form-group col-xs-7">                                        
                                       <?php
                                       $sql = "SELECT * FROM bgi_clientreqs ORDER BY id ASC";
                                       $result = mysql_query($sql);
                                       
                                       echo '<select multiple class="form-control select" id="client-reqs3" name="client3_reqs[]">
                                                <option>Additional Requirements</option>';
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<option value='" . $row['reqs'] . "'>" . $row['reqs'] . "</option>";
                                                }
                                                echo "</select>";
                                       ?>
                                        <span class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>
                                    </div>
                                    <?php */ ?>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="cold-towels1" name="cold_towels1" value="" placeholder="Cold Towels">
                                                <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="bottled-water1" name="bottled_water1" value="" placeholder="Bottled Water">
                                                <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="vouchers1" name="vouchers1" value="" placeholder="Vouchers">
                                            </div>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Infant Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="infant-seats1" name="infant_seats1" value="" placeholder="Infant Seats">
                                                <label class="right20">Child Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="child-seats1" name="child_seats1" value="" placeholder="Child Seats">
                                                <label class="right20">Booster Seats</label><input type="number" min=0 max=99 class="form-control numericCol" id="booster-seats1" name="booster_seats1" value="" placeholder="Booster Seats">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Excursion Name</label><input type="text" class="right20 form-control" id="excursion_name1" name="excursion_name1" placeholder="Excursion Name">
                                            <label class="right20">Excursion Date</label><input type="text" class="right20 form-control" id="excursion_date1" name="excursion_date1" placeholder="Excursion Date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Pickup Time</label><input type="text" class="form-control timepicker24" id="pickup_time1" name="excursion_pickup1" placeholder="Pickup Time">
                                            <label class="right20">Confirmed By Whom</label><input type="text" class="form-control" id="excursion_confirm_by1" name="excursion_confirm_by1" placeholder="Confirmed By Whom">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Date of Confirmation</label><input type="text" class="form-control" id="excursion_confirm_date1" name="excursion_confirm_date1" placeholder="Excursion Confirm Date">
                                            <label class="right20">Number of Guests</label><input type="number" class="form-control" id="excursion_guests1" name="excursion_guests1" placeholder="Number of Guests">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div><button id="remarrival1" class="btn btn-danger right20">Remove Arrival</button> <button id="arrival2" class="btn btn-warning">Add Arrival</button></div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- end arrival 1 -->
                                
                                <!-- arrival 2 -->
                                <div class="arrivalsDiv" data-id="2" id="arrival2show">
                                <input type="hidden" id="arrival2active" name="arrival2active" value="0" />
                                <hr />
                                <h4>Arrival Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <label class="right20">Arrival Date</label>
                                        <div class="input-group date col-xs-4 right20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="arr_date2" id="arr-date2" placeholder="Arrival date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftres2" name="ftres2"> Fast
                                            Track
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"
                                           title="Check the box if this is a Fast Track reservation">
                                        </i>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label for="arr_flight_no2">Flight number</label>
                                    <select class="form-control" id="arr-flight-no2" name="arr_flight_no2">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label class="left20">Flight time</label>
                                    <select class="form-control left20" id="arr-time2" name="arr_time2">
                                        <option value="0">Flight ETA [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_flightclass ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="flight-class2" name="flight_class2">
                                        <option>Select flight class</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <label>Transport mode</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="arr-transport2" name="arr2_transport[]">
                                        <option>Arrival Transport mode</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                            }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label for="arr-driver2">Transport Supplier</label>
                                    <select class="form-control" id="arr-driver2" name="arr2_driver[]">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label for="arr-vehicle-no2" class="left20">Vehicle</label>
                                    <select class="form-control left20" id="arr-vehicle-no2" name="arr2_vehicle_no[]">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>

                                    <div class="left20 actionBtnsArrTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addArrTransportBtn left20" data-id="0"><i class="fa fa-plus"></i> Add Transport</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="arrTransportsDiv">
                                    </div>

                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Arrival &amp; Transport notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-transport-notes2" name="arr_transport_notes2" placeholder="Arrival &amp; Transportation notes: additional arrival &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <select class="form-control" id="arr-pickup2" name="arr_pickup2">
                                        <option value="0">Pickup Location</option>
                                        <option value="56">Airport</option>
                                        <option value="57">Seaport</option>      
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="arr-dropoff2">Dropoff Location</label>
                                    <select class="form-control dropSelect arr_dropoff" id="arr-dropoff2" name="arr_dropoff2">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group col-lg-2 col-md-6 col-xs-6"><!-- number of rooms -->
                                        <label>Number of Rooms</label>
                                        <input type="number" min=0 max=99 class="form-control" id="no-of-rooms2" name="no_of_rooms2" placeholder="Number of Rooms">
                                    </div>
                                <div class="clearfix"></div>

                                    <div class="form-group col-lg-3 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room type selection -->
                                        <label for="arr2_room_type">Room type</label>
                                        <select class="form-control arr2_room_type right20" id="arr2_room_type" name="arr2_room_type">
                                            <option>Room Type</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                        <label for="arr2_room_no" class="right20">Room number</label>
                                        <input class="form-control right20" id="arr2_room-no" name="arr2_room_no" placeholder="Room number">
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;">
                                        <label for="arr2_room_last_name">Last Name</label>
                                        <input type="text" class="form-control right20" id="arr2_room_last_name" name="arr2_room_last_name" placeholder="Guest last name">
                                    </div>
                                    <div class="form-group col-lg-1" style="margin-top: 20px;">
                                        <a class="btn btn-default addRoomBtn" data-id="2"><i class="fa fa-plus"></i> Add Room</a>
                                    </div>
                                    <div id="sub-forms-div2" data-id="2">
                                    </div>
                                    <div class="clearfix"></div>
                                 <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Hotel notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-hotel-notes2" name="arr_hotel_notes2" placeholder="Hotel notes: additional hotel comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- representation type selection -->
                                    <label for="rep_type2">Representation Type</label>
                                    <select multiple class="form-control rep-type" id="rep_type2" name="rep_type2[]">
                                        <option value="0">Select Representation</option>
                                        <?php include('reptype_select_multiple.php'); ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                    <div class="form-group col-lg-8">
                                        <label>
                                            <input type="checkbox" id="luggageVehicle2" name="luggageVehicle2"> Luggage Vehicle
                                        </label>
                                    </div>
                                <div class="form-group col-xs-7 checkbox"><!-- additional requirements show -->
                                <label>
                                 <input type="checkbox" value="clientreqs2"> Add Requirements
                                </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements and amount"></i>
                                <br /><br />
                                </div>
                                <div class="clientreqs2 reqs-box">
                                <?php /* ?>
                                    <div class="form-group col-xs-7">                                        
                                       <?php
                                       $sql = "SELECT * FROM bgi_clientreqs ORDER BY id ASC";
                                       $result = mysql_query($sql);
                                       
                                       echo '<select multiple class="form-control select" id="client-reqs2" name="client2_reqs[]">
                                                <option>Additional Requirements</option>';
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<option value='" . $row['reqs'] . "'>" . $row['reqs'] . "</option>";
                                                }
                                                echo "</select>";
                                       ?>
                                        <span class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>
                                    </div>
                                    <?php */ ?>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="cold-towels2" name="cold_towels2" value="" placeholder="Cold Towels">
                                                <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="bottled-water2" name="bottled_water2" value="" placeholder="Bottled Water">
                                                <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="vouchers2" name="vouchers2" value="" placeholder="Vouchers">
                                            </div>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Infant Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="infant-seats2" name="infant_seats2" value="" placeholder="Infant Seats">
                                                <label class="right20">Child Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="child-seats2" name="child_seats2" value="" placeholder="Child Seats">
                                                <label class="right20">Booster Seats</label><input type="number" min=0 max=99 class="form-control numericCol" id="booster-seats2" name="booster_seats2" value="" placeholder="Booster Seats">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Excursion Name</label><input type="text" class="right20 form-control" id="excursion_name2" name="excursion_name2" placeholder="Excursion Name">
                                            <label class="right20">Excursion Date</label><input type="text" class="right20 form-control" id="excursion_date2" name="excursion_date2" placeholder="Excursion Date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Pickup Time</label><input type="text" class="form-control  timepicker24" id="pickup_time2" name="excursion_pickup2" placeholder="Pickup Time">
                                            <label class="right20">Confirmed By Whom</label><input type="text" class="form-control" id="excursion_confirm_by2" name="excursion_confirm_by2" placeholder="Confirmed By Whom">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Date of Confirmation</label><input type="text" class="form-control" id="excursion_confirm_date2" name="excursion_confirm_date2" placeholder="Excursion Confirm Date">
                                            <label class="right20">Number of Guests</label><input type="number" class="form-control" id="excursion_guests2" name="excursion_guests2" placeholder="Number of Guests">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div><button id="remarrival2" class="btn btn-danger right20">Remove Arrival</button> <button id="arrival3" class="btn btn-warning">Add Arrival</button></div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- end arrival 2 -->
                                
                                <!-- arrival 3 -->
                                <div class="arrivalsDiv" data-id="3" id="arrival3show">
                                <input type="hidden" id="arrival3active" name="arrival3active" value="0" />
                                <hr />
                                <h4>Arrival Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- arrival date -->
                                        <label class="right20">Arrival Date</label>
                                        <div class="input-group date col-xs-4 right20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="arr_date3" id="arr-date3" placeholder="Arrival date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftres3" name="ftres3"> Fast
                                            Track
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip"
                                           data-placement="top"
                                           title="Check the box if this is a Fast Track reservation">
                                        </i>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label>Flight number</label>
                                    <select class="form-control" id="arr-flight-no3" name="arr_flight_no3">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label class="left20">Flight time</label>
                                    <select class="form-control left20" id="arr-time3" name="arr_time3">
                                        <option value="0">Flight ETA [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_flightclass ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="flight-class3" name="flight_class3">
                                        <option>Select flight class</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group col-xs-7"> <!-- transport mode field -->                                      
                                    <label>Transport mode</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="arr-transport3" name="arr3_transport[]">
                                        <option>Arrival Transport mode</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                            }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label for="arr-driver3">Transport Supplier</label>
                                    <select class="form-control" id="arr-driver3" name="arr3_driver[]">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label for="arr-vehicle-no3" class="left20">Vehicle</label>
                                    <select class="form-control left20" id="arr-vehicle-no3" name="arr3_vehicle_no[]">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
                                    <div class="left20 actionBtnsArrTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addArrTransportBtn left20" data-id="0"><i class="fa fa-plus"></i> Add Transport</a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="arrTransportsDiv">
                                    </div>

                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Arrival &amp; Transport notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-transport-notes3" name="arr_transport_notes3" placeholder="Arrival &amp; Transportation notes: additional arrival &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <select class="form-control" id="arr-pickup3" name="arr_pickup3">
                                        <option value="0">Pickup Location</option>
                                        <option value="56">Airport</option>
                                        <option value="57">Seaport</option>      
                                    </select>
                                </div>
                                <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="arr-dropoff3">Dropoff Location</label>
                                    <select class="form-control dropSelect arr_dropoff" id="arr-dropoff3" name="arr_dropoff3">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                    <div class="form-group col-lg-3 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room type selection -->
                                        <label for="arr3_room_type">Room type</label>
                                        <select class="form-control arr3_room_type right20" id="arr3_room_type" name="arr3_room_type">
                                            <option>Room Type</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;"><!-- room number -->
                                        <label for="arr3_room_no" class="right20">Room number</label>
                                        <input class="form-control right20" id="arr3_room-no" name="arr3_room_no" placeholder="Room number">
                                    </div>
                                    <div class="form-group col-lg-2 col-sm-7 col-xs-12" style="margin-right: 10px !important;">
                                        <label for="arr3_room_last_name">Last Name</label>
                                        <input type="text" class="form-control right20" id="arr3_room_last_name" name="arr3_room_last_name" placeholder="Guest last name">
                                    </div>
                                    <div class="form-group col-lg-1" style="margin-top: 20px;">
                                        <a class="btn btn-default addRoomBtn" data-id="3"><i class="fa fa-plus"></i> Add Room</a>
                                    </div>
                                    <div id="sub-forms-div3" data-id="3">
                                    </div>
                                    <div class="clearfix"></div>
                                 <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Hotel notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="arr-hotel-notes3" name="arr_hotel_notes3" placeholder="Hotel notes: additional hotel comments and details here"></textarea>
                                    </div>
                                 </div>
                                <div class="form-group col-xs-7">
                                    <!-- representation type selection -->
                                    <label for="rep_type3">Representation Type</label>
                                    <select multiple class="form-control rep-type" id="rep_type3" name="rep_type3[]">
                                        <option value="0">Select Representation</option>
                                        <?php include('reptype_select_multiple.php'); ?>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <hr />
                                    <div class="form-group col-lg-8">
                                        <label>
                                            <input type="checkbox" id="luggageVehicle3" name="luggageVehicle3"> Luggage Vehicle
                                        </label>
                                    </div>
                                <div class="form-group col-xs-7 checkbox"><!-- additional requirements show -->
                                <label>
                                 <input type="checkbox" value="clientreqs3"> Add Requirements
                                </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements and amount"></i>
                                <br /><br />
                                </div>
                                <div class="clientreqs3 reqs-box">
                                    <?php /* ?>
                                    <div class="form-group col-xs-7">
                                       <?php
                                       $sql = "SELECT * FROM bgi_clientreqs ORDER BY id ASC";
                                       $result = mysql_query($sql);
                                       
                                       echo '<select multiple class="form-control select" id="client-reqs3" name="client3_reqs[]">
                                                <option>Additional Requirements</option>';
                                                while ($row = mysql_fetch_array($result)) {
                                                    echo "<option value='" . $row['reqs'] . "'>" . $row['reqs'] . "</option>";
                                                }
                                                echo "</select>";
                                       ?>
                                        <span class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>
                                    </div>
                                    <?php */ ?>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="cold-towels3" name="cold_towels3" value="" placeholder="Cold Towels">
                                                <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="bottled-water3" name="bottled_water3" value="" placeholder="Bottled Water">
                                                <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="vouchers3" name="vouchers3" value="" placeholder="Vouchers">
                                            </div>
                                    </div>
                                    <div class="form-group">                                         
                                            <div class="form-inline col-xs-6 col-sm-12">
                                                <label class="right20">Infant Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="infant-seats3" name="infant_seats3" value="" placeholder="Infant Seats">
                                                <label class="right20">Child Seats</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="child-seats3" name="child_seats3" value="" placeholder="Child Seats">
                                                <label class="right20">Booster Seats</label><input type="number" min=0 max=99 class="form-control numericCol" id="booster-seats3" name="booster_seats3" value="" placeholder="Booster Seats">
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Excursion Name</label><input type="text" class="right20 form-control" id="excursion_name3" name="excursion_name3" placeholder="Excursion Name">
                                            <label class="right20">Excursion Date</label><input type="text" class="right20 form-control" id="excursion_date3" name="excursion_date3" placeholder="Excursion Date">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Pickup Time</label><input type="text" class="form-control timepicker24" id="pickup_time3" name="excursion_pickup3" placeholder="Pickup Time">
                                            <label class="right20">Confirmed By Whom</label><input type="text" class="form-control" id="excursion_confirm_by3" name="excursion_confirm_by3" placeholder="Confirmed By Whom">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Date of Confirmation</label><input type="text" class="form-control" id="excursion_confirm_date3" name="excursion_confirm_date3" placeholder="Excursion Confirm Date">
                                            <label class="right20">Number of Guests</label><input type="number" class="form-control" id="excursion_guests3" name="excursion_guests3" placeholder="Number of Guests">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div><button id="remarrival3" class="btn btn-danger right20">Remove Arrival</button></div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- end arrival 3 -->
                                </div>
                                <div id="transfermain"><hr /><button  class="btn btn-success">Add Inter-Hotel Transfer</button></div>
                                <div class="clearfix"></div>
                                <!-- transfer main -->
                                
                                <div id="transfermainshow">
                                <input type="hidden" id="transfermainactive" name="transfermainactive" value="0" />
                                <hr />
                                <h4>Inter-Hotel Transfer Details</h4>
                                <div class="form-group col-xs-4 right20"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select select2" id="transfer-pickup" name="transfer_pickup">
                                            <option>Pickup Location</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                        }
                                    echo "</select>";
                                    ?>
                                </div>                                                                        
                                <div class="form-group col-xs-3">
                                        <!-- arrival date -->
                                        <label class="left20">Pickup Date</label>
                                        <div class="input-group date left20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="transfer_pickup_date" id="transfer-pickup-date" placeholder="Pickup date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                
                                <div class="form-group col-xs-2"><!-- pickup time -->
                                        <label>Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" class="form-control timepicker24" name="transfer_pickup_time" id="transfer-pickup-time" placeholder="Pickup time"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>

                                <div class="form-group col-xs-5"> <!-- transport mode field -->                                      
                                    <label class="left20">Transport mode</label>
                                    <div class="left20">
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select multiple class="form-control select" id="transfer-transport" name="transfer_transport[]">
                                            <option>Transfer Transport mode</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                                }
                                            echo "</select>";
                                    ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                 <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="transfer-dropoff">Dropoff Location</label>
                                    <select class="form-control dropSelect" id="transfer-dropoff" name="transfer_dropoff">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="transfer-driver" name="transfer_driver">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Transport Supplier</label>
                                    <select class="form-control left20" id="transfer-vehicle-no" name="transfer_vehicle_no">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
 
                                  <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Inter Hotel Transfer Details</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="transfer-notes" name="transfer_notes" placeholder="Transfer &amp; Transportation notes: additional transfer &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                  <div><button id="remtransfermain" class="btn btn-danger right20">Remove Transfer</button><button id="transfer1" class="btn btn-warning">Add Transfer</button></div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- end transfer main -->
                                
                                <!-- transfer 1 -->
                                <div id="transfer1show">
                                <input type="hidden" id="transfer1active" name="transfer1active" value="0" />
                                <hr />
                                <h4>Inter-Hotel Transfer Details</h4>
                                <div class="form-group col-xs-4 right20"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select select2" id="transfer-pickup1" name="transfer_pickup1">
                                            <option>Pickup Location</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                        }
                                    echo "</select>";
                                    ?>
                                </div>                                                                        
                                <div class="form-group col-xs-3">
                                        <!-- arrival date -->
                                        <label class="left20">Pickup Date</label>
                                        <div class="input-group date left20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="transfer_pickup_date1" id="transfer-pickup-date1" placeholder="Pickup date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                
                                <div class="form-group col-xs-2"><!-- pickup time -->
                                        <label>Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" class="form-control timepicker24" name="transfer_pickup_time1" id="transfer-pickup-time1" placeholder="Pickup time"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>

                                <div class="form-group col-xs-5"> <!-- transport mode field -->                                      
                                    <label class="left20">Transport mode</label>
                                    <div class="left20">
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select multiple class="form-control select" id="transfer-transport1" name="transfer1_transport[]">
                                            <option>Transfer Transport mode</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                                }
                                            echo "</select>";
                                    ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                 <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="transfer-dropoff1">Dropoff Location</label>
                                    <select class="form-control dropSelect" id="transfer-dropoff1" name="transfer_dropoff1">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="transfer-driver1" name="transfer_driver1">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="transfer-vehicle-no1" name="transfer_vehicle_no1">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
 
                                  <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Inter Hotel Transfer Details</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="transfer-notes1" name="transfer_notes1" placeholder="Transfer &amp; Transportation notes: additional transfer &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                  <div><button id="remtransfer1" class="btn btn-danger right20">Remove Transfer</button><button id="transfer2" class="btn btn-warning">Add Transfer</button></div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- end transfer 1 -->
                                
                                <!-- transfer 2 -->
                                <div id="transfer2show">
                                <input type="hidden" id="transfer2active" name="transfer2active" value="0" />
                                <hr />
                                <h4>Inter-Hotel Transfer Details</h4>
                                <div class="form-group col-xs-4 right20"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select select2" id="transfer-pickup2" name="transfer_pickup2">
                                            <option>Pickup Location</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                        }
                                    echo "</select>";
                                    ?>
                                </div>                                                                        
                                <div class="form-group col-xs-3">
                                        <!-- arrival date -->
                                        <label class="left20">Pickup Date</label>
                                        <div class="input-group date left20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="transfer_pickup_date2" id="transfer-pickup-date2" placeholder="Pickup date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                
                                <div class="form-group col-xs-2"><!-- pickup time -->
                                        <label>Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" class="form-control timepicker24" name="transfer_pickup_time2" id="transfer-pickup-time2" placeholder="Pickup time"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>

                                <div class="form-group col-xs-5"> <!-- transport mode field -->                                      
                                    <label class="left20">Transport mode</label>
                                    <div class="left20">
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select multiple class="form-control select" id="transfer-transport2" name="transfer2_transport[]">
                                            <option>Transfer Transport mode</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                                }
                                            echo "</select>";
                                    ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                 <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="transfer-dropoff2">Dropoff Location</label>
                                    <select class="form-control dropSelect" id="transfer-dropoff2" name="transfer_dropoff2">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="transfer-driver2" name="transfer_driver2">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="transfer-vehicle-no2" name="transfer_vehicle_no2">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
 
                                  <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Inter Hotel Transfer Details</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="transfer-notes2" name="transfer_notes2" placeholder="Transfer &amp; Transportation notes: additional transfer &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                  <div><button id="remtransfer2" class="btn btn-danger right20">Remove Transfer</button><button id="transfer3" class="btn btn-warning">Add Transfer</button></div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- end transfer 2 -->
                                
                                <!-- transfer 3 -->
                                <div id="transfer3show">
                                <input type="hidden" id="transfer3active" name="transfer3active" value="0" />
                                <hr />
                                <h4>Inter-Hotel Transfer Details</h4>
                                <div class="form-group col-xs-4 right20"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select select2" id="transfer-pickup3" name="transfer_pickup3">
                                            <option>Pickup Location</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                        }
                                    echo "</select>";
                                    ?>
                                </div>                                                                        
                                <div class="form-group col-xs-3">
                                        <!-- arrival date -->
                                        <label class="left20">Pickup Date</label>
                                        <div class="input-group date left20" data-date-format="mm-dd-yyyy">
                                                <input type="text" class="form-control datepicker" name="transfer_pickup_date3" id="transfer-pickup-date3" placeholder="Pickup date"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                </div>
                                
                                <div class="clearfix"></div>
                                
                                <div class="form-group col-xs-2"><!-- pickup time -->
                                        <label>Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" class="form-control timepicker24" name="transfer_pickup_time3" id="transfer-pickup-time3" placeholder="Pickup time"/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>

                                <div class="form-group col-xs-5"> <!-- transport mode field -->                                      
                                    <label class="left20">Transport mode</label>
                                    <div class="left20">
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select multiple class="form-control select" id="transfer-transport3" name="transfer3_transport[]">
                                            <option>Transfer Transport mode</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                                }
                                            echo "</select>";
                                    ?>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                 <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                    <label for="transfer-dropoff3">Dropoff Location</label>
                                    <select class="form-control dropSelect" id="transfer-dropoff3" name="transfer_dropoff3">
                                        <?php echo $opt->ShowLocation(); ?>     
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                                <!-- initiate chained selection drivers -->
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="transfer-driver3" name="transfer_driver3">
                                        <?php echo $opt->ShowTransport(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="transfer-vehicle-no3" name="transfer_vehicle_no3">
                                        <option value="0">Select vehicle</option>    
                                    </select>
                                </div>
 
                                  <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">                                            
                                        <label>Inter Hotel Transfer Details</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="transfer-notes3" name="transfer_notes3" placeholder="Transfer &amp; Transportation notes: additional transfer &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                  <div><button id="remtransfer3" class="btn btn-danger right20">Remove Transfer</button></div>
                                </div>
                                <div class="clearfix"></div>
                                <!-- end transfer 3 -->

                                    <div id="additionalBtnDiv"><hr /><button type="button" id="additionalMainBtn" class="btn btn-success">Concierge Transfer</button></div>
                                    <div class="clearfix"></div>
                                    <!--All Additional Transfers Would Go Under Below Div-->
                                    <div id="additionalTransfersDiv">
                                    </div>

                                    
                                <!-- departure main -->
                                <hr />
                                <h4>Departure Details <label class="checkbox-inline label_checkboxitem" style="margin-left:10px;padding-top: 0;">
                                        <input type="checkbox" id="departuresDivCheckBox" name="departuresDivCheckBox"> No Flight Details
                                    </label> </h4>
                                <div id="departuresDiv" class="departureDivs" data-id="0">
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <label>Departure Date</label>
                                        <div class="input-group date col-xs-3 right20 left20" data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker"  name="dpt_date" id="dpt-date" placeholder="Departure date"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>

                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftdepres" name="ftdepres"> Fast
                                            Track
                                        </label>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label>Flight number</label>
                                    <select class="form-control" id="dpt-flight-no" name="dpt_flight_no">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label class="left20">Flight time</label>
                                    <select class="form-control left20" id="dpt-time" name="dpt_time">
                                        <option value="0">Flight ETD [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_flightclass ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    echo '<select class="form-control select" id="dpt-flight-class" name="dpt_flight_class">
                                            <option>Select flight class</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                                }
                                                echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group col-xs-7">                                       
                                    <label>Transport mode</label>
                                    <?php include ('transport_mode_dpt.php'); ?>
                                </div>
                                
                                <a data-id="transport_mode" data-toggle="modal" data-target="#add_mdl" class="btn btn-success" style="float:left;margin-top:20px;margin-left:3px;"><i class="fa fa-plus"></i></a>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="dpt-driver" name="dpt_driver[]">
                                        <?php echo $opt->ShowTransport(); ?>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="dpt-vehicle-no" name="dpt_vehicle_no[]">
                                        <option value="0">Vehicle #</option>   
                                    </select>
                                </div>
                                <div class="left20 actionBtnsDptTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addDptTransportBtn left20" data-id="0"><i class="fa fa-plus"></i>Additional Departure Transfer</a>
                                        </div>
                                    </div>
                                <div class="clearfix"></div>
                                <div class="dptTransportsDiv">
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label>Departure &amp; Transport notes</label>                                            
                                        <textarea class="form-control text-lowercase" rows="5" id="dpt-transport-notes" name="dpt_transport_notes" placeholder="Departure &amp; Transportation notes: additional departure &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                
                                    <div class="form-group col-xs-4"><!-- pickup location selection -->
                                        <label>Pickup Location</label>
                                        <?php include ('dpt_pickup_select.php'); ?>
                                    </div>
                                    <div class="form-group"><!-- pickup time -->
                                        <label class="left20">Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker col-xs-3">
                                            <input type="text" class="form-control timepicker24 left20" name="pickup_time" id="pickup-time" placeholder="Pickup time" value=""/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                        <label>Dropoff Location</label>
                                        <?php include ('dpt_location_select.php'); ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label>
                                        <input type="checkbox" name="jetCenter" value="jetCenter"> IAM Jet Center
                                    </label>
                                        <br />
                                    <div class="form-group col-lg-12">
                                        <label>
                                            <input type="checkbox" class="dpt_client_reqs" value="dpt_clientreqs"> Add Requirements
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements"></i>
                                    </div>
                                    <div class="form-group dpt_clientreqs reqs-box">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="dpt_vouchers" name="dpt_vouchers" value="" placeholder="Vouchers">
                                            <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_cold-towels" name="dpt_cold_towels" value="" placeholder="Cold Towels">
                                            <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_bottled-water" name="dpt_bottled_water" value="" placeholder="Bottled Water">
                                        </div>
                                    </div>

                               <br />
                                    <div class="clearfix"></div>
                                    <br />
                                    <div><button id="departure1" class="btn btn-warning">Add Departure</button></div>
                                    </div>
                                    <!-- end departure main -->
                                    
                                    <!-- departure 1 -->
                            <div id="departure1show" class="departureDivs" data-id = "1">
                                <input type="hidden" id="departure1active" name="departure1active" value="0" />
                                <hr />
                                <h4>Departure Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <label>Departure Date</label>
                                        <div class="input-group date col-xs-3 right20 left20" data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker"  name="dpt_date1" id="dpt-date1" placeholder="Departure date"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>

                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftdepres1" name="ftdepres1"> Fast
                                            Track
                                        </label>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label>Flight number</label>
                                    <select class="form-control" id="dpt-flight-no1" name="dpt_flight_no1">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label class="left20">Flight time</label>
                                    <select class="form-control left20" id="dpt-time1" name="dpt_time1">
                                        <option value="0">Flight ETD [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_flightclass ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    echo '<select class="form-control select" id="dpt-flight-class1" name="dpt_flight_class1">
                                            <option>Select flight class</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                                }
                                                echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group col-xs-7">                                       
                                    <label>Transport mode</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="dpt-transport1" name="dpt1_transport[]">
                                        <option>Departure Transport mode</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="dpt-driver1" name="dpt1_driver">
                                        <?php echo $opt->ShowTransport(); ?>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="dpt-vehicle-no1" name="dpt1_vehicle_no">
                                        <option value="0">Vehicle #</option>   
                                    </select>
                                </div>
                                <div class="left20 actionBtnsDptTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addDptTransportBtn left20" data-id="0"><i class="fa fa-plus"></i>Additional Departure Transfer</a>
                                        </div>
                                    </div>
                                <div class="clearfix"></div>
                                <div class="dptTransportsDiv">
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label>Departure &amp; Transport notes</label>                                            
                                        <textarea class="form-control text-lowercase" rows="5" id="dpt-transport-notes1" name="dpt_transport_notes1" placeholder="Departure &amp; Transportation notes: additional departure &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                
                                    <div class="form-group col-xs-4"><!-- pickup location selection -->
                                        <label>Pickup Location</label>
                                        <?php
                                        $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                        $result = mysql_query($sql);
                                        
                                        echo '<select class="form-control select select2" id="dpt-pickup1" name="dpt_pickup1">
                                                <option>Pickup Location</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                        }
                                        echo "</select>"
                                        ?>
                                    </div>
                                    <div class="form-group"><!-- pickup time -->
                                        <label>Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker col-xs-3">
                                            <input type="text" class="form-control timepicker24" name="pickup_time1" id="pickup-time1" placeholder="Pickup time" value=""/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                        <label>Dropoff Location</label>
                                        <?php
                                        $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                        $result = mysql_query($sql);
                                        
                                        echo '<select class="form-control dropSelect" id="dpt-dropoff1" name="dpt_dropoff1">
                                                <option>Dropoff Location</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                            }
                                            echo "</select>";
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label>
                                        <input type="checkbox" name="jetCenter1" value="jetCenter"> IAM Jet Center
                                    </label>
                                        <br />
                                    <div class="form-group col-lg-12">
                                        <label>
                                            <input type="checkbox" class="dpt_client_reqs" value="dpt_clientreqs1"> Add Requirements
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements"></i>
                                    </div>
                                    <div class="form-group dpt_clientreqs1 reqs-box">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="dpt_vouchers1" name="dpt_vouchers1" value="" placeholder="Vouchers">
                                            <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_cold-towels1" name="dpt_cold_towels1" value="" placeholder="Cold Towels">
                                            <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_bottled-water1" name="dpt_bottled_water1" value="" placeholder="Bottled Water">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br />
                                     <div><button id="remdeparture1" class="btn btn-danger right20">Remove Departure</button> <button id="departure2" class="btn btn-warning">Add Departure</button></div>
                                    </div>
                                    <!-- end departure 1 -->
                                    
                                    <!-- departure 2 -->
                                <div id="departure2show"  class="departureDivs" data-id = "2">
                                <input type="hidden" id="departure2active" name="departure2active" value="0" />
                                <hr />
                                <h4>Departure Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <label>Departure Date</label>
                                        <div class="input-group date col-xs-3 right20 left20" data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker"  name="dpt_date2" id="dpt-date2" placeholder="Departure date"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>

                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftdepres2" name="ftdepres2"> Fast
                                            Track
                                        </label>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label>Flight number</label>
                                    <select class="form-control" id="dpt-flight-no2" name="dpt_flight_no2">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label class="left20">Flight time</label>
                                    <select class="form-control left20" id="dpt-time2" name="dpt_time2">
                                        <option value="0">Flight ETD [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_flightclass ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    echo '<select class="form-control select" id="dpt-flight-class2" name="dpt_flight_class2">
                                            <option>Select flight class</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                                }
                                                echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group col-xs-7">                                       
                                    <label>Transport mode</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="dpt-transport2" name="dpt2_transport[]">
                                        <option>Departure Transport mode</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="dpt-driver2" name="dpt2_driver[]">
                                        <?php echo $opt->ShowTransport(); ?>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="dpt-vehicle-no2" name="dpt2_vehicle_no[]">
                                        <option value="0">Vehicle #</option>   
                                    </select>
                                </div>
                                <div class="left20 actionBtnsDptTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addDptTransportBtn left20" data-id="2"><i class="fa fa-plus"></i>Additional Departure Transfer</a>
                                        </div>
                                    </div>
                                <div class="clearfix"></div>
                                <div class="dptTransportsDiv">
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label>Departure &amp; Transport notes</label>                                            
                                        <textarea class="form-control text-lowercase" rows="5" id="dpt-transport-notes2" name="dpt_transport_notes2" placeholder="Departure &amp; Transportation notes: additional departure &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                
                                    <div class="form-group col-xs-4"><!-- pickup location selection -->
                                        <label>Pickup Location</label>
                                        <?php
                                        $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                        $result = mysql_query($sql);
                                        
                                        echo '<select class="form-control select select2" id="dpt-pickup2" name="dpt_pickup2">
                                                <option>Pickup Location</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                    </div>
                                    <div class="form-group"><!-- pickup time -->
                                        <label>Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker col-xs-3">
                                            <input type="text" class="form-control timepicker24" name="pickup_time2" id="pickup-time2" placeholder="Pickup time" value=""/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                        <label>Dropoff Location</label>
                                        <?php
                                        $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                        $result = mysql_query($sql);
                                        
                                        echo '<select class="form-control dropSelect" id="dpt-dropoff2" name="dpt_dropoff2">
                                                <option>Dropoff Location</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                            }
                                            echo "</select>";
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label>
                                        <input type="checkbox" name="jetCenter2" value="jetCenter"> IAM Jet Center
                                    </label>
                                        <br />
                                    <div class="form-group col-lg-12">
                                        <label>
                                            <input type="checkbox" class="dpt_client_reqs" value="dpt_clientreqs2"> Add Requirements
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements"></i>
                                    </div>
                                    <div class="form-group dpt_clientreqs2 reqs-box">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="dpt_vouchers2" name="dpt_vouchers2" value="" placeholder="Vouchers">
                                            <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_cold-towels2" name="dpt_cold_towels2" value="" placeholder="Cold Towels">
                                            <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_bottled-water2" name="dpt_bottled_water2" value="" placeholder="Bottled Water">
                                        </div>
                                    </div>
                                    <br />
                                     <div><button id="remdeparture2" class="btn btn-danger right20">Remove Departure</button> <button id="departure3" class="btn btn-warning">Add Departure</button></div>
                                    </div>
                                    <!-- end departure 2 -->
                                    
                                    <!-- departure 3 -->
                                <div id="departure3show"  class="departureDivs" data-id = "3">
                                <input type="hidden" id="departure3active" name="departure3active" value="0" />
                                <hr />
                                <h4>Departure Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <label>Departure Date</label>
                                        <div class="input-group date col-xs-3 right20 left20" data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker"  name="dpt_date3" id="dpt-date3" placeholder="Departure date"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>

                                        <label class="checkbox-inline label_checkboxitem">
                                            <input class="icheckbox" type="checkbox" id="ftdepres3" name="ftdepres3"> Fast
                                            Track
                                        </label>
                                    </div>
                                </div>
                                <!-- initiate chained selection flight# -->
                                <div class="form-group col-xs-4"><!-- flight # selection -->
                                    <label>Flight number</label>
                                    <select class="form-control" id="dpt-flight-no3" name="dpt_flight_no3">
                                        <?php echo $opt->ShowFlight(); ?>     
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- flight time selection -->
                                    <label class="left20">Flight time</label>
                                    <select class="form-control left20" id="dpt-time3" name="dpt_time3">
                                        <option value="0">Flight ETD [24 hour]</option>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-7">                                        
                                    <label>Flight class</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_flightclass ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    echo '<select class="form-control select" id="dpt-flight-class3" name="dpt_flight_class3">
                                            <option>Select flight class</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['class'] . "</option>";
                                                }
                                                echo "</select>";
                                    ?>
                                </div>
                                <div class="form-group col-xs-7">                                       
                                    <label>Transport mode</label>
                                    <?php
                                    $sql = "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                                    $result = mysql_query($sql);
                                    
                                    echo '<select class="form-control select" id="dpt-transport3" name="dpt3_transport[]">
                                        <option>Departure Transport mode</option>';
                                    while ($row = mysql_fetch_array($result)) {
                                        echo "<option value='" . $row['transport_type'] . "'>" . $row['transport_type'] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="dpt-driver3" name="dpt3_driver[]">
                                        <?php echo $opt->ShowTransport(); ?>    
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="dpt-vehicle-no3" name="dpt3_vehicle_no[]">
                                        <option value="0">Vehicle #</option>   
                                    </select>
                                </div>
                                <div class="left20 actionBtnsDptTransportDiv">
                                        <div class="form-group left20" style="margin-top: 20px; display:inline-block; margin-left: 15px;">
                                            <a class="btn btn-default addDptTransportBtn left20" data-id="3"><i class="fa fa-plus"></i>Additional Departure Transfer</a>
                                        </div>
                                    </div>
                                <div class="clearfix"></div>
                                <div class="dptTransportsDiv">
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label>Departure &amp; Transport notes</label>                                            
                                        <textarea class="form-control text-lowercase" rows="5" id="dpt-transport-notes3" name="dpt_transport_notes3" placeholder="Departure &amp; Transportation notes: additional departure &amp; transport comments and details here"></textarea>
                                    </div>
                                 </div>
                                
                                    <div class="form-group col-xs-4"><!-- pickup location selection -->
                                        <label>Pickup Location</label>
                                        <?php
                                        $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                        $result = mysql_query($sql);
                                        
                                        echo '<select class="form-control select select2" id="dpt-pickup3" name="dpt_pickup3">
                                                <option>Pickup Location</option>';
                                        while ($row = mysql_fetch_array($result)) {
                                            echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                        }
                                        echo "</select>";
                                        ?>
                                    </div>
                                    <div class="form-group"><!-- pickup time -->
                                        <label class="left20">Pickup Time</label>
                                        <div class="input-group bootstrap-timepicker col-xs-3">
                                            <input type="text" class="form-control timepicker24 left20" name="pickup_time3" id="pickup-time3" placeholder="Pickup time" value=""/>
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                        </div>
                                        <span class="help-block"> &nbsp;Select pickup time</span>
                                    </div>
                                    <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                        <label>Dropoff Location</label>
                                        <?php
                                        $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
                                        $result = mysql_query($sql);
                                        
                                        echo '<select class="form-control dropSelect" id="dpt-dropoff3" name="dpt_dropoff3">
                                                <option>Dropoff Location</option>';
                                            while ($row = mysql_fetch_array($result)) {
                                                echo "<option value='" . $row['id_location'] . "'>" . $row['name'] . "</option>";
                                            }
                                            echo "</select>";
                                        ?>
                                    </div>
                                    <div class="clearfix"></div>
                                    <label>
                                        <input type="checkbox" name="jetCenter3" value="jetCenter"> IAM Jet Center
                                    </label>
                                        <br />
                                    <div class="form-group col-lg-12">
                                        <label>
                                            <input type="checkbox" class="dpt_client_reqs" value="dpt_clientreqs3"> Add Requirements
                                        </label>
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Check this box to assign additional requirements"></i>
                                    </div>
                                    <div class="form-group dpt_clientreqs3 reqs-box">
                                        <div class="form-inline col-xs-6 col-sm-12">
                                            <label class="right20">Vouchers</label><input type="number" min=0 max=99 class="form-control numericCol" id="dpt_vouchers3" name="dpt_vouchers3" value="" placeholder="Vouchers">
                                            <label class="right20">Cold Towels</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_cold-towels3" name="dpt_cold_towels3" value="" placeholder="Cold Towels">
                                            <label class="right20">Bottled Water</label><input type="number" min=0 max=99 class="right20 form-control numericCol" id="dpt_bottled-water3" name="dpt_bottled_water3" value="" placeholder="Bottled Water">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br />
                                     <div><button id="remdeparture3" class="btn btn-danger right20">Remove Departure</button>
                                    </div>
                                    </div>
                                    <!-- end departure 3 -->
                                    </div> <!--DepartureFlight-->
                                    <hr /> 
                                <div class="form-group"><!-- accounting notes -->
                                        <div class="col-xs-7">
                                            <label>Accounting notes</label>                                            
                                            <textarea class="form-control text-lowercase" rows="5" id="dpt-notes" name="dpt_notes" placeholder="Accounting notes: additional accounting comments and details here"></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="addreservation" />
                                <div class="panel-footer">
                                    <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">Clear Form</button>                                    
                                    <button name="addreservation" class="btn btn-primary" id="add" type="button">Submit</button>
                                </div>
                            </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        <div class="modal fade" id="fsft-checkbox-warn" tabindex="-1" role="dialog" aria-labelledby="hotelNotes" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">FSFT Checkbox</h4>
                    </div>
                    <div class="modal-body">
                        You have not selected FSFT for this reservation
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary continue">Continue</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press Yes to logout current user. Press No if you want to continue working. </p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->             
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>            
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>              
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <!--Select2-->
        <script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
        <!-- END THIS PAGE PLUGINS -->       
        
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>

<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
<script type="text/javascript">
    window.fsft_check = true;
    $('#tour-oper,.dropSelect, .select2').select2({
        minimumInputLength: 3
    });
    $('.rep-type').select2();
    $('.clientReqs').select2();
    $('.clientReqs').next().css('width','100%');
    body = $('body');

    $(function(){
        $('.numericCol').keypress(function(e) {
            var tval = $(this).val(),
                tlength = tval.length,
                set = 3,
                remain = parseInt(set - tlength);
            $('p').text(remain);
            if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
                $(this).val((tval).substring(0, tlength - 1))
            }
        });

        $('.clientReqs').on('change',function(){
            console.log('value changed');
            var selectedValues = $(this).val();
            var available = $.inArray('Pre booked excursion',selectedValues);
            console.log(available);
            if(available === -1){
                console.log('value does not exist');
            }else{
                console.log('value exists in array');
            }
        });
    });

    $('#arrivalsDivCheckBox').on('change',function(){
         if($(this).is(':checked')){
             $('#arrivalsDiv').hide();
         }else{
             $('#arrivalsDiv').show();
         }
    });

    $('#departuresDivCheckBox').on('change',function(){
        console.log('#departuresDivCheckBox');
         if($(this).is(':checked')){
             $('#departuresDiv').hide();
         }else{
             $('#departuresDiv').show();
         }
    });


    //Code for Additional Transfer
    $('#additionalTransfersDiv').hide();
    body.on('click',"#additionalMainBtn, .addAdditionalTransfer", function(e){
        e.preventDefault();
        var additionalTransfersDiv = $('#additionalTransfersDiv');
        var totalAdditionalTransfers = additionalTransfersDiv.find('div.additional-transfer-div').length;
        var maxDivs = 6;
        //Need to Make an Ajax Call to get the Divs Loaded in Here.
        if(totalAdditionalTransfers<maxDivs){
            console.log('totalDivs:'+totalAdditionalTransfers);
            $(this).parent().hide();
            $.ajax({
                url:"<?=$url?>/custom_updates/additional_transfer.php",
                type:"POST",
                data:{dataID:totalAdditionalTransfers,max:maxDivs},
                success:function(output){
                    additionalTransfersDiv.show();
                    additionalTransfersDiv.append(output);
                    $('.transport-mode').select2();
                    $('select.select').select2();
                     $('.timepicker24').timepicker({
                        defaultTime: '',
                        showMeridian:false
                    });
                    //Need To Initialize the datepicker also.
                    if($(".datepicker").length > 0){
                        $(".datepicker").datepicker({format: 'yyyy-mm-dd'});
                    }
                }
            });
        }

    });

    body.on('click','.remAdditionalTransfer',function(){
        var additionalTransfersDiv = $('#additionalTransfersDiv');
        $(this).parents('div.additional-transfer-div').remove();
        var totalAdditionalTransfers = additionalTransfersDiv.find('div.additional-transfer-div').length;
        if(totalAdditionalTransfers === 0){
            console.log('i should show up');
            additionalTransfersDiv.html('');
            additionalTransfersDiv.hide();
            $('#additionalBtnDiv').show();
        }else if(totalAdditionalTransfers > 0){
            additionalTransfersDiv.find('div.additional-transfer-div').last().find('div.additionalTransferActionButtonsDiv').show();
        }
    });

    body.on('click','.addRoomBtn',function(){
        var currentBtn = $(this);
        var currentArrivalID = currentBtn.attr('data-id');
        var subRoomsDiv = $('#sub-forms-div'+currentArrivalID);
        console.log(subRoomsDiv);
        var totalCurrentDivs = subRoomsDiv.find('div.roomDiv').length + 1;
        var maxRooms = 5;
        var locId = $(this).parents('.arrivalsDiv').find('.arr_dropoff').val();
        console.log(locId);

        if(totalCurrentDivs<maxRooms){
            //We Would be Adding More Guests Now to our specified Div.
            //New Way, Now More Guests Forms will be added through the jquery/ajax
            $.ajax({
                url: "<?=$url?>/custom_updates/sub_room_form.php",
                type: "POST",
                data: {req: "roomCount", dataID: totalCurrentDivs, arrID:currentArrivalID, locationid:locId},
                success: function (output) {
                    subRoomsDiv.append(output);
                    currentBtn.parent().hide();
                    console.log(totalCurrentDivs);
                    console.log(maxRooms);
                    if(totalCurrentDivs==(maxRooms-1)){
                        subRoomsDiv.find('div.roomDiv').last().find('.addRoomBtn').hide();
                        console.log('total 5 added');
                    }
                }
            });
        }
    });
    body.on('click','.removeBtn',function(){
        var removeBtn = $(this);
        var currentArrivalID = removeBtn.attr('data-id');
        var mainDiv = $('#sub-forms-div'+currentArrivalID);
        removeBtn.parents('.roomDiv').remove();

        //Now we need to check what button to show
        var totalCurrentDivs = mainDiv.find('div.roomDiv').length;
        console.log(totalCurrentDivs);
        if(totalCurrentDivs){
            mainDiv.find('.roomDiv').last().find('.actionButtons').show();
        }else{
            console.log(mainDiv);
            console.log(currentArrivalID);
            mainDiv.prev().show();
        }
    });

    //Need to code fro Arrival Transport
    //When Clicked on Add Transport
    body.on('click','.addArrTransportBtn',function(){
        var button = $(this);
        var arrivalDiv = button.parents('.arrivalsDiv');
        var mainTransportsDiv = arrivalDiv.find('.arrTransportsDiv');
        var totalTransportDivs = mainTransportsDiv.find('div.arr_transport_div').length + 1;
        var arrivalsID = arrivalDiv.attr('data-id');
        console.log(arrivalsID);
        var maxDivs = 5;
        if(totalTransportDivs<maxDivs){
            $.ajax({
                url: "<?=$url?>/custom_updates/arr_transports.php",
                type:"POST",
                data:{max:maxDivs,dataID:totalTransportDivs,arrID:arrivalsID},
                success:function(output){
//                    console.log(output);
                    mainTransportsDiv.append(output);
                    button.parents('div.actionBtnsArrTransportDiv').hide();
                }
            });
        }else{
            console.log('Max Arrival Transport Divs Reached');
        }
    });
    body.on('click','.remArrTransportBtn',function(){
        var mainTransportsDiv = $('.arrTransportsDiv');
        var currentMainDiv = $(this).parents('div.arr_transport_div');
        //Remove this Current Div.
        currentMainDiv.remove();
        //Now Need to Check if there are any other divs in the super main div.
        var totalTransportDivs = mainTransportsDiv.find('div.arr_transport_div').length;
        if(totalTransportDivs > 0){
            mainTransportsDiv.find('div.arr_transport_div').last().find('div.actionBtnsArrTransportDiv').show();
        }else{
            mainTransportsDiv.html('');
            $('div.actionBtnsArrTransportDiv').show();
        }

    });


//Need to code for Depature Transport
    //When Clicked on Add Transport
    body.on('click','.addDptTransportBtn',function(){
        var button = $(this);
        var dptDiv = button.parents('.departureDivs');
        var mainTransportsDiv = dptDiv.find('.dptTransportsDiv');
        var totalTransportDivs = mainTransportsDiv.find('div.dpt_transport_div').length + 1;
        var dptsID = dptDiv.attr('data-id');
        console.log(dptsID);
        var maxDivs = 5;
        if(totalTransportDivs<maxDivs){
            $.ajax({
                url: "<?=$url?>/custom_updates/dpt_transports.php",
                type:"POST",
                data:{max:maxDivs,dataID:totalTransportDivs,dptID:dptsID},
                success:function(output){
                    mainTransportsDiv.append(output);
                    button.parents('div.actionBtnsDptTransportDiv').hide();
                }
            });
        }else{
            console.log('Max Arrival Transport Divs Reached');
        }
    });
    body.on('click','.remDptTransportBtn',function(){
        var mainTransportsDiv = $('.dptTransportsDiv');
        var currentMainDiv = $(this).parents('div.dpt_transport_div');
        //Remove this Current Div.
        currentMainDiv.remove();
        //Now Need to Check if there are any other divs in the super main div.
        var totalTransportDivs = mainTransportsDiv.find('div.dpt_transport_div').length;
        if(totalTransportDivs > 0){
            mainTransportsDiv.find('div.dpt_transport_div').last().find('div.actionBtnsDptTransportDiv').show();
        }else{
            mainTransportsDiv.html('');
            $('div.actionBtnsDptTransportDiv').show();
        }

    });

    //Now need to work on transport mode
    body.on('change','.transport_mode',function(){
        var parentDiv = $(this).parents('.transport-div');
        var changedValue = $(this).val();
        console.log(changedValue);
        if(changedValue && (changedValue !== 'Group Transfers')){
            parentDiv.find('.driver').removeAttr('disabled');
        }else{
            parentDiv.find('.driver').attr('disabled','disabled');
            parentDiv.find('.driver').val('0');
            //IF THIS GOES TO DISABLE THEN THE OTHER THING SHOULD ALSO GO DISABLE.
            parentDiv.find('.vehicle').attr('disabled','disabled');
            parentDiv.find('.vehicle').val('0');
        }

    });
    body.on('change','.driver',function(){
        var parentDiv = $(this).parents('.transport-div');
        var changedValue = $(this).val();
        var arr_vehicle = parentDiv.find('.vehicle');
        if(changedValue && parseInt(changedValue) > 0){
            parentDiv.find('.vehicle').removeAttr('disabled');
            arr_vehicle.html("<option>Loading vehicles ...</option>");
            $.post("select_vehicle.php", {driverid:changedValue}, function(data){
                arr_vehicle.html(data);
            });
        }else{
            parentDiv.find('.vehicle').attr('disabled','disabled');
            parentDiv.find('.vehicle').val('0');
        }


    });

   /* body.on('focus','#tour-oper', function(){
        var e = $.Event( "keypress", { which: 13 } );
        $(this).trigger(e);
    })*/
    body.on('keyup', function(e){
        var ele = $(e.target);
        if(ele.attr('class') == 'triggerTourOp'){
            $('#tour-oper').select2('open'); 
        }
       /* else if(ele.find('#select2-tour-oper-container').length){ 
            console.log(ele.attr('id'));
            $('#oper-code').focus(); 
        }*/
        else if(ele.attr('class') == 'triggerDropOff'){
            $('#arr-dropoff').select2('open'); 
        }
       /* else if(ele.find('#select2-arr-dropoff-container').length){
            $('#no-of-rooms').focus();
        }*/
        console.log(ele);

    })
    // focus next fields on select 2 select
    $('.onselection').on('select2:select', function(e){
        var $id = $(this).attr('id');
        if($id == 'tour-oper') 
            $('#oper-code').focus(); 
        else if($id == 'arr-drooff'){
            $('#no-of-rooms').focus();
        }
    })
  //  var element = $('#select-tour-oper-results').parents('.select2-container').find('.select2-search__field');

        
    $('.timepicker24').timepicker({
                defaultTime: '',
                showMeridian:false
            });
    
    $(document).on('keyup', 'input[type="text"]:not(#tour-ref-no)', function(e){
        var $str = $(this).val();
        $(this).val($str.substr(0,1).toUpperCase()+$str.substr(1).toLowerCase());
    })

    $(document).on('click','#add', function(e){
        if($('#ftres:checked').length == 0 && $('#ftdepres:checked').length == 0 && window.fsft_check == true) {
            $('#fsft-checkbox-warn').modal('show');
        } else {
            if($('#first-name').val() != '' && $('#last-name').val() != '' && $('.ref_no_check').attr('data-id') == 0){
                $('#add-reservations').submit(); 
            } else {
                $('html, body').animate({
                    scrollTop: $("#add-reservations").offset().top
                }, 2000);
            }
        }

    })
    $(document).on('click','#fsft-checkbox-warn .continue', function(e){
        window.fsft_check = false;
        $('#fsft-checkbox-warn').modal('hide');
    })
   
    $(document).on('focusout', '#tour-ref-no', function(e){
        var ref = $(this);
        var ref_no = ref.val();
        if(ref_no != ""){
            $.ajax({
                url: "<?=$url?>/custom_updates/check_field_exist.php",
                type:"POST",
                data:{ref_no:ref_no},
                success:function(output){
                    output = JSON.parse(output);
                    ref.parents('.form-group').find('.ref_no_check').html(output["message"]).attr('data-id', output["exist"]);
                }
            });
        }
    })
</script>

        <?php // to add transport mode 
         include ('add_field_val_mdl.php'); ?>
        <?php
        $ok= isset($_GET['ok']);
        if($ok)  {
            if(isset($_GET['sysRef']) && !empty($_GET['sysRef'])){
                $sysRef = $_GET['sysRef'];
                echo '<script> prompt("Reservation successfully added", "Ref # '.$sysRef.'"); </script>';
            }
            else
                echo '<script> alert("Reservation successfully added"); </script>';
            }
        ?>
    </body>
</html>
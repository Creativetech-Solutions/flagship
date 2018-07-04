<?php header("Content-Type: text/html; charset=ISO-8859-1");
$url = '//' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
define("_VALID_PHP", true);
require_once("../admin-panel-skb/init.php");
if (!$user->levelCheck("2,9"))
    redirect_to("index.php");
$row = $user->getUserData();
?>
<?php
/**
 * @author Alvin Herbert
 * @copyright 2015
 */
include('ref.php');
include('fast_ref.php');
include('header.php');
include('select.class.php');
$countrycode = "SKB";
$fsref = "$countrycode-$flagship_ref";
$fastRef = "$countrycode-$flagship_fast_ref";
$loggedinas = $row->fname . ' ' . $row->lname;
site_header('Add Reservations');
if (isset($_POST['addreservation'])) {
    //Sanitize data
    $title_name = QuoteSmart(@$_POST['title_name']);
    $first_name = QuoteSmart(@$_POST['first_name']);
    $last_name = QuoteSmart(@$_POST['last_name']);

    $paymentType = QuoteSmart(@$_POST['paymentType']);

    if($paymentType == 2){ //pay on arrival
        $paymentAmount = QuoteSmart(@$_POST['paymentAmount']);
    }else{
        $paymentAmount = 0;
    }


    if($_POST['arr_ServiceOnly']){
        $arrServiceOnly = true;
    }else{
        $arrServiceOnly = false;
    }
    $pnr = QuoteSmart(@$_POST['pnr']);
    $tour_oper = QuoteSmart(@$_POST['tour_oper']);
    $oper_code = QuoteSmart(@$_POST['oper_code']);
    $tour_ref_no = QuoteSmart(@$_POST['tour_ref_no']);
    $affiliates = QuoteSmart(@$_POST['affiliates']);
    $adults = QuoteSmart(@$_POST['adults']);
    $children = QuoteSmart(@$_POST['children']);
    $infants = QuoteSmart(@$_POST['infants']);
    $tour_notes = QuoteSmart(@$_POST['tour_notes']);
    $arr_date = QuoteSmart(@$_POST['arr_date']);
    $arr_time = QuoteSmart(@$_POST['arr_time']);
    $arr_flight_no = QuoteSmart(@$_POST['arr_flight_no']);
    $flight_class = QuoteSmart(@$_POST['flight_class']);

    if(isset($_POST['total_amount'])){
        $total_amount = $_POST['total_amount'];
    } else {
        $total_amount = 0;
    }

    if (isset($_POST['arr_transport'])) {
        $arr_transport = QuoteSmart(implode(', ', $_POST['arr_transport']));
    } else {
        $arr_transport = '';
    }
    $arr_driver = QuoteSmart(@$_POST['arr_driver']);
    $arr_vehicle_no = QuoteSmart(@$_POST['arr_vehicle_no']);
    $arr_pickup = QuoteSmart(@$_POST['arr_pickup']);
    $arr_dropoff = QuoteSmart(@$_POST['arr_dropoff']);
    if (!empty($_POST['room_type'])) {
        $room_type = QuoteSmart($_POST['room_type']);
    } else {
        $room_type = '';
    }
    $rep_type = (isset($_POST['rep_type']) and !empty($_POST['rep_type'])) ? QuoteSmart(implode(', ', @$_POST['rep_type'])) : '';
    $client_reqs = QuoteSmart(implode(', ', $_POST['client_reqs']));
    $infant_seats = QuoteSmart(@$_POST['infant_seats']);
    $child_seats = QuoteSmart(@$_POST['child_seats']);
    $booster_seats = isset($_POST['booster_seats']) ? QuoteSmart($_POST['booster_seats']) : '';
    $vouchers = QuoteSmart(@$_POST['vouchers']);
    $dpt_date = QuoteSmart(@$_POST['dpt_date']);
    $dpt_time = QuoteSmart(@$_POST['dpt_time']);
    $dpt_flight_no = QuoteSmart(@$_POST['dpt_flight_no']);
    $dpt_transport = !empty($_POST['dpt_transport']) ? QuoteSmart(implode(', ', $_POST['dpt_transport'])) : '';
    $dpt_driver = QuoteSmart(@$_POST['dpt_driver']);
    $dpt_vehicle_no = QuoteSmart(@$_POST['dpt_vehicle_no']);
    $dpt_pickup = QuoteSmart(@$_POST['dpt_pickup']);
    $dpt_dropoff = QuoteSmart(@$_POST['dpt_dropoff']);
    $pickup_time = QuoteSmart(@$_POST['pickup_time']);
    $dpt_notes = QuoteSmart(@$_POST['dpt_notes']);
    $arr_transport_notes = QuoteSmart(@$_POST['arr_transport_notes']);
    $arr_hotel_notes = QuoteSmart(@$_POST['arr_hotel_notes']);
    $dpt_transport_notes = QuoteSmart(@$_POST['dpt_transport_notes']);
    $dpt_flight_class = QuoteSmart(@$_POST['dpt_flight_class']);
    $bottled_water = QuoteSmart(@$_POST['bottled_water']);
    $cold_towels = QuoteSmart(@$_POST['cold_towels']);
    $rooms = QuoteSmart(@$_POST['no_of_rooms']);
    $room_no = QuoteSmart(@$_POST['room_no']);
    $ftres = 1;
    $arr_main = 1;
    $dpt_main = 1;
    //Arrival0 Rooms
    //Room0
    $arr0_room_type = $_POST['arr0_room_type'];
    $arr0_room_no = $_POST['arr0_room_no'];
    $arr0_room_last_name = $_POST['arr0_room_last_name'];
    //Room1
    if (isset($_POST['arr0_room_no2'])) {
        $arr0_room_type1 = $_POST['arr0_room_type1'];
        $arr0_room_no1 = $_POST['arr0_room_no1'];
        $arr0_room_last_name1 = $_POST['arr0_room_last_name1'];
    }
    //Room2
    if (isset($_POST['arr0_room_no2'])) {
        $arr0_room_type2 = $_POST['arr0_room_type2'];
        $arr0_room_no2 = $_POST['arr0_room_no2'];
        $arr0_room_last_name2 = $_POST['arr0_room_last_name2'];
    }
    //Room3
    if (isset($_POST['arr0_room_no3'])) {
        $arr0_room_type3 = $_POST['arr0_room_type3'];
        $arr0_room_no3 = $_POST['arr0_room_no3'];
        $arr0_room_last_name3 = $_POST['arr0_room_last_name3'];
    }
    //Room4
    if (isset($_POST['arr0_room_no4'])) {
        $arr0_room_type4 = $_POST['arr0_room_type4'];
        $arr0_room_no4 = $_POST['arr0_room_no4'];
        $arr0_room_last_name4 = $_POST['arr0_room_last_name4'];
    }
    //Room5
    if (isset($_POST['arr0_room_no5'])) {
        $arr0_room_type5 = $_POST['arr0_room_type5'];
        $arr0_room_no5 = $_POST['arr0_room_no5'];
        $arr0_room_last_name5 = $_POST['arr0_room_last_name5'];
    }
    //JetCenter
    if (isset($_POST['jetCenter'])) {
        $jetCenter = 1;
    } else {
        $jetCenter = 0;
    }

    //Arrivals Transport Mode.
    $arr_transport_mode = $_POST['arr_transport'];
    $arr_driver = $_POST['arr_driver'];
    $arr_vehicle_no = $_POST['arr_vehicle_no'];
    $arr_luggage_vehicle_no = $_POST['arr_luggage_vehicle_no'];

    $arrival_transport_array = array();
    if(!empty($arr_transport_mode) and is_array($arr_transport_mode)){
        foreach($arr_transport_mode as $key=>$val){
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arr_driver[$key],
                'vehicle' => $arr_vehicle_no[$key],
                'luggage_vehicle' => $arr_luggage_vehicle_no[$key]
            );
            $arrival_transport_array[$key] = $tempArray;
        }
    }

    //Arrival 1
    $arr_date1 = QuoteSmart(@$_POST['arr_date1']);
    $arr_time1 = QuoteSmart(@$_POST['arr_time1']);
    $arr_flight_no1 = QuoteSmart(@$_POST['arr_flight_no1']);
    $flight_class1 = QuoteSmart(@$_POST['flight_class1']);
    $arr1_transport = QuoteSmart(implode(', ', $_POST['arr1_transport']));
    $arr_driver1 = QuoteSmart(@$_POST['arr_driver1']);
    $arr_vehicle_no1 = QuoteSmart(@$_POST['arr_vehicle_no1']);
    $arr_pickup1 = QuoteSmart(@$_POST['arr_pickup1']);
    $arr_dropoff1 = QuoteSmart(@$_POST['arr_dropoff1']);
    $room_type1 = QuoteSmart(@$_POST['room_type1']);
    $rep_type1 = (isset($_POST['rep_type1']) and !empty($_POST['rep_type1'])) ? QuoteSmart(implode(', ', @$_POST['rep_type1'])) : '';
    $client1_reqs = !empty($_POST['client1_reqs']) ? QuoteSmart(implode(', ', $_POST['client1_reqs'])) : '';
    $arr_transport_notes1 = QuoteSmart(@$_POST['arr_transport_notes1']);
    $arr_hotel_notes1 = QuoteSmart(@$_POST['arr_hotel_notes1']);
    $infant_seats1 = QuoteSmart(@$_POST['infant_seats1']);
    $child_seats1 = QuoteSmart(@$_POST['child_seats1']);
    $booster_seats1 = QuoteSmart(@$_POST['booster_seats1']);
    $vouchers1 = QuoteSmart(@$_POST['vouchers1']);
    $cold_towels1 = QuoteSmart(@$_POST['cold_towels1']);
    $bottled_water1 = QuoteSmart(@$_POST['bottled_water1']);
    $rooms1 = QuoteSmart(@$_POST['no_of_rooms1']);
    $room_no1 = QuoteSmart(@$_POST['room_no1']);
    //Arrival1 Rooms
    //Room0
    $arr1_room_type = $_POST['arr1_room_type'];
    $arr1_room_no = $_POST['arr1_room_no'];
    $arr1_room_last_name = $_POST['arr1_room_last_name'];
    //Room1
    if (isset($_POST['arr1_room_no1'])) {
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

    //Arrivals 1 Transport Mode.
    $arr1_transport_mode = $_POST['arr1_transport'];
    $arr1_driver = $_POST['arr1_driver'];
    $arr1_vehicle_no = $_POST['arr1_vehicle_no'];

    $arrival1_transport_array = array();
    if(!empty($arr1_transport_mode) and is_array($arr1_transport_mode)){
        foreach($arr1_transport_mode as $key=>$val){
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arr1_driver[$key],
                'vehicle' => $arr1_vehicle_no[$key]
            );
            $arrival1_transport_array[$key] = $tempArray;
        }
    }

    //Arrival 2
    $arr_date2 = QuoteSmart(@$_POST['arr_date2']);
    $arr_time2 = QuoteSmart(@$_POST['arr_time2']);
    $arr_flight_no2 = QuoteSmart(@$_POST['arr_flight_no2']);
    $flight_class2 = QuoteSmart(@$_POST['flight_class2']);
    $arr2_transport = !empty($_POST['arr2_transport']) ? QuoteSmart(implode(', ', $_POST['arr2_transport'])) : '';
    $arr_driver2 = QuoteSmart(@$_POST['arr_driver2']);
    $arr_vehicle_no2 = QuoteSmart(@$_POST['arr_vehicle_no2']);
    $arr_pickup2 = QuoteSmart(@$_POST['arr_pickup2']);
    $arr_dropoff2 = QuoteSmart(@$_POST['arr_dropoff2']);
    $room_type2 = QuoteSmart(@$_POST['room_type2']);
    $rep_type2 = (isset($_POST['rep_type2']) and !empty($_POST['rep_type2'])) ? QuoteSmart(implode(', ', @$_POST['rep_type2'])) : '';
    $client2_reqs = !empty($_POST['client2_reqs']) ? QuoteSmart(implode(', ', $_POST['client2_reqs'])) : '';
    $arr_transport_notes2 = QuoteSmart(@$_POST['arr_transport_notes2']);
    $arr_hotel_notes2 = QuoteSmart(@$_POST['arr_hotel_notes2']);
    $infant_seats2 = QuoteSmart(@$_POST['infant_seats2']);
    $child_seats2 = QuoteSmart(@$_POST['child_seats2']);
    $booster_seats2 = QuoteSmart(@$_POST['booster_seats2']);
    $vouchers2 = QuoteSmart(@$_POST['vouchers2']);
    $cold_towels2 = QuoteSmart(@$_POST['cold_towels2']);
    $bottled_water2 = QuoteSmart(@$_POST['bottled_water2']);
    $rooms2 = QuoteSmart(@$_POST['no_of_rooms2']);
    $room_no2 = QuoteSmart(@$_POST['room_no2']);
    //Arrival2 Rooms
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
    //Arrivals 2 Transport Mode.
    $arr2_transport_mode = $_POST['arr2_transport'];
    $arr2_driver = $_POST['arr2_driver'];
    $arr2_vehicle_no = $_POST['arr2_vehicle_no'];


    $arrival2_transport_array = array();
    if(!empty($arr2_transport_mode) and is_array($arr2_transport_mode)){
        foreach($arr2_transport_mode as $key=>$val){
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arr2_driver[$key],
                'vehicle' => $arr2_vehicle_no[$key]
            );
            $arrival2_transport_array[$key] = $tempArray;
        }
    }
    //Arrival 3
    $arr_date3 = QuoteSmart(@$_POST['arr_date3']);
    $arr_time3 = QuoteSmart(@$_POST['arr_time3']);
    $arr_flight_no3 = QuoteSmart(@$_POST['arr_flight_no3']);
    $flight_class3 = QuoteSmart(@$_POST['flight_class3']);
    $arr3_transport = !empty($_POST['arr3_transport']) ? QuoteSmart(implode(', ', $_POST['arr3_transport'])) : '';
    $arr_driver3 = QuoteSmart(@$_POST['arr_driver3']);
    $arr_vehicle_no3 = QuoteSmart(@$_POST['arr_vehicle_no3']);
    $arr_pickup3 = QuoteSmart(@$_POST['arr_pickup3']);
    $arr_dropoff3 = QuoteSmart(@$_POST['arr_dropoff3']);
    $room_type3 = QuoteSmart(@$_POST['room_type3']);
    $rep_type3 = (isset($_POST['rep_type3']) and !empty($_POST['rep_type3'])) ? QuoteSmart(implode(', ', @$_POST['rep_type3'])) : '';
    $client3_reqs = !empty($_POST['client3_reqs']) ? QuoteSmart(implode(', ', $_POST['client3_reqs'])) : '';
    $arr_transport_notes3 = QuoteSmart(@$_POST['arr_transport_notes3']);
    $arr_hotel_notes3 = QuoteSmart(@$_POST['arr_hotel_notes3']);
    $infant_seats3 = QuoteSmart(@$_POST['infant_seats3']);
    $child_seats3 = QuoteSmart(@$_POST['child_seats3']);
    $booster_seats3 = QuoteSmart(@$_POST['booster_seats3']);
    $vouchers3 = QuoteSmart(@$_POST['vouchers3']);
    $cold_towels3 = QuoteSmart(@$_POST['cold_towels3']);
    $bottled_water3 = QuoteSmart(@$_POST['bottled_water3']);
    $rooms3 = QuoteSmart(@$_POST['no_of_rooms3']);
    $room_no3 = QuoteSmart(@$_POST['room_no3']);
    //Arrival3 Rooms
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
    //Arrivals 3 Transport Mode.
    $arr3_transport_mode = $_POST['arr3_transport'];
    $arr3_driver = $_POST['arr3_driver'];
    $arr3_vehicle_no = $_POST['arr3_vehicle_no'];
    //Making Array of all transports for Arrivals 3
    $arrival3_transport_array = array();
    if(!empty($arr3_transport_mode) and is_array($arr3_transport_mode)){
        foreach($arr3_transport_mode as $key=>$val){
            $tempArray = array(
                'transport_mode' => $val,
                'driver' => $arr3_driver[$key],
                'vehicle' => $arr3_vehicle_no[$key]
            );
            $arrival3_transport_array[$key] = $tempArray;
        }
    }

    //Departure 1
    $dpt_date1 = QuoteSmart(@$_POST['dpt_date1']);
    $dpt_time1 = QuoteSmart(@$_POST['dpt_time1']);
    $dpt_flight_no1 = QuoteSmart(@$_POST['dpt_flight_no1']);
    $dpt_flight_class1 = QuoteSmart(@$_POST['dpt_flight_class1']);
    $dpt1_transport = !empty($_POST['dpt1_transport']) ? QuoteSmart(implode(', ', $_POST['dpt1_transport'])) : '';
    $dpt_driver1 = QuoteSmart(@$_POST['dpt_driver1']);
    $dpt_vehicle_no1 = QuoteSmart(@$_POST['dpt_vehicle_no1']);
    $dpt_pickup1 = QuoteSmart(@$_POST['dpt_pickup1']);
    $dpt_dropoff1 = QuoteSmart(@$_POST['dpt_dropoff1']);
    $pickup_time1 = QuoteSmart(@$_POST['pickup_time1']);
    $dpt_transport_notes1 = QuoteSmart(@$_POST['dpt_transport_notes1']);
    //JetCenter 1
    if (isset($_POST['jetCenter1'])) {
        $jetCenter1 = 1;
    } else {
        $jetCenter1 = 0;
    }
    //Departure 2
    $dpt_date2 = QuoteSmart(@$_POST['dpt_date2']);
    $dpt_time2 = QuoteSmart(@$_POST['dpt_time2']);
    $dpt_flight_no2 = QuoteSmart(@$_POST['dpt_flight_no2']);
    $dpt_flight_class2 = QuoteSmart(@$_POST['dpt_flight_class2']);
    $dpt2_transport = !empty($_POST['dpt2_transport']) ? QuoteSmart(implode(', ', $_POST['dpt2_transport'])) : '';
    $dpt_driver2 = QuoteSmart(@$_POST['dpt_driver2']);
    $dpt_vehicle_no2 = QuoteSmart(@$_POST['dpt_vehicle_no2']);
    $dpt_pickup2 = QuoteSmart(@$_POST['dpt_pickup2']);
    $dpt_dropoff2 = QuoteSmart(@$_POST['dpt_dropoff2']);
    $pickup_time2 = QuoteSmart(@$_POST['pickup_time2']);
    $dpt_transport_notes2 = QuoteSmart(@$_POST['dpt_transport_notes2']);
    //JetCenter 2
    if (isset($_POST['jetCenter2'])) {
        $jetCenter2 = 1;
    } else {
        $jetCenter2 = 0;
    }
    //Departure 3
    $dpt_date3 = QuoteSmart(@$_POST['dpt_date3']);
    $dpt_time3 = QuoteSmart(@$_POST['dpt_time3']);
    $dpt_flight_no3 = QuoteSmart(@$_POST['dpt_flight_no3']);
    $dpt_flight_class3 = QuoteSmart(@$_POST['dpt_flight_class3']);
    $dpt3_transport = !empty($_POST['dpt3_transport']) ? QuoteSmart(implode(', ', $_POST['dpt3_transport'])) : '';
    $dpt_driver3 = QuoteSmart(@$_POST['dpt_driver3']);
    $dpt_vehicle_no3 = QuoteSmart(@$_POST['dpt_vehicle_no3']);
    $dpt_pickup3 = QuoteSmart(@$_POST['dpt_pickup3']);
    $dpt_dropoff3 = QuoteSmart(@$_POST['dpt_dropoff3']);
    $pickup_time3 = QuoteSmart(@$_POST['pickup_time3']);
    $dpt_transport_notes3 = QuoteSmart(@$_POST['dpt_transport_notes3']);
    //JetCenter 3
    if (isset($_POST['jetCenter3'])) {
        $jetCenter3 = 1;
    } else {
        $jetCenter3 = 0;
    }
    //Transfer
    $transfer_pickup = QuoteSmart(@$_POST['transfer_pickup']);
    $transfer_time = QuoteSmart(@$_POST['transfer_pickup_time']);
    $transfer_pickup_date = QuoteSmart(@$_POST['transfer_pickup_date']);
    $transfer_transport = !empty($_POST['transfer_transport']) ? QuoteSmart(implode(', ', $_POST['transfer_transport'])) : '';
    $transfer_dropoff = QuoteSmart(@$_POST['transfer_dropoff']);
    $transfer_driver = QuoteSmart(@$_POST['transfer_driver']);
    $transfer_vehicle_no = QuoteSmart(@$_POST['transfer_vehicle_no']);
    $transfer_notes = QuoteSmart(@$_POST['transfer_notes']);
    //Transfer 1
    $transfer_pickup1 = QuoteSmart(@$_POST['transfer_pickup1']);
    $transfer_time1 = QuoteSmart(@$_POST['transfer_pickup_time1']);
    $transfer_pickup_date1 = QuoteSmart(@$_POST['transfer_pickup_date1']);
    $transfer1_transport = !empty($_POST['transfer1_transport']) ? QuoteSmart(implode(', ', $_POST['transfer1_transport'])) : '';
    $transfer_dropoff1 = QuoteSmart(@$_POST['transfer_dropoff1']);
    $transfer_driver1 = QuoteSmart(@$_POST['transfer_driver1']);
    $transfer_vehicle_no1 = QuoteSmart(@$_POST['transfer_vehicle_no1']);
    $transfer_notes1 = QuoteSmart(@$_POST['transfer_notes1']);
    //Transfer 2
    $transfer_pickup2 = QuoteSmart(@$_POST['transfer_pickup2']);
    $transfer_time2 = QuoteSmart(@$_POST['transfer_pickup_time2']);
    $transfer_pickup_date2 = QuoteSmart(@$_POST['transfer_pickup_date2']);
    $transfer_transport2 = !empty($_POST['transfer2_transport']) ? QuoteSmart(implode(', ', $_POST['transfer2_transport'])) : '';
    $transfer_dropoff2 = QuoteSmart(@$_POST['transfer_dropoff2']);
    $transfer_driver1 = QuoteSmart(@$_POST['transfer_driver2']);
    $transfer_vehicle_no2 = QuoteSmart(@$_POST['transfer_vehicle_no2']);
    $transfer_notes2 = QuoteSmart(@$_POST['transfer_notes2']);
    //Transfer 3
    $transfer_pickup3 = QuoteSmart(@$_POST['transfer_pickup3']);
    $transfer_time3 = QuoteSmart(@$_POST['transfer_pickup_time3']);
    $transfer_pickup_date3 = QuoteSmart(@$_POST['transfer_pickup_date3']);
    $transfer3_transport = !empty($_POST['transfer3_transport']) ? QuoteSmart(implode(', ', $_POST['transfer3_transport'])) : '';
    $transfer_dropoff3 = QuoteSmart(@$_POST['transfer_dropoff3']);
    $transfer_driver3 = QuoteSmart(@$_POST['transfer_driver3']);
    $transfer_vehicle_no3 = QuoteSmart(@$_POST['transfer_vehicle_no3']);
    $transfer_notes3 = QuoteSmart(@$_POST['transfer_notes3']);
    //Custom Code for dynamic Guest. //Haider
    $guestTitleName = $_POST['guest_title_name'];
    $guestFirstName = $_POST['guest_first_name'];
    $guestLastName = $_POST['guest_last_name'];
    $guestAdult = !empty($_POST['guest_adult']) ? $_POST['guest_adult'] : 0;
    $guestChildAge = $_POST['child_age'];
    $guestInfantAge = $_POST['infant_age'];
    $guestPNR = $_POST['guest_pnr'];
    //Phase2
    //Luggage Vehicle Check
    $luggageVehicle = (isset($_POST['luggageVehicle']) and !empty($_POST['luggageVehicle'])) ? 'Yes' : 'No';
    $luggageVehicle1 = (isset($_POST['luggageVehicle1']) and !empty($_POST['luggageVehicle1'])) ? 'Yes' : 'No';
    $luggageVehicle2 = (isset($_POST['luggageVehicle2']) and !empty($_POST['luggageVehicle2'])) ? 'Yes' : 'No';
    $luggageVehicle3 = (isset($_POST['luggageVehicle3']) and !empty($_POST['luggageVehicle3'])) ? 'Yes' : 'No';
    // Number of Total Guests
    $totalNumberOfGuests = $_POST['totalGuests'];
    if (empty($totalNumberOfGuests) or !is_numeric($totalNumberOfGuests)) {
        $total_guests = 1;
    } else {
        $total_guests = intval($totalNumberOfGuests);
    }
    $guestsArray = array();
    foreach ($guestFirstName as $key => $val) {
        $arrayToPush = array(
            'guestTitle' => $guestTitleName[$key],
            'guestFirstName' => $guestFirstName[$key],
            'guestLastName' => $guestLastName[$key],
            'guestAdult' => @$guestAdult[$key],
            'guestChildAge' => @$guestChildAge[$key],
            'guestInfantAge' => $guestInfantAge[$key],
            'guestPNR' => $guestPNR[$key]
        );
        array_push($guestsArray, $arrayToPush);
    }
//    print_r($guestsArray);
    $user_action = "add new fast track reservation:  $title_name. $first_name $last_name #ref:$fsref";
    //Now Just Loop the Guests the the guests table
    if (!empty($guestsArray)) {
        foreach ($guestsArray as $guest) {
            $sqlGuestQuery = "INSERT INTO skb_guest " .
                "(ref_no_sys, title_name, first_name, last_name, adult, child_age, infant_age, pnr) " .
                "VALUES ('$fsref', '" . $guest['guestTitle'] . "', '" . $guest['guestFirstName'] . "', '" . $guest['guestLastName'] . "', '" . (!empty($guest['guestAdult']) ? 1 : 0) . "', '" . $guest['guestChildAge'] . "', '" . $guest['guestInfantAge'] . "', '" . $guest['guestPNR'] . "')";
            $retval1 = mysql_query($sqlGuestQuery, $conn);
            if (mysql_errno()) {
                echo $sqlGuestQuery;
                die(mysql_error());
            }
        }
    }
    $sql_5 = "INSERT INTO skb_arrivals " .
        "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no, arr_main, luggage_vehicle,room_last_name, fast_track) " .
        "VALUES ('$fsref', '$arr_date', '$arr_time', '$arr_flight_no', '$flight_class', '$arr_transport', '$arr_driver', '$arr_vehicle_no', '$arr_pickup', '$arr_dropoff', '$room_type', '$rep_type', '$client_reqs', '$arr_transport_notes', '$arr_hotel_notes', '$infant_seats', '$child_seats', '$booster_seats', '$vouchers', '$cold_towels', '$bottled_water', '$rooms', '$room_no', '$arr_main','$luggageVehicle','$arr0_room_last_name', '$ftres')";
    $retval5 = mysql_query($sql_5, $conn);
    if (mysql_errno()) {
        echo $sql_5;
        echo "<br/>" . mysql_error();
        $lastArrival0ID = 0;
    } else {
        $lastArrival0ID = mysql_insert_id();
    }
    if (!empty($lastArrival0ID)) {

        //Need to Insert Arrival Id Column in array also
        array_walk($arrival_transport_array,function(&$subArray,$key,$lastArrival0ID){
            $subArray['arrival_id'] = $lastArrival0ID;
        },$lastArrival0ID);
        foreach($arrival_transport_array as $subArray){
            $arrivals_transport_sql = build_sql_insert('skb_arrivals_transports',$subArray);
            //Now Run the Queries for this.
            $arrivals_transport_resource = mysql_query($arrivals_transport_sql,$conn);
            if(mysql_errno()) {
                echo $arrivals_transport_sql;
                echo "<pre><br/>LINE::".__LINE__."::". mysql_error().'</pre>';
            }
        }

        //Insert the First Arrival Room Details.
        //For Room 0
        $sql_arrival0_room = "INSERT INTO skb_arrivals_rooms " .
            "(arrival_id, room_type, room_number, last_name) " .
            "VALUES ('$lastArrival0ID', '$arr0_room_type', '$arr0_room_no', '$arr0_room_last_name')";
        $resource_arrival0_room = mysql_query($sql_arrival0_room, $conn);
        if (mysql_errno()) {
            echo $sql_arrival0_room;
            echo "<br/>" . mysql_error();
            echo "Error near LINE::" . __LINE__;
        }
        //now, we need to check if there is another rooms selected or not.
        if (!empty($arr0_room_no1)) {
            $sql_arrival0_room1 = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival0ID', '$arr0_room_type1', '$arr0_room_no1', '$arr0_room_last_name1')";
            $resource_arrival0_room1 = mysql_query($sql_arrival0_room1, $conn);
            if (mysql_errno()) {
                echo '<pre>';
                echo $resource_arrival0_room1;
                echo "<br/>" . __LINE__ . "::" . mysql_error();
                echo "Error near LINE::" . __LINE__;
                echo '</pre>';
            }
        }
        if (!empty($arr0_room_no2)) {
            $sql_arrival0_room2 = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival0ID', '$arr0_room_type2', '$arr0_room_no2', '$arr0_room_last_name2')";
            $resource_arrival0_room2 = mysql_query($sql_arrival0_room2, $conn);
            if (mysql_errno()) {
                echo '<pre>';
                echo $sql_arrival0_room2;
                echo "<br/>" . __LINE__ . "::" . mysql_error();
                echo "Error near LINE::" . __LINE__;
                echo '</pre>';
            }
        }
        if (!empty($arr0_room_no3)) {
            $sql_arrival0_room13 = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival0ID', '$arr0_room_type3', '$arr0_room_no3', '$arr0_room_last_name3')";
            $resource_arrival0_room3 = mysql_query($sql_arrival0_room13, $conn);
        }
        if (!empty($arr0_room_no4)) {
            $sql_arrival0_room4 = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival0ID', '$arr0_room_type4', '$arr0_room_no4', '$arr0_room_last_name4')";
            $resource_arrival0_room4 = mysql_query($sql_arrival0_room4, $conn);
        }
        if (!empty($arr0_room_no5)) {
            $sql_arrival0_room5 = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival0ID', '$arr0_room_type5', '$arr0_room_no5','$arr0_room_last_name5')";
            $resource_arrival0_room5 = mysql_query($sql_arrival0_room5, $conn);
        }
    }
    $arrival1active = QuoteSmart($_POST['arrival1active']);
    //Arrival 1 if Exists.
    if ($arrival1active == 1) {
        $sql_6 = "INSERT INTO skb_arrivals " .
            "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no, luggage_vehicle) " .
            "VALUES ('$fsref', '$arr_date1', '$arr_time1', '$arr_flight_no1', '$flight_class1', '$arr1_transport', '$arr_driver1', '$arr_vehicle_no1', '$arr_pickup1', '$arr_dropoff1', '$room_type1', '$rep_type1', '$client1_reqs', '$arr_transport_notes1', '$arr_hotel_notes1', '$infant_seats1', '$child_seats1', '$booster_seats1', '$vouchers1', '$cold_towels1', '$bottled_water1', '$rooms1', '$room_no1','$luggageVehicle1')";
        $retval6 = mysql_query($sql_6, $conn);
        if (mysql_errno()) {
            echo $sql_6;
            echo "<br/>" . __LINE__ . "::" . mysql_error();
            $lastArrival1ID = 0;
        } else {
            $Arr0roomIDs = array();
            $lastArrival1ID = mysql_insert_id();
        }
        //Now we need to check if we have rooms.
        if (!empty($lastArrival1ID)) {

            //Need to Insert Arrival Id Column in array also
            array_walk($arrival1_transport_array,function(&$subArray,$key,$lastArrival1ID){
                $subArray['arrival_id'] = $lastArrival1ID;
            },$lastArrival1ID);

            foreach($arrival1_transport_array as $subArray){
                $arrivals1_transport_sql = build_sql_insert('skb_arrivals_transports',$subArray);
                //Now Run the Queries for this.
                $arrivals1_transport_resource = mysql_query($arrivals1_transport_sql,$conn);
                if(mysql_errno()) {
                    echo $arrivals1_transport_sql;
                    echo "<br/>LINE::".__LINE__."::". mysql_error();
                }
            }

            //Insert the First Arrival Room Details.
            //For Room 0
            $sql_arrival1_room = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival1ID', '$arr1_room_type', '$arr1_room_no', '$arr1_room_last_name')";
            $resource_arrival1_room = mysql_query($sql_arrival1_room, $conn);
            if (mysql_errno()) {
                echo $sql_arrival1_room;
                echo "<br/>" . mysql_error();
                echo "Error near LINE::" . __LINE__;
            } else {
                array_push($arr0RoomID, $Arr0roomIDs);
            }
            //now, we need to check if there is another rooms selected or not.
            //Arr1 Room1
            if (!empty($arr1_room_no1)) {
                $sql_arrival1_room1 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival1ID', '$arr1_room_type1', '$arr1_room_no1', '$arr1_room_last_name1')";
                $resource_arrival1_room1 = mysql_query($sql_arrival1_room1, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival1_room1;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //now, we need to check if there is another rooms selected or not.
            //Arr1 Room2
            if (!empty($arr1_room_no2)) {
                $sql_arrival1_room2 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival1ID', '$arr1_room_type2', '$arr1_room_no2', '$arr1_room_last_name2')";
                $resource_arrival1_room2 = mysql_query($sql_arrival1_room2, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival1_room2;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            // Arr1 Room3
            if (!empty($arr1_room_no3)) {
                $sql_arrival1_room3 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival1ID', '$arr1_room_type3', '$arr1_room_no3', '$arr1_room_last_name3')";
                $resource_arrival1_room3 = mysql_query($sql_arrival1_room3, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival1_room3;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            // Arr1 Room4
            if (!empty($arr1_room_no4)) {
                $sql_arrival1_room4 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival1ID', '$arr1_room_type4', '$arr1_room_no4', '$arr1_room_last_name4')";
                $resource_arrival1_room4 = mysql_query($sql_arrival1_room3, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival1_room4;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            // Arr1 Room5
            if (!empty($arr1_room_no5)) {
                $sql_arrival1_room5 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival1ID', '$arr1_room_type5', '$arr1_room_no5', '$arr1_room_last_name5')";
                $resource_arrival1_room5 = mysql_query($sql_arrival1_room5, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival1_room5;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
        }
    }
    $arrival2active = QuoteSmart($_POST['arrival2active']);
    //Arrival 2 if Exists.
    if ($arrival2active == 1) {
        $sql_7 = "INSERT INTO skb_arrivals " .
            "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no, luggage_vehicle) " .
            "VALUES ('$fsref', '$arr_date2', '$arr_time2', '$arr_flight_no2', '$flight_class2', '$arr2_transport', '$arr_driver2', '$arr_vehicle_no2', '$arr_pickup2', '$arr_dropoff2', '$room_type2', '$rep_type2', '$client2_reqs', '$arr_transport_notes2', '$arr_hotel_notes2', '$infant_seats2', '$child_seats2', '$booster_seats2', '$vouchers2', '$cold_towels2', '$bottled_water2', '$rooms2', '$room_no2', '$luggageVehicle2')";
        $retval7 = mysql_query($sql_7, $conn);
        if (mysql_errno()) {
            echo "<br/>" . __LINE__ . "::" . mysql_error();
            $lastArrival2ID = 0;
        } else {
            $lastArrival2ID = mysql_insert_id();
        }
        if (!empty($lastArrival2ID)) {

            //Need to Insert Arrival Id Column in array also
            array_walk($arrival2_transport_array,function(&$subArray,$key,$lastArrival2ID){
                $subArray['arrival_id'] = $lastArrival2ID;
            },$lastArrival2ID);

            foreach($arrival2_transport_array as $subArray){
                $arrivals2_transport_sql = build_sql_insert('skb_arrivals_transports',$subArray);
                //Now Run the Queries for this.
                $arrivals2_transport_resource = mysql_query($arrivals2_transport_sql,$conn);
                if(mysql_errno()) {
                    echo $arrivals2_transport_sql;
                    echo "<br/>LINE::".__LINE__."::". mysql_error();
                }
            }

            //Arr2 Room0
            //Insert the First Arrival Room Details.
            $sql_arrival2_room = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival2ID', '$arr2_room_type', '$arr2_room_no', '$arr2_room_last_name')";
            $resource_arrival2_room = mysql_query($sql_arrival2_room, $conn);
            if (mysql_errno()) {
                echo $sql_arrival2_room;
                echo "<br/>" . mysql_error();
                echo "Error near LINE::" . __LINE__;
            }
            //Arr2 Room1
            if (!empty($arr2_room_no1)) {
                $sql_arrival2_room1 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival2ID', '$arr2_room_type1', '$arr2_room_no1', '$arr2_room_last_name1')";
                $resource_arrival2_room1 = mysql_query($sql_arrival2_room1, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival2_room1;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr2 Room2
            if (!empty($arr2_room_no1)) {
                $sql_arrival2_room2 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival2ID', '$arr2_room_type2', '$arr2_room_no2', '$arr2_room_last_name2')";
                $resource_arrival2_room2 = mysql_query($sql_arrival2_room2, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival2_room2;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr2 Room3
            if (!empty($arr2_room_no3)) {
                $sql_arrival2_room3 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival2ID', '$arr2_room_type3', '$arr2_room_no3', '$arr2_room_last_name3')";
                $resource_arrival2_room3 = mysql_query($sql_arrival2_room3, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival2_room3;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr2 Room4
            if (!empty($arr1_room_no4)) {
                $sql_arrival2_room4 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival2ID', '$arr2_room_type4', '$arr2_room_no4', '$arr2_room_last_name4')";
                $resource_arrival2_room4 = mysql_query($sql_arrival2_room4, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival2_room4;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr2 Room5
            if (!empty($arr2_room_no5)) {
                $sql_arrival2_room5 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival2ID', '$arr2_room_type5', '$arr2_room_no5', '$arr2_room_last_name5')";
                $resource_arrival2_room5 = mysql_query($sql_arrival2_room5, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival2_room5;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
        }
    }
    $arrival3active = QuoteSmart($_POST['arrival3active']);
    //Arrival 3 if Exists.
    if ($arrival3active == 1) {
        $sql_8 = "INSERT INTO skb_arrivals " .
            "(ref_no_sys, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, arr_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, rooms, room_no,luggage_vehicle) " .
            "VALUES ('$fsref', '$arr_date3', '$arr_time3', '$arr_flight_no3', '$flight_class3', '$arr3_transport', '$arr_driver3', '$arr_vehicle_no3', '$arr_pickup3', '$arr_dropoff3', '$room_type3', '$rep_type3', '$client3_reqs', '$arr_transport_notes3', '$arr_hotel_notes3', '$infant_seats3', '$child_seats3', '$booster_seats3', '$vouchers3', '$cold_towels3', '$bottled_water3', '$rooms3', '$room_no3', '$luggageVehicle3')";
        $retval8 = mysql_query($sql_8, $conn);
        if (mysql_errno()) {
            echo "<br/>" . __LINE__ . "::" . mysql_error();
            $lastArrival3ID = 0;
        } else {
            $lastArrival3ID = mysql_insert_id();
        }
        if (!empty($lastArrival3ID)) {

            //Need to Insert Arrival Id Column in array also
            array_walk($arrival3_transport_array,function(&$subArray,$key,$lastArrival3ID){
                $subArray['arrival_id'] = $lastArrival3ID;
            },$lastArrival3ID);

            foreach($arrival3_transport_array as $subArray){
                $arrivals3_transport_sql = build_sql_insert('skb_arrivals_transports',$subArray);
                //Now Run the Queries for this.
                $arrivals3_transport_resource = mysql_query($arrivals3_transport_sql,$conn);
                if(mysql_errno()) {
                    echo $arrivals3_transport_sql;
                    echo "<pre><br/>LINE::".__LINE__."::". mysql_error()."</pre>";
                }
            }

            //Arr3 Room0
            //Insert the First Arrival Room Details.
            $sql_arrival3_room = "INSERT INTO skb_arrivals_rooms " .
                "(arrival_id, room_type, room_number, last_name) " .
                "VALUES ('$lastArrival3ID', '$arr3_room_type', '$arr3_room_no', '$arr3_room_last_name')";
            $resource_arrival3_room = mysql_query($sql_arrival3_room, $conn);
            if (mysql_errno()) {
                echo $sql_arrival3_room;
                echo "<br/>" . mysql_error();
                echo "Error near LINE::" . __LINE__;
            }
            //Arr3 Room1
            if (!empty($arr3_room_no1)) {
                $sql_arrival3_room1 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival3ID', '$arr3_room_type1', '$arr3_room_no1', '$arr3_room_last_name1')";
                $resource_arrival3_room1 = mysql_query($sql_arrival3_room1, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival3_room1;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr3 Room2
            if (!empty($arr3_room_no2)) {
                $sql_arrival3_room2 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival3ID', '$arr3_room_type2', '$arr3_room_no2', '$arr3_room_last_name2')";
                $resource_arrival3_room2 = mysql_query($sql_arrival3_room2, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival3_room2;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr3 Room3
            if (!empty($arr3_room_no3)) {
                $sql_arrival3_room3 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival3ID', '$arr3_room_type3', '$arr3_room_no3', '$arr3_room_last_name3')";
                $resource_arrival3_room3 = mysql_query($sql_arrival3_room3, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival3_room3;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr3 Room4
            if (!empty($arr3_room_no4)) {
                $sql_arrival3_room4 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival3ID', '$arr3_room_type4', '$arr3_room_no4', '$arr3_room_last_name4')";
                $resource_arrival3_room4 = mysql_query($sql_arrival3_room4, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival3_room4;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
            //Arr3 Room5
            if (!empty($arr3_room_no5)) {
                $sql_arrival3_room5 = "INSERT INTO skb_arrivals_rooms " .
                    "(arrival_id, room_type, room_number, last_name) " .
                    "VALUES ('$lastArrival3ID', '$arr3_room_type5', '$arr3_room_no5', '$arr3_room_last_name5')";
                $resource_arrival3_room5 = mysql_query($sql_arrival3_room5, $conn);
                if (mysql_errno()) {
                    echo '<pre>';
                    echo $sql_arrival3_room5;
                    echo "<br/>" . __LINE__ . "::" . mysql_error();
                    echo '</pre>';
                }
            }
        }
    }

    //If Arrival Service Only then this Below Block Will Not Execute, If Arrival Service Not Checked then this block should Execute.
    if($arrServiceOnly !== true){
        $sql_9 = "INSERT INTO skb_departures " .
            "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes, dpt_main, dpt_jet_center, fast_track) " .
            "VALUES ('$fsref', '$dpt_date', '$dpt_time', '$dpt_flight_no', '$dpt_flight_class', '$dpt_transport', '$dpt_driver', '$dpt_vehicle_no', '$dpt_pickup', '$dpt_dropoff', '$pickup_time', '$dpt_transport_notes', '$dpt_main','$jetCenter', '$ftres')";
        $retval9 = mysql_query($sql_9, $conn);
        $departure1active = QuoteSmart($_POST['departure1active']);
        if ($departure1active == 1) {
            $sql_10 = "INSERT INTO skb_departures " .
                "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes,dpt_jet_center) " .
                "VALUES ('$fsref', '$dpt_date1', '$dpt_time1', '$dpt_flight_no1', '$dpt_flight_class1', '$dpt1_transport', '$dpt_driver1', '$dpt_vehicle_no1', '$dpt_pickup1', '$dpt_dropoff1', '$pickup_time1', '$dpt_transport_notes1','$dpt_transport_notes1','$jetCenter1')";
            $retval10 = mysql_query($sql_10, $conn);
        }
        $departure2active = QuoteSmart($_POST['departure2active']);
        if ($departure2active == 1) {
            $sql_11 = "INSERT INTO skb_departures " .
                "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes) " .
                "VALUES ('$fsref', '$dpt_date2', '$dpt_time2', '$dpt_flight_no2', '$dpt_flight_class2', '$dpt2_transport', '$dpt_driver2', '$dpt_vehicle_no2', '$dpt_pickup2', '$dpt_dropoff2', '$pickup_time2', '$dpt_transport_notes2','$jetCenter2')";
            $retval11 = mysql_query($sql_11, $conn);
        }
        $departure3active = QuoteSmart($_POST['departure3active']);
        if ($departure3active == 1) {
            $sql_12 = "INSERT INTO skb_departures " .
                "(ref_no_sys, dpt_date, dpt_time, dpt_flight_no, flight_class, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_transport_notes) " .
                "VALUES ('$fsref', '$dpt_date3', '$dpt_time3', '$dpt_flight_no3', '$dpt_flight_class3', '$dpt3_transport', '$dpt_driver3', '$dpt_vehicle_no3', '$dpt_pickup3', '$dpt_dropoff3', '$pickup_time3', '$dpt_transport_notes3','$jetCenter3')";
            $retval12 = mysql_query($sql_12, $conn);
        }
    }

    $transfermainactive = QuoteSmart($_POST['transfermainactive']);
    if ($transfermainactive == 1) {
        $sql_13 = "INSERT INTO skb_transfer " .
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) " .
            "VALUES ('$fsref', '$transfer_pickup','$transfer_pickup_date', '$transfer_time', '$transfer_dropoff', '$transfer_transport', '$transfer_vehicle_no', '$transfer_driver', '$transfer_notes')";
        $retval13 = mysql_query($sql_13, $conn);
    }
    $transfer1active = QuoteSmart($_POST['transfer1active']);
    if ($transfer1active == 1) {
        $sql_14 = "INSERT INTO skb_transfer " .
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) " .
            "VALUES ('$fsref', '$transfer_pickup1','$transfer_pickup_date1', '$transfer_time1', '$transfer_dropoff1', '$transfer1_transport', '$transfer_vehicle_no1', '$transfer_driver1', '$transfer_notes1')";
        $retval14 = mysql_query($sql_14, $conn);
    }
    $transfer2active = QuoteSmart($_POST['transfer2active']);
    if ($transfer2active == 1) {
        $sql_15 = "INSERT INTO skb_transfer " .
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) " .
            "VALUES ('$fsref', '$transfer_pickup2','$transfer_pickup_date2', '$transfer_time2', '$transfer_dropoff2', '$transfer2_transport', '$transfer_vehicle_no2', '$transfer_driver2', '$transfer_notes2')";
        $retval15 = mysql_query($sql_15, $conn);
    }
    $transfer3active = QuoteSmart($_POST['transfer3active']);
    if ($transfer3active == 1) {
        $sql_16 = "INSERT INTO skb_transfer " .
            "(ref_no_sys, pickup, pickup_date, pickup_time, dropoff, transport, vehicle, driver, transfer_notes) " .
            "VALUES ('$fsref', '$transfer_pickup3','$transfer_pickup_date3', '$transfer_time3', '$transfer_dropoff3', '$transfer3_transport', '$transfer_vehicle_no3', '$transfer_driver3', '$transfer_notes3')";
        $retval16 = mysql_query($sql_16, $conn);
    }
    //Post driver info to jobsheet
    if ($arr_driver > 0) {
        $res_type_arr = 1;
        $sql_17 = "INSERT INTO skb_resdrivers " .
            "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) " .
            "VALUES ('$arr_driver', '$arr_vehicle_no', '$fsref', '$adults', '$children', '$infants', '$tour_oper', '$arr_pickup', '$arr_time', '$arr_transport_notes', '$arr_time', '$arr_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$arr_date', '$res_type_arr')";
        $retval17 = mysql_query($sql_17, $conn);
    }
    if ($dpt_driver > 0) {
        $res_type_dpt = 2;
        $sql_18 = "INSERT INTO skb_resdrivers " .
            "(transport, vehicle, ref_no_sys, adult, child, infant, tour_operator, location, pickup_time,  comments, flight_time, flight_no, infant_seats, child_seats, booster_seats, title_name, first_name, last_name, transport_date, res_type) " .
            "VALUES ('$dpt_driver', '$dpt_vehicle_no', '$fsref', '$adults', '$children', '$infants', '$tour_oper', '$dpt_pickup', '$pickup_time', '$dpt_transport_notes', '$dpt_time', '$dpt_flight_no', '$infant_seats', '$child_seats', '$booster_seats', '$title_name', '$first_name', '$last_name', '$dpt_date', '$res_type_dpt')";
        $retval18 = mysql_query($sql_18, $conn);
    }
    //Put all this stuff into the database
    $sql = "INSERT INTO skb_reservations " .
        "(title_name, first_name, last_name, pnr, tour_operator, operator_code, tour_ref_no, adult, child, infant, tour_notes, fast_track, affiliates, arr_date, arr_time, arr_flight_no, flight_class, arr_transport, arr_driver, arr_vehicle, arr_pickup, arr_dropoff, room_type, rep_type, client_reqs, dpt_date, dpt_time, dpt_flight_no, dpt_transport, dpt_driver, dpt_vehicle, dpt_pickup, dpt_dropoff, dpt_pickup_time, dpt_notes, creation_date, created_by, ref_no_sys, arr_transport_notes, dpt_transport_notes, arr_hotel_notes, infant_seats, child_seats, booster_seats, vouchers, cold_towel, bottled_water, dpt_flight_class, rooms, room_no, total_guests, luggage_vehicle,fast_ref_no_sys,payment_type,payment_amount, sup_total_amount) " .
        "VALUES ('$title_name', '$first_name', '$last_name', '$pnr', '$tour_oper', '$oper_code', '$tour_ref_no', '$adults', '$children', '$infants', '$tour_notes', '$ftres', '$affiliates', '$arr_date', '$arr_time', '$arr_flight_no', '$flight_class', '$arr_transport', '$arr_driver', '$arr_vehicle_no', '$arr_pickup', '$arr_dropoff', '$room_type', '$rep_type', '$client_reqs', '$dpt_date', '$dpt_time', '$dpt_flight_no', '$dpt_transport', '$dpt_driver', '$dpt_vehicle_no', '$dpt_pickup', '$dpt_dropoff', '$pickup_time', '$dpt_notes', NOW(), '$loggedinas', '$fsref', '$arr_transport_notes', '$dpt_transport_notes', '$arr_hotel_notes', '$infant_seats', '$child_seats', '$booster_seats', '$vouchers', '$cold_towels', '$bottled_water', '$dpt_flight_class', '$rooms', '$room_no', '$total_guests','$luggageVehicle','$fastRef','$paymentType','$paymentAmount', '$total_amount')";
    $retval = mysql_query($sql, $conn);

    $insertId = mysql_query('SELECT LAST_INSERT_ID()');
        $insertId = mysql_fetch_array($insertId);
        $insertId = $insertId[0];
        if(isset($insertId) && !empty($insertId)){
            $sysRefNo = mysql_query("SELECT `ref_no_sys` FROM skb_reservations WHERE id = '$insertId'");
            $sysRefNo = mysql_fetch_array($sysRefNo);
            $sysRefNo = $sysRefNo[0];
        }

    //Log user action
    $sql_19 = "INSERT INTO skb_activity " .
        "(log_user, user_action, log_time) " .
        "VALUES ('$loggedinas', '$user_action', NOW())";
    $retval19 = mysql_query($sql_19, $conn);
    if (!$retval) {
        die('Could not enter data: ' . mysql_error());
    }
    mysql_close($conn);
    //Seems Successful, so redirect the user to next page.
    //echo "<script>window.location='add-fasttrack.php?ok=1'</script>";

    if(isset($sysRefNo) && !empty($sysRefNo))
        echo "<script>window.location='add-fasttrack.php?ok=1&sysRef=$sysRefNo'</script>";
    else
        echo "<script>window.location='add-fasttrack.php?ok=1'</script>";
   
}
?>

<style type="text/css">
    .reqs-box {
        display: none;
    }

    .numericCol {
        width: 100px !important;
    }
</style>
<!-- start additional requirements toggle -->
<script type="text/javascript">
    $(document).ready(function () {
        $('input[type="checkbox"]').click(function () {
            if ($(this).attr("value") == "clientreqs") {
                $(".clientreqs").toggle();
            }
        });

        $('input[type="checkbox"]').click(function () {
            if ($(this).attr("value") == "clientreqs1") {
                $(".clientreqs1").toggle();
            }
        });

        $('input[type="checkbox"]').click(function () {
            if ($(this).attr("value") == "clientreqs2") {
                $(".clientreqs2").toggle();
            }
        });

        $('input[type="checkbox"]').click(function () {
            if ($(this).attr("value") == "clientreqs3") {
                $(".clientreqs3").toggle();
            }
        });
    });
</script>
<script type="text/javascript">
    //<![CDATA[
    function disp_confirm() {
        var name = confirm("Pressing OK will Clear all data.")
        if (name == true) {
            return true;
        }
        else {
            return false;
        }
    }
    //]]>
</script>

<script type="text/javascript">
    //<![CDATA[
    function disp_confirm() {
        var name = confirm("Pressing OK will Clear all form data.")
        if (name == true) {
            return true;
        }
        else {
            return false;
        }
    }
    //]]>
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#arr-vehicle-no").attr("disabled", "disabled");
        $("#arr-vehicle-no1").attr("disabled", "disabled");
        $("#arr-vehicle-no2").attr("disabled", "disabled");
        $("#arr-vehicle-no3").attr("disabled", "disabled");

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
        /*                                        $('#guest1show').hide();
         $('#guest2show').hide();
         $('#guest3show').hide(); */

        $("#arr-driver").change(function () {
            $("#arr-vehicle-no").attr("disabled", "disabled");
            $("#arr-vehicle-no").html("<option>Loading vehicles ...</option>");

            var driverid = $("#arr-driver option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#arr-vehicle-no").removeAttr("disabled");
                $("#arr-vehicle-no").html(data);

            });
        });

        $("#dpt-vehicle-no").attr("disabled", "disabled");

        $("#dpt-driver").change(function () {
            $("#dpt-vehicle-no").attr("disabled", "disabled");
            $("#dpt-vehicle-no").html("<option>Loading vehicles ...</option>");

            var driverid = $("#dpt-driver option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#dpt-vehicle-no").removeAttr("disabled");
                $("#dpt-vehicle-no").html(data);

            });
        });

        $("#arr-time").attr("disabled", "disabled");

        $("#arr-flight-no").change(function () {
            $("#arr-time").attr("disabled", "disabled");
            $("#arr-time").html("<option>Loading flight times ...</option>");

            var flightid = $("#arr-flight-no option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#arr-time").removeAttr("disabled");
                $("#arr-time").html(data);

            });
        });

        $("#dpt-time").attr("disabled", "disabled");

        $("#dpt-flight-no").change(function () {
            $("#dpt-time").attr("disabled", "disabled");
            $("#dpt-time").html("<option>Loading flight times ...</option>");

            var flightid = $("#dpt-flight-no option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#dpt-time").removeAttr("disabled");
                $("#dpt-time").html(data);

            });
        });

        $(".arr0_room_type").attr("disabled", "disabled");

        $("#arr-dropoff").change(function () {
            $(".arr0_room_type").attr("disabled", "disabled");
            $(".arr0_room_type").html("<option>Loading rooms ...</option>");

            var locationid = $("#arr-dropoff option:selected").attr('value');

            $.post("select_roomtype.php", {locationid: locationid}, function (data) {
                $(".arr0_room_type").removeAttr("disabled");
                $(".arr0_room_type").html(data);

            });
        });

        /* arrival 1 */
        $("#arr-driver1").change(function () {
            $("#arr-vehicle-no1").attr("disabled", "disabled");
            $("#arr-vehicle-no1").html("<option>Loading vehicles ...</option>");

            var driverid = $("#arr-driver1 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#arr-vehicle-no1").removeAttr("disabled");
                $("#arr-vehicle-no1").html(data);
            });
        });

        $("#dpt-vehicle-no1").attr("disabled", "disabled");

        $("#dpt-driver1").change(function () {
            $("#dpt-vehicle-no1").attr("disabled", "disabled");
            $("#dpt-vehicle-no1").html("<option>Loading vehicles ...</option>");

            var driverid = $("#dpt-driver1 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#dpt-vehicle-no1").removeAttr("disabled");
                $("#dpt-vehicle-no1").html(data);

            });
        });

        $("#arr-time1").attr("disabled", "disabled");

        $("#arr-flight-no1").change(function () {
            $("#arr-time1").attr("disabled", "disabled");
            $("#arr-time1").html("<option>Loading flight times ...</option>");

            var flightid = $("#arr-flight-no1 option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#arr-time1").removeAttr("disabled");
                $("#arr-time1").html(data);

            });
        });

        $("#dpt-time1").attr("disabled", "disabled");

        $("#dpt-flight-no1").change(function () {
            $("#dpt-time1").attr("disabled", "disabled");
            $("#dpt-time1").html("<option>Loading flight times ...</option>");

            var flightid = $("#dpt-flight-no1 option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#dpt-time1").removeAttr("disabled");
                $("#dpt-time1").html(data);

            });
        });

        $("#room-type1").attr("disabled", "disabled");

        $("#arr-dropoff1").change(function () {
            var roomTypeSelector1 = $(".arr1_room_type");
            roomTypeSelector1.attr("disabled", "disabled");
            roomTypeSelector1.html("<option>Loading rooms ...</option>");

            var locationid = $("#arr-dropoff1 option:selected").attr('value');

            $.post("select_roomtype.php", {locationid: locationid}, function (data) {
                roomTypeSelector1.removeAttr("disabled");
                roomTypeSelector1.html(data);

            });
        });
        /* end arrival 1 */

        /* arrival 2 */
        $("#arr-driver2").change(function () {
            $("#arr-vehicle-no2").attr("disabled", "disabled");
            $("#arr-vehicle-no2").html("<option>Loading vehicles ...</option>");

            var driverid = $("#arr-driver2 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#arr-vehicle-no2").removeAttr("disabled");
                $("#arr-vehicle-no2").html(data);

            });
        });

        $("#dpt-vehicle-no2").attr("disabled", "disabled");

        $("#dpt-driver2").change(function () {
            $("#dpt-vehicle-no2").attr("disabled", "disabled");
            $("#dpt-vehicle-no2").html("<option>Loading vehicles ...</option>");

            var driverid = $("#dpt-driver2 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#dpt-vehicle-no2").removeAttr("disabled");
                $("#dpt-vehicle-no2").html(data);

            });
        });

        $("#arr-time2").attr("disabled", "disabled");

        $("#arr-flight-no2").change(function () {
            $("#arr-time2").attr("disabled", "disabled");
            $("#arr-time2").html("<option>Loading flight times ...</option>");

            var flightid = $("#arr-flight-no2 option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#arr-time2").removeAttr("disabled");
                $("#arr-time2").html(data);

            });
        });

        $("#dpt-time2").attr("disabled", "disabled");

        $("#dpt-flight-no2").change(function () {
            $("#dpt-time2").attr("disabled", "disabled");
            $("#dpt-time2").html("<option>Loading flight times ...</option>");

            var flightid = $("#dpt-flight-no2 option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#dpt-time2").removeAttr("disabled");
                $("#dpt-time2").html(data);

            });
        });

        $(".arr2_room_type").attr("disabled", "disabled");
        $("#arr-dropoff2").change(function () {
            var roomTypeSelector2 = $(".arr2_room_type");
            roomTypeSelector2.attr("disabled", "disabled");
            roomTypeSelector2.html("<option>Loading rooms ...</option>");

            var locationid = $("#arr-dropoff2 option:selected").attr('value');

            $.post("select_roomtype.php", {locationid: locationid}, function (data) {
                roomTypeSelector2.removeAttr("disabled");
                roomTypeSelector2.html(data);

            });
        });
        /* end arrival 2 */

        /* arrival 3 */
        $("#arr-driver3").change(function () {
            $("#arr-vehicle-no3").attr("disabled", "disabled");
            $("#arr-vehicle-no3").html("<option>Loading vehicles ...</option>");

            var driverid = $("#arr-driver3 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#arr-vehicle-no3").removeAttr("disabled");
                $("#arr-vehicle-no3").html(data);

            });
        });

        $("#dpt-vehicle-no3").attr("disabled", "disabled");

        $("#dpt-driver2").change(function () {
            $("#dpt-vehicle-no3").attr("disabled", "disabled");
            $("#dpt-vehicle-no3").html("<option>Loading vehicles ...</option>");

            var driverid = $("#dpt-driver3 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#dpt-vehicle-no3").removeAttr("disabled");
                $("#dpt-vehicle-no3").html(data);

            });
        });

        $("#arr-time3").attr("disabled", "disabled");

        $("#arr-flight-no3").change(function () {
            $("#arr-time3").attr("disabled", "disabled");
            $("#arr-time3").html("<option>Loading flight times ...</option>");

            var flightid = $("#arr-flight-no3 option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#arr-time3").removeAttr("disabled");
                $("#arr-time3").html(data);

            });
        });

        $("#dpt-time3").attr("disabled", "disabled");

        $("#dpt-flight-no3").change(function () {
            $("#dpt-time3").attr("disabled", "disabled");
            $("#dpt-time3").html("<option>Loading flight times ...</option>");

            var flightid = $("#dpt-flight-no3 option:selected").attr('value');

            $.post("select_flighttime.php", {flightid: flightid}, function (data) {
                $("#dpt-time3").removeAttr("disabled");
                $("#dpt-time3").html(data);

            });
        });

        $(".arr3_room_type").attr("disabled", "disabled");

        $("#arr-dropoff3").change(function () {
            var roomTypeSelector3 = $(".arr3_room_type");
            roomTypeSelector3.attr("disabled", "disabled");
            roomTypeSelector3.html("<option>Loading rooms ...</option>");

            var locationid = $("#arr-dropoff3 option:selected").attr('value');

            $.post("select_roomtype.php", {locationid: locationid}, function (data) {
                roomTypeSelector3.removeAttr("disabled");
                roomTypeSelector3.html(data);
            });
        });
        /* end arrival 3 */

        /* transfer */
        $("#transfer-vehicle-no").attr("disabled", "disabled");

        $("#transfer-driver").change(function () {
            $("#transfer-vehicle-no").attr("disabled", "disabled");
            $("#transfer-vehicle-no").html("<option>Loading vehicles ...</option>");

            var driverid = $("#transfer-driver option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#transfer-vehicle-no").removeAttr("disabled");
                $("#transfer-vehicle-no").html(data);

            });
        });
        /* end transfer */

        /* transfer 1 */
        $("#transfer-vehicle-no1").attr("disabled", "disabled");

        $("#transfer-driver1").change(function () {
            $("#transfer-vehicle-no1").attr("disabled", "disabled");
            $("#transfer-vehicle-no1").html("<option>Loading vehicles ...</option>");

            var driverid = $("#transfer-driver1 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#transfer-vehicle-no1").removeAttr("disabled");
                $("#transfer-vehicle-no1").html(data);

            });
        });
        /* end transfer 1 */

        /* transfer 2 */
        $("#transfer-vehicle-no1").attr("disabled", "disabled");

        $("#transfer-driver2").change(function () {
            $("#transfer-vehicle-no2").attr("disabled", "disabled");
            $("#transfer-vehicle-no2").html("<option>Loading vehicles ...</option>");

            var driverid = $("#transfer-driver2 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#transfer-vehicle-no2").removeAttr("disabled");
                $("#transfer-vehicle-no2").html(data);

            });
        });
        /* end transfer 2 */

        /* transfer 3 */
        $("#transfer-vehicle-no3").attr("disabled", "disabled");

        $("#transfer-driver3").change(function () {
            $("#transfer-vehicle-no3").attr("disabled", "disabled");
            $("#transfer-vehicle-no3").html("<option>Loading vehicles ...</option>");

            var driverid = $("#transfer-driver3 option:selected").attr('value');

            $.post("select_vehicle.php", {driverid: driverid}, function (data) {
                $("#transfer-vehicle-no3").removeAttr("disabled");
                $("#transfer-vehicle-no3").html(data);

            });
        });
        /* end transfer 3 */


        /* guest hide show */
        $('body').on('click', '#guest1,.addGuest', function (e) {
            e.preventDefault();
            var NumberOfGuests = $("#totalGuests");
            var totalGuests = NumberOfGuests.val();
            if (totalGuests) {
                //Lets Find Out How Many No of Guests have been Assigned so far.
                totalGuests = parseInt(totalGuests) - 1;
                var currentBtn = $(this);
                var guestsDiv = $("#guestPlaceHolder");
                var totalCurrentDivs = guestsDiv.find('div.guestShow').length;
                console.log(totalCurrentDivs);

                var applicableDivs = totalCurrentDivs + 1;
                if (totalGuests < (applicableDivs)) {
                    console.log('totalGuests:' + totalGuests);
                    console.log('applicableGuests:' + applicableDivs);
                    return false;
                }

                //New Way, Now More Guests Forms will be added through the jquery/ajax
                $.ajax({
                    url: "<?=$url?>/custom_updates/sub_guest_form.php",
                    type: "POST",
                    data: {req: "guestCount", dataID: totalCurrentDivs},
                    success: function (output) {
                        guestsDiv.append(output);
                        currentBtn.hide();
                    }
                });
            } else {
                return false;
            }
        });
        $('body').on("click", ".removeGuest", function (e) {
            e.preventDefault();
            if ($(this).parents('.guestShow').is(':last-child')) {
                $(this).parents('.guestShow').remove();

                //Now Show the button to the last div only if exist.
                var lastDivButton = $("#guestPlaceHolder").find(".guestShow:last-child").find('.addGuest');
                if (lastDivButton) {
                    lastDivButton.show();
                } else {
                    $('#guest1').show();
                }

                console.log($("#guestPlaceHolder").find(".guestShow:last-child"));
            } else {
                $(this).parents('.guestShow').remove();
            }

        });

        /* guest hide show */

        $('#remguest1').click(function (e) {
            e.preventDefault();
            $('#guest1show').hide().find('input:text').val('');
            $('#guest1').show();
            document.getElementById('guest1active').value = "0";
        });
        /* end guesthide show */

        /* arrival hide show */
        $('#arrival1').click(function (e) {
            e.preventDefault();
            $('#arrival1show').show();
            $('#arrival1').hide();
            document.getElementById('arrival1active').value = "1";
        });

        $('#remarrival1').click(function (e) {
            e.preventDefault();
            $('#arrival1show').hide().find('input:text').val('');
            $('#arrival1').show();
            document.getElementById('arrival1active').value = "0";
        });

        $('#arrival2').click(function (e) {
            e.preventDefault();
            $('#arrival2show').show();
            $('#arrival2').hide();
            $('#arrival3').show();
            document.getElementById('arrival2active').value = "1";
        });

        $('#remarrival2').click(function (e) {
            e.preventDefault();
            $('#arrival2show').hide().find('input:text').val('');
            $('#arrival2').show();
            document.getElementById('arrival2active').value = "0";
        });

        $('#arrival3').click(function (e) {
            e.preventDefault();
            $('#arrival3show').show();
            $('#arrival3').hide();
            document.getElementById('arrival3active').value = "1";
        });

        $('#remarrival3').click(function (e) {
            e.preventDefault();
            $('#arrival3show').hide().find('input:text').val('');
            $('#arrival3').show();
            document.getElementById('arrival3active').value = "0";
        });
        /* end arrival hide show */

        /* transfer hide show */
        $('#transfermain').click(function (e) {
            e.preventDefault();
            $('#transfermainshow').show();
            $('#transfermain').hide();
            document.getElementById('transfermainactive').value = "1";
        });

        $('#remtransfermain').click(function (e) {
            e.preventDefault();
            $('#transfermainshow').hide().find('input:text').val('');
            $('#transfermain').show();
            document.getElementById('transfermainactive').value = "0";
        });

        $('#transfer1').click(function (e) {
            e.preventDefault();
            $('#transfer1show').show();
            $('#transfer1').hide();
            document.getElementById('transfer1active').value = "1";
        });

        $('#remtransfer1').click(function (e) {
            e.preventDefault();
            $('#transfer1show').hide().find('input:text').val('');
            $('#transfer1').show();
            document.getElementById('transfer1active').value = "0";
        });

        $('#transfer2').click(function (e) {
            e.preventDefault();
            $('#transfer2show').show();
            $('#transfer2').hide();
            $('#transfer3').show();
            document.getElementById('transfer2active').value = "1";
        });

        $('#remtransfer2').click(function (e) {
            e.preventDefault();
            $('#transfer2show').hide().find('input:text').val('');
            $('#transfer2').show();
            document.getElementById('transfer2active').value = "0";
        });

        $('#transfer3').click(function (e) {
            e.preventDefault();
            $('#transfer3show').show();
            $('#transfer3').hide();
            document.getElementById('transfer3active').value = "1";
        });

        $('#remtransfer3').click(function (e) {
            e.preventDefault();
            $('#transfer3show').hide().find('input:text').val('');
            $('#transfer3').show();
            document.getElementById('transfer3active').value = "0";
        });
        /* end transferhide show */

        /* departure hide show */
        $('#departure1').click(function (e) {
            e.preventDefault();
            $('#departure1show').show();
            $('#departure1').hide();
            document.getElementById('departure1active').value = "1";
        });

        $('#remdeparture1').click(function (e) {
            e.preventDefault();
            $('#departure1show').hide().find('input:text').val('');
            $('#departure1').show();
            document.getElementById('departure1active').value = "0";
        });

        $('#departure2').click(function (e) {
            e.preventDefault();
            $('#departure2show').show();
            $('#departure2').hide();
            $('#departure3').show();
            document.getElementById('departure2active').value = "1";
        });

        $('#remdeparture2').click(function (e) {
            e.preventDefault();
            $('#departure2show').hide().find('input:text').val('');
            $('#departure2').show();
            document.getElementById('departure2active').value = "0";
        });

        $('#departure3').click(function (e) {
            e.preventDefault();
            $('#departure3show').show();
            $('#departure3').hide();
            document.getElementById('departure3active').value = "1";
        });

        $('#remdeparture3').click(function (e) {
            e.preventDefault();
            $('#departure3show').hide().find('input:text').val('');
            $('#departure3').show();
            document.getElementById('departure3active').value = "0";
        });
        /* end departure hide show */

    });
</script>
<?php include('profile.php'); ?>
<?php include('navigation.php'); ?>
<!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->

<!-- PAGE CONTENT -->
<div class="page-content">
    <?php include('vert-navigation.php'); ?>
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="dashboard.php">Home</a></li>
        <li>Fast Track</li>
        <li class="active">Add Fast Track Reservation</li>
    </ul>
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
                            <h3 class="panel-title"><strong>Add Fast track Reservation</strong></h3>
                        </div>
                        <div class="panel-body">
                            <h4>Tour Details</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="form-inline col-xs-8"><!-- first name / last name fields -->

                                    <label>First name</label> <input type="text" class="form-control text-capitalize"
                                                                     placeholder="First name" id="first-name"
                                                                     name="first_name" value="" required>
                                    <label class="left20">Last name</label> <input type="text"
                                                                                   class="form-control right20 text-capitalize"
                                                                                   placeholder="Last name"
                                                                                   id="last-name" name="last_name"
                                                                                   value="" required>
                                    <div class="form-group col-xs-3"><!-- title selection -->
                                        <select class="form-control select" id="title-name" name="title_name">
                                            <option>Select title</option>
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
                                    <label class="checkbox-inline label_checkboxitem">
                                        <input type="checkbox" id="arr_ServiceOnly" name="arr_ServiceOnly"> Arrival
                                        Service Only
                                    </label>
                                </div>
                            </div>
                            <div class="form-group col-xs-7"><!-- Passenger name record field -->
                                <label>Passenger name record (PNR)</label>
                                <input type="text" class="form-control" placeholder="Passenger name record (PNR)"
                                       id="pnr" name="pnr" value="">
                            </div>

                            <div class="form-group col-xs-7"><!-- tour operator selection -->
                                <label>Client</label>
                                <?php include('fsft_tour_oper_select.php'); ?>
                            </div>
                            <a data-id="supplier" data-toggle="modal" data-target="#add_mdl" class="btn btn-success" style="float:left;margin-top:20px;margin-left:3px;"><i class="fa fa-plus"></i></a>
                            
                            <div class="form-group col-xs-7"><!-- reference number field -->
                                <label>Reference number</label>
                                <input type="text" class="form-control" placeholder="reference number" id="tour-ref-no" name="tour_ref_no" value="">
                            </div>
                            <div class="form-group">
                                <div class="form-inline col-xs-9"><!-- number of persons traveling -->
                                    <input type="number" min=0 max=99 class="form-control" id="adults" name="adults"
                                           value="" placeholder="Select # of Adults"> Adult(s)
                                    <input type="number" min=0 max=99 class="left20 form-control" id="children"
                                           name="children" value="" placeholder="Select # of Children"> Children
                                    <input type="number" min=0 max=99 class="left20 form-control" id="infants"
                                           name="infants" value="" placeholder="Select # of Infants"> Infant(s)
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-7">
                                    <label>Rep Notes</label>
                                    <textarea class="form-control text-lowercase" rows="5" id="tour-notes"
                                              name="tour_notes"
                                              placeholder="Rep notes: additional rep comments and details here"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-7"><!-- tour operator selection -->
                                <label for="paymentType">Payment</label>
                                <?php 
                                $paymentTypes = mysql_query('SELECT * FROM skb_payment_type') or die();?>
                                <select class="form-control select" id="paymentType" name="paymentType">
                                    <option value="0">Select Payment Type</option>
                                    <?php 
                                        while($row = mysql_fetch_array($paymentTypes)){
                                            echo '<option value="'.$row['id'].'">'.$row['payment_type'].'</option>';
                                        }
                                    ?><!-- 
                                    <option value="1">Payment Received</option>
                                    <option value="2">Pay on Arrival</option> -->
                                </select>
                            </div>
                            <div class="form-group col-xs-7" id="paymentAmountDiv" style="display: none;"><!-- affiliates field -->
                                <label>Payment Amount</label>
                                <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control text-capitalize" placeholder="Payment Amount"
                                       id="paymentAmount" name="paymentAmount">
                                    </div>
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                            <!-- guests main-->
                            <div id="guestmain">
                                <h5>Guest Details</h5>
                                <div class="form-group">
                                    <div class="form-inline col-xs-12">
                                        <!-- guest first name / guest last name fields -->
                                        <label class="left20">First name</label> <input type="text"
                                                                                        class="form-control right20 text-capitalize"
                                                                                        placeholder="First name"
                                                                                        id="guest-first-name"
                                                                                        name="guest_first_name[]"
                                                                                        value="">
                                        <label>Last name</label> <input type="text"
                                                                        class="form-control right20 text-capitalize"
                                                                        placeholder="Last name" id="guest-last-name"
                                                                        name="guest_last_name[]" value="">
                                        <label>PNR</label> <input type="text" class="form-control"
                                                                  placeholder="Guest PNR" id="guest-pnr"
                                                                  name="guest_pnr[]" value="">
                                        <div class="form-group col-xs-2">
                                            <select class="form-control select" id="guest-title-name"
                                                    name="guest_title_name[]">
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
                                    <div class="form-inline col-xs-8"><!-- guest first name / guest last name fields -->
                                        <label class="checkbox-inline right20 label_checkboxitem">
                                            <input type="checkbox" id="guest-adult" name="guest_adult[]"> Adult
                                        </label>
                                        <input type="number" min=0 max=11 class="form-control" id="child_age"
                                               name="child_age[]" value="" placeholder="Child - 13 months - 11 yrs">
                                        Years
                                        <input type="number" min=0 max=23 class="left20 form-control" id="infant_age"
                                               name="infant_age[]" value="" placeholder="Infant - 12 months or less">
                                        Months
                                        <input type="number" min=0 max=23 class="left20 form-control" id="totalGuests"
                                               name="totalGuests" value="" placeholder="Guests Total No"> Guests


                                    <!-- changes -->
                                    <br><br>
                                         <span class="adult_count">0</span> Adults @ 
                                        <input type="number" min=0 class="left20 form-control" id="price"
                                               name="supplier_price" placeholder="Price">&nbsp;  &nbsp;
                                               =
                                        <input type="text" class="left20 form-control" id="total_amount"
                                               name="total_amount"  placeholder="Total Amount" readonly style="background-color:white;color: black;"> 
                                    </div>
                                </div>
                                <div>
                                    <button id="guest1" class="btn btn-warning">Add guest</button>
                                </div>
                                <div class="clearfix"></div>
                                <hr/>
                            </div>
                            <!-- end guest main -->

                            <div id="guestPlaceHolder">
                            </div>

                            <!-- arrival main -->

                            <h4>Arrival Details</h4>
                            <div class="arrivalsDiv" data-id="0">
                            <div class="form-group">
                                <div class="form-inline left20">
                                    <!-- arrival date -->
                                    <label class="right20">Arrival Date</label>
                                    <div class="input-group date col-xs-4 right20" data-date-format="mm-dd-yyyy">
                                        <input type="text" class="form-control datepicker" name="arr_date" id="arr-date"
                                               placeholder="Arrival date"/>
                                        <span class="input-group-addon add-on"><span
                                                class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                            <!-- initiate chained selection flight# -->
                            <div class="form-group col-xs-4"><!-- flight # selection -->
                                <label>Flight number</label>
                                <select class="form-control" id="arr-flight-no" name="arr_flight_no">
                                    <?php echo $opt->ShowFlight(); ?>
                                </select>
                            </div>

                            <div class="form-group col-xs-3"><!-- flight time selection -->
                                <label class="left20">Flight time</label>
                                <select class="form-control left20" id="arr-time" name="arr_time">
                                    <option value="0">Flight ETA [24 hour]</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-7">
                                <label>Flight class</label>
                                <?php include('flightclass_select.php'); ?>
                            </div>
                            <div class="form-group col-xs-7"> <!-- transport mode field -->
                                <label>Transport mode</label>
                                <?php include('transport_mode_arr.php'); ?>
                            </div>

                            <a data-id="transport_mode" data-toggle="modal" data-target="#add_mdl" class="btn btn-success" style="float:left;margin-top:20px;margin-left:3px;"><i class="fa fa-plus"></i></a>
                            <div class="clearfix"></div>
                            <!-- initiate chained selection drivers -->
                            <div class="form-group col-xs-4"><!-- available driver selection -->
                                <label for="arr-driver">Transport Supplier</label>
                                <select class="form-control" id="arr-driver" name="arr_driver">
                                    <?php echo $opt->ShowTransport(); ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                <label for="arr-vehicle-no" class="left20">Vehicle</label>
                                <select class="form-control left20" id="arr-vehicle-no" name="arr_vehicle_no">
                                    <option value="0">Select vehicle</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-xs-6"><!-- vehicle # selection -->
                                <label for="arr-luggage-vehicle-no">Luggage Vehicle</label>
                                <select class="form-control arr_luggage_vehicle" id="arr-luggage-vehicle-no" name="arr_luggage_vehicle_no[]">
                                    <option value="0">Select luggage vehicle</option>
                                    <?php include ('custom_updates/luggage_vehicle.php');?>
                                </select>
                            </div>
                            
                            <div class="clearfix"></div>
                            <div class="arrTransportsDiv">
                            </div>
                            <div class="form-group"><!-- hotel notes -->
                                <div class="col-xs-7">
                                    <label>Arrival &amp; Transport notes</label>
                                    <textarea class="form-control text-lowercase" rows="5" id="arr-transport-notes"
                                              name="arr_transport_notes"
                                              placeholder="Arrival &amp; Transportation notes: additional arrival &amp; transport comments and details here"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-xs-7"><!-- dropoff location selection -->
                                <label for="arr-dropoff">Dropoff Location</label>
                                <select class="form-control dropSelect" id="arr-dropoff" name="arr_dropoff">
                                    <?php echo $opt->ShowLocation(); ?>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <hr/>
                            <div class="form-group col-xs-7 checkbox"><!-- additional requirements show -->
                                <label>
                                    <input type="checkbox" value="clientreqs"> Add Requirements
                                </label> <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                                            title="Check this box to assign additional requirements and amount"></i>
                                <br/><br/>
                            </div>
                            <div class="clientreqs reqs-box">
                                <div class="form-group col-xs-7">
                                    <?php
                                    $section = 'fsft';
                                     include('clientreqs_select.php'); ?>
                                    <span
                                        class="help-block"> Select one (1) or multiple Airport/Hotel requirements</span>
                                </div>
                                <div class="form-group">
                                    <div class="form-inline col-xs-9">
                                        <label class="right20">Cold Towels</label><input type="number" min=0 max=99
                                                                                         class="right20 form-control numericCol"
                                                                                         id="cold-towels"
                                                                                         name="cold_towels" value=""
                                                                                         placeholder="Cold Towels">
                                        <label class="right20">Bottled Water</label><input type="number" min=0 max=99
                                                                                           class="right20 form-control numericCol"
                                                                                           id="bottled-water"
                                                                                           name="bottled_water" value=""
                                                                                           placeholder="Bottled Water">
                                        <label class="right20">Vouchers</label><input type="number" min=0 max=99
                                                                                      class="form-control numericCol"
                                                                                      id="vouchers" name="vouchers"
                                                                                      value="" placeholder="Vouchers">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-inline col-xs-9">
                                        <label class="right20">Infant Seats</label><input type="number" min=0 max=99
                                                                                          class="right20 form-control numericCol"
                                                                                          id="infant-seats"
                                                                                          name="infant_seats" value=""
                                                                                          placeholder="Infant Seats">
                                        <label class="right20">Child Seats</label><input type="number" min=0 max=99
                                                                                         class="right20 form-control numericCol"
                                                                                         id="child-seats"
                                                                                         name="child_seats" value=""
                                                                                         placeholder="Child Seats">
                                        <label class="right20">Booster Seats</label><input type="number" min=0 max=99
                                                                                           class="form-control numericCol"
                                                                                           id="booster-seats"
                                                                                           name="booster_seats" value=""
                                                                                           placeholder="Booster Seats">
                                    </div>
                                </div>
                            </div>
                            <br/>
                            </div>
                            <div class="clearfix"></div>
                            <!-- end arrival main -->


                            <div id="departureDetailsDiv">
                                <!-- departure main -->
                                <hr/>
                                <h4>Departure Details</h4>
                                <div class="form-group">
                                    <div class="form-inline left20">
                                        <!-- departure date -->
                                        <label>Departure Date</label>
                                        <div class="input-group date col-xs-3 right20 left20"
                                             data-date-format="mm-dd-yyyy">
                                            <input type="text" class="form-control datepicker" name="dpt_date"
                                                   id="dpt-date" placeholder="Departure date"/>
                                            <span class="input-group-addon add-on"><span
                                                    class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
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
                                    $sql = "SELECT * FROM skb_flightclass ORDER BY id ASC";
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
                                    <?php include('transport_mode_dpt.php'); ?>
                                </div>
                                
                                <a data-id="transport_mode" data-toggle="modal" data-target="#add_mdl" class="btn btn-success" style="float:left;margin-top:20px;margin-left:3px;"><i class="fa fa-plus"></i></a>
                                <div class="clearfix"></div>
                                <div class="form-group col-xs-4"><!-- available driver selection -->
                                    <label>Transport Supplier</label>
                                    <select class="form-control" id="dpt-driver" name="dpt_driver">
                                        <?php echo $opt->ShowTransport(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-xs-3"><!-- vehicle # selection -->
                                    <label class="left20">Vehicle</label>
                                    <select class="form-control left20" id="dpt-vehicle-no" name="dpt_vehicle_no">
                                        <option value="0">Vehicle #</option>
                                    </select>
                                </div>
                                <div class="form-group"><!-- hotel notes -->
                                    <div class="col-xs-7">
                                        <label>Departure &amp; Transport notes</label>
                                        <textarea class="form-control text-lowercase" rows="5" id="dpt-transport-notes"
                                                  name="dpt_transport_notes"
                                                  placeholder="Departure &amp; Transportation notes: additional departure &amp; transport comments and details here"></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-xs-4"><!-- pickup location selection -->
                                    <label>Pickup Location</label>
                                    <?php include('dpt_pickup_select.php'); ?>
                                </div>
                                <div class="form-group"><!-- pickup time -->
                                    <label>Pickup Time</label>
                                    <div class="input-group bootstrap-timepicker col-xs-3">
                                        <input type="text" class="form-control timepicker24" name="pickup_time"
                                               id="pickup-time" placeholder="Pickup time" value=""/>
                                        <span class="input-group-addon"><span
                                                class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                    <span class="help-block"> &nbsp;Select pickup time</span>
                                </div>
                                <div class="clearfix"></div>
                                <label>
                                    <input type="checkbox" name="jetCenter" value="jetCenter"> IAM Jet Center
                                </label>
                                <div class="clearfix"></div>
                                <br/>
                                <!-- end departure main -->

                            </div> <!--departures Main Div-->
                            <hr/>
                            <div class="form-group"><!-- accounting notes -->
                                <div class="col-xs-7">
                                    <label>Accounting notes</label>
                                    <textarea class="form-control text-lowercase" rows="5" id="dpt-notes"
                                              name="dpt_notes"
                                              placeholder="Accounting notes: additional accounting comments and details here"></textarea>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-default right20" type="reset" onclick="return disp_confirm()">
                                    Clear Form
                                </button>
                                <button name="addreservation" class="btn btn-primary" id="add" type="submit">Submit
                                </button>
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
<script type="text/javascript" src="js/clone-form-td.js"></script>
<!-- END PLUGINS -->

<!-- THIS PAGE PLUGINS -->
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>

<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<!-- END THIS PAGE PLUGINS -->

<!-- START TEMPLATE -->
<script type="text/javascript" src="js/relCopy.jquery.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/actions.js"></script>

<!--  Script for Inactivity-->
<script type="text/javascript" src="assets/store.js/store.min.js"></script>
<script type="text/javascript" src="assets/idleTimeout/jquery-idleTimeout.min.js"></script>
<script type="text/javascript" src="js/customScripting.js"></script>
<!--Select2-->
<script type="text/javascript" src="js/plugins/select2/dist/js/select2.full.min.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->
<script type="text/javascript">
    $('#tour-oper,.dropSelect, .pickSelect').select2({
        minimumInputLength: 3
    });
    $('.rep-type').select2();
    
$('.clientReqs').select2();
    body = $('body');
    $(function () {
        $('.numericCol').keypress(function (e) {
            var tval = $(this).val(),
                tlength = tval.length,
                set = 3,
                remain = parseInt(set - tlength);
            $('p').text(remain);
            if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
                $(this).val((tval).substring(0, tlength - 1))
            }
        });

        console.log($("#arr_ServiceOnly"));
        $("#arr_ServiceOnly").on('change', function () {
            if ($(this).is(':checked')) {
                $('#departureDetailsDiv').hide();
            } else {
                $('#departureDetailsDiv').show();
            }
        });

        $('#paymentType').on('change',function(){
            if($(this).val() == '2'){
                $('#paymentAmountDiv').show();
            }else{
                $('#paymentAmountDiv').hide();
            }
        });
    });


    //Need to code fro Arrival Transport
    //When Clicked on Add Transport
    body.on('click','.addArrTransportBtn',function(){
        var button = $(this);
        var arrivalDiv = button.parents('.arrivalsDiv');
        var mainTransportsDiv = arrivalDiv.find('.arrTransportsDiv');
        var totalTransportDivs = mainTransportsDiv.find('div.arr_transport_div').length + 1;
        var arrivalsID = arrivalDiv.attr('data-id');
        console.log(arrivalDiv);
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
    //Now need to work on transport mode
    body.on('change','.transport_mode',function(){
        var parentDiv = $(this).parents('.arr_transport_div');
        var changedValue = $(this).val();
        console.log(changedValue);
        if(changedValue && (changedValue !== 'Group Transfers')){
            parentDiv.find('.arr_driver').removeAttr('disabled');
        }else{
            parentDiv.find('.arr_driver').attr('disabled','disabled');
            parentDiv.find('.arr_driver').val('0');
            //IF THIS GOES TO DISABLE THEN THE OTHER THING SHOULD ALSO GO DISABLE.
            parentDiv.find('.arr_vehicle').attr('disabled','disabled');
            parentDiv.find('.arr_vehicle').val('0');
        }

    });
    body.on('change','.arr_driver',function(){
        var parentDiv = $(this).parents('.arr_transport_div');
        var changedValue = $(this).val();
        var arr_vehicle = parentDiv.find('.arr_vehicle');
        if(changedValue && parseInt(changedValue) > 0){
            parentDiv.find('.arr_vehicle').removeAttr('disabled');
            arr_vehicle.html("<option>Loading vehicles ...</option>");
            $.post("select_vehicle.php", {driverid:changedValue}, function(data){
                arr_vehicle.html(data);
            });
        }else{
            parentDiv.find('.arr_vehicle').attr('disabled','disabled');
            parentDiv.find('.arr_vehicle').val('0');
        }


    });

     // on adult number change event
     $("#adults").bind('keyup mouseup', function () {
        updateAdult(this);            
    });

     // update adult function
     function updateAdult(element){
        var adultCount = $(element).val();
        $('.adult_count').html(adultCount);
        var price = $('#price').val();
        if(price > 0){
            var total_amount = adultCount * price;
            $('#total_amount').val(total_amount);
        }
     }

     // on select supplier set price
     $('#tour-oper').on('select2:select',function(e){
        //console.log($(this).select2('data')); 
      // var price = $(this).select2('data')[0].element.attributes[0].nodeValue;
       var price = $('#tour-oper option:selected').attr('data-price');
       $('#price').val(price);
       // check adult count
       var adultCount = $("#adults").val();
       if(adultCount>=0){
            var total_amount = adultCount * price;
            $('#total_amount').val(total_amount);
       }
     })

     // on price change by user , calculate result again
     $('#price').on('change',function(e){
        var price = $(this).val();
        var adultCount =  $('.adult_count').html();
        if (price>=0 && adultCount>=0) {
            var total_amount = adultCount * price;
            $('#total_amount').val(total_amount);
        } // end of if
     })
</script>
        <?php // to add supplier 
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

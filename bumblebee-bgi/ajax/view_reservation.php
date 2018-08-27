
 <?php
  define("_VALID_PHP", true);
  require_once("../../admin-panel-bgi/init.php");
  
  if (!$user->levelCheck("2,9,1"))
      redirect_to("index.php");
      


//Grab all reservation info
$reservationQuery = "SELECT * FROM bgi_reservations WHERE ( fast_track = 0 OR ftnotify = 1) AND status != 2";
if(isset($_POST['name']) && !empty($_POST)){
    if(!empty($_POST['name']))
    	$reservationQuery .= " AND (first_name = '".$_POST['name']."' OR last_name = '".$_POST['name']."' OR tour_ref_no = '".$_POST['name']."' OR ref_no_sys = '".$_POST['name']."')";

    if(!empty($_POST['arrivalDate']))
    	$reservationQuery .= " AND arr_date = '".date('Y-m-d', strtotime($_POST['arrivalDate']))."'";

    if(!empty($_POST['depDate']))
    	$reservationQuery .= " AND dpt_date = '".date('Y-m-d', strtotime($_POST['depDate']))."'";

} else {
	$reservationQuery .= " LIMIT 10";
}

//echo  $reservationQuery;

include('../header.php');
$reservations = mysql_query($reservationQuery);



?>
                                    <table id="res-arrivals" class="table table-hover display">
                                        <?php if ($user->levelCheck("2,9")) : ?>
                                        <thead>
                                            <tr>
                                                <th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Confirmation Number</th>
                                                <th>T/O</th>
                                                <th>Operator Code</th>
                                                <th>Ref #</th>
                                                <th>Adult</th>
                                                <th>Child</th>
                                                <th>Infant</th>
                                                <th>Rep</th>
                                                <th>Rep Service</th>
                                                <th>Pickup Location</th>
                                                <th>Hotel</th>
                                                <th>Room Type</th>
                                                <th>Room No</th>
                                                <th>No of Rooms</th>
                                                <th>Hotel Notes</th>
                                                <th>Trans Type</th>
                                                <th>FSFT</th>
                                                <th>Inf Seat</th>
                                                <th>Car Seat</th>
                                                <th>Boost Seat</th>
                                                <th>Arr Reqs</th>
                                                <th>Vouchers</th>
                                                <th>Additional Reqs</th>
                                                <th>A</th>
                                                <th>C</th>
                                                <th>I</th>
                                                <th>Arr Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arr Time</th>
                                                <th>Luggage Vehicle</th>
                                                <th>Class</th>
                                                <th>Dpt Date</th>
                                                <th>Dpt Flight #</th>
                                                <th>Dpt Transport Mode</th>
                                                <th>Dpt Transport Supplier</th>
                                                <th>Dpt Vehicle</th>
                                                <th>Dpt Pickup Location</th>
                                                <th>Dpt Pickup Time</th>
                                                <th>Dpt Dropoff Location</th>
                                                <th>Arr &amp; Trans Notes</th>
                                                <th>Rep Notes</th>
                                                <th>Acct Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            while($row = mysql_fetch_array($reservations)) {
                                              
                                                 $data[] = $row;
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[28] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                $rep_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $row[24] . "'"));
                                                $flight_class = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[17] . "'"));
                                                $rep_name = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reps WHERE id_rep='" . $row[42] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[22] . "'"));
                                                $room_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_roomtypes WHERE id_room='" . $row[23] . "'"));
                                                $dpt_driver = mysql_fetch_row(mysql_query("SELECT * FROM bgi_transport WHERE id_transport='" . $row[30] . "'"));
                                                $dpt_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM skb_vehicles WHERE id_vehicle ='" . $row[31] . "'"));
                                                $dpt_pickup = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location ='" . $row[32] . "'"));

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $operator_code = $row[6];
                                                $ref_no = $row[7];
                                                $adult = $row[8];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $arr_date = $row[14];
                                                $transport_type = $row[18];
                                                $infant_seat = $row[48];
                                                $car_seat = $row[49];
                                                $booster_seat = $row[50];
                                                $cold_towel = $row[53];
                                                $bottled_water = $row[54];
                                                $client_reqs = $row[25];
                                                $adult = $row[8];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $dpt_date = $row[26];
                                                $arr_notes = $row[44];
                                                $rep_notes = $row[11];
                                                $acc_notes = $row[35];
													//  $roomType = $row[23];
                                                $room_no = $row[57];
                                                $rooms = $row[56];
                                                $arr_hotel_notes = $row[46];
                                                $dpt_transport = $row[29];
                                                $dpt_pickup_time = $row[34];
                                                $vouchers = $row[51];
                                                $conf_num = $row[40];
                                                
                                                if ($row[53]>0){
                                                        $ct= ''. $cold_towel . 'CT(s)';
                                                    } else {
                                                        $ct='No CT';
                                                    
                                                    }
                                                    
                                                if ($row[54]>0){
                                                        $bw= ''. $bottled_water . 'BW';
                                                    } else {
                                                        $bw='No BW';
                                                    
                                                    }
                                                
                                                if ($row[12]>0){
                                                        $fsft='Y';
                                                    } else {
                                                        $fsft='N';                                                    
                                                    }
                                                
                                                if ($group == 3){
                                                        $ftlink='ft';
                                                    } else {
                                                        $ftlink='';
                                                    
                                                    }
                                                
                                                if ($row[42]>0){
                                                        $rep = $rep_name[1];
                                                    } else {
                                                        $rep='Not Assigned';
                                                    
                                                    }


                                                if($row[21] === '56'){
                                                    $arr_pickup = 'Airport';
                                                }elseif($row[21] === '57'){
                                                    $arr_pickup = 'Seaport';
                                                }else{
                                                    $arr_pickup = '';
                                                }

                                                if($row[33] === '56'){
                                                    $dpt_drop_off = 'Airport';
                                                }elseif($row[33] === '57'){
                                                    $dpt_drop_off = 'Seaport';
                                                }else{
                                                    $dpt_drop_off = $row[33];
                                                }
                                                
                                                echo '<tr>
                                                        <td><a href="'. $ftlink .'reservation-details.php?id=' . $id . '&sect=gh"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="View / Edit reservation"></i></a></td>
                                                        <td>' . $title_name . '</td>
                                                        <td>' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $conf_num . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $operator_code . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $adult . '</td>
                                                        <td>' . $child . '</td>
                                                        <td>' . $infant . '</td>
                                                        <td>' . $rep . '</td>
                                                        <td>' . $rep_type[1] . '</td>
                                                        <td>' . $arr_pickup . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td>' . $room_type[2] . '</td>
                                                        <td>' . $room_no . '</td>
                                                        <td>' . $rooms . '</td>
                                                        <td class="hotelNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">'  . $arr_hotel_notes . '</td>
                                                        <td>' . $transport_type . '</td>
                                                        <td>' . $fsft . '</td>
                                                        <td>' . $infant_seat . '</td>
                                                        <td>' . $car_seat . '</td>
                                                        <td>' . $booster_seat . '</td>
                                                        <td>' . $bw . '/' . $ct . '</td>
                                                        <td>' . $vouchers . '</td>
                                                        <td>' . $client_reqs . '</td>
                                                        <td>' . $adult . '</td>
                                                        <td>' . $child . '</td>
                                                        <td>' . $infant . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $row['luggage_vehicle'] . '</td>                                                        
                                                        <td>' . $flight_class[1] . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $dpt_flight_no[1] . '</td>
                                                        <td>' . $dpt_transport . '</td>
                                                        <td>' . $dpt_driver[1] . '</td>
                                                        <td>' . $dpt_vehicle[2] . '</td>
                                                        <td>' . (!empty($dpt_pickup[1])?$dpt_pickup[1]:$row[32]) . '</td>
                                                        <td>' . $dpt_pickup_time . '</td>
                                                        <td>' . $dpt_drop_off . '</td>
                                                        <td class="arrNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">' . $arr_notes . '</td>
                                                        <td class="repNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">' . $rep_notes . '</td>
                                                        <td class="accNotes" data-placement="top" data-toggle="tooltip" data-original-title="Click to See All">' . $acc_notes . '</td>
                                                </tr>';
                                            }/*echo '<pre>';
                                            print_r($data); exit;*/
                                        ?>
                                        </tbody>
                                        <?php else: ?>
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>T/O</th>
                                                <th>Ref #</th>
                                                <th>Rep</th>
                                                <th>Rep Service</th>
                                                <th>Hotel</th>
                                                <th>Trans Type</th>
                                                <th>FSFT</th>
                                                <th>Inf Seat</th>
                                                <th>Car Seat</th>
                                                <th>Boost Seat</th>
                                                <th>Arr Reqs</th>
                                                <th>Additional Reqs</th>
                                                <th>A</th>
                                                <th>C</th>
                                                <th>I</th>
                                                <th>Arr Date</th>
                                                <th>Arr Flight#</th>
                                                <th>Arr Time</th>
                                                <th>Class</th>
                                                <th>Dpt Date</th>
                                                <th>Arr &amp; Trans Notes</th>
                                                <th>Rep Notes</th>
                                                <th>Acct Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            while($row = mysql_fetch_array($reservations)) {
                                                
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flighttime WHERE id_fltime='" . $row[15] . "'"));                                                   
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM bgi_touroperator WHERE id='" . $row[5] . "'"));
                                                $rep_type = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reptype WHERE id='" . $row[24] . "'"));
                                                $flight_class = mysql_fetch_row(mysql_query("SELECT * FROM bgi_flightclass WHERE id='" . $row[17] . "'"));
                                                $rep_name = mysql_fetch_row(mysql_query("SELECT * FROM bgi_reps WHERE id_rep='" . $row[42] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM bgi_location WHERE id_location='" . $row[22] . "'"));

                                                //assign names to results that are readable
                                                $id = $row[0];
                                                $title_name = $row[1];
                                                $first_name = $row[2];
                                                $last_name = $row[3];
                                                $ref_no = $row[7];
                                                $arr_date = $row[14];
                                                $transport_type = $row[18];
                                                $infant_seat = $row[48];
                                                $car_seat = $row[49];
                                                $booster_seat = $row[50];
                                                $cold_towel = $row[53];
                                                $bottled_water = $row[54];
                                                $client_reqs = $row[25];
                                                $adult = $row[8];
                                                $child = $row[9];
                                                $infant = $row[10];
                                                $dpt_date = $row[26];
                                                $arr_notes = $row[44];
                                                $rep_notes = $row[11];
                                                $acc_notes = $row[35];
                                                
                                                if ($row[53]>0){
                                                        $ct= ''. $cold_towel . 'CT(s)';
                                                    } else {
                                                        $ct='No CT';
                                                    
                                                    }
                                                    
                                                if ($row[54]>0){
                                                        $bw= ''. $bottled_water . 'BW';
                                                    } else {
                                                        $bw='No BW';
                                                    
                                                    }
                                                
                                                if ($row[12]>0){
                                                        $fsft='Y';
                                                    } else {
                                                        $fsft='N';
                                                    
                                                    }
                                                
                                                if ($row[42]>0){
                                                        $rep = $rep_name[1];
                                                    } else {
                                                        $rep='Not Assigned';
                                                    
                                                    }
                                                
                                                echo '<tr>
                                                        <td>' . $title_name . '</td>
                                                        <td>' . $first_name . '</td>
                                                        <td>' . $last_name . '</td>
                                                        <td>' . $tour_oper[1] . '</td>
                                                        <td>' . $ref_no . '</td>
                                                        <td>' . $rep . '</td>
                                                        <td>' . $rep_type[1] . '</td>
                                                        <td>' . $hotel[1] . '</td>
                                                        <td>' . $transport_type . '</td>
                                                        <td>' . $fsft . '</td>
                                                        <td>' . $infant_seat . '</td>
                                                        <td>' . $car_seat . '</td>
                                                        <td>' . $booster_seat . '</td>
                                                        <td>' . $bw . '/' . $ct . '</td>
                                                        <td>' . $client_reqs . '</td>
                                                        <td>' . $adult . '</td>
                                                        <td>' . $child . '</td>
                                                        <td>' . $infant . '</td>
                                                        <td>' . $arr_date . '</td>
                                                        <td>' . $arr_flight_no[1] . '</td>
                                                        <td>' . $arr_time[2] . '</td>
                                                        <td>' . $flight_class[1] . '</td>
                                                        <td>' . $dpt_date . '</td>
                                                        <td>' . $arr_notes . '</td>
                                                        <td>' . $rep_notes . '</td>
                                                        <td>' . $acc_notes . '</td>
                                                </tr>';
                                            }
                                        ?>
                                        </tbody>
                                        <?php endif; ?>
                                    </table>                                    
                                    
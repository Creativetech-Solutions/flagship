<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
error_reporting(E_ALL ^ E_DEPRECATED);
class SelectList
{
    protected $connd;
 
        public function __construct()
        {
            $this->DbConnect();
        }
 
        protected function DbConnect()
        {
            include "selectdb_config.php";
            $this->connd = mysql_connect($host,$user,$password) OR die("Unable to connect to the database");
            mysql_select_db($db,$this->connd) OR die("can not select the database $db");
            return TRUE;
        }
 
        public function ShowTransport()
        {
            $sql = "SELECT * FROM bgi_transport ORDER BY name ASC";
            $resd= mysql_query($sql,$this->connd);
            $driver = '<option value="0">Select Transport Supplier</option>';
            while($row = mysql_fetch_array($resd))
            {
                $driver .= '<option value="' . $row['id_transport'] . '">' . $row['name'] . '</option>';
            }
            return $driver;
        }
 
        public function ShowVehicle()
        {
            $sql = "SELECT * FROM bgi_vehicles WHERE id_transport=$_POST[driverid] ORDER BY name ASC";
            $resd= mysql_query($sql,$this->connd);

            $vehiclesArray = array();
            //Making a MultiDimentional Array.
            while($row=mysql_fetch_array($resd)){
                $arrayToPush = array(
                    'id_vehicle' => $row['id_vehicle'],
                    'id_transport' => $row['id_transport'],
                    'name' => $row['name']
                );
                array_push($vehiclesArray,$arrayToPush);
            }

            $totalVehicles = count($vehiclesArray);
            if($totalVehicles===1){
                $vehicle = '<option value="' . $vehiclesArray[0]['id_vehicle'] . '" selected="selected">' . $vehiclesArray[0]['name'] . '</option>';
            }else if($totalVehicles>1){
                $vehicle = '<option value="0">Select vehicle</option>';
                foreach($vehiclesArray as $v){
                    $vehicle .= '<option value="' . $v['id_vehicle'] . '">' . $v['name'] . '</option>';
                }
            }else{
                $vehicle = '<option value="0">Select vehicle</option>';
            }
            return $vehicle;
        }
        
        public function ShowFlight()
        {
            $sql = "SELECT * FROM bgi_flights ORDER BY flight_number ASC";
            $flightd= mysql_query($sql,$this->connd);
            $flight = '<option value="0">Select Flight #</option>';
            while($row = mysql_fetch_array($flightd))
            {
                $flight .= '<option value="' . $row['id_flight'] . '">' . $row['flight_number'] . '</option>';
            }
            return $flight;
        }
 
        public function ShowFlightTime()
        {
            $sql = "SELECT * FROM bgi_flighttime WHERE id_flight=$_POST[flightid] ORDER BY flight_time ASC";
            $fltimed= mysql_query($sql,$this->connd);
            $flight_time = '<option value="0">Select Flight Time</option>';
            while($row = mysql_fetch_array($fltimed))
            {
                $flight_time .= '<option value="' . $row['id_fltime'] . '">' . $row['flight_time'] . '</option>';
            }
            return $flight_time;
        }
        
        public function ShowLocation()
        {
            $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
            $flightd= mysql_query($sql,$this->connd);
            $flight = '<option value="0">Dropoff Location</option>';
            while($row = mysql_fetch_array($flightd))
            {
                $flight .= '<option value="' . $row['id_location'] . '">' . $row['name'] . '</option>';
            }
            return $flight;
        }
 
        public function ShowRoomType()
        {
            //$sql = "SELECT * FROM bgi_roomtypes WHERE id_location=$_POST[locationid] ORDER BY room_type ASC";
            $sql = "SELECT * FROM bgi_room_loc INNER JOIN bgi_roomtypes WHERE bgi_room_loc.id_location=$_POST[locationid] and
                 bgi_room_loc.id_roomtype=bgi_roomtypes.id_room ORDER BY bgi_roomtypes.room_type ASC";
            $roomd= mysql_query($sql,$this->connd);
            $room_type = '<option value="0">Room Type</option>';
            while($row = mysql_fetch_array($roomd))
            {
                $room_type .= '<option value="' . $row['id_room'] . '">' . $row['room_type'] . '</option>';
            }

            return $room_type;
        }

        public function ShowHotelLocations($id = 0)
        {
            $sql = "SELECT * FROM bgi_location ORDER BY name ASC";
            $flightd= mysql_query($sql,$this->connd);
            $flight = '<option value="0">Hotel</option>';
            while($row = mysql_fetch_array($flightd))
            {   
                if($id == $row['id_location'])
                    $selected = 'selected';
                else $selected = '';

                $flight .= '<option '.$selected.' value="' . $row['id_location'] . '">' . $row['name'] . '</option>';
            }
            return $flight;
        }
}
 
$opt = new SelectList();

?>
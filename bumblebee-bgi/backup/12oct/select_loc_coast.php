<?php
/**
 * Created by PhpStorm.
 * User: Syed Haider Hassan
 * Date: 12/21/2016
 * Time: 1:11 PM
 */

mysql_connect('localhost', 'root', 'chocolate');
mysql_select_db ("cocoa_bgi");

$sql = "SELECT H.`id_location` AS HotelID, H.`name` AS HotelName, C.`coast` AS Coast FROM `bgi_location` H
LEFT JOIN `bgi_loc_coast` C ON C.`id` = H.`zone` ";
$resourceHotels = mysql_query($sql);

$zoneHotelsArray = array();

while ($locRow = mysql_fetch_array($resourceHotels)) {
   $subArray = array(
        'ID' => $locRow['HotelID'],
        'Name' => $locRow['HotelName']
   );

    //Need to check if Coast Do Exist with the Records..If Not then put those records in undefined Category
    if(!empty($locRow['Coast'])){
        $coast = $locRow['Coast'];
    }else{
        $coast = 'Undefined Coast';
    }

    //If Coast is set, then check if key with this coast name already exists?
    if(!array_key_exists($coast,$zoneHotelsArray)){
        $zoneHotelsArray[$coast] = array();
    }

    array_push($zoneHotelsArray[$coast],$subArray);
}

//Funciton to Rearrange the Hotels in Alphabetical Order.
function sortFunction( $a, $b ) {
    return strcmp($a["Name"], $b["Name"]);
}

if(!empty($zoneHotelsArray) and is_array($zoneHotelsArray)){
    foreach ($zoneHotelsArray as $zKey => $zone){
        usort($zone, "sortFunction");
        echo '<optgroup data-label="'.$zKey.'" label="'.$zKey.'">';
            foreach($zone as $lKey=>$location){
                echo "<option value='" . $location['ID'] . "' ".((isset($selectedHotel) and !empty($selectedHotel) and $selectedHotel==$location['ID'])?'selected="selected"':'').">" . $location['Name']." ( $zKey )" . "</option>";
            }
        echo '</optgroup>';
    }
}

?>
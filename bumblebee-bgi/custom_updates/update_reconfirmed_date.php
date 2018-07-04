<?php
error_reporting(E_ALL &~ E_DEPRECATED);
define("_VALID_PHP", true);

include('../config.php');


//update reservation reconfWith
if($_POST){
    $id = $_POST['id'];
    $reconfirmedDate = $_POST['date'];

    if(empty($id)){
        echo "FAIL::ID is not Posting";
    }

    if(empty($reconfirmedDate)){
        echo "FAIL::Please Select the Date";
    }

    $updateQuery = "UPDATE bgi_reservations
SET date_reconfirmed='".date("Y-m-d",strtotime($reconfirmedDate))."'
WHERE id=".$id.";";

    mysql_query($updateQuery);

    if(mysql_error()){
        echo "FAIL::".mysql_error();
        echo "<br>".$updateQuery;
    }else{
        echo "OK::Record Successfully Updated::".date('F d, Y', strtotime($reconfirmedDate));
    }

}

?>
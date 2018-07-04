<?php
error_reporting(E_ALL &~ E_DEPRECATED);
define("_VALID_PHP", true);

include('../config.php');


//update reservation reconfWith
if($_POST){
    $id = $_POST['id'];
    $reconfWith = mysql_real_escape_string($_POST['reconfWith']);

    if(empty($id)){
        echo "FAIL::ID is not Posting";
    }

    if(empty($reconfWith)){
        echo "FAIL::Please Fill the Input Box";
    }

    $updateQuery = "UPDATE bgi_reservations
SET reconf_with='".$reconfWith."'
WHERE id=".$id.";";

    mysql_query($updateQuery);

    if(mysql_error()){
        echo "FAIL::".mysql_error();
    }else{
        echo "OK::Record Successfully Updated";
    }

}

?>
<?php
error_reporting(E_ALL &~ E_DEPRECATED);
define("_VALID_PHP", true);

include('../config.php');


// save transport mode
if(isset($_POST['transport_mode'])){
    $transport_mode = $_POST['transport_mode'];

    $transport_mode=mysql_real_escape_string($transport_mode);
    if(!empty($transport_mode)){
        // check if exist alread
        $selectQuery= "SELECT * FROM bgi_transporttype WHERE `transport_type` = '".$transport_mode."'";
        $result = mysql_query($selectQuery);
        if(mysql_num_rows($result)>0){
                echo 'FAIL::This transport mode is already exists';
            } //end of else if
        else {
                $insertQuery = "INSERT INTO bgi_transporttype ( transport_type ) VALUES ( '".$transport_mode."' )";

                $result = mysql_query($insertQuery);

                if(mysql_error()){
                    echo "FAIL::".mysql_error();
                }else{
                     $selectQuery= "SELECT * FROM bgi_transporttype ORDER BY id ASC";
                     $result = mysql_query($selectQuery);
                     $data=array();
                     while ($row = mysql_fetch_array($result)) {
                       array_push($data, $row);
                    }
                     echo "OK::Record Successfully Inserted::".json_encode($data);

                }
            } //end of if
        }
    } // end of outer if


// save transport mode
if(isset($_POST['supplier'])){
    $supplier = $_POST['supplier'];

    $supplier=mysql_real_escape_string($supplier);
    if(!empty($supplier)){
        // check if exist alread
        $selectQuery= "SELECT tour_operator FROM bgi_fsft_touroperator WHERE tour_operator = '".$supplier."'";
        $result = mysql_query($selectQuery);

        if(mysql_num_rows($result)>0){
            echo 'FAIL::Supplier already exists';
        } else {

            $insertQuery = "INSERT INTO bgi_fsft_touroperator ( tour_operator ) VALUES ( '".$supplier."' )";

            $result = mysql_query($insertQuery);

            if(mysql_error()){
                echo "FAIL::".mysql_error();
            }else{
                 $selectQuery= "SELECT * FROM bgi_fsft_touroperator ORDER BY id ASC";
                 $result = mysql_query($selectQuery);
                 $data=array();
                 while ($row = mysql_fetch_array($result)) {
                   array_push($data, $row);
                }
                 echo "OK::Record Successfully Inserted::".json_encode($data);

            }
        } //end of else
    } // end of outer if
} // end of outer most if

?>
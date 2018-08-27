<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
include('config.php');

//Check for valid user and store information of login
if (!isset($_SESSION)) session_start(); 
// check user level, if it's super admin, then set session to show admin link 

error_reporting(0);
ini_set("display_errors", "off");
function site_header($title) {
	global $application, $site_title_deliminator, $tab;
	
	echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Flagship' . $site_title_deliminator . $title . '</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=1190, initial-scale=1" />
        <meta name="author" content="Alvin Herbert" />
        <meta http-equiv="pragma" content="no-cache" />
        
        <!--<link rel="icon" href="favicon.ico" type="image/x-icon" />-->
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
        <!-- END META SECTION -->
       
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-dark.css"/>
        <link rel="stylesheet" type="text/css" href="css/flag-icon.css"/>
        <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css">
        <!-- EOF CSS INCLUDE -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script> 
		<script type="text/javascript" src="console_chat/js/scripts.js"></script> 
        <link href="js/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <link href="js/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
        <link href="css/bootstrap-editable.css" rel="stylesheet">
        <link href="console_chat/css/styles.css" rel="stylesheet">
        <style type="text/css">
        input{
        text-transform: capitalize; 
        }
        .dataTables_length{z-index:1;position:relative;}
        input[type="number"]{ height:37px; margin:5px 0; }
        </style>            
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="dashboard.php">Flagship</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>';
}

function fetch($query) {
	$result = mysql_fetch_row(mysql_query($query));
	echo mysql_error();
	return $result[0];
}

function QuoteSmart($value) {
	// Safe entry of any text into a mysql query. Usage: $name=quote_smart($_POST['name']);

	// Stripslashes
	if (get_magic_quotes_gpc()) $value = stripslashes($value);
	$value = mysql_real_escape_string($value);
	return $value;
}

function validateDate($date)
{
	$d = DateTime::createFromFormat('Y-m-d', $date);
	return $d && $d->format('Y-m-d') === $date;
}



//general queries functions
function build_sql_insert($table, $data) {
	$key = array_keys($data);
	$val = array_values($data);
	$sql = "INSERT INTO $table (" . implode(', ', $key) . ") "
		. "VALUES ('" . implode("', '", $val) . "')";

	return($sql);
}

?>
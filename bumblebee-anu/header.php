<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
include('config.php');

//Check for valid user and store information of login
if (!isset($_SESSION)) session_start();

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
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Alvin Herbert" />
        
        <!--<link rel="icon" href="favicon.ico" type="image/x-icon" />-->
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-dark.css"/>
        <link rel="stylesheet" type="text/css" href="css/flag-icon.css"/>
        <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
        <!-- EOF CSS INCLUDE -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script> 
        <script type="text/javascript" src="console_chat/js/scripts.js"></script>
        <link href="console_chat/css/styles.css" rel="stylesheet">            
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

?>
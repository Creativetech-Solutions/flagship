<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */

//Flagship Config File

/********************************************************************/
// DATABASE CONFIGURATION //

$db = array(
	'host'     => 'localhost',	// Name of server you are on (e.g. localhost)
	'user'     => 'root',						// Your Server Username	
	'pass'     => 'chocolate',						// Your Server Password
	'database' => 'cocoa_anu',						// Database Name where the user details are
);

/********************************************************************/
// SITE DETAILS CONFIGURATION //

$company                = 'Sunlinc'; // write your company name
$application            = 'Flagship'; // Application Name
$admin_email            = 'nicole.moody@sunlinc.net'; // Email of Administrator
$site_title_deliminator = ' - '; // Deliminator that appears in between the site title and the page title (ex. sunlinc.net - Contact Us)
$language               = 'english'; // Default language of your website
$prefix                 = 'fs_'; // Prefix of database tables. e.g. websitesbb_
$user_log_limit         = 30;
$uri                    = 'http://25.88.101.58/'; // URL of your website. e.g. http://sunlinc.net/

/********************************************************************/
// ALLOWED IMAGE TYPES (use MIME value) //

$allowed_types = array('image/jpeg', 'image/pjpeg', 'image/png', 'image/gif');

/********************************************************************/


//////////////////////////////////
//                              //
// Do not edit below this line. //
//                              //
//////////////////////////////////

/********************************************************************/
// TABLE CONFIGURATION //

$tab = array(
	'anu_users'        => $prefix . 'users',
	'anu_guest'        => $prefix . 'guest',
	'anu_admins_logs'  => $prefix . 'admins_logs',
	'anu_levels'       => $prefix . 'levels',
	'anu_reservations' => $prefix . 'reservations',
    'anu_arrivals'     => $prefix . 'arrivals',
    'anu_departures'   => $prefix . 'departures',
);

/********************************************************************/
// DB CONNECTION //

$conn = mysql_connect($db['host'], $db['user'], $db['pass']) or die(mysql_error()); 
mysql_select_db($db['database']) or die(mysql_error());

/********************************************************************/
// SESSION START //

if(session_id() == ""){
  session_start();
}

?>
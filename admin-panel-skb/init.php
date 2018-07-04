<?php
  /**
   * Init
   *
   * @package Admin Panel System
   * @author Alvin Herbert
   * @copyright 2015
   * @version $Id: init.php, v2.00 2011-07-10 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');

/*$inactive = 1800;
ini_set('session.gc_maxlifetime', $inactive); // set the session max lifetime to 30 minutes

session_start();
if(!isset($_SESSION['testing'])){
  $_SESSION['testing'] = time(); // Update session
}else if (isset($_SESSION['testing']) && (time() - $_SESSION['testing'] > $inactive)) {
  // last request was more than 2 hours ago
  session_unset();     // unset $_SESSION variable for this page
  session_destroy();   // destroy session data
}*/

?>
<?php //error_reporting(E_ALL);
  
  $BASEPATH = str_replace("init.php", "", realpath(__FILE__));
  
  define("BASEPATH", $BASEPATH);
  
  $configFile = BASEPATH . "lib/config.ini.php";
  if (file_exists($configFile)) {
      require_once($configFile);
  } else {
      header("Location: setup/");
  }
  
  require_once(BASEPATH . "lib/class_db.php");
  
  require_once(BASEPATH . "lib/class_registry.php");
  Registry::set('Database',new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE));
  $db = Registry::get("Database");
  $db->connect();
  
  //Include Functions
  require_once(BASEPATH . "lib/functions.php");
  
  require_once(BASEPATH . "lib/class_filter.php");
  $request = new Filter();
	
  //Start Core Class 
  require_once(BASEPATH . "lib/class_core.php");
  Registry::set('Core',new Core());
  $core = Registry::get("Core");

  //Start Paginator Class 
  require_once(BASEPATH . "lib/class_paginate.php");
  $pager = Paginator::instance();
  
  //StartUser Class 
  require_once(BASEPATH . "lib/class_user.php");
  Registry::set('Users',new Users());
  $user = Registry::get("Users");
   
  define("SITEURL", $core->site_url);
  define("ADMINURL", $core->site_url."/admin");
  define("UPLOADS", BASEPATH."uploads/");
  define("UPLOADURL", SITEURL."/uploads/");
?>
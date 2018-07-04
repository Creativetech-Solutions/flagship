<?php
  /**
   * Logout
   *
   * @package CMS Pro
   * @author Alvin Herbert
   * @copyright 2015
   * @version $Id: logout.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
  define("_VALID_PHP", true);
  
  require_once("../init.php");
?>
<?php
  if ($user->logged_in)
      $user->logout();
	  
  redirect_to("login.php");
?>
<?php

/**
 * Log the user out and optionally redirect to a page afterwards.
 *
 *
 * @author       Alvin Herbert <alvin.herbert@sunlinc.net>
 * @copyright    Copyright © 2015 Sunlinc.
 */

  define("_VALID_PHP", true);
  
  require_once("../admin-panel-bgi/init.php");
?>
<?php
  if ($user->logged_in){
      $user->logout();
      }
	  
  redirect_to("index.php");
?>
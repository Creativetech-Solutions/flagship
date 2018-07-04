<?php
  /**
   * Install
   *
   * @package Admin Panel System
   * @author Alvin Herbert
   * @copyright 2015
   * @version $Id: install.php, v2.00 2011-04-20 10:12:05 gewa Exp $
   */
?>
<?php
  define("_VALID_PHP", true);
  require_once("functions.php");
  
  session_start();
  
  $msg = '';
  
  error_reporting(E_ALL);
  define("CMS_DS", DIRECTORY_SEPARATOR);
  define("BASE", dirname(__FILE__));
  define("DDPBASE", str_replace('setup', '', BASE));
  
  $script_path = str_replace('/setup', '', dirname($_SERVER['SCRIPT_NAME']));
  
  $_SERVER['REQUEST_TIME'] = time();
  
  $step = !isset($_GET['step']) ? 0 : (int)$_GET['step'];
  
  if (isset($_POST['db_action'])) {
      $err = false;
      
      if (!$_POST['dbhost'])
          $err[] = 1;
      
      if (!$_POST['dbuser'])
          $err[] = 2;
      
      if (!$_POST['dbname'])
          $err[] = 3;
      
      if (!$_POST['admin_username'])
          $err[] = 4;
      
      if (!$_POST['admin_password'])
          $err[] = 5;
      
      if ($_POST['admin_password'] != $_POST['admin_password2'])
          $err[] = 6;
      
      if (!$_POST['site_email'])
          $err[] = 7;
      
      if (!$err) {
          $link = mysqli_connect($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd']);
          
          $error = false;
          
          if (!$link) {
              $error = true;
              $msg = 'Could not connect to MySQL server: ' . mysqli_error($link) . '<br />';
          }
          
          if (!mysqli_select_db($link, $_POST['dbname'])) {
              $error = true;
              $msg .= 'Could not select database ' . sanitize($_POST['dbname']) . ': ' . mysqli_error($link);
          }

          /** Writing to database **/
          if (!$error) {
              mysqli_query($link, "CREATE DATABASE `" . $_POST['dbname'] . "`;");
              mysqli_select_db($link, $_POST['dbname']);
              
              $success = true;
              parse_mysql_dump("sql/structure.sql", $link);
              
              if ($success)
                  writeConfigFile($_POST['dbhost'], $_POST['dbuser'], $_POST['dbpwd'], $_POST['dbname']);
              
              if ($script_path == "/")
                  $script_path = "";
          }
          
          if (!$error && isset($_POST['install_data'])) {
              $success = true;
              parse_mysql_dump("sql/sampledata.sql", $link);
              if (!$success) {
                  $msg = "Error in adding the sample data<br />
        <em>The installation can continue, but the site will be empty, without any simple information, categories or items.</em>";
              }
          }
          
          $user = (isset($_POST['admin_username'])) ? $_POST['admin_username'] : "";
          $pass = (isset($_POST['admin_password'])) ? sanitize($_POST['admin_password']) : "";
          $url = (isset($_POST['site_url'])) ? $_POST['site_url'] : "";
          $sitename = (isset($_POST['site_name'])) ? $_POST['site_name'] : "";
          $site_email = (isset($_POST['site_email'])) ? $_POST['site_email'] : "";
          
          mysqli_query($link, "INSERT INTO `users` (id,username,password,email,fname, lname, created,userlevel,active)
        VALUES ('1','" . sanitize($user) . "','" . md5($pass) . "','" . sanitize($site_email) . "','Web', 'Master',NOW(),'9','y')");
          
          mysqli_query($link, "UPDATE `settings` SET 
		  site_name = '" . sanitize($sitename) . "', 
		  site_url = '" . sanitize($url) . "', 
		  site_email = '" . sanitize($site_email) . "'");
          
          mysqli_close($link);
          
          if (!$error) {
              if (!file_exists("../lib/config.inc.php")) {
                  cmsHeader();
				  include("templates/finish.tpl.php");
                  cmsFooter();
                  exit;
              }
          }
      }
  }
?>
<?php cmsHeader(); ?>
<?php
  if (!$step)
      : clearstatcache();
  
  include("templates/pre_install.tpl.php");
  elseif ($step == 1)
      : 
	  include("templates/license.tpl.php");
  elseif ($step == '2')
      : 
  include("templates/configuration.tpl.php");
  
  else
      : echo 'Incorrect step. Please follow installation instructions.';
  endif;
?>
<?php cmsFooter(); ?>
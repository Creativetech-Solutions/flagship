<?php
  /**
   * Functions
   *
   * @package Admin Panel System
   * @author Alvin Herbert
   * @copyright 2015
   * @version $Id: functions.php, v2.00 2011-07-10 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php
  function getIniSettings($aSetting)
  {
	  $out = (ini_get($aSetting) == '1' ? 'ON' : 'OFF');
	  return $out;
  }

  function getWritableCell($aDir)
  {
	  echo '<tr>';
	  echo '<td class="elem">'.$aDir .CMS_DS.'</td>';
	  echo '<td align="left">';
	  echo is_writable(DDPBASE.$aDir) ? '<span class="yes">Writeable</span>' : '<span class="no">Unwriteable</span>';
	  echo '</td>';
	  echo '</tr>';
  }

  function sanitize($string, $trim = false)
  {
	$string = filter_var($string, FILTER_SANITIZE_STRING); 
	$string = trim($string);
	$string = stripslashes($string);
	$string = strip_tags($string);
	$string = str_replace(array('‘','’','“','”'), array("'","'",'"','"'), $string);
	if($trim)
	$string = substr($string, 0, $trim);
	
	return $string;
  }

  function parse_mysql_dump($filename, $dblink)
  {

      $templine = '';
      $lines = file($filename);
      foreach ($lines as $line_num => $line) {
          if (substr($line, 0, 2) != '--' && $line != '') {
              $templine .= $line;
              if (substr(trim($line), -1, 1) == ';') {
                  if (!mysqli_query($dblink, $templine)) {
                      $success = false;
                      $msg = "<div class=\"qerror\">'" . mysqli_errno($dblink) . " " . mysqli_errno($dblink) . "' during the following query:</div> 
					  <div class=\"query\">{$templine} </div>";
                  }
                  $templine = '';
              }

          }
      }
  }
  
  function writeConfigFile($host, $username, $password, $name)
  {
      
          $content = "<?php \n" 
		  . "\t/** \n" 
		  . "\t* Configuration\n"
		  . "\n"
		  . "\t* @package Admin Panel System\n"
		  . "\t* @author wojocms.com\n"
		  . "\t* @copyright 2011\n"
		  . "\t* @version Id: config.ini.php, v2.00 2011-04-20 10:12:05 gewa Exp $\n"
		  . "\t*/\n"

		  . " \n" 
		  . "\t if (!defined(\"_VALID_PHP\")) \n"
		  . "     die('Direct access to this location is not allowed.');\n"
		  
		  . " \n" 
		  . "\t/** \n" 
		  . "\t* Database Constants - these constants refer to \n"
		  . "\t* the database configuration settings. \n"
		  . "\t*/\n"
		  . "\t define('DB_SERVER', '".$host."'); \n" 
		  . "\t define('DB_USER', '".$username."'); \n"  
		  . "\t define('DB_PASS', '".$password."'); \n"  
		  . "\t define('DB_DATABASE', '" . $name . "');\n" 

		  . " \n" 
		  . "\t/** \n" 
		  . "\t* Show MySql Errors. \n"
		  . "\t* Not recomended for live site. true/false \n"
		  . "\t*/\n"
		  . "\t define('DEBUG', false);\n"
		  . "?>";
      
      $confile = '../lib/config.ini.php';
      if (is_writable('../lib/')) {
          $handle = fopen($confile, 'w');
          fwrite($handle, $content);
          fclose($handle);
          $success = true;
      } else {
          $success = false;
      }
  }

  function safeConfig($host, $username, $password, $name)
  {
          $content = "<?php \n" 
		  . "\t/** \n" 
		  . "\t* Configuration\n"
		  . "\n"
		  . "\t* @package Admin Panel System\n"
		  . "\t* @author wojocms.com\n"
		  . "\t* @copyright 2011\n"
		  . "\t* @version Id: config.ini.php, v2.00 2011-04-20 10:12:05 gewa Exp $\n"
		  . "\t*/\n"

		  . " \n" 
		  . "\t if (!defined(\"_VALID_PHP\")) \n"
		  . "     die('Direct access to this location is not allowed.');\n"
		  
		  . " \n" 
		  . "\t/** \n" 
		  . "\t* Database Constants - these constants refer to \n"
		  . "\t* the database configuration settings. \n"
		  . "\t*/\n"
		  . "\t define('DB_SERVER', '".$host."'); \n" 
		  . "\t define('DB_USER', '".$username."'); \n"  
		  . "\t define('DB_PASS', '".$password."'); \n"  
		  . "\t define('DB_DATABASE', '" . $name . "');\n" 

		  . " \n" 
		  . "\t/** \n" 
		  . "\t* Show MySql Errors. \n"
		  . "\t* Not recomended for live site. true/false \n"
		  . "\t*/\n"
		  . "\t define('DEBUG', false);\n"
		  . "?>";
		  
		  return $content;
  }
  
  function cmsHeader()
  {
      echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
      echo '<html xmlns="http://www.w3.org/1999/xhtml">';
      echo '<head>';
      echo '<title>Advanced Login System - Web Installer</title>';
      echo '<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />';
      echo '<link rel="stylesheet" type="text/css" href="style.css" />';
      echo '</head>';
      echo '<body>';
      echo '<div id="installation"><div class="logo"></div>';
  }

  function cmsFooter()
  {
      global $err;
      
      echo '</div>';
      echo '<div id="copyright">Advanced Login System<br />';
      echo 'Copyright &copy; ' . date("Y") . ' wojoscripts.com';
      echo '</div>';
      echo '<script type="text/javascript">';
      
      if ($err) {
          $j = 0;
          foreach ($err as $key => $i) {
              if ($i > 0) {
                  $first = ($j > 0) ? $i : '';
                  echo "document.getElementById('err{$i}').style.display = 'block';\n";
                  echo "document.getElementById('t{$i}').style.background = '#FFD5D5';\n";
                  $j++;
              }
          }
          echo "document.getElementById('t{$err[0]}').focus();\n";
      }
      
      echo '</script>';
      echo '</body>';
      echo '</html>';
  }
?>
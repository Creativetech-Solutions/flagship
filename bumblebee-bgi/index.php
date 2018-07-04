<?php

/**
 * @author Alvin Herbert
 * @copyright 2015
 */
define("_VALID_PHP", true);
  require_once("../admin-panel-bgi/init.php");
 // echo '<pre>'; print_r($user); exit;
  if ($user->logged_in)
      redirect_to("dashboard.php");
	  
	  
  if (isset($_POST['doLogin']))
      : $result = $user->login($_POST['username'], $_POST['password']);
  
  /* Login Successful */
  if ($result)
      : redirect_to("dashboard.php");
  endif;
  endif;
//error_reporting(0);
error_reporting(E_ALL &~ E_DEPRECATED);
?>
<?php include_once('header.php'); ?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Flagship - Login</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="author" content="Alvin Herbert" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-dark.css"/>
        <link rel="stylesheet" type="text/css" href="css/flag-icon.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Welcome</strong>, Please login <span class="flag-icon flag-icon-us"></div>
                    <form action="<?php $_PHP_SELF ?>" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Username" name="username" autofocus="true"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" class="form-control" placeholder="Password" name="password"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block" name="login" id="dosubmit" type="submit">Log In</button>
                        </div>
                    </div>
                    <input name="doLogin" type="hidden" value="1" />
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        Copyright &copy; 2015 Sunlinc
                    </div>
                </div>
            </div>
            
        </div>
        
    </body>
</html>
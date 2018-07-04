<?php ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Flagship Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  
  <?php if(strtolower($this->router->fetch_class())!='home') { ?>

   <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/datatables/dataTables.bootstrap.css">
   <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">

  <?php } ?>
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/skins/_all-skins.min.css">
  <?php if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='home/index') {?>
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/datepicker/datepicker3.css">

  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <?php } if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='user/edituser') {?>
<link rel="stylesheet" href="<?=base_url('assets')?>/plugins/daterangepicker/daterangepicker.css">
<?php } 
    if(strtolower($this->router->fetch_class().'/'.$this->router->fetch_method())=='flight/index' ) {?>
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/timepicker/bootstrap-timepicker.min.css">
  <?php }
  ?>
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/select2/select2.min.css"> 
  <link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url('home')?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>F</b>LL</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><!-- <b>Admin</b>LTE -->
        <img src="<?=$this->frontEndPath?>bumblebee-bgi/img/logo.png" class="img-circle" alt="User Image">
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <?php // Db will be select on this dropdown option value ?>
          <form class="select-config" action="<?=base_url('home/configure')?>" method="post">
          <?php $db=$this->session->userdata('db_name');?>
            <select id="config_select" name="destination" class="form-control">
                <option <?=$db == 'cocoa_bgi' ? 'selected' : ''?> value="B">BGI - Barbados</option>
                <option <?=$db == 'cocoa_fll' ? 'selected' : ''?> value="F" >FLL - Florida</option>
                <option <?=$db == 'cocoa_anu' ? 'selected' : ''?> value="A">ANU - Antigua</option>
                <option <?=$db == 'cocoa_gnd' ? 'selected' : ''?> value="G">GND - Grenada</option>
                <option <?=$db == 'cocoa_skb' ? 'selected' : ''?> value="S">SKB - St.Kitts &amp; Nevis</option>
            </select>
            <input type="hidden" name="path" value="<?=base_url(uri_string()) ?>">
           
        </form>


      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=$this->session->userdata('useravatar') ? $this->frontEndPath.'/admin-panel-fll/uploads/'.$this->session->userdata('useravatar'):''?>" class="user-image" alt="User Image">
              <span class="hidden-xs">
                <?php
                    if($this->session->userdata('name')){ echo $this->session->userdata('name'); }
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=$this->session->userdata('useravatar') ? $this->frontEndPath.'/admin-panel-fll/uploads/'.$this->session->userdata('useravatar'):''?>" class="img-circle" alt="User Image">

                <p>
                  <?php
                    if($this->session->userdata('name')){ echo $this->session->userdata('name'); }
                ?>
                  <small>Member since Nov. 2017</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url('user/editUser').'/'.$this->session->userdata('userid')?>" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=base_url('account/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>

  <?php
    $this->load->view('components/side_bar');
   ?>

   <div id="confirm_modal" class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12 text-center" style="border-radius: 10px;">
      <div class="modal-body col-md-12" style="padding:24px">
          <div class="col-md-12" style="color: #dd4b39;font-size: 40px;">
              <i class="fa fa-question-circle" aria-hidden="true"></i> 
          </div>
          <input type="hidden" class="id_one">
          <input type="hidden" class="id_two">
          <input type="hidden" class="action_val">
          <div class="col-md-12 font22">
                   <strong>Are you sure to delete this record?</strong>
                   <br>
                   
                This record will not be recovered! 
          </div>
          <div class="col-md-12"><br>
                <a class="btn btn-default del" data-dismiss="modal">Cancel</a>
                <a class="btn btn-danger conf_del">Yes, Delete it!</a>
          </div>
      </div>
    </div>
  </div>
</div>
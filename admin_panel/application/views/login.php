<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Flagship Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/bootstrap/css/bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url('assets')?>/plugins/iCheck/square/blue.css">

</head>
<body class="hold-transition login-page" style="float: left;width: 100%;background-color: #073b3d;">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=$this->frontEndPath?>"><img src="<?=$this->frontEndPath?>bumblebee-fll/img/logo.png" class="img-circle" alt="User Image"></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form class="login-form" action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control username" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url('assets')?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url('assets')?>/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url('assets')?>/plugins/iCheck/icheck.min.js"></script>
<script src="<?=base_url('assets')?>/js/custom.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/vendors/noty-2.3.8/js/noty/packaged/jquery.noty.packaged.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  // on login 
  $(document).on('submit','.login-form', function(e){
    e.preventDefault();
    var username=$('.username').val();
    var password=$('.password').val();
    if(username==''){
      notify('Pleas Enter Username','error');
    }
    else if(password==''){
      notify('Please Enter Password','error');
    }
    else {
      $.ajax({
        url:"<?=base_url('account/login')?>",
        type:'POST',
        data:{username:username, password:password},
        beforeSend:function(){},
        success:function(data){
          var data=data.split('::');
          notify(data[1], data[2]);
          if(data[2]=='success'){
            location.reload();
          }
        },
        error:function(){},
      })
    }
  })
</script>
</body>
</html>

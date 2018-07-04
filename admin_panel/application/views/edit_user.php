
<?php 
//     // check profile image path
// echo '<pre>'; print_r($user);
// echo $this->frontEndPath.'admin-panel-fll/uploads/'.$user->avatar;
/*  if(file_exists($this->frontEndPath.'admin-panel-fll/uploads/'.$user->avatar)){
    exit;
  }$user->avatar=$this->frontEndPath.'admin-panel-fll/uploads/'.$user->avatar;*/

  $imgPath=$this->frontEndPath.'admin-panel-fll/uploads/'.$user->avatar;

  if(is_url_exist($imgPath) && !empty($user->avatar)){ 
    $userImg=$this->frontEndPath.'admin-panel-fll/uploads/'.$user->avatar;
  } else {
      $userImg=$this->frontEndPath.'admin-panel-fll/uploads/'.$this->defaultImg;
  }
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit User Record
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('/')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?=base_url('/user')?>">Users</a></li>
        <li class="active">Edit User</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?=$user->fname.' '.$user->lname?></h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
           <div class="col-md-12 errors">

                <button type="button" class="close close-error" style="margin-top: 12px;margin-right:12px;color:white;opacity:1;">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
        </div>
        <div class="box-body">
            <div class="row col-md-12">
          <div class="box box-danger">
            <div class="box-header">
            </div>
            <div class="box-body">
             <form action="<?=base_url('user/saveData')?>" method="post" enctype="multipart/form-data" class="user-edit-form">

              <div class="col-md-3 col-sm-3 col-xs-12 col-md-push-9 col-sm-push-9">
                  <div class="col-md-12 text-center">
                      <img style="width:150px;max-height:150px" class="responsive prof_img" src="<?=$userImg?>" />
                      <hr>
                      <input type="file" name="avatar" class="avatar hidden" accept="image/*" />
                      <a class="btn btn-primary choose-avatar">Choose Avatar</a>
                  </div>
              </div>
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-pull-3 col-sm-pull-3">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="userid" value="<?=$user->id?>">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>First Name:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                              </div>
                              <input type="text" name="fname" class="form-control" required value="<?=$user->fname?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Last Name:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                              </div>
                              <input type="text" name="lname" class="form-control" required value="<?=$user->lname?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Username:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                              </div>
                              <input type="text" name="username" class="form-control" required value="<?=$user->username?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Password:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-key" aria-hidden="true"></i>
                              </div>
                              <input type="text" name="password" class="form-control" value="">
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Email:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                              </div>
                              <input type="text" name="email" class="form-control" required value="<?=$user->email?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Country:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-flag" aria-hidden="true"></i>
                              </div>
                              <input type="text" name="country" class="form-control" value="<?=$user->country?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>User Level:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                              </div>
                              <select name="level" class="form-control select2" required style="width: 100%;">
                                <?php 
                                    if(isset($roles) and is_array($roles) and !empty($roles)){ 
                                      foreach($roles as $role){?>
                                        <option <?=$role->level_id==$user->userlevel?'selected':''?> value="<?=$role->level_id?>"><?=$role->role_name?></option>
                                     <?php }
                                    }
                                ?>
                              </select>
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Registration:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-registered" aria-hidden="true"></i>
                              </div>
                              <?php 
                                $createdDate=date('m/d/Y h:m:s',strtotime($user->created));
                              ?>
                              <input name="register_time" type="text" required class="form-control date-time" value="<?=$createdDate?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Last Login:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                              </div>
                               <?php 
                                $lastlogin=date('m/d/Y h:m:s',strtotime($user->lastlogin));
                              ?>
                              <input name="last_log" type="text" class="form-control date-time" value="<?=$lastlogin?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>Last Ip:</label>

                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-server" aria-hidden="true"></i>
                              </div>
                              <input name="last_ip" type="text" class="form-control" value="<?=$user->lastip?>">
                            </div>
                            <!-- /.input group -->
                          </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                          <label>User Status:</label>&nbsp;&nbsp;&nbsp;&nbsp; <br>
                          <label><input type="radio" name="status" value="y" required <?=$user->active=='y'?'checked':'' ?> > Active</label>&nbsp;&nbsp;
                          <label><input type="radio" name="status" value="n" required <?=$user->active=='n'?'checked':'' ?> > Inactive</label>&nbsp;&nbsp;
                          <label><input type="radio" name="status" value="b" required <?=$user->active=='b'?'checked':'' ?> > Banned</label>&nbsp;&nbsp;
                          <label><input type="radio" name="status" value="t" required <?=$user->active=='t'?'checked':'' ?> > Pending</label>
                          <!-- /.input group -->
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- Date dd/mm/yyyy -->
                        <div class="form-group">
                          <label>Newsletter Subscribe:</label>&nbsp;&nbsp;&nbsp;&nbsp;<br>
                          <label><input type="radio" name="newsletter" required value="1" <?=$user->newsletter==1?'checked':'' ?> > Yes</label>&nbsp;&nbsp;
                          <label><input type="radio" name="newsletter" required value="0" <?=$user->newsletter==0?'checked':'' ?> > No</label>
                          <!-- /.input group -->
                        </div>
                    </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-9 col-xs-12">
                   <textarea name="notes" class="form-control" rows="4" placeholder="User Notes"><?=$user->notes?></textarea>
                <hr>
                </div>
                <div class="col-md-3 col-xs-12" style="position: absolute;bottom: 0;right: 0;">
                   <input type="submit" class="btn btn-success pull-right" value="Save Changes
                ">
                </div>
              </div>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

      </div>
      <!-- /.row -->
        </div>
        
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

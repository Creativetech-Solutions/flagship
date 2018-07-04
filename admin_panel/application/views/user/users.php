 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
      </ol>
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Filter By</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" id="search_by_name" class="form-control " placeholder="Search By Name">
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" id="search_by_username" class="form-control " placeholder="Search By Username">
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                        <div class="form-group">
                            <label>Status:</label>
                            <!-- <input type="text" id="search_by_status" class="form-control " placeholder="Search By Status"> -->
                            <select data-id="status" class="form-control select2 userstatus" >
                              <?php 
                                  foreach($this->userStatus as $key=>$status){
                                    echo '<option value="'.$key.'">'.$status.'</option>';
                                  }
                              ?>
                            </select>
                        </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Level:</label>
                                <select data-id="level" class="form-control select2 userlevel" >
                                  <?php 
                                    if(is_array($userlevels) and !empty($userlevels)) {
                                      foreach($userlevels as $key=>$level){
                                        echo '<option value="'.$level->level_id.'">'.$level->role_name.'</option>';
                                      }
                                    }
                                  ?>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                    </div>
             </div>
          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success add" href="<?=base_url('user/addUser')?>">Add New Users</a>
              <h3 class="box-title pull-right">Total Users: <span class="tour-count"><?=count($users)?></span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body user-list">
             <?php 
                $data['users']=$users;
                $this->load->view('user/user_list', $data); 
                ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


  <!-- Left side column. contains the logo and sidebar -->

<?php
  
 ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('/')?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$this->counter['users']? $this->counter['users']:0?></h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$this->counter['activeUsers']? $this->counter['activeUsers']:0?><sup style="font-size: 20px"></sup></h3>

              <p>Active Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?=base_url('/user')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$this->counter['vehicles']? $this->counter['vehicles']:0?></h3>

              <p>Vehicles</p>
            </div>
            <div class="icon">
              <i class="fa fa-car"></i>
            </div>
            <a href="<?=base_url('/vehicle')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$this->counter['flights']? $this->counter['flights']:0?></h3>

              <p>Flights</p>
            </div>
            <div class="icon">
              <i class="fa fa-fighter-jet"></i>
            </div>
            <a href="<?=base_url('/flight')?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-7 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs"><!-- 
              <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li> -->
              <li><a href="#sales-chart" data-toggle="tab">Flagship Statistic</a></li>
<!--               <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
 -->            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <!-- <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div> -->
              <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 373px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 connectedSortable">

        

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Others</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <!-- <div class="chart" id="line-chart" style="height: 250px;"></div> -->
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="<?=$this->counter['transport']? $this->counter['transport']:0?>" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Transport Supplier</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="<?=$this->counter['users']? $this->counter['users']:0?>" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Users</div>
                </div>
                <!-- ./col -->
                <div class="col-xs-4 text-center">
                  <input type="text" class="knob" data-readonly="true" value="<?=$this->counter['flights']? $this->counter['flights']:0?>" data-width="60" data-height="60" data-fgColor="#39CCCC">

                  <div class="knob-label">Flights</div>
                </div>
                <!-- ./col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

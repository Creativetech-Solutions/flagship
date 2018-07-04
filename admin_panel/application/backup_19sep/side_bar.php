  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=$this->session->userdata('useravatar') ? $this->frontEndPath.'/admin-panel-bgi/uploads/'.$this->session->userdata('useravatar'):''?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> <?php
                    if($this->session->userdata('name')){ echo $this->session->userdata('name'); }
                ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
    
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?=base_url('home')?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <!-- <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> -->
          </a><!-- 
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul> -->
        </li>
        <li>
          <a href="<?=base_url('user')?>">
            <i class="fa fa-users" aria-hidden="true"></i> <span>Users</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-aqua"><?=$this->counter['users']? $this->counter['users']:0?></small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i> <span>Operators/Supplier</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?=base_url('touroperator')?>"><i class="fa fa-circle-o"></i> <span>Tour Operators</span> 
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?=$this->counter['operators']? $this->counter['operators']:0?></small>
            </span> </a></li>
            <li><a href="<?=base_url('fasttrack/tourop')?>"><i class="fa fa-circle-o"></i><span> Fast Track Suppliers </span> 
            <span class="pull-right-container">
              <small class="label pull-right bg-red"><?=$this->counter['suppliers']? $this->counter['suppliers']:0?></small>
            </span></a></li>
          </ul>
        </li>
        <li>
          <a href="<?=base_url('driver')?>">
            <i class="fa fa-hdd-o" aria-hidden="true"></i> <span>Transport Supplier</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-purple"><?=$this->counter['transport']? $this->counter['transport']:0?></small>
            </span>
          </a>
        </li>
        <li>
          <a href="<?=base_url('vehicle')?>">
            <i class="fa fa-th"></i> <span>Vehicles</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow"><?=$this->counter['vehicles']? $this->counter['vehicles']:0?></small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-plane"></i> <span>Flights</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?=base_url('flight')?>"><i class="fa fa-circle-o"></i><span> Flight # &amp; Timing </span>
            <span class="pull-right-container">
              <small class="label pull-right bg-purple"><?=$this->counter['flights']? $this->counter['flights']:0?></small>
            </span></a></li>
            <li><a href="<?=base_url('flight/classesList')?>"><i class="fa fa-circle-o"></i><span> Flight Classes</span> 
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?=$this->counter['fl_class']? $this->counter['fl_class']:0?></small>
            </span></a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-location-arrow" aria-hidden="true"></i><span>Locations <small>(Pickup/Dropoff)</small></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?=base_url('location')?>"><i class="fa fa-circle-o"></i><span> Locations </span>
            <span class="pull-right-container">
              <small class="label pull-right bg-purple"><?=$this->counter['locations']? $this->counter['locations']:0?></small>
            </span></a></li>
            <li><a href="<?=base_url('roomtype')?>"><i class="fa fa-circle-o"></i><span> Room Types</span> 
            <span class="pull-right-container">
              <small class="label pull-right bg-green"><?=$this->counter['roomtypes']? $this->counter['roomtypes']:0?></small>
            </span></a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
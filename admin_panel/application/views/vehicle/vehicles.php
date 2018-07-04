 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vehicles List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Vehicles</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box  box-primary">
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
                            <label>Vehicle Number</label>
                            <!-- <select class="form-control select2 vehicle-list" style="width: 100%;">
                            </select> -->
                            <input type="text" id="search_by_vehicle" class="form-control " placeholder="Search By Vehicle Number">
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Transport Supplier</label>
                            <!-- <select class="form-control drivers-list select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                            </select> -->
                            <input type="text" id="search_by_driver" class="form-control " placeholder="Search By Transport Supplier">
                        </div><!-- /.form-group -->
                    </div><!-- /.col -->
                </div>
            </div>
        </div>
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success add" data-toggle="modal" data-target="#edit-vehicle">Add New Vehicle</a>
              <h3 class="box-title pull-right">Total Vehicles: <span class="vehicle-count"><?=count($vehicles)?></span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <?php if(is_array($vehicles) and !empty($vehicles)) { ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th></th>
                  <th>Vehicle</th>
                  <th>Transport Supplier</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                </tr>
                </thead>
                <tbody class="vehicles-list">
             <?php 
                $data['vehicles']=$vehicles;
                $this->load->view('vehicle/vehicle_list', $data); 
                ?>

                  </tbody>

              </table>
              <?php } else {
                  echo 'No Vehicle Found.';

                }?>
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


<!-- Vehicle Modal -->
<div class="modal fade" id="edit-vehicle" role="dialog" aria-labelledby="tour_op_lbl">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header col-md-12">
        <h5 class="modal-title font22 bold fl" id="tour_op_lbl">Add New Vehicle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
          <div class="col-md-12">
            <label>Vehicle Number:</label>
            <input type="text" class="form-control vehicle_name" value="" />
            <label>Select Transport Supplier:</label>
            <select class="form-control select2 transporter" style="width: 100%;">
                <?php 
                  foreach($transporters as $transporter) {
                    echo '<option value="'.$transporter->id_transport.'">'.$transporter->name.'</option>';
                  }
                ?>
            </select>
            <input type="hidden" value="" class="vehicle_id">
          </div>
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-primary save-vehicle">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
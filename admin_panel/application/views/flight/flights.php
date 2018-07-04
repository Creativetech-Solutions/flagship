<style>
  .disable{border: none;background-color: transparent!important;}
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Flights List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Flights</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->
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
                                <label>Flight Number:</label>
                               <input type="text" id="search_by_fl_num" class="form-control " placeholder="Search By Flight Number">
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Flight Time:</label>
                                <select type="text" id="Search_by_time" class="form-control select2 time-search" placeholder="Search By Flight Time">
                                  <option></option>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-4">
                            <div class="col-md-6">
                            <div class="col-md-12 pad0"><label>Time From:</label></div>
                              <div class="input-group bootstrap-timepicker timepicker">
                                  <input type="text" id="time_range_search" class="form-control timepicker from" placeholder="Search By Time" />
                              </div><!-- /.form-group -->
                            </div>
                            <div class="col-md-6">
                            <div class="col-md-12 pad0"><label>Time To:</label></div>
                              <div class="input-group bootstrap-timepicker timepicker">
                                  <input type="text" id="time_range_search" class="form-control timepicker to" placeholder="Search By Time" />
                              </div><!-- /.form-group -->
                            </div>
                        </div><!-- /.col -->
                    </div>
            </div>
        </div>

          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success add" data-toggle="modal" data-target="#edit-flight">Add New Flight</a>
              <h3 class="box-title pull-right">Total Flights: <span class="flight-count"><?=count($flights)?></span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body flights-list">
             <?php 
                $data['flights']=$flights;
                $this->load->view('flight/flight_list', $data); 
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


<!-- Vehicle Modal -->
<div class="modal" id="edit-flight" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header col-md-12">
        <h5 class="modal-title font22 bold fl" id="tour_op_lbl">Add New Flight</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
          <div class="col-md-12">
            <label>Flight Number:</label>
            <input type="text" class="form-control flight_num" value="" />
            <input type="hidden" value="" class="flight_id">
          </div>
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-primary save-flight">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Flight Timing Modal -->
<div id="fl_times" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content col-md-12">
       <div class="modal-header col-md-12">
        <h5 class="modal-title font22 bold fl" id="tour_op_lbl">Flight Timings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
          <div class="col-md-12">
            <label>Flight Number: <span class="fl_num"></span></label>
            <input type="hidden" value="" class="flight_id">
            <div class="row">
                <div class="col-md-10 col-sm-9 col-xs-8 bootstrap-timepicker timepicker">
                    <input type="text" class="form-control fl_time" />
                </div>
                <div class="col-md-2 col-sm-3 col-xs-4">
                    <a class="pull-right btn btn-sm btn-success add-time">Add Time</a>
                </div>
            </div>
          <hr>
          </div>
          <div class="col-md-12 fltime_wrap"></div>
      </div>
    </div>
  </div>
</div>
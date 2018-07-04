<style>
  .disable{border: none;background-color: transparent!important;}
</style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Flight Classes
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?=base_url('flight')?>"><i class="fa fa-dashboard"></i> Flights</a></li>
        <li class="active">Flight Classes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success add" data-toggle="modal" data-target="#edit-fl-class">Add New Flight</a>
              <h3 class="box-title pull-right">Total Flight Classes: <span class="flight-count"><?=count($fl_classes)?></span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body flights-list">
             <?php 
                $data['fl_classes']=$fl_classes;
                $this->load->view('flight/fl_class_list', $data); 
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
<div class="modal" id="edit-fl-class" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header col-md-12">
        <h5 class="modal-title font22 bold fl" id="tour_op_lbl">Add New Flight Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
          <div class="col-md-12">
            <label>Flight Class:</label>
            <input type="text" class="form-control fl_class" value="" />
            <input type="hidden" value="" class="fl_class_id">
          </div>
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-primary save-fl-class">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


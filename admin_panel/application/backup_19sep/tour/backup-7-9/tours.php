 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tour Operators
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Operators</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success add" data-toggle="modal" data-target="#edit-tour">Add New Operator</a>
              <h3 class="box-title pull-right">Total Operators: <span class="tour-count"><?=count($operators)?></span></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <?php 
                $data['operators']=$operators;
                $this->load->view('tour/op_list', $data); 
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


<!-- Modal -->
<div class="modal" id="edit-tour" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header col-md-12">
        <h5 class="modal-title font22 bold fl" id="tour_op_lbl">Add Tour Operator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
          <div class="col-md-12">
            <label>Operator Name:</label>
            <input type="text" class="form-control op_name" value="" />
            <input type="hidden" value="" class="op_id">
          </div>
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-primary save-tour">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style>
  .disable{border: none;background-color: transparent!important;}
   .total-vehicle{font-size: 16px;padding: 0 0 12px 0;}
   .flr100{float:left;width:100%;}
 </style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Reps List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Reps</li>
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
                                <label>Name:</label>
                               <input type="text" id="search_by_name" class="form-control " placeholder="Search By Name">
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Phone No:</label>
                               <input type="text" id="search_by_phone" class="form-control " placeholder="Search By Phone No.">
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                    </div>
            </div>
        </div>

          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success add" data-toggle="modal" data-target="#edit-rep">Add New Rep</a>
              <h3 class="box-title pull-right">Total Reps: <span class="rep-count"><?=count($reps)?></span></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
             <?php
             $reps['reps'] = $reps;
             $this->load->view('rep/rep_list', $reps);
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
<div class="modal" id="edit-rep" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header col-md-12">
        <h5 class="modal-title font22 bold fl" id="tour_op_lbl">Add New Rep</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
          <div class="col-md-12">
            <label>Rep Name:</label>
            <input type="text" class="form-control rep_name" value="" /><br>
            <label>Rep Phone:</label>
            <input type="text" class="form-control rep_phone" value="" /><br>
            <input type="hidden" value="" class="rep_id">
          </div>
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-primary save-rep">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

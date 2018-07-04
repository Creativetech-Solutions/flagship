<style>
  .disable{border: none;background-color: transparent!important;}
   .total-vehicle{font-size: 16px;padding: 0 0 12px 0;}
   .flr100{float:left;width:100%;}
 </style>
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Locations List
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url('home')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Locations</li>
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
                                <label>Zone:</label>
                               <!--  <input type="text" id="Search_by_zone" class="form-control " placeholder="Search By Zone"> -->
                                <select class="from-control  select2" id="Search_by_zone" style="width:100%" >
                                <?php 
                                  if(isset($coasts) and is_array($coasts) and !empty($coasts)){
                                    echo '<option value="0">All</option>';
                                    foreach($coasts as $coast){
                                      echo '<option value="'.$coast->id.'">'.$coast->coast.'</option>';
                                    } // end of foreach
                                  } // end of if
                                ?>
                                </select>
                            </div><!-- /.form-group -->
                        </div><!-- /.col -->
                    </div>
            </div>
        </div>

          <div class="box">
            <div class="box-header">
              <a class="btn btn-sm btn-success add" data-toggle="modal" data-target="#edit-loc">Add New Location</a>
              <h3 class="box-title pull-right">Total Locations: <span class="loc-count"><?=count($locations)?></span></h3>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
             <?php
             $locations['locations'] = $locations;
             $this->load->view('location/location_list', $locations);
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
<div class="modal" id="edit-loc" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content col-md-12">
      <div class="modal-header col-md-12">
        <h5 class="modal-title font22 bold fl" id="tour_op_lbl">Add New Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body col-md-12">
          <div class="col-md-12">
            <label>Location :</label>
            <input type="text" class="form-control loc_name" value="" /><br>
            <label>Location Code :</label>
            <input type="text" class="form-control loc_code" value="000" maxlength="6" /><br>
            <label>Zone :</label>
            <!-- <input type="text" class="form-control loc_zone" value="" /> -->
            <select class="from-control loc_zone select2" style="width:100%" >
            <?php 
              if(isset($coasts) and is_array($coasts) and !empty($coasts)){
                foreach($coasts as $coast){
                  echo '<option value="'.$coast->id.'">'.$coast->coast.'</option>';
                }
              }
            ?>
            </select>
            <input type="hidden" value="" class="loc_id">
            <input type="hidden" value="" class="zone_id">
          </div>
      </div>
      <div class="modal-footer col-md-12">
        <button type="button" class="btn btn-primary save-loc">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- room types modal -->
<div class="modal fade" id="roomtypes" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content flr100">
      <div class="modal-header">
        <strong class="modal-title pull-left col-xs-11 pad0" id="exampleModalLabel" style="font-size: 18px;">Room Types</strong>
        <button type="button" class="close col-xs-1 pad0" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body flr100" style="max-height: 425px;overflow-y: scroll;">
         <div class="flr100 total-vehicle">
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-7">
              <strong>Location: <span class="loc-name"></span></strong>
              <br> <input type="hidden" class="loc_id" />
              <strong>Total Rooms: <span style="background-color:#0b8cba" class="badge badge-pill">0</span></strong>
            </div>
            

            <!-- assign room types -->
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
              <select class="form-control roomtype_select2" style="width:100%">
                <?php
                if(isset($roomtypes) and is_array($roomtypes) and !empty($roomtypes)) {
                    echo '<option value="0">Select Room Type</option>';
                    foreach ($roomtypes as $roomtype) {
                        echo '<option value="' . $roomtype->id_room . '">' . $roomtype->room_type . '</option>';
                    }
                }?>
              </select>
              <a class="btn btn-success btn-sm assign_room" style="width:100%;margin-top:3px">Assign Room Type</a>
            </div>
         </div>
         <div class="flr100 room_type_list col-md-12"></div>
      </div>
    </div>
  </div>
</div>
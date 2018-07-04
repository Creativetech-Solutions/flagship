 <?php ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Flight Number</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                  <th>Hidden id</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(isset($flights) and is_array($flights) and !empty($flights)) {
                $fl_nums=array();$times=""; 
                foreach($flights as $flight){ 
                ?>
                <tr class="flight" data-id="<?=$flight->id_flight?>">
                  <td></td>
                  <td><span class="fl_num"><?=$flight->flight_number?></span>
                  <a class="btn btn-success btn-xs pull-right" data-toggle="modal" data-target="#fl_times"> <i class="fa fa-clock-o" aria-hidden="true"></i> Timings</a></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-flight"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a data-id="del-flight" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-flight"><i class="fa fa-trash"></i> Delete</a></td>
                  <td><?=$flight->id_flight?></td> <!-- hidden id -->
                  <?php }  ?>
                </tr>

              <?php } ?>
              </table>

              <table id="time_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Flight Time</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                </tr>
                </thead>
                <tbody>
                
<?php if(is_array($fl_times) and !empty($fl_times)) { ?>
                <?php $count=1;
                foreach($fl_times as $fl_time){ 
                 
                ?>
                <tr class="flight" data-id="<?=$fl_time->id_fltime?>" data-fl-id="<?=$fl_time->id_flight?>">
                  <td><?=$count++?></td>
                  <td><input class="disable" type="text" value="<?=$fl_time->flight_time?>" readonly ></td>
                  <td class="text-center"><a title="Edit" class="btn btn-sm btn-primary btn-xs edit-fl-time"><i class="fa fa-pencil"></i> </a></td>
                  <td class="text-center"><a class="btn btn-sm btn-danger btn-xs del-fl-time"><i class="fa fa-trash"></i> </a></td>
                </tr>
                  <?php }  ?>

              <?php } else {
                  echo 'No Flight Found.';

                }?>
              </table>
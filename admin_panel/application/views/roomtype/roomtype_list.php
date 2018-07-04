 <?php ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Room Type</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                  <th>Hidden id</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(isset($roomtypes) and is_array($roomtypes) and !empty($roomtypes)) {
                foreach($roomtypes as $roomtype){ 
                ?>
                <tr class="room" data-id="<?=$roomtype->id_room?>">
                  <td></td>
                  <td><?=$roomtype->room_type?></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-roomtype"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a data-id="del-roomtype" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-roomtype"><i class="fa fa-trash"></i> Delete</a></td>
                  <td><?=$roomtype->id_room?></td> <!-- hidden id -->
                  <?php }  ?>
                </tr>

              <?php } ?>
              </table>
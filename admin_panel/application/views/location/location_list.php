 <?php ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Location</th>
                  <th>Code</th>
                  <th>Zone</th>
                  <th>Room Types</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                  <th>Hidden Id </th>
                </tr>
                </thead>
                <tbody>
                <?php  if(isset($locations) and is_array($locations) and !empty($locations)) {
                foreach($locations as $location){ 
                ?>
                <tr class="room" data-id="<?=$location->id_location?>">
                  <td></td>
                  <td><?=$location->name?></td>
                  <td><?=$location->loc_code?></td>
                  <td><?=$location->coast?></td>
                  <td><a data-target="#roomtypes" data-toggle="modal" class="btn btn-success btn-xs roomtypes">Room Types</a></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-loc"><i data-toggle="tooltip" title="Edit" class=" ml-fa fa fa-pencil fa-6 "></i> Edit</a></td>
                  <td><a data-id="del-loc" class="btn btn-sm btn-danger del-loc" data-toggle="modal" data-target="#confirm_modal"><i data-toggle="tooltip" title="Delete" data-placement="right" class="fa fa-trash-o ml-fa"></i> Delete</a></td>
                  <td><?=$location->id_location?></td> <!-- hidden id -->
                  <?php }  ?>
                </tr>

              <?php } ?>
              </table>
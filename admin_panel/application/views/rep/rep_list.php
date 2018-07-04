 <?php ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Rep</th>
                  <th>Phone No.</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                  <th>Hidden Id </th>
                </tr>
                </thead>
                <tbody>
                <?php  if(isset($reps) and is_array($reps) and !empty($reps)) {
                foreach($reps as $rep){ 
                ?>
                <tr class="room" data-id="<?=$rep->id_rep?>">
                  <td></td>
                  <td><?=$rep->name?></td>
                  <td><?=$rep->rep_phone?></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-rep"><i data-toggle="tooltip" title="Edit" class=" ml-fa fa fa-pencil fa-6 "></i> Edit</a></td>
                  <td><a data-id="del-rep" class="btn btn-sm btn-danger del-rep" data-toggle="modal" data-target="#confirm_modal"><i data-toggle="tooltip" title="Delete" data-placement="right" class="fa fa-trash-o ml-fa"></i> Delete</a></td>
                  <td><?=$rep->id_rep?></td> <!-- hidden id -->
                  <?php }  ?>
                </tr>

              <?php } ?>
              </table>
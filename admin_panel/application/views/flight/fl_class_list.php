 <?php ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Flight Class</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                  <th>Hidden id</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(isset($fl_classes) and is_array($fl_classes) and !empty($fl_classes)) {
                foreach($fl_classes as $fl_class){ 
                ?>
                <tr class="flight" data-id="<?=$fl_class->id?>">
                  <td></td>
                  <td><?=$fl_class->class?></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-fl-class"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a data-id="del-fl-class" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-flight"><i class="fa fa-trash"></i> Delete</a></td>
                  <td><?=$fl_class->id?></td> <!-- hidden id -->
                  <?php }  ?>
                </tr>

              <?php } ?>
              </table>
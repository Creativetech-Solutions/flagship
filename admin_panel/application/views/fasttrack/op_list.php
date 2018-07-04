 <?php ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>hiddenId</th>
                  <th>Supplier</th>
                  <th>Amount ($)</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($operators) and !empty($operators)) { 
                foreach($operators as $operator){ ?>
                <tr class="tour_operator" data-id="<?=$operator->id?>">
                  <td></td>
                  <td><?=$operator->id?></td>
                  <td><?=$operator->tour_operator?></td>
                  <td><?=$operator->amount?></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-tour"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a data-id="del-tourop" class="btn btn-sm btn-danger del-tourop" data-toggle="modal" data-target="#confirm_modal"><i class="fa fa-trash"></i> Delete</a></td>
                  <?php }  ?>
                </tr>

              <?php } ?>
              </table>
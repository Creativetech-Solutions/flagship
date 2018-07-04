 <?php ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                  <td>Hidden Id</td>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($drivers) and !empty($drivers)) { 
                foreach($drivers as $driver){ ?>
                <tr class="driver" data-id="<?=$driver->id_transport?>">
                  <td></td>
                  <td><span class="dr_name"><?=$driver->name?></span> <a class="btn btn-xs btn-success pull-right" data-toggle="modal" data-target="#vehicle_md">Vehicles <span class="badge"><?=$driver->TotalVehicles?></span></a></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-driver"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a data-id="del-driver" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-driver"><i class="fa fa-trash"></i> Delete</a></td>
                  <td><?=$driver->id_transport?></td>
                  <?php }  ?>
                </tr>

              <?php } ?>
              </table>
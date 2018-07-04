 
                <?php $count=1;
                foreach($vehicles as $vehicle){ ?>
                <tr class="vehicle" data-id="<?=$vehicle->id_vehicle?>" data-dr-id="<?=$vehicle->id_transport?>">
                  <td></td>
                  <td><?=$vehicle->id_vehicle?></td> <!-- for ordering -->
                  <td><?=$vehicle->vehicle_name?></td>
                  <td><?=$vehicle->driver?></td>
                  <td><a class="btn btn-sm btn-primary edit" data-toggle="modal" data-target="#edit-vehicle"><i class="fa fa-pencil"></i> Edit</a></td>
                  <td><a data-id="del-vehicle" data-toggle="modal" data-target="#confirm_modal" class="btn btn-sm btn-danger del-vehicle"><i class="fa fa-trash"></i> Delete</a></td>
                </tr>
                  <?php }  ?>
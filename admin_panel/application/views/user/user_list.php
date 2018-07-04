 <?php if(is_array($users) and !empty($users)) { ?>
              <table id="data_list" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Username</th>
                  <th>Full Name</th>
                  <th>User Status</th>
                  <th>Level</th>
                  <th>Last Login</th>
                  <th class="text-center">Edit</th>
                  <th class="text-center">Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                foreach($users as $user){ ?>
                <tr class="tour_user" data-id="<?=$user->id?>">
                  <td></td>
                  <td><?=$user->username?></td>
                  <td><?=$user->fname.' '.$user->lname?></td>
                  <td><?=$user->active=='y'?'Active':'---'?></td>
                  <td><?=$user->role_name?></td>
                  <td><?=$user->lastlogin?></td>
                  <td>
                  <a class="btn btn-sm btn-primary edit" href="<?=base_url('user/editUser').'/'.$user->id ?>"><i class="fa fa-pencil"></i></a></td>
                  <td><a data-id="del-user" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#confirm_modal"><i class="fa fa-trash"></i></a></td>
                </tr>
                  <?php }  ?>

              </table>
              <?php } else {
                  echo 'No User Found.';

                }?>
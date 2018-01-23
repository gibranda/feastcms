        <?php echo form_open('admin/users/delete_multi');?>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body">
                  <button type="submit" onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" style="display: none; margin-bottom: 10px" class="btn btn-sm btn-danger delete_multi"><?=feast_line('delete', 'selected')?></button>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center no-padding no-margin" style="vertical-align: middle;">
                          <div class="pretty info smooth">
                            <input type="checkbox" name="checkAll" id="dt-select-all" value="1"> 
                            <label><i class="fa fa-check"></i></label>
                          </div>
                        </th>
                        <th><?=feast_line('username')?></th>
                        <th><?=feast_line('email')?></th>
                        <th><?=feast_line('group')?></th>
                        <th><?=feast_line('register_date')?></th>
                        <th><?=feast_line('statue')?></th>
                        <th><span class="nobr"><?=feast_line('action')?></span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($users as $user): ?>
                      <tr>
                        <td class="text-center"><?=get_user('id', $user->id)?></td>
                        <td><?=get_user('username', $user->id)?></td>
                        <td><?=get_user('email', $user->id)?></td>
                        <td><?=get_user_group($user->id)?></td>
                        <td><?=get_user('date_created', $user->id)?></td>
                        <td>
                          <?=(get_user('banned', $user->id) == 0) ? '<span class="label label-success" data-toggle="tooltip" data-title="'.feast_line('active').'"><i class="fa fa-user"></i></span>' : '<span class="label label-danger" data-toggle="tooltip" data-title="'.feast_line('banned').'"><i class="fa fa-user-times"></i></span>'?> 
                        </td>
                        <td>
                          <a href="<?=base_url('admin/edit/'.$user->id)?>" data-toggle="tooltip" data-title="<?=feast_line('edit', 'user')?>" class="btn btn-xs label-info"><i class="fa fa-pencil"></i></a>
                          <?=(get_user('banned', $user->id) == 0) ? '<a href="'.base_url('admin/edit/'.$user->id).'" class="btn btn-xs bg-red" data-toggle="tooltip" data-title="'.feast_line('ban_user').'"><i class="fa fa-user-times"></i></a>' : '<a href="'.base_url('admin/edit/'.$user->id).'" class="btn btn-xs bg-green" data-toggle="tooltip" data-title="'.feast_line('unban_user').'"><i class="fa fa-check"></i></a>'?>
                          <a href="<?=base_url('admin/edit/'.$user->id)?>" data-toggle="tooltip" data-title="<?=feast_line('delete', 'user')?>" class="btn btn-xs label-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table>                  
                </div>
              </div>
            </div>

          </div>
        <?php echo form_close();?>          
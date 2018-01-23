        <?php echo form_open('admin/users/delete_multi'); ?>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body">

                  <?php if( count($all_accounts) > 0 ) : ?>
                  <button type="submit" onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" class="btn btn-danger delete_multi"><i class="fa fa-trash"></i> <?=feast_line('delete', 'selected')?></button>
                  <table class="table table table-striped table-bordered" id="datatable">
                    <thead>
                      <tr>
                        <th class="text-center no-padding no-margin" style="vertical-align: middle;">
                          <div class="pretty info smooth">
                            <input type="checkbox" name="checkAll" id="dt-select-all" value="1"> 
                            <label><i class="fa fa-check"></i></label>
                          </div>
                        </th>
                        <th><?php echo lang('users_username'); ?></th>
                        <th><?php echo lang('settings_email'); ?></th>
                        <th><?php echo lang('settings_firstname'); ?></th>
                        <th><?php echo lang('settings_lastname'); ?></th>
                        <th><?php echo lang('website_update'); ?></th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach( $all_accounts as $acc ) : ?>
                        <tr>
                          <td class="text-center"><?php echo $acc['id']; ?></td>
                          <td>
                            <?php echo $acc['username']; ?>
                            <?php if( $acc['is_banned'] ): ?>
                              <span class="label label-danger"><?php echo lang('users_banned'); ?></span>
                            <?php elseif( $acc['is_admin'] ): ?>
                              <span class="label label-success"><?php echo lang('users_admin'); ?></span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo $acc['email']; ?></td>
                          <td><?php echo $acc['firstname']; ?></td>
                          <td><?php echo $acc['lastname']; ?></td>
                          <td>
                            <?php if( $this->authorization->is_permitted('update_users') ): ?>
                              <?php echo anchor('admin/users/edit/'.$acc['id'],'<i class="fa fa-pencil"></i> '.lang('website_update'),'class="btn btn-xs label-primary"'); ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        <?php echo form_close(); ?>
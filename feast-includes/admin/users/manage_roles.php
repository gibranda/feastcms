        <?php echo form_open('admin/roles/delete_multi');?>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body">

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
                        <th><?php echo lang('roles_column_role'); ?></th>
                        <th><?php echo lang('roles_column_users'); ?></th>
                        <th><?php echo lang('roles_permission'); ?></th>
                        <th><?php echo lang('website_update'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach( $roles as $role ) : ?>
                        <tr>
                          <td class="text-center"><?php echo $role['id']; ?></td>
                          <td>
                            <?php echo $role['name']; ?>
                            <?php if( $role['is_disabled'] ): ?>
                              <span class="label label-important"><?php echo lang('roles_banned'); ?></span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if( $role['user_count'] > 0 ) : ?>
                              <?php echo anchor('admin/users/filter/role/'.$role['id'], $role['user_count'], 'class="badge bg-green"'); ?>
                            <?php else : ?>
                              <span class="badge">0</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if( count($role['perm_list']) == 0 ) : ?>
                              <span class="label label-danger">No Permissions</span>
                            <?php else : ?>
                                <?php $i = 0; foreach( $role['perm_list'] as $itm ) : ?>
                                  <span class="btn btn-xs label-info roles-list"><?php echo anchor('admin/permissions/edit/'.$itm['id'], $itm['key'], 'title="'.$itm['title'].'"'); ?></span>
                                <?php if(++$i == 5) { echo ' more...'; break; } ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if( $this->authorization->is_permitted('update_roles') ): ?>
                              <?php echo anchor('admin/roles/edit/'.$role['id'], '<i class="fa fa-pencil"></i> '.lang('website_update'), 'class="btn btn-xs label-primary"'); ?>
                            <?php endif; ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>
          </div>
        <?php echo form_close(); ?>          
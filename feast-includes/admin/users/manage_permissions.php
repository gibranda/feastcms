        <?php echo form_open('admin/permissions/delete_multi');?>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body">
                  <button type="submit" onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" class="btn btn-danger delete_multi"><i class="fa fa-trash"></i> <?=feast_line('delete', 'selected')?></button>
                  <table class="table table-striped table-bordered" id="datatable">
                    <thead>
                      <tr>
                        <th class="text-center no-padding no-margin" style="vertical-align: middle;">
                          <div class="pretty info smooth">
                            <input type="checkbox" name="checkAll" id="dt-select-all" value="1"> 
                            <label><i class="fa fa-check"></i></label>
                          </div>
                        </th>
                        <th><?php echo lang('permissions_column_permission'); ?></th>
                        <th><?php echo lang('permissions_description'); ?></th>
                        <th><?php echo lang('permissions_column_inroles'); ?></th>
                        <th><?php echo lang('website_update'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach( $permissions as $perm ) : ?>
                        <tr>
                          <td class="text-center"><?php echo $perm['id']; ?></td>
                          <td>
                            <?php echo str_replace('_', ' ', $perm['key']); ?>
                            <?php if( $perm['is_disabled'] ): ?>
                              <span class="btn btn-xs label-important"><?php echo lang('permissions_banned'); ?></span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo $perm['description']; ?></td>
                          <td>
                            <?php if( count($perm['role_list']) == 0 ) : ?>
                              <span class="label">None</span>
                            <?php else : ?>
                                <?php foreach( $perm['role_list'] as $itm ) : ?>
                                  <span class="btn btn-xs label-info"><?php echo anchor('admin/roles/edit/'.$itm['id'], $itm['name'], 'title="'.$itm['title'].'" style="color: white"'); ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                          </td>
                          <td>
                            <?php if( $this->authorization->is_permitted('update_permissions') ): ?>
                              <?php echo anchor('admin/permissions/edit/'.$perm['id'], '<i class="fa fa-pencil"></i> '.lang('website_update'), 'class="btn btn-xs label-primary"'); ?>
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
        <?php echo form_close();?>
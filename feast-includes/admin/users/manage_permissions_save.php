          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <?php echo form_open(); ?>
                <div class="box-body">

                  <div class="control-group bordered <?php echo (form_error('permission_key') || isset($permission_key_error)) ? 'has-error' : ''; ?>">
                      <label class="control-label" for="permission_key"><?php echo lang('permissions_key'); ?></label>

                      <div class="controls">
                        <?php if( $is_system ) : ?>
                          <?php echo form_hidden('permission_key', set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : '')); ?>

                          <?=form_input(array('class' => 'form-control', 'readonly' => 'readonly', 'id' => 'permission_key', 'value' => set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : '')));?>
                          <span class="help-block"><?php echo lang('permissions_system_name'); ?></span>
                        <?php else : ?>
                          <?php echo form_input(array('name' => 'permission_key', 'class' => 'form-control', 'id' => 'permission_key', 'value' => set_value('permission_key') ? set_value('permission_key') : (isset($permission->key) ? $permission->key : ''), 'maxlength' => 80)); ?>

                          <?php if (form_error('permission_key') || isset($permission_key_error)) : ?>
                            <span class="help-inline">
                            <?php
                              echo form_error('permission_key');
                              echo isset($permission_key_error) ? $permission_key_error : '';
                            ?>
                            </span>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                  </div>

                  <div class="control-group bordered <?php echo form_error('permission_description') ? 'has-error' : ''; ?>">
                      <label class="control-label" for="permission_description"><?php echo lang('permissions_description'); ?></label>

                      <div class="controls">
                        <?php echo form_textarea(array('name' => 'permission_description', 'class' => 'form-control', 'id' => 'permission_description', 'value' => set_value('permission_description') ? set_value('permission_description') : (isset($permission->description) ? $permission->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

                        <?php if (form_error('permission_description') || isset($permission_name_error)) : ?>
                          <span class="help-inline">
                          <?php
                            echo form_error('permission_description');
                          ?>
                          </span>
                        <?php endif; ?>
                      </div>
                  </div>

                  <div class="control-group bordered">
                      <label class="control-label" for="settings_lastname"><?php echo lang('permissions_role'); ?></label>

                      <div class="controls">
                      <ol>
                        <?php foreach( $roles as $role ) : ?>
                          <?php
                            $check_it = FALSE;

                            if( isset($role_permissions) )
                            {
                              foreach( $role_permissions as $rperm )
                              {
                                if( $rperm->id == $role->id )
                                {
                                  $check_it = TRUE; break;
                                }
                              }
                            }
                          ?>
                          <li>
                            <div class="ios-switch switch-md switch-left">
                              <label style="padding-left: 0;">
                                <span class="check-label" style="font-size: 13px; font-weight: normal;"><?php echo $role->name; ?>&nbsp;</span>
                                <?php echo form_checkbox("role_permission_{$role->id}", 'apply', $check_it, array('class' => 'js-switch')); ?>
                              </label>
                            </div>
                          </li>
                        <?php endforeach; ?>
                        </ol>
                      </div>
                  </div>


                </div>

                <div class="box-footer">
                  <?php echo form_submit('manage_permission_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
                  <?php echo anchor('admin/permissions', lang('website_cancel'), 'class="btn"'); ?>

                  <?php if( $this->authorization->is_permitted('delete_permissions') && $action == 'update' && ! $is_system ): ?>
                    <span><?php echo lang('admin_or');?></span>
                    <?php if( isset($permission->suspendedon) ): ?>
                      <?php echo form_submit('manage_permission_unban', lang('permissions_unban'), 'class="btn btn-danger"'); ?>
                    <?php else: ?>
                      <?php echo form_submit('manage_permission_ban', lang('permissions_ban'), 'class="btn btn-danger"'); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>

                <?php echo form_close(); ?>
              </div>
            </div>

          </div>
          <div class="row">
            <?php echo form_open(); ?>
            <div class="col-md-9 col-sm-12">
              <div class="box" data-spy="affix" data-offset-top="60" data-offset-bottom="200">
                <div class="box-body">


                  <div class="control-group bordered <?php echo (form_error('role_name') || isset($role_name_error)) ? 'error' : ''; ?>">
                      <label class="control-label" for="role_name"><?php echo lang('roles_name'); ?></label>

                      <div class="controls">
                        <?php if( $is_system ) : ?>
                          <?php echo form_hidden('role_name', set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : '')); ?>

                          <?=form_input(array('class' => 'form-control', 'readonly' => 'readonly', 'id' => 'permission_key', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : '')));?>
                          <span class="help-block">
                          <?php echo lang('roles_system_name'); ?></span>
                        <?php else : ?>
                          <?php echo form_input(array('name' => 'role_name', 'class' => 'form-control', 'id' => 'role_name', 'value' => set_value('role_name') ? set_value('role_name') : (isset($role->name) ? $role->name : ''), 'maxlength' => 80)); ?>

                          <?php if (form_error('role_name') || isset($role_name_error)) : ?>
                            <span class="help-inline">
                            <?php
                              echo form_error('role_name');
                              echo isset($role_name_error) ? $role_name_error : '';
                            ?>
                            </span>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                  </div>

                  <div class="control-group bordered <?php echo form_error('role_description') ? 'error' : ''; ?>">
                      <label class="control-label" for="role_description"><?php echo lang('roles_description'); ?></label>

                      <div class="controls">
                        <?php echo form_textarea(array('name' => 'role_description', 'class' => 'form-control', 'id' => 'role_description', 'value' => set_value('role_description') ? set_value('role_description') : (isset($role->description) ? $role->description : ''), 'maxlength' => 160, 'rows'=>'4')); ?>

                        <?php if (form_error('role_description') || isset($role_name_error)) : ?>
                          <span class="help-inline">
                          <?php
                            echo form_error('role_description');
                          ?>
                          </span>
                        <?php endif; ?>
                      </div>
                  </div>

                </div>
                
                <div class="box-footer">
                  <?php echo form_submit('manage_role_submit', lang('settings_save'), 'class="btn btn-primary"'); ?>
                  <?php echo anchor('admin/roles', lang('website_cancel'), 'class="btn"'); ?>
                  <?php if( $this->authorization->is_permitted('delete_roles') && $action == 'update' && ! $is_system ): ?>
                    <span><?php echo lang('admin_or');?></span>
                    <?php if( isset($role->suspendedon) ): ?>
                      <?php echo form_submit('manage_role_unban', lang('roles_unban'), 'class="btn btn-danger"'); ?>
                    <?php else: ?>
                      <?php echo form_submit('manage_role_ban', lang('roles_ban'), 'class="btn btn-danger"'); ?>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>


              </div>
            </div>

            <div class="col-md-3 col-sm-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo lang('roles_permission'); ?></h3>
                </div>
                <div class="box-body" id="role_perms">
                       <!-- radio -->
                        <div class="form-group">
                          <label>
                            <input type="radio" name="check_all" class="minimal check_all">
                            Check all
                          </label>
                          <label>
                            <input type="radio" name="check_all" class="minimal uncheck_all">
                            Uncheck all
                          </label>
                        </div>
                        <?php foreach( $permissions as $perm ) : ?>
                          <?php
                            $check_it = FALSE;

                            if( isset($role_permissions) )
                            {
                              foreach( $role_permissions as $rperm )
                              {
                                if( $rperm->id == $perm->id )
                                {
                                  $check_it = TRUE; break;
                                }
                              }
                            }
                          ?>
                          <div class="form-group">
                            <div class="ios-switch switch-md">
                              <label style="padding-left: 0;">
                                <span class="check-label"><?php echo str_replace('_', ' ', $perm->key); ?>&nbsp;</span>
                                <?php echo form_checkbox("role_permission_{$perm->id}", 'apply', $check_it, array('class' => 'js-switch')); ?>
                              </label>
                            </div>
                          </div>
                        <?php endforeach; ?>

                </div>

              </div>              
            </div>
            <?php echo form_close(); ?>
          </div>

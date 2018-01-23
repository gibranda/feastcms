<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
          <div class="row">

            <div class="col-md-7">
              <?php echo form_open();?>
              <div class="box">
                <div class="box-header with-border">
                  <h4 class="box-title">Manage items</h4>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-7">
                      <h4><span class="badge badge-primary"><i class="fa fa-bars"></i></span> Manage orders</h4>
                      <div id="orderResult">
                        <?=isset($items) ? get_ol($items) : null?>
                      </div>
                      <button type="button" id="save" class="btn btn-success btn-flat">Save items</button>
                    </div>
                    <div class="col-md-5">
                      <h4><span class="badge badge-primary"><i class="fa fa-plus"></i></span> Add item</h4>
                      <div class="form-group">
                        <label for="itemType">Select type</label>
                        <select name="itemType" id="itemType" class="form-control not">
                          <option value="">Select Type</option>
                          <option value="page">Page</option>
                          <option value="category">Category</option>
                          <option value="post">Post</option>
                          <option value="custom">Custom link</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="typeItems">Select item</label>
                        <select name="typeItems" data-placeholder="Select item" id="typeItems" class="form-control not">
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="itemTitle">Title</label>
                        <input type="text" name="itemTitle" class="form-control" id="itemTitle"/>
                      </div>
                      <div class="form-group">
                        <label for="itemUrl">link</label>
                        <input type="text" name="itemUrl" class="form-control" id="itemUrl"/>
                      </div>
                      <button type="button" id="addItem" class="btn btn-primary btn-flat">Add item</button>
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <?php echo form_close();?>
            </div><!-- /.col-md-4 -->

            <div class="col-md-5">
              <?php echo form_open();?>
              <div class="box collapsed-box">
                <div class="box-header with-border">
                  <h4 class="box-title"><?=feast_line('edit', feast_line('menu'))?></h4>
                  <div class="box-tools pull-right">
                    <!-- Buttons, labels, and many other things can be placed here! -->
                    <!-- Here is a label for example -->
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div>
                <div class="box-body">
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label(feast_line('title'),'title');
                      echo form_input('title',set_value('title',$menu->title),'class="form-control"');
                      echo form_error('title', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label(feast_line('alias'),'alias');
                      echo form_input('alias', htmlspecialchars_decode(set_value('alias',$menu->alias)),'class="form-control"');
                      echo form_error('alias', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('Start tag','st_tag');
                      echo form_input('st_tag', htmlspecialchars_decode(set_value('st_tag',$menu->st_tag)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>&lt;ul class="nav"&gt;</code></p>';
                      echo form_error('st_tag', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('End tag','en_tag');
                      echo form_input('en_tag', htmlspecialchars_decode(set_value('en_tag',$menu->en_tag)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>&lt;/ul&gt;</code></p>';
                      echo form_error('en_tag', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('Item start tag','item_st_tag');
                      echo form_input('item_st_tag', htmlspecialchars_decode(set_value('item_st_tag',$menu->item_st_tag)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>&lt;li&gt;</code></p>';
                      echo form_error('item_st_tag', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('Item end tag','item_en_tag');
                      echo form_input('item_en_tag',htmlspecialchars_decode(set_value('item_en_tag',$menu->item_en_tag)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>&lt;/li&gt;</code></p>';
                      echo form_error('item_en_tag', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('Sub-menu start tag','sub_st_tag');
                      echo form_input('sub_st_tag',htmlspecialchars_decode(set_value('sub_st_tag',$menu->sub_st_tag)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>&lt;ul class="dropdown-menu"&gt;</code></p>';
                      echo form_error('sub_st_tag', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('Sub-menu end tag','sub_en_tag');
                      echo form_input('sub_en_tag',htmlspecialchars_decode(set_value('sub_en_tag',$menu->sub_en_tag)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>&lt;/ul&gt;</code></p>';
                      echo form_error('sub_en_tag', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('Active class','active_class');
                      echo form_input('active_class',htmlspecialchars_decode(set_value('active_class',$menu->active_class)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>active</code></p>';
                      echo form_error('active_class', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                    <div class="form-group col-md-12">
                      <?php
                      echo form_label('has-sub class','has_sub_class');
                      echo form_input('has_sub_class',htmlspecialchars_decode(set_value('has_sub_class',$menu->has_sub_class)),'class="form-control"');
                      echo '<p class="text-info">Default: <code>dropdown</code></p>';
                      echo form_error('has_sub_class', '<p class="text-danger">', '</p>');
                      ?>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <?php echo form_submit('submit', feast_line('save'), 'class="btn btn-primary pull-right"');?>
                </div>
              </div><!-- /.box -->
              <?php echo form_close();?>
            </div><!-- /.col-md-4 -->

          </div><!-- /.row -->

          <!-- Modal -->
          <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <?=form_open(base_url().'admin/menu/edit_item/')?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title">Edit menu item</h4>

                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
            <?=form_close()?>            
          </div>
          <div class="row">
            <div class="col-md-8 col-sm-12">
              <div class="box">
                <div class="box-body">
                  <?php echo form_open('admin/portfolio/delete_multi_cat'); ?>
                  <button type="submit" onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" class="btn btn-danger delete_multi"><i class="fa fa-trash"></i> <?=feast_line('delete', 'selected')?></button>
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center no-padding no-margin" style="vertical-align: middle;">
                          <div class="pretty info smooth">
                            <input type="checkbox" name="checkAll" id="dt-select-all" value="1"> 
                            <label><i class="fa fa-check"></i></label>
                          </div>
                        </th>
                        <th><?=feast_line('title')?></th>
                        <th><?=feast_line('slug')?></th>
                        <th><?=feast_line('order')?></th>
                        <th><span class="nobr"><?=feast_line('action')?></span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach(list_portfolio_cats() as $cat): ?>
                      <tr>
                        <td class="text-center"><?=cat_id($cat)?></td>
                        <td><?=cat_title($cat)?></td>
                        <td><?=cat_slug($cat)?></td>
                        <td><?=cat_order($cat)?></td>
                        <td>
                          <a href="<?=base_url('admin/portfolio/edit_cat/' . cat_id($cat))?>" class="label label-info" data-toggle="tooltip" data-title="<?=feast_line('edit', $this->lang->line('category') )?>"><i class="fa fa-lg fa-pencil"></i></a>
                          <a onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" href="<?=base_url('admin/portfolio/delete_cat/' . cat_id($cat))?>" class="label label-danger" data-toggle="tooltip" data-title="<?=feast_line('delete', $this->lang->line('category') )?>"><i class="fa fa-lg fa-trash"></i></a> 
                        </td>
                      </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table> 
                  <?php echo form_close(); ?>                 
                </div>
              </div>
            </div>

            <div class="col-md-4 col-sm-12">

    				<div class="box box-primary">
    				  <div class="box-header with-border">
    				    <h3 class="box-title"><?=feast_line('add', $this->lang->line('category') )?></h3>
    				  </div><!-- /.box-header -->
    				  <?=form_open('admin/portfolio/edit_cat', array('class' => 'form'))?>
    				  <div class="box-body">
                <div class="form-group">
                  <?php
                  echo form_label(feast_line('title'),'title');
                  echo form_input('title',set_value('title'),'class="form-control"');
                  echo form_error('title', '<p class="text-danger">', '</p>');
                  ?>
                </div>
                <div class="form-group">
                  <?php
                  echo form_label(feast_line('slug'),'slug');
                  echo form_input('slug',set_value('slug'),'class="form-control"');
                  echo form_error('slug', '<p class="text-danger">', '</p>');
                  ?>
                </div>
                <div class="form-group">
                  <?php
                  echo form_label(feast_line('order'),'order');
                  echo form_input('order',set_value('order'),'class="form-control"');
                  echo form_error('order', '<p class="text-danger">', '</p>');
                  ?>
                </div>

    				  </div><!-- /.box-body -->
    				  <div class="box-footer">
                  <?php echo form_submit('submit', feast_line('save'), 'class="btn btn-success btn-lg btn-block"');?>
    				  </div><!-- box-footer -->
    				  <?=form_close()?>
    				</div><!-- /.box -->

            </div>

          </div>
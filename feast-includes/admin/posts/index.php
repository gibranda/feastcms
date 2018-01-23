        <?php echo form_open('admin/posts/delete_multi');?>
          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body">
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
                        <th><?=feast_line('category')?></th>
                        <th><?=feast_line('statue')?></th>
                        <th><span class="nobr"><?=feast_line('action')?></span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($posts as $post): ?>
                      <tr>
                        <td class="text-center"><?=post_id($post)?></td>
                        <td><a href="<?=post_url($post)?>" target="_blank"><?=post_title($post)?></a></td>
                        <td><?=post_category($post)?></td>
                        <td><?=post_statue($post) == 1 ? '<span class="label label-success" data-toggle="tooltip" data-title="'.feast_line("active").'"><i class="fa fa-lg fa-check-circle"></i></span>': '<span class="label label-danger"><i class="fa fa-lg fa-times-circle" data-toggle="tooltip" data-title="'.feast_line("hidden").'"></i></span>'?></td>
                        <td>
                          <a href="<?=base_url('admin/posts/edit/' . post_id($post))?>" class="label label-info" data-toggle="tooltip" data-title="<?=feast_line('edit', $this->lang->line('post') )?>"><i class="fa fa-lg fa-pencil"></i></a>
                          <a onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" href="<?=base_url('admin/posts/delete/' . post_id($post))?>" class="label label-danger" data-toggle="tooltip" data-title="<?=feast_line('delete', $this->lang->line('post') )?>"><i class="fa fa-lg fa-trash"></i></a> 
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
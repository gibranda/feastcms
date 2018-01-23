          <div class="row">
            <div class="col-md-12 col-sm-12">
              <div class="box">
                <div class="box-body">
                  <?php echo form_open('admin/comments/delete_multi'); ?>               
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
                        <th><?=feast_line('username')?></th>
                        <th><?=feast_line('post')?>/<?=feast_line('page')?></th>
                        <th><?=feast_line('created')?></th>
                        <th><span class="nobr"><?=feast_line('action')?></span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach(list_comments() as $comment): ?>
                      <tr>
                        <td class="text-center"><?=comment_id($comment)?></td>
                        <td><?=comment_username($comment)?></td>
                        <td><a href="<?=comment_post_url($comment)?>"><?=comment_post($comment)?></a></td>
                        <td><?=comment_date($comment)?></td>
                        <td>
                          <a type="button" class="push label label-primary" id="<?=comment_id($comment)?>" data-url="<?php echo base_url('admin/comments/comment'); ?>" data-toggle="modal" data-target="#Comment"><i class="fa fa-eye"></i></a>
                          <a onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" href="<?=base_url('admin/comments/delete/' . comment_id($comment))?>" class="label label-danger" data-toggle="tooltip" data-title="<?=feast_line('delete', $this->lang->line('comment') )?>"><i class="fa fa-lg fa-trash"></i></a> 
                        </td>
                      </tr>
                      <?php endforeach; ?>

                    </tbody>
                  </table>
                  <?php echo form_close(); ?> 
                </div>
              </div>
            </div>

          </div>

          <!-- Modal -->
          <div class="modal fade" id="Comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Comment</h4>
                </div>
                <div class="modal-body">
                  <div id="comment-body"></div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
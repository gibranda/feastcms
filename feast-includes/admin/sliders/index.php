        <?php echo form_open('admin/slider/delete_multi');?>
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
                        <th><?=feast_line('alias')?></th>
                        <th><?=feast_line('type')?></th>
                        <th><span class="nobr"><?=feast_line('action')?></span></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach($sliders as $slider): ?>
                      <?php 
                      switch($slider->sliderType) {
                        case 1:
                          $sliderType = 'Latest posts';
                          break;
                        case 2:
                          $sliderType = 'Custom posts';
                          break;
                        case 3:
                          $sliderType = 'Custom categories';
                          break;
                        case 4:
                          $sliderType = 'Custom slider';
                          break;
                      }
                      ?>
                      <tr>
                        <td class="text-center"><?=$slider->id?></td>
                        <td><?=$slider->title?></td>
                        <td><?=$slider->alias?></td>
                        <td><?=$sliderType?></td>
                        <td>
                          <a href="<?=base_url('admin/slider/edit/' . $slider->id)?>" class="label label-info" data-toggle="tooltip" data-title="<?=feast_line('edit', 'slider')?>"><i class="fa fa-lg fa-pencil"></i></a>
                          <a onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" href="<?=base_url('admin/slider/delete/' . $slider->id)?>" class="label label-danger" data-toggle="tooltip" data-title="<?=feast_line('delete', 'slider')?>"><i class="fa fa-lg fa-trash"></i></a> 
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
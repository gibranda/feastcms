        <div class="row">
          <div class="col-md-12">
            <button onclick="moduleUpload()" class="btn btn-info btn-flat" style="margin-bottom: 15px;">
              <i class="fa fa-cloud-upload"></i> Upload module
            </button>

            <div id="moduleUpload" style="display: none;">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Select your zip file</h3>
                </div>
                <div class="box-body text-center" style="padding: 30px 0;">
                  <?php echo form_open_multipart('admin/unzip/upload');?>
                    <label class="control-label">Select File</label>
                    <input class="fileinput" name="zip_file" type="file">
                    <input type="hidden" name="upload_path" value="./feast-content/modules/">
                    <input type="hidden" name="extract_location" value="./feast-content/modules/">
                    <button type="submit" class="btn btn-success" style="margin: 15px auto 0;">Upload</button>
                  <?php echo form_close();?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <?php foreach($modules as $module): 
            $image = file_exists(FCPATH . 'feast-content/modules/'.$module->module_name.'/screen.png') ? base_url('feast-content/modules/'.$module->module_name.'/screen.png') : base_url('feast-content/modules/no-image.png');
            $style = $module->statue == 'enable' ? 'box-success' : 'box-primary';
          ?>
          <div class="col-md-3 col-sm-6 co-xs-12">
            <div class="box <?=$style?>">
              <div class="box-header with-border">
                <h3 class="box-title"><?=ucfirst($module->module_name)?></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <img src="<?=$image?>" class="img-responsive">
              </div><!-- /.box-body -->
              <div class="box-footer text-center">
                  <?php if($module->statue == 'disable') { ?>
                  <a href="<?=base_url('admin/module/enable/'. $module->id)?>" class="btn btn-success"><i class="fa fa-check" data-toggle="tooltip" data-title="<?=feast_line('enable')?>"></i></a>
                  <?php } else { ?>
                  <a href="<?=base_url('admin/module/disable/'. $module->id)?>" class="btn btn-default"><i class="fa fa-times" data-toggle="tooltip" data-title="<?=feast_line('disable')?>"></i></a>
                  <?php }?>
                  <?php if(file_exists(FCPATH . 'feast-content/modules/' . $module->module_name . '/setting.php')) { ?>
                  <a href="<?=base_url('admin/module/setting/'. $module->id)?>" class="btn btn-primary"><i class="fa fa-cog" data-toggle="tooltip" data-title="<?=feast_line('settings', feast_line('module'))?>"></i></a>
                  <?php } ?>
                  <a href="<?=base_url('admin/module/uninstall/'. $module->module_name)?>" class="btn btn-danger" onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" ><i class="fa fa-trash" data-toggle="tooltip" data-title="<?=feast_line('delete', feast_line('module'))?>"></i></a>
              </div><!-- box-footer -->
            </div>
          </div>

          <?php endforeach; ?>
        </div>

        <script type="text/javascript">
          function moduleUpload() {
            $('#moduleUpload').slideToggle('slow');
          }
        </script>
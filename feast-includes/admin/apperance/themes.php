        <div class="row">
          <div class="col-md-12">
            <button onclick="moduleUpload()" class="btn btn-info btn-flat" style="margin-bottom: 15px;">
              <i class="fa fa-cloud-upload"></i> Upload Theme
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
                    <input type="hidden" name="upload_path" value="./feast-content/themes/">
                    <input type="hidden" name="extract_location" value="./feast-content/themes/">
                    <button type="submit" class="btn btn-success" style="margin: 15px auto 0;">Upload</button>
                  <?php echo form_close();?>
                </div>
              </div>
            </div>
          </div>
        </div>
          <div class="row">
			<?php $active_theme = theme_headers($this->pref->active_theme); ?>
            <div class="col-md-4 col-sm-6 co-xs-12">
				<div class="box box-success">
				  <div class="box-header with-border">
				    <h3 class="box-title"><?=$active_theme['theme_name']?></h3>
				    <div class="box-tools pull-right">
				      <!-- Buttons, labels, and many other things can be placed here! -->
				      <!-- Here is a label for example -->
				      <span class="label label-primary"><?=$active_theme['theme_version']?></span>
				    </div><!-- /.box-tools -->
				    <p>By: <a href="<?=$active_theme['theme_author_uri']?>" target="_blank"><?=$active_theme['theme_author']?></a></p>
				  </div><!-- /.box-header -->
				  <div class="box-body">
				    <img src="<?=base_url('feast-content/themes/'.$this->pref->active_theme.'/screenshot.png')?>" class="img-responsive">
				  </div><!-- /.box-body -->
				  <div class="box-footer">
					    <span class="btn btn-flat btn-success" data-toggle="tooltip" data-title="<?=feast_line('current_theme')?>"><i class="fa fa-check-circle"></i></span>
					    <span data-toggle="tooltip" data-title="<?=feast_line('theme_info')?>">
					    	<a href="<?=base_url('admin/apperance/theme_info/'.$this->pref->active_theme)?>" class="btn btn-flat btn-info theme_info"><i class="fa fa-info-circle"></i></a>
				    	</span>
				    	<?php if(theme_has_options()) { ?>
					    <a href="<?=base_url('admin/apperance/theme_options/'. $this->pref->active_theme)?>" class="btn btn-flat btn-default"><i class="fa fa-cog"></i> <?=feast_line('settings', feast_line('theme'))?></a>
					    <?php } ?>				  		
				  </div><!-- box-footer -->
				</div><!-- /.box -->				
            </div><!-- /.col-md-4 -->

			<?php
			$map = directory_map('./feast-content/themes/', 1);
			foreach($map as $theme) {
				$theme = str_replace(DIRECTORY_SEPARATOR, '', $theme);
				$image = base_url('feast-content/themes/'.$theme.'/screenshot.png');
				$theme_headers = theme_headers($theme);
			  	if(is_dir('./feast-content/themes/'.$theme) and !in_array($theme, array('errors', $this->pref->active_theme))) {

	  			if(file_exists('./feast-content/themes/'.$theme . '/style.css')) {
	  				$style = TRUE;
	  			} else {
	  				$style = FALSE;
	  			}

			?>


            <div class="col-md-4 col-sm-6 co-xs-12">
				<div class="box <?=$style == TRUE ? null : 'box-danger'?>">
				<?php if($style == TRUE) { ?>
				  <div class="box-header with-border">
				    <h3 class="box-title"><?=$theme_headers['theme_name']?></h3>
				    <div class="box-tools pull-right">
				      <!-- Buttons, labels, and many other things can be placed here! -->
				      <!-- Here is a label for example -->
				      <span class="label label-primary"><?=$theme_headers['theme_version']?></span>
				    </div><!-- /.box-tools -->
				    <p>By: <a href="<?=$theme_headers['theme_author_uri']?>" target="_blank"><?=$theme_headers['theme_author']?></a></p>
				  </div><!-- /.box-header -->
				  <div class="box-body">
				    <img src="<?=$image?>" class="img-responsive">
				  </div><!-- /.box-body -->
				  <div class="box-footer">
				  	<span data-toggle="tooltip" data-title="<?=feast_line('theme_info')?>">
				  		<a href="<?=base_url('admin/apperance/theme_info/'.$theme)?>" class="btn btn-flat btn-info theme_info"><i class="fa fa-info-circle"></i></a>
			  		</span>
				    <a href="<?=base_url('admin/apperance/set_theme/'. $theme)?>" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> <?=feast_line('active_theme')?></a>
				    <a onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" href="<?=base_url('admin/apperance/uninstall/'. $theme)?>" class="btn btn-danger btn-flat"data-toggle="tooltip" data-title="<?=feast_line('delete', feast_line('theme'))?>"><i class="fa fa-trash"></i></a>
				  </div><!-- box-footer -->
				<?php } else { ?>
				  <div class="box-header with-border">
				    <h3 class="box-title">Theme <?=$theme?> <small>Missing <code>style.css</code> file</small></h3>
				  </div><!-- /.box-header -->
				  <div class="box-body">
				    <div class="alert alert-danger">
				    	Looks like the style.css file are missing in your theme and this is the only required file for your theme informations. For more information about themes system please check the <a href="http://demo.eadhassan.com/feast-cms/documentation/#features-themes" target="_blank">documentation</a>.
				    </div>
				  </div><!-- /.box-body -->
				  <div class="box-footer">
				    <a onClick="javascript:return confirm('<?=feast_line('delete_confirm_msg')?>');" href="<?=base_url('admin/apperance/uninstall/'. $theme)?>" class="btn btn-danger btn-flat" data-toggle="tooltip" data-title="<?=feast_line('delete', feast_line('theme'))?>"><i class="fa fa-trash"></i></a>
				  </div><!-- box-footer -->				<?php } ?>
				</div><!-- /.box -->				
            </div><!-- /.col-md-4 -->

			<?php
				}
			}
			?>            

          </div><!-- /.row -->

        <script type="text/javascript">
          function moduleUpload() {
            $('#moduleUpload').slideToggle('slow');
          }
        </script>
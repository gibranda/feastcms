    <?php $dir = is_rtl() ? 'rtl' : 'ltr'; ?>
                      <div class="row">
                        <div class="col-lg-12 col-md-12">
                          <form class="form-horizontal" method="post" action="<?php echo base_url('admin/settings/update'); ?>">
                            <div class="box">
                                <div class="box-header with-border">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> <?=feast_line('save')?></button>
                                </div>
                                <div class="box-body" style="padding-top: 20px;">
                                    <?php foreach($settings as $setting):
                                        $type = '';
                                    switch ($setting->type) {
                                      case 1:
                                        $type = '<input type="text" name="'.$setting->key.'" class="form-control" value="'.$setting->value.'">';
                                        break;
                                      case 2:
                                        $type = '<input type="email" name="'.$setting->key.'" class="form-control" value="'.$setting->value.'">';
                                        break;
                                      case 3:
                                        $type = '<textarea name="'.$setting->key.'" class="form-control" rows="4">'.$setting->value.'</textarea>';
                                        break;
                                      case 4:
                                        $type = '<select name="'.$setting->key.'" class="form-control" dir="'.$dir.'">';
                                        if($setting->value == 1){
                                        $type .= '<option value="1">Yes</option>';
                                        $type .= '<option value="0">No</option>';
                                        } else {
                                        $type .= '<option value="0">No</option>';
                                        $type .= '<option value="1">Yes</option>';
                                        }
                                        $type .= '</select>';
                                        break;
                                        default:
                                        $type = '<input type="text" name="'.$setting->key.'" class="form-control" value="'.$setting->value.'">';
                                    }

                                    ?>
                                      <?php if($setting->key != 'timezone') { ?>
                                      <div class="form-group">
                                          <label for="inputEmail3" class="col-sm-2 control-label"><?=$setting->title?></label>
                                          <div class="col-sm-4">
                                        <?php if($setting->key == 'active_theme'){
                                        $map = directory_map('./feast-content/themes/', 1);
                                        ?>
                                        <select name="<?php echo $setting->key; ?>" class="form-control" dir="<?=$dir?>">
                                            <?php
                                              foreach($map as $theme) {
                                              	$theme = str_replace(DIRECTORY_SEPARATOR, '', $theme);
                                                if(is_dir('./feast-content/themes/'.$theme) and $theme != 'errors') {
                                              ?>
                                              <option value="<?php echo $theme; ?>" <?php if($setting->value == $theme) {echo 'selected';}?>><?php echo $theme; ?></option>
                                              <?php }
                                              }
                                            ?>
                                        </select>
                                        <?php } elseif($setting->key == 'site_logo') { ?>
                                        <div class="input-group input-group-sm">
                                          <input class="form-control iframe-btn" placeholder="<?=$this->uri->segment(4) ? feast_line('change_image') : feast_line('select_image')?>" type="text" name="<?=$setting->key?>" value="<?=set_value($setting->value, $setting->value)?>" id="<?=$setting->key?>">
                                          <span class="input-group-btn">
                                            <a href="#" class="btn btn-danger delete_media" id="<?=$setting->key?>" data-toggle="tooltip" data-title="remove" type="button"><i class="fa fa-trash"></i></a>
                                            <a href="<?=base_url()?>feast-includes/admin/assets/filemanager/dialog.php?type=1&field_id=<?=$setting->key?>" class="btn btn-success iframe-btn" data-toggle="tooltip" data-title="<?=feast_line('select_image')?>" type="button"><i class="fa fa-folder-open"></i></a>
                                          </span>
                                        </div>
                                        <div id="<?=$setting->key?>_preview" class="thumbnail" style="margin-top: 10px; display: none">
                                          <img src="" alt="Logo">
                                        </div>
                                        <?php } elseif($setting->key == 'latest_posts_order') { ?>
                                        <select name="<?php echo $setting->key; ?>" class="form-control" dir="<?=$dir?>">
                                            <option value="" <?php if($setting->value == 'full_slider') {echo 'selected';}?>>Select order</option>
                                            <option value="ASC" <?php if($setting->value == 'ASC') {echo 'selected';}?>>&#xf15d; Ascending</option>
                                            <option value="DESC" <?php if($setting->value == 'DESC') {echo 'selected';}?>>&#xf15e; Descending</option>
                                        </select>
                                        <?php } elseif($setting->key == 'home_intro'){?>
                                        <select name="<?php echo $setting->key; ?>" class="form-control" dir="<?=$dir?>">
                                            <option value="full_slider" <?php if($setting->value == 'full_slider') {echo 'selected';}?>>Full slider</option>
                                            <option value="classic_slider" <?php if($setting->value == 'classic_slider') {echo 'selected';}?>>Classic slider</option>
                                            <option value="text_rotate" <?php if($setting->value == 'text_rotate') {echo 'selected';}?>>Text rotate</option>
                                            <option value="full_image" <?php if($setting->value == 'full_image') {echo 'selected';}?>>Full image</option>
                                            <option value="classic_image" <?php if($setting->value == 'classic_image') {echo 'selected';}?>>Classic image</option>
                                        </select>
                                        <?php } elseif($setting->key == 'admin_theme_color'){
                                        ?>
                                        <select name="<?php echo $setting->key; ?>" class="form-control" dir="<?=$dir?>">
                                            <option <?php if($setting->value == 'blue'){echo ' selected';}?> value="blue">Blue</option>
                                            <option <?php if($setting->value == 'red'){echo ' selected';}?> value="red">Red</option>
                                            <option <?php if($setting->value == 'white'){echo ' selected';}?> value="white">White</option>
                                            <option <?php if($setting->value == 'green'){echo ' selected';}?> value="green">Green</option>
                                            <option <?php if($setting->value == 'purple'){echo ' selected';}?> value="purple">Purple</option>
                                            <option <?php if($setting->value == 'dark'){echo ' selected';}?> value="dark">Dark</option>
                                        </select>
                                        <?php } elseif($setting->key == 'default_controller'){
                                        ?>
                                        <select name="<?php echo $setting->key; ?>" class="form-control" dir="<?=$dir?>">
                                              <option value="home"<?=$setting->value == 'home' ? 'selected' : null ?>><?=feast_line('Index')?></option>
                                            <?php
                                              foreach(list_pages() as $page) {
                                              ?>
                                              <option value="<?=post_id($page)?>" <?php if($setting->value == post_id($page)) {echo 'selected';}?>><?=post_title($page)?></option>
                                              <?php 
                                              }
                                            ?>
                                        </select>
                                        <?php } elseif($setting->key == 'default_language'){
                                        $map = directory_map('./feast-includes/application/language/', 1);
                                        ?>
                                        <select name="<?php echo $setting->key; ?>" class="form-control" dir="<?=$dir?>">
                                            <?php
                                              foreach($map as $lang) {
                                              	$lang = str_replace(DIRECTORY_SEPARATOR, '', $lang);
                                                if(is_dir('./feast-includes/application/language/'.$lang) and $lang != 'errors') {
                                              ?>
                                              <option value="<?php echo $lang; ?>" <?php if($setting->value == $lang) {echo 'selected';}?>><?php echo $lang; ?></option>
                                              <?php }
                                              }
                                            ?>
                                        </select>
                                        <?php } else {
                                            echo $type;
                                        }
                                        ?>
                                          <?php if($setting->key == 'site_url'){ ?>
                                              <p class="help-block text-danger">Not recommended to change this option.</p>
                                          <?php } ?>
                                          </div>
                                      </div>
                                      <?php } else {
                                        echo admin_select($setting->title, $setting->key, $zones, $setting->value, FALSE, 2, 4);
                                        }?>
                                      <hr/>
                                   <?php endforeach; ?>
                                </div>
                                <div class="box-footer">
                                    <button class="btn btn-success" style="display: block" type="submit"><i class="fa fa-save"></i> <?=feast_line('save')?></button>
                                </div>
                            </div>
                          </form>
                        </div>
                      </div>
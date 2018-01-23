          <?php $sliderSource = $this->uri->segment(4) ? unserialize(base64_decode($slide->sliderSource)) : null ?>
          <?php $sliderCustom = $this->uri->segment(4) ? unserialize(base64_decode($slide->customize)) : null ?>

          <?php if($slide->sliderType == 4) { 
            unset( $sliderSource['postNum'] ); 
            unset( $sliderSource['staticBg'] ); 
          } ?>
          <div class="row">

            <!-- Form start -->
            <?php echo form_open_multipart('', array('id' => 'Slider')); ?>
            
            <div class="col-lg-8 col-md-7">

              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=(!$this->uri->segment(4)) ? feast_line('add','slider') : feast_line('edit','slider')?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="title"><?=feast_line('title')?></label>
                          <?php echo form_input('title', set_value('title', $slide->title), array('class' => 'form-control', 'id' => 'title')); ?>
                                <?php echo form_error('title', '<p class="text-danger">', '</p>'); ?>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label for="alias"><?=feast_line('alias')?></label>
                          <?php echo form_input('alias', set_value('alias', $slide->alias), array('class' => 'form-control', 'id' => 'alias')); ?>
                                <?php echo form_error('alias', '<p class="text-danger">', '</p>'); ?>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                          
                          <label for="copyTarget"><?=feast_line('shortcode')?></label>
                          <div class="input-group m-b-sm">
                          <?php $shortcode = !empty($slide->alias) ? 'get_slider("' . $slide->alias . '")' : ''; ?>
                              <input type="text" id="copyTarget" value='<?=$shortcode?>' readonly="readonly" class="form-control">
                              <span class="input-group-btn">
                                  <button class="btn btn-default" id="copyButton" type="button" data-toggle="tooltip" data-placement="top" title="Copy shortcode"><i class="fa fa-copy"></i></button>
                              </span>
                          </div>
                      </div>
                    </div>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->


              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Slider type</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <div class="form-group img-radio" id="sliderType">
                    <label class="col-md-3">
                      <input type="radio" class="no-uniform" name="sliderType" value="1" <?php echo $slide->sliderType == 1 ? ' checked' : ''; ?> />
                      <img src="<?=base_url('feast-includes/admin/assets/images/slider/latest.png')?>" class="img-responsive" data-type="type_latest" style="z-index: 500">
                    </label>
                    <label class="col-md-3">
                      <input type="radio" class="no-uniform" name="sliderType" value="2" <?php echo $slide->sliderType == 2 ? ' checked' : ''; ?> />
                      <img src="<?=base_url('feast-includes/admin/assets/images/slider/custom-posts.png')?>" class="img-responsive" data-type="type_cust_post" style="z-index: 500">
                    </label>
                    <label class="col-md-3">
                      <input type="radio" class="no-uniform" name="sliderType" value="3" <?php echo $slide->sliderType == 3 ? ' checked' : ''; ?> />
                      <img src="<?=base_url('feast-includes/admin/assets/images/slider/custom-category.png')?>" class="img-responsive" data-type="type_cust_cat" style="z-index: 500">
                    </label>
                    <label class="col-md-3">
                      <input type="radio" class="no-uniform" name="sliderType" value="4" <?php echo $slide->sliderType == 4 ? ' checked' : ''; ?> />
                      <img src="<?=base_url('feast-includes/admin/assets/images/slider/custom-slider.png')?>" class="img-responsive" data-type="type_cust_slider" style="z-index: 500">
                    </label>
                  </div>

                </div><!-- /.box-body -->
              </div><!-- /.box -->


              <div class="box box-default sliderSource collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Content Source</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">

                  <!-- Latest posts slider options -->
                  <div class="slider-source" id="type_latest" style="display: none;">
                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="postNum">Number of posts</label>
                        <div class="col-md-7">
                          <input type="text" id="postNum" name="sliderSource[postNum]" value="<?=(isset($sliderSource['postNum']) and $slide->sliderType == 1 ) ? $sliderSource['postNum'] : null?>" class="form-control">
                        </div>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="ios-switch switch-md">
                        <label style="padding-left: 0;">
                        <span class="check-label">Post image as slide background&nbsp;</span>
                        <input type="checkbox" class="js-switch" name="sliderSource[postBg]" <?=isset($sliderSource['postBg']) && $sliderSource['postBg'] == 1 ? ' checked' : ''?> value="1">
                        </label>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="image">Static background</label>
                        <div class="col-md-7">
                          <div class="input-group input-group-sm">
                            <input class="form-control iframe-btn" placeholder="<?=feast_line('select_image')?>" type="text" name="sliderSource[staticBg]" value="" id="type_latest_img">
                            <span class="input-group-btn">
                              <a href="#" class="btn btn-danger delete_media" id="type_latest_img" data-toggle="tooltip" data-title="remove" type="button"><i class="fa fa-trash"></i></a>
                              <a href="<?=base_url()?>feast-includes/admin/assets/filemanager/dialog.php?type=1&field_id=type_latest_img" class="btn btn-success iframe-btn" data-toggle="tooltip" data-title="<?=feast_line('select_image')?>" type="button"><i class="fa fa-folder-open"></i></a>
                            </span>
                          </div>
                          <div id="type_latest_img_preview" class="thumbnail" style="margin-top: 10px; display: none">
                            <img src="" class="img-responsive">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="expectPosts">Expect posts</label>
                        <div class="col-md-7">
                          <select type="text" class="form-control input-sm" name="sliderSource[expectPosts][]" multiple="multiple" id="expectPosts" data-tags="true" data-placeholder="Select posts">

                          <?php foreach($posts as $post):?>
                            <option value="<?=post_id($post)?>" <?=isset($sliderSource['expectPosts']) && in_array(post_id($post), $sliderSource['expectPosts']) ? ' selected' : ''?>><?=post_title($post)?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="expectCats">Expect Categories</label>
                        <div class="col-md-7">
                          <select type="text" class="form-control input-sm" name="sliderSource[expectCats][]" multiple="multiple" id="expectCats" data-tags="true" data-placeholder="Select categories">

                          <?php foreach($categories as $category):?>
                            <option value="<?=cat_id($category)?>" <?=isset($sliderSource['expectCats']) && in_array(cat_id($category), $sliderSource['expectCats']) ? ' selected' : ''?>><?=cat_title($category)?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div><!-- /.form-group -->

                  </div><!-- /.slider-source -->

                  <!-- Custom posts slider options -->
                  <div class="slider-source" id="type_cust_post" style="display: none">
                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="custPosts">Select posts</label>
                        <div class="col-md-7">
                          <select type="text" class="form-control input-sm" name="sliderSource[custPosts][]" multiple="multiple" id="custPosts" data-tags="true" data-placeholder="Select posts">
                          <?php foreach($posts as $post):?>
                            <option value="<?=post_id($post)?>" <?=isset($sliderSource['custPosts']) && in_array(post_id($post), $sliderSource['custPosts']) ? ' selected' : ''?>><?=post_title($post)?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="ios-switch switch-md">
                        <label style="padding-left: 0;">
                        <span class="check-label">Post image as slide background&nbsp;</span>
                        <input type="checkbox" class="js-switch" name="sliderSource[postBg]" <?=(isset($sliderSource['postBg']) && $sliderSource['postBg'] == 1) ? ' checked' : ''?> value="1">
                        </label>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="image">Static background</label>
                        <div class="col-md-7">
                          <div class="input-group input-group-sm">
                            <input class="form-control iframe-btn" placeholder="<?=feast_line('select_image')?>" type="text" name="sliderSource[staticBg]" id="type_cust_post_img">
                            <span class="input-group-btn">
                              <a href="#" class="btn btn-danger delete_media" id="type_cust_post_img" data-toggle="tooltip" data-title="remove" type="button"><i class="fa fa-trash"></i></a>
                              <a href="<?=base_url()?>feast-includes/admin/assets/filemanager/dialog.php?type=1&field_id=type_cust_post_img" class="btn btn-success iframe-btn" data-toggle="tooltip" data-title="<?=feast_line('select_image')?>" type="button"><i class="fa fa-folder-open"></i></a>
                            </span>
                          </div>
                          <div id="type_cust_post_img_preview" class="thumbnail" style="margin-top: 10px; display: none">
                            <img src="" class="img-responsive">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.slider-source -->

                  <!-- Custom category slider options -->
                  <div class="slider-source" id="type_cust_cat" style="display: none">
                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="custCats">Select categories</label>
                        <div class="col-md-7">
                          <select type="text" class="form-control input-sm" name="sliderSource[custCats][]" multiple="multiple" id="custCats" data-tags="true" data-placeholder="Select posts">

                          <?php foreach($categories as $cat):?>
                            <option value="<?=cat_id($cat)?>" <?=isset($sliderSource['custCats']) && in_array(cat_id($cat), $sliderSource['custCats']) ? ' selected' : ''?>><?=cat_title($cat)?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="postNum">Number of posts</label>
                        <div class="col-md-7">
                          <input type="text" id="postNum" name="sliderSource[postNum]" value="<?=isset($sliderSource['postNum']) && $slide->sliderType == 3 ? $sliderSource['postNum'] : ''?>" class="form-control">
                        </div>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="ios-switch switch-md">
                        <label style="padding-left: 0;">
                        <span class="check-label">Post image as slide background&nbsp;</span>
                        <input type="checkbox" class="js-switch" name="sliderSource[postBg]" <?=isset($sliderSource['postBg']) && $sliderSource['postBg'] == 1 ? ' checked' : ''?> value="1">
                        </label>
                      </div>
                    </div><!-- /.form-group -->

                    <div class="form-group">
                      <div class="row">
                        <label class="form-label col-md-5" for="image">Static background</label>
                        <div class="col-md-7">
                          <div class="input-group input-group-sm">
                            <input class="form-control iframe-btn" placeholder="<?=feast_line('select_image')?>" type="text" name="sliderSource[staticBg]" id="type_cust_cat_img">
                            <span class="input-group-btn">
                              <a href="#" class="btn btn-danger delete_media" id="type_cust_cat_img" data-toggle="tooltip" data-title="remove" type="button"><i class="fa fa-trash"></i></a>
                              <a href="<?=base_url()?>feast-includes/admin/assets/filemanager/dialog.php?type=1&field_id=type_cust_cat_img" class="btn btn-success iframe-btn" data-toggle="tooltip" data-title="<?=feast_line('select_image')?>" type="button"><i class="fa fa-folder-open"></i></a>
                            </span>
                          </div>
                          <div id="type_cust_cat_img_preview" class="thumbnail" style="margin-top: 10px; display: none">
                            <img src="" class="img-responsive">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div><!-- /.slider-source -->


                  <!-- Custom slider options -->
                  <div class="slider-source" id="type_cust_slider" style="display: none">
                      <button type="button" class="btn btn-lg btn-primary btn-block btn-flat addSlide">
                        <h3 style="margin: 0">
                        <i class="icon-plus" style="clear: both; display: block; margin-bottom: 10px; font-weight: normal; font-size: 26px"></i>
                        New Slide
                        </h3>
                      </button>

                      <hr style="border-style: dashed">

                      <div class="box-group SlidesPlace" id="accordion" role="tablist" aria-multiselectable="false">
                        <?php if($slide->sliderType == 4) { ?>
                        <?php $i = 1; foreach ($sliderSource as $sl): ?>
                          <div class="panel box box-primary">

                            <div class="box-header with-border">
                              <h4 class="box-title" style="display: block">
                                <a href="#<?=$i?>" class="text-primary" style="vertical-align: middle;" data-toggle="collapse" data-parent="#accordion">
                                  Slide <?=$i?>
                                </a>
                                <div class="box-tools pull-right">
                                  <button id="removeSlide" class="btn btn-box-tool" style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Delete this"><i class="fa fa-lg fa-trash"></i></button> 
                                </div>
                                
                              </h4>
                            </div>

                            <div id="<?=$i?>" class="panel-collapse collapse" role="tabpanel">
                              <div class="box-body">

                                <!-- Slide title-->
                                <div class="form-group">
                                  <div class="row">
                                    <label class="form-label col-md-5" for="slideTitle">Slide title</label>
                                    <div class="col-md-7">
                                      <input type="text" name="sliderSource[<?=$i?>][slideTitle]" id="slideTitle" value="<?=$sl['slideTitle']?>" class="form-control">
                                    </div>
                                  </div>
                                </div>

                                <!-- Slide description-->
                                <div class="form-group">
                                  <div class="row">
                                    <label class="form-label col-md-5" for="slideDesc">Slide Description</label>
                                    <div class="col-md-7">
                                      <input type="text" name="sliderSource[<?=$i?>][slideDesc]" id="slideDesc" value="<?=$sl['slideDesc']?>" class="form-control">
                                    </div>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="row">
                                    <label class="form-label col-md-5" for="image">Static background</label>
                                    <div class="col-md-7">
                                      <div class="input-group input-group-sm">
                                        <input class="form-control iframe-btn" placeholder="<?=feast_line('select_image')?>" type="text" value="<?=$sl['slideBg']?>" name="sliderSource[<?=$i?>][slideBg]" id="img_<?=$i?>">
                                        <span class="input-group-btn">
                                          <a href="#" class="btn btn-danger delete_media" id="img_<?=$i?>" data-toggle="tooltip" data-title="remove" type="button"><i class="fa fa-trash"></i></a>
                                          <a href="<?=base_url()?>feast-includes/admin/assets/filemanager/dialog.php?type=1&field_id=img_<?=$i?>" class="btn btn-success iframe-btn" data-toggle="tooltip" data-title="<?=feast_line('select_image')?>" type="button"><i class="fa fa-folder-open"></i></a>
                                        </span>
                                      </div>
                                      <div id="img_<?=$i?>_preview" class="thumbnail" style="margin-top: 10px; display: none">
                                        <img src="" class="img-responsive">
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                <!-- Slide Button text-->
                                <div class="form-group">
                                  <div class="row">
                                    <label class="form-label col-md-5" for="slideBtnT">Slide Button text</label>
                                    <div class="col-md-7">
                                      <input type="text" name="sliderSource[<?=$i?>][slideBtnT]" id="slideBtnT" value="<?=$sl['slideBtnT']?>" class="form-control">
                                    </div>
                                  </div>
                                </div>

                                <!-- Slide Button link -->
                                <div class="form-group">
                                  <div class="row">
                                    <label class="form-label col-md-5" for="slideBtnL">Slide Button link</label>
                                    <div class="col-md-7">
                                      <input type="text" name="sliderSource[<?=$i?>][slideBtnL]" id="slideBtnL" value="<?=$sl['slideBtnL']?>" class="form-control">
                                    </div>
                                  </div>
                                </div>

                                <!-- Slide Button target -->
                                <div class="form-group">
                                  <div class="row">
                                    <label class="form-label col-md-5" for="slideBtnTa">Slide Button target</label>
                                    <div class="col-md-7">
                                      <select type="text" name="sliderSource[<?=$i?>][slideBtnTa]" id="slideBtnTa" class="form-control">
                                        <option value="">Select target</option>
                                        <option value="_self" <?=$sl['slideBtnTa'] == '_self' ? 'selected' : ''?>>Same page</option>
                                        <option value="_blank" <?=$sl['slideBtnTa'] == '_blank' ? 'selected' : ''?>>New page</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>


                              </div>
                            </div>
                          </div>
                        <?php $i++; endforeach; ?>
                        <?php } ?>
                      </div><!-- /.box-group -->


                  </div><!-- /.slider-source -->


                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!-- /.col-lg-8 -->


            <div class="col-lg-4 col-md-5">

              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title <?=($this->session->userdata('site_lang') == 'arabic') ? 'pull-right' : 'pull-left'?>"><?=feast_line('save', 'slider')?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <button class="btn btn-success btn-flat btn-block" type="submit" id="submit"><i class="fa fa-save"></i> Save Slider</button>
                </div><!-- /.box-body -->
              </div><!-- /.box --> 

              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Customize slider</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body customize-slider">

                  <div class="form-group">
                    <div class="ios-switch switch-md">
                        <label style="padding-left: 0;">
                        <span class="check-label">Autoplay&nbsp;</span>
                        <input type="checkbox" class="js-switch" name="customize[autoplay]" <?=isset($sliderCustom['autoplay']) && $sliderCustom['autoplay'] == 1 ? ' checked' : ''?> value="1">
                        </label>
                    </div>
                  </div><!-- /.form-group -->

                  <div class="form-group">
                    <div class="row">
                      <label class="col-md-5" for="autoplay-delay">Autoplay Delay <small class="help-block">in second</small></label>
                      <div class="col-md-7">
                          <input id="autoplay_delay" class="ui-slider" type="text" name="customize[autoplay_delay]" value="<?=isset($sliderCustom['autoplay_delay']) ? $sliderCustom['autoplay_delay'] : 1?>" data-min="1" data-max="20" data-from="<?=isset($sliderCustom['autoplay_delay']) ? $sliderCustom['autoplay_delay'] : 1?>" data-step="1" data-grid="true" data-prefix="s ">
                      </div>
                    </div>
                  </div><!-- /.form-group -->

                  <div class="form-group">
                    <div class="row">
                      <label class="col-md-5" for="effect">Slide effect</label>
                      <div class="col-md-7">
                        <select type="text" data-placeholder="Select slide effect" class="form-control input-sm" name="customize[effect]" id="effect">
                          <option value=""></option>
                          <option value="slide" <?=isset($sliderCustom['effect']) && $sliderCustom['effect'] == 'slide' ? ' selected' : ''?>>slide</option>
                          <option value="goDown" <?=isset($sliderCustom['effect']) && $sliderCustom['effect'] == 'goDown' ? ' selected' : ''?>>goDown</option>
                          <option value="fade" <?=isset($sliderCustom['effect']) && $sliderCustom['effect'] == 'fade' ? ' selected' : ''?>>Fade</option>
                        </select>
                      </div>
                    </div>
                  </div><!-- /.form-group -->

                  <div class="form-group">
                    <div class="ios-switch switch-md">
                        <label style="padding-left: 0;">
                        <span class="check-label">Navigation&nbsp;</span>
                        <input type="checkbox" class="js-switch" name="customize[navigation]" <?=isset($sliderCustom['navigation']) && $sliderCustom['navigation'] == 1 ? ' checked' : ''?> value="1">
                        </label>
                    </div>
                  </div><!-- /.form-group -->

                  <div class="form-group">
                    <div class="ios-switch switch-md">
                        <label style="padding-left: 0;">
                        <span class="check-label">Pagination&nbsp;</span>
                        <input type="checkbox" class="js-switch" name="customize[pagination]" <?=isset($sliderCustom['pagination']) && $sliderCustom['pagination'] == 1 ? ' checked' : ''?> value="1">
                        </label>
                    </div>
                  </div><!-- /.form-group -->

                </div><!-- /.box-body -->
              </div><!-- /.box -->              

            </div><!-- /.col-lg-4 -->

            <!-- Form close -->
            <?=form_close()?>

          </div><!-- /.row -->
                        <?php $hidden['masterLang'] = $this->config->item('translator_masterLang'); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header" style="padding: 10px">
                            <h4 class="box-title">Languages list</h4>
                        </div>
                        <div class="box-body" style="padding: 10px">

                <?php

                /* Forms */

                foreach ( $languages as $language ) { ?>

                	<?echo form_open('admin/translator', '', $hidden );?>

                            <ul class="list-unstyled">
                                <li style="overflow: hidden; display: block; border-bottom: 1px solid #eee;">
                                    <p class="pull-left" style="padding: 6px 0">
                                    <?=$language?>
                                    </p>
                                  <div class="button-group pull-right">
                                    <?=form_hidden('slaveLang', $language);?>
                                    <?=form_submit('submit', 'Update', array('class' => 'btn btn-primary'));?>
                                    <a onClick="javascript:return confirm('Are you shore you want to delete this language ?');" href="<?=base_url('admin/translator/delete/'.$language)?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                  </div>
                                </li>
                            </ul>

                	<?echo form_close();?>

                <?php }

                ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box box-success">
                      <form action="<?=base_url('admin/translator/newlang')?>" method="post" class="form">
                        <div class="box-header" style="padding: 10px">
                            <h4 class="box-title">Create new language</h4>
                        </div>
                        <div class="box-body" style="padding-top: 10px">
                            <div class="form-group" style="margin-bottom: 0;">
                              <input type="text" name="lang" placeholder="Language name" class="form-control" />
                            </div>
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Create</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
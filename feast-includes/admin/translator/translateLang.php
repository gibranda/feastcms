<?php $hidden['masterLang'] = $this->config->item('translator_masterLang'); ?>
        <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="box box-default">
                  <div class="box-body">
                    <?php echo form_open('admin/translator', '', $hidden );?>
                      <table class="table table-striped table-bordered">
                          <thead>
                            <tr>
                              <th class="text-center no-padding no-margin" style="vertical-align: middle;">
                                <div class="pretty info smooth">
                                  <input type="checkbox" name="checkAll" id="dt-select-all" value="1"> 
                                  <label><i class="fa fa-check"></i></label>
                                </div>
                              </th>
                              <th>Key</th>
                              <th><?=ucwords( $masterLang )?></th>
                              <th><?=ucwords( $slaveLang )?></th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php
                            $i = 1;
                            foreach ( $moduleData as $key => $line ) { ?>
                          	<tr>
                              <td class="text-center"><?=$i?></td>
                            	<td><?=$key?></td>
                            	<td><?=htmlspecialchars( $line[ 'master' ] )?></td>
                              <td>
                              <?php if ( mb_strlen( $line[ 'slave' ] ) > $textarea_line_break ) {
                            	echo form_textarea( array( 'name' => $postUniquifier . $key, 
                                'value' => $line[ 'slave' ], 
                                'rows' => $textarea_rows
                                )
                              );
                            	} else {
                            	echo form_input( $postUniquifier . $key, $line[ 'slave' ] );
                            	} ?>

                            	<?php if ( strlen( $line[ 'error' ] ) > 0 ) { ?>
                            	<br /><span class="text-danger"><?=$line[ 'error' ]?></span>
                              <?php } ?>

                            	<?php if ( strlen( $line[ 'note' ] ) > 0 ) { ?>
                            		<br /><span class="text-info"><?=$line[ 'note' ]?></span>
                              <?php } ?>

                            	</td>
                          	</tr>
                            <?php $i++;
                            }
                            ?>
                          </tbody>

                      </table>

                      <?php

                      echo form_submit('ConfirmSaveLang', 'Save', array('class' => 'btn btn-success') );

                      echo form_close();

                      ?>
                  </div>
              </div>
          </div>
        </div>
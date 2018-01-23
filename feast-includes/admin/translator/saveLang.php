<?php $hidden['masterLang'] = $this->config->item('translator_masterLang'); ?>
      <div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="box box-default">
                  <div class="box-body">
                    <?php echo form_open('admin/translator', '', $hidden );?>
                    <div class="table-responsive">
                      <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                          <thead>
                            <tr>
                            <th class="translator_table_header">Key</th>
                            <th class="translator_table_header"><?=ucwords( $masterLang )?></th>
                            <th class="translator_table_header"><?=ucwords( $slaveLang )?></th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php

                            foreach ( $moduleData as $key => $line ) {
                            	echo '<tr>';
                            	echo '<td>' . $key . '</td>';
                            	echo '<td>' . htmlspecialchars( $line['master'] ) . '</td>';
                            	echo '<td>' . htmlspecialchars( $line['slave'] ) . '</td>';
                            	echo '</tr>';
                            }

                            ?>
                          </tbody>

                      </table>

                    </div>

                      <?php

                      echo form_submit('ConfirmSaveLang', 'Confirm' );

                      echo form_close();

                      ?>
                  </div>
              </div>
          </div>
    </div>
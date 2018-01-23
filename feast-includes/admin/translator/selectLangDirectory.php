<?php $hidden['masterLang'] = $this->config->item('translator_masterLang'); ?>
<div class="row">
	<div class="col-md-12">
	    <div class="box box-default">
	        <div class="box-body">

	<?php

	/* Forms */

	foreach ( $langdirs as $langdir ) {
		
		echo form_open('admin/translator');
		
		echo form_submit('langDir', $langdir, array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px'));
		
		echo form_close();
		
	}

	?>

	        </div>
	    </div>
	</div>
</div>
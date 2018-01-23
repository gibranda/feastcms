<?php $hidden['masterLang'] = $this->config->item('translator_masterLang'); ?>
<div class="row">
	<div class="col-md-12">
	    <div class="box box-default">
	        <div class="box-body">

	<?php

	/* Forms */

	foreach ( $languages as $language ) {
		
		echo form_open('admin/translator', '', $hidden );
		
		echo form_submit('masterLang', $language, array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px'));
		
		echo form_close();

	}

	?>

	        </div>
	    </div>
	</div>
</div>
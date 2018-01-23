<?php $hidden['masterLang'] = $this->config->item('translator_masterLang'); ?>
<div class="row">
	<div class="col-md-12">
	    <div class="box box-default">
	        <div class="box-body">

	<?php

	/* Forms */

	foreach ( $masterModules as $masterModule ) {
		
		echo form_open('admin/translator', '', $hidden );
		
		echo form_submit('langModule', $masterModule, array('class' => 'btn btn-primary', 'style' => 'margin-bottom: 15px') );
		
		if ( ! in_array( $masterModule, $slaveModules ) ) {
			echo $slaveLang . " module not found";
		}
		
		echo form_close();
		
	}

	?>

	        </div>
	    </div>
	</div>
</div>
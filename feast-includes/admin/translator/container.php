<?php $hidden = array('masterLang' => config_item('translator_masterLang')); ?>
<div class="row">
	<div class="col-lg-12 col-md-12">
	    <div class="box box-default">
	        <div class="box-body">

	            <?php $this->load->view($page_content); ?>

	        </div>
	    </div>
	</div>
</div>

<?php
// 
if(!isset($options['page_comments'])) {
	echo admin_post_option('page_comments', 'Enable comments', 'checkbox');
}

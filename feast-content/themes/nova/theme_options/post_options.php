<?php
// 
if(!isset($options['post_comments'])) {
	echo admin_post_option('post_comments', 'Enable comments', 'checkbox');
}

<?php
function options()
{
    if(is_option('bootstrap_theme') == FALSE){add_option('bootstrap_theme', 'flatly');}
    if(is_option('home_slider') == FALSE){add_option('home_slider', '');}
    if(is_option('slider_type') == FALSE){add_option('slider_type', '');}
    if(is_option('post_comments') == FALSE){add_option('post_comments', 1);}
    if(is_option('page_comments') == FALSE){add_option('page_comments', 0);}
    if(is_option('posts_per_page') == FALSE){add_option('posts_per_page', 2);}
    if(is_option('home_posts_num') == FALSE){add_option('home_posts_num', 8);}
    if(is_option('posts_layout') == FALSE){add_option('posts_layout', 1);}
    if(is_option('site_sidebar') == FALSE){add_option('site_sidebar', 1);}
}

options();

?>
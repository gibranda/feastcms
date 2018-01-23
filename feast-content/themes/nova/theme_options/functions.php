<?php
function options()
{

    // General options
    if(is_option('home_slider') == FALSE){add_option('home_slider', '');}
    if(is_option('post_comments') == FALSE){add_option('post_comments', 1);}
    if(is_option('page_comments') == FALSE){add_option('page_comments', 0);}
    if(is_option('posts_per_page') == FALSE){add_option('posts_per_page', 2);}
    if(is_option('category_per_page') == FALSE){add_option('category_per_page', 2);}
    if(is_option('portfolio_per_page') == FALSE){add_option('portfolio_per_page', 4);}
    if(is_option('site_sidebar') == FALSE){add_option('site_sidebar', 1);}

    // Menus options
    if(is_option('nova_main_menu') == FALSE){add_option('nova_main_menu', '');}
    if(is_option('nova_sidebar_title') == FALSE){add_option('nova_sidebar_title', '');}
    if(is_option('nova_sidebar_menu') == FALSE){add_option('nova_sidebar_menu', '');}
    if(is_option('nova_footer_menu1') == FALSE){add_option('nova_footer_menu1', '');}
    if(is_option('nova_footer_title1') == FALSE){add_option('nova_footer_title1', '');}
    if(is_option('nova_footer_menu2') == FALSE){add_option('nova_footer_menu2', '');}
    if(is_option('nova_footer_title2') == FALSE){add_option('nova_footer_title2', '');}

    // Advertizing options
    if(is_option('nova_adv_url1') == FALSE){add_option('nova_adv_url1', '');}
    if(is_option('nova_adv_img1') == FALSE){add_option('nova_adv_img1', '');}
    if(is_option('nova_adv_url2') == FALSE){add_option('nova_adv_url2', '');}
    if(is_option('nova_adv_img2') == FALSE){add_option('nova_adv_img2', '');}
    if(is_option('nova_adv_url3') == FALSE){add_option('nova_adv_url3', '');}
    if(is_option('nova_adv_img3') == FALSE){add_option('nova_adv_img3', '');}
    if(is_option('nova_adv_url4') == FALSE){add_option('nova_adv_url4', '');}
    if(is_option('nova_adv_img4') == FALSE){add_option('nova_adv_img4', '');}
}

options();

?>
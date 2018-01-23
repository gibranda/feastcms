<?php
function options()
{

    // General options
    if(is_option('post_comments') == FALSE){add_option('post_comments', 1);}
    if(is_option('page_comments') == FALSE){add_option('page_comments', 0);}
    if(is_option('posts_per_page') == FALSE){add_option('posts_per_page', 2);}
    if(is_option('search_per_page') == FALSE){add_option('search_per_page', 15);}
    if(is_option('category_per_page') == FALSE){add_option('category_per_page', 2);}
    if(is_option('portfolio_per_page') == FALSE){add_option('portfolio_per_page', 4);}
    if(is_option('sidebar_position') == FALSE){add_option('sidebar_position', 'right');}

    // Header options
    if(is_option('themeone_header_layout') == FALSE){add_option('themeone_header_layout', 'slider');}
    if(is_option('themeone_header_fullscreen') == FALSE){add_option('themeone_header_fullscreen', '1');}
    if(is_option('themeone_textrotate') == FALSE){add_option('themeone_textrotate', 'FeastCMS,Fully customizable,Awesome features');}
    if(is_option('themeone_textrotate_title') == FALSE){add_option('themeone_textrotate_title', 'We are');}
    if(is_option('themeone_textrotate_image') == FALSE){add_option('themeone_textrotate_image', '');}
    if(is_option('themeone_header_image') == FALSE){add_option('themeone_header_image', '');}
    if(is_option('themeone_header_image_title') == FALSE){add_option('themeone_header_image_title', '');}
    if(is_option('themeone_header_image_text') == FALSE){add_option('themeone_header_image_text', '');}
    if(is_option('home_slider') == FALSE){add_option('home_slider', '');}


    // Blog layouts
    if(is_option('themeone_blog_layout') == FALSE){add_option('themeone_blog_layout', 'classic-right');}
    if(is_option('themeone_category_layout') == FALSE){add_option('themeone_category_layout', '2cols-sidebar');}
    if(is_option('themeone_search_layout') == FALSE){add_option('themeone_search_layout', '4cols');}
    if(is_option('themeone_portfolio_layout') == FALSE){add_option('themeone_portfolio_layout', '4cols');}
    if(is_option('themeone_portfolio_gutter') == FALSE){add_option('themeone_portfolio_gutter', '0');}
    if(is_option('themeone_portfolio_boxed') == FALSE){add_option('themeone_portfolio_boxed', '0');}
    
    // Pages header
    if(is_option('themeone_blog_text') == FALSE){add_option('themeone_blog_text', '');}
    if(is_option('themeone_category_text') == FALSE){add_option('themeone_category_text', '');}
    if(is_option('themeone_portfolio_text') == FALSE){add_option('themeone_portfolio_text', '');}
    if(is_option('themeone_search_text') == FALSE){add_option('themeone_search_text', '');}


    // Menus options
    if(is_option('themeone_main_menu') == FALSE){add_option('themeone_main_menu', '');}
    if(is_option('themeone_sidebar_title') == FALSE){add_option('themeone_sidebar_title', '');}
    if(is_option('themeone_sidebar_menu') == FALSE){add_option('themeone_sidebar_menu', '');}
    if(is_option('sidebar_widget_title') == FALSE){add_option('sidebar_widget_title', '');}
    if(is_option('sidebar_widget_content') == FALSE){add_option('sidebar_widget_content', '');}
    if(is_option('footer_widget_title') == FALSE){add_option('footer_widget_title', '');}
    if(is_option('footer_widget_content') == FALSE){add_option('footer_widget_content', '');}

}

options();

?>
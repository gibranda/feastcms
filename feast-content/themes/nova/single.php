    <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1>Blog Item</h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url()?>"><?=feast_line('home')?></a> <span class="divider">/</span></li>
                        <li><a href="<?=base_url('posts')?>"><?=feast_line('blog')?></a> <span class="divider">/</span></li>
                        <li class="active"><?=post_title($post)?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title --> 

    <section id="about-us" class="container">
        <div class="row-fluid">
            <div class="<?=(get_option('site_sidebar') == 1 && $post->sidebar == 1) ? 'span8' : 'span12'?>">
                <div class="blog">
                    <div class="blog-item well">
                        <a href="#"><h2><?=post_title($post)?></h2></a>
                        <div class="blog-meta clearfix">
                            <p class="pull-left">
                              <i class="icon-user"></i> by <a href="#"><?=post_author($post)?></a> | <i class="icon-folder-close"></i> Category <a href="#"><?=post_category($post)?></a> | <i class="icon-calendar"></i> <?=post_date($post)?>
                          </p>
                          <p class="pull-right"><i class="icon-comment pull"></i> <a href="#comments"><?=count_comments($post)?> Comments</a></p>
                      </div>
                      <p><img src="<?=post_image($post)?>" width="100%" alt="<?=post_title($post)?>" /></p>
                      
                      <?=post_body($post)?>                     

                    <p>&nbsp;</p>
                    
                    <div id="comments" class="comments">

                    <?php 

                    echo show_comments();

                    ?>

                    </div>
                    
                    <hr>

                    <?php
                      if(get_option('post_comments') == "1" && post_option('post_comments', $post) == 1) {

                        echo comment_box( post_id($post), 'comment-form', 'input-block-level', 'span' );

                      } 
                    ?>

                </div>
                <!-- End Blog Item -->

            </div>
        </div>

      <?php if(get_option('site_sidebar') == 1 && $post->sidebar == 1) { ?>
      <!-- include sidebar -->
      <?php load_template('includes/sidebar'); ?>
      <?php } ?>      

    </div>

</section>
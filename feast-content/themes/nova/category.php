    <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1><?=cat_title($category)?></h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url()?>"><?=feast_line('home')?></a> <span class="divider">/</span></li>
                        <li><a href="<?=base_url('posts')?>"><?=feast_line('blog')?></a> <span class="divider">/</span></li>
                        <li class="active"><?=cat_title($category)?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->         

    <section id="about-us" class="container main">
        <div class="row-fluid">
            <div class="span8">
                <div class="blog">

                <?php foreach($posts as $post): ?>
                    <div class="blog-item well">
                        <a href="<?=post_url($post)?>"><h2><?=post_title($post)?></h2></a>
                        <div class="blog-meta clearfix">
                            <p class="pull-left">
                              <i class="icon-user"></i> by <a href="#"><?=post_author($post)?></a> | <i class="icon-folder-close"></i> Category <a href="#"><?=post_category($post)?></a> | <i class="icon-calendar"></i> <?=post_date($post)?>
                          </p>
                          <p class="pull-right"><i class="icon-comment pull"></i> <a href="<?=post_url($post)?>#comments"><?=count_comments($post)?> Comments</a></p>
                      </div>
                      <p><img src="<?=post_thumb($post, 'wide')?>" width="100%" alt="" /></p>
                      <p><?=post_excerpt($post, NULL, 80)?></p>
                      <a class="btn btn-link" href="<?=post_url($post)?>">Read More <i class="icon-angle-right"></i></a>
                  </div>
                  <!-- End Blog Item -->
                <?php endforeach; ?>



              <div class="gap"></div>

            <div class="pagination">
                <!-- Pager -->
                <?=$this->pagination->create_links();?>
            </div>

        </div>
    </div>

      <?php if(get_option('site_sidebar') == 1) { ?>
      <!-- include sidebar -->
      <?php load_template('includes/sidebar'); ?>
      <?php } ?>

</div>

</section>
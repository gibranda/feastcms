    <div id="main" class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header" style="margin-top: 0">
                    <?=feast_line('all', feast_line('posts'))?></small>
                </h1>

              <?php foreach(list_posts(get_option('posts_per_page'), uri_segment(2)) as $post): ?>

                <div class="col-md-12" style="padding-left: 0; padding-right: 0">
                    <div class="col-sm-4 col-md-4" style="padding-left: 0;">
                        <img class="img-responsive" src="<?=post_thumb($post, 'medium')?>" alt="<?=post_title($post)?>">
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <!-- Blog Post -->
                        <h2 style="margin-top: 0">
                            <a href="<?=post_url($post)?>"><?=post_title($post)?></a>
                        </h2>
                        <p class="small home-post-info">
                            <!-- Author -->
                             <i class="glyphicon glyphicon-user"></i> <a href="#"><?=post_author($post)?></a>
                            <!-- Date/time -->
                             <i class="glyphicon glyphicon-time"></i> <?=post_date($post)?>
                            <!-- Category -->
                             <i class="glyphicon glyphicon-tag"></i> <a href="<?=base_url('category/'.$post->category_id.'/'.$post->category)?>"><?=post_category($post)?></a>
                        </p>
                        <p><?=post_excerpt($post, Null, 40)?></p>
                        <a class="btn btn-primary" href="<?=post_url($post)?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>            
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                </div>
              <?php endforeach; ?>

                <!-- Pager -->
                <?=$this->pagination->create_links();?>

            </div>

            <!-- include sidebar -->
            <?php load_template('includes/sidebar'); ?>

          </div>
    </div>

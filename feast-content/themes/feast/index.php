    <div id="main" class="container">
        <!-- include slider -->
        <?php load_template('includes/slider'); ?>
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-<?=get_option('site_sidebar') == 1 ? '8' : '12'?>">

                <h1 class="page-header" style="margin-top: 0">
                    <?=feast_line('latest_posts')?>
                </h1>

                <div class="home_posts" style="min-height: 400px;">
                <?php 
                switch(get_option('posts_layout')) {
                    case 1:
                        $layout = 'blog-1cols';
                        break;
                    case 2:
                        $layout = 'blog-2cols';
                        break;
                    case 3:
                        $layout = 'blog-3cols';
                        break;
                } 
                ?>
              <?php foreach(list_posts(get_option('home_posts_num'), 0) as $post): ?>

                <?php load_template('includes/'.$layout, array('post' => $post)); ?>

              <?php endforeach; ?>
              <?=count( list_posts(get_option('home_posts_num'), 0) ) > 0 ? null : '<div class="alert alert-info"><strong>There is no posts</strong></div>'?>
              </div>
                <hr>

                <div class="col-md-12">
                    <h3 class="page-header"><?=feast_line('contact')?></h3>
                    <?=contact_form()?>
                </div>

            </div>

            <!-- include sidebar -->
            <?php 
            if(get_option('site_sidebar') == 1) {
                load_template('includes/sidebar'); 
            }
            ?>
        </div>
    </div>
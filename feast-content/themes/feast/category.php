    <div id="main" class="container">
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header" style="margin-top: 0">
                    <?=cat_title($category)?> <small class="badge badge-info"><?=count(list_posts(null, 0, uri_segment(2)))?></small>
                </h1>

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

              <?php foreach(list_posts(get_option('posts_per_page'), uri_segment(4), uri_segment(2)) as $post): ?>

                <?php load_template('includes/'.$layout, array('post' => $post)); ?>

              <?php endforeach; ?>

                <!-- Pager -->
                <?=$this->pagination->create_links();?>

            </div>

            <!-- include sidebar -->
            <?php load_template('includes/sidebar'); ?>

          </div>
    </div>
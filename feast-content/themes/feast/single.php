  <div id="main" class="container">
      <div class="row">

      <div class="<?=(get_option('site_sidebar') == 1 && $post->sidebar == 1) ? 'col-md-8' : 'col-md-12'?>">

          <!-- Blog Post -->

          <!-- Title -->
          <h1 class="page-header"><?=post_title($post)?></h1>
          <!-- Preview Image -->
          <img class="img-responsive" src="<?=post_image($post)?>" alt="">
          <hr>

          <!-- Author -->
          <p class="small post-info">
            <!-- Author -->
             <i class="glyphicon glyphicon-user"></i> <a href="#"><?=post_author($post)?></a>
            <!-- Date/time -->
             <i class="glyphicon glyphicon-time"></i> <?=post_date($post)?>
            <!-- Category -->
             <i class="glyphicon glyphicon-tag"></i> <a href="<?=base_url('category/'.$post->category_id.'/'.$post->category)?>"><?=post_category($post)?></a>
          </p>

          <!-- Post Content -->
          <p class="lead"><?=post_body($post)?></p>

      <?php 
      if(get_option('post_comments') == "1" && post_option('post_comments', $post) == 1) {

        echo comment_box( post_id($post) );
          
        echo show_comments();

      } 
      ?>

      </div>

      <?php if(get_option('site_sidebar') == 1 && $post->sidebar == 1) { ?>
      <!-- include sidebar -->
      <?php load_template('includes/sidebar'); ?>
      <?php } ?>
      </div>
  </div>

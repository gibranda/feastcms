  <div id="main" class="container">
      <div class="row">

      <div class="<?=(get_option('site_sidebar') == 1 && $page->sidebar == 1) ? 'col-md-8' : 'col-md-12'?>">

          <!-- Blog Post -->

          <!-- Title -->
          <h1 class="page-header"><?=post_title($page)?></h1>

          <!-- Post Content -->
          <p class="lead"><?=post_body($page)?></p>

      <?php 
      if(get_option('page_comments') == 1 && post_option('page_comments', $page) == 1) {

        echo comment_box( post_id($page) );
          
        echo show_comments();

      } 
      ?>

      </div>

      <?php if(get_option('site_sidebar') == 1 && $page->sidebar == 1) { ?>
      <!-- include sidebar -->
      <?php load_template('includes/sidebar'); ?>
      <?php } ?>
      </div>
  </div>
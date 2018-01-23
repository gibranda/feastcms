      <div class="main">
        <section class="module-small">
          <div class="container">
            <div class="row">
              <div class="col-sm-8">
                <div class="post">
                  <div class="post-thumbnail"><img src="<?=post_image($post)?>" alt="<?=post_title($post)?>"/></div>
                  <div class="post-header font-alt">
                    <h1 class="post-title"><?=post_title($post)?></h1>
                    <div class="post-meta">By&nbsp;<a href="#"><?=post_author($post)?></a>| <?=post_date($post)?> | <?=count_comments($post)?> Comments | <a href="<?=post_cat_url($post)?>"><?=post_category($post)?></a>
                    </div>
                  </div>
                  <div class="post-entry">
                    <?=post_body($post)?>
                  </div>
                </div>
                <!-- comments -->
                <?=show_comments()?>

                <!-- comment form -->
                  <?=comment_box( post_id($post) )?>
                  
              </div>
              
              <?php load_template('includes/sidebar'); ?>

            </div>
          </div>
        </section>
      <div class="main">

        <?php if(is_home() == FALSE) { ?>

        <section class="module bg-dark-60 about-page-header parallax-bg" data-background="<?=post_image($page)?>">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt"><?=post_title($page)?></h2>
                <div class="module-subtitle font-serif"><?=post_excerpt($page, NULL, 20)?></div>
              </div>
            </div>
          </div>
        </section>
        <?=post_body($page)?>
        <?php } else { echo post_body($page); } ?>
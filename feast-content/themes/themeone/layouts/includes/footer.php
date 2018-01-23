        <div class="module-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt"><?=get_option('footer_widget_title')?></h5>
                  <?=get_option('footer_widget_content')?>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Recent Comments</h5>
                  <ul class="icon-list">
                  <?php foreach (latest_comments(5) as $footercomment): ?>
                    <li><?=comment_username($footercomment)?> on <a href="<?=comment_post_url($footercomment)?>/#comments"><?=comment_post($footercomment)?></a></li>
                  <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Blog Categories</h5>
                  <ul class="icon-list">
                  <?php foreach(list_cats() as $footercat): ?>
                    <li><a href="<?=cat_url($footercat)?>"><?=cat_title($footercat)?> - <?=count(list_posts(null, 0, $footercat->id))?></a></li>
                  <?php endforeach; ?>
                  </ul>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Popular Posts</h5>
                  <ul class="widget-posts">

                  <?php foreach(list_posts(2) as $footerpost): ?>
                    <li class="clearfix">
                      <div class="widget-posts-image"><a href="<?=post_url($footerpost)?>"><img src="<?=post_thumb($footerpost, 'small')?>" alt="<?=post_title($footerpost)?>"/></a></div>
                      <div class="widget-posts-body">
                        <div class="widget-posts-title"><a href="<?=post_url($footerpost)?>"><?=post_title($footerpost)?></a></div>
                        <div class="widget-posts-meta"><?=post_date($footerpost)?></div>
                      </div>
                    </li>
                  <?php endforeach; ?>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="divider-d">
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <p class="copyright font-alt">RG93bmxvYWRlZCBmcm9tIENPREVMSVNULkND</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    <!--  
    JavaScripts
    =============================================
    -->
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/wow/dist/wow.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/smoothscroll.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/js/plugins.js"></script>
    <script src="<?php echo theme_folder('themeone'); ?>assets/js/main.js"></script>

    <script type="text/javascript">
      $('.main .home-section').each(function() {
        $(this).insertBefore($(this).parent('.main'));
      });      
    </script>
  </body>
</html>
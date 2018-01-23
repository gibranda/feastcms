                <div class="post">
                  <div class="post-thumbnail"><a href="<?=post_url($post)?>"><img src="<?=post_image($post)?>" alt="<?=post_title($post)?>" class="img-responsive"/></a></div>
                  <div class="post-header font-alt">
                    <h2 class="post-title"><a href="<?=post_url($post)?>"><?=post_title($post)?></a></h2>
                    <div class="post-meta">By&nbsp;<a href="#"><?=post_author($post)?></a>| <?=post_date($post)?> | <?=count_comments($post)?> comments | <a href="<?=post_cat_url($post)?>"><?=post_category($post)?></a>
                    </div>
                  </div>
                  <div class="post-entry">
                    <p><?=post_excerpt($post, NULL, 80)?></p>
                  </div>
                  <div class="post-more"><a class="more-link" href="<?=post_url($post)?>">Read more</a></div>
                </div>
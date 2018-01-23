                  <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="post">
                      <div class="post-thumbnail"><a href="<?=post_url($post)?>"><img src="<?=post_thumb($post, 'medium')?>" alt="<?=post_title($post)?>"/></a></div>
                      <div class="post-header font-alt">
                        <h2 class="post-title"><a href="<?=post_url($post)?>"><?=post_title($post)?></a></h2>
                        <div class="post-meta">By&nbsp;<a href="#"><?=post_author($post)?></a>&nbsp;| <?=post_date($post)?> | <?=count_comments($post)?> Comments
                        </div>
                      </div>
                      <div class="post-entry">
                        <p><?=post_excerpt($post, NULL, 30)?></p>
                      </div>
                      <div class="post-more"><a class="more-link" href="<?=post_url($post)?>">Read more</a></div>
                    </div>
                  </div>

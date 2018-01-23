                <div class="widget">
                  <h5 class="widget-title font-alt"><?=feast_line('latest_posts')?></h5>
                  <ul class="widget-posts">

                    <?php foreach(list_posts(5) as $sidebarPost): ?>
                    <li class="clearfix">
                      <div class="widget-posts-image"><a href="<?=post_url($sidebarPost)?>"><img src="<?=post_thumb($sidebarPost, 'small')?>" alt="Post Thumbnail"/></a></div>
                      <div class="widget-posts-body">
                        <div class="widget-posts-title"><a href="<?=post_url($sidebarPost)?>"><?=post_title($sidebarPost)?></a></div>
                        <div class="widget-posts-meta"><?=post_date($sidebarPost)?></div>
                      </div>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
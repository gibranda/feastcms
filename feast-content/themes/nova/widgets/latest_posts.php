        <div class="widget widget-popular">
            <h3><?=feast_line('latest_posts')?></h3>
            <div class="widget-blog-items">

            <?php foreach(list_posts(5) as $sidebarPost): ?>
                <div class="widget-blog-item media">
                    <div class="pull-left">
                        <div class="date">
                            <span class="month"><?=date('M', strtotime($sidebarPost->created))?></span>
                            <span class="day"><?=date('d', strtotime($sidebarPost->created))?></span>
                        </div>
                    </div>
                    <div class="media-body">
                        <a href="<?=post_url($sidebarPost)?>"><h5><?=post_title($sidebarPost)?></h5></a>
                        <p class="post-meta">
                        <i class="icon-folder-close"></i> <a href="<?=post_cat_url($sidebarPost)?>"><?=post_category($sidebarPost)?></a> | 
                        <i class="icon-comment pull"></i> <a href="<?=post_url($sidebarPost)?>#comments"><?=count_comments($sidebarPost)?> Comments</a>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>                        
        </div>
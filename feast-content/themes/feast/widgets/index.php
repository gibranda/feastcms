<!-- Latest posts -->
<div class="widget widget-posts">
    <div class="widget-title">
        <h5><?=feast_line('latest_posts')?></h5>
    </div>
    <div class="widget-content">

        <?php foreach($posts as $post): ?>

        <div class="item">
            <img src="<?=post_thumb($post, 'small')?>" width="50" height="50" alt="<?=post_title($post)?>">
            <div class="item-desc">
                <div class="item-title">
                    <a href="<?=post_url($post)?>"><?=post_title($post)?>.</a>
                </div>  
                <div class="item-meta">
                    <span>by: <a href="<?=base_url('account/profile/' . $post->user_id)?>"> <?=post_author($post)?></a></span><span class="slash"> / </span>
                    <span>on: <a href="<?=post_url($post)?>"><?=post_date($post)?></a></span>
                </div>
            </div>      
        </div>

        <?php endforeach; ?>

    </div>
</div>
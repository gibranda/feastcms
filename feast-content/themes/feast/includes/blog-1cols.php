        <div class="row post-item col-1">
            <div class="col-md-5">
                <a href="<?=post_url($post)?>">
                    <img class="img-responsive" data-wide="<?=post_thumb($post, 'wide')?>" src="<?=post_thumb($post, 'large')?>" alt="<?=post_title($post)?>">
                </a>
            </div>
            <div class="col-md-7">
                <h3><?=post_title($post)?></h3>
                <p <?=is_arabic( post_excerpt($post, null, 50) ) ? ' class="text-right"' : ' class="text-left"'?>><?=post_excerpt($post, null, 50)?></p>
                <a class="btn btn-primary" href="<?=post_url($post)?>">Read more <span class="glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>
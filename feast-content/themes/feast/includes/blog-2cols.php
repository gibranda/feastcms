
            <div class="col-md-6 post-item">
                <a href="<?=post_url($post)?>">
                    <img class="img-responsive" data-wide="<?=post_thumb($post, 'wide')?>" src="<?=post_thumb($post, 'medium')?>" alt="<?=post_title($post)?>">
                </a>
                <h3>
                    <a href="<?=post_url($post)?>"><?=post_title($post)?></a>
                </h3>
                <p <?=is_arabic( post_excerpt($post, null, 20) ) ? ' class="text-right"' : ' class="text-left"'?>><?=post_excerpt($post, null, 20)?></p>
            </div>

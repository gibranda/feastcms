<!-- Categories -->
<div class="widget widget-categories">
    <div class="widget-title">
        <h5><?=feast_line('categories')?></h5>
    </div>
    <div class="widget-content">
        <ul class="list-unstyled" style="margin-bottom: 0">
        <?php foreach($categories as $cat): ?>
            <li>
                <a href="<?=cat_url($cat)?>"><i class="glyphicon glyphicon-menu-right"></i><?=cat_title($cat)?><span>(<?=count(list_posts(null, 0, $cat->id))?>)</span></a>
            </li>  
        <?php endforeach; ?>
        </ul>
    </div>
</div>
    <aside class="span4">
        <div class="widget search">
            <?=form_open(base_url('posts/search'))?>
                <input type="text" name="text" class="input-block-level" placeholder="Type something and hit Enter">
            <?=form_close()?>
        </div>
        <!-- /.search -->

        <div class="widget ads">
            <div class="row-fluid">
                <?php if(is_option('nova_adv_url1') && get_option('nova_adv_url1') !== '') { ?>
                <div class="span6">
                    <a href="<?=get_option('nova_adv_url1')?>"><img src="<?=get_option('nova_adv_img1')?>" alt=""></a>
                </div>
                <?php } ?>

                <?php if(is_option('nova_adv_url2') && get_option('nova_adv_url2') !== '') { ?>
                <div class="span6">
                    <a href="<?=get_option('nova_adv_url2')?>"><img src="<?=get_option('nova_adv_img2')?>" alt=""></a>
                </div>
                <?php } ?>
            </div>
            <p> </p>
            <div class="row-fluid">
                <?php if(is_option('nova_adv_url3') && get_option('nova_adv_url3') !== '') { ?>
                <div class="span6">
                    <a href="<?=get_option('nova_adv_url3')?>"><img src="<?=get_option('nova_adv_img3')?>" alt=""></a>
                </div>
                <?php } ?>

                <?php if(is_option('nova_adv_url4') && get_option('nova_adv_url4') !== '') { ?>
                <div class="span6">
                    <a href="<?=get_option('nova_adv_url4')?>"><img src="<?=get_option('nova_adv_img4')?>" alt=""></a>
                </div>
                <?php } ?>

            </div>
        </div>
        <!-- /.ads -->

        <?=$this->widget->latest_posts(5)?>
        <!-- End Popular Posts -->        

        <?=$this->widget->list_cats()?>
        <!-- End Category Widget -->

    </aside>
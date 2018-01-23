    <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1><?=feast_line('portfolio')?></h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url()?>"><?=feast_line('home')?></a> <span class="divider">/</span></li>
                        <li class="active"><?=feast_line('portfolio')?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->     

    <section id="portfolio" class="container main">    
        <ul class="gallery col-4">

        <?php $i = 1; foreach(list_works(get_option('portfolio_per_page'), uri_segment(3)) as $work): ?>
            <!--Item 1-->
            <li>
                <div class="preview">
                    <img alt="<?=post_title($work)?>" src="<?=post_thumb($work, 'medium')?>">
                    <div class="overlay">
                    </div>
                    <div class="links text-center">
                        <a data-toggle="modal" href="#modal-<?=$i?>"><i class="icon-eye-open"></i></a>                                
                    </div>
                </div>
                <div class="desc">
                    <h5><?=post_title($work)?></h5>
                    <small><?=post_category($work)?></small>
                </div>
                <div id="modal-<?=$i?>" class="modal hide fade">
                    <a class="close-modal" href="javascript:;" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></a>
                    <div class="modal-body">
                        <img src="<?=post_image($work)?>" alt="<?=post_title($work)?>" width="100%" style="max-height:400px">
                    </div>
                </div>                 
            </li>
            <!--/Item 1--> 
        <?php $i++; endforeach; ?>               

        </ul>

        
    </section>

        </div>
    </section>

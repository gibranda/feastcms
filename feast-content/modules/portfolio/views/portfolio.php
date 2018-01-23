
    <section id="top_banner">
        <div class="banner">
            <div class="inner text-center">
                <h2><?=feast_line('portfolio')?></h2>
            </div>
        </div>
        <div class="page_info">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-6">
                        <h4><?=feast_line('portfolio')?></h4>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-6" style="text-align:right;">Home<span class="sep"> / </span><span class="current"><?=feast_line('portfolio')?></span></div>
                </div>
            </div>
        </div>

        </div>
    </section>



    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="section-heading text-center">
                    <div class="col-md-12 col-xs-12">
                        <h1>Our <span>Latest Work</span></h1>
                        <p class="subheading">Lorem ipsum dolor sit amet sit legimus copiosae instructior ei ut vix denique fierentis ea saperet inimicu ut qui dolor oratio mnesarchum ea utamur impetus fuisset nam nostrud euismod volumus ne mei.</p>
                    </div>
                </div>
            </div>
            <div class="row">

              <?php foreach(list_works(get_option('posts_per_page'), uri_segment(2)) as $work): ?>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 portfolio-item">
                    <div class="portfolio-one">
                        <div class="portfolio-head">
                            <div class="portfolio-img"><img alt="" src="<?=post_thumb($work, 'medium')?>"></div>
                            <div class="portfolio-hover">
                                <a class="portfolio-link" href="#"><i class="fa fa-link"></i></a>
                                <a class="portfolio-zoom" href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <!-- End portfolio-head -->
                        <div class="portfolio-content">
                            <h5 class="title"><?=post_title($work)?></h5>
                            <p><?=post_excerpt($work, Null, 30)?></p>
                        </div>
                        <!-- End portfolio-content -->
                    </div>
                    <!-- End portfolio-item -->
                </div>
              <?php endforeach; ?>

            </div>

            <!-- Pager -->
            <?=$this->pagination->create_links();?>


        </div>
    </section>

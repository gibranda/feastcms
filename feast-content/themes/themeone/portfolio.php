
      <?php

      switch (get_option('themeone_portfolio_layout')) {
        case '2cols':
          $layout = 'works-grid-2';
          break;
        
        case '3cols':
          $layout = 'works-grid-3';
          break;

        case '4cols':
          $layout = 'works-grid-4';
          break;

        default:
          $layout = 'works-grid-3';
          break;
      }

      ?>

      <div class="main">      
        <section class="module bg-dark-60 portfolio-page-header" data-background="<?=theme_folder('themeone')?>assets/images/portfolio/portfolio_header_bg.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt"><?=feast_line('portfolio')?></h2>
                <div class="module-subtitle font-serif"><?=get_option('themeone_portfolio_text')?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="module pb-0">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <ul class="filter font-alt" id="filters">
                  <li><a class="current wow fadeInUp" href="#" data-filter="*">All</a></li>
                  <?php foreach(list_portfolio_cats() as $cat): ?>
                  <li><a class="wow fadeInUp" href="#" data-filter=".<?=cat_slug($cat)?>" data-wow-delay="0.2s"><?=cat_title($cat)?></a></li>
                  <?php endforeach; ?>

                </ul>
              </div>
            </div>
          <?=get_option('themeone_portfolio_boxed') == 0 ? '</div>' : null?>
            <ul class="works-grid <?=get_option('themeone_portfolio_gutter') == 1 ? 'works-grid-gut' : null?> <?=$layout?> works-hover-w" id="works-grid">
              <?php foreach(list_works() as $work): ?>
              <li class="work-item <?=post_cat_slug($work)?>"><a href="<?=work_url($work)?>">
                  <div class="work-image"><img src="<?=post_thumb($work, 'medium')?>" alt="<?=post_title($work)?>"/></div>
                  <div class="work-caption font-alt">
                    <h3 class="work-title"><?=post_title($work)?></h3>
                    <div class="work-descr"><?=post_category($work)?></div>
                  </div></a>
              </li>
              <?php endforeach; ?>

            </ul>
          <?=get_option('themeone_portfolio_boxed') == 1 ? '</div>' : null?>
        </section>
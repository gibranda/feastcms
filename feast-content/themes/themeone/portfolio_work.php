      <div class="main">      
        <section class="module bg-dark-60 portfolio-page-header" data-background="<?=theme_folder()?>assets/images/portfolio/portfolio_header_bg.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt"><?=post_title($work)?></h2>
                <div class="module-subtitle font-serif"><?=post_excerpt($work)?></div>
              </div>
            </div>
          </div>
        </section>

        <section class="module">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-8 col-lg-8"><img src="<?=post_image($work)?>" alt="<?=post_title($work)?>"/></div>
              <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="work-details">
                  <h5 class="work-details-title font-alt">Project Details</h5>
                  <p><?=post_option('details', $work)?>.</p>
                  <ul>
                    <li><strong>Client: </strong><span class="font-serif"><?=post_option('client', $work)?></span>
                    </li>
                    <li><strong>Date: </strong><span class="font-serif"><?=post_date($work)?></span>
                    </li>
                    <li><strong>Online: </strong><span class="font-serif"><a href="<?=post_option('online', $work)?>" target="_blank"><?=post_option('online', $work)?></a></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="module mt-0 pt-0">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12">

                  <?=post_body($work)?>

              </div>
            </div>
          </div>
        </section>
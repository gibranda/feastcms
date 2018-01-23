      <section class="home-section home-parallax home-fade <?=get_option('themeone_header_fullscreen') == 1 ? 'home-full-height' : NULL?>" id="home">
        <div class="hero-slider">
          <ul class="slides">

          <?php foreach(get_slider(get_option('home_slider')) as $slide): ?>
            <li class="bg-dark-30 bg-dark" style="background-image:url(<?=slide_background($slide)?>);">
              <div class="titan-caption">
                <div class="caption-content">
                  <div class="font-alt mb-20 titan-title-size-3"><?=slide_title($slide)?></div>
                  <div class="font-alt mb-40 titan-title-size-1"><?=slide_text($slide, 40)?></div>
                  <a class="section-scroll btn btn-border-w btn-round" href="<?=slide_button($slide)?>"><?=slide_button_text($slide)?></a>
                </div>
              </div>
            </li>
          <?php endforeach; ?>

          </ul>
        </div>
      </section>
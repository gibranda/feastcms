<style type="text/css">
  .hide-bullets {
    list-style:none;
    margin-left: -40px;
    margin-top:10px;
  }
  #slider-thumbs li a img {
    max-height: 100px;
    min-width: 100%;
    overflow: hidden;
  }
</style>
<div id="main_area">
        <!-- Slider -->
        <div class="row">
            <div class="col-xs-12" id="slider">
                <!-- Top part of the slider -->
                <div class="row">
                    <div class="col-sm-8" id="carousel-bounding-box">
                        <div class="carousel slide" id="myCarousel" data-interval="<?=floor(slider_option(get_option('home_slider'), 'autoplay') * 1000)?>" style="height: 300px; overflow: hidden;">
                            <!-- Carousel items -->
                            <div class="carousel-inner">

                              <?php $i = 0; foreach(get_slider( get_option('home_slider') ) as $slide): ?>      
                                <div class="item<?=$i == 0 ? ' active' : null?>" data-slide-number="<?=$i?>">
                                <img src="<?=slide_background($slide)?>"></div>
                              <?php $i++; endforeach; ?>

                            </div><!-- Carousel nav -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>                                       
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>                                       
                            </a>                                
                            </div>
                    </div>

                    <div class="col-sm-4" id="carousel-text"></div>

                    <div id="slide-content" style="display: none;">

                      <?php $ii = 0; foreach(get_slider( get_option('home_slider') ) as $slide): ?>      
                        <div id="slide-content-<?=$ii?>">
                            <h2><?=slide_title($slide)?></h2>
                            <p><?=slide_text($slide)?></p>
                            <p class="sub-text"><?=slide_date($slide, TRUE)?> - <a href="<?=slide_button($slide)?>">Read more</a></p>
                        </div>
                      <?php $ii++; endforeach; ?>

                    </div>
                </div>
            </div>
        </div><!--/Slider-->

        <div class="row hidden-xs" id="slider-thumbs">
            <!-- Bottom switcher of slider -->
            <ul class="hide-bullets">

              <?php $iii = 0; foreach(get_slider( get_option('home_slider') ) as $slide): ?>      
                <li class="col-sm-2" style="padding-right: 0">
                    <a class="thumbnail" id="carousel-selector-<?=$iii?>"><img src="<?=slide_thumb($slide)?>"></a>
                </li>
              <?php $iii++; endforeach; ?>
            </ul>                 
        </div>
</div>

<script type="text/javascript">
  jQuery(document).ready(function($) {
 
        $('#myCarousel').carousel();
 
        $('#carousel-text').html($('#slide-content-0').html());
 
        //Handles the carousel thumbnails
       $('[id^=carousel-selector-]').click( function(){
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel').carousel(id);
        });
 
 
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
  });  
</script>
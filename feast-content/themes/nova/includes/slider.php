<?php
$autoplay = (is_option('home_slider') && is_numeric(slider_option(get_option('home_slider'), 'autoplay'))) ? 'true' : 'false';
$interval  = (is_option('home_slider') && is_numeric(slider_option(get_option('home_slider'), 'autoplay'))) ? floor(slider_option(get_option('home_slider'), 'autoplay') * 1000) : 2000;
?>
    <!--Slider-->
    <section id="slide-show">
        <div id="slider" data-autoplay="<?=$autoplay?>" data-interval="<?=$interval?>" class="sl-slider-wrapper">

            <!--Slider Items-->    
            <div class="sl-slider">
                <?php if( !is_option('home_slider') && !get_slider( get_option('home_slider') ) ) { ?>
                <!--Slider Item1-->
                <div class="sl-slide item1" data-orientation="horizontal" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner">
                        <div class="container">
                            <img class="pull-right" src="<?=theme_folder('nova')?>/assets/images/sample/slider/img1.png" alt="" />
                            <h2>Creative Ideas</h2>
                            <h3 class="gap">Tincidunt condimentum eros</h3>
                            <a class="btn btn-large btn-transparent" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
                <!--/Slider Item1-->

                <!--Slider Item2-->
                <div class="sl-slide item2" data-orientation="vertical" data-slice1-rotation="10" data-slice2-rotation="-15" data-slice1-scale="1.5" data-slice2-scale="1.5">
                    <div class="sl-slide-inner">
                        <div class="container">
                            <img class="pull-right" src="<?=theme_folder('nova')?>/assets/images/sample/slider/img2.png" alt="" />
                            <h2>Planning &amp; Analysis</h2>
                            <h3 class="gap">Aenean ultricies mi vitast</h3>
                            <a class="btn btn-large btn-transparent" href="#">Learn More</a>
                        </div>
                    </div>
                </div>
                <!--Slider Item2-->

                <!--Slider Item3-->
                <div class="sl-slide item3" data-orientation="horizontal" data-slice1-rotation="3" data-slice2-rotation="3" data-slice1-scale="2" data-slice2-scale="1">
                    <div class="sl-slide-inner">
                       <div class="container">
                        <img class="pull-right" src="<?=theme_folder('nova')?>/assets/images/sample/slider/img3.png" alt="" />
                        <h2>Unique Solutions</h2>
                        <h3 class="gap">Breatures who have been utterly</h3>
                        <a class="btn btn-large btn-transparent" href="#">Learn More</a>
                    </div>
                    </div>
                </div>
                <!--Slider Item3-->

            <?php } else { ?>
            <?php 
                $i = 1;
                $position = 'horizontal';
                foreach( get_slider( get_option('home_slider') ) as $slide):
                $active  = $i ==1 ? ' active' : null;
            ?>
                <div class="sl-slide item<?=$i?>" data-orientation="<?=$position?>" data-slice1-rotation="-25" data-slice2-rotation="-25" data-slice1-scale="2" data-slice2-scale="2">
                    <div class="sl-slide-inner" style="background-image: url(<?=slide_background($slide)?>);background-position: center;">
                        <div class="container text-center" style="background: rgba(0, 0, 0, 0.4); width: 100%; height: 100%">
                            <h2 class="anim-moveUp"><?=slide_title($slide)?></h2>
                            <h3 class="anim-fadeIn"><?=slide_text($slide)?></h3>
                            <a class="btn btn-large btn-transparent anim-scaleUp" style="margin-top: 10px" href="<?=slide_button($slide)?>">Learn More</a>
                        </div>
                    </div>
                </div>
            <?php
                $position = $position == 'horizontal' ? 'vertical' : $position;
                $i++; endforeach;
            ?>
            <?php } ?>
            </div>
            <!--/Slider Items-->

            <!--Slider Next Prev button-->
            <nav id="nav-arrows" class="nav-arrows">
                <span class="nav-arrow-prev"><i class="icon-angle-left"></i></span>
                <span class="nav-arrow-next"><i class="icon-angle-right"></i></span> 
            </nav>
            <!--/Slider Next Prev button-->

        </div>
    <!-- /slider-wrapper -->           
    </section>
    <!--/Slider-->


<!-- SL Slider -->
<script type="text/javascript"> 
$(function() {
    var Page = (function() {

        var $navArrows = $( '#nav-arrows' ),
        slitslider = $( '#slider' ).slitslider( {
            autoplay : true
        } ),

        init = function() {
            initEvents();
        },
        initEvents = function() {
            $navArrows.children( ':last' ).on( 'click', function() {
                slitslider.next();
                return false;
            });

            $navArrows.children( ':first' ).on( 'click', function() {
                slitslider.previous();
                return false;
            });
        };

        return { init : init };

    })();

    Page.init();
});
</script>
<!-- /SL Slider -->

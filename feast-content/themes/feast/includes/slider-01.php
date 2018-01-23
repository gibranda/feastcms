<style type="text/css">
.carousel-caption {
  position: relative;
  left: 0%;
  right: 0%;
  bottom: 0px;
  z-index: 10;
  padding-top: 0px;
  padding-bottom: 0px;
  color: #000;
  text-shadow: none;
  text-align: <?=is_rtl() ? 'right' : 'left'?>;
}
.carousel {
    position: relative;
}
.controllers {
    position: absolute;
    top: 0px;
    height: 300px !important;
}

.carousel-control.left, 
.carousel-control.right {
    background-image: none;
}
</style>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="<?=floor(slider_option(get_option('home_slider'), 'autoplay') * 1000)?>" style="height: 300px; overflow: hidden;">
  <!-- Wrapper for slides -->
  <div class="carousel-inner">

  <?php $i = 0; foreach(get_slider( get_option('home_slider') ) as $slide): ?>      
    <div class="item<?=$i == 0 ? ' active' : null?>">
      <div class="holder col-sm-8">
        <img class="img-responsive" src="<?=slide_background($slide)?>" alt="<?=slide_title($slide)?>" style="height: 100vh; min-width: 100%">
      </div>
      <div class="col-sm-4">
        <div class="carousel-caption">
            <h2><?=slide_title($slide)?></h2>
            <p><?=slide_text($slide, 50)?></p>
            <a href="<?=slide_button($slide)?>" class="btn btn-default" style="margin-top: 15px">Read more</a>    
        </div>
      </div>
    </div>
  <?php $i++; endforeach; ?>

  </div>
  <div class="controllers col-sm-8 col-xs-12">
  <!-- Controls -->
    <?php if(slider_option(get_option('home_slider'), 'navigation')) { ?>
    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
    <?php } ?>

    <?php if(slider_option(get_option('home_slider'), 'pagination')) { ?>
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php $ii = 0; foreach(get_slider( get_option('home_slider') ) as $slide): ?>      
      <li data-target="#carousel-example-generic" data-slide-to="<?=$ii?>" <?=$ii == 0 ? ' class="active"' : null?>></li>
    <?php $ii++; endforeach; ?>
    </ol> 
    <?php } ?>
  </div>
</div>
<script type="text/javascript">
$(window).bind("load resize slid.bs.carousel", function() {
  var imageHeight = $(".active .holder").height();
  $(".controllers").height( imageHeight );
  console.log("Slid");
});
</script>
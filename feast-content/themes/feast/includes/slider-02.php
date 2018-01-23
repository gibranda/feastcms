<style type="text/css">
  #myCarousel {
    margin-bottom: 20px;
    height: 400px;
    overflow: hidden;
  }

  #myCarousel .carousel-caption {
    left:0;
    right:0;
    bottom:0;
    text-align:left;
    padding:10px;
    background:rgba(0,0,0,0.6);
    text-shadow:none;
  }

  #myCarousel .list-group {
    position:absolute;
    top:0;
    right:0;
    padding-right: 0;
  }
  #myCarousel .list-group-item {
    border-radius:0px;
    cursor:pointer;
  }
  #myCarousel .list-group .active {
    background-color:#eee;  
  }

  @media (min-width: 992px) { 
    #myCarousel {padding-right:33.3333%;}
    #myCarousel .carousel-controls {display:none;}  
  }
  @media (max-width: 991px) { 
    .carousel-caption p,
    #myCarousel .list-group {display:none;} 
  }

</style>
    <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="<?=floor(slider_option(get_option('home_slider'), 'autoplay') * 1000)?>">
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner">

      <?php $i = 0; foreach(get_slider( get_option('home_slider') ) as $slide): ?>      
        <div class="item<?=$i == 0 ? ' active' : null?>" style="height: 400px; overflow: hidden;">
          <img src="<?=slide_background($slide)?>" alt="<?=slide_title($slide)?>" style="min-height: 100%; min-width: 100%">
           <div class="carousel-caption">
            <h4><a href="<?=slide_button($slide)?>"><?=slide_title($slide)?></a></h4>
            <p><?=slide_text($slide, 50)?></p>
          </div>
        </div><!-- End Item -->
      <?php $i++; endforeach; ?>

                
      </div><!-- End Carousel Inner -->


    <ul class="list-group col-sm-4">

    <?php $ii = 0; foreach(get_slider( get_option('home_slider') ) as $slide): ?>
      <li data-target="#myCarousel" data-slide-to="<?=$ii?>" class="list-group-item<?=$ii == 0 ? ' active' : null?>">
        <h4 style="margin-top: 0"><?=slide_title($slide)?></h4>
        <p><?=slide_text($slide, 10)?></p>
      </li>
    <?php $ii++; endforeach; ?>
    </ul>

      <!-- Controls -->
      <div class="carousel-controls">
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>
      </div>

    </div><!-- End Carousel -->



    <script type="text/javascript">
    $(document).ready(function(){
        
      var clickEvent = false;
      $('#myCarousel').carousel().on('click', '.list-group li', function() {
          clickEvent = true;
          $('.list-group li').removeClass('active');
          $(this).addClass('active');   
      }).on('slid.bs.carousel', function(e) {
        $('.list-group li.active').prev('li').appendTo('.list-group');
        var count = $('.list-group').children().length -1;
        var current = $('.list-group li.active');
        current.removeClass('active').next().addClass('active');
        var id = parseInt(current.data('slide-to'));
        if(count == id) {
          $('.list-group li').first().addClass('active'); 
        }
        clickEvent = false;
      });
    })

    $(window).load(function() {
        var boxheight = $('#myCarousel .carousel-inner').innerHeight();
        var itemlength = $('#myCarousel .item').length;
        var triggerheight = Math.round(boxheight/itemlength);
      $('#myCarousel .list-group-item').outerHeight(triggerheight);
    });     
    </script>

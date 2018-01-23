<!--Bottom-->
<section id="bottom" class="main">
    <!--Container-->
    <div class="container">

        <!--row-fluids-->
        <div class="row-fluid">

            <!--Contact Form-->
            <div class="span3">
                <h4>ADDRESS</h4>
                <ul class="unstyled address">
                    <li>
                        <i class="icon-home"></i><strong>Address:</strong> <?=$this->pref->address?>
                    </li>
                    <li>
                        <i class="icon-envelope"></i>
                        <strong>Email: </strong> <?=$this->pref->contact_email?>
                    </li>
                    <li>
                        <i class="icon-phone"></i>
                        <strong>Call us:</strong> <?=$this->pref->mobile?>
                    </li>
                </ul>
            </div>
            <!--End Contact Form-->

            <!--Important Links-->
            <div id="tweets" class="span3">
                <h4><?=is_option('nova_footer_title1') ? get_option('nova_footer_title1') : NULL?></h4>
                <div>
                    <?=(is_option('nova_footer_menu1') && get_option('nova_footer_menu1') != '') ? show_menu(get_option('nova_footer_menu1'), array('nav_tag_open' => '<ul class="arrow-fluid">')) : '<span class="navbar-text pull-left" style="margin: 17px 15px 0 0">No menu selected</span>'?>       
                </div>  
            </div>
            <!--Important Links-->

            <!--Archives-->
            <div id="archives" class="span3">
                <h4><?=is_option('nova_footer_title2') ? get_option('nova_footer_title2') : NULL?></h4>
                <div>
                    <?=(is_option('nova_footer_menu2') && get_option('nova_footer_menu2') != '') ? show_menu(get_option('nova_footer_menu2'), array('nav_tag_open' => '<ul class="arrow-fluid">')) : '<span class="navbar-text pull-left" style="margin: 17px 15px 0 0">No menu selected</span>'?>       
                </div>
            </div>
            <!--End Archives-->

            <div class="span3">
                <h4><?=(is_option('footer_widget_title') && get_option('footer_widget_title') != '') ? get_option('footer_widget_title') : 'Text widget'?></h4>
                <div class="row-fluid first">
                    <?=(is_option('footer_widget') && get_option('footer_widget') != '') ? get_option('footer_widget') : '<p>This is a text widget, you can change the text by go to theme options section in dashboard.</p>'?>
                </div>

        </div>

    </div>
    <!--/row-fluid-->
</div>
<!--/container-->

</section>
<!--/bottom-->

<footer id="footer">
    <div class="container">
        <div class="row-fluid">
            <div class="span5 cp">
                &copy; 2017 <a target="_blank" href="http://demo.eadhassan.com/feast-cms" title="FeastCMS Content management system">FeastCMS</a>. All Rights Reserved.
            </div>
            <!--/Copyright-->

            <div class="span6">
                <ul class="social pull-right">

                    <?php if(@$this->pref->facebook != '') { ?>
                    <li><a href="<?=$this->pref->facebook?>" target="_blank"><i class="icon-facebook"></i></a></li>
                    <?php } if(@$this->pref->twitter != '') { ?>
                    <li><a href="<?=$this->pref->twitter?>" target="_blank"><i class="icon-twitter"></i></a></li>
                    <?php } if(@$this->pref->linkedin != '') { ?>
                    <li><a href="<?=$this->pref->linkedin?>" target="_blank"><i class="icon-linkedin"></i></a></li>
                    <?php } if(@$this->pref->pinterest != '') { ?>
                    <li><a href="<?=$this->pref->pinterest?>" target="_blank"><i class="icon-pinterest"></i></a></li>
                    <?php } if(@$this->pref->google_plus != '') { ?>
                    <li><a href="<?=$this->pref->google_plus?>" target="_blank"><i class="icon-google-plus"></i></a></li>
                    <?php } if(@$this->pref->behance != '') { ?>
                    <li><a href="<?=$this->pref->behance?>" target="_blank"><i class="icon-behance"></i></a></li>
                    <?php } if(@$this->pref->github != '') { ?>
                    <li><a href="<?=$this->pref->github?>" target="_blank"><i class="icon-github-alt"></i></a></li>
                    <?php } if(@$this->pref->youtube != '') { ?>
                    <li><a href="<?=$this->pref->youtube?>" target="_blank"><i class="icon-youtube"></i></a></li>
                    <?php } if(@$this->pref->skype != '') { ?>
                    <li><a href="<?=$this->pref->skype?>" target="_blank"><i class="icon-skype"></i></a></li>
                    <?php } ?>
                  
                </ul>
            </div>

            <div class="span1">
                <a id="gototop" class="gototop pull-right" href="#"><i class="icon-angle-up"></i></a>
            </div>
            <!--/Goto Top-->
        </div>
    </div>
</footer>
<!--/Footer-->

<!--  Login form -->
<div class="modal hide fade in" id="loginForm" aria-hidden="false">
    <div class="modal-header">
        <i class="icon-remove" data-dismiss="modal" aria-hidden="true"></i>
        <h4>Login Form</h4>
    </div>
    <!--Modal Body-->
    <div class="modal-body">
        <form class="form-inline" action="index.html" method="post" id="form-login">
            <input type="text" class="input-small" placeholder="Email">
            <input type="password" class="input-small" placeholder="Password">
            <label class="checkbox">
                <input type="checkbox"> Remember me
            </label>
            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
        <a href="#">Forgot your password?</a>
    </div>
    <!--/Modal Body-->
</div>
<!--  /Login form -->

<script src="<?=theme_folder('nova')?>/assets/js/vendor/bootstrap.min.js"></script>
<script src="<?=theme_folder('nova')?>/assets/js/main.js"></script>
<!-- Required javascript files for Slider -->
<script src="<?=theme_folder('nova')?>/assets/js/jquery.ba-cond.min.js"></script>
<script src="<?=theme_folder('nova')?>/assets/js/jquery.slitslider.js"></script>
<!-- /Required javascript files for Slider -->

<script type="text/javascript">
    if($(window).width() > )
    $('ul.nav li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });        
</script>

</body>
</html>
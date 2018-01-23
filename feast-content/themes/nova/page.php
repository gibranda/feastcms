<?php 
if(is_page()) { ?>
    <section class="title">
        <div class="container">
            <div class="row-fluid">
                <div class="span6">
                    <h1><?=post_title($page)?></h1>
                </div>
                <div class="span6">
                    <ul class="breadcrumb pull-right">
                        <li><a href="<?=base_url()?>"><?=feast_line('home')?></a> <span class="divider">/</span></li>
                        <li class="active"><?=post_title($page)?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- / .title -->   
<?php } ?>

          <!-- Post Content -->
          <?=post_body($page)?>

<?php 
if(is_page()) { ?>

    <div class="container">
        <div class="row-fluid">
            <?php 

            echo show_comments();

            ?>
            
            <hr>

            <?php
              if(get_option('page_comments') == "1" && post_option('page_comments', $page) == 1) {

                echo comment_box( post_id($page), 'comment-form', 'input-block-level', 'span' );

              } 
            ?>
        </div>
    </div>  
<?php } ?>
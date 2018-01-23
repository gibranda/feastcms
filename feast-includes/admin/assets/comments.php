        <hr>
        <h3>
        <?=is_post() ? feast_line('post_comments') : feast_line('page_comments')?> : 
        <small><?=(count($comments) > 0) ? feast_line('has_comments', count($comments)) : 'No comments'?></small>
        </h3>
        <?php $i = 0; foreach($comments as $comment): ?>
          <!-- comment -->
          <div class="media">
              <img class="media-object pull-left" src="<?php echo THEME_FOLDER; ?>assets/images/default-person.png" alt="Post Comment">
              <div class="media-body">
                  <h4 class="media-heading"><?=comment_username($comment)?>
                      <small><?=comment_date($comment)?></small>
                  </h4>
                  <?=comment_text($comment)?>
              </div>
          </div>
          <?php if($i < count($comments)-1) { echo '<hr>'; } ?>
          <!-- /comment -->
        <?php $i++; endforeach; ?>
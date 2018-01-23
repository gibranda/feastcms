      <div class="comments">
      <?php if(count($comments)) { ?>
        <hr>
        <h4 class="comment-title font-alt">
          <?=feast_line('comments')?> <small>(<?=count($comments)?>)</small> 
        </h4>
        <?php $i = 0; foreach($comments as $comment): ?>
          <!-- comment -->
          <div class="comment clearfix" id="comment-<?=comment_id($comment)?>">
              <?php
                if($comment->user_type == 1) {
                  $img = showPhoto( get_user('picture', $comment->user_id));
                } else {
                  $img = '<img class="pull-left img-responsive" style="margin-right: 10px" width="68" src="'.THEME_FOLDER.'assets/images/default-person.png" alt="Post Comment">';
                }
              ?>
              <div class="comment-avatar">
              <?=$img?>
              </div>
              <div class="comment-content clearfix">
              <div class="comment-author font-alt"><a href="#"><?=comment_username($comment)?></a></div>
              <div class="comment-body">
                <p><?=comment_text($comment)?></p>
              </div>
              <div class="comment-meta font-alt"><?=comment_date($comment)?>
              </div>
              </div>
          </div>
          <!-- /comment -->
        <?php $i++; endforeach; ?>
      <?php } ?>
      </div>
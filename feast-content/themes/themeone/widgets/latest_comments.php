                <div class="widget">
                  <h5 class="widget-title font-alt">Recent Comments</h5>
                  <ul class="icon-list">
                    <?php foreach (latest_comments(5) as $sideparComments): ?>
                      <li><?=comment_username($sideparComments)?> on <a href="<?=comment_post_url($sideparComments)?>/#comments"><?=comment_post($sideparComments)?></a></li>
                    <?php endforeach; ?>
                  </ul>
                </div>

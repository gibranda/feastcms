<style type="text/css">
.comment-list{
  list-style: none;
  margin: 0;
  padding: 0;
}

.comment-list li {
  padding: 15px 0;
  border-bottom: 1px dashed #aaa;
}

.comment-list li:last-child {
  border-bottom: none
}

.comment-list li span {
  color: #2980b9;
  text-transform: uppercase;
  font-weight: bold;
}

</style>
<ul class="comment-list">
    <li><span>Name :</span> <?=comment_username($comment)?></li>
    <li><span>Email :</span> <?=comment_email($comment)?></li>
    <li><span>Date :</span>  <?=comment_date($comment, FALSE)?></li>
    <li><span>Comment :</span> <p> <?=comment_text($comment)?></p></li>
    <li><span>Url :</span> <a href=" <?=comment_post_url($comment)?>/#comment-<?=comment_id($comment)?>" target="_blank"> <i class="fa fa-link"></i> Click to visit</a></li>
</ul>
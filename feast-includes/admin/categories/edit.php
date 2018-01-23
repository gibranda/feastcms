<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
      <?php echo form_open('',array('class'=>'form-horizontal'));?>
        <div class="form-group">
          <?php
          echo form_label(feast_line('title'),'title');
          echo form_input('title',set_value('title',$category->title),'class="form-control"');
          echo form_error('title', '<p class="text-danger">', '</p>');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label(feast_line('slug'),'slug');
          echo form_input('slug',set_value('slug',$category->slug),'class="form-control"');
          echo form_error('slug', '<p class="text-danger">', '</p>');
          ?>
        </div>
        <div class="form-group">

          <?php
          $list = array(0 => 'No parent');
          foreach (list_cats() as $option):
            if($option->parent_id == 0 and $option->id != @$this->uri->segment(4)) {
              $list[$option->id] = $option->title;
            }
          endforeach;

          echo form_label('Parent','parent_id');
          echo form_dropdown('parent_id', $list, $category->parent_id);
          echo form_error('parent_id', '<p class="text-danger">', '</p>');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label(feast_line('order'),'order');
          echo form_input('order',set_value('order',$category->order),'class="form-control"');
          echo form_error('order', '<p class="text-danger">', '</p>');
          ?>
        </div>
        <?php echo form_submit('submit', feast_line('save'), 'class="btn btn-primary btn-lg btn-block"');?>
      <?php echo form_close();?>
    </div>
  </div>
</div>
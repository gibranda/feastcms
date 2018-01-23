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
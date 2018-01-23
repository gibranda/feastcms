          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?=count_table('posts', array('post_type' => 'post'))?></h3>
                  <p><?=feast_line('posts')?></p>
                </div>
                <div class="icon">
                  <i class="fa fa-file-text"></i>
                </div>
                <a href="<?=base_url('admin/posts')?>" class="small-box-footer"><?=feast_line('all', $this->lang->line('posts') )?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?=count_table('categories')?></h3>
                  <p><?=feast_line('categories')?></p>
                </div>
                <div class="icon">
                  <i class="fa fa-tags"></i>
                </div>
                <a href="<?=base_url('admin/categories')?>" class="small-box-footer"><?=feast_line('all', $this->lang->line('categories') )?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?=count_table('posts', array('post_type' => 'page'))?></h3>
                  <p><?=feast_line('pages')?></p>
                </div>
                <div class="icon">
                  <i class="fa fa-files-o"></i>
                </div>
                <a href="<?=base_url('admin/pages')?>" class="small-box-footer"><?=feast_line('all', $this->lang->line('pages') )?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?=count_table('feast_account')?></h3>
                  <p><?=feast_line('users')?></p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="<?=base_url('admin/users')?>" class="small-box-footer"><?=feast_line('all', $this->lang->line('users') )?> <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->

          <div class="row">
            <section class="col-md-9">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=feast_line('latest_posts')?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-striped no-margin">
                      <thead>
                        <tr>
                          <th><?=feast_line('title')?></th>
                          <th><?=feast_line('category')?></th>
                          <th><?=feast_line('statue')?></th>
                          <th><?=feast_line('edit')?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      <?php foreach(list_posts(5) as $post): ?>
                        <tr>
                          <td><a href="<?=post_url($post)?>" target="_blank"><?=post_title($post)?></a></td>
                          <td><?=post_category($post)?></td>
                          <td><?=post_statue($post) == 1 ? '<span class="label label-success" data-toggle="tooltip" data-title="published"><i class="fa fa-check"></i></span>' : '<span class="label label-danger" data-toggle="tooltip" data-title="unpublished"><i class="fa fa-remove"></i></span>'?></td>
                          <td><a href="<?=base_url('admin/posts/edit/' . post_id($post))?>" class="label label-info" data-toggle="tooltip" data-title="<?=feast_line('edit', $this->lang->line('post') )?>"><i class="fa fa-pencil"></i></a></td>
                        </tr>
                      <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?=base_url('admin/posts')?>" class="btn btn-sm btn-info btn-flat pull-left"><?=feast_line('all', $this->lang->line('posts') )?></a>
                </div><!-- /.box-footer -->
              </div>

            </section>

            <section class="col-md-3">

              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=feast_line('latest_categories')?></h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-striped no-margin">
                      <thead>
                        <tr>
                          <th><?=feast_line('title')?></th>
                          <th><?=feast_line('edit')?></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      <?php foreach(list_cats(5) as $cat): ?>
                        <tr>
                          <td><?=cat_title($cat)?></td>
                          <td><a href="<?=base_url('admin/categories/edit/' . cat_id($cat))?>" class="label label-info" data-toggle="tooltip" data-title="<?=feast_line('edit', $this->lang->line('category') )?>"><i class="fa fa-pencil"></i></a></td>
                        </tr>
                      <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <a href="<?=base_url('admin/categories')?>" class="btn btn-sm btn-info btn-flat pull-left"><?=feast_line('all', $this->lang->line('categories') )?></a>
                </div><!-- /.box-footer -->
              </div>

            </section>

          </div>
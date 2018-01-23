<style type="text/css">
.tab-content { padding: 0 !important;}
.tab-pane { overflow: hidden !important;}
.tab-pane h3 { margin-top: 0; padding-top: 0; border-bottom: 2px solid #ddd; padding-bottom: 10px;}
.full-content .tab-pane { background: #f3f3f3; padding: 15px 15px}
.service-content .tab-pane { background: #fff; padding: 15px 15px;}
.tabs-left > .nav-tabs { margin-right: 0;}
.question-icon {vertical-align: middle; position: relative;}
.question-icon i { text-align: center; width: 100%; position: absolute; top: 50%; transform: translateY(100%); border-left: 1px solid #555;}
.tooltip .tooltip-inner { text-align: left; direction: ltr;}
.form-group {
  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 1px solid #ddd;
  overflow: hidden;
}
label {
  font-weight: bold;
}

label .help-block {
  font-family: tahoma;
  font-size: 11px;
  color: #888;
  margin-top: 5px;
  margin-bottom: 0px;
  line-height: 1.1;
}
</style>

    <?php $dir = is_rtl() ? 'rtl' : 'ltr'; ?>
    <?php echo form_open_multipart(base_url('admin/apperance/update')); ?>
    <div class="row">
      <div class="col-lg-12 col-md-12">
          <div class="box">
              <div class="box-body">
                  <?php
                    if(theme_has_options()) {
                      $this->load->view($this->pref->active_theme.'/theme_options/index', TRUE);
                    }
                  ?>
              </div>

              <div class="box-footer">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
              </div>
          </div>
      </div>
    </div>
    <?php echo form_close(); ?>
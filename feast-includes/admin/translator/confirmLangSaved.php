        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="box box-default">
                    <div class="box-body">

                        <div class="alert alert-success">
                          <p>
                            <div class="label label-info"><i class="fa fa-check"></i></div>
                            Language: <span class="text-muted"><?=ucwords( $slaveLang )?></span> -
                            File: <span class="text-muted"><?=ucwords( $langModule )?></span>
                          </p>
                        </div>
                        <p><?php echo $this->data['saved_data']; ?></p>
                    </div>
                </div>
            </div>
        </div>
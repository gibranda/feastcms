            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <div class="sidebar affix">
                
                    <?=$this->widget->list_cats()?>

                    <?=$this->widget->latest_posts(5)?>

                </div>
            </div>

            <script type="text/javascript">


                $(document).ready(affixSidebar);
                $(window).on('resize',affixSidebar);

                function affixSidebar() {
                    if($(window).width() > 997) {
                        $('.affix').affix({
                          offset: {
                            top: "<?=is_home() ? '350' : '20'?>",
                            bottom: $('.footer').outerHeight(true)
                          }
                        });
                    }
                }

                $(document).on('affixed.bs.affix',function(e){
                    $('.affix').each(function(){
                        var elem = $(this);
                        var parentPanel = $(elem).parent();
                        var resizeFn = function () {
                            var parentAffixWidth = $(parentPanel).width();
                            elem.width(parentAffixWidth);
                        };      

                        resizeFn();
                        $(window).resize(resizeFn);
                    });
                });
            </script>
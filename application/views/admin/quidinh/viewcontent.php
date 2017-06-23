<div class="wrapper">
    <!-- Form -->
    <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
        <fieldset>
            <div class="widget">
                <div class="title">
                    <h6 > <i class="fa fa-newspaper-o" aria-hidden="true"></i> Tin: <?php echo $quidinh->title ?> <a href="<?php echo admin_url('quidinh/edit/'.$quidinh->id); ?>" style="color: #5CB85C;"> | đi đến <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>  </h6>
                </div>
             
                <div class="tab_container">
                    <!-- truong content -->
                    <div syle="width: 100%;" class="formRow">
                        <div style="width: 100%; margin: 0px; padding: 0px;" class="formRight">
                            <span class="">
                            <textarea class="content" id="content" name="content"><?php echo $quidinh->content ?></textarea>
                            </span>
                        </div><!-- formRight -->
                        <div class="clear"></div>
                    </div><!-- formRow -->
                    <script>CKEDITOR.replace( 'content' );</script>
                
                    <div class="formRow hide"></div>
                </div><!-- tab_container -->
            </div><!-- End widget-->
            <div class="clear"></div>
        </fieldset>
    </form>
</div><!-- wrapper -->
<div class="clear mt30"></div>

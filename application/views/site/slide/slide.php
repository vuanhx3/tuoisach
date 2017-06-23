                <div  class="top_left hide_slide">
                        <script type="text/javascript">
                        (function($)
                        {
                            $(document).ready(function()
                            {
                                $("#HomeSlide1").royalSlider({
                                    arrowsNav:true,
                                    loop:false,
                                    keyboardNavEnabled:true,
                                    controlsInside:false,
                                    imageScaleMode:"fill",
                                    arrowsNavAutoHide:false,
                                    autoScaleSlider:true,
                                    autoScaleSliderWidth:440,//chiều rộng slide
                                    autoScaleSliderHeight:240,//chiều cao slide
                                    controlNavigation:"bullets",
                                    thumbsFitInViewport:false,
                                    navigateByClick:true,
                                    startSlideId:0,
                                    autoPlay:{enabled:false, stopAtAction:false, pauseOnHover:true, delay:5000},
                                    transitionType:"move",
                                    slideshowEnabled:true,
                                    slideshowDelay:5000,
                                    slideshowPauseOnHover:true,
                                    slideshowAutoStart:true,
                                    globalCaption:false
                                });
                            });
                        })(jQuery);
                        </script>
                      <div id='slide'>
                            <div id="img-slide" class="sliderContainer" >
                                <div id="HomeSlide1" class="royalSlider rsMinW">
                                   <?php foreach($bcn_list as $row): ?>
                                    <?php $name = $row->slug; ?>
                                      <a href="" target='_blank'>
                                      <img title="<?php echo $row->name ?>" alt="<?php echo $row->name ?>" src="<?php echo $row->image_link ?>" /> 
                                      </a>
                                   <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <div class="clear pb20"></div>  
                 </div><!-- end top_left -->

                 <div  class="top_right">
                    <!-- lay slide -->
                        <script type="text/javascript">
                            (function($)
                            {
                                $(document).ready(function()
                                {
                                    $("#HomeSlide").royalSlider({
                                        arrowsNav:true,
                                        loop:false,
                                        keyboardNavEnabled:true,
                                        controlsInside:false,
                                        imageScaleMode:"fill",
                                        arrowsNavAutoHide:false,
                                        autoScaleSlider:true,
                                        autoScaleSliderWidth:710,//chiều rộng slide
                                        autoScaleSliderHeight:240,//chiều cao slide
                                        controlNavigation:"bullets",
                                        thumbsFitInViewport:false,
                                        navigateByClick:true,
                                        startSlideId:0,
                                        autoPlay:{enabled:true, stopAtAction:false, pauseOnHover:true, delay:5000},
                                        transitionType:"move",
                                        slideshowEnabled:true,
                                        slideshowDelay:5000,
                                        slideshowPauseOnHover:true,
                                        slideshowAutoStart:true,
                                        globalCaption:false
                                    });
                                });
                            })(jQuery);
                        </script> 

                        <div id='slide'>
                            <div id="img-slide" class="sliderContainer" >
                                <div id="HomeSlide" class="royalSlider rsMinW">
                                    <?php foreach($slide_list as $row): ?>
                                        <?php $name = $row->slug; ?>
                                        <?php if($row->anhien == 1): ?>      
                                              <a href="<?php echo base_url($name.'-c'.$row->catalog_id.'.html') ?>"" target='_blank'>
                                              <img title="<?php echo $row->name ?>" alt="<?php echo $row->name ?>" src="<?php echo $row->image_link ?>" /> 
                                              </a>
                                         <?php else: ?>
                                             <?php echo ''; ?>
                                         <?php endif; ?>       
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <div class="clear pb20"></div>  
                 </div><!-- end top_right -->
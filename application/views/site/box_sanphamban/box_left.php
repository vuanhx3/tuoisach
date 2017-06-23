                        <div class="box-left">
                          <div class="box_kinang">
                            <div class="row">
                                <div class="col">
                                    <div class="panel panel-default">
                                         <div class="panel-heading"> 
                                           <h2><span class="fa fa-bars"></span> Mẹo & Kĩ Năng </h2>
                                          </div>
                                            <div class="panel-body">
                                              <div class="row">
                                                   <div class="new_main">
                                                     <ul class="demo">
                                                     <?php foreach($list_meovat as $row): ?>
                                                      <?php $name = $row->slug ; ?>
                                                        <li class="news-item">
                                                          <div class="blog_img">
                                                              <a href="#">
                                                              <img alt="<?php echo $row->title ?>" src="<?php echo $row->image_link ?>" width="60" class="img-circle" />
                                                          </a>
                                                          </div>
                                                          <div class="blog_detail">
                                                             <h3><a href="#"><?php echo $row->title ?></a></h3>
                                                             <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_date($row->created); ?>  <i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row->count_view ?></span>
                                                              <p><?php echo $row->intro ?> <a href="#">...[Xem thêm...]</a></p>
                                                          </div>
                                                        </li>
                                                      <?php endforeach; ?>
                                                   

                                                    </ul>
                                                </div>
                                              </div><!-- end row -->
                                            </div><!-- end panel-body -->
                                            <div class="panel_footer"> 
                                                 <ul class="pagination pull-right" >
                                                    <li>
                                                      <a href="#" class="prev">
                                                        <span class="glyphicon_down"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></span>
                                                      </a>
                                                    </li>
                       
                                                    <li>
                                                      <a href="#" class="next">
                                                        <span class="glyphicon_up"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></span>
                                                      </a>
                                                    </li>
                                                </ul>
                                            <div class="clearfix"></div>
                                          </div> <!-- end panel-footer  -->  
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- End box-ki-nang -->
                         </div><!-- end box-left -->
                           <script type="text/javascript">
                            $(function () {
                                $(".demo").bootstrapNews({
                                    newsPerPage: 1,
                                    autoplay: true,
                                    pauseOnHover:true,
                                    direction: 'up',
                                    newsTickerInterval: 6000,
                                    onToDo: function () {
                                        //console.log(this);
                                    }
                                });
                            });
                        </script>   






                        <div class="box-left">
                          <div class="box_kinang">
                            <div class="row">
                                <div class="col">
                                    <div class="panel panel-default">
                                         <div class="panel-heading"> 
                                           <h2>Thực phẩm xem nhiều <span class="fa fa-arrow-right"></span></h2>
                                          </div>
                                            <div class="panel-body">
                                              <div class="row">
                                                   <div class="new_main">
                                                     <ul class="demo_hoaqua">
                                                      <?php foreach($product_view as $row): ?>
                                                        <?php $name = $row->slug; ?>
                                                          <li class="news-item">
                                                            <div class="blog_img">
                                                              <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>">
                                                                <img alt="<?php echo $row->name ?>" src="<?php echo $row->image_link ?>" width="60" class="img-circle" />
                                                               </a>
                                                            </div>
                                                            <div class="blog_detail">
                                                                <div class="action_pd">
                                                                  <a class="name_product" href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>"><?php echo $row->name ?></a>
                                                                </div>
                                                                <p class="price">
                                                                <?php if($row->discount > 0): ?>
                                                                  <?php $price_new = $row->price - $row->discount; ?>
                                                                  <span> <?php echo number_format($price_new) ?> <sup>đ</sup></span>
                                                                  <span class="price-old"> <?php echo number_format($row->price) ?> <sup>đ</sup></span>
                                                                <?php else: ?>
                                                                   <span> <?php echo number_format($row->price) ?> <sup>đ</sup></span>
                                                                <?php endif; ?>
                                                                  <br>
                                                                  <span><i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row->view ?> </span>  
                                                                </p>
                                                            </div>
                                                          </li>
                                                      <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                              </div><!-- end row -->
                                            </div><!-- end panel-body -->
                                            <div class="panel_footer"> 
                                                 <ul class="pagination pull-right" >
                                                    <li>
                                                      <a href="#" class="prev">
                                                        <span class="glyphicon_down"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></span>
                                                      </a>
                                                    </li>
                                                  
                                                    <li>
                                                      <a href="#" class="next">
                                                        <span class="glyphicon_up"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></span>
                                                      </a>
                                                    </li>
                                                </ul>
                                            <div class="clearfix"></div>
                                          </div> <!-- end panel-footer  -->  
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- End box-ki-nang -->
                         </div><!-- end box-left -->
                           <script type="text/javascript">
                            $(function () {
                                $(".demo_hoaqua").bootstrapNews({
                                    newsPerPage: 3,
                                    autoplay: true,
                                    pauseOnHover:true,
                                    direction: 'up',
                                    newsTickerInterval: 4000,
                                    onToDo: function () {
                                        //console.log(this);
                                    }
                                });
                            });
                        </script> 


    
                      <div class="box-left">
                        <div class="fanPage">
                            FanPage Facebook
                        </div>
                      </div><!-- end box left -->
                    
                    <!-- truong video homapage -->
                      <div  class="box-left ">
                        <div class="fanPage ">
                            <?php echo $homepage->video_youtube ?>
                        </div>
                      </div><!-- end box left -->

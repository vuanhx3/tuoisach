<!-- section thu 1 o vi tri box 1 -->
                  <?php foreach($list_thucphamban as $row): ?>
                    <?php if($row->box_vitri == 1): ?>
                       <?php $name = $row->slug ?>
                        <section class="product-sale">
                            <!-- phan man hinh desktop -->
                            <?php if(count($row->subs) > 0): ?>
                            <div class="box_unhide_sale">
                                <div class="box-sale-heading">
                                  <div class="box-sale-title">
                                      <a href="<?php echo base_url($name.'-c'.$row->id.'.html') ?>">
                                        <h3><?php echo $row->name ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></h3>
                                      </a>
                                      <nav class="nav-box-sale hide-mb">
                                          <ul class="box-sale-children">
                                          <!-- lay ra danh muc con -->
                                            <?php foreach($row->subs as $subs): ?>
                                              <?php $name = $subs->slug; ?>
                                             <li><a href="<?php echo base_url($name . '-c' . $subs->id . '.html') ?>"> <?php echo $subs->name ?> </a></li>
                                             <?php endforeach; ?> 
                                          </ul>
                                      </nav>
                                  </div><!-- end box-sale-title -->
                              </div><!-- End heading -->

                              <div class="box-sale-content">
                                  <div class="owl-hotsale">
                                    <?php foreach($row->subs as $subs1): ?>
                                      <?php foreach($list_pd as $row1): ?>
                                        <?php $name = $row1->slug; ?>
                                        <?php if($subs1->id == $row1->catalog_id ): ?>
                                            <div class="product_item">
                                                <div class="product_img">
                                                    <div class="product-item__background">
                                                      <div class="product-item__buttons">
                                                        <button type="button" onclick="notify()" class="product-item__add add_cart" data-productname="<?php echo $row1->name ?>" data-slug="<?php echo $name ?>" data-productimage="<?php echo $row1->image_link ?>"  data-price="<?php if($row1->discount > 0){
                                                             $price_new = $row1->price - $row1->discount;
                                                             echo $price_new;
                                                          }else{
                                                            echo $row1->price; 
                                                            }    ?>" data-productid="<?php echo $row1->id ?>"  >Mua hàng</button>
                                                        <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row1->id.'.html'); ?>" class="product-item__more">Xem thêm</a>
                                                      </div>
                                                    </div><!-- end product-item__background -->
                                                    <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row1->id.'.html'); ?>">
                                                      <img src="<?php echo $row1->image_link ?>" alt="<?php echo $row1->name ?>">
                                                    </a>  
                                                </div><!-- product_img --> 
                                                <p class="price">
                                                   <?php if($row1->discount > 0): ?>
                                                      <?php $price_new = $row1->price - $row1->discount; ?>
                                                      <span> <?php echo number_format($price_new) ?> <sup>đ</sup></span>
                                                      <span class="price-old"> <?php echo number_format($row1->price) ?> <sup>đ</sup></span>
                                                    <?php else: ?>
                                                       <span> <?php echo number_format($row1->price) ?> <sup>đ</sup></span>
                                                    <?php endif; ?>
                                                </p>
                                                <div class="action_pd">
                                                  <a class="name_product" href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row1->id.'.html'); ?>"><?php echo $row1->name ?></a>
                                                </div>
                                            </div><!-- product item -->
                                      <?php endif; ?>
                                     <?php endforeach; ?>
                                    <?php endforeach; ?>

                                  </div><!-- end hotsale -->
                              </div><!-- end box-sale-content -->
                            </div><!-- end box_unhide_sale -->
                           <?php endif; ?>   

                            <!-- phan thu gon box thit -->
                            <?php if(count($row->subs) > 0): ?>  
                             <div class="box_hide_md_sale">
                               <div class="box-left">
                                 <div class="box_kinang">
                                  <div class="row">
                                      <div class="col">
                                          <div class="panel panel-default">
                                               <div class="panel-heading"> 
                                               <?php $name = $row->slug ?>
                                                 <a href="<?php echo base_url($name . '-c' . $row->id . '.html') ?>">
                                                   <h2><?php echo $row->name ?> <span class="fa fa-arrow-right"></span></h2>
                                                 </a>
                                                </div>
                                                  <div class="panel-body">
                                                    <div class="row">
                                                         <div class="new_main">
                                                           <ul  class="demo<?php echo $row->id?> box_pd">
                                                             <?php foreach($row->subs as $subs2): ?>
                                                              <?php foreach($list_pd as $row2): ?>
                                                                <?php $name = $row2->slug; ?>
                                                                <?php if($subs2->id == $row2->catalog_id ): ?>
                                                                  <li class="news-item">
                                                                    <div class="blog_img">
                                                                        <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row2->id.'.html'); ?>">
                                                                        <img alt="<?php echo $row2->name ?>" src="<?php echo $row2->image_link ?>" width="60" class="img-circle" />
                                                                    </a>
                                                                    </div>
                                                                    <div class="blog_detail">
                                                                        <div class="action_pd">
                                                                          <a class="name_product" href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row2->id.'.html'); ?>"><?php echo $row2->name ?></a>
                                                                        </div>
                                                                        <p class="price">
                                                                          <span class="price-old">100.000 <sup>đ</sup></span>
                                                                          <span> 90.000 <sup>đ</sup></span>
                                                                        </p>
                                                                    </div>
                                                                  </li>
                                                            <?php endif; ?>
                                                           <?php endforeach; ?>
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
                                    $(".demo<?php echo $row->id?>").bootstrapNews({
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
                         </div><!-- end box_hide_md_sale --> 
          <?php endif;?>
</section><!-- end product-sale -->
 <?php endif; ?>
<?php endforeach; ?>




<!-- section thu 3 -->
                         <section class="product-sale">
                            <div  class="banner-pd1">
                              <?php foreach($list_bannerTP as $row): ?>
                                <?php if($row->vitri == 2): ?>
                                  <div class="banner_img1">
                                     <a href="#">
                                       <img src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
                                     </a>
                                  </div><!-- end banner_img1 -->
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </div><!-- end banner-pd2 -->
</section>




<!-- section thu 1 o vi tri box 2 -->
                  <?php foreach($list_thucphamban as $row): ?>
                    <?php if($row->box_vitri == 2): ?>
                       <?php $name = $row->slug ?>
                        <section class="product-sale">
                            <!-- phan man hinh desktop -->
                            <?php if(count($row->subs) > 0): ?>
                            <div class="box_unhide_sale">
                                <div class="box-sale-heading">
                                  <div class="box-sale-title">
                                      <a href="<?php echo base_url($name.'-c'.$row->id.'.html') ?>">
                                        <h3><?php echo $row->name ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></h3>
                                      </a>
                                      <nav class="nav-box-sale hide-mb">
                                          <ul class="box-sale-children">
                                          <!-- lay ra danh muc con -->
                                            <?php foreach($row->subs as $subs): ?>
                                              <?php $name = $subs->slug; ?>
                                             <li><a href="<?php echo base_url($name . '-c' . $subs->id . '.html') ?>"> <?php echo $subs->name ?> </a></li>
                                             <?php endforeach; ?> 
                                          </ul>
                                      </nav>
                                  </div><!-- end box-sale-title -->
                              </div><!-- End heading -->

                              <div class="box-sale-content">
                                  <div class="owl-hotsale">
                                    <?php foreach($row->subs as $subs1): ?>
                                      <?php foreach($list_pd as $row1): ?>
                                        <?php $name = $row1->slug; ?>
                                        <?php if($subs1->id == $row1->catalog_id ): ?>
                                            <div class="product_item">
                                                <div class="product_img">
                                                    <div class="product-item__background">
                                                      <div class="product-item__buttons">
                                                        <button type="button" onclick="notify()" class="product-item__add add_cart" data-productname="<?php echo $row1->name ?>" data-slug="<?php echo $name ?>" data-productimage="<?php echo $row1->image_link ?>"  data-price="<?php if($row1->discount > 0){
                                                             $price_new = $row1->price - $row1->discount;
                                                             echo $price_new;
                                                          }else{
                                                            echo $row1->price; 
                                                            }    ?>" data-productid="<?php echo $row1->id ?>"  >Mua hàng</button>
                                                        <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row1->id.'.html'); ?>" class="product-item__more">Xem thêm</a>
                                                      </div>
                                                    </div><!-- end product-item__background -->
                                                    <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row1->id.'.html'); ?>">
                                                      <img src="<?php echo $row1->image_link ?>" alt="<?php echo $row1->name ?>">
                                                    </a>  
                                                </div><!-- product_img --> 
                                                <p class="price">
                                                   <?php if($row1->discount > 0): ?>
                                                      <?php $price_new = $row1->price - $row1->discount; ?>
                                                      <span> <?php echo number_format($price_new) ?> <sup>đ</sup></span>
                                                      <span class="price-old"> <?php echo number_format($row1->price) ?> <sup>đ</sup></span>
                                                    <?php else: ?>
                                                       <span> <?php echo number_format($row1->price) ?> <sup>đ</sup></span>
                                                    <?php endif; ?>
                                                </p>
                                                <div class="action_pd">
                                                  <a class="name_product" href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row1->id.'.html'); ?>"><?php echo $row1->name ?></a>
                                                </div>
                                            </div><!-- product item -->
                                      <?php endif; ?>
                                     <?php endforeach; ?>
                                    <?php endforeach; ?>

                                  </div><!-- end hotsale -->
                              </div><!-- end box-sale-content -->
                            </div><!-- end box_unhide_sale -->
                           <?php endif; ?>   

                            <!-- phan thu gon box thit -->
                            <?php if(count($row->subs) > 0): ?>  
                             <div class="box_hide_md_sale">
                               <div class="box-left">
                                 <div class="box_kinang">
                                  <div class="row">
                                      <div class="col">
                                          <div class="panel panel-default">
                                               <div class="panel-heading"> 
                                                <?php $name = $row->slug ?>
                                                 <a href="<?php echo base_url($name . '-c' . $row->id . '.html') ?>">
                                                   <h2><?php echo $row->name ?> <span class="fa fa-arrow-right"></span></h2>
                                                 </a>
                                                </div>
                                                  <div class="panel-body">
                                                    <div class="row">
                                                         <div class="new_main">
                                                           <ul  class="demo<?php echo $row->id?> box_pd">
                                                             <?php foreach($row->subs as $subs2): ?>
                                                              <?php foreach($list_pd as $row2): ?>
                                                              <?php $name = $row2->slug; ?>
                                                                <?php if($subs2->id == $row2->catalog_id ): ?>

                                                              <li class="news-item">
                                                                <div class="blog_img">
                                                                    <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row2->id.'.html'); ?>">
                                                                    <img alt="<?php echo $row2->name ?>" src="<?php echo $row2->image_link ?>" width="60" class="img-circle" />
                                                                </a>
                                                                </div>
                                                                <div class="blog_detail">
                                                                    <div class="action_pd">
                                                                      <a class="name_product" href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row2->id.'.html'); ?>"><?php echo $row2->name ?></a>
                                                                    </div>
                                                                    <p class="price">
                                                                      <span class="price-old">100.000 <sup>đ</sup></span>
                                                                      <span> 90.000 <sup>đ</sup></span>
                                                                    </p>
                                                                </div>
                                                              </li>
                                                            <?php endif; ?>
                                                           <?php endforeach; ?>
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
                                    $(".demo<?php echo $row->id?>").bootstrapNews({
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
                         </div><!-- end box_hide_md_sale --> 
          <?php endif;?>
</section><!-- end product-sale -->
 <?php endif; ?>
<?php endforeach; ?>















 


 <!-- tin hot moi nhat trong ngay -->
                      <div id="box-product-new-left">
                          <div class="wp_inner breaking_new_search ">
                           <div class="new_box">
                               <div class="inner" id="breaking_news">
                                  <div class="breaking-news">
                                      <div class="the_ticker">
                                          <div class="bn-title"><span>BẢN TIN HOT</span></div>
                                          <div class="news-ticker">
                                              <marquee direction="right" scrollamount="7" onmouseover="this.stop();" onmouseout="this.start();">
                                                  <ul>
                                                  <?php foreach($list_vs as $val): ?>
                                                      <li>
                                                        <i style="color: #023859" class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="#"><?php echo $val->title ?></a>
                                                      </li>
                                                   <?php endforeach; ?>
                                                  </ul>
                                              </marquee>
                                          </div>
                                      </div>
                                  </div>
                              </div><!-- End inner -->
                          </div><!-- end new_box -->
                       </div><!-- End wp_inner breaking_new_search --> 
                       
                       <div class="boxProduct_mostNew">
                          <div id="box_center_new">

                              <div class="tittle-box-center">
                                 <span>
                                    <h2>
                                        <?php 
                                           $defauld = "%d - %m - %Y";
                                           date_default_timezone_set('Asia/Ho_Chi_Minh');
                                           $time = time();
                                         ?>
                                        <label for="">
                                          <a >THỰC PHẨM MỚI NGÀY <?php echo  mdate($defauld, $time); ?></a>
                                        </label>
                                      </h2>
                                 </span>
                               </div><!-- End title- box-center -->

                               <div class="box-content-product">
                                <?php if(count($list_product) > 0): ?>
                                  <?php foreach($list_product as $row): ?> 
                                    <?php $name = $row->slug ; ?> 
                                      <div class="product_item">
                                        <div class="product_img">
                                          <div class="product-item__background">
                                            <div class="product-item__buttons">
                                              <button type="button"  class="product-item__add add_cart" data-productname="<?php echo $row->name ?>" data-slug="<?php echo $name ?>" data-productimage="<?php echo $row->image_link ?>"  data-price="<?php if($row->discount > 0){
                                                   $price_new = $row->price - $row->discount;
                                                   echo $price_new;
                                                }else{
                                                  echo $row->price; 
                                                  }    ?>" data-productid="<?php echo $row->id ?>"  >Mua hàng</button>
                                              <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>" class="product-item__more">Xem thêm</a>
                                            </div>
                                          </div><!-- end product-item__background -->

                                          <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>">
                                            <img  src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
                                          </a>  
                                        </div> 
                                        <p class="price">
                                          <?php if($row->discount > 0): ?>
                                            <?php $price_new = $row->price - $row->discount ; ?>
                                            <span> <?php echo number_format($price_new) ?> <sup>đ</sup></span>
                                            <span class="price-old"> <?php echo number_format($row->price) ?> <sup>đ</sup></span>
                                          <?php else: ?>
                                             <span> <?php echo number_format($row->price) ?> <sup>đ</sup></span>
                                          <?php endif; ?>
                                        </p>
                                        
                                        <div class="action_pd">
                                          <a class="name_product" href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>"><?php echo $row->name ?></a>
                                        </div>
                                      </div><!-- End product_item -->
                                  <?php endforeach; ?>
                                 <?php endif; ?> 
                              </div><!-- end box-content-product -->

                          </div> <!-- End box_center_new -->
                      </div><!-- boxProduct_mostNew -->

                    </div><!-- end box-product-new-left -->

                   <div id="box_product_most-right">
                         <div class="box_most_right">
                              <div class="title tittle-box-left">
                                <h2> Thực phẩm nổi bật  <i class="fa fa-arrow-right" aria-hidden="true"></i> </h2>
                              </div><!-- End title -->

                              <div class="highlight">
                                <?php if(count($product_noibat) > 0): ?>
                                  <?php foreach($product_noibat as $row): ?> 
                                    <?php $name = $row->slug ; ?> 
                                      <div class="product_item">
                                        <div class="product_img">
                                          <div class="product-item__background">
                                            <div class="product-item__buttons">
                                              <button type="button" onclick="notify()" class="product-item__add add_cart" data-productname="<?php echo $row->name ?>" data-slug="<?php echo $name ?>" data-productimage="<?php echo $row->image_link ?>"  data-price="<?php if($row->discount > 0){
                                                   $price_new = $row->price - $row->discount;
                                                   echo $price_new;
                                                }else{
                                                  echo $row->price; 
                                                  }    ?>" data-productid="<?php echo $row->id ?>"  >Mua hàng</button>
                                              <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>" class="product-item__more">Xem thêm</a>
                                            </div>
                                          </div><!-- end product-item__background -->

                                          <a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>">
                                            <img  src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
                                          </a>  
                                        </div> 
                                        <p class="price">
                                          <?php if($row->discount > 0): ?>
                                            <?php $price_new = $row->price - $row->discount ; ?>
                                            <span> <?php echo number_format($price_new) ?> <sup>đ</sup></span>
                                            <span class="price-old"> <?php echo number_format($row->price) ?> <sup>đ</sup></span>
                                          <?php else: ?>
                                             <span> <?php echo number_format($row->price) ?> <sup>đ</sup></span>
                                          <?php endif; ?>
                                        </p>
                                        
                                        <div class="action_pd">
                                          <a class="name_product" href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>"><?php echo $row->name ?></a>
                                        </div>
                                      </div><!-- End product_item -->
                                  <?php endforeach; ?>
                                 <?php endif; ?> 
                          </div><!-- End box_most_right-pd -->


                          <div class="box_most_right-online">
                              <div class="title tittle-box-left">
                                <h2> Hỗ trợ trực tuyến  <i class="fa fa-arrow-right" aria-hidden="true"></i> </h2>
                              </div><!-- End title -->
                            <?php foreach($list_support as $row): ?>
                                <div class="highlight">
                                    <div class="sp_1">
                                        <p>Đặt hàng online</p>
                                        <p>
                                          <span><?php echo $row->phone ?></span>
                                        </p>
                                    </div>

                                    <div class="sp_2">
                                        <p>Hotline</p>
                                        <p>
                                          <span><?php echo $row->phone ?></span>
                                        </p>
                                    </div>

                                    <div class="sp_mail">
                                        <p>Email liên hệ</p>
                                        <p>
                                          <span><?php echo $row->emails ?></span>
                                        </p>
                                    </div>
                                </div><!-- end highlight -->
                            <?php endforeach; ?>
                          </div><!-- End box_most_right -->
                        </div><!-- end box_most_right-online -->
                   </div> <!-- End box_product_most -->

                   <!-- phan banner -->
                  <div class="banner-pd1">
                    <?php if(count($list_bannerTP) > 0): ?>
                     <?php foreach($list_bannerTP as $row): ?> 
                        <?php if($row->vitri == 1): ?>
                          <div class="banner_img1">
                             <a href="#">
                               <img src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
                             </a>
                          </div>
                        <?php else: ?>
                          <?php echo ''; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                   <?php endif; ?>    
                  </div> <!-- banner tp vi tri 1 -->
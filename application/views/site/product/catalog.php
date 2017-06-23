<script language="javascript">
	$(document).ready(function(){
		$('.sort-by').change(function(){
			var val = $(this).val();

			if(val == 'default')
			{
				$('.default').show();
				$('.collection-grid-price_asc').hide();
				$('.collection-grid-price_desc').hide();
			}else if(val == 'price-asc')
			{
				$('.default').hide();
				$('.collection-grid-price_desc').hide();
				$('.collection-grid-price_asc').show();

			}else if(val == 'price-desc')
			{
				$('.default').hide();
				$('.collection-grid-price_asc').hide();
				$('.collection-grid-price_desc').show();
			}else{
				$('.default').show();
				$('.collection-grid-price_asc').hide();
				$('.collection-grid-price_desc').hide();
			}
			return false;
		});	
	});
</script>

<script language="javascript">
	function viewList() {
		localStorage.setItem('category', 'list');
		$(".grid").removeClass("active");
		$(".list").addClass("active");
		$(".collection-grid").hide();
		$(".collection-list").show();
		$('.sort-by option.nlast').css('display', 'none');

	}
	function viewGrid() {
		localStorage.setItem('category', 'grid');
		$(".list").removeClass("active");
		$(".grid").addClass("active");
		$(".collection-grid").show();
		$(".collection-list").hide();
		$('.sort-by option.nlast').css('display', 'block');
	}
	if(typeof(Storage) !== "undefined") {
		if(localStorage.category) {
			if (localStorage.getItem('category') == 'list') {
				viewList();
			} else {
				viewGrid();
			}
		} else {
			localStorage.setItem('category', 'grid');
			viewGrid();
		}
	}
</script>

<div class="header_breadcrumb">
	<ul class="breadcrumbs">
		<li><a href="<?php echo base_url()?>"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
		<!-- blog -->
		<?php foreach($list_catalog as $row): ?>
			<?php $name = $row->slug; ?>
			<?php if(count($row->subs) >= 1): ?>
				<!-- lap ra danh sach danh muc con -->
				<?php foreach($row->subs as $subs): ?>
					<?php if($subs->id == $catalog->id): ?>
			            <li><a href="<?php echo base_url($name . '-c' . $row->id . '.html') ?>"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; <?php echo $row->name ?> </a></li>
					 <?php else: ?>
					 	<?php echo ''; ?>
					 <?php endif; ?>	
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endforeach; ?>

	    <li class="active breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; <?php echo $catalog->name ?></li>
	</ul>
</div><!-- end header_breadcrum -->

 <!-- phần box danh muc thuc pham moi của web ở trang chủ-->
	<div id="box_sanphammoi" style="width:100%;  float:left;margin-bottom:15px; margin:0 auto; padding-bottom: 20px;">
		<div class="left-product show_mobile ">

			<?php $this->load->view("site/box_sanphammoi/sale_left.php", $this->data) ?><!-- danh sach thuc pham -->

			 <div class="box-left">
                  <div class="box_kinang">
                    <div class="row">
                        <div class="col">
                            <div class="panel panel-default">
                                 <div class="panel-heading"> 
                                   <h2><span class="fa fa-bars"></span> Tin vệ sinh an toàn TP </h2>
                                  </div>
                                    <div class="panel-body">
                                      <div class="row">
                                           <div class="new_main">
                                             <ul class="demo">
                                             <?php foreach($list_safety as $row): ?>
                                              <?php $name = $row->slug ; ?>
                                                <li class="news-item">
                                                  <div class="blog_img">
	                                                  <a href="#">
	                                                    <img src="<?php echo $row->image_link ?>" width="60" class="img-circle" />
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

		</div><!-- end left-product -->

		<div class="content-product">
			      <!-- danh sach thuvc pham theo danh muc -->
			       <?php if(!empty($catalog->avatar)): ?>
	                   <div class="avatar_img">
	                   	  <div class="collection__heading">	
		                   		<img alt="<?php echo $catalog->name ?>" src="<?php echo $catalog->avatar ?>" alt="Thịt lợn sạch">
		                   		<h1><?php echo $catalog->name ?></h1>
								<ul class="breadcrumb">
									<li><a href="<?php echo base_url()?>">Trang chủ &nbsp;</a></li>
									<!-- blog -->
								     <li class="active breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; <?php echo $catalog->name ?></li>
								</ul>
						  </div><!-- collection__heading -->		
	                   </div><!-- avatar_img -->
	                <?php else: ?>
	               	   <?php echo ''; ?>
					<?php endif; ?>

                   <div class="wrap_mota">
						<p><?php echo $catalog->content ?></p>
					</div><!-- wrap_mota -->
						
							<div class="collection__content">
								<div class="collection__toolbar">
									<nav class="view">
										<ul>
											<li>
												<a href="javascript:void(0)" onclick="viewGrid()" class="grid active"></a>
											</li>
											<li>
												<a href="javascript:void(0)" onclick="viewList()" class="list default"></a>
											</li>
										</ul>
									</nav>
									<div class="sortby">
										<label class="hidden-xs">Sắp xếp theo</label>
										<select class="sort-by">
											<option value="default">Mặc định</option>
											<option class="nlast" value="price-asc">Giá tăng dần</option>
											<option class="nlast" value="price-desc">Giá giảm dần</option>
										</select>
									</div>
								</div><!-- collecton__toolbar -->
								
							  <?php if(count($list) > 0): ?>
								<div class="collection-grid default">
									<div class="box-sale-content">
										<div class="owl-hotsale">
											<?php foreach($list as $row): ?>
												<?php $name = $row->slug; ?>
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
			                                              <img src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
			                                            </a>  
			                                        </div><!-- product_img --> 
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
			                                    </div><!-- end product-item -->
											<?php endforeach; ?>	
										</div><!-- end owl-hotsale -->	
									</div><!-- end box-sale-content -->
								</div><!-- end collection-grid -->


								<div class="collection-list ">
								   <?php foreach($list as $row): ?>	
								   	<?php $name = $row->slug; ?>
										<div class="product-item">
											<div class="product-item__thumbnail">
												<a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>" class="product-item__image">
													<img src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
												</a>
											</div>

											<a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>" class="product-item__name">
												<h3><?php echo $row->name ?></h3>
											</a>
											<div class="product-item__summary">
												<p> <?php echo $row->content ?> </p>
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

											<div class="product-item__buttons2">
												<button type="button"  class="product-item__add add_cart" data-productname="<?php echo $row->name ?>" data-slug="<?php echo $name ?>" data-productimage="<?php echo $row->image_link ?>"  data-price="<?php if($row->discount > 0){
	                                                   $price_new = $row->price - $row->discount;
	                                                   echo $price_new;
	                                                }else{
	                                                  echo $row->price; 
	                                                  }    ?>" data-productid="<?php echo $row->id ?>"  >Mua hàng</button>
												<a href="<?php echo base_url($name.'/xem-chi-tiet-p'.$row->id.'.html'); ?>">Xem chi tiết</a>
											</div>
										</div><!-- product-item -->
									<?php endforeach; ?>
								</div><!-- end collection-list -->
							  <?php else: ?>
							  	 <?php echo 'Thực phẩm hiện tại đang cháy hàng, Mong quí khách thông cảm!'; ?>
							  <?php endif; ?>

							
							<!-- price asc -->	
							<?php if(count($list) > 0): ?>
							  <div class="collection-grid-price_asc ">
									<div class="box-sale-content">
										<div class="owl-hotsale">
											<?php foreach($list_asc as $row): ?>
												<?php $name = $row->slug; ?>
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
			                                              <img src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
			                                            </a>  
			                                        </div><!-- product_img --> 
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
			                                    </div><!-- end product-item -->
											<?php endforeach; ?>	
										</div><!-- end owl-hotsale -->	
									</div><!-- end box-sale-content -->
								</div><!-- end collection-grid -->
							  <?php else: ?>
							  	 <?php echo 'Thực phẩm hiện tại đang cháy hàng, Mong quí khách thông cảm!'; ?>
							  <?php endif; ?>


							<!-- price desc -->
							  <?php if(count($list) > 0): ?>
							  <div class="collection-grid-price_desc ">
									<div class="box-sale-content">
										<div class="owl-hotsale">
											<?php foreach($list_desc as $row): ?>
												<?php $name = $row->slug; ?>
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
			                                              <img src="<?php echo $row->image_link ?>" alt="<?php echo $row->name ?>">
			                                            </a>  
			                                        </div><!-- product_img --> 
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
			                                    </div><!-- end product-item -->
											<?php endforeach; ?>	
										</div><!-- end owl-hotsale -->	
									</div><!-- end box-sale-content -->
								</div><!-- end collection-grid -->
							  <?php else: ?>
							  	 <?php echo 'Thực phẩm hiện tại đang cháy hàng, Mong quí khách thông cảm!'; ?>
							  <?php endif; ?>
								

							</div><!--  collection__content -->	

						<div class="pagination_page">
						  <?php echo $this->pagination->create_links() ?>
						 </div>
				       <div class="clear"></div>
		</div><!-- end content-product -->

						
    </div><!-- end box_sanphammoi -->
 <!-- phần box danh muc thuc pham moi của web ở trang chủ-->
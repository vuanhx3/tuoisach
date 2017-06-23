
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
	    <li class="breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; tìm kiếm </li>
	    <li class="breadcrumb-title"> Giá: <?php echo number_format($price_from) ?> <sup>đ</sup> - <?php echo number_format($price_to) ?> <sup>đ</sup></li>
	</ul>
</div><!-- end header_breadcrum -->

 <!-- phần box danh muc thuc pham moi của web ở trang chủ-->
	<div id="box_sanphammoi" style="width:100%;  float:left;margin-bottom:15px; margin:0 auto; padding-bottom: 20px;">
		<div class="left-product show_mobile ">

			<?php $this->load->view("site/box_sanphammoi/sale_left.php", $this->data) ?><!-- danh sach thuc pham -->

		</div><!-- end left-product -->

		<div class="content-product">
			      <!-- danh sach thuvc pham theo danh muc -->

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
							  	 <p style="margin-top: 20px; color: #898989;"><?php echo 'không tìm thấy thức phẩm nào !'; ?></p>
							  <?php endif; ?>
						 </div><!--  collection__content -->	
						
				       <div class="clear"></div>
		</div><!-- end content-product -->

						
    </div><!-- end box_sanphammoi -->
 <!-- phần box danh muc thuc pham moi của web ở trang chủ-->
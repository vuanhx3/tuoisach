<?php $this->load->view('site/product/head.php', $this->data)?>


<div class="col-lg-12">
  <div class="header_breadcrumb" >
    <ul class="breadcrumbs">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a></li>
      <!-- blog -->
      <?php foreach($list_catalog as $row): ?>
      	<?php $name = $row->slug; ?>
      	<?php if($row->id == $product->catalog_id): ?>
         <li><a href="<?php echo base_url($name . '-c' . $row->id . '.html') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; <?php echo $row->name ?> </a></li>
		<?php endif; ?>	
	  <?php endforeach; ?>	
      <li class="active breadcrumb-title"> <i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp; <?php echo $product->name ?> </li>
    </ul>
  </div>   
</div>

 <!-- phần box thuc pham moi của web ở trang chủ--> 
  <div id="box_sanphammoi" >
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
       <div  class="left-products show_mobiles">
		<?php $this->load->view("site/box_sanphammoi/sale_left.php", $this->data) ?><!-- danh sach thuc pham -->
		<div class="box-left">
            <div class="box_kinang">
              <div class="row_safety">
                  <div class="col">
                      <div class="panel panel-default">
                           <div class="panel-heading"> 
                             <h2><span class="fa fa-bars"></span> Mẹo vặt và kỹ năng </h2>
                            </div>
                              <div class="panel-body">
                                <div class="row">
                                     <div class="new_main">
                                       <ul class="demo">
                                       	<?php foreach($list_news as $row): ?>
	                                          <li class="news-item">
	                                            <div class="blog_img">
	                                                <a href="#">
	                                                <img src="<?php echo $row->image_link ?>" width="60" class="img-circle" />
	                                            </a>
	                                            </div>
	                                            <div class="blog_detail">
	                                               <h3><a href="#"><?php echo $row->title ?></a></h3>
	                                               <span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_date($row->created); ?> <i class="fa fa-eye" aria-hidden="true"></i> <?php echo $row->count_view ?> </span>
	                                                <p> <?php echo $row->intro ?> <a href="#">...[Xem thêm...]</a></p>
	                                            </div>
	                                          </li>
                                     	<?php endforeach; ?>
                                      </ul>
                                  </div>
                                </div><!-- end row -->
                              </div><!-- end panel-body -->
                              <div class="panel-footer"> 
                                   <ul class="pagination pull-right" >
                                      <li class="glyphicon_down">
                                      </li>
         
                                      <li class="glyphicon_up>
                                      </li>
                                  </ul>
                              <div class="clearfix"></div>
                            </div> <!-- end panel-footer  -->  
                          </div>
                      </div><!-- end col -->
                  </div><!-- end row -->
              </div><!-- End box-ki-nang -->
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
      </div><!-- left-products show_mobiles -->
   </div><!-- col-lg-3 col-md-3 col-sm-12 col-xs-12 -->

	
	<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="product-content">
            <div class>
                <div class="col-lg-6">
                    <div id="image_galary">
                      <div class="zoom ex1" id="imgMain"><!-- chua image chinh -->
                        <img src="<?php echo $product->image_link ?>" alt="" >
                      </div>
                      <div id="imgThumnail">
                       <?php if(count($list_img) > 0): ?>
                       	  <?php foreach($list_img as $row): ?>
                           <img src="<?php echo $row?>" alt="" >
						              <?php endforeach; ?>	
                       <?php endif; ?>
                      </div><!-- end imgContainer -->
                    </div><!-- image_galary -->
                </div><!-- col-lg-6 -->

                <div class="col-lg-6">
                    <div class="product_content">
                      <h3 class="product__name"><?php echo $product->name ?></h3>
                      <div class="product__summary">
                        <?php echo $product->content; ?> 
                      </div>
                       <?php if($product->number_pd > 0): ?>
                          <p id="status">Trạng Thái : <span>còn hàng</span></p>
                       <?php else: ?>
                      	  <p id="status">Trạng Thái : <span>Hết hàng</span></p>
					   <?php endif; ?>

					   <?php if(!empty($product->gifts)): ?>
                        <p id="status">Qùa tri ân : <span> <?php echo $product->gifts; ?> </span></p>
                       <?php else: ?>
						<p id="status"> <?php echo ''; ?> </p> 	
                       <?php endif; ?>

                      <p class="product__price">
                         <?php if($product->discount > 0): ?>
	                        <?php $price_new = $product->price - $product->discount ; ?>
	                        <span> <?php echo number_format($price_new) ?> <sup>đ</sup></span>
	                        <span class="price-old"> <?php echo number_format($product->price) ?> <sup>đ</sup></span>
	                      <?php else: ?>
	                         <span> <?php echo number_format($product->price) ?> <sup>đ</sup></span>
	                      <?php endif; ?>
                      </p>

                      <form action="" method="post" id="product-form">
                        <div class="product__variants">

                            <div class="product__variants__item">
                              <label>Số lượng</label>
                              <div class="product__quantity">
                                <span class="quantity__down" onclick="quantityChange('down')">-</span>
                                <input type="text" name="quantity" value="1">
                                <span class="quantity__up" onclick="quantityChange('up')">+</span>
                              </div><!-- end product__quantity -->
                            </div><!-- end product__variants__item -->
                           
                        </div><!-- end product__variants -->
                        <a style="cursor: pointer;" data-productname="<?php echo $product->name ?>" data-slug="<?php echo $product->slug ?>" data-productimage="<?php echo $product->image_link ?>" data-price="<?php if($product->discount > 0){
                           $price_new = $product->price - $product->discount;
                           echo $price_new;
                        }else{
                          echo $product->price; 
                          }    ?>" data-productid="<?php echo $product->id ?>" class="product__add">Mua hàng</a>
                      </form>



                      <script language="javascript">
                          // doan code khong cho nhap string  
                          $(document).ready(function(){
                              $(".product__quantity input").keydown(function (e) {
                               // Allow: backspace, delete, tab, escape, enter and .
                               if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                 // Allow: Ctrl+A, Command+A
                                 (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
                                 // Allow: home, end, left, right, down, up
                                 (e.keyCode >= 35 && e.keyCode <= 40)) {
                                 // let it happen, don't do anything
                                 return;
                               }
                               // Ensure that it is a number and stop the keypress
                               if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                 e.preventDefault();
                               }
                               if(isNaN($(".product__quantity input").val())) {
                                 $(".product__quantity input").val(1); 
                               }
                             });
                            
                          });
                         function quantityChange(change) {
                             var quantity = parseInt($('.product__quantity input').val());
                             if(change == 'down') {
                               quantity = quantity - 1;
                             } else {
                               quantity = quantity + 1;
                             }
                             if(quantity < 1) quantity = 1;
                             $('.product__quantity input').val(quantity);
                           }
                      </script>

                       <script language="javascript">
                         $(document).ready(function(){
                            $('.product__add').click(function(){
                              var product_qty = $(".product__quantity input").val();
                              var product_id    = $(this).data("productid");
                              var product_name  = $(this).data("productname");
                              var product_img   = $(this).data("productimage");
                              var product_price = $(this).data("price");
                              var product_slug  = $(this).data("slug");

                              // xu ly ajax
                              $.ajax({
                                url:"<?php echo base_url(); ?>cart/add_view",
                                method:"POST",
                                data:{
                                  product_id:product_id, product_name:product_name, product_img:product_img, product_price:product_price, product_slug:product_slug, product_qty:product_qty
                                },
                                success: function(data)
                                {
                                  $('.show_cart').html(data);
                                }
                              });

                              // thong bao mua hang thanh cong 
                              $.notify("Đã thêm " + product_name + " vào giỏ hàng thành công"   , "success");    

                              $.ajax({
                                url:"<?php echo base_url(); ?>cart/qty_cart",
                                cache: false,
                                success: function(result)
                                {
                                  $('.abc').html(result);
                                }
                              });  

                            });
                         });
                      </script>

                      <div class="product__share">
                        <ul>
                          <li class="facebook">
                            <!--<a target="_blank" href="http://www.facebook.com/sharer.php?u=https://standardfood.vn/ca-thu-phan-thiet">Facebook</a>-->
                            <a href="#" target="_blank">facebook</a>
                          </li>
                          <li class="twitter">
                            <a href="#">Twitter</a>
                          </li>
                          <li class="google">
                            <a href="#" >Google</a>
                          </li>
                        </ul>
                      </div><!-- product__share -->
                    </div>
                </div>
            </div><!-- end class -->
             <script language="javascript">
              $(document).ready(function(){
                $('#imgThumnail img').on({
                  mouseover : function(){
                    $(this).css({'cursor' : 'pointer', 'opacity' : '0.7', 'transaction' : '0.5s'});
                  },
                  mouseout : function(){
                    $(this).css({'cursor' : 'default', 'opacity' : '1', 'transaction' : '0.5s'});
                  },
                  click : function(){
                    var $mainImg = $('.ex1 img');
                    var $elementImg = $(this).attr('src');
                    $mainImg.fadeOut(300, function(){$(this).attr('src', $elementImg );}).fadeIn(300);
                  }
                });
              });
            </script><!-- doan script hieu ung anh -->
        </div><!-- end product-content -->



	 	 <!-- phan tab noi dung san pham -->
	       <div class="product_tabs">
	          <ul class="tab_product">
	            <li><a title="tab-1" class="tab active_tab" > Thông Tin </a></li>
	            <li><a title="tab-2" class="tab " > Thẻ Tags </a></li>
	            <li><a title="tab-3" class="tab " > Video </a></li>
	          </ul>

	          <div class="tab_contents">
	              <div id="tab-1" class="contentTab">
	                 <?php echo $product->content ?>
	              </div><!-- end contentTab -->

	              <div id="tab-2" class="contentTab">
	                 Cố lên tôi ơi
	              </div><!-- end contentTab -->

	              <div id="tab-3" class="contentTab">
	                <?php echo $product->nhung_video; ?>
	              </div><!-- end contentTab-->
	          </div><!-- tab_contents -->
	       </div><!-- end product-tabs -->

	       <script language="javascript">
	         $(document).ready(function(){
	            $('.tab').on('click', function(){
	              $('.active_tab').removeClass('active_tab');
	              // them moi class active vao
	              $(this).addClass('active_tab');

	              // an the div theo tab do di khi chuyen sang div khac
	              $('.contentTab').hide();
	              var $title = $(this).attr('title');
	              $('#' + $title).show();
	            });
	         });
	       </script>


	       <!-- phan thuc pham lien quan -->
			 <div class="product_related">
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 product_lienquan ">
                          <div class="box_heading">
                              <h2>
                                  Thực phẩm liên quan
                              </h2>
                          </div>
                          <!-- Controls -->
                          <div class="controls pull-right mobile-hidden_top">
                             <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example"
                                  data-slide="prev"></a>
                             <a class="right fa fa-chevron-right btn btn-success" href="#carousel-example"
                                      data-slide="next"></a>
                          </div>
                       </div>

                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  ">
                        <div id="carousel-example" class="carousel slide mobile-hidden_content" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="row">

                                        <?php foreach($list_lienquan as $row): ?>
                    											<?php $name = $row->slug; ?>
                    											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mobile_product ">
                      												<div class="product_item">
    			                                        <div class="product_img">
    			                                            <div class="product-item__background">
    	                                                      <div class="product-item__buttons">
    	                                                        <a href="#"  class="product-item__add">Mua hàng</a>
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
    		                                    </div><!-- mobile_product -->
                    										<?php endforeach; ?>	

                                    </div><!-- end row -->
                                </div><!-- end item -->

                                <div class="item">
                                     <div class="row">
                               
	                                     <?php foreach($list_lienquan as $row): ?>
                  											<?php $name = $row->slug; ?>
                  											<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 mobile_product ">
                    												<div class="product_item">
  			                                        <div class="product_img">
  			                                            <div class="product-item__background">
  	                                                      <div class="product-item__buttons">
  	                                                        <a href="#"  class="product-item__add">Mua hàng</a>
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
		                                    </div><!-- end mobile_product  -->
										                  <?php endforeach; ?>	
                               
                                     </div> <!-- end row -->
                               </div><!-- end item -->
                            </div>
                        </div>      
                      </div>                  
                   </div><!-- product-relate -->	
	       <!-- phan thuc pham lien quan -->
    

    </div><!-- col-lg-9 col-md-9 col-sm-12 col-xs-12 -->		

 </div><!-- box_sanphammoi -->  
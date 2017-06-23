    <!-- script autocomplete -->
     <link type="text/css" href="<?php echo public_url()?>/js/jquery/autocomplete/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet"> 
     <script type="text/javascript" src="<?php echo public_url()?>/js/jquery/autocomplete/jquery-ui.js"></script>

    <script language="javascript">
       $(document).ready(function(){
          $('.bt-menu > span').click(function(){
            var open = $(this).attr('class');
            if(open == 'fa fa-bars')
            {
              $(this).removeClass('fa-bars').addClass('fa-times');
            }else if(open == 'fa fa-times')
            {
              $(this).removeClass('fa-times').addClass('fa-bars');
            }else{
              $(this).removeClass('fa-times').addClass('fa-bars');
            }
          });
       });
     </script>
     
     <div class="menu_top_bar clearfix">
        <a href="#" class="bt-menu"><span class="fa fa-bars"></span></a>
     </div>

     <div class="top_bar clearfix">
          <div class="inner">
              <div id="top_bar_left">
                  <ul id="menu_primary_items">
                    <?php if(isset($user_info)): ?>
                       <div id="nav_left" style="float: left; padding-left: 15px; ">
                           <li class=""><a href="<?php echo site_url('user/index'); ?>"><i class="fa fa-user" aria-hidden="true"></i> Xin chào: <?php echo $user_info->name ?></a></li>
                          
                           <li><a class="verify_logout" href="<?php echo site_url('user/logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát </a></li>
                           <script language="javascript">
                              $(document).ready(function(){
                                $('a.verify_logout').click(function(){
                                  if(!confirm('Bạn có chắc chắn muốn đăng xuất ?'))
                                  {
                                    return false;
                                  }
                                });
                              });
                           </script>
                        </div><!-- nav-left -->   

                       <div id="nav_right" style="float: right ; padding-right: 15px; ">
                           <li><a href="#">HotLine: 01647858168 - Mail <i class="fa fa-envelope" aria-hidden="true"></i> </a></li>
                       </div><!-- nav-right -->
                     <?php else: ?>
                        <div id="nav_left" style="float: left; padding-left: 15px; ">
                          <li class=""><a href="<?php echo site_url('user/register')?>"><i class="fa fa-user-plus" aria-hidden="true"></i> ĐĂNG KÝ</a></li>

                          <li class=""><a href="<?php echo site_url('user/login')?>"><i class="fa fa-sign-in" aria-hidden="true"></i> ĐĂNG NHẬP</a></li>
                       </div>
                        
                        <div id="nav_right" style="float: right ; padding-right: 15px; ">
                           <li><a href="#">HotLine:01647858168 - Mail <i class="fa fa-envelope" aria-hidden="true"></i> </a></li>
                        </div>
                     <?php endif; ?>   

                  </ul>
              </div>
          </div>    
      </div>

     

			<div class="wp_inner top_logo">
		       <div id="logo"><!-- the logo -->
               <a href="<?php echo base_url(); ?>">
                 <img class="tuoisach" src="<?php echo $homepage->image_link ?>" alt="<?php echo $homepage->site_desc ?>">
                </a>
            </div><!-- End logo -->

             <div class="search-form"><!-- the search -->
                <form method="get" action="<?php echo site_url('product/search'); ?>">
                  <input type="text" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" name="key-search" value="<?php echo isset($key)? $key : ''; ?>" placeholder="Tìm kiếm..." id="search" class="search-form__query ui-autocomplete-input">
                  <button type="submit" class="search-form__submit"></button>
                </form>
             </div><!-- End search -->

              <div id="cart_expand" class="cart "> <!--  load gio hàng -->
                 <div class="header-cart__button">
                 <a href="<?php echo base_url('cart'); ?>"> Giỏ hàng: <span class="abc">  </span> </a>
                    <div  class="show_cart">
                    
                    </div>
                 </div>
             </div> <!--  load gio hàng -->

              <script type="text/javascript">
                $(function() {
                    $( "#search" ).autocomplete({
                        source: "<?php echo site_url('product/search/1')?>",
                    });
                });
              </script>

             <div class="clearfix"></div>

           <!--  <div  id="search-form">
                <form action="" class="form-wrapper" method="get" >
                    <input type="text" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" placeholder="Thực phẩm bạn tìm là..." value="" name="key-search" id="search"       >
                    <input id="submit" value="tìm kiếm" type="submit" name="but">
                </form>
            </div> -->
			</div>	

     <script language="javascript">
       $(document).ready(function(){
          // add to cart
          $('.add_cart').click(function(){
            var product_id    = $(this).data("productid");
            var product_name  = $(this).data("productname");
            var product_img   = $(this).data("productimage");
            var product_price = $(this).data("price");
            var product_slug  = $(this).data("slug");

            // xu ly ajax
            $.ajax({
              url: "<?php echo base_url(); ?>cart/add",
              method: "POST",
              data:{
                product_id:product_id, product_name:product_name, product_img:product_img, product_price:product_price, product_slug:product_slug
              },
              dataType: 'html',
              cache:false,
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

         // load san pham khi reset lai trang 
         $('.abc').load("<?php echo base_url();?>cart/load_qty_cart");
         $('.show_cart').load("<?php echo base_url();?>cart/load");

         // xoa san pham
         $(document).on('click', '.remove_item', function(){
              var row_id = $(this).attr("id");
              // xu ly ajax
              $.ajax({
                url : "<?php echo base_url();?>cart/remove",
                method: "POST",
                data:{
                  row_id:row_id
                },
                cache:false,
                success: function(data)
                {
                  $('.show_cart').html(data);
                }
              });

              $.ajax({
                url:"<?php echo base_url(); ?>cart/qty_cart",
                cache:false,
                success: function(result)
                {
                  $('.abc').html(result);
                }
              });
         });

         // xoa het san pham
         $(document).on('click', '#clear_cart_action', function(){
            if(confirm("Bạn muốn xóa tất cả ?"))
            {
              $.ajax({
                url: "<?php echo base_url();?>cart/clear",
                cache:false,
                success: function(data)
                {
                  $('.show_cart').html(data);
                }
              });

              $('.abc').html('0');
            }else{
              return false;
            }
         });
       });

        $(document).ready(function(){

           $('.header-cart__button').mouseover(function(){
               $('.show_cart').show();
             });

           $('.header-cart__button').mouseout(function(){
             $('.show_cart').hide();
           });

            
         });
     </script>